<?php
require 'config.php';
session_start();

// Обработка редактирования и удаления товара
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Удаление товара
    if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Обработка редактирования товара
    if (isset($_POST['edit_product'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // Обработка загрузки нового изображения
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $stmt = $pdo->prepare("UPDATE products SET name = :name, image = :image, price = :price, quantity = :quantity WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'price' => $price,
                'quantity' => $quantity
            ]);
        } else {
            // Обновление без изображения
            $stmt = $pdo->prepare("UPDATE products SET name = :name, price = :price, quantity = :quantity WHERE id = :id");
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity
            ]);
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }

    // Существующий код добавления товара
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
            $stmt = $pdo->prepare("INSERT INTO products (name, image, price, quantity) VALUES (:name, :image, :price, :quantity)");
            $stmt->execute([
                'name' => $name, 
                'image' => $image, 
                'price' => $price, 
                'quantity' => $quantity
            ]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)");
            $stmt->execute(['name' => $name, 'price' => $price, 'quantity' => $quantity]);
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Получение всех товаров из базы данных
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление товарами</title>
    <link rel="stylesheet" href="2.css">
    <script src="2.js"></script>
</head>
<body>
    <header>
        <h1>ФигуркиМир</h1>
        <?php
        if (isset($_SESSION['role'])) {
            echo "" . htmlspecialchars($_SESSION['role']);
        } else {
            echo "Вы не авторизованы.";
        }
        ?>
        <a href="/logout.php" class="button">Выйти</a>
        <nav>	
            <ul>
                <li><a href="1.php">Главная</a></li>
                <li><a href="add_product.php">Склад</a></li>
                <!-- <li><a href="3.php">Продажи</a></li> -->
                <li><a href="4.php">Финансы</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
    
    <form method="post" enctype="multipart/form-data">
        <label for="name">Название товара:</label>
        <input type="text" id="name" name="name" required>

        <label for="image">Изображение товара:</label>
        <input type="file" id="image" name="image" accept="image/*" class="file-input">

        <label for="price">Цена в $ за шт:</label>
        <input type="number" id="price" name="price" required step="0.01">

        <label for="quantity">Количество:</label>
        <input type="number" id="quantity" name="quantity" required>

        <button type="submit" name="add_product" class="btn btn-save">Добавить товар</button>
    </form>

    <h2>Список товаров</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Цена в $ за шт.</th>
                <th>Количество</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <!-- Строка просмотра -->
                <tr id="view_<?php echo $product['id']; ?>">
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="display_image.php?id=<?php echo $product['id']; ?>" 
                                 alt="Изображение товара" 
                                 style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            Нет изображения
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td>
                        <button class="btn btn-edit" onclick="enableEdit(<?php echo $product['id']; ?>)">Редактировать</button>
                        <button class="btn btn-delete" onclick="confirmDelete(<?php echo $product['id']; ?>)">Удалить</button>
                    </td>
                </tr>

                <!-- Строка редактирования -->
                <tr id="edit_<?php echo $product['id']; ?>" style="display:none;">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </td>
                        <td>
                            <input type="file" name="image" accept="image/*" class="file-input">
                            <?php if (!empty($product['image'])): ?>
                                <small>Текущее изображение будет заменено</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
                        </td>
                        <td>
                            <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required>
                        </td>
                        <td>
                            <button type="submit" name="edit_product" class="btn btn-save">Сохранить</button>
                            <button type="button" onclick="cancelEdit(<?php echo $product['id']; ?>)" class="btn btn-cancel">Отмена</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </main>

    <footer>
        <p>&copy; 2025 ФигуркиМир. Все права защищены.</p>
    </footer>

</body>
</html>
