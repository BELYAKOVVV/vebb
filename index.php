<?php
session_start(); // Стартуем сессию

// Подключение к базе данных
$servername = "localhost"; // Имя хоста
$username = "root";        // Имя пользователя
$password = "root";            // Пароль
$dbname = "database";      // Имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверка, авторизован ли пользователь
if (isset($_SESSION['user_id'])) {
    // Пользователь авторизован, получаем данные
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT name FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['name']; // Имя пользователя
    }
} else {
    $username = null; // Пользователь не авторизован
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Персона - Главная</title>
    <link href="styles/css/styles.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header class="header">
    <div class="header_main">
        <img src="https://persona.ru/pageproofs/img/logo.png" alt="logo" class="logo">

        
        <?php if ($username): ?>
            <!-- Если пользователь авторизован, показываем его имя -->
            <p>Привет, <?php echo htmlspecialchars($username); ?>!</p>
            <a href="logout.php" class="logout">Выйти</a>

        <?php else: ?>
            <!-- Если не авторизован, показываем форму для входа -->
            <form class="login" action="login.php" method="POST">
                <input type="text" name="login" id="login" placeholder="Логин" required>
                <input type="password" name="password" id="password" placeholder="Пароль" required>
                <button type="submit" id="in">Войти</button>
                <a href="register.php" id="in">Регистрация</a>
            </form>
        <?php endif; ?>
    </div>
    <div class="header_help">
        <div class="header_hrefs">
            <a href="index.php" class="razdel">Главная</a>
            <a href="catalog.php" class="razdel">Каталог</a>
            <a href="contacts.php" class="razdel">Контакты</a>
            <a href="cart.php" class="razdel">Корзина</a>

        </div>
    </div>
</header>

<div class="content">
    <div class="left">
        <a href="about.php">О нас</a>
        <a href="history.php">История фирмы</a>
        <a href="workers.php">Сотрудники</a>
    </div>
    <div class="main">
        <h1 class="des">Главная</h1>
        <div class="text_and_pic">
            <p>Красоту Творим Любовью! Поразить своего мужчину в самое сердце? Быть «первой леди» на вручении государственной награды? Мы сделаем это! Наши специалисты создали стиль тысячам прекрасных дам, от первых лиц высшего общества, до представительниц маргинальных «тусовок». Подберем наиболее подходящий вам стиль. Примем во внимание, ваш образ жизни, привычку одеваться и, конечно же, особенности лица и структуру волос. Создадим ваши самые смелые желания, и поможем советом. Ваш стиль будет безупречен!</p>
            <img src="https://persona.ru/upload/iblock/5a4/5a48a7f4c71b552de34e307ea716ea76.jpg" alt="ur">
        </div>
        <div id="slider">
    <a href="#" class="control_next">>></a>
    <a href="#" class="control_prev"><</a>
    <ul>
        <li><img src="img/slider/1.jpg" alt="Slide 1"></li>
        <li><img src="img/slider/2.jpg" alt="Slide 2"></li>
        <li><img src="img/slider/3.jpg" alt="Slide 3"></li>
        <li><img src="img/slider/4.jpg" alt="Slide 4"></li>
        
    </ul>
</div>

<div class="slider_option">
    <input type="checkbox" id="checkbox">
    <label for="checkbox">Autoplay Slider</label>
</div>



    </div>
    <div class="right">
        <form class="search">
            <input type="text" placeholder="Поиск" required>
            <button type="submit">Искать</button>
        </form>
        <a href="https://www.avito.ru/moskva/zapchasti_i_aksessuary/shiny_diski_i_kolesa/shiny-ASgBAgICAkQKJooLgJ0B?cd=1&f=ASgBAQICBEQKJooLgJ0B8ooOpIKUAfyGFQIBQLwLJJKiAZCiAQ">
            <img src="https://r.mradx.net/imgs/b8/53/45f9bc89e42398c9.jpg" alt="iphone" class="banner">
        </a>
        <a href="https://vk.com/msh_events_msk?ad_id=189596971">
            <img src="https://sun1-30.userapi.com/DpF9Xtztvqz_0oEd9T4PzFdZgfKCquSiCYkPKQ/bSSLFQ2HHU4.jpg" alt="max" class="banner">
        </a>
    </div>
</div>

<footer class="footer">
    <p>©Все права защищены</p>
</footer>
<!-- Подключение JavaScript для слайдера -->
<script>
    document.querySelector('.control_next').addEventListener('click', function() {
        const slider = document.querySelector('#slider ul');
        slider.appendChild(slider.firstElementChild); // Перемещаем первый элемент в конец списка
    });

    document.querySelector('.control_prev').addEventListener('click', function() {
        const slider = document.querySelector('#slider ul');
        slider.insertBefore(slider.lastElementChild, slider.firstElementChild); // Перемещаем последний элемент в начало списка
    });

    // Автопрокрутка слайдера
    const checkbox = document.querySelector('#checkbox');
    let autoPlayInterval;

    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            autoPlayInterval = setInterval(function() {
                document.querySelector('.control_next').click();
            }, 2000);
        } else {
            clearInterval(autoPlayInterval);
        }
    });
</script>

</body>
</html>
