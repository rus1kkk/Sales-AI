<template>
  <div v-if="isOpen" class="modal-overlay">
    <form class="modal" @submit.prevent="handleSubmit">
      <div class="input">
        <div class="title-row">
          <p>{{ title }}</p>
          <CustomButton type="icon" @click="onClose">
            <template #icon>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="21"
                viewBox="0 0 20 21"
                fill="none"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M0.418415 0.918415C0.976316 0.360528 1.88083 0.360528 2.43873 0.918415L10 8.47973L17.5613 0.918415C18.1192 0.360528 19.0237 0.360528 19.5816 0.918415C20.1395 1.47632 20.1395 2.38083 19.5816 2.93873L12.0203 10.5L19.5816 18.0613C20.1395 18.6192 20.1395 19.5237 19.5816 20.0816C19.0237 20.6395 18.1192 20.6395 17.5613 20.0816L10 12.5203L2.43873 20.0816C1.88083 20.6395 0.976316 20.6395 0.418415 20.0816C-0.139472 19.5237 -0.139472 18.6192 0.418415 18.0613L7.97973 10.5L0.418415 2.93873C-0.139472 2.38083 -0.139472 1.47632 0.418415 0.918415Z"
                  fill="#A8A9AF"
                />
              </svg>
            </template>
          </CustomButton>
        </div>
        <div class="inputs">
          <div v-for="(input, index) in inputs" :key="index" class="input-wrapper">
            <InputModal
              :placeholder="input.placeholder || `Поле ${index + 1}`"
              :type="input.type || 'text'"
              :value="inputValues[index] || ''"
              :hasError="!!validationErrors[index]"
              @update:value="handleInputChange(index, $event)"
              @blur="handleBlur(index)"
              :aria-describedby="validationErrors[index] ? `error-message-${index}` : null"
            />
            <div 
              v-if="validationErrors[index]" 
              class="error-message" 
              :class="{ 'error-visible': validationErrors[index] }" 
              :id="`error-message-${index}`"
            >
              {{ validationErrors[index] }}
            </div>
          </div>
          <div 
            v-if="serverError" 
            class="server-error-message" 
            :class="{ 'error-visible': serverError }"
          >
            {{ serverError }}
          </div>
        </div>
      </div>
      <div class="action-buttons">
        <CustomButton type="text" label="Отменить" @click="onClose" />
        <CustomButton
          type="text-blue"
          label="Принять"
          buttonType="submit"
          :disabled="isSubmitting || !isFormValid"
        />
      </div>
    </form>
  </div>
</template>

<script>
import InputModal from './InputModal.vue'
import CustomButton from '../CustomButton.vue'
import { ValidationHelpers } from '@/utils/ValidationModule.js'

export default {
  name: 'ModalForm',
  components: { InputModal, CustomButton },
  props: {
    isOpen: { type: Boolean, required: true },
    title: { type: String, default: 'Модальное окно' },
    inputs: {
      type: Array,
      default: () => [],
      validator: (inputs) =>
        inputs.every(
          (input) => typeof input === 'object' && 'placeholder' in input && 'type' in input,
        ),
    },
    field: { type: String, default: '' },
    onClose: { type: Function, required: true },
    onSubmit: { type: Function, required: true },
  },
  data() {
    return {
      inputValues: [],
      validationErrors: [],
      touchedFields: [],
      isSubmitting: false,
      serverError: '',
      debounceTimeouts: [], // Для дебаунсинга
    }
  },
  computed: {
    isFormValid() {
      return (
        this.inputValues.length === this.inputs.length &&
        this.inputValues.every((value) => value && value.trim() !== '') &&
        this.validationErrors.every((error) => !error)
      )
    },
  },
  watch: {
    inputs: {
      handler() {
        this.inputValues = this.inputs.map((input) => input.value || '')
        this.validationErrors = new Array(this.inputs.length).fill('')
        this.touchedFields = new Array(this.inputs.length).fill(false)
        this.debounceTimeouts = new Array(this.inputs.length).fill(null)
        this.serverError = ''
      },
      immediate: true,
    },
  },
  methods: {
    handleInputChange(index, value) {
      const newValues = [...this.inputValues]
      newValues[index] = value
      this.inputValues = newValues

      if (!this.touchedFields[index]) {
        const newTouched = [...this.touchedFields]
        newTouched[index] = true
        this.touchedFields = newTouched
      }

      this.serverError = ''
      // Очищаем ошибку для текущего поля при вводе
      this.setFieldError(index, '')

      // Для поля подтверждения пароля используем специальную обработку
      if (this.field === 'password' && index === 1) {
        // Для подтверждения пароля только проверяем совпадение
        this.validatePasswordConfirmation()
      } else {
        // Валидация на input (недопустимые символы)
        this.validateOnInput(index, value)
        
        // Дебаунсинг для валидации длины и формата
        this.debouncedValidation(index, value)
      }
    },

    handleBlur(index) {
      const newTouched = [...this.touchedFields]
      newTouched[index] = true
      this.touchedFields = newTouched
      
      // Очищаем дебаунс при blur
      if (this.debounceTimeouts[index]) {
        clearTimeout(this.debounceTimeouts[index])
        this.debounceTimeouts[index] = null
      }
      
      // Для поля подтверждения пароля используем специальную валидацию
      if (this.field === 'password' && index === 1) {
        this.validatePasswordConfirmation()
      } else {
        // Полная валидация при blur для остальных полей
        this.validateOnBlur(index, this.inputValues[index])
      }
    },

    validateOnInput(index, value) {
      const fieldType = this.getFieldType(index)
      if (!fieldType) return

      const result = ValidationHelpers.validateOnInput(fieldType, value)
      
      if (!result.success) {
        const firstError = Object.values(result.errors)[0]?.[0]
        this.setFieldError(index, firstError || '')
      }
    },

    debouncedValidation(index, value) {
      const fieldType = this.getFieldType(index)
      if (!fieldType) return

      // Очищаем предыдущий timeout
      if (this.debounceTimeouts[index]) {
        clearTimeout(this.debounceTimeouts[index])
      }

      // Устанавливаем новый timeout
      this.debounceTimeouts[index] = setTimeout(() => {
        // Сначала проверяем input валидацию
        const inputResult = ValidationHelpers.validateOnInput(fieldType, value)
        
        if (!inputResult.success) {
          // Если есть ошибка на input уровне, показываем её
          const firstError = Object.values(inputResult.errors)[0]?.[0]
          this.setFieldError(index, firstError || '')
        } else {
          // Если input валидация прошла, проверяем debounced
          const debouncedResult = ValidationHelpers.validateOnDebounced(fieldType, value)
          
          if (!debouncedResult.success) {
            const firstError = Object.values(debouncedResult.errors)[0]?.[0]
            this.setFieldError(index, firstError || '')
          } else {
            this.setFieldError(index, '')
          }
        }
        
        // Дополнительная проверка для подтверждения пароля
        if (this.field === 'password' && index === 0 && this.inputValues[1]) {
          this.validatePasswordConfirmation()
        }
      }, 1000)
    },

    validateOnBlur(index, value) {
      const fieldType = this.getFieldType(index)
      if (!fieldType) return

      const result = ValidationHelpers.validateOnBlur(fieldType, value)
      
      if (!result.success) {
        const firstError = Object.values(result.errors)[0]?.[0]
        this.setFieldError(index, firstError || '')
      } else {
        this.setFieldError(index, '')
      }

      // Дополнительная проверка для подтверждения пароля
      if (this.field === 'password') {
        if (index === 0 && this.inputValues[1]) {
          this.validatePasswordConfirmation()
        } else if (index === 1) {
          this.validatePasswordConfirmation()
        }
      }
    },

    validatePasswordConfirmation() {
      if (this.field !== 'password' || this.inputValues.length < 2) return

      const password = this.inputValues[0]
      const confirmPassword = this.inputValues[1]

      if (confirmPassword.trim() === '') {
        this.setFieldError(1, 'Подтвердите пароль')
      } else if (password !== confirmPassword) {
        this.setFieldError(1, 'Пароли не совпадают')
      } else {
        this.setFieldError(1, '')
      }
    },

    getFieldType(index) {
      if (this.field === 'password') {
        if (index === 0) {
          return 'password' // Первое поле - новый пароль
        } else if (index === 1) {
          return null // Второе поле - подтверждение пароля, обрабатывается отдельно
        }
      }
      return this.field
    },

    setFieldError(index, error) {
      const newErrors = [...this.validationErrors]
      newErrors[index] = error
      this.validationErrors = newErrors
    },

    async handleSubmit() {
      this.touchedFields = new Array(this.inputs.length).fill(true)
      
      // Валидируем все поля при отправке
      this.inputValues.forEach((value, index) => {
        if (this.field === 'password' && index === 1) {
          // Для подтверждения пароля используем специальную валидацию
          this.validatePasswordConfirmation()
        } else {
          this.validateOnBlur(index, value)
        }
      })

      if (this.isFormValid) {
        this.isSubmitting = true
        this.serverError = ''
        try {
          await this.onSubmit(this.inputValues)
        } catch (error) {
          this.serverError = error.message || this.getErrorMessage(this.field)
        } finally {
          this.isSubmitting = false
        }
      }
    },

    getErrorMessage(field) {
      const errorMessages = {
        name: 'Не удалось изменить имя',
        phone: 'Не удалось изменить номер телефона',
        email: 'Не удалось изменить почту',
        password: 'Не удалось изменить пароль',
      }
      return errorMessages[field] || 'Ошибка при сохранении данных'
    },
  },
  
  beforeUnmount() {
    // Очищаем все таймауты при уничтожении компонента
    this.debounceTimeouts.forEach(timeout => {
      if (timeout) {
        clearTimeout(timeout)
      }
    })
  },
}
</script>

<style scoped>
@import '../../../assets/styles/Profile/ModalForm.css';
</style>