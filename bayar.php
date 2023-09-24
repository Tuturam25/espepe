<?php
session_start();
include 'koneksi.php';

date_default_timezone_set('Asia/jakarta');

if (isset($_POST['cek'])) {
    $ttl = 0;
    $nisn = $_POST['nisn'];
    $idpetugas = $_POST['id_petugas'];
    if (isset($_POST['bulan'])) {
        echo "<form action='' method='post'>
        <span>bulan dibayar</span><br>
        ";
        foreach ($_POST['bulan'] as $nilai) {
            echo "$nilai |
                <input type='hidden' name='bayar[]' value='$nilai'>
            ";
            $ttl++;
        }
    }
    echo '<br>';
    $tahun = $spp->siswa->findOne(['nisn' => intval($_POST['nisn'])])['tahunajar'];
    $nom = $spp->spp->findOne(['tahun' => $tahun])['nominal'];
    $tal = $nom * $ttl;
    echo 'harga spp: ' . number_format($nom, 2, ',', '.') . ' x ' . $ttl . ' jumlah bulan dibayar' . "<br>";
    echo 'total yang harus dibayar: Rp. ' . $total = number_format($nom * $ttl, 2, ',', '.');
    echo "
    <br>
    <input type='hidden' name='nisn' value='$nisn'>
    <input type='hidden' name='id_petugas' value='$idpetugas'>
    <input type='hidden' name='total' value='$tal'>
    <button name='konfir'>konfirmasi</button>
    </form>";
}

if (isset($_POST['konfir'])) {
    // foreach ($_POST['bayar'] as $nilai) {
    //     $spp->siswa->updateOne(
    //         ['nisn' => intval($_POST['nisn'])],
    //         [
    //             '$push' =>
    //             [
    //                 'pembayaran' => $nilai
    //             ]
    //         ]
    //     );
    // }
    $id = $spp->pembayaran->countdocuments();
    if (isset($_POST['total'])) {
        $spp->pembayaran->insertOne([
            'id_pembayaran' => ++$id,
            'id_petugas' => $_POST['id_petugas'],
            'nisn' => $_POST['nisn'],
            'tgl_bayar' => date('d m Y'),
            'total_bayar' => intval($_POST['total']),
            'bayaran' => $_POST['bayar']
        ]);
    }
    // if ($tugas = $spp->pembayaran->findOne(['id_pembayaran' => $id])['id_pembayaran']) {
    //     foreach ($_POST['bayar'] as $nilai) {
    //         $spp->pembayaran->updateOne(
    //             ['id_pembayaran' => $tugas],
    //             [
    //                 '$push' =>
    //                 [
    //                     'pembayaran' => $nilai
    //                 ]
    //             ]
    //         );
    //     }
    // }
    header('location: admin.php');
}
?>
<?php if (isset($_POST['cari']) and $sis = $spp->siswa->findOne(['nisn' => intval($_POST['nisn'])])) { ?>
    <a href="admin.php">balik</a>
    <h1>data siswa</h1>
    <p>nama: <?= $sis['nama'] ?></p>
    <p>nisn: <?= $sis['nisn'] ?></p>
    <p>kelas: <?= $spp->kelas->findOne(['id_kelas' => $sis['id_kelas']])['kompetensi'] ?></p>
    <p>alamat: <?= $sis['alamat'] ?></p>
    <p>tahun ajaran: <?= $sis['tahunajar'] ?></p>
    <br>
    <form action="" method="post">
        <input type="hidden" value="<?= $_POST['nisn'] ?>" name="nisn">
        <input type="hidden" value="<?= $_POST['id_petugas'] ?>" name="id_petugas">
        <?php
        $awalthn = intval(substr($sis['tahunajar'], 3, 4));
        $akhirthn = intval(substr($sis['tahunajar'], 11, 4));
        $awalbln = intval(substr($sis['tahunajar'], 0, 2));
        $akhirbln = intval(substr($sis['tahunajar'], 9, 2));

        for ($awalthn; $awalthn <= $akhirthn; $awalthn++) {
            for ($awalbln; $awalbln <= 12;) {
                $bln = date($awalbln);
                $thn = date($awalthn);
                if ($bln == 1) {
                    $bln = 'Januari';
                } else if ($bln == 2) {
                    $bln = 'Februari';
                } else if ($bln == 3) {
                    $bln = 'Maret';
                } else if ($bln == 4) {
                    $bln = 'April';
                } else if ($bln == 5) {
                    $bln = 'Mei';
                } else if ($bln == 6) {
                    $bln = 'Juni';
                } else if ($bln == 7) {
                    $bln = 'Juli';
                } else if ($bln == 8) {
                    $bln = 'Agustus';
                } else if ($bln == 9) {
                    $bln = 'September';
                } else if ($bln == 10) {
                    $bln = 'Oktober';
                } else if ($bln == 11) {
                    $bln = 'November';
                } else if ($bln == 12) {
                    $bln = 'Desember';
                }
                $dah = '';
                if ($bay = $spp->pembayaran->find(['nisn' => $_POST['nisn']])) {
                    foreach ($bay as $ror) {
                        foreach ($ror['bayaran'] as $rawr) {
                            if ($bln . ' ' . $thn == $rawr) {
                                $dah = 'checked disabled';
                            }
                        }
                    }
                }
                echo "
                <input type='checkbox' $dah name='bulan[]' value='$bln $thn'>
                <label>bulan $bln</label>
                <label>tahun $thn</label>
                ";
                if ($awalbln == $akhirbln and $awalthn == $akhirthn) {
                    break;
                }
                $awalbln++;
            }
            $awalbln = 1;
        } ?>
        <button name="cek">cek</button>
    </form>
<?php } else if (!$spp->siswa->findOne(['nisn' => intval($_POST['nisn'])])) { ?>
    <script>
        alert('data tidak ditemukan');
        window.location.href = 'admin.php';
    </script>
<?php } ?>