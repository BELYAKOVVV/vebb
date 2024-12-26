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
                <h1 class="des">Наши сотрудники</h1>
                <table class="contacts">
                    <tr>
                        <td>
                            Бабичев Иван Викторович
                        </td>
                        <td>
                            Генеральный директор
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Гаджиев Раджаб
                        </td>
                        <td>
                            Уборщица
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Беляков Максим Андреевич
                        </td>
                        <td>
                            Front-end разработчик
                        </td>
                    </tr>
                </table>

                <!-- Новая секция с сотрудниками -->
                <div class="team-section">
                    <h2>Наша команда</h2>
                    <div class="team-member">
                        <img src="https://via.placeholder.com/100" alt="team1">
                        <div>
                            <h3>Бабичев Иван Викторович</h3>
                            <p>Генеральный директор</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <img src="https://via.placeholder.com/100" alt="team2">
                        <div>
                            <h3>Гаджиев Раджаб</h3>
                            <p>Уборщица</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <img src="https://via.placeholder.com/100" alt="team3">
                        <div>
                            <h3>Беляков Максим Андреевич</h3>
                            <p>Front-end разработчик</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right">
                <form class="search">
                    <input type="text" placeholder="Поиск" required>
                    <button>Искать</button>
                </form>
                <a href="https://www.avito.ru/moskva/zapchasti_i_aksessuary/shiny_diski_i_kolesa/shiny-ASgBAgICAkQKJooLgJ0B?cd=1&f=ASgBAQICBEQKJooLgJ0B8ooOpIKUAfyGFQIBQLwLJJKiAZCiAQ"><img src="https://r.mradx.net/imgs/b8/53/45f9bc89e42398c9.jpg" alt="iphone" class="banner"></a>
                <a href="https://vk.com/msh_events_msk?ad_id=189596971"><img src="https://sun1-30.userapi.com/DpF9Xtztvqz_0oEd9T4PzFdZgfKCquSiCYkPKQ/bSSLFQ2HHU4.jpg" alt="max" class="banner"></a>
            </div>
        </div>
        <footer class="footer">
            <p>©Все права защищены</p>
        </footer>
    </body>
</html>
