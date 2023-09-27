<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisasi Data Transjakarta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- NAVIGATION BAR -->
    <nav>
        <div class="wrapper">
            <div class="logo">
                <div class="logo_name">Transjakarta</div>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="beranda.php" class="tbl-biru">Beranda</a></li>
                    <li><a href="konteks.php" class="tbl-biru">Dataset</a></li>
                    <li><a href="visual.php" class="tbl-biru">Visualisasi</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <section class="two">
            <div class="kolom2">
                <h3>Sumber Data</h3>
                <p style="text-align: justify;"><b>Jumlah Penumpang dan Pendapatan Transjakarta menurut Koridor/Rute Tahun 2019-2021 </b> merupakan publikasi dari <a href="https://jakarta.bps.go.id/indicator/17/812/1/jumlah-penumpang-dan-pendapatan-trans-jakarta-menurut-koridor-rute.html" style="color: blue;">Badan Pusat Statistik (BPS)</a> yang menyajikan tingkat perkembangan penumpang dan pendapatan sesuai dengan koridor yang telah didata. Publikasi ini menyajikan berbagai aspek Transjakarta yang datanya tersedia dan terukur. Tema ini memberikan gambaran tentang kondisi transportasi umum khususnya Transjakarta pada sebelum, selama, dan saat kondisi mengalami <b>masa pandemi COVID-19</b> yang tentunya pada saat kondisi ekonomi mulai dari mengalami penurunan hingga pemulihan. 
                </p>
            </div>
        </section>
        <div>
    <div class="wrapper">
   
   <!-- Main -->
   <section class="two">
   <div class="kolom2">
   <h3> Tampilan Dataset </h3>
   </div></div>

   
    <!-- TABEL PENDAPATAN-->
    <div class="menu">
    <p>
        <a href="pendapatan.php" class="tbl-pinky">Visualisasi</a>
        <a href="csv/Jumlah Pendapatan Transjakarta Tahun 2019-2021.xlsx" download class="tbl-down">Download</a>
    </p>
    </div></div></section>

   <p><b>Data Pendapatan (Rupiah)</b></p>
    <div class="charts3">
    <div class="charts-card3">
    <div class="charts-table3">

    <table border='1' width='200%'>
    <tr>
        <th>No</th>
        <th>Koridor</th>
        <th width='30%'>Trayek</th>
        <th>Jenis</th>
        <th width='15%'>2019</th>
        <th width='15%'>2020</th>
        <th width='15%'>2021</th>
    </tr>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "transjakarta";

    // Create connection
    $koneksi = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }
    
    $no = 1;
    $ambildata = mysqli_query($koneksi, "SELECT * FROM pendapatan");
    while ($tampil = mysqli_fetch_array($ambildata)) {

        echo "
        <tr>
            <td>$no</td>
            <td>$tampil[Kode]</td>
            <td>";
        
        $trayekList = explode("\n", $tampil['Trayek']); // Memisahkan setiap jalur dengan baris baru
        foreach ($trayekList as $trayek) {
            echo "$trayek<br>";
        }
        
        echo "</td>
            <td>$tampil[Jenis]</td>
            <td>Rp " . number_format($tampil['year_2019']) . "</td>
            <td>Rp " . number_format($tampil['year_2020']) . "</td>
            <td>Rp " . number_format($tampil['year_2021']) . "</td>
        </tr>";
        
        $no++;
    }

    ?>
    </table>
    </div>
    </div>
    </div>

    <!-- TABEL PENUMPANG -->
    <div class="menu">
    <p>
        <a href="penumpang.php" class="tbl-pinky">Visualisasi</a>
        <a href="csv/Jumlah Penumpang Transjakarta Tahun 2019-2021.xlsx" download class="tbl-down">Download</a>
    </p>
    </div>

   <p><b>Data Penumpang (Rupiah)</b></p>
    <div class="charts3">
    <div class="charts-card3">
    <div class="charts-table3">

    <table border='1'width='70%'>
    <tr>
        <th>No</th>
        <th>Koridor</th>
        <th width='30%'>Trayek</th>
        <th>Jenis</th>
        <th width='15%'>2019</th>
        <th width='15%'>2020</th>
        <th width='15%'>2021</th>
    </tr>
    
    <?php
    include "koneksi.php";
    
    $no = 1;
    $ambildata = mysqli_query($koneksi, "SELECT * FROM penumpang");
    while ($tampil = mysqli_fetch_array($ambildata)) {
        
        echo "
        <tr>
            <td>$no</td>
            <td>$tampil[kode]</td>
            <td>";
        
        $trayekList = explode("\n", $tampil['trayek']); // Memisahkan setiap jalur dengan baris baru
        foreach ($trayekList as $trayek) {
            echo "$trayek<br>";
        }
        
        echo "</td>
            <td>$tampil[jenis]</td>
            <td> " . number_format($tampil['tahun_2019']) . "</td>
            <td> " . number_format($tampil['tahun_2020']) . "</td>
            <td> " . number_format($tampil['tahun_2021']) . "</td>
        </tr>";

        $no++;
    }

    ?>
</table>
    </div>
    </div>

    <!-- PENJELASAN BUTTON -->
    <div>
        <p><a class="tbl-pink" onclick="toggleContent()"> Penjelasan </a></p>
        <div id="content">
        <table border='1'width='70%'>
        <tr>
            <th>Kolom</th>
            <th>Deskripsi</th>
        </tr>
        <tr>
            <td>Koridor</td>
            <td>Koridor yang sesuai dengan Trayek Perjalananan </td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>Jenis Layanan yang disediakan Transjakarta</td>
        </tr>
        <tr>
            <td>Trayek</td>
            <td>Tujuan dan Keberangkatan (Rute) Transjakarta</td>
        </tr>
        <tr>
            <td>2019</td>
            <td>Tahun untuk jumlah penumpang dan pendapatan</td>
        </tr>
        <tr>
            <td>2020</td>
            <td>Tahun untuk jumlah penumpang dan pendapatan</td>
        </tr>
        <tr>
            <td>2021</td>
            <td>Tahun untuk jumlah penumpang dan pendapatan</td>
        </tr>
        </table>
        </div>
        </div>
        <script src="js/skript.js"></script>
        </html>

        <div id="copyright">
        <div class="wrapper">
            &copy; 2022. <b>Visualisasi Transjakarta</b> All Rights Reserved.
        </div>
    </div>
    
</body>
