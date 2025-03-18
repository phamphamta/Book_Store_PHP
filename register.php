<?php

include 'config.php';  // kết nối với cơ sở dữ liệu MySQL-

if(isset($_POST['submit'])){  //Kiểm tra xem form có được gửi không

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   // kiểm tra xem đã có người dùng với cùng email và mật khẩu tồn tại hay chưa.


   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User Already Exist!';  //Nếu truy vấn trả về kết quả (nghĩa là người dùng đã tồn tại), thông báo "user already exist!" sẽ được lưu vào mảng $message.
   }else{
      if($pass != $cpass){ // Nếu mật khẩu và mật khẩu xác nhận không khớp, thông báo "confirm password not matched!" sẽ được thêm vào $message.
         $message[] = 'Confirm Password Not mMtched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('Query failed');
         $message[] = 'Registered Successfully!';
         // Nếu tất cả điều kiện hợp lệ, hệ thống sẽ thực hiện câu 
         //lệnh SQL INSERT để thêm người dùng mới vào bảng users
         //Sau đó, thông báo "registered successfully!"
         header('location:login.php');
         //được lưu và trang sẽ chuyển hướng đến login.php.
      }
   }

}

// Mã này nhận dữ liệu từ form đăng ký người dùng, 
//kiểm tra người dùng đã tồn tại chưa, 
//kiểm tra xem mật khẩu và mật khẩu xác nhận có khớp không, 
//rồi thêm thông tin người dùng vào cơ sở dữ liệu nếu tất cả điều kiện đều hợp lệ
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!--Giúp trang tương thích tốt hơn với các phiên bản Internet Explorer 
   cũ hơn bằng cách sử dụng phiên bản Edge.
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> !-->
   <!--Cài đặt hiển thị trang trên các thiết bị khác nhau.
   Ví dụ: điều chỉnh trang để thân thiện với thiết bị di động, đảm bảo kích thước hiển thị vừa với màn hình.!-->
   <title>Register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <!-- FontAwesome: Thẻ link đầu tiên liên kết đến FontAwesome thông qua CDN. 
   FontAwesome cung cấp các biểu tượng (icons) để sử dụng trong trang web. 
   Dòng này cho phép sử dụng các biểu tượng có sẵn từ FontAwesome.

   //Custom CSS: Thẻ link thứ hai liên kết đến tệp CSS tùy chỉnh (style.css). 
   Tệp này chứa các định dạng và bố cục (layout) của trang web. !-->

</head>
<body>


<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <input type="text" name="name" placeholder="Enter Your Name" required class="box">
      <input type="email" name="email" placeholder="Enter Your Email" required class="box">
      <input type="password" name="password" placeholder="Enter Your Password" required class="box">
      <input type="password" name="cpassword" placeholder="Confirm Your Password" required class="box">
      <select name="user_type" class="box">
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      <input type="submit" name="submit" value="Register now" class="btn">
      <p>Already Have An Account?   <a href="login.php">Login Now</a></p>
   </form>

</div>

</body>
</html>