<script setup>
defineProps({
  title: {
    type: String,
    default: 'Проблема',
  },
  description: {
    type: String,
    default:
      'Сейчас многие покупают обувь через интернет — особенно молодёжь.\n' +
      'Если у магазина нет нормального сайта, он теряет часть клиентов.',
  },
  subtitle: {
    type: String,
    default: 'Основные проблемы без сайта:',
  },
  items: {
    type: Array,
    default: () => [
      'Зависимость от Avito маркетплейсов или Instagram',
      'Сложно рассказать про ассортимент',
      'Нет возможности отслеживать заказы и анализировать продажи',
      'Заглушка',
    ],
  },
  caption: {
    type: String,
    default: 'Мы предлагаем решение, которое уберёт эти ограничения.',
  },
})
</script>

<template>
  <div class="small-card">
    <h1>{{ title }}</h1>
    <p v-if="description">{{ description }}</p>
    <div class="small-list">
      <h3>{{ subtitle }}</h3>
      <input v-for="(item, index) in items" :key="index" class="input" type="text" :value="item" />
    </div>
    <p>{{ caption }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>
