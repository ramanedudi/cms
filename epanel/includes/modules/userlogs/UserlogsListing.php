<?php/
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dheader.php');
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');

$query = "SELECT * FROM log ORDER BY created DESC";
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
			<img src="<?php echo baseUrl; ?>images/activity-icon.jpg" alt="" width="79" height="60" align="absmiddle" style="margin-right: 10px;">
			Track the user's activities
		</h3>
	</div>
	<table width="950" border="0" cellspacing="0" cellpadding="0"
		class="data-table">
		<thead>
			<tr class="t-head">
				<th>Date</th>
				<th>User</th>
				<th>Content</th>
				<th>Action</th>
				<th>IP</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($count):
		$i=0;
		?>
		<?php while ($row = mysqli_fetch_array($res)) {?>
			<tr class="<?php if($i%2 == 0){ echo 'even'; } else { echo 'odd'; }?>">
				<td>
					<?php echo $row['created']; ?>	
				</td>
				<td>
					<?php echo $row['user_id'] ?>
				</td>
				<td>
					<?php echo htmlentities($row['message']); ?>
				</td>
				<td><?php echo $row['info_icon']; ?></td>
				<td><?php echo $row['ip']; ?></td>
			</tr>
			<?php $i++; } ?>
		<?php endif;?>
	</tbody>
	</table>
</div>

</div>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dfooter.php'); ?>