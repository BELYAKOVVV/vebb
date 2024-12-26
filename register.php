<?php
// Подключение к базе данных
$host = 'localhost'; // Хост
$dbname = 'database'; // Имя базы данных
$username = 'root'; // Имя пользователя базы данных
$password = 'root'; // Пароль (если есть)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit();
}

session_start();

// Обработка регистрации
if (isset($_POST['signUp'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хэшируем пароль

    // Проверка, существует ли уже такой пользователь
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo 'Пользователь с таким email уже существует.';
    } else {
        // Добавляем нового пользователя
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $password]);
        echo 'Регистрация успешна!';
    }
}

// Обработка авторизации
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка пользователя
    $stmt = $pdo->prepare('SELECT id, password FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Успешная авторизация, создаем сессию
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        echo 'Неверный email или пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in/up Form</title>
    <link rel="stylesheet" href="styles/css/register.css">
</head>
<body>
<h2> Sign in/up Form </h2>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="">
            <h1>Create Account</h1>
            <span>or use your email for registration</span>
            <input type="text" name="name" placeholder="Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit" name="signUp">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form method="POST" action="">
            <h1>Sign in</h1>
            <span>or use your account</span>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <a href="#">Forgot your password?</a>
            <button type="submit" name="signIn">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start your journey with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>
        Created with ❤️ by
        <a target="_blank" href="https://fantacydesigns.com/">FantacyDesigns</a> from Florin Pop.
    </p>
</footer>

<script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});
</script>
</body>
</html>
