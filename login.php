<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверяем, есть ли пользователь с таким email
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php'); // Перенаправление на index.php
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
