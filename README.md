# Mobile Shop Management System

A combined mobile shop sales & repair management system built with HTML, CSS, JavaScript, PHP and MySQL.

## Tech Stack
- HTML5, CSS3, JavaScript
- PHP (vanilla, no framework)
- MySQL (via XAMPP / phpMyAdmin)
- Chart.js (CDN) for dashboard charts
- Bootstrap 5 (CDN) for layout/icons (optional)

## Local Setup (XAMPP)
1. Clone this repo into `C:\xampp\htdocs\mobile-shop-management-system`
2. Start Apache and MySQL from the XAMPP control panel
3. Create a database `mobile_shop_db` in phpMyAdmin
4. Import the SQL schema from `/database/schema.sql` (once added)
5. Update credentials in `config/db.php`
6. Visit `http://localhost/mobile-shop-management-system/`

## Folder Structure
- `assets/` — CSS, JS, images, icons
- `includes/` — shared PHP partials (header, sidebar, topbar, footer)
- `config/` — database connection config
- `auth/` — login, register, logout
- `inventory/`, `sales/`, `repairs/`, `customers/`, `reports/` — feature modules
- `uploads/` — user-uploaded files (product images, invoices)

## Status
🚧 In development — frontend UI in progress.
