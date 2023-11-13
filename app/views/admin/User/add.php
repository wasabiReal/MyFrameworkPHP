<!-- Default box -->
<div class="card">

    <div class="card-body">

        <form action="" method="post" class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= get_field_value('email') ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="name">Ім'я</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= get_field_value('name') ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="required" for="address">Адреса</label>
                    <input type="text" name="address" class="form-control" id="address" value="<?= get_field_value('address') ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="required" for="role">Роль</label>
                    <select name="role" id="role" class="form-control">
                        <option value="user">Користувач</option>
                        <option value="admin">Адміністратор</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary">Зберегти</button>
            </div>

        </form>

        <?php
        if (isset($_SESSION['form_data'])) {
            unset($_SESSION['form_data']);
        }
        ?>

    </div>


</div>
<!-- /.card -->
