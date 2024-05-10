let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};

const showPassword = document.querySelector
("#show-password");
const passwordField = document.querySelector
("#password");

showPassword.addEventListener("click", function(){
    this.classlist.toggle("fa-eye-slash");
    const type = passwordField.getAttribute("type")
    === "password" ? "text" : "password";
    passwordField.setAttribute("type",type);
})