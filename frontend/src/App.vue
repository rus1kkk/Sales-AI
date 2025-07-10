<template>
  <div id="app">
    <BackgroundStars></BackgroundStars>
    <img
      v-if="$route.name === 'MainPage'"
      class="custom-shape top-right"
      :src="mainFigure"
      alt="Main Figure"
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape top-right"
      :src="generateFigure_1"
      alt="Generate Figure"
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape bottom-left"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    <AppHeader />
    <router-view />
  </div>
</template>

<script>
import AppHeader from './components/AppHeader.vue'
import mainFigure from '@/assets/images/figure2.png'
import generateFigure_1 from '@/assets/images/figure3.png'
import generateFigure_2 from '@/assets/images/figure4.png'
import BackgroundStars from './components/BackgroundStars.vue'

export default {
  components: { AppHeader, BackgroundStars },
  data() {
    return {
      mainFigure,
      generateFigure_1,
      generateFigure_2,
      showMainFigure: false,
      showGenerateFigure: false,
    }
  },
  mounted() {
    // Задержка для плавного появления
    setTimeout(() => {
      this.showMainFigure = this.$route.name === 'MainPage'
      this.showGenerateFigure = this.$route.name === 'GeneratePage'
    }, 80)
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
  overflow: hidden;
  min-height: 100vh;
}

.custom-shape {
  position: absolute;
  width: 100vw;
  opacity: 0;
  z-index: -1;
  background-size: cover;
}

.top-right{
  right: -27vw;
  top: -22vw;
  animation:
  fadeIn 1s ease-in forwards,
  float 20s infinite ease-in-out;
}

.bottom-left {
  left: -27vw;
  bottom: -30vw;
  animation:
  fadeIn 1s ease-in forwards,
  float-mirrored 20s infinite ease-in-out;
}

@keyframes float {
  0% {
    transform: translate(0, 0) rotate(0deg);
    opacity: 0.7;
  }

  50% {
    transform: translate(-7vw, -1vw) rotate(5deg);
    opacity: 1;
  }

  100% {
    transform: translate(0, 0) rotate(0deg);
    opacity: 0.7;
  }
}
@keyframes float-mirrored {
  0% {
    transform: translate(0, 0) rotate(0deg);
    opacity: 1;
  }
  50% {
    transform: translate(7vw, -1vw) rotate(15deg);
    opacity: 0.7;
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
    opacity: 0.7;
  }
}
</style>
