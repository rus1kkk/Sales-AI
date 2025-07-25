<template>
  <section class="tz-page-section">
    <div 
      v-for="(table, index) in tables" 
      :key="index"
      class="tz-wrap fade-up" 
      style="animation-delay: 0.2s"
    >
      <Table 
        :rows="table.rows"
        :table-name="index === 0 ? 'Реквизиты документа' : ''"
        :isReadOnly="index === 0"
      />
    </div>
    <div @click="addTable()" class="make-table-wrap fade-up" style="animation-delay: 0.6s">
        <h2>Добавить таблицу</h2>
        <span>+</span>
    </div>
  </section>
</template>

<script setup>
import Table from '../components/Tz/Table.vue'
import { ref } from 'vue'
//временное решение без бэка
const tables = ref([
  {
    rows: [
      { th: 'Зоомагазин1', td: ["cell1", "cell2", "cell3"] },
      { th: 'Зоомагазин2' },
      { th: 'Зоомагазин3', td: ["cell1", "cell2"] },
    ]
  }
])

// Добавляем новую таблицу
const addTable = () => {
  tables.value.push({
    rows: []
  })
}
</script>

<style scoped>
.tz-page-section {
  width: 100vw;
  min-height: 90vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 120px;
}

.tz-wrap {
  height: fit-content;
}

.make-table-wrap{
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 90vw;
    max-width: 1166px;
    height: 310px;
    padding: 36px;
    border-radius: 60px;
    backdrop-filter: blur(15px);
    background-color: rgba(255, 255, 255, 0.2);
    box-shadow: inset 0px 0px 68px 0px rgba(255, 255, 255, 0.05);
    margin-bottom: 300px;
}

.make-table-wrap h2{
    font-size: 32px;
    line-height: 120%;
    font-weight: 500;
    color: var(--actient-color);
    text-align: center;
}

.make-table-wrap span{
    font-size: 128px;
    color: var(--muted-color);
    font-weight: 500;
    line-height: 125%;
}

.fade-up {
  opacity: 0;
  animation: fadeUp 0.8s ease-out forwards;
}
@keyframes fadeUp {
  0% {
    opacity: 0;
    transform: translateY(-40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-out {
  opacity: 1;
  animation: fadeOut 0.5s ease-out forwards;
}
@keyframes fadeOut {
  0% {
    opacity: 1;
    transform: translateY(0px);
  }
  100% {
    opacity: 0;
    transform: translateY(-40px);
  }
}
</style>
