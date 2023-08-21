<?php
if (empty($_GET['act'])) {
    tampil();
} elseif ($_GET['act'] == 'edit') {
    edit();
} elseif ($_GET['act'] == 'hapus') {
    hapus();
}
?>
<?php function tampil()
{
?>
    <div class="row mb-1">
        <!-- <h1>Produk</h1> -->
    </div>
    <div class="row">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Transaksi</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th colspan="2">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'config.php';
                        $query = mysqli_query($conn, "SELECT * FROM history");
                        if (mysqli_num_rows($query) == 0) {
                            echo "<b>data tidak ada<b>";
                        } else {
                            $no = 1;
                            while ($fetch = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $fetch['total'] ?></td>
                                    <td>
                                        <?= $fetch['status'] ?>
                                    </td>
                                    <td>
                                        <a href="?page=history&act=edit&id=<?php echo $fetch['id']; ?>"><i class="fas 
fa-user-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="?page=history&act=hapus&id=<?php echo $fetch['id']; ?>"><i style="color: red;" class="fas fa-trash"></i></a>
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
                <label for="#" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" placeholder="Input nama produk" name="nama">
            </div>
            <div class="mb-3">
                <label for="#" class="form-label">Jumlah Stok</label>
                <input type="number" class="form-control" placeholder="123" name="stok">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" rows="3" placeholder="Produk yang hebat" name="deskripsi"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="formFile" name="file">
            </div>
            <button class="btn btn-primary" type="submit" name="tambah">
                <i class="fas fa-plus"></i>
                <!--Tambah Produk-->
            </button>
        </form>
    </div>
    <?php
    $base_url = 'http://localhost/admin/';
    // echo $base_url;
    if (isset($_POST['tambah'])) {
        $gambar = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $path = "asset/image/" . $gambar;
        move_uploaded_file($tmp, $path);
        include 'config.php';
        $querytambah = mysqli_query($conn, "INSERT INTO produk 
(nama_produk,deskripsi,gambar,stok) VALUES ('$nama','$deskripsi','$gambar','$stok')");
        if ($querytambah) {
            // echo "<script>document.location.href='?page=history'</script>";
        } else {
            echo "<script>alert('Produk gagal tersimpan')</script>";
            // echo "<script>document.location.href='?page=history'</script>";
        }
    }
    ?>
<?php }
?>
<?php function edit()
{
    include "config.php";
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT * FROM history WHERE id = '$id'");
    $res = mysqli_fetch_array($query);
?>
    <div>
        <h1>Edit History</h1>
        <div class="row col-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="#" class="form-label">Total</label>
                    <input type="text" class="form-control" placeholder="Input nama produk" name="total" value="<?= $res['total']; ?>">
                </div>
                <div class=" mb-3">
                    <label for="#" class="form-label">Status</label>
                    <input type="text" class="form-control" placeholder="123" name="status" value="<?=
                                                                                                    $res['status'] ?>">
                </div>
                <button class="btn btn-primary" type="submit" name="edit">
                    Edit History
                </button>
            </form>
            <?php
            if (isset($_POST['edit'])) {
                $total = $_POST['total'];
                $status = $_POST['status'];
                $queryupdate = mysqli_query($conn, "UPDATE history SET
total = '$total',
status = '$status'
WHERE id = '$id'");
                if ($queryupdate) {
                    echo "update berhasil";
                    echo "<script>document.location.href='?page=history'</script>";
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
    $queryhapus = mysqli_query($conn, "DELETE FROM history WHERE id = '$id'");
    if ($queryhapus) {
        echo "<script>document.location.href='?page=history'</script>";
    } else {
        echo "hapus gagal";
    }
?>
<?php }
?>