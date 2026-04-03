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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, username, password_hash, role FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user_data = $result->fetch_assoc()) {
            if (password_verify($password, $user_data['password_hash'])) {
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['role'] = $user_data['role'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Неверный пароль';
            }
        } else {
            $error = 'Пользователь не найден';
        }
    } else {
        $error = 'Заполните все поля';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - АПТ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 3rem auto;
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, #1a4d8c 0%, #0e3a6b 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }
        button:hover {
            background: #c9a03d;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .register-link {
            text-align: center;
            margin-top: 1rem;
        }
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
        <div class="login-container">
            <h2>🔐 Вход в систему</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Логин или Email</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Войти</button>
            </form>
            <div class="register-link">
                <a href="register.php">Нет аккаунта? Зарегистрироваться</a>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ)</p>
    </footer>
</body>
</html>
