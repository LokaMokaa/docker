<?php
session_start();
require_once 'auth.php';
requireAdmin();

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

$message = '';
$error = '';

// Обработка действий
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $table = $_POST['table'] ?? '';
    
    if ($action === 'add') {
        if ($table === 'students') {
            $stmt = $conn->prepare("INSERT INTO students (full_name, student_card, group_name, specialty, course, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiss", $_POST['full_name'], $_POST['student_card'], $_POST['group_name'], $_POST['specialty'], $_POST['course'], $_POST['phone'], $_POST['email']);
            if ($stmt->execute()) $message = "Студент добавлен";
            else $error = "Ошибка: " . $conn->error;
        } elseif ($table === 'teachers') {
            $stmt = $conn->prepare("INSERT INTO teachers (full_name, teacher_card, department, position, degree, experience_years, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssiss", $_POST['full_name'], $_POST['teacher_card'], $_POST['department'], $_POST['position'], $_POST['degree'], $_POST['experience_years'], $_POST['phone'], $_POST['email']);
            if ($stmt->execute()) $message = "Преподаватель добавлен";
            else $error = "Ошибка: " . $conn->error;
        }
    } elseif ($action === 'edit') {
        $id = $_POST['id'];
        if ($table === 'students') {
            $stmt = $conn->prepare("UPDATE students SET full_name=?, student_card=?, group_name=?, specialty=?, course=?, phone=?, email=? WHERE id=?");
            $stmt->bind_param("ssssissi", $_POST['full_name'], $_POST['student_card'], $_POST['group_name'], $_POST['specialty'], $_POST['course'], $_POST['phone'], $_POST['email'], $id);
            if ($stmt->execute()) $message = "Студент обновлен";
            else $error = "Ошибка: " . $conn->error;
        } elseif ($table === 'teachers') {
            $stmt = $conn->prepare("UPDATE teachers SET full_name=?, teacher_card=?, department=?, position=?, degree=?, experience_years=?, phone=?, email=? WHERE id=?");
            $stmt->bind_param("sssssissi", $_POST['full_name'], $_POST['teacher_card'], $_POST['department'], $_POST['position'], $_POST['degree'], $_POST['experience_years'], $_POST['phone'], $_POST['email'], $id);
            if ($stmt->execute()) $message = "Преподаватель обновлен";
            else $error = "Ошибка: " . $conn->error;
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'];
        if ($table === 'students') {
            $conn->query("DELETE FROM students WHERE id=$id");
            $message = "Студент удален";
        } elseif ($table === 'teachers') {
            $conn->query("DELETE FROM teachers WHERE id=$id");
            $message = "Преподаватель удален";
        }
    }
}

$students = $conn->query("SELECT * FROM students ORDER BY id");
$teachers = $conn->query("SELECT * FROM teachers ORDER BY id");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель АПТ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container { max-width: 1400px; margin: 2rem auto; padding: 0 1rem; }
        .admin-table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; margin: 1rem 0; }
        .admin-table th { background: #1a4d8c; color: white; padding: 12px; text-align: left; }
        .admin-table td { padding: 10px; border-bottom: 1px solid #eee; }
        .admin-table tr:hover { background: #f5f5f5; }
        .btn { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-edit { background: #c9a03d; color: white; }
        .btn-delete { background: #8b3c2c; color: white; }
        .btn-add { background: #1a4d8c; color: white; padding: 10px 20px; margin: 1rem 0; }
        .form-modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
        .form-modal.active { display: flex; }
        .form-content { background: white; padding: 2rem; border-radius: 12px; max-width: 500px; width: 90%; }
        .form-content input, .form-content select { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        .message { background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin: 1rem 0; }
        .error { background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin: 1rem 0; }
        .section-title { margin-top: 2rem; color: #1a4d8c; border-bottom: 2px solid #c9a03d; display: inline-block; }
        .avatar-preview { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    </style>
</head>
<body>
    <header>
        <h1>🔧 Админ-панель АПТ</h1>
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
    <main class="admin-container">
        <h2>Управление данными</h2>
        
        <?php if ($message): ?>
            <div class="message">✅ <?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="error">❌ <?php echo $error; ?></div>
        <?php endif; ?>
        
        <!-- Студенты -->
        <h3 class="section-title">🎓 Студенты</h3>
        <button class="btn-add" onclick="openModal('students', 'add')">+ Добавить студента</button>
        <table class="admin-table">
            <tr><th>ID</th><th>Фото</th><th>ФИО</th><th>Студ.билет</th><th>Группа</th><th>Специальность</th><th>Курс</th><th>Телефон</th><th>Email</th><th>Действия</th></tr>
            <?php while($row = $students->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="<?php echo htmlspecialchars($row['avatar_url'] ?: 'https://via.placeholder.com/40/cccccc/ffffff?text=?'); ?>" class="avatar-preview" onerror="this.src='https://via.placeholder.com/40/cccccc/ffffff?text=?'"></td>
                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                <td><?php echo $row['student_card']; ?></td>
                <td><?php echo $row['group_name']; ?></td>
                <td><?php echo $row['specialty']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <button class="btn btn-edit" onclick="editStudent(<?php echo htmlspecialchars(json_encode($row)); ?>)">✏️</button>
                    <form method="POST" style="display:inline" onsubmit="return confirm('Удалить?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="table" value="students">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-delete">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <!-- Преподаватели -->
        <h3 class="section-title">👨‍🏫 Преподаватели</h3>
        <button class="btn-add" onclick="openModal('teachers', 'add')">+ Добавить преподавателя</button>
        <table class="admin-table">
            <tr><th>ID</th><th>Фото</th><th>ФИО</th><th>Таб.номер</th><th>Кафедра</th><th>Должность</th><th>Степень</th><th>Стаж</th><th>Телефон</th><th>Email</th><th>Действия</th></tr>
            <?php while($row = $teachers->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="<?php echo htmlspecialchars($row['avatar_url'] ?: 'https://via.placeholder.com/40/cccccc/ffffff?text=?'); ?>" class="avatar-preview" onerror="this.src='https://via.placeholder.com/40/cccccc/ffffff?text=?'"></td>
                <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                <td><?php echo $row['teacher_card']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['degree']; ?></td>
                <td><?php echo $row['experience_years']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <button class="btn btn-edit" onclick="editTeacher(<?php echo htmlspecialchars(json_encode($row)); ?>)">✏️</button>
                    <form method="POST" style="display:inline" onsubmit="return confirm('Удалить?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="table" value="teachers">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-delete">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
    
    <div id="modal" class="form-modal">
        <div class="form-content">
            <h3 id="modal-title">Добавить</h3>
            <form method="POST" id="modal-form">
                <input type="hidden" name="action" id="modal-action">
                <input type="hidden" name="table" id="modal-table">
                <input type="hidden" name="id" id="modal-id">
                <div id="modal-fields"></div>
                <button type="submit">Сохранить</button>
                <button type="button" onclick="closeModal()">Отмена</button>
            </form>
        </div>
    </div>
    
    <script>
        function openModal(table, action, data = null) {
            document.getElementById('modal').classList.add('active');
            document.getElementById('modal-action').value = action;
            document.getElementById('modal-table').value = table;
            
            let fields = '';
            if (table === 'students') {
                fields = `
                    <label>ФИО</label><input name="full_name" value="${data?.full_name || ''}" required>
                    <label>Студенческий билет</label><input name="student_card" value="${data?.student_card || ''}" required>
                    <label>Группа</label><input name="group_name" value="${data?.group_name || ''}" required>
                    <label>Специальность</label><input name="specialty" value="${data?.specialty || ''}" required>
                    <label>Курс</label><input name="course" type="number" value="${data?.course || ''}" required>
                    <label>Телефон</label><input name="phone" value="${data?.phone || ''}">
                    <label>Email</label><input name="email" type="email" value="${data?.email || ''}">
                    <label>URL фото</label><input name="avatar_url" value="${data?.avatar_url || ''}" placeholder="https://...">
                `;
                document.getElementById('modal-title').innerText = action === 'add' ? '➕ Добавить студента' : '✏️ Редактировать студента';
            } else {
                fields = `
                    <label>ФИО</label><input name="full_name" value="${data?.full_name || ''}" required>
                    <label>Табельный номер</label><input name="teacher_card" value="${data?.teacher_card || ''}" required>
                    <label>Кафедра</label><input name="department" value="${data?.department || ''}" required>
                    <label>Должность</label><input name="position" value="${data?.position || ''}" required>
                    <label>Ученая степень</label><input name="degree" value="${data?.degree || ''}">
                    <label>Стаж (лет)</label><input name="experience_years" type="number" value="${data?.experience_years || ''}">
                    <label>Телефон</label><input name="phone" value="${data?.phone || ''}">
                    <label>Email</label><input name="email" type="email" value="${data?.email || ''}">
                    <label>URL фото</label><input name="avatar_url" value="${data?.avatar_url || ''}" placeholder="/uploads/teachers/professorov.jpg">
                `;
                document.getElementById('modal-title').innerText = action === 'add' ? '➕ Добавить преподавателя' : '✏️ Редактировать преподавателя';
            }
            document.getElementById('modal-fields').innerHTML = fields;
            if (data && data.id) document.getElementById('modal-id').value = data.id;
        }
        
        function editStudent(data) { openModal('students', 'edit', data); }
        function editTeacher(data) { openModal('teachers', 'edit', data); }
        function closeModal() { document.getElementById('modal').classList.remove('active'); }
    </script>
</body>
</html>