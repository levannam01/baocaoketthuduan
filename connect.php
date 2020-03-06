<?php
header("Content-type: text/html; charset=utf-8");
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "quanly";      // Khai báo database

// Kết nối database tintuc
$con = mysqli_connect($server, $username, $password, $dbname);
mysqli_set_charset($con, 'UTF8');

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if (!$con) {
    die("Không kết nối :" . mysqli_connect_error());
    exit();
}
?>