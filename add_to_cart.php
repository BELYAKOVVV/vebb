<?php
session_start(); // Старт сессии

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
    $user_id = $_SESSION['user_id']; // Идентификатор пользователя из сессии

    // Получаем данные о товаре из POST
    if (isset($_POST['product_id']) && isset($_POST['price'])) {
        $product_id = $_POST['product_id'];
        $price = $_POST['price'];

        // Добавляем товар в корзину
        $sql_add_to_cart = "INSERT INTO cart (product_id, user_id, price) VALUES ('$product_id', '$user_id', '$price')";

        if ($conn->query($sql_add_to_cart) === TRUE) {
            echo "Товар успешно добавлен в корзину!";
            header("Location: cart.php"); // Перенаправление на страницу корзины
            exit();
        } else {
            echo "Ошибка при добавлении товара в корзину: " . $conn->error;
        }
    } else {
        echo "Ошибка: недостающие данные о товаре.";
    }
} else {
    echo "Пожалуйста, войдите в систему, чтобы добавить товар в корзину.";
}

$conn->close();
?>
