<?php
require("common/auth.php");
include("conn.php");

$id = (int) ($_GET["prod_id"] ?? 0);
if ($id <= 0) {
    header("Location: products.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM `products` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: products.php");
    exit;
}

$categoryResult = $conn->query("SELECT * FROM categories");
$categories = $categoryResult ? $categoryResult->fetch_all(MYSQLI_ASSOC) : [];
$pageTitle = "Edit Product | MugStore";
?>
<?php include("common/head.php") ?>

<body>
    <div class="admin-shell">
        <div class="sidebar-backdrop" data-sidebar-close></div>
        <?php require("common/sidebar.php") ?>

        <div class="admin-main">
            <?php require("common/navbar.php") ?>

            <main class="dashboard-content">
                <div class="container-fluid px-3 px-lg-4 py-4">
                    <div class="page-heading">
                        <div class="page-heading-copy">
                            <span class="page-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Catalog</p>
                                <h1 class="h3 mb-1">Edit Product</h1>
                                <p class="text-muted mb-0">Change the name, price, category, or photo.</p>
                            </div>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <form action="update_product.php" method="POST" enctype="multipart/form-data" class="col-12 col-lg-8">
                            <input type="hidden" name="id" value="<?php echo (int) $product['id']; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="categories_id" class="form-label">Category</label>
                                <select class="form-select" id="categories_id" name="categories_id">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) { ?>
                                        <option value="<?php echo (int) $category['categories_id']; ?>" <?php echo (int) ($product['categories_id'] ?? 0) === (int) $category['categories_id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($category['categories_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <?php if (!empty($product['image'])) { ?>
                                        <img src="uploads/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="96" height="96" style="object-fit: cover; border-radius: 12px;">
                                    <?php } else { ?>
                                        <span class="text-muted">No image</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Replace Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                        </form>
                    </section>
                </div>
            </main>

            <?php require("common/footer.php") ?>
        </div>
    </div>

    <?php require("common/script.php") ?>
</body>
</html>
