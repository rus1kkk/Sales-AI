<template>
  <div class="payment-page">
    <FloatingShapes />
    <main class="payment-main">
      <div class="payment-container">
        <div class="product-box">
          <p class="product-count">1 товар</p>
          <div class="product-info">
            <div>
              <h2 class="product-title">{{ planTitle }}</h2>
              <p class="product-desc">
                Месячная подписка на услуги Sales AI<br />
                {{ planSubtitle }}
              </p>
            </div>
            <div class="product-price">
              <div class="quantity-buttons">
                <button @click="decreaseQuantity">-</button>
                <span>{{ quantity }}</span>
                <button @click="increaseQuantity">+</button>
              </div>
              <div class="price">{{ totalPrice }} ₽</div>
            </div>
          </div>
        </div>

        <div class="form-block">
          <h3 class="form-title centered">Данные покупателя</h3>
          <div class="form-fields">
            <input
              v-model="name"
              type="text"
              placeholder="Имя"
              :class="{ invalid: showErrors && !isNameValid }"
              @input="validateField('name', name)"
            />
            <input
              v-model="phone"
              type="tel"
              placeholder="Телефон"
              :class="{ invalid: showErrors && !isPhoneValid }"
              @input="validateField('phone', phone)"
            />
            <input
              v-model="email"
              type="email"
              placeholder="Почта"
              :class="{ invalid: showErrors && !isEmailValid }"
              @input="validateField('email', email)"
            />
          </div>
          <p v-if="showErrors && !formValid" class="error-message">
            Введите корректные данные покупателя
          </p>
        </div>

        <h4 class="info-title">Нажмите кнопку и перейдите на сайт для оплаты</h4>

        <button @click="submitPayment" class="pay-button">Оплатить</button>
      </div>
    </main>
    <SuccessModal v-if="showSuccess" @close="showSuccess = false" />
    <FailModal v-if="showFailure" @close="showFailure = false" />
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import { ValidationHelpers } from '@/utils/ValidationModule.js'
import SuccessModal from '@/views/SuccessModal.vue'
import FailModal from '@/views/FailModal.vue'
import FloatingShapes from '@/components/FloatingShapes.vue'

const route = useRoute()

// Динамические данные тарифа
const planTitle = route.query.plan || 'PRO'
const planPrice = Number((route.query.price || 990).toString().replace(/[^\d]/g, ''))
const planSubtitle =
  planTitle === 'MAX'
    ? 'В 10 раз больше возможностей, чем у Pro'
    : planTitle === 'PRO'
    ? 'Для активных отделов продаж'
    : 'Попробуй автоматизацию продаж'

const showSuccess = ref(false)
const showFailure = ref(false)

const name = ref('')
const phone = ref('')
const email = ref('')

const showErrors = ref(false)

const isNameValid = ref(true)
const isPhoneValid = ref(true)
const isEmailValid = ref(true)

const quantity = ref(1)
const totalPrice = computed(() => quantity.value * planPrice)

const increaseQuantity = () => quantity.value++
const decreaseQuantity = () => {
  if (quantity.value > 1) quantity.value--
}

function validateField(field: 'name' | 'phone' | 'email', value: string) {
  const result = ValidationHelpers.validateOnInput(field, value)
  const valid = result.success
  if (field === 'name') isNameValid.value = valid
  if (field === 'phone') isPhoneValid.value = valid
  if (field === 'email') isEmailValid.value = valid
  return valid
}

function validateAllFields() {
  return (
    validateField('name', name.value) &&
    validateField('phone', phone.value) &&
    validateField('email', email.value)
  )
}

function submitPayment() {
  showErrors.value = true
  if (validateAllFields()) {
    const isSuccess = Math.random() > 0.5
    setTimeout(() => {
      showSuccess.value = isSuccess
      showFailure.value = !isSuccess
    }, 1000)
  }
}
</script>

<style scoped>
@import '../assets/styles/Payment.css';

.form-title.centered {
  text-align: center;
}

.info-title {
  text-align: center;
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
  font-size: 18px;
  line-height: 120%;
  color: #ffffff;
  margin-top: 20px;
  margin-bottom: 10px;
}

input.invalid {
  border: none;
  background-color: #ff000033;
  outline: none;
}

.error-message {
  color: #ff000066;
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
  font-size: 16px;
  line-height: 120%;
  margin-top: 6px;
  text-align: center;
}
</style>
