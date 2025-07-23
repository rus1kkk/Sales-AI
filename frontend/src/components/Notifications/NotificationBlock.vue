<template>
  <section class="notifications-section">
    <h1>Уведомления</h1>
    <section class="new-notifications-section">
      <h2>Новые</h2>
      <div class="notifications-block">
        <NotificationElement
          date="03.02.2025"
          time="13:57"
          title="Зоомагазин"
          taskLink="#"
          description="Изменена менеджером"
        />
        <NotificationElement
          date="03.02.2025"
          time="13:57"
          title="Зоомагазин"
          taskLink="#"
          description="Изменена менеджером"
        />
      </div>
    </section>
    <hr />
    <section class="read-notifications-section">
      <h2>Прочитанные</h2>
      <div class="notifications-block">
        <NotificationElement
          date="03.02.2025"
          time="13:57"
          title="Зоомагазин"
          taskLink="#"
          description="Изменена менеджером"
        />
      </div>
    </section>
  </section>
</template>

<script setup>
import NotificationElement from '../Notifications/NotificationElement.vue'
</script>

<style scoped>
@import '../../assets/styles/Notifications/NotificationBlock.css';
</style>
