<?php
require_once 'auth.php';
header('Content-Type: text/html; charset=utf-8');

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $success_message = 'Спасибо! Ваше сообщение отправлено.';
    } else {
        $error_message = 'Пожалуйста, заполните все поля.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты - АПТ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>📞 Контакты АПТ</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="about.php">О техникуме</a>
            <a href="contacts.php">Контакты</a>
            <?php if (isUser()): ?>
                <a href="students.php">Студенты</a>
                <a href="teachers.php">Преподаватели</a>
            <?php endif; ?>
            <?php if (isAdmin()): ?>
                <a href="admin_panel.php">🔧 Админ-панель</a>
            <?php endif; ?>
            <?php if (isLoggedIn()): ?>
                <a href="logout.php" style="background: #8b3c2c;">👤 <?php echo $_SESSION['username']; ?> (Выход)</a>
            <?php else: ?>
                <a href="login.php">🔐 Вход</a>
                <a href="register.php">📝 Регистрация</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <div class="contacts-container">
            <div class="contact-info">
                <h2>Контактная информация</h2>
                <p><strong>📍 Адрес:</strong> 665830, Иркутская область, г. Ангарск, ул. Техническая, д. 1</p>
                <p><strong>📞 Телефон:</strong> +7 (3955) 55-55-55</p>
                <p><strong>📠 Факс:</strong> +7 (3955) 55-55-56</p>
                <p><strong>📧 Email:</strong> info@apt.ru</p>
                <p><strong>🕐 Часы работы:</strong> Пн-Пт, 8:00 - 17:00</p>
                
                <h2>Приемная комиссия</h2>
                <p><strong>📞 Телефон:</strong> +7 (3955) 55-55-77</p>
                <p><strong>📧 Email:</strong> priem@apt.ru</p>
                <p><strong>🕐 Часы работы:</strong> Пн-Пт, 9:00 - 16:00</p>
            </div>
            <div class="contact-form">
                <h2>Напишите нам</h2>
                <?php if ($success_message): ?>
                    <div class="success"><?php echo $success_message; ?></div>
                <?php endif; ?>
                <?php if ($error_message): ?>
                    <div class="error"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div>
                        <label for="name">Имя:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="message">Сообщение:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ)</p>
        <p>г. Ангарск, ул. Техническая, д. 1 | ☎ +7 (3955) 55-55-55</p>
    </footer>
</body>
</html>
