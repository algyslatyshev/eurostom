<?php
require 'auth.php';
requireRole('admin');
require 'db.php';

$users = $conn->query("SELECT id, login, display_name, role, is_active, created_at FROM users ORDER BY id ASC");
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8">
<title>Пользователи — Админ-панель</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--navy-dark:#072A42;--accent:#2C7DA0;--bg:#F5F8FA;--white:#fff;--text:#1A2C38;--muted:#637A8A;--border:#E2EAF0;--success:#4CAF7D;--error:#E05B5B;--display:'Manrope',sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);padding:40px 24px;line-height:1.6}
.container{max-width:1100px;margin:0 auto;background:var(--white);padding:36px;border-radius:20px;box-shadow:0 12px 40px rgba(11,59,92,.12)}
.header{display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid var(--border);padding-bottom:20px;margin-bottom:28px;flex-wrap:wrap;gap:16px}
.header h1{font-family:var(--display);color:var(--navy);font-size:26px;font-weight:800}
.header__actions{display:flex;gap:10px}
.btn{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;border-radius:8px;font-weight:600;font-size:14px;text-decoration:none;cursor:pointer;border:none;transition:.2s}
.btn--primary{background:var(--navy);color:#fff}.btn--primary:hover{background:var(--navy-dark)}
.btn--accent{background:var(--accent);color:#fff}.btn--accent:hover{background:#236B8A}
.btn--ghost{background:transparent;color:var(--muted)}.btn--ghost:hover{background:var(--bg);color:var(--navy)}
.table-wrap{overflow-x:auto;border:1px solid var(--border);border-radius:14px}
table{width:100%;border-collapse:collapse;text-align:left}
th,td{padding:14px 18px;border-bottom:1px solid var(--border);font-size:14px}
th{background:var(--bg);color:var(--muted);font-size:12px;text-transform:uppercase;letter-spacing:.05em;font-weight:700}
tr:last-child td{border-bottom:none}
tr:hover td{background:#FAFCFE}
.badge{display:inline-flex;align-items:center;padding:5px 11px;border-radius:20px;font-size:12px;font-weight:600}
.badge--admin{background:#E6F1F7;color:#2C7DA0}
.badge--op{background:#FFF3CD;color:#856404}
.badge--ed{background:#E8F8EE;color:#2E7D50}
.badge--inactive{background:#F0F0F0;color:#999}
.action-btn{display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:8px;background:var(--bg);color:var(--muted);border:1px solid var(--border);text-decoration:none;transition:.2s}
.action-btn:hover{transform:translateY(-1px)}
.action-btn--edit:hover{background:#E6F1F7;color:var(--accent);border-color:#BCD6E2}
.action-btn--del:hover{background:#FDF0F0;color:var(--error);border-color:#F5C6C6}
</style></head>
<body>
<div class="container">
    <div class="header">
        <h1>👥 Пользователи</h1>
        <div class="header__actions">
            <a href="add_user.php" class="btn btn--accent">➕ Добавить</a>
            <a href="admin.php" class="btn btn--ghost">← Назад</a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>ID</th><th>Логин</th><th>Имя</th><th>Роль</th><th>Статус</th><th>Дата</th><th>Действия</th></tr></thead>
            <tbody>
            <?php if ($users->num_rows > 0): while($u = $users->fetch_assoc()): ?>
                <tr>
                    <td style="color:var(--muted)">#<?= $u['id'] ?></td>
                    <td><strong><?= htmlspecialchars($u['login']) ?></strong></td>
                    <td><?= htmlspecialchars($u['display_name'] ?: '—') ?></td>
                    <td><span class="badge <?= roleBadgeClass($u['role']) ?>"><?= roleLabel($u['role']) ?></span></td>
                    <td><?= $u['is_active'] ? '<span style="color:#2E7D50">● Активен</span>' : '<span class="badge badge--inactive">Отключён</span>' ?></td>
                    <td style="color:var(--muted);white-space:nowrap"><?= date('d.m.Y', strtotime($u['created_at'])) ?></td>
                    <td><div style="display:flex;gap:6px">
                        <a href="edit_user.php?id=<?= $u['id'] ?>" class="action-btn action-btn--edit" title="Изменить">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        </a>
                        <?php if ($u['id'] != currentUserId()): ?>
                        <a href="delete_user.php?id=<?= $u['id'] ?>" class="action-btn action-btn--del" title="Удалить" onclick="return confirm('Удалить пользователя «<?= htmlspecialchars($u['login']) ?>»?');">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        </a>
                        <?php endif; ?>
                    </div></td>
                </tr>
            <?php endwhile; else: ?>
                <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)">Пользователей нет</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body></html>