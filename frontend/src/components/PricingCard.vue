<script setup>
defineProps({
  title: {
    type: String,
    default: 'FREE',
  },
  subtitle: {
    type: String,
    default: 'Попробуй автоматизацию продаж',
  },
  features: {
    type: Array,
    default: () => [
      'Генерация коммерческих предложений с помощью ИИ',
      'Создание презентаций для клиентов',
      'Базовое редактирование документов',
    ],
  },
  price: {
    type: String,
    default: '₽ 0',
  },
  priceDescription: {
    type: String,
    default: 'Бесплатно для всех',
  },
  showAction: {
    type: Boolean,
    default: false,
  },
})
</script>
<template>
  <div class="pricing-card">
    <!-- Заголовок -->
    <div class="header">
      <h2 class="title">{{ title }}</h2>
      <p class="subtitle">{{ subtitle }}</p>
    </div>
    <div class="content">
      <!-- Список возможностей -->
      <div class="features">
        <div v-for="(feature, index) in features" :key="index" class="feature-item">
          <div class="check-icon">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="30"
              height="30"
              viewBox="0 0 30 30"
              fill="none"
            >
              <circle
                cx="15"
                cy="15"
                r="14.0476"
                fill="#71ABEB"
                stroke="#71ABEB"
                stroke-width="1.90476"
              />
              <path
                d="M7.5 14.8122L12.8902 20.2024L23.0239 10.5"
                stroke="white"
                stroke-width="2.1561"
                stroke-linecap="round"
              />
            </svg>
          </div>
          <span class="feature-text">{{ feature }}</span>
        </div>
      </div>

      <!-- Цена -->
      <div class="price-section-card">
        <div class="price-section-left">
          <div class="price">{{ price }}</div>
          <div class="price-description">{{ priceDescription }}</div>
        </div>
        <div class="price-action" v-if="showAction">
          Оформить подписку
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="21"
            height="12"
            viewBox="0 0 21 12"
            fill="none"
          >
            <path
              d="M1 6H21M21 6L16 1M21 6L16 11"
              stroke="#E6E9ED"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@import url('../assets/styles/PricingCard.css');
</style>
