<template>
  <div class="payment-item">
    <PaymentCard :card="card" />
    <button @click="$emit('remove', card.title)">-</button>
  </div>
</template>

<script>
import PaymentCard from './PaymentCard.vue'

export default {
  name: 'PaymentItem',
  components: { PaymentCard },
  props: {
    card: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
  },
}
</script>

<style scoped>
.payment-item {
  display: flex;
  width: 100%;
  padding: 25px 36px;
  justify-content: space-between;
  align-items: center;
  border-bottom: 0.5px solid rgba(255, 255, 255, 0.87);
}
</style>
