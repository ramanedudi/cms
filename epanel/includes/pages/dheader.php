<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Office of the General Counsel</title>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/custom_script.js"></script>
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function openContent(type)
{
	$("#blank_screen").fadeIn(2000);
	$("#content_frame").attr('src','<?php echo baseUrl; ?>includes/modules/openContent.php?open='+type);
	$("#content_open_block").show();
}
</script>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="logo">
				<img src="images/login_logo.jpg" alt="logo">
			</div>
		</div>