<template>
  <div class="history">
    <p class="history-title" style="animation-delay: 0.2s">История покупок:</p>
    <PurchaseRow
      v-for="(purchase, index) in purchases"
      :key="purchase.id"
      :purchase="purchase"
      :isCurrent="index === 0"
      class="fade-up"
      :style="{ 'animation-delay': `${0.4 + index * 0.2}s` }"
      @open-info="openInfoModal"
    />
  </div>
</template>

<script>
import PurchaseRow from './PurchaseRow.vue'

export default {
  name: 'PurchaseHistory',
  components: { PurchaseRow },
  props: {
    purchases: {
      type: Array,
      required: true,
      validator: (purchases) =>
        purchases.every(
          (purchase) =>
            typeof purchase === 'object' &&
            'id' in purchase &&
            'date' in purchase &&
            'title' in purchase &&
            'quantity' in purchase &&
            'expiryDate' in purchase,
        ),
    },
  },
  methods: {
    openInfoModal(purchase) {
      this.$emit('open-info-modal', purchase)
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.history {
  display: flex;
  max-width: 652px;
  min-width: 537px;
  width: 100%;
  flex-direction: column;
  align-items: flex-start;
  gap: 36px;
}
.history-title {
  color: var(--standart-color);
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}

.fade-up {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .history {
    min-width: 0;
  }
}

@media (max-width: 360px) {
  .history {
    padding: 0px 6.5px;
  }
}
</style>
