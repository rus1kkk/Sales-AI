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
}

.cases {
  width: 1024px;
  height: 1024px;
  aspect-ratio: 1/1;
  border-radius: 60px;
  background: lightgray 50% / cover no-repeat;
}
</style>
