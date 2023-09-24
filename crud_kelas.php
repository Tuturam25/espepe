<?php
include 'koneksi.php';

$query = $spp->kelas->find();

if (isset($_POST['batal'])) {
    header('refresh: 0');
}
if (isset($_POST['tambahp'])) {
    $id = $spp->kelas->countdocuments();
    $spp->kelas->insertOne([
        'id_kelas' => ++$id,
        'nama_kelas' => $_POST['nama_kelas'],
        'kompetensi' => $_POST['kompetensi']
    ]);
    header('refresh: 0');
}

if (isset($_POST['hapus'])) {
    $spp->kelas->deleteOne(['id_kelas' => intval($_POST['id'])]);
    header('refresh: 0');
}


?>

<form action="" method="post">
    <button name="tambah">tambah</button>
    <button name="batal">batal</button>
</form>

<a href="admin.php">kembali</a>

<?php if (isset($_POST['tambah'])) { ?>
    <form action="" method="post">
        <label for="">nama kelas</label>
        <input type="text" name="nama_kelas">
        <label for="">kompetensi keahlian</label>
        <input type="text" name="kompetensi">
        <button name="tambahp">tambah</button>
    </form>
<?php } ?>

<table>
    <tr>
        <th>No</th>
        <th>Nama kelas</th>
        <th>Kompetensi keahlian</th>
        <th>aksi</th>
    </tr>
    <?php $no = 1;
    foreach ($query as $row) :  ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama_kelas'] ?></td>
            <td><?= $row['kompetensi'] ?></td>
            <td>
                <form action="ubah.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_kelas'] ?>">
                    <input type="hidden" name="nama_kelas" value="<?= $row['nama_kelas'] ?>">
                    <input type="hidden" name="kompetensi" value="<?= $row['kompetensi'] ?>">
                    <button name="ubahkelas">ubah</button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_kelas'] ?>">
                    <button name="hapus">hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>