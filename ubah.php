<?php

include 'koneksi.php';

if (isset($_POST['petugasubah'])) {
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $level = $_POST['level'];
    $spp->petugas->updateOne(
        ['id_petugas' => intval($_POST['id'])],
        [
            '$set' => [
                'username' => $username,
                'password' => $pass,
                'nama_petugas' => $nama,
                'level' => $level
            ]
        ]
    );
    header('location: crud_petugas.php');
}

if (isset($_POST['sppubah'])) {
    if ($_POST['tahun'] == '' and $_POST['tahunn'] == '') {
        $spp->spp->updateOne(
            ['id_spp' => intval($_POST['id'])],
            [
                '$set' => [
                    'tahun' => $_POST['tahunlama'] . '/' . $_POST['tahunlamaa'],
                    'nominal' => intval($_POST['nominal'])
                ]
            ]
        );
        header('location: crud_spp.php');
    } else {
        $spp->spp->updateOne(
            ['id_spp' => intval($_POST['id'])],
            [
                '$set' => [
                    'tahun' => $_POST['tahun'] . '/' . $_POST['tahunn'],
                    'nominal' => intval($_POST['nominal'])
                ]
            ]
        );
        header('location: crud_spp.php');
    }
}

if (isset($_POST['kelasubah'])) {
    $spp->kelas->updateOne(
        ['id_kelas' => intval($_POST['id'])],
        [
            '$set' => [
                'nama_kelas' => $_POST['nama_kelas'],
                'kompetensi' => $_POST['kompetensi']
            ]
        ]
    );
    header('location: crud_spp.php');
}

if (isset($_POST['siswaubah'])) {
    $kelas = $spp->kelas->findOne(['kompetensi' => $_POST['kelas']])['id_kelas'];
    $spp->siswa->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($_POST['_id'])],
        [
            '$set' => [
                'nisn' => intval($_POST['nisn']),
                'nis' => intval($_POST['nis']),
                'nama' => $_POST['nama'],
                'id_kelas' => intval($kelas),
                'alamat' => $_POST['alamat'],
                'no_telp' => intval($_POST['no_telp']),
                'password' => $_POST['password'],
                'tahunajar' => $_POST['tahunajar']
            ]
        ]
    );
    header('location: crud_siswa.php');
}

?>

<?php if (isset($_POST['ubahpetugas'])) { ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
        <label for="">username</label>
        <input type="text" name="user" value="<?= $_POST['username'] ?>">
        <label for="">password</label>
        <input type="text" name="pass" value="<?= $_POST['password'] ?>">
        <label for="">Nama petugas</label>
        <input type="text" name="nama" value="<?= $_POST['nama'] ?>">
        <label for="">level</label>
        <select name="level" id="">
            <option <?php if ($_POST['level'] == 'admin') {
                        echo 'selected';
                    } ?> value="admin">admin</option>
            <option <?php if ($_POST['level'] == 'petugas') {
                        echo 'selected';
                    } ?> value="petugas">petugas</option>
        </select>
        <button name="petugasubah">ubah</button>
    </form>
<?php } ?>

<?php if (isset($_POST['ubahkelas'])) { ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
        <label for="">nama kelas</label>
        <input type="text" name="nama_kelas" value="<?= $_POST['nama_kelas'] ?>">
        <label for="">kompetensi</label>
        <input type="text" name="kompetensi" value="<?= $_POST['kompetensi'] ?>">
        <button name="kelasubah">ubah</button>
    </form>
<?php } ?>

<?php if (isset($_POST['ubahspp'])) { ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
        <input type="hidden" name="tahunlama" value="<?= $_POST['tahun'] ?>">
        <input type="hidden" name="tahunlamaa" value="<?= $_POST['tahunn'] ?>">
        <label for="">Tahun ajaran</label>
        <input type="month" name="tahun">
        <span>sampai</span>
        <input type="month" name="tahunn">
        <label for="">Nominal</label>
        <input type="number" name="nominal" value="<?= $_POST['nominal'] ?>">
        <button name="sppubah">ubah</button>
    </form>
<?php } ?>

<?php if (isset($_POST['ubahsiswa'])) { ?>
    <form action="" method="post">
        <input type="hidden" name="_id" value="<?= $_POST['_id'] ?>">
        <label for="">nisn</label>
        <input type="text" name="nisn" value="<?= $_POST['nisn'] ?>">
        <label for="">password</label>
        <input type="text" name="password" value="<?= $_POST['password'] ?>">
        <label for="">nis</label>
        <input type="text" name="nis" value="<?= $_POST['nis'] ?>">
        <label for="">nama</label>
        <input type="text" name="nama" value="<?= $_POST['nama'] ?>">
        <label for="">kelas</label>
        <select name="kelas" id="">
            <option value="">pilih kelas</option>
            <?php foreach ($spp->kelas->find() as $row) : ?>
                <option <?php if ($_POST['id_kelas'] == $row['id_kelas']) echo 'selected' ?> value="<?= $row['kompetensi'] ?>"><?= $row['kompetensi'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="">tahun ajaran</label>
        <select name="tahunajar" id="">
            <option value="">pilih tahun</option>
            <?php foreach ($spp->spp->find() as $row) : ?>
                <option <?php if ($_POST['tahunajar'] == $row['tahun']) echo 'selected' ?> value="<?= $row['tahun'] ?>"><?= $row['tahun'] ?></option>
            <?php endforeach ?>
        </select>
        <label for="">alamat</label>
        <input type="text" name="alamat" value="<?= $_POST['alamat'] ?>">
        <label for="">no telpon</label>
        <input type="text" name="no_telp" value="<?= $_POST['no_telp'] ?>">
        <button name="siswaubah">ubah</button>
    </form>
<?php } ?>