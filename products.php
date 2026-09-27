<?php
require("common/auth.php");
include("conn.php");

$sql = "SELECT products.*, categories.categories_name
        FROM products
        LEFT JOIN categories ON products.categories_id = categories.categories_id
        ORDER BY products.id DESC";
$result = $conn->query($sql);
$products = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$categoryResult = $conn->query("SELECT * FROM categories");
$categories = $categoryResult ? $categoryResult->fetch_all(MYSQLI_ASSOC) : [];
$pageTitle = "Products | MugStore";
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
                            <span class="page-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Catalog</p>
                                <h1 class="h3 mb-1">Products</h1>
                                <p class="text-muted mb-0">Add mugs, update prices, and keep product photos current.</p>
                            </div>
                        </div>
                        <div class="heading-actions">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="bi bi-plus-lg" aria-hidden="true"></i> Add Product
                            </button>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Product List</span></h2>
                                <p class="text-muted mb-0"><?php echo count($products); ?> product<?php echo count($products) === 1 ? '' : 's'; ?> in the store.</p>
                            </div>
                            <input class="form-control form-control-sm table-search" type="search" placeholder="Search products" data-table-search="productsTable" aria-label="Search products">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" id="productsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Created</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($products)) { ?>
                                        <tr>
                                            <td colspan="6" class="text-muted">No products found.</td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if (!empty($product['image'])) { ?>
                                                        <img src="uploads/products/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="48" height="48" style="object-fit: cover; border-radius: 10px;">
                                                    <?php } else { ?>
                                                        <span class="metric-icon"><i class="bi bi-image" aria-hidden="true"></i></span>
                                                    <?php } ?>
                                                    <div>
                                                        <p class="fw-semibold mb-0"><?php echo htmlspecialchars($product['name']); ?></p>
                                                        <p class="text-muted small mb-0">#<?php echo (int) $product['id']; ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($product['description']); ?></td>
                                            <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                                            <td><?php echo htmlspecialchars($product['categories_name'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                                            <td class="text-end">
                                                <a href="update_form_product.php?prod_id=<?php echo (int) $product['id']; ?>" class="btn btn-light btn-sm">Edit</a>
                                                <a href="delete_product.php?product_id=<?php echo (int) $product['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </main>

            <?php require("common/footer.php") ?>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="categories_id" class="form-label">Category</label>
                            <select class="form-select" id="categories_id" name="categories_id">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo (int) $category['categories_id']; ?>"><?php echo htmlspecialchars($category['categories_name']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require("common/script.php") ?>
</body>
</html>
