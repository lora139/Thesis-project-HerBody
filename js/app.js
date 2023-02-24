window.addEventListener('scroll',function(){
    const header = document.querySelector('header');
    header.classList.toggle("sticky",window.scrollY > 0);
});

function toggleMenu(){
    const menuToggle = document.querySelector('.menuToggle');
    const navigation = document.querySelector('.navigation');
    menuToggle.classList.toggle('active');
    navigation.classList.toggle('active');
}

/* black magic slider thing :> */

var slider_offset = 1;
slider_refresh(slider_offset);

function slider_shift(n) {
    slider_refresh(slider_offset += n);
}

function slider_refresh(n) {
    var i;
    var x = document.getElementsByClassName("triple-box");
    if (n > x.length) slider_offset = 1;
    if (n < 1) slider_offset = x.length
    for (i = 0; i < x.length; ++i) x[i].style.display = "none";
    x[slider_offset - 1].style.display = "flex";
}

function back(){
    document.location.href="/index.php";
}