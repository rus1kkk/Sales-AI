<template>
  <div class="payment-input">
    <PaymentCard :card="card" />
    <button @click="handleAddCard">+</button>
  </div>
</template>

<script>
import PaymentCard from './PaymentCard.vue'

export default {
  name: 'PaymentInput',
  components: { PaymentCard },
  props: {
    card: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
  },
  methods: {
    handleAddCard() {
      // Заглушка
      const newCardTitle = '**' + Math.floor(1000 + Math.random() * 9000)
      this.$emit('add', newCardTitle)
    },
  },
}
</script>

<style scoped>
.payment-input {
  display: flex;
  width: 100%;
  padding: 25px 36px;
  justify-content: space-between;
  align-items: center;
}
</style>
