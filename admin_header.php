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
//Đoạn mã PHP này hiển thị các thông báo (messages) cho người dùng, với khả năng đóng (xóa) 
//từng thông báo bằng cách nhấn vào biểu tượng "X". Dưới đây là giải thích chi tiết:
?>


<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">
         <img src="uploaded_img/LOGO.png" alt="Admin Logo"></a>
         
      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <a href="admin_users.php">Users</a>
         <a href="admin_contacts.php">Messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Logout</a>
         <div>New <a href="login.php">Login</a> | <a href="register.php">Register</a></div>
      </div>

   </div>

</header>