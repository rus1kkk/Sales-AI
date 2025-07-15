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
              :aria-describedby="errorMessage ? 'error-message' : null"
            />
          </div>
          <div class="error-message" :class="{ 'error-visible': errorMessage }" id="error-message">
            {{ errorMessage || '' }}
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
import InputModal from './InputModal.vue';
import CustomButton from '../CustomButton.vue';

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
        inputs.every((input) => typeof input === 'object' && 'placeholder' in input && 'type' in input),
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
    };
  },
  computed: {
    isFormValid() {
      return (
        this.inputValues.length === this.inputs.length &&
        this.inputValues.every((value) => value && value.trim() !== '') &&
        this.validationErrors.every((error) => !error)
      );
    },
    errorMessage() {
      if (this.serverError) return this.serverError;
      const errorIndex = this.validationErrors.findIndex((error) => error);
      return errorIndex !== -1 ? this.validationErrors[errorIndex] : '';
    },
  },
  watch: {
    inputs: {
      handler() {
        this.inputValues = this.inputs.map((input) => input.value || '');
        this.validationErrors = new Array(this.inputs.length).fill('');
        this.touchedFields = new Array(this.inputs.length).fill(false);
        this.serverError = '';
      },
      immediate: true,
    },
  },
  methods: {
    handleInputChange(index, value) {
      const newValues = [...this.inputValues];
      newValues[index] = value;
      this.inputValues = newValues;

      if (!this.touchedFields[index]) {
        const newTouched = [...this.touchedFields];
        newTouched[index] = true;
        this.touchedFields = newTouched;
      }

      this.serverError = '';
      this.validateField(index, value);
    },

    handleBlur(index) {
      const newTouched = [...this.touchedFields];
      newTouched[index] = true;
      this.touchedFields = newTouched;
      this.validateField(index, this.inputValues[index]);
    },

    validateField(index, value) {
      const newErrors = [...this.validationErrors];
      const rules = this.getValidationRules(index, this.field);

      let currentError = '';

      for (const rule of rules) {
        if (!rule.validator(value)) {
          currentError = rule.message;
          break;
        }
      }

      newErrors[index] = currentError;

      if (this.field === 'password' && index === 0 && this.inputValues[1]) {
        newErrors[1] = this.inputValues[1].trim() === ''
          ? 'Подтвердите пароль'
          : this.inputValues[0] !== this.inputValues[1]
            ? 'Пароли не совпадают'
            : '';
      }

      this.validationErrors = newErrors;
    },

    getValidationRules(index, field) {
      switch (field) {
        case 'name':
          return [
            {
              validator: (value) => /^[а-яёА-ЯЁa-zA-Z]+$/.test(value),
              message: 'Имя должно состоять только из букв',
            },
            {
              validator: (value) => value.trim() !== '',
              message: 'Имя не может быть пустым',
            },
            {
              validator: (value) => value.trim().length >= 2,
              message: 'Имя должно содержать минимум 2 символа',
            },
          ];
        case 'phone':
          return [
            {
              validator: (value) => /^(\+?[\d\s\-\(\)]*)?$/.test(value),
              message: 'Только цифры, +, -, (), пробелы',
            },
            {
              validator: (value) => {
                const plusCount = (value.match(/\+/g) || []).length;
                return plusCount <= 1 && (plusCount === 0 || value.indexOf('+') === 0);
              },
              message: 'Знак + может быть только в начале номера',
            },
            {
              validator: (value) => value.trim() !== '',
              message: 'Номер телефона не может быть пустым',
            },
            {
              validator: (value) => {
                const cleanPhone = value.replace(/[^\d]/g, '');
                return cleanPhone.length === 11;
              },
              message: 'Номер должен содержать 11 цифр',
            },
          ];
        case 'email':
          return [
            {
              validator: (value) => /^[^\s@]*@?[^\s@]*\.?[^\s@]*$/.test(value),
              message: 'Недопустимые символы в email',
            },
            {
              validator: (value) => value.trim() !== '',
              message: 'Email не может быть пустым',
            },
            {
              validator: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
              message: 'Введите корректный email адрес',
            },
          ];
        case 'password':
          if (index === 0) {
            return [
              {
                validator: (value) => /^[a-zA-Z0-9!@#$%^&*]*$/.test(value),
                message: 'Только буквы, цифры и специальные символы',
              },
              {
                validator: (value) => value.trim() !== '',
                message: 'Пароль не может быть пустым',
              },
              {
                validator: (value) => value.length >= 6,
                message: 'Пароль должен содержать минимум 6 символов',
              },
              {
                validator: (value) => /(?=.*[a-zA-Z])(?=.*\d)/.test(value),
                message: 'Пароль должен содержать хотя бы одну букву и одну цифру',
              },
            ];
          } else if (index === 1) {
            return [
              {
                validator: (value) => value.trim() !== '',
                message: 'Подтвердите пароль',
              },
              {
                validator: (value) => value === this.inputValues[0],
                message: 'Пароли не совпадают',
              },
            ];
          }
          return [];
        default:
          return [];
      }
    },

    async handleSubmit() {
      this.touchedFields = new Array(this.inputs.length).fill(true);
      this.inputValues.forEach((value, index) => {
        this.validateField(index, value);
      });

      if (this.isFormValid) {
        this.isSubmitting = true;
        this.serverError = '';
        try {
          await this.onSubmit(this.inputValues);
        } catch (error) {
          this.serverError = error.message || this.getErrorMessage(this.field);
        } finally {
          this.isSubmitting = false;
        }
      }
    },

    getErrorMessage(field) {
      const errorMessages = {
        name: 'Не удалось изменить имя',
        phone: 'Не удалось изменить номер телефона',
        email: 'Не удалось изменить почту',
        password: 'Не удалось изменить пароль',
      };
      return errorMessages[field] || 'Ошибка при сохранении данных';
    },
  },
};
</script>

<style scoped>
@import '../../../assets/styles/Profile/ModalForm.css';

</style>