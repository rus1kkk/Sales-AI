<template>
  <div class="purchase-row">
    <div class="purchase-data">{{ purchase.date }}</div>
    <div class="purchase-about">
      <p class="purchase-title">Тариф "{{ purchase.title }}"</p>
      <p class="quantity">{{ purchase.quantity }} шт</p>
      <p class="term">действителен до:</p>
      <p :class="['expiry-date', { 'current-subscription': isCurrent }]">
        {{ purchase.expiryDate }}
      </p>
      <CustomButton type="icon" class="info-btn" @click="openInfoModal">
        <template #icon>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 20 20"
            fill="none"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM10 5.75C9.3787 5.75 8.875 6.25368 8.875 6.875C8.875 7.28921 8.5392 7.625 8.125 7.625C7.71079 7.625 7.375 7.28921 7.375 6.875C7.375 5.42525 8.5503 4.25 10 4.25C11.4497 4.25 12.625 5.42525 12.625 6.875C12.625 7.58584 12.3415 8.232 11.883 8.704C11.7907 8.7989 11.7027 8.8869 11.6187 8.9708C11.4029 9.1864 11.2138 9.3753 11.0479 9.5885C10.8289 9.8699 10.75 10.0768 10.75 10.25V11C10.75 11.4142 10.4142 11.75 10 11.75C9.5858 11.75 9.25 11.4142 9.25 11V10.25C9.25 9.5948 9.555 9.0644 9.8642 8.6672C10.0929 8.3733 10.3804 8.0863 10.6138 7.85346C10.6842 7.78321 10.7496 7.71789 10.807 7.65877C11.0046 7.45543 11.125 7.18004 11.125 6.875C11.125 6.25368 10.6213 5.75 10 5.75ZM10 15C10.5523 15 11 14.5523 11 14C11 13.4477 10.5523 13 10 13C9.4477 13 9 13.4477 9 14C9 14.5523 9.4477 15 10 15Z"
              fill="#A8A9AF"
            />
          </svg>
        </template>
      </CustomButton>
    </div>
  </div>
</template>

<script>
import CustomButton from '../CustomButton.vue'
export default {
  name: 'PurchaseRow',
  components: { CustomButton },
  props: {
    purchase: { type: Object, required: true },
    isCurrent: { type: Boolean, default: false },
  },
  methods: {
    openInfoModal() {
      this.$emit('open-info', this.purchase)
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/main.css';

.purchase-row {
  height: 28px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  align-self: stretch;
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
  color: var(--actient-color);
}

.quantity {
  margin-right: 3px;
}

.info-btn {
  display: none;
  width: 20px;
  height: 20px;
  aspect-ratio: 1/1;
}

@media (max-width: 684px) {
  .purchase-data {
    display: none;
  }
  .quantity {
    display: none;
  }
  .info-btn {
    display: block;
  }
  .purchase-about {
    max-width: unset;
  }
}

@media (max-width: 438px) {
  .term,
  .expiry-date {
    display: none;
  }
}
</style>
