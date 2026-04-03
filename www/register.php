<?php
session_start();
require_once 'auth.php';

$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'webuser';
$pass = getenv('DB_PASSWORD') ?: 'webpass';
$dbname = 'apt';

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8mb4");

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Заполните все поля';
    } elseif ($password !== $confirm_password) {
        $error = 'Пароли не совпадают';
    } elseif (strlen($password) < 6) {
        $error = 'Пароль должен быть не менее 6 символов';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $username, $email, $password_hash);
        
        if ($stmt->execute()) {
            $success = 'Регистрация успешна! Теперь вы можете войти.';
        } else {
            $error = 'Пользователь с таким именем или email уже существует';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - АПТ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .register-container {
            max-width: 400px;
            margin: 3rem auto;
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-group input { width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; }
        button { width: 100%; padding: 0.8rem; background: linear-gradient(135deg, #1a4d8c 0%, #0e3a6b 100%); color: white; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background: #c9a03d; }
        .error { background: #f8d7da; color: #721c24; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; }
        .success { background: #d4edda; color: #155724; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <header>
        <h1>🏫 Ангарский политехнический техникум (АПТ)</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="about.php">О техникуме</a>
            <a href="contacts.php">Контакты</a>
        </nav>
    </header>
    <main>
        <div class="register-container">
            <h2>📝 Регистрация</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Имя пользователя</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Пароль (мин. 6 символов)</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Подтвердите пароль</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <button type="submit">Зарегистрироваться</button>
            </form>
            <div style="text-align: center; margin-top: 1rem;">
                <a href="login.php">Уже есть аккаунт? Войти</a>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ)</p>
    </footer>
</body>
</html>
