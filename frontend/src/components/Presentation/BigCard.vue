<script setup>
defineProps({
  title: {
    type: String,
  },
  subtitle: {
    type: String,
  },
  items: {
    type: Array,
  },
  images: {
    type: Array,
    default: () => [],
  },
  caption: {
    type: String,
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
      <div v-for="(image, index) in images" :key="index" class="team-img">
        <img :src="image.src || image" :alt="image.alt || ''" :title="image.title || ''" />
      </div>
    </div>
    <p class="big-card-p">{{ caption }}</p>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/PresCards.css';
</style>
