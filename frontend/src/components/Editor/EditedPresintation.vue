<template>
  <div class="presentation-content">
    <section class="cover">
      <CoverContent
        v-model:title="data.cover.title"
        v-model:date="data.cover.date"
        v-model:fromSomeone="data.cover.fromSomeone"
        v-model:toSomeone="data.cover.toSomeone"
        v-model:images="data.cover.images"
        @update:title="$emit('update:data', { ...data, cover: { ...data.cover, title: $event } })"
        @update:date="$emit('update:data', { ...data, cover: { ...data.cover, date: $event } })"
        @update:fromSomeone="$emit('update:data', { ...data, cover: { ...data.cover, fromSomeone: $event } })"
        @update:toSomeone="$emit('update:data', { ...data, cover: { ...data.cover, toSomeone: $event } })"
        @update:images="$emit('update:data', { ...data, cover: { ...data.cover, images: $event } })"
      />
      <right-figure />
      <left-figure />
    </section>
    <section class="problem-and-solution">
      <div class="problem-card">
        <SmallCard
          v-model:title="data.problem.title"
          v-model:description="data.problem.description"
          v-model:subtitle="data.problem.subtitle"
          v-model:items="data.problem.items"
          v-model:caption="data.problem.caption"
          @update:title="$emit('update:data', { ...data, problem: { ...data.problem, title: $event } })"
          @update:description="$emit('update:data', { ...data, problem: { ...data.problem, description: $event } })"
          @update:subtitle="$emit('update:data', { ...data, problem: { ...data.problem, subtitle: $event } })"
          @update:items="$emit('update:data', { ...data, problem: { ...data.problem, items: $event } })"
          @update:caption="$emit('update:data', { ...data, problem: { ...data.problem, caption: $event } })"
        />
      </div>
      <div class="solution-card">
        <SmallCard
          v-model:title="data.solution.title"
          v-model:description="data.solution.description"
          v-model:subtitle="data.solution.subtitle"
          v-model:items="data.solution.items"
          v-model:caption="data.solution.caption"
          @update:title="$emit('update:data', { ...data, solution: { ...data.solution, title: $event } })"
          @update:description="$emit('update:data', { ...data, solution: { ...data.solution, description: $event } })"
          @update:subtitle="$emit('update:data', { ...data, solution: { ...data.solution, subtitle: $event } })"
          @update:items="$emit('update:data', { ...data, solution: { ...data.solution, items: $event } })"
          @update:caption="$emit('update:data', { ...data, solution: { ...data.solution, caption: $event } })"
        />
      </div>
      <middle-figure />
    </section>
    <div class="product-card">
      <BigCard
        v-model:title="data.product.title"
        v-model:subtitle="data.product.subtitle"
        v-model:items="data.product.items"
        v-model:images="data.product.images"
        v-model:caption="data.product.caption"
        @update:title="$emit('update:data', { ...data, product: { ...data.product, title: $event } })"
        @update:subtitle="$emit('update:data', { ...data, product: { ...data.product, subtitle: $event } })"
        @update:items="$emit('update:data', { ...data, product: { ...data.product, items: $event } })"
        @update:images="$emit('update:data', { ...data, product: { ...data.product, images: $event } })"
        @update:caption="$emit('update:data', { ...data, product: { ...data.product, caption: $event } })"
      />
    </div>
    <section class="stages-of-work">
      <div class="work-card">
        <SmallCard
          v-model:title="data.stages.title"
          v-model:description="data.stages.description"
          v-model:subtitle="data.stages.subtitle"
          v-model:items="data.stages.items"
          v-model:caption="data.stages.caption"
          @update:title="$emit('update:data', { ...data, stages: { ...data.stages, title: $event } })"
          @update:description="$emit('update:data', { ...data, stages: { ...data.stages, description: $event } })"
          @update:subtitle="$emit('update:data', { ...data, stages: { ...data.stages, subtitle: $event } })"
          @update:items="$emit('update:data', { ...data, stages: { ...data.stages, items: $event } })"
          @update:caption="$emit('update:data', { ...data, stages: { ...data.stages, caption: $event } })"
        />
        <calendar-figure />
      </div>
    </section>
    <section class="price-of-work">
      <div class="price-card">
        <SmallCard
          v-model:title="data.price.title"
          v-model:description="data.price.description"
          v-model:subtitle="data.price.subtitle"
          v-model:items="data.price.items"
          v-model:caption="data.price.caption"
          @update:title="$emit('update:data', { ...data, price: { ...data.price, title: $event } })"
          @update:description="$emit('update:data', { ...data, price: { ...data.price, description: $event } })"
          @update:subtitle="$emit('update:data', { ...data, price: { ...data.price, subtitle: $event } })"
          @update:items="$emit('update:data', { ...data, price: { ...data.price, items: $event } })"
          @update:caption="$emit('update:data', { ...data, price: { ...data.price, caption: $event } })"
        />
        <coin-figure />
      </div>
    </section>
    <section class="who-will-do-it">
      <div class="do-it">
        <BigCard
          v-model:title="data.team.title"
          v-model:subtitle="data.team.subtitle"
          v-model:items="data.team.items"
          v-model:images="data.team.images"
          v-model:caption="data.team.caption"
          @update:title="$emit('update:data', { ...data, team: { ...data.team, title: $event } })"
          @update:subtitle="$emit('update:data', { ...data, team: { ...data.team, subtitle: $event } })"
          @update:items="$emit('update:data', { ...data, team: { ...data.team, items: $event } })"
          @update:images="$emit('update:data', { ...data, team: { ...data.team, images: $event } })"
          @update:caption="$emit('update:data', { ...data, team: { ...data.team, caption: $event } })"
        />
      </div>
    </section>
    <section class="cases-section">
      <div class="cases-block">
        <CaseContent
          v-model:items="data.cases.items"
          @update:items="$emit('update:data', { ...data, cases: { ...data.cases, items: $event } })"
        />
        <svg
          class="blur"
          xmlns="http://www.w3.org/2000/svg"
          width="1728"
          height="4037"
          viewBox="0 0 1728 4037"
          fill="none"
        >
          <g filter="url(#filter0_f_437_18813)">
            <path
              d="M483.12 662.765L686.784 881.061L896.078 662.765L1230.2 500L1491.11 662.765L1388.81 1216.17L1457.33 1666.16L1615 2441.69L1575.58 3537H1117.57L783.453 3284.24L245.67 2972.11L324.507 1955.31L149 949.997L483.12 662.765Z"
              fill="url(#paint0_linear_437_18813)"
              fill-opacity="0.6"
            />
          </g>
          <defs>
            <filter
              id="filter0_f_437_18813"
              x="-351"
              y="0"
              width="2466"
              height="4037"
              filterUnits="userSpaceOnUse"
              color-interpolation-filters="sRGB"
            >
              <feFlood flood-opacity="0" result="BackgroundImageFix" />
              <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
              <feGaussianBlur stdDeviation="250" result="effect1_foregroundBlur_437_18813" />
            </filter>
            <linearGradient
              id="paint0_linear_437_18813"
              x1="238.332"
              y1="3393.23"
              x2="2388.07"
              y2="2248.17"
              gradientUnits="userSpaceOnUse"
            >
              <stop stop-color="#71ABEB" />
              <stop offset="1" stop-color="#406185" />
            </linearGradient>
          </defs>
        </svg>
      </div>
    </section>
    <section class="next-steps">
      <BigCard
        v-model:title="data.nextSteps.title"
        v-model:subtitle="data.nextSteps.subtitle"
        v-model:items="data.nextSteps.items"
        v-model:images="data.nextSteps.images"
        v-model:caption="data.nextSteps.caption"
        @update:title="$emit('update:data', { ...data, nextSteps: { ...data.nextSteps, title: $event } })"
        @update:subtitle="$emit('update:data', { ...data, nextSteps: { ...data.nextSteps, subtitle: $event } })"
        @update:items="$emit('update:data', { ...data, nextSteps: { ...data.nextSteps, items: $event } })"
        @update:images="$emit('update:data', { ...data, nextSteps: { ...data.nextSteps, images: $event } })"
        @update:caption="$emit('update:data', { ...data, nextSteps: { ...data.nextSteps, caption: $event } })"
      />
    </section>
  </div>
</template>

<script setup>
import CoverContent from './CoverContent.vue'
import SmallCard from './SmallCard.vue'
import BigCard from './BigCard.vue'
import CaseContent from './CaseContent.vue'
import RightFigure from './Figures/RightFigure.vue'
import LeftFigure from './Figures/LeftFigure.vue'
import MiddleFigure from './Figures/MiddleFigure.vue'
import CalendarFigure from './Figures/CalendarFigure.vue'
import CoinFigure from './Figures/CoinFigure.vue'

defineProps({
  data: {
    type: Object,
    required: true,
  },
})

defineEmits(['update:data'])

</script>

<style scoped>
@import '@/assets/styles/Presentation/presentation.css';
@import '@/assets/styles/Presentation/PresentationFigures.css';

.problem-card {
  width: 747px;
}

.solution-card {
  width: 638px;
}
.product-card,
.do-it,
.next-steps {
  margin: 0;
}
</style>