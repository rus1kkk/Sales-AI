<script setup>
import pencilIcon from '@/assets/images/pencil.svg'

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

const emit = defineEmits(['update:title', 'update:date', 'update:fromSomeone', 'update:toSomeone'])

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
    <div class="title-edit">
      <input
        :value="title"
        @input="$emit('update:title', $event.target.value)"
        class="editable-input title-input"
        type="text"
      />
       <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
    </div>
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
        <div class="from-edit">
          <input
            :value="fromSomeone"
            @input="$emit('update:fromSomeone', $event.target.value)"
            class="editable-input from-to-input"
            type="text"
          />
          <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
        </div>
      </div>
      <div class="vertical-line"></div>
      <div class="to-someone">
        <p>Для компании</p>
        <div class="to-edit">
          <input
            :value="toSomeone"
            @input="$emit('update:toSomeone', $event.target.value)"
            class="editable-input from-to-input"
            type="text"
          />
          <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
        </div>
      </div>
    </div>
    <input
      :value="date"
      @input="$emit('update:date', $event.target.value)"
      class="editable-input date-input"
      type="text"
    />
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
  max-width: 885px;
  width: 100%;
}

h1 {
  color: var(--actient-color, #71abeb);
  font-weight: 600;
  text-transform: uppercase;
  font-size: 36px;
  text-align: center;
  line-height: 120%;
}

.title-input {
  color: #fff;
  text-align: center;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;

}

h3, .from-to-input  {
  color: #fff;
  text-align: center;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}

h3{
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

.from-someone input{
  text-align: start;
}

input{
  width: 100%;
  font-size: 16px;
  background: none;
  outline: none;
  color:white;
  border: none;
  font-family: Montserrat;
  text-align: center;
  text-wrap: wrap;
}

.to-someone {
  display: flex;
  width: 365px;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  gap: 24px;
}

.to-someone input{
  text-align: end;
}

.title-edit, .from-edit, .to-edit{
  display: flex;
  width: 100%;
  gap:10px;
  align-items: center;
  padding-bottom: 24px;
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
