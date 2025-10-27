# TicketApp - PHP/Twig Version

A complete rewrite of the React ticket management system using **PHP** and **Twig** templating engine.

## 🎯 Features

- ✅ User Authentication (Signup/Login/Logout)
- ✅ Protected Routes (Dashboard & Tickets)
- ✅ Full Ticket CRUD Operations
- ✅ Status Filtering (Open, In Progress, Closed)
- ✅ Priority Levels (Low, Medium, High)
- ✅ Dashboard Statistics
- ✅ Flash Messages (Toast Notifications)
- ✅ Dark Theme UI with TailwindCSS
- ✅ Session-based Authentication
- ✅ JSON File Storage

## 📁 Project Structure

```
php-app/
├── public/
│   ├── index.php          # Front controller & router
│   └── .htaccess          # URL rewriting
├── src/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── PageController.php
│   │   └── TicketController.php
│   └── Services/
│       ├── AuthService.php
│       └── TicketService.php
├── views/
│   ├── auth/
│   │   ├── login.twig
│   │   └── signup.twig
│   ├── components/
│   │   ├── navbar.twig
│   │   └── footer.twig
│   ├── tickets/
│   │   ├── index.twig
│   │   ├── form.twig
│   │   └── list.twig
│   ├── layout.twig
│   ├── landing.twig
│   └── dashboard.twig
└── data/
    ├── users.json         # Auto-generated
    └── tickets.json       # Auto-generated
```

## 🚀 Setup & Installation

### Prerequisites

- **PHP 8.0+** (Check with `php -v`)
- **Composer** (PHP dependency manager)

### Installation Steps

1. **Install Dependencies**

   ```bash
   composer install
   ```

2. **Start PHP Development Server**

   ```bash
   cd php-app/public
   php -S localhost:8000
   ```

3. **Open in Browser**
   ```
   http://localhost:8000
   ```

## 🔑 Authentication

- Uses **PHP Sessions** for authentication
- Passwords are hashed with `password_hash()` (bcrypt)
- User data stored in `php-app/data/users.json`

### Test Account

Just sign up with any email/password - they'll be stored locally!

## 📊 Data Storage

- **Users**: `php-app/data/users.json`
- **Tickets**: `php-app/data/tickets.json`
- Both files are auto-generated on first use

## 🎨 Tech Stack

| Technology       | Purpose               |
| ---------------- | --------------------- |
| **PHP 8.0+**     | Backend language      |
| **Twig**         | Templating engine     |
| **TailwindCSS**  | Styling (via CDN)     |
| **PHP Sessions** | Authentication        |
| **JSON Files**   | Data persistence      |
| **Composer**     | Dependency management |

## 🛣️ Routes

| Method | Route                  | Description              |
| ------ | ---------------------- | ------------------------ |
| GET    | `/`                    | Landing page             |
| GET    | `/auth/login`          | Login form               |
| POST   | `/auth/login`          | Process login            |
| GET    | `/auth/signup`         | Signup form              |
| POST   | `/auth/signup`         | Process signup           |
| GET    | `/auth/logout`         | Logout                   |
| GET    | `/dashboard`           | Dashboard (protected)    |
| GET    | `/tickets`             | View tickets (protected) |
| POST   | `/tickets`             | Create ticket            |
| GET    | `/tickets/{id}/edit`   | Load edit form           |
| POST   | `/tickets/{id}/edit`   | Update ticket            |
| GET    | `/tickets/{id}/delete` | Delete ticket            |

## 🆚 React vs PHP/Twig Comparison

| Feature           | React Version      | PHP/Twig Version           |
| ----------------- | ------------------ | -------------------------- |
| **Routing**       | React Router       | Custom PHP router          |
| **State**         | useState/useEffect | PHP Sessions & Server-side |
| **Auth**          | localStorage       | PHP Sessions               |
| **Storage**       | localStorage       | JSON files                 |
| **Templating**    | JSX                | Twig                       |
| **Notifications** | react-toastify     | Flash messages + CSS       |
| **Form Handling** | React state        | Native HTML forms          |

## 📝 Key Differences

### 1. **Server-Side Rendering**

- React: Client-side rendering (SPA)
- PHP/Twig: Server-side rendering (traditional MPA)

### 2. **Data Persistence**

- React: Browser localStorage
- PHP: JSON files on server

### 3. **Authentication**

- React: Client-side localStorage
- PHP: Server-side sessions (more secure)

### 4. **Routing**

- React: Client-side routing
- PHP: Server-side routing with redirects

## 🔧 Development

### File Structure by Concern

**Controllers** (Handle HTTP requests)

- `AuthController.php` - Authentication logic
- `PageController.php` - Static pages
- `TicketController.php` - Ticket CRUD

**Services** (Business logic)

- `AuthService.php` - User management
- `TicketService.php` - Ticket operations

**Views** (Twig templates)

- Reusable components (navbar, footer)
- Page templates with inheritance
- Form components

## 🎯 Features Implemented

✅ **Authentication**

- User signup with validation
- Login with password verification
- Session-based auth
- Protected routes

✅ **Dashboard**

- Ticket statistics
- Status breakdown
- Quick actions

✅ **Tickets Management**

- Create new tickets
- Edit existing tickets
- Delete tickets
- Filter by status
- Priority levels

✅ **UI/UX**

- Responsive design
- Dark theme
- Flash messages
- Form validation
- Confirmation dialogs

## 🚀 Production Deployment

For production, consider:

1. **Use a real database** (MySQL, PostgreSQL)
2. **Enable Twig caching**
3. **Use proper .env file** (with vlucas/phpdotenv)
4. **Configure Apache/Nginx** properly
5. **Enable HTTPS**
6. **Add CSRF protection**
7. **Implement rate limiting**

## 📦 Dependencies

```json
{
  "twig/twig": "^3.0",
  "vlucas/phpdotenv": "^5.5"
}
```

## 🎉 Ready to Use!

The PHP/Twig version is a **complete, functional recreation** of your React app with the same features, UI, and user experience - just built with server-side technologies!

---

**Built with ❤️ using PHP, Twig, and TailwindCSS**
