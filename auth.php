<?php
if (session_status() === PHP_SESSION_NONE) session_start();

function isLoggedIn(): bool {
    // Если есть старый флаг, но нет новых данных — значит, сессия старая
    if (isset($_SESSION['admin_logged_in']) && !isset($_SESSION['user'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && isset($_SESSION['user']);
}

function currentRole(): ?string {
    return $_SESSION['user']['role'] ?? null;
}

function currentUserId(): ?int {
    return $_SESSION['user']['id'] ?? null;
}

function currentDisplayName(): string {
    return $_SESSION['user']['display_name'] ?? ($_SESSION['user']['login'] ?? 'Пользователь');
}

function requireAuth(): void {
    if (!isLoggedIn()) { 
        header("Location: login.php"); 
        exit; 
    }
}

function requireRole($roles): void {
    requireAuth();
    if (!in_array(currentRole(), (array)$roles, true)) {
        http_response_code(403);
        die("<div style='font-family:sans-serif; text-align:center; padding:50px;'>
                <h2>🚫 Доступ запрещён</h2>
                <p>У вас недостаточно прав для просмотра этой страницы.</p>
                <a href='admin.php'>← Вернуться в панель</a>
             </div>");
    }
}

function hasRole(string $role): bool { return currentRole() === $role; }
function canManageUsers(): bool    { return hasRole('admin'); }
function canViewRequests(): bool   { return in_array(currentRole(), ['admin','operator'], true); }
function canManageReviews(): bool  { return in_array(currentRole(), ['admin','editor'], true); }
function canManageNews(): bool     { return in_array(currentRole(), ['admin','editor'], true); }
function roleLabel(string $role): string {
    return ['admin' => 'Администратор', 'operator' => 'Оператор', 'editor' => 'Редактор'][$role] ?? $role;
}
function roleBadgeClass(string $role): string {
    return ['admin' => 'badge--admin', 'operator' => 'badge--op', 'editor' => 'badge--ed'][$role] ?? '';
}