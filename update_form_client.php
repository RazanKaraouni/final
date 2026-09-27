<?php
require('common/auth.php');
include("conn.php");

if (!isset($_GET['id'])) {
    header("Location: clients.php");
    exit;
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM clients WHERE clients_id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    die("Client not found");
}

$client = $result->fetch_assoc();
$pageTitle = "Edit Client | MugStore";
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
                                <p class="eyebrow mb-1">Contacts</p>
                                <h1 class="h3 mb-1">Edit Client</h1>
                                <p class="text-muted mb-0">Update this client's contact details.</p>
                            </div>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <form action="update_client.php" method="POST" class="col-12 col-lg-6">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($client['clients_id']); ?>">
                            <div class="mb-3">
                                <label class="form-label">Client Name</label>
                                <input type="text" class="form-control" name="clients_name" value="<?php echo htmlspecialchars($client['clients_name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($client['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($client['phone']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="clients.php" class="btn btn-outline-secondary">Cancel</a>
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
