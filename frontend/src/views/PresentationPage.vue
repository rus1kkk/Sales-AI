<script setup>
import CoverContent from '../components/Presentation/CoverContent.vue'
import SmallCard from '../components/Presentation/SmallCard.vue'
import BigCard from '../components/Presentation/BigCard.vue'
import CaseContent from '../components/Presentation/CaseContent.vue'
import middleFigure from '@/assets/images/figure6.png'
import rightFigure from '@/assets/images/figure2.png'
import leftFigure from '@/assets/images/figure3.png'
import calendarFigure from '@/assets/images/figure7.png'
import coinFigure from '@/assets/images/figure8.png'
</script>

<template>
  <div class="presentation-content">
    <section class="cover">
      <CoverContent
        :images="['presentation/photo1.png', 'presentation/photo2.png', 'presentation/photo3.png']"
      />
      <img class="custom-shape right" :src="rightFigure" alt="Right Figure" />
      <img class="custom-shape left" :src="leftFigure" alt="Left Figure" />
    </section>
    <section class="problem-and-solution">
      <div class="problem-card">
        <SmallCard />
      </div>
      <div class="solution-card">
        <SmallCard
          title="Решение"
          description="Мы сделаем сайт, с которым вам будет удобно продавать:"
          subtitle="Основные проблемы без сайта:"
          :items="[
            'Каталог с фильтрами (размер, бренд, цена)',
            'Удобная корзина и оформление заказа',
            'Мобильная версия — всё работает на телефонах',
            'Быстрая работа и понятный дизайн',
            'Готов к подключению онлайн-оплаты и CRM',
          ]"
          caption="Всё просто: зашёл, нашёл, купил. И вам удобно управлять."
        />
      </div>
      <img class="custom-shape middle" :src="middleFigure" alt="Middle Figure" />
    </section>
    <div class="product-card">
      <BigCard
        title="Что дает такой продукт?"
        subtitle="Основные проблемы без сайта:"
        :items="[
          'Помогает продавать в любое время, даже ночью',
          'Доверие выше, чем к аккаунтам в соцсетях',
          'Можно запускать рекламу и отслеживать, что работает',
          'Готов к подключению онлайн-оплаты и CRM',
          'Экономит время — меньше ручной обработки заказов',
        ]"
        caption="Это уже не просто сайт — это полноценный инструмент продаж."
      />
    </div>
    <section class="stages-of-work">
      <div class="work-card">
        <SmallCard />
        <img class="custom-shape calendar" :src="calendarFigure" alt="Calendar Figure" />
      </div>
    </section>
    <section class="price-of-work">
      <div class="price-card">
        <SmallCard />
        <img class="custom-shape coin" :src="coinFigure" alt="Coin Figure" />
      </div>
    </section>
    <section class="who-will-do-it">
      <div class="do-it">
        <BigCard
          title="Кто будет делать?"
          subtitle="Над проектом будут работать:"
          :items="[
            'Дизайнер',
            'Frontend и backend-разработчик',
            'Cпециалист по UX',
            'Mенеджер, который всегда на связи',
            'Экономит время — меньше ручной обработки заказов',
          ]"
          caption="Мы работали с интернет-магазинами и знаем, как сделать так, чтобы сайт приносил продажи."
        />
      </div>
    </section>
    <section class="cases-section">
      <div class="cases-block">
        <CaseContent
          :items="[
            {
              src: 'presentation/case_1.png',
              alt: 'Кейс интернет-магазина обуви',
              title: 'Проект для обувного магазина',
            },
            'presentation/case_2.png',
            'presentation/case_3.png',
          ]"
        />
        <svg
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
      <BigCard />
    </section>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/presentation.css';
</style>
