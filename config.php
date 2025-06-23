<?php
$url = parse_url(getenv("MYSQL_PUBLIC_URL"));

$host = $url["host"];
$user = $url["user"];
$pass = $url["pass"];
$db   = ltrim($url["path"], "/");
$port = $url["port"];

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
