<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['item-name'];
    $jumlah = $_POST['item-quantity'];
    $harga = $_POST['item-price'];
    $total = $jumlah * $harga;

    $sql = "INSERT INTO transaksi (nama_barang, jumlah, harga, total) 
            VALUES ('$nama_barang', '$jumlah', '$harga', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();

    // Redirect kembali ke halaman utama
    header("Location: dashboard.php");
    exit();
}
?>
