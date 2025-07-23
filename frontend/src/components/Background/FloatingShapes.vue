<template>
  <div class="shapes-container">
    <img
      v-if="$route.name === 'MainPage'"
      class="custom-shape top-right"
      :src="mainFigure"
      alt="Main Figure"
    />
    <img
      v-if="
        $route.name === 'GeneratePage' ||
        $route.name === 'ChatPage' ||
        $route.name === 'NotificationsPage'
      "
      class="custom-shape top-right"
      :src="generateFigure_1"
      alt="Generate Figure"
      id="flower-figure"
    />
    <img
      v-if="
        $route.name === 'GeneratePage' ||
        $route.name === 'ChatPage' ||
        $route.name === 'NotificationsPage'
      "
      class="custom-shape bottom-left"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    <img
      v-if="$route.name === 'profile' || $route.name === 'HistoryPage'"
      class="custom-shape top-right"
      :src="sharedFigure_1"
      alt="Shared Figure 1"
    />
    <img
      v-if="$route.name === 'profile' || $route.name === 'HistoryPage'"
      class="custom-shape bottom-left chain"
      :src="sharedFigure_2"
      alt="Shared Figure 2"
    />
  </div>
</template>

<script>
import mainFigure from '@/assets/images/figure1.png'
import generateFigure_1 from '@/assets/images/figure2.png'
import generateFigure_2 from '@/assets/images/figure3.png'
import sharedFigure_1 from '@/assets/images/figure4.png'
import sharedFigure_2 from '@/assets/images/figure5.png'

export default {
  data() {
    return {
      mainFigure,
      generateFigure_1,
      generateFigure_2,
      sharedFigure_1,
      sharedFigure_2,
    }
  },
}
</script>

<style scoped>
@import url('../../assets/styles/Background/FloatingShapes.css');
</style>
