<template>
  <div class="purchase-row">
    <div class="purchase-data">{{ purchase.date }}</div>
    <div class="purchase-about">
      <p class="purchase-title">{{ purchase.title }}</p>
      <p class="quantity">{{ purchase.quantity }} шт</p>
      <p>действителен до:</p>
      <p :class="['expiry-date', { 'current-subscription': isCurrent }]">
        {{ purchase.expiryDate }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PurchaseRow',
  props: {
    purchase: { type: Object, required: true },
    isCurrent: { type: Boolean, default: false },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.purchase-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  align-self: stretch;
  gap: 27px;
  border-bottom: 1px solid var(--muted-color);
}
.purchase-data {
  color: var(--standart-color);
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
.purchase-about {
  max-width: 437px;
  width: 100%;
  height: 19px;
  display: flex;
  gap: 24px;
  justify-content: space-between;
}
.expiry-date.current-subscription {
  color:  var(--actient-color);
}

.quantity {
  margin-right: 3px;
}
</style>
