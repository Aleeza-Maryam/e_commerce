<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartify - Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="main_page.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="logo-text">Cartify<span>.</span></div>
            </a>

            <ul class="nav-links">
                <li><a href="#hero-sale" class="active">HOME</a></li>
                <li><a href="#products-section">PRODUCTS</a></li>
                <li><a href="#categories-section">CATEGORIES</a></li>
                <li><a href="#best-sellers-section">BEST SELLERS</a></li>
                <li><a href="#footer-section">CONTACT</a></li>
            </ul>

            <div class="nav-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-user"></i></a>
                <a href="#" class="cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">3</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Sale Section -->
    <section class="hero-sale" id="hero-sale">
        <div class="sale-content">
            <div class="sale-badge">Sale 20% Off</div>
            <h1 class="sale-title">On Everything</h1>
            <p class="sale-description">
                HE BIG EVENT IS HERE! ⚡️
                Up to 50% OFF sitewide. No codes. No stress. Just pure style. Call to Action: Tap to shop now!
            </p>
            <a href="#" class="sale-button">Shop Now</a>
        </div>
    </section>

    <!-- Main Products Section -->
    <section class="products-section" id="products-section">
        <div class="products-container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-content">
                    <!-- Categories -->
                    <div class="sidebar-section" id="categories-section">
                        <h3 class="sidebar-title">CATEGORY</h3>
                        <ul class="category-list" id="categoryList">
                            <!-- Categories will be loaded from database -->
                        </ul>
                    </div>

                    <!-- Best Sellers -->
                    <div class="sidebar-section" id="best-sellers-section">
                        <h3 class="sidebar-title">BEST SELLERS</h3>
                        <div id="bestSellers">
                            <!-- Best sellers will be loaded from database -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Products Area -->
            <div class="products-main">
                <div class="section-header">
                    <h2 class="section-title">New <span>Products</span></h2>
                    <div class="products-count" id="productCount">0 Products</div>
                </div>

                <div class="products-grid" id="productsGrid">
                    <!-- Products will be loaded from database -->
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer-section">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Cartify.</h3>
                <p>Elevate your shopping experience with premium products, quality service, and seamless shopping.</p>
            </div>

            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#hero-sale">Home</a></li>
                    <li><a href="#products-section">Products</a></li>
                    <li><a href="#categories-section">Categories</a></li>
                    <li><a href="#best-sellers-section">Best Sellers</a></li>
                    <li><a href="#footer-section">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Customer Service</h3>
                <ul class="footer-links">
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li><i class="fas fa-map-marker-alt"></i> 123 Shopping Street, New York, NY</li>
                    <li><i class="fas fa-phone"></i> +1 (234) 567-8900</li>
                    <li><i class="fas fa-envelope"></i> support@cartify.com</li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; 2023 Cartify. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript remains the same -->
    <script>
        // ... all your existing JavaScript code remains exactly the same ...
        // Generate star rating HTML
        function generateStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="fas fa-star"></i>';
                } else if (i === Math.ceil(rating) && !Number.isInteger(rating)) {
                    stars += '<i class="fas fa-star-half-alt"></i>';
                } else {
                    stars += '<i class="far fa-star"></i>';
                }
            }
            return stars;
        }

        // Load categories from database
        function loadCategories() {
            fetch("get_categories.php")
                .then(res => res.json())
                .then(data => {
                    const categoryList = document.getElementById('categoryList');
                    categoryList.innerHTML = '';

                    // All products option
                    categoryList.innerHTML += `
            <li><a href="#" class="active" data-category="">All</a></li>
        `;

                    data.forEach(cat => {
                        categoryList.innerHTML += `
                <li><a href="#" data-category="${cat}">${cat}</a></li>
            `;
                    });

                    document.querySelectorAll('#categoryList a').forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault();

                            document.querySelectorAll('#categoryList a')
                                .forEach(a => a.classList.remove('active'));
                            this.classList.add('active');

                            loadProducts(this.dataset.category);
                        });
                    });
                });
        }

        // Load best sellers from database
        function loadBestSellers() {
            fetch("get_best_sellers.php")
                .then(res => res.json())
                .then(data => {
                    const div = document.getElementById("bestSellers");
                    div.innerHTML = '';

                    data.forEach(p => {
                        div.innerHTML += `
                <div class="best-seller-item">
                    <div class="bs-image">
                        <img src="../admin/uploads/${p.image}">

                    </div>
                    <div class="bs-details">
                        <div class="bs-name">${p.product_name}</div>
                        <div class="bs-price">$${p.product_price}</div>
                    </div>
                    <div class="bs-rating">
    ${generateStars(5)}
</div>

                </div>
            `;
                    });
                });
        }

        // Load products from database
        function loadProducts(category = '') {
            let url = "get_products_front.php";
            if (category) url += "?category=" + encodeURIComponent(category);

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const grid = document.getElementById('productsGrid');
                    grid.innerHTML = '';

                    document.getElementById('productCount')
                        .textContent = `${data.length} Products`;

                    data.forEach(p => {
                        grid.innerHTML += `
                <div class="product-card">
                    <div class="product-image">
                        <img src="../admin/uploads/${p.image}" alt="${p.product_name}">
                    </div>
                   <div class="product-info">
                    <div class="product-category">${p.category}</div>
                        <h3 class="product-name">${p.product_name}</h3>

                         <div class="product-rating">
                             ${generateStars(4)}
                           </div>

                         <div class="product-price">
                         <span class="current-price">$${p.product_price}</span>
                           </div>
             <a href="product_details.php?id=${p.id}" class="view-details">
    <i class="fas fa-arrow-right"></i>
</a>


                     </div>

                </div>
            `;
                    });
                });
        }

        // Filter products by category
        function filterProductsByCategory(categoryId) {
            // In a real application, this would be a database query
            console.log(`Filtering by category ID: ${categoryId}`);
            // For demo, we'll just reload all products
            loadProducts();
        }

        // Add to cart function
        function addToCart(productId) {
            const cartCount = document.querySelector('.cart-count');
            let count = parseInt(cartCount.textContent);
            count++;
            cartCount.textContent = count;

            // Animation
            cartCount.style.transform = 'scale(1.5)';
            setTimeout(() => {
                cartCount.style.transform = 'scale(1)';
            }, 300);

            // In a real application, this would send an AJAX request to add item to cart
            console.log(`Added product ${productId} to cart`);

            // Show notification
            showNotification('Product added to cart!');
        }

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #2E7D32;
                color: #FFFFFF;
                padding: 15px 25px;
                border-radius: 5px;
                z-index: 1001;
                animation: slideIn 0.3s ease-out;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 2000);

            // Add keyframes for animation
            if (!document.getElementById('notification-styles')) {
                const style = document.createElement('style');
                style.id = 'notification-styles';
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                    @keyframes slideOut {
                        from { transform: translateX(0); opacity: 1; }
                        to { transform: translateX(100%); opacity: 0; }
                    }
                `;
                document.head.appendChild(style);
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
            loadBestSellers();
            loadProducts();
        });
    </script>
</body>

</html>