<?php
// gui


if ( isset($_GET['v']) && (isset($_GET['q']) || !isset($_GET['tags']) || !isset($_GET['s']) ) )
{

}


// COLUMN 2
if ( isset($_GET['v']) )
{
	if ( in_array($_GET['v'],array_keys($public_menu)) )
	{
		echo "<h1>";
		echo getTranslation($public_menu[$_GET['v']],$_GET) ;
		echo "</h1>";
	}
}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="news")
{

	$news_content="";
	try
	{
		$news_content=file_get_contents("https://humanintelligencesystem.com/news/");
	}
	catch (Exception $e)
	{
		$news_content=getTranslation("Oops! Unable to get news.  Unable to establish secure connection to news server.",$_GET);
	}
	if ( strlen($news_content)==0)
	{
		$news_content=file_get_contents("news.html");
	}
	echo "<ul>";
	echo $news_content;
	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";

}
}

if ( isset($_GET['v']) )
{
if ($_GET['v']=="purpose")
{

echo getTranslation("What is it?",$_GET);
echo "<br/>";
echo "<br/>";

echo getTranslation("A single Open-Source software package with 2 primary functions",$_GET);
echo ":";
echo "<br/>";
echo "<br/>";

echo "<ul>";

echo "- ";
echo getTranslation("HTTP API Generator",$_GET);
echo "<br/>";

echo "- ";
echo getTranslation("Job Server",$_GET);
echo "<br/>";
echo "&nbsp;";
echo "&nbsp;";
echo "&nbsp;";
echo "&nbsp;";
echo "<font size='-2'>";
echo getTranslation("(Job server takes action based on your HIS HTTP API Requests)",$_GET);
echo "</font>";

echo "</ul>";


echo getTranslation("You connect to in-house or third party automation infrastructure through HTTP calls to HIS.",$_GET);

if ( !isset($this_server_url) )
{
	$this_server_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	if ( substr($this_server_url,strlen($this_server_url)-1,1) == "/")
	{
		$this_server_url=substr($this_server_url,0,strlen($this_server_url)-1);
	}
}

echo "<ul>";
echo "<textarea cols='80' rows='10' style='background-color:#d9c5ca;font-size:12px;padding:10px;display:block;margin:10px;font-weight:bold;;font-family:Courier New;'>wget -O my_download.txt '";
/*echo "http";
if (isset($_SERVER['HTTPS']))
{
	if ($_SERVER['HTTPS']=="on")
	{
		echo "s";
	}
}
else if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]))
{
	if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=="https")
	{
		echo "s";
	}
}
echo "://";
*/
echo $this_server_url;
//$wc=str_replace("/index.php","",$_SERVER['REQUEST_URI']);
//$wc=str_replace("index.php","",$wc);
//$wc=rtrim($wc,"/");
//echo $wc;

echo "/?q=1a27e71c5a7b2b241b1554770d62bd4c685f53d0&id_user=e040ef1bcd6ac1bc11a995470790bc061fb817f3&secret=[HIS_SECRET_KEY]&send_fax_to_phone_number=1-661-123-4567&content=this+is+a+test+fax%21&remote&cxml'</textarea>";
echo "</ul>";

echo "<br/>";
echo getTranslation("Your HTTP request hits your HIS Web Interface, and is forwarded to your job server cluster.",$_GET);
echo "<br/>";

echo "<img src='images/infrastructure-picture.png'/>";

echo "<br/>";
echo getTranslation("This allows you to:",$_GET);
echo "<br/>";


// todo: fix this include better

$items=array();
foreach ($STATIC['hf_resource_types'] as $resource_type_key=>$resource_type_value)
{
	$txt=$resource_type_key;
	$txt=str_replace("remote-","",$txt);
	if ( strpos($txt,"-")!==FALSE )
	{
		$txt=substr($txt,0,strpos($txt,"-") );
	}
	$items[]=$txt;
}


echo "<table width='700' border='0'>";
echo "<tr><td width='100%' align='center'>";

echo "<br/>";

//echo "<h2>";
//echo getTranslation("The idea is simple",$_GET);
//echo "</h2>";


echo "<h2>";
echo getTranslation("Write Instructions (or not)",$_GET);
echo "</h2>";

$item_idx=0;
foreach ($items as $txt)
{
	if ($item_idx>22) continue;
	$rn=rand(1,6);	$cr=rand(1,255); 	$cg=rand(1,255); 	$cb=rand(1,255);
	echo "<table style='display:inline;'><tr><td style='color:rgb($cr,$cg,$cb);text-align:center;font-weight:bold;font-size:14px;'>$txt<br/><div style='width:50;height:50;background-color:rgb($cr,$cg,$cb);'><img src='images/bug$rn.png' border='0' height='50' width='50'/></div></td></tr></table>";
	$item_idx=$item_idx+1;
}



echo "<h2>";
echo getTranslation("In Any Language (or plain english)",$_GET);
echo "</h2>";

$item_idx=0;
foreach ($items as $txt)
{
	$item_idx=$item_idx+1;
	if ($item_idx<=22) continue;
	if ($item_idx>44) continue;
	$rn=rand(1,6);	$cr=rand(1,255); 	$cg=rand(1,255); 	$cb=rand(1,255);
	echo "<table style='display:inline;'><tr><td style='color:rgb($cr,$cg,$cb);text-align:center;font-weight:bold;font-size:14px;'>$txt<br/><div style='width:50;height:50;background-color:rgb($cr,$cg,$cb);'><img src='images/bug$rn.png' border='0' width='50' height='50'/></div></td></tr></table>";
}




echo "<br/>";
echo "<br/>";


echo "<h2>";
echo getTranslation("Initiate from HTTP",$_GET);
echo "</h2>";



$item_idx=0;
foreach ($items as $txt)
{
	$item_idx=$item_idx+1;
	if ($item_idx<=44) continue;
	if ($item_idx>66) continue;
	$rn=rand(1,6);	$cr=rand(1,255); 	$cg=rand(1,255); 	$cb=rand(1,255);
	echo "<table style='display:inline;'><tr><td style='color:rgb($cr,$cg,$cb);text-align:center;font-weight:bold;font-size:14px;'>$txt<br/><div style='width:50;height:50;background-color:rgb($cr,$cg,$cb);'><img src='images/bug$rn.png' border='0' height='50' width='50'/></div></td></tr></table>";
}


echo "<h2>";
echo getTranslation("Run on your servers (or not)",$_GET);
echo "</h2>";



echo "<table>";
for ($i=0;$i<20;$i++)
{
	echo "<tr>";
	for ($f=0;$f<20;$f++)
	{
		$cr=rand(1,255); 	$cg=rand(1,255); 	$cb=rand(1,255);
		echo "<td style='width:10;height:10;background-color:rgb($cr,$cg,$cb);font-size:6px;'>&nbsp;</td>";
	}
	echo "</tr>";
}
echo "</table>";

echo "<h2>";
echo getTranslation("Produce structured output",$_GET);
echo "</h2>";

echo "<img src='images/his-overview.png'/>";

echo "<h2>";
echo getTranslation("Simple. Elegant. Human.",$_GET);
echo "</h2>";

echo "<h2>";
echo getTranslation("Welcome to the Human Intelligence System.",$_GET);
echo "</h2>";

echo "</td>";
echo "</tr>";
echo "</table>";

echo "<br/>";
echo "<br/>";



}
}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="infrastructure")
{

echo "<img src='images/infrastructure-picture.png'/>";

echo "<span style='position:absolute;top:230px;left:400px;color:#333;'><h2>".getTranslation("HIS Functions written inside HIS Web Interface",$_GET)."</h2></span>";
echo "<span style='position:absolute;top:380px;left:400px;color:#333;'><h2>".getTranslation("Database is communications hub",$_GET)."</h2></span>";
echo "<span style='text-align:center;position:absolute;top:670px;left:150px;color:#333;'><h2>".getTranslation("Compute Servers Execute your HIS Functions",$_GET)."</h2></span>";

}
}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="download")
{

	echo "<h3 style='padding-left:30px;'>";
	echo getTranslation("STEP 1: HIS Web Interface - Source",$_GET);
	echo "</h3>";

	echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
	echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

	echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?get=current'>";
	echo getTranslation("Download",$_GET);
	echo " Zip (12MB)</a>";

	echo "<br/>";

	echo "<a style='zIndex:2;;color:black;' href='https://humanintelligencesystem.com/version?get=current&type=tar'>";
	echo getTranslation("Download",$_GET);
	echo " Tar (21MB)</a>";
	echo "<br/>";
	echo "<br/>";

	echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?get=current'>";
	echo getTranslation("Latest Release",$_GET);
	echo " Jul 16, 2014</a>";

	echo "<br/>";


	echo "</td>";
	echo "</tr>";
	echo "</table>";


	echo "<ul>";
	echo "<ul>";
	echo getTranslation("Extract to your www/ folder, and browse to index.php",$_GET);
	echo "</ul>";
	echo "</ul>";

	echo "<br/>";



	$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	if ( strpos($ua,"windows nt")===FALSE || isset($_GET['showall']) )
	{

		echo "<h3 style='padding-left:30px;'>";
		echo getTranslation("STEP 2: HIS Server - Linux Server Install Script",$_GET);
		echo "</h3>";

		echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
		echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

		echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?dl=server-linux'>";
		echo getTranslation("Download",$_GET);
		echo " Tar (6KB)</a>";

		echo "<br/>";
		echo "<br/>";


		echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?dl=server-linux'>";
		echo getTranslation("Latest Release",$_GET);
		echo " Oct 12, 2013</a>";
		echo "<br/>";
		echo "<span style='padding-left:30px;font-size:13px;'><a href='?v=addserver-linux' style='color:black;'>";
		//echo getTranslation("View Install Instructions Here",$_GET);
		echo "</a></span>";

		echo "<br/>";

		echo "</td>";
		echo "</tr>";
		echo "</table>";


		echo "<ul>";
		echo "<ul>";
		echo getTranslation("Run ./install-linux-his-server.sh",$_GET);
		echo "</ul>";
		echo "</ul>";

		echo "<br/>";

	}

	$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	if ( strpos($ua,"windows nt")!==FALSE || isset($_GET['showall']) )
	{
		echo "<h3 style='padding-left:30px;'>";
		echo getTranslation("STEP 2: HIS Server - Windows Server Install Script",$_GET);
		echo "</h3>";

		echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
		echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

		echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?dl=server-win'>";
		echo getTranslation("Download",$_GET);
		echo " Zip (1.8MB)</a>";

		echo "<br/>";
		echo "<br/>";

		echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?dl=server-win'>";
		echo getTranslation("Latest Release",$_GET);
		echo " Oct 12, 2013</a>";
		echo "<br/>";
		echo "<span style='padding-left:30px;font-size:13px;'><a href='?v=addserver-win' style='color:black;'>";
		//echo getTranslation("View Install Instructions Here",$_GET);
		echo "</a></span>";
		echo "<br/>";

		echo "</td>";
		echo "</tr>";
		echo "</table>";

		echo "<ul>";
		echo "<ul>";
		echo getTranslation("Double-click install-win-his-server.vbs",$_GET);
		echo "</ul>";
		echo "</ul>";

		echo "<br/>";


	}

	echo "<br/>";
	echo "<br/>";
	echo "<ul>";
	$lang_link_addition="";
	if ( isset($_GET['language']) )
	{
		$lang_link_addition="&language=".$_GET['language'];
	}
	if ( !isset($_GET['showall']) )
	{
		echo "<a href='?v=download&showall".$lang_link_addition."'>";
		echo getTranslation("Click here to show all Download options",$_GET);
		echo "</a>";
	}
	else
	{
		echo "<a href='?v=download".$lang_link_addition."'>";
		echo getTranslation("Click here to show normal Download options",$_GET);
		echo "</a>";
	}
	echo "<br/>";
	echo "<br/>";
	echo "<a href='https://humanintelligencesystem.com/all-downloads/'>";
	echo getTranslation("Click here to show older downloads",$_GET);
	echo "</a>";
	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";


}
}




if ( isset($_GET['v']) )
{
if ($_GET['v']=="feature")
{


echo "<h3>";
echo getTranslation("HIS Implementation Language (Web Interface & HIS Server)",$_GET);
echo "</h3>";
echo "<table style='padding-left:45px;' width='600'><tr><td valign='top'>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/php.png'/><br/>PHP<br/><br/></td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center' nowrap='nowrap'><img src='images/ruby.disabled.png'/><br/>Ruby<br/>(";
echo getTranslation("coming soon",$_GET);
echo ")</td></tr></table>";
echo "</td></tr></table>";



echo "<h3>";
echo getTranslation("Hosting Choices",$_GET);
echo "</h3>";
echo "<table style='padding-left:45px;' width='800'><tr><td>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/home.png'/><br/>".getTranslation("Your Machines",$_GET)."<br/>(".getTranslation("In-House",$_GET).")<br/><b style='color:green;'>".getTranslation("FREE",$_GET)."</b></td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td nowrap='nowrap' align='center'><img src='images/forest.png'/><br/>".getTranslation("Remote<br/>Machines",$_GET)."<br/>(".getTranslation("Your Cloud",$_GET).")<br/><b style='color:green;'>".getTranslation("FREE",$_GET)."</b></td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center' nowrap='nowrap'><img src='images/managed.png'/><br/>".getTranslation("Managed",$_GET)."<br/>SaaS<br/>(".getTranslation("Hosted",$_GET).")<br/><b style='color:red;'>".getTranslation('$$',$_GET)."/".getTranslation('month',$_GET)."</b></td></tr></table>";
echo "</td></tr></table>";


echo "<br/>";

/// SERVICES
$services_file=$BIN_DIR.$PATH_SEPERATOR."services.xml";
$service_doc = xmlToArray( simplexml_load_file($services_file) );
$SERVICES=array();
foreach ($service_doc as $services)
{
	foreach ($services as $service)
	{
		$SERVICES[]=new Service($service);
	}
}


function service_table($service_kind)
{
	global $SERVICES;

$dbc="";
$fsc="";
$idc=0;
$ifc=0;
foreach ($SERVICES as $service)
{
	$dstr="";
	if ($service->type=="database")
	{
		//if ($idc>3) $dstr=" disabled='disabled'";
		if (!$service->enabled) $dstr=" disabled='disabled'";
		$dbc=$dbc."<option value='".$service->name."'$dstr>".$service->name."</option>";
		$idc=$idc+1;
	}
	if ($service->type=="file-storage")
	{
		if ($ifc>2) $dstr=" disabled='disabled'";
		if (!$service->enabled) $dstr=" disabled='disabled'";
		$fsc=$fsc."<option value='".$service->name."'$dstr>".$service->name."</option>";
		$ifc=$ifc+1;
	}
} // foreach

		$core_configuration="database";
		$configuration_category="Application Memory System (Database)";


		$services_content="";
		//$services_content=$services_content."<h3>$configuration_category</h3>";
		$services_content=$services_content."<table width='700'>";
		$SIDX=0;
		foreach ($SERVICES as $SERVICE)
		{
			if ($SERVICE->type!="$service_kind") continue;
			$SIDX=$SIDX+1;
			if ($SIDX%4==1)
			{
				$services_content=$services_content."<tr>";
			}
			$services_content=$services_content."<td style='vertical-align:top;text-align:center;width:200px;'>";
			if ( strlen($SERVICE->home)>0 )
			{
			}
			if (strlen($SERVICE->icon)>0)
			{
				if ($SERVICE->enabled)
				{
					$services_content=$services_content."<img width=70 src='".($SERVICE->icon)."'/>";
				}
				else
				{
					$alttxt=str_replace("'","&rsquo;",$SERVICE->error);
					$services_content=$services_content."<img width=70 alt='$alttxt' title='$alttxt' src='".str_replace("png","disabled.png",$SERVICE->icon)."'/>";
				}
				$services_content=$services_content."<br/>";
			}
			else
			{
				$services_content=$services_content."<img width='70' height='70' />";
				$services_content=$services_content."<br/>";
			}
			$services_content=$services_content.($SERVICE->name);
			if ( strlen($SERVICE->home)>0 )
			{
			}
			if (!$SERVICE->enabled)
			{
				$alttxt=str_replace("'","&rsquo;",$SERVICE->error);
				$alttxt=str_replace("\"","&quot;",$SERVICE->error);
				$services_content=$services_content."<br/><input type='button' value='".getTranslation('view problems',$_GET)."' onClick=\"alert('$alttxt')\" style='margin:0px;font-size:8px;' />";
			}
			$services_content=$services_content."</td>";
			if (($SIDX+1)%4==1)
			{
				$services_content=$services_content."</tr>";
			}
		} // end foreach (service)
		$services_content=$services_content."</table>";


echo $services_content;
		//echo $PAGE->content();

}


echo "<h3>";
echo "HIS ";
echo getTranslation("Infrastructure",$_GET);
echo " - ";
echo getTranslation("Database Choices",$_GET);
echo "</h3>";
echo "<ul>";
$show_type="database";
service_table($show_type);
echo "</ul>";

echo "<h3>";
echo "HIS ";
echo getTranslation("Infrastructure",$_GET);
echo " - ";
echo getTranslation("File Storage Choices",$_GET);
echo "</h3>";

echo "<ul>";
$show_type="file-storage";
service_table($show_type);
echo "</ul>";

echo "<h3>";
echo "HIS ";
echo getTranslation("Infrastructure",$_GET);
echo " - ";
echo getTranslation("Message Queue Choices",$_GET);
echo "</h3>";

echo "<ul>";
$show_type="message-queue";
service_table($show_type);
echo "</ul>";



echo "<h3>";
echo getTranslation("HIS Software Function Inheritable Samples",$_GET);
echo "</h3>";

echo "<ul>";
echo "<table width='700'><tr><td style='padding-left:30px;'>";
foreach ($STATIC['hf_resource_types'] as $resource_type_key=>$resource_type_value)
{
	$rn=rand(1,6);	$cr=rand(1,255); 	$cg=rand(1,255); 	$cb=rand(1,255);
	$txt=$resource_type_key;
	$txt=str_replace("remote-","",$txt);
	if ( strpos($txt,"-")!==FALSE )
	{
		$txt=substr($txt,0,strpos($txt,"-") );
	}
	echo "<table style='display:inline;'><tr><td style='color:rgb($cr,$cg,$cb);text-align:center;font-weight:bold;font-size:14px;'>$txt<br/><div style='width:50;height:50;background-color:rgb($cr,$cg,$cb);'><img src='images/bug$rn.png' border='0' width='50' height='50'/></div></td></tr></table>";
}
echo "</td></tr></table>";
echo "</ul>";



echo "<h3>";
echo getTranslation("Language Choices",$_GET);
echo "</h3>";
echo "<ul>";

$langs = array_keys($translation['Purpose']);

echo "<div style='width:700px;'>";
foreach ($langs as $a_lang)
{
	echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td><a href='?v=feature&language=$a_lang'><img border='0' src='images/$a_lang.png'/></a></td></tr></table>";
}
echo "</div>";

echo "</ul>";


echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "<h3>";
echo getTranslation("Compute Node (HIS Server) - Operating System Choices",$_GET);
echo "</h3>";
echo "<ul>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/windows8.png'/><br/>Windows</td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/linux.png'/><br/>Linux</td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/mac.png'/><br/>Mac</td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/solaris.png'/><br/>Solaris</td></tr></table>";
echo "<br/>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/freebsd.png'/><br/>FreeBSD</td></tr></table>";
echo "<table style='display:inline;padding:20px;width:90px;height:90px;'><tr><td align='center'><img src='images/cygwin.png'/><br/>Cygwin</td></tr></table>";
echo "</ul>";


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

}
}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="install")
{

echo "<a href='install.php'>";
echo getTranslation("Click Here",$_GET);
echo "</a> ";
echo getTranslation("to begin the installation process.",$_GET);

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

}
}

if ( isset($_GET['v']) )
{
if ($_GET['v']=="why")
{


echo "<br/>";
echo "<br/>";


echo "<br/>";
echo "<br/>";

echo getTranslation("HIS is a HTTP API Generator/Job Cluster for your automation.",$_GET);
echo "<br/>";
echo "<br/>";

echo getTranslation("HIS was created because other systems make it too complicated.",$_GET);
echo "<br/>";
echo "<br/>";


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
}
}

echo "<br/>";

echo "<table width='700'><tr><td align='center'>";

$langs = array_keys($translation['Purpose']);
foreach ($langs as $a_lang)
{
	$v_link="";
	if ( isset($_GET['v']) )
	{
		$v_link="v=".urlencode($_GET['v'])."&";
	}
	echo "<a style='margin-left:20px;;margin-right:20px;' href='?$v_link"."language=$a_lang'><img border='0' src='images/$a_lang.sm.png'/></a>";
}
echo "<br/>";

echo "</td></tr></table>";


?>
