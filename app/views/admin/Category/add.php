<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">

            <div class="form-group">
                <label class="required" for="parent_id">Батьківська категорія</label>
                <?php new \app\widgets\menu\Menu([
                    'cache' => 0,
                    'cacheKey' => 'admin_menu_select',
                    'class' => 'form-control',
                    'container' => 'select',
                    'attrs' => [
                        'name' => 'parent_id',
                        'id' => 'parent_id',
                        'required' => 'required',
                    ],
                    'prepend' => '<option value="0">немає</option>',
                    'tpl' => APP . '/widgets/menu/admin_select_tpl.php',
                ]) ?>
            </div>

            <div class="card card-info card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <?php foreach (\wsb\App::$app->getProperty('languages') as $k => $lang): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill" href="#<?= $k ?>">
                                    <img src="<?= PATH ?>/public/assets/img/lang/<?= $k ?>.png" alt="">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <?php foreach (\wsb\App::$app->getProperty('languages') as $k => $lang): ?>
                            <div class="tab-pane fade <?php if ($lang['base']) echo 'active show' ?>" id="<?= $k ?>">

                                <div class="form-group">
                                    <label class="required" for="title">Заголовок</label>
                                    <input type="text" name="category_desc[<?= $lang['id'] ?>][title]" class="form-control" id="title" placeholder="Заголовок" value="<?= get_field_array_value('category_desc', $lang['id'], 'title') ?>" required2>
                                </div>

                                <div class="form-group">
                                    <label for="description">Короткий опис</label>
                                    <input type="text" name="category_desc[<?= $lang['id'] ?>][description]" class="form-control" id="description" placeholder="Короткий опис" value="<?= get_field_array_value('category_desc', $lang['id'], 'description') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Ключові слова</label>
                                    <input type="text" name="category_desc[<?= $lang['id'] ?>][keywords]" class="form-control" id="keywords" placeholder="Ключові слова" value="<?= get_field_array_value('category_desc', $lang['id'], 'keywords') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Опис категорії</label>
                                    <textarea name="category_desc[<?= $lang['id'] ?>][content]" class="form-control editor" id="content" rows="3" placeholder="Опис категорії"><?= get_field_array_value('category_desc', $lang['id'], 'content') ?></textarea>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>

</div>
<!-- /.card -->
