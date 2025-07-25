<script setup>
defineProps({
  items: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <div class="case-container">
    <h1>Кейсы</h1>
    <div v-for="(item, index) in items" :key="index" class="cases">
      <img :src="item.src || item" :alt="item.alt || ''" :title="item.title || ''" />
    </div>
  </div>
</template>

<style scoped>
h1 {
  color: white;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
  text-align: center;
}

.case-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 24px;
  width: 100%;
}

.cases {
  /*
  width: 1024px;
  height: 1024px;
  background: lightgray 50% / cover no-repeat;
  aspect-ratio: 1/1;*/
  border-radius: 60px;
  width: 100%;
  max-width: 1024px;
  display: flex;
  justify-content: center;
}

.cases img {
  width: 100%;
  height: auto;
  border-radius: 60px;
  object-fit: cover;
  display: block;
}
@media (max-width: 1200px) {
  .cases {
    max-width: 698px;
  }
}
</style>
