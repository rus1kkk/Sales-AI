<template>
  <div class="payment-input">
    <PaymentCard :card="card" />
    <CustomButton type="icon-line" @click="handleStartAddingCard">
      <template #icon>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="19"
          height="18"
          viewBox="0 0 19 18"
          fill="none"
          style="pointer-events: none"
        >
          <path
            d="M1.5 9H17.5M9.5 1V17"
            stroke="#E6E9ED"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
        </svg>
      </template>
    </CustomButton>
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'
import PaymentCard from './PaymentCard.vue'

export default {
  name: 'PaymentInput',
  components: { PaymentCard, CustomButton },
  props: {
    card: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
  },
  methods: {
    handleStartAddingCard() {
      this.$emit('start-adding-card')
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
