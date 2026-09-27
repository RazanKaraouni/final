<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
window.adminHMDUser = {
    name: <?php echo json_encode($_SESSION['usersname'] ?? 'Admin'); ?>,
    workspace: "MugStore Admin",
    avatar: "assets/images/avatar/avatar.jpg"
};
</script>
<script src="assets/js/main.js"></script>
