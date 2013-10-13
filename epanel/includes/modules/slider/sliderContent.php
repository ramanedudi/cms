<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/lock.php'); 
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');
define ('DS','/'); 
$error = '';
$imageBaseUrl = str_replace("epanel","",baseUrl);
if(isset($_POST) && !empty($_POST)) {
	$bodyEn = addslashes($_POST['description_en']);
	$titleEn = addslashes($_POST['title_en']);
	$id = $_POST['id'];
	$position = $_POST['position'];
	$url = $_POST['url'];
	$isImageUploaded = false;
	if(!empty($_FILES["file"]["name"]))
	{
		$allowedExts = array("gif", "jpeg", "jpg", "png","JPG","JPEG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png")
			|| ($_FILES["file"]["type"] == "image/JPG")
			|| ($_FILES["file"]["type"] == "image/JPEG"))
			&& in_array($extension, $allowedExts)) 
		{
			
		  if ($_FILES["file"]["error"] > 0) {
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			} else {
					$fileName = "FILE_".rand() . '_'.$_FILES["file"]["name"];
					$updir = $_SERVER['DOCUMENT_ROOT']. DS .'cms'.DS.'plugins'.DS.'jqueryslider'.DS.'slides'.DS;	
					if (move_uploaded_file($_FILES["file"]["tmp_name"],$updir . $fileName) ) {
						$isImageUploaded = true;
					}
			}
		  } else {
			echo 'Invalid file.';
		  }
	}
	
	if ($isImageUploaded) {
		if (empty($id)) {
echo			$query = "INSERT INTO plug_slider(title_en, description_en, filename, url, urltype, position)
			VALUES ('".$titleEn."','".$bodyEn."','".$fileName."','".$url."','ext',".$position.")";
		} else {
			$query = "UPDATE plug_slider SET description_en='".$bodyEn."', title_en='".$titleEn."', filename='".$fileName."', url='".$url."', urltype='ext', position=".$position." WHERE id=".$id;
		}
		
		mysqli_query($con, $query);
		
		if(mysqli_affected_rows($con)) {
			$error = "Image added successfully.";
		}
	}
}
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$query = "SELECT * FROM plug_slider WHERE id=".$_GET['id'];
	$res = mysqli_query($con,$query);
	$row = mysqli_fetch_array($res);
}
$selectQuery = "SELECT count(*) AS count FROM plug_slider";
$sres = mysqli_query($con,$selectQuery);
$srow = mysqli_fetch_array($sres);
$selectHtml = '<select name="position">';
for($ii=0; $ii<$srow['count'];$ii++) {
	$selectHtml .= '<option value="'.$ii.'">'.$ii.'</option>';	
}
$selectHtml .= '</select>'; 
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
		<div class="header-detail">Site Slideshow</div>
		
	</div>
	<div class="text-content">
		<form method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php if(isset($row['id'])) echo $row['id']; ?>" />
			<br/>
			<label>Title :<label> <input type="text" name="title_en" value="<?php if(isset($row['title_en'])) echo $row['title_en']; ?>" placeholder="Enter Slide Title" />
			<br/>
			<label>Image Description :</label> <textarea name="description_en" id="description_en"><?php if(isset($row['description_en'])) echo $row['description_en']; ?></textarea>
			<br/>
			<img src="<?php echo $imageBaseUrl.'/plugins/jqueryslider/slides/'. $row['filename']; ?>" width="200" height="170" />
			<br/>
			<input type="file" name="file" id="slider_image" />
			<br/>
			<label>Image URL : </label><input type="text" name="url" id="url" value="<?php if(isset($row['url'])) echo $row['url']; ?>" placeholder="Enter Slide URL" />
			<br/>
			<label>Position : </label><?php echo $selectHtml; ?>
			<br/>
			<input type="submit" value="save" />
			<input type="button" value="cancel" />
		</form>	
	</div>
</div>