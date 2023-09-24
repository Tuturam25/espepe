<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['idsiswa'])) {
    echo "
    <script>
    // Menghapus hash dari URL saat halaman dimuat
    window.addEventListener('load', function () {
    if (window.location.hash) {
      // Menggunakan metode replaceState untuk menghapus hash
      window.history.replaceState({}, document.title, window.location.pathname);
    }
    window.location.href = 'index.php';
    });
    </script>
    ";
}
if (isset($_POST['logout'])) {
    session_destroy();
    echo "
    <script>
    // Menghapus hash dari URL saat halaman dimuat
    window.addEventListener('load', function () {
    if (window.location.hash) {
      // Menggunakan metode replaceState untuk menghapus hash
      window.history.replaceState({}, document.title, window.location.pathname);
    }
    window.location.href = 'index.php';
    });
    </script>
    ";
}

$siswa = $spp->siswa->findOne(['_id' => $_SESSION['idsiswa']]);

?>

<link rel="stylesheet" href="output.css">
<!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


<div id="#" class="flex items-center justify-center h-screen target:transition-opacity target:rotate-45 target:duration-1000">
    <div class="bg-[E3141E] rounded-xl w-[90%] text-white flex-shrink-0 h-fit text-sm overflow-hidden font-semibold tracking-[1px] relative after:w-40 after:h-40 after:absolute after:right-0 after:bottom-0 after:outline after:rounded-full after:scale-150 after:outline-[#E83642] after:outline-[20px] before:w-40 before:h-40 before:absolute before:left-0 before:top-0 before:outline before:rounded-full before:scale-150 before:outline-[#E83642] before:outline-[20px] before:z-0">
        <div class="pb-0 pt-4 px-4 md:text-2xl relative z-10">
            <form action="" method="post" class="absolute right-0 top-0">
                <button name="logout" class="p-3 flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M9 12h12l-3 -3"></path>
                        <path d="M18 15l3 -3"></path>
                    </svg>
                    <span class="text-xs">Logout</span>
                </button>
            </form>
            <div class="flex flex-col gap-4">
                <h1 class="text-center mb-3">Data Siswa</h1>
                <h2>Nama : <?= $siswa['nama'] ?></h2>
                <h2>Nisn : <?= $siswa['nisn'] ?></h2>
                <h2>Kelas : <?= $spp->kelas->findOne(['id_kelas' => $siswa['id_kelas']])['kompetensi'] ?></h2>
                <h2>Alamat : <?= $siswa['alamat'] ?></h2>
                <h2>Tahun Ajaran : <?= $siswa['tahunajar'] ?></h2>
            </div>
        </div>
        <div class="flex justify-between items-center relative z-10">
            <a href="#modals" class="bg-white rounded-3xl px-2 m-5 p-1 md:w-2/5 gap-2 flex justify-between items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt bg-[E3141E] rounded-full p-[0.15rem] md:w-9 md:h-9" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2m4 -14h6m-6 4h6m-2 4h2"></path>
                </svg>
                <span class="text-black p-0 w-fit m-auto h-fit font-light text-xs tracking-wide text-center md:text-xl">Tagihan Kamu ></span>
            </a>
            <a href="history.php?page=siswa.php&nisn=<?= $siswa['nisn'] ?>" class="flex flex-col items-center gap-2 p-3 group/riw ">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist group-active/riw:text-slate-800 md:w-10 md:h-10" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                    <path d="M14 19l2 2l4 -4"></path>
                    <path d="M9 8h4"></path>
                    <path d="M9 12h2"></path>
                    <span class="font-semibold text-xs tracking-normal group-active/riw:text-slate-800 md:text-lg">Riwayat</span>
                </svg>
            </a>
        </div>
    </div>
    <div id="modals" class="group bg-white h-screen w-full transition-opacity duration-1000 absolute -z-10 target:z-10 opacity-0 target:opacity-100 overflow-x-hidden">
        <div class="bg-[E3141E] relative w-full text-white flex-shrink-0 h-2/5 md:h-56 -translate-y-full text-sm overflow-hidden font-semibold tracking-[1px] after:w-20 after:h-20 after:md:w-40 after:md:h-40 after:absolute after:right-0 after:bottom-0 after:outline after:rounded-full after:scale-150 after:outline-[#E83642] after:outline-[20px] before:w-20 before:h-20 before:md:w-40 before:md:h-40 before:absolute before:left-0 before:top-0 before:outline before:rounded-full before:scale-150 before:outline-[#E83642] before:outline-[20px] before:z-0 group-target:translate-y-0 transition duration-1000">
            <div class="w-fit group-target:translate-x-5 translate-y-5 -translate-x-full opacity-0 group-target:opacity-100 delay-500 transition duration-[1.25s] flex items-center gap-3">
                <a href="#" class="bg-white rounded-full p-2 px-3 md:p-4 md:px-5 h-fit text-black">&#9587;</a>
            </div>
            <div class="transition delay-1000 block duration-1000 translate-x-28 top-0 w-fit -translate-y-full group-target:translate-y-7 absolute md:text-3xl">SPP</div>
            <div class="opacity-0 transition-opacity absolute top-0 right-0 z-10 duration-1000 delay-1000 group-target:opacity-100 ">
                <a href="history.php?page=siswa.php&nisn=<?= $siswa['nisn'] ?>" class="flex flex-col items-center gap-1 p-3 group/riw">
                    <svg xmlns=" http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist group-active/riw:text-slate-800 md:w-10 md:h-10" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                        <path d="M14 19l2 2l4 -4"></path>
                        <path d="M9 8h4"></path>
                        <path d="M9 12h2"></path>
                        <span class="font-semibold text-xs tracking-normal group-active/riw:text-slate-800 md:text-2xl">Riwayat</span>
                    </svg>
                </a>
            </div>
        </div>


        <div class="bg-white rounded-xl translate-y-full transition duration-1000 delay-1000 w-[95%] md:w-4/5 m-auto p-8 shadow-xl h-fit group-target:-translate-y-20">
            <?php
            $sppk = number_format($spp->spp->findOne(['tahun' => $siswa['tahunajar']])['nominal'], 2, ',', '.');
            $awalthn = intval(substr($siswa['tahunajar'], 3, 4));
            $akhirthn = intval(substr($siswa['tahunajar'], 11, 4));
            $awalbln = intval(substr($siswa['tahunajar'], 0, 2));
            $akhirbln = intval(substr($siswa['tahunajar'], 9, 2));

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
                    $lel = "";
                    if ($bay = $spp->pembayaran->find(['nisn' => strval($siswa['nisn'])])) {
                        foreach ($bay as $ror) {
                            foreach ($ror['bayaran'] as $rawr) {
                                if ($bln . ' ' . $thn == $rawr) {
                                    $dah = 'checked';
                                    $lel = "
                                    <span class=' w-fit flex items-center left-24 text-xs md:text-lg py-[0.225rem] gap-1 px-[0.25rem] rounded-full bg-slate-300 text-lime-600 bottom-0'>
                                        <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-check-filled text-lime-600' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                        <path stroke='none' d='M0 0h24v24H0z' fill='none'></path>
                                        <path d='M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z' stroke-width='0' fill='currentColor'></path>
                                        </svg>
                                    Lunas</span>
                                    ";
                                }
                                // else {
                                //     $dahh = "type='checkbox'";
                                // }
                            }
                        }
                    }
                    echo "<details class='relative'>
                    <summary class='text-blue-700 m-3 relative'>
                    <span class='text-gray-500 md:text-4xl'>$bln $thn</span><input type='checkbox' disabled $dah name='bulan[]' value='$bln $thn' class='absolute right-0 bottom-0 w-5 h-5 md:w-8 md:h-8'></summary>
                    <span class='font-bold font-mono px-7 py-3 flex items-center gap-5 md:text-xl'>Rp.$sppk $lel</span>
                    </details>
                    <hr>
                ";
                    if ($lel != 'hidden') {
                        echo "<br>";
                    }
                    if ($awalbln == $akhirbln and $awalthn == $akhirthn) {
                        break;
                    }
                    $awalbln++;
                }
                $awalbln = 1;
            }

            ?>

        </div>
    </div>


</div>