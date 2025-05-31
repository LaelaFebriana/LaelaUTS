<?php
session_start();
include 'db_connection.php'; // Hubungkan ke database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user di database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
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
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styling halaman login */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #4a90e2, #357ab8); /* Warna biru utama */
        }

        .login-container {
            width: 380px;
            padding: 40px;
            background: white;
            border-radius: 12px;
            /* Membuat box berbentuk silinder */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container h2 {
            color: #4a90e2; /* Warna biru untuk judul */
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }

        .input-group input {
            width: calc(100% - 20px);
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 16px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background: #4a90e2; /* Warna biru untuk tombol */
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 25px;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #357ab8; /* Warna biru lebih gelap untuk hover */
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
            animation: shake 0.3s ease-in-out;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #4a90e2; /* Warna biru untuk tautan */
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 400px) {
            .login-container {
                width: 90%;
                border-radius: 40px;
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login" class="login-btn">Login</button>
        </form>
        <p class="register-link">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>

</html>