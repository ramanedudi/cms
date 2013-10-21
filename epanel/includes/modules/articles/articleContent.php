<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php'); 
$error = '';
if(isset($_POST) && !empty($_POST)) {
	$bodyEn = addslashes($_POST['body_en']);
	$titleEn = addslashes($_POST['title_en']);
	$slug = addslashes($_POST['slug']);
	$cid = $_POST['category_id'];
	$shortDesc = addslashes($_POST['short_desc_en']);
	
	$id = $_POST['id'];
	
	if (empty($id)) {
		$query = "INSERT INTO mod_articles(title_en, body_en, slug, short_desc_en, cid, uid, created, modified, show_author, show_ratings, show_comments, show_created, active)
		VALUES ('".$titleEn."','".$bodyEn."', '".$slug."','".$shortDesc."', ".$cid.", 1, now(), now(), 1, 1, 1, 1, 1)";
	} else {
		$query = "UPDATE mod_articles SET body_en='".$bodyEn."', title_en='".$titleEn."', slug='".$slug."', short_desc_en='".$shortDesc."', cid=".$cid." WHERE id=".$id;
	}
	
	mysqli_query($con, $query);
	
	if(mysqli_affected_rows($con)) {
		$error = "Article updated successfully.";
	}
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$query = "SELECT * FROM mod_articles WHERE id=".$_GET['id'];
	$res = mysqli_query($con,$query);
	$row = mysqli_fetch_array($res);
} 
$sqlCat = "SELECT id, name_en FROM mod_article_categories";
$cRes = mysqli_query($con,$sqlCat);
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
		
		<div class="header-detail"><img src="<?php echo baseUrl; ?>images/book-icon.jpg" align="middle" />Homepage Articles</div>
		<div class="last-updated">Last Updated : <strong><?php if(isset($row['modified'])) echo $row['modified']; ?></strong></div>
	</div>
	<div class="text-content">
		<form method="post">
			<ul>
			<li><input type="hidden" name="id" value="<?php if(isset($row['id'])) echo $row['id']; ?>" /></li>
			<li>
			<label>Slug</label>
			<input type="text" name="slug"  value="<?php if(isset($row['slug'])) echo $row['slug']; ?>" placeholder="Enter Slug" />
			 </li>
			<li>
			<label>Category</label>
			<select name="category_id" value="<?php if(isset($row['cid'])) echo $row['cid']; ?>">
				<?php 
					while ($cRow = mysqli_fetch_array($cRes)) { ?>
						<option value="<?php echo $cRow['id']; ?>" <?php if(isset($row['cid']) && $cRow['id'] == $row['cid'] ) echo "selected" ?> >
							<?php echo $cRow['name_en']; ?>
						</option>
				<?php	}
				?>
			</select>
			</li>
			</ul>
			<div class="add-title"><label class="discr-head">Title : </label>
				<input type="text" name="title_en" value="<?php if(isset($row['title_en'])) echo $row['title_en']; ?>" placeholder="Enter Article Title" /></div>
			<label class="discr-head">Short Description :</label>
			<textarea name="short_desc_en" id="short_desc_en"><?php if(isset($row['short_desc_en'])) echo $row['short_desc_en']; ?></textarea>
			<br/>
			
			<label class="discr-head">Description : </label>
			<textarea name="body_en" id="body_en"><?php if(isset($row['body_en'])) echo $row['body_en']; ?></textarea>
			<br/>
			
			<input type="submit" value="save" class="save" />
			<input type="button" value="cancel" class="cancel" />
		</form>	
	</div>
</div>

 
<script>
CKEDITOR.replace( 'body_en', {
	uiColor: '#d3d3d3',
	toolbar: [
	[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
	[ 'FontSize', 'TextColor', 'BGColor' ]
	]
});
CKEDITOR.replace( 'short_desc_en', {
	uiColor: '#d3d3d3',
	toolbar: [
	[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
	[ 'FontSize', 'TextColor', 'BGColor' ]
	]
	});


</script>