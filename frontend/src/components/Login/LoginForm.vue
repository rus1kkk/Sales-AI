<template>
  <form @submit.prevent="submitForm" class="login-form fade-up">
    <div class="form-buttons">
      <button class="login-button" :disabled="mode === 'login'" @click.prevent="switchMode('login')">
        ВХОД
      </button>
      <button class="registration-button" :disabled="mode === 'register'" @click.prevent="switchMode('register')">
        РЕГИСТРАЦИЯ
      </button>
    </div>
    <transition name="expand" mode="out-in">
      <div class="form-input" :key="mode">
        <transition-group name="fade-field" tag="div" class="form-input">
          <div v-if="mode === 'register'" class="input-wrapper">
            <input key="name" placeholder="Имя" v-model="fields.name" @input="validateInput('name')"
              @blur="touch('name')" :class="['base-input', { 'error-input': fields.name && errors.name }]" />
            <p class="error-text">{{ errors.name }}</p>
          </div>

          <div v-if="mode === 'login'" class="input-wrapper">
            <input key="emailLogin" placeholder="Email" v-model="fields.emailLogin"
              @input="validateInput('email', 'emailLogin')" @blur="touch('emailLogin')"
              :class="['base-input', { 'error-input': fields.emailLogin && errors.emailLogin }]" />
            <p class="error-text">{{ errors.emailLogin }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input key="emailRegister" placeholder="Email" v-model="fields.emailRegister"
              @input="validateInput('email', 'emailRegister')" @blur="touch('emailRegister')"
              :class="['base-input', { 'error-input': fields.emailRegister && errors.emailRegister }]" />
            <p class="error-text">{{ errors.emailRegister }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input key="phone" type="phone" placeholder="Телефон" v-model="fields.phone" @input="validateInput('phone')"
              @blur="touch('phone')" :class="['base-input', { 'error-input': fields.phone && errors.phone }]" />
            <p class="error-text">{{ errors.phone }}</p>
          </div>

          <div v-if="mode === 'login'" class="input-wrapper">
            <input key="passwordLogin" type="password" placeholder="Пароль" v-model="fields.passwordLogin"
              @input="validateInput('password', 'passwordLogin')" @blur="touch('passwordLogin')"
              :class="['base-input', { 'error-input': fields.passwordLogin && errors.passwordLogin }]" />
            <p class="error-text">{{ errors.passwordLogin }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input key="passwordRegister" type="password" placeholder="Пароль" v-model="fields.passwordRegister"
              @input="validateInput('password', 'passwordRegister')" @blur="touch('passwordRegister')"
              :class="['base-input', { 'error-input': fields.passwordRegister && errors.passwordRegister }]" />
            <p class="error-text">{{ errors.passwordRegister }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input key="confirmPassword" type="password" placeholder="Повторите пароль" v-model="fields.confirmPassword"
              @input="validateInput('confirmPassword')" @blur="touch('confirmPassword')"
              :class="['base-input', { 'error-input': fields.confirmPassword && errors.confirmPassword }]" />
            <p class="error-text">{{ errors.confirmPassword }}</p>
          </div>
        </transition-group>
      </div>
    </transition>

    <button class="send-button" :disabled="hasErrors">
      {{ mode === 'login' ? 'ВОЙТИ' : 'ЗАРЕГИСТРИРОВАТЬСЯ' }}
    </button>
  </form>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { ValidationHelpers } from '@/utils/ValidationModule'


const mode = ref('login')
const fields = ref({
  emailLogin: '',
  passwordLogin: '',
  name: '',
  emailRegister: '',
  phone: '',
  passwordRegister: '',
  confirmPassword: '',
})
const touched = ref({})
const errors = ref({})
const error = ref('')

const requiredFields = computed(() =>
  mode.value === 'login'
    ? ['emailLogin', 'passwordLogin']
    : ['name', 'emailRegister', 'phone', 'passwordRegister', 'confirmPassword']
)

function validateInput(schemaField, formField = schemaField) {
  if (!fields.value[formField]) {
    errors.value[formField] = ''
    return
  }

  if (schemaField === 'confirmPassword') {
    errors.value[formField] = fields.value.confirmPassword === fields.value.passwordRegister ? '' : 'Пароли не совпадают'
    return
  }

  const result = ValidationHelpers.validateOnInput(schemaField, fields.value[formField])
  errors.value[formField] = result.success ? '' : result.errors.root?.[result.errors.root.length - 1] || ''
}

function validateBlur(field) {
  if (!fields.value[field]) {
    errors.value[field] = ''
    return
  }

  if (field === 'confirmPassword') {
    errors.value[field] = fields.value.confirmPassword === fields.value.passwordRegister ? '' : 'Пароли не совпадают'
    return
  }

  const schemaField = field === 'emailLogin' || field === 'emailRegister' ? 'email'
    : field === 'passwordLogin' || field === 'passwordRegister' ? 'password'
      : field
  const result = ValidationHelpers.validateOnBlur(schemaField, fields.value[field])
  errors.value[field] = result.success ? '' : result.errors.root?.[result.errors.root.length - 1] || ''
}

function touch(field) {
  touched.value[field] = true
  validateBlur(field)
}

watch(fields.value, () => {
  requiredFields.value.forEach(field => {
    if (touched.value[field]) {
      validateBlur(field)
    }
  })
}, { deep: true })

const hasErrors = computed(() =>
  requiredFields.value.some(f => !fields.value[f] || errors.value[f])
)

const errorMessage = computed(() => {
  if (!requiredFields.value.some(f => touched.value[f])) return ''
  for (const f of requiredFields.value) {
    if (touched.value[f] && errors.value[f]) return errors.value[f]
  }
  return ''
})

function submitForm() {
  requiredFields.value.forEach(field => {
    touched.value[field] = true
    validateBlur(field)
  })

  if (!hasErrors.value) {
    error.value = mode.value === 'login' ? 'Успешный вход!' : 'Успешная регистрация!'
  } else {
    error.value = errorMessage.value
  }
}

function switchMode(newMode) {
  mode.value = newMode
  fields.value = {
    name: '',
    emailLogin: '',
    emailRegister: '',
    phone: '',
    passwordLogin: '',
    passwordRegister: '',
    confirmPassword: ''
  }
  touched.value = {}
  errors.value = {}
  error.value = ''
}
</script>

<style>
.login-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 55px;
  border-radius: 60px;
  padding: 46px;
  width: 90%;
  max-width: 630px;
  background-color: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(6px);
  box-sizing: border-box;
  margin: auto 0;
}

.form-buttons {
  display: flex;
  width: 100%;
  box-sizing: border-box;
  border-radius: 60px;
  overflow: hidden;
  border: 3px solid var(--actient-color);
}

.form-buttons > button {
  all: unset;
  flex: 1;
  padding: 23px 0;
  background: transparent;
  transition: background-color 0.5s ease;
  cursor: pointer;
  font-weight: 500;
  font-size: 20px;
  text-align: center;
}

.form-buttons > button:disabled {
  background-color: var(--actient-color);
  color: white;
}

.form-input {
  display: flex;
  flex-direction: column;
  width: 100%;
  box-sizing: border-box;
  gap: 20px;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.base-input {
  all: unset;
  cursor: pointer;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 60px;
  padding: 25px 36px;
  transition: background-color 0.5s ease;
}

.base-input::placeholder {
  color: var(--muted-color);
}

.error-input {
  background-color: rgba(252, 134, 134, 0.5);
}

.error-input::placeholder {
  color: var(--white-color);
}

.error-text {
  color: rgba(252, 134, 134, 0.8);
  font-size: 12px;
  text-align: center;
  min-height: 15px;
  transition: opacity 0.5s ease;
}

.send-button {
  all: unset;
  font-weight: 500;
  font-size: 20px;
  width: 100%;
  cursor: pointer;
  text-align: center;
  background-color: var(--actient-color);
  box-sizing: border-box;
  padding: 23px 0;
  border-radius: 60px;
}

.send-button:disabled {
  cursor: default;
}

.fade-up {
  animation: fadeUp 0.8s ease-out forwards;
}

@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.expand-enter-active,
.expand-leave-active {
  transition:
    max-height 0.8s ease-in-out,
    opacity 0.6s ease-in-out,
    transform 0.6s ease-in-out;
  overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
  max-height: 0;
  opacity: 0;
  transform: translateY(-30px);
}

.expand-enter-to,
.expand-leave-from {
  max-height: 600px;
  opacity: 1;
  transform: translateY(0);
}

.fade-field-enter-active,
.fade-field-leave-active {
  transition:
    opacity 0.5s ease,
    transform 0.5s ease;
}

.fade-field-enter-from,
.fade-field-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

.fade-field-enter-to,
.fade-field-leave-from {
  opacity: 1;
  transform: translateY(0);
}
</style>