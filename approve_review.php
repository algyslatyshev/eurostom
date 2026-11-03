<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $conn->query("UPDATE reviews SET status = 'published' WHERE id = $id");
}
$conn->close();
header("Location: admin.php");
exit;