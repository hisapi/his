<?php
include("model.classes.php");
include_once("controller.guard.php");

if ( isset($_GET['dl']) )
{
	if ( $_GET['dl']=="rdp" )
	{
		if ( isset($_GET['server']) )
		{
			$a_server = new user_server();
			$a_server->get_from_hashrange($u->id_user,$_GET['server']);
			if ($a_server->id_user!="undefined")
			{
				$ip_address=$a_server->ip_address;
				$rdp_content="auto connect:i:1\r\nfull address:s:$ip_address\r\nusername:s:Administrator";
				file_download($a_server->name.".rdp",$rdp_content);
				exit;
			}
		}
	}
}



$qn="";
if ( isset($_GET['q']) )
{
	$qn=$_GET['q'];
}

if ( strlen($qn)>0 )
{

	if ( isset($_GET['file']) )
	{
		if ($_GET['file']=="hisfunctionxmlexport")
		{
			$u->build();
			$q = new hf_id_user();
			$q->get_from_hashrange($u->id_user,$qn);
			$q->build();

			$hf_name = $q->name;
			$chars = ' !@#$%^&*()_+-=[]{}\|;\':"<>?,./;';
			for ($i=0;$i<strlen($chars)-2;$i++)
			{
				$char = substr($chars,$i,1);
				$hf_name = str_replace($char,"_",$hf_name);
			}
			//$hf_name = urlencode($hf_name);
			$hf_name = "".$hf_name.".hf.xml";

			$export=$q->toxml(true);


			$export=$q->toxml(true);
			file_download($hf_name,$export);
			exit;

		}
	}
} // end if
exit;

?>