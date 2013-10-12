<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); 
$error = '';
if(isset($_POST) && !empty($_POST)) {
	$bodyEn = addslashes($_POST['body_en']);
	$titleEn = addslashes($_POST['title_en']);
	$id = $_POST['id'];
	
	if (empty($id)) {
		$query = "INSERT INTO plug_newsslider(title_en, body_en, show_title, created, show_created, position, active)
		VALUES ('".$titleEn."','".$bodyEn."',1,now(),1,1,1)";
	} else {
		$query = "UPDATE plug_newsslider SET body_en='".$bodyEn."', title_en='".$titleEn."' WHERE id=".$id;
	}
	
	mysqli_query($con, $query);
	
	if(mysqli_affected_rows($con)) {
		$error = "News updated successfully.";
	}
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$query = "SELECT * FROM plug_newsslider WHERE id=".$_GET['id'];
	$res = mysqli_query($con,$query);
	$row = mysqli_fetch_array($res);
} 
?>
<script src="<?php echo baseUrl; ?>includes/modules/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo baseUrl; ?>includes/modules/ckeditor/sample.css">
<div id="msg">
<?php if(isset($error) && !empty($error)) {
	echo $error;
}
?>
</div>
<div id="main-content">
	<div class="header_title">
		<img src="" width="" height="" />
		<div class="header-detail">Homepage News</div>
		<div class="last-updated">Last Updated : <?php if(isset($row['created'])) echo $row['created']; ?></div>
	</div>
	<div class="text-content">
		<form method="post">
			<input type="hidden" name="id" value="<?php if(isset($row['id'])) echo $row['id']; ?>" />
			<input type="text" name="title_en" value="<?php if(isset($row['title_en'])) echo $row['title_en']; ?>" placeholder="Enter News Title" />
			<textarea name="body_en" id="body_en"><?php if(isset($row['body_en'])) echo $row['body_en']; ?></textarea>
			<input type="submit" value="save" />
			<input type="button" value="cancel" />
		</form>	
	</div>
</div>
<script>
CKEDITOR.replace( 'body_en', {
	uiColor: '#14B8C4'
});
</script>