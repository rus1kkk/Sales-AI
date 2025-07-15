<template>
  <section class="history-page-section">
    <div class="history-wrap">
      <h1 class="fade-up" style="animation-delay: 0.2s">История генераций</h1>
      <div class="history-table fade-up" style="animation-delay: 0.4s">
        <HistoryItem 
          v-for="item in items" 
          :key="item.id" 
          :item="item"
          @edit="handleEditClick"
          @delete="handleDeleteClick"
        />
      </div>
      <div class="button fade-up" style="animation-delay: 0.6s">
        <router-link to="/generate">Генерировать</router-link>
      </div>
    </div>
  </section>
  <Modal
    v-model:isOpen="isModalOpen"
    v-model:value="currentItemName"
    :mode="modalMode"
    :currentItemName="currentItemName"
    @submit="handleModalSubmit"
    @delete="handleModalDelete"
  />
</template>


<script setup>
import HistoryItem from '../components/History/HistoryItem.vue'
import Modal from '@/components/History/Modal.vue'
import { ref } from 'vue'
//временное решение без бэка
const items = ref([
  { id: 1, name: 'Зоомагазин', date: '01.07.2025', status: 'готово'},
  { id: 2, name: 'Магазин детских игрушек', date: '02.07.2025', status: 'отправлено менеджеру'},
  { id: 3, name: 'Упаковки "Цветной жираф"', date: '03.07.2025', status: 'ожидает генерацию'},
  { id: 4, name: 'Кофейня', date: '04.07.2025', status: 'готово'},
  { id: 5, name: 'Новый запрос', date: '05.07.2025', status: 'ожидает генерацию'},
]);

const isModalOpen = ref(false)
const currentItem = ref(null)
const currentItemName = ref('')
const modalMode = ref('edit')

const handleEditClick = (item) => {
  modalMode.value = 'edit'
  currentItem.value = item
  currentItemName.value = item.name
  isModalOpen.value = true
}

const handleDeleteClick = (item) => {
  modalMode.value = 'delete'
  currentItem.value = item
  currentItemName.value = item.name
  isModalOpen.value = true
}

const handleModalSubmit = (newVal) => {
  //временное решение, без бэка
  const index = items.value.findIndex(item => item.id === currentItem.value.id)
  if (index !== -1) {
    items.value[index].name = newVal
  }
}

const handleModalDelete = () => {
  //временное решение, без бэка
  items.value = items.value.filter(item => item.id !== currentItem.value.id)
}

</script>


<style scoped>

  .history-page-section{
    width: 100vw;
    height: 90vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .history-wrap{
    width: 50vw;
    height: fit-content;
  }

  .history-page-section h1{
    font-size: 24px;
    font-weight: 400;
    line-height: 120%;
    text-align: center;
    color: var(--white-color);
    margin-bottom: 24px;
  }

  .history-table{
    max-height: 296px;
    margin-bottom: 24px;
    background-color: rgba(255, 255, 255, 0.2 );
    border-radius: 60px;
    overflow-y: auto;
    overflow: auto;
    box-shadow: inset 0px 0px 68px 0px rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
  }
  .history-table::-webkit-scrollbar {
    width: 8px;
    height: 8px;
    background: transparent;
  }
  .history-table::-webkit-scrollbar-track {
    background: transparent;
    margin-top: 48px;
    margin-bottom: 48px;
  }
  .history-table::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.32);
    border-radius: 4px;
  }

  .history-page-section .button{
    background-color: var(--actient-color);
    width: 100%;
    border-radius: 34px;
    height: 67px;
    font-size: 24px;
    line-height: 120%;
    font-weight: 400;
    cursor: pointer;
    font-family: 'Montserrat', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .history-page-section .button>*{
    text-decoration: none;
    color: var(--white-color);
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

