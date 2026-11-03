<?php
require 'auth.php';
requireRole(['admin','editor']);
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    // Удалить картинку
    $stmt = $conn->prepare("SELECT image FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($row && $row['image'] && file_exists(__DIR__ . '/' . $row['image'])) {
        @unlink(__DIR__ . '/' . $row['image']);
    }
    $stmt = $conn->prepare("DELETE FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: news.php"); exit;