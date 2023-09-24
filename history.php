<?php
session_start();
include 'koneksi.php';

if (isset($_POST['cetak'])) {
    echo "
    <script>
    window.onload = function() {
        window.print();
    }
    </script>
    ";
}

?>


<?php if (isset($_POST['page']) and $_POST['page'] == 'admin.php') { ?>
    <a href="<?= $_POST['page'] ?>">balik</a>
    <table border="1">
        <tr>
            <th>nisn</th>
            <th>tanggal bayar</th>
            <th>total bayar</th>
            <th>bulan dibayar</th>
        </tr>
        <?php foreach ($spp->pembayaran->find() as $bayar) {
            // $hasil = 0;
            // foreach ($bayar['bayaran'] as $baya) {
            //     $hasil++;
            // }
            // $bagi = intval($bayar['total_bayar']) / $hasil;     
        ?>
            <tr>
                <td><?= $bayar['nisn'] ?></td>
                <td><?= $bayar['tgl_bayar'] ?></td>
                <td><?= $bayar['total_bayar'] ?></td>
                <td><?php foreach ($bayar['bayaran'] as $byr) {
                        echo $byr . '<br>';
                    } ?>
                </td>

            </tr>
        <?php } ?>
    </table>
    <?php if ($_SESSION['level'] == 'admin') { ?>
        <form action="" method="post">
            <button name="cetak">cetak laporan</button>
        </form>
    <?php } ?>

<?php } else if (isset($_GET['page'])) { ?>
    <a href="<?= $_GET['page'] ?>">balik</a>
    <table border="1">
        <tr>
            <th>tanggal bayar</th>
            <th>total bayar</th>
            <th>bulan dibayar</th>
        </tr>
        <?php foreach ($spp->pembayaran->find(['nisn' => $_GET['nisn']]) as $bayar) {
            // $hasil = 0;
            // foreach ($bayar['bayaran'] as $baya) {
            //     $hasil++;
            // }
            // $bagi = intval($bayar['total_bayar']) / $hasil;     
        ?>
            <tr>
                <td><?= $bayar['tgl_bayar'] ?></td>
                <td><?= $bayar['total_bayar'] ?></td>
                <td><?php foreach ($bayar['bayaran'] as $byr) {
                        echo $byr . '<br>';
                    } ?>
                </td>

            </tr>
        <?php } ?>
    </table>
<?php } ?>