<template>
  <article class="notification-block">
    <div class="datetime-task-name-block">
      <div class="datetime-block">
        <time :datetime="date">{{ date }}</time>
        <time :datetime="time">{{ time }}</time>
      </div>
      <a :href="taskLink">
        <h2>
          Задача «<span>{{ title }}</span
          >»
        </h2>
      </a>
    </div>
    <p>{{ description }}</p>
  </article>
</template>

<script setup>
defineProps({
  date: String,
  time: String,
  title: String,
  taskLink: String,
  description: String,
})
</script>

<style scoped>
@import '../../assets/styles/Notifications/NotificationElement.css';
</style>
