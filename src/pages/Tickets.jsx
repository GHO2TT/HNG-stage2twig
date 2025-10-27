"use client"

import { useState, useEffect } from "react"
import { toast } from "react-toastify"
import Navbar from "../components/Navbar"
import Footer from "../components/Footer"
import TicketForm from "../components/TicketForm"
import TicketList from "../components/TicketList"
import { ticketService } from "../services/ticketService"

export default function Tickets() {
  const [tickets, setTickets] = useState([])
  const [showForm, setShowForm] = useState(false)
  const [editingId, setEditingId] = useState(null)
  const [filter, setFilter] = useState("all")

  useEffect(() => {
    loadTickets()
  }, [])

  const loadTickets = () => {
    const allTickets = ticketService.getAllTickets()
    setTickets(allTickets)
  }

  const handleAddTicket = (ticketData) => {
    if (editingId) {
      ticketService.updateTicket(editingId, ticketData)
      toast.success("Ticket updated successfully!")
      setEditingId(null)
    } else {
      ticketService.createTicket(ticketData)
      toast.success("Ticket created successfully!")
    }
    setShowForm(false)
    loadTickets()
  }

  const handleDeleteTicket = (id) => {
    if (window.confirm("Are you sure you want to delete this ticket?")) {
      ticketService.deleteTicket(id)
      toast.success("Ticket deleted successfully!")
      loadTickets()
    }
  }

  const handleEditTicket = (ticket) => {
    setEditingId(ticket.id)
    setShowForm(true)
  }

  const filteredTickets = filter === "all" ? tickets : tickets.filter((t) => t.status === filter)

  return (
    <div className="min-h-screen flex flex-col bg-slate-900">
      <Navbar />

      <main className="flex-1 px-4 py-12">
        <div className="max-w-6xl mx-auto">
          <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
              <h1 className="text-4xl font-bold text-white mb-2">Tickets</h1>
              <p className="text-slate-400">Manage and track all your support tickets</p>
            </div>
            <button
              onClick={() => {
                setEditingId(null)
                setShowForm(!showForm)
              }}
              className="mt-4 md:mt-0 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
            >
              {showForm ? "Cancel" : "New Ticket"}
            </button>
          </div>

          {/* Form */}
          {showForm && (
            <div className="mb-8">
              <TicketForm
                onSubmit={handleAddTicket}
                editingTicket={editingId ? tickets.find((t) => t.id === editingId) : null}
              />
            </div>
          )}

          {/* Filter */}
          <div className="flex gap-2 mb-8 flex-wrap">
            {["all", "open", "in_progress", "closed"].map((status) => (
              <button
                key={status}
                onClick={() => setFilter(status)}
                className={`px-4 py-2 rounded-lg font-medium transition-colors ${
                  filter === status ? "bg-blue-600 text-white" : "bg-slate-800 text-slate-300 hover:bg-slate-700"
                }`}
              >
                {status === "all"
                  ? "All"
                  : status === "in_progress"
                    ? "In Progress"
                    : status.charAt(0).toUpperCase() + status.slice(1)}
              </button>
            ))}
          </div>

          {/* Tickets List */}
          <TicketList tickets={filteredTickets} onEdit={handleEditTicket} onDelete={handleDeleteTicket} />
        </div>
      </main>

      <Footer />
    </div>
  )
}
