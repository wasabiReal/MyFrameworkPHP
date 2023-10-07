<?php

use wsb\View;

/** @var $this View */
?>
<?php $this->getPart('header'); ?>

<?php echo $this->content; ?>

<?php $this->getPart('footer');
