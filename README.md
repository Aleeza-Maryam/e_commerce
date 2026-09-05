# E-Commerce Website

A PHP-based e-commerce web application featuring product browsing, categories, best sellers, a shopping cart, and checkout functionality. Built with core PHP, HTML/CSS, and MySQL.

## Features

- **Home & Landing Pages** – Welcoming storefront with navigation to products and categories.
- **Product Catalog** – Browse products by category, view best sellers, and see detailed product pages.
- **Shopping Cart** – Add products to a cart and manage items before purchase.
- **Checkout** – Complete orders through a dedicated checkout flow.
- **User Authentication Options** – Choose between login methods via a login selection page.
- **Image Uploads** – Product images and assets stored in the `uploads` directory.

## Tech Stack

- **Backend:** PHP
- **Frontend:** HTML, CSS
- **Database:** MySQL (assumed — update if different)

## File Structure

| File/Folder | Description |
|---|---|
| `Home.php` / `Home.css` | Main home page and its styling |
| `main_page.php` / `main_page.css` | Primary landing/storefront page and styling |
| `login_choice.php` / `login_choice.css` | Page for selecting a login method |
| `product_details.php` / `product_details.css` | Detailed view of an individual product |
| `cart.php` | Shopping cart page |
| `checkout.php` | Checkout and order completion page |
| `get_categories.php` | Fetches product categories (likely via AJAX) |
| `get_best_sellers.php` | Fetches best-selling products (likely via AJAX) |
| `get_products_front.php` | Fetches products for front-end display |
| `uploads/` | Directory for uploaded product images/assets |

## Getting Started

### Prerequisites

- [XAMPP](https://www.apachefriends.org/) / WAMP / LAMP or any local server with PHP support
- MySQL database
- Web browser

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Aleeza-Maryam/e_commerce.git
   ```
2. Move the project folder into your server's root directory (e.g., `htdocs` for XAMPP).
3. Create a MySQL database and import the required tables (products, categories, cart, orders, users, etc.) matching the fields used across the PHP files.
4. Update database connection credentials (host, username, password, database name) in the relevant PHP files.
5. Ensure the `uploads` folder has proper read/write permissions for product images.
6. Start Apache and MySQL from your server control panel.
7. Open your browser and navigate to:
   ```
   http://localhost/e_commerce/Home/Home.php
   ```

## Usage

1. Open `Home.php` or `main_page.php` to browse the storefront.
2. View categories and best sellers, which are loaded dynamically via `get_categories.php`, `get_best_sellers.php`, and `get_products_front.php`.
3. Click on a product to view more details via `product_details.php`.
4. Add items to your cart (`cart.php`).
5. Proceed to `checkout.php` to complete your purchase.
6. Use `login_choice.php` to sign in or choose an account type before checkout.

## Contributing

Contributions are welcome! Feel free to fork this repository, make improvements, and submit a pull request.

## License

This project is open source. Add your preferred license (e.g., MIT) here.
