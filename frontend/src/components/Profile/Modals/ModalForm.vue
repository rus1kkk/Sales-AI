<template>
  <div v-if="isOpen" class="modal-overlay">
    <form class="modal" @submit.prevent="handleSubmit">
      <div class="input">
        <div class="title-row">
          <p>{{ title }}</p>
          <button type="button" @click="onClose">x</button>
        </div>
        <div class="inputs">
          <div v-for="(input, index) in inputs" :key="index" class="input-wrapper">
            <InputModal
              :placeholder="input.placeholder || `Поле ${index + 1}`"
              :type="input.type || 'text'"
              :value="inputValues[index] || ''"
              :hasError="!!validationErrors[index] && touchedFields[index]"
              @update:value="updateInputValue(index, $event)"
              @blur="handleBlur(index)"
              :aria-describedby="
                validationErrors[index] && touchedFields[index] ? `error-${index}` : null
              "
            />
            <div
              v-if="validationErrors[index] && touchedFields[index]"
              class="error-message"
              :id="`error-${index}`"
            >
              {{ validationErrors[index] }}
            </div>
          </div>
        </div>
      </div>
      <div class="action-buttons">
        <button type="button" @click="onClose">Отменить</button>
        <button type="submit" :disabled="!isFormValid">Принять</button>
      </div>
    </form>
  </div>
</template>
<script>
import InputModal from './InputModal.vue'

export default {
  name: 'ModalForm',
  components: {
    InputModal,
  },
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
      },
      immediate: true,
    },
  },
  methods: {
    updateInputValue(index, value) {
      const newValues = [...this.inputValues]
      newValues[index] = value
      this.inputValues = newValues

      if (!this.touchedFields[index]) {
        const newTouched = [...this.touchedFields]
        newTouched[index] = true
        this.touchedFields = newTouched
      }

      this.validateField(index, value, 'input')
    },
    handleBlur(index) {
      const newTouched = [...this.touchedFields]
      newTouched[index] = true
      this.touchedFields = newTouched

      this.validateField(index, this.inputValues[index], 'blur')
    },
    validateField(index, value, eventType = 'input') {
      const newErrors = [...this.validationErrors]
      const rules = this.getValidationRules(index, this.field)

      newErrors[index] = ''
      for (const rule of rules) {
        if (rule.eventType && rule.eventType !== eventType) continue
        if (!rule.validator(value)) {
          newErrors[index] = rule.message
          break
        }
      }

      // Для паролей проверяем подтверждение при изменении первого поля
      if (this.field === 'password' && index === 0 && this.inputValues[1] && eventType === 'blur') {
        newErrors[1] = this.validatePasswordConfirm(this.inputValues[0], this.inputValues[1])
      }

      this.validationErrors = newErrors
    },
    getValidationRules(index, field) {
      switch (field) {
        case 'name':
          return [
            {
              eventType: 'input',
              validator: (value) => /^[а-яёА-ЯЁa-zA-Z]*$/.test(value),
              message: 'Имя должно состоять только из букв',
            },
            {
              eventType: 'blur',
              validator: (value) => value.trim() !== '',
              message: 'Имя не может быть пустым',
            },
            {
              eventType: 'blur',
              validator: (value) => value.trim().length >= 2,
              message: 'Имя должно содержать минимум 2 символа',
            },
          ]
        case 'phone':
          return [
            {
              eventType: 'input',
              validator: (value) => /^[\d+\s]*$/.test(value),
              message: 'Только цифры, +, -, (), пробелы',
            },
            {
              eventType: 'blur',
              validator: (value) => value.trim() !== '',
              message: 'Номер телефона не может быть пустым',
            },
            {
              eventType: 'blur',
              validator: (value) => {
                const cleanPhone = value.replace(/[^\d+]/g, '')
                return /^(\+7|8)\d*$/.test(cleanPhone)
              },
              message: 'Номер телефона должен начинаться с +7 или +8',
            },
            {
              eventType: 'blur',
              validator: (value) => value.length == 12,
              message: 'Номер телефона должен состоять из 11 цифр',
            },
          ]
        case 'email':
          return [
            {
              eventType: 'input',
              validator: (value) => /^[^\s@]*@?[^\s@]*\.?[^\s@]*$/.test(value),
              message: 'Недопустимые символы в email',
            },
            {
              eventType: 'blur',
              validator: (value) => value.trim() !== '',
              message: 'Email не может быть пустым',
            },
            {
              eventType: 'blur',
              validator: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
              message: 'Введите корректный email адрес',
            },
          ]
        case 'password':
          if (index === 0) {
            return [
              {
                eventType: 'input',
                validator: (value) => /^[a-zA-Z0-9!@#$%^&*]*$/.test(value),
                message: 'Только буквы, цифры и специальные символы',
              },
              {
                eventType: 'blur',
                validator: (value) => value.trim() !== '',
                message: 'Пароль не может быть пустым',
              },
              {
                eventType: 'blur',
                validator: (value) => value.length >= 6,
                message: 'Пароль должен содержать минимум 6 символов',
              },
              {
                eventType: 'blur',
                validator: (value) => /(?=.*[a-zA-Z])(?=.*\d)/.test(value),
                message: 'Пароль должен содержать хотя бы одну букву и одну цифру',
              },
            ]
          } else if (index === 1) {
            return [
              {
                eventType: 'blur',
                validator: (value) => value.trim() !== '',
                message: 'Подтвердите пароль',
              },
              {
                eventType: 'blur',
                validator: (value) => value === this.inputValues[0],
                message: 'Пароли не совпадают',
              },
            ]
          }
          break
        default:
          return []
      }
    },
    validatePasswordConfirm(password, confirmPassword) {
      if (!confirmPassword || confirmPassword.trim() === '') {
        return 'Подтвердите пароль'
      }
      if (password !== confirmPassword) {
        return 'Пароли не совпадают'
      }
      return ''
    },
    handleSubmit() {
      this.touchedFields = new Array(this.inputs.length).fill(true)

      this.inputValues.forEach((value, index) => {
        this.validateField(index, value, 'blur')
      })

      if (this.isFormValid) {
        this.onSubmit(this.inputValues)
      }
    },
  },
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(15, 0, 0, 0.25);
  backdrop-filter: blur(12.5px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal {
  display: flex;
  width: 100%;
  max-width: 777px;
  min-height: 263px;
  padding: 36px;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 24px;
  border-radius: 61px;
  background: rgba(255, 255, 255, 0.2);
}

.input {
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 24px;
  align-self: stretch;
}

.title-row {
  font-family: Montserrat;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}

.inputs {
  display: flex;
  flex-direction: column;
  gap: 24px;
  width: 100%;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  gap: 8px;
  width: 100%;
}

.error-message {
  color: #ff9999;
  text-align: center;
  font-family: Montserrat;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 19.2px */
}

.action-buttons {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
  gap: 24px;
  align-self: stretch;
}

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
