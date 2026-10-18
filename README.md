# Malshoes - Footwear Ecommerce & ERP (Laravel Edition)

Malshoes is a clean, modern, and high-performance e-commerce and ERP stock management platform designed for footwear retailers. Built with **Laravel 11**, the platform features customer shopping, real-time cart synchronization, admin catalog & financial ERP reports, and supplier inventory fulfillment.

---

## 🌟 Key Features

### 👤 Customer Portal (User)
* **Interactive Catalog**: Filter shoes by category and instant keyword search.
* **Product Detail**: Multi-size selection (Sizes 38-45) with live stock availability limits.
* **Shopping Cart & Checkout**: Local guest cart synchronization and authenticated persistent cart, flat-rate shipping calculation, and billing address capture.
* **Profile Management**: Update profile info and credentials.

### 🛡️ Admin Management Portal
* **Executive KPI Dashboard**: Total products, total live stock across all sizes, category counts, gross revenue, expenditures, and pending supplier invoices.
* **Catalog Control**: Full CRUD for shoes and categories with image upload management.
* **Stock Control & Dispatch**: Monitor stock per size tier and dispatch stock replenishment requests directly to suppliers.
* **Financial & Sales Reports**: Real-time sales journal and net profit calculation.
* **Supplier Invoice Settlement**: Review and clear supplier invoices upon shipment.
* **User Management**: Manage administrative, supplier, and customer accounts.

### 🚚 Supplier Portal
* **Stock Request Board**: Review incoming shoe demand requests from the admin.
* **Fulfillment Action**: Instant single-click fulfillment that increments catalog stock automatically.
* **Invoice Accounting & Payment Logs**: Real-time payment tracking for supplied goods.

---

## 🛠️ Technology Stack & Architecture
* **Framework**: Laravel 11.x (PHP 8.2+)
* **Database**: SQLite / MySQL / MariaDB (Optimized migrations & seeders included)
* **Frontend**: Blade Templating, Bootstrap 5, FontAwesome 6, DataTables, Google Fonts (Poppins)
* **Architecture**: Strict MVC adhering to Clean Code standards (all files strictly ≤ 500 lines)

---

## 🚀 Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/anasikhzf/footwear-ecommerce-erp.git
   cd footwear-ecommerce-erp
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

5. **Start Local Development Server**
   ```bash
   php artisan serve
   ```
   Visit `http://127.0.0.1:8000` in your browser.

---

## 🔐 Demo Credentials

All seeded accounts use the default password `password`:

| Role | Username | Password | Email |
| :--- | :--- | :--- | :--- |
| **User** | `user` | `password` | `user@example.com` |
| **Admin** | `admin` | `password` | `admin@example.com` |
| **Supplier** | `supplier` | `password` | `supplier@example.com` |

---

## 📄 License
This project is open-source software licensed under the [MIT license](LICENSE).
