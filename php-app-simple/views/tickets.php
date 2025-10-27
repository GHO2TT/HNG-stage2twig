<?php
$title = 'Tickets - TicketApp';
unset($_SESSION['success'], $_SESSION['error']);
ob_start();
?>

<div class="min-h-screen flex flex-col bg-slate-900">
    <main class="flex-1 px-4 py-12">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Tickets</h1>
                    <p class="text-slate-400">Manage and track all your support tickets</p>
                </div>
                <button
                    onclick="toggleForm()"
                    class="mt-4 md:mt-0 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
                >
                    <span id="formToggleText">New Ticket</span>
                </button>
            </div>

            <!-- Form -->
            <div id="ticketForm" class="mb-8 hidden">
                <form method="POST" action="<?php echo $editingTicket ? '/tickets/' . $editingTicket['id'] . '/edit' : '/tickets'; ?>" class="bg-slate-800 rounded-lg p-6 border border-slate-700">
                    <h2 class="text-2xl font-bold text-white mb-6">
                        <?php echo $editingTicket ? 'Edit Ticket' : 'Create New Ticket'; ?>
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-300 mb-2">Title</label>
                            <input
                                id="title"
                                type="text"
                                name="title"
                                value="<?php echo $editingTicket ? e($editingTicket['title']) : ''; ?>"
                                required
                                class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                placeholder="Ticket title"
                            />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                required
                                class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                placeholder="Describe the issue..."
                            ><?php echo $editingTicket ? e($editingTicket['description']) : ''; ?></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-300 mb-2">Status</label>
                                <select
                                    id="status"
                                    name="status"
                                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                >
                                    <option value="open" <?php echo ($editingTicket && $editingTicket['status'] === 'open') ? 'selected' : ''; ?>>Open</option>
                                    <option value="in_progress" <?php echo ($editingTicket && $editingTicket['status'] === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                                    <option value="closed" <?php echo ($editingTicket && $editingTicket['status'] === 'closed') ? 'selected' : ''; ?>>Closed</option>
                                </select>
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-slate-300 mb-2">Priority</label>
                                <select
                                    id="priority"
                                    name="priority"
                                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                >
                                    <option value="low" <?php echo ($editingTicket && $editingTicket['priority'] === 'low') ? 'selected' : ''; ?>>Low</option>
                                    <option value="medium" <?php echo ($editingTicket && $editingTicket['priority'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                                    <option value="high" <?php echo ($editingTicket && $editingTicket['priority'] === 'high') ? 'selected' : ''; ?>>High</option>
                                </select>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            <?php echo $editingTicket ? 'Update Ticket' : 'Create Ticket'; ?>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filter -->
            <div class="flex gap-2 mb-8 flex-wrap">
                <a href="/tickets?filter=all" class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo $filter === 'all' ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'; ?>">
                    All
                </a>
                <a href="/tickets?filter=open" class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo $filter === 'open' ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'; ?>">
                    Open
                </a>
                <a href="/tickets?filter=in_progress" class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo $filter === 'in_progress' ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'; ?>">
                    In Progress
                </a>
                <a href="/tickets?filter=closed" class="px-4 py-2 rounded-lg font-medium transition-colors <?php echo $filter === 'closed' ? 'bg-blue-600 text-white' : 'bg-slate-800 text-slate-300 hover:bg-slate-700'; ?>">
                    Closed
                </a>
            </div>

            <!-- Tickets List -->
            <?php if (empty($tickets)): ?>
                <div class="bg-slate-800 rounded-lg p-12 text-center border border-slate-700">
                    <p class="text-slate-400 text-lg">No tickets found. Create one to get started!</p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php foreach ($tickets as $ticket): ?>
                        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700 hover:border-slate-600 transition-colors">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-white mb-2"><?php echo e($ticket['title']); ?></h3>
                                    <p class="text-slate-400 mb-4"><?php echo e($ticket['description']); ?></p>
                                    <div class="flex flex-wrap gap-3">
                                        <?php
                                        $statusClass = match($ticket['status']) {
                                            'open' => 'bg-emerald-100 text-emerald-800',
                                            'in_progress' => 'bg-amber-100 text-amber-800',
                                            default => 'bg-slate-100 text-slate-800'
                                        };
                                        $statusLabel = $ticket['status'] === 'in_progress' ? 'In Progress' : ucfirst($ticket['status']);
                                        ?>
                                        <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo $statusClass; ?>">
                                            <?php echo $statusLabel; ?>
                                        </span>
                                        
                                        <?php
                                        $priorityClass = match($ticket['priority']) {
                                            'low' => 'text-slate-400',
                                            'medium' => 'text-blue-400',
                                            default => 'text-red-400'
                                        };
                                        ?>
                                        <span class="text-sm font-medium <?php echo $priorityClass; ?>">
                                            Priority: <?php echo ucfirst($ticket['priority']); ?>
                                        </span>
                                        
                                        <span class="text-slate-500 text-sm">
                                            Created: <?php echo formatDate($ticket['created_at']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a
                                        href="/tickets/<?php echo $ticket['id']; ?>/edit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium"
                                    >
                                        Edit
                                    </a>
                                    <button
                                        onclick="confirmDelete('<?php echo $ticket['id']; ?>')"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>
</div>

<script>
    let formVisible = <?php echo $editingTicket ? 'true' : 'false'; ?>;
    
    function toggleForm() {
        const form = document.getElementById('ticketForm');
        const toggleText = document.getElementById('formToggleText');
        formVisible = !formVisible;
        
        if (formVisible) {
            form.classList.remove('hidden');
            toggleText.textContent = 'Cancel';
        } else {
            form.classList.add('hidden');
            toggleText.textContent = 'New Ticket';
        }
    }
    
    <?php if ($editingTicket): ?>
        toggleForm();
    <?php endif; ?>
    
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this ticket?')) {
            window.location.href = '/tickets/' + id + '/delete';
        }
    }
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
?>
