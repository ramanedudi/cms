<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');

$type   = $_POST['type'];
$module = $_POST['module'];
$id     = $_POST['id'];
$table  = "";
$sql    = "";
switch ($module) {
	case "news":
		$table = "plug_newsslider";
		break;
	case "article":
		$table = "mod_articles";
		break;	
	case "post":
		$table = "posts";
		break;
	case "form_enq":
		$table = "form_enquries";
		break;
	case "pages":
		$table = "pages";
		break;		
			
}

switch ($type) {
	case "activate":
		$sql = "UPDATE " . $table . " SET active=". $_POST['activeVal'] . " WHERE id=" . $id;
		if (1==$_POST['activeVal']) {
			$msg = "Activated Successfully !";
		} else {
			$msg = "De-Activated Successfully !";
		}
		
		break;
	case "del":
		$sql = "DELETE FROM " . $table . " WHERE id=" . $id;
		$msg = "Record Deleted Successfully !";
		break;	
}
mysqli_query($con,$sql);
echo $msg;