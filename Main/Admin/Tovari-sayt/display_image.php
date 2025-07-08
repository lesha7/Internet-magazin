<?php
require 'config.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product && !empty($product['image'])) {
        header("Content-Type: image/jpeg"); // или другой тип в зависимости от загружаемых изображений
        echo $product['image'];
    } else {
        echo "Изображение не найдено";
    }
    exit;
}