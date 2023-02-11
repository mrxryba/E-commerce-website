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

/*             Cart     */


function cartItemsViewer () {

}

// function loadCartItems () {
//     return new Promise(resolve => {
//         let xhr = new XMLHttpRequest();
//         xhr.open('GET', `inc/loadCart.php`, true);
//         xhr.setRequestHeader("Content-type", "application/json");
//         xhr.onload = function () {
//             if (xhr.status === 200) {
//                 let response = (JSON.parse(this.responseText));
//                 resolve(response);
//
//
//                 // if (response.hasOwnProperty('cartEmpty')){
//                 //     //cart is empty
//                 // }else {
//                 //     cartItems = response;
//                 // }
//             }
//         }
//         xhr.send();
//     });
// }

//
//












const removeFromCartBtn = document.querySelectorAll('.remove-from-cart-link');

/*Load CartItems Qty inserted to the cart at cart.php*/

function loadProductQty() {
    console.log(cartItems);
    // console.log(cartItemSections)
    for (let i = 0; i < cartItems.length; i++) {
        if (cartItems[i].productQty > 8) {
            let qtyInput = document.createElement('input');
            qtyInput.maxLength = 3;
            qtyInput.classList.add('product-qty-input');
            qtyInput.value = cartItems[i].productQty;
            cartItemSections[i].parentNode.appendChild(qtyInput);
            cartItemSections[i].classList.add('hidden');
            qtyInput.addEventListener('change', function (event) {
                getInputValue(event, cartItemSections[i]);
            });
        } else {
            cartItemSections[i].value = cartItems[i].productQty;
            // console.log(cartItemSections[i].value)
        //
        }
        cartItemSections[i].addEventListener('change', getProductQty);
    }
}

document.addEventListener('DOMContentLoaded', loadProductQty);
document.addEventListener('DOMContentLoaded', addFunctionsToRemoveBtn);
document.addEventListener('DOMContentLoaded', addEventToRemoveAllBtn);


function addEventToRemoveAllBtn() {
    let btn = document.querySelector('#removeAllCartItems');
    btn.addEventListener('click', removeAllFromCart);
}

function addFunctionsToRemoveBtn() {
    for (let i = 0; i < cartItems.length; i++) {
        removeFromCartBtn[i].addEventListener('click', removeFromCart);
    }
}


function getProductQty(e) {
    // console.log(e)
    let selectTag = e.target;
    let selectedProductId = e.target.getAttribute('data-value');
    let selectedProductQty = e.target.value;
    if (selectedProductQty === "9+") {
        // console.log("9+")
        e.target.classList.add('hidden');
        let qtyInput = document.createElement('input');
        qtyInput.maxLength = 3;
        qtyInput.type = "number";
        qtyInput.min = 1;
        qtyInput.max = 999;
        qtyInput.classList.add('product-qty-input')
        e.target.parentNode.appendChild(qtyInput);
        qtyInput.focus();
        qtyInput.addEventListener('change', function (event) {
            getInputValue(event, selectTag);

        });
    } else {
        changeCartItemsJson(selectedProductId, selectedProductQty);
        changeQtyInCart(cartItems);
    }

}


function changeCartItemsJson(selectedProductId, selectedProductQty) {
    for (let i = 0; i < cartItems.length; i++) {
        if (cartItems[i].productId === parseInt(selectedProductId)) {
            cartItems[i].productQty = parseInt(selectedProductQty);
            console.log(cartItems);
            break;
        }
    }
}


/*Create and get Qty input from user */
function getInputValue(e, selectTag) {
    // console.log(selectTag)
    let selectedProductId = selectTag.getAttribute('data-value');
    let inputVal = e.target.value;
    let input = e.target;
    // console.log(inputVal)
    // console.log(inputVal.replace(/[^0-9]/gi, ""));
    if (inputVal < 1) {
        inputVal = 1;
    }
    if (inputVal < 9) {
        selectTag.classList.remove('hidden');
        selectTag.value = inputVal;
        // console.log(selectTag.value)
        input.remove();
    }
    changeCartItemsJson(selectedProductId, inputVal);
    changeQtyInCart(cartItems);
}

// let e;
function changeQtyInCart(cartItems) {
    // loadCartItems().then(response => {
    //     e = response
    // })
    // console.log(cartItems)
    // console.log(e)
    let xhr = new XMLHttpRequest();
    xhr.open('POST', `inc/changeQtyInCart.php`, true);
    xhr.setRequestHeader("Content-type", "application/json");
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = (JSON.parse(this.responseText));
            console.log(response)
            if (response.error) {
                // console.log(response);
            } else {
                document.querySelector('.icon-zero').innerHTML = response.cartQty;
                document.querySelector('#cart-heading-qty').innerHTML = response.cartQty;
                document.querySelector('#cart-total').innerHTML = response.cartTotal;
                let currency = document.createElement('span');
                currency.innerText = " zł";
                document.querySelector('#cart-total').appendChild(currency);
            }
        }
    }


    xhr.send(JSON.stringify(cartItems));
}

// Remove product from CartItems
// function removeFromCartItems(selectedProductId) {
//     for (let i = 0; i < cartItems.length; i++) {
//         if (cartItems[i].productId === parseInt(selectedProductId)) {
//             delete cartItems[i]
//             console.log(cartItems);
//             break;
//         }
//     }
// }

//Remove product from Cart

function removeFromCart(e) {

    // console.log(e.target)
    let selectedProductId = e.target.closest('.cart-item').querySelector('.product-qty').getAttribute('data-value');
    // console.log(selectedProductId)
    for (let i = 0; i < cartItems.length; i++) {
        if (cartItems[i].productId === parseInt(selectedProductId)) {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', `inc/removeFromCart.php?product=${selectedProductId}`, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    let response = (JSON.parse(this.responseText));
                    console.log(response);
                    if (response.hasOwnProperty('cartEmpty')) {
                        document.querySelector('.icon-zero').innerHTML = 0;
                        document.querySelector('#cart-heading-qty').innerHTML = 0;
                        document.querySelector('#cart-total').innerHTML = 0;
                        let currency = document.createElement('span');
                        currency.innerText = " zł";
                        document.querySelector('#cart-total').appendChild(currency);
                        let cartItem = e.target.closest('.cart-item');
                        cartItem.remove();
                    } else {
                        response = response[0]
                        document.querySelector('.icon-zero').innerHTML = response.cartQty;
                        document.querySelector('#cart-heading-qty').innerHTML = response.cartQty;
                        document.querySelector('#cart-total').innerHTML = response.cartTotal;
                        let currency = document.createElement('span');
                        currency.innerText = " zł";
                        document.querySelector('#cart-total').appendChild(currency);
                        let cartItem = e.target.closest('.cart-item');
                        cartItem.remove();
                    }


                    // removeFromCartItems(selectedProductId);
                    // loadCartItems().then(response => {
                    //     cartItems = response
                    // })
                }
            }
            xhr.send();

        }
    }
}


/*Remove all products from Cart*/

function removeAllFromCart() {

    let xhr = new XMLHttpRequest();
    xhr.open('GET', `inc/removeAllFromCart.php?product=all`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            let response = (JSON.parse(this.responseText));
            // console.log(response)
            if (response.hasOwnProperty('cartEmpty')) {
                document.querySelector('.icon-zero').innerHTML = 0;
                document.querySelector('#cart-heading-qty').innerHTML = 0;
                document.querySelector('#cart-total').innerHTML = 0;
                let currency = document.createElement('span');
                currency.innerText = " zł";
                document.querySelector('#cart-total').appendChild(currency);
                for (let i = 0; i < cartItemSections.length; i++) {
                    cartItemSections[i].closest('.cart-item').remove();
                }
                // console.log(cartItems)

            }
            // loadCartItems().then(response => {
            //     cartItems = response
            // })
        }
    }
    xhr.send();
}

