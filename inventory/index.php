<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';
include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';

// Fetch real inventory items from database
$result = $conn->query("SELECT * FROM inventory_items ORDER BY name ASC");

function getStatus($qty, $reorder) {
    if ($qty <= 0) return 'out-stock';
    if ($qty <= $reorder) return 'low-stock';
    return 'in-stock';
}
$status_labels = ["in-stock" => "In Stock", "low-stock" => "Low Stock", "out-stock" => "Out of Stock"];
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Inventory</h1>
      <p>Manage phones, accessories, and spare parts stock</p>
    </div>
    <a href="add.php" class="btn btn-primary-sm">+ Add New Item</a>
  </div>

  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'added'): ?>
    <div class="auth-error" style="background:#f0fdf4; color:#16a34a; max-width:none;">Item added successfully!</div>
  <?php endif; ?>
  <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
    <div class="auth-error" style="background:#f0fdf4; color:#16a34a; max-width:none;">Item deleted successfully!</div>
  <?php endif; ?>

  <div class="card">
    <div class="table-toolbar">
      <input type="text" class="search-input" placeholder="🔍 Search by name, brand...">
    </div>

    <table class="data-table">
      <thead>
        <tr>
          <th>Item</th>
          <th>Category</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($item = $result->fetch_assoc()): ?>
          <?php $status = getStatus($item['quantity'], $item['reorder_level']); ?>
          <tr>
            <td>
              <div class="item-cell">
                <div class="item-thumb">📱</div>
                <div>
                  <strong><?= htmlspecialchars($item['name']) ?></strong>
                  <small><?= htmlspecialchars($item['brand']) ?></small>
                </div>
              </div>
            </td>
            <td><?= htmlspecialchars($item['category']) ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>₹<?= number_format($item['selling_price']) ?></td>
            <td><span class="status-pill <?= $status ?>"><?= $status_labels[$status] ?></span></td>
            <td>
              <div class="action-icons">
                <a href="edit.php?id=<?= $item['id'] ?>" class="btn-icon-sm">Edit</a>
                <a href="delete.php?id=<?= $item['id'] ?>" class="btn-icon-sm" onclick="return confirm('Delete this item?')">Delete</a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:30px;">No items yet. Click "Add New Item" to get started.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</main>
<?php include '../includes/footer.php'; ?>