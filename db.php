<?php
$servername = "localhost";
$username = "root"; // или ваше имя пользователя
$password = "root"; // или ваш пароль
$dbname = "database"; // имя вашей базы данных

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
