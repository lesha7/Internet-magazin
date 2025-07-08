<?php
define('USER', 'root');
define('PASSWORD', '');
define('HOST', '127.127.126.50:3306');
define('DATABASE', 'Zzzz');

try { 
    $pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>