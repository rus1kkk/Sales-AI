<script setup>
const props = defineProps({
  title: {
    type: String,
    default: 'Разработка сайта для магазина спортивной обуви',
  },
  date: {
    type: String,
    default: 'Июль 2025',
  },
  fromSomeone: {
    type: String,
    default: 'Русские сайты',
  },
  toSomeone: {
    type: String,
    default: 'Лучшая обувь РФ',
  },
  images: {
    type: Array,
    default: () => [],
  },
})
const isCenter = (index) => {
  const total = props.images.length
  const isOdd = total % 2 === 1
  const centerIndex = Math.floor(total / 2)
  return isOdd && index === centerIndex
}
</script>

<template>
  <div class="cover-content">
    <h1>SALES AI</h1>
    <h3>Коммерческое предложение</h3>
    <h2>{{ title }}</h2>
    <div class="cover-photo-list">
      <div
        v-for="(image, index) in images"
        :key="index"
        class="cover-photo"
        :class="{ 'center-image': isCenter(index) }"
      >
        <img :src="image.src || image" :alt="image.alt || ''" :title="image.title || ''" />
      </div>
    </div>
    <div class="from-someone-to-someone">
      <div class="from-someone">
        <p>От компании</p>
        <h3>{{ fromSomeone }}</h3>
      </div>
      <div class="vertical-line"></div>
      <div class="to-someone">
        <p>Для компании</p>
        <h3>{{ toSomeone }}</h3>
      </div>
    </div>
    <p>{{ date }}</p>
  </div>
</template>

<style scoped>
.cover-content {
  display: flex;
  padding: 132px 0;
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
  line-height: 120%;
  padding-bottom: 24px;
}

h3 {
  color: #fff;
  text-align: center;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
  padding-bottom: 14px;
}

.cover-photo-list {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 10px;
  justify-content: center;
  padding: 24px 0 48px 0;
}

.cover-photo {
  width: 200px;
  height: 200px;
  border-radius: 6000px;
  border: 0.6px solid rgba(255, 255, 255, 0.6);
  overflow: hidden;
  flex-shrink: 0;
}

.cover-photo.center-image {
  width: 250px;
  height: 250px;
}

.cover-photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

.from-someone-to-someone {
  display: flex;
  justify-content: center;
  align-items: stretch;
  gap: 64px;
  align-self: stretch;
  position: relative;
}

.vertical-line {
  width: 1px;
  background-color: rgba(255, 255, 255, 0.6);
  flex-shrink: 0;
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

@media (max-width: 900px) {
  .from-someone,
  .to-someone {
    width: 300px;
  }

  .from-someone-to-someone {
    gap: 49px;
  }
}

@media (max-width: 720px) {
  h3 {
    padding-bottom: 0px;
  }
  .cover-photo-list {
    flex-direction: column;
  }

  .from-someone-to-someone {
    flex-direction: column;
    align-items: center;
    gap: 24px;
  }

  .vertical-line {
    height: 1px;
    width: 100%;
    padding: 0 24px;
    flex-shrink: 0;
  }

  .from-someone,
  .to-someone {
    align-items: center;
  }

  .cover-content {
    padding: 30px 0;
  }
}
</style>
