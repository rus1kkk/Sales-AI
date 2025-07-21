<template>
  <div class="payment-page">
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
            />
            <input
              v-model="phone"
              type="tel"
              placeholder="Телефон"
              :class="{ invalid: showErrors && !isPhoneValid }"
            />
            <input
              v-model="email"
              type="email"
              placeholder="Почта"
              :class="{ invalid: showErrors && !isEmailValid }"
            />
          </div>
          <p v-if="showErrors && !formValid" class="error-message">
            Введите корректные данные покупателя
          </p>
        </div>

        <button class="pay-button" @click="submitPayment">
          Оплатить
        </button>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'

type Card = {
  id: string
  mask: string
  icon: string
}

const name = ref('')
const phone = ref('')
const email = ref('')
const selectedCard = ref('')

const cards = ref<Card[]>([])

const showAddCardForm = ref(false)
const cardName = ref('')
const cardNumber = ref('')
const cardExpiry = ref('')
const cardCVV = ref('')

const quantity = ref(1)
const pricePerUnit = 990
const totalPrice = computed(() => quantity.value * pricePerUnit)

const increaseQuantity = () => {
  quantity.value++
}
const decreaseQuantity = () => {
  if (quantity.value > 1) quantity.value--
}

const isNameValid = computed(() => name.value.trim().length > 1)
const isPhoneValid = computed(() => phone.value.trim().length > 7)
const isEmailValid = computed(() => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value))
const isCardSelected = computed(() => selectedCard.value !== '')

const formValid = computed(() => {
  return isNameValid.value && isPhoneValid.value && isEmailValid.value && isCardSelected.value
})

const showErrors = ref(false)

const handleAddCard = () => {
  if (cardNumber.value.length < 4) return

  const last4 = cardNumber.value.slice(-4)
  const newCard: Card = {
    id: 'card' + (cards.value.length + 1),
    mask: '**' + last4,
    icon: '💳'
  }

  cards.value.push(newCard)
  selectedCard.value = newCard.id
  showAddCardForm.value = false

  cardName.value = ''
  cardNumber.value = ''
  cardExpiry.value = ''
  cardCVV.value = ''
}

const submitPayment = () => {
  showErrors.value = true

  if (formValid.value) {
    alert(`Оплата успешно отправлена с карты: ${selectedCard.value} на сумму ${totalPrice.value} ₽`)
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
  border: 2px solid red;
  outline: none;
}

.error-message {
  color: red;
  margin-top: 6px;
  font-weight: bold;
}
</style>
