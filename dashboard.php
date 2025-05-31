<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include('db_connection.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #74b9ff, #6c5ce7);
            color: #2d3436;
            min-height: 100vh;
        }

        header {
            background: #6c5ce7;
            color: white;
            padding: 1rem 2rem;
            text-align: center;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        nav .button {
            display: inline-block;
            background: #ff7675;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 25px;
            margin-top: 10px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        nav .button:hover {
            background: #d63031;
            transform: scale(1.1);
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card h3 {
            font-size: 1.5rem;
            color: #6c5ce7;
            margin-bottom: 10px;
        }

        .card p {
            margin-bottom: 15px;
        }

        .card .button {
            background: #74b9ff;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .card .button:hover {
            background: #0984e3;
            transform: scale(1.1);
        }

        .crud-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .crud-container h2 {
            font-size: 2rem;
            color: #6c5ce7;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            gap: 15px;
        }

        form .form-group {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-weight: bold;
        }

        form input {
            padding: 10px;
            border: 2px solid #dfe6e9;
            border-radius: 5px;
        }

        form input:focus {
            border-color: #6c5ce7;
        }

        form button {
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 25px;
            cursor: pointer;
        }

        form button:hover {
            background: #4834d4;
        }

        .search-bar {
            margin-top: 20px;
            text-align: center;
        }

        .search-bar input {
            padding: 10px;
            width: 50%;
            max-width: 400px;
            border: 2px solid #dfe6e9;
            border-radius: 25px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #dfe6e9;
            padding: 10px;
            text-align: center;
        }

        table th {
            background: #6c5ce7;
            color: white;
        }

        table tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tr:hover {
            background: #f1f2f6;
        }

        table a {
            color: #6c5ce7;
            text-decoration: none;
        }

        table a:hover {
            color: #4834d4;
        }
    </style>
</head>
<body>

    <header>
        <h1>Sistem Data Kasir</h1>
        <nav>
            <a href="logout.php" class="button">Logout</a>
        </nav>
    </header>

    <main class="container">
        <div class="card">
            <h3>Transaksi Baru</h3>
            <p>Mulai pencatatan transaksi baru.</p>
            <a href="#crud-transactions" class="button">Mulai</a>
        </div>
        <div class="card">
            <h3>Laporan Penjualan</h3>
            <p>Lihat laporan penjualan harian, mingguan, atau bulanan.</p>
            <a href="#" class="button">Lihat Laporan</a>
        </div>
        <div class="card">
            <h3>Manajemen Stok</h3>
            <p>Kelola stok barang di toko Anda.</p>
            <a href="#" class="button">Kelola Stok</a>
        </div>
        <div class="card">
            <h3>Pengaturan</h3>
            <p>Sesuaikan pengaturan sistem.</p>
            <a href="#" class="button">Pengaturan</a>
        </div>
    </main>

    <section id="crud-transactions" class="crud-container">
        <h2>CRUD Transaksi Baru</h2>

        <form id="transaction-form" action="save_transaction.php" method="POST">
            <div class="form-group">
                <label for="item-name">Nama Barang</label>
                <input type="text" id="item-name" name="item-name" required>
            </div>
            <div class="form-group">
                <label for="item-quantity">Jumlah</label>
                <input type="number" id="item-quantity" name="item-quantity" required>
            </div>
            <div class="form-group">
                <label for="item-price">Harga</label>
                <input type="number" id="item-price" name="item-price" required>
            </div>
            <button type="submit">Tambah Transaksi</button>
        </form>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari nama barang...">
        </div>

        <table id="transactions-table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM transaksi");
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['nama_barang']}</td>
                                <td>{$row['jumlah']}</td>
                                <td>{$row['harga']}</td>
                                <td>{$row['total']}</td>
                                <td>{$row['tanggal']}</td>
                                <td>
                                    <a href='edit_transaction.php?id={$row['id']}'>Edit</a> | 
                                    <a href='delete_transaction.php?id={$row['id']}'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Belum ada data transaksi.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <script>
        // Filter/search table rows
        document.getElementById("searchInput").addEventListener("keyup", function () {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll("#transactions-table tbody tr");

            rows.forEach(row => {
                const namaBarang = row.querySelector("td")?.textContent.toLowerCase();
                row.style.display = namaBarang.includes(keyword) ? "" : "none";
            });
        });
    </script>

</body>
</html>
