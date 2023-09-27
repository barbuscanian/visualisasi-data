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
        <h3>Dashboard Jumlah Penumpang dan Pendapatan Transjakarta</h3>
            <div class="main-cards">
            

        <!-- CARD TOTAL PENUMPANG -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Penumpang</div>
              <div class ="icon icon-shape background-green text-primary">
                <span class="material-icons-outlined">diversity_3</span>
              </div>
              </div>
              <div class="text-primary" id="totalPenumpang"></div>
            </div>

            <?php
            include "koneksi.php";
            // Mengambil total penumpang dari tabel 'penumpang' kolom 'tahun_2019', 'tahun_2020', dan 'tahun_2021' dan menjumlahkannya
            $query = "SELECT SUM(tahun_2019 + tahun_2020 + tahun_2021) AS total_penumpang FROM penumpang";
            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_penumpang = $row["total_penumpang"];
            } else {
                $total_penumpang = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>

            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPenumpang = <?php echo json_encode($total_penumpang); ?>;
            var formattedTotal = totalPenumpang.toLocaleString();
            document.getElementById("totalPenumpang").innerHTML = formattedTotal;
            
            </script>
        

        <!-- CARD TOTAL PENDAPATAN -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Pendapatan (Rupiah)</div>
              <div class ="icon icon-shape background-blue text-primary">
                <span class="material-icons-outlined">monetization_on</span>
              </div>
              </div>
              <div class="text-primary" id="totalPendapatan"></div>   
            </div>
            </div>

            <?php
            include "koneksi.php";
            // Mengambil total penumpang dari tabel 'pendapatan' kolom 'tyear_2019', 'year_2020', dan 'year_2021' dan menjumlahkannya
            $query = "SELECT SUM(pendapatan) AS total_pendapatan FROM jumlahpptahun";

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

        <div class="main-cards3">
        <!-- GRAFIK TOTAL PENUMPANG DAN PENDAPATAN TRANSJAKARTA-->
        <div class="card3">
              <div class="card3-inner">
            <div class="pi">Grafik Penumpang dan Pendapatan Berdasarkan Tahun</div></div>
            <canvas id="grafikMixed" width="400" height="200"></canvas>
            </div></div>

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

        $tahun_penumpang = array();
        $penumpang = array();
        $tahun_pendapatan = array();
        $pendapatan = array();

            // Query untuk memilih tabel 'jumlah' dengan kolom 'tahun' dan 'penumpang'
            $sql_penumpang = "SELECT tahun, penumpang FROM jumlahpptahun";
            $result_penumpang = $koneksi->query($sql_penumpang);

            if ($result_penumpang) {
                if ($result_penumpang->num_rows > 0) {
                    // Proses data dari setiap baris
                    while($row = $result_penumpang->fetch_assoc()) {
                        $tahun_penumpang[] = $row["tahun"];
                        $penumpang[] = $row["penumpang"];
                    }
                } else {
                    echo "No data found for jumlah penumpang.";
                }
            } else {
                // Handle query error
                echo "Query Error: " . $koneksi->error;
            }

        // Query untuk memilih tabel 'jumlah' dengan kolom 'tahun' dan 'pendapatan'
        $sql_pendapatan = "SELECT tahun, pendapatan FROM jumlahpptahun";
        $result_pendapatan = $koneksi->query($sql_pendapatan);

        if ($result_pendapatan) {
            if ($result_pendapatan->num_rows > 0) {
                // Proses data dari setiap baris
                while($row = $result_pendapatan->fetch_assoc()) {
                    $tahun_pendapatan[] = $row["tahun"];
                    $pendapatan[] = $row["pendapatan"];
                }
            } else {
                echo "No data found for jumlah pendapatan.";
            }
        } else {
            // Handle query error
            echo "Query Error: " . $koneksi->error;
        }

        // Menutup koneksi setelah selesai menggunakan database
        $koneksi->close();
        ?>

        <!-- Memasukkan kode JavaScript dari file terpisah -->
        <script>
        var ctx = document.getElementById('grafikMixed').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($tahun_penumpang); ?>,
                datasets: [{
                    label: 'Jumlah Penumpang',
                    data: <?php echo json_encode($penumpang); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light mode color for bars
                    borderColor: 'rgba(75, 192, 192, 1)', // Light mode color for border
                    borderWidth: 1
                }, {
                    label: 'Jumlah Pendapatan',
                    data: <?php echo json_encode($pendapatan); ?>,
                    type: 'line',
                    fill: true,
                    backgroundColor: 'rgba(15, 0, 255, 0.2)', // Light mode color for line area
                    borderColor: 'rgba(15, 0, 255, 1)', // Light mode color for line border
                    borderWidth: 2
                }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white' // Set y-axis text color to white
                    }
                },
                x: {
                    ticks: {
                        color: 'white' // Set x-axis text color to white
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Set legend label color to white
                    }
                },
                annotation: {
                    annotations: [
                        {
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y',
                            value: totalPendapatan,
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 2,
                            label: {
                                enabled: true,
                                content: "Rp " + totalPendapatan,
                                position: "left",
                                backgroundColor: 'rgba(255, 255, 255, 0.8)',
                                font: {
                                    size: 14,
                                    weight: 'bold',
                                    color: 'white'
                                }
                            }
                        }
                    ]
                }
            }
        }
    });
</script>
    <!-- PENJELASAN BUTTON -->
    <div>
        <p><a class="tbl-pink" onclick="toggleContent()"> Penjelasan </a></p>
        <div id="content">
        <p style="text-align: justify;">Grafik penumpang menggambarkan tren penurunan yang konsisten dari tahun ke tahun. Jumlah penumpang mengalami penurunan sekitar 52.00% dari tahun 2019 ke 2020, dan kemudian mengalami penurunan sekitar 22.03% dari tahun 2020 ke 2021. Penurunan ini dapat diartikan sebagai dampak dari faktor eksternal seperti pandemi COVID-19 yang mempengaruhi mobilitas dan permintaan layanan selama periode tersebut.
        <p style="text-align: justify;">Pengaruh pandemi COVID-19 juga terlihat dalam grafik pendapatan yang menunjukkan penurunan yang signifikan dari tahun ke tahun. Terjadi penurunan sekitar 62.71% dalam pendapatan dari tahun 2019 ke 2020, dan kemudian terjadi penurunan sekitar 38.05% dari tahun 2020 ke 2021. Penurunan pendapatan ini dapat sebagian besar dihubungkan dengan pengaruh pandemi, yang berpotensi mengurangi permintaan dan aktivitas ekonomi yang secara langsung berdampak pada pendapatan layanan.
        <p style="text-align: justify;">Grafik ini memberikan gambaran tentang variasi layanan yang disediakan oleh TransJakarta dan seberapa banyak koridor yang dikhususkan untuk masing-masing jenis layanan tersebut. Jumlah koridor terbanyak berada pada layanan Sistem Bus Rapid Transit (BRT), yang memiliki 13 koridor. Ini mengindikasikan bahwa layanan BRT memiliki cakupan yang luas dalam sistem transportasi TransJakarta dan mungkin menjadi salah satu jenis layanan yang paling banyak digunakan oleh masyarakat.
</p></p></p></div></div>
        <script src="js/skript.js"></script>

            <!-- CARD TOTAL JENIS TRANSJAKARTA -->
            <div class="main-cards2">
            <div class="card2">
              <div class="card2-inner">
            <div class="pi">Total Jenis Layanan</div>
                <div class ="icon icon-shape background-red text-primary">
                  <span class="material-icons-outlined">directions_bus</span>
                </div>
                </div>
                <div class="text-primary"id="totalLayanan"></div>   
              </div>

            <?php
            include "koneksi.php";
            // Nilai-nilai layanan dari jenis-jenis yang berbeda
            $royaltrans = 1;
            $mikrotrans = 1;
            $transjabodetabek = 1;
            $angkutanpariwisata = 1;
            $angkutanumum = 1;
            $angkutanumumlainnya = 1;
            $layanan_sistem_brt = 1;
            
            // Jumlahkan total keseluruhan layanan
            $total_layanan = $royaltrans + $mikrotrans + $transjabodetabek + $angkutanpariwisata + $angkutanumum + $angkutanumumlainnya + $layanan_sistem_brt;
            ?>

            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalLayanan = <?php echo json_encode($total_layanan); ?>;
            document.getElementById("totalLayanan").innerHTML = totalLayanan;
            </script>
            
            <!-- CARD TOTAL KORIDOR -->
            <div class="card2">
              <div class="card2-inner">
              <div class="pi">Total Koridor</div>
                <div class ="icon icon-shape background-orange text-primary">
                  <span class="material-icons-outlined">radio_button_checked</span>
                </div>
                </div>
                <div class="text-primary" id="totalKode"></div>   
              </div>

              <?php
        include "koneksi.php"; // Menghubungkan ke database
        
        // Kueri untuk menghitung total data dalam kolom 'KODE'
        $sql = "SELECT COUNT(KODE) AS total FROM PENUMPANG";
        
        // Menjalankan kueri dan mendapatkan hasil
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalKode = $row["total"];
            echo "<script>document.getElementById('totalKode').textContent = $totalKode;</script>";
        } else {
            echo "Tidak ada data.";
        }
        
        // Menutup koneksi database
        $conn->close();
    ?>

<script>
        // Membuat permintaan HTTP menggunakan Fetch API
        fetch('get_total_kode.php')
            .then(response => response.json())
            .then(data => {
                const totalKode = data.total;
                const totalKodeElement = document.getElementById('totalKode');
                totalKodeElement.textContent = totalKode;
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    </script>

            <!-- CARD JENIS PALING BANYAK DIGUNAKAN -->
            <div class="card2">
                <div class="card2-inner">
                <div class="pi">Jenis Paling Banyak digunakan</div>
                  <div class ="icon icon-shape background-red text-primary">
                    <span class="material-icons-outlined">directions_bus</span>
                  </div>
                  </div>
                  <div class="text-primary" id="mostUsedTransportation"></div>   
                </div>
              </div>

            <?php
            include "koneksi.php";
            $sql = "SELECT jenis, COUNT(*) AS count FROM penumpang GROUP BY jenis ORDER BY count DESC LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $mostUsedTransportation = $row["jenis"];
                $mostUsedCount = $row["count"];
            } else {
                $mostUsedTransportation = "N/A";
                $mostUsedCount = 0;
            }

            $conn->close();
            ?>

            <script>
            // Assume the PHP variable $mostUsedTransportation is already assigned the most used transportation value
            var mostUsedTransportation = "<?php echo $mostUsedTransportation; ?>";

            // Update the displayed result
            document.getElementById("mostUsedTransportation").textContent = mostUsedTransportation;
            </script>

            
            <div class="main-cards">
            <!-- TOP 5 TRAYEK DENGAN PENUMPANG TERTINGGI -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 DATA TERATAS DENGAN PENUMPANG TERTINGGI</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='60%'>Trayek</th>
                <th width='20%'>Pendapatan</th>
                </tr>
                <?php
                    include "koneksi.php";

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die('Koneksi gagal: ' . $conn->connect_error);
                    }

                    // Ambil 5 data teratas dengan penumpang tertinggi dari tabel "trayek"
                    $sql = "SELECT kode, trayek, (COALESCE(tahun_2019, 0) + COALESCE(tahun_2020, 0) + COALESCE(tahun_2021, 0)) AS total_penumpang FROM penumpang 
                    WHERE COALESCE(tahun_2019, 0) + COALESCE(tahun_2020, 0) + COALESCE(tahun_2021, 0) > 0
                    ORDER BY total_penumpang DESC
                    LIMIT 5;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["kode"] . "</td>";
                            echo "<td>";
                    
                            $trayekList = explode("\n", $row["trayek"]); // Memisahkan setiap jalur dengan baris baru
                            foreach ($trayekList as $trayek) {
                                echo "" . $trayek . "<br>"; // Menggunakan simbol bullets
                            }
                    
                            echo "</td>";
                            echo "<td>" . number_format($row["total_penumpang"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Tidak ada data trayek</td></tr>";
                    }
                    

                    // Tutup koneksi
                    $conn->close();
                    ?>
                </table>
            </div>
             
            <!-- TOP 5 TRAYEK DENGAN PENDAPATAN TERTINGGI -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 DATA TERATAS DENGAN PENDAPATAN TERTINGGI</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='50%'>Trayek</th>
                <th width='20%'>Pendapatan</th>
                </tr>
                <?php
                include "koneksi.php";

                // Cek koneksi
                if ($conn->connect_error) {
                    die('Koneksi gagal: ' . $conn->connect_error);
                }

                // Ambil 5 data teratas dengan pendapatan tertinggi dari tabel "trayek"
                $sql = "SELECT kode, trayek, (year_2019 + year_2020 + year_2021) AS total_pendapatan FROM pendapatan ORDER BY total_pendapatan DESC LIMIT 5;";
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
            </div></div>

        <div class="main-cards3">
        <!-- GRAFIK TOTAL PENUMPANG DAN PENDAPATAN TRANSJAKARTA-->
        <div class="card3">
              <div class="card3-inner">
              <div class="pi">Grafik Jumlah Koridor Transjakarta Berdasarkan Jenis</div></div>
                <canvas id="kodeChart"></canvas>
            </div></div>

    <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "transjakarta";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    $sql = "SELECT jenis, COUNT(kode) as jumlah FROM penumpang GROUP BY jenis";
    $result = $conn->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    ?>

    <script>
        // Menyiapkan data untuk grafik
        var labels = <?php echo json_encode(array_column($data, 'jenis')); ?>;
        var values = <?php echo json_encode(array_column($data, 'jumlah')); ?>;

        // Membuat grafik
        var ctx = document.getElementById('kodeChart').getContext('2d');
        var kodeChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Koridor Transjakarta',
                    data: values,
                    backgroundColor: 'rgba(15, 0, 255, 0.3)',
                    borderColor: 'rgba(15, 0, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white' // Set y-axis text color to white
                    }
                },
                x: {
                    ticks: {
                        color: 'white' // Set x-axis text color to white
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Set legend label color to white
                    }
                },
        }
    }
});
    </script>

    <!-- PENJELASAN BUTTON -->
    <div>
    <button id="toggleButton">Penjelasan</button>
    <div id="content1" class="content-hidden">
        <p style="text-align: justify;">Grafik penumpang menggambarkan tren penurunan yang konsisten dari tahun ke tahun. Jumlah penumpang mengalami penurunan sekitar 52.00% dari tahun 2019 ke 2020, dan kemudian mengalami penurunan sekitar 22.03% dari tahun 2020 ke 2021. Penurunan ini dapat diartikan sebagai dampak dari faktor eksternal seperti pandemi COVID-19 yang mempengaruhi mobilitas dan permintaan layanan selama periode tersebut.
        <p style="text-align: justify;">Pengaruh pandemi COVID-19 juga terlihat dalam grafik pendapatan yang menunjukkan penurunan yang signifikan dari tahun ke tahun. Terjadi penurunan sekitar 62.71% dalam pendapatan dari tahun 2019 ke 2020, dan kemudian terjadi penurunan sekitar 38.05% dari tahun 2020 ke 2021. Penurunan pendapatan ini dapat sebagian besar dihubungkan dengan pengaruh pandemi, yang berpotensi mengurangi permintaan dan aktivitas ekonomi yang secara langsung berdampak pada pendapatan layanan.
        <p style="text-align: justify;">Grafik ini memberikan gambaran tentang variasi layanan yang disediakan oleh TransJakarta dan seberapa banyak koridor yang dikhususkan untuk masing-masing jenis layanan tersebut. Jumlah koridor terbanyak berada pada layanan Sistem Bus Rapid Transit (BRT), yang memiliki 13 koridor. Ini mengindikasikan bahwa layanan BRT memiliki cakupan yang luas dalam sistem transportasi TransJakarta dan mungkin menjadi salah satu jenis layanan yang paling banyak digunakan oleh masyarakat.
    </p></p></p></div></div>
        <script src="js/skrip.js"></script></main>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2022. <b>Visualisasi Transjakarta</b> All Rights Reserved.
        </div>
    </div>
        </main>

        






</body>
</body>
</body>


