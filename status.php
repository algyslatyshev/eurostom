<?php
require 'auth.php';
requireRole(['admin', 'operator']);
require 'db.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    // Обновляем только если статус действительно "Новая"
    // (чтобы нельзя было перезаписать, например, "Отменена")
    $stmt = $conn->prepare("UPDATE requests SET status = 'Позвонили' WHERE id = ? AND status = 'Новая'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $affected = $stmt->affected_rows;
    $stmt->close();

    // Если ничего не обновилось — возможно, уже был "Позвонили"
    // или заявку удалили. Молча редиректим — админ и так увидит актуальное состояние.
}

$conn->close();
header("Location: admin.php?tab=requests");
exit;