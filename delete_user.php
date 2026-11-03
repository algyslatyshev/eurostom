<?php
require 'auth.php';
requireRole('admin');
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0 || $id === currentUserId()) {
    header("Location: users.php"); exit;
}

$stmt = $conn->prepare("SELECT role, is_active FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$u = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($u && $u['role'] === 'admin' && $u['is_active']) {
    $cnt = $conn->query("SELECT COUNT(*) c FROM users WHERE role='admin' AND is_active=1")->fetch_assoc()['c'];
    if ($cnt <= 1) { header("Location: users.php?err=last_admin"); exit; }
}

if ($u) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: users.php"); exit;