<script setup>
defineProps({
  title: {
    type: String,
  },
  description: {
    type: String,
  },
  subtitle: {
    type: String,
  },
  items: {
    type: Array,
  },
  caption: {
    type: String,
  },
})
</script>

<template>
  <div class="small-card">
    <h1>{{ title }}</h1>
    <p v-if="description">{{ description }}</p>
    <div class="small-list">
      <h3>{{ subtitle }}</h3>
      <p v-for="(item, index) in items" :key="index" class="input">{{ item }}</p>
    </div>
    <p>{{ caption }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>
