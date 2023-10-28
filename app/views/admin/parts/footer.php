<?php /** @var $this View */ ?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<div class="logs">
    <?php if (DEBUG) $this->getDatabaseLogs() ?>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
    const PATH = '<?= PATH ?>';
    const ADMIN = '<?= ADMIN ?>';
</script>

<!-- jQuery -->
<script src="<?= PATH ?>/public/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= PATH ?>/public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= PATH ?>/public/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= PATH ?>/public/adminlte/dist/js/demo.js"></script>
<script src="<?= PATH ?>/public/adminlte/plugins/select2/js/select2.full.js"></script>
<script src="<?= PATH ?>/public/adminlte/main.js"></script>
</body>
</html>