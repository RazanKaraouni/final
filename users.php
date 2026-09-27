<?php
require('common/auth.php');
require('conn.php');
$sql = "select * from users";
$result = $conn->query($sql);
$users = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
$pageTitle = "Users | MugStore";
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
                            <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                            <div>
                                <p class="eyebrow mb-1">Management</p>
                                <h1 class="h3 mb-1">Users</h1>
                                <p class="text-muted mb-0">Review accounts, roles, and passwords for the admin team.</p>
                            </div>
                        </div>
                        <div class="heading-actions">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="bi bi-person-plus" aria-hidden="true"></i> Add User
                            </button>
                        </div>
                    </div>

                    <section class="panel mt-3">
                        <div class="panel-header">
                            <div>
                                <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>User List</span></h2>
                                <p class="text-muted mb-0"><?php echo count($users); ?> account<?php echo count($users) === 1 ? '' : 's'; ?> can sign in.</p>
                            </div>
                            <input class="form-control form-control-sm table-search" type="search" placeholder="Search users" data-table-search="usersTable" aria-label="Search users">
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" id="usersTable">
                                <thead>
                                    <tr>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col" class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($users)) { ?>
                                        <tr>
                                            <td colspan="3" class="text-muted">No users found.</td>
                                        </tr>
                                    <?php } ?>
                                    <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img class="avatar-img avatar-sm" src="assets/images/avatar/avatar.jpg" alt="<?php echo htmlspecialchars($user['usersname']) ?>">
                                                    <p class="fw-semibold mb-0"><?php echo htmlspecialchars($user['usersname']) ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge <?php echo $user['role'] === 'admin' ? 'text-bg-primary' : 'text-bg-secondary'; ?>">
                                                    <?php echo htmlspecialchars($user['role']) ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="update_form_user.php?id=<?php echo $user['users_id'] ?>" class="btn btn-light btn-sm" title="Edit">Edit</a>
                                                <a href="update_password.php?id=<?php echo $user['users_id']; ?>" class="btn btn-outline-warning btn-sm" title="Change Password">
                                                    <i class="bi bi-key"></i>
                                                </a>
                                                <a href="delete_user.php?id=<?php echo $user['users_id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete">Delete</a>
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

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_users.php" method="POST">
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="username" placeholder="Enter user name" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" name="password" placeholder="Enter password" required autocomplete="new-password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require("common/script.php") ?>
</body>
</html>
