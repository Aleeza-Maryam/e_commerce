<?php
header("Content-Type: application/json");

$conn = mysqli_connect("localhost", "root", "", "cartify");

if (!$conn) {
    echo json_encode([]);
    exit;
}

$query = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn, $query);

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

echo json_encode($products);
