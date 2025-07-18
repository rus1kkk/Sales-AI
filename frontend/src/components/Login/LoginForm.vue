<template>
  <LoginMessageModal :visible="!!error" :message="error" />

  <form @submit.prevent="submitForm" class="login-form fade-up">
    <div class="form-buttons">
      <button
        class="login-button"
        :disabled="mode === 'login'"
        @click.prevent="switchMode('login')"
      >
        ВХОД
      </button>
      <button
        class="registration-button"
        :disabled="mode === 'register'"
        @click.prevent="switchMode('register')"
      >
        РЕГИСТРАЦИЯ
      </button>
    </div>

    <transition name="expand" mode="out-in">
      <div class="form-input" :key="mode">
        <transition-group name="fade-field" tag="div" class="form-input">
          <div v-if="mode === 'register'" class="input-wrapper">
            <input
              key="name"
              autocomplete="name"
              placeholder="Имя"
              v-model="fields.name"
              @input="validateInput('name')"
              @blur="touch('name')"
              :class="['base-input', { 'error-input': errors.name }]"
            />
            <p class="error-text">{{ errors.name }}</p>
          </div>

          <div v-if="mode === 'login'" class="input-wrapper">
            <input
              key="emailLogin"
              autocomplete="email"
              placeholder="Email"
              v-model="fields.emailLogin"
              @input="validateInput('email', 'emailLogin')"
              @blur="touch('emailLogin')"
              :class="['base-input', { 'error-input': errors.emailLogin }]"
            />
            <p class="error-text">{{ errors.emailLogin }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input
              key="emailRegister"
              autocomplete="email"
              placeholder="Email"
              v-model="fields.emailRegister"
              @input="validateInput('email', 'emailRegister')"
              @blur="touch('emailRegister')"
              :class="['base-input', { 'error-input': errors.emailRegister }]"
            />
            <p class="error-text">{{ errors.emailRegister }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input
              key="phone"
              type="tel"
              autocomplete="tel"
              placeholder="Телефон"
              v-model="fields.phone"
              @input="validateInput('phone')"
              @blur="touch('phone')"
              :class="['base-input', { 'error-input': errors.phone }]"
            />
            <p class="error-text">{{ errors.phone }}</p>
          </div>

          <div v-if="mode === 'login'" class="input-wrapper">
            <input
              key="passwordLogin"
              type="password"
              autocomplete="current-password"
              placeholder="Пароль"
              v-model="fields.passwordLogin"
              @blur="touch('passwordLogin')"
              :class="['base-input', { 'error-input': errors.passwordLogin }]"
            />
            <p class="error-text">{{ errors.passwordLogin }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input
              key="passwordRegister"
              type="password"
              autocomplete="new-password"
              placeholder="Пароль"
              v-model="fields.passwordRegister"
              @input="validateInput('password', 'passwordRegister')"
              @blur="touch('passwordRegister')"
              :class="['base-input', { 'error-input': errors.passwordRegister }]"
            />
            <p class="error-text">{{ errors.passwordRegister }}</p>
          </div>

          <div v-if="mode === 'register'" class="input-wrapper">
            <input
              key="confirmPassword"
              type="password"
              autocomplete="new-password"
              placeholder="Повторите пароль"
              v-model="fields.confirmPassword"
              @input="validateInput('confirmPassword')"
              @blur="touch('confirmPassword')"
              :class="['base-input', { 'error-input': errors.confirmPassword }]"
            />
            <p class="error-text">{{ errors.confirmPassword }}</p>
          </div>
        </transition-group>
      </div>
    </transition>

    <button class="send-button" :disabled="hasErrors || isSubmitting">
      {{ isSubmitting ? 'ПОДОЖДИТЕ...' : mode === 'login' ? 'ВОЙТИ' : 'ЗАРЕГИСТРИРОВАТЬСЯ' }}
    </button>
  </form>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import { ValidationHelpers } from '@/utils/ValidationModule'
import LoginMessageModal from './LoginMessageModal.vue'

const router = useRouter()
const mode = ref('login')
const fields = ref(defaultFields())
const touched = ref({})
const errors = ref({})
const error = ref('')
const isSubmitting = ref(false)

function showModal() {
  setTimeout(() => {
    error.value = ''
  }, 1500)
}

const requiredFields = computed(() =>
  mode.value === 'login'
    ? ['emailLogin', 'passwordLogin']
    : ['name', 'emailRegister', 'phone', 'passwordRegister', 'confirmPassword'],
)

function validateInput(schemaField, formField = schemaField) {

  if (schemaField === 'confirmPassword') {
  if (!fields.value[formField]) {
    errors.value[formField] = 'Повторите пароль'
    return
  }
  errors.value[formField] =
    fields.value.confirmPassword === fields.value.passwordRegister ? '' : 'Пароли не совпадают'
  return
  }

  const result = ValidationHelpers.validateOnInput(schemaField, fields.value[formField])
  errors.value[formField] = result.success
    ? ''
    : result.errors.root?.[result.errors.root.length - 1] || ''
}

function validateBlur(field) {
    if (field === 'confirmPassword') {
    if (!fields.value[field]) {
      errors.value[field] = 'Повторите пароль'
      return
    }
    errors.value[field] =
      fields.value.confirmPassword === fields.value.passwordRegister ? '' : 'Пароли не совпадают'
    return
  }

  if (field === 'confirmPassword') {
    errors.value[field] =
      fields.value.confirmPassword === fields.value.passwordRegister ? '' : 'Пароли не совпадают'
    return
  }

const schemaField =
    field === 'emailLogin' || field === 'emailRegister'
      ? 'email'
      : field === 'passwordLogin'
        ? 'passwordLogin'
        : field === 'passwordRegister'
          ? 'password'
          : field
  const result = ValidationHelpers.validateOnBlur(schemaField, fields.value[field])
  errors.value[field] = result.success
    ? ''
    : result.errors.root?.[0] || ''
}

function touch(field) {
  touched.value[field] = true
  validateBlur(field)
}

watch(
  fields.value,
  () => {
    requiredFields.value.forEach((field) => {
      if (touched.value[field]) {
        validateBlur(field)
      }
    })
  },
  { deep: true },
)

const hasErrors = computed(() =>
  requiredFields.value.some((f) => !fields.value[f] || errors.value[f]),
)

const errorMessage = computed(() => {
  if (!requiredFields.value.some((f) => touched.value[f])) return ''
  for (const f of requiredFields.value) {
    if (touched.value[f] && errors.value[f]) return errors.value[f]
  }
  return ''
})

async function submitForm() {
  requiredFields.value.forEach((field) => {
    touched.value[field] = true
    validateBlur(field)
  })

  if (hasErrors.value) {
    error.value = errorMessage.value
    showModal()
    return
  }

  error.value = ''
  isSubmitting.value = true

  const sendData =
    mode.value === 'login'
      ? {
          email: fields.value.emailLogin,
          password: fields.value.passwordLogin,
        }
      : {
          name: fields.value.name,
          email: fields.value.emailRegister,
          phone: fields.value.phone,
          password: fields.value.passwordRegister,
        }

  // заглушка для работы формы
  try {
    await new Promise((resolve) => setTimeout(resolve, 2000))

    const isSuccess =
      mode.value === 'login'
        ? sendData.email && sendData.password === '123'
        : sendData.email && sendData.password && sendData.name && sendData.phone

    if (!isSuccess) {
      error.value = 'Некорректные данные.'
      showModal()
      return
    }

    setTimeout(() => {
      router.push('/profile')
    }, 1500)
  } catch (err) {
    error.value = 'Произошла ошибка.'
    console.log(err)
    showModal()
  } finally {
    isSubmitting.value = false
  }
}

function switchMode(newMode) {
  mode.value = newMode
  fields.value = defaultFields()
  touched.value = {}
  errors.value = {}
  error.value = ''
}

function defaultFields() {
  return {
    name: '',
    emailLogin: '',
    emailRegister: '',
    phone: '',
    passwordLogin: '',
    passwordRegister: '',
    confirmPassword: '',
  }
}
</script>

<style>
@import '../../assets/styles/Login/LoginForm.css';
</style>
