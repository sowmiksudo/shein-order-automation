# 🛍️ Shein Order Automation (Pure Laravel)

> An end-to-end dropshipping automation system and admin dashboard built entirely on Laravel. This application automates the process of placing orders on Shein.com directly from the custom backend, bypassing the need for an official API.

## 🚀 Overview

Managing dropshipping orders manually is a massive bottleneck. This project solves that by unifying a robust admin dashboard with a background web-automation engine, all within the Laravel ecosystem.

The system listens for new orders placed via the admin panel, queues them using Laravel Events, and triggers an automated browser session to seamlessly navigate Shein.com (specifically handling Malaysian product variants) and execute the checkout process automatically.

## ⚙️ Tech Stack

* **Framework:** Laravel (PHP)
* **Database:** MySQL / PostgreSQL
* **Queue Management:** Laravel Queues / Horizon (for handling background automation tasks)
* **Automation/RPA:** Laravel Dusk / WebDriver (PHP-based browser automation)
* **Frontend/Dashboard:** Blade Templates / Livewire (or whatever you used for the UI)

## 🏗️ Architecture & Workflow

1. **Order Ingestion:** A customer places an order, or an admin logs it into the Dashboard.
2. **Event Dispatch:** Laravel dispatches an `OrderPlaced` event, pushing the order payload into a background queue. This ensures the main web thread is never blocked by the heavy browser automation tasks.
3. **Queue Worker Execution:** A dedicated Laravel queue worker picks up the job and spins up a headless browser instance.
4. **Automated Checkout:** The script navigates to Shein, handles the UI layer (bypassing standard web hurdles), selects the correct variants, and injects the shipping payload data.
5. **Real-Time Status:** Once the checkout succeeds or fails, the job updates the database, reflecting the new order status instantly on the admin dashboard.

## 🛠️ Installation & Setup

```bash
# Clone the repository
git clone [https://github.com/sowmiksudo/shein-order-automation.git](https://github.com/sowmiksudo/shein-order-automation.git)
cd shein-order-automation

# Install PHP dependencies
composer install

# Install NPM dependencies (if applicable)
npm install
npm run build

# Set up environment variables
cp .env.example .env
php artisan key:generate

# Configure your database credentials in .env, then run:
php artisan migrate

# Start the web server
php artisan serve

```

### Starting the Automation Workers

To process the automated orders, you need to ensure the Laravel queue worker is running:

```bash
# Run the queue worker to listen for order jobs
php artisan queue:work

```

## ⚠️ Disclaimer

This project was built for educational purposes and internal workflow automation. Automated interactions and web scraping may violate the Terms of Service of target websites like Shein. Use responsibly and ensure you have the appropriate permissions before deploying in a production environment.

---

*Built by [@sowmiksudo*](https://github.com/sowmiksudo)
