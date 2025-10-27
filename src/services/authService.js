const STORAGE_KEY = "ticketapp_session"
const USERS_KEY = "ticketapp_users"

export const authService = {
  signup(email, password) {
    const users = JSON.parse(localStorage.getItem(USERS_KEY) || "[]")

    if (users.some((u) => u.email === email)) {
      return false
    }

    users.push({ email, password })
    localStorage.setItem(USERS_KEY, JSON.stringify(users))

    const session = { email, loginTime: new Date().toISOString() }
    localStorage.setItem(STORAGE_KEY, JSON.stringify(session))

    return true
  },

  login(email, password) {
    const users = JSON.parse(localStorage.getItem(USERS_KEY) || "[]")
    const user = users.find((u) => u.email === email && u.password === password)

    if (!user) {
      return false
    }

    const session = { email, loginTime: new Date().toISOString() }
    localStorage.setItem(STORAGE_KEY, JSON.stringify(session))

    return true
  },

  logout() {
    localStorage.removeItem(STORAGE_KEY)
  },

  isAuthenticated() {
    return !!localStorage.getItem(STORAGE_KEY)
  },

  getCurrentUser() {
    const session = localStorage.getItem(STORAGE_KEY)
    return session ? JSON.parse(session) : null
  },
}
