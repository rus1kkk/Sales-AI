<template>
  <div class="payment">
    <p class="payment-title">Привязанные карты</p>
    <div class="payment-form">
      <div class="payment-choice">
        <PaymentItem
          v-for="card in cards"
          :key="card.title"
          :card="card"
        />
        <PaymentInput :card="inputCard" />
      </div>
    </div>
  </div>
</template>

<script>
import PaymentItem from './PaymentItem.vue';
import PaymentInput from './PaymentInput.vue';
import tbankIcon from '@/assets/images/tbank-icon.png';
import sberIcon from '@/assets/images/sber-icon.png';
import alphaIcon from '@/assets/images/alpha-icon.png';
import mirIcon from '@/assets/images/mir-icon.png';

export default {
  name: 'PaymentMethod',
  components: { PaymentItem, PaymentInput },
  data() {
    return {
      cards: [
        { title: '**5448', icon: tbankIcon },
        { title: '**4578', icon: sberIcon },
        { title: '**1770', icon: alphaIcon },
      ],
      inputCard: { title: 'Привязать карту', icon: mirIcon },
    };
  },
};
</script>

<style scoped>
.payment {
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
  width: 647px;
  align-items: flex-start;
  gap: 24px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(7.5px);
}

.payment-choice {
  display: flex;
  width: 647px;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  flex-shrink: 0;
}
</style>