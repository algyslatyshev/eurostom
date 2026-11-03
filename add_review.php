<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $text = $_POST['text'];
    $rating = (int)$_POST['rating'];
    $date = date('Y-m-d');
    
    $stmt = $conn->prepare("INSERT INTO reviews (author, text, rating, date, status) VALUES (?, ?, ?, ?, 'published')");
    $stmt->bind_param("ssis", $author, $text, $rating, $date);
    $stmt->execute();
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить отзыв — Евростом+</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #F5F8FA; padding: 40px; }
        .box { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        h2 { color: #0B3B5C; margin-top: 0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #637A8A; font-weight: 600; }
        input, textarea, select { width: 100%; padding: 10px; border: 1px solid #C9D6E0; border-radius: 6px; font-family: inherit; }
        button { background: #0B3B5C; color: #fff; border: none; padding: 12px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; }
        button:hover { background: #2C7DA0; }
    </style>
</head>
<body>
<div class="box">
    <h2>➕ Добавить отзыв</h2>
    <form method="POST">
        <div class="form-group">
            <label>Имя автора</label>
            <input type="text" name="author" required placeholder="Анна К.">
        </div>
        <div class="form-group">
            <label>Текст отзыва</label>
            <textarea name="text" rows="4" required placeholder="Текст отзыва..."></textarea>
        </div>
        <div class="form-group">
            <label>Рейтинг</label>
            <select name="rating">
                <option value="5">5 звезд</option>
                <option value="4">4 звезды</option>
                <option value="3">3 звезды</option>
                <option value="2">2 звезды</option>
                <option value="1">1 звезда</option>
            </select>
        </div>
        <button type="submit">Сохранить</button>
        <a href="admin.php" style="margin-left: 15px; color: #637A8A; text-decoration: none;">Отмена</a>
    </form>
</div>
</body>
</html>