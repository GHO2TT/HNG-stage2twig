<?php
// php-app/src/Services/AuthService.php

namespace App\Services;

class AuthService
{
    private $usersFile;
    
    public function __construct()
    {
        $dataPath = __DIR__ . '/../../data';
        if (!file_exists($dataPath)) {
            mkdir($dataPath, 0777, true);
        }
        $this->usersFile = $dataPath . '/users.json';
        
        if (!file_exists($this->usersFile)) {
            file_put_contents($this->usersFile, json_encode([]));
        }
    }
    
    private function getUsers()
    {
        $content = file_get_contents($this->usersFile);
        return json_decode($content, true) ?: [];
    }
    
    private function saveUsers($users)
    {
        file_put_contents($this->usersFile, json_encode($users, JSON_PRETTY_PRINT));
    }
    
    public function signup($email, $password)
    {
        $users = $this->getUsers();
        
        // Check if user exists
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                return false;
            }
        }
        
        // Add new user
        $users[] = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->saveUsers($users);
        
        // Auto login
        $_SESSION['user'] = [
            'email' => $email,
            'login_time' => date('Y-m-d H:i:s')
        ];
        
        return true;
    }
    
    public function login($email, $password)
    {
        $users = $this->getUsers();
        
        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'email' => $email,
                    'login_time' => date('Y-m-d H:i:s')
                ];
                return true;
            }
        }
        
        return false;
    }
    
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }
    
    public function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }
    
    public function getCurrentUser()
    {
        return $_SESSION['user'] ?? null;
    }
}
