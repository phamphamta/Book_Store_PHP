// Lấy phần tử có lớp 'user-box' trong phần tử có lớp 'header-2' của phần tử 'header'
let userBox = document.querySelector('.header .header-2 .user-box');

// Xử lý sự kiện khi người dùng nhấp vào nút có ID 'user-btn'
document.querySelector('#user-btn').onclick = () => {
   // Thêm hoặc bỏ lớp 'active' cho phần tử 'userBox' khi nhấp vào
   userBox.classList.toggle('active');
   // Loại bỏ lớp 'active' khỏi phần tử 'navbar' khi nhấp vào
   navbar.classList.remove('active');
}

// Lấy phần tử có lớp 'navbar' trong phần tử có lớp 'header-2' của phần tử 'header'
let navbar = document.querySelector('.header .header-2 .navbar');

// Xử lý sự kiện khi người dùng nhấp vào nút có ID 'menu-btn'
document.querySelector('#menu-btn').onclick = () => {
   // Thêm hoặc bỏ lớp 'active' cho phần tử 'navbar' khi nhấp vào
   navbar.classList.toggle('active');
   // Loại bỏ lớp 'active' khỏi phần tử 'userBox' khi nhấp vào
   userBox.classList.remove('active');
}

// Xử lý sự kiện khi người dùng cuộn trang
window.onscroll = () => {
   // Loại bỏ lớp 'active' khỏi 'userBox' và 'navbar' khi cuộn trang
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   // Kiểm tra vị trí cuộn trang (scroll position)
   if (window.scrollY > 60) {
      // Nếu cuộn xuống hơn 60px, thêm lớp 'active' vào phần tử 'header-2'
      document.querySelector('.header .header-2').classList.add('active');
   } else {
      // Nếu không, loại bỏ lớp 'active' khỏi phần tử 'header-2'
      document.querySelector('.header .header-2').classList.remove('active');
   }
}
