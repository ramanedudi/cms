<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); 
$error = '';
if(isset($_POST) && !empty($_POST)) {
	$bodyEn = addslashes($_POST['body_en']);
	$titleEn = addslashes($_POST['title_en']);
	$slug = addslashes($_POST['page_slug']);
	$pid = $_POST['page_id'];
	
	$id = $_POST['id'];
	
	if (empty($id)) {
		$query = "INSERT INTO posts (page_id,page_slug,title_en,show_title,body_en,position,active)
		VALUES(".$pid.",'".$slug."','".$titleEn."',1,'".$bodyEn."',1,1)";
	} else {
		$query = "UPDATE posts SET body_en='".$bodyEn."', title_en='".$titleEn."', page_slug='".$slug."' WHERE id=".$id;
	}
	
	mysqli_query($con, $query);
	
	if(mysqli_affected_rows($con)) {
		$error = "Post updated successfully.";
	}
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
	if (is_numeric($_GET['id'])) {
		$query = "SELECT * FROM posts WHERE id=".$_GET['id'];
		$res = mysqli_query($con,$query);
		$row = mysqli_fetch_array($res);
		$pageId[1] = $row['page_id'];	
	} elseif(is_string($_GET['id'])) {
		$pageId = explode('-',$_GET['id']);
	}
} 
?>
<script src="<?php echo baseUrl; ?>includes/modules/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo baseUrl; ?>includes/modules/ckeditor/sample.css">
<link href="../../css/login.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo baseUrl; ?>/css/custom.css">
<div id="msg">
<?php if(isset($error) && !empty($error)) {
	echo $error;
}
?>
</div>
<div id="main-content">
	<div class="header_title">
		<img src="<?php echo baseUrl; ?>images/page-icon.jpg" alt="" width="60"/>
		<div class="header-detail">Homepage Posts</div>
	</div>
	<div class="text-content">
		<form method="post">
			<input type="hidden" name="id" value="<?php if(isset($row['id'])) echo $row['id']; ?>" />
			<input type="hidden" name="page_id" value="<?php echo $pageId[1]; ?>" />
			<div class="add-title">
			<label>Title : </label>
				<input type="text" name="title_en" value="<?php if(isset($row['title_en'])) echo $row['title_en']; ?>" placeholder="Enter Page Title" />
			</div>
			<br/>

			<label>Page Slug: </label>
				<br/><input type="text" name="page_slug" value="<?php if(isset($row['page_slug'])) echo $row['page_slug']; ?>" placeholder="Enter Page Slug" />
			
					<br/><br/>	
			<label>Description : </label>
			<textarea name="body_en" id="body_en"><?php if(isset($row['body_en'])) echo $row['body_en']; ?></textarea>
			<br/>
			
			<input type="submit" value="save" class="save" />
			<input type="button" value="cancel" class="cancel" />
		</form>	
	</div>
</div>
<script>
CKEDITOR.replace( 'body_en', {
	uiColor: '#d3d3d3'
});
</script>