<?php
// gui

$is_dark=false;

header('Content-Type: text/html; charset=utf-8');

echo "<style>";
echo "* {font-family:'Myriad Pro',Trebuchet,Verdana;}";
if ($is_dark)
{
	echo "textarea {background-color:#222;color:white;";
	echo "input {background-color:#222;color:white;";
	echo "select {background-color:#222;color:white;";
	echo "option {background-color:#222;color:white;";
}
echo "</style>";

if ($is_dark)
{
	echo "<body bgColor='#222'>";
}
else
{
	echo "<body>";
}

//echo "<script>alert(window.innerHeight);</script>";

$main_menu=array();
$main_menu["his-overview"]="Overview";
$main_menu["hf-list"]="Function List";
$main_menu["add-hf"]="Add Function or Add User";
$main_menu["job-servers"]="Job Cluster";
$main_menu["map"]="Cluster Map";
$main_menu["features"]="Compatability and Features";
$main_menu["find-hf"]="Search Tags";
$main_menu["server-info"]="Information";
$main_menu["settings"]="Settings";
$main_menu["download"]="Download";
$main_menu["import"]="Import Function";

if ( !isset($_GET['v']) && !isset($_GET['s']) && !isset($_GET['q']) )
{
	$_GET['v']="his-overview";
}

$image_width=70;
$font_size=9;
$font_style="";
// COLUMN 1
echo "<table width='100%' style='display:inline;'>";
/*if ($detect->isMobile())
{
	$image_width=80;
	$font_size=20;
	$font_style="font-weight:bold;";
}*/

$view_filtering_get="";
if ( isset($_GET['view-filtering']) && isset($_GET['q']) )
{
        if ( $_GET['view-filtering']=="true")
        {
                $view_filtering_get="&view-filtering=true";
        }
}


foreach ($main_menu as $menu_key=>$menu_value)
{
	if ($menu_key=="import") continue;
	$existing_q="";
	if (isset($_GET['q']))
	{
		$existing_q="q=".$_GET['q']."&";
	}
	echo "<a style='color:black;$font_style' href='?$existing_q"."v=$menu_key$view_filtering_get'>";
	echo "<img border='0' alt='".getTranslation($menu_value,$settings)."' title='".getTranslation($menu_value,$settings)."' width=$image_width height=$image_width src='images/".$menu_key.".png'/>";
	echo "</a>";
}

echo "<form style='display:inline;' action='logout.php' onSubmit='return confirm(\"".getTranslation('Confirm Logout?',$settings)."\");'><input type='image' alt='".getTranslation('Confirm Logout?',$settings)."' title='".getTranslation('Confirm Logout?',$settings)."' style='width:$image_width;height:$image_width;' src='images/back.png'/></form>";
echo "<br/>";
?>