# TicketApp - PHP/Twig

A ticket management system built with **PHP 8+** and **Twig** templating engine.

## Features

- User Authentication (Signup/Login/Logout)
- Protected Routes (Dashboard & Tickets)
- Full Ticket CRUD Operations
- Status Management (Open, In Progress, Closed)
- Priority Levels (Low, Medium, High)
- Dashboard with Statistics
- Dark Theme UI with TailwindCSS
- Session-based Authentication

## Tech Stack

- **PHP 8.0+** - Backend
- **Twig 3.0** - Templating
- **TailwindCSS** - Styling
- **JSON Files** - Data Storage
- **Composer** - Dependencies

## Local Development

### Prerequisites

- PHP 8.0+
- Composer

### Setup

1. Install dependencies:

```bash
composer install
```

2. Start development server:

```bash
cd php-app/public
php -S localhost:8000
```

3. Open browser:

```
http://localhost:8000
```

## Deployment

### Railway (Recommended)

1. Push to GitHub
2. Connect repository to Railway
3. Railway auto-detects PHP and deploys

Configuration files included:

- `railway.toml`
- `.nixpacks.toml`

## Project Structure

```
php-app/
├── public/
│   ├── index.php       # Front controller
│   └── .htaccess       # URL rewriting
├── src/
│   ├── Controllers/    # HTTP handlers
│   └── Services/       # Business logic
├── views/              # Twig templates
└── data/               # JSON storage
```

## License

MIT
