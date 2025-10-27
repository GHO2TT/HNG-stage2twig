<?php
// php-app-simple/public/index.php - Simplified version without Twig

session_start();

// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Include helpers and services
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/AuthService.php';
require_once __DIR__ . '/../includes/TicketService.php';

$authService = new AuthService();
$ticketService = new TicketService();

// Routes
switch ($uri) {
    case '/':
        include __DIR__ . '/../views/landing.php';
        break;
    
    case '/auth/login':
        if ($method === 'POST') {
            handleLogin($authService);
        } else {
            include __DIR__ . '/../views/login.php';
        }
        break;
    
    case '/auth/signup':
        if ($method === 'POST') {
            handleSignup($authService);
        } else {
            include __DIR__ . '/../views/signup.php';
        }
        break;
    
    case '/auth/logout':
        $authService->logout();
        redirect('/', 'Logged out successfully!');
        break;
    
    case '/dashboard':
        requireAuth($authService);
        $stats = $ticketService->getStats();
        include __DIR__ . '/../views/dashboard.php';
        break;
    
    case '/tickets':
        requireAuth($authService);
        if ($method === 'POST') {
            handleCreateTicket($ticketService);
        } else {
            $filter = $_GET['filter'] ?? 'all';
            $tickets = $ticketService->getAllTickets();
            if ($filter !== 'all') {
                $tickets = array_filter($tickets, fn($t) => $t['status'] === $filter);
            }
            $editingTicket = $_SESSION['editing_ticket'] ?? null;
            include __DIR__ . '/../views/tickets.php';
        }
        break;
    
    case (preg_match('/^\/tickets\/(\d+)\/edit$/', $uri, $matches) ? true : false):
        requireAuth($authService);
        if ($method === 'POST') {
            handleUpdateTicket($ticketService, $matches[1]);
        } else {
            $ticket = $ticketService->getTicketById($matches[1]);
            if ($ticket) {
                $_SESSION['editing_ticket'] = $ticket;
            }
            redirect('/tickets');
        }
        break;
    
    case (preg_match('/^\/tickets\/(\d+)\/delete$/', $uri, $matches) ? true : false):
        requireAuth($authService);
        $ticketService->deleteTicket($matches[1]);
        redirect('/tickets', 'Ticket deleted successfully!');
        break;
    
    default:
        header("Location: /");
        exit;
}

// Handler functions
function handleLogin($authService) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        redirect('/auth/login', 'Please fill in all fields', 'error');
    }
    
    if ($authService->login($email, $password)) {
        redirect('/dashboard', 'Login successful!');
    } else {
        redirect('/auth/login', 'Invalid email or password', 'error');
    }
}

function handleSignup($authService) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    if (empty($email) || empty($password) || empty($confirmPassword)) {
        redirect('/auth/signup', 'Please fill in all fields', 'error');
    }
    
    if ($password !== $confirmPassword) {
        redirect('/auth/signup', 'Passwords do not match', 'error');
    }
    
    if (strlen($password) < 6) {
        redirect('/auth/signup', 'Password must be at least 6 characters', 'error');
    }
    
    if ($authService->signup($email, $password)) {
        redirect('/dashboard', 'Account created successfully!');
    } else {
        redirect('/auth/signup', 'Email already exists', 'error');
    }
}

function handleCreateTicket($ticketService) {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $status = $_POST['status'] ?? 'open';
    $priority = $_POST['priority'] ?? 'medium';
    
    if (empty(trim($title)) || empty(trim($description))) {
        redirect('/tickets', 'Please fill in all fields', 'error');
    }
    
    $ticketService->createTicket([
        'title' => $title,
        'description' => $description,
        'status' => $status,
        'priority' => $priority
    ]);
    
    redirect('/tickets', 'Ticket created successfully!');
}

function handleUpdateTicket($ticketService, $id) {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $status = $_POST['status'] ?? 'open';
    $priority = $_POST['priority'] ?? 'medium';
    
    if (empty(trim($title)) || empty(trim($description))) {
        redirect('/tickets', 'Please fill in all fields', 'error');
    }
    
    $ticketService->updateTicket($id, [
        'title' => $title,
        'description' => $description,
        'status' => $status,
        'priority' => $priority
    ]);
    
    unset($_SESSION['editing_ticket']);
    redirect('/tickets', 'Ticket updated successfully!');
}
