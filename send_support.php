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

// Получаем данные из формы
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user_id'])) {
    // Пользователь авторизован, получаем его имя
    $user_id = $_SESSION['user_id'];
} else {
    // Пользователь не авторизован, используем имя из формы
    $user_id = null;
}

// Подготовка запроса для вставки данных в таблицу
$sql = "INSERT INTO support (name, email, message) VALUES (?, ?, ?)";

// Подготовка и выполнение запроса
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message); // Привязываем параметры
$stmt->execute();

// Проверка успешности выполнения
if ($stmt->affected_rows > 0) {
    echo "Ваше сообщение успешно отправлено!";
} else {
    echo "Произошла ошибка при отправке сообщения.";
}

// Закрытие подключения
$stmt->close();
$conn->close();
?>
