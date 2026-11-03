<?php
session_start();
require 'db.php';

// Проверяем, что БД инициализирована
$check = $conn->query("SHOW TABLES LIKE 'users'");
if (!$check || $check->num_rows === 0) {
    die("⚠️ База не инициализирована. Запустите <a href='setup.php'>setup.php</a> один раз.");
}

// Если уже вошёл — сразу в админку
if (isset($_SESSION['admin_logged_in']) && isset($_SESSION['user']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php"); exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '' || $password === '') {
        $error = 'Заполните все поля!';
    } else {
        $stmt = $conn->prepare("SELECT id, login, password_hash, display_name, role FROM users WHERE login = ? AND is_active = 1 LIMIT 1");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password_hash'])) {
            // ВОТ ЗДЕСЬ МЫ ЗАПИСЫВАЕМ ДАННЫЕ ПОЛЬЗОВАТЕЛЯ
            $_SESSION['admin_logged_in'] = true; 
            $_SESSION['user'] = [
                'id'           => (int)$user['id'],
                'login'        => $user['login'],
                'display_name' => $user['display_name'],
                'role'         => $user['role'],
            ];
            header("Location: admin.php"); exit;
        } else {
            $error = 'Неверный логин или пароль!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Вход в админку</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--navy-dark:#072A42;--accent:#2C7DA0;--bg:#F5F8FA;--white:#fff;--text:#1A2C38;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);display:flex;justify-content:center;align-items:center;min-height:100vh;padding:24px}
.login-box{background:var(--white);padding:48px 40px;border-radius:20px;box-shadow:0 12px 40px rgba(11,59,92,.12);width:100%;max-width:420px;border:1px solid var(--border);position:relative;overflow:hidden}
.login-box::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:var(--accent)}
.login-box h2{font-family:'Manrope',sans-serif;color:var(--navy);text-align:center;font-size:26px;font-weight:800;margin-bottom:28px}
.form-group{margin-bottom:18px;position:relative}
.form-group label{display:block;margin-bottom:8px;color:var(--muted);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.05em}
.form-group input{width:100%;padding:14px 16px;border:1.5px solid var(--border);border-radius:10px;font-family:inherit;font-size:15px;background:var(--bg);transition:.2s}
.form-group input:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 4px #E6F1F7}
.password-toggle{position:absolute;right:14px;top:38px;background:none;border:none;cursor:pointer;color:var(--muted);padding:4px}
.btn-login{width:100%;padding:16px;background:var(--navy);color:#fff;border:none;border-radius:10px;font-family:inherit;font-size:16px;font-weight:600;cursor:pointer;margin-top:10px;transition:.25s}
.btn-login:hover{background:var(--navy-dark);transform:translateY(-1px)}
.error{background:#FDF0F0;color:var(--error);padding:14px;border-radius:10px;margin-bottom:20px;text-align:center;font-size:14px;border:1px solid #F5C6C6}
.back-link{display:flex;justify-content:center;align-items:center;gap:6px;margin-top:24px;color:var(--muted);text-decoration:none;font-size:14px}
.back-link:hover{color:var(--accent)}
</style>
</head>
<body>
<div class="login-box">
    <h2>🔐 Вход в админку</h2>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group">
            <label>Логин</label>
            <input type="text" name="login" required placeholder="Введите логин" autofocus autocomplete="username">
        </div>
        <div class="form-group">
            <label>Пароль</label>
            <input type="password" name="password" id="passwordInput" required placeholder="Введите пароль" autocomplete="current-password">
            <button type="button" class="password-toggle" id="togglePassword" aria-label="Показать">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>
        <button type="submit" class="btn-login">Войти в систему</button>
    </form>
    <a href="index.php" class="back-link">← Вернуться на сайт</a>
</div>
<script>
document.getElementById('togglePassword').addEventListener('click', function(){
    const p = document.getElementById('passwordInput');
    const type = p.type === 'password' ? 'text' : 'password';
    p.type = type;
});
</script>
</body>
</html>