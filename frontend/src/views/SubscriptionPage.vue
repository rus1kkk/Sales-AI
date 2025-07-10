<script setup>
import PricingCard from '../components/PricingCard.vue'
</script>

<template>
  <div class="price-section">
    <h1 class="pricing-h1">Тарифные планы</h1>
    <div class="pricing-card-list">
      <PricingCard />
      <PricingCard
        title="PRO"
        subtitle="Для активных отделов продаж"
        :features="[
          'Больше запросов к Sales AI',
          'Доступ к неограниченному количеству проектов для организации клиентов',
          'Получите доступ к расширенным шаблонам презентаций и КП',
        ]"
        price="₽ 990"
        priceDescription="За месяц"
        :showAction="true"
      />
      <PricingCard
        title="MAX"
        subtitle="В 10 раз больше возможностей, чем у Pro"
        :features="[
          'В 10 раз больше запросов к ИИ, чем в Pro',
          'Повышенные лимиты генерации для всех типов документов',
          'Персональный менеджер и консультации',
        ]"
        price="₽ 3 990"
        priceDescription="За месяц"
        :showAction="true"
      />
    </div>
  </div>
</template>

<style scoped>
.pricing-card-list {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  align-content: flex-start;
  gap: 25px;
  flex-shrink: 0;
  /*align-self: stretch;*/
  flex-wrap: wrap;
}
.pricing-h1 {
  color: #fff;
  text-align: center;
  /* Заголовок */
  font-size: 32px;
  font-style: normal;
  font-weight: 500;
  line-height: 120%; /* 38.4px */
}

.price-section {
  display: flex;
  padding: 0px 80px;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 86px;
  flex-shrink: 0;
  margin-bottom: 176px;
  margin-top: 86px;
}
</style>
