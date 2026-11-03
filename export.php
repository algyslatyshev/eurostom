<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
require 'db.php';

$result = $conn->query("SELECT * FROM requests ORDER BY created_at DESC");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=zayavki_' . date('Y-m-d') . '.csv');

$output = fopen('php://output', 'w');
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM для Excel
fputcsv($output, array('ID', 'Имя', 'Телефон', 'Услуга', 'Статус', 'Дата'));

while ($row = $result->fetch_assoc()) {
    fputcsv($output, array($row['id'], $row['name'], $row['phone'], $row['service'], $row['status'], $row['created_at']));
}
fclose($output);
exit;
?>