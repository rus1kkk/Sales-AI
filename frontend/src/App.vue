<template>
  <div class="app-container" id="app">
    <BackgroundStars />
    <FloatingShapes />
    <AppHeader />
    <router-view />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'
import BackgroundStars from './components/Background/BackgroundStars.vue'
import FloatingShapes from './components/Background/FloatingShapes.vue'

export default {
  name: 'App',
  components: {
    AppHeader,
    BackgroundStars,
    FloatingShapes,
  },
}
</script>

<style scoped>
@import '@/assets/styles/main.css';

.app-container {
  width: 100%;
  margin: 0;
  padding: 0;
}

.app-container.no-scroll {
  overflow: hidden;
}

#app {
  font-family: 'Montserrat', sans-serif;
  position: relative;
  min-height: 100vh;
}
</style>
