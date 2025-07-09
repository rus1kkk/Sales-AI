<template>
  <div class="starry-bg">
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

function generateStars() {
  const screenWidth = window.innerWidth
  const minStars = 60
  const maxStars = 200
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
  const maxBigStars = 10
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

onMounted(() => {
  updateStars()
  window.addEventListener('resize', updateStars)
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', updateStars)
})

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
.starry-bg {
  position: fixed;
  inset: 0;
  background: rgb(25, 27, 43);
  overflow: hidden;
  z-index: -1;
}

.star {
  position: absolute;
  border-radius: 50%;
  background: radial-gradient(
    rgb(146, 154, 204) 5%,
    rgba(69, 77, 158, 0.63) 35%,
    rgba(0, 170, 255, 0.1) 100%
  );
  filter: blur(4px);
  box-shadow:
    0 0 30px rgba(0, 170, 255, 0.1),
    0 0 40px rgba(255, 255, 255, 0.1),
    0 0 50px rgba(86, 121, 139, 0.075);
}

.star-core {
  position: absolute;
  background: rgb(193, 196, 204);
  border-radius: 50%;
  filter: blur(0.4px);
  pointer-events: none;
}

.big-star {
  position: absolute;
  border-radius: 50%;
  background: radial-gradient(
    rgba(206, 174, 198, 0.95) 1%,
    rgba(230, 149, 238, 0.493) 1%,
    rgba(201, 45, 162, 0.055) 30%
  );
  filter: blur(10px);
}

.big-star-core {
  position: absolute;
  background: rgb(241, 236, 240);
  border-radius: 50%;
  filter: blur(2px);
  pointer-events: none;
}

.big-star,
.big-star-core {
  animation: pulse 5s ease-in-out infinite;
  transform-origin: center;
}

@keyframes pulse {
  0% {
    transform: translate(-50%, -50%) scale(1);
  }
  40%,
  60% {
    transform: translate(-50%, -50%) scale(1.5);
  }
  100% {
    transform: translate(-50%, -50%) scale(1);
  }
}
</style>
