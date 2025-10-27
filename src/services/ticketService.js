const TICKETS_KEY = "ticketapp_tickets"

export const ticketService = {
  getAllTickets() {
    return JSON.parse(localStorage.getItem(TICKETS_KEY) || "[]")
  },

  createTicket(ticketData) {
    const tickets = this.getAllTickets()
    const newTicket = {
      id: Date.now().toString(),
      ...ticketData,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
    }
    tickets.push(newTicket)
    localStorage.setItem(TICKETS_KEY, JSON.stringify(tickets))
    return newTicket
  },

  updateTicket(id, ticketData) {
    const tickets = this.getAllTickets()
    const index = tickets.findIndex((t) => t.id === id)

    if (index !== -1) {
      tickets[index] = {
        ...tickets[index],
        ...ticketData,
        updatedAt: new Date().toISOString(),
      }
      localStorage.setItem(TICKETS_KEY, JSON.stringify(tickets))
    }
  },

  deleteTicket(id) {
    const tickets = this.getAllTickets()
    const filtered = tickets.filter((t) => t.id !== id)
    localStorage.setItem(TICKETS_KEY, JSON.stringify(filtered))
  },

  getTicketById(id) {
    const tickets = this.getAllTickets()
    return tickets.find((t) => t.id === id)
  },
}
