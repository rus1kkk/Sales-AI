<template>
  <div class="form-wrapper">
    <form action="" @submit.prevent>
      <div class="form-buttons">
        <button class="login-button" disabled @click="switching">ВХОД</button>
        <button class="registration-button" @click="switching">РЕГИСТРАЦИЯ</button>
      </div>
      <div class="form-input">
        <input
          type="email"
          id="email-input"
          placeholder="Email"
          v-model="email"
          @input="validateForm"
          :class="['base-input', { 'error-input': emailInvalid }]"
        />
        <input
          type="password"
          id="password-input"
          v-model="password"
          placeholder="Пароль"
          @input="validateForm"
          :class="['base-input', { 'error-input': passwordInvalid }]"
        />
        <p class="error-text">{{ error }}</p>
      </div>
      <button class="send-button" :disabled="!!error">ВОЙТИ</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  data() {
    return {
      email: '',
      password: '',
      error: '',
      emailInvalid: false,
      passwordInvalid: false,
    }
  },
  methods: {
    validateForm() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      this.emailInvalid = false
      this.passwordInvalid = false

      if (!this.email) {
        this.error = 'Введите Email'
        this.emailInvalid = true
      } else if (!emailRegex.test(this.email)) {
        this.error = 'Некорректный Email'
        this.emailInvalid = true
      } else if (!this.password) {
        this.error = 'Введите пароль'
        this.passwordInvalid = true
      } else {
        this.error = ''
      }
    },
  },
}
</script>

<style>
.form-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 90vh;
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
}

.form-buttons {
  display: flex;
  width: 100%;

  box-sizing: border-box;
}

.login-button,
.registration-button {
  all: unset;
  font-weight: 500;
  font-size: 20px;
  width: 50%;
  cursor: pointer;
  text-align: center;
  background-color: transparent;
  border: 3px solid var(--actient-color);
  cursor: pointer;
  padding: 23px 0px 23px 0px;
}

.login-button:disabled,
.registration-button:disabled {
  background-color: var(--actient-color);
  border: none;
  cursor: default;
}

.login-button {
  border-top-left-radius: 34px;
  border-bottom-left-radius: 34px;
}

.registration-button {
  border-top-right-radius: 34px;
  border-bottom-right-radius: 34px;
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
}

.base-input::placeholder {
  color: var(--muted-color);
}

.error-text {
  color: rgba(252, 134, 134, 0.8);
  font-size: 16px;
  text-align: center;
  height: 19px;
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
</style>
