import api from '@/services/api.js'

class HistoryService {
  async getHistory(userId) {
    const response = await api.get('/api/history', {
      params: { id_user: userId },
    })
    return response.data
  }

  async updateChat(chatId, chatName) {
    const response = await api.put(`/api/chats/${chatId}`, {
      chat_name: chatName,
    })
    return response.data
  }

  async deleteChat(chatId) {
    const response = await api.delete(`/api/chats/${chatId}`)
    return response.data
  }
}

const historyService = new HistoryService()

export default historyService
