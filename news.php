<?php
require 'auth.php';
requireRole(['admin','editor']);
require 'db.php';

$news = $conn->query("SELECT n.*, u.login AS author_login FROM news n LEFT JOIN users u ON u.id = n.author_id ORDER BY n.created_at DESC");
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Новости — Админ-панель</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--navy-dark:#072A42;--accent:#2C7DA0;--bg:#F5F8FA;--white:#fff;--muted:#637A8A;--border:#E2EAF0;--error:#E05B5B;--success:#4CAF7D;--display:'Manrope',sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:#1A2C38;padding:40px 24px;line-height:1.6}
.container{max-width:1200px;margin:0 auto;background:#fff;padding:36px;border-radius:20px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
.header{display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid var(--border);padding-bottom:20px;margin-bottom:28px;flex-wrap:wrap;gap:16px}
.header h1{font-family:var(--display);color:var(--navy);font-size:26px;font-weight:800}
.btn{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;border-radius:8px;font-weight:600;font-size:14px;text-decoration:none;border:none;cursor:pointer;transition:.2s}
.btn--accent{background:var(--accent);color:#fff}.btn--accent:hover{background:#236B8A}
.btn--ghost{background:transparent;color:var(--muted)}.btn--ghost:hover{background:var(--bg);color:var(--navy)}
.table-wrap{overflow-x:auto;border:1px solid var(--border);border-radius:14px}
table{width:100%;border-collapse:collapse;text-align:left}
th,td{padding:14px 18px;border-bottom:1px solid var(--border);font-size:14px;vertical-align:top}
th{background:var(--bg);color:var(--muted);font-size:12px;text-transform:uppercase;letter-spacing:.05em;font-weight:700}
tr:last-child td{border-bottom:none}
tr:hover td{background:#FAFCFE}
.thumb{width:60px;height:60px;border-radius:8px;object-fit:cover;border:1px solid var(--border);background:var(--bg)}
.badge{display:inline-flex;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.04em}
.badge--pub{background:#E8F8EE;color:#2E7D50}
.badge--draft{background:#FFF3CD;color:#856404}
.action-btn{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:var(--bg);color:var(--muted);border:1px solid var(--border);text-decoration:none;transition:.2s}
.action-btn:hover{transform:translateY(-1px)}
.action-btn--edit:hover{background:#E6F1F7;color:var(--accent)}
.action-btn--del:hover{background:#FDF0F0;color:var(--error)}
.title-cell strong{display:block;color:var(--navy);margin-bottom:3px}
.title-cell small{color:var(--muted);font-size:12px}
.empty{text-align:center;padding:40px;color:var(--muted)}
</style></head>
<body>
<div class="container">
    <div class="header">
        <h1>📰 Новости</h1>
        <div style="display:flex;gap:8px">
            <a href="add_news.php" class="btn btn--accent">➕ Добавить новость</a>
            <a href="admin.php" class="btn btn--ghost">← Назад</a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>ID</th><th>Фото</th><th>Заголовок</th><th>Автор</th><th>Статус</th><th>Дата</th><th>Действия</th></tr></thead>
            <tbody>
            <?php if ($news->num_rows > 0): while($n = $news->fetch_assoc()): ?>
                <tr>
                    <td style="color:var(--muted)">#<?= $n['id'] ?></td>
                    <td><?php if ($n['image']): ?><img src="<?= htmlspecialchars($n['image']) ?>" class="thumb" alt=""><?php else: ?><div class="thumb" style="display:flex;align-items:center;justify-content:center;color:#ccc;font-size:11px">нет</div><?php endif; ?></td>
                    <td class="title-cell">
                        <strong><?= htmlspecialchars($n['title']) ?></strong>
                        <small><?= htmlspecialchars(mb_substr($n['excerpt'] ?: strip_tags($n['content']), 0, 80)) ?>…</small>
                    </td>
                    <td><?= htmlspecialchars($n['author_login'] ?: '—') ?></td>
                    <td><span class="badge <?= $n['status']==='published'?'badge--pub':'badge--draft' ?>"><?= $n['status']==='published'?'Опубликовано':'Черновик' ?></span></td>
                    <td style="color:var(--muted);white-space:nowrap"><?= date('d.m.Y', strtotime($n['created_at'])) ?></td>
                    <td><div style="display:flex;gap:6px">
                        <?php if ($n['status']==='published'): ?>
                        <a href="news_view.php?id=<?= $n['id'] ?>" target="_blank" class="action-btn" title="Просмотр">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <?php endif; ?>
                        <a href="edit_news.php?id=<?= $n['id'] ?>" class="action-btn action-btn--edit" title="Редактировать">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        </a>
                        <a href="delete_news.php?id=<?= $n['id'] ?>" class="action-btn action-btn--del" onclick="return confirm('Удалить новость «<?= htmlspecialchars(addslashes($n['title'])) ?>»?');" title="Удалить">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </a>
                    </div></td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7" class="empty">📭 Новостей пока нет. <a href="add_news.php" style="color:var(--accent)">Добавьте первую!</a></td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body></html>