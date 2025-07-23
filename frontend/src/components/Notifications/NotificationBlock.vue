<template>
  <section class="notifications-section">
    <h1>Уведомления</h1>

    <section class="new-notifications-section">
      <h2>Новые</h2>
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
      <h2>Прочитанные</h2>
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
import NotificationElement from '../Notifications/NotificationElement.vue'

const newNotifications = [
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

const readNotifications = [
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
</script>

<style scoped>
@import '../../assets/styles/Notifications/NotificationBlock.css';
</style>
