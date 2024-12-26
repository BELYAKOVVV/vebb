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
            <div class="left" style="height:180vh;">
                <a href="about.php">О нас</a>
                <a href="history.php">История фирмы</a>
                <a href="workers.php">Сотрудники</a>
            </div>
            <div class="main">
                <h1 class="des">История</h1>
                <div class="text_and_pic">
                    <p style="font-size: 2rem;"><strong>1993 год</strong> - Первый салон Гранд Персона в Москве</p>
                    <img src="https://persona.ru/upload/iblock/1f2/1f2072acf26a91fb3cd7b47d997e107d.jpg" alt="history1" style="width: 30%;">
                </div><br><br>
                <div class="text_and_pic">
                    <p style="font-size: 2rem;"><strong>1998 год</strong> - Новый формат салона - Имидж Лаборатория</p>
                    <img src="https://persona.ru/upload/iblock/fad/fadc78f40e69077c1b84a6e213ee4a52.jpg" alt="history2" style="width: 30%;">
                </div><br><br>
                <div class="text_and_pic">
                    <p style="font-size: 2rem;"><strong>2004 год</strong> - Первый салон открытый по франшизе</p>
                    <img src="https://persona.ru/upload/iblock/ee9/27eb7wp41y3n98gxhuf27oc9sp0vsnos.jpg" alt="history3">
                </div><br><br>
                <div class="text_and_pic">
                    <p style="font-size: 2rem;"><strong>2019 год</strong> - Более 80 салонов в России</p>
                    <img src="https://persona.ru/upload/iblock/d33/8iu3r30bpismhmjxxqhusc4zc3wei0vw.jpg" alt="history4">
                </div><br><br>

                <!-- Новый блок с цитатой -->
                <div class="quote">
                    <blockquote>
                        "Персона — это не просто бренд, это символ стиля и качества."
                        <footer>— Основатель компании</footer>
                    </blockquote>
                </div><br><br>

                <!-- Новый блок с отзывами клиентов -->
                <div class="reviews">
                    <h2>Отзывы клиентов</h2>
                    <div class="review_item">
                        <p>"Отличный сервис, всегда все на высшем уровне!"</p>
                        <p><strong>Мария Иванова</strong></p>
                    </div>
                    <div class="review_item">
                        <p>"Лучшие специалисты и комфортная атмосфера. Рекомендую!"</p>
                        <p><strong>Игорь Петров</strong></p>
                    </div>
                </div>
            </div>
            <div class="right" style="height:180vh;">
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
