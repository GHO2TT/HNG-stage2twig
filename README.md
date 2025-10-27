# 🎫 TicketApp - Full-Stack Ticket Management System

A modern, full-featured ticket management system available in **two implementations**: React (SPA) and PHP (Server-side).

---

## 🌟 Overview

TicketApp is a complete ticket management solution with user authentication, CRUD operations, status tracking, and priority management. This repository contains both a **React frontend application** and **two PHP backend versions** - giving you the flexibility to choose your preferred tech stack.

---

## 📦 What's Included

This repository contains **THREE complete applications**:

### 1️⃣ **React Version** (Original SPA)

- **Location:** `/src`
- **Tech Stack:** React 18, Vite, TailwindCSS, React Router
- **Storage:** Browser localStorage
- **Port:** 5173

### 2️⃣ **PHP + Twig Version** (Professional)

- **Location:** `/php-app`
- **Tech Stack:** PHP 8+, Twig templating, TailwindCSS
- **Storage:** JSON files on server
- **Port:** 8000
- **Requirements:** Composer

### 3️⃣ **Simple PHP Version** (No Dependencies)

- **Location:** `/php-app-simple`
- **Tech Stack:** Pure PHP, Native templates, TailwindCSS
- **Storage:** JSON files on server
- **Port:** 8000
- **Requirements:** PHP only (no Composer needed!)

---

## ✨ Features

All three versions include identical features:

- ✅ **User Authentication**

  - Signup with email & password
  - Login with validation
  - Session management
  - Protected routes

- ✅ **Dashboard**

  - Ticket statistics overview
  - Status breakdown (Open, In Progress, Closed)
  - Quick action buttons

- ✅ **Ticket Management**

  - Create new tickets
  - Edit existing tickets
  - Delete tickets
  - Filter by status
  - Priority levels (Low, Medium, High)
  - Timestamps for creation & updates

- ✅ **Modern UI/UX**
  - Dark theme design
  - Responsive layout (mobile-friendly)
  - Toast/Flash notifications
  - Smooth transitions
  - Hero landing page

---

## 🚀 Quick Start

### Choose Your Version:

<details>
<summary><b>Option 1: React Version (Recommended for SPAs)</b></summary>

**Prerequisites:**

- Node.js 16+
- npm or pnpm

**Installation:**

```bash
# Install dependencies
npm install

# Start development server
npm run dev

# Open browser
http://localhost:5173
```

**Build for production:**

```bash
npm run build
npm run preview
```

</details>

<details>
<summary><b>Option 2: Simple PHP Version (Easiest!)</b></summary>

**Prerequisites:**

- PHP 8.0+

**Installation:**

```bash
# No installation needed!

# Just double-click:
start-simple.bat

# Or manually:
cd php-app-simple/public
php -S localhost:8000

# Open browser
http://localhost:8000
```

**✅ Zero dependencies required!**

</details>

<details>
<summary><b>Option 3: PHP + Twig Version (Professional)</b></summary>

**Prerequisites:**

- PHP 8.0+
- Composer

**Installation:**

```bash
# Install dependencies
composer install

# Start development server
cd php-app/public
php -S localhost:8000

# Open browser
http://localhost:8000
```

</details>

---

## 📂 Project Structure

```
ticket-app/
│
├── src/                          # React version
│   ├── components/              # React components
│   │   ├── Navbar.jsx
│   │   ├── Footer.jsx
│   │   ├── TicketForm.jsx
│   │   └── TicketList.jsx
│   ├── pages/                   # React pages
│   │   ├── Landing.jsx
│   │   ├── Login.jsx
│   │   ├── Signup.jsx
│   │   ├── Dashboard.jsx
│   │   └── Tickets.jsx
│   ├── services/                # Business logic
│   │   ├── authService.js
│   │   └── ticketService.js
│   ├── App.jsx                  # Main app component
│   └── main.jsx                 # Entry point
│
├── php-app/                      # PHP + Twig version
│   ├── public/
│   │   └── index.php            # Front controller
│   ├── src/
│   │   ├── Controllers/
│   │   └── Services/
│   ├── views/                   # Twig templates
│   └── data/                    # JSON storage
│
├── php-app-simple/              # Simple PHP version
│   ├── public/
│   │   └── index.php            # Router & controller
│   ├── includes/                # Services & helpers
│   ├── views/                   # Native PHP templates
│   └── data/                    # JSON storage
│
├── components/ui/               # Shared UI components (shadcn)
├── start-simple.bat             # Launch simple PHP version
├── start-server.bat             # Launch Twig PHP version
├── package.json                 # React dependencies
├── composer.json                # PHP dependencies
├── vite.config.js               # Vite configuration
├── tailwind.config.js           # TailwindCSS config
│
└── Documentation/
    ├── START-HERE.md            # Getting started guide
    ├── README-SIMPLE.md         # Simple PHP docs
    ├── README-PHP.md            # Twig PHP docs
    └── QUICK-START.md           # Quick reference
```

---

## 🎨 Tech Stack Comparison

| Feature          | React Version   | PHP Simple        | PHP Twig          |
| ---------------- | --------------- | ----------------- | ----------------- |
| **Frontend**     | React 18        | Native PHP        | Twig Templates    |
| **Build Tool**   | Vite            | None              | None              |
| **Routing**      | React Router v6 | PHP Router        | PHP Router        |
| **Styling**      | TailwindCSS     | TailwindCSS (CDN) | TailwindCSS (CDN) |
| **Auth**         | localStorage    | PHP Sessions      | PHP Sessions      |
| **Storage**      | localStorage    | JSON Files        | JSON Files        |
| **Dependencies** | npm packages    | **None!**         | Composer (Twig)   |
| **Hot Reload**   | ✅ Yes          | ❌ No             | ❌ No             |
| **SEO**          | ⚠️ Limited      | ✅ Full           | ✅ Full           |
| **Deployment**   | Static hosting  | PHP hosting       | PHP hosting       |

---

## 🛣️ Routes & Pages

### All Versions Include:

| Route                 | Page      | Auth Required | Description         |
| --------------------- | --------- | ------------- | ------------------- |
| `/`                   | Landing   | ❌ No         | Hero page with CTAs |
| `/auth/login`         | Login     | ❌ No         | User login form     |
| `/auth/signup`        | Signup    | ❌ No         | User registration   |
| `/dashboard`          | Dashboard | ✅ Yes        | Statistics overview |
| `/tickets`            | Tickets   | ✅ Yes        | Ticket management   |
| `/tickets/:id/edit`   | Edit      | ✅ Yes        | Edit ticket         |
| `/tickets/:id/delete` | Delete    | ✅ Yes        | Delete ticket       |
| `/auth/logout`        | Logout    | ✅ Yes        | User logout         |

---

## 🎯 Key Features Explained

### Authentication System

- **React:** Client-side validation with localStorage
- **PHP:** Server-side sessions with bcrypt password hashing
- Prevents unauthorized access to protected routes
- Auto-redirects unauthenticated users to login

### Ticket Management

- **Create:** Add new tickets with title, description, status, priority
- **Read:** View all tickets or filter by status
- **Update:** Edit ticket details inline
- **Delete:** Remove tickets with confirmation dialog

### Data Persistence

- **React:** Browser localStorage (client-side)
- **PHP:** JSON files on server (server-side)
- Auto-saves on every change
- No database required!

### Status Management

- **Open:** New tickets awaiting action
- **In Progress:** Tickets currently being worked on
- **Closed:** Resolved/completed tickets

### Priority Levels

- **Low:** Minor issues
- **Medium:** Standard priority
- **High:** Urgent issues requiring immediate attention

---

## 🎨 UI/UX Features

### Design System

- **Color Scheme:** Dark theme with slate background
- **Typography:** System fonts for optimal performance
- **Components:** Consistent button styles, form inputs, cards
- **Responsive:** Mobile-first design, works on all screen sizes

### User Experience

- **Toast Notifications:** Real-time feedback for user actions
- **Loading States:** Visual feedback during operations
- **Form Validation:** Client-side validation before submission
- **Confirmation Dialogs:** Prevent accidental deletions

### Accessibility

- **ARIA Labels:** Screen reader support
- **Keyboard Navigation:** Full keyboard accessibility
- **Focus States:** Clear visual focus indicators
- **Color Contrast:** WCAG AA compliant

---

## 🔧 Development

### React Development

```bash
# Install dependencies
npm install

# Start dev server
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

### PHP Simple Development

```bash
# Start dev server
php -S localhost:8000 -t php-app-simple/public

# No build step needed!
```

### PHP Twig Development

```bash
# Install dependencies
composer install

# Start dev server
cd php-app/public
php -S localhost:8000
```

---

## 📊 Data Structure

### User Object

```json
{
  "email": "user@example.com",
  "password": "hashed_password",
  "created_at": "2025-10-25 12:00:00"
}
```

### Ticket Object

```json
{
  "id": "1729876543210",
  "title": "Bug: Login not working",
  "description": "Users cannot log in with valid credentials",
  "status": "open",
  "priority": "high",
  "created_at": "2025-10-25 12:00:00",
  "updated_at": "2025-10-25 12:00:00"
}
```

---

## 🚢 Deployment

### React Version

Deploy to any static hosting:

- **Vercel:** `vercel deploy`
- **Netlify:** `netlify deploy`
- **GitHub Pages:** Push to `gh-pages` branch

### PHP Versions

Deploy to any PHP hosting:

- **Shared Hosting:** Upload files via FTP
- **VPS:** Configure Apache/Nginx
- **Platform.sh:** `platform deploy`
- **Heroku:** Use PHP buildpack

---

## 🔒 Security Considerations

### React Version

- ⚠️ localStorage is vulnerable to XSS attacks
- ✅ Passwords should be hashed server-side in production
- ✅ Use HTTPS in production

### PHP Versions

- ✅ Passwords hashed with bcrypt
- ✅ Session-based authentication
- ✅ Server-side validation
- ⚠️ Use database in production (not JSON files)
- ⚠️ Add CSRF protection for forms
- ⚠️ Implement rate limiting

---

## 🧪 Testing

### React Version

```bash
# Run tests (if configured)
npm test
```

### PHP Versions

- Manual testing via browser
- Consider adding PHPUnit for unit tests

---

## 🤝 Contributing

This is a learning/demo project. Feel free to:

- Fork the repository
- Create feature branches
- Submit pull requests
- Report issues

---

## 📝 License

This project is open source and available for educational purposes.

---

## 🎓 Learning Resources

### For React Version:

- [React Documentation](https://react.dev)
- [Vite Guide](https://vitejs.dev)
- [TailwindCSS Docs](https://tailwindcss.com)
- [React Router](https://reactrouter.com)

### For PHP Versions:

- [PHP Manual](https://www.php.net/manual)
- [Twig Documentation](https://twig.symfony.com)
- [PHP The Right Way](https://phptherightway.com)

---

## 🐛 Troubleshooting

### React Version Issues

- **Port already in use:** Change port in `vite.config.js`
- **Build errors:** Delete `node_modules` and reinstall

### PHP Version Issues

- **"PHP not recognized":** Ensure PHP is in system PATH
- **Composer errors:** Run `composer install`
- **Permission denied:** Check file permissions on data/ folder

See individual README files for detailed troubleshooting.

---

## 📞 Support

For questions or issues:

1. Check the documentation in the `/Documentation` folder
2. Review the specific README for your chosen version
3. Check the troubleshooting section above

---

## 🎉 Acknowledgments

- **TailwindCSS** for the amazing utility-first CSS framework
- **Twig** for the flexible templating engine
- **React** team for the powerful UI library
- **Vite** for the lightning-fast build tool

---

## 📈 Project Status

- ✅ React version: **Complete**
- ✅ PHP Simple version: **Complete**
- ✅ PHP Twig version: **Complete**
- 🔄 Future enhancements: Database integration, API layer, testing

---

**Built with ❤️ as a full-stack learning project**

_Demonstrating identical functionality across different tech stacks_
