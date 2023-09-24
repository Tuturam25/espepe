<?php
include 'koneksi.php';

$query = $spp->petugas->find();

if (isset($_POST['batal'])) {
    header('refresh: 0');
}
if (isset($_POST['tambahp'])) {
    $id = $spp->petugas->countdocuments();
    $spp->petugas->insertOne([
        'id_petugas' => ++$id,
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'nama_petugas' => $_POST['nama_petugas'],
        'level' => $_POST['level']
    ]);
    header('refresh: 0');
}

if (isset($_POST['hapus'])) {
    $spp->petugas->deleteOne(['id_petugas' => intval($_POST['id'])]);
    header('refresh: 0');
}


?>

<form action="" method="post">
    <button name="tambah">tambah</button>
    <button name="batal">batal</button>
</form>

<?php if (isset($_POST['tambah'])) { ?>
    <form action="" method="post">
        <label for="">username</label>
        <input type="text" name="username">
        <label for="">password</label>
        <input type="text" name="password">
        <label for="">nama petugas</label>
        <input type="text" name="nama_petugas">
        <label for="">level</label>
        <select name="level" id="">
            <option value="admin">admin</option>
            <option value="petugas">petugas</option>
        </select>
        <button name="tambahp">tambah</button>
    </form>
<?php } ?>

<a href="admin.php">kembali</a>

<table>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama petugas</th>
        <th>Level</th>
        <th>aksi</th>
    </tr>
    <?php $no = 1;
    foreach ($query as $row) :  ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['password'] ?></td>
            <td><?= $row['nama_petugas'] ?></td>
            <td><?= $row['level'] ?></td>
            <td>
                <form action="ubah.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_petugas'] ?>">
                    <input type="hidden" name="username" value="<?= $row['username'] ?>">
                    <input type="hidden" name="password" value="<?= $row['password'] ?>">
                    <input type="hidden" name="nama" value="<?= $row['nama_petugas'] ?>">
                    <input type="hidden" name="level" value="<?= $row['level'] ?>">
                    <button name="ubahpetugas">ubah</button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_petugas'] ?>">
                    <button name="hapus">hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>