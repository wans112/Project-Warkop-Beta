<?php
include 'service/service.php';
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: atmin.php");
    exit();
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Haven | Cashier</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6F4E37;
            --secondary-color: #B85C38;
            --light-color: #F5F5DC;
            --dark-color: #3C2A21;
            --accent-color: #E6CCB2;
        }
        
        body {
            background-color: var(--light-color);
            color: var(--dark-color);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--dark-color);
        }

        .navbar-brand {
            color: var(--accent-color);
            font-weight: 600;
        }

        .logout-btn {
            background-color: transparent;
            border: 1px solid var(--accent-color);
            color: var(--accent-color);
            border-radius: 20px;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: var(--accent-color);
            color: var(--dark-color);
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem;
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 500;
        }

        .form-select, .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            background-color: white;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(230, 204, 178, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 78, 55, 0.2);
        }
        
        .coffee-animation {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }
        
        .coffee-cup {
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .coffee-cup i {
            font-size: 4rem;
            color: var(--primary-color);
            animation: steam 2s ease-in-out infinite;
        }
        
        @keyframes steam {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-5px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        .transaction-success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid #28a745;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
        }
        
        .transaction-success i {
            color: #28a745;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .transaction-error {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            display: flex;
            align-items: center;
        }
        
        .transaction-error i {
            color: #dc3545;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-coffee me-2"></i>
                Warkop Prapatan
            </a>
            <form action="kasir.php" method="POST">
                <button type="submit" name="logout" class="btn logout-btn">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="coffee-animation">
                    <div class="coffee-cup">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Transaksi Baru</h5>
                        <span><i class="fas fa-cash-register"></i></span>
                    </div>
                    <div class="card-body">
                        <form action="kasir.php" method="POST">
                            <div class="mb-3">
                                <label for="id_produk" class="form-label">Pilih Menu</label>
                                <select class="form-select" id="id_produk" name="id_produk" required>
                                    <option value="" disabled selected>Pilih</option>
                                    <?php
                                    $data_produk = mysqli_query($connect, "SELECT * FROM produk");
                                    while ($row = mysqli_fetch_array($data_produk)) {
                                        echo "<option value='" . $row['id_produk'] . "'>" . $row['nama_produk'] ." - Rp ".number_format($row['harga'], 0, ',', '.')."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-receipt me-2"></i> Process Transaction
                            </button>
                        </form>
                        
                        <?php
                        // Display transaction result
                        if(isset($_POST["id_produk"]) && isset($_POST["jumlah"])){
                            $id_transaksi = generate_uuid();
                            $id_produk = $_POST["id_produk"];
                            $jumlah = $_POST["jumlah"];

                            $query_produk = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                            $data_produk = mysqli_fetch_array($query_produk);
                            $total = $data_produk['harga'] * $jumlah;
                            $nama_produk = mysqli_real_escape_string($connect, $data_produk['nama_produk']);

                            $insert_transaksi = mysqli_query($connect, "INSERT INTO transaksi (id_transaksi, nama_produk, jumlah, total, waktu) VALUES ('$id_transaksi', '$nama_produk', '$jumlah', '$total', NOW())");

                            if($insert_transaksi){
                                echo '
                                <div class="transaction-success mt-3">
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <h6 class="mb-1">Transaksi Berhasil!</h6>
                                        <p class="mb-0 small">Produk: '.$nama_produk.'<br>Jumlah: '.$jumlah.'<br>Total: Rp '.number_format($total, 0, ',', '.').'</p>
                                    </div>
                                </div>';
                            } else {
                                echo '
                                <div class="transaction-error mt-3">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <div>
                                        <h6 class="mb-1">Transaksi Gagal</h6>
                                        <p class="mb-0 small">Coba Lagi atau Hubungi Atmin</p>
                                    </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
function generate_uuid() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}
?>