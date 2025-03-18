<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){
   //Lấy dữ liệu từ form:
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   //Cập nhật giá trị cột payment_status trong bảng orders dựa trên ID đơn hàng.
   $message[] = 'Payment Status Has Been Updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete']; //ID của đơn hàng cần xóa, được lấy từ tham số delete trên URL.
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   //Xóa bản ghi trong bảng orders có ID khớp với $delete_id.

   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom admin CSS file link -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/tooltip_style.css"> <!-- Link đến tệp CSS tooltip -->

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">
   <h1 class="title">Placed Orders</h1>
   <div class="box-container">
      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
    <p> User Id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
    <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
    <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
    <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>

    <!-- Tooltip for additional information -->
    <div class="tooltip">
        <span class="learn-more">Watch More</span>
        <div class="tooltiptext">
            <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
            <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
            <p>Total Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
            <p>Total Price: <span><?php echo number_format($fetch_orders['total_price'], 0, ',', '.') . '₫'; ?></span></p>

            <p>Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
        </div>
    </div>
    
    <form action="" method="post">
        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
        <select name="update_payment">
            <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
        </select>
        <input type="submit" value="update" name="update_order" class="option-btn">
        <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
    </form>
</div>

      <?php
         }
      }else{
         echo '<p class="empty">No Orders Placed Yet!</p>';
      }
      ?>
   </div>
</section>

<script src="js/admin_script.js"></script>

</body>
</html>
