<?php
include 'koneksi.php';

$query = $spp->spp->find();

if (isset($_POST['batal'])) {
    header('refresh: 0');
}
if (isset($_POST['tambahp'])) {
    $id = $spp->spp->countdocuments();
    $spp->spp->insertOne([
        'id_spp' => ++$id,
        'tahun' => date('m-Y', strtotime($_POST['tahun'])) . '/' . date('m-Y', strtotime($_POST['tahunn'])),
        'nominal' => intval($_POST['nominal'])
    ]);
    header('refresh: 0');
    $awalthn = intval(date('Y', strtotime($_POST['tahun'])));
    $akhirthn = intval(date('Y', strtotime($_POST['tahunn'])));
    $awalbln = intval(date('m', strtotime($_POST['tahun'])));
    $akhirbln = intval(date('m', strtotime($_POST['tahunn'])));
    echo $awalthn . $akhirthn;
    echo $awalbln . $akhirbln;

    for ($awalthn; $awalthn <= $akhirthn; $awalthn++) {
        for ($awalbln; $awalbln <= 12;) {
            $bln = date($awalbln);
            $thn = date($awalthn);
            echo "
            <input type='checkbox'>
            <label>bulan $bln</label>
            <label>tahun $thn</label>
            ";
            if ($awalbln == $akhirbln and $awalthn == $akhirthn) {
                break;
            }
            $awalbln++;
        }
        $awalbln = 1;
    }
}

if (isset($_POST['hapus'])) {
    $spp->spp->deleteOne(['id_spp' => intval($_POST['id'])]);
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
        <label for="">Tahun ajaran</label>
        <input type="month" name="tahun">
        <span>sampai</span>
        <input type="month" name="tahunn">
        <label for="">Nominal</label>
        <input type="number" name="nominal">
        <button name="tambahp">tambah</button>
    </form>
<?php } ?>

<table>
    <tr>
        <th>No</th>
        <th>Tahun ajaran</th>
        <th>nominal</th>
        <th>aksi</th>
    </tr>
    <?php $no = 1;
    foreach ($query as $row) :  ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['tahun'] ?></td>
            <td><?= 'Rp.' . number_format(intval($row['nominal']), 0, ',', '.') ?></td>
            <td>
                <form action="ubah.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_spp'] ?>">
                    <input type="hidden" name="tahun" value="<?= substr($row['tahun'], 0, 7) ?>">
                    <input type="hidden" name="tahunn" value="<?= substr($row['tahun'], 8, 14) ?>">
                    <input type="hidden" name="nominal" value="<?= $row['nominal'] ?>">
                    <button name="ubahspp">ubah</button>
                </form>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_spp'] ?>">
                    <button name="hapus">hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>