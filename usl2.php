<?php
session_start(); // Стартуем сессию

// Подключение к базе данных
$servername = "localhost"; // Имя хоста
$username = "root";        // Имя пользователя
$password = "root";        // Пароль
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

// Запрос для получения товара с id = 1
$sql_product = "SELECT * FROM products WHERE id = 2";
$result_product = $conn->query($sql_product);

// Проверка, есть ли товар с id = 1
if ($result_product->num_rows > 0) {
    $row_product = $result_product->fetch_assoc();
    $usluga_name = $row_product['usluga_name'];
    $cost = $row_product['cost'];
    $duration = $row_product['duration'];
    $img_url = $row_product['img_url'];
    $category = $row_product['category'];
    $brands = $row_product['brands'];
} else {
    $usluga_name = "Не найдено";
    $cost = "Не указано";
    $duration = "Не указано";
    $img_url = "";
    $category = "Не указано";
    $brands = "Не указано";
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
        <h1 class="des"><?php echo htmlspecialchars($usluga_name); ?></h1>
        <div class="text_and_pic">
            <p>
                Вам будет к лицу ваш новый цвет! Хотите ли вы только освежить свой образ или вам не дает покоя идея радикального изменения стиля, наши специалисты помогут реализовать самые смелые идеи и современные тренды.
            </p>
            <img src="<?php echo htmlspecialchars($img_url); ?>" alt="usl1">
        </div>
        <ul>
            <li>
                Цена:
                <ul>
                    <li>
                        от <?php echo htmlspecialchars($cost); ?> рублей
                    </li>
                </ul>
            </li>
            <li>
                Длительность:
                <ul>
                    <li>
                        <?php echo htmlspecialchars($duration); ?> минут
                    </li>
                </ul>
            </li>
            <li>
                Категория:
                <ul>
                    <li>
                        <?php echo htmlspecialchars($category); ?>
                    </li>
                </ul>
            </li>
            <li>
                Бренды, которыми мы пользуемся:
                <ol>
                    <li>
                        <?php echo htmlspecialchars($brands); ?>
                    </li>
                </ol>
            </li>
        </ul>
        <form method="POST">
        <button class="add-to-cart-btn">Добавить в корзину</button>

        </form>
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

<div class="footer">
    <p>© Все права защищены</p>
</div>
<script>
    jQuery(document).ready(function ($) {

$('#checkbox').change(function(){
  setInterval(function () {
      moveRight();
  }, 3000);
});

  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;
  
  $('#slider').css({ width: slideWidth, height: slideHeight });
  
  $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
  
  $('#slider ul li:last-child').prependTo('#slider ul');

  function moveLeft() {
      $('#slider ul').animate({
          left: + slideWidth
      }, 200, function () {
          $('#slider ul li:last-child').prependTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  function moveRight() {
      $('#slider ul').animate({
          left: - slideWidth
      }, 200, function () {
          $('#slider ul li:first-child').appendTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  $('a.control_prev').click(function () {
      moveLeft();
  });

  $('a.control_next').click(function () {
      moveRight();
  });

});    

</script>
</body>
</html>

<?php
// Закрываем соединение с базой данных
$conn->close();
?>
