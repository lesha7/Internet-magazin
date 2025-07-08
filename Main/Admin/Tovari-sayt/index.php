<?php
// Настройки подключения к базе данных
session_start();
include('config.php');
if (isset($_POST['regbtn'])) {
// Получаем данные из формы
$username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Проверяем пароли
    if ($password !== $repeat_password) {
        echo "Пароли не совпадают";
        exit;
    }

    // Хэшируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Подготавливаем SQL-запрос
    if (isset($pdo)) { // Проверяем наличие объекта PDO
        $query = $pdo->prepare("INSERT INTO personal (username, email, password) VALUES (:username, :email, :hashed_password)");
        $query->bindParam(":hashed_password", $hashed_password);
        $query->bindParam(":email", $email);
        $query->bindParam(":username", $username);

        if ($query->execute()) {
            echo '<p class="success">Регистрация прошла успешно!</p>';
        } else {
            echo '<p class="error">Произошла ошибка при регистрации!</p>';
        }
    } else {
        echo "Ошибка подключения к базе данных.";
    }
}
?>


<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="reg.css">
    <title>Регистрация и Вход</title>
</head>
<body>

<div class="container">
    <div class="dws-form">
        <label title="Вкладка 1">Вход</label>
        <label title="Вкладка 2">Регистрация</label>
    </div>

    <div class="tab-form login-form">
        <h1>Вход</h1>
        <form action="login.php" method="post">
            <label for="login-email"><b>Email</b></label>
            <input type="email" id="login-email" name="email" placeholder="Введите вашу почту" required>

            <label for="login-psw"><b>Пароль</b></label>
            <input type="password" id="login-psw" name="password" placeholder="Введите пароль" required>

            <button type="submit" class="loginbtn">Вход</button>
        </form>
    </div>

    <div class="tab-form register-form" style="display:none;">
        <h1>Регистрация</h1>
        <form action="index.php" method="post">
            <label for="register-login"><b>Логин</b></label>
            <input type="text" id="register-login" name="username" placeholder="Введите ваш логин" required>

            <label for="register-email"><b>Email</b></label>
            <input type="email" id="register-email" name="email" placeholder="Введите вашу почту" required>

            <label for="register-psw"><b>Пароль</b></label>
            <input type="password" id="register-psw" name="password" placeholder="Введите пароль" required>

            <label for="register-psw-repeat"><b>Повторить пароль</b></label>
            <input type="password" id="register-psw-repeat" name="repeat_password" placeholder="Повторите пароль" required>

            <button name="regbtn" type="submit" class="reg">Регистрация</button>
        </form>
    </div>

    <div id="user-login" style="display:none;"></div>
</div>

<script>
    // Скрипт для переключения между формами
    document.addEventListener('DOMContentLoaded', function() {
        const loginTab = document.querySelector('.dws-form label[title="Вкладка 1"]');
        const registerTab = document.querySelector('.dws-form label[title="Вкладка 2"]');
        const loginForm = document.querySelector('.login-form');
        const registerForm = document.querySelector('.register-form');

        loginTab.addEventListener('click', function() {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        });

        registerTab.addEventListener('click', function() {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });
    });
</script>
</body>
</html>