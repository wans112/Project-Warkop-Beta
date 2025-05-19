<?php
include "service/service.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7c69ef;
        }
        
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 360px;
            padding: 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .form-control {
            border: none;
            background-color: #f8f9fa;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            background-color: #f0f2f5;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #6557cc;
            transform: translateY(-1px);
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-header h4 {
            color: #2d3436;
            font-weight: 600;
        }

        .form-floating > label {
            padding-left: 16px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h4 class="mb-1">Hai,</h4>
            <p class="text-muted small mb-0">Bagaimana harimu?</p>
        </div>

        <form action="index.php" method="POST">
            <div class="form-floating mb-3">
                <input type="username" class="form-control" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3" name="login">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>