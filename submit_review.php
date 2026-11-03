<?php
require 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = trim($_POST['author'] ?? '');
    $text = trim($_POST['text'] ?? '');
    $rating = (int)($_POST['rating'] ?? 5);
    $date = date('Y-m-d');
    
    // Валидация
    if (mb_strlen($author) < 2) {
        echo json_encode(['status' => 'error', 'message' => 'Укажите имя (минимум 2 символа)']);
        exit;
    }
    if (mb_strlen($text) < 10) {
        echo json_encode(['status' => 'error', 'message' => 'Текст отзыва слишком короткий (минимум 10 символов)']);
        exit;
    }
    if ($rating < 1 || $rating > 5) {
        $rating = 5;
    }

    // Сохраняем со статусом 'pending' (на модерации)
    $stmt = $conn->prepare("INSERT INTO reviews (author, text, rating, date, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssis", $author, $text, $rating, $date);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Спасибо! Ваш отзыв отправлен на проверку.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Ошибка сохранения в базу данных.']);
    }
    $stmt->close();
} else {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Доступ запрещен']);
}