<?php

include 'config.php';
//config.php, nơi chứa các thông tin cấu hình cơ sở dữ liệu (như thông tin kết nối) 
session_start();
session_unset(); //Hủy tất cả dữ liệu trong phiên làm việc (Session):
session_destroy();// Hủy phiên làm việc (Session)

header('location:login.php');

?>