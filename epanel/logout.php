<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/constants.php'); ?>
<?php 
session_start();
session_destroy();
header('Location: '.loginUrl);
?>