<template>
  <div id="app">
    <BackgroundStars></BackgroundStars>
    <img
      v-if="$route.name === 'MainPage'"
      class="custom-shape"
      :src="mainFigure"
      alt="Main Figure"
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape"
      :src="generateFigure"
      alt="Generate Figure"
    />
    <AppHeader />
    <router-view />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'
import mainFigure from '@/assets/images/figure2.png'
import generateFigure from '@/assets/images/figure3.png'
import BackgroundStars from './components/BackgroundStars.vue'

export default {
  components: { AppHeader, BackgroundStars },
  data() {
    return {
      mainFigure,
      generateFigure,
      showMainFigure: false,
      showGenerateFigure: false,
    }
  },
  mounted() {
    // Задержка для плавного появления
    setTimeout(() => {
      this.showMainFigure = this.$route.name === 'MainPage'
      this.showGenerateFigure = this.$route.name === 'GeneratePage'
    }, 100)
  },
  watch: {
    '$route.name'(newName) {
      this.showMainFigure = newName === 'MainPage'
      this.showGenerateFigure = newName === 'GeneratePage'
    },
  },
}
</script>

<style>
@import '@/assets/styles/main.css';

#app {
  font-family: 'Montserrat', sans-serif;
  margin: 0;
  padding: 0;
  position: relative;
  min-height: 100vh;
}

.custom-shape {
  position: absolute;
  right: -27vw;
  top: -22vw;
  width: 100vw;
  height: auto;
  animation:
    float 20s infinite ease-in-out,
    fadeIn 1s ease-in forwards;
  opacity: 0;
  z-index: -1;
}

@keyframes float {
  0% {
    transform: translate(0, 0) rotate(0deg);
    opacity: 1;
  }
  50% {
    transform: translate(-7vw, -1vw) rotate(5deg);
    opacity: 0.5;
  }
  100% {
    transform: translate(0, 0) rotate(0deg);
    opacity: 1;
  }
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  50% {
    opacity: 0.5;
  }
  100% {
    opacity: 1;
  }
}
</style>
