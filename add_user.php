<?php
require 'auth.php';
requireRole('admin');
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $display = trim($_POST['display_name'] ?? '');
    $role = $_POST['role'] ?? 'operator';

    if (!in_array($role, ['admin','operator','editor'], true)) $role = 'operator';

    if ($login === '' || strlen($login) < 3) {
        $error = 'Логин должен содержать минимум 3 символа';
    } elseif (strlen($password) < 5) {
        $error = 'Пароль должен содержать минимум 5 символов';
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE login = ? LIMIT 1");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = 'Такой логин уже занят';
        } else {
            $stmt->close();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (login, password_hash, display_name, role) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $login, $hash, $display, $role);
            if ($stmt->execute()) {
                header("Location: users.php"); exit;
            }
            $error = 'Ошибка сохранения';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Добавить пользователя</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--bg:#F5F8FA;--white:#fff;--text:#1A2C38;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);padding:40px 24px}
.box{max-width:560px;margin:0 auto;background:#fff;padding:32px;border-radius:16px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
h1{font-family:'Manrope',sans-serif;color:var(--navy);font-size:24px;margin-bottom:24px}
.form-group{margin-bottom:16px}
label{display:block;margin-bottom:6px;color:var(--muted);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.04em}
input,select{width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:9px;font-family:inherit;font-size:15px;background:var(--bg);transition:.2s}
input:focus,select:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px #E6F1F7}
.btn{padding:13px 24px;background:var(--navy);color:#fff;border:none;border-radius:9px;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer;transition:.2s}
.btn:hover{background:#072A42}
.btn--cancel{background:transparent;color:var(--muted);text-decoration:none;padding:13px 24px;font-weight:500}
.error{background:#FDF0F0;color:var(--error);padding:12px;border-radius:9px;margin-bottom:16px;font-size:14px;border:1px solid #F5C6C6}
</style></head><body>
<div class="box">
    <h1>➕ Добавить пользователя</h1>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Логин *</label><input type="text" name="login" required minlength="3" placeholder="Например: ivan_operator"></div>
        <div class="form-group"><label>Пароль *</label><input type="password" name="password" required minlength="5" placeholder="Минимум 5 символов"></div>
        <div class="form-group"><label>Отображаемое имя</label><input type="text" name="display_name" placeholder="Иван Иванов"></div>
        <div class="form-group">
            <label>Роль *</label>
            <select name="role" required>
                <option value="operator">Оператор — только заявки</option>
                <option value="editor">Редактор — отзывы и новости</option>
                <option value="admin">Администратор — полный доступ</option>
            </select>
        </div>
        <div style="display:flex;gap:8px;margin-top:20px">
            <button type="submit" class="btn">Создать</button>
            <a href="users.php" class="btn--cancel">Отмена</a>
        </div>
    </form>
</div>
</body></html>