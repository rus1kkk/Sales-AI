<template>
  <div
    v-if="isOpen"
    class="modal-overlay fade"
    @click.self="handleClose"
    :class="{ 'fade-close': isClosing }"
  >
    <div class="modal-section" :class="{ 'modal-edit': mode === 'edit' }">
      <div class="modal-content">
        <!-- Заголовок и кнопка закрытия -->
        <div class="name-close-block">
          <h2>
            {{
              mode === 'edit'
                ? 'Изменение названия'
                : mode === 'delete'
                  ? 'Удаление элемента'
                  : 'Информация'
            }}
          </h2>
          <svg
            class="close-img"
            @click="handleClose"
            xmlns="http://www.w3.org/2000/svg"
            width="21"
            height="20"
            viewBox="0 0 21 20"
            fill="none"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M0.918415 0.418415C1.47632 -0.139472 2.38083 -0.139472 2.93873 0.418415L10.5 7.97973L18.0613 0.418415C18.6192 -0.139472 19.5237 -0.139472 20.0816 0.418415C20.6395 0.976316 20.6395 1.88083 20.0816 2.43873L12.5203 10L20.0816 17.5613C20.6395 18.1192 20.6395 19.0237 20.0816 19.5816C19.5237 20.1395 18.6192 20.1395 18.0613 19.5816L10.5 12.0203L2.93873 19.5816C2.38083 20.1395 1.47632 20.1395 0.918415 19.5816C0.360528 19.0237 0.360528 18.1192 0.918415 17.5613L8.47973 10L0.918415 2.43873C0.360528 1.88083 0.360528 0.976316 0.918415 0.418415Z"
              fill="#A8A9AF"
            />
          </svg>
        </div>

        <!-- Режим редактирования -->
        <form v-if="mode === 'edit'" @submit.prevent="handleSubmit" class="edit-form">
          <input type="text" v-model="localValue" required />
          <div class="buttons">
            <button type="button" @click="handleClose">Отменить</button>
            <button type="submit" class="actient-color-button">Принять</button>
          </div>
        </form>

        <!-- Режим удаления -->
        <form v-if="mode === 'delete'" @submit.prevent="handleDelete" class="delete-form">
          <p class="delete-message">Вы уверены, что хотите удалить "{{ currentItem?.name }}"?</p>
          <div class="buttons">
            <button type="button" @click="handleClose">Отменить</button>
            <button type="submit" class="delete-btn actient-color-button">Удалить</button>
          </div>
        </form>

        <!-- Режим просмотра информации -->
        <form v-if="mode === 'info'" @submit.prevent="handleInfo" class="info-form">
          <section class="info-section">
            <h2>Дата создания:</h2>
            <p>{{ currentItem?.date }}</p>
          </section>
          <section class="info-section">
            <h2>Название:</h2>
            <p>{{ currentItem?.name }}</p>
          </section>
          <section class="info-section">
            <h2>Статус:</h2>
            <p>{{ currentItem?.status }}</p>
          </section>
          <section class="info-section">
            <h2>Действителен до:</h2>
            <p>{{ currentItem?.expirationDate }}</p>
          </section>
          <button type="button" class="actient-color-button" @click="handleClose">Закрыть</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  isOpen: Boolean,
  value: String,
  mode: {
    type: String,
    default: 'edit',
    validator: (value) => ['edit', 'delete', 'info'].includes(value),
  },
  currentItem: Object,
})

const emit = defineEmits(['update:isOpen', 'update:value', 'submit', 'delete', 'info'])

const localValue = ref(props.value)
const isClosing = ref(false)

watch(
  () => props.value,
  (newVal) => {
    localValue.value = newVal
  },
)

const handleClose = () => {
  isClosing.value = true
  setTimeout(() => {
    emit('update:isOpen', false)
    isClosing.value = false
  }, 500)
}

const handleSubmit = () => {
  emit('submit', localValue.value)
  handleClose()
}

const handleDelete = () => {
  emit('delete')
  handleClose()
}

const handleInfo = () => {
  emit('info')
  handleClose()
}
</script>

<style scoped>
@import '../../assets/styles/History/ModalHistory.css';
</style>
