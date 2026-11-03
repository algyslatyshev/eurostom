<?php
require 'auth.php';
requireRole('admin');
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: users.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$user) { header("Location: users.php"); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $display = trim($_POST['display_name'] ?? '');
    $role = $_POST['role'] ?? 'operator';
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $new_password = $_POST['password'] ?? '';

    if (!in_array($role, ['admin','operator','editor'], true)) $role = 'operator';

    // Защита от потери последнего админа
    if ($user['role'] === 'admin' && $role !== 'admin') {
        $cnt = $conn->query("SELECT COUNT(*) c FROM users WHERE role='admin' AND is_active=1")->fetch_assoc()['c'];
        if ($cnt <= 1) $error = 'Нельзя изменить роль последнего администратора';
    }
    if (!$error && $user['role'] === 'admin' && $is_active === 0) {
        $cnt = $conn->query("SELECT COUNT(*) c FROM users WHERE role='admin' AND is_active=1")->fetch_assoc()['c'];
        if ($cnt <= 1) $error = 'Нельзя отключить последнего администратора';
    }

    if (!$error) {
        if ($new_password !== '') {
            if (strlen($new_password) < 5) {
                $error = 'Пароль — минимум 5 символов';
            } else {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET display_name=?, role=?, is_active=?, password_hash=? WHERE id=?");
                $stmt->bind_param("ssisi", $display, $role, $is_active, $hash, $id);
            }
        } else {
            $stmt = $conn->prepare("UPDATE users SET display_name=?, role=?, is_active=? WHERE id=?");
            $stmt->bind_param("ssii", $display, $role, $is_active, $id);
        }
        if (!$error && $stmt->execute()) {
            // Обновляем сессию, если правим себя
            if ($id === currentUserId()) {
                $_SESSION['user']['display_name'] = $display;
                $_SESSION['user']['role'] = $role;
            }
            $stmt->close();
            header("Location: users.php"); exit;
        }
        if (!$error) $error = 'Ошибка сохранения';
    }
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Изменить пользователя</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--bg:#F5F8FA;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:#1A2C38;padding:40px 24px}
.box{max-width:560px;margin:0 auto;background:#fff;padding:32px;border-radius:16px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
h1{font-family:'Manrope',sans-serif;color:var(--navy);font-size:24px;margin-bottom:8px}
.sub{color:var(--muted);font-size:14px;margin-bottom:24px}
.form-group{margin-bottom:16px}
label{display:block;margin-bottom:6px;color:var(--muted);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.04em}
input,select{width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:9px;font-family:inherit;font-size:15px;background:var(--bg);transition:.2s}
input:focus,select:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px #E6F1F7}
.checkbox{display:flex;align-items:center;gap:10px;cursor:pointer}
.checkbox input{width:18px;height:18px;accent-color:var(--accent)}
.btn{padding:13px 24px;background:var(--navy);color:#fff;border:none;border-radius:9px;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer}
.btn--cancel{background:transparent;color:var(--muted);text-decoration:none;padding:13px 24px}
.error{background:#FDF0F0;color:var(--error);padding:12px;border-radius:9px;margin-bottom:16px;font-size:14px;border:1px solid #F5C6C6}
</style></head><body>
<div class="box">
    <h1>✏️ Изменить пользователя</h1>
    <p class="sub">Логин: <b><?= htmlspecialchars($user['login']) ?></b></p>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Отображаемое имя</label><input type="text" name="display_name" value="<?= htmlspecialchars($user['display_name']) ?>"></div>
        <div class="form-group">
            <label>Роль</label>
            <select name="role">
                <option value="operator" <?= $user['role']==='operator'?'selected':'' ?>>Оператор — только заявки</option>
                <option value="editor" <?= $user['role']==='editor'?'selected':'' ?>>Редактор — отзывы и новости</option>
                <option value="admin" <?= $user['role']==='admin'?'selected':'' ?>>Администратор — полный доступ</option>
            </select>
        </div>
        <div class="form-group"><label>Новый пароль (оставьте пустым, чтобы не менять)</label><input type="password" name="password" minlength="5" placeholder="Минимум 5 символов"></div>
        <div class="form-group">
            <label class="checkbox"><input type="checkbox" name="is_active" value="1" <?= $user['is_active']?'checked':'' ?>><span>Активен</span></label>
        </div>
        <div style="display:flex;gap:8px;margin-top:20px">
            <button type="submit" class="btn">Сохранить</button>
            <a href="users.php" class="btn--cancel">Отмена</a>
        </div>
    </form>
</div>
</body></html>