<?php
// php-app/src/Controllers/TicketController.php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\TicketService;

class TicketController
{
    private $twig;
    private $authService;
    private $ticketService;
    
    public function __construct($twig)
    {
        $this->twig = $twig;
        $this->authService = new AuthService();
        $this->ticketService = new TicketService();
    }
    
    private function requireAuth()
    {
        if (!$this->authService->isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }
    }
    
    public function index()
    {
        $this->requireAuth();
        
        $filter = $_GET['filter'] ?? 'all';
        $tickets = $this->ticketService->getAllTickets();
        
        if ($filter !== 'all') {
            $tickets = array_filter($tickets, function($ticket) use ($filter) {
                return $ticket['status'] === $filter;
            });
        }
        
        echo $this->twig->render('tickets/index.twig', [
            'tickets' => array_values($tickets),
            'filter' => $filter,
            'success' => $_SESSION['success'] ?? null,
            'error' => $_SESSION['error'] ?? null,
            'editingTicket' => $_SESSION['editing_ticket'] ?? null
        ]);
        
        unset($_SESSION['success'], $_SESSION['error'], $_SESSION['editing_ticket']);
    }
    
    public function create()
    {
        $this->requireAuth();
        
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'open';
        $priority = $_POST['priority'] ?? 'medium';
        
        if (empty(trim($title)) || empty(trim($description))) {
            $_SESSION['error'] = 'Please fill in all fields';
            header('Location: /tickets');
            exit;
        }
        
        $this->ticketService->createTicket([
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'priority' => $priority
        ]);
        
        $_SESSION['success'] = 'Ticket created successfully!';
        header('Location: /tickets');
        exit;
    }
    
    public function update($id)
    {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ticket = $this->ticketService->getTicketById($id);
            if ($ticket) {
                $_SESSION['editing_ticket'] = $ticket;
            }
            header('Location: /tickets');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? 'open';
            $priority = $_POST['priority'] ?? 'medium';
            
            if (empty(trim($title)) || empty(trim($description))) {
                $_SESSION['error'] = 'Please fill in all fields';
                header('Location: /tickets');
                exit;
            }
            
            $this->ticketService->updateTicket($id, [
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'priority' => $priority
            ]);
            
            $_SESSION['success'] = 'Ticket updated successfully!';
            header('Location: /tickets');
            exit;
        }
    }
    
    public function delete($id)
    {
        $this->requireAuth();
        
        $this->ticketService->deleteTicket($id);
        $_SESSION['success'] = 'Ticket deleted successfully!';
        header('Location: /tickets');
        exit;
    }
}
