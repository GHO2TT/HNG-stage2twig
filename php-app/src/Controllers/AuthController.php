<?php
// php-app/src/Controllers/AuthController.php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
    private $twig;
    private $authService;
    
    public function __construct($twig)
    {
        $this->twig = $twig;
        $this->authService = new AuthService();
    }
    
    public function showLogin()
    {
        if ($this->authService->isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }
        
        echo $this->twig->render('auth/login.twig', [
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null
        ]);
        
        unset($_SESSION['error'], $_SESSION['success']);
    }
    
    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Please fill in all fields';
            header('Location: /auth/login');
            exit;
        }
        
        if ($this->authService->login($email, $password)) {
            $_SESSION['success'] = 'Login successful!';
            header('Location: /dashboard');
        } else {
            $_SESSION['error'] = 'Invalid email or password';
            header('Location: /auth/login');
        }
        exit;
    }
    
    public function showSignup()
    {
        if ($this->authService->isAuthenticated()) {
            header('Location: /dashboard');
            exit;
        }
        
        echo $this->twig->render('auth/signup.twig', [
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null
        ]);
        
        unset($_SESSION['error'], $_SESSION['success']);
    }
    
    public function signup()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if (empty($email) || empty($password) || empty($confirmPassword)) {
            $_SESSION['error'] = 'Please fill in all fields';
            header('Location: /auth/signup');
            exit;
        }
        
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = 'Passwords do not match';
            header('Location: /auth/signup');
            exit;
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters';
            header('Location: /auth/signup');
            exit;
        }
        
        if ($this->authService->signup($email, $password)) {
            $_SESSION['success'] = 'Account created successfully!';
            header('Location: /dashboard');
        } else {
            $_SESSION['error'] = 'Email already exists';
            header('Location: /auth/signup');
        }
        exit;
    }
    
    public function logout()
    {
        $this->authService->logout();
        session_start();
        $_SESSION['success'] = 'Logged out successfully!';
        header('Location: /');
        exit;
    }
}
