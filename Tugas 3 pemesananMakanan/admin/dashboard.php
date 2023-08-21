<?php
include 'config.php';
$history = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM history"));
$konsumen = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));
$paket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tabel_paket"));
?>
<div class="row mb-1">
    <h1>Dashboard</h1>
</div>
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-dark">
            <div class="inner">
                <h3><?= $history ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $paket ?></h3>
                <p>Jumlah Paket Kue</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $konsumen ?></h3>
                <p>Jumlah Konsumen</p>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <!-- /.card-header -->
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
    <!-- /.card-body -->
</div>