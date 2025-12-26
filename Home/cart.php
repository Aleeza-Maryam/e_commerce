<?php
ini_set('session.cookie_path', '/');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Cartify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            background: #f5f1eb;
        }
        
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(44, 62, 41, 0.08);
        }
        
        h2 {
            color: #2c5d3b;
            margin-bottom: 30px;
            font-size: 32px;
        }
        
        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            border-bottom: 2px solid #e8dfd5;
            align-items: center;
        }
        
        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e8dfd5;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-details h4 {
            color: #1e3a2c;
            margin-bottom: 10px;
            font-size: 20px;
        }
        
        .item-details p {
            color: #5a4a3a;
            margin: 5px 0;
        }
        
        .subtotal {
            color: #2c5d3b;
            font-weight: bold;
            font-size: 18px;
        }
        
        .total-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e8dfd5;
            text-align: right;
        }
        
        .total-amount {
            font-size: 28px;
            color: #2c5d3b;
            font-weight: 800;
            margin: 10px 0;
        }
        
        .checkout-btn {
            background: linear-gradient(135deg, #2c5d3b, #3e7c4f);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 20px;
        }
        
        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(44, 93, 59, 0.3);
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px;
            color: #8b7355;
        }
        
        .empty-cart i {
            font-size: 64px;
            margin-bottom: 20px;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 25px;
            background: #f8f4f0;
            color: #5a4a3a;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            border: 2px solid #e8dfd5;
            margin-top: 20px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }
        
        .qty-btn {
            width: 35px;
            height: 35px;
            border: 2px solid #c4a77d;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            color: #5a4a3a;
        }
        
        .qty-input {
            width: 60px;
            height: 35px;
            text-align: center;
            border: 2px solid #c4a77d;
            border-radius: 6px;
        }
        
        .remove-btn {
            background: #ff6b6b;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2><i class="fas fa-shopping-cart"></i> Your Shopping Cart</h2>
    
    <?php
    // Get cart from session
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
    if (empty($cart)):
    ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-basket"></i>
            <h3>Your cart is empty</h3>
            <p>Add some products to get started!</p>
            <a href="main_page.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>
    <?php else: ?>
        <form method="POST" action="update_cart.php">
            <?php
            $total = 0;
            foreach ($cart as $id => $item):
                $subtotal = $item['price'] * $item['qty'];
                $total += $subtotal;
            ?>
                <div class="cart-item">
                    <input type="checkbox" name="selected_items[]" value="<?php echo $id; ?>" checked>
                    
                    <img src="../admin/uploads/<?php echo htmlspecialchars($item['image']); ?>" 
                         alt="<?php echo htmlspecialchars($item['name']); ?>">
                    
                    <div class="item-details">
                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                        <p>Price: Rs <?php echo number_format($item['price'], 2); ?></p>
                        
                        <div class="quantity-control">
                            <label>Quantity:</label>
                            <button type="button" class="qty-btn minus" data-id="<?php echo $id; ?>">-</button>
                            <input type="number" class="qty-input" 
                                   name="quantity[<?php echo $id; ?>]" 
                                   value="<?php echo $item['qty']; ?>" 
                                   min="1" max="50">
                            <button type="button" class="qty-btn plus" data-id="<?php echo $id; ?>">+</button>
                        </div>
                        
                        <p class="subtotal">Subtotal: Rs <?php echo number_format($subtotal, 2); ?></p>
                        
                        <button type="button" class="remove-btn" onclick="removeItem(<?php echo $id; ?>)">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <div class="total-section">
                <h3>Total Amount:</h3>
                <div class="total-amount">Rs <?php echo number_format($total, 2); ?></div>
                
                <button type="submit" class="checkout-btn" name="update_cart">
                    <i class="fas fa-sync-alt"></i> Update Cart
                </button>
                
                <button type="button" class="checkout-btn" onclick="checkout()" style="margin-left: 15px;">
                    <i class="fas fa-shopping-bag"></i> Proceed to Checkout
                </button>
            </div>
        </form>
        
        <div style="margin-top: 20px;">
            <a href="main_page.php" class="back-btn">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
            
            <button type="button" class="remove-btn" onclick="clearCart()" style="margin-left: 15px;">
                <i class="fas fa-trash-alt"></i> Clear Entire Cart
            </button>
        </div>
    <?php endif; ?>
</div>

<script>
    // Quantity controls
    document.querySelectorAll('.qty-btn.minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`input[name="quantity[${id}]"]`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });

    document.querySelectorAll('.qty-btn.plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`input[name="quantity[${id}]"]`);
            if (parseInt(input.value) < 50) {
                input.value = parseInt(input.value) + 1;
            }
        });
    });

    function removeItem(id) {
        if (confirm('Remove this item from cart?')) {
            window.location.href = 'remove_from_cart.php?id=' + id;
        }
    }

    function clearCart() {
        if (confirm('Clear entire cart?')) {
            window.location.href = 'clear_cart.php';
        }
    }

    function checkout() {
        alert('Checkout feature coming soon!');
    }
</script>

</body>
</html>