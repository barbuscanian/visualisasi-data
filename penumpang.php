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
        <main class="main-container">
        <h3>Dashboard Jumlah Penumpang Transjakarta</h3>
            <div class="main-cards2">

        <!-- CARD TOTAL PENUMPANG 2019 -->
        <div class="card">
            <div class="card-inner">
            <div class="pi">Total Penumpang Tahun 2019</div>
              <div class ="icon icon-shape background-green text-primary">
                <span class="material-icons-outlined">diversity_3</span>
              </div>
              </div>
              <div class="text-primary" id="totalPenumpang"></div>
            </div>

            <?php
            include "koneksi.php";
            // Mengambil total penumpang dari tabel 'penumpang' kolom 'tahun_2019'
            $query = "SELECT SUM(tahun_2019) AS total_penumpang FROM penumpang";
            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_penumpang = number_format($row["total_penumpang"], 0, '.', ',');

            } else {
                $total_penumpang = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>

            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPenumpang = <?php echo json_encode($total_penumpang); ?>;
            document.getElementById("totalPenumpang").innerHTML = "  "+ totalPenumpang;
            </script>

        <!-- CARD TOTAL PENUMPANG 2020 -->
        <div class="card">
            <div class="card-inner">
            <div class="pi">Total Penumpang Tahun 2020</div>
              <div class ="icon icon-shape background-green text-primary">
                <span class="material-icons-outlined">diversity_3</span>
              </div>
              </div>
              <div class="text-primary" id="totalPenumpang20"></div>
            </div>

            <?php
            include "koneksi.php";
            // Mengambil total penumpang dari tabel 'penumpang' kolom 'tahun_2020'
            $query = "SELECT SUM(tahun_2020) AS totalPenumpang20 FROM penumpang";
            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_penumpang = number_format($row["totalPenumpang20"], 0, '.', ',');
            } else {
                $total_penumpang = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>

            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPenumpang = <?php echo json_encode($total_penumpang); ?>;
            document.getElementById("totalPenumpang20").innerHTML = "  "+ totalPenumpang;
            </script>

            <!-- CARD TOTAL PENUMPANG 2021 -->
            <div class="card">
            <div class="card-inner">
            <div class="pi">Total Penumpang Tahun 2021</div>
              <div class ="icon icon-shape background-green text-primary">
                <span class="material-icons-outlined">diversity_3</span>
              </div>
              </div>
              <div class="text-primary" id="totalPenumpang21"></div>
            </div>

            <?php
            include "koneksi.php";
            // Mengambil total penumpang dari tabel 'penumpang' kolom 'tahun_2021'
            $query = "SELECT SUM(tahun_2021) AS total_penumpang21 FROM penumpang";
            $result = $conn->query($query);

            // Memeriksa apakah query berhasil dieksekusi
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total_penumpang = number_format($row["total_penumpang21"], 0, '.', ',');
            } else {
                $total_penumpang = "Data tidak tersedia"; // Jika terjadi masalah dalam eksekusi query
            }

            // Menutup koneksi
            $conn->close();
            ?>

            <script>
            // Skrip JavaScript untuk menampilkan data
            var totalPenumpang = <?php echo json_encode($total_penumpang); ?>;
            document.getElementById("totalPenumpang21").innerHTML = "  "+ totalPenumpang;
            </script>
            </div>

            <div class="main-cards3">
        <!-- GRAFIK TOTAL PENUMPANG DAN PENDAPATAN TRANSJAKARTA-->
        <div class="card3">
              <div class="card3-inner">
            <div class="pi">Grafik Persebaran Penumpang Berdasarkan Koridor </div></div>
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
$tahun_penumpang = array();
$tahun_2019 = array();
$tahun_2020 = array();
$tahun_2021 = array();

// Query untuk memilih data koridor dari tabel penumpang
$sql_penumpang = "SELECT kode, tahun_2019, tahun_2020, tahun_2021 FROM penumpang";
$result_penumpang = $koneksi->query($sql_penumpang);

if ($result_penumpang) {
    if ($result_penumpang->num_rows > 0) {
        while ($row = $result_penumpang->fetch_assoc()) {
            $tahun_penumpang[] = $row["kode"];
            $tahun_2019[] = $row["tahun_2019"];
            $tahun_2020[] = $row["tahun_2020"];
            $tahun_2021[] = $row["tahun_2021"];
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
        var tahunPenumpang = <?php echo json_encode($tahun_penumpang); ?>;
        var tahun2019 = <?php echo json_encode($tahun_2019); ?>;
        var tahun2020 = <?php echo json_encode($tahun_2020); ?>;
        var tahun2021 = <?php echo json_encode($tahun_2021); ?>;

        var ctx = document.getElementById('grafikBar').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tahunPenumpang,
                datasets: [{
                    label: 'Tahun 2019',
                    data: tahun2019,
                    backgroundColor: 'rgba(15, 0, 255, 0.3)',
                    borderColor: 'rgba(15, 0, 255, 1)',
                    borderWidth: 2
                }, {
                    label: 'Tahun 2020',
                    data: tahun2020,
                    backgroundColor: 'rgba(245, 40, 145, 0.3)',
                    borderColor: 'rgba(245, 40, 145, 1)',
                    borderWidth: 2
                }, {
                    label: 'Tahun 2021',
                    data: tahun2021,
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
    <p><a class="tbl-pink" onclick="toggleContent()"> Penjelasan </a></p>
    <div id="content">
    <p style="text-align: justify;">Data tersebut mencerminkan distribusi penumpang di berbagai koridor TransJakarta selama tiga tahun berturut-turut (2019, 2020, dan 2021). Koridor I dan IX menonjol sebagai koridor dengan jumlah penumpang tertinggi dalam tiga tahun tersebut, walaupun mengalami penurunan di tahun 2021. Koridor XI tetap menjadi yang terendah dalam jumlah penumpang. Fluktuasi jumlah penumpang di berbagai koridor mungkin dipengaruhi oleh faktor-faktor seperti perkembangan kota, perubahan preferensi pengguna, dan perubahan dalam infrastruktur transportasi.
    </p>
    <script src="js/skript.js"></script>
    </div>
        
         <div class="main-cards">
            <!-- TOP 5 TRAYEK DENGAN PENUMPANG TERTINGGI -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 DATA TERATAS PENUMPANG TERTINGGI TAHUN 2021</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='50%'>Trayek</th>
                <th width='10%'>Penumpang</th>
                </tr>
                <?php
                    include "koneksi.php";

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die('Koneksi gagal: ' . $conn->connect_error);
                    }

                    // Ambil 5 data teratas dengan penumpang tertinggi dari tabel "trayek"
                    $sql = "SELECT kode, trayek, COALESCE(tahun_2021, 0) AS total_penumpang FROM penumpang 
                    WHERE COALESCE(tahun_2021, 0) > 0
                    ORDER BY total_penumpang DESC
                    LIMIT 5;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<tr>";
                        echo "<td>" . $row["kode"] . "</td>";
                        echo "<td>";
                        
                        $trayekList = explode("\n", $row["trayek"]); // Memisahkan setiap jalur dengan baris baru
                        foreach ($trayekList as $trayek) {
                            echo "" . $trayek . "<br>";
                        }
                        
                        echo "<td>" . number_format($row["total_penumpang"]) . "</td>";
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
             
            <!-- TOP 5 TRAYEK DENGAN PENUMPANG TERENDAH -->
            <div class="card">
            <div class="card-inner">
                <div class="pi">5 DATA TERBAWAH PENUMPANG TERENDAH TAHUN 2021</div>
            </div>
                <table>
                <tr>
                <th width='10%'>Koridor</th>
                <th width='50%'>Trayek</th>
                <th width='10%'>Penumpang</th>
                </tr>
                <?php
                include "koneksi.php";

                // Cek koneksi
                if ($conn->connect_error) {
                    die('Koneksi gagal: ' . $conn->connect_error);
                }

                    // Ambil 5 data teratas dengan penumpang tertinggi dari tabel "trayek"
                    $sql = "SELECT kode, trayek, COALESCE(tahun_2021, 0) AS total_penumpang FROM penumpang 
                    WHERE COALESCE(tahun_2021, 0) > 0
                    ORDER BY total_penumpang ASC
                    LIMIT 5;";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<tr>";
                        echo "<td>" . $row["kode"] . "</td>";
                        echo "<td>";
                        
                        $trayekList = explode("\n", $row["trayek"]); // Memisahkan setiap jalur dengan baris baru
                        foreach ($trayekList as $trayek) {
                            echo "" . $trayek . "<br>";
                        }
                        
                        echo "<td>" . number_format($row["total_penumpang"]) . "</td>";
                        echo "</tr>";
                    }
                    } else {
                        echo "<tr><td colspan='3'>Tidak ada data trayek</td></tr>";
                    }

                // Tutup koneksi
                $conn->close();
                ?>
            </table>
            </div></div> </div></main>



    <div id="copyright">
        <div class="wrapper">
            &copy; 2022. <b>Visualisasi Transjakarta</b> All Rights Reserved.
        </div>
    </div>
