CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(500),
    author VARCHAR(100),
    category VARCHAR(100),
    views INT DEFAULT 0,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255),
    full_name VARCHAR(255),
    avatar_url VARCHAR(500),
    phone VARCHAR(20),
    role ENUM('admin', 'editor', 'user') DEFAULT 'user',
    is_active BOOLEAN DEFAULT TRUE,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO articles (title, content, category, author, status, views) VALUES
('Добро пожаловать в мир Docker!', 
 'Docker — это платформа для разработки, доставки и запуска приложений в контейнерах. Контейнеры позволяют упаковать приложение со всеми зависимостями и гарантировать его работу в любой среде. В этой статье мы рассмотрим основы работы с Docker и создадим свой первый контейнер.',
 'Технологии', 'Админ', 'published', 150),

('Преимущества контейнеризации', 
 'Контейнеризация приложений становится стандартом в современной разработке. Основные преимущества: лёгкость (по сравнению с виртуальными машинами), портативность (работает везде, где есть Docker), изоляция (безопасное разделение приложений) и эффективность использования ресурсов.',
 'DevOps', 'Админ', 'published', 98),

('Создание сайта на PHP и MySQL в Docker', 
 'В этом руководстве мы покажем, как развернуть полноценный веб-сайт с использованием PHP и MySQL в Docker. Используя Docker Compose, можно легко связать веб-сервер, базу данных и инструменты администрирования в единую систему.',
 'Туториалы', 'Админ', 'published', 210);

INSERT INTO users (username, email, full_name, role, is_active) VALUES
('admin', 'admin@apt.ru', 'Администратор АПТ', 'admin', TRUE),
('editor', 'editor@apt.ru', 'Редактор АПТ', 'editor', TRUE),
('user1', 'user@example.com', 'Тестовый Пользователь', 'user', TRUE);
