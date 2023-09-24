<?php

session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header('location: index.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php');
}
$admin = $spp->petugas->findOne(['_id' => new MongoDB\BSON\ObjectId($_SESSION['id'])]);

$petugas = $spp->petugas->countdocuments();
$kelas = $spp->kelas->countdocuments();
$siswa = $spp->siswa->countdocuments();
$sppk = $spp->spp->countdocuments();

?>

<form action="" method="post">
    <h2>halo <?= $_SESSION['level'] ?>: <?= $admin['nama_petugas'] ?></h2>
    <button name="logout">logout</button>
</form>
<h3>
    <form action="history.php" method="post">
        <input type="hidden" name="page" value="admin.php">
        <button>history pembayaran</button>
    </form>
</h3>

<?php if ($_SESSION['level'] == 'admin') { ?>
    <h1>
        <a href="crud_petugas.php">Jumlah petugas: <?= $petugas ?></a>
    </h1>
    <h1>
        <a href="crud_kelas.php">Jumlah kelas: <?= $kelas ?></a>
    </h1>
    <h1>
        <a href="crud_siswa.php">Jumlah siswa: <?= $siswa ?></a>
    </h1>
    <h1>
        <a href="crud_spp.php">Jumlah spp: <?= $sppk ?></a>
    </h1>
<?php } ?>

<form action="bayar.php" method="post">
    <label for="">nisn</label>
    <input type="hidden" name="id_petugas" value="<?= $admin['id_petugas'] ?>">
    <input type="number" name="nisn">
    <button name="cari">cari</button>
</form>