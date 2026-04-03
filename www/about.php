<?php
require_once 'auth.php';
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О техникуме - АПТ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🏫 О Ангарском политехническом техникуме</h1>
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
        <section class="about-section">
            <h2>История техникума</h2>
            <p>Ангарский политехнический техникум (АПТ) основан в 1965 году. За годы существования техникум выпустил тысячи квалифицированных специалистов для промышленности и IT-сферы.</p>
            
            <h2>Направления подготовки</h2>
            <ul>
                <li>📱 Информационные системы и программирование</li>
                <li>💻 Компьютерные сети и администрирование</li>
                <li>⚙️ Техническая эксплуатация оборудования</li>
                <li>📊 Экономика и бухгалтерский учет</li>
                <li>🔧 Автомеханика и транспортные средства</li>
            </ul>
            
            <h2>Достижения</h2>
            <p>Техникум является победителем региональных и всероссийских конкурсов профессионального мастерства "Молодые профессионалы" (WorldSkills Russia).</p>
            
            <h2>Материально-техническая база</h2>
            <ul>
                <li>💻 5 компьютерных классов с современным оборудованием</li>
                <li>🔬 Лаборатории сетевого администрирования</li>
                <li>📚 Библиотека с электронными ресурсами</li>
                <li>🏋️ Спортивный зал и тренажерный комплекс</li>
                <li>🍽️ Столовая и буфет</li>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Ангарский политехнический техникум (АПТ)</p>
        <p>г. Ангарск, ул. Техническая, д. 1 | ☎ +7 (3955) 55-55-55</p>
    </footer>
</body>
</html>
