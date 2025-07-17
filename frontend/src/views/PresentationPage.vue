<script setup>
import CoverContent from '../components/Presentation/CoverContent.vue'
import SmallCard from '../components/Presentation/SmallCard.vue'
import BigCard from '../components/Presentation/BigCard.vue'
import CaseContent from '../components/Presentation/CaseContent.vue'
</script>

<template>
  <div class="presentation-content">
    <section class="cover">
      <CoverContent
        :images="[
          'presentation/photo1.png',
          'presentation/photo2.png',
          'presentation/photo3.png',
        ]"
      />
    </section>
    <section class="problem-and-solution">
      <div class="problem-card">
        <SmallCard />
      </div>
      <div class="solution-card">
        <SmallCard
          title="Решание"
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
      </div>
    </section>
    <section class="price-of-work">
      <div class="price-card">
        <SmallCard />
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
      <CaseContent
        :items="[
        {
          src: 'presentation/case_1.png',
          alt: 'Кейс интернет-магазина обуви',
          title: 'Проект для обувного магазина'
        },
          'presentation/case_2.png',
          'presentation/case_3.png',
        ]"
      />
    </section>
    <section class="next-steps">
      <BigCard/>
    </section>
  </div>
</template>

<style scoped>
@import '@/assets/styles/Presentation/presentation.css';
</style>
