# Hotel Bhagyashree

> A lightweight PHP/HTML/CSS hotel ordering system — simple UI for menu display and order management.

[![Repo Size](https://img.shields.io/github/repo-size/Sagardevil/Hotel-bhagyashree)](https://github.com/Sagardevil/Hotel-bhagyashree) [![Languages](https://img.shields.io/github/languages/top/Sagardevil/Hotel-bhagyashree)](https://github.com/Sagardevil/Hotel-bhagyashree) [![Open Issues](https://img.shields.io/github/issues/Sagardevil/Hotel-bhagyashree)](https://github.com/Sagardevil/Hotel-bhagyashree/issues)

---

## Table of contents

- [About](#about)
- [Interactive features included in this README](#interactive-features-included-in-this-readme)
- [Demo / Screenshots](#demo--screenshots)
- [Tech stack](#tech-stack)
- [Repo structure](#repo-structure)
- [Quick start (run locally)](#quick-start-run-locally)
- [Database setup](#database-setup)
- [How to use](#how-to-use)
- [Admin pages & endpoints](#admin-pages--endpoints)
- [Additions & enhancements (ideas / TODO)](#additions--enhancements-ideas--todo)
- [Contributing](#contributing)
- [License](#license)

---

## About

This repository contains a small hotel ordering system built with plain PHP, HTML and CSS. It provides a menu display for customers and a set of PHP pages (admin side) to view and manage orders.

Files of interest: `index.html`, `menu.html`, `menu-style.css`, `style.css`, `db.php`, `insert.php`, `fetch.php`, `admin_orders.php`, `order_summary.php`, `complete_order.php`, `hotel_menu.sql`.

---

## Interactive features included in this README

1. **Collapsible sections** for long instructions (use the `<details>` tag below).
2. **Task checklist** for setup/QA that you can toggle while working on the repo.
3. **Live badges** (repo size / languages / issues) which update automatically.
4. **One-click SQL import command** (copyable code block) to set up the database.
5. **Sample `curl` calls** to exercise endpoints for quick testing.

<details>
<summary>Quick checklist (click to expand/collapse)</summary>

- [ ] Verify PHP version (>= 7.4 recommended)
- [ ] Install XAMPP / LAMP and start Apache + MySQL
- [ ] Import `hotel_menu.sql` into a database
- [ ] Update `db.php` with DB credentials
- [ ] Open `index.html` or `menu.html` in browser
- [ ] Test order placement and admin pages
</details>

---

## Demo / Screenshots

> Add screenshots to the `/assets` folder and update paths below. Example:

```
![Menu page preview](assets/menu-preview.png)
```

---

## Tech stack

- PHP (server-side scripting)
- MySQL (or MariaDB) — small SQL file provided
- HTML, CSS for frontend

---

## Repo structure (high level)

```
Hotel-bhagyashree/
├─ index.html             # landing / menu
├─ menu.html              # menu listing (frontend)
├─ menu-style.css         # menu specific styling
├─ style.css              # general styling
├─ db.php                 # DB connection (update credentials)
├─ insert.php             # endpoint to insert orders
├─ fetch.php              # fetch menu / orders
├─ admin_orders.php       # admin view for incoming orders
├─ order_summary.php      # summary page
├─ complete_order.php     # mark order as complete
├─ hotel_menu.sql         # SQL to create menu table + sample data
└─ URL QR Code (1).png    # image file
```

---

## Quick start (run locally)

<details>
<summary>Click to expand quick start commands</summary>

**1. Install XAMPP (or use your existing LAMP stack)**

- On Windows: install XAMPP and start Apache + MySQL from the XAMPP Control Panel.
- On Linux: install Apache, PHP and MySQL/MariaDB.

**2. Copy repository files into your web root**

On XAMPP (Windows) place files into `C:\xampp\htdocs\Hotel-bhagyashree`.

On Linux with Apache: place into `/var/www/html/Hotel-bhagyashree` (use sudo when copying).

**3. Create the database & import SQL**

```sql
CREATE DATABASE hotel_db;
USE hotel_db;
-- Import file `hotel_menu.sql` (example using mysql CLI)
mysql -u root -p hotel_db < path/to/hotel_menu.sql
```

**One-line import (example)**

```bash
mysql -u root -p hotel_db < hotel_menu.sql
```

**4. Update `db.php`**

Open `db.php` and set your DB host, username, password, and database name.

**5. Open the app in your browser**

Visit `http://localhost/Hotel-bhagyashree/index.html` or `menu.html`.

</details>

---

## Database setup

The repo includes `hotel_menu.sql`. Run it to create the `menu` table and populate sample items.

**If you prefer phpMyAdmin:**

- Open `http://localhost/phpmyadmin` -> import -> choose `hotel_menu.sql` -> Go.

---

## How to use

**Placing an order (client-side)**

1. Browse `menu.html` and choose items.
2. The frontend calls `insert.php` to store order details.
3. Admin opens `admin_orders.php` to view incoming orders.
4. `complete_order.php` can be used to mark an order completed.

**Testing with `curl`**

```bash
# Sample insert (example fields; adapt to what insert.php expects)
curl -X POST http://localhost/Hotel-bhagyashree/insert.php \
  -d "item_id=1&quantity=2&customer_name=TestUser&table_no=3"

# Fetch menu
curl http://localhost/Hotel-bhagyashree/fetch.php
```

---

## Admin pages & endpoints

- `admin_orders.php` — view and manage orders
- `order_summary.php` — shows a summary of an order
- `complete_order.php` — endpoint to update order status
- `fetch.php` — returns menu (or orders)

---

## Additions & enhancements (ideas / TODO)

- Add screenshots and a small demo GIF.
- Add `config.sample.php` to avoid committing credentials.
- Add input validation & prepared statements (to prevent SQL injection).
- Add a simple login for `admin_orders.php`.
- Add GitHub Actions workflow for linting PHP.

---

## Contributing

1. Fork the repo
2. Create a branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "feat: add ..."`
4. Push: `git push origin feature/your-feature`
5. Open a Pull Request describing your change

---

## License

This project currently has no license file. Add one (MIT recommended) if you plan to open-source it.
