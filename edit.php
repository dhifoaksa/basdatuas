<?php
require 'config.php';
require _DIR_('templates/header.php');
require _DIR_('templates/sidebar.php');
require _DIR_('templates/topbar.php');
//Update Data Karyawan
if (isset($_POST['updatedata_karyawan'])) {
    $nama = filter($_POST['nama']);
    $nik = filter($_POST['nik']);
    $alamat = filter($_POST['alamat']);
    $j_kelamin = filter($_POST['j_kelamin']);
    $t_lahir = filter($_POST['t_lahir']);
    $jabatan = filter($_POST['jabatan']);
    if (!$nama || !$nik || !$alamat || !$j_kelamin || !$t_lahir || !$jabatan) {
        notif(false, "Harap mengisi semua data");
    } else {
        if ($fo->query("UPDATE karyawan SET nik='$nik',nama='$nama',j_kelamin='$j_kelamin',tanggal_lahir='$t_lahir',jabatan='$jabatan',alamat='$alamat'")) {
            notif(true, "Data baru berhasil diUpdate");
        } else {
            notif(false, "Terjadi kesalahan sistem");
        }
    }
}


if ($_GET['token']) {
    $token = filter(base64_decode($_GET['token']));
    $id = explode("|", $token)[1];
    $type = explode("|", $token)[0];
    if ($fo->query("SELECT * FROM $type WHERE id='$id'")->num_rows < 1) {
        notif(false, "Token Tidak Valid");
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if ($type == "karyawan") {
        $cek_data = $fo->query("SELECT * FROM karyawan WHERE id='$id'")->fetch_assoc();
    ?>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Karyawan</h6>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nik</label>
                        <input type="number" class="form-control" value="<?= $cek_data['nik']; ?>" name="nik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="<?= $cek_data['nama']; ?>" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="<?= $cek_data['j_kelamin']; ?>" name="j_kelamin">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" class="form-control" value="<?= $cek_data['jabatan']; ?>" name="jabatan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat"><?= $cek_data['alamat']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" value="<?= $cek_data['tanggal_lahir']; ?>" name="t_lahir">
                    </div>
                    <div class="text-right">
                        <a href="<?= $httpReferer; ?>" class="btn btn-danger" data-dismiss="modal">Kembali</a>
                        <button type="submit" name='updatedata_karyawan' class="btn btn-primary">Update Data</button>
                </form>
            </div>
            </form>
        </div>
</div>
<?php
    }
?>
</div>
<!-- /.container-fluid -->

<?php

require _DIR_('templates/footer.php');
