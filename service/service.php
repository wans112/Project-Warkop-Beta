<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "tokobaju";

    $connect = mysqli_connect($hostname, $username, $password, $database);

    if($connect->connect_error){
        echo "Koneksi Gagal: ";
        die("eror");
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