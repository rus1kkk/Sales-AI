import api from '@/services/api.js'

class AuthService {
  async login(credentials) {
    const response = await api.post('/api/login', credentials)

    const success = response.data.success
    const token = response.data.data.token
    const user = response.data.data.user

    localStorage.setItem('token', token)

    return { success, token, user }
  }

  async register(userData) {
    const response = await api.post('/api/register', userData)

    const success = response.data.success
    const token = response.data.data.token
    const user = response.data.data.user

    localStorage.setItem('token', token)

    return { success, token, user }
  }

  async logout() {
    if (localStorage.getItem('token')) {
      await api.post('/api/logout')

      localStorage.removeItem('token')
    }
  }

  async getMe() {
    const token = localStorage.getItem('token')

    if (!token) {
      return
    }

    const response = await api.get('/api/me')
    return response.data.data.user
  }

  async changePassword(values) {
    const passwordData = {
      current_password: values[0],
      password: values[1],
      password_confirmation: values[2],
    }

    const response = await api.post('/api/password/change', passwordData)

    const success = response.data.success
    const token = response.data.data.token
    const user = response.data.data.user

    localStorage.setItem('token', token)

    return { success, token, user }
  }

  async updateProfile(field, value) {
    const profileData = {
      [field]: value,
    }

    const response = await api.patch('/api/profile/update', profileData)
    const { user } = response.data

    return user
  }
}

const authService = new AuthService()

export default authService
