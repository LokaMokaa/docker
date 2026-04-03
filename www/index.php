<?php
require_once 'auth.php';
header('Content-Type: text/html; charset=utf-8');

$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'webuser';
$pass = getenv('DB_PASSWORD') ?: 'webpass';
$dbname = 'apt';

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8mb4");

$students_count = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'] ?? 0;
$teachers_count = $conn->query("SELECT COUNT(*) as count FROM teachers")->fetch_assoc()['count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АПТ - Ангарский политехнический техникум</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🏫 Ангарский политехнический техникум (АПТ)</h1>
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
        <section class="hero">
            <h2>Добро пожаловать в АПТ!</h2>
            <p>Ангарский политехнический техникум — современное образовательное учреждение</p>
        </section>
        
        <section class="gallery-section">
            <h2>📸 Фотогалерея техникума</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <div class="image-container">
                        <img src="/uploads/main/photo1.jpg" alt="Здание техникума" onerror="this.src='https://via.placeholder.com/400x300/1a4d8c/ffffff?text=Здание+техникума'">
                    </div>
                    <div class="gallery-caption">
                        <h3>🏛️ Главный корпус</h3>
                        <p>Учебный корпус №1</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-container">
                        <img src="/uploads/main/photo2.jpg" alt="Директор" onerror="this.src='https://via.placeholder.com/400x300/1a4d8c/ffffff?text=Директор'">
                    </div>
                    <div class="gallery-caption">
                        <h3>👨‍🎓 Директор техникума</h3>
                        <p>Руководство АПТ</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <div class="image-container">
                        <img src="/uploads/main/photo3.jpg" alt="Студенты" onerror="this.src='https://via.placeholder.com/400x300/1a4d8c/ffffff?text=Студенты'">
                    </div>
                    <div class="gallery-caption">
                        <h3>👥 Наши студенты</h3>
                        <p>Активная студенческая жизнь</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="stats">
            <div class="stat-card">
                <h3>🎓 Студентов</h3>
                <p class="stat-number"><?php echo $students_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>👨‍🏫 Преподавателей</h3>
                <p class="stat-number"><?php echo $teachers_count; ?></p>
            </div>
            <div class="stat-card">
                <h3>📚 Специальностей</h3>
                <p class="stat-number">12</p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ)</p>
        <p>г. Ангарск, ул. Техническая, д. 1 | ☎ +7 (3955) 55-55-55</p>
    </footer>
</body>
</html>
