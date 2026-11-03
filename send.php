<?php
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $service = strip_tags(trim($_POST["service"] ?? 'Не выбрана'));

    if (!empty($_POST["_gotcha"])) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Spam detected"]);
        exit;
    }

    if (empty($name) || empty($phone)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Заполните имя и телефон"]);
        exit;
    }

    require 'db.php';
    
    // Сохраняем в БД
    $stmt = $conn->prepare("INSERT INTO requests (name, phone, service, status) VALUES (?, ?, ?, 'Новая')");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $phone, $service);
        $stmt->execute();
        $stmt->close();
    }

    // Отправка email (работает, если настроен SMTP в php.ini, иначе не блокирует работу)
    $to = "eurostom66@mail.ru"; 
    $subject = "Новая заявка с сайта Евростом+";
    $message = "Имя: $name\nТелефон: $phone\nУслуга: $service\nДата: " . date("Y-m-d H:i:s");
    $headers = "From: no-reply@eurostom.local\r\nReply-To: no-reply@eurostom.local\r\nContent-Type: text/plain; charset=utf-8\r\n";
    @mail($to, $subject, $message, $headers); 

    echo json_encode(["status" => "success", "message" => "Заявка отправлена"]);
} else {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Доступ запрещен"]);
}
?>