<?php
require 'db.php';
$news = $conn->query("SELECT id, title, excerpt, image, created_at FROM news WHERE status='published' ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Новости — Ваша стоматология</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--accent:#2C7DA0;--accent-light:#E6F1F7;--bg:#F5F8FA;--white:#fff;--muted:#637A8A;--border:#E2EAF0;--text:#1A2C38}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);line-height:1.6}
a{color:inherit;text-decoration:none}
.container{max-width:1100px;margin:0 auto;padding:0 24px}
header{background:var(--white);border-bottom:1px solid var(--border);padding:18px 0;position:sticky;top:0;z-index:10}
header .container{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px}
.logo{font-family:'Manrope',sans-serif;font-weight:800;font-size:20px;color:var(--navy)}
.logo em{font-style:normal;color:var(--accent)}
.back{font-size:14px;font-weight:600;color:var(--muted);transition:.2s}
.back:hover{color:var(--accent)}
main{padding:48px 0 80px}
h1{font-family:'Manrope',sans-serif;font-size:clamp(30px,4vw,42px);color:var(--navy);margin-bottom:10px}
.sub{color:var(--muted);font-size:16px;margin-bottom:40px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px}
.card{background:#fff;border-radius:16px;overflow:hidden;border:1px solid var(--border);display:flex;flex-direction:column;transition:.25s}
.card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(11,59,92,.12);border-color:transparent}
.card-img{aspect-ratio:16/9;background:var(--accent-light);overflow:hidden}
.card-img img{width:100%;height:100%;object-fit:cover;transition:.5s}
.card:hover .card-img img{transform:scale(1.05)}
.card-img.placeholder{display:flex;align-items:center;justify-content:center;color:#B8CCD8;font-size:40px}
.card-body{padding:22px;display:flex;flex-direction:column;gap:10px;flex:1}
.card-date{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;font-weight:600}
.card-title{font-family:'Manrope',sans-serif;font-size:19px;color:var(--navy);line-height:1.3;font-weight:700}
.card-excerpt{color:var(--muted);font-size:14px;flex:1}
.card-link{color:var(--accent);font-weight:600;font-size:14px;display:inline-flex;align-items:center;gap:6px;margin-top:auto}
.card-link:hover{gap:10px}
.empty{text-align:center;padding:60px 20px;color:var(--muted)}
footer{background:#072A42;color:rgba(255,255,255,.6);text-align:center;padding:32px 0;font-size:13px}
</style>
</head>
<body>
<header><div class="container">
    <a href="index.php" class="logo">Ваша<em>Стоматология</em></a>
    <a href="index.php" class="back">← На главную</a>
</div></header>
<main><div class="container">
    <h1>Новости клиники</h1>
    <p class="sub">Актуальные события, акции и полезные материалы</p>
    <div class="grid">
    <?php if ($news->num_rows > 0): while($n = $news->fetch_assoc()): ?>
        <a href="news_view.php?id=<?= $n['id'] ?>" class="card">
            <?php if ($n['image']): ?>
                <div class="card-img"><img src="<?= htmlspecialchars($n['image']) ?>" alt="" loading="lazy"></div>
            <?php else: ?>
                <div class="card-img placeholder">📰</div>
            <?php endif; ?>
            <div class="card-body">
                <div class="card-date"><?= date('d.m.Y', strtotime($n['created_at'])) ?></div>
                <h2 class="card-title"><?= htmlspecialchars($n['title']) ?></h2>
                <p class="card-excerpt"><?= htmlspecialchars(mb_substr($n['excerpt'] ?: '', 0, 140)) ?><?= mb_strlen($n['excerpt'] ?: '') > 140 ? '…' : '' ?></p>
                <span class="card-link">Читать далее →</span>
            </div>
        </a>
    <?php endwhile; else: ?>
        <div class="empty" style="grid-column:1/-1">📭 Пока нет опубликованных новостей</div>
    <?php endif; ?>
    </div>
</div></main>
<footer>© <?= date('Y') ?> Ваша стоматология. Все права защищены.</footer>
</body></html>