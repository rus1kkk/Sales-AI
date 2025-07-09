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
.starry-bg {
  position: fixed;
  inset: 0;
  overflow: hidden;
  background-image: url(@/assets/images/background.png);
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  z-index: -1;
}

.shooting-star {
  position: fixed;
  width: 3px;
  height: 80px;
  background: linear-gradient(rgba(255, 255, 255, 0.4), rgba(100, 124, 190, 0.5), transparent);
  border-radius: 50% 50% 40% 40%;
  transform: rotate(-225deg);
  animation: fall 1s ease-out forwards;
  opacity: 1;
  z-index: 1;
}

@keyframes fall {
  0% {
    transform: translate(0, 0) rotate(-225deg);
    opacity: 1;
  }

  70% {
    opacity: 0.7;
  }

  100% {
    transform: translate(200px, 200px) rotate(-225deg);
    opacity: 0;
  }
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
    rgba(255, 252, 254, 0.95) 1%,
    rgba(230, 149, 238, 0.493) 1%,
    rgba(201, 45, 162, 0.055) 30%
  );
  filter: blur(10px);
}

.big-star-core {
  position: absolute;
  background: rgb(255, 254, 255);
  border-radius: 50%;
  filter: blur(2px);
  pointer-events: none;
}

.big-star,
.big-star-core,
.star,
.star-core {
  animation: pulse 3s ease-in-out infinite;
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