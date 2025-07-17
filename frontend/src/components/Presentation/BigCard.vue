<script setup>
defineProps({
  title: {
    type: String,
    default: 'Следующие шаги',
  },
  subtitle: {
    type: String,
    default: null,
  },
  items: {
    type: Array,
    default: () => [
      'Свяжитесь с нами удобным способом',
      'Обсудим детали проекта',
      'Подпишем договор и начинаем работу',
    ],
  },
  images: {
    type: Array,
    default: () => [],
  },
  caption: {
    type: String,
    default:
      'Мы объясним каждый этап, покажем макет, поможем после запуска.  Всё будет понятно, без сложных слов — просто нормальный рабочий сайт под ваш магазин.',
  },
})
</script>

<template>
  <div class="big-card">
    <h1>{{ title }}</h1>
    <div class="big-list">
      <h3 v-if="subtitle">{{ subtitle }}</h3>
      <input v-for="(item, index) in items" :key="index" class="input" type="text" :value="item" />
    </div>
    <div v-if="images.length > 0" class="card-img">
      <img
        v-for="(image, index) in images"
        :key="index"
        :src="image.src || image"
        :alt="image.alt || ''"
        :class="image.class || ''"
      />
    </div>
    <p class="big-card-p">{{ caption }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>
