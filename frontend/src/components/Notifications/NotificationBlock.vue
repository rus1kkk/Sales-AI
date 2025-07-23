<template>
  <section class="notifications-section">
    <h1 class="fade-up" style="animation-delay: 0.2s">Уведомления</h1>

    <section class="new-notifications-section">
      <h2 class="fade-up" style="animation-delay: 0.4s">Новые</h2>
      <div class="notifications-block">
        <NotificationElement
          v-for="(item, index) in newNotifications"
          :key="'new-' + index"
          :date="item.date"
          :time="item.time"
          :title="item.title"
          :taskLink="item.taskLink"
          :description="item.description"
        />
      </div>
    </section>

    <hr />

    <section class="read-notifications-section">
      <h2 class="fade-up" style="animation-delay: 0.6s">Прочитанные</h2>
      <div class="notifications-block">
        <NotificationElement
          v-for="(item, index) in readNotifications"
          :key="'read-' + index"
          :date="item.date"
          :time="item.time"
          :title="item.title"
          :taskLink="item.taskLink"
          :description="item.description"
        />
      </div>
    </section>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import NotificationElement from '../Notifications/NotificationElement.vue'

const newNotifications = ref([])
const readNotifications = ref([])

const allNewNotifications = [
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Зоомагазин',
    taskLink: '#',
    description: 'сгенерирована',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Кофемашина',
    taskLink: '#',
    description: 'изменена менеджером',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Книги',
    taskLink: '#',
    description: 'сгенерирована',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Книги',
    taskLink: '#',
    description: 'сгенерирована',
  },
]

const allReadNotifications = [
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Зоомагазин',
    taskLink: '#',
    description: 'сгенерирована',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Кофемашина',
    taskLink: '#',
    description: 'изменена менеджером',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Книги',
    taskLink: '#',
    description: 'сгенерирована',
  },
  {
    date: '03.02.2025',
    time: '13:57',
    title: 'Книги',
    taskLink: '#',
    description: 'сгенерирована',
  },
]

onMounted(() => {
  let i = 0
  const intrNew = setInterval(() => {
    if (i < allNewNotifications.length) {
      newNotifications.value.push(allNewNotifications[i])
    } else {
      clearInterval(intrNew)
    }
    i++
  }, 300)

  let j = 0
  const intrlRead = setInterval(() => {
    if (j < allReadNotifications.length) {
      readNotifications.value.push(allReadNotifications[j])
    } else {
      clearInterval(intrlRead)
    }
    j++
  }, 500)
})
</script>

<style scoped>
@import '../../assets/styles/Notifications/NotificationBlock.css';
</style>
