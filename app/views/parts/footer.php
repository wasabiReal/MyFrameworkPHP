<?php

use wsb\View;
use app\widgets\page\Page;

/** @var $this View */
?>
<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_information'); ?></h4>
                    <!--                        <li><a href="#">--><?php //= __('tpl_home_link'); ?><!--</a></li>-->
                    <!--                        <li><a href="#">--><?php //= __('tpl_about_us'); ?><!--</a></li>-->
                    <!--                        <li><a href="#">-->
                    <?php //= __('tpl_payment_and_delivery'); ?><!--</a></li>-->
                    <!--                        <li><a href="#">--><?php //= __('tpl_contacts'); ?><!--</a></li>-->
                    <?php new Page([
                        'cache' => 3600 * 60,
                        'class' => 'list-unstyled',
                        'prepend' => '<li><a href="' . base_url() . '">' . ___('tpl_home_link') . '</a></li>',
                    ]) ?>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_worktime_title'); ?></h4>
                    <ul class="list-unstyled">
                        <li><?= __('tpl_worktime_address'); ?></li>
                        <li><?= __('tpl_worktime_time'); ?></li>
                        <li><?= __('tpl_worktime_desc'); ?></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_contacts'); ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567">555 123-45-67</a></li>
                        <li><a href="tel:5551234567">555 123-45-68</a></li>
                        <li><a href="tel:5551234567">555 123-45-69</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?= __('tpl_we_online'); ?></h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= __('tpl_cart_title'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-cart-content">

            </div>
        </div>
    </div>
</div>

<?php if (DEBUG) $this->getDatabaseLogs() ?>
<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>
<script> const PATH = '<?= PATH ?>';</script>
<script src="<?= PATH ?>/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?= PATH ?>/public/assets/js/sweetalert2.js"></script>
<script src="<?= PATH ?>/public/assets/js/main.js"></script>
<script src="<?= PATH ?>/public/assets/js/jquery.magnific-popup.min.js"></script>
</body>
</html>