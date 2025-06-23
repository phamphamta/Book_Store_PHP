<?php
$host = 'containers-us-west-43.railway.app'; // host thật
$port = 7856;                                // port thật
$user = 'root';
$password = 'CypyAJCVqzEGNmnwjenERowjgzqbIHHf';
$database = 'railway';

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
