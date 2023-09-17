<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="#">Ноутбуки</a></li>
            <li class="breadcrumb-item active" aria-current="page">MacBook</li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="row">

        <div class="col-md-4 order-md-2">

            <h1><?= $product['title'] ?></h1>

            <ul class="list-unstyled">
                <?php if($product['status']): ?>
                    <li><i class="fas fa-check text-success"></i> <?= __('product_view_availability') ?></li>
                    <li><i class="fas fa-hand-holding-usd"></i>
                    <span class="product-price">
                        <?php if($product['old_price']): ?>
                        <small>$ <?= $product['old_price'] ?></small>
                        <?php endif; ?>
                        $<?= $product['price'] ?></li>
                <?php endif; ?>
            </ul>

            <div id="product">
                <div class="input-group mb-3">
                    <input id="input-quantity" type="number" class="form-control" name="quantity" value="1" step="1">
                    <button class="btn btn-danger add-to-cart" type="button" data-id="<?= $product['id'] ?>"><?= __('product_view_buy') ?></button>
                </div>
            </div>

        </div>

        <div class="col-md-8 order-md-1">

            <ul class="thumbnails list-unstyled clearfix">
                <li class="thumb-main text-center"><a class="thumbnail" href="<?= PATH . $product['img'] ?>" data-effect="mfp-zoom-in"><img src="<?= PATH . $product['img'] ?>" alt="<?= $product['title'] ?>"></a></li>
                <?php if(!empty($gallery)): ?>
                <?php foreach ($gallery as $item): ?>
                <li class="thumb-additional"><a class="thumbnail" href="<?= PATH . $item['img'] ?>" data-effect="mfp-zoom-in">
                        <img src="<?= PATH . $item['img'] ?>" alt=""></a></li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <?= $product['content'] ?>


        </div>

    </div>
</div>