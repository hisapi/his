<?php
echo " ";
ini_set('display_errors', 'On');
error_reporting(E_ALL);

$this_server_url="";
global $this_server_url;

$this_http="http";
if ( isset($_SERVER['HTTPS']) )
{
	if ($_SERVER['HTTPS']=="on")
	{
		$this_http="https";
	}
}

if ( isset($_SERVER['HTTP_HOST']) )
{
	$this_server_url=$this_http."://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	$this_server_url=str_replace("/install.php", "", $this_server_url);
}

include_once("version.php");
include_once("model.classes.php");
if ( isset($_POST['language']) )
{
	header("Content-Language: ".getTranslation('iso639',$_POST));
}

$_COOKIE['hisdata']="";
$expire=time()-3600;
if (strpos($_SERVER['HTTP_HOST'],"localhost")===false)
{
	$cookied=setcookie("hisdata", "", $expire,"/",$_SERVER['HTTP_HOST'],false,true);
}
else
{
	$cookied=setcookie("hisdata", "", $expire,"/","",false,true);
}



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

foreach ($_GET as $GK=>$GV)
{
    $_POST[$GK]=$GV;
}

$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
if ( file_exists($settings_file) )
{
	if ( !isset($_GET['page']) || intval($_GET['page'])<11 )
	{
		include("templates/existsmessage.php");
		exit;
	}
}

if ( !isset($_GET['page']) && !file_exists($settings_file) )
{
	include("templates/noconfig.php");
	exit;
}

if ( isset($_GET['page']) )
{
	if (intval($_GET['page'])==1)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('installpage'.$_GET['page'],$_POST)."</p>";
		echo $PAGE->content();
		exit;
	}
}

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

$dbc="";
$fsc="";
$msc="";
$idc=0;
$ifc=0;
$imc=0;
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
		if ($ifc>2 && $ifc!=4 && $ifc!=8) $dstr=" disabled='disabled'";
		if (!$service->enabled) $dstr=" disabled='disabled'";
		$fsc=$fsc."<option value='".$service->name."'$dstr>".$service->name."</option>";
		$ifc=$ifc+1;
	}
	if ($service->type=="message-queue")
	{
		//if ($ifc>2) $dstr=" disabled='disabled'";
		if (!$service->enabled) $dstr=" disabled='disabled'";
		$msc=$msc."<option value='".$service->name."'$dstr>".$service->name."</option>";
		$imc=$imc+1;
	}
} // foreach

// SHOW SERVICES INVENTORY
if ( isset($_GET['page']) )
{
	if ($_GET['page']==2 || $_GET['page']==3 || $_GET['page']==4)
	{
		$core_configuration="database";
		$configuration_category="Application Memory System (Database)";
		if ($_GET['page']==3)
		{
			$core_configuration="file-storage";
			$configuration_category="File Storage (Storage)";
		}
		if ($_GET['page']==4)
		{
			$core_configuration="message-queue";
			$configuration_category="Message Queue";
		}

		$PAGE=new SetupPage($_GET['page']);
        $PAGE->hide_refresh=false;
		$PAGE->title="<p>".getTranslation('installpage'.$_GET['page'],$_POST)."</p>";

		$PAGE->body=<<<EOD
		<tr>
			<td>
EOD;
		//$PAGE->body=$PAGE->body."<h3>$configuration_category</h3>";
		$PAGE->body=$PAGE->body."<table width='100%'>";
		$SIDX=0;
		foreach ($SERVICES as $SERVICE)
		{
			if ($SERVICE->type!="$core_configuration") continue;
			$SIDX=$SIDX+1;
			if ($SIDX%4==1)
			{
				$PAGE->body=$PAGE->body."<tr>";
			}
			$PAGE->body=$PAGE->body."<td style='vertical-align:top;text-align:center;width:200px;'>";
			if ( strlen($SERVICE->home)>0 )
			{
			}
			if (strlen($SERVICE->icon)>0)
			{
				if ($SERVICE->enabled)
				{
					$PAGE->body=$PAGE->body."<img width=70 src='".($SERVICE->icon)."'/>";
				}
				else
				{
					$alttxt=str_replace("'","&rsquo;",$SERVICE->error);
					$PAGE->body=$PAGE->body."<img width=70 alt='$alttxt' title='$alttxt' src='".str_replace("png","disabled.png",$SERVICE->icon)."'/>";
				}
				$PAGE->body=$PAGE->body."<br/>";
			}
			else
			{
				$PAGE->body=$PAGE->body."<img width='70' height='70' />";
				$PAGE->body=$PAGE->body."<br/>";
			}
			$PAGE->body=$PAGE->body.($SERVICE->name);
			if ( strlen($SERVICE->home)>0 )
			{
			}
			if (!$SERVICE->enabled)
			{
				$alttxt=str_replace("'","&rsquo;",$SERVICE->error);
				$alttxt=str_replace("\"","&quot;",$SERVICE->error);
				$PAGE->body=$PAGE->body."<br/><input type='button' value='".getTranslation('view problems',$_POST)."' onClick=\"alert('$alttxt')\" style='margin:0px;font-size:8px;' />";
			}
			$PAGE->body=$PAGE->body."</td>";
			if (($SIDX+1)%4==1)
			{
				$PAGE->body=$PAGE->body."</tr>";
			}
		} // end foreach (service)
		$PAGE->body=$PAGE->body."</table>";

		$PAGE->body=$PAGE->body.<<<EOD
			</td>
		</tr>
EOD;
		echo $PAGE->content();
		exit;
	}
}


// WHAT TYPE OF DATABASE?
if ( isset($_GET['page']) )
{
	if ($_GET['page']==5)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('enter database details',$_POST)."</p>";
		$PAGE->body=<<<EOD
		<tr>
			<th scope="row"><label for="uname">
EOD;
$PAGE->body=$PAGE->body.getTranslation('Database Type',$_POST);
$PAGE->body=$PAGE->body."
</label></th>
			<td>
				<select name='dbtype' style='width:206px;'>$dbc</select>
			</td>
			<td>".getTranslation('Your database type.',$_POST)."</td>
		</tr>";
		echo $PAGE->content();
		exit;
	}
}

$DBCONFIG=false;
if ( isset($_GET['page']) )
{
	if ($_GET['page']>=6 && $_GET['page']<=11)
	{
		if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
		{
			if (isset($_POST['dbtype']))
			{
				$DBCONFIG=new ServiceConfigurator($services_file,htmlspecialchars($_POST['dbtype']));
			}
			else
			{
				exit;
			}
		}
	}
}

// DATABASE DETAILS
if ( isset($_GET['page']) )
{
	if ($_GET['page']==6)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('enter database details',$_POST)."</p>";
		$dbfc="";
		if ( isset($DBCONFIG->fields) )
		{
			foreach ($DBCONFIG->fields as $FIELD)
			{
				$dbfc=$dbfc."		<tr>";
				$dbfc=$dbfc."			<th scope='row'><label for='".$FIELD->fieldname."'>".getTranslation($FIELD->fieldtext,$_POST)."</label></th>";
				$dbfc=$dbfc."			<td><input name='".$FIELD->fieldname."' id='".$FIELD->fieldname."' type='text' size='25' value='".$FIELD->value."' /></td>";
				$dbfc=$dbfc."			<td>".getTranslation($FIELD->helptext,$_POST)."</td>";
				$dbfc=$dbfc."		</tr>";
			} // end for (service configuration html building)
		}
		$dbtype=htmlspecialchars($_POST['dbtype']);
		$PAGE->body=<<<EOD
		<tr>
			<th scope="row"><label for="uname">
EOD;
$PAGE->body=$PAGE->body.getTranslation('Database Type',$_POST);
$PAGE->body=$PAGE->body."</label></th>
			<td>
			<input name='dbtype' id='dbtype' type='text' size='25' value='$dbtype' style='background-color:#EEE;' readonly='readonly'/>
			</td>
			<td>".getTranslation('Your database type.',$_POST)."</td>
		</tr>$dbfc";
		echo $PAGE->content();
		exit;
	}
}


$APP=array();
global $APP;

// DATABASE CONNECTION TEST
$DB_CONNECT=false;
if ( isset($_GET['page']) )
{
if ($_GET['page']>=7)
{
	include_once("model.database.php");
	if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
	{
		$db = new Post_Database_Adapter($_POST);
		$db=$db->database;
	}
	else
	{
		// open settings file
		$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
		include_once($settings_file);
		$db = new Settings_Database_Adapter($settings);
		$db=$db->database;
	}
	global $db;
	$GLOBALS['db']=$db;
	if ( $db && $db->connected )
	{
		$DB_CONNECT=true;
		$APP['db']=$db;
	}
	else
	{
		$DB_CONNECT=false;
	}
	
}
}






// PAGE 7 - EITHER DB ERROR OR NEXT BASIC PAGE - FILE STORAGE
if ( isset($_GET['page']) )
{
	if ($_GET['page']==7 && !$DB_CONNECT)
	{
		include($BIN_DIR.$PATH_SEPERATOR."templates/dbfail.php");
		exit;
	}
	if ($_GET['page']==7 && $DB_CONNECT)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('file storage details',$_POST)."</p>";
		$PAGE->body="
		<tr>
			<th scope='row'><label for='uname'>".getTranslation('File Storage Type',$_POST)."</label></th>
			<td>
				<select name='fstype' style='width:206px;'>$fsc</select>
			</td>
			<td>".getTranslation('Your file storage system.',$_POST)."</td>
		</tr>";

		$PAGE->body=$PAGE->body."<input type='hidden' name='dbtype' value='".htmlspecialchars($_POST['dbtype'])."'/>";
		foreach ($DBCONFIG->fields as $FIELDS)
		{
			$PAGE->body=$PAGE->body."<input type='hidden' name='".$FIELDS->fieldname.
				"' value='".$FIELDS->value."'/>";
			$PAGE->body=$PAGE->body."";
		}
		echo $PAGE->content();
		exit;
	}
}

$FSCONFIG=false;
if ( isset($_GET['page']) )
{
	if ($_GET['page']>=8 && $_GET['page']<=11)
	{
		if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
		{
			if ( isset($_POST['fstype']) )
			{
				$FSCONFIG=new ServiceConfigurator($services_file,htmlspecialchars($_POST['fstype']));
			}
		}
	}
}

// FILE STORAGE DETAILS
if ( isset($_GET['page']) )
{
	if ($_GET['page']==8)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('file storage details',$_POST)."</p>";
		$fsfc="";
		foreach ($FSCONFIG->fields as $FIELD)
		{
			$fsfc=$fsfc."		<tr>";
			$fsfc=$fsfc."			<th scope='row'><label for='".$FIELD->fieldname."'>".getTranslation($FIELD->fieldtext,$_POST)."</label></th>";
			$fsfc=$fsfc."			<td><input name='".$FIELD->fieldname."' id='".$FIELD->fieldname."' type='text' size='25' value='".$FIELD->value."' /></td>";
			$fsfc=$fsfc."			<td>".getTranslation($FIELD->helptext,$_POST)."</td>";
			$fsfc=$fsfc."		</tr>";
			if (strlen(trim($FIELD->special))>0)
			{
				$fsfc=$fsfc."<tr><td colspan='3' align='center'>";
				$fsfc=$fsfc.html_entity_decode($FIELD->special,ENT_QUOTES);
				$fsfc=$fsfc."</td></tr>";
			}
			if (strlen(trim($FIELD->image))>0)
			{
				$fsfc=$fsfc."<tr><td colspan='3' align='center'>";
				$fsfc=$fsfc."<img src='".$FIELD->image."' style='border:1px solid red;max-width:600px;'/>";
				$fsfc=$fsfc."</td></tr>";
			}
		} // end for (service configuration html building)
		$fstype=htmlspecialchars($_POST['fstype']);
		$PAGE->body="
		<tr>
			<th scope='row'><label for='uname'>".getTranslation('File Storage Type',$_POST)."</label></th>
			<td>
			<input name='fstype' id='fstype' type='text' size='25' value='$fstype' style='background-color:#EEE;' readonly='readonly'/>
			</td>
			<td>".getTranslation('Your file storage system.',$_POST)."</td>
		</tr>$fsfc";

		$PAGE->body=$PAGE->body."<input type='hidden' name='dbtype' value='".htmlspecialchars($_POST['dbtype'])."'/>";
		foreach ($DBCONFIG->fields as $FIELDS)
		{
			$PAGE->body=$PAGE->body."<input type='hidden' name='".$FIELDS->fieldname.
				"' value='".$FIELDS->value."'/>";
		}
		echo $PAGE->content();
		exit;
	}
}



// STORAGE CONNECTION TEST
$FS_CONNECT=false;
if ( isset($_GET['page']) )
{
if ($_GET['page']>=9)
{
	if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
	{
		if ( isset($_POST['fstype']) )
		{
			include_once("model.storage.php");
			$fs = new Post_Storage_Adapter($_POST);
			$fs=$fs->storage;
		}
	}
	else
	{
		include_once("model.storage.php");
		// open settings file
		$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
		include_once($settings_file);
		$fs = new Settings_Storage_Adapter($settings);
		$fs=$fs->storage;
	}
	if ( isset($fs) )
	{
		if ( $fs->connect() )
		{
			$FS_CONNECT=true;
			$APP['fs']=$fs;
		}
		else
		{
			$FS_CONNECT=false;
		}
		$fs->debug=false;
		$GLOBALS['fs']=$fs;
	}
}
}


// PAGE 9 - EITHER FS ERROR OR NEXT PAGE
if ( isset($_GET['page']) )
{
	if ($_GET['page']==9 && !$FS_CONNECT)
	{
		include($BIN_DIR.$PATH_SEPERATOR."templates/fsfail.php");
		exit;
	}
}

// MESSAGING HERE
// PAGE 9 - EITHER FS ERROR OR NEXT BASIC PAGE - MESSAGING
if ( isset($_GET['page']) )
{
	if ($_GET['page']==9 && !$DB_CONNECT)
	{
		include($BIN_DIR.$PATH_SEPERATOR."templates/dbfail.php");
		exit;
	}
	if ($_GET['page']==9 && !$FS_CONNECT)
	{
		include($BIN_DIR.$PATH_SEPERATOR."templates/fsfail.php");
		exit;
	}
	if ($_GET['page']==9 && $DB_CONNECT)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('message queue details',$_POST)."</p>";
		$PAGE->body="
		<tr>
			<th scope='row'><label for='uname'>".getTranslation('Message Queue Type',$_POST)."</label></th>
			<td>
				<select name='mstype' style='width:206px;'>$msc</select>
			</td>
			<td>".getTranslation('Your message queue system.',$_POST)."</td>
		</tr>";

		foreach ($_POST as $PK=>$PV)
		{
			$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars($PK,ENT_NOQUOTES).
				"' value='".htmlspecialchars($PV,ENT_NOQUOTES)."'/>";
			$PAGE->body=$PAGE->body."";
		}
		echo $PAGE->content();
		exit;
	}
}

$MSCONFIG=false;
if ( isset($_GET['page']) )
{
	if ($_GET['page']>=10 && $_GET['page']<=11)
	{
		if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
		{
			if ( isset($_POST['mstype']) )
			{
				$MSCONFIG=new ServiceConfigurator($services_file,htmlspecialchars($_POST['mstype']));
			}
		}
	}
}

// MESSAGE QUEUE DETAILS
if ( isset($_GET['page']) )
{
	if ($_GET['page']==10)
	{
		$PAGE=new SetupPage($_GET['page']);
		$PAGE->title="<p>".getTranslation('message queue details',$_POST)."</p>";
		$msfc="";
		foreach ($MSCONFIG->fields as $FIELD)
		{
			$msfc=$msfc."		<tr>";
			$msfc=$msfc."			<th scope='row'><label for='".$FIELD->fieldname."'>".getTranslation($FIELD->fieldtext,$_POST)."</label></th>";
			$msfc=$msfc."			<td><input name='".$FIELD->fieldname."' id='".$FIELD->fieldname."' type='text' size='25' value='".$FIELD->value."' /></td>";
			$msfc=$msfc."			<td>".getTranslation($FIELD->helptext,$_POST)."</td>";
			$msfc=$msfc."		</tr>";
			if (strlen(trim($FIELD->special))>0)
			{
				$msfc=$msfc."<tr><td colspan='3' align='center'>";
				$msfc=$msfc.html_entity_decode($FIELD->special,ENT_QUOTES);
				$msfc=$msfc."</td></tr>";
			}
			if (strlen(trim($FIELD->image))>0)
			{
				$msfc=$msfc."<tr><td colspan='3' align='center'>";
				$msfc=$msfc."<img src='".$FIELD->image."'/>";
				$msfc=$msfc."</td></tr>";
			}
		} // end for (service configuration html building)
		$mstype=htmlspecialchars($_POST['mstype']);
		$PAGE->body="
		<tr>
			<th scope='row'><label for='uname'>".getTranslation('Message Queue Type',$_POST)."</label></th>
			<td>
			<input name='mstype' id='mstype' type='text' size='25' value='$mstype' style='background-color:#EEE;' readonly='readonly'/>
			</td>
			<td>".getTranslation('Your message queue system.',$_POST)."</td>
		</tr>$msfc";

		$PAGE->body=$PAGE->body."<input type='hidden' name='dbtype' value='".htmlspecialchars($_POST['dbtype'])."'/>";
		$PAGE->body=$PAGE->body."<input type='hidden' name='fstype' value='".htmlspecialchars($_POST['fstype'])."'/>";
		
		foreach ($_POST as $PK=>$PV)
		{
			$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars($PK,ENT_NOQUOTES).
				"' value='".htmlspecialchars($PV,ENT_NOQUOTES)."'/>";
			$PAGE->body=$PAGE->body."";
		}
		
		echo $PAGE->content();
		exit;
	}
}

// MESSAGE QUEUE TEST
$MS_CONNECT=false;
if ( isset($_GET['page']) )
{
if ($_GET['page']>=11)
{
	include_once("model.message.php");
	if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
	{
		if ( isset($_POST['mstype']) )
		{
			$ms = new Post_Message_Adapter($_POST);
			$ms=$ms->messenger;
		}
	}
	else
	{
		// open settings file
		$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
		include_once($settings_file);
		$ms = new Settings_Message_Adapter($settings);
		$ms=$ms->messenger;
	}
	if ( isset($ms) )
	{
		if ( $ms->connect() )
		{
			$MS_CONNECT=true;
			$APP['ms']=$ms;

		}
		else
		{
			$MS_CONNECT=false;
		}
		$ms->debug=false;
		$GLOBALS['ms']=$ms;
	}
}
}

// PAGE 11 - EITHER FS ERROR OR NEXT PAGE
if ( isset($_GET['page']) )
{
	if ($_GET['page']==11 && !$MS_CONNECT)
	{
		include($BIN_DIR.$PATH_SEPERATOR."templates/msfail.php");
		exit;
	}
}







// WRITE FILE ATTEMPT
$FILE_WRITE=false;
$sample_config="";

if ( isset($_GET['page']) )
{
if ($_GET['page']==11 && $DB_CONNECT && $FS_CONNECT)
{
	if ( !file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
	{
		$sample_config=file_get_contents($BIN_DIR.$PATH_SEPERATOR."his-config-sample.php");
		$services_settings="";

		$services_settings="";
		if ( isset($DBCONFIG->settings) )
		{
			$services_settings=$services_settings.$DBCONFIG->settings;
		}
		foreach ($DBCONFIG->fields as $FIELD)
		{
			$services_settings=str_replace($FIELD->original,$FIELD->value,$services_settings);
		}
		
		$services_settings=$services_settings.$FSCONFIG->settings;
		foreach ($FSCONFIG->fields as $FIELD)
		{
			$services_settings=str_replace($FIELD->original,$FIELD->value,$services_settings);
		}
		$services_settings=$services_settings.$MSCONFIG->settings;
		foreach ($MSCONFIG->fields as $FIELD)
		{
			$services_settings=str_replace($FIELD->original,$FIELD->value,$services_settings);
		}

		$sample_config=str_replace("SELECT-HUMAN-LANGUAGE",$_POST['language'],$sample_config);
		$sample_config=str_replace("DBTYPE",$_POST['dbtype'],$sample_config);
		$sample_config=str_replace("FSTYPE",$_POST['fstype'],$sample_config);
		$sample_config=str_replace("MSTYPE",$_POST['mstype'],$sample_config);



		$sample_config=str_replace_first("\"SALT\"","\"".generate_salt()."\"",$sample_config);
		$sample_config=str_replace_first("\"SALT\"","\"".generate_salt()."\"",$sample_config);

		$sample_config=str_replace("<!--SERVICES-->",$services_settings,$sample_config);
		if ( isset($_POST['RABBITQUEUEPREFIX']) )
		{
			$sample_config=str_replace("RABBITMQ-EXCHANGE",$_POST['RABBITQUEUEPREFIX'].sha1(microtime()),$sample_config);
		}

		$this_http="http";
		if ( isset($_SERVER['HTTPS']) )
		{
			if ($_SERVER['HTTPS']=="on")
			{
				$this_http="https";
			}
		}
		if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]))
		{
			if ($_SERVER["HTTP_X_FORWARDED_PROTO"]=="https")
			{
				$this_http="https";
			}
		}

		$sample_config=str_replace("<uri value=\"{uri}\"/>","<uri value=\"$this_server_url\"/>",$sample_config);

		// $sample_config is now an xml representation of the settings page
		// convert to php code

		$sample_config_xml_array = xmlToArray(simplexml_load_string($sample_config));
		$sample_config="<?php\n";
		$sample_config.="\$"."settings=";
		$sample_config.= var_export($sample_config_xml_array,true).";";
		$sample_config.="\n";
		$sample_config.="\$GLOBALS['settings']=\$"."settings;\n";
		$sample_config.="?".">";
		$sample_config = trim($sample_config);
		if ( file_put_contents($BIN_DIR.$PATH_SEPERATOR."his-config.php",$sample_config)===FALSE )
		{
			$FILE_WRITE=false;
		}
		else
		{
			$FILE_WRITE=true;
		}
	}
	else
	{
		$FILE_WRITE=true;
	}
}
}

// SETTINGS FILE WILL EXIST AFTER THIS STEP - ADDITIONAL ERROR STATES
if ( isset($_GET['page']) )
{
	if ($_GET['page']==11 && $DB_CONNECT && $FS_CONNECT &&
		!file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php") )
	{
		$this_folder=$BIN_DIR;
		$sample_config_safe=str_replace("<","&lt;",$sample_config);
		include("templates/cantwrite.php");
		exit;
	}
	if ($_GET['page']==11 && $DB_CONNECT &&
		file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php") )
	{
		// COUNT NUMBER OF DB TABLES
		$current_db_tables = $db->get_tables();
		$found_user_table=false;
		foreach ($current_db_tables as $dbtable)
		{
			if ($dbtable=="user_id_user")
			{
				$found_user_table=true;
			}
		}
		// IF ALL THE CORRECT DB TABLES EXIST, DONT SETUP USER
		if ($found_user_table)
		{
			$PAGE=new SetupPage( intval($_GET['page'])-1 );
			$PAGE->title="<h1>Database tables already exist</h1>";
			$PAGE->body="<p>";
			$PAGE->body=$PAGE->body.getTranslation("dbexist1",$settings);
			$PAGE->body=$PAGE->body."</p>";
			$PAGE->body=$PAGE->body."<p>";
			
			$PAGE->body=$PAGE->body."</p>";
			$PAGE->body=$PAGE->body."<center><a href='?page=11'><img src='images/refresh.png'/></a></center><br/>";
			$PAGE->body=$PAGE->body."<p>";
			$PAGE->body=$PAGE->body.getTranslation("dbexist2",$settings);
			$PAGE->body=$PAGE->body."</p>";
			$PAGE->body=$PAGE->body."<center><a href='index.php?v=login'><img border='0' src='images/login.png'/></a></center>";

			$PAGE->body=$PAGE->body."</p>";
			$PAGE->hide_next=true;
			$PAGE->hide_back=true;
			echo $PAGE->content();
			exit;
		}
		else
		{
			// SHOW SETUP USER FORM FIELDS
			include("templates/setupuser.php");
			exit;
		}
	}
}


// CONFIG FILE either created or has been manually created...continue - Library value entries
if ( isset($_GET['page']) )
{
if ($_GET['page']==12 && $DB_CONNECT && $FS_CONNECT && file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
{
                $current_db_tables = $db->get_tables();
                $found_user_table=false;
                foreach ($current_db_tables as $dbtable)
                {
                        if ($dbtable=="user_id_user")
                        {
                                $found_user_table=true;
                        }
                }
                // IF ALL THE CORRECT DB TABLES EXIST, DONT SETUP USER
                if ($found_user_table)
                {
                        $PAGE=new SetupPage( intval($_GET['page'])-1 );
                        $PAGE->title="<h1>Database tables already exist</h1>";
                        $PAGE->body="<p>";
                        $PAGE->body=$PAGE->body.getTranslation("dbexist1",$settings);
                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<p>";

                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<center><a href='?page=11'><img src='images/refresh.png'/></a></center><br/>";
                        $PAGE->body=$PAGE->body."<p>";
                        $PAGE->body=$PAGE->body.getTranslation("dbexist2",$settings);
                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<center><a href='index.php?v=login'><img border='0' src='images/login.png'/></a></center>";

                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->hide_next=true;
                        $PAGE->hide_back=true;
                        echo $PAGE->content();
                        exit;
                }



	$PAGE=new SetupPage($_GET['page']);
	$PAGE->hide_back=true;
	$PAGE->title="<h1>".getTranslation("Default HIS Function library settings",$settings)."</h1>";
	$PAGE->body="";
	$PAGE->body=$PAGE->body."<p>".getTranslation("library field description",$settings)."</p>";

	$PAGE->body=$PAGE->body."<table style='display:inline;width:100%;'><tr><td valign='top' align='center'>";

	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://www.godaddy.com/email/internet-fax.aspx' target='_blank'><img border='0' src='images/godaddy.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Fax Thru Email",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Online Fax Send/Receive",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("GoDaddy Username",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='godaddy_username' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("GoDaddy Password",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='godaddy_password' value=''>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</td><td valign='top' align='center'>";
	
	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://www.postalmethods.com/' target='_blank'><img border='0' src='images/postalmethods.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Web-to-Post Service",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Send Snail Mail",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("PostalMethods Username",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='postalmethods_username' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("PostalMethods Password",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='postalmethods_password' value=''>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";

	$PAGE->body=$PAGE->body."</td><td valign='top' align='center'>";
	
	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://www.twilio.com/' target='_blank'><img border='0' src='images/twilio.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Phone and SMS Service",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Send/Receive Phone/SMS",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."Twilio Sid";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='twilio_sid' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."Twilio AuthToken";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='twilio_authtoken' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."Default <a href='https://www.twilio.com/user/account/phone-numbers/incoming' target='_blank'>Twilio \"From\"</a> Phone #:";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='twilio_from_number' value='+1 (123) 456-7890'>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Default \"To\" Phone # (your cell):",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='twilio_to_number' value='+1 (123) 456-7890'>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</td></tr>";

	$PAGE->body=$PAGE->body."<tr><td valign='top' align='center'>";

	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://aws.amazon.com/ses/' target='_blank'><img border='0' src='images/ses.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Simple E-Mail Service",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Send E-Mail",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("AWS Access Key",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='aws_accesskey_ses' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("AWS Secret Key",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='aws_secretkey_ses' value=''>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";

	$PAGE->body=$PAGE->body."</td><td valign='top' align='center'>";

	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://aws.amazon.com/mturk/' target='_blank'><img border='0' src='images/mturk.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Human Intelligence Tasks",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Do things machines cannot",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("AWS Access Key",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='aws_accesskey_mturk' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("AWS Secret Key",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='aws_secretkey_mturk' value=''>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";
	
	$PAGE->body=$PAGE->body."</td><td valign='top' align='center'>";

	$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
	$PAGE->body=$PAGE->body."<center>";
	$PAGE->body=$PAGE->body."<a href='http://support.google.com/mail/bin/answer.py?hl=en&answer=77695' target='_blank'><img border='0' src='images/imap.png'/></a>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."Internet Message Access Protocol";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body.getTranslation("Read and Send E-Mail",$settings);
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."</center>";

	$PAGE->body=$PAGE->body."<br/>";

	$PAGE->body=$PAGE->body."IMAP Server";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='imap_email_host' value='imap.gmail.com'>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."IMAP Server Port";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='imap_email_port' value='993'>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."SMTP Server";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='smtp_email_server' value='smtp.gmail.com'>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."SMTP Server Port";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='smtp_email_port' value='587'>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."E-Mail Address/Username";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='text' name='imap_email_user' value=''>";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."E-Mail Password";
	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<input type='password' name='imap_email_pass' value=''>";
	$PAGE->body=$PAGE->body."</td></tr></table>";

	$PAGE->body=$PAGE->body."<br/>";
	$PAGE->body=$PAGE->body."<br/>";	

	$PAGE->body=$PAGE->body."</td></tr>";

	$PAGE->body=$PAGE->body."<tr><td valign='top' align='center'>";

		$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
		$PAGE->body=$PAGE->body."<center>";
		$PAGE->body=$PAGE->body."<a href='http://www.complexityintelligence.com/en/intellexere' target='_blank'><img border='0' src='images/intellexere.png'/></a>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Language Processing Analysis",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Natural Language Processing",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."</center>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."Public Access ID";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='intellexere_access_id' value=''>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."Secret Auth Key";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='password' name='intellexere_secret_key' value=''>";
		$PAGE->body=$PAGE->body."</td></tr></table>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<br/>";

	$PAGE->body=$PAGE->body."</td><td valign='top' align='center'>";
		
		$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
		$PAGE->body=$PAGE->body."<center>";
		$PAGE->body=$PAGE->body."<a href='https://www.paypal.com/' target='_blank'><img border='0' src='images/paypal.png'/></a>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Send and Recieve Money",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Online Payment Processor",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."</center>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."API Username";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='paypal_api_username' value=''>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."API Password";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='password' name='paypal_api_password' value=''>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."API Signature";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='password' name='paypal_api_signature' value=''>";
		$PAGE->body=$PAGE->body."</td></tr></table>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<br/>";
		
		
	$PAGE->body=$PAGE->body."</td><td valign='top'>";
	
		/*
		// OLD IMACROS STYLE LICENSE KEY
		$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
		$PAGE->body=$PAGE->body."<center>";
		$PAGE->body=$PAGE->body."<a href='http://www.iopus.com/imacros/' target='_blank'><img border='0' src='images/imacros.png'/></a>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Browser Automation",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("Record & Play Macros",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."</center>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body.getTranslation("iMacros Player License Key",$settings);
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='imacros_license_key' value='XXXXX-XXXXX-XXXXX-XXXXX-XXXXX-XXXXX'>";
		$PAGE->body=$PAGE->body."</td></tr></table>";

		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<br/>";
		*/
	
	$PAGE->body=$PAGE->body."</td><td valign='top'>";
	
		/*
		$PAGE->body=$PAGE->body."<table style='display:inline;width:200px;'><tr><td style='text-align:center;font-size:14px;display:inline;'>";
		$PAGE->body=$PAGE->body."<center>";
		$PAGE->body=$PAGE->body."<a href='http://support.google.com/mail/bin/answer.py?hl=en&answer=77695' target='_blank'><img border='0' src='images/imap.png'/></a>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."Internet Message Access Protocol";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."Read and Send E-Mail";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."</center>";

		$PAGE->body=$PAGE->body."<br/>";

		$PAGE->body=$PAGE->body."IMAP Server";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='imap_email_host' value='imap.gmail.com'>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."IMAP Server Port";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='imap_email_port' value='993'>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."SMTP Server";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='smtp_email_server' value='smtp.gmail.com'>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."SMTP Server Port";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='smtp_email_port' value='587'>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."E-Mail Address/Username";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='text' name='imap_email_user' value=''>";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."E-Mail Password";
		$PAGE->body=$PAGE->body."<br/>";
		$PAGE->body=$PAGE->body."<input type='password' name='imap_email_pass' value=''>";
*/
	$PAGE->body=$PAGE->body."</td></tr></table>";

	foreach ($_POST as $PK=>$PV)
	{
		$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars($PK,ENT_NOQUOTES)."' value='".htmlspecialchars($PV,ENT_NOQUOTES)."'/>";
	}

	echo $PAGE->content();
	exit;



}
}


// CONFIG FILE either created or has been manually created...continue - install
if ( isset($_GET['page']) )
{
if ($_GET['page']==13 && $DB_CONNECT && $FS_CONNECT && file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
{
	ob_end_clean();
	ob_start();

	$users = $db->select_table("user_user_name",array('user_name'),array());
	if ( $users && count($users)>0 )
	{
                        $PAGE=new SetupPage( intval($_GET['page'])-1 );
                        $PAGE->title="<h1>Database tables already exist</h1>";
                        $PAGE->body="<p>";
                        $PAGE->body=$PAGE->body.getTranslation("dbexist1",$settings);
                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<p>";

                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<center><a href='?page=11'><img src='images/refresh.png'/></a></center><br/>";
                        $PAGE->body=$PAGE->body."<p>";
                        $PAGE->body=$PAGE->body.getTranslation("dbexist2",$settings);
                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->body=$PAGE->body."<center><a href='index.php?v=login'><img border='0' src='images/login.png'/></a></center>";

                        $PAGE->body=$PAGE->body."</p>";
                        $PAGE->hide_next=true;
                        $PAGE->hide_back=true;
                        echo $PAGE->content();
                        exit;

	}

	$PAGE=new SetupPage($_GET['page']);
	$PAGE->title="<p>Installation in progress</p>";

	//$PAGE->body=$PAGE->body."<span style='font-size:10px;'>";
	$database_commands_run=false;

	if (isset($_POST['user_name']) && isset($_POST['admin_password']) && isset($_POST['admin_password2']) && isset($_POST['admin_email']) && ( isset($_POST['Submit']) || isset($_POST['substep']) ) )
	{
		if (strlen(trim($_POST['user_name']))>0 && strlen(trim($_POST['admin_password']))>0 && strlen(trim($_POST['admin_password2']))>0 && strlen(trim($_POST['admin_email']))>0  )
		{
			$_POST['admin_email']=str_replace("'","\'",$_POST['admin_email']);
			$_POST['user_name']=str_replace("'","\'",$_POST['user_name']);
			if ( $_POST['admin_password']==$_POST['admin_password2'])
			{
				$current_db_tables = $db->get_tables();
				$found_user_table=false;
				foreach ($current_db_tables as $dbtable)
				{
					if ($dbtable=="user_id_user")
					{
						$found_user_table=true;
						break;
					}
				}
				if (!$found_user_table || isset($_POST['substep']) )
				{
					$sql_schema_commands=file_get_contents($BIN_DIR.$PATH_SEPERATOR."schemas".$PATH_SEPERATOR."db-schema-".$db->kind.".sql");
					$sql_schema_commands=str_replace("DBNAME",strtoupper($db->kind),$sql_schema_commands);
					$sql_schema_commands=str_replace("USERNAME",($db->auth1),$sql_schema_commands);
					$database_commands_run=true;
					if ($db->kind=="mysql"||$db->kind=="postgres")
					{
						$scs=explode(";",$sql_schema_commands);
						foreach ($scs as $sdbc)
						{
							if ( strlen(trim($sdbc))>0 )
							{
								$db->query(trim($sdbc).";");
							}
						}
					}
					else if ($db->kind=="mssql")
					{
						$scs=explode(";",$sql_schema_commands);
						foreach ($scs as $sdbc)
						{
							if ( strlen(trim($sdbc))>0 )
							{
								$db->query(trim($sdbc)."");
							}
						}
					}
					else if ($db->kind=="oracle")
					{
						$scs=explode(";",$sql_schema_commands);
						foreach ($scs as $sdbc)
						{
							if ( strlen(trim($sdbc))>0 )
							{
								$sdbc=str_replace("(SEMICOLON)",";",$sdbc);
								$trig=strpos($sdbc,"CREATE OR REPLACE TRIGGER");
								if ($trig===false)
								{
									$db->query(trim($sdbc)."");
								}
								else
								{
									// PL/SQL statements
									$db->query(trim($sdbc).";");
								}
							}
						}
					}
					else if ($db->kind=="postgres")
					{
						$scs=explode(";",$sql_schema_commands);
						foreach ($scs as $sdbc)
						{
							if ( strlen(trim($sdbc))>0 )
							{
								$db->query(trim($sdbc).";");
							}
						}
					}
					else if ($db->kind=="dynamodb")
					{
						if (!isset($_POST['substep']))
						{
							$_POST['substep']=1;
						}
						// AWS
						require_once("api/aws-sdk/sdk.class.php");
						include($BIN_DIR.$PATH_SEPERATOR."schemas".$PATH_SEPERATOR."db-schema-".$db->kind.".sql");

						
						$step_N_of = intval($_POST['substep']);
						$total_steps = $number_of_steps;
						$percent_complete = $step_N_of/$total_steps;
						$percent_complete = $percent_complete * 100;
						
						if ($step_N_of<=$total_steps)
						{
						
							$next_step=-1;
							if ($step_N_of==$total_steps)
							{
								//$next_step=-1;
								$next_step = intval($_GET['page']);
							}
							else
							{
								$next_step = intval($_GET['page']);
							}

							$PAGE=new SetupPage(intval($_GET['page']),$next_step);
							
							$PAGE->title="<p>";
							$PAGE->title=$PAGE->title.getTranslation("Database table creation",$settings);
							$PAGE->title=$PAGE->title." ($step_N_of/$total_steps)</p>";
							$PAGE->generate_headers_footers();
							$PAGE->body=$PAGE->body."<p>";
							$PAGE->body=$PAGE->body."<noscript>".getTranslation("It is recommended to wait at LEAST 1-2 minutes before clicking the submit button for the next step.  The reason is that DynamoDB is only capable of creating a small number of database tables at a time, and because you do not have JavaScript enabled, we are unable to step through the database table creation steps automatically.",$settings)."<br/><br/>".getTranslation("Press the \"submit\" button to continue to the next step after 1-2 minutes have passed.",$settings)."<br/><br/>"."</noscript>";
							$PAGE->body=$PAGE->body.getTranslation("These steps will be done Automatically. Stepping through database table creation...",$settings)."
							<br/><br/>
							<style>
							#progress {
							 width: 500px;   
							 border: 1px solid black;
							 position: relative;
							 padding: 3px;
							}
							#percent {
							 position: absolute;   
							 left: 50%;
							}

							#bar {
							 height: 20px;
							 background-color: green;
							 width: $percent_complete%;
							}
							</style>
							<br/>
							<br/>
							<div id='progress'>
							<span id='percent'>".(int)$percent_complete."%</span>
							<div id='bar'></div>
							</div>
							</div>
							";
							//$PAGE->body=$PAGE->body."<span style='font-size:10px;'>";
							//ob_end_clean();
							//ob_start();

							//include_once("model.classes.php");
							//include("controller.libraryinstall.php");

							foreach ($_POST as $PK=>$PV)
							{
								if ($PK!="Submit"&&$PK!="btnSubmit"&&$PK!="submit")
								{
									$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars($PK,ENT_NOQUOTES)."' value='".htmlspecialchars($PV,ENT_NOQUOTES)."'/>";
								}
								
							}
							$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars("substep",ENT_NOQUOTES)."' value='".(intval($_POST['substep'])+1)."'/>";

							$PAGE->body=$PAGE->body."</p>";

							$content="";
							//$content=ob_get_clean();
							//ob_end_flush();
							$PAGE->hide_back=true;
							echo $PAGE->content();
							echo "<script>
						function WindowLoad(event) {
							document.getElementById('btnSubmit').disabled=true;
							setTimeout('document.forms[0].submit()',60000); // 60 second wait
						}

						if (window.addEventListener) { // Mozilla, Netscape, Firefox
							window.addEventListener('load', WindowLoad, false);
						} else if (window.attachEvent) { // IE
							window.attachEvent('onload', WindowLoad);
						}

						</script>";
							exit;
						}
						
					}
					else if ($db->kind=="mongodb")
					{
						// MONGO
						include($BIN_DIR.$PATH_SEPERATOR."schemas".$PATH_SEPERATOR."db-schema-".$db->kind.".sql");

					}
					$tables_to_create=array();
					if ($db->connected)
					{
						$table_exist=array();
						$table_exist[]="job_new";
						$table_exist[]="job_id_user";
						$table_exist[]="match_custom";
						$table_exist[]="match_entry";
						$table_exist[]="me_setting";
						$table_exist[]="ph_child";
						$table_exist[]="ph_parent";
						$table_exist[]="hfp_vcs";
						$table_exist[]="hf_file";
						$table_exist[]="hf_kill";
						$table_exist[]="hf_node_filter";
						$table_exist[]="hf_parameter";
						$table_exist[]="hf_tag";
						$table_exist[]="hf_id_user";
						$table_exist[]="strings";
						$table_exist[]="user_server";
						$table_exist[]="user_id_user";
						$table_exist[]="sys_setting";
						$table_exist[]="user_user_name";
						
						$table_exist[]="hf_resource";
						$table_exist[]="user_inherit";
						$table_exist[]="hf_system_kind";
						$table_exist[]="hfr_system_kind";
						$table_exist[]="user_system_kind";
						$table_exist[]="hf_inherit";
						
						$table_exist[]="user_server_service";
						$table_exist[]="hfp_hf";
						$table_exist[]="assign_hf";
						$table_exist[]="assign_server";
						$table_exist[]="job_flag";

						$tables_to_create=$table_exist;
						//$PAGE->body=$PAGE->body. "<pre>";


						$current_db_tables = $db->get_tables();

						// READ THE LIST OF TABLES, DETERMINE IF ANY TABLES WERE NOT CREATED
						$any_tables_found=false;
						$tables_found=array();
						$install_failed=false;
						foreach ($table_exist as $table_to_be_created)
						{
							$found_table=false;
							foreach ($current_db_tables as $table_created)
							{
								if ( strtolower($table_created)==strtolower($table_to_be_created) )
								{
									$found_table=true;
								}
							}
							if (!$found_table)
							{
								$install_failed=true;
								$tables_found[]=$table_to_be_created;
							}
						}

						// EITHER SUCCESS OR FAILURE - ALL TABLES CREATED OR NOT
						if ( !$install_failed)
						{

							$sys_setting = new sys_setting();
							$sys_setting->create(array("category"=>"system","param"=>"version","val"=>$software_version));

							$pw=sha1($settings['salt1']['@attributes']['value'].$_POST['admin_password'].$_POST['user_name'].$settings['salt2']['@attributes']['value']);
							$id_user=sha1(time().$_POST['user_name'].$pw);
							$secret=sha1(time().rand(1,50).$_POST['admin_password'].$_POST['user_name'].$settings['salt2']['@attributes']['value']);
							$props=array();
							$props['id_user']=$id_user;
							$props['user_name']=$_POST['user_name'];
							$props['email']=$_POST['admin_email'];
							$props['pw']=$pw;
							$props['secret']=$secret;
							$props['lang']="undefined";
							
							foreach ($_POST as $PK=>$PV)
							{
								if ($PK!="Submit"&&$PK!="btnSubmit"&&$PK!="submit")
								{
									$PAGE->body=$PAGE->body."<input type='hidden' name='".str_replace("'","",$PK)."' value='".str_replace("'","",$PV)."'/>";
								}
							}
							//echo "creating user";
							$new_user = new user_id_user();
							$new_user->create($props);

							$PAGE->body=$PAGE->body."<input type='hidden' name='id_user' value='".$new_user->id_user."'/>";

							$props=array();
							$props['user_name']=$_POST['user_name'];
							$props['id_user']=$id_user;
							$props['email']=$_POST['admin_email'];
							$props['pw']=$pw;
							$props['secret']=$secret;
							$props['lang']="undefined";
							$new_user = new user_user_name();
							$new_user->create($props);


							$new_id=sha1(time().rand(1,20)."Linux"."nux");
							$props=array();
							$props['id']=$new_id;
							$props['name']="Linux";
							$props['detection_text']="nux";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);

							$new_id=sha1(time().rand(1,20)."Mac"."Darwin");
							$props=array();
							$props['id']=$new_id;
							$props['name']="Mac";
							$props['detection_text']="Darwin";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);
							
							$new_id=sha1(time().rand(1,20)."FreeBSD"."FreeBSD");
							$props=array();
							$props['id']=$new_id;
							$props['name']="FreeBSD";
							$props['detection_text']="FreeBSD";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);
							
							$new_id=sha1(time().rand(1,20)."Cygwin"."Cygwin");
							$props=array();
							$props['id']=$new_id;
							$props['name']="Cygwin";
							$props['detection_text']="Cygwin";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);
							
							$new_id=sha1(time().rand(1,20)."Solaris"."SunOS");
							$props=array();
							$props['id']=$new_id;
							$props['name']="Solaris";
							$props['detection_text']="SunOS";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);
							
							$new_id=sha1(time().rand(1,20)."Windows"."indows");
							$props=array();
							$props['id']=$new_id;
							$props['name']="Windows";
							$props['detection_text']="indows";
							$props['id_user']=$new_user->id_user;
							$new_user_sk=new user_system_kind();
							$new_user_sk->create($props);

							$library_messages="";
							global $library_messages;
							//include("controller.libraryinstall.php");
							
							
							$PAGE->body=$PAGE->body."<p>".getTranslation('The following tables were created.  Click Submit at the bottom of the page to continue.',$settings)."</p>";
							$PAGE->body=$PAGE->body."<table width='100%'><tr><td width='50%' valign='top'>";

							$PAGE->body=$PAGE->body."<ul style='display:inline;'>";
							foreach ($tables_to_create as $table_created)
							{
								$PAGE->body=$PAGE->body."<li>";
								$PAGE->body=$PAGE->body.$table_created;
								$PAGE->body=$PAGE->body."</li>";
							}
							$PAGE->body=$PAGE->body."</ul>";
							$PAGE->body=$PAGE->body."</td>";
							$PAGE->body=$PAGE->body."<td valign='top' align='right'>";
							$PAGE->body=$PAGE->body."<img src='images/checkmark.png'/>";
							$PAGE->body=$PAGE->body."</td></tr></table>";

							$PAGE->hide_back=true;
							$PAGE->title="<h1>".getTranslation('Installation successful',$settings)."</h1>";

						} // end if (all tables created)
						else
						{
							$PAGE->hide_next=true;

							$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";

							$missing_message="";

							$missing_message="<p>".getTranslation('The following tables were not created.  Contact support.',$settings)."</p>".$missing_message;

							$missing_message=$missing_message."<ul>";
							foreach ($tables_found as $table_found)
							{
								$missing_message=$missing_message."<li>";
								$missing_message=$missing_message.$table_found;
								$missing_message=$missing_message."</li>";
							}
							$missing_message=$missing_message."</ul>";
							$status_table="";
							$status_table=$status_table."<table width='100%'><td><td valign='top'>";
							$status_table=$status_table.$missing_message;
							$status_table=$status_table."</td><td valign='top' align='right'>";
							$status_table=$status_table."<img src='images/failure.png'/>";
							$status_table=$status_table."</td></tr></table>";
							$PAGE->body=$PAGE->body.$status_table;

						} // end else (some tables not created)
					} // end if (db is connected)
					else
					{
						$PAGE->hide_next=true;
						$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";
						$PAGE->body=$PAGE->body."<table width='100%'><td><td valign='top'>";
						$PAGE->body=$PAGE->body. "<p>".getTranslation('Database connection problem',$settings)."</p>";
						$PAGE->body=$PAGE->body."</td><td valign='top' align='right'>";
						$PAGE->body=$PAGE->body."<img src='images/failure.png'/>";
						$PAGE->body=$PAGE->body."</td></tr></table>";

					} // end else (db is not connected)

				}
				else
				{
					$PAGE->hide_next=true;
					$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";
					$PAGE->body=$PAGE->body."<table width='100%'><td><td valign='top'>";
					$PAGE->body=$PAGE->body. "<p>".getTranslation('Database tables already exist.',$settings)."</p>";
					$PAGE->body=$PAGE->body."</td><td valign='top' align='right'>";
					$PAGE->body=$PAGE->body."<img src='images/failure.png'/>";
					$PAGE->body=$PAGE->body."</td></tr></table>";
				} // user_id_user table already exists

			}
			else
			{
				$PAGE->hide_next=true;
				$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";
				$PAGE->body=$PAGE->body."<table width='100%'><td><td valign='top'>";
				$PAGE->body=$PAGE->body. "<p>".getTranslation('Passwords need to match.',$settings)."</p>";
				$PAGE->body=$PAGE->body."</td><td valign='top' align='right'>";
				$PAGE->body=$PAGE->body."<img src='images/failure.png'/>";
				$PAGE->body=$PAGE->body."</td></tr></table>";
			} // end if (admin pws equal)
		}
		else
		{
			$PAGE->hide_next=true;
			$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";
			$PAGE->body=$PAGE->body."<table width='100%'><td><td valign='top'>";
			$PAGE->body=$PAGE->body. "<p>".getTranslation('Invalid data entered for first user account.',$settings)."</p>";
			$PAGE->body=$PAGE->body."</td><td valign='top' align='right'>";
			$PAGE->body=$PAGE->body."<img src='images/failure.png'/>";
			$PAGE->body=$PAGE->body."</td></tr></table>";

		} // end if (all fields not blank)
	}
	else
	{
		$PAGE->hide_next=true;
		$PAGE->title="<h1>".getTranslation('Installation failed',$settings)."</h1>";
		$PAGE->body=$PAGE->body."<table width='100%'><td><td>";
		$PAGE->body=$PAGE->body. "<p>".getTranslation('Invalid data entered for first user account.',$settings)."</p>";
		$PAGE->body=$PAGE->body."</td><td valign='top' align='right'>";
		$PAGE->body=$PAGE->body."<img src='images/failure.png'/>";
		$PAGE->body=$PAGE->body."</td></tr></table>";

	} // end if (all fields exist)

	$content="";
	$content=ob_get_clean();
	//ob_end_flush();
	if ($database_commands_run)
	{
		$PAGE->body=$PAGE->body."<h1>";
		$PAGE->body=$PAGE->body.getTranslation('Database Log',$settings).":";
		$PAGE->body=$PAGE->body."</h1>";
		$PAGE->body=$PAGE->body."<p style='font-size:9px;'>";
		$PAGE->body=$PAGE->body.$content;
		$PAGE->body=$PAGE->body."</p>";
	}
	echo $PAGE->content();
	exit;

}
}

$first_step_of_library_installation=14;
$last_step_of_library_installation=$first_step_of_library_installation+45; // there are currently 45 functions
// last step is step 59

// CONFIG FILE either created or has been manually created...continue
if ( isset($_GET['page']) )
{
if ($_GET['page']>=$first_step_of_library_installation && $_GET['page']<=$last_step_of_library_installation && $DB_CONNECT && $FS_CONNECT && file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
{
	$check_user = new user_user_name();
	$check_user->get_from_hashrange($_POST['user_name']);
	$pw=sha1($settings['salt1']['@attributes']['value'].$_POST['admin_password'].$_POST['user_name'].$settings['salt2']['@attributes']['value']);
	if ($check_user->pw!=$pw)
	{
		exit;
	}

	$PAGE=new SetupPage($_GET['page']);
	
	$step_N_of = $_GET['page']-$first_step_of_library_installation;
	$step_N_of = $step_N_of + 1;
	$total_steps = $last_step_of_library_installation-$first_step_of_library_installation;
	$total_steps = $total_steps + 1;
	$percent_complete = $step_N_of/$total_steps;
	$percent_complete = $percent_complete * 100;

	$percent_text_color="black";
	if ($percent_complete>60.0)
	{
		$percent_text_color="white";
	}

	$PAGE->title="<h1>".getTranslation("Function Library installation",$settings)." ($step_N_of/$total_steps)</h1>";
	$PAGE->generate_headers_footers();
	$PAGE->body=$PAGE->body."<p><b>";
	$PAGE->body=$PAGE->body."<noscript>".getTranslation("press submit button no javascript",$settings)."</noscript></b><br/><br/>";
	$PAGE->body=$PAGE->body.getTranslation("These steps will be done Automatically.  Stepping through function library installation...",$settings)."
	<br/><br/>
	<style>
	#progress {
	 width: 500px;   
	 border: 1px solid black;
	 position: relative;
	 padding: 3px;
	}
	#percent {
	 position: absolute;   
         color:$percent_text_color;
	 left: 50%;
	}

	#bar {
	 height: 20px;
	 background-color: green;
	 width: $percent_complete%;
	}
	</style>
	<br/>
	<br/>
	<div id='progress'>
    <span id='percent'>".(int)$percent_complete."%</span>
    <div id='bar'></div>
	</div>
	</div>
	";
	//$PAGE->body=$PAGE->body."<span style='font-size:10px;'>";
	//ob_end_clean();
	//ob_start();

	//include_once("model.classes.php");
	include("controller.libraryinstall.php");

	foreach ($_POST as $PK=>$PV)
	{
		if ($PK!="Submit"&&$PK!="btnSubmit"&&$PK!="submit")
		{
			$PAGE->body=$PAGE->body."<input type='hidden' name='".htmlspecialchars($PK,ENT_NOQUOTES)."' value='".htmlspecialchars($PV,ENT_NOQUOTES)."'/>";
		}
		
	}

	$PAGE->body=$PAGE->body."</p>";

	$content="";
	//$content=ob_get_clean();
	//ob_end_flush();
	$PAGE->hide_back=true;
	echo $PAGE->content();
	echo "<script>
function WindowLoad(event) {
    document.getElementById('btnSubmit').disabled=true;
    setTimeout('document.forms[0].submit()',1000);
}

if (window.addEventListener) { // Mozilla, Netscape, Firefox
    window.addEventListener('load', WindowLoad, false);
} else if (window.attachEvent) { // IE
    window.attachEvent('onload', WindowLoad);
}

</script>";
	exit;
	
}
}


if ( isset($_GET['page']) )
{
if ($_GET['page']==$last_step_of_library_installation+1 && $DB_CONNECT && $FS_CONNECT && file_exists($BIN_DIR.$PATH_SEPERATOR."his-config.php"))
{

	$check_user = new user_user_name();
	$check_user->get_from_hashrange($_POST['user_name']);
	$pw=sha1($settings['salt1']['@attributes']['value'].$_POST['admin_password'].$_POST['user_name'].$settings['salt2']['@attributes']['value']);
	if ($check_user->pw!=$pw)
	{
		exit;
	}

        $PAGE=new SetupPage($_GET['page']);

        $PAGE->title="<p>";
        $PAGE->title=$PAGE->title.getTranslation("Setup complete.",$settings);
        $PAGE->body=$PAGE->body."</p>";

		$PAGE->body=$PAGE->body."<table width='100%'><tr><td width='50%' valign='top'><p>";

		$PAGE->body=$PAGE->body.getTranslation("Setup was successful.  Click ",$settings);
		$PAGE->body=$PAGE->body." <a href='index.php?v=login'>";
		$PAGE->body=$PAGE->body.getTranslation("here",$settings);
		$PAGE->body=$PAGE->body."</a> ";
		$PAGE->body=$PAGE->body.getTranslation(" to login to HIS.",$settings);
		
		$PAGE->body=$PAGE->body."</p></td>";
		$PAGE->body=$PAGE->body."<td valign='top' align='right'>";
		$PAGE->body=$PAGE->body."<img src='images/checkmark.png'/>";
		$PAGE->body=$PAGE->body."</td></tr></table>";

		



	$PAGE->hide_back=true;
	$PAGE->hide_next=true;
	echo $PAGE->content();
	exit;

}
}




?>
