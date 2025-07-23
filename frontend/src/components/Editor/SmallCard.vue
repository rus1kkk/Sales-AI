<script setup>
import { ref } from 'vue'
import pencilIcon from '@/assets/images/pencil.svg'
import trashlIcon from '@/assets/images/trash.svg'

const props = defineProps({
  title: {
    type: String,
    default: '',
  },
  description: {
    type: String,
    default: '',
  },
  subtitle: {
    type: String,
    default: '',
  },
  items: {
    type: Array,
    default: () => [],
  },
  caption: {
    type: String,
    default: '',
  },
})

// Объявляем события для v-model
const emit = defineEmits([
  'update:title',
  'update:description',
  'update:subtitle',
  'update:items',
  'update:caption',
])

const newItemValue = ref('')

// Обновление отдельного пункта
const updateItem = (index, value) => {
  const newItems = [...props.items]
  newItems[index] = value
  emit('update:items', newItems)
}

// Добавление нового пункта
const addNewItem = () => {
  const trimmedValue = newItemValue.value.trim()
  if (trimmedValue) {
    const newItems = [...props.items, trimmedValue]
    emit('update:items', newItems)
    newItemValue.value = ''
  }
}

const handleNewItemKeyDown = (e) => {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault()
    addNewItem()
  }
}

const handleNewItemBlur = () => {
  addNewItem()
}

// Удаление пункта (удаляется полностью)
const removeItem = (index) => {
  const newItems = props.items.filter((_, i) => i !== index)
  emit('update:items', newItems)
}

// Очистка полей (очищается значение)
const clearDescription = () => {
  emit('update:description', '')
}

const clearSubtitle = () => {
  emit('update:subtitle', '')
}

const clearCaption = () => {
  emit('update:caption', '')
}
</script>

<template>
  <div class="small-card">
    <div class="title-edit">
      <textarea
        :value="title"
        @input="$emit('update:title', $event.target.value)"
        class="editable-textarea title-textarea"
        rows="1"
        placeholder="Добавить заголовок"
      ></textarea>
      <img v-if="title" :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
    </div>

    <div class="description-edit">
      <textarea
        placeholder="Добавить текст"
        :value="description"
        @input="$emit('update:description', $event.target.value)"
        class="editable-textarea description-textarea"
        rows="1"
      ></textarea>
      <img v-if="description" :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
      <img v-if="description" :src="trashlIcon" alt="Trash Icon" class="input-icon clear-icon trash-icon" @click="clearDescription" />
    </div>

    <div class="small-list">
      <div class="subtitle-edit">
        <textarea
          placeholder="Добавить подзаголовок"
          :value="subtitle"
          @input="$emit('update:subtitle', $event.target.value)"
          class="editable-textarea subtitle-textarea"
          rows="1"
        ></textarea>
        <img v-if="subtitle" :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
        <img v-if="subtitle" :src="trashlIcon" alt="Trash Icon" class="input-icon clear-icon trash-icon" @click="clearSubtitle" />
      </div>

      <!-- Существующие пункты списка -->
      <div v-for="(item, index) in items" :key="`item-${index}`" class="item-edit">
        <textarea
          placeholder="Добавить пункт"
          :value="item"
          @input="updateItem(index, $event.target.value)"
          class="editable-textarea item-textarea"
          rows="1"
        ></textarea>
        <img :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
        <img :src="trashlIcon" alt="Trash Icon" class="input-icon trash-icon" @click="removeItem(index)" />
      </div>

      <!-- Поле для добавления нового пункта -->
      <div class="item-edit">
        <textarea
          v-model="newItemValue"
          placeholder="Добавить пункт"
          class="editable-textarea item-textarea"
          rows="1"
          @blur="handleNewItemBlur"
          @keydown="handleNewItemKeyDown"
        ></textarea>
        <div class="blank"></div>
      </div>
    </div>

    <div class="caption-edit">
      <textarea
        placeholder="Добавить подпись"
        :value="caption"
        @input="$emit('update:caption', $event.target.value)"
        class="editable-textarea caption-textarea"
        rows="1"
      ></textarea>
      <img v-if="caption" :src="pencilIcon" alt="Pencil Icon" class="input-icon" />
      <img v-if="caption" :src="trashlIcon" alt="Trash Icon" class="input-icon clear-icon trash-icon" @click="clearCaption" />
    </div>
  </div>
</template>

<style scoped>
h1 {
  color: var(--actient-color, #71abeb);
  font-family: Montserrat;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 43.2px */
  /*text-transform: uppercase;*/
  text-align: center;
}
h2 {
  color: #fff;
  text-align: center;
  /* Заголовок */
  font-family: Montserrat;
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 38.4px */
}
h3 {
  color: #fff;
  text-align: center;
  /* Подзаголовок */
  font-family: Montserrat;
  font-size: 24px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 28.8px */
}

/*small-card*/
.small-card {
  display: flex;
  flex-direction: column;
  padding: 36px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 68px 0px rgba(255, 255, 255, 0.05) inset;
  backdrop-filter: blur(22.5px);
  gap: 16px;
  text-align: left;
  width: 100%;
  height: auto;
}

.small-list {
  display: flex;
  padding: 24px 0px;
  flex-direction: column;
  align-items: flex-start;
  gap: 16px;
}

/* Editable elements */
.title-edit, .description-edit, .subtitle-edit, .item-edit, .caption-edit {
  display: flex;
  width: 100%;
  gap: 10px;
  align-items: flex-start;
  padding-bottom: 8px;
}

.editable-textarea {
  width: 100%;
  background: none;
  outline: none;
  color: white;
  border: none;
  font-family: Montserrat;
  resize: vertical;
  min-height: auto;
  overflow: hidden;
}

.title-textarea {
  color: var(--actient-color, #71abeb);
  font-size: 32px;
  font-weight: 500;
  line-height: 120%;
  text-align: left;
}

.description-textarea, .caption-textarea {
  font-size: 16px;
  font-weight: 400;
  line-height: 120%;
  color: #fff;
}

.subtitle-textarea {
  color: #fff;
  font-size: 24px;
  font-weight: 500;
  line-height: 120%;
  text-align: left;
}

.item-textarea {
  width: 100%;
  padding: 25px 36px;
  border-radius: 60px;
  background: rgba(255, 255, 255, 0.2);
  backdrop-filter: blur(7.5px);
  border: none;
  color: var(--standart-color, #fff);
  font-size: 16px;
  font-family: Montserrat;
  transition: background 0.5s ease;
  will-change: background;
  min-height: 70px;
}

.input-icon {
  width: 18px;
  height: 18px;
  flex-shrink: 0;
  opacity: 0.7;
  margin-top: 8px;

  transition: opacity 0.2s ease;
}

.trash-icon{
  width: 20px;
  height: 24px;
  cursor: pointer;
}
.input-icon:hover {
  opacity: 1;
}

.blank{
  width: 58px;
}

@media (max-width: 1200px) {
  .small-card {
    width: 698px;
  }
}

@media (max-width: 740px) {
  .small-card {
    width: 456px;
  }

  .title-textarea {
    font-size: 28px;
  }

  .subtitle-textarea {
    font-size: 20px;
  }
}

@media (max-width: 500px) {
  .small-card {
    width: 312px;
  }

  .small-card {
    padding: 24px;
  }

  .title-textarea {
    font-size: 24px;
  }

  .subtitle-textarea {
    font-size: 18px;
  }

  .item-textarea {
    padding: 20px 24px;
    font-size: 14px;
  }
}
</style>
