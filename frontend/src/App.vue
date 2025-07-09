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
      :src="generateFigure_1"
      alt="Generate Figure"
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape-additional"
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
  overflow: hidden;
  min-height: 100vh;
}

.custom-shape,
.custom-shape-additional {
  position: absolute;
  width: 100vw;
  animation:
    float 20s infinite ease-in-out,
    fadeIn 1s ease-in forwards;
  opacity: 0;
  z-index: -1;
  background-size: cover;
}

.custom-shape {
  right: -27vw;
  top: -22vw;
}

.custom-shape-additional {
  left: -27vw;
  top: -12vh;
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
