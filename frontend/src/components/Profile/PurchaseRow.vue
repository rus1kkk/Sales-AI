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
.purchase-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  align-self: stretch;
  border-bottom: 1px solid #a8a9af;
}
.purchase-data {
  color: #e6e9ed;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
.purchase-about {
  width: 70%;
  display: flex;
  justify-content: space-between;
}
.expiry-date.current-subscription {
  color: #71abeb;
}
</style>
