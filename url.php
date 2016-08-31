
<?php

$settings_file=("his-config.php");
include_once($settings_file);
include("utility.functions.php");
include_once("translation.php");

echo "
			<html lang='".getTranslation('iso639',$settings)."' xmlns='http://www.w3.org/1999/xhtml' >
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta http-equiv='Content-Language' Content='".getTranslation('iso639',$settings)."'/>
			</head>
			<body>
";
?>

<a href='index.php?v=settings'><img title='<?php echo getTranslation("Back",$settings); ?>' alt='<?php echo getTranslation("Back",$settings); ?>' src='images/back.png'/></a>
<br/>
<br/>


<?php

if ( isset($_POST['str']) )
{
	if ( isset($_GET['action']) )
	{
		if ($_GET['action']=='encode')
		{
			echo "<h2>".getTranslation('Encoded Text',$settings).":</h2>";
			echo "<textarea style='background-color:".rcolor()."' rows=5 cols='50' style='font-family:Courier New;'>";
			echo urlencode($_POST['str']);
			echo "</textarea>";
		}
		if ($_GET['action']=='decode')
		{
			echo "<h2>".getTranslation('Decoded Text',$settings).":</h2>";
			echo "<textarea style='background-color:".rcolor()."' rows=5 cols='50' style='font-family:Courier New;'>";
			echo urldecode($_POST['str']);
			echo "</textarea>";
		}
	}
}



?>


<h1><?php echo getTranslation('Encode Text',$settings); ?></h1>
<form action='?action=encode' method='post'>
<textarea name='str' style='width:500px;'><?php
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='encode')
	{
		if ( isset($_POST['str']) )
		{
			echo str_replace("","",$_POST['str']);
		}
	}
}

?></textarea>
<input type='submit'/>
</form>
<h1><?php echo getTranslation('Decode Text',$settings); ?></h1>
<form action='?action=decode' method='post'>
<textarea name='str' style='width:500px;'><?php
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='decode')
	{
		if ( isset($_POST['str']) )
		{
			echo str_replace("","",$_POST['str']);
		}
	}
}

?></textarea>
<input type='submit'/>
</form>