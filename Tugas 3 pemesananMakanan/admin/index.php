<?php
$base_url = 'https://id.000webhost.com/';
$page = @$_GET['page'];
ob_start();
session_start();
if (empty($_SESSION['username_admin']) and empty($_SESSION['password_admin'])) {
    echo "<script>document.location.href='login'</script>";
}
?>
<?php
include 'view/komponen/head.php';
include 'view/komponen/sidebar.php';
?>
<div class="col-lg-10 mt-4">
    <?php
    if (empty($page) || $page == 'dashboard') {
        include 'view/page/dashboard.php';
    } else {
        include 'view/page/' . $page . '.php';
    }
    ?>
</div>
<?php include 'view/komponen/footer.php' ?>