<script setup>
defineProps({
  title: {
    type: String,
    default: 'Разработка сайта для магазина спортивной обуви',
  },
  data: {
    type: String,
    default: 'Июль 2025',
  },
  someone: {
    type: String,
    default: 'Лучшая обвуь РФ',
  },
  images: {
    type: Array,
    default: () => [],
  },
})
</script>

<template>
  <div class="cover-content">
    <h1>SALES AI</h1>
    <h3>Комерческое предложение</h3>
    <h2>{{ title }}</h2>
    <div class="cover-photo-list">
      <div v-for="(image, index) in images" :key="index" class="cover-photo">
        <img :src="image.src || image" :alt="image.alt || ''" :title="image.title || ''" />
      </div>
    </div>
    <div class="from-someone-to-someone">
      <div class="from-someone">
        <p>От компании</p>
        <h3>Русские сайты</h3>
      </div>
      <div class="vertical-line"></div>
      <div class="to-someone">
        <p>Для компании</p>
        <h3>{{ someone }}</h3>
      </div>
    </div>
    <p>{{ data }}</p>
  </div>
</template>

<style scoped>
.cover-content {
  display: flex;
  width: 1128px;
  height: 985px;
  padding: 36px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 24px;
}
h1 {
  color: var(--actient-color, #71abeb);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 36px;
  text-align: center;
  line-height: 120%;
}

h2 {
  color: #fff;
  text-align: center;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 38.4px */
  padding-bottom: 24px;
}

h3 {
  color: #fff;
  text-align: center;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 28.8px */
  padding-bottom: 24px;
}

.cover-photo-list {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 10px;
}
/*
.cover-photo {
  border-radius: 6000px;
  border: 0.6px solid rgba(255, 255, 255, 0.6);
  background: lightgray 50% / cover no-repeat;
  aspect-ratio: 1/1;
}
*/
.vertical-line {
  border-left: 1px solid white;
  height: 100%;
}

.from-someone-to-someone {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 64px;
  align-self: stretch;
}

.from-someone {
  display: flex;
  width: 365px;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  gap: 24px;
}

.to-someone {
  display: flex;
  width: 365px;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  gap: 24px;
}
</style>
