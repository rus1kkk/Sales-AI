<template>
  <div class="presentation-content">
    <section class="cover">
      <CoverContent :images="Data.cover.images" />
      <img class="custom-shape right" :src="rightFigure" alt="Right Figure" />
      <img class="custom-shape left" :src="leftFigure" alt="Left Figure" />
    </section>
    <section class="problem-and-solution">
      <div class="problem-card">
        <SmallCard
          :title="Data.problem.title"
          :description="Data.problem.description"
          :subtitle="Data.problem.subtitle"
          :items="Data.problem.items"
          :caption="Data.problem.caption"
        />
      </div>
      <div class="solution-card">
        <SmallCard
          :title="Data.solution.title"
          :description="Data.solution.description"
          :items="Data.solution.items"
          :caption="Data.solution.caption"
        />
      </div>
      <img class="custom-shape middle" :src="middleFigure" alt="Middle Figure" />
    </section>
    <div class="product-card">
      <BigCard
        :title="Data.product.title"
        :items="Data.product.items"
        :caption="Data.product.caption"
      />
    </div>
    <section class="stages-of-work">
      <div class="work-card">
        <SmallCard
          :title="Data.stages.title"
          :items="Data.stages.items"
          :caption="Data.stages.caption"
        />
        <img class="custom-shape calendar" :src="calendarFigure" alt="Calendar Figure" />
      </div>
    </section>
    <section class="price-of-work">
      <div class="price-card">
        <SmallCard
          :title="Data.price.title"
          :description="Data.price.description"
          :subtitle="Data.price.subtitle"
          :items="Data.price.items"
          :caption="Data.price.caption"
        />
        <img class="custom-shape coin" :src="coinFigure" alt="Coin Figure" />
      </div>
    </section>
    <section class="who-will-do-it">
      <div class="do-it">
        <BigCard
          :title="Data.team.title"
          :subtitle="Data.team.subtitle"
          :items="Data.team.items"
          :images="Data.team.images"
          :caption="Data.team.caption"
        />
      </div>
    </section>
    <section class="cases-section">
      <div class="cases-block">
        <CaseContent :items="Data.cases.items" />
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
      <BigCard
        :title="Data.nextSteps.title"
        :items="Data.nextSteps.items"
        :caption="Data.nextSteps.caption"
      />
    </section>
  </div>
</template>

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

// Данные для компонентов
const Data = {
  cover: {
    images: ['presentation/photo1.png', 'presentation/photo2.png', 'presentation/photo3.png'],
  },

  problem: {
    title: 'Проблема',
    description:
      'Сейчас многие покупают обувь через интернет — особенно молодёжь. Если у магазина нет нормального сайта, он теряет часть клиентов.',
    subtitle: 'Основные проблемы без сайта:',
    items: [
      'Зависимость от Avito маркетплейсов или Instagram',
      'Сложно рассказать про ассортимент',
      'Нет возможности отслеживать заказы и анализировать продажи',
    ],
    caption: 'Мы предлагаем решение, которое уберёт эти ограничения.',
  },

  solution: {
    title: 'Решение',
    description: 'Мы сделаем сайт, с которым вам будет удобно продавать:',
    items: [
      'Каталог с фильтрами (размер, бренд, цена)',
      'Удобная корзина и оформление заказа',
      'Мобильная версия — всё работает на телефонах',
      'Быстрая работа и понятный дизайн',
      'Готов к подключению онлайн-оплаты и CRM',
    ],
    caption: 'Всё просто: зашёл, нашёл, купил. И вам удобно управлять.',
  },

  product: {
    title: 'Что дает такой продукт?',
    items: [
      'Помогает продавать в любое время, даже ночью',
      'Доверие выше, чем к аккаунтам в соцсетях',
      'Можно запускать рекламу и отслеживать, что работает',
      'Готов к подключению онлайн-оплаты и CRM',
      'Экономит время — меньше ручной обработки заказов',
    ],
    caption: 'Это уже не просто сайт — это полноценный инструмент продаж.',
  },

  stages: {
    title: 'Этапы работы',
    items: [
      'Обсудим ваши задачи и товары',
      'Удобная корзина и оформление заказа',
      'Мобильная версия — всё работает на телефонах',
      'Быстрая работа и понятный дизайн',
      'Готов к подключению онлайн-оплаты и CRM',
    ],
    caption: 'Всё просто: зашёл, нашёл, купил. И вам удобно управлять.',
  },

  price: {
    title: 'Стоимость',
    description:
      'Стоимость зависит от объёма каталога и нужных функций. Примерная цена: от 120 000 до 180 000 ₽',
    subtitle: 'В стоимость входит:',
    items: [
      'Дизвйн',
      'Адаптация под телефон',
      'Установка и базовая настройка',
      'Подключение корзины, фильтров, доставки',
    ],
    caption: 'Оплата поэтапно, договор и всё официально.',
  },

  team: {
    title: 'Кто будет делать?',
    subtitle: 'Над проектом будут работать:',
    items: [
      'Дизайнер',
      'Frontend и backend-разработчик',
      'Cпециалист по UX',
      'Mенеджер, который всегда на связи',
      'Экономит время — меньше ручной обработки заказов',
    ],
    images: [
      { src: 'presentation/avatar2.png', alt: 'Фото команды' },
      { src: 'presentation/avatar1.png', alt: 'Дизайнер' },
      { src: 'presentation/avatar3.png', alt: 'Разработчик' },
      { src: 'presentation/avatar4.png', alt: 'Разработчик' },
      { src: 'presentation/avatar5.png', alt: 'Разработчик' },
    ],
    caption:
      'Мы работали с интернет-магазинами и знаем, как сделать так, чтобы сайт приносил продажи.',
  },

  cases: {
    items: [
      {
        src: 'presentation/case_1.png',
        alt: 'Кейс интернет-магазина обуви',
        title: 'Проект для обувного магазина',
      },
      'presentation/case_2.png',
      'presentation/case_3.png',
    ],
  },

  nextSteps: {
    title: 'Следующие шаги',
    items: [
      'Свяжитесь с нами удобным способом',
      'Обсудим детали проекта',
      'Подпишем договор и начинаем работу',
    ],
    caption:
      'Мы объясним каждый этап, покажем макет, поможем после запуска. Всё будет понятно, без сложных слов — просто нормальный рабочий сайт под ваш магазин.',
  },
}
</script>

<style scoped>
@import '@/assets/styles/Presentation/presentation.css';
@import '@/assets/styles/Presentation/PresentationFigures.css';
</style>
