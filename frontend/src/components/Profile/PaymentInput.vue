<template>
  <div class="payment-input">
    <Card :card="card" />
    <button>+</button>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  name: 'PaymentInput',
  components: { Card },
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
  width: 647px;
  padding: 25px 36px;
  justify-content: space-between;
  align-items: center;
}
</style>