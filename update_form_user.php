<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);

$sql = "SELECT * FROM users WHERE users_id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("User not found");
}

$user = $result->fetch_assoc();
$pageTitle = "Edit User | MugStore";
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
                                <p class="eyebrow mb-1">Management</p>
                                <h1 class="h3 mb-1">Edit User</h1>
                                <p class="text-muted mb-0">Change the username or role. Passwords stay on their own page.</p>
                            </div>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <form action="update_user.php" method="POST" class="col-12 col-lg-6">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['users_id']); ?>">
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user['usersname']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="users.php" class="btn btn-outline-secondary">Cancel</a>
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
