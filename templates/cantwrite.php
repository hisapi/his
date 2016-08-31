<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HIS &rsaquo; Setup Configuration File</title>
<link rel="stylesheet" href="templates/install.css?ver=0.1.1" type="text/css" />

</head>
<body>
<h1 id="logo"><img alt="HIS" src="images/his-logo.png?ver=20120216" /></h1>
<p>

<?php
	echo getTranslation('cantwrite',$_POST);
?>
<ul><code><?php echo $this_folder; ?>/his-config.php</code></ul>

</p>
<textarea cols="98" rows="15" class="code"><?php echo $sample_config_safe; ?></textarea>
<p><?php echo getTranslation('After you have done that, click "Run the install".',$_POST); ?></p>
<form method="post" action="install.php?page=11">
<p class="step">
<?php
$hff="";
$hff=$hff."<input type='hidden' name='"."dbtype".
	"' value='".$_POST['dbtype']."'/>";
foreach ($DBCONFIG->fields as $FIELDS)
{
	$hff=$hff."<input type='hidden' name='".$FIELDS->fieldname.
		"' value='".$FIELDS->value."'/>";
}
$hff=$hff."<input type='hidden' name='"."fstype".
	"' value='".$_POST['fstype']."'/>";
foreach ($FSCONFIG->fields as $FIELDS)
{
	$hff=$hff."<input type='hidden' name='".$FIELDS->fieldname.
		"' value='".$FIELDS->value."'/>";
}
$hff=$hff."<input type='hidden' name='"."language".
	"' value='".$_POST['language']."'/>";
echo $hff;
?>
<input name="submit" type="submit" value="<?php echo getTranslation("Run the Install",$_POST); ?>" class="button" />
</p>
</form
</body>
</html>
