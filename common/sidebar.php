<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
    <div class="sidebar-header">
        <a class="brand-mark" href="index.php" aria-label="MugStore dashboard">
            <span class="brand-icon"><i class="bi bi-cup-hot-fill" aria-hidden="true"></i></span>
            <span class="brand-copy">
                <span class="brand-title">MugStore</span>
                <span class="brand-subtitle">Admin Panel</span>
            </span>
        </a>
    </div>

    <nav class="sidebar-nav">
        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
        <a class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" href="index.php" <?php echo $currentPage === 'index.php' ? 'aria-current="page"' : ''; ?>>
            <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link <?php echo in_array($currentPage, ['categories.php', 'update_form_category.php'], true) ? 'active' : ''; ?>" href="categories.php">
            <span class="nav-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
            <span class="nav-text">Categories</span>
        </a>
        <a class="nav-link <?php echo in_array($currentPage, ['products.php', 'update_form_product.php'], true) ? 'active' : ''; ?>" href="products.php">
            <span class="nav-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
            <span class="nav-text">Products</span>
        </a>
        <a class="nav-link <?php echo in_array($currentPage, ['clients.php', 'update_form_client.php'], true) ? 'active' : ''; ?>" href="clients.php">
            <span class="nav-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
            <span class="nav-text">Clients</span>
        </a>
        <a class="nav-link <?php echo in_array($currentPage, ['users.php', 'update_form_user.php', 'update_password.php'], true) ? 'active' : ''; ?>" href="users.php">
            <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
            <span class="nav-text">Users</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">Store workspace online</span>
    </div>
</aside>
