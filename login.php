<?php
session_start();
include("conn.php");

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE usersname = '$username'";
    $result = $conn->query($sql);
    $user = $result ? $result->fetch_assoc() : null;

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['users_id'];
        $_SESSION['usersname'] = $user['usersname'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        exit;
    }

    $error = "Wrong username or password!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MugStore</title>
    <link rel="icon" href="assets/images/favicon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">
    <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
        <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
    </button>
    <main class="auth-page">
        <section class="auth-card">
            <a class="auth-brand" href="login.php">
                <span class="brand-icon"><i class="bi bi-cup-hot-fill" aria-hidden="true"></i></span>
                <span>
                    <strong>MugStore</strong>
                    <small>Sign in to the admin workspace.</small>
                </span>
            </a>
            <form method="POST">
                <div class="mb-4">
                    <p class="eyebrow mb-1">Secure Access</p>
                    <h1 class="h3 mb-1">Login</h1>
                    <p class="text-muted mb-0">Use your admin username and password.</p>
                </div>
                <?php if ($error !== "") { ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php } ?>
                <div class="mb-3">
                    <label class="form-label" for="username">User name</label>
                    <input class="form-control" id="username" name="username" type="text" required autocomplete="username">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" id="password" name="password" type="password" required autocomplete="current-password">
                </div>
                <button class="btn btn-primary w-100" type="submit">
                    <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Sign In
                </button>
            </form>
        </section>
    </main>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
