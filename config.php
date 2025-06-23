<?php
$conn = mysqli_connect(
    getenv('MYSQLHOST'),
    getenv('MYSQLUSER'),
    getenv('MYSQLPASSWORD'),
    getenv('MYSQLDATABASE'),
    getenv('MYSQLPORT')
);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
