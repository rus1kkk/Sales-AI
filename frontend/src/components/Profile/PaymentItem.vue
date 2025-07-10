<template>
  <div class="payment-item">
    <Card :card="card" />
    <button>-</button>
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  name: 'PaymentItem',
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
.payment-item {
  display: flex;
  width: 647px;
  padding: 25px 36px;
  justify-content: space-between;
  align-items: center;
  border-bottom: 0.5px solid rgba(255, 255, 255, 0.87);
}
</style>