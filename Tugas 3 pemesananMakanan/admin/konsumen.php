<?php
if (empty($_GET['act'])) {
    tampil();
} elseif ($_GET['act'] == 'tambah') {
    tambah();
} elseif ($_GET['act'] == 'edit') {
    edit();
} elseif ($_GET['act'] == 'hapus') {
    hapus();
}
?>
<?php function tampil()
{
?>
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Konsumen</h5>
                <a class="btn btn-primary" href="?page=konsumen&act=tambah" role="button">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th colspan="2" style="width: 50px;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'config/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM user");
                        if (mysqli_num_rows($query) == 0) {
                            echo "<b>data tidak ada<b>";
                        } else {
                            $no = 1;
                            while ($fetch = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $fetch['nama_lengkap'] ?></td>
                                    <td><?= $fetch['username'] ?></td>
                                    <td>
                                        <a href="?page=konsumen&act=edit&id=<?php echo $fetch['id'];
                                                                            ?>"><i class="fas fa-user-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="?page=konsumen&act=hapus&id=<?php echo $fetch['id'];
                                                                                ?>"><i style="color: red;" class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
<?php }
?>
<?php function tambah()
{
?>
    <h1>Tambah produk</h1>
    <div class="row col-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="#" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="John Doe" name="nama">
            </div>
            <div class="mb-3">
                <label for="#" class="form-label">Username</label>
                <input type="number" class="form-control" placeholder="John" name="username">
            </div>
            <div class="mb-3">
                <label for="#" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="*****" name="password">
            </div>
            <button class="btn btn-primary" type="submit" name="tambah">
                <i class="fas fa-plus"></i>
                <!--Tambah User-->
            </button>
        </form>
    </div>
    <?php
    $base_url = 'http://localhost/admin/';
    // echo $base_url;
    if (isset($_POST['tambah'])) {
        $nama = $_POST['nama_lengkap'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        include 'config/koneksi.php';
        $querytambah = mysqli_query($conn, "INSERT INTO user 
(nama_lengkap,username,password) VALUES ('$nama','$username','$password')");
        if ($querytambah) {
            echo "<script>document.location.href='?page=konsumen'</script>";
        } else {
            echo "<script>alert('Produk gagal tersimpan')</script>";
            // echo "<script>document.location.href='?page=konsumen'</script>";
        }
    }
    ?>
<?php }
?>
<?php function edit()
{
    include "config/koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
    $res = mysqli_fetch_array($query);
?>
    <div>
        <h1>Edit User</h1>
        <div class="row col-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="#" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="John Doe" name="nama" value="<?= $res['nama_lengkap'] ?>">
                </div>
                <div class="mb-3">
                    <label for="#" class="form-label">Username</label>
                    <input type="number" class="form-control" placeholder="John" name="username" value="<?= $res['username'] ?>">
                </div>
                <div class="mb-3">
                    <label for="#" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="*****" name="password" value="<?= $res['password'] ?>">
                </div>
                <button class="btn btn-primary" type="submit" name="edit">
                    <!--Edit Produk-->
                </button>
            </form>
            <?php
            if (isset($_POST['edit'])) {
                $nama = $_POST['nama'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $queryupdate = mysqli_query($conn, "UPDATE user SET
nama_lengkap = '$nama',
username = '$username',
password = '$password'
WHERE id = '$id'");
                if ($queryupdate) {
                    echo "update berhasil";
                    echo "<script>document.location.href='?page=konsumen'</script>";
                } else {
                    echo "update gagal";
                }
            } ?>
        </div>
    </div>
<?php }
?>
<?php function hapus()
{
    include "config/koneksi.php";
    $id = $_GET['id'];
    $queryhapus = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");
    if ($queryhapus) {
        echo "<script>document.location.href='?page=konsumen'</script>";
    } else {
        echo "hapus gagal";
    }
?>
<?php }
?>