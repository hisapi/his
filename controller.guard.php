<?php
// BASIC LOGIN

include_once("model.classes.php");

error_reporting(-1);
ini_set('error_reporting', E_ALL);
set_time_limit ( 60 * 60 * 3 ); // 3 hours

include_once("utility.functions.php");

$BIN_DIR=__dir__;
// watch for jobs
$INT_32_OR_64=32;
if (strpos(php_uname('m'),"64")!==false)
{
	$INT_32_OR_64=64;
}

$PATH_SEPERATOR="/";
$IS_LINUX=true;
$IS_WINDOWS=false;
if ( strpos(php_uname('s'),"nux")===false)
{
	$IS_WINDOWS=true;
	$IS_LINUX=false;
	$PATH_SEPERATOR="\\";
}

include_once("model.database.php");
// open settings file
$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");

if ( !file_exists($settings_file) )
{
	$settings_file=(dirname($BIN_DIR).$PATH_SEPERATOR."his-config.php");
}

if ( file_exists($settings_file) )
{
	include_once($settings_file);
}
else
{
	include("view.menu.public.php");
	include("view.public.php");
	exit;
}
		

if (!$APP['db']->connected)
{
	echo "ERROR: Not connected to database.";
	exit;
}

$u=false;
global $u;
$GLOBALS['u']=$u;
$APP['u']=$u;

if ( isset($_COOKIE["hisdata"]) )
{
	$cookie_data=$_COOKIE['hisdata'];
	$cookie_data = explode(":",$cookie_data);
	$cookie_user = $cookie_data[0];
	$cookie_pass = $cookie_data[1];
	$u = new user_user_name();
	$u->get_from_hashrange($cookie_user);

	if ($u->user_name!="undefined")
	{
		if ($u->pw != $cookie_pass)
		{
			$u=false;
		}
	}
}
else if ( isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) )
{
	// UID + Secret
	$u = new user_id_user();
	$u->get_from_hashrange($_SERVER['PHP_AUTH_USER']);

	if ($u->user_name!="undefined")
	{
		if ($u->secret != $_SERVER['PHP_AUTH_PW'])
		{
			$u=false;
		}
	}
	else
	{
		$u=false;
	}
}
else if ( isset($_POST['uid']) && isset($_POST['secret']) )
{
	// UID + Secret
	$u = new user_id_user();
	$u->get_from_hashrange($_POST['uid']);

	if ($u->user_name!="undefined")
	{
		if ($u->secret != $_POST['secret'])
		{
			$u=false;
		}
	}
	else
	{
		$u=false;
	}
}
else if ( isset($_GET['uid']) && isset($_GET['secret']) )
{
	// UID + Secret
	$u = new user_id_user();
	$u->get_from_hashrange($_GET['uid']);
	if ($u->user_name!="undefined")
	{
		if ($u->secret != $_GET['secret'])
		{
			$u=false;
		}
	}
	else
	{
		$u=false;
	}
}
else if ( false )
{
	// LDAP PLACEHOLDER - NEED TO TEST
	$u = false;
	/*

	$ldapconfig['host'] = 'localhost';
	$ldapconfig['port'] = NULL;
	$ldapconfig['basedn'] = 'dc=localhost,dc=com';
	$ldapconfig['authrealm'] = 'My Realm';

	function ldap_authenticate() {
		global $ldapconfig;
		global $PHP_AUTH_USER;
		global $PHP_AUTH_PW;
		
		if ($PHP_AUTH_USER != "" && $PHP_AUTH_PW != "") {
			$ds=@ldap_connect($ldapconfig['host'],$ldapconfig['port']);
			$r = @ldap_search( $ds, $ldapconfig['basedn'], 'uid=' . mysqli_escape_string($PHP_AUTH_USER) );
			if ($r) {
				$result = @ldap_get_entries( $ds, $r);
				if ($result[0]) {
					if (@ldap_bind( $ds, $result[0]['dn'], mysqli_escape_string($PHP_AUTH_PW) ) ) {
						return $result[0];
					}
				}
			}
		}
		header('WWW-Authenticate: Basic realm="'.$ldapconfig['authrealm'].'"');
		header('HTTP/1.0 401 Unauthorized');
		return NULL;
	}

	if (($result = ldap_authenticate()) == NULL) {
		echo('Authorization Failed');
		exit(0);
	}
	echo('Authorization success');
	print_r($result);
	*/
}


if (!$u)
{
	// is public interface enabled or not?
	if ( !endsWith($_SERVER['SCRIPT_NAME'],"status.php") )
	{
		include("view.menu.public.php");
		include("view.public.php");
		exit;
	}
	else
	{
		echo "login failure";
		exit;
	}
}


?>