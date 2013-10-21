<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); 
$error = '';
if(isset($_POST) && !empty($_POST)) {
	$welcomePara = addslashes($_POST['welcome-para']);
	$query = "UPDATE posts SET body_en='".$welcomePara."' WHERE page_id=1";
	mysqli_query($con, $query);
	if(mysqli_affected_rows($con)) {
		$error = "Welcome Page updated successfully.";
	}
}
$query = "SELECT * FROM posts WHERE page_id=1";// for welcome paragraph
$res = mysqli_query($con,$query);
$row = mysqli_fetch_array($res);
?>
<script src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../../css/custom.css">

<div id="msg">
<?php if(isset($error) && !empty($error)) {
	echo $error;
}
?>
</div>
<div id="main-content">
	<div class="header_title">
		
		<div class="header-detail"><img src="../../images/welcome-icon.jpg" align="middle" alt="Welcome"/>Welcome Paragraph</div>
	</div>
	<div class="text-content welcome-box">
		<form method="post">
			<textarea name="welcome-para" id="welcome-para"><?php echo $row['body_en']; ?></textarea>
			<input type="submit" value="save" class="save" />
			<input type="button" value="cancel" class="cancel" />
		</form>	
	</div>
</div>
<script>
CKEDITOR.replace( 'welcome-para', {
	uiColor: '#eb9049'
});
</script>