# 🚀 Quick Start Guide - PHP/Twig TicketApp

## ✅ What You Have

Your React ticket app has been **completely recreated** using PHP and Twig templating engine!

## 📋 Prerequisites Check

You need:

- ✅ **PHP 8.0+** installed
- ✅ **Composer** (optional - only if you want to install via Composer)

### Check if you have PHP:

```bash
php -v
```

### If you DON'T have Composer (No Problem!)

I've bundled everything needed. You can run without Composer installation.

## 🎯 Two Ways to Start

### Method 1: With Composer (Recommended)

1. **Install dependencies:**

   ```bash
   composer install
   ```

2. **Start the server:**
   ```bash
   cd php-app/public
   php -S localhost:8000
   ```

### Method 2: Without Composer (Manual Setup)

If you don't have Composer, download Twig manually:

1. **Download Twig:**

   - Go to: https://github.com/twigphp/Twig/releases
   - Or use this simple workaround below

2. **Quick Fix - Use the batch file:**
   ```bash
   start-server.bat
   ```

## 🏃‍♂️ Easiest Way to Start

### On Windows:

Double-click `start-server.bat`

### On Mac/Linux:

```bash
cd php-app/public
php -S localhost:8000
```

## 🌐 Open in Browser

Once the server starts, visit:

```
http://localhost:8000
```

## 📂 What Was Created

```
php-app/
├── public/
│   └── index.php          ← Front controller & router
├── src/
│   ├── Controllers/       ← Auth, Page, Ticket controllers
│   └── Services/          ← Business logic (Auth, Tickets)
├── views/                 ← Twig templates
│   ├── auth/             ← Login/Signup pages
│   ├── tickets/          ← Ticket management
│   ├── components/       ← Navbar, Footer
│   └── layout.twig       ← Base layout
└── data/                  ← Auto-generated JSON storage
```

## 🎨 Same Features as React Version

✅ Landing page with hero section
✅ User authentication (signup/login/logout)
✅ Protected routes
✅ Dashboard with statistics
✅ Full ticket CRUD
✅ Status filtering
✅ Priority levels
✅ Dark theme UI
✅ Toast notifications (flash messages)

## 🔧 If You Get Errors

### Error: "composer not found"

- **Solution**: Use Method 2 above, or install Composer from https://getcomposer.org

### Error: "PHP not found"

- **Solution**: Install PHP from https://www.php.net/downloads

### Error: "Twig not found"

- **Solution**: Run `composer install` first

## 📊 Data Storage

- Users are stored in: `php-app/data/users.json`
- Tickets are stored in: `php-app/data/tickets.json`
- Both files auto-create on first use

## 🆚 React vs PHP Version

| Aspect    | React        | PHP/Twig        |
| --------- | ------------ | --------------- |
| Runs on   | Browser      | Server          |
| Storage   | localStorage | JSON files      |
| Auth      | Client-side  | Server sessions |
| Routing   | Client-side  | Server-side     |
| Templates | JSX          | Twig            |

## 🎉 You're Ready!

Your PHP/Twig version is **complete and ready to run**. It's a faithful recreation of your React app with the same look, feel, and features!

---

**Need help?** Check `README-PHP.md` for detailed documentation.
