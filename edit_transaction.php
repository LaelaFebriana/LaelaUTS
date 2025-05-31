<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'kasir_db');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$result = $conn->query("SELECT * FROM transaksi WHERE id = $id");
$transaction = $result->fetch_assoc();

// Jika data tidak ditemukan
if (!$transaction) {
    echo "Data transaksi tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang di-submit dari form
    $item_name = $_POST['item-name'];
    $item_quantity = $_POST['item-quantity'];
    $item_price = $_POST['item-price'];
    $total = $item_quantity * $item_price;

    // Update data transaksi di database
    $update_query = "UPDATE transaksi SET nama_barang='$item_name', jumlah='$item_quantity', harga='$item_price', total='$total' WHERE id=$id";
    if ($conn->query($update_query)) {
        header('Location: dashboard.php'); // Redirect ke halaman utama setelah update
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            color: #2d3436;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form Container */
        form {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        form label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
            color: #6c5ce7;
        }

        form input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #dfe6e9;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            color: #2d3436;
            transition: border-color 0.3s ease;
        }

        form input:focus {
            border-color: #6c5ce7;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            background: #6c5ce7;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        form button:hover {
            background: #4834d4;
            transform: scale(1.05);
        }

        /* Heading */
        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #6c5ce7;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h1>Edit Transaksi</h1>
        <label for="item-name">Nama Barang</label>
        <input type="text" id="item-name" name="item-name" value="<?php echo $transaction['nama_barang']; ?>" required>

        <label for="item-quantity">Jumlah</label>
        <input type="number" id="item-quantity" name="item-quantity" value="<?php echo $transaction['jumlah']; ?>" required>

        <label for="item-price">Harga</label>
        <input type="number" id="item-price" name="item-price" value="<?php echo $transaction['harga']; ?>" required>

        <button type="submit">Update Transaksi</button>
    </form>
</body>
</html>
