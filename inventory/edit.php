<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';

$id = (int)($_GET['id'] ?? 0);
$error = "";

// Fetch existing item
$stmt = $conn->prepare("SELECT * FROM inventory_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$item) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $brand = trim($_POST['brand'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $quantity = (int)($_POST['quantity'] ?? 0);
    $reorder_level = (int)($_POST['reorder_level'] ?? 5);
    $cost_price = (float)($_POST['cost_price'] ?? 0);
    $selling_price = (float)($_POST['selling_price'] ?? 0);
    $supplier = trim($_POST['supplier'] ?? '');

    if ($name === '' || $selling_price <= 0) {
        $error = "Please enter at least the item name and a valid selling price.";
    } else {
        $update = $conn->prepare("UPDATE inventory_items SET name=?, brand=?, category=?, quantity=?, reorder_level=?, cost_price=?, selling_price=?, supplier=? WHERE id=?");
        $update->bind_param("sssiiddsi", $name, $brand, $category, $quantity, $reorder_level, $cost_price, $selling_price, $supplier, $id);

        if ($update->execute()) {
            header("Location: index.php?msg=added");
            exit;
        } else {
            $error = "Something went wrong. Please try again.";
        }
        $update->close();
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Edit Item</h1>
      <p>Update item details</p>
    </div>
    <a href="index.php" class="btn btn-outline">← Back to Inventory</a>
  </div>

  <div class="card form-card">
    <?php if ($error): ?>
      <div class="auth-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="form-row">
        <div class="form-group">
          <label>Item Name</label>
          <input type="text" name="name" required value="<?= htmlspecialchars($item['name']) ?>">
        </div>
        <div class="form-group">
          <label>Brand</label>
          <input type="text" name="brand" value="<?= htmlspecialchars($item['brand']) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Category</label>
          <select name="category" required>
            <option value="Phone" <?= $item['category']=='Phone'?'selected':'' ?>>Phone</option>
            <option value="Accessory" <?= $item['category']=='Accessory'?'selected':'' ?>>Accessory</option>
            <option value="Spare Part" <?= $item['category']=='Spare Part'?'selected':'' ?>>Spare Part</option>
          </select>
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" value="<?= htmlspecialchars($item['supplier']) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Quantity in Stock</label>
          <input type="number" name="quantity" min="0" required value="<?= $item['quantity'] ?>">
        </div>
        <div class="form-group">
          <label>Reorder Level</label>
          <input type="number" name="reorder_level" min="0" value="<?= $item['reorder_level'] ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Cost Price (₹)</label>
          <input type="number" name="cost_price" min="0" step="0.01" value="<?= $item['cost_price'] ?>">
        </div>
        <div class="form-group">
          <label>Selling Price (₹)</label>
          <input type="number" name="selling_price" min="0" step="0.01" required value="<?= $item['selling_price'] ?>">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary-sm">Update Item</button>
        <a href="index.php" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</main>
<?php include '../includes/footer.php'; ?>