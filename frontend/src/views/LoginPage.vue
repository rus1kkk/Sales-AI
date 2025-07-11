<template>
  <div class="form-wrapper">
    <form @submit.prevent="submitForm" class="fade-up">
      <div class="form-buttons">
        <button class="login-button" :disabled="mode === 'login'" @click.prevent="mode = 'login'">
          ВХОД
        </button>
        <button
          class="registration-button"
          :disabled="mode === 'register'"
          @click.prevent="mode = 'register'"
        >
          РЕГИСТРАЦИЯ
        </button>
      </div>
      <transition name="expand" mode="out-in">
        <div class="form-input" :key="mode">
          <transition-group name="fade-field" tag="div" class="form-input">
            <input
              v-if="mode === 'register'"
              key="name"
              placeholder="Имя"
              v-model="fields.name"
              @blur="touch('name')"
              :class="['base-input', { 'error-input': fields.name && validate('name') }]"
            />

            <input
              key="email"
              placeholder="Email"
              v-model="fields.email"
              @blur="touch('email')"
              :class="['base-input', { 'error-input': fields.email && validate('email') }]"
            />

            <input
              v-if="mode === 'register'"
              key="phone"
              type="phone"
              placeholder="Телефон"
              v-model="fields.phone"
              @blur="touch('phone')"
              :class="['base-input', { 'error-input': fields.phone && validate('phone') }]"
            />

            <input
              key="password"
              type="password"
              placeholder="Пароль"
              v-model="fields.password"
              @blur="touch('password')"
              :class="['base-input', { 'error-input': fields.password && validate('password') }]"
            />
            <input
              v-if="mode === 'register'"
              key="confirmPassword"
              type="password"
              placeholder="Повторите пароль"
              v-model="fields.confirmPassword"
              @blur="touch('confirmPassword')"
              :class="[
                'base-input',
                { 'error-input': fields.confirmPassword && validate('confirmPassword') },
              ]"
            />
            <transition name="fade-text" mode="out-in"></transition>
            <p key="error" class="error-text">{{ error }}</p>
          </transition-group>
        </div>
      </transition>

      <button class="send-button" :disabled="hasErrors">
        {{ mode === 'login' ? 'ВОЙТИ' : 'ЗАРЕГИСТРИРОВАТЬСЯ' }}
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, watch, computed, onMounted } from 'vue'
import { z } from 'zod'

const mode = ref('login')

const fields = ref({
  email: '',
  password: '',
  name: '',
  confirmPassword: '',
  phone: '',
})

const touched = ref({})
const errors = ref({})

const baseSchema = z.object({
  email: z.email('Некорректный email'),
  password: z.string().min(6, 'Пароль слишком короткий'),
})

const registerSchema = baseSchema.extend({
  name: z.string().min(1, 'Имя обязательно'),
  confirmPassword: z.string().refine(
    (val, ctx) => {
      if (val !== ctx.parent.password) return false
      return true
    },
    { message: 'Пароли не совпадают' },
  ),
  phone: z
    .string()
    .refine((val) => (val.includes('+') ? val.startsWith('+') : true), {
      message: 'Символ + допустим только в начале',
    })
    .refine((val) => val.replace(/\D/g, '').length === 11, {
      message: 'Номер должен содержать 11 цифр',
    })
    .refine((val) => /^[+\d\s\-()]+$/.test(val), {
      message: 'Телефон может содержать только цифры и +',
    }),
})

const getSchema = computed(() => (mode.value === 'login' ? baseSchema : registerSchema))

const requiredFields = computed(() =>
  mode.value === 'login'
    ? ['email', 'password']
    : ['name', 'email', 'phone', 'password', 'confirmPassword'],
)

function validate(field) {
  const value = fields.value[field]
  if (!value.trim()) return ''

  const schema = getSchema.value
  const partialSchema = schema.pick({ [field]: true })

  const result = partialSchema.safeParse({ [field]: value })

  if (!result.success) {
    const issue = result.error.issues.find((i) => i.path[0] === field)
    return issue?.message || ''
  }

  return ''
}

function touch(field) {
  touched.value[field] = true
  errors.value[field] = validate(field)
}

onMounted(() => {
  for (const field of Object.keys(fields.value)) {
    touched.value[field] = false
    errors.value[field] = ''

    watch(
      () => fields.value[field],
      (val) => {
        if (!touched.value[field] && val.trim()) {
          touched.value[field] = true
        }
        if (touched.value[field]) {
          errors.value[field] = validate(field)
        }
      },
    )
  }
})

const hasErrors = computed(() =>
  requiredFields.value.some((f) => !fields.value[f] || errors.value[f]),
)

const error = computed(() => {
  if (!requiredFields.value.some((f) => touched.value[f])) return ''
  for (const f of requiredFields.value) {
    if (touched.value[f] && errors.value[f]) return errors.value[f]
  }
  return ''
})

function submitForm() {
  requiredFields.value.forEach((field) => {
    touched.value[field] = true

    const schema = getSchema.value.pick({ [field]: true })
    const result = schema.safeParse({ [field]: fields.value[field] })
    if (!result.success) {
      const issue = result.error.issues.find((i) => i.path[0] === field)
      errors.value[field] = issue?.message || ''
    } else {
      errors.value[field] = ''
    }
  })

  if (!hasErrors.value) {
    alert(mode.value === 'login' ? 'Вход выполнен' : 'Регистрация завершена')
  }
}
</script>

<style>
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

.fade-up {
  opacity: 0;
  animation: fadeUp 0.8s ease-out forwards;
}

.form-wrapper {
  display: grid;
  place-items: center;
  min-height: 90vh;
  height: 90vh;
  overflow-y: auto;
  box-sizing: border-box;
  padding: 10px;
}

form {
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

.form-buttons button {
  all: unset;
  flex: 1;
  padding: 10px 20px;
  border: none;
  background: transparent;
  transition: background-color 0.5s ease;
  cursor: pointer;

  font-weight: 500;
  font-size: 20px;
  width: 50%;
  cursor: pointer;
  text-align: center;
  padding: 23px 0px 23px 0px;
}

.form-buttons button:disabled {
  background-color: var(--actient-color);
  color: white;
}

.form-input {
  display: flex;
  flex-direction: column;
  width: 100%;
  box-sizing: border-box;
  gap: 30px;
}

.base-input {
  all: unset;
  cursor: pointer;
  padding: 23px 0px 23px 0px;
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 60px;
  padding: 25px 36px 25px 36px;
  transition: background-color 0.5s ease;
}

.base-input::placeholder {
  color: var(--muted-color);
}

.error-text {
  color: rgba(252, 134, 134, 0.8);
  font-size: 16px;
  text-align: center;
  height: 19px;
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
  padding: 23px 0px 23px 0px;
  border-radius: 60px;
}

.send-button:disabled {
  cursor: default;
}

.error-input {
  background-color: rgba(252, 134, 134, 0.5);
}

.error-input::placeholder {
  color: var(--white-color);
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
  max-height: 1000px;
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
