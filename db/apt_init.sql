SET NAMES utf8mb4;

-- Создаем базу данных (если нет)
CREATE DATABASE IF NOT EXISTS apt;
USE apt;

-- Таблица студентов (7+ полей)
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL COMMENT 'ФИО студента',
    student_card VARCHAR(50) NOT NULL UNIQUE COMMENT 'Номер студенческого билета',
    group_name VARCHAR(50) NOT NULL COMMENT 'Номер группы',
    specialty VARCHAR(255) NOT NULL COMMENT 'Специальность',
    course INT NOT NULL COMMENT 'Курс',
    phone VARCHAR(20) COMMENT 'Телефон',
    email VARCHAR(255) COMMENT 'Email',
    birth_date DATE COMMENT 'Дата рождения',
    avatar_url VARCHAR(500) COMMENT 'Фото',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Таблица преподавателей (7+ полей)
CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL COMMENT 'ФИО преподавателя',
    teacher_card VARCHAR(50) NOT NULL UNIQUE COMMENT 'Табельный номер',
    department VARCHAR(255) NOT NULL COMMENT 'Кафедра',
    position VARCHAR(255) NOT NULL COMMENT 'Должность',
    degree VARCHAR(255) COMMENT 'Ученая степень',
    experience_years INT DEFAULT 0 COMMENT 'Стаж работы',
    phone VARCHAR(20) COMMENT 'Телефон',
    email VARCHAR(255) COMMENT 'Email',
    avatar_url VARCHAR(500) COMMENT 'Фото',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Добавляем тестовых студентов
INSERT INTO students (full_name, student_card, group_name, specialty, course, phone, email, avatar_url) VALUES
('Иванов Иван Иванович', 'СТ-001', 'А-21-01', 'Информационные системы', 2, '+7 (901) 123-45-67', 'ivanov@apt.ru', 'https://via.placeholder.com/150/667eea/ffffff?text=Иванов'),
('Петрова Анна Сергеевна', 'СТ-002', 'А-21-01', 'Информационные системы', 2, '+7 (901) 123-45-68', 'petrova@apt.ru', 'https://via.placeholder.com/150/764ba2/ffffff?text=Петрова'),
('Сидоров Алексей Дмитриевич', 'СТ-003', 'А-22-02', 'Программирование', 1, '+7 (901) 123-45-69', 'sidorov@apt.ru', 'https://via.placeholder.com/150/4CAF50/ffffff?text=Сидоров'),
('Козлова Екатерина Андреевна', 'СТ-004', 'А-21-01', 'Информационные системы', 2, '+7 (901) 123-45-70', 'kozlova@apt.ru', 'https://via.placeholder.com/150/ff9800/ffffff?text=Козлова'),
('Смирнов Дмитрий Павлович', 'СТ-005', 'А-22-02', 'Программирование', 1, '+7 (901) 123-45-71', 'smirnov@apt.ru', 'https://via.placeholder.com/150/f44336/ffffff?text=Смирнов'),
('Новикова Ольга Владимировна', 'СТ-006', 'А-23-03', 'Сетевое администрирование', 3, '+7 (901) 123-45-72', 'novikova@apt.ru', 'https://via.placeholder.com/150/9c27b0/ffffff?text=Новикова');

-- Добавляем тестовых преподавателей
INSERT INTO teachers (full_name, teacher_card, department, position, degree, experience_years, phone, email, avatar_url) VALUES
('Профессоров Петр Николаевич', 'ПР-001', 'Информационных технологий', 'Профессор', 'Доктор технических наук', 25, '+7 (902) 111-22-33', 'professorov@apt.ru', 'https://via.placeholder.com/150/667eea/ffffff?text=Профессоров'),
('Доцентова Мария Ивановна', 'ПР-002', 'Информационных технологий', 'Доцент', 'Кандидат педагогических наук', 15, '+7 (902) 111-22-34', 'docents@apt.ru', 'https://via.placeholder.com/150/764ba2/ffffff?text=Доцентова'),
('Старшийова Елена Петровна', 'ПР-003', 'Программирования', 'Старший преподаватель', NULL, 12, '+7 (902) 111-22-35', 'starova@apt.ru', 'https://via.placeholder.com/150/4CAF50/ffffff?text=Старшийова'),
('Лаборантов Андрей Сергеевич', 'ПР-004', 'Сетей и систем', 'Лаборант', NULL, 5, '+7 (902) 111-22-36', 'lab@apt.ru', 'https://via.placeholder.com/150/ff9800/ffffff?text=Лаборантов'),
('Заслуженова Татьяна Викторовна', 'ПР-005', 'Информационных технологий', 'Заведующий кафедрой', 'Кандидат технических наук', 20, '+7 (902) 111-22-37', 'zasl@apt.ru', 'https://via.placeholder.com/150/f44336/ffffff?text=Заслуженова');
