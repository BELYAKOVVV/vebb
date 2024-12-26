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
            <div class="left" style="height:90vh;">
                <a href="about.php">О нас</a>
                <a href="history.php">История фирмы</a>
                <a href="workers.php">Сотрудники</a>
            </div>
            <div class="main">
                <h1 class="des">Контакты</h1>
                <div class="text_and_pic">
                    <p>г. Котельники, 1-й Покровский пр-д, д. 5, (14-й км МКАД)<br><br>+7 (499) 380-78-36<br>
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1ee54a29c8ca97d82225bdf860e0d3f8a2f17a45d089cba365ae443aa453a4d8&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script></p>
                    <img src="https://persona.ru/upload/iblock/a04/tc2cyp99lhaafc1obayhub0yneumamlb.jpg" alt="cont" style="object-fit: contain;">
                </div>
                <h1 class="des">Связаться с нами</h1>
                <form class="vopros" action="send_support.php" method="POST">
                <input type="text" name="name" placeholder="Имя" required>
                <input type="email" name="email" placeholder="email" required>
                <textarea name="message" placeholder="Ваш текст" required></textarea>
                <button type="submit">Отправить</button>
            </form>

            </div>
            <div class="right" style="height:90vh;">
                <form class="search">
                    <input type="text" placeholder="Поиск" required>
                    <button>Искать</button>
                </form>
                <a href="https://www.avito.ru/moskva/zapchasti_i_aksessuary/shiny_diski_i_kolesa/shiny-ASgBAgICAkQKJooLgJ0B?cd=1&f=ASgBAQICBEQKJooLgJ0B8ooOpIKUAfyGFQIBQLwLJJKiAZCiAQ"><img src="https://r.mradx.net/imgs/b8/53/45f9bc89e42398c9.jpg" alt="iphone" class="banner"></a>
                <a href="https://vk.com/msh_events_msk?ad_id=189596971"><img src="https://sun1-30.userapi.com/DpF9Xtztvqz_0oEd9T4PzFdZgfKCquSiCYkPKQ/bSSLFQ2HHU4.jpg" alt="max" class="banner"></a>
            </div>
        </div>
        <div class="footer">
            <p>©Все права защищены</p>
        </div>
    </body>
</html>