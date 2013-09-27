<?php include('includes/pages/header.php'); ?>
<div class="content">
	<div id="heading">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td width="511" valign="top" align="left"><h1>Admin
							Access</h1>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="wrap">
		<div id="message-box"></div>
		<div id="content-wrap">
			<h1>sdtechnologies.in - Admin Panel</h1>
			<div id="content">
				<form name="login_form" method="post" action="<?php echo baseUrl; ?>includes/modules/processLogin.php">
					<div class="block">
						<label for="user">Username :</label> <input type="text" size="25"
							id="user" class="inputbox" name="username">
					</div>
					<div class="block">
						<label for="password">Password :&nbsp;</label> <input
							type="password" size="25" id="password" class="inputbox"
							name="password">
					</div>
					<div style="text-align: right; margin-right: 24px;" class="block">
						<input type="submit" id="submit" value="Login" class="button" name="submit" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include('includes/pages/footer.php'); ?>

