<?php

include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}



if(isset($_POST['add_to_cart'])){
   // Nhận thông tin sản phẩm từ biểu mẫu (POST)
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added To Cart!';
   } else {
      // Thêm sản phẩm vào giỏ hàng
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product Added To Cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- sau khi thêm liên kết này, bạn có thể sử dụng biểu tượng giỏ hàng -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p>Books You Love, Delivered to You.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               //Hàm này trả về mỗi bản ghi sản phẩm dưới dạng một mảng kết hợp, 
               //với các cột trong cơ sở dữ liệu (như name, price, image, v.v.) là các khóa của mảng.
               //Câu truy vấn SQL này lấy ra 6 sản phẩm đầu tiên từ bảng products 
      ?>
      
     <form action="" method="post" class="box">

      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <!-- //Hiển thị hình ảnh sản phẩm. Đường dẫn ảnh lấy từ trường image của sản phẩm trong cơ sở dữ liệu, -->
      <!-- // được kết hợp với thư mục uploaded_img/ để truy cập ảnh sản phẩm. -->
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price"><?php echo number_format($fetch_products['price'], 0, ',', '.') . '₫'; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      <a href="product_details.php?product_id=<?php echo $fetch_products['id']; ?>" class="btn">View Details</a>

     </form>
     
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      //Nếu không có sản phẩm nào được trả về từ câu truy vấn
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/Library.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>At BookBook, we believe in the magic of reading.
            <br> Our mission is to hand-pick the best books and deliver them right to your door,
            making it easier for you to discover new stories and authors.
             We’re passionate about connecting readers with books they'll love.</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>We're here to help! Reach out to us for any inquiries or assistance, and we'll get back to you as soon as possible.</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>


<?php include 'footer.php'; ?>
<script src="js/script.js"></script>

</body>
</html>