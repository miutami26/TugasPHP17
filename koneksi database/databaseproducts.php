<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "tugas18";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
    exit;
}
function insertProducts($productsName, $productsPrice, $productsdes, $productsCategory, $productsBy)
{
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO products (name, price, description, category_id, status, created_at, updated_at, created_by)
        VALUES (?, ?, ?, ?, ?, NOW(), NOW(), ?)
    ");
    $status = 'waiting';
    $stmt->execute([$productsName, $productsPrice, $productsdes, $productsCategory, $status, $productsBy]);
    return "Produk " . $productsName . " berhasil ditambahkan";
}

$productsName = "laptop";
$productsPrice = 250000;
$productsCategory = 12;
$productsdes = "produk Electronik";
$productsBy = 1;

$result = insertProducts($productsName, $productsPrice, $productsdes, $productsCategory, $productsBy);
echo $result;