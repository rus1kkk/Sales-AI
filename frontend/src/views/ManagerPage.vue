<template>
  <section class="manager-page-section">
    <FloatingShapes />
    <div class="manager-wrap">
      <div class="manager-top-bar fade-up" style="animation-delay: 0.2s">
        <div class="admin-title">АДМИН. ПАНЕЛЬ</div>
        <input 
          type="text" 
          v-model="searchQuery"
          placeholder="Поиск по названию \\ имени пользователя"
        />
        <div class="profile-link">ПРОФИЛЬ</div>
      </div>

      <h1 class="fade-up" style="animation-delay: 0.3s">Презентации на доработку</h1>

      <div class="presentations-table fade-up" style="animation-delay: 0.4s">
        <div 
          class="presentation-row" 
          v-for="item in filteredItems" 
          :key="item.id"
        >
          <span class="date">{{ item.date }}</span>
          <span class="name">Название: <a href="#">{{ item.name }}</a></span>
          <span class="status">статус: {{ item.status }}</span>
          <div class="icons">
            <button class="info-btn" @click="showInfo(item)">?</button>
            <button class="delete-btn" @click="deleteItem(item)">🗑</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal-overlay" v-if="showModal" @click.self="closeModal">
      <div class="modal-content">
        <div class="modal-header">Информация</div>
        <div class="modal-body">
          <div class="modal-row">
            <span>Дата отправки на редактирование:</span>
            <span>{{ currentItem.editDate || '12.03.2025' }}</span>
          </div>
          <div class="modal-row">
            <span>Дата создания:</span>
            <span>{{ currentItem.createDate || '12.03.2025' }}</span>
          </div>
          <div class="modal-row">
            <span>Название:</span>
            <span>{{ currentItem.name || 'Зоомагазин' }}</span>
          </div>
          <div class="modal-row">
            <span>Имя пользователя:</span>
            <span>{{ currentItem.username || '©Савушка' }}</span>
          </div>
          <div class="modal-row">
            <span>статус:</span>
            <span>{{ currentItem.status || 'отправлено менеджеру' }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import FloatingShapes from '@/components/FloatingShapes.vue'

const items = ref([
  { id: 1, date: '12.01.2025', name: 'Зоомагазин', status: 'отправлено менеджеру' },
  { id: 2, date: '12.01.2025', name: 'Магазин детских игрушек', status: 'отправлено менеджеру' },
  { id: 3, date: '12.01.2025', name: 'Упаковки "Цветной жираф"', status: 'отправлено менеджеру' },
  { id: 4, date: '12.01.2025', name: 'Кофейня', status: 'отправлено менеджеру' },
])

const searchQuery = ref('')
const showModal = ref(false)
const currentItem = ref({})

const filteredItems = computed(() => {
  return items.value.filter(item =>
    item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

function deleteItem(item) {
  items.value = items.value.filter(i => i.id !== item.id)
}

function showInfo(item) {
  currentItem.value = item
  showModal.value = true
}

function closeModal() {
  showModal.value = false
}
</script>

<style scoped>
.manager-page-section {
  width: 100%;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  padding: 20px;
  background: url('../assets/images/bg-stars.png') no-repeat center/cover;
  color: var(--white-color);
  font-family: 'Montserrat', sans-serif;
  box-sizing: border-box;
}

.manager-wrap {
  width: 70vw;
  max-width: 1200px;
  min-width: 300px;
}

.manager-top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
  gap: 10px;
  flex-wrap: wrap;
}

.manager-top-bar input {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  color: white;
  width: 320px;
  max-width: 100%;
}

.manager-top-bar input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

h1 {
  text-align: center;
  margin-bottom: 24px;
  font-size: 24px;
  font-weight: 400;
}

.presentations-table {
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 20px;
  padding: 20px;
  box-shadow: inset 0px 0px 68px rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
}

.presentation-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  margin-bottom: 10px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  flex-wrap: wrap;
  gap: 8px;
}

.presentation-row span {
  font-size: 14px;
}

.presentation-row .name a {
  color: #fff;
  text-decoration: underline;
}

.icons {
  display: flex;
  gap: 10px;
}

.info-btn,
.delete-btn {
  background: transparent;
  border: none;
  font-size: 16px;
  cursor: pointer;
  color: white;
}

.info-btn:hover,
.delete-btn:hover {
  color: #ff5c5c;
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

/* Модальное окно */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  padding: 10px;
}

.modal-content {
  background-color: #fff;
  border-radius: 10px;
  width: 300px;
  max-width: 100%;
  color: #000;
  font-family: 'Montserrat', sans-serif;
  overflow: hidden;
}

.modal-header {
  padding: 15px;
  font-size: 18px;
  font-weight: bold;
  background-color: #f0f0f0;
  border-bottom: 1px solid #ddd;
}

.modal-body {
  padding: 15px;
}

.modal-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-size: 14px;
}

.modal-row span:first-child {
  font-weight: bold;
}

.modal-energy {
  padding: 15px;
  font-size: 18px;
  text-align: center;
  background-color: #f0f0f0;
  border-top: 1px solid #ddd;
}

/* ----- АДАПТИВ ----- */
@media (max-width: 1024px) {
  .manager-wrap {
    width: 90vw;
  }

  h1 {
    font-size: 22px;
  }
}

@media (max-width: 768px) {
  .manager-top-bar {
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
  }

  .manager-top-bar input {
    width: 100%;
  }

  .presentation-row {
    flex-direction: column;
    align-items: flex-start;
  }

  .icons {
    width: 100%;
    justify-content: flex-end;
  }
}

@media (max-width: 480px) {
  h1 {
    font-size: 18px;
  }

  .manager-top-bar input {
    padding: 8px 15px;
    font-size: 12px;
  }

  .presentation-row span {
    font-size: 12px;
  }
}
</style>
