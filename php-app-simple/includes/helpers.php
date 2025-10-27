<?php
// Helper functions

function redirect($url, $message = null, $type = 'success') {
    if ($message) {
        $_SESSION[$type] = $message;
    }
    header("Location: $url");
    exit;
}

function requireAuth($authService) {
    if (!$authService->isAuthenticated()) {
        redirect('/auth/login');
    }
}

function isAuthenticated() {
    return isset($_SESSION['user']);
}

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function formatDate($date) {
    return date('M d, Y', strtotime($date));
}
