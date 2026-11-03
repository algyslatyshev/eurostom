<?php
require 'db.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT n.*, u.display_name, u.login FROM news n LEFT JOIN users u ON u.id = n.author_id WHERE n.id = ? AND n.status='published' LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$n = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$n) {
    http_response_code(404);
    die("<h1 style='font-family:sans-serif;padding:40px;text-align:center'>Новость не найдена</h1><p style='text-align:center'><a href='news_public.php'>← Все новости</a></p>");
}
$author = $n['display_name'] ?: $n['login'] ?: 'Редакция';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?= htmlspecialchars($n['title']) ?> — Ваша стоматология</title>
<meta name="description" content="<?= htmlspecialchars(mb_substr($n['excerpt'] ?: strip_tags($n['content']), 0, 160)) ?>">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--accent-light:#E6F1F7;--bg:#F5F8FA;--white:#fff;--muted:#637A8A;--border:#E2EAF0;--text:#1A2C38}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);line-height:1.7}
a{color:var(--accent);text-decoration:none}
.container{max-width:800px;margin:0 auto;padding:0 24px}
header{background:#fff;border-bottom:1px solid var(--border);padding:18px 0}
header .container{display:flex;justify-content:space-between;align-items:center;max-width:1100px}
.logo{font-family:'Manrope',sans-serif;font-weight:800;font-size:20px;color:var(--navy)}
.logo em{font-style:normal;color:var(--accent)}
.back{font-size:14px;font-weight:600;color:var(--muted);transition:.2s}
.back:hover{color:var(--accent)}
main{padding:48px 0 80px}
.article{background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 12px 40px rgba(11,59,92,.08)}
.article-img{width:100%;aspect-ratio:16/9;object-fit:cover}
.article-head{padding:36px 40px 20px}
.meta{display:flex;gap:16px;flex-wrap:wrap;font-size:13px;color:var(--muted);margin-bottom:14px}
.meta span{display:inline-flex;align-items:center;gap:5px}
h1{font-family:'Manrope',sans-serif;font-size:clamp(26px,4vw,38px);color:var(--navy);line-height:1.2;margin-bottom:14px}
.excerpt{font-size:18px;color:var(--muted);line-height:1.6;border-left:3px solid var(--accent);padding-left:16px;margin-bottom:8px}
.article-body{padding:0 40px 40px;font-size:16.5px;color:var(--text)}
.article-body p{margin-bottom:16px}
.article-footer{margin-top:32px;padding-top:20px;border-top:1px solid var(--border);display:flex;justify-content:space-between;flex-wrap:wrap;gap:16px;align-items:center}
.article-footer a{font-weight:600}
footer{background:#072A42;color:rgba(255,255,255,.6);text-align:center;padding:32px 0;font-size:13px;margin-top:60px}
@media(max-width:600px){.article-head{padding:24px 24px 12px}.article-body{padding:0 24px 24px}}
</style>
</head>
<body>
<header><div class="container">
    <a href="index.php" class="logo">Ваша<em>Стоматология</em></a>
    <a href="news_public.php" class="back">← Все новости</a>
</div></header>
<main><div class="container">
    <article class="article">
        <?php if ($n['image']): ?>
            <img src="<?= htmlspecialchars($n['image']) ?>" alt="" class="article-img">
        <?php endif; ?>
        <div class="article-head">
            <div class="meta">
                <span>📅 <?= date('d.m.Y', strtotime($n['created_at'])) ?></span>
                <span>✍️ <?= htmlspecialchars($author) ?></span>
            </div>
            <h1><?= htmlspecialchars($n['title']) ?></h1>
            <?php if ($n['excerpt']): ?><p class="excerpt"><?= htmlspecialchars($n['excerpt']) ?></p><?php endif; ?>
        </div>
        <div class="article-body">
            <?= nl2br(htmlspecialchars($n['content'])) ?>
            <div class="article-footer">
                <a href="news_public.php">← Все новости</a>
                <a href="index.php#booking" style="background:var(--navy);color:#fff;padding:10px 20px;border-radius:8px">Записаться на приём</a>
            </div>
        </div>
    </article>
</div></main>
<footer>© <?= date('Y') ?> Ваша стоматология. Все права защищены.</footer>
</body></html>