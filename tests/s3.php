<?php
require_once("awssdk/sdk.class.php");
$s3 = new AmazonS3();
$bucket="hisbucket00";
$response = $s3->get_object_list($bucket);
print_r($response);
phpinfo();
?>
