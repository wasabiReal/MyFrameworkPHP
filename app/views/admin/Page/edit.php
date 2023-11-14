<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post">
            <div class="card card-info card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <?php foreach (\wsb\App::$app->getProperty('languages') as $k => $lang): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($lang['base']) echo 'active' ?>" data-toggle="pill"
                                   href="#<?= $k ?>">
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
                                    <label class="required" for="title">Позначення сторінки</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][title]"
                                           class="form-control" id="title" placeholder="Позначення сторінки"
                                           value="<?= h($page[$lang['id']]['title']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="description">Мета-опис</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][description]"
                                           class="form-control" id="description" placeholder="Мета-опис"
                                           value="<?= h($page[$lang['id']]['description']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="keywords">Ключові слова</label>
                                    <input type="text" name="page_description[<?= $lang['id'] ?>][keywords]"
                                           class="form-control" id="keywords" placeholder="Ключові слова"
                                           value="<?= h($page[$lang['id']]['keywords']) ?>">
                                </div>

                                <div class="form-group">
                                    <label for="content">Контент сторінки</label>
                                    <textarea name="page_description[<?= $lang['id'] ?>][content]"
                                              class="form-control editor" id="content" rows="3"
                                              placeholder="Контент сторінки"><?= h($page[$lang['id']]['content']) ?></textarea>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>

        </form>

    </div>

</div>
<!-- /.card -->

<script>
    window.editors = {};
    document.querySelectorAll('.editor').forEach((node, index) => {
        ClassicEditor
            .create(node, {
                ckfinder: {
                    uploadUrl: '<?= PATH ?>/adminlte/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: ['ckfinder', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'insertTable', 'blockQuote'],
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight'],
                    styles: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight'
                    ]
                }
            })
            .then(newEditor => {
                window.editors[index] = newEditor
            })
            .catch(error => {
                console.error(error);
            });
    });

</script>