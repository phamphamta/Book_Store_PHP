<?php
$url = getenv("MYSQL_PUBLIC_URL");

if (!$url) {
    die("❌ Không tìm thấy biến MYSQL_PUBLIC_URL. Hãy kiểm tra biến môi trường đã được đặt trong Railway.");
}

$parts = parse_url($url);

if (!$parts || !isset($parts['host'], $parts['user'], $parts['pass'], $parts['path'], $parts['port'])) {
    die("❌ Biến MYSQL_PUBLIC_URL không hợp lệ hoặc thiếu thành phần.");
}

$host = $parts["host"];
$user = $parts["user"];
$pass = $parts["pass"];
$db   = ltrim($parts["path"], '/');
$port = $parts["port"];

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("❌ Kết nối thất bại: " . mysqli_connect_error());
}
?>
