<template>
  <CardInputForm
    v-if="isAddingCard"
    :class="{ 'fade-up': isInitialLoad }"
    style="animation-delay: 0.2s"
    @cancel="emitCancelAddingCard"
  />
  <div v-else class="payment">
    <p class="payment-title" :class="{ 'fade-up': isInitialLoad }" style="animation-delay: 0.2s">
      Привязанные карты
    </p>
    <div class="payment-form">
      <div class="payment-choice">
        <PaymentItem
          v-for="(card, index) in cards"
          :key="card.title"
          :card="card"
          :class="{ 'fade-up': isInitialLoad }"
          :style="{ 'animation-delay': isInitialLoad ? `${0.4 + index * 0.2}s` : '0s' }"
          @remove="emitRemoveCard(card.title)"
        />
        <PaymentInput
          :key="'unique-payment-input'"
          :card="inputCard"
          :class="{ 'fade-up': isInitialLoad }"
          :style="{ 'animation-delay': isInitialLoad ? `${0.4 + cards.length * 0.2}s` : '0s' }"
          @start-adding-card="emitStartAddingCard"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PaymentItem from './PaymentItem.vue'
import PaymentInput from './PaymentInput.vue'
import CardInputForm from './CardInputForm.vue'

export default {
  name: 'PaymentMethod',
  components: { PaymentItem, PaymentInput, CardInputForm },
  props: {
    cards: {
      type: Array,
      required: true,
      validator: (cards) => cards.every((card) => 'title' in card && 'icon' in card),
    },
    inputCard: {
      type: Object,
      required: true,
      validator: (card) => 'title' in card && 'icon' in card,
    },
    isAddingCard: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      isInitialLoad: true, // Флаг начальной загрузки
    }
  },
  mounted() {
    // После первой загрузки отключаем анимацию
    setTimeout(() => {
      this.isInitialLoad = false
    }, 2000)
  },
  watch: {
    cards() {
      // При изменении списка карт (добавление/удаление) анимация не применяется
      this.isInitialLoad = false
    },
    isAddingCard(newVal) {
      // Если возвращаемся к списку карт, включаем анимацию
      if (!newVal) {
        this.isInitialLoad = true
        // Отключаем анимацию после завершения
        setTimeout(() => {
          this.isInitialLoad = false
        }, 2000)
      }
    },
  },
  methods: {
    emitRemoveCard(cardTitle) {
      this.$emit('remove-card', cardTitle)
    },
    emitStartAddingCard() {
      this.isInitialLoad = true // Включаем анимацию перед переходом к форме
      this.$emit('start-adding-card')
    },
    emitCancelAddingCard() {
      this.$emit('cancel-adding-card')
    },
  },
}
</script>

<style scoped>
@import '../../../assets/styles/Profile/PaymentMethod.css';


</style>
