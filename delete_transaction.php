<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'kasir_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus transaksi dari database
$delete_query = "DELETE FROM transaksi WHERE id = $id";
if ($conn->query($delete_query)) {
    header('Location: dashboard.php'); // Redirect ke halaman utama setelah hapus
} else {
    echo "Error: " . $conn->error;
}
?>
