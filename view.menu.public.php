<?php
// gui


$show_head=false;
if ( isset($_GET['v']) )
{
	if ( $_GET['v'] != "login" )
	{
		$show_head=true;
	}
}

if ($show_head)
{
echo "<html lang='".getTranslation('iso639',$_GET)."' xmlns='http://www.w3.org/1999/xhtml' ><head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta http-equiv='Content-Language' Content='".getTranslation('iso639',$_GET)."'/>
<!--<title>HIS </title>-->
<!--<link rel='stylesheet' href='templates/install.css?ver=0.1.1' type='text/css' />-->
</head>
<body>";

}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="login")
{
	if (!$APP['u'])
	{
		include("login.php");
		exit;
	}
}
}


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

$public_menu=array();
$public_menu["purpose"]="Human Intelligence System";
//$public_menu["why"]="What is this, and Why?";
$public_menu["download"]="Download";
$public_menu["infrastructure"]="Infrastructure";
$public_menu["feature"]="Features";
$public_menu["news"]="News";
if ( !file_exists("his-config.php") )
{
	$public_menu["install"]="Install";
}
else
{
	$public_menu["login"]="Login";
}

$added_v=false;

if ( !isset($_GET['v']) )
{
	$_GET['v']="purpose";
	$added_v=true;
}
if ( isset($_GET['v']) )
{
	if ( !array_key_exists($_GET['v'],$public_menu) )
	{
		$_GET['GET___v']=$_GET['v'];
		$_GET['v']="purpose";
		$added_v=true;
	}
}


$image_width=70;
$font_size=9;
$font_style="";
// COLUMN 1
echo "<table width='100%' style='display:inline;'>";
/*if ($detect->isMobile())
{
	$image_width=90;
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


	echo "<table cellspacing='1' cellpadding='1' width='700'><tr><td align='left'>";

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
	//echo "<br/>";

	echo "</td></tr></table>";

$forwarded_login=false;

if ( isset($_GET['GET___v']) || count($_POST)>0 )
{
	if ( !in_array($_GET['GET___v'],array_keys($public_menu)) )
	{
		$forwarded_login=true;
	}
}

foreach ($public_menu as $menu_key=>$menu_value)
{
	$existing_q="";
	if (isset($_GET['q']))
	{
		$existing_q="q=".$_GET['q']."&";	
	}
	$existing_lang="";
	if (isset($_GET['language']))
	{
		$existing_lang="language=".$_GET['language']."&";	
	}

	if ($menu_key!="login" || !$forwarded_login)
	{
		echo "<a style='color:black;$font_style' href='?$existing_lang$existing_q"."v=$menu_key$view_filtering_get'>";
		echo "<img border='0' alt='".getTranslation($menu_value,$_GET)."' title='".getTranslation($menu_value,$_GET)."' width=$image_width height=$image_width src='images/".$menu_key.".png'/>";
		echo "</a>";
	}
	elseif ($menu_key=="login" && $forwarded_login)
	{
		echo "<form action='?$existing_lang"."v=$menu_key' method='post' style='display:inline;'>";
		foreach ($_GET as $GK=>$GV)
		{
			if ( strpos($GK,"GET___")!==false )
			{
				echo "<input type='hidden' name='".htmlspecialchars($GK,ENT_QUOTES)."' value='".htmlspecialchars($GV,ENT_QUOTES)."'/>";
			}
			else
			{
				if (!isset($_GET['GET___'.$GK]) && !($GK=="v" && $added_v)  )
				{
					echo "<input type='hidden' name='GET___".htmlspecialchars($GK,ENT_QUOTES)."' value='".htmlspecialchars($GV,ENT_QUOTES)."'/>";
				}
			}
		}
		foreach ($_POST as $PK=>$PV)
		{
			if ( is_array($PV) )
			{
				foreach ($PV as $PVA)
				{
					echo "<input type='hidden' name='POST___".htmlspecialchars((string)$PK,ENT_QUOTES)."[]' value='".htmlspecialchars((string)$PVA,ENT_QUOTES)."'/>";
				}
			}
			else
			{
				echo "<input type='hidden' name='POST___".htmlspecialchars((string)$PK,ENT_QUOTES)."' value='".htmlspecialchars((string)$PV,ENT_QUOTES)."'/>";
			}
		}
		echo "<input type='image' alt='".getTranslation($menu_value,$_GET)."' title='".getTranslation($menu_value,$_GET)."' style='width:".$image_width.";height:".$image_width.";' width=$image_width height=$image_width src='images/".$menu_key.".png'/>";
		echo "</form>";
	}

} // END FOREACH


echo "<br/>";

?>
