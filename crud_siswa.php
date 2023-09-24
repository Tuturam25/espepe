<?php
include 'koneksi.php';

$query = $spp->siswa->find();

if (isset($_POST['batal'])) {
    header('refresh: 0');
}
if (isset($_POST['tambahp'])) {
    // $id = $spp->siswa->countdocuments();
    // echo $awalthn . "\n" . $akhirthn . "\n";
    // echo $awalbln . "\n" . $akhirbln;
    if ($_POST['kelas'] == '' or $_POST['tahunajar'] == '') {
        echo 'isi yg bener dlu semua!!!!!';
    } else {
        $kelas = $spp->kelas->findOne(['kompetensi' => $_POST['kelas']])['id_kelas'];
        $spp->siswa->insertOne([
            'nisn' => intval($_POST['nisn']),
            'nis' => intval($_POST['nis']),
            'nama' => $_POST['nama'],
            'id_kelas' => intval($kelas),
            'alamat' => $_POST['alamat'],
            'no_telp' => intval($_POST['no_telp']),
            'password' => $_POST['pass'],
            'tahunajar' => $_POST['tahunajar']
        ]);
        header('refresh: 0');
    }
}

if (isset($_POST['hapus'])) {
    $spp->siswa->deleteOne(['nisn' => intval($_POST['id'])]);
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
        <label for="">nisn</label>
        <input type="number" name="nisn">
        <label for="">password</label>
        <input type="text" name="pass">
        <label for="">nis</label>
        <input type="number" name="nis">
        <label for="">nama</label>
        <input type="text" name="nama">
        <label for="">kelas</label>
        <select name="kelas" id="">
            <option value="">pilih kelas</option>
            <?php foreach ($spp->kelas->find() as $row) : ?>
                <option value="<?= $row['kompetensi'] ?>"><?= $row['kompetensi'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="">tahun ajaran</label>
        <select name="tahunajar" id="">
            <option value="">pilih tahun</option>
            <?php foreach ($spp->spp->find() as $row) : ?>
                <option value="<?= $row['tahun'] ?>"><?= $row['tahun'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="">alamat</label>
        <input type="text" name="alamat">
        <label for="">no telpon</label>
        <input type="number" name="no_telp">
        <button name="tambahp">tambah</button>
    </form>
<?php } ?>

<table>
    <tr>
        <th>No</th>
        <th>nisn</th>
        <th>nis</th>
        <th>nama</th>
        <th>kelas</th>
        <th>alamat</th>
        <th>no telpon</th>
        <th>password</th>
        <th>tahun ajaran</th>
    </tr>
    <?php $no = 1;
    foreach ($query as $row) :  ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nisn'] ?></td>
            <td><?= $row['nis'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $spp->kelas->findOne(['id_kelas' => $row['id_kelas']])['kompetensi'] ?></td>
            <td><?= $row['alamat'] ?></td>
            <td><?= $row['no_telp'] ?></td>
            <td><?= $row['password'] ?></td>
            <td><?= $row['tahunajar'] ?></td>
            <td>
                <form action="ubah.php" method="post">
                    <input type="hidden" name="nisn" value="<?= $row['nisn'] ?>">
                    <input type="hidden" name="_id" value="<?= $row['_id'] ?>">
                    <input type="hidden" name="password" value="<?= $row['password'] ?>">
                    <input type="hidden" name="nis" value="<?= $row['nis'] ?>">
                    <input type="hidden" name="nama" value="<?= $row['nama'] ?>">
                    <input type="hidden" name="id_kelas" value="<?= $row['id_kelas'] ?>">
                    <input type="hidden" name="alamat" value="<?= $row['alamat'] ?>">
                    <input type="hidden" name="no_telp" value="<?= $row['no_telp'] ?>">
                    <input type="hidden" name="tahunajar" value="<?= $row['tahunajar'] ?>">
                    <button name="ubahsiswa">ubah</button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $row['nisn'] ?>">
                    <button name="hapus">hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>