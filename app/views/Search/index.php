<?php
/** @var $this View */
/** @var $products array */
/** @var $total int */
/** @var $pagination object */

use wfm\View;

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('search_index_title') ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?= __('search_index_title') ?></h1>

            <h4><?= __('search_index_query') . '"' . h($s) . '"' ?></h4>

            <?php if (!empty($category['content'])): ?>
                <div class="category-desc">
                    <?= $category['content'] ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php if (!empty($products)): ?>

                    <div class="pag-count col-lg-12 col-sm-12 mb-3">
                        <p><?= __('tpl_total_text') ?> <?= count($products) ?> <?= pagination_total(count($products)) ?> <?= $total ?></p>
                    </div>

                    <?php $this->getPart('products_loop', compact('products')); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($pagination->countPages > 1): ?>
                                <?= $pagination ?>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>
                    <p><?php __('search_index_empty'); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
