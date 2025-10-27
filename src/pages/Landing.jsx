import { Link } from "react-router-dom"
import Navbar from "../components/Navbar"
import Footer from "../components/Footer"

export default function Landing() {
  return (
    <div className="min-h-screen flex flex-col bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900">
      <Navbar />

      <main className="flex-1 flex items-center justify-center px-4 py-20">
        <div className="max-w-4xl w-full text-center">
          {/* Decorative circles */}
          <div className="absolute top-20 left-10 w-32 h-32 bg-blue-500 rounded-full opacity-10 blur-3xl"></div>
          <div className="absolute bottom-40 right-10 w-40 h-40 bg-emerald-500 rounded-full opacity-10 blur-3xl"></div>

          {/* Hero content */}
          <div className="relative z-10">
            <h1 className="text-5xl md:text-7xl font-bold text-white mb-6 text-balance">
              Manage Your Tickets with Ease
            </h1>

            <p className="text-xl md:text-2xl text-slate-300 mb-12 text-balance">
              A modern ticket management system built for teams. Track, organize, and resolve issues efficiently.
            </p>

            {/* Wavy SVG background effect */}
            <svg className="w-full h-32 mb-12 opacity-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
              <path
                d="M0,50 Q300,0 600,50 T1200,50 L1200,120 L0,120 Z"
                fill="currentColor"
                className="text-blue-500"
              ></path>
            </svg>

            {/* CTA Buttons */}
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                to="/auth/login"
                className="px-8 py-3 bg-white text-slate-900 font-semibold rounded-lg hover:bg-slate-100 transition-colors"
              >
                Login
              </Link>
              <Link
                to="/auth/signup"
                className="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors border border-blue-500"
              >
                Get Started
              </Link>
            </div>
          </div>
        </div>
      </main>

      <Footer />
    </div>
  )
}
