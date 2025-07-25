<template> 
  <div class="shapes-container">
    <img
      v-if="$route.name === 'MainPage'"
      class="custom-shape top-right"
      :src="mainFigure"
      alt="Main Figure"
    />
    
    <img
      v-if="$route.name === 'GeneratePage' || $route.name === 'ChatPage'"
      class="custom-shape top-right"
      :src="generateFigure_1"
      alt="Generate Figure"
    />
    <img
      v-if="$route.name === 'GeneratePage' || $route.name === 'ChatPage'"
      class="custom-shape bottom-left"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    
    <img
      v-if="$route.name === 'PaymentPage'"
      class="custom-shape top-right"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    <img
      v-if="$route.name === 'PaymentPage'"
      class="custom-shape bottom-left"
      :src="historyFigure_1"
      alt="History Figure 1"
    />

    <img
      v-if="$route.name === 'ManagerPage'"
      class="custom-shape top-right"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    <img
      v-if="$route.name === 'ManagerPage'"
      class="custom-shape bottom-left"
      :src="historyFigure_1"
      alt="History Figure 1"
    />
    
    <img
      v-if="$route.name === 'HistoryPage'"
      class="custom-shape top-right"
      :src="historyFigure_1"
      alt="History Figure 1"
    />
    <img
      v-if="$route.name === 'HistoryPage'"
      class="custom-shape bottom-left"
      :src="historyFigure_2"
      alt="History Figure 2"
    />
  </div>
</template>

<script>
import mainFigure from '@/assets/images/figure2.png'
import generateFigure_1 from '@/assets/images/figure3.png'
import generateFigure_2 from '@/assets/images/figure4.png'
import historyFigure_1 from '@/assets/images/figure5.png'
import historyFigure_2 from '@/assets/images/figure6.png'

export default {
  data() {
    return {
      mainFigure,
      generateFigure_1,
      generateFigure_2,
      historyFigure_1,
      historyFigure_2,
    }
  },
}
</script>

<style scoped>
.shapes-container {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: -1;
}

.custom-shape {
  position: absolute;
  width: 100vw;
  opacity: 0;
  z-index: -1;
  background-size: cover;
  will-change: transform, opacity;
}

.top-right {
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
