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
          @info="handleInfoClick"
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
    :currentItem="currentItem"
    @submit="handleModalSubmit"
    @delete="handleModalDelete"
    @info="handleModalInfo"
  />
</template>

<script setup>
import HistoryItem from '../components/History/HistoryItem.vue'
import Modal from '@/components/History/ModalHistory.vue'
import { ref } from 'vue'
//временное решение без бэка
const items = ref([
  { id: 1, name: 'Зоомагазин', date: '01.07.2025', status: 'готово', expirationDate: '01.07.2025' },
  {
    id: 2,
    name: 'Магазин детских игрушек',
    date: '02.07.2025',
    status: 'отправлено менеджеру',
    expirationDate: '02.07.2025',
  },
  {
    id: 3,
    name: 'Упаковки "Цветной жираф"',
    date: '03.07.2025',
    status: 'ожидает генерацию',
    expirationDate: '03.07.2025',
  },
  { id: 4, name: 'Кофейня', date: '04.07.2025', status: 'готово', expirationDate: '04.07.2025' },
  {
    id: 5,
    name: 'Новый запрос',
    date: '05.07.2025',
    status: 'ожидает генерацию',
    expirationDate: '05.07.2025',
  },
])

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

const handleInfoClick = (item) => {
  modalMode.value = 'info'
  currentItem.value = item
  currentItemName.value = item.name
  isModalOpen.value = true
}

const handleModalSubmit = (newVal) => {
  //временное решение, без бэка
  const index = items.value.findIndex((item) => item.id === currentItem.value.id)
  if (index !== -1) {
    items.value[index].name = newVal
  }
}

const handleModalDelete = () => {
  //временное решение, без бэка
  items.value = items.value.filter((item) => item.id !== currentItem.value.id)
}

const handleModalInfo = () => {
  console.log('Modal in info mode was triggered')
}
</script>

<style scoped>
@import '../assets/styles/History/HistoryPage.css';
</style>
