<?php
define('USER', 'aleksuvarg');
define('PASSWORD', '123456Qw');
define('HOST', 'localhost');
define('DATABASE', 'aleksuvarg');

try { 
    $pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE."", USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>