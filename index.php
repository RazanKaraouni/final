<?php
require('common/auth.php');
include("conn.php");

$sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";
$result_categories = $conn->query($sql_categories);
$row_categories = $result_categories ? $result_categories->fetch_assoc() : null;
$total_categories = $row_categories['total_categories'] ?? 0;

$sql_products = "SELECT COUNT(*) AS total_products FROM products";
$result_products = $conn->query($sql_products);
$row_products = $result_products ? $result_products->fetch_assoc() : null;
$total_products = $row_products['total_products'] ?? 0;

$sql_users = "SELECT COUNT(*) AS total_users FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users ? $result_users->fetch_assoc() : null;
$total_users = $row_users['total_users'] ?? 0;

$sql_clients = "SELECT COUNT(*) AS total_clients FROM clients";
$result_clients = $conn->query($sql_clients);
$row_clients = $result_clients ? $result_clients->fetch_assoc() : null;
$total_clients = $row_clients['total_clients'] ?? 0;

$recentResult = $conn->query("SELECT products.name, products.price, products.created_at, categories.categories_name
    FROM products
    LEFT JOIN categories ON products.categories_id = categories.categories_id
    ORDER BY products.id DESC
    LIMIT 5");
$recentProducts = $recentResult ? $recentResult->fetch_all(MYSQLI_ASSOC) : [];

$pageTitle = "Dashboard | MugStore";
?>
<?php include("common/head.php") ?>

<body>
<div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>
    <?php require("common/sidebar.php"); ?>

    <div class="admin-main">
        <?php require("common/navbar.php"); ?>

        <main class="dashboard-content">
            <div class="container-fluid px-3 px-lg-4 py-4">
                <div class="page-heading">
                    <div class="page-heading-copy">
                        <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
                        <div>
                            <p class="eyebrow mb-1">Overview</p>
                            <h1 class="h3 mb-1">Dashboard</h1>
                            <p class="text-muted mb-0">Monitor categories, products, clients, and team accounts from one workspace.</p>
                        </div>
                    </div>
                    <div class="heading-actions">
                        <a class="btn btn-outline-secondary btn-sm" href="products.php"><i class="bi bi-box-seam" aria-hidden="true"></i> Products</a>
                        <a class="btn btn-primary btn-sm" href="categories.php"><i class="bi bi-plus-lg" aria-hidden="true"></i> Categories</a>
                    </div>
                </div>

                <section class="row g-3 mt-1" aria-label="Dashboard metrics">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <article class="metric-card metric-primary">
                            <div class="metric-top">
                                <span class="metric-label">Categories</span>
                                <span class="metric-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
                            </div>
                            <div class="metric-value"><?php echo (int) $total_categories; ?></div>
                            <div class="metric-meta"><span>catalog groups</span></div>
                        </article>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <article class="metric-card metric-success">
                            <div class="metric-top">
                                <span class="metric-label">Products</span>
                                <span class="metric-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
                            </div>
                            <div class="metric-value"><?php echo (int) $total_products; ?></div>
                            <div class="metric-meta"><span>items in stock list</span></div>
                        </article>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <article class="metric-card metric-warning">
                            <div class="metric-top">
                                <span class="metric-label">Users</span>
                                <span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                            </div>
                            <div class="metric-value"><?php echo (int) $total_users; ?></div>
                            <div class="metric-meta"><span>admin accounts</span></div>
                        </article>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <article class="metric-card metric-danger">
                            <div class="metric-top">
                                <span class="metric-label">Clients</span>
                                <span class="metric-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                            </div>
                            <div class="metric-value"><?php echo (int) $total_clients; ?></div>
                            <div class="metric-meta"><span>saved contacts</span></div>
                        </article>
                    </div>
                </section>

                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <section class="panel">
                            <div class="panel-header">
                                <div>
                                    <h2 class="h5 mb-1 section-title"><i class="bi bi-clock-history" aria-hidden="true"></i><span>Recent Products</span></h2>
                                    <p class="text-muted mb-0">The latest items added to the store.</p>
                                </div>
                                <a class="btn btn-primary btn-sm" href="products.php">View all</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($recentProducts)) { ?>
                                            <tr>
                                                <td colspan="4" class="text-muted">No products yet.</td>
                                            </tr>
                                        <?php } ?>
                                        <?php foreach ($recentProducts as $product) { ?>
                                            <tr>
                                                <td class="fw-semibold"><?php echo htmlspecialchars($product['name']); ?></td>
                                                <td><?php echo htmlspecialchars($product['categories_name'] ?? '—'); ?></td>
                                                <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                                                <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>

        <?php require("common/footer.php"); ?>
    </div>
</div>

<?php require("common/script.php"); ?>
</body>
</html>
