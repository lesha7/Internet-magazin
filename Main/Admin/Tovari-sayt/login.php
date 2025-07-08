<?php
// Настройки подключения к базе данных
include('config.php');

// Получаем данные из формы
$email = trim($_POST['email']); // Удаляем пробелы с начала и конца строки
$password = $_POST['password'];

// Подготавливаем SQL-запрос с учётом регистра почты (LOWER)
$query = $pdo->prepare("
    SELECT personal.*, role.*
    FROM personal
    JOIN role ON personal.role = role.id
    WHERE LOWER(personal.email) = LOWER(:email)
");
$query->execute(['email' => $email]);
$user = $query->fetch();

if ($user) {
    print_r($user); // Для отладки
    
    if (password_verify($password, $user['password'])) {
        // Авторизация успешна, сохраняем данные в сессии
        session_start();
        $_SESSION['role'] = $user['role']; // Сохраняем роль пользователя в сессии
        
        header('Location: 1.php'); // Перенаправление на страницу аккаунта
        exit();
    } else {
        echo "Неправильный пароль";
    }
} else {
    echo "Пользователь не найден";
}
?>