<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
};
//Khởi tạo phiên làm việc với
//kiểm tra xem quản trị viên đã đăng nhập hay chưa
if(isset($_POST['add_product'])){
   //Kiểm tra xem người dùng có nhấn nút thêm sản phẩm hay không
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   //Kiểm tra xem sản phẩm với tên đã nhập có tồn tại trong cơ sở dữ liệu hay chưa.
   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');
   //Nếu tên sản phẩm đã tồn tại, thông báo lỗi được hiển thị. 
   //Nếu chưa, thực hiện thêm sản phẩm vào cơ sở dữ liệu.
   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'Product Name Already Added';
   } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, description, image) VALUES('$name', '$price', '$description', '$image')") or die('query failed');
// Kiểm tra kích thước hình ảnh (không quá 2MB)
      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'Image Size Is Too Large';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Product Added Successfully!';
         }
      } else {
         $message[] = 'Product Could Not Be Added!';
      }
   }
}


// Truy vấn cơ sở dữ liệu để lấy hình ảnh của sản phẩm cần xóa, 
//sau đó xóa tệp hình ảnh và xóa sản phẩm khỏi cơ sở dữ liệu.

if(isset($_GET['delete'])){
   //Điều kiện isset($_GET['delete']) kiểm tra xem có tham số delete trong URL không. 
   //Nếu có, mã sẽ thực hiện các bước tiếp theo để xóa sản phẩm.
   $delete_id = $_GET['delete'];
   //tham số delete từ URL và gán cho biến $delete_id. Đây chính là ID của sản phẩm cần xóa.
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}



//Nếu người dùng nhấn nút "Cập nhật sản phẩm", lấy các thông tin cần thiết như ID sản phẩm, tên, giá và mô tả.

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_price = $_POST['update_price'];
   $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);


//Cập nhật thông tin sản phẩm trong cơ sở dữ liệu.
   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', description = '$update_description' WHERE id = '$update_p_id'") or die('query failed');


   //Lấy thông tin tệp hình ảnh mới (nếu có) và đường dẫn tệp cũ.
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   //Nếu người dùng chọn hình ảnh mới, kiểm tra kích thước và tải lên. Sau khi tải xong, xóa tệp hình ảnh cũ.
   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image File Size Is Too Large';
      } else {
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom admin CSS file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- Product CRUD section starts -->
<section class="add-products">
   <h1 class="title">Shop Products</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Product</h3>
      <input type="text" name="name" class="box" placeholder="Enter Product Name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter Product Price" required>
      <textarea name="description" class="box" required placeholder="Enter Product Description" rows="5" style="resize: vertical;"></textarea>
      <input type="file" name="image" id="image" accept="image/jpg, image/jpeg, image/png" class="box" required style="display: none;">
      <button type="button" class="box" onclick="document.getElementById('image').click();">Choose File</button>
      <input type="submit" value="Add Product" name="add_product" class="btn">
   </form>
</section>
<!-- Product CRUD section ends -->

<!-- Show products -->
<section class="show-products">
   <div class="box-container">
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price"><?php echo number_format($fetch_products['price'], 0, ',', '.') . ' VNĐ'; ?></div>
         
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>
</section>

<section class="edit-product-form">
<?php
   if(isset($_GET['update'])){
      $update_id = $_GET['update'];  // Lấy ID sản phẩm cần cập nhật từ URL, nếu có
      $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
      if(mysqli_num_rows($update_query) > 0){  // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
         while($fetch_update = mysqli_fetch_assoc($update_query)){  // Lặp qua các kết quả tìm được
?>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter Product Name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter Product Price">
      <textarea name="update_description" class="box" required placeholder="Enter Product Description" rows="5" style="resize: vertical;"><?php echo $fetch_update['description']; ?></textarea>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="Update" name="update_product" class="btn">
      <input type="reset" value="Cancel" id="close-update" class="option-btn">
   </form>
   <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }

      //Nếu không có tham số update trong URL, 
      //phần form chỉnh sửa sản phẩm sẽ bị ẩn bằng cách thay đổi thuộc tính display của 
      //.edit-product-form thành none.
   ?>
</section>

<script src="js/admin_script.js"></script>
</body>
</html>
