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
    />
    <img
      v-if="$route.name === 'GeneratePage'"
      class="custom-shape bottom-left"
      :src="generateFigure_2"
      alt="Generate Figure 2"
    />
  </div>
</template>

<script>
import mainFigure from '@/assets/images/figure2.png'
import generateFigure_1 from '@/assets/images/figure3.png'
import generateFigure_2 from '@/assets/images/figure4.png'

export default {
  data() {
    return {
      mainFigure,
      generateFigure_1,
      generateFigure_2,
    }
  },
}
</script>

<style scoped>
@import url('../../assets/styles/Background/FloatingShapes.css');
</style>