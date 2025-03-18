<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){ //Kiểm tra xem biểu mẫu đã gửi yêu cầu cập nhật giỏ hàng chưa.
   $cart_id = $_POST['cart_id']; //Lấy ID của sản phẩm trong giỏ hàng từ dữ liệu biểu mẫu ($_POST).
   $cart_quantity = $_POST['cart_quantity'];
   //Lấy số lượng sản phẩm mới từ dữ liệu biểu mẫu ($_POST)
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   //Thực thi câu lệnh SQL để cập nhật số lượng (quantity)
   $message[] = 'Cart Quantity Updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Shopping cart</h3>
   <p> <a href="home.php">Home</a> / Cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">Products added</h1>

   <div class="box-container">
   <?php
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
   ?>
   <div class="box">
      <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
      <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_cart['name']; ?></div>
      <div class="price"><?php echo number_format($fetch_cart['price'], 0, ',', '.') . '₫'; ?></div>
      <form action="" method="post">
         <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
         <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
         <input type="submit" name="update_cart" value="update" class="option-btn">
      </form>
      <div class="sub-total"> Sub Total : <span><?php echo number_format($sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']), 0, ',', '.') . '₫'; ?></span> </div>
   </div>
   <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<p class="empty">Your Cart Is Empty</p>';
      }
   ?>
</div>


   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>Grand Total : <span><?php echo number_format($grand_total, 0, ',', '.') . '₫'; ?></span></p>
      

         <div class="flex" style="display: flex; justify-content: center; gap: 2rem;">
            <a href="shop.php" class="btn" style="font-size: 1.6rem;  text-align: center; ">
             continue shopping
            </a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" style="font-size: 1.6rem;  text-align: center; : <?php echo ($grand_total > 1) ? '1' : '0.5'; ?>;">
               proceed to checkout
            </a>
         </div>
   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>