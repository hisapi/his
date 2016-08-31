<?php

if ( !isset($_GET['key']) || !isset($_GET['secret']) || !isset($_GET['auth']) )
{
	exit;
}


# Include the Dropbox SDK libraries
require_once "lib/Dropbox/autoload.php";
use \Dropbox as dbx;

$json_str='{"key": "'.$_GET['key'].'","secret": "'.$_GET['secret'].'"}';
$json_obj=json_decode($json_str, TRUE);
$appInfo = dbx\AppInfo::loadFromJson($json_obj);
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

// START THE AUTHORIZATION PROCEDURE
$authorizeUrl = $webAuth->start();

$authCode = $_GET['auth'];

list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);

echo "<div style='text-align:center;font-weight:bold;'>";
echo "Your permanent access token is:<br/>";
echo "<h4 style='color:red;font-size:10px;'>";
echo $accessToken;
echo "</h4>";
echo "<div>";
