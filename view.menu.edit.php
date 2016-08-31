<?php
// gui

$is_dark=false;

header('Content-Type: text/html; charset=utf-8');

echo "<style>";
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

$menu=array();
$menu["overview"]="Overview";
$menu["input-resource"]="Input Resource";
$menu["filtering-expression"]="Filtering Expression";
$menu["hf-parameters"]="Function Parameters";
$menu["node-filters"]="Server Filters";
$menu["mime"]="MIME Output Type";
$menu["time"]="Time Behavior";
$menu["output-expression"]="Output Expression";
$menu["techniques"]="Techniques";
//$menu["gui"]="GUI";
$menu["integration"]="Integration";
//$menu["node-passwords"]="Node Passwords";
$menu["gather"]="Resource Gathering";
$menu["hf-tags"]="Function Tags";
//$menu["content-approval"]="Content Approval";

if ( !isset($_GET['v']) )
{
	$_GET['v']="overview";
}

if ( isset($_GET['v']) )
{
	if ( in_array($_GET['v'],array_keys($menu)) )
	{
	}
}


// COLUMN 1
echo "<table border='0' width='100%' style='display:inline;'>";
$image_width=50;
/*if ($detect->isMobile())
{
	$image_width=62;
}*/
echo "<tr><td>";

$view_filtering_get="";
if ( isset($_GET['view-filtering']) )
{
	if ( $_GET['view-filtering']=="true")
	{
		$view_filtering_get="&view-filtering=true";
	}
}

$i=0;
foreach ($menu as $menu_key=>$menu_value)
{
	echo "<table style='display:inline;' border=0><tr><td width='$image_width' height='".($image_width+0)."' valign='top' style='font-size:9px;text-align:center;'>";
	echo "<a style='color:black;' href='?q=$qn&v=$menu_key$view_filtering_get'><img border='0' alt='".getTranslation($menu_value,$settings)."' title='".getTranslation($menu_value,$settings)."' width=$image_width height=$image_width src='images/".$menu_key.".png'/><!--<br/>".getTranslation($menu_value,$settings);
	echo "--></td></tr></table>";
	$i=$i+1;
}

$back_link="";
if ( isset( $_GET['v'] ) )
{
	if ( !in_array($_GET['v'],array_keys($menu) ) )
	{
		$back_link="v=".$_GET['v'];
	}
}

echo "<table style='display:inline;' border=0><tr><td width='$image_width' height='".($image_width+0)."' valign='top' style='font-size:9px;text-align:center;'>";
echo "<a style='color:black;' href='?$back_link'><img border='0' width=$image_width alt='".getTranslation("Back",$settings)."' title='".getTranslation("Back",$settings)."' height=$image_width src='images/back.png'/><!--<br/>".getTranslation("Back",$settings)."-->";
echo "</td></tr></table>";
echo "<br/>";

$the_v="";
if ( isset($_GET['v']) )
{
	$the_v="&v=".$_GET['v'];
}
echo "<table><tr><td valign='center' style='vertical-align:center;'>";
echo "<a href='?q=$qn$the_v&action=regather-latest-cache$view_filtering_get'>";
echo "<img border='0' src='images/shortcut-gather.png' width='50'/>";
echo "<font style='font-size:9px;color:black;'>";
echo getTranslation("Regather Latest Cache",$settings);
echo "</font>";
echo "</a>";
echo " ";
$link_view_filtering="true";
$link_show_hide="Show";
if ( isset($_GET['view-filtering']) )
{
	if ( $_GET['view-filtering']=="true")
	{
		$link_view_filtering="false";
		$link_show_hide="Hide";
	}
}
echo "<a href='?q=$qn$the_v&view-filtering=$link_view_filtering'>";
echo "<img border='0' src='images/shortcut-filtering.png' width='50'/>";
echo "<font style='font-size:9px;color:black;'>";
echo getTranslation("$link_show_hide",$settings);
echo " ";
echo getTranslation("Filtering Interface on this Page",$settings);
echo "</font>";
echo "</a>";
echo "</td></tr></table>";
echo "<br/>";

?>
