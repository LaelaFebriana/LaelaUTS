<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kasir</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #4a90e2; /* Warna biru utama */
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-box {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .btn-box button {
            width: 200px;
            padding: 10px;
            background: #4a90e2; /* Warna biru untuk tombol */
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 20px;
            transition: 0.3s;
        }

        .btn-box button:hover {
            background: #357ab8; /* Warna biru lebih gelap untuk hover */
        }
    </style>
</head>

<body>

    <h1>Welcome to Website Online Data Kasir</h1>

    <div class="btn-box">
        <button onclick="window.location.href='login.php'">Login</button>
        <button onclick="window.location.href='register.php'">Register</button>
    </div>

</body>

</html>
