<?php
require 'auth.php';
requireRole(['admin','editor']);
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: news.php"); exit; }

$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$n = $stmt->get_result()->fetch_assoc();
$stmt->close();
if (!$n) { header("Location: news.php"); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status = $_POST['status'] === 'published' ? 'published' : 'draft';
    $imagePath = $n['image'];

    if ($title === '') $error = 'Введите заголовок';
    elseif ($content === '') $error = 'Введите текст новости';

    if (!$error && !empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $error = 'Ошибка загрузки (код ' . $_FILES['image']['error'] . ')';
        } elseif ($_FILES['image']['size'] > 5*1024*1024) {
            $error = 'Изображение больше 5MB';
        } else {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png','webp','gif'], true)) {
                $error = 'Недопустимый формат';
            } else {
                $dir = __DIR__ . '/image/news';
                if (!is_dir($dir)) @mkdir($dir, 0755, true);
                $filename = 'news_' . date('YmdHis') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . '/' . $filename)) {
                    // Удалить старое
                    if ($n['image'] && file_exists(__DIR__ . '/' . $n['image'])) @unlink(__DIR__ . '/' . $n['image']);
                    $imagePath = 'image/news/' . $filename;
                } else {
                    $error = 'Не удалось сохранить файл';
                }
            }
        }
    }

    // Удаление текущей картинки по галочке
    if (!$error && isset($_POST['remove_image']) && $_POST['remove_image'] === '1') {
        if ($imagePath && file_exists(__DIR__ . '/' . $imagePath)) @unlink(__DIR__ . '/' . $imagePath);
        $imagePath = '';
    }

    if (!$error) {
        $stmt = $conn->prepare("UPDATE news SET title=?, excerpt=?, content=?, image=?, status=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $excerpt, $content, $imagePath, $status, $id);
        if ($stmt->execute()) { header("Location: news.php"); exit; }
        $error = 'Ошибка: ' . $stmt->error;
    }
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Редактировать новость</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--bg:#F5F8FA;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:#1A2C38;padding:40px 24px}
.box{max-width:720px;margin:0 auto;background:#fff;padding:36px;border-radius:16px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
h1{font-family:'Manrope',sans-serif;color:var(--navy);font-size:24px;margin-bottom:24px}
.form-group{margin-bottom:16px}
label{display:block;margin-bottom:6px;color:var(--muted);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.04em}
input[type=text],textarea,select{width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:9px;font-family:inherit;font-size:15px;background:var(--bg)}
input:focus,textarea:focus,select:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px #E6F1F7}
textarea.content{min-height:220px;font-family:'Menlo',monospace;font-size:14px}
input[type=file]{padding:10px;background:#fff;border:1.5px dashed var(--border);border-radius:9px;width:100%}
.btn{padding:13px 24px;background:var(--navy);color:#fff;border:none;border-radius:9px;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer}
.btn--cancel{background:transparent;color:var(--muted);text-decoration:none;padding:13px 24px}
.error{background:#FDF0F0;color:var(--error);padding:12px;border-radius:9px;margin-bottom:16px;font-size:14px;border:1px solid #F5C6C6}
.preview{max-width:220px;border-radius:8px;border:1px solid var(--border);margin-bottom:8px}
.hint{font-size:12px;color:var(--muted);margin-top:4px}
.checkbox{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);cursor:pointer}
.checkbox input{width:16px;height:16px;accent-color:var(--accent)}
</style></head><body>
<div class="box">
    <h1>✏️ Редактировать новость #<?= $id ?></h1>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group"><label>Заголовок *</label><input type="text" name="title" required maxlength="500" value="<?= htmlspecialchars($n['title']) ?>"></div>
        <div class="form-group"><label>Краткое описание</label><textarea name="excerpt" rows="2" maxlength="500"><?= htmlspecialchars($n['excerpt']) ?></textarea></div>
        <div class="form-group"><label>Текст *</label><textarea name="content" class="content" required><?= htmlspecialchars($n['content']) ?></textarea></div>
        <?php if ($n['image']): ?>
            <div class="form-group">
                <label>Текущее изображение</label>
                <img src="<?= htmlspecialchars($n['image']) ?>" class="preview" alt="">
                <label class="checkbox"><input type="checkbox" name="remove_image" value="1"> Удалить текущее изображение</label>
            </div>
        <?php endif; ?>
        <div class="form-group"><label><?= $n['image']?'Заменить изображение':'Добавить изображение' ?></label><input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif"><div class="hint">До 5MB</div></div>
        <div class="form-group"><label>Статус</label>
            <select name="status">
                <option value="draft" <?= $n['status']==='draft'?'selected':'' ?>>Черновик</option>
                <option value="published" <?= $n['status']==='published'?'selected':'' ?>>Опубликовано</option>
            </select>
        </div>
        <div style="display:flex;gap:8px;margin-top:20px">
            <button type="submit" class="btn">Сохранить</button>
            <a href="news.php" class="btn--cancel">Отмена</a>
        </div>
    </form>
</div>
</body></html>