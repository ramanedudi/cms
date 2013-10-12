<?php
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dheader.php');
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');

$query = "SELECT * FROM pages";
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
			<img src="<?php echo baseUrl; ?>images/page-icon.jpg" alt="" width="79" height="60" align="absmiddle" style="margin-right: 10px;">
				Pages, links and Documents from the site
		</h3>
	</div>


	<div>
		Add News <img src="<?php echo baseUrl; ?>images/add-icon.png"
			alt="" width="20" height="20" align="absmiddle"
			style="margin-left: 5px;">
	</div>
	<table width="950" border="0" cellspacing="0" cellpadding="0"
		class="data-table">
		<thead>
			<tr class="t-head">
				<th>Active</th>
				<th>Edit</th>
				<th>Title</th>
				<th>Update Last On</th>
				<th>Updated By</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($count):
		$i=0;
		?>
		<?php while ($row = mysqli_fetch_array($res)) {?>
			<tr class="<?php if($i%2 == 0){ echo 'even'; } else { echo 'odd'; }?>">
				<td>
					<input type="checkbox" name="active" id="active" onClick="updateActiveArticle(<?php echo $row['id']; ?>)">
				</td>
				<td>
					<a href="<?php echo baseUrl.'includes/modules/pages/postsListing.php?pid=' . $row['id']; ?>">
						<img src="<?php echo baseUrl; ?>images/edit-icon.png" alt="" width="20" height="21">
					</a>		
				</td>
				<td><?php echo htmlentities($row['title_en']); ?></td>
				<td><?php echo $row['created']; ?></td>
				<td>Admin</td>
			</tr>
			<?php $i++; } ?>
		<?php endif;?>
	</tbody>
	</table>
</div>

</div>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dfooter.php'); ?>