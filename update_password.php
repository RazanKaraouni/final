<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id']) && !isset($_POST['id'])) {
    header("Location: users.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id'] ?? $_POST['id']);

$sql = "SELECT * FROM users WHERE users_id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("User not found");
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = $conn->real_escape_string($hashed_password);

        $sql = "UPDATE users SET password = '$hashed_password' WHERE users_id = '$id'";

        if ($conn->query($sql)) {
            echo "<script>
                    alert('Password updated successfully!');
                    window.location.href='users.php';
                  </script>";
            exit;
        }

        $error = "Error updating password!";
    }
}

$pageTitle = "Change Password | MugStore";
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
                            <span class="page-icon"><i class="bi bi-key" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Management</p>
                                <h1 class="h3 mb-1">Change Password</h1>
                                <p class="text-muted mb-0">Set a new password for <?php echo htmlspecialchars($user['usersname']); ?>.</p>
                            </div>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <form method="POST" class="col-12 col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['usersname']); ?>" disabled>
                            </div>

                            <?php if (isset($error)) { ?>
                                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                            <?php } ?>

                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['users_id']); ?>">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required minlength="6">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="confirm_password" class="form-control" required minlength="6">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-key" aria-hidden="true"></i> Update Password
                            </button>
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
