<template>
  <div class="presentation-content">
    <section class="cover">
      <CoverContent
        :title="data.cover.title"
        :date="data.cover.date"
        :fromSomeone="data.cover.fromSomeone"
        :toSomeone="data.cover.toSomeone"
        :images="data.cover.images"
        @update:title="$emit('update:data', { ...data, cover: { ...data.cover, title: $event } })"
        @update:date="$emit('update:data', { ...data, cover: { ...data.cover, date: $event } })"
        @update:fromSomeone="
          $emit('update:data', { ...data, cover: { ...data.cover, fromSomeone: $event } })
        "
        @update:toSomeone="
          $emit('update:data', { ...data, cover: { ...data.cover, toSomeone: $event } })
        "
        @update:images="$emit('update:data', { ...data, cover: { ...data.cover, images: $event } })"
      />
      <right-figure />
      <left-figure />
    </section>
    <section class="problem-and-solution">
      <div class="problem-card">
        <SmallCard
          :title="data.problem.title"
          :description="data.problem.description"
          :subtitle="data.problem.subtitle"
          :items="data.problem.items"
          :caption="data.problem.caption"
          @update:title="
            $emit('update:data', { ...data, problem: { ...data.problem, title: $event } })
          "
          @update:description="
            $emit('update:data', { ...data, problem: { ...data.problem, description: $event } })
          "
          @update:subtitle="
            $emit('update:data', { ...data, problem: { ...data.problem, subtitle: $event } })
          "
          @update:items="
            $emit('update:data', { ...data, problem: { ...data.problem, items: $event } })
          "
          @update:caption="
            $emit('update:data', { ...data, problem: { ...data.problem, caption: $event } })
          "
        />
      </div>
      <div class="solution-card">
        <SmallCard
          :title="data.solution.title"
          :description="data.solution.description"
          :subtitle="data.solution.subtitle"
          :items="data.solution.items"
          :caption="data.solution.caption"
          @update:title="
            $emit('update:data', { ...data, solution: { ...data.solution, title: $event } })
          "
          @update:description="
            $emit('update:data', { ...data, solution: { ...data.solution, description: $event } })
          "
          @update:subtitle="
            $emit('update:data', { ...data, solution: { ...data.solution, subtitle: $event } })
          "
          @update:items="
            $emit('update:data', { ...data, solution: { ...data.solution, items: $event } })
          "
          @update:caption="
            $emit('update:data', { ...data, solution: { ...data.solution, caption: $event } })
          "
        />
      </div>
      <middle-figure />
    </section>
    <div class="product-card">
      <BigCard
        :title="data.product.title"
        :subtitle="data.product.subtitle"
        :items="data.product.items"
        :images="data.product.images"
        :caption="data.product.caption"
        @update:title="
          $emit('update:data', { ...data, product: { ...data.product, title: $event } })
        "
        @update:subtitle="
          $emit('update:data', { ...data, product: { ...data.product, subtitle: $event } })
        "
        @update:items="
          $emit('update:data', { ...data, product: { ...data.product, items: $event } })
        "
        @update:images="
          $emit('update:data', { ...data, product: { ...data.product, images: $event } })
        "
        @update:caption="
          $emit('update:data', { ...data, product: { ...data.product, caption: $event } })
        "
      />
    </div>
    <section class="stages-of-work">
      <div class="work-card">
        <SmallCard
          :title="data.stages.title"
          :description="data.stages.description"
          :subtitle="data.stages.subtitle"
          :items="data.stages.items"
          :caption="data.stages.caption"
          @update:title="
            $emit('update:data', { ...data, stages: { ...data.stages, title: $event } })
          "
          @update:description="
            $emit('update:data', { ...data, stages: { ...data.stages, description: $event } })
          "
          @update:subtitle="
            $emit('update:data', { ...data, stages: { ...data.stages, subtitle: $event } })
          "
          @update:items="
            $emit('update:data', { ...data, stages: { ...data.stages, items: $event } })
          "
          @update:caption="
            $emit('update:data', { ...data, stages: { ...data.stages, caption: $event } })
          "
        />
        <calendar-figure />
      </div>
    </section>
    <section class="price-of-work">
      <div class="price-card">
        <SmallCard
          :title="data.price.title"
          :description="data.price.description"
          :subtitle="data.price.subtitle"
          :items="data.price.items"
          :caption="data.price.caption"
          @update:title="$emit('update:data', { ...data, price: { ...data.price, title: $event } })"
          @update:description="
            $emit('update:data', { ...data, price: { ...data.price, description: $event } })
          "
          @update:subtitle="
            $emit('update:data', { ...data, price: { ...data.price, subtitle: $event } })
          "
          @update:items="$emit('update:data', { ...data, price: { ...data.price, items: $event } })"
          @update:caption="
            $emit('update:data', { ...data, price: { ...data.price, caption: $event } })
          "
        />
        <coin-figure />
      </div>
    </section>
    <section class="who-will-do-it">
      <div class="do-it">
        <BigCard
          :title="data.team.title"
          :subtitle="data.team.subtitle"
          :items="data.team.items"
          :images="data.team.images"
          :caption="data.team.caption"
          @update:title="$emit('update:data', { ...data, team: { ...data.team, title: $event } })"
          @update:subtitle="
            $emit('update:data', { ...data, team: { ...data.team, subtitle: $event } })
          "
          @update:items="$emit('update:data', { ...data, team: { ...data.team, items: $event } })"
          @update:images="$emit('update:data', { ...data, team: { ...data.team, images: $event } })"
          @update:caption="
            $emit('update:data', { ...data, team: { ...data.team, caption: $event } })
          "
        />
      </div>
    </section>
    <section class="cases-section">
      <div class="cases-block">
        <CaseContent
          :items="data.cases.items"
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
        :title="data.nextSteps.title"
        :subtitle="data.nextSteps.subtitle"
        :items="data.nextSteps.items"
        :images="data.nextSteps.images"
        :caption="data.nextSteps.caption"
        @update:title="
          $emit('update:data', { ...data, nextSteps: { ...data.nextSteps, title: $event } })
        "
        @update:subtitle="
          $emit('update:data', { ...data, nextSteps: { ...data.nextSteps, subtitle: $event } })
        "
        @update:items="
          $emit('update:data', { ...data, nextSteps: { ...data.nextSteps, items: $event } })
        "
        @update:images="
          $emit('update:data', { ...data, nextSteps: { ...data.nextSteps, images: $event } })
        "
        @update:caption="
          $emit('update:data', { ...data, nextSteps: { ...data.nextSteps, caption: $event } })
        "
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
