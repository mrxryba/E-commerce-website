const toggle = document.querySelector(".toggle");
const menu = document.querySelector(".menu");

/*Toggle mobile menu*/

function toggleMenu() {
    if (menu.classList.contains("active")) {
        menu.classList.remove("active");

        // adds the menu (hamburger) icon
        toggle.querySelector("a").innerHTML = "<i class='bx bx-menu' ></i>";
    }else if (menu.classList.contains("actived")){
        menu.classList.remove("actived");
        menu.classList.add("active");
        toggle.querySelector("a").innerHTML = "<i class='bx bx-x'></i>"
    }
    else {
        menu.classList.add("active");

        //adds the close (X) icon
        toggle.querySelector("a").innerHTML = "<i class='bx bx-x'></i>"
    }
}

/*Event Listener*/
toggle.addEventListener("click", toggleMenu, false);
////////////////////////////////////////

/*User toggle mobile */
const user = document.querySelector(".user");
// const menu = document.querySelector(".menu");



function userMenu() {
    if (menu.classList.contains("actived")) {
        menu.classList.remove("actived");
    } else if (menu.classList.contains("active")) {
        menu.classList.remove("active");
        toggle.querySelector("a").innerHTML = "<i class='bx bx-menu' ></i>";
        menu.classList.add("actived");
    }else {
        menu.classList.add("actived");
    }
}
/*Event Listener*/
user.addEventListener("click", userMenu, false);
///////////////////////////



/*Activate Submenu*/
const items = document.querySelectorAll(".item");

function toggleItem() {
    if (this.classList.contains("submenu-active")) {
        this.classList.remove("submenu-active");
    } else if (menu.querySelector(".submenu-active")) {
        menu.querySelector(".submenu-active").classList.remove("submenu-active");
        this.classList.add("submenu-active");
    } else {
        this.classList.add("submenu-active");
    }
}

/*Event Listener*/

for (let item of items) {
    if (item.querySelector(".submenu")) {
        item.addEventListener("click", toggleItem, false);
        item.addEventListener("keypress", toggleItem, false);
    }
}

/*Remove from Cart */
const btnRemover = document.getElementById("removeFromCart");

btnRemover.addEventListener("click", function (){
    fetch("http://localhost:8000/hairshop/functions/removeFromCart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },

    })
        .then((response) => response.text())
        .then((res) => (document.getElementById("result").innerHTML = res));


})

/*Carousel main page*/
const slider = document.querySelector('.gallery');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', e => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', _ => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mouseup', _ => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mousemove', e => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const SCROLL_SPEED = 3;
    const walk = (x - startX) * SCROLL_SPEED;
    slider.scrollLeft = scrollLeft - walk;
});


