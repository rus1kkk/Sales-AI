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
      <input v-for="(item, index) in items" :key="index" class="input" type="text" :value="item" />
    </div>
    <p>{{ caption }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>
