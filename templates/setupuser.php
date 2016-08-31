<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HIS &rsaquo; Installation</title>
	<link rel='stylesheet' id='install-css'  href='templates/install.css?ver=3.4.1' type='text/css' media='all' />
</head>
<body>
<table align='center'><tr><td valign='center' style='padding-right:10px;'>
<img alt='HIS' src='images/his-only.png' />
</td><td>
<h1 id='logo' style='text-align:center;display:inline;font-size:30px;'>
<?php

require_once("utility.functions.php");
$settings_file="his-config.php";
include_once($settings_file);
?>

<?php echo getTranslation('Human Intelligence System',$settings); ?>
</h1>
</td></tr></table><br/>

<h1><?php echo getTranslation('Welcome',$settings); ?></h1>
<p><?php echo getTranslation('Welcome to the instantaneous HIS installation process',$settings); ?></p>

<h1><?php echo getTranslation('Information needed',$settings); ?></h1>
<p><?php echo getTranslation('Please provide the following information.',$settings); ?></p>

<form id="setup" method="post" action="?page=12">
	<table class="form-table">
		<!--
		<tr>
			<th scope="row"><label for="weblog_title">Site Title</label></th>
			<td><input name="weblog_title" type="text" id="weblog_title" size="25" value="" /></td>
		</tr>
		-->
		<tr>
			<th scope="row"><label for="user_name"><?php echo getTranslation('Username',$settings); ?></label></th>
			<td>
			<input name="user_name" type="text" id="user_login" size="25" value="admin" />
				<p><?php echo getTranslation('user name guidelines',$settings); ?></p>
						</td>
		</tr>
				<tr>
			<th scope="row">
				<label for="admin_password"><?php echo getTranslation('Password, twice',$settings); ?></label>
			</th>
			<td>
				<input name="admin_password" type="password" id="pass1" size="25" value="" />
				<p><input name="admin_password2" type="password" id="pass2" size="25" value="" /></p>
				<div id="pass-strength-result">Strength indicator</div>
				<p><?php echo getTranslation('password creation hint',$settings); ?></p>
			</td>
		</tr>
				<tr>
			<th scope="row"><label for="admin_email"><?php echo getTranslation('Your E-mail',$settings); ?></label></th>
			<td><input name="admin_email" type="text" id="admin_email" size="25" value="" />
			<p><?php echo getTranslation('double check email',$settings); ?></p></td>
		</tr>
		<!--
		<tr>
			<th scope="row"><label for="blog_public">Privacy</label></th>
			<td colspan="2"><label><input type="checkbox" name="blog_public" value="1"  checked='checked' /> Allow search engines to index this site.</label></td>
		</tr>
		-->
	</table>
	<p class="step"><input type="submit" name="Submit" value="<?php echo getTranslation("Create Database Tables & Install HIS",$settings); ?>" class="button" /></p>
<?php
	foreach ($_POST as $PK=>$PV) echo "<input type='hidden' name='".htmlentities($PK,ENT_QUOTES)."' value='".htmlentities($PV,ENT_QUOTES)."'/>";
?>
</form>
<script type="text/javascript">var t = document.getElementById('weblog_title'); if (t){ t.focus(); }</script>
<script type='text/javascript' src='jhf.js?ver=1.7.2'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var pwsL10n = {"empty":"Strength indicator","short":"Very weak","bad":"Weak","good":"Medium","strong":"Strong","mismatch":"Mismatch"};
/* ]]> */
</script>
<script type='text/javascript' src='js/password-strength-meter.js?ver=3.4.1'></script>
<script type='text/javascript' src='js/user-profile.js?ver=3.4.1'></script>
</body>
</html>
