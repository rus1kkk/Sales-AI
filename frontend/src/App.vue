<template>
  <div class="app-container">
    <ProfileView />
  </div>
</template>

<script>
import ProfileView from './views/ProfileView.vue'

export default {
  name: 'App',
  components: {
    ProfileView,
  },
}
</script>

<style scoped>
.app-container {
  width: 100%;
  height: 100vh;
  margin: 0;
  padding: 0;
  overflow: hidden;
}
</style>
