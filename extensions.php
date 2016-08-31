<?php

$required_functions=array();
$required_functions[]="mbstring";
$required_functions[]="libxml";
$required_functions[]="pcre";
$required_functions[]="mysqli";
$required_functions[]="curl";
$required_functions[]="SimpleXML";
//$required_functions[]="zip";

foreach ($required_functions as $rf)
{
	if (!extension_loaded( $rf ) )
	{
		echo "ERROR: Extension \"$rf\" is not loaded.  The following extensions are required: ".implode(",",$required_functions);
		exit;
	}
}
ini_set('allow_url_fopen', '1');
if (!ini_get('allow_url_fopen'))
{
	echo "ERROR: php.ini setting 'allow_url_fopen' must be set to true";
	exit;
}