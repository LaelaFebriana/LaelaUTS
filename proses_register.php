<?php
session_start();
include 'db_connection.php'; // Hubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dengan keamanan tambahan
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validasi jika salah satu input kosong
    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua kolom harus diisi!";
        header("Location: register.php");
        exit;
    }

    // Hash password untuk keamanan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah email sudah ada
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Kesalahan SQL: " . $conn->error;
        header("Location: register.php");
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email sudah terdaftar!";
        $stmt->close();
        header("Location: register.php");
        exit;
    }
    $stmt->close();

    // Insert user baru
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        $_SESSION['error'] = "Kesalahan SQL saat menyimpan data: " . $conn->error;
        header("Location: register.php");
        exit;
    }

    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat registrasi.";
        $stmt->close();
        header("Location: register.php");
        exit;
    }
}

$conn->close();
?>
