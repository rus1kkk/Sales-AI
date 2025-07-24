<template>
  <div
    v-if="isOpen"
    class="modal-overlay fade-up"
    @click.self="handleClose"
    :class="{ 'fade-out': isClosing }"
    style="animation-delay: 0.2s"
  >
    <div class="modal-section" :class="{ 'modal-edit': mode === 'edit' }">
      <div class="modal-content">
        <!-- Заголовок и кнопка закрытия -->
        <div class="name-close-block">
          <h2>{{ mode === 'edit' ? 'Изменение названия' : 'Удаление элемента' }}</h2>
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
            <button type="submit">Принять</button>
          </div>
        </form>

        <!-- Режим удаления -->
        <form v-else @submit.prevent="handleDelete" class="delete-form">
          <p class="delete-message">Вы уверены, что хотите удалить "{{ currentItemName }}"?</p>
          <div class="buttons">
            <button type="button" @click="handleClose">Отменить</button>
            <button type="submit" class="delete-btn">Удалить</button>
          </div>
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
    validator: (value) => ['edit', 'delete'].includes(value),
  },
  currentItemName: String,
})

const emit = defineEmits(['update:isOpen', 'update:value', 'submit', 'delete'])

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
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(10px);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-section {
  background-color: rgba(255, 255, 255, 0.15);
  border-radius: 60px;
  padding: 36px;
  width: 95vw;
  max-width: 777px;
}

.modal-content {
  display: flex;
  flex-direction: column;
  gap: 25px;
}

.edit-form {
  display: flex;
  flex-direction: column;
  gap: 25px;
  align-items: end;
}

.name-close-block {
  display: flex;
  justify-content: space-between;
}

.close-img {
  cursor: pointer;
}

input {
  all: unset;
  width: 100%;
  box-sizing: border-box;
  padding: 25px 36px;
  border-radius: 60px;
  background-color: rgba(255, 255, 255, 0.2);
  color: var(--muted-color);
  font-size: 16px;
  box-shadow: inset 0px 0px 68px 0px rgba(255, 255, 255, 0.05);
  font-family: 'Montserrat', sans-serif;
  backdrop-filter: blur(12px);
}

.modal-content h2 {
  display: inline-block;
  white-space: normal;
  word-break: break-word;
  font-weight: 400;
}

.modal-content .buttons {
  display: flex;
  gap: 24px;
}

.modal-content button {
  font-family: 'Montserrat', sans-serif;
  background-color: transparent;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.modal-content .buttons > button:first-child {
  color: var(--white-color);
}

.modal-content .buttons > button:last-child {
  color: var(--actient-color);
}

.delete-message {
  width: 100%;
}

.delete-form {
  display: flex;
  gap: 25px;
  flex-direction: column;
  align-items: end;
}

path {
  transition: fill 0.3s ease-in-out;
}

path:hover {
  fill: var(--actient-color);
  cursor: pointer;
}

@media (max-width: 400px) {
  .modal-content h2 {
    max-width: 260px;
    text-align: center;
  }

  .delete-message {
    text-align: center;
  }
}
</style>
