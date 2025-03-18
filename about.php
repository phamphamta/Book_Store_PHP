<?php

include 'config.php'; // Kết nối đến file cấu hình, 

session_start(); // Bắt đầu biến session.

$user_id = $_SESSION['user_id']; // Lấy ID người dùng từ biến session.

if(!isset($user_id)){ // Kiểm tra xem người dùng đã đăng nhập chưa.
   header('location:login.php'); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- Nhúng file header.php -->
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/Library.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At BookBook, we believe in the magic of reading.
            <br> Our mission is to hand-pick the best books and deliver them right to your door,
            making it easier for you to discover new stories and authors.
             We’re passionate about connecting readers with books they'll love.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>I absolutely love this bookstore! The selection is fantastic, and I always find the books I'm looking for. Fast shipping too!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>James Wilson</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>A great place for book lovers! The user interface is easy to navigate, and my orders always arrive on time. Highly recommend!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jessica Davis</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>I was impressed by the variety of genres available. I found some rare titles that I couldn't find anywhere else!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>David Brown</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Customer service is top-notch! They answered all my questions quickly, and I appreciate their personalized recommendations.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sarah Williams</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>The packaging was perfect, ensuring my books arrived in pristine condition. I will definitely be ordering again!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Michael Smith</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>This is my go-to online bookstore! Great prices, excellent quality, and a wonderful selection. I can't wait to shop again!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Emily Johnson</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>