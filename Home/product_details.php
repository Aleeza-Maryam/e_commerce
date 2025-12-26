<?php
ini_set('session.cookie_path', '/');
session_start();


$conn = mysqli_connect("localhost", "root", "", "cartify");

if (!$conn) {
    die("DB connection failed");
}

if (!isset($_GET['id'])) {
    die("Product ID not found");
}

$id = intval($_GET['id']);

$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Product not found");
}

$product = mysqli_fetch_assoc($result);

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $qty = intval($_POST['quantity']);
    
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if product already in cart
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qty;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'name' => $product['product_name'],
            'price' => $product['discount_price'] ?? $product['product_price'],
            'image' => $product['image'],
            'qty' => $qty
        ];
    }
    
    // Show success message
    $cart_success = "Added $qty item(s) to cart!";
    
    // Redirect to same page to show updated cart count
    header("Location: product_details.php?id=$id");
    exit();
}

// Calculate cart count
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['qty'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Cartify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="product_details.css">
    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #2c5d3b, #3e7c4f);
            color: #fffaf0;
            padding: 15px 25px;
            border-radius: 10px;
            z-index: 10000;
            box-shadow: 0 5px 15px rgba(44, 93, 59, 0.3);
            display: none;
            align-items: center;
            gap: 10px;
            border: 2px solid #c4a77d;
            animation: slideIn 0.3s ease;
        }
        
        .notification.show {
            display: flex;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<div class="product-page">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="main_page.php"><i class="fas fa-home"></i> Home</a> / 
        <a href="#"><?php echo htmlspecialchars($product['category']); ?></a> / 
        <span><?php echo htmlspecialchars($product['product_name']); ?></span>
    </div>
    
    <!-- Cart Icon -->
    <div class="cart">
       <a href="cart.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count"><?php echo $cart_count; ?></span>
        </a>
    </div>

    <!-- Product Container -->
    <div class="product-container">
        <!-- Image Section -->
        <div class="image-section">
            <div class="main-image">
                <img src="../admin/uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                <div class="badge hot-badge">
                    <i class="fas fa-fire"></i> HOT ITEM
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="product-header">
                <h1 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                
                <div class="rating-sold">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="rating-text">4.5 (24 reviews)</span>
                    </div>
                    <div class="sold-count">
                        <i class="fas fa-shopping-cart"></i>
                        <span><?php echo number_format($product['sold_count'] ?? 150); ?> sold</span>
                    </div>
                </div>

                <div class="category-tag">
                    <i class="fas fa-tag"></i> <?php echo htmlspecialchars($product['category']); ?>
                </div>
            </div>

            <!-- Short Description -->
            <div class="short-description">
                <h3><i class="fas fa-info-circle"></i> Quick Overview</h3>
                <p><?php echo htmlspecialchars($product['short_description'] ?? 'Premium quality product with excellent features and performance.'); ?></p>
            </div>

            <!-- Price Section -->
            <div class="price-section">
                <div class="current-price">
                    <span class="price">Rs <?php echo number_format($product['discount_price'] ?? $product['product_price'], 2); ?></span>
                    <?php if($product['discount_price'] && $product['discount_price'] < $product['product_price']): ?>
                        <span class="old-price">Rs <?php echo number_format($product['product_price'], 2); ?></span>
                        <span class="discount">SAVE <?php echo round((($product['product_price'] - $product['discount_price']) / $product['product_price']) * 100); ?>%</span>
                    <?php endif; ?>
                </div>
                
                <div class="stock-info">
                    <i class="fas fa-box"></i>
                    <span><?php echo $product['stock'] ?? 50; ?> units in stock</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <form method="POST" action="" id="addToCartForm">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <input type="hidden" name="quantity" id="qtyField" value="1">
                
                <div class="action-section">
                    <div class="quantity">
                        <button type="button" class="qty-btn minus"><i class="fas fa-minus"></i></button>
                        <input type="number" value="1" min="1" max="50" class="qty-input" id="qtyInput">
                        <button type="button" class="qty-btn plus"><i class="fas fa-plus"></i></button>
                    </div>
                    
                    <button type="submit" name="add_to_cart" class="btn add-to-cart">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                    
                    <button type="button" class="btn buy-now">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                    
                    <button type="button" class="wishlist-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </form>

            <!-- Delivery Info -->
            <div class="delivery-info">
                <div class="delivery-item">
                    <i class="fas fa-shipping-fast"></i>
                    <div>
                        <strong>Free Shipping</strong>
                        <p>Delivery in 2-4 days</p>
                    </div>
                </div>
                <div class="delivery-item">
                    <i class="fas fa-undo"></i>
                    <div>
                        <strong>Easy Returns</strong>
                        <p>30 days return policy</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs">
        <div class="tab-headers">
            <button type="button" class="tab-btn active" onclick="showTab('description')">
                <i class="fas fa-file-alt"></i> Description
            </button>
            <button type="button" class="tab-btn" onclick="showTab('reviews')">
                <i class="fas fa-comments"></i> Reviews
            </button>
            <button type="button" class="tab-btn" onclick="showTab('shipping')">
                <i class="fas fa-truck"></i> Shipping
            </button>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="description">
                <h3>Product Description</h3>
                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            </div>

            <div class="tab-pane" id="reviews">
                <h3>Customer Reviews</h3>
                <div class="review">
                    <div class="review-header">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span class="reviewer">Daniyal</span>
                    </div>
                    <p>"Very good quality, totally satisfied! "</p>
                </div>
                
                <div class="review">
                    <div class="review-header">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="reviewer">Sarah Khan</span>
                    </div>
                    <p>"Best product in this price range! "</p>
                </div>
            </div>

            <div class="tab-pane" id="shipping">
                <h3>Shipping Information</h3>
                <p>We offer free shipping on all orders. Delivery usually takes 2-4 business days.</p>
            </div>
        </div>
    </div>
</div>

<!-- Notification -->
<?php if (isset($cart_success)): ?>
    <div class="notification" id="cartNotification">
        <i class="fas fa-check-circle"></i>
        <span><?php echo $cart_success; ?></span>
    </div>
<?php endif; ?>

<script>
    // Tab switching
    function showTab(tabName, event) {
        // Hide all tabs
        document.querySelectorAll('.tab-pane').forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Remove active class from all buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Show selected tab
        document.getElementById(tabName).classList.add('active');
        event.target.classList.add('active');
    }

    // Quantity selector
    const qtyInput = document.querySelector('.qty-input');
    const qtyField = document.getElementById('qtyField');
    
    document.querySelector('.minus').addEventListener('click', function() {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            qtyField.value = qtyInput.value;
        }
    });

    document.querySelector('.plus').addEventListener('click', function() {
        const max = parseInt(qtyInput.max);
        if (parseInt(qtyInput.value) < max) {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            qtyField.value = qtyInput.value;
        }
    });

    // Update hidden field when input changes
    qtyInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (value < 1) value = 1;
        if (value > parseInt(this.max)) value = parseInt(this.max);
        this.value = value;
        qtyField.value = value;
    });

    // Add to cart form submission
    document.getElementById('addToCartForm').addEventListener('submit', function(e) {
        const qty = qtyInput.value;
        const addToCartBtn = this.querySelector('.add-to-cart');
        
        // Change button text temporarily
        const originalHTML = addToCartBtn.innerHTML;
        addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Added!';
        addToCartBtn.disabled = true;
        
        setTimeout(() => {
            addToCartBtn.innerHTML = originalHTML;
            addToCartBtn.disabled = false;
        }, 1500);
    });

    // Wishlist toggle
    document.querySelector('.wishlist-btn').addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('far')) {
            icon.classList.replace('far', 'fas');
            this.style.color = '#3e7c4f'; // Dark green
            showNotification('Added to wishlist!');
        } else {
            icon.classList.replace('fas', 'far');
            this.style.color = '#8b7355'; // Light brown
            showNotification('Removed from wishlist');
        }
    });

    // Buy Now button
    document.querySelector('.buy-now').addEventListener('click', function() {
        showNotification('Redirecting to checkout...');
        setTimeout(() => {
            document.getElementById('addToCartForm').submit();
        }, 1000);
    });

    // Show notification function
    function showNotification(message) {
        // Remove existing notification
        const existing = document.querySelector('.notification:not(#cartNotification)');
        if (existing) existing.remove();
        
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `
            <i class="fas fa-info-circle"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, 3000);
    }

    // Show cart notification if exists
    const cartNotification = document.getElementById('cartNotification');
    if (cartNotification) {
        setTimeout(() => {
            cartNotification.classList.add('show');
        }, 500);
        
        setTimeout(() => {
            cartNotification.classList.remove('show');
            setTimeout(() => {
                if (cartNotification.parentNode) {
                    cartNotification.remove();
                }
            }, 300);
        }, 3000);
    }
</script>

</body>
</html>