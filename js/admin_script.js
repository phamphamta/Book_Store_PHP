

// Lấy phần tử có lớp 'navbar' trong phần tử có lớp 'header'
let navbar = document.querySelector('.header .navbar');

// Lấy phần tử có lớp 'account-box' trong phần tử có lớp 'header'
let accountBox = document.querySelector('.header .account-box');

// Xử lý sự kiện khi người dùng nhấp vào nút có ID 'menu-btn'
document.querySelector('#menu-btn').onclick = () => {
   // Thêm hoặc bỏ lớp 'active' cho phần tử 'navbar' khi nhấp vào
   navbar.classList.toggle('active');
   // Loại bỏ lớp 'active' khỏi phần tử 'accountBox' khi nhấp vào
   accountBox.classList.remove('active');
}

// Xử lý sự kiện khi người dùng nhấp vào nút có ID 'user-btn'
document.querySelector('#user-btn').onclick = () => {
   // Thêm hoặc bỏ lớp 'active' cho phần tử 'accountBox' khi nhấp vào
   accountBox.classList.toggle('active');
   // Loại bỏ lớp 'active' khỏi phần tử 'navbar' khi nhấp vào
   navbar.classList.remove('active');
}

// Xử lý sự kiện khi người dùng cuộn trang
window.onscroll = () => {
   // Loại bỏ lớp 'active' khỏi 'navbar' và 'accountBox' khi cuộn trang
   navbar.classList.remove('active');
   accountBox.classList.remove('active');
}

// Xử lý sự kiện khi người dùng nhấp vào nút có ID 'close-update'
document.querySelector('#close-update').onclick = () => {
   // Ẩn form chỉnh sửa sản phẩm khi nhấp vào nút 'close-update'
   document.querySelector('.edit-product-form').style.display = 'none';
   // Chuyển hướng người dùng về trang 'admin_products.php'
   window.location.href = 'admin_products.php';
}
