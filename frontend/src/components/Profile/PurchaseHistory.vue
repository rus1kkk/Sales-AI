<template>
  <div class="history">
    <p class="history-title">История покупок:</p>
    <PurchaseRow
      v-for="(purchase, index) in purchases"
      :key="purchase.id"
      :purchase="purchase"
      :isCurrent="index === 0"
    />
  </div>
</template>

<script>
import PurchaseRow from './PurchaseRow.vue'

export default {
  name: 'PurchaseHistory',
  components: { PurchaseRow },
  data() {
    return {
      purchases: [
        {
          id: 1,
          date: '12.04.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.05.2025',
        },
        {
          id: 2,
          date: '12.03.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.04.2025',
        },
        {
          id: 3,
          date: '12.02.2025',
          title: 'Тариф “Pro”',
          quantity: '1',
          expiryDate: '12.03.2025',
        },
        {
          id: 4,
          date: '12.12.2024',
          title: 'Тариф “Pro”',
          quantity: '2',
          expiryDate: '12.02.2025',
        },
      ],
    }
  },
}
</script>

<style scoped>
.history {
  display: flex;
  width: 652px;
  flex-direction: column;
  align-items: flex-start;
  gap: 36px;
}
.history-title {
  color: #e6e9ed;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}
</style>
