<script setup>
import { ref } from 'vue'

const props = defineProps({
  items: {
    type: Array,
    default: () => [],
  },
})

const emit = defineEmits(['update:items'])

// Реф для скрытого input файла
const fileInput = ref(null)
const currentImageIndex = ref(-1)

// Функция для обработки клика по изображению
const handleImageClick = (index) => {
  currentImageIndex.value = index
  fileInput.value?.click() // Проверка на существование fileInput
}

// Функция для обработки выбора файла
const handleFileChange = (event) => {
  const file = event.target.files[0]

  if (file && currentImageIndex.value !== -1 && props.items) {
    const imageUrl = URL.createObjectURL(file) // Создаем URL для превью
    const newItems = [...props.items] // Копия массива items
    newItems[currentImageIndex.value] = {
      ...(typeof newItems[currentImageIndex.value] === 'object'
        ? newItems[currentImageIndex.value]
        : {}),
      src: imageUrl,
      alt: newItems[currentImageIndex.value]?.alt || '',
      title: newItems[currentImageIndex.value]?.title || '',
    }
    emit('update:items', newItems)
    currentImageIndex.value = -1
    event.target.value = '' // Сброс input
  }
}
</script>

<template>
  <div class="case-container">
    <h1>Кейсы</h1>
    <!-- Скрытый input для выбора файла -->
    <input
      ref="fileInput"
      type="file"
      accept="image/*"
      style="display: none"
      @change="handleFileChange"
    />
    <div
      v-for="(item, index) in props.items"
      :key="index"
      class="cases"
      @click="handleImageClick(index)"
    >
      <img
        :src="item.src || item || 'https://via.placeholder.com/1024x1024'"
        :alt="item.alt || 'Кейс ' + (index + 1)"
        :title="item.title || 'Кейс ' + (index + 1)"
      />
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
  border-radius: 60px;
  width: 100%;
  max-width: 1024px;
  display: flex;
  justify-content: center;
  cursor: pointer;
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
