# Malshoes - Premium Shoe Store Platform

Malshoes is a clean, modern, and high-performance e-commerce and stock management application designed for premium footwear retailers. Built using a custom MVC architecture in Native PHP, the application facilitates seamless customer shopping experiences, robust admin operations (CRUD for products/categories, finance reporting, invoice clearance), and supplier inventory request fulfillment.

---

## Key Features

### 👤 Customer Portal (User)
* **Explore Products**: Elegant home catalog with filter-by-category and search parameters.
* **Product Detail**: Choose available shoe sizes with dynamic real-time stock limits.
* **Shopping Cart**: Interactive cart with session-based local synchronization.
* **Checkout & Billing**: Flat-rate shipping fee calculations and billing address tracking.
* **Profile Settings**: Manage email, name, and login credentials.

### 🛡️ Management Portal (Admin)
* **KPI Dashboard**: View overall sales revenue, net profit, category counts, and pending supplier invoices.
* **Catalog Control**: Full CRUD for shoe products, descriptions, pricing, images, and category catalog structures.
* **Stock Control & Requests**: Monitor stocks across all size tiers (Sizes 38-45) and dispatch stock supply orders directly to suppliers.
* **Financial Reporting**: Real-time sales journal and net profitability reports.
* **Invoice Clearance**: Clear pending transactions for completed supplier shipments.
* **User Management**: Admin control over user accounts, permissions, and roles.

### 🚚 Supplier Portal
* **Stock Request Board**: Fulfill pending stock requests dispatched by the store admin.
* **Fulfillment Action**: Instantly increment catalog stock counts upon shipping.
* **Invoice Accounting**: Review payment logs and track unpaid/paid supplier statements.

---

## Technology Stack

* **Back-End**: PHP (Native MVC Pattern, PDO Database driver)
* **Database**: MySQL / MariaDB (Optimized English relational schema with key constraint references)
* **Front-End Styling**: HTML5, CSS3 Custom Theme System, Bootstrap 5 CSS CDN, Google Fonts (Poppins), FontAwesome 6 Icons
* **Interactivity**: Vanilla JavaScript, DataTables (Enhanced Bootstrap 5 grids)
* **Architecture**: Model-View-Controller (MVC) directory structure

---

## Directory Structure

```text
malshoes/
├── app/
│   ├── controllers/      # App routing logic (Admin, Auth, Home, Supplier, User)
│   ├── core/             # Base MVC classes (App routing, controller base, database engine)
│   ├── models/           # Data models interacting with MySQL via PDO
│   └── views/            # Template rendering (Dashboard layouts, layouts components)
├── database/
│   └── malshoes.sql      # Database structure and seeds
├── public/
│   ├── assets/           # User-uploaded images and product catalog uploads
│   ├── css/              # Customized CSS components
│   └── index.php         # Single entry point
└── README.md             # Project documentation
```

---

## Installation & Setup

### Prerequisites
* **Web Server**: Apache (XAMPP, Laragon, or custom Nginx with mod_rewrite enabled)
* **Database**: MySQL/MariaDB (MariaDB 10.1+ recommended)
* **PHP Engine**: PHP 7.3 or above

### Step-by-Step Installation

1. **Clone the Repository**
   Clone this repository or move the `malshoes` directory to your web server root (e.g. `htdocs` or `www`).
   ```bash
   git clone <repository_url> malshoes
   ```

2. **Configure Database Schema**
   * Open PHPMyAdmin or your preferred database GUI (HeidiSQL, DBeaver).
   * Create a new database named `malshoes` (Collation: `utf8mb4_general_ci`).
   * Import the [malshoes.sql](file:///d:/www/malshoes/database/malshoes.sql) file located in the `/database` directory.

3. **Verify Web Server Rewrite Configurations**
   The application uses clean routing urls. Ensure that `.htaccess` is configured correctly in the root directory. XAMPP/Apache must have `mod_rewrite` enabled.

4. **Run Application**
   Launch your server and visit the address in your browser:
   ```text
   http://localhost/malshoes/public/
   ```

---

## Demo Credentials

All standard seeded accounts share the default password `password`:

| Role | Username | Password | Email |
| :--- | :--- | :--- | :--- |
| **User** | `user` | `password` | `user@example.com` |
| **Admin** | `admin` | `password` | `admin@example.com` |
| **Supplier** | `supplier` | `password` | `supplier@example.com` |
