<?php
require 'config.php';
require _DIR_('templates/header.php');
require _DIR_('templates/sidebar.php');
require _DIR_('templates/topbar.php');
if (isset($_POST['tambahdata'])) {
    $nama = filter($_POST['nama']);
    $nik = filter($_POST['nik']);
    $alamat = filter($_POST['alamat']);
    $j_kelamin = filter($_POST['j_kelamin']);
    $t_lahir = filter($_POST['t_lahir']);
    $jabatan = filter($_POST['jabatan']);
    $t_masuk = $date;
    if (!$nama || !$nik || !$alamat || !$j_kelamin || !$t_lahir || !$jabatan || !$t_masuk) {
        notif(false, "Harap mengisi semua data");
    } else {
        if ($fo->query("INSERT INTO karyawan VALUES (NULL,'$nik','$nama','$j_kelamin','$t_masuk','$t_lahir','$jabatan','$alamat')")) {
            notif(true, "Data baru berhasil di masukan");
        } else {
            notif(false, "Terjadi kesalahan sistem");
        }
    }
}

if (isset($_GET['delet'])) {
    $id = filter($_GET['delet']);
    if ($fo->query("SELECT * FROM karyawan WHERE id='$id'")->num_rows < 1) {
        notif(false, "Data Tidak kami temukan");
    } else {
        if ($fo->query("DELETE FROM karyawan WHERE karyawan.id='$id'")) {
            notif(true, "Data Karyawan Berhasil di Delete");
        } else {
            notif(false, "Terjadi kesalahan Sistem");
        }
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Absen</h1>
    <p class="mb-4">Berikut ini adalah data Absen karyawan yang telah terdata</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Absen</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_karyawan = $fo->query("SELECT * FROM absen INNER JOIN karyawan ON absen.karyawan_id=karyawan.id ORDER BY karyawan.id DESC");
                        while ($row = $cek_karyawan->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['waktu_masuk']; ?></td>
                                <td><?= $row['waktu_keluar']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php

require _DIR_('templates/footer.php');
