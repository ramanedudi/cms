<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/constants.php'); ?>
<?php
$uname = addslashes($_POST['username']);
$upass = sha1($_POST['password']);
$check = "SELECT * FROM users WHERE username = '".$uname."' AND password = '".$upass."' AND active='y'";

$res = mysqli_query($con,$check);

if (false === $res) {
    echo mysql_error();
}
$count = mysqli_num_rows($res);

if($count == 1)
{
	session_start();
	$_SESSION['username'] = $uname;
	header('Location: '.homeUrl);
}
else
{
	header('Location: '.loginUrl);
}


?>
