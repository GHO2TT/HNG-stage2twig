<nav class="bg-slate-800 border-b border-slate-700 sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="/" class="text-2xl font-bold text-blue-400 hover:text-blue-300">
            TicketApp
        </a>

        <div class="flex items-center gap-6">
            <?php if (isAuthenticated()): ?>
                <a href="/dashboard" class="text-slate-300 hover:text-white transition-colors">
                    Dashboard
                </a>
                <a href="/tickets" class="text-slate-300 hover:text-white transition-colors">
                    Tickets
                </a>
                <a href="/auth/logout" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Logout
                </a>
            <?php else: ?>
                <a href="/auth/login" class="text-slate-300 hover:text-white transition-colors">
                    Login
                </a>
                <a href="/auth/signup" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Sign Up
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
