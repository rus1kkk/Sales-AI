<template>
  <transition-group name="fade-slide" tag="div" class="notification-stack">
    <NotificationModal
      v-for="note in modalNotifications"
      :key="note.id"
      :date="note.date"
      :time="note.time"
      :title="note.title"
      :taskLink="note.taskLink"
      :description="note.description"
      @close="removeModalById(note.id)"
    />
  </transition-group>
</template>

<script setup>
import { ref } from 'vue'
import NotificationModal from '../Notifications/NotificationModal.vue'

// уведомления работают по принципу очереди (не более двух стразу, первое удаляется)
const queuedNotifications = ref([
  {
    id: 1,
    date: '03.02.2025',
    time: '13:57',
    title: 'Зоомагазин',
    taskLink: '#',
    description: 'сгенерирована',
  },
  {
    id: 2,
    date: '03.02.2025',
    time: '13:57',
    title: 'Кофемашина',
    taskLink: '#',
    description: 'изменена менеджером',
  },
  {
    id: 3,
    date: '03.02.2025',
    time: '13:57',
    title: 'Фильтр воды',
    taskLink: '#',
    description: 'добавлен сотрудником',
  },
])

const modalNotifications = ref([])

// заглушка для демонстрации уведомлений
function showNextNotification() {
  if (queuedNotifications.value.length > 0) {
    const next = queuedNotifications.value.shift()

    if (modalNotifications.value.length >= 2) {
      modalNotifications.value.shift()
    }

    modalNotifications.value.push(next)

    setTimeout(() => {
      removeModalById(next.id)
    }, 5000)
  }
}

function removeModalById(id) {
  modalNotifications.value = modalNotifications.value.filter((n) => n.id !== id)
}

setInterval(showNextNotification, 2000)
</script>

<style scoped>
@import '../../assets/styles/Notifications/NotificationModalBlock.css';
</style>
