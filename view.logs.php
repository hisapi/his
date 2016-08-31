<?php

error_reporting(-1);
ini_set('error_reporting', E_ALL);

$log_width=300;
$log_height=300;
$log_size=9;
$refresh_every_x_minutes=0.5;

require_once("controller.guard.php");
include_once("controller.action_handler.php");
require_once("model.classes.php");

echo "<html lang='".getTranslation('iso639',$settings)."' xmlns='http://www.w3.org/1999/xhtml' ><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta http-equiv='Content-Language' Content='".getTranslation('iso639',$settings)."'/>
<!--<title>HIS </title>-->
<!--<link rel='stylesheet' href='templates/install.css?ver=0.1.1' type='text/css' />-->
</head>
<body>";


echo "<head><style>* {font-family:'Myriad Pro',Trebuchet,Verdana;}</style></head>";

echo "<body bgColor='black' style='color:white;' link='white' vlink='white' alink'red'/>";

echo "<center>";
echo "<a href='index.php?v=map' style='color:white;'>";
echo getTranslation("Go Back to Cluster Map",$settings);
echo "</a>";
echo "<br/>";
echo "<br/>";
echo "<br/>";

$u->build(array("obj_hfs","obj_inherits"));

if ( count($u->obj_servers)>0)
{
	echo getTranslation("Page automatically refreshes every",$settings);
	echo " ".$refresh_every_x_minutes." ";
	echo getTranslation("minutes",$settings);
	echo "<br/>";
	echo "<form onsubmit='return confirm(\"";
	echo getTranslation("Restart ALL Servers",$settings);
	echo "?\");' style='display:inline;align:right' method='post' action='?action=ras'><input style='font-size:9px;' type='submit' name='restart' value='% ";
	echo getTranslation("Restart ALL Servers",$settings);
	echo " %' title='Restart ALL Servers' alt='";
	echo getTranslation("Restart ALL Servers",$settings);
	echo "'/></form>";
	echo "<br/>";
	echo "<input type='button' onClick='window.location.reload(true);' value='";
	echo getTranslation("Refresh Log Page Now",$settings);
	echo "'/>";
	echo "<br/>";
	echo "<br/>";
}
	
$idx=0;
foreach ($u->obj_servers as $job_node)
{
	$job_node->build();

	$show_rdp=false;
	foreach ($u->obj_system_kinds as $usk)
	{
		if ($usk->id==$job_node->id_sk)
		{
			if (strtolower($usk->name)=="windows")
			{
				$show_rdp=true;
			}
		}
	}

	echo "<table width='$log_width' align='left' border='1'>";
	$timespan="";
	$is_past=false;
	$is_future=false;
	if ( intval(gmdate('U')) > intval($job_node->last_ping) )
	{
		$timespan=time_elapsed(intval(gmdate('U'))-intval($job_node->last_ping));
		$is_past=true;
	}
	elseif ( intval(gmdate('U')) < intval($job_node->last_ping) )
	{
		$timespan=time_elapsed(intval($job_node->last_ping)-intval(gmdate('U')));
		$is_future=true;
	}
	if ( strlen( $timespan)==0 )
	{
		$timespan="0s";
		$is_past=true;
	}

	$bgcolor="white";
	$tcolor="black";
	if ( strpos($timespan,"s")!==FALSE)
	{
		$bgcolor="green";
		$tcolor="white";
	}
	if ( strpos($timespan,"m")!==FALSE)
	{
		$bgcolor="yellow";
		$tcolor="black";
	}
	if ( strpos($timespan,"h")!==FALSE)
	{
		$bgcolor="red";
		$tcolor="white";
	}
	if ( strpos($timespan,"d")!==FALSE)
	{
		$bgcolor="gray";
		$tcolor="white";
	}
	if ( strpos($timespan,"y")!==FALSE)
	{
		$bgcolor="black";
		$tcolor="white";
	}
	if ($is_future)
	{
		$bgcolor="blue";
		$tcolor="white";
	}
	if (intval($job_node->int_online)!=1)
	{
		$bgcolor="gray";
		$tcolor="black";
	}
	
	echo "<tr><td style='background-color:$bgcolor;color:$tcolor;';>";

	$svr_name=$job_node->name;
	$icons="";

	// rackspace
	if (strpos($svr_name,"rackspace")!==false)
	{
		$icons=$icons."<img width='30' height='30' src='images/rackspace.png'/>";
	}

	// godaddy
	if (strpos($svr_name,"godaddy")!==false)
	{
		$icons=$icons."<img width='30' height='30' src='images/godaddy.png'/>";
	}

	// 1and1
	if (strpos($svr_name,"1and1")!==false || strpos($svr_name,"1&1")!==false)
	{
		$icons=$icons."<img width='30' height='30' src='images/1and1.png'/>";
	}

	// appscale
	if (strpos($svr_name,"appscale")!==false )
	{
		$icons=$icons."<img width='30' height='30' src='images/appscale.png'/>";
	}

	// cloudfoundry
	if (strpos($svr_name,"cloud")!==false && strpos($svr_name,"foundry")!==false )
	{
		$icons=$icons."<img width='30' height='30' src='images/cloudfoundry.png'/>";
	}

	// hpcloud
	if (strpos($svr_name,"hp")!==false )
	{
		$icons=$icons."<img width='30' height='30' src='images/hpcloud.png'/>";
	}

	// aws
	if (strpos($svr_name,"aws")!==false)
	{
		$icons=$icons."<img width='30' height='30' src='images/iconaws.png'/>";
	}
	if ($show_rdp)
	{
		$icons=$icons."<a href='download.php?dl=rdp&server=".$svr_name."'>";
		$icons=$icons."<img width='30' height='30' border='0' src='images/rdp.png'/>";
		$icons=$icons."</a>";
	}

	$icons=$icons."&nbsp;";
	$icons=$icons."&nbsp;";

	// ubuntu
	if (strpos($svr_name,"linux")!==false)
	{
		if (strpos($svr_name,"debian")!==false)
		{
			// debian
			$icons=$icons."<img width='30' height='30' src='images/debian.png'/>";
		}
		else
		{
			// ubuntu
			$icons=$icons."<img width='30' height='30' src='images/ubuntu.png'/>";
		}
	}

	// windows
	if (strpos($svr_name,"win")!==false)
	{
		if (strpos($svr_name,"win7")!==false)
		{
			$icons=$icons."<img width='30' height='30' src='images/win7.png'/>";
		}
		elseif  (strpos($svr_name,"2008")!==false)
		{
			$icons=$icons."<img width='30' height='30' src='images/win2008.png'/>";
		}
		else
		{
			$icons=$icons."<img width='30' height='30' src='images/win2008.png'/>";
		}
	}

	echo "<center>";
	echo $icons;
	echo "</center>";
	echo "<span style='font-size:18px;font-weight:bold;'>";
	echo $job_node->name;
	echo "</span>";
	echo "<br/>";
	echo getTranslation("last check-in was",$settings);
	echo " $timespan";
	if ($is_past)
	{
		echo " ";
		echo getTranslation("ago",$settings);
	}
	if ($is_future)
	{
		echo " ";
		echo getTranslation("from now",$settings);
	}
	echo "<br/>";

	echo "<div style='width:100%;'><form style='display:inline;text-align:right;' method='post' action='?action=rss'><input type='hidden' name='server_name' value='".$job_node->name."'/><input style='font-size:9px;' type='submit' name='restart' value='% ";
	echo getTranslation("Restart Server",$settings);
	echo "' title='";
	echo getTranslation("Restart Server",$settings);
	echo "' alt='";
	echo getTranslation("Restart Server",$settings);
	echo "'/></form></div>";

	echo "</td></tr>";
	echo "<tr><td>";
	echo "<textarea id='log$idx' style='font-size:$log_size"."px;width:$log_width;height:$log_height;background-color:black;color:white;'>";
	$log_content=$job_node->obj_log->body;
	$log_content=str_replace("&","&amp;",$log_content);
	$log_content=str_replace("<","&lt;",$log_content);
	$log_content=str_replace(">","&gt;",$log_content);
	$log_content=str_replace("\n\n","\n",$log_content);
	echo $log_content;
	echo "</textarea>";

	echo "</td></tr>";

	echo "<tr><td align='center'>";
	echo "<input type='button' onClick='window.location.reload(true);' value='";
	echo getTranslation("Refresh Log Page Now",$settings);
	echo "'/>";
	echo "</td></tr>";

	echo "</table>";

	$idx=$idx+1;
} // end for each through job nodes


if (count($u->obj_servers)==0)
{
	echo getTranslation("No job servers currently exist.  Go to the Cluster Map page and add some!",$settings);
}

echo "
<script type='text/javascript'>
for(var i=0;i<".count($u->obj_servers).";i++)
{
	var textArea = document.getElementById('log'+i);
	textArea.scrollTop = textArea.scrollHeight;
}
setTimeout('window.location.reload(true);',60*1000*$refresh_every_x_minutes)
</script>
";


?>
