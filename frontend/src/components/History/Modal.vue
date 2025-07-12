<template>
  <div v-if="isOpen" class="modal-overlay fade-up" @click.self="handleClose" :class="{ 'fade-out': isClosing}" style="animation-delay: 0.2s">
    <div class="modal-section" :class="{'modal-edit': mode==='edit'}">
      <div class="modal-content">
        <!-- Заголовок и кнопка закрытия -->
        <div>
          <h2>{{ mode === 'edit' ? 'Изменение названия' : 'Удаление элемента' }}</h2>
          <img :src="closeIcon" alt="close" class="close-img" @click="handleClose">
        </div>

        <!-- Режим редактирования -->
        <form v-if="mode === 'edit'" @submit.prevent="handleSubmit">
          <input type="text" v-model="localValue" required>
          <div class="buttons">
            <button type="button" @click="handleClose">Отменить</button>
            <button type="submit">Принять</button>
          </div>
        </form>

        <!-- Режим удаления -->
        <form v-else @submit.prevent="handleDelete" class="delete-form">
          <p>Вы уверены, что хотите удалить "{{ currentItemName }}"?</p>
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
import closeIcon from '@/assets/images/close.svg'

const props = defineProps({
  isOpen: Boolean,
  value: String,
  mode: {
    type: String,
    default: 'edit',
    validator: (value) => ['edit', 'delete'].includes(value)
  },
  currentItemName: String
})

const emit = defineEmits([
  'update:isOpen', 
  'update:value', 
  'submit', 
  'delete'
])

const localValue = ref(props.value)
const isClosing = ref(false)

watch(() => props.value, (newVal) => {
  localValue.value = newVal
})

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
  background-color: rgba(255, 255, 255, 0.15 );
  border-radius: 60px;
  overflow: auto;
  padding: 48px 36px;
  width: 777px;
  height: fit-content;
}

.modal-section.modal-edit{
  height: 263px;
}

.modal-content {
  position: relative;
}

.close-img {
  cursor: pointer;
  position: absolute;
  top: 0;
  right: 0;
}

input{
  width: 705px;
  height: 69px;
  padding: 25px 36px;
  border: none;
  border-radius: 60px;
  background-color: rgba(255, 255, 255, 0.2);
  color: var(--muted-color);
  margin-top: 24px;
  margin-bottom: 24px;
  font-size: 16px;
  box-shadow: inset 0px 0px 68px 0px rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(15px);
}

.modal-content h2{
  font-weight: 400;
}

.modal-content .buttons{
  display: flex;
  gap: 24px;
  position: absolute;
  right: 0;
}

.modal-content button{
  background-color: transparent;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

.modal-content .buttons>button:first-child{
  color: var(--white-color);
}
.modal-content .buttons>button:last-child{
  color: var(--actient-color);
}

.delete-form{
    display: flex;
    margin-top: 48px;
}


</style>