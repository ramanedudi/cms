<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); ?>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/constants.php'); ?>
<?php $googleUrl = str_replace("epanel","admin",baseUrl); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Office of the General Counsel</title>
<script type="text/javascript" src="<?php echo baseUrl; ?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo baseUrl; ?>js/custom_script.js"></script>
<link href="<?php echo baseUrl; ?>css/login.css" rel="stylesheet" type="text/css" />
<link href="<?php echo baseUrl; ?>css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function openContent(type)
{
	$("#blank_screen").fadeIn(2000);
	$("#content_frame").attr('src','<?php echo baseUrl; ?>includes/modules/openContent.php?open='+type);
	$("#content_open_block").show();
}

function editContent(module, page, id)
{
	$("#blank_screen").fadeIn(2000);
	$("#content_frame").attr('src','<?php echo baseUrl; ?>includes/modules/'+module+'/'+page+'Content.php?id='+id);
	$("#content_open_block").show();
}
function updateActiveContent(module, id, obj)
{
	var active = obj.checked;
	if (true == active) {
		activeVal = 1;
	} else {
		activeVal = 0;
	}
	$.ajax({
		type: "POST",
		url: "<?php echo baseUrl; ?>includes/modules/updateAll.php",
		data: { module: module, id: id, activeVal: activeVal, type: "activate" }
		})
		.done(function( msg ) {
		$("#error").html( "Data updated :  " + msg );
		});
}
function deleteContent(module, id)
{
	$.ajax({
		type: "POST",
		url: "<?php echo baseUrl; ?>includes/modules/updateAll.php",
		data: { module: module, id: id, type: "del" }
		})
		.done(function( msg ) {
		$("#error").html( "Data updated :  " + msg );
		$("#option_id_"+id).hide(1500);
		});
}

function openGoogleA()
{
	$("#blank_screen").fadeIn(2000);
	$("#content_frame").attr('src','<?php echo $googleUrl; ?>google-analytics.php');
	$("#content_open_block").show();
}
</script>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="logo">
				<a href="<?php echo baseUrl; ?>dashboard.php"><img src="<?php echo baseUrl; ?>images/login_logo.jpg" alt="logo"></a>
			</div>
			<div class="logout" style="float: right; z-index: 9999; margin-right: 30px;">
				<a href="<?php echo baseUrl; ?>logout.php" style="text-decoration: none;">
					<h1 style="color: #BE2E38;">Logout</h1>
				</a>
			</div>
		</div>
		<div id="error">
			
		</div>