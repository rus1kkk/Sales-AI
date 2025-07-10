<template>
  <div class="content-banner">
    <h1>
      Начни Создавать Вместе с
      <span class="sales-ai-text">{{ title }}</span>
    </h1>
    <div class="arrow">
      <img src="@/assets/images/arrow.svg" alt="Arrow" />
    </div>
  </div>
</template>

<script>
export default {
  name: 'MainPage',
  props: {
    title: {
      type: String,
      default: 'Sales AI',
    },
  },
}
</script>

<style scoped>
@import '../assets/styles/MainPage.css';
</style>