<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dheader.php');
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');
$imageBaseUrl = str_replace("epanel/","",baseUrl);
$query = "SELECT * FROM plug_slider";
$res = mysqli_query($con,$query);
$count = mysqli_num_rows($res);
?>
<div id="heading">
	<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td width="511" valign="top" align="left"><h1>Homepage Content</h1>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="content_in">
	<div>
		<h3 class="sub-head">
			<img src="<?php echo baseUrl; ?>images/slideshow-icon.jpg" alt=""
				width="79" height="60" align="absmiddle" style="margin-right: 10px;">Site Slideshow
		</h3>
	</div>


	<div>
		Add Slides
		<a href="#" onClick="editContent('slider','slider','')">
			<img src="<?php echo baseUrl; ?>images/add-icon.png" alt="" width="20" height="20" align="absmiddle" style="margin-left: 5px;">
		</a>
	</div>
	<table width="950" border="0" cellspacing="0" cellpadding="0"
		class="data-table">
		<thead>
			<tr class="t-head">
				<th>Delete</th>
				<th>Edit</th>
				<th>Title</th>
				<th>Image Thumb</th>
				<th>Description</th>
				<th>Position</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($count):
		$i=0;
		?>
		<?php while ($row = mysqli_fetch_array($res)) {?>
			<tr id="option_id_<?php echo $row['id']; ?>" class="<?php if($i%2 == 0){ echo 'even'; } else { echo 'odd'; }?>">
				<td>
					<a href="#" onClick="deleteContent('slider',<?php echo $row['id']; ?>)" >
						<img src="<?php echo baseUrl; ?>images/delet-icon.png" alt="" width="24" height="24">
					</a>	
				</td>
				<td>
					<a href="#" onClick="editContent('slider','slider',<?php echo $row['id']; ?>)">
						<img src="<?php echo baseUrl; ?>images/edit-icon.png" alt="" width="20" height="21">
					</a>		
				</td>
				<td><?php echo htmlentities($row['title_en']); ?></td>
				<td><img src="<?php echo $imageBaseUrl.'/plugins/jqueryslider/slides/'. $row['filename']; ?>" width="100" height="70" /></td>
				<td><?php echo wordwrap($row['description_en'],40,"<br/>"); ?><b>...</b></td>
				<td><?php echo $row['position']; ?></td>
			</tr>
			<?php $i++; } ?>
		<?php endif;?>
	</tbody>
	</table>
</div>

</div>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dfooter.php'); ?>