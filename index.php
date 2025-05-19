<?php
include "service/service.php";

session_start();
if (isset($_SESSION['kasir'])) {
    header("Location: kasir.php");
    exit();
} else if (isset($_SESSION['admin'])) {
    header("Location: atmin.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cekuser = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $validasi = mysqli_num_rows($cekuser);

    if ($validasi > 0) {
        $getdatarole = mysqli_fetch_array($cekuser);
        $role = $getdatarole['role'];

        if ($role == 'admin') {
            session_start();
            $_SESSION['is_login'] = true;
            $_SESSION['role'] = 'admin';
            header("Location: atmin.php");
        } elseif ($role == 'kasir') {
            session_start();
            $_SESSION['is_login'] = true;
            $_SESSION['role'] = 'kasir';
            header("Location: kasir.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Haven | Login</title>
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
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background-color: rgba(184, 92, 56, 0.1);
            z-index: -1;
        }
        
        body::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background-color: rgba(111, 78, 55, 0.1);
            z-index: -1;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 2.5rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            position: relative;
            z-index: 1;
        }
        
        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .brand-title {
            font-weight: 600;
            margin-top: 0.5rem;
            color: var(--dark-color);
        }

        .form-floating .form-control {
            border: none;
            background-color: #f8f9fa;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .form-floating .form-control:focus {
            box-shadow: none;
            background-color: #f0f2f5;
            border: 1px solid var(--accent-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 78, 55, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h4 {
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .coffee-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand-logo">
            <i class="fas fa-coffee fa-3x coffee-icon"></i>
            <h3 class="brand-title mt-2">Warkop Prapatan</h3>
        </div>

        <form action="index.php" method="POST">
            <div class="form-floating mb-3">
                <input type="username" class="form-control" id="username" name="username" placeholder="Username" required>
                <label for="username"><i class="fas fa-user me-2"></i>Username</label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 py-2" name="login">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>