<script setup>
import { ref } from 'vue'
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

const emit = defineEmits(['update:title', 'update:date', 'update:fromSomeone', 'update:toSomeone', 'update:images'])

// Реф для скрытого input файла
const fileInput = ref(null)
const currentImageIndex = ref(-1)

const isCenter = (index) => {
  const total = props.images.length
  const isOdd = total % 2 === 1
  const centerIndex = Math.floor(total / 2)
  return isOdd && index === centerIndex
}

const handleImageClick = (index) => {
  currentImageIndex.value = index
  fileInput.value.click()
}

// Функция для обработки выбора файла
const handleFileChange = (event) => {
  const file = event.target.files[0]
  
  if (file && currentImageIndex.value !== -1) {
    const imageUrl = URL.createObjectURL(file)    // Создаем URL для превью
    const newImages = [...props.images]
    newImages[currentImageIndex.value] = imageUrl
    emit('update:images', newImages)
    currentImageIndex.value = -1
    event.target.value = ''
  }
}
</script>

<template>
  <div class="cover-content">
    <h1>SALES AI</h1>
    <h3>Коммерческое предложение</h3>
    
    <!-- Скрытый input для выбора файла -->
    <input
      ref="fileInput"
      type="file"
      accept="image/*"
      style="display: none"
      @change="handleFileChange"
    />
    
    <div class="title-edit">
      <textarea
        :value="title"
        @input="$emit('update:title', $event.target.value)"
        class="editable-input title-input"
      ></textarea>
      <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
    </div>
    <div class="cover-photo-list">
      <div
        v-for="(image, index) in images"
        :key="index"
        class="cover-photo"
        :class="{ 'center-image': isCenter(index) }"
        @click="handleImageClick(index)"
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
    <div class="date-edit">
      <input
        :value="date"
        @input="$emit('update:date', $event.target.value)"
        class="editable-input date-input"
        type="text"
      />
      <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
    </div>
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
  background: none;
  outline: none;
  border: none;
  font-family: Montserrat;
  resize: none;
  width: 100%;
  min-height: 38px; 
  overflow: hidden; 
}

h3,
.from-to-input {
  color: #fff;
  text-align: center;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%;
}

h3 {
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
  cursor: pointer;
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

.from-someone input {
  text-align: start;
}

input,
textarea {
  width: 100%;
  font-size: 16px;
  background: none;
  outline: none;
  color: white;
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

.to-someone input {
  text-align: end;
}

.title-edit,
.from-edit,
.to-edit,
.date-edit {
  display: flex;
  width: 100%;
  gap: 10px;
  padding-bottom: 24px;
}

.title-edit .input-icon{
   margin-top: 10px;
}

.date-edit{
  justify-content: center;
  max-width: 132px;
}
.date-edit .input-icon{
  margin: 0;
}
.date-edit input{
  text-align: start;
}

.input-icon {
  width: 18px;
  height: 18px;
  object-fit: contain;
  margin-top: 5.5px;
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

  .from-someone input,
  .to-someone input {
    text-align: center;
  }

  .cover-content {
    padding: 30px 0;
  }
}
</style>