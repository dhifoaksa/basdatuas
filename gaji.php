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
    <h1 class="h3 mb-2 text-gray-800">Data Gaji</h1>
    <p class="mb-4">Berikut ini adalah data Penggajian karyawan yang telah terdata</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Gaji</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Bonus</th>
                            <th>Gaji</th>
                            <th>Total Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cek_karyawan = $fo->query("SELECT * FROM penggajian INNER JOIN karyawan ON penggajian.id_karyawan=karyawan.id ORDER BY karyawan.id DESC");
                        while ($row = $cek_karyawan->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['tanggal']; ?></td>
                                <td><?= $row['keterangan']; ?></td>
                                <td>Rp <?= number_format($row['bonus']); ?></td>
                                <td>Rp <?= number_format($row['gaji']); ?></td>
                                <td>Rp <?= number_format($row['total_gaji']); ?></td>
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

<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="jumlahkursi">Nik</label>
                        <input type="number" class="form-control" name="nik">
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Alamat</label>
                        <textarea class="form-control" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Jenis Kelamin</label>
                        <select class="form-control" name='j_kelamin'>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="pria">Pria</option>
                            <option value="wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Tanggal lahir</label>
                        <input type="date" class="form-control" id="t_lahir" name="t_lahir">
                    </div>
                    <div class="form-group">
                        <label for="jumlahkursi">Jabatan</label>
                        <select class="form-control" name='jabatan'>
                            <option value="">Pilih Jabatan</option>
                            <option value="Costumer Service">Costumer Service</option>
                            <option value="Finance">Finance</option>
                            <option value="Developer">Developer</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name='tambahdata' class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

require _DIR_('templates/footer.php');
