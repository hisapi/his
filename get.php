<?php
if ( ( ( !isset($_GET['uid']) && !isset($_GET['secret']) ) || ( !isset($_POST['uid']) && !isset($_POST['secret']) ) ) && !isset($_COOKIE["hisdata"]))
{
	echo trim(iconv('UTF-8', 'ASCII//IGNORE', "ERROR: GET parameters 'uid' and 'secret' must be defined"));
	exit;
}
if (!isset($_GET['job']))
{
	echo trim(iconv('UTF-8', 'ASCII//IGNORE', "ERROR: GET parameter 'job' must be defined"));
	exit;
}
if (!isset($_GET['return']))
{
	echo trim(iconv('UTF-8', 'ASCII//IGNORE', "ERROR: GET parameter 'return' must be defined"));
	exit;
}

include("version.php");
include("demos.php");
include("controller.guard.php");
$find_job = new job_id_user();
$find_job->get_from_hashrange($u->id_user,$_GET['job']);

if ($find_job->id!="undefined")
{

	if ($_GET['return']=="status")
	{
		echo trim(iconv('UTF-8', 'ASCII//IGNORE', $find_job->id_status));
	
	}
	if ($_GET['return']=="output")
	{
		$find_job->build(array("obj_rqdata","obj_response","obj_ad","obj_hf","obj_user"));
		// 302
		header("Location: ".$find_job->obj_output->val);
	}
}
else
{
	echo trim(iconv('UTF-8', 'ASCII//IGNORE', "undefined"));
}

?>