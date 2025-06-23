<?php
$host = 'containers-us-west-123.railway.app';
$user = 'root';
$password = 'NTHDRAdIHvtnbhytNpXgrDcUaphCVSXS';
$database = 'railway';
$port = 7856;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
