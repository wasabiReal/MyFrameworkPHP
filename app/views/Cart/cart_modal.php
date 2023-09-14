<div class="modal-body">
    <?php if(!empty($_SESSION['cart'])): ?>
    <div class="table-responsive cart-table">
        <table class="table text-start">
            <thead>
            <tr>
                <th scope="col"><?= __('tpl_cart_photo'); ?></th>
                <th scope="col"><?= __('tpl_cart_product'); ?></th>
                <th scope="col"><?= __('tpl_cart_qty'); ?></th>
                <th scope="col"><?= __('tpl_cart_price'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <td>
                    <a href="product/<?= $item['slug'] ?>"><img src="<?= PATH . $item['slug'] ?>" alt=""></a>
                </td>
                <td><a href="product/<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                <td><?= $item['qty'] ?></td>
                <td><?= $item['price'] ?></td>
                <?php endforeach; ?>
            </tr>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <h3 class = "text-start"><?= __("tpl_cart_empty") ?></h3>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary ripple" data-bs-dismiss="modal"><?= __('tpl_cart_btn_continue'); ?></button>
    <?php if(!empty($_SESSION['cart'])): ?>
    <button type="button" class="btn btn-danger"><?= __('tpl_cart_btn_clear') ?></button>
    <button type="button" class="btn btn-primary"><?= __('tpl_cart_btn_order') ?></button>
    <?php endif; ?>
</div>