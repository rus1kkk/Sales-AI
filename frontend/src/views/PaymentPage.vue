<template>
  <div class="payment-page">
        <FloatingShapes />
    <main class="payment-main">
      <div class="payment-container">
        <div class="product-box">
          <p class="product-count">1 товар</p>
          <div class="product-info">
            <div>
              <h2 class="product-title">PRO</h2>
              <p class="product-desc">
                Месячная подписка на услуги Sales AI<br />
                Для активных отделов продаж
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
          <h3 class="form-title">Данные покупателя</h3>
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

        <button @click="submitPayment" class="pay-button">Оплатить</button>
      </div>
    </main>
    <SuccessModal v-if="showSuccess" @close="showSuccess = false" />
    <FailModal v-if="showFailure" @close="showFailure = false" />
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { ValidationHelpers } from '@/utils/ValidationModule.js' 
import SuccessModal from '@/views/SuccessModal.vue'
import FailModal from '@/views/FailModal.vue'
import FloatingShapes from '@/components/FloatingShapes.vue' 

const showSuccess = ref(false)
const showFailure = ref(false)

const name = ref('')
const phone = ref('')
const email = ref('')

const showErrors = ref(false)

// Локальные флаги валидности (будут обновляться при вводе)
const isNameValid = ref(true)
const isPhoneValid = ref(true)
const isEmailValid = ref(true)

const quantity = ref(1)
const pricePerUnit = 990
const totalPrice = computed(() => quantity.value * pricePerUnit)

const increaseQuantity = () => {
  quantity.value++
}
const decreaseQuantity = () => {
  if (quantity.value > 1) quantity.value--
}

// Функция валидации по твоему ValidationModule.js
function validateField(field: 'name' | 'phone' | 'email', value: string) {
  const result = ValidationHelpers.validateOnInput(field, value)
  const valid = result.success
  if (field === 'name') isNameValid.value = valid
  if (field === 'phone') isPhoneValid.value = valid
  if (field === 'email') isEmailValid.value = valid
  return valid
}

// Полная валидация при сабмите
function validateAllFields() {
  const nameValid = validateField('name', name.value)
  const phoneValid = validateField('phone', phone.value)
  const emailValid = validateField('email', email.value)
  return nameValid && phoneValid && emailValid
}

function submitPayment() {
  showErrors.value = true
  if (validateAllFields()) {
    const isSuccess = Math.random() > 0.5
    setTimeout(() => {
      if (isSuccess) {
        showSuccess.value = true
      } else {
        showFailure.value = true
      }
    }, 1000)
  }
}
</script>

<style scoped>
@import '../assets/styles/Payment.css';

.add-card-form {
  margin-top: 1rem;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.card-details-row {
  display: flex;
  gap: 12px;
}

.link-card-btn {
  background-color: #5aa9ff;
  color: white;
  padding: 12px;
  border-radius: 10px;
  border: none;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s ease;
}
.link-card-btn:hover {
  background-color: #4a98e0;
}

input.invalid {
  border: none;
  background-color: #FF000033;
  outline: none;
}

.error-message {
  color: #FF000066;
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
  font-size: 16px;
  line-height: 120%;
  letter-spacing: 0;
  margin-top: 6px;
  font-style: normal;
  text-align: center;
  user-select: none;
}
</style>
