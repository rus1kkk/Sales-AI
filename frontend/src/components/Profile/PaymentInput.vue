<template>
  <div class="payment-input">
    <PaymentCard :card="card" />
    <button>+</button>
  </div>
</template>

<script>
import PaymentCard from './PaymentCard.vue';

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
};
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