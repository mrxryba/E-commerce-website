<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
include_once "./phpHeader.php";
include_once "./header.php";
?>

<?php if ($_GET['product']):
    $productContr = new ProductContr();
    $productId = $_GET['product'];
    $productContr->checkIfProductExists($productId);
    $product = new Product($_GET['product']);

    if ($isLogged) {
        $wishlistContr = new WishlistContr();
        $wishlists = $wishlistContr->getWishlist($user->getId());
        $isAdded = 0;
        $wishId = array();
        foreach ($wishlists as $item) {
            $wishlist = new Wishlist($item['wishlist_id']);
            if ($wishlist->findWishlistItem($product->getId())) {
                $isAdded += 1;
                $wishId[] = $wishlist->getWishlistNumber();
            }
        }

    }
    ?>
    <div class="product-wrapper">


        <div class="product-image-container">
            <img class="product-image" src="<?php echo $product->getImage(); ?>"
                 alt="<?php echo $product->getTitle(); ?>">
        </div>
        <div class="product-wishlist-section">
            <button type="button" class="btn btn-primary product-wishlist-button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                <span class="material-symbols-outlined" id="product-wishlist-add-button">favorite</span>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title fs-5" id="exampleModalLabel">Save to Wishlist</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div data-visible="true" class="modal-footer product-modal-add-wishlist">
                            <button class="product-modal-add-btn">
                                <span id="product-modal-add-btn-span"><svg class="product-modal-add-btn-svg"
                                           xmlns="http://www.w3.org/2000/svg"
                                           viewBox="0 0 24 24"><path d="M12 4.5a.5.5 0 0 1 .5.5v6.5H19a.5.5 0 1 1 0 1h-6.5V19a.5.5 0 1 1-1 0v-6.5H5a.5.5 0 1 1 0-1h6.5V5a.5.5 0 0 1 .5-.5z"></path></svg></span>
                                <span id="product-modal-add-btn-text">Add new Wishlist</span>
                            </button>
                        </div>
                        <div data-visible="false" class="product-modal-add-wishlist-section">
                            <form>
                                <input type="text" id="wishlist-form-name" placeholder="Wishlist name">
                                <div class="wishlist-form-btn">
                                    <button type="button" id="wishlist-form-cancel-btn">Cancel</button>
                                    <button type="button" id="wishlist-form-create-btn">Create</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <h1><?php echo $product->getTitle(); ?></h1>
        <div class="product-info">
            <div class="product-price"><span><?php echo $product->getPrice(); ?></span><span>zł</span></div>

            <div class="product-qty-add-btn-container">
                <div class="product-qty-section">
                    <select class="product-qty">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9+">9+</option>
                    </select>
                </div>
                <button class="product-add-to-cart">Add to cart</button>
            </div>
            <div class="product-info-table">
                <div class="product-available">Available <span><?php echo $product->getAvailableQuantity(); ?></span>
                    <span>pieces</span></div>
                <div class="product-shipping">Free shipping</div>
            </div>
        </div>
        <div class="product-spec">Mini specs</div>
        <div class="product-desc">Desc</div>
        <div class="product-reviews">Reviews</div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    let productId = <?php echo $product->getId(); ?>;
    let productQty = document.querySelector('.product-qty').value;
</script>
<script src="inc/product.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>