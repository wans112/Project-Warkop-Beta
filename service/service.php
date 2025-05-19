<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "warkop";
            //mysqli_connect untuk menghubungkan ke database
$connect = mysqli_connect($hostname, $username, $password, $database);

//menampilkan pesan jika gagal terhubung ke database
if($connect->connect_error){
    echo "Koneksi Gagal: ";
    die("eror");
}
?>