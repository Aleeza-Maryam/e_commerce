<?php
$conn = mysqli_connect("localhost","root","","cartify");
$id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="product_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="product-container">

    <!-- Image -->
    <div class="product-image">
        <img src="../uploads/<?php echo $product['image']; ?>">
    </div>

    <!-- Details -->
    <div class="product-info">
        <h2><?php echo $product['product_name']; ?></h2>
        <p class="category"><?php echo $product['category']; ?></p>

        <div class="price">
            <span class="new">Rs <?php echo $product['discount_price']; ?></span>
            <span class="old">Rs <?php echo $product['product_price']; ?></span>
        </div>

        <p class="description">
            <?php echo $product['description']; ?>
      
        </p>

        <!-- Buttons -->
        <div class="btns">
            <button class="cart">Add to Cart</button>
            <button class="buy">Buy Now</button>
        </div>
    </div>
</div>

<!-- Fake Reviews -->
<div class="reviews">
    <h3>Customer Reviews</h3>

    <div class="review">
        ⭐⭐⭐⭐☆
        <p>Very good quality, totally satisfied 👍</p>
    </div>

    <div class="review">
        ⭐⭐⭐⭐⭐
        <p>Best product in this price range 💯</p>
    </div>

    <div class="review">
        ⭐⭐⭐⭐☆
        <p>Delivery was fast, product is amazing 😍</p>
    </div>
</div>

</body>
</html>
