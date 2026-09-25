<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
require_once '../config/db.php';

$error = "";

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
        $stmt = $conn->prepare("INSERT INTO inventory_items (name, brand, category, quantity, reorder_level, cost_price, selling_price, supplier) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiidds", $name, $brand, $category, $quantity, $reorder_level, $cost_price, $selling_price, $supplier);

        if ($stmt->execute()) {
            header("Location: index.php?msg=added");
            exit;
        } else {
            $error = "Something went wrong. Please try again.";
        }
        $stmt->close();
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
include '../includes/topbar.php';
?>
<main class="page-body">
  <div class="page-header">
    <div>
      <h1>Add New Item</h1>
      <p>Add a phone, accessory, or spare part to inventory</p>
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
          <input type="text" name="name" placeholder="e.g. iPhone 13 128GB" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </div>
        <div class="form-group">
          <label>Brand</label>
          <input type="text" name="brand" placeholder="e.g. Apple" value="<?= htmlspecialchars($_POST['brand'] ?? '') ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Category</label>
          <select name="category" required>
            <option value="">Select category</option>
            <option value="Phone">Phone</option>
            <option value="Accessory">Accessory</option>
            <option value="Spare Part">Spare Part</option>
          </select>
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" placeholder="Supplier name">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Quantity in Stock</label>
          <input type="number" name="quantity" placeholder="0" min="0" required>
        </div>
        <div class="form-group">
          <label>Reorder Level (low-stock alert)</label>
          <input type="number" name="reorder_level" placeholder="5" min="0" value="5">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Cost Price (₹)</label>
          <input type="number" name="cost_price" placeholder="0" min="0" step="0.01">
        </div>
        <div class="form-group">
          <label>Selling Price (₹)</label>
          <input type="number" name="selling_price" placeholder="0" min="0" step="0.01" required>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary-sm">Save Item</button>
        <a href="index.php" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</main>
<?php include '../includes/footer.php'; ?>