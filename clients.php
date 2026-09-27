<?php
require('common/auth.php');
require('conn.php');
$sql = "select * from clients";
$result = $conn->query($sql);
$clients = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$pageTitle = "Clients | MugStore";
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
                            <span class="page-icon"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Contacts</p>
                                <h1 class="h3 mb-1">Clients</h1>
                                <p class="text-muted mb-0">Keep customer names, emails, and phone numbers in one list.</p>
                            </div>
                        </div>
                        <div class="heading-actions">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addClientModal">
                                <i class="bi bi-plus-lg" aria-hidden="true"></i> Add Client
                            </button>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Client List</span></h2>
                                <p class="text-muted mb-0"><?php echo count($clients); ?> client<?php echo count($clients) === 1 ? '' : 's'; ?> saved.</p>
                            </div>
                            <input class="form-control form-control-sm table-search" type="search" placeholder="Search clients" data-table-search="clientsTable" aria-label="Search clients">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" id="clientsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($clients)) { ?>
                                        <tr>
                                            <td colspan="4" class="text-muted">No clients yet.</td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($clients as $client) { ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($client['clients_name']) ?></td>
                                            <td><?php echo htmlspecialchars($client['email']) ?></td>
                                            <td><?php echo htmlspecialchars($client['phone']) ?></td>
                                            <td class="text-end">
                                                <a href="update_form_client.php?id=<?php echo $client['clients_id'] ?>" class="btn btn-light btn-sm">Edit</a>
                                                <a href="delete_client.php?id=<?php echo $client['clients_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this client?')">Delete</a>
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

    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_client.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control" name="clients_name" placeholder="Enter client name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require("common/script.php") ?>
</body>
</html>
