<?php
// Detect current page folder to highlight the right sidebar link
$current_path = $_SERVER['PHP_SELF'];
function is_active($folder) {
    global $current_path;
    return strpos($current_path, "/$folder/") !== false ? 'active' : '';
}
function is_dashboard_active() {
    global $current_path;
    return (basename($current_path) === 'dashboard.php') ? 'active' : '';
}
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <span style="font-size:26px;">📱</span>
    <h2>Mobile Shop<br>Management System</h2>
  </div>

  <nav class="sidebar-nav">
    <a class="sidebar-link <?= is_dashboard_active() ?>" href="/mobile-shop-management-system/dashboard.php">
      <span class="icon">🏠</span> Dashboard
    </a>
    <a class="sidebar-link <?= is_active('inventory') ?>" href="/mobile-shop-management-system/inventory/index.php">
      <span class="icon">📦</span> Inventory
    </a>
    <a class="sidebar-link <?= is_active('sales') ?>" href="/mobile-shop-management-system/sales/index.php">
      <span class="icon">🛒</span> Sales
    </a>
    <a class="sidebar-link <?= is_active('repairs') ?>" href="/mobile-shop-management-system/repairs/index.php">
      <span class="icon">🔧</span> Repairs
    </a>
    <a class="sidebar-link <?= is_active('customers') ?>" href="/mobile-shop-management-system/customers/index.php">
      <span class="icon">👥</span> Customers
    </a>
    <a class="sidebar-link <?= is_active('reports') ?>" href="/mobile-shop-management-system/reports/index.php">
      <span class="icon">📊</span> Reports
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <span class="avatar">👤</span>
      <div>
        <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?></strong>
        <small><?= htmlspecialchars(ucwords(str_replace('_', ' ', $_SESSION['user_role'] ?? ''))) ?></small>
      </div>
    </div>
    <a href="/mobile-shop-management-system/auth/logout.php" style="display:block; margin-top:10px; font-size:12px; color:#c7d2fe; text-decoration:none;">🚪 Logout</a>
  </div>
</aside>