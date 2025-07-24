<template>
  <section class="history-page-section">
    <div v-if="isLoading" class="loading-spinner">
      <div class="spinner"></div>
    </div>
    <div v-else class="history-wrap">
      <h1 class="fade-up" style="animation-delay: 0.2s">История генераций</h1>
      <div class="history-table fade-up" style="animation-delay: 0.4s">
        <HistoryItem
          v-for="item in items"
          :key="item.id"
          :item="item"
          @edit="openModal('edit', item)"
          @delete="openModal('delete', item)"
        />
      </div>
      <div class="button fade-up" style="animation-delay: 0.6s">
        <router-link to="/generate">Генерировать</router-link>
      </div>
    </div>
    <transition name="modal-fade">
      <Modal
        v-if="modal.isOpen"
        v-model:isOpen="modal.isOpen"
        :title="modal.title"
        :value="modal.value"
        :inputs="modal.inputs"
        :mode="modal.field"
        :currentItemName="modal.currentItemName"
        :onClose="closeModal"
        :onSubmit="handleModalSubmit"
        :onDelete="handleModalDelete"
      />
    </transition>
  </section>
</template>

<script>
import HistoryItem from '../components/History/HistoryItem.vue'
import Modal from '@/components/History/Modal.vue'
import historyService from '@/services/historyService.js'
import authService from '@/services/authService.js'

export default {
  name: 'HistoryPage',
  components: { HistoryItem, Modal },
  data() {
    return {
      userId: null,
      items: [], // массив для данных чатов
      isLoading: false, // состояние загрузки
      modal: {
        isOpen: false,
        title: '',
        inputs: [],
        field: '',
        currentItemName: '',
        currentItem: null,
      },
    }
  },
  async created() {
    await this.initializePage()
  },
  methods: {
    async initializePage() {
      this.isLoading = true
      try {
        await this.getUserId()
        await this.loadChatList()
      } catch (error) {
        console.error('Ошибка при инициализации страницы:', error)
        this.$router.push('/login') // Перенаправление на логин при ошибке
      } finally {
        this.isLoading = false
      }
    },
    async getUserId() {
      try {
        const currentUser = await authService.getMe()
        this.userId = currentUser.id_user
      } catch (error) {
        console.error('Ошибка при получении ID пользователя:', error)
        throw error // Пробрасываем ошибку, чтобы обработать в initializePage
      }
    },
    async loadChatList() {
      try {
        this.items = await historyService.getHistory(this.userId)
      } catch (error) {
        console.error('Ошибка при загрузке истории:', error)
        throw error // Пробрасываем ошибку, чтобы обработать в initializePage
      }
    },
    openModal(mode, item) {
      const title = mode === 'edit' ? 'Редактировать чат' : 'Удалить чат'
      this.modal = {
        isOpen: true,
        title,
        inputs: mode === 'edit' ? [{ label: 'Название чата', value: item.name, key: 'name' }] : [],
        field: mode,
        currentItemName: item.name,
        currentItem: item,
        value: item.name,
      }
    },
    closeModal() {
      this.modal.isOpen = false
    },
    async handleModalSubmit(value) {
      try {
        await historyService.updateChat(this.modal.currentItem.id, value)
        const index = this.items.findIndex((item) => item.id === this.modal.currentItem.id)
        if (index !== -1) {
          this.items[index].name = value
        }
        this.closeModal()
      } catch (error) {
        console.error('Ошибка при обновлении чата:', error)
      }
    },
    async handleModalDelete() {
      try {
        await historyService.deleteChat(this.modal.currentItem.id)
        this.items = this.items.filter((item) => item.id !== this.modal.currentItem.id)
        this.closeModal()
      } catch (error) {
        console.error('Ошибка при удалении чата:', error)
      }
    },
  },
}
</script>

<style scoped>
.history-page-section {
  width: 100vw;
  height: 90vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.history-wrap {
  width: 50vw;
  height: fit-content;
}

.history-page-section h1 {
  font-size: 24px;
  font-weight: 400;
  line-height: 120%;
  text-align: center;
  color: var(--white-color);
  margin-bottom: 24px;
}

.history-table {
  max-height: 296px;
  margin-bottom: 24px;
  background-color: rgba(255, 255, 255, 0.2);
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

.history-page-section .button {
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
.history-page-section .button > * {
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

.modal-fade-enter-active,
.modal-fade-leave-active {
  transition: all 0.4s ease;
}
.modal-fade-enter-from,
.modal-fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.loading-spinner {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: var(--white-color);
  font-family: 'Montserrat', sans-serif;
  font-size: 18px;
}

.spinner {
  width: 56px;
  height: 56px;
  border: 5px solid rgba(255, 255, 255, 0.3); /* Полупрозрачная дуга (оставшаяся часть) */
  border-top: 5px solid var(--white-color); /* Основная видимая часть дуги */
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 16px;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
