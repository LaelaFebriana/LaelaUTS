<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4a90e2, #357ab8);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
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

        .container h2 {
            margin-bottom: 20px;
            color: #4a90e2;
            font-weight: bold;
            text-transform: uppercase;
        }

        .container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 25px;
            box-sizing: border-box;
            font-size: 16px;
            transition: 0.3s;
        }

        .container input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
        }

        .container button {
            width: 100%;
            padding: 12px 20px;
            background: #4a90e2;
            border: none;
            border-radius: 25px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .container button:hover {
            background: #357ab8;
            transform: scale(1.05);
        }

        .container a {
            display: block;
            margin-top: 15px;
            color: #4a90e2;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .container a:hover {
            text-decoration: underline;
        }

        @media (max-width: 400px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Registrasi</h2>
        <form action="proses_register.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <a href="login.php">Sudah punya akun? Login</a>
    </div>
</body>

</html>
