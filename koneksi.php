<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "transjakarta");

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
