const toggle = document.querySelector(".toggle");
const menu = document.querySelector(".menu");

/*Toggle mobile menu*/

function toggleMenu() {
    if (menu.classList.contains("active")) {
        menu.classList.remove("active");

        // adds the menu (hamburger) icon
        toggle.querySelector("a").innerHTML = "<i class='bx bx-menu' ></i>";
    } else if (menu.classList.contains("actived")) {
        menu.classList.remove("actived");
        menu.classList.add("active");
        toggle.querySelector("a").innerHTML = "<i class='bx bx-x'></i>"
    } else {
        menu.classList.add("active");

        //adds the close (X) icon
        toggle.querySelector("a").innerHTML = "<i class='bx bx-x'></i>"
    }
}

/*Event Listener*/
toggle.addEventListener("click", toggleMenu, false);

/*User toggle mobile */
const user = document.querySelector(".user");



function userMenu() {
    if (menu.classList.contains("actived")) {
        menu.classList.remove("actived");
    } else if (menu.classList.contains("active")) {
        menu.classList.remove("active");
        toggle.querySelector("a").innerHTML = "<i class='bx bx-menu' ></i>";
        menu.classList.add("actived");
    } else {
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

/*Add to Cart & Product Qty */
const addToCartBtn = document.querySelector('.product-add-to-cart');
addToCartBtn.addEventListener('click', addToCart);

function addToCart() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `inc/addToCart.php?product=${productId}&qty=${productQty}`, true);
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = JSON.parse(this.responseText);
            if (response.error) {
                console.log(response);
            } else {
                document.querySelector('.icon-zero').innerHTML = response.cartQty;
            }
        }
    }
    xhr.send();
}




// /*Get qty picked from user at product.php */

const qtyDiv = document.querySelector('.product-qty-section');
const qtySelect = document.querySelector('.product-qty');
qtySelect.addEventListener('change', getProductQty);

function getProductQty() {
    productQty = document.querySelector('.product-qty').value;
    if (productQty === "9+") {
        qtySelect.classList.add('hidden');
        let qtyInput = document.createElement('input');
        qtyInput.maxLength = 3;
        qtyInput.classList.add('product-qty-input')
        qtyDiv.appendChild(qtyInput);
        qtyInput.focus();
        qtyInput.addEventListener('change', getInputValue);
    }
}

// /*Create and get Qty input from user */
function getInputValue() {
    let inputVal = document.querySelector('.product-qty-input').value;
    let input = document.querySelector('.product-qty-input');
    if (inputVal < 9) {
        productQty = inputVal;
        qtySelect.value = inputVal;
        qtySelect.classList.remove('hidden');
        input.remove();
    }
    productQty = inputVal;
}
