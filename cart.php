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
               <!-- Секция для корзины -->
    <div class="cart-section">
        <h2>Корзина</h2>
        <div class="cart">
        <?php
// Подключение к базе данных
$servername = "localhost"; 
$username = "root";        
$password = "root";        
$dbname = "database";      

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<p>Вы не авторизованы. Пожалуйста, войдите в систему, чтобы увидеть корзину.</p>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Получение информации о товарах из корзины
$sql = "
    SELECT 
        products.id,
        products.usluga_name,
        products.cost,
        products.img_url,
        cart.cart_id
    FROM 
        cart
    INNER JOIN 
        products 
    ON 
        cart.product_id = products.id
    WHERE 
        cart.user_id = '$user_id'
";

$result = $conn->query($sql);

// Инициализация переменной для подсчета итоговой стоимости
$totalCost = 0;

// Проверка наличия товаров в корзине
if ($result->num_rows > 0) {
    echo '<div class="cart">';

    echo '<table class="cart-table">';
    echo '<thead>
            <tr>
                <th>Изображение</th>
                <th>Название услуги</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        // Добавляем стоимость товара к итоговой стоимости
        $totalCost += $row['cost'];

        echo '<tr>';
        echo '<td><img src="' . htmlspecialchars($row['img_url']) . '" alt="' . htmlspecialchars($row['usluga_name']) . '" width="100"></td>';
        echo '<td>' . htmlspecialchars($row['usluga_name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['cost']) . ' руб.</td>';
        echo '<td>
                <form method="POST" action="remove_from_cart.php">
                    <input type="hidden" name="cart_id" value="' . htmlspecialchars($row['cart_id']) . '">
                    <button type="submit" class="btn-delete">Удалить</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';

    // Отображение итоговой стоимости
    echo '<div class="cart-total">';
    echo '<p>Итоговая стоимость: <strong>' . $totalCost . ' руб.</strong></p>';
    echo '</div>';

    echo '</div>';
} else {
    echo '<p>Ваша корзина пуста.</p>';
}

// Закрытие соединения с базой данных
$conn->close();
?>


        </div>
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

</body>
</html>
