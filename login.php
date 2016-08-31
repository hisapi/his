<?php
require_once("model.classes.php");

error_reporting(-1);
ini_set('error_reporting', E_ALL);

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


$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
if ( !file_exists($settings_file) )
{
	header("Location: install.php");
	exit;
}
if ( isset($_POST['btnSubmit']) )
{
	if ( isset($_POST['log']) && isset($_POST['pwd']) )
	{
		if ( strlen($_POST['log'])>0 && strlen($_POST['pwd'])>0)
		{
			// open settings file
			$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
			if ( !file_exists($settings_file) )
			{
				include("existsmessage.php");
				exit;
			}
			else
			{
				include_once($settings_file);
			}

			if (!$APP['db']->connected)
			{
				include("existsmessage.php");
				exit;
			}
			$pre_hash=$settings['salt1']['@attributes']['value'].$_POST['pwd'].$_POST['log'].$settings['salt2']['@attributes']['value'];
			$login_hash=sha1($pre_hash);

			$_POST['log']=str_replace(":","",$_POST['log']);

			$user_login = new user_user_name();
			//$user_login->obj_debug=true;
			$user_login->get_from_hashrange($_POST['log']);
			$db_user_pw_hash="";
			if ($user_login->id_user!="undefined")
			{
				$db_user_pw_hash=$user_login->pw;
			}

			//echo ($login_hash ."    ===    ".$db_user_pw_hash);
			if ($login_hash == $db_user_pw_hash && strlen($db_user_pw_hash)>0 )
			{
				$expire=time()+(60*60*2); // 2 hrs
				if ( isset($_POST['rememberme']) )
				{
					if ($_POST['rememberme']=="forever")
					{
						$expire=time()+(60*60*24*7); // 1 week
					}
				}
				if (strpos($_SERVER['HTTP_HOST'],"localhost")===false)
				{
					$cookied=setcookie("hisdata", $_POST['log'].":".$login_hash, $expire,"/",$_SERVER['HTTP_HOST'],false,true);
				}
				else
				{
					$cookied=setcookie("hisdata", $_POST['log'].":".$login_hash, $expire,"/","",false,true);
				}
				if ($cookied)
				{
					$u=$user_login;
					if ( isset($_POST['log']) )
					{
						unset($_POST['log']);
					}
					if ( isset($_POST['pwd']) )
					{
						unset($_POST['pwd']);
					}
					if ( isset($_POST['btnSubmit']) )
					{
						unset($_POST['btnSubmit']);
					}

					$forwarded_login=false;

					foreach ($_POST as $PK=>$PV)
					{
						if ( strpos($PK,"GET___")!==false)
						{
							$forwarded_login=true;
							$_GET[str_replace("GET___","",$PK)]=$PV;
						}
						if ( strpos($PK,"POST___")!==false)
						{
							$forwarded_login=true;
							$_POST[str_replace("POST___","",$PK)]=$PV;
						}
						unset($_POST[$PK]);
					}
					if ($forwarded_login)
					{
						include("index.php");
					}
					else
					{
						echo "<script>setTimeout(\"window.location='index.php';\",300);</script>";
						echo "<noscript>Login Successful.  Click <a href='index.php'>here</a> to go to the index page.</noscript>";
					}
					exit;
				}
				else
				{
					echo "Failed to create cookie";
				}
			}
		} // end if (user fields given in form not blank)
	} // end if (user fields)
}


?>
<!DOCTYPE html>
<?php
	echo "<html lang='".getTranslation('iso639',$settings)."' xmlns='http://www.w3.org/1999/xhtml' ><head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='Content-Language' Content='".getTranslation('iso639',$settings)."'/>
	<title>".getTranslation("Human Intelligence System",$settings)." &rsaquo; ".getTranslation("Log In",$settings)."</title>";
?>
	<link rel='stylesheet' id='his-admin-css'  href='templates/his-admin.css?ver=0.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='colors-fresh-css'  href='templates/colors-fresh.css?ver=0.1.1' type='text/css' media='all' />
<meta name='robots' content='noindex,nofollow' />
	</head>
	<body class="login">

	<div id="login" style=';'>
	
		<table style='margin-left:-90px;'><tr><td valign='center' style='padding-right:10px;'>
		<img alt='HIS' src='images/his-only.png' />
		</td><td nowrap='nowrap'>
		<h1 id='logo' style='text-align:center;display:inline;font:30px Georgia,"Times New Roman",Times,serif;'>
		<?php
		
		echo getTranslation('Human Intelligence System',$settings);
		
		?>
		</h1>
		</td></tr></table><br/>

<?php
if ( isset($_GET['logged']) )
{
	echo "	<p class=\"message\">	You are now logged out.<br /></p>";
}
else
{
	if ( isset($_POST['btnSubmit']) )
	{
		echo "	<p class=\"message\" >Login failed, try again.<br /></p>";
	}
	else
	{
		echo "	<p class=\"message\" style='opacity:0;'><br /></p>";
	}
}
?>
<form name="loginform" id="loginform" action="index.php?v=login" method="post">
	<p>
		<label for="user_login"><?php echo getTranslation("Username",$settings); ?><br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label for="user_pass"><?php echo getTranslation("Password",$settings); ?><br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
	</p>
<?php


foreach ($_POST as $PK=>$PV)
{
	if ( strpos($PK,"POST___")!==false || strpos($PK,"GET___")!==false)
	{
		if ( is_array($PV) )
		{
			foreach ($PV as $PVA)
			{
				echo "<input type='hidden' name='".htmlspecialchars($PK,ENT_QUOTES)."[]' value='".htmlspecialchars($PVA,ENT_QUOTES)."'/>";
			}
		}
		else
		{
			echo "<input type='hidden' name='".htmlspecialchars($PK,ENT_QUOTES)."' value='".htmlspecialchars($PV,ENT_QUOTES)."'/>";
		}
	}
}

?>


	<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> <?php echo getTranslation("Remember Me",$settings); ?></label></p>
	<p class="submit">
		<input type="submit" name="btnSubmit" id="wp-submit" class="button-primary" value="<?php echo getTranslation("Log In",$settings); ?>" tabindex="100" />
	</p>
</form>

<p id="nav">
<a href="index.php" title="<?php echo getTranslation("Go Back to HIS",$settings); ?>"><?php echo getTranslation("Go Back to HIS",$settings); ?></a>
</p>
<script type="text/javascript">
function attempt_focus(){
setTimeout( function(){ try{
d = document.getElementById('user_login');
d.focus();
d.select();
} catch(e){}
}, 200);
}

//if(typeof wpOnload=='function')wpOnload();
attempt_focus();
</script>

<!--
	<p id="backtoblog"><a href="http://hisapi.com/" title="Are you lost?">&larr; Back to Human Intelligence System</a></p>
-->

	</div>


		<div class="clear"></div>
	</body>
	</html>
