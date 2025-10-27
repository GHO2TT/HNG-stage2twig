<?php
// php-app/public/index.php - Front Controller

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

// Initialize Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => $_ENV['APP_ENV'] === 'development',
]);

// Add global variables
$twig->addGlobal('session', $_SESSION);

// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Include controllers
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/TicketController.php';
require_once __DIR__ . '/../src/Controllers/PageController.php';

use App\Controllers\AuthController;
use App\Controllers\TicketController;
use App\Controllers\PageController;

$authController = new AuthController($twig);
$ticketController = new TicketController($twig);
$pageController = new PageController($twig);

// Routes
switch ($uri) {
    case '/':
        $pageController->landing();
        break;
    
    case '/auth/login':
        if ($method === 'POST') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;
    
    case '/auth/signup':
        if ($method === 'POST') {
            $authController->signup();
        } else {
            $authController->showSignup();
        }
        break;
    
    case '/auth/logout':
        $authController->logout();
        break;
    
    case '/dashboard':
        $pageController->dashboard();
        break;
    
    case '/tickets':
        if ($method === 'POST') {
            $ticketController->create();
        } else {
            $ticketController->index();
        }
        break;
    
    case (preg_match('/^\/tickets\/(\d+)\/edit$/', $uri, $matches) ? true : false):
        $ticketController->update($matches[1]);
        break;
    
    case (preg_match('/^\/tickets\/(\d+)\/delete$/', $uri, $matches) ? true : false):
        $ticketController->delete($matches[1]);
        break;
    
    default:
        header("Location: /");
        exit;
}
