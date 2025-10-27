"use client"

import { Link, useNavigate } from "react-router-dom"
import { authService } from "../services/authService"
import { toast } from "react-toastify"

export default function Navbar() {
  const navigate = useNavigate()
  const isAuthenticated = authService.isAuthenticated()

  const handleLogout = () => {
    authService.logout()
    toast.success("Logged out successfully!")
    navigate("/")
  }

  return (
    <nav className="bg-slate-800 border-b border-slate-700 sticky top-0 z-50">
      <div className="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <Link to="/" className="text-2xl font-bold text-blue-400 hover:text-blue-300">
          TicketApp
        </Link>

        <div className="flex items-center gap-6">
          {isAuthenticated ? (
            <>
              <Link to="/dashboard" className="text-slate-300 hover:text-white transition-colors">
                Dashboard
              </Link>
              <Link to="/tickets" className="text-slate-300 hover:text-white transition-colors">
                Tickets
              </Link>
              <button
                onClick={handleLogout}
                className="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
              >
                Logout
              </button>
            </>
          ) : (
            <>
              <Link to="/auth/login" className="text-slate-300 hover:text-white transition-colors">
                Login
              </Link>
              <Link
                to="/auth/signup"
                className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
              >
                Sign Up
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  )
}
