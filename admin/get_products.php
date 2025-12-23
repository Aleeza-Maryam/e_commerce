<?php
header("Content-Type: application/json");

// Database connection
$conn = mysqli_connect("localhost", "root", "", "cartify");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]);
    exit;
}

// Check if table exists
$tableCheck = mysqli_query($conn, "SHOW TABLES LIKE 'products'");
if (mysqli_num_rows($tableCheck) == 0) {
    echo json_encode(["error" => "Products table does not exist"]);
    exit;
}

// Query all products
$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . mysqli_error($conn)]);
    exit;
}

$products = [];
while ($row = mysqli_fetch_assoc($result)) {

    $row = array_merge([
        'id' => '',
        'product_name' => '',
        'sku' => '',
        'brand' => '',
        'product_price' => '',
        'stock' => '',
        'status' => '',
        'sold_count' => '',
        'category' => '',
        'short_description' => '',
        'description' => '',
        'image' => 'default.jpg'
    ], $row);
    
    $products[] = $row;
}

mysqli_close($conn);

echo json_encode($products);
?>