"use client"

import { useState, useEffect } from "react"
import { toast } from "react-toastify"
import Navbar from "../components/Navbar"
import Footer from "../components/Footer"
import { ticketService } from "../services/ticketService"

export default function Dashboard() {
  const [stats, setStats] = useState({
    total: 0,
    open: 0,
    inProgress: 0,
    closed: 0,
  })

  useEffect(() => {
    const tickets = ticketService.getAllTickets()
    setStats({
      total: tickets.length,
      open: tickets.filter((t) => t.status === "open").length,
      inProgress: tickets.filter((t) => t.status === "in_progress").length,
      closed: tickets.filter((t) => t.status === "closed").length,
    })
  }, [])

  const statCards = [
    { label: "Total Tickets", value: stats.total, color: "bg-blue-600" },
    { label: "Open", value: stats.open, color: "bg-emerald-600" },
    { label: "In Progress", value: stats.inProgress, color: "bg-amber-600" },
    { label: "Closed", value: stats.closed, color: "bg-slate-600" },
  ]

  return (
    <div className="min-h-screen flex flex-col bg-slate-900">
      <Navbar />

      <main className="flex-1 px-4 py-12">
        <div className="max-w-6xl mx-auto">
          <div className="mb-12">
            <h1 className="text-4xl font-bold text-white mb-2">Dashboard</h1>
            <p className="text-slate-400">Welcome back! Here's your ticket overview.</p>
          </div>

          {/* Stats Grid */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            {statCards.map((card) => (
              <div key={card.label} className={`${card.color} rounded-lg p-6 text-white shadow-lg`}>
                <p className="text-sm font-medium opacity-90">{card.label}</p>
                <p className="text-4xl font-bold mt-2">{card.value}</p>
              </div>
            ))}
          </div>

          {/* Quick Actions */}
          <div className="bg-slate-800 rounded-lg p-8 border border-slate-700">
            <h2 className="text-2xl font-bold text-white mb-6">Quick Actions</h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <button
                onClick={() => toast.info("Navigate to Tickets page to create a new ticket")}
                className="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
              >
                Create Ticket
              </button>
              <button
                onClick={() => toast.info("View all tickets on the Tickets page")}
                className="px-6 py-3 bg-slate-700 text-white font-semibold rounded-lg hover:bg-slate-600 transition-colors"
              >
                View All Tickets
              </button>
              <button
                onClick={() => toast.info("Feature coming soon!")}
                className="px-6 py-3 bg-slate-700 text-white font-semibold rounded-lg hover:bg-slate-600 transition-colors"
              >
                Generate Report
              </button>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  )
}
