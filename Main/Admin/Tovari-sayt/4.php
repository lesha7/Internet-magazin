<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="4.css">
    <title></title>
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
            <ul>
                <li><a href="1.php">Главная</a></li>
                <li><a href="add_product.php">Склад</a></li>
                <!-- <li><a href="3.php">Продажи</a></li> -->
                <li><a href="4.php">Финансы</a></li>
            </ul>
        </nav>
    </header>


    <main>
    <div id="columnchart_material" style="width: 1500px; height: 800px; position:relative; left: 550px"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Месяц', 'расходы', 'заработано', 'прибыль'],
          ['Январь', 150000, 250000, 100000],
          ['Февраль', 110000, 260000, 150000],
          ['Март', 260000, 330000, 70000],
          ['Апрель', 80000, 170000, 90000],
          ['Май', 95000, 145000, 50000],
          ['Июнь', 130000, 280000, 150000],
          ['Июль', 115000, 190000, 75000],
          ['Август', 160000, 258000, 98000],
          ['Сентябрь', 120000, 215000, 95000],
          ['Октябрь', 145000, 275000, 130000],
          ['Ноябрь', 105000, 270000, 165000],
          ['Декабрь', 200000, 310000, 110000],
        ]);

        var options = {
          chart: {
            title: 'Финансовый отчёт',
            subtitle: 'расходы, заработано, прибыль',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


        <section>
            <h2>Добро пожаловать на страницу управления</h2>
            <p>Здесь вы можете управлять данными вашего магазина.</p>
        </section>
    </main>

    <footer>
    <p>&copy; 2025 ФигуркиМир. Все права защищены.</p>
    </footer>

</body>
</html>