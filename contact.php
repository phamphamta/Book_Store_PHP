<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){ //Kiểm tra xem form đã được gửi hay chưa.
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   //Lọc dữ liệu từ form để bảo vệ chống lại SQL Injection (tấn công SQL)
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);


   //Thực hiện một câu truy vấn SQL để tìm kiếm trong bảng message
   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message Sent Already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message Sent Successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">Home</a> / Contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Say Something!</h3>
      <input type="text" name="name" required placeholder="Enter Your Name" class="box">
      <input type="email" name="email" required placeholder="Enter Your Email" class="box">
      <input type="number" name="number" required placeholder="Rnter Your Number" class="box">
      <textarea name="message" class="box" placeholder="Enter Your Message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>



<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>