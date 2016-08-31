<?php

$sys_setting = new sys_setting();
$sys_setting->get_from_hashrange("system","version");
$database_version = $sys_setting->val;

if ($database_version=="undefined") return;

$versions = array();
$versions[]="2013-08-07";
$versions[]="2013-08-26";
$versions[]="2013-08-29";
$versions[]="2013-08-30";
$versions[]="2013-09-28";
$versions[]="2013-09-29";
$versions[]="2013-10-03";
$versions[]="2013-10-06";
$versions[]="2013-10-08";
$versions[]="2013-10-10";
$versions[]="2013-10-11";
$versions[]="2013-10-12";
$versions[]="2013-10-20";
$versions[]="2013-10-28";
$versions[]="2013-11-03";
$versions[]="2013-11-08";
$versions[]="2014-04-18";
$versions[]="2014-04-19";
$versions[]="2014-04-24";
$versions[]="2014-07-13";
$versions[]=$software_version; // CURRENT VERSION: "2014-07-16";
//$versions[]=$software_version; // "2024-08-26";  // FUTURE SOFTWARE VERSION APPEAR BELOW
$error_database_from_future_version = false;

if ($database_version!= $software_version )
{
	$software_stamp_list=explode("-",$software_version);
	$software_stamp_year = intval($software_stamp_list[0]);
	$software_stamp_month= intval($software_stamp_list[1]);
	$software_stamp_day = intval($software_stamp_list[2]);

	$database_stamp_list=explode("-",$database_version);
	$database_stamp_year = intval($database_stamp_list[0]);
	$database_stamp_month= intval($database_stamp_list[1]);
	$database_stamp_day = intval($database_stamp_list[2]);

	$software_stamp = ($software_stamp_year*365)+($software_stamp_month*30)+$software_stamp_day;
	$database_stamp = ($database_stamp_year*365)+($database_stamp_month*30)+$database_stamp_day;
	
	if ($database_stamp>$software_stamp)
	{
		$error_database_from_future_version = true;
	}
	
}

if (!$error_database_from_future_version && $database_version!= $software_version )
{
	$idx=0;
	$found_version=false;
	while ($idx<count($versions) )
	{
		if ($database_version==$versions[$idx])
		{
			$found_version=true;
			break;
		}
		$idx=$idx+1;
	}
	if (!$found_version)
	{
		// the web interface is ahead of the servers in version number
		logger("The HIS Job Servers are using an older version of HIS than the web interface\n");
		logger("Update this HIS job servers using the provided update script\n");
		exit;
	}

	// $idx is the starting location of the upgrade path
	
	$current_version = $versions[$idx];
	$next_version = $versions[$idx+1];

	$update_file = "updates/update.".$current_version.".to.".$next_version.".php";
	
	if ( file_exists($update_file) )
	{
		try
		{
			include_once($update_file);
		}
		catch (Exception $e)
		{
			echo "<pre>";
			echo "UPDATE ERROR: $update_file\n";
			print_r($e);
			exit;
		}
	}
	$UPDATE = new Update();

	// SHOW PAGE
	$PAGE=new SetupPage(1);
	$PAGE->hide_back=true;
	$PAGE->pagetitle="Update";
	$PAGE->generate_headers_footers();
	if ( !isset($_GET['page']) )
	{
		$title_text = getTranslation("Update from version",$settings);
		$title_text = $title_text . " ";
		$title_text = $title_text . $current_version;
		$title_text = $title_text . " ";
		$title_text = $title_text . getTranslation("to version",$settings);
		$title_text = $title_text . " ";
		$title_text = $title_text . $next_version;
	
		$PAGE->body = $PAGE->body . "<br/>";
		$PAGE->body = $PAGE->body . "<b>";
		$PAGE->body = $PAGE->body . getTranslation("Update Notes for version",$settings);
		$PAGE->body = $PAGE->body . " ";
		$PAGE->body = $PAGE->body . $next_version;
		$PAGE->body = $PAGE->body . "</b>";

		$update_notes = $UPDATE->notes();
		if ( strlen($update_notes)>0 )
		{
			$PAGE->body = $PAGE->body . "<ul>";
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . $update_notes;
			$PAGE->body = $PAGE->body . "</ul>";
		}

	}
	elseif ( isset($_GET['page']) && intval($_GET['page'])==2  && isset($_POST['btnSubmit']) ) 
	{
		// CALL THE UPDATE COMMANDS
		$UPDATE->execute();
		
		$old_version = $current_version;
		// UPDATE THE DATABASE VERSION NUMBER
		$sys_setting = new sys_setting();
		$sys_setting->get_from_hashrange("system","version");
		$sys_setting->update(array("val"=>$next_version));
		$database_version = $sys_setting->val;
		$current_version = $next_version;

		$title_text = getTranslation("Update from version",$settings);
		$title_text = $title_text . " ";
		$title_text = $title_text . $old_version;
		$title_text = $title_text . " ";
		$title_text = $title_text . getTranslation("to version",$settings);
		$title_text = $title_text . " ";
		$title_text = $title_text . $current_version;
		$title_text = $title_text . " ";
		$title_text = $title_text . getTranslation("successful",$settings);
	
		$update_notes = $UPDATE->notes();
		if ( strlen($update_notes)>0 )
		{
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . "<b>";
			$PAGE->body = $PAGE->body . getTranslation("Update Notes for version",$settings);
			$PAGE->body = $PAGE->body . " ";
			$PAGE->body = $PAGE->body . $current_version;
			$PAGE->body = $PAGE->body . "</b>";
			$PAGE->body = $PAGE->body . "<ul>";
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . $update_notes;
			$PAGE->body = $PAGE->body . "</ul>";
		}

		if ( $database_version== $software_version )
		{

			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . "<a href='?'>".getTranslation("Click here to use your new & improved HIS Web Interface",$settings)."</a>";
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . "<br/>";
			$PAGE->body = $PAGE->body . getTranslation("job server update reminder",$settings);
			$PAGE->hide_back=true;
			$PAGE->hide_next=true;
			
		}
		
	}
	
	$PAGE->title="<h1>".$title_text."</h1>";

	if ( $database_version != $software_version )
	{
		$PAGE->body = $PAGE->body . "<br/>";
		$PAGE->body = $PAGE->body . "<br/>";
		if ( !isset($_GET['page']) )
		{
			$PAGE->body = $PAGE->body . getTranslation("Click Submit to execute the update.",$settings);
		}
		else
		{
			$PAGE->body = $PAGE->body . getTranslation("Click Submit to execute the next update.",$settings);
		}
	}
	echo $PAGE->content();
	
	exit;
}
elseif ($error_database_from_future_version)
{
	$PAGE=new SetupPage(1);
	$PAGE->pagetitle="Update";
	$PAGE->generate_headers_footers();
	$PAGE->title="<p>".getTranslation("Database is using a future schema version",$settings)."</p>";
	$PAGE->hide_back=true;
	echo $PAGE->content();
	$PAGE->body = getTranslation("downgrade attempt",$settings);
	$PAGE->body = $PAGE->body. "<br/><br/>";
	exit;
}



?>
