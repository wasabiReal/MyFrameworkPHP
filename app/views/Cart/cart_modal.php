<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="table-responsive cart-table">
            <table class="table text-start">
                <thead>
                <tr>
                    <th scope="col"><?= __('tpl_cart_photo'); ?></th>
                    <th scope="col"><?= __('tpl_cart_product'); ?></th>
                    <th scope="col"><?= __('tpl_cart_qty'); ?></th>
                    <th scope="col"><?= __('tpl_cart_price'); ?></th>
                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td><a href="product/<?= $item['slug'] ?>"><img src="<?= PATH . $item['img'] ?>" alt=""></a>
                        </td>
                        <td><a href="product/<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td>$<?= $item['price'] ?></td>
                        <td><a href="cart/delete?id=<?= $id ?>" class="del-item" data-id="<?= $id ?>"><i class="far fa-trash-alt"></a></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="4" class="text-end"><? __('tpl_cart_total_qty') ?></td>
                        <td class="cart-qty"><?= $_SESSION['cart.qty'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end"><? __('tpl_cart_sum') ?></td>
                        <td class="cart-sum">$<?= $_SESSION['cart.sum'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h3 class="text-start"><?= __("tpl_cart_empty") ?></h3>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary ripple"
            data-bs-dismiss="modal"><?= __('tpl_cart_btn_continue'); ?></button>
    <?php if (!empty($_SESSION['cart'])): ?>
        <button type="button" class="btn btn-danger" id="cart-clear"><?= __('tpl_cart_btn_clear') ?></button>
        <button type="button" class="btn btn-primary"><?= __('tpl_cart_btn_order') ?></button>
    <?php endif; ?>
</div>