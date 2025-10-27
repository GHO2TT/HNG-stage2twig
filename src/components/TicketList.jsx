"use client"

const statusColors = {
  open: "bg-emerald-100 text-emerald-800",
  in_progress: "bg-amber-100 text-amber-800",
  closed: "bg-slate-100 text-slate-800",
}

const priorityColors = {
  low: "text-slate-400",
  medium: "text-blue-400",
  high: "text-red-400",
}

export default function TicketList({ tickets, onEdit, onDelete }) {
  if (tickets.length === 0) {
    return (
      <div className="bg-slate-800 rounded-lg p-12 text-center border border-slate-700">
        <p className="text-slate-400 text-lg">No tickets found. Create one to get started!</p>
      </div>
    )
  }

  return (
    <div className="space-y-4">
      {tickets.map((ticket) => (
        <div
          key={ticket.id}
          className="bg-slate-800 rounded-lg p-6 border border-slate-700 hover:border-slate-600 transition-colors"
        >
          <div className="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div className="flex-1">
              <h3 className="text-xl font-semibold text-white mb-2">{ticket.title}</h3>
              <p className="text-slate-400 mb-4">{ticket.description}</p>
              <div className="flex flex-wrap gap-3">
                <span className={`px-3 py-1 rounded-full text-sm font-medium ${statusColors[ticket.status]}`}>
                  {ticket.status === "in_progress"
                    ? "In Progress"
                    : ticket.status.charAt(0).toUpperCase() + ticket.status.slice(1)}
                </span>
                <span className={`text-sm font-medium ${priorityColors[ticket.priority]}`}>
                  Priority: {ticket.priority.charAt(0).toUpperCase() + ticket.priority.slice(1)}
                </span>
                <span className="text-slate-500 text-sm">
                  Created: {new Date(ticket.createdAt).toLocaleDateString()}
                </span>
              </div>
            </div>
            <div className="flex gap-2">
              <button
                onClick={() => onEdit(ticket)}
                className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium"
              >
                Edit
              </button>
              <button
                onClick={() => onDelete(ticket.id)}
                className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      ))}
    </div>
  )
}
