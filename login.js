var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");

function hash() { 
    window.location.hash='#register';   //разделя една страница, на два отделни фрагмента (login от register)
}

function register(){
    // window.location.hash='#register';
    x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}
function login(){
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0px";
}

function back(){
    document.location.href="index.php";
}

