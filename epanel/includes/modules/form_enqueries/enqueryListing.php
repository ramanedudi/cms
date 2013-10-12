<?php/
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dheader.php');
include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/config/config.php');

$query = "SELECT * FROM form_enquries";
$res = mysqli_query($con,$query);
$count = @mysqli_num_rows($res);
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
			<img src="<?php echo baseUrl; ?>images/form-icon.jpg" alt="" width="79" height="60" align="absmiddle" style="margin-right: 10px;">
			Form Enqueries
		</h3>
	</div>
	<table width="950" border="0" cellspacing="0" cellpadding="0"
		class="data-table">
		<thead>
			<tr class="t-head">
				<th>Delete</th>
				<th>Sender Email</th>
				<th>Name</th>
				<th>Phone</th>
				<th>message</th>
				<th>IP</th>
			</tr>
		</thead>
		<tbody>
		<?php if ($count):
		$i=0;
		?>
		<?php while ($row = mysqli_fetch_array($res)) {?>
			<tr id="option_id_<?php echo $row['id']; ?>" class="<?php if($i%2 == 0){ echo 'even'; } else { echo 'odd'; }?>">
				<td>
					<a href="#" onClick="deleteContent('form_enq',<?php echo $row['id']; ?>)" >
						<img src="<?php echo baseUrl; ?>images/delet-icon.png" alt="" width="24" height="24">
					</a>	
				</td>
				<td>
					<?php echo $row['sender_email'] ?>
				</td>
				<td>
					<?php echo $row['name']; ?>
				</td>
				<td><?php echo $row['phone']; ?></td>
				<td><?php echo htmlentities($row['message']); ?></td>
				<td><?php echo $row['ip']; ?></td>
			</tr>
			<?php $i++; } ?>
		<?php endif;?>
	</tbody>
	</table>
</div>

</div>
<?php include ($_SERVER['DOCUMENT_ROOT'].'/cms/epanel/includes/pages/dfooter.php'); ?>