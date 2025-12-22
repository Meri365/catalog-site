function showMessage(){
    alert("Welcome to our world of Modern-style furniture. 👋");
    window.location.href = "page2.php"; 
}

// HOME կոճակ
document.getElementById('btnHome').addEventListener('click', function () {
  window.location.href = 'indexc.php';
});

//Page@
document.getElementById('btnPage2').addEventListener('click', function () {
  window.location.href = 'page2.php';
});

// LIVING ROOM
document.getElementById('btnLiving').addEventListener('click', function () {
  window.location.href = 'living.php';
});

// DINING ROOM
document.getElementById('btnDining').addEventListener('click', function () {
  window.location.href = 'kitchen.php';
});

// BEDROOM
document.getElementById('btnBedroom').addEventListener('click', function () {
  window.location.href = 'bedroom.php';
});

// BATHROOM
document.getElementById('btnBathroom').addEventListener('click', function () {
  window.location.href = 'bathroom.php';
});
// LOGIN
document.getElementById('btnLogin').addEventListener('click', function () {
  window.location.href = '/login/login.php';
});
// REGISTER
document.getElementById('register').addEventListener('click', function () {
  window.location.href = '/login/register.php';
});
