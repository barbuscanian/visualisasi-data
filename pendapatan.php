<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Sertakan Chart.js melalui CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Visualisasi Data Transjakarta</title>
    <link rel="stylesheet" href="css/style.css">
    <style>

    </style>
</head>
<body>
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
        <main class="main-container">
        <h3>Dashboard Jumlah Pendapatan Transjakarta</h3>
            <div class="main-cards2">

            <!-- CARD TOTAL PENDAPATAN -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Pendapatan Tahun 2019</div>
              <div class ="icon icon-shape background-blue text-primary">
                <span class="material-icons-outlined">monetization_on</span>
              </div>
              </div>
              <div class="text-primary" id="totalPendapatan"></div>   
            </div>

            <?php
            include "koneksi.php";
            $query = "SELECT COALESCE(SUM(year_2019), 0) AS total_pendapatan FROM pendapatan;";

            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_pendapatan = number_format($row["total_pendapatan"]); // Add number format here
            } else {
                $total_pendapatan = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>


            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPendapatan = <?php echo json_encode($total_pendapatan); ?>;
            document.getElementById("totalPendapatan").innerHTML = "Rp " + totalPendapatan;
            </script>

            <!-- CARD TOTAL PENDAPATAN -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Pendapatan Tahun 2020</div>
              <div class ="icon icon-shape background-blue text-primary">
                <span class="material-icons-outlined">monetization_on</span>
              </div>
              </div>
              <div class="text-primary" id="totalPendapatan20"></div>   
            </div>

            <?php
            include "koneksi.php";
            $query = "SELECT SUM(year_2020) AS total_pendapatan20 FROM pendapatan";

            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_pendapatan20 = number_format($row["total_pendapatan20"]); // Add number format here
            } else {
                $total_pendapatan20 = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>


            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPendapatan = <?php echo json_encode($total_pendapatan20); ?>;
            document.getElementById("totalPendapatan20").innerHTML = "Rp " + totalPendapatan;
            </script>

            <!-- CARD TOTAL PENDAPATAN -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Pendapatan Tahun 2021</div>
              <div class ="icon icon-shape background-blue text-primary">
                <span class="material-icons-outlined">monetization_on</span>
              </div>
              </div>
              <div class="text-primary" id="totalPendapatan21"></div>   
            </div>
            </div>

            <?php
            include "koneksi.php";
            $query = "SELECT SUM(year_2021) AS total_pendapatan21 FROM pendapatan";

            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_pendapatan = number_format($row["total_pendapatan21"]); // Add number format here
            } else {
                $total_pendapatan = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>


            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPendapatan = <?php echo json_encode($total_pendapatan); ?>;
            document.getElementById("totalPendapatan21").innerHTML = "Rp " + totalPendapatan;
            </script>

        <div class="main-cards3">
        <!-- GRAFIK TOTAL PENUMPANG DAN PENDAPATAN TRANSJAKARTA-->
        <div class="card3">
              <div class="card3-inner">
            <div class="pi">Grafik Tren Pendapatan Berdasarkan Koridor </div></div>
            <canvas id="grafikBar" width="400" height="200"></canvas>
            </div>

            <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "transjakarta";

        // Create a connection to the database
        $koneksi = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($koneksi->connect_error) {
            die("Connection failed: " . $koneksi->connect_error);
        }

        $year_penumpang = array();
        $year_2019 = array();
        $year_2020 = array();
        $year_2021 = array();

        // Query untuk memilih data koridor dari tabel penumpang
        $sql_penumpang = "SELECT kode, year_2019, year_2020, year_2021 FROM pendapatan";
        $result_penumpang = $koneksi->query($sql_penumpang);

        if ($result_penumpang) {
            if ($result_penumpang->num_rows > 0) {
                while ($row = $result_penumpang->fetch_assoc()) {
                    $year_penumpang[] = $row["kode"];
                    $year_2019[] = $row["year_2019"];
                    $year_2020[] = $row["year_2020"];
                    $year_2021[] = $row["year_2021"];
                }
            } else {
                echo "No data found for passenger counts.";
            }
        } else {
            echo "Query Error: " . $koneksi->error;
        }

        $koneksi->close();
        ?>

    <script>
        var yearPenumpang = <?php echo json_encode($year_penumpang); ?>;
        var year2019 = <?php echo json_encode($year_2019); ?>;
        var year2020 = <?php echo json_encode($year_2020); ?>;
        var year2021 = <?php echo json_encode($year_2021); ?>;

        var ctx = document.getElementById('grafikBar').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: yearPenumpang,
                datasets: [{
                    label: 'Tahun 2019',
                    data: year2019,
                    backgroundColor: 'rgba(15, 0, 255, 0.3)',
                    borderColor: 'rgba(15, 0, 255, 1)',
                    borderWidth: 2
                }, {
                    label: 'Tahun 2020',
                    data: year2020,
                    backgroundColor: 'rgba(245, 40, 145, 0.3)',
                    borderColor: 'rgba(245, 40, 145, 1)',
                    borderWidth: 2
                }, {
                    label: 'Tahun 2021',
                    data: year2021,
                    backgroundColor: 'rgba(39, 164, 151, 0.3)',
                    borderColor: 'rgba(39, 164, 151, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: 'white'  // Warna label x-axis
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white'  // Warna label y-axis
                        }
                    }
                }
            }
        });
    </script>
    
    <!-- PENJELASAN BUTTON -->
    <div>
    <p><a class="tbl-pink" onclick="toggleContent()"> Penjelasan </a></p>
    <div id="content">
    <p style="text-align: justify;">Data tersebut mencerminkan distribusi penumpang di berbagai koridor TransJakarta selama tiga tahun berturut-turut (2019, 2020, dan 2021). Koridor I dan IX menonjol sebagai koridor dengan jumlah penumpang tertinggi dalam tiga tahun tersebut, walaupun mengalami penurunan di tahun 2021. Koridor XI tetap menjadi yang terendah dalam jumlah penumpang. Fluktuasi jumlah penumpang di berbagai koridor mungkin dipengaruhi oleh faktor-faktor seperti perkembangan kota, perubahan preferensi pengguna, dan perubahan dalam infrastruktur transportasi.
    </p>
    <script src="js/skript.js"></script>
    </div>
        
         <div class="main-cards">
            <!-- TOP 5 TRAYEK DENGAN PENDAPATAN TERTINGGI -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 DATA TERATAS DENGAN PENDAPATAN TERTINGGI</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='50%'>Trayek</th>
                <th width='25%'>Pendapatan</th>
                </tr>
                <?php
                    include "koneksi.php";

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die('Koneksi gagal: ' . $conn->connect_error);
                    }

                    // Ambil 5 data teratas dengan penumpang tertinggi dari tabel "trayek"
                    $sql = "SELECT trayek, kode, COALESCE(year_2021, 0) AS total_pendapatan FROM pendapatan 
                    WHERE COALESCE(year_2021, 0) > 0
                    ORDER BY total_pendapatan DESC
                    LIMIT 5;";
            $hasil = $conn->query($sql);
            
            if ($hasil->num_rows > 0) {
                while ($row = $hasil->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["kode"] . "</td>";
                    echo "<td>";
                    
                    $trayekList = explode("\n", $row["trayek"]); // Memisahkan setiap jalur dengan baris baru
                    foreach ($trayekList as $trayek) {
                        echo "" . $trayek . "<br>";
                    }
                    
                    echo "</td>";
                    echo "<td>Rp " . number_format($row["total_pendapatan"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data trayek</td></tr>";
            }
            
    
                    // Tutup koneksi
                    $conn->close();
                    ?>
                </table>
            </div>
             
            <!-- TOP 5 TRAYEK DENGAN PENDAPATAN TERENDAH -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 TRAYEK DENGAN PENDAPATAN TERENDAH</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='50%'>Trayek</th>
                <th width='30%'>Pendapatan</th>
                </tr>
                <?php
                include "koneksi.php";

                // Cek koneksi
                if ($conn->connect_error) {
                    die('Koneksi gagal: ' . $conn->connect_error);
                }

                // Ambil 5 data teratas dengan penumpang terendah dari tabel "trayek"
                $sql = "SELECT trayek, kode, COALESCE(year_2021, 0) AS total_pendapatan FROM pendapatan 
                WHERE COALESCE(year_2021, 0) > 0
                ORDER BY total_pendapatan ASC
                LIMIT 5;";
        $hasil = $conn->query($sql);
        
        if ($hasil->num_rows > 0) {
            while ($row = $hasil->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["kode"] . "</td>";
                echo "<td>";
                
                $trayekList = explode("\n", $row["trayek"]); // Memisahkan setiap jalur dengan baris baru
                foreach ($trayekList as $trayek) {
                    echo "" . $trayek . "<br>";
                }
                
                echo "</td>";
                echo "<td>Rp " . number_format($row["total_pendapatan"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Tidak ada data trayek</td></tr>";
        }

                // Tutup koneksi
                $conn->close();
                ?>
            </table>
            </div></div></div></div></main>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2022. <b>Visualisasi Transjakarta</b> All Rights Reserved.
        </div>
    </div>