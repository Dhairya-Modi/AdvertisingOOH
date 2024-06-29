<?php include('../config/constants.php')?>
<?php
session_start();
session_unset();
header("location:".SITEURL.'admin/login.php');

?>
