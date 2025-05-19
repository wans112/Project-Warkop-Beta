<?php
include 'service/service.php';
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['kasir'])) {
    header("Location: kasir.php");
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
    <title>Brew Admin | Coffee Shop Management</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            margin-top: 2rem;
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            background-color: white;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: var(--accent-color);
            color: var(--dark-color);
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid var(--accent-color);
        }

        tr:hover {
            background-color: rgba(230, 204, 178, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-coffee me-2"></i>
                Brew Admin
            </a>
            <form action="atmin.php" method="POST">
                <button type="submit" name="logout" class="btn logout-btn">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Transaksi</h5>
                <span><i class="fas fa-history"></i></span>
            </div>
            <div class="card-body">
                <?php
                // Query transaction data
                $query_transaksi = mysqli_query($connect, "SELECT * FROM transaksi ORDER BY waktu DESC");

                if(mysqli_num_rows($query_transaksi) > 0){
                    echo '<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>';

                    while($row = mysqli_fetch_array($query_transaksi)){
                        echo "<tr>
                                <td>".substr($row['id_transaksi'], 0, 8)."...</td>
                                <td>".$row['nama_produk']."</td> 
                                <td>".$row['jumlah']."</td>
                                <td>Rp ".number_format($row['total'], 0, ',', '.')."</td>
                                <td>".$row['waktu']."</td>
                            </tr>";
                    } 
                    
                    echo '</tbody></table></div>';
                } else {
                    echo '<div class="empty-state">
                            <i class="fas fa-receipt fa-3x mb-3"></i>
                            <h5>No transactions yet</h5>
                            <p class="text-muted">Transaction records will appear here</p>
                          </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>