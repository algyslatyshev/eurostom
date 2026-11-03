<?php
require 'auth.php';
requireAuth();
require 'db.php';

$total   = $conn->query("SELECT COUNT(*) c FROM requests")->fetch_assoc()['c'];
$new     = $conn->query("SELECT COUNT(*) c FROM requests WHERE status='Новая'")->fetch_assoc()['c'];
$today   = $conn->query("SELECT COUNT(*) c FROM requests WHERE DATE(created_at)=CURDATE()")->fetch_assoc()['c'];
$requests = $conn->query("SELECT * FROM requests ORDER BY created_at DESC");
$reviews  = $conn->query("SELECT * FROM reviews ORDER BY id DESC");

$userRole   = currentRole();
$userName   = currentDisplayName();
$userLogin  = $_SESSION['user']['login'] ?? '';
$newsCount  = $conn->query("SELECT COUNT(*) c FROM news")->fetch_assoc()['c'];
$usersCount = canManageUsers() ? $conn->query("SELECT COUNT(*) c FROM users")->fetch_assoc()['c'] : 0;

$tabs = [];
if (canViewRequests())  $tabs['requests']  = '📋 Заявки';
if (canManageReviews()) $tabs['reviews']   = '⭐ Отзывы';
if (canManageNews())    $tabs['news']      = '📰 Новости';
if (canManageUsers())   $tabs['users']     = '👥 Пользователи';

$activeTab = $_GET['tab'] ?? array_key_first($tabs);
if (!isset($tabs[$activeTab])) $activeTab = array_key_first($tabs);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Панель управления</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--navy:#0B3B5C;--navy-dark:#072A42;--accent:#2C7DA0;--accent-light:#E6F1F7;--bg:#F5F8FA;--white:#fff;--text:#1A2C38;--muted:#637A8A;--border:#E2EAF0;--success:#4CAF7D;--error:#E05B5B;--display:'Manrope',sans-serif;--radius:14px;--radius-lg:20px;--shadow:0 4px 20px rgba(11,59,92,.08);--shadow-lg:0 12px 40px rgba(11,59,92,.12)}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Inter',sans-serif;background:var(--bg);color:var(--text);padding:32px 24px;line-height:1.6;min-height:100vh}
.container{max-width:1280px;margin:0 auto;background:var(--white);padding:36px;border-radius:var(--radius-lg);box-shadow:var(--shadow-lg)}
.header{display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid var(--border);padding-bottom:24px;margin-bottom:24px;flex-wrap:wrap;gap:16px}
.header h1{font-family:var(--display);color:var(--navy);font-size:26px;font-weight:800;display:flex;align-items:center;gap:10px}
.header__right{display:flex;align-items:center;gap:14px;flex-wrap:wrap}
.user-info{display:flex;flex-direction:column;align-items:flex-end;font-size:13px}
.user-info strong{color:var(--navy);font-weight:600}
.user-info small{color:var(--muted)}
.badge{display:inline-flex;padding:5px 11px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em}
.badge--admin{background:#E6F1F7;color:#2C7DA0}
.badge--op{background:#FFF3CD;color:#856404}
.badge--ed{background:#E8F8EE;color:#2E7D50}
.btn{display:inline-flex;align-items:center;gap:6px;padding:10px 18px;border-radius:8px;font-weight:600;font-size:13px;text-decoration:none;border:none;cursor:pointer;transition:.2s}
.btn--primary{background:var(--navy);color:#fff}.btn--primary:hover{background:var(--navy-dark)}
.btn--accent{background:var(--accent);color:#fff}.btn--accent:hover{background:#236B8A}
.btn--out{background:#FDF0F0;color:var(--error)}.btn--out:hover{background:#FAD4D4}
.btn--site{color:var(--muted);background:transparent}.btn--site:hover{color:var(--navy);background:var(--bg)}
.tabs{display:flex;gap:6px;margin-bottom:28px;background:var(--bg);padding:6px;border-radius:12px;width:fit-content;flex-wrap:wrap}
.tab{padding:10px 20px;border-radius:8px;font-weight:600;font-size:14px;color:var(--muted);cursor:pointer;border:none;background:transparent;text-decoration:none;display:inline-flex;align-items:center;gap:6px}
.tab:hover{color:var(--navy)}
.tab.active{background:var(--white);color:var(--navy);box-shadow:0 2px 8px rgba(11,59,92,.08)}
.dashboard{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px}
.card{background:var(--white);padding:20px;border-radius:var(--radius);border:1px solid var(--border);box-shadow:var(--shadow);position:relative;overflow:hidden}
.card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;background:var(--accent)}
.card--red::before{background:var(--error)}.card--green::before{background:var(--success)}
.card h3{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;font-weight:600;margin-bottom:6px}
.card p{font-family:var(--display);font-size:32px;font-weight:800;color:var(--navy);line-height:1}
.search-box{margin-bottom:20px;position:relative}
.search-box input{width:100%;padding:14px 18px 14px 44px;border:1.5px solid var(--border);border-radius:10px;font-family:inherit;font-size:14px;background:var(--bg)}
.search-box input:focus{outline:none;border-color:var(--accent);background:#fff;box-shadow:0 0 0 3px var(--accent-light)}
.search-box svg{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted)}
.table-wrap{overflow-x:auto;border-radius:var(--radius);border:1px solid var(--border);background:#fff}
table{width:100%;border-collapse:collapse;text-align:left}
th,td{padding:14px 18px;border-bottom:1px solid var(--border);font-size:14px;vertical-align:top}
th{background:var(--bg);color:var(--muted);font-size:11px;text-transform:uppercase;letter-spacing:.05em;font-weight:700;white-space:nowrap}
tr:last-child td{border-bottom:none}
tr:hover td{background:#FAFCFE}
td strong{color:var(--navy);font-weight:600}
.td-phone{font-family:monospace;font-size:14px;font-weight:600;color:var(--navy)}
.td-date{color:var(--muted);white-space:nowrap;font-size:13px}
.review-text{font-size:13.5px;color:var(--text);max-width:400px;white-space:normal;line-height:1.5}
.badge-status{display:inline-flex;padding:5px 11px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap}
.badge-status--new{background:#FFF3CD;color:#856404}
.badge-status--called{background:#EBF9F1;color:#2E7D50}
.badge-status--pub{background:#E8F8EE;color:#2E7D50}
.badge-status--draft{background:#F0F0F0;color:#888}
.action-btn{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:7px;text-decoration:none;background:var(--bg);color:var(--muted);border:1px solid var(--border);transition:.2s}
.action-btn:hover{transform:translateY(-1px)}
.action-btn--check:hover{background:#EBF9F1;color:var(--success);border-color:#C4EBD3}
.action-btn--delete:hover{background:#FDF0F0;color:var(--error);border-color:#F5C6C6}
.action-btn--edit:hover{background:#E6F1F7;color:var(--accent)}
.stars{color:#F5B547;font-size:15px;letter-spacing:1px}
.tab-content{display:none}.tab-content.active{display:block}
@media(max-width:900px){.container{padding:20px}.dashboard{grid-template-columns:1fr}.header{flex-direction:column;align-items:flex-start}.user-info{align-items:flex-start}}
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>⚙️ Панель управления</h1>
        <div class="header__right">
            <div class="user-info">
                <strong><?= htmlspecialchars($userName) ?></strong>
                <small>@<?= htmlspecialchars($userLogin) ?> · <span class="badge <?= roleBadgeClass($userRole) ?>"><?= roleLabel($userRole) ?></span></small>
            </div>
            <a href="index.php" class="btn btn--site">🌐 На сайт</a>
            <?php if (canViewRequests()): ?><a href="export.php" class="btn btn--accent">📥 Excel</a><?php endif; ?>
            <a href="logout.php" class="btn btn--out">Выйти</a>
        </div>
    </div>

    <div class="tabs">
        <?php foreach ($tabs as $key => $label): ?>
            <a href="?tab=<?= $key ?>" class="tab <?= $key === $activeTab ? 'active' : '' ?>"><?= $label ?></a>
        <?php endforeach; ?>
    </div>

    <!-- ================= ЗАЯВКИ ================= -->
    <?php if (canViewRequests() && $activeTab === 'requests'): ?>
    <div class="tab-content active">
        <div class="dashboard">
            <div class="card"><h3>Всего заявок</h3><p><?= $total ?></p></div>
            <div class="card card--red"><h3>Новых</h3><p><?= $new ?></p></div>
            <div class="card card--green"><h3>За сегодня</h3><p><?= $today ?></p></div>
        </div>
        <div class="search-box">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="searchInput" placeholder="Поиск по имени или телефону...">
        </div>
        <div class="table-wrap">
            <table id="requestsTable">
                <thead><tr><th>ID</th><th>Имя</th><th>Телефон</th><th>Услуга</th><th>Статус</th><th>Дата</th><th>Действия</th></tr></thead>
                <tbody>
                <?php if ($requests->num_rows > 0): while($r = $requests->fetch_assoc()): ?>
                    <tr>
                        <td style="color:var(--muted)">#<?= $r['id'] ?></td>
                        <td><strong><?= htmlspecialchars($r['name']) ?></strong></td>
                        <td class="td-phone"><?= htmlspecialchars($r['phone']) ?></td>
                        <td><?= htmlspecialchars($r['service'] ?: '—') ?></td>
                        <td><?php if ($r['status']==='Новая'||empty($r['status'])): ?>
                            <span class="badge-status badge-status--new">Новая</span>
                        <?php else: ?>
                            <span class="badge-status badge-status--called"><?= htmlspecialchars($r['status']) ?></span>
                        <?php endif; ?></td>
                        <td class="td-date"><?= date('d.m.Y H:i', strtotime($r['created_at'])) ?></td>
                        <td><div style="display:flex;gap:6px">
                            <?php if ($r['status']==='Новая'||empty($r['status'])): ?>
                            <a href="status.php?id=<?= $r['id'] ?>" class="action-btn action-btn--check" title="Позвонили">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            </a>
                            <?php endif; ?>
                            <a href="delete.php?id=<?= $r['id'] ?>" class="action-btn action-btn--delete" onclick="return confirm('Удалить заявку?');" title="Удалить">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                            </a>
                        </div></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)">Заявок нет</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================= ОТЗЫВЫ ================= -->
    <?php if (canManageReviews() && $activeTab === 'reviews'): ?>
    <div class="tab-content active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px">
            <h2 style="font-family:var(--display);color:var(--navy);font-size:20px">⭐ Управление отзывами</h2>
            <a href="add_review.php" class="btn btn--accent">➕ Добавить отзыв</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>ID</th><th>Автор</th><th>Текст</th><th>Рейтинг</th><th>Статус</th><th>Дата</th><th>Действия</th></tr></thead>
                <tbody>
                <?php if ($reviews->num_rows > 0): while($rv = $reviews->fetch_assoc()): ?>
                    <tr>
                        <td style="color:var(--muted)">#<?= $rv['id'] ?></td>
                        <td><strong><?= htmlspecialchars($rv['author']) ?></strong></td>
                        <td class="review-text"><?= htmlspecialchars($rv['text']) ?></td>
                        <td><span class="stars"><?= str_repeat('★', (int)$rv['rating']) ?></span></td>
                        <td>
                            <?php if (($rv['status'] ?? '') === 'pending'): ?>
                                <span class="badge-status badge-status--new">На модерации</span>
                            <?php else: ?>
                                <span class="badge-status badge-status--pub">Опубликован</span>
                            <?php endif; ?>
                        </td>
                        <td class="td-date"><?= date('d.m.Y', strtotime($rv['date'])) ?></td>
                        <td><div style="display:flex;gap:6px">
                            <?php if (($rv['status'] ?? '') === 'pending'): ?>
                            <a href="approve_review.php?id=<?= $rv['id'] ?>" class="action-btn action-btn--check" title="Одобрить">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            </a>
                            <?php endif; ?>
                            <a href="delete_review.php?id=<?= $rv['id'] ?>" class="action-btn action-btn--delete" onclick="return confirm('Удалить отзыв?');" title="Удалить">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                            </a>
                        </div></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)">Отзывов нет</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================= НОВОСТИ ================= -->
    <?php if (canManageNews() && $activeTab === 'news'): ?>
    <div class="tab-content active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px">
            <h2 style="font-family:var(--display);color:var(--navy);font-size:20px">📰 Новости (<?= $newsCount ?>)</h2>
            <div style="display:flex;gap:8px">
                <a href="news_public.php" target="_blank" class="btn btn--site" style="background:var(--bg)">👁 Все новости на сайте</a>
                <a href="news.php" class="btn btn--accent">Управление →</a>
            </div>
        </div>
        <div class="card" style="padding:32px;text-align:center;border:1px dashed var(--border)">
            <p style="font-size:44px;margin-bottom:8px">📰</p>
            <p style="color:var(--muted);margin-bottom:16px">Всего новостей: <b style="color:var(--navy)"><?= $newsCount ?></b></p>
            <a href="news.php" class="btn btn--primary">Перейти к списку новостей</a>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================= ПОЛЬЗОВАТЕЛИ ================= -->
    <?php if (canManageUsers() && $activeTab === 'users'): ?>
    <div class="tab-content active">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px">
            <h2 style="font-family:var(--display);color:var(--navy);font-size:20px">👥 Пользователи (<?= $usersCount ?>)</h2>
            <a href="users.php" class="btn btn--accent">Управление →</a>
        </div>
        <div class="card" style="padding:32px;text-align:center;border:1px dashed var(--border)">
            <p style="font-size:44px;margin-bottom:8px">👥</p>
            <p style="color:var(--muted);margin-bottom:16px">Управление доступом и ролями</p>
            <a href="users.php" class="btn btn--primary">Перейти к пользователям</a>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('searchInput')?.addEventListener('keyup', function(){
    const f = this.value.toLowerCase();
    document.querySelectorAll('#requestsTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(f) ? '' : 'none';
    });
});
</script>
</body></html>