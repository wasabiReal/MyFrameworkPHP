<?php
/** @var $this \wfm\View */
/** @var $category array */
/** @var $products array */
/** @var $total int */
/** @var $pagination object */
/** @var $breadcrumbs string */
?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs ?>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title"><?= $category['title'] ?></h3>

            <?php if (!empty($category['content'])): ?>
                <div class="category-desc">
                    <?= $category['content'] ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($products) && count($products) > 1): ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="input-sort"><?= __('category_view_sort')?></label>
                        <select class="form-select" id="input-sort">
                            <option selected=""><?= __('category_view_sort_by_default') ?></option>
                            <option value="sort=title_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo 'selected' ?>><?= __('category_view_sort_title_asc') ?></option>
                            <option value="sort=title_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_desc') echo 'selected' ?>><?= __('category_view_sort_title_desc') ?></option>
                            <option value="sort=title_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo 'selected' ?>><?= __('category_view_sort_price_asc') ?></option>
                            <option value="sort=price_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo 'selected' ?>><?= __('category_view_sort_price_desc') ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <div class="row">
                <?php if (!empty($products)): ?>

                    <div class="pag-count">
                        <p><?= __('tpl_total_text') ?> <?= count($products) ?> <?= pagination_total(count($products)) ?> <?= $total ?></p>
                    </div>

                    <?php $this->getPart('products_loop', compact('products')); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if($pagination->countPages > 1): ?>
                                <?= $pagination ?>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else: ?>
                    <p><?php __('category_view_no_products'); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
