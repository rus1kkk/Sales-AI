<template>
  <CardInputForm v-if="isAddingCard" @cancel="emitCancelAddingCard" />
  <div v-else class="payment">
    <p class="payment-title">Привязанные карты</p>
    <div class="payment-form">
      <div class="payment-choice">
        <PaymentItem
          v-for="card in cards"
          :key="card.title"
          :card="card"
          @remove="emitRemoveCard(card.title)"
        />
        <PaymentInput
          :key="'unique-payment-input'"
          :card="inputCard"
          @start-adding-card="emitStartAddingCard"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PaymentItem from './PaymentItem.vue'
import PaymentInput from './PaymentInput.vue'
import CardInputForm from './CardInputForm.vue'

export default {
  name: 'PaymentMethod',
  components: { PaymentItem, PaymentInput, CardInputForm },
  props: {
    cards: {
      type: Array,
      required: true,
      validator: (cards) => cards.every((card) => 'title' in card && 'icon' in card),
    },
    inputCard: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
    isAddingCard: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    emitRemoveCard(cardTitle) {
      this.$emit('remove-card', cardTitle)
    },
    emitStartAddingCard() {
      this.$emit('start-adding-card')
    },
    emitCancelAddingCard() {
      this.$emit('cancel-adding-card')
    },
  },
}
</script>

<style scoped>
.payment {
  max-width: 647px;
  min-width: 562px;
  width: 100%;
  display: inline-flex;
  padding-top: 24px;
  flex-direction: column;
  align-items: center;
  gap: 24px;
}

.payment-title {
  color: #fff;
  text-align: center;
  font-family: Montserrat;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 28.8px */
}

.payment-form {
  display: flex;
  width: 100%;
  align-items: flex-start;
  gap: 24px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(7.5px);
}

.payment-choice {
  display: flex;
  width: 100%;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  flex-shrink: 0;
}
</style>
