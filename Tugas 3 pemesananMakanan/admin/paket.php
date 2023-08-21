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
                <h5 class="card-title">Pilihan Paket</h5>
                <a class="btn btn-primary" href="?page=paket&act=tambah" role="button">
                    <i class="fas fa-plus"></i>
                    <!--Tambah Paket-->
                </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama</th>
                            <th>Gambar Paket</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th colspan="2">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'config/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM tabel_paket");
                        if (mysqli_num_rows($query) == 0) {
                            echo "<b>data tidak ada<b>";
                        } else {
                            $no = 1;
                            while ($fetch = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $fetch['nama_paket'] ?></td>
                                    <td><img width="120px" height="120px" src="<?=
                                                                                $fetch['gambar_paket'] ?>" alt=""></td>
                                    <td>Rp. <?= number_format($fetch['harga_paket']) ?></td>
                                    <td><?= $fetch['deskripsi'] ?></td>
                                    101
                                    <td>
                                        <a href="?page=paket&act=edit&kode_paket=<?php echo
                                                                                    $fetch['kode_paket']; ?>"><i class="fas fa-user-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="?page=paket&act=hapus&kode_paket=<?php echo
                                                                                    $fetch['kode_paket']; ?>"><i style="color: red;" class="fas fa-trash"></i></a>
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
    <h1>Tambah Paket Wisata</h1>
    <div class="row col-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="#" class="form-label">Nama Paket Wisata</label>
                <input type="text" class="form-control" placeholder="Nama Paket" name="nama_paket">
            </div>
            <div class="mb-3">
                <label for="#" class="form-label">Harga Paket</label>
                <input type="number" class="form-control" placeholder="123" name="harga_paket">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" rows="3" name="deskripsi"></textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi Lengkap</label>
                <textarea class="form-control" rows="3" name="deskripsi_lengkap"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <input class="form-control" type="text" placeholder="http://link" name="file">
            </div>
            <button class="btn btn-primary" type="submit" name="tambah">
                <i class="fas fa-plus"></i>
                <!--Tambah Paket-->
            </button>
        </form>
    </div>
    <?php
    $base_url = 'http://localhost/admin/';
    // echo $base_url;
    if (isset($_POST['tambah'])) {
        $gambar = $_POST['file'];
        $nama = $_POST['nama_paket'];
        $deskripsi = $_POST['deskripsi'];
        $deskripsi_lengkap = $_POST['deskripsi_lengkap'];
        $harga = $_POST['harga_paket'];
        include 'config/koneksi.php';
        $querytambah = mysqli_query($conn, "INSERT INTO tabel_paket
(nama_paket,harga_paket,deskripsi,deskripsi_lengkap,gambar_paket) VALUES 
('$nama','$harga','$deskripsi','$deskripsi_lengkap','$gambar')");
        if ($querytambah) {
            echo "<script>document.location.href='?page=paket'</script>";
        } else {
            echo "<script>alert('Produk gagal tersimpan')</script>";
            // echo "<script>document.location.href='?page=paket'</script>";
        }
    }
    ?>
<?php }
?>
<?php function edit()
{
    include "config/koneksi.php";
    $kode_paket = $_GET['kode_paket'];
    $query = mysqli_query($conn, "SELECT * FROM tabel_paket WHERE kode_paket = 
'$kode_paket'");
    $res = mysqli_fetch_array($query);
?>
    <div>
        <h1>Edit Paket</h1>
        <div class="row col-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="#" class="form-label">Nama Paket Wisata</label>
                    <input type="text" class="form-control" placeholder="Nama Paket" name="nama_paket" value="<?= $res['nama_paket'] ?>">
                </div>
                <div class="mb-3">
                    <label for="#" class="form-label">Harga Paket</label>
                    <input type="number" class="form-control" placeholder="123" name="harga_paket" value="<?= $res['harga_paket'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="3" name="deskripsi"><?= $res['deskripsi']
                                                                                ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Deskripsi Lengkap</label>
                    <textarea class="form-control" rows="3" name="deskripsi_lengkap"><?=
                                                                                        $res['deskripsi_lengkap'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar</label>
                    <input class="form-control" type="text" placeholder="http://link" name="file" value="<?= $res['gambar_paket'] ?>">
                </div> <button class="btn btn-primary" type="submit" name="edit">
                    <!--Edit Paket-->
                </button>
            </form>
            <?php
            if (isset($_POST['edit'])) {
                $gambar = $_POST['file'];
                $nama = $_POST['nama_paket'];
                $deskripsi = $_POST['deskripsi'];
                $deskripsi_lengkap = $_POST['deskripsi_lengkap'];
                $harga = $_POST['harga_paket'];
                $queryupdate = mysqli_query($conn, "UPDATE tabel_paket SET 
nama_paket = '$nama',
harga_paket = '$harga',
deskripsi_lengkap = '$deskripsi_lengkap',
deskripsi = '$deskripsi',
gambar_paket = '$gambar'
WHERE kode_paket = '$kode_paket'");
                if ($queryupdate) {
                    echo "update berhasil";
                    echo "<script>document.location.href='?page=paket'</script>";
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
    $kode_paket = $_GET['kode_paket'];
    $queryhapus = mysqli_query($conn, "DELETE FROM tabel_paket WHERE kode_paket = 
'$kode_paket'");
    if ($queryhapus) {
        echo "<script>document.location.href='?page=paket'</script>";
    } else {
        echo "hapus gagal";
    }
?>
<?php }
?>