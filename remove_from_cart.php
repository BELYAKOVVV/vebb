<?php
session_start();

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
if (!isset($_SESSION['user_id'])) {
    echo "<p>Вы не авторизованы.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];

    // Удаление товара из корзины
    $sql = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "<p>Ошибка удаления товара из корзины.</p>";
    }
    $stmt->close();
}

$conn->close();
?>
