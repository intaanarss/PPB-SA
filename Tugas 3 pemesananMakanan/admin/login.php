<?php
include 'head.php';
?>
<?php
if (empty($_GET['act'])) {
    tampil();
} else if ($_GET['act'] == 'login') {
    login();
} elseif ($_GET['act'] == 'logout') {
    logout();
}
function tampil()
{
?>
    <section class="vh-100 d-flex ">
        <div class="container-fluid h-custom justify-content-center">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://id.000webhost.com/bg_detail.jpeg" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="?act=login" method="POST">
                        <div class="divider d-flex align-items-center my-4">
                            97
                            <p class="text-center fw-bold mx-3 mb-0">
                                <!--Login Admin-->
                            </p>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="username" class="form-control form-control-lg" placeholder="Enter Username" />
                            <label class="form-label" for="form3Example3">Username</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" name="password" class="form-control formcontrol-lg" placeholder="Enter password" />
                            <label class="form-label">Password</label>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <a href="#!" class="text-body">Forgot password?</a>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php }
function login()
{
    include "config.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($conn, "SELECT*from admin WHERE username='$username' 
AND password='$password'");
    $ketemu = mysqli_num_rows($login);
    $data = mysqli_fetch_array($login);
    if ($ketemu > 0) {
        session_start();
        $_SESSION['username_admin'] = $data['username'];
        $_SESSION['password_admin'] = $data['password'];
        echo "<script>alert('Selamat Datang 
$data[username]');document.location.href='index.php'</script>";
    } else {
        echo "<script>alert('Kata Sandi Tidak Sama!');document.location.href='login'</script>";
    }
}
function logout()
{
    session_start();
    unset($_SESSION['username_admin']);
    unset($_SESSION['password_admin']);
    session_unset();
    session_destroy();
    header("location:index.php");
}
?>
<?php
include 'footer.php';
?>