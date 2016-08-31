<?php
$_COOKIE['hisdata']="";
$expire=time()-3600;
if (strpos($_SERVER['HTTP_HOST'],"localhost")===false)
{
	$cookied=setcookie("hisdata", "", $expire,"/",$_SERVER['HTTP_HOST'],false,true);
}
else
{
	$cookied=setcookie("hisdata", "", $expire,"/","",false,true);
}

echo "<script>";
echo "setTimeout(\"window.location='index.php';\",400);";
echo "</script>";
echo "<noscript>";
echo "You have been logged out.  Click <a href='index.php'>here</a> to go back to the main site.";
echo "</noscript>";
?>