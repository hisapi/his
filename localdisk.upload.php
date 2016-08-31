<?php
include_once("model.classes.php");

if ($_SERVER['HTTP_HOST']!=$demo_domain)
{
}
else
{
	return;
}

if (!isset($_POST['bucket']) || !isset($_POST['success_action_redirect']) || !isset($_POST['key']) )
{
	echo "<pre>";
	echo "Missing form content";
	print_r($_FILES);
	print_r($_POST);
}

if ($_FILES["file"]["error"] > 0)
{
	echo "File Upload Return Code: " . $_FILES["file"]["error"] . "<br>";
	exit;
}
else
{
	echo "form content";

	if ($_POST['bucket']!=$APP['fs']->bucket)
	{
		echo "Bucket name mismatch";
		exit;
	}

	//$new_key = $_POST['bucket']."/".$_POST['key'];
	$new_key = $_POST['key'];
	$new_key=str_replace("\$"."{filename}",$_FILES['file']['name'],$new_key);

	if (file_exists($new_key))
	{
		echo $new_key." already exists. ";
		exit;
	}
	else
	{
		$is_uploaded=is_uploaded_file($_FILES["file"]["tmp_name"]);
		if ($is_uploaded)
		{
			$APP['fs']->create_object(true,$_POST['bucket'],$new_key,$_FILES['file']['tmp_name'],$_FILES["file"]["type"]);
			unlink($_FILES['file']['tmp_name']);
			//echo "file moved to $new_key";
		}
		else
		{
			echo "file was not uploaded";
			exit;
		}
	}
}

// key
// etag
// bucket

header("Location: ".$_POST['success_action_redirect']."&etag=".sha1(time().rand(9,100))."&bucket=".$_POST['bucket']."&key=".urlencode($new_key) );


?>