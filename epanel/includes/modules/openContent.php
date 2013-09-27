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
<link rel="stylesheet" href="ckeditor/sample.css">
<div id="msg">
<?php if(isset($error) && !empty($error)) {
	echo $error;
}
?>
</div>
<div id="main-content">
	<div class="header_title">
		<img src="" width="" height="" />
		<div class="header-detail">Welcome Paragraph</div>
	</div>
	<div class="text-content">
		<form method="post">
			<textarea name="welcome-para" id="welcome-para"><?php echo $row['body_en']; ?></textarea>
			<input type="submit" value="save" />
			<input type="button" value="cancel" />
		</form>	
	</div>
</div>
<script>
CKEDITOR.replace( 'welcome-para', {
	uiColor: '#14B8C4'
});
</script>