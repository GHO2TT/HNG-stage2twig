<?php
// php-app/src/Controllers/PageController.php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\TicketService;

class PageController
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
    
    public function landing()
    {
        echo $this->twig->render('landing.twig', [
            'success' => $_SESSION['success'] ?? null
        ]);
        
        unset($_SESSION['success']);
    }
    
    public function dashboard()
    {
        if (!$this->authService->isAuthenticated()) {
            header('Location: /auth/login');
            exit;
        }
        
        $stats = $this->ticketService->getStats();
        
        echo $this->twig->render('dashboard.twig', [
            'stats' => $stats,
            'success' => $_SESSION['success'] ?? null
        ]);
        
        unset($_SESSION['success']);
    }
}
