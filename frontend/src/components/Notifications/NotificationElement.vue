<template>
  <article class="notification-block">
    <time :datetime="date">{{ date }}</time>
    <time :datetime="time">{{ time }}</time>
    <a :href="taskLink">
      <h2>
        Задача "<span>{{ title }}</span
        >"
      </h2>
    </a>
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

<style>
@import '../../assets/styles/Notifications/NotificationElement.css';
</style>
