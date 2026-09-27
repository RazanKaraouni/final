<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: categories.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM categories WHERE categories_id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("Category not found");
}

$category = $result->fetch_assoc();
$pageTitle = "Edit Category | MugStore";
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
                                <h1 class="h3 mb-1">Edit Category</h1>
                                <p class="text-muted mb-0">Update the name used across the product catalog.</p>
                            </div>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <form action="update_category.php" method="POST" class="col-12 col-lg-6">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['categories_id']); ?>">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="categories_name" value="<?php echo htmlspecialchars($category['categories_name']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="categories.php" class="btn btn-outline-secondary">Cancel</a>
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
