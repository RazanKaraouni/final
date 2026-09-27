<?php
require('common/auth.php');
require('conn.php');
$sql = "select * from categories";
$result = $conn->query($sql);
$categories = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$pageTitle = "Categories | MugStore";
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
                            <span class="page-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Catalog</p>
                                <h1 class="h3 mb-1">Categories</h1>
                                <p class="text-muted mb-0">Group products so the store stays easy to browse.</p>
                            </div>
                        </div>
                        <div class="heading-actions">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="bi bi-plus-lg" aria-hidden="true"></i> Add Category
                            </button>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Category List</span></h2>
                                <p class="text-muted mb-0"><?php echo count($categories); ?> categor<?php echo count($categories) === 1 ? 'y' : 'ies'; ?> in the catalog.</p>
                            </div>
                            <input class="form-control form-control-sm table-search" type="search" placeholder="Search categories" data-table-search="categoriesTable" aria-label="Search categories">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" id="categoriesTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Category Name</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($categories)) { ?>
                                        <tr>
                                            <td colspan="2" class="text-muted">No categories yet.</td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($categories as $category) { ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($category['categories_name']) ?></td>
                                            <td class="text-end">
                                                <a href="update_form_category.php?id=<?php echo $category['categories_id'] ?>" class="btn btn-light btn-sm">Edit</a>
                                                <a href="delete_category.php?id=<?php echo $category['categories_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_category.php" method="POST">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categories_name" placeholder="Enter category name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require("common/script.php") ?>
</body>
</html>
