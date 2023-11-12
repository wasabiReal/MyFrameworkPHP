<!-- Default box -->
<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table text-start table-bordered">
                <thead>
                <tr>
                    <th scope="col">Позначення</th>
                    <th scope="col">Ціна</th>
                    <th scope="col">Кількість</th>
                    <th scope="col">Сума</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($order as $item): ?>
                    <tr>
                        <td><a href="product/<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                        <td>$<?= $item['price'] ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td>$<?= $item['sum'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box">
            <h3 class="box-title">Деталі замовлення</h3>
            <div class="box-content">
                <div class="table-responsive">
                    <table class="table text-start table-striped">
                        <tr>
                            <td>Номер замовлення</td>
                            <td><?= $order[0]['order_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Статус</td>
                            <td><?= $order[0]['status'] ? '<b>Завершений</b>' : '<b>Новий</b>' ?></td>
                        </tr>
                        <tr>
                            <td>Створено</td>
                            <td><i><?= $order[0]['created_at'] ?></i></td>
                        </tr>
                        <tr>
                            <td>Оновлено</td>
                            <td><i><?= $order[0]['updated_at'] ?></i></td>
                        </tr>
                        <tr>
                            <td>Примітка</td>
                            <td><i><?= $order[0]['note'] ?></i></td>
                        </tr>
                        <tr>
                            <td>Кінцева сума</td>
                            <td><b>$<?= $order[0]['total'] ?></b></td>
                        </tr>

                    </table>
                </div>
            </div>

        </div>

        <?php if (!$order[0]['status']): ?>
            <a href="<?= ADMIN ?>/order/edit?id=<?= $order[0]['order_id'] ?>&status=1" class="btn btn-success btn-flat">Змінити статус на Завершений</a>
        <?php else: ?>
            <a href="<?= ADMIN ?>/order/edit?id=<?= $order[0]['order_id'] ?>&status=0" class="btn btn-danger btn-flat">Змінити статус на Новий</a>
        <?php endif; ?>

    </div>
</div>
<!-- /.card -->
