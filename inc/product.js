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


const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const product = urlParams.get('product')

// document.querySelector('.product-wishlist-section').addEventListener('click',createWishlistDivs);
document.addEventListener('DOMContentLoaded', function () {
    loadWishlists().then(response => {
        wishlists = response
        createWishlistDivs()
    })
});


let wishlists

function loadWishlists() {
    return new Promise(resolve => {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `inc/loadWishlists.php?product=${product}`, true);
        xhr.setRequestHeader("Content-type", "application/json");
        xhr.onload = function () {
            if (xhr.status === 200) {
                let response = (JSON.parse(this.responseText));
                resolve(response);
            }
        }
        xhr.send();
    });
}


/*
* This adds product to a Wishlist
* Reloads wishlists Json and updates checkboxes
*
* */

function addProductToWishlist(e) {
    if (e.target.matches('.product-wishlist-item') || e.target.parentNode.matches('.product-wishlist-item') || e.target.parentNode.parentNode.matches('.product-wishlist-item')) {
        let wishlistDiv = e.target.closest('.product-wishlist-item')
        let wishlistKey = wishlistDiv.getAttribute('data-value');
        let wishlistNumber = wishlists[wishlistKey].wishlistNumber;

        let xhr = new XMLHttpRequest();
        xhr.open('GET', `inc/addToWishlist.php?product=${product}&wishlistNumber=${wishlistNumber}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.productAdded === true) {
                    loadWishlists().then(r => {
                        let fill = 1;
                        wishlists = r
                        updateCheckbox(wishlistDiv, fill)
                        wishlistDiv.removeEventListener('click', addProductToWishlist);
                        addEventToWishlist();
                    });
                }
            }
        }
        xhr.send();
    }
}


function removeProductFromWishlist(e) {

    if (e.target.matches('.product-wishlist-item') || e.target.parentNode.matches('.product-wishlist-item') || e.target.parentNode.parentNode.matches('.product-wishlist-item')) {
        let wishlistDiv = e.target.closest('.product-wishlist-item')
        let wishlistKey = wishlistDiv.getAttribute('data-value');
        let wishlistNumber = wishlists[wishlistKey].wishlistNumber;

        let xhr = new XMLHttpRequest();
        xhr.open('GET', `inc/removeFromWishlist.php?product=${product}&wishlistNumber=${wishlistNumber}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.productRemoved === true) {
                    let fill = 0;
                    loadWishlists().then(r => {
                        wishlists = r
                        updateCheckbox(wishlistDiv, fill)
                        wishlistDiv.removeEventListener('click', removeProductFromWishlist);
                        addEventToWishlist();
                    });
                }
            }
        }

        xhr.send();


    }
}


/*This creates Wishlist Item Div */

function createWishlistDivs() {
    const modalBody = document.querySelector('.modal-body');
    if ((wishlists.hasOwnProperty('userNotLogged'))) {
        let addBtnDiv = document.querySelector('.product-modal-add-wishlist');
        let loginBtn = document.createElement('a');
        loginBtn.classList.add('product-login-btn');
        loginBtn.href = "login.php";
        loginBtn.innerText = "Sign in"
        addBtnDiv.innerHTML = "";
        addBtnDiv.appendChild(loginBtn)

        let wishlistItem = document.createElement('div');
        wishlistItem.classList.add('product-wishlist-item');

        let wishlistNotExist = document.createElement('span')
        wishlistNotExist.classList.add('product-wishlist-not-exist');
        wishlistNotExist.innerText = "You have to log in to use the Wishlist."
        wishlistItem.appendChild(wishlistNotExist);
        modalBody.appendChild(wishlistItem);
    } else if (wishlists[0].hasOwnProperty('wishlistNotExist')) {

        let wishlistItem = document.createElement('div');
        wishlistItem.classList.add('product-wishlist-item');

        let wishlistNotExist = document.createElement('span')
        wishlistNotExist.classList.add('product-wishlist-not-exist');
        wishlistNotExist.innerText = "You don't have a wishlist. Create a new one."
        wishlistItem.appendChild(wishlistNotExist);
        modalBody.appendChild(wishlistItem);
    } else {

        for (let i = 0; i < wishlists.length; i++) {

            let wishlistItem = document.createElement('div');
            wishlistItem.classList.add('product-wishlist-item');
            wishlistItem.setAttribute('data-value', i)


            let wishlistItemInput = document.createElement('span');
            wishlistItemInput.classList.add('material-symbols-outlined');
            wishlistItemInput.classList.add('product-wishlist-item-checkbox');
            !wishlists[i].productAdded ? wishlistItemInput.innerHTML = "check_box_outline_blank" : wishlistItemInput.innerHTML = "check_box";

            let wishlistItemTitle = document.createElement('span');
            wishlistItemTitle.classList.add('product-wishlist-item-title');
            wishlistItemTitle.innerText = wishlists[i].wishlistName;

            wishlistItem.appendChild(wishlistItemInput);
            wishlistItem.appendChild(wishlistItemTitle);
            modalBody.appendChild(wishlistItem);

        }
        addEventToWishlist();
    }
}

/*This updates WishlistItem tags after creating new Wishlist*/

function createNewWishlistDiv() {
    loadWishlists().then(r => {
        let wishlists = r;
        const modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = "";

        for (let i = 0; i < wishlists.length; i++) {

            let wishlistItem = document.createElement('div');
            wishlistItem.classList.add('product-wishlist-item');
            wishlistItem.setAttribute('data-value', i)


            let wishlistItemInput = document.createElement('span');
            wishlistItemInput.classList.add('material-symbols-outlined');
            wishlistItemInput.classList.add('product-wishlist-item-checkbox');
            !wishlists[i].productAdded ? wishlistItemInput.innerHTML = "check_box_outline_blank" : wishlistItemInput.innerHTML = "check_box";

            let wishlistItemTitle = document.createElement('span');
            wishlistItemTitle.classList.add('product-wishlist-item-title');
            wishlistItemTitle.innerText = wishlists[i].wishlistName;

            wishlistItem.appendChild(wishlistItemInput);
            wishlistItem.appendChild(wishlistItemTitle);
            modalBody.appendChild(wishlistItem);

        }
        addEventToWishlist();
    });
}


function addEventToWishlist() {
    loadWishlists().then(r => {
        wishlists = r
        let wishlistDiv = document.querySelectorAll('.product-wishlist-item');
        for (let i = 0; i < wishlists.length; i++) {
            wishlists[i].productAdded ? wishlistDiv[i].addEventListener('click', removeProductFromWishlist) : wishlistDiv[i].addEventListener('click', addProductToWishlist);
        }
    });

}


function updateCheckbox(wishlistDiv, fill) {

    let checkbox = wishlistDiv.querySelector('.product-wishlist-item-checkbox');
    fill ? checkbox.innerHTML = "check_box" : checkbox.innerHTML = "check_box_outline_blank"

}

/*Pop up wishlist form */
const wishlistDiv = document.querySelector('.product-modal-add-wishlist');
const wishlistSection = document.querySelector('.product-modal-add-wishlist-section');

const addWishlistBtnDiv = document.querySelector('.product-modal-add-wishlist');
const cancelWishlistBtn = document.querySelector('#wishlist-form-cancel-btn');


addWishlistBtnDiv.addEventListener('click', function (e) {

    if (e.target.matches('.product-modal-add-wishlist') || (e.target.matches('.product-modal-add-btn')) || (e.target.matches('#product-modal-add-btn-span')) || (e.target.matches('.product-modal-add-btn-svg')) || (e.target.matches('#product-modal-add-btn-text'))) {
        changeVisibility();
    }
});

function changeVisibility() {
    let sectionVisibility = wishlistSection.getAttribute('data-visible');
    sectionVisibility === "false" ? wishlistSection.setAttribute('data-visible', 'true') : wishlistSection.setAttribute('data-visible', 'false');
    let divVisibility = wishlistDiv.getAttribute('data-visible');
    divVisibility === "true" ? wishlistDiv.setAttribute('data-visible', 'false') : wishlistDiv.setAttribute('data-visible', 'true');
}


cancelWishlistBtn.addEventListener('click', changeVisibility);


/*Creation of new Wishlist*/

let wishlistName
const wishlistNameInput = document.querySelector('#wishlist-form-name');
const createBtn = document.querySelector('#wishlist-form-create-btn');

wishlistNameInput.addEventListener('change', getWishlistNameInput);
createBtn.addEventListener('click', createWishlist);

function getWishlistNameInput() {
    wishlistName = wishlistNameInput.value;
    // console.log(wishlistName.length)
    // let wishlistNameError;
    if (wishlistName.length <= 2) {
        let wishlistNameError = document.createElement('span');
        wishlistNameError.classList.add('wishlistNameError');
        wishlistNameError.innerText = "The minimum number of characters is 2";
        wishlistNameError.style.color = "red";
        wishlistNameInput.parentNode.insertBefore(wishlistNameError, wishlistNameInput.nextSibling);
    }
    if (wishlistName.length > 2) {
        let input = document.querySelector('.wishlistNameError')
        if (input) {
            input.remove();
        }
    }
    // if (wishlistNameError){
    //     wishlistNameError.remove();
    // }
    // console.log(wishlistName)
}


function createWishlist() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `inc/createWishlist.php`, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = (JSON.parse(this.responseText));
            createNewWishlistDiv();
            wishlistNameInput.value = "";
            changeVisibility();
        }
    }
    xhr.send(JSON.stringify(wishlistName));
}














