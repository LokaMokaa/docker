<?php 
session_start(); 
require_once "auth.php"; 
requireUser(); 

// Настройки подключения к БД на Railway
$host = 'interchange.proxy.rlwy.net';
$user = 'root';
$pass = 'OSUSjygwBrpoZbeAiufeIykPRQRLaWpl';
$dbname = 'railway';
$port = 10699;

$conn = new mysqli($host, $user, $pass, $dbname, $port);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT id, full_name, teacher_card, department, position, degree, experience_years, phone, email, avatar_url FROM teachers ORDER BY department, full_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Преподаватели - АПТ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>👨‍🏫 Преподаватели АПТ</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="about.php">О техникуме</a>
            <a href="contacts.php">Контакты</a>
            <?php if (function_exists('isUser') && isUser()): ?>
                <a href="students.php">Студенты</a>
                <a href="teachers.php">Преподаватели</a>
            <?php endif; ?>
            <?php if (function_exists('isAdmin') && isAdmin()): ?>
                <a href="admin_panel.php">🔧 Админ-панель</a>
            <?php endif; ?>
            <?php if (function_exists('isLoggedIn') && isLoggedIn()): ?>
                <a href="logout.php" style="background: #8b3c2c;">👤 <?php echo $_SESSION['username']; ?> (Выход)</a>
            <?php else: ?>
                <a href="login.php">🔐 Вход</a>
                <a href="register.php">📝 Регистрация</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <h2>Педагогический состав</h2>
        <div class="cards-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($row['avatar_url']); ?>" alt="<?php echo htmlspecialchars($row['full_name']); ?>" class="card-avatar" onerror="this.src='https://via.placeholder.com/150/cccccc/ffffff?text=Нет+фото'">
                        <div class="card-info">
                            <h3><?php echo htmlspecialchars($row['full_name']); ?></h3>
                            <p><strong>Табельный номер:</strong> <?php echo htmlspecialchars($row['teacher_card']); ?></p>
                            <p><strong>Кафедра:</strong> <?php echo htmlspecialchars($row['department']); ?></p>
                            <p><strong>Должность:</strong> <?php echo htmlspecialchars($row['position']); ?></p>
                            <?php if($row['degree']): ?>
                                <p><strong>Ученая степень:</strong> <?php echo htmlspecialchars($row['degree']); ?></p>
                            <?php endif; ?>
                            <p><strong>Стаж:</strong> <?php echo $row['experience_years']; ?> лет</p>
                            <p><strong>Телефон:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Преподавателей пока нет.</p>
            <?php endif; ?>
        </div>
        <?php $conn->close(); ?>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ). Все права защищены.</p>
    </footer>
</body>
</html>