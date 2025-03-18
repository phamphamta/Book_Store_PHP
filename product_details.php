<?php
include 'config.php';
session_start();

if(isset($_GET['product_id'])){
   $product_id = $_GET['product_id'];
   $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');

   if(mysqli_num_rows($select_product) > 0){
      $product = mysqli_fetch_assoc($select_product);
   } else {
      echo 'Product not found!';
      exit();
   }
} else {
   echo 'No product selected!';
   exit();
}

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
} else {
   header('location:login.php'); // Chuyển hướng nếu người dùng chưa đăng nhập
   exit();
}

if(isset($_POST['add_to_cart'])){
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added To Cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product Added To Cart!';
   }
}

if(isset($_POST['buy_now'])){
   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already Added To Cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product Added To Cart!';
   }

   header('Location: cart.php'); 
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Details</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/product-details.css"> <!-- Thêm liên kết đến tệp CSS mới -->
</head>
<body>

<?php include 'header.php'; ?>

<div class="heading">
   <h3>Product Details</h3>
   <p> <a href="home.php">Home</a> / Product Details </p>
</div>

<section class="product-details">
   <div class="box">
      <div class="product-image">
         <img src="uploaded_img/<?php echo $product['image']; ?>" alt="Product Image">
      </div>
      <div class="product-info">
         <h2><?php echo $product['name']; ?></h2>
         <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
         <span><?php echo number_format($product['price'], 0, ',', '.') . ' VNĐ'; ?></span>
         <form action="" method="post" class="quantity-form">
            <div class="quantity">
               <input type="number" min="1" value="1" id="quantity" name="product_quantity">
            </div>
            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            <input type="submit" value="buy now" name="buy_now" class="btn">
         </form>
      </div>
   </div>
</section>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '<div class="message">'.$msg.'</div>';
   }
}
?>

<?php include 'footer.php'; ?>


<script src="js/script.js"></script>


</body>
</html>
