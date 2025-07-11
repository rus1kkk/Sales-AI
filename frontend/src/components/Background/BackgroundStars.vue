<template>
  <div class="starry-bg" id="starry">
    <template v-for="(star, index) in stars" :key="index">
      <div class="star" :style="styleFor(star)"></div>
      <div class="star-core" :style="coreStyle(star)"></div>
    </template>
    <template v-for="(star, index) in bigStars" :key="'b' + index">
      <div class="big-star" :style="styleFor(star)"></div>
      <div class="big-star-core" :style="coreStyle(star)"></div>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'

const stars = ref([])
const bigStars = ref([])

onMounted(() => {
  updateStars()
  window.addEventListener('resize', updateStars)
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', updateStars)
})

setInterval(() => {
  createShootingStar()
}, 4000)

function createShootingStar() {
  const star = document.createElement('div')
  star.className = 'shooting-star'
  const top = Math.random() * window.innerHeight * 0.3
  const left = Math.random() * window.innerWidth * 0.8
  star.style.top = `${top}px`
  star.style.left = `${left}px`

  document.getElementById('starry').appendChild(star)

  setTimeout(() => {
    star.remove()
  }, 1000)
}

function generateStars() {
  const screenWidth = window.innerWidth
  const minStars = 10
  const maxStars = 20
  const count = Math.floor(minStars + (screenWidth / 1920) * (maxStars - minStars))

  return Array.from({ length: count }, () => {
    const baseSize = Math.random() * 4 + 2
    const scale = Math.min(Math.max(screenWidth / 1920, 0.5), 0.5)
    const coreSize = baseSize * scale
    const glowSize = coreSize * 4

    return {
      top: `${Math.floor(Math.random() * window.innerHeight)}px`,
      left: `${Math.floor(Math.random() * window.innerWidth)}px`,
      size: `${coreSize}px`,
      glowSize: `${glowSize}px`,
      duration: `${2 + Math.random() * 3}s`,
    }
  })
}

function generateBigStars() {
  const screenWidth = window.innerWidth
  const minBigStars = 4
  const maxBigStars = 15
  const estimatedCount = minBigStars + (screenWidth / 1920) * (maxBigStars - minBigStars)
  const count = Math.min(Math.floor(estimatedCount), maxBigStars)

  return Array.from({ length: count }, () => {
    const sizeScale = Math.min(Math.max(screenWidth / 1920, 0.6), 0.5)
    const baseSize = (Math.random() * 6 + 6) * sizeScale
    const glowSize = baseSize * 5

    return {
      top: `${Math.floor(Math.random() * window.innerHeight)}px`,
      left: `${Math.floor(Math.random() * window.innerWidth)}px`,
      size: `${baseSize}px`,
      glowSize: `${glowSize}px`,
      duration: `${3 + Math.random() * 3}s`,
      delay: `${Math.random() * 4}s`,
    }
  })
}

function updateStars() {
  stars.value = generateStars()
  bigStars.value = generateBigStars()
}

function styleFor(star) {
  return {
    top: star.top,
    left: star.left,
    width: star.glowSize,
    height: star.glowSize,
    transform: 'translate(-50%, -50%)',
    animationDuration: star.duration,
    '--delay': star.delay || '0s',
  }
}

function coreStyle(star) {
  return {
    top: star.top,
    left: star.left,
    width: star.size,
    height: star.size,
    transform: 'translate(-50%, -50%)',
  }
}
</script>

<style>
@import url('../../assets/styles/Background/BackgroundStars.css');
</style>

