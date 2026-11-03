<?php
require 'auth.php';
requireRole(['admin','operator']);
require 'db.php';
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
header("Location: admin.php?tab=requests"); exit;