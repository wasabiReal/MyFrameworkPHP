<!-- Default box -->
<div class="card">

    <div class="card-body">


        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Позначення</th>
                <th>Опис</th>
                <td width="50"><i class="far fa-trash-alt"></i></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    Кеш категорій
                </td>
                <td>
                    Меню категорій на сайті. Кешується на 1 годину.
                </td>
                <td width="50">
                    <a class="btn btn-danger btn-sm delete"
                       href="<?= ADMIN ?>/cache/delete?cache=category">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    Кеш сторінок
                </td>
                <td>
                    Меню сторінок у футері. Кешується на 1 годину.
                </td>
                <td width="50">
                    <a class="btn btn-danger btn-sm delete"
                       href="<?= ADMIN ?>/cache/delete?cache=page">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
<!-- /.card -->
