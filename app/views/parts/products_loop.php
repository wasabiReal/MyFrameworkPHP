<?php

/** @var $products array */

use wsb\App;

?>
<?php foreach ($products as $product): ?>
    <div class="col-lg-4 col-sm-6 mb-3">
        <div class="product-card">
            <div class="product-tumb">
                <a href="product/<?= $product['slug'] ?>"><img src="<?= PATH . $product['img'] ?>" alt=""></a>
            </div>
            <div class="product-details">
                <h4><a href="product/<?= $product['slug'] ?>"><?= $product['title'] ?></a></h4>
                <p><?= $product['exerpt'] ?></p>
                <div class="product-bottom-details d-flex justify-content-between">
                    <div class="product-price">
                        <?php if ($product['old_price']): ?>
                            <small>$<?= $product['old_price'] ?></small>
                        <?php endif; ?>
                        <b>$<?= $product['price'] ?></b>
                    </div>
                    <div class="product-links">
                        <a class="add-to-cart" href="cart/add?id=<?= $product['id'] ?>"
                           data-id="<?= $product['id'] ?>"><?= get_cart_icon($product['id']) ?></a>
                        <?php if (in_array($product['id'], App::$app->getProperty('wishlist'))): ?>
                            <a href="wishlist/delete?id=<?= $product['id'] ?>" data-id="<?= $product['id'] ?>"
                               class="delete-from-wishlist"><i class="fas fa-hand-holding-heart"></i></a>
                        <?php else: ?>
                            <a href="wishlist/add?id=<?= $product['id'] ?>" data-id="<?= $product['id'] ?>"
                               class="add-to-wishlist"><i class="far fa-heart"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>