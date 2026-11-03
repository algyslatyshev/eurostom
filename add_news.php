<?php
require 'auth.php';
requireRole(['admin','editor']);
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status = $_POST['status'] === 'published' ? 'published' : 'draft';

    if ($title === '') $error = 'Введите заголовок';
    elseif ($content === '') $error = 'Введите текст новости';

    // Загрузка изображения
    $imagePath = '';
    if (!$error && !empty($_FILES['image']['name'])) {
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            $error = 'Ошибка загрузки изображения (код ' . $_FILES['image']['error'] . ')';
        } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            $error = 'Изображение больше 5MB';
        } else {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png','webp','gif'], true)) {
                $error = 'Недопустимый формат (jpg, png, webp, gif)';
            } else {
                $dir = __DIR__ . '/image/news';
                if (!is_dir($dir)) @mkdir($dir, 0755, true);
                $filename = 'news_' . date('YmdHis') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dir . '/' . $filename)) {
                    $imagePath = 'image/news/' . $filename;
                } else {
                    $error = 'Не удалось сохранить файл. Проверьте права на папку image/news/';
                }
            }
        }
    }

    if (!$error) {
        $authorId = currentUserId();
        $stmt = $conn->prepare("INSERT INTO news (title, excerpt, content, image, status, author_id) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("sssssi", $title, $excerpt, $content, $imagePath, $status, $authorId);
        if ($stmt->execute()) { header("Location: news.php"); exit; }
        $error = 'Ошибка сохранения: ' . $stmt->error;
    }
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Новая новость</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--bg:#F5F8FA;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:#1A2C38;padding:40px 24px}
.box{max-width:720px;margin:0 auto;background:#fff;padding:36px;border-radius:16px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
h1{font-family:'Manrope',sans-serif;color:var(--navy);font-size:24px;margin-bottom:24px}
.form-group{margin-bottom:16px}
label{display:block;margin-bottom:6px;color:var(--muted);font-size:13px;font-weight:600;text-transform:uppercase;letter-spacing:.04em}
input[type=text],textarea,select{width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:9px;font-family:inherit;font-size:15px;background:var(--bg);transition:.2s}
input:focus,textarea:focus,select:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px #E6F1F7}
textarea{resize:vertical;min-height:80px}
textarea.content{min-height:220px;font-family:'Menlo',monospace;font-size:14px}
input[type=file]{padding:10px;background:#fff;border:1.5px dashed var(--border);border-radius:9px;cursor:pointer;width:100%}
.btn{padding:13px 24px;background:var(--navy);color:#fff;border:none;border-radius:9px;font-family:inherit;font-size:15px;font-weight:600;cursor:pointer;transition:.2s}
.btn:hover{background:#072A42}
.btn--cancel{background:transparent;color:var(--muted);text-decoration:none;padding:13px 24px}
.error{background:#FDF0F0;color:var(--error);padding:12px;border-radius:9px;margin-bottom:16px;font-size:14px;border:1px solid #F5C6C6}
.hint{font-size:12px;color:var(--muted);margin-top:4px}
</style></head><body>
<div class="box">
    <h1>➕ Новая новость</h1>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group"><label>Заголовок *</label><input type="text" name="title" required maxlength="500" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" placeholder="Например: Открытие нового филиала"></div>
        <div class="form-group"><label>Краткое описание</label><textarea name="excerpt" rows="2" maxlength="500" placeholder="Пара предложений для превью (необязательно)"><?= htmlspecialchars($_POST['excerpt'] ?? '') ?></textarea></div>
        <div class="form-group"><label>Текст новости *</label><textarea name="content" class="content" required placeholder="Полный текст новости. Можно использовать переносы строк."><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea><div class="hint">Поддерживаются переносы строк. HTML отключён в целях безопасности.</div></div>
        <div class="form-group"><label>Изображение</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/gif"><div class="hint">JPG, PNG, WEBP или GIF, до 5MB</div></div>
        <div class="form-group"><label>Статус</label>
            <select name="status">
                <option value="draft" <?= ($_POST['status'] ?? '')==='draft'?'selected':'' ?>>Черновик (не видно на сайте)</option>
                <option value="published" <?= ($_POST['status'] ?? 'published')==='published'?'selected':'' ?>>Опубликовать</option>
            </select>
        </div>
        <div style="display:flex;gap:8px;margin-top:20px">
            <button type="submit" class="btn">Сохранить</button>
            <a href="news.php" class="btn--cancel">Отмена</a>
        </div>
    </form>
</div>
</body></html>