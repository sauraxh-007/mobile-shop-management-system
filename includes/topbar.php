<header class="topbar">
  <input type="text" class="search-input" placeholder="🔍 Search here...">

  <div class="topbar-right">
    <div class="notif-bell">🔔 <span class="notif-badge">3</span></div>
<div class="topbar-user">
  <span class="avatar">👤</span>
  <div>
    <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong>
    <small><?= htmlspecialchars(ucwords(str_replace('_', ' ', $_SESSION['user_role'] ?? ''))) ?></small>
  </div>
</div>
  </div>
</header>