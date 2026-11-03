<?php
require 'db.php';

$msgs = [];

// ===== Таблица users =====
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    display_name VARCHAR(200) DEFAULT '',
    role ENUM('admin','operator','editor') NOT NULL DEFAULT 'operator',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$msgs[] = "✅ Таблица <b>users</b> готова";

// ===== Таблица news =====
$conn->query("CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500) NOT NULL,
    slug VARCHAR(500) DEFAULT '',
    excerpt TEXT,
    content LONGTEXT,
    image VARCHAR(500) DEFAULT '',
    status ENUM('draft','published') NOT NULL DEFAULT 'draft',
    author_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created (created_at),
    CONSTRAINT fk_news_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
$msgs[] = "✅ Таблица <b>news</b> готова";

// ===== Папка для картинок новостей =====
$dir = __DIR__ . '/image/news';
if (!is_dir($dir)) {
    @mkdir($dir, 0755, true);
    $msgs[] = "📁 Создана папка <b>image/news/</b>";
} else {
    $msgs[] = "📁 Папка <b>image/news/</b> уже существует";
}

// ===== Дефолтный админ =====
$check = $conn->query("SELECT id FROM users WHERE login = 'admin' LIMIT 1");
if ($check && $check->num_rows === 0) {
    $login = 'admin';
    $hash = password_hash('12345', PASSWORD_DEFAULT);
    $name = 'Администратор';
    $role = 'admin';
    $stmt = $conn->prepare("INSERT INTO users (login, password_hash, display_name, role) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $login, $hash, $name, $role);
    $stmt->execute();
    $stmt->close();
    $msgs[] = "👤 Создан пользователь <b>admin / 12345</b> (роль: admin)";
} else {
    $msgs[] = "👤 Пользователь <b>admin</b> уже существует";
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8">
<title>Установка — Админ-панель</title>
<style>
body{font-family:'Inter',sans-serif;background:#F5F8FA;color:#1A2C38;padding:40px;line-height:1.7}
.box{max-width:600px;margin:0 auto;background:#fff;padding:32px;border-radius:14px;box-shadow:0 12px 40px rgba(11,59,92,.1)}
h1{color:#0B3B5C;margin-bottom:16px}
li{margin-bottom:6px;list-style:none}
.btn{display:inline-block;margin-top:20px;background:#0B3B5C;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600}
.btn:hover{background:#2C7DA0}
</style></head><body>
<div class="box">
    <h1>⚙️ Установка завершена</h1>
    <ul><?php foreach ($msgs as $m) echo "<li>$m</li>"; ?></ul>
    <p style="margin-top:16px;color:#637A8A">После установки <b>удалите setup.php</b> в целях безопасности.</p>
    <a href="login.php" class="btn">Перейти к входу →</a>
</div>
</body></html>