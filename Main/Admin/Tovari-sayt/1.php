<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="1.css">
    <title>main</title>
</head>
<body>
    
    <header>
        <h1>ФигуркиМир</h1>
        <?php
    session_start(); // Запускаем сессию
    if (isset($_SESSION['role'])) {
        echo "" . htmlspecialchars($_SESSION['role']);
    } else {
        echo "Вы не авторизованы.";
    }
    ?>
    <a href="/logout.php" class="button">Выйти</a>
    <nav>	
        <nav> 
            <ul>
                <li><a href="1.php">Главная</a></li>
                <li><a href="add_product.php">Склад</a></li>
                <!-- <li><a href="3.php">Продажи</a></li> -->
                <li><a href="4.php">Финансы</a></li>
            </ul>
        </nav>
    </header>
    <!-- Основное содержимое страницы --> 
    <main>
    <div class="slider">
        <div class="slide active">
            <img src="/картинки/Johnny Silverhand.jpg" alt="Image 1">
            <img src="/картинки/V.jpg" alt="Image 2">
            <div class="caption">Новые фигурки по cyberpunk2077</div>
        </div>
        <div class="slide">
            <img src="/Фигурки/Grey Knights Strike Squad Justicar.jpg" alt="Image 3">
            <img src="/Фигурки/Grey Knights Strike Squad.jpg" alt="Image 4">
            <div class="caption">Хиты продаж</div>
        </div>
        <div class="slide">
            <img src="/картинки/chill.jpg" alt="Image 5">
            <div class="caption">Не забывайте отдыхать на рабочем месте</div>
        </div>
        <div class="navigation">
            <button class="prev" onclick="plusSlides(-1)"><<<</button>
            <button class="next" onclick="plusSlides(1)">>>></button>
        </div>
        <div class="dots">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    
    
    
    <section class="corporate-announcements">
        <h2>Корпоративные объявления</h2>
        <div class="announcements-list">
            <article>
                <h3>Плановое совещание</h3>
                <p>02 февраля в 10:00 состоится еженедельное совещание отдела продаж</p>
                <time datetime="2025-01-30">30.01.2025</time>
            </article>
            <article>
                <h3>Новый склад</h3>
                <p>Открытие нового распределительного центра намечено на 15 марта</p>
                <time datetime="2025-02-15">15.02.2025</time>
            </article>
            <article>
                <h3>Внутренний конкурс</h3>
                <p>Объявляется конкурс на лучшего сотрудника месяца с призовым фондом 50 000 рублей</p>
                <time datetime="2025-02-01">01.02.2025</time>
            </article>
        </div>
    </section>
    
    <section class="company-info">
        <h2>О Компании</h2>
        <div class="contacts">
            <h3>Контактная информация</h3>
            <p>ООО "ФигуркиМир"</p>
            <p>Адрес: 123456, г. Москва, ул. Игровая, д. 42</p>
            <p>Телефон: +7 (495) 123-45-67</p>
            <p>Email: info@figuresworld.ru</p>
        </div>

        <div class="team">
            <h3>Наша команда</h3>
            <ul>
                <li>
                    <strong>Иванов Игорь Сергеевич</strong> - Генеральный директор
                    <span>Опыт работы в индустрии более 15 лет</span>
                </li>
                <li>
                    <strong>Петрова Анна Михайловна</strong> - Директор по развитию
                    <span>Эксперт в коллекционных моделях</span>
                </li>
                <li>
                    <strong>Смирнов Дмитрий Александрович</strong> - Начальник отдела продаж
                    <span>Специалист по работе с клиентами</span>
                </li>
            </ul>
        </div>
    </section>
    </main>

    <footer>
    <p>&copy; 2025 ФигуркиМир. Все права защищены.</p>
    </footer>
    
    
    <script src="1.js"></script>

</body>
</html>