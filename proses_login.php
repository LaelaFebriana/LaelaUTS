<?php
session_start();
include 'db_connection.php'; // Hubungkan ke database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ganti 'admin_users' menjadi 'users' jika itu nama tabel yang benar
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    if (!$stmt) {
        die("Kesalahan SQL: " . $conn->error); // Debugging error
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password dengan hashing
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Arahkan ke dashboard setelah login
            exit();
        } else {
            echo "Password salah! <a href='login.php'>Coba lagi</a>";
        }
    } else {
        echo "Username tidak ditemukan! <a href='login.php'>Coba lagi</a>";
    }

    $stmt->close();
}

$conn->close();
?>
