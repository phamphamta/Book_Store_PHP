
<?php
if(isset($message)){
   foreach($message as $message){
      //foreach($message as $message):
   // Đây là vòng lặp foreach để lặp qua tất cả các phần tử trong mảng $message để tạo ra thông báo
//Mỗi phần tử trong mảng $message sẽ được gán vào biến $message
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';//HIện thị thông báo ấn X để tắt
   }
}
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
         <div class="share">
         <a href="https://www.facebook.com" class="fab fa-facebook-f"></a> <!-- Facebook -->
         <a href="https://www.instagram.com" class="fab fa-instagram"></a> <!-- Instagram -->
         <a href="https://www.linkedin.com" class="fab fa-linkedin"></a> <!-- LinkedIn -->
         <a href="https://www.x.com" class="fa-brands fa-x"></a> <!-- X -->
         </div>
         <p> New <a href="login.php">Login</a> | <a href="register.php">Register</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <div class="logo">
            <a href="home.php">
               <img src="uploaded_img/LOGO.png" alt="Logo"> 
            </a>
         </div>


         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
            <a href="orders.php">Orders</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>Username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
         </div>
      </div>
   </div>

</header>