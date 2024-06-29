<!-- DB Connection-->
<?php
// session_start();

define('SITEURL','http://localhost/AdvertisingToSubmit/');
define('LOCALHOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'advt2');

$conn=mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

?>