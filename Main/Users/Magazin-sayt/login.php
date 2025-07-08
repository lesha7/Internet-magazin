<?php
include('config.php');

$email = trim($_POST['email']);
$password = $_POST['password'];

// Получаем пользователя вместе с названием его роли
$query = $pdo->prepare("
    SELECT personal.*, role.role AS role_name 
    FROM personal
    JOIN role ON personal.role = role.id
    WHERE LOWER(personal.email) = LOWER(:email)
");
$query->execute(['email' => $email]);
$user = $query->fetch();

if ($user) {
    if (password_verify($password, $user['password'])) {
        session_start();
        
        // Сохраняем НАЗВАНИЕ РОЛИ в сессию
        $_SESSION['role'] = $user['role_name']; 

        // Перенаправление по ролям
        if ($user['role_name'] == 'Пользователь') {
            header('Location: main.php');
        } else {
            header('Location: 1.php');
        }

        exit();
    } else {
        echo "Неправильный пароль";
    }
} else {
    echo "Пользователь не найден";
}
?>




<!-- include('config.php');

$email = trim($_POST['email']);
$password = $_POST['password'];

// Выбираем название роли из таблицы role
$query = $pdo->prepare("
    SELECT personal.*, role.id as role_id, role.role as role_name 
    FROM personal
    JOIN role ON personal.role = role.id
    WHERE LOWER(personal.email) = LOWER(:email)
");
$query->execute(['email' => $email]);
$user = $query->fetch();

if ($user) {
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['role_id'] = $user['role_id']; // ID для проверок
        $_SESSION['role_name'] = $user['role_name']; // Название для отображения
        
        // Перенаправление по роли
        if ($_SESSION['role_id'] == 3) {
            header('Location: main.php');
        } else {
            header('Location: 1.php');
        }
        exit();
    } else {
        echo "Неправильный пароль";
    }
} else {
    echo "Пользователь не найден";
} -->