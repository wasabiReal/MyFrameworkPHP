<?php /** @var $this \wsb\View */ ?>

<?php $this->getPartAdmin('header'); ?>

<?php $this->getPartAdmin('sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1><?= $title ?? 'heLLo' ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $_SESSION['errors']; unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <?php echo $this->content; ?>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php $this->getPartAdmin('footer'); ?>
