<template>
  <div class="shapes-container">
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
      id="flower-figure"
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape bottom-left"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
    <img
      v-if="$route.name === 'profile'"
      class="custom-shape top-right"
      :src="profileFigure_1"
      alt="Profile Figure"
    />
    <img
      v-if="$route.name === 'profile'"
      class="custom-shape bottom-left"
      id="chain-figure"
      :src="profileFigure_2"
      alt="Profile Figure 2"
    />
  </div>
</template>

<script>
import mainFigure from '@/assets/images/figure1.png'
import generateFigure_1 from '@/assets/images/figure2.png'
import generateFigure_2 from '@/assets/images/figure3.png'
import profileFigure_1 from '@/assets/images/figure4.png'
import profileFigure_2 from '@/assets/images/figure5.png'

export default {
  data() {
    return {
      mainFigure,
      generateFigure_1,
      generateFigure_2,
      profileFigure_1,
      profileFigure_2,
    }
  },
}
</script>

<style scoped>
@import url('../../assets/styles/Background/FloatingShapes.css');
</style>
