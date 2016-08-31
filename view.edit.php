<?php
// gui

// COLUMN 2

if ( isset($_GET['v']) )
{
	if ( in_array($_GET['v'],array_keys($menu)) )
	{
		echo "<h1 style='display:inline;'>";
		echo getTranslation("Function",$settings);
		echo " \"".$q->name."\" ";
		echo getTranslation($menu[$_GET['v']],$settings);
		echo "</h1>";
		echo "<br/>";
		echo "<br/>";
	}
}


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="overview" )
{

$translated_text=getTranslation("edit overview",$settings);
$translated_text=str_replace("q=qn","q=$qn",$translated_text);
echo $translated_text;
echo "<br/>";
echo "<br/>";


echo "<b>";
echo getTranslation("Function",$settings);
echo ":</b>";
echo "<br/>";

echo "<ul>";
echo "<form style='display:inline;' method='post' action='?q=$qn&v=overview&action=update-hf-name'>";
echo getTranslation("Name",$settings);
echo ": <input style=\"font-weight:bold;width:'50%';background-color:".rcolor().";display:inline;\" type='text' name='name' value='".str_replace("'","&#39;",$q->name)."'/>";
echo "<input type='submit' name='btnSubmit' value='";
echo getTranslation("Update",$settings);
echo "' style='background-color:".rcolor().";display:inline;'/>";
echo "</form>";

echo "<br/>";
echo "<br/>";
echo "<ul>";
echo "<form style='display:inline;' onSubmit='return confirm(\"Delete Function?\");' method='post' action='?q=$qn&v=hf-list&action=delete-hf'>";
echo "<input style='display:inline;background-color:".rcolor().";display:inline;' name='btnDelete' value='";
echo getTranslation("Delete Function",$settings);
echo "' type='submit'/>";
echo "</form>";
echo "</ul>";

echo "<form style='display:inline;' method='post' action='?q=$qn&action=clone-hf'>";
/*
echo "<input name='btnClone' style='background-color:".rcolor().";display:inline;' value='";
echo getTranslation("Clone Function",$settings);
echo "' type='submit'/>";
*/
echo "</form>";
echo "</ul>";

}
} // end if (view - overview)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="integration" )
{

$u->build();
$q->build();

echo "<h3>";
echo "How to execute HIS Functions and integrate them into your applications";
echo "</h3>";

echo "<ul>";

echo getTranslation("Collecting HIS data can be done using many common tools",$settings);
echo ".";
echo "<br/>";
echo getTranslation("HTTP GET/POST calls to ",$settings);
echo "$this_server_url";
echo getTranslation(" will return raw HIS data and/or filtered texts.",$settings);
echo "<br/>";
echo "<br/>";
echo getTranslation("HTTP GET/POST calls can be executed using any the following tools",$settings);
echo ":";
echo "<br/>";
echo "<br/>";
echo "<ul>
<li><a href='http://en.wikipedia.org/wiki/Wget#Basic_usage' target='_new'>wget</a></li>
<li><a href='http://php.net/manual/en/book.curl.php' target='_new'>CURL library</a></li>
<li><a href='http://en.wikipedia.org/wiki/CURL#Examples_of_cURL_use_from_command_line' target='_new'>CURL utility</a></li>
<li>jQuery GET/POST event handlers</li>
<li>Native HTTP POST/GET functionality in any modern language</li>
<li>Direct HIS SDK/API access (coming soon) <!--(see <a href='$this_server_url/api.php'>$this_server_url/api.php</a>)--></li>
</ul>";
echo "</ul>";

echo "<h3>";
echo getTranslation("Code Samples for this Function",$settings);
echo "</h3>";

echo "<ul>";

echo getTranslation("Not sure what to type in the [HIS_SECRET_KEY] entry in the sample codes?",$settings);
echo "<br/>";
echo "<br/>";
echo "<ul>";

echo getTranslation("The code snippets below require your HIS Secret Key.",$settings);
echo "<br/>";
echo "<a href='?q=$qn&v=settings'>";
echo getTranslation("Click here",$settings);
echo "</a>";
echo getTranslation(" to find your HIS Secret Key.",$settings);
echo "<br/>";
echo "<br/>";

echo "</ul>";

echo "<ul>";

$found_chk=false;
foreach ($_POST as $PK=>$PV)
{
	if ( strpos($PK,"chkshow_")===0 )
	{
		$found_chk = true;
		break;
	}
}
$show_btn = false;
if ( isset($_POST['btnShowOnly'])  )
{
	$show_btn=true;
}

echo "<form action='?q=$qn&v=integration' method='post'>";

echo "<table>";
echo "<tr>";

$selected_params = array();

echo "<td valign='top'>";
foreach ($q->obj_hf_parameters as $hf_param)
{
	$found_this_check = false;
	if (!$found_chk && !$show_btn)
	{
		if ( !isset($hf_param->obj_inherited) )
		{
			$found_this_check=true;
		}
		else
		{
			if (!$hf_param->obj_inherited)
			{
				$found_this_check=true;
			}
		}
		if ( $hf_param->int_immutable == 1 )
		{
			$found_this_check=false;
		}
	} // END IF (DEFAULT CHECKED STATE)

	foreach ($_POST as $PK=>$PV)
	{
		if ($PK=="chkshow_".$hf_param->parameter_name)
		{
			$found_this_check=true;
		}
	}
	$checked="";
	if ($found_this_check)
	{
		$checked=" checked='checked'";
		$selected_params[] = $hf_param->parameter_name;
	}
	if (!isset($hf_param->obj_overridden) || ( isset($hf_param->obj_overridden) && !$hf_param->obj_overridden) )
	{
		echo "<input type='checkbox' name='chkshow_".$hf_param->parameter_name."' $checked/>";
		echo $hf_param->parameter_name;
		echo "<br/>";
	}
}
echo "</td>";

echo "<td valign='top'>";
echo "<input name='btnShowOnly' style='background-color:".rcolor()."' type='submit' value='";
echo getTranslation("Show only these parameters",$settings);
echo "'/>";
echo "</td>";

echo "</tr>";
echo "</table>";
echo "</form>";

echo "</ul>";

echo getTranslation("Wget Call",$settings);
echo "<ul>";
echo "<textarea cols='80' rows='3' style='background-color:".rcolor().";font-family:Courier New;'>";

$long_full_wget_url = "$this_server_url/?q=".$qn."&uid=".$u->id_user."&secret=[HIS_SECRET_KEY]&remote&cxml";

$long_full_php_url = "$this_server_url/?q=".$qn."&uid=".$u->id_user."&secret=\$HIS_SECRET_KEY&remote&cxml";

$prs="";
foreach ($q->obj_hf_parameters as $hfp)
{
	if (!isset($hfp->obj_overridden) && in_array($hfp->parameter_name,$selected_params ) )
	{
		$prs = $prs."&".$hfp->parameter_name."=".urlencode($hfp->obj_default_value->body);
	}
	if ( isset($hfp->obj_overridden) )
	{
		if (!$hfp->obj_overridden && in_array($hfp->parameter_name,$selected_params) )
		{
			$prs = $prs."&".$hfp->parameter_name."=".urlencode($hfp->obj_default_value->body);
		}
	}
}
if ( $q->id_mime_type=="undefined" )
{
	$q->id_mime_type="text/plain";
}
echo "wget -O my_download.".$STATIC['mime_types'][$q->id_mime_type]." '$long_full_wget_url".$prs."'";

echo "</textarea>";
echo "</ul>";


echo getTranslation("PHP Call",$settings);
echo "<ul>";
echo "<textarea cols='80' rows='3' style='background-color:".rcolor().";font-family:Courier New;'>";

$post_array_php="";
$post_array_idx=0;

$already_printed = array();
foreach ($q->obj_hf_parameters as $hfp)
{
	if (  (isset($hfp->obj_overridden) && !$hfp->obj_overridden && in_array($hfp->parameter_name,$selected_params)) || ( !isset($hfp->obj_overridden) && in_array($hfp->parameter_name,$selected_params)))
	{

		if ( $post_array_idx!=0 && $post_array_idx < count($q->obj_hf_parameters) ) $post_array_php = $post_array_php.",\n";
		else { $post_array_php = $post_array_php."\n";}
		if (isset($hfp->preserve_encode) && $hfp->preserve_encode)
		{
			$post_array_php = $post_array_php."\t'".$hfp->parameter_name."'=>'".str_replace("'","\'",$hfp->obj_default_value->body)."'";
		}
		else
		{
			$post_array_php = $post_array_php."\t'".$hfp->parameter_name."'=>'".str_replace("'","\'",urldecode($hfp->obj_default_value->body))."'";
		}
		$post_array_idx = $post_array_idx + 1;
	}
}

if ( count($q->obj_hf_parameters)>0 ) $post_array_php = $post_array_php."\n";

echo "
<"."?php
\$HIS_SECRET_KEY = \"[HIS_SECRET_KEY]\";
\$url = \"$long_full_php_url\";
\$post = array($post_array_php);
\$defaults = array( 
    CURLOPT_POST => 1, 
    CURLOPT_HEADER => 0, 
    CURLOPT_URL => \$url, 
    CURLOPT_FRESH_CONNECT => 1, 
    CURLOPT_RETURNTRANSFER => 1, 
    CURLOPT_FORBID_REUSE => 1, 
    CURLOPT_FOLLOWLOCATION=>TRUE,
    CURLOPT_TIMEOUT=>10,
    CURLOPT_POSTFIELDS => http_build_query(\$post)
); 
// CURL Options
\$options = array();

\$ch = curl_init(); 
curl_setopt_array(\$ch, (\$options + \$defaults)); 
if( ! \$result = curl_exec(\$ch)) 
{ 
    trigger_error(curl_error(\$ch));
} 
curl_close(\$ch); 
print_r(\$result);";

echo "
?>
</textarea>";
echo "</ul>";


$u->build();
echo getTranslation("HIS Function XML Export",$settings);
echo " - ";
echo "<a target='_new' href='download.php?q=$qn&file=hisfunctionxmlexport'>Download HF XML</a>";
echo "<ul>";
echo "<textarea cols='80' rows='3' style='background-color:".rcolor().";font-family:Courier New;'>";
echo htmlentities($q->toxml(true));
echo "</textarea>";
echo "</ul>";

echo "</ul>";


echo "<br/>";

echo "<h3>";
echo getTranslation("Looking to call this HIS Function via HTTP GET and provide customized inputs to this function?",$settings);
echo "<br/>";
echo getTranslation("Use these Shortcut URLs to launch/execute HIS functions",$settings);
echo ":</h3>";

echo "<ul>";

echo "<b>";
echo getTranslation("Shortcuts",$settings);
echo "</b>:";
echo "<ul>";
echo getTranslation("Live and Default Values",$settings);
echo "<br/>";
	echo "<ul>";
	echo "<a href='?q=$qn&xml&remote' target='_new'>";
	echo getTranslation("live his-xml version of this page",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&xml&remote";
	echo "</font>";
	echo "<br/>";
	echo "<br/>";
	echo "<a href='?q=$qn&xml&short&remote' target='_new'>";
	echo getTranslation("live his-xml short version of this page",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&xml&short&remote";
	echo "</font>";
	echo "<br/>";
	echo "<br/>";
	$download_desc_string=getTranslation("custom-formatted",$settings);
	if ( strlen($hf_expression)==0 )
	{
		$download_desc_string=getTranslation("job's raw",$settings);
	}
	echo "<a href='?q=$qn&cxml&remote' target='_new'>";
	echo getTranslation("live download your",$settings);
	echo " $download_desc_string ";
	echo getTranslation("output",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&cxml&remote";
	echo "</font>";
	echo "<br/>";
	
	$url_addition="";
	foreach ($q->obj_hf_parameters as $hfp)
	{
		if ( !isset($hfp->obj_overridden) || (isset($hfp->obj_overridden) && !$hfp->obj_overridden) )
		{
			$url_addition=$url_addition."&".$hfp->parameter_name."=".urlencode(str_replace("%2A","*",($hfp->printable_value)));
		}
	}

	echo "<br/>";
	echo getTranslation("Live and Fully Described",$settings);
	echo "<br/>";
		echo "<ul>";
		echo "<a href='?q=$qn&xml&remote$url_addition' target='_new'>";
		echo getTranslation("live his-xml version of this page",$settings);
		echo "</a>\n";
		echo "<br/>";
		echo "<font size='-1'>";
		echo "$this_server_url/?q=$qn&xml&remote$url_addition";
		echo "</font>";
		echo "<br/>";
		echo "<br/>";
		echo "<a href='?q=$qn&xml&short&remote$url_addition' target='_new'>";
		echo getTranslation("live his-xml short version of this page",$settings);
		echo "</a>\n";
		echo "<br/>";
		echo "<font size='-1'>";
		echo "$this_server_url/?q=$qn&xml&short&remote$url_addition";
		echo "</font>";
		echo "<br/>";
		echo "<br/>";
		$download_desc_string=getTranslation("custom-formatted",$settings);
		if ( strlen($hf_expression)==0 )
		{
			$download_desc_string=getTranslation("job's raw",$settings);
		}
		echo "<a href='?q=$qn&cxml&remote$url_addition' target='_new'>";
		echo getTranslation("live download your",$settings);
		echo " $download_desc_string ";
		echo getTranslation("output",$settings);
		echo "</a>\n";
		echo "<br/>";
		echo "<font size='-1'>";
		echo "$this_server_url/?q=$qn&cxml&remote$url_addition";
		echo "</font>";
		echo "<br/>";
		echo "</ul>";	
	
	echo "</ul>";
echo "</ul>";
echo "<ul>";
echo getTranslation("Non-Live",$settings);
	echo "<ul>";
	echo "<a href='?q=$qn&xml' target='_new'>";
	echo getTranslation("non-live his-xml version of this page",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&xml";
	echo "</font>";
	echo "<br/>";
	echo "<br/>";
	echo "<a href='?q=$qn&xml&short' target='_new'>";
	echo getTranslation("non-live his-xml short version of this page",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&short&xml";
	echo "</font>";
	echo "<br/>";
	echo "<br/>";
	$download_desc_string=getTranslation("custom-formatted",$settings);
	if ( strlen($hf_expression)==0 )
	{
		$download_desc_string=getTranslation("job's raw",$settings);
	}
	echo "<a href='?q=$qn&cxml' target='_new'>";
	echo getTranslation("non-live download your",$settings);
	echo " $download_desc_string ";
	echo getTranslation("output",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&cxml";
	echo "</font>";
	echo "<br/>";
	echo "<br/>";

	echo "<a href='?q=$qn&cxml&use_approved=yes' target='_new'>";
	echo getTranslation("non-live download your",$settings);
	echo " $download_desc_string ";
	echo getTranslation("output, but use cached pre-approved input resource data as input",$settings);
	echo "</a>\n";
	echo "<br/>";
	echo "<font size='-1'>";
	echo "$this_server_url/?q=$qn&cxml&use_approved=yes";
	echo "</font>";
	echo "<br/>";

	echo "</ul>";


echo "</ul>";

echo "</ul>";



echo "<a name='monitor_collect'>";
echo "<h3>";
echo getTranslation("Want to monitor job status or collect job outputs on your own?",$settings);
echo "<br/>";
echo getTranslation("Use these Shortcut URLs to collect job data",$settings);
echo ":</h3>";
echo "</a>";

echo "<ul>";

echo "<a href='get.php?return=status&job=INSERT-JOB-ID-HERE' target='_new'>";
echo getTranslation("return job status",$settings);
echo "</a>\n";
echo "<br/>";
echo "<font size='-1'>";
echo "$this_server_url/get.php?return=status&job=INSERT-JOB-ID-HERE";
echo "</font>";
echo "<br/>";
echo "<br/>";


echo "<a href='get.php?return=output&job=INSERT-JOB-ID-HERE' target='_new'>";
echo getTranslation("return job output",$settings);
echo "</a>\n";
echo "<br/>";
echo "<font size='-1'>";
echo "$this_server_url/get.php?return=output&job=INSERT-JOB-ID-HERE";
echo "</font>";
echo "<br/>";
echo "<br/>";
	


echo "</ul>";



echo "<b>";
echo getTranslation("Commit Live XML/CXML output as stored output",$settings);
echo " - ";
echo getTranslation("for future reference as an example of this functions [C]XML output",$settings);

echo "</b>\n";
echo "<br/>";
echo "<ul>";
echo "<form action='?q=$qn&v=integration&action=cxo' method='post' style='display:inline;'><input style='background-color:".rcolor()."' value='";
echo getTranslation("Commit XML Output",$settings);
echo "' type='submit'/></form>";
echo "<form action='?q=$qn&v=integration&action=cco' method='post' style='display:inline;'><input style='background-color:".rcolor()."' value='";
echo getTranslation("Commit CXML Output",$settings);
echo "' type='submit'/></form>";
echo "\n\n";
echo "<br/>";
echo "<br/>";
echo "<a href='?q=$qn&xout' target='_new'>";
echo getTranslation("stored xml output sample",$settings);
echo "</a>\n";
echo "<br/>";
echo "<a href='?q=$qn&cout' target='_new'>";
echo getTranslation("stored cxml output sample",$settings);
echo "</a>\n";
echo "<br/>";
echo "<br/>";
echo "</ul>";

}
} // end if (view - shortcuts)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="techniques" )
{
echo getTranslation("Function Techniques Checklist",$settings);
echo ":";
echo "<ul>";
$translated_text=getTranslation("techniques checklist",$settings);
$translated_text=str_replace("q=qn","q=$qn",$translated_text);
$translated_text=str_replace("this_server_url","$this_server_url",$translated_text);
echo $translated_text;
echo "</ul>";
}
} // end if (view - techniques)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="overview" )
{
echo "<b>".getTranslation('Inherit from existing HIS Function',$settings).":</b>";

echo "<ul>";

$u->build();

echo "<b>";
echo getTranslation("Current Inheritance for this Function",$settings);
echo ":</b>";
echo "<ul>";
echo "<br/>";

if ( count($q->obj_hf_inherit)==0 )
{
	echo getTranslation("No Inheritance defined yet.",$settings);
}
foreach ($q->obj_hf_inherit as $hf_inherit)
{
	$parent_function = new hf_id_user();
	$parent_function->get_from_hashrange($u->id_user,$hf_inherit->id_inherit);
	echo "<span style='background-color:".rcolor().";width:500;'>";
	echo "HIS ";
	echo getTranslation("Function",$settings);
	echo ": ".$parent_function->name;
	echo "</span>";
	echo "<form action='?q=$qn&v=overview&action=delete-hf-inherit' method='post'>"; 
	echo "<input type='hidden' name='id' value='".$hf_inherit->id."'/>";
	echo "<input type='submit' name='btnSubmit' style='background-color:".rcolor()."' value='";
	echo getTranslation("Delete",$settings);
	echo "'/>";
	echo "</form>";
	
}

echo "<br/>";
echo "<br/>";
echo "</ul>";


$inheritable_by_this_function=array();
foreach ($u->obj_inherits as $user_inherit)
{
	$a_hf = new hf_id_user();
	$a_hf->get_from_hashrange($user_inherit->id_user,$user_inherit->id_hf);
	if ($a_hf->id!="undefined")
	{
		if ($a_hf->id != $q->id )
		{
			$inheritable_by_this_function[]=$a_hf;
		}
	}
}


if ( count($inheritable_by_this_function)> 0 )
{

	echo "<b>";
	echo getTranslation("Add Inheritance to this Function",$settings);
	echo ":</b>";
	echo "<ul>";

		echo "<form action='?q=$qn&v=overview&action=add-hf-inherit' method='post'>";

			echo "<select name='id_hf' style='background-color:".rcolor().";display:inline;'>";
			echo "<option value=''></option>";
			
			foreach ($inheritable_by_this_function as $user_inherit)
			{
				$a_hf = new hf_id_user();
				$a_hf->get_from_hashrange($user_inherit->id_user,$user_inherit->id);
				echo "<option value='".$a_hf->id."'>HIS Function: ".$a_hf->name."</option>";
			}
			echo "</select>";

		echo "<input type='submit' name='' style='background-color:".rcolor().";display:inline;' value='";
		echo getTranslation("Submit",$settings);
		echo "'/>";
		echo "</form>";

	echo "</ul>";

} // END IF
	
echo "</ul>";



echo "<b>".getTranslation('Allow other HIS Functions to Inherit this Function\'s data',$settings).":</b>";
echo "<ul>";

echo getTranslation("inheritance should",$settings);
echo "<br/>";
echo "<br/>";

echo "<ul>";


if (!$q->obj_bool_inheritable)
{
	echo getTranslation("Inheritance is turned",$settings);
	echo " <span style='background-color:".rcolor().";display:inline;'>";
	echo getTranslation("off",$settings);
	echo "</span> ";
	echo getTranslation("for this function currently.",$settings);
	echo "<br/>";
	echo "<br/>";
	echo "<form action='?q=$qn&v=overview&action=update-inheritance' method='post'>";
	echo "<input type='submit' name='btnInheritanceOn' value='";
	echo getTranslation("Turn Inheritance on for this function",$settings);
	echo "' style='background-color:".rcolor().";'/>";
	echo "</form>";
}
else
{
	echo getTranslation("Inheritance is turned",$settings);
	echo " <span style='background-color:".rcolor().";display:inline;'>";
	echo getTranslation("on",$settings);
	echo "</span>";
	echo getTranslation("for this function currently.",$settings);
	echo "<br/>";
	echo "<br/>";
	echo "<form action='?q=$qn&v=overview&action=update-inheritance' method='post'>";
	echo "<input type='submit' name='btnInheritanceOff' value='";
	echo getTranslation("Turn Inheritance off for this function",$settings);
	echo "' style='background-color:".rcolor().";'/>";
	echo "</form>";

}
echo "</ul>";


echo "</ul>";

echo "<b>".getTranslation('Run This Function on',$settings).":</b>";
echo "<ul>";
echo "<form action='?q=$qn&v=overview&action=hf-edit-system-kind' method='post'>";

$u->build();

$checked_yes="";
foreach ($q->obj_hf_system_kind as $hfsk)
{
	if ($hfsk->id_sk=="any")
	{
		$checked_yes=" checked='yes'";
	}
}
echo "<span style='background-color:".rcolor().";width:400;'>";
echo "<input type='checkbox' name='system_kind[]' value='"."any"."'$checked_yes/>"."Any"."<br/>";

echo "</span>";

foreach ($u->obj_system_kinds as $usk)
{
	$checked_yes="";
	foreach ($q->obj_hf_system_kind as $hfsk)
	{
		if ($hfsk->id_sk==$usk->id && ( !isset($hfsk->obj_enabled) || (isset($hfsk->obj_enabled) && $hfsk->obj_enabled) ) )
		{
			$checked_yes=" checked='yes'";
		}
	}
	echo "<span style='background-color:".rcolor().";width:400;'>";
	echo "<input type='checkbox' name='system_kind[]' value='".$usk->id."'$checked_yes/>".$usk->name."<br/>";
	echo "</span>";
}

echo "<input style='background-color:".rcolor().";' type='submit' name='btnSubmit' value='".getTranslation("Update",$settings)."'/>";
echo "</form>";



echo "</ul>";


echo "<b>".getTranslation('Status of this Function',$settings).":</b>";
echo "<ul>";
echo "<form name='condition' method='post' action='?q=".$qn."&v=overview&action=update-condition'>";

if ($is_dark)
{
	echo "<select name='id_condition' style='background-color:black;color:white;'>";
}
else
{
	echo "<select name='id_condition' style='background-color:".rcolor()."'>";
}

foreach ($STATIC['conditions'] as $k=>$v)
{
	$seltext="";
	if ($q->id_condition==$k)
		$seltext=" selected";
	echo "<option value='".$k."'$seltext>".getTranslation($v,$settings)."</option>";
}
echo "</select>";
echo "<input type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "' style='background-color:".rcolor()."'/>";
echo "</form>";
echo "</ul>";




}
} // end if (view - overview)

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="mime" )
{

echo "<b>";
echo getTranslation("Select MIME type of function CXML output (text/plain is default)",$settings);
echo ":</b>";
echo "<ul>";


if (isset($q->obj_expression) && $q->obj_expression && strlen($q->obj_expression->body)==0)
{
	$text_translation=getTranslation("blank filtering expression 1",$settings);
	$text_translation=str_replace("q=qn","q=$qn",$text_translation);
	echo $text_translation;
}
else
{
	$text_translation=getTranslation("nonblank filtering expression 1",$settings);
	$text_translation=str_replace("q=qn","q=$qn",$text_translation);
	echo $text_translation;
}




echo "<br/>";
echo "<br/>";
echo "<br/>";


echo getTranslation("mime message 1",$settings);

echo "<br/>";
echo "<br/>";
echo "<b>";
echo getTranslation("Select output file MIME type",$settings);
echo ":</b>";
echo "<br/>";
echo "<form action='?q=$qn&v=mime&action=update-mime-type' method='post'>";
echo "<input type='hidden' name='qid' value='$qn'/>";
echo "<select name='id_mime' style='background-color:".rcolor().";display:inline;'>";
echo "<option value=''></option>";
foreach ($STATIC['mime_types'] as $mime_type_key=>$mime_type_value)
{
	$seltxt="";
	if ($mime_type_key==$q->id_mime_type)
	{
		$seltxt=" selected";
	}
	echo "<option value='".$mime_type_key."'$seltxt>".$mime_type_key."</option>";
}
echo "</select>";
echo "<br/>";
echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</form>";
echo "</ul>";
echo "<br/>";
echo "<br/>";

}
} // end if (mime)

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="time" )
{

echo "<b>";
echo getTranslation("Function Synchronous/Wait Behaviour",$settings);
echo "</b>";

echo "<ul>";
$translated_text=getTranslation("time behavior 1",$settings);
$translated_text=str_replace("THIS_SERVER","<a href='$this_server_url?q=a1b2c3&my=data&here'>$this_server_url?q=a1b2c3&my=data</a>",$translated_text);
echo $translated_text;
echo "<br/>";
echo "<br/>";

echo "<b>";
echo getTranslation("Select wait behavior",$settings);
echo ":</b>";
echo "<br/>";

echo "<form action='?q=$qn&v=time&action=update-hf-wait' method='post'>";
echo "<select style='background-color:".rcolor()."' name='int_wait'>";
echo "<option></option>";
foreach ($STATIC['wait_types'] as $wait_type_key=>$wait_type_value)
{
	$seltxt="";
	if ( intval($q->int_wait)==$wait_type_key )
	{
		$seltxt=" selected";
	}
	echo "<option value='".$wait_type_key."'$seltxt>";
	echo getTranslation($wait_type_value,$settings);
	echo "</option>";
}
echo "</select>";
echo "<input type='submit' style='background-color:".rcolor()."' value='";
echo getTranslation('Submit',$settings);
echo "'/>";
echo "</form>";

if ( intval($q->int_wait) == 0 )
{
	echo "<span style='width:600;background-color:".rcolor()."'>";
	$translated_text=getTranslation('fast response',$settings);
	$translated_text=$translated_text."<br/><br/>".getTranslation('To collect your "Fast-Response" job\'s output, see your '.$q->name.'\'s <a href="?q=qn&v=integration#monitor_collect">Integration</a> page.',$settings);
	$translated_text=str_replace("q=qn","q=$qn",$translated_text);
	echo $translated_text;
	echo "<br/>";
	echo "<br/>";
	echo "</span>";
}
if ( intval($q->int_wait) == 1 )
{
	echo "<span style='width:600;background-color:".rcolor()."'>";
	$translated_text=getTranslation('slow response',$settings);
	$translated_text=str_replace("q=qn","q=$qn",$translated_text);
	echo $translated_text;
	echo "<br/>";
	echo "<br/>";
	echo "</span>";
}



echo "</ul>";

if ( intval($q->int_wait) == 0 )
{

	echo "<b>";
	echo getTranslation("Fast Response Job Submission Printout",$settings);
	echo "</b>";
	echo "<ul>";
	$translated_text=getTranslation("fast response submission printout",$settings);
	$translated_text=str_replace("q=qn","q=$qn",$translated_text);
	$translated_text=str_replace("this_server_url","$this_server_url",$translated_text);
	echo $translated_text;
	echo "<br/>";
	echo "<br/>";

	echo "<ul>";
	echo htmlspecialchars("<success value='JOB-SUBMITTED' job='"."NEW-JOB-ID-WILL-APPEAR-HERE"."'/>");
	echo "</ul>";
	echo "<br/>";

	$translated_text=getTranslation("fast response submission printout2",$settings);
	$translated_text=str_replace("q=qn","q=$qn",$translated_text);
	$translated_text=str_replace("this_server_url","$this_server_url",$translated_text);
	echo $translated_text;

	echo "<br/>";
	echo "<br/>";

	echo "<b>";
	echo getTranslation("Current Parameter Values",$settings);
	echo ": ";
	echo "</b>";

	echo "<ul>";
	echo "<table border='1'>";
	foreach ($q->obj_hf_parameters as $hf_param)
	{
		if ( isset($hf_param->obj_overridden) && $hf_param->obj_overridden)
		{
			continue;
		}

		echo "<tr>";
		echo "<td>";
		echo "<pre>";
		echo htmlspecialchars($hf_param->keyword);
		echo "</td>";
		echo "<td style='font-size:10px'>";
		echo htmlspecialchars($hf_param->printable_value);
		echo "</td>";
		echo "</tr>";
	}
	echo "<tr>";
	echo "<td>";
	echo "<pre>";
	echo htmlspecialchars("[JID]");
	echo "</td>";
	echo "<td style='font-size:10px'>";
	echo htmlspecialchars("NEW-JOB-ID-WILL-APPEAR-HERE");
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "<br/>";
	echo "</ul>";


	echo "<b>";
	echo getTranslation("Enter a new Fast Response below",$settings);
	echo ": ";
	echo "</b>";
	echo "<form style='display:inline;' action='?q=$qn&v=time&action=update-hf-fastresponse' method='post'>";
	echo "<textarea rows='1' style='background-color:".rcolor().";width:500px;' name='str_fastresponse'>";

	if (!isset($q->obj_fastresponse))
	{
		$q->obj_fastresponse = new strings();
		$q->obj_fastresponse->body="";
	}
	if ($q->obj_fastresponse==false)
	{
		$q->obj_fastresponse = new strings();
		$q->obj_fastresponse->body="";
	}
	if ($q->obj_fastresponse->body==""||$q->obj_fastresponse->body=="undefined")
	{
		$q->obj_fastresponse->body = "<success value='JOB-SUBMITTED' job='[JID]'/>";
	}
	$q->obj_fastresponse->value = replace_hf_parameters($q->obj_fastresponse->body,$q->obj_hf_parameters);
	$q->obj_fastresponse->value = str_replace("[JID]","NEW-JOB-ID-WILL-APPEAR-HERE",$q->obj_fastresponse->value);
	echo $q->obj_fastresponse->body;

	echo "</textarea>";
	echo "<input style='background-color:".rcolor()."' type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";
	echo "</form>";

	if ($q->obj_fastresponse->body!=$q->obj_fastresponse->value)
	{
		echo "<ul>";
		echo "<b>After Function Parameter Value Replacement:</b>";
		echo "<ul>";
		echo "<textarea style='background-color:".rcolor().";width:500px;' rows='1' readonly='readonly'>";
		echo str_replace("<","&lt;",$q->obj_fastresponse->value);
		echo "</textarea>";
		echo "</ul>";
		echo "</ul>";
	}
	echo "<br/>";
	echo "<br/>";


	echo "</ul>";

}


echo "<b>";
echo getTranslation("Function Maximum Run Time",$settings);
echo "</b>";
echo "<ul>";
echo getTranslation("max function run time seconds",$settings);
echo ":";
echo "<br/>";
echo "<br/>";
echo "<form style='display:inline;' action='?q=$qn&v=time&action=update-hf-maxruntime' method='post'>";
echo "<input type='text' style='background-color:".rcolor()."' value='".$q->int_maxruntime."' name='int_maxruntime'/>";

if ($q->int_maxruntime_value!=$q->int_maxruntime)
{
	echo "<ul>";
	echo "After Function Parameter Value Replacement:";
	echo "<span style='background-color:".rcolor()."'>";
	echo str_replace("<","&lt;",$q->int_maxruntime_value);
	echo "</span>";
	echo "</ul>";
}

$checked_mtf=" checked='checked'";
if ($q->int_mtf=="0")
{
	$checked_mtf="";
}

echo "<span style='background-color:".rcolor()."'>";
echo "<input type='checkbox' name='int_mtf' value='1' $checked_mtf/>";
echo " ";
echo getTranslation("If a function goes over above time limit, consider job as 'failed' and do not try to parse collected remote content",$settings);
echo "</span>";

echo "<input style='background-color:".rcolor()."' value='";
echo getTranslation("Submit",$settings);
echo "' type='submit'/>";
echo "</form>";

//echo "<!--";

echo "<br/>";
echo "<br/>";
echo getTranslation("if max processes",$settings);
echo "<br/>";
echo "<br/>";
echo "<b>";
echo getTranslation("current process list",$settings);
echo "</b>";
echo "<ul>";
if ( count($q->obj_hf_kill)>0 )
{
	foreach ($q->obj_hf_kill as $hf_kill)
	{
		echo "<form style='display:inline;' action='?q=$qn&v=time&action=delete-hf-terminate-name' method='post'>";
		echo "<input type='text' style='background-color:".rcolor()."' value='".$hf_kill->obj_name->body."' name='str_name'/>";
		echo "<input type='hidden' name='id_hf' value='".$hf_kill->id_hf."'/>";
		echo "<input type='hidden' name='id' value='".$hf_kill->id."'/>";
		if ($hf_kill->value!=$hf_kill->obj_name->body)
		{
			echo "<ul>";
			echo "After Function Parameter Value Replacement:";
			echo "<span style='background-color:".rcolor()."'>";
			echo str_replace("<","&lt;",$hf_kill->value);
			echo "</span>";
			echo "</ul>";
		}

		echo "<input type='submit' style='background-color:".rcolor()."' name='btnDelete' value='";
		echo getTranslation("Delete",$settings);
		echo "'/>";
		echo "</form>";


		echo "<br/>";
	}
}
else
{
	echo "<br/>";
	echo getTranslation("No Process Names specified yet.",$settings);
}
echo "</ul>";
echo "<br/>";
echo "<b>";
echo getTranslation("add new process",$settings);
echo "</b>";
echo "<ul>";
echo "<form style='display:inline;' action='?q=$qn&v=time&action=add-hf-terminate-name' method='post'>";
echo "<input type='text' value='iexplore.exe' style='background-color:".rcolor()."' name='str_name'/>";
echo "<input style='background-color:".rcolor()."' type='submit' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</form>";
echo "</ul>";
echo "<br/>";
echo "<br/>";
echo "</ul>";

echo "<b>";
echo getTranslation("Function Execution Retry",$settings);
echo "</b>";

echo "<ul>";

echo getTranslation("If function execution fails or exceeds max execution time limit, how many times should execution be re-tried?",$settings);

echo "<ul>";

echo "<form action='?q=".$qn."&action=update-hf-retry&v=time' method='post'>";

echo "<input type='text' name='int_retry_count' value='".intval($q->int_retry_count)."' style='background-color:".rcolor()."'/>";

echo "<input style='background-color:".rcolor()."' type='submit' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</form>";

echo "</ul>";

echo getTranslation("Enter a negative number to have the function execution retried until success (could cause function to retry forever).",$settings);


echo "<br/>";
echo "<br/>";
echo "</ul>";
echo "<br/>";
echo "<br/>";


//echo "-->";


}
} // end if (output CXML mime type)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="output-expression" )
{

echo "<b>";
echo getTranslation("Output Expressions",$settings);
echo ":</b>";
echo "<br/>";

echo "<ul>";

$translated_text=getTranslation("output expression description",$settings);
$translated_text=str_replace("q=qn","q=$qn",$translated_text);
$translated_text=str_replace("this_server_url","$this_server_url",$translated_text);

echo $translated_text;
echo "<br/>";
echo "<br/>";


/// SERVICES DEFINITION
$services_file="services.xml";
$service_doc = xmlToArray( simplexml_load_file($services_file) );
$SERVICES=array();
foreach ($service_doc as $services)
{
	foreach ($services as $service)
	{
		$SERVICES[]=new Service($service);
	}
}

if ( isset($q->obj_cache_ad) && isset($q->obj_cache_ad->body) )
{
	$adjacent_dictionary_encoded = $q->obj_cache_ad->body;
	if ($adjacent_dictionary_encoded!='undefined')
	{
		$adjacent_dictionary_base64decoded=base64_decode($adjacent_dictionary_encoded);
		$adjacent_dictionary_array=unserialize($adjacent_dictionary_base64decoded);
		$adjacent_dictionary=$adjacent_dictionary_array['ad'];
		$adjacent_dictionary["[RAW_OUTPUT]"]=$q->obj_cache_out_cxml->body;
	}
	else
	{
		if (!isset($adjacent_dictionary)) {$adjacent_dictionary=array();}
		$adjacent_dictionary['[RAW_OUTPUT]']='Function has not been run yet, no Raw output is available';
	}
}

echo "<ul>";
	echo "<b>";
	echo getTranslation("Current Parameter Values",$settings);
	echo ": ";
	echo "</b>";
	
	echo "<ul>";
	echo "<table border='1'>";
	foreach ($q->obj_hf_parameters as $hf_param)
	{
		if ( isset($hf_param->obj_overridden) && $hf_param->obj_overridden)
		{
			continue;
		}
		
		echo "<tr>";
		echo "<td valign='top'>";
		echo htmlspecialchars($hf_param->keyword);
		echo "</td>";
		echo "<td style='font-size:10px'>";

		if ( is_secret($hf_param->keyword) )
		{
			echo htmlspecialchars($hf_param->printable_value);
		}
		else
		{
			echo htmlspecialchars($hf_param->value);
		}

		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br/>";
	echo "</ul>";


	echo "<b>";
	echo getTranslation("Current Adjacent Dictionary Contents",$settings);
	echo ": ";
	echo "</b>";
	

	echo "<ul>";
	echo "<table border='1'>";
	foreach ($adjacent_dictionary as $adk=>$adv)
	{
		echo "<tr>";
		echo "<td valign='top'>";
		echo htmlspecialchars($adk);
		echo "</td>";
		echo "<td style='font-size:10px'>";
		echo htmlspecialchars($adv);
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
	echo "<br/>";
	echo "</ul>";
echo "</ul>";


$q->build();

$match_entries=$q->obj_expression->obj_match_entries;
usort($match_entries, "meordersort");
$bool_output_expression = false;
foreach ($match_entries as $match_entry)
{
	if (strpos($match_entry->idx_id,"-1")===0 &&  $match_entry->id_entry_type == 'output')
	{
		foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
		{
			$match_entry->obj_me_settings[$MESK]->value=replace_dictionary($match_entry->obj_me_settings[$MESK]->value,$adjacent_dictionary);
		}
	
		echo "<ul>";

		echo "<form action='?q=$qn&v=output-expression&action=update-match-entry' method='post' style='display:inline;'>";
		echo "<input type='hidden' name='id_expr' value='".$match_entry->id_expr."'>";
		echo "<input type='hidden' name='idx_id' value='".$match_entry->idx_id."'>";
		echo "<input type='hidden' name='id_entry_type' value='".$match_entry->id_entry_type."'>";

		echo "<b>";
		echo getTranslation("Output Expression",$settings);
		echo ": ";
		echo "</b>";

		echo "<select name='id_entry_subtype' style='background-color:".rcolor().";display:inline;'>";
		foreach ($STATIC['output_types'] as $output_key=>$output_value)
		{
			if ($output_key=="print-value") continue;
			$seltxt="";
			if ($output_key==$match_entry->id_entry_subtype)
			{
				$seltxt=" selected";
			}
			echo "<option value='".$output_key."'$seltxt>".getTranslation($output_value,$settings)."</option>";
		}
		echo "</select>";

		echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
		echo getTranslation("Update",$settings);
		echo "'/>";
		echo "<input type='submit' name='btnDelete' style='background-color:".rcolor().";display:inline;' value='";
		echo getTranslation("Delete",$settings);
		echo "'/>";

		echo "<br/>";
		echo "<br/>";
		echo "<ul>";

		if ( $match_entry->id_entry_subtype == 'print-value' )
		{
			// PRINT VALUE
			echo "Value will be printed out to the web page/console/output file.";
			echo "<br/>";
			echo "<br/>";
		} // END IF (PRINT VALUE)


		// GENERALLY USED MATCH ENTRY SETTING - ITS OKAY IF IT IS NOT USED
		$do_this_output_in_edit_mode=false;
		if ( isset( $match_entry->obj_me_settings['run_in_edit_mode'] ) )
		{
			if ( $match_entry->obj_me_settings['run_in_edit_mode']->value=="true"  )
			{
				$do_this_output_in_edit_mode=true;
			}
		}
	
		$plugin_base_filename = "plugins/matchentry.".$match_entry->id_entry_type.".".$match_entry->id_entry_subtype."";
		$plugin_init_filename = $plugin_base_filename."."."init".".php";
		$plugin_exec_filename = $plugin_base_filename."."."exec".".php";
		$plugin_dispose_filename = $plugin_base_filename."."."dispose".".php";
		$plugin_edit_filename = $plugin_base_filename."."."edit".".php";

		if ( file_exists($plugin_init_filename) )
		{
			try
			{
				include($plugin_init_filename);
			}
			catch (Exception $e)
			{
				if ($mode_edit)
				{
					echo "<br/>";
				}
				echo getTranslation("PLUGIN ERROR DURING INITIALIZATION",$settings);
				echo ": ";
				if ($mode_edit)
				{
					echo "<br/>";
					echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
				}
				echo str_replace("<","&lt;",$e);
				if ($mode_edit)
				{
					echo "</textarea>";
					echo "<br/>";
				}
			}
		}

		if (!$mode_edit || ($mode_edit && $do_this_output_in_edit_mode) )
		{
		
			if ( file_exists($plugin_exec_filename) )
			{
				try
				{
					include($plugin_exec_filename);
				}
				catch (Exception $e)
				{
					if ($mode_edit)
					{
						echo "<br/>";
					}
					echo getTranslation("PLUGIN ERROR DURING EXECUTION",$settings);
					echo ": ";
					if ($mode_edit)
					{
						echo "<br/>";
						echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
					}
					echo str_replace("<","&lt;",$e);
					if ($mode_edit)
					{
						echo "</textarea>";
						echo "<br/>";
					}
				}
			}
		}

		

		if ( file_exists($plugin_edit_filename) )
		{
			try
			{
				include($plugin_edit_filename);
			}
			catch (Exception $e)
			{
				if ($mode_edit)
				{
					echo "<br/>";
				}
				echo getTranslation("PLUGIN ERROR DURING EDIT",$settings);
				echo ": ";
				if ($mode_edit)
				{
					echo "<br/>";
					echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
				}
				echo str_replace("<","&lt;",$e);
				if ($mode_edit)
				{
					echo "</textarea>";
					echo "<br/>";
				}
			}
		}
		
		
		if ( file_exists($plugin_dispose_filename) )
		{
			try
			{
				include($plugin_dispose_filename);
			}
			catch (Exception $e)
			{
				if ($mode_edit)
				{
					echo "<br/>";
				}
				echo getTranslation("PLUGIN ERROR DURING DISPOSAL",$settings);
				echo ": ";
				if ($mode_edit)
				{
					echo "<br/>";
					echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
				}
				echo str_replace("<","&lt;",$e);
				if ($mode_edit)
				{
					echo "</textarea>";
					echo "<br/>";
				}
			}
		}
		echo "</ul>";
		
	
	
		$bool_output_expression=true;
		echo "<ul>";
		echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
		echo "<input type='submit' name='btnUp' value='".getTranslation("Move Up",$settings)."'/>";
		echo "<input type='submit' name='btnDown' value='".getTranslation("Move Down",$settings)."'/>";
		echo "<input type='submit' name='btnDelete' value='".getTranslation("Delete",$settings)."'/>";
		echo "</ul>";


		echo "</ul>";

		echo "</form>";
		echo "<br/>";
		echo "<br/>";

	} // END IF (OUTPUT EXPRESSION MATCHENTRY)
} // END FOREACH (ALL MATCHENTRIES)

echo "</ul>";

if (!$bool_output_expression)
{
	echo "<ul>";
	echo getTranslation("No Output Expressions specified yet.",$settings);
	echo "</ul>";
}
echo "<b>";
echo getTranslation("Add Output Expression",$settings);
echo ":</b>";
echo "<ul>";
echo "<form style='display:inline;' action='?q=$qn&action=add-match-entry&v=output-expression' method='post'>";
echo "<input type='hidden' name='id_expr' value='".$q->str_expression."'/>";
echo "<input type='hidden' name='idx_id' value='-1'/>";
echo "<input type='hidden' name='id_entry_type' value='output'/>";
//echo "<pre>";
//print_r($q);
$otoptions="<option value=''>(".getTranslation("select one",$settings).")</option>";
foreach ( $STATIC['output_types'] as $output_type_key=>$output_type_value )
{
	if ($output_type_key=="print-value") continue;
	$otoptions=$otoptions."<option value='$output_type_key'>";
	$otoptions=$otoptions.getTranslation($output_type_value,$settings);
	$otoptions=$otoptions."</option>";
}
echo getTranslation("Output Type",$settings);
echo "<br/><select name='id_entry_subtype' style='height:46px;background-color:".rcolor()."width:500;display:inline;'>$otoptions</select>";
echo "<input style='background-color:".rcolor().";display:inline;' value='";
echo getTranslation("Submit",$settings);
echo "' type='submit'/>";
echo "</form>";
echo "</ul>";
}
} // end if (view - output expressions)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="filtering-expression" )
{
echo "<b>";
echo getTranslation("Filtering Pattern",$settings);
echo ":</b>";

echo "<ul>";
echo getTranslation("filtering expression 1",$settings);
echo "<br/>";
echo "<br/>";
echo getTranslation("If a blank regular expression is given",$settings);
echo " ";
if (strlen($q->obj_expression->body)==0)
{
	echo getTranslation("(as it currently is)",$settings);
	echo " ";
}
$translated_text=getTranslation("then raw byte data gathered",$settings);
$translated_text=str_replace("q=qn","q=$qn",$translated_text);
echo $translated_text;
echo "<br/>";
echo "<br/>";

if (strlen($q->obj_expression->body)==0)
{
	echo "<span style='background-color:".rcolor()."'>";
	echo getTranslation("(blank filtering expression; no further HIS processing; raw data will be returned)",$settings);
	echo "</span>";
	echo "<br/>";
}

echo getTranslation("Modify Current Filtering Expression",$settings);
echo ": ";

echo "<ul>";
echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=edit-main-filtering-pattern' method='post'>";
echo "<input type='hidden' name='id_expression' value='".$q->str_expression."'/>";
echo "<textarea cols='50' style=\"background-color:".rcolor()."font-family:'Courier New'\" rows='1' name='regex'>";
echo str_replace("<","&lt;",$q->obj_expression->body);
echo "</textarea>";
if ($q->obj_expression->value!=$q->obj_expression->body)
{
	echo "After Function Parameter Value Replacement:<br/><ul><span style='background-color:".rcolor()."'>".str_replace("<","&lt;",$q->obj_expression->value)."</span></ul>";
}
echo "<input style='background-color:".rcolor().";display:inline;' value='";
echo getTranslation("Submit",$settings);
echo "' type='submit'/>";
echo "</form>";
echo "</ul>";
echo "<br/>";

echo "</ul>";

if (false && $hf_expression=="(.*)")
{
	echo "\nThis Regular Expression is usually a temporary placeholder, used to capture ENTIRE page content.\n";
	echo "Once you have identified a better \"first\" regular expression, you can replace this placeholder with that better one, to ensure maximum execution speed of your hfs.\n";
}

}
} // end if (view - filtering expression)

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="filtering-expression" )
{

if ( strlen(trim($hf_expression))>0 )
{
	if ($q->obj_cache_latest)
	{
		if ( isset($q->obj_cache_latest->val) )
		{

echo "<b>";
echo getTranslation("Whitespace Sensitivity",$settings);
echo ":</b>";
echo "<ul>";
echo "<form action='?q=$qn&v=filtering-expression&action=update-whitespace' method='post'>";
$seltxt="";
if ( intval($q->int_ws)==1 )
{
	$seltxt=" checked='yes'";
}
echo "<input type='hidden' name='qid' value='$qn'/>";
echo getTranslation("Sensitive to whitespace?",$settings);
echo "<span style='background-color:".rcolor().";display:inline;width:60px;'>";
echo "<input type='checkbox' name='whitespace'$seltxt/>";
echo "</span>";

echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";
echo "</form>";
echo "</ul>";

echo "<b>";
echo getTranslation("Default Adjacent Dictionary Contents",$settings);
echo ": ";
echo "</b>";
echo "<ul>";
echo "<table border='1'>";
foreach ($adjacent_dictionary as $adk=>$adv)
{
		echo "<tr>";
		echo "<td>";
		echo htmlspecialchars($adk);
		echo "</td>";
		echo "<td style='font-size:10px'>";
		echo htmlspecialchars($adv);
		echo "</td>";
		echo "</tr>";
}
echo "</table>";
echo "</ul>";
echo "<br/>";
echo "</ul>";
		

		}
	}
}





}
} // end if (view - whitespace sensitivity)





if ( isset($_GET['v']) )
{
if ( $_GET['v']=="overview" )
{
echo "<b>";
echo getTranslation('Cache Activity',$settings);
echo ":</b>";
echo "<ul>";

echo getTranslation("Ephemeral Remote",$settings);
echo ": ".intval($ephemeral_remote)."\n";
echo "<br/>";
echo getTranslation("Function Parameters Given",$settings);
echo ": ".intval($hf_parameters_given)."\n";
echo "<br/>";
echo getTranslation("Refresh Cache",$settings);
echo ": ".intval($refresh_cache)."\n";
echo "<br/>";
echo getTranslation("Use Approved",$settings);
echo ": ".intval(isset($_GET['use_approved']))."\n";
echo "<br/>";
echo getTranslation("Cache content used",$settings);
echo ": ".intval($cache_content_used)."\n";
echo "<br/>";
echo $cache_message;
echo "<br/>";

echo "</ul>";

}
} // end if (view - cache activity)

// gui + true_resource collection
// remote job options, job filters, job node passwords,


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="node-filters" )
{

echo "<ul>";

echo getTranslation("node filters 1",$settings);

echo "<br/>";
echo "<br/>";

echo "<b>";
echo getTranslation("Current Job Server Filters",$settings);
echo ":</b>\n";
echo "<ul>";
$fqn=$q->obj_hf_node_filters;

if (is_array($fqn)>0)
{
	if ( count($fqn) > 0 )
	{
		foreach($fqn as $fk=>$fv)
		{
			echo "<span style='background-color:".rcolor().";width:500;'>";
			echo str_replace("<","&lt;",$fv->obj_filter->body);
			echo "</span>\t";

			if ($fv->value!=$fv->obj_filter->body)
			{
				echo "<ul>";
				echo "After Function Parameter Value Replacement: ";
				echo "<span style='background-color:".rcolor().";width:450;'>";
				echo str_replace("<","&lt;",$fv->value);
				echo "</span>\t";
				echo "</ul>";
			}

			echo "<form action='?q=$qn&v=node-filters&action=delete-job-node-filter' style='display:inline;' method='post'>";
			echo "<input type='hidden' name='nid' value='".$fv->id."'/>";
			echo "<input type='hidden' name='id_hf' value='$qn'/>";
			echo "<input type='submit' style='background-color:".rcolor()."' value='";
			echo getTranslation("Delete Filter",$settings);
			echo "'/>";
			echo "</form>\n";
		} // END FOR
	}
	else
	{
		echo "<br/>";
		echo getTranslation("No filters found.",$settings);
		echo "<br/>";
		echo "<br/>";
	}
}
else
{
	echo "<br/>";
	echo getTranslation("No filters found.",$settings);
	echo "<br/>";
	echo "<br/>";
}
echo "</ul>";
echo "\n";

echo "<br/>";
echo "<b>";
echo getTranslation("Add Job Server Filter",$settings);
echo ":</b>";
echo "<br/>";
echo "<br/>";
echo "<ul>";
echo getTranslation("Only run THIS function/job on a node/server whose \"-node\" name matches this pattern",$settings);
echo ":";
echo "<form action='?q=$qn&v=node-filters&action=add-job-node-filter' method='post'>";
echo "\t<!--Node Name Filter (compared to nodes' -node entry):--><input type='text' style='background-color:".rcolor().";width:500px;' name='filter_expression' style='width:500px;'/>\n";
echo "<input type='hidden' name='id_hf' value='$qn'/>";
echo "<input type='submit' style='background-color:".rcolor()."' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</form>";
echo "<br/>";
echo "</ul>";


		echo "<h3>";
		echo getTranslation("List of Server Instances",$settings);
		echo ":</h3>";
		echo "<table width='100%'><tr><td style='padding-left:20px;'>";
		echo "<pre>";
		$u->build();
				if (count($u->obj_servers)>0)
				{
					echo "<table>";
					echo "<tr><td>";
					echo "<form onsubmit='return confirm(\"Update ALL Servers to latest version?\");' style='display:inline;' method='post' action='?action=ras'><input style='font-size:9px;' type='submit' name='restart' value='% ALL' title='Update ALL Servers to latest version' alt='Update ALL Servers to latest version'/></form>";
					echo "</td><td colspan='4'></td><td width='100'><u><b>";
					echo getTranslation("Job Node",$settings);
					echo "</b></u></td><!--<td><u><b>";
					echo getTranslation("Address",$settings);
					echo "</b></u></td>--><td><u><b>";
					echo getTranslation("Last Seen",$settings);
					echo "</b></u></td></tr>";
					foreach ($u->obj_servers as $job_server)
					{
						$icons="";
						$svr_name=$job_server->name;
						$icons=$icons."<td>";
						$icons=$icons."<form style='display:inline;' method='post' action='?action=rss'><input style='font-size:9px;' type='submit' name='restart' value='%' title='Update Server to latest version' alt='Update Server to latest version'/></form>";
						$icons=$icons."</td>";

						// 32
						$icons=$icons."<td width='15'>";
						if (strpos($svr_name,"32")!==false)
						{
							$icons=$icons."<b>x32</b>";
						}
						else
						{
							$icons=$icons."&nbsp;";
						}
						$icons=$icons."</td>";

						// 64
						$icons=$icons."<td width='15'>";
						if (strpos($svr_name,"64")!==false)
						{
							$icons=$icons."<b>x64</b>";
						}
						else
						{
							$icons=$icons."&nbsp;";
						}
						$icons=$icons."</td>";


						// ubuntu
						$icons=$icons."<td width='15'>";
						if (strpos($svr_name,"ubuntu")!==false)
						{
							$icons=$icons."<img width='15' height='15' src='images/ubuntu.png'/>";
						}
						elseif (strpos($svr_name,"debian")!==false)
						{
							$icons=$icons."<img width='15' height='15' src='images/debian.png'/>";
						}
						else
						{
							$icons=$icons."&nbsp;";
						}
						$icons=$icons."</td>";

						// windows
						$icons=$icons."<td width='15'>";
						if (strpos($svr_name,"win")!==false)
						{
							if (strpos($svr_name,"win7")!==false)
							{
								$icons=$icons."<img width='15' height='15' src='images/win7.png'/>";
							}
							elseif  (strpos($svr_name,"2008")!==false)
							{
								$icons=$icons."<img width='15' height='15' src='images/win2008.png'/>";
							}
							else
							{
								$icons=$icons."<img width='15' height='15' src='images/win2008.png'/>";
							}
						}
						else
						{
							$icons=$icons."&nbsp;";
						}
						$icons=$icons."</td>";

						echo "<tr>$icons<td style='padding-right:20px;font-size:9px;' nowrap='nowrap'>".$svr_name."</td><td nowrap='nowrap'>";
						if ( time() > intval($job_server->last_ping) )
						{
							echo time_elapsed(time()-intval($job_server->last_ping))." ".getTranslation("ago",$settings)." ";
						}
						elseif ( time() < intval($job_server->last_ping) )
						{
							echo "+".time_elapsed(intval($job_server->last_ping)-time())." ".getTranslation("from now",$settings);
						}
						else
						{
							echo "0s ".getTranslation("ago",$settings);
						}
						echo "</td></tr>";
					}
					echo "</table>\n\n";
				}
				else
				{
					echo getTranslation("No job servers have been added yet.",$settings);
				}
		echo "</td></tr></table>";

				echo getTranslation("Want to add a job server?",$settings);
				echo "<br/>";
                echo "<a href='?q=$qn&v=map'>";
				echo getTranslation("Click here",$settings);
				echo "</a> ";
				echo getTranslation("to generate a his-config.php file for your server.",$settings);
				echo "<br/>";


	echo "</ul>";


	echo "<h1>";
	echo getTranslation("Server Cleanup",$settings);
	echo "</h1>";
	echo getTranslation("",$settings);
	$checked="";
	if ($q->int_cleanup=="1")
	{
		$checked="checked='true'";
	}
	echo "<ul>";
	echo "<form action='?q=$qn&v=node-filters&action=update-cleanup' method='post'>";
	echo getTranslation("Cleanup all job files after job completion?",$settings);
	echo " ";
	echo "<input type='hidden' name='id_hf' value='$qn'/>";
	echo "<span style='background-color:".rcolor().";width:50px;text-align:center;display:inline;'>";
	echo "<input type='checkbox' style='-ms-transform: scale(2); /* IE */ -moz-transform: scale(2); /* FF */  -webkit-transform: scale(2); /* Safari and Chrome */  -o-transform: scale(2); /* Opera */ padding: 10px;' name='chkCleanup' value='true' $checked/>";
	echo "</span>";
	echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";

	echo "</form>";
	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";


}
} // end if (view - node filters)


if ( false && isset($_GET['v']) )
{
if ( $_GET['v']=="node-filters" )
{

echo "<br/>";
echo "<b>";
echo getTranslation("List of Remote Job Nodes:",$settings);
echo "</b>";

$u->build();
$nodes=$u->obj_servers;

if (count($nodes)>0)
{
	echo "<table style='margin-left:20px;'>";
	echo "<tr><td><td colspan='4'></td><td width='100'><u><b>";
	echo getTranslation("Job Node",$settings);
	echo "</b></u></td><td></td><td><u><b>";
	echo getTranslation("Last Seen",$settings);
	echo "</b></u></td></tr>";
	foreach ($nodes as $node)
	{
			$icons="";
			$svr_name=$node->name;
			$icons=$icons."<td>";
			$icons=$icons."<form style='display:inline;' method='post' action='?q=$qn&action=rss'><input type='hidden' name='nid' value='".$node->id."'/><input style='font-size:9px;' type='submit' name='restart' value='%'/></form>";
			$icons=$icons."</td>";

			// 32
			$icons=$icons."<td width='15'>";
			if (strpos($svr_name,"32")!==false)
			{
				$icons=$icons."<b>x32</b>";
			}
			else
			{
				$icons=$icons."&nbsp;";
			}
			$icons=$icons."</td>";

			// 64
			$icons=$icons."<td width='15'>";
			if (strpos($svr_name,"64")!==false)
			{
				$icons=$icons."<b>x64</b>";
			}
			else
			{
				$icons=$icons."&nbsp;";
			}
			$icons=$icons."</td>";


			// ubuntu
			$icons=$icons."<td width='15'>";
			if (strpos($svr_name,"ubuntu")!==false)
			{
				$icons=$icons."<img width='15' height='15' src='images/ubuntu.png'/>";
			}
			elseif (strpos($svr_name,"debian")!==false)
			{
				$icons=$icons."<img width='15' height='15' src='images/debian.png'/>";
			}
			else
			{
				$icons=$icons."&nbsp;";
			}
			$icons=$icons."</td>";

			// windows
			$icons=$icons."<td width='15'>";
			if (strpos($svr_name,"win")!==false)
			{
				if (strpos($svr_name,"win7")!==false)
				{
					$icons=$icons."<img width='15' height='15' src='images/win7.png'/>";
				}
				elseif  (strpos($svr_name,"2008")!==false)
				{
					$icons=$icons."<img width='15' height='15' src='images/win2008.png'/>";
				}
				else
				{
					$icons=$icons."<img width='15' height='15' src='images/win2008.png'/>";
				}
			}
			else
			{
				$icons=$icons."&nbsp;";
			}
			$icons=$icons."</td>";

			echo "<tr>$icons<td style='' nowrap='nowrap'>".$svr_name."</td><td>".$node->address."</td><td nowrap='nowrap'>";
			if ( time() > intval($node->last_ping) )
			{
				echo time_elapsed(time()-intval($node->last_ping))." ";
				echo getTranslation("ago",$settings);
			}
			elseif ( time() < intval($jnv['last_ping']) )
			{
				echo "+".time_elapsed(intval($node->last_ping)-time())." ";
				echo getTranslation("from now",$settings);
			}
			else
			{
				echo "0s ";
				echo getTranslation("ago",$settings);
			}
			echo "</td></tr>";
		}
	echo "</table><br/>";
}
else
{
	echo "<ul>";
	echo "No job nodes found.\n";
}

echo "<br/><br/>Want to add a job server?<br/>";
echo "<a href='?q=$qn&v=map'>Click here</a> to generate a his-config.php file for your server.<br/>";


echo "</ul>";
echo "<br/>";

}
} // end if (view - node list)



if ( isset($_GET['v']) )
{
if ( $_GET['v']=="node-passwords" )
{

echo "When Executing on Job Server, Provide this Password to Remote Job Node, if it asks:";
echo "<br/>";
echo "<br/>";
echo "<b>Current Remote Job Node Passwords:</b>";

echo "<ul>";
$pws=$q->obj_hf_passwords;
if ( is_array($pws) )
{
	if ( count($pws)>0 )
	{
		foreach ($pws as $pw)
		{
			echo "<form action='?q=$qn&v=node-passwords&action=delete-remote-job-node-password' method='post' style='display:inline;'>";
			echo "<span style='background-color:".rcolor()."'>".$pw->obj_pass->body."</span>";
			echo "<input type='hidden' name='pid' value='".$pw->id."' />";
			echo "<input type='hidden' name='id_hf' value='".$pw->id_hf."' />";
			echo "<input type='submit' value='";
	echo getTranslation("Delete",$settings);
	echo "'/>\n";
			echo "</form>";
		}
	}
	else
	{
		echo "No passwords defined yet.\n";
	}
}
else
{
	echo "No passwords defined yet.\n";
}
echo "</ul>";
echo "<b>Add Remote Job Node Password:</b>";
echo "<ul>";
echo "<form action='?q=$qn&v=node-passwords&action=add-remote-job-node-password' method='post'>";
echo "IF a Remote Job Node asks for a password, use this password:\n";
echo "\t<input type='text' name='node_password' style='width:500px;'/>\n";
echo "\t<input type='hidden' name='qid' value='$qn'/>\n";
echo "<input type='submit'/>";
echo "</form>";
echo "</ul>";

}
} // end if (view - node passwords)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="input-resource" )
{


$translated_text=getTranslation("input resource 1",$settings);
$translated_text=str_replace("q=qn","q=$qn",$translated_text);
echo $translated_text;
echo "<br/>";
echo "<br/>";
$u->build();
//echo "<pre>";
//$q->build();
//print_r($q);

echo "<ul style='padding-left:30px;'>";
echo "<h3>";
echo getTranslation("List of Current Input Resources/Files",$settings);
echo ":";
echo "</h3>";
echo "</ul>";

echo "<table><tr><td style='padding-left:70px;'>";
foreach ($q->obj_hf_resources as $hf_resource)
{
	if ( isset($hf_resource->obj_overpowered) && $hf_resource->obj_overpowered)
	{
		continue;
	}

	if ( isset($hf_resource->obj_inherited) || (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering) )
	{
	}
	else
	{
		echo "<span style='float:left;background-color:".rcolor()."'>";
		echo "<a href='#".$hf_resource->obj_filename->body."' style='text-decoration:none;color:black;'>";
		echo htmlspecialchars($hf_resource->obj_filename->body);
		echo "</a>";
		echo "</span>";
	}
}
echo "</td></tr></table>";

foreach ($q->obj_hf_resources as $hf_resource)
{

	// search for any other resources with the same id as this resource, but with a parent equal to THIS function
	// in that case, do not show the parent function's resource

	$readonly_flag="";
	$disabled_flag="";
	$highlight_flag="";
	if ( isset($hf_resource->obj_overpowered) && $hf_resource->obj_overpowered)
	{
		continue;
	}
	if ( isset($hf_resource->obj_inherited) || (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering) )
	{
		if ( (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering) || isset($hf_resource->obj_inherited) && $hf_resource->obj_inherited)
		{
			$readonly_flag=" readonly='readonly'";
			$disabled_flag=" disabled";
			if (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering)
			{
				$readonly_flag="";
				$highlight_flag="background-color:green;";
			}
		}
	}
	else
	{
		echo "<a name='".$hf_resource->obj_filename->body."'>";
	}

	echo "<ul";
	if ( strlen($readonly_flag)>0 )
	{
		echo " style='background-color:#ddd;width:700px;'";
	}
	else if (strlen($highlight_flag)>0)
	{
		echo " style='background-color:#ddd;width:700px;'";
	}
	else
	{
		echo " style='width:700px;'";
	}
	echo ">";
	echo "<form action='?q=$qn&v=input-resource&action=update-hf-resource' method='post'>";
	echo "<h3>";
	echo getTranslation("Input",$settings);
	if ( strlen($readonly_flag)>0 || strlen($highlight_flag)>0 )
	{
		echo " (";
		echo getTranslation("Inherited from Parent",$settings);
		echo " ";
		echo "<a href='?q=".$hf_resource->obj_inherited_from_id."&v=overview'>";
		echo $hf_resource->obj_inherited_from_name;
		echo "</a>";
		echo ")";
	}

	if ( isset($hf_resource->obj_overridden) )
	{
		if ($hf_resource->obj_overridden)
		{
			echo " (";
			echo getTranslation("Overridden",$settings);
			echo ")";
		}
	}
	if ( isset($hf_resource->obj_overpowering) )
	{
		if ($hf_resource->obj_overpowering)
		{
			echo " (";
			echo getTranslation("Edited Copy",$settings);
			echo ")";
		}
	}

	echo "</h3>";

	echo "<ul>";
	echo "<input type='text' name='str_filename' value='".str_replace("'","\'",$hf_resource->obj_filename->body)."' style='background-color:".rcolor().";$highlight_flag;'/>";
	echo "<textarea$readonly_flag name='str_location' style='width:600;background-color:".rcolor()."'>";
	echo $hf_resource->obj_location->body;
	echo "</textarea>";
	if ($hf_resource->obj_location->body != $hf_resource->value_location)
	{
		echo getTranslation("After POST Parameter replacement",$settings);
		echo ": ";
		echo "<ul>";
		echo "<textarea readonly='readonly' style='background-color:".rcolor().";width:600;'>";
		echo $hf_resource->value_location;
		echo "</textarea>";
		echo "</ul>";
	
	}

	$checked_any="";
	foreach ($hf_resource->obj_system_kinds as $hfrsk)
	{
		if ($hfrsk->id_sk=="any")
		{
			$checked_any=" checked='checked'";
		}
	}
	if ( count($hf_resource->obj_system_kinds) == 0 )
	{
		$checked_any=" checked='checked'";
	}
	echo "<input type='checkbox' name='system_kind[]' value='any'$checked_any/> Any&nbsp;&nbsp;";
	foreach ($u->obj_system_kinds as $usk)
	{
		$checked_yes="";
		foreach ($hf_resource->obj_system_kinds as $hfrsk)
		{
			if ($usk->id==$hfrsk->id_sk)
			{
				$checked_yes=" checked='checked'";
			}
		}
		echo "<input$disabled_flag type='checkbox'$checked_yes name='system_kind[]' value='".$usk->id."'/> ".$usk->name."&nbsp;&nbsp;";
	}

	
	echo "<br/>";
	echo "<input type='hidden' name='id' value='".$hf_resource->id."'/>";


	echo "<input type='submit' style='background-color:".rcolor().";display:inline;' name='btnUpdate' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";

	if ( isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering)
	{
		$disabled_flag="";
	}

	echo "<input$disabled_flag type='submit' style='background-color:".rcolor().";display:inline;' name='btnDelete' value='";
	echo getTranslation("Delete",$settings);
	echo "'/>";

	echo "</ul>";
	echo "</form>";

	echo "</ul>";


	if ( isset($hf_resource->obj_inherited) || (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering) )
	{
	}
	else
	{
		echo "</a>";
	}
} // END FOREACH (ALL RESOURCES IN FUNCTION)

echo "<h3>";
echo getTranslation("Add Input",$settings);
echo "</h3>";


echo "<ul>";
echo "<form method='post' action='?q=$qn&v=input-resource&action=add-hf-resource'>";
echo getTranslation("Save to File",$settings);
echo ": ";
echo "<br/>";
echo "<input type='text' name='str_filename' value='' style='background-color:".rcolor()."'/>";
echo "<br/>";

echo getTranslation("Text",$settings);
echo ": ";
echo "<textarea name='str_location' style='width:600px;background-color:".rcolor()."'>";
echo "</textarea>";
echo "<input type='submit' style='background-color:".rcolor()."' name='btnSubmit' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</form>";
echo "</ul>";

/*
echo "<b>";
echo getTranslation("Update Input Resource Type",$settings);
echo ":</b>";
echo "<ul>";
echo getTranslation("Modify",$settings);
echo ": ";
echo "<form action='?q=$qn&v=input-resource&action=update-input-resource-type' method='post' style='display:inline;'>";
echo "<input type='hidden' name='id_hf_resource' value='".$q->id_hf_resource."'/>";
echo "<select style='background-color:".rcolor()."' name='new_hf_resource_type'>";
echo "<option value=''></option>";
foreach ($STATIC['hf_resource_types'] as $hf_resource_types_key=>$hf_resource_types_value)
{
	$seltxt="";
	if ($q->obj_hf_resources->id_type==$hf_resource_types_key)
	{
		$seltxt=" selected";
	}
	echo "<option value='".$hf_resource_types_key."'".$seltxt.">".$hf_resource_types_value."</option>";
}
echo "</select><input type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "'/></form></ul>";

echo "<b>";
echo getTranslation("Input Resource",$settings);
echo ":</b>";
echo "<br/>";

	echo "<ul>";

	$hf_resource_example=$STATIC['hf_resource_examples'][$q->obj_hf_resources->id_type];
	$row_count=count(explode("\n",$hf_resource_example));
	echo $STATIC['hf_resource_types'][$q->obj_hf_resources->id_type];
	echo " ";
	echo getTranslation("Input Resource example value",$settings);
	echo ":";
	echo "<br/>";
	echo "<ul>";
	echo "<a href='javascript:void(0);' onclick='getElementById(\"example\").style.display=\"block\";'><h3>";
	echo getTranslation("Click here to view Sample",$settings);
	echo "</h3></a>";
	echo "<textarea id='example' style='width:400px;background-color:#ddd;display:none;' rows='$row_count' wrap='off' readonly='readonly'>";
	echo $hf_resource_example;
	echo "</textarea>";
	echo "</ul>";
	echo "<br/>";
*/
/*
	if (count($q->obj_hf_parameters)>0)
	{
		foreach ($q->obj_hf_parameters as $hf_parameter)
		{
			if ( is_secret($hf_parameter->keyword) )
			{
				$hf_resource_link_link=str_replace($hf_parameter->value,str_repeat("*",10),$hf_resource_link_link);
			}
		}// end foreach (function parameters)
	} // end if (count function parameters)
*/
	//$hf_resource_link_text=str_replace("<","&lt;",$hf_resource_link_link);

	/*
	$helium_str="";
	if ($q->obj_hf_resources->id_type=='remote-helium')
	{
		$helium_str=" disabled='disabled'";
	}
	echo getTranslation("Modify Current Input Resource",$settings);
	echo ":";
	echo "<br/>";
	echo "<ul>";
	$font_size=16;
	if (strlen($q->obj_hf_resources->obj_location->body)>120)
	{
		$font_size=9;
	}
	if (strlen($q->obj_hf_resources->obj_location->body)>400)
	{
		$font_size=7;
	}
	echo "<form style='display:inline;' action='?q=$qn&v=input-resource&action=update-input-resource' method='post'>";
	echo "<input type='hidden' name='rid' value='".$q->id_hf_resource."'/>";
	$row_count=count(explode("\n",$hf_resource_location_provided));
	echo "<textarea cols='100' rows='$row_count' style='font-family:Courier New;background-color:".rcolor().";font-size:$font_size' name='str'$helium_str>";
	echo str_replace("<","&lt;",$q->obj_hf_resources->obj_location->body);
	echo "</textarea>";

	if ( $q->obj_hf_resources->obj_location->value != $q->obj_hf_resources->obj_location->body )
	{
		echo "<b>After Function Parameter Value Replacement:</b>";
		echo "<ul>";
		$row_count=count(explode("\n",$hf_resource_link_text));
		$font_size=14;
		if (strlen($q->obj_hf_resources->obj_location->value)>120)
		{
			$font_size=9;
		}
		echo "<span style=''><a href='$hf_resource_link_link' target='_new'><textarea wrap='off' rows='$row_count' style='width:400px;font-size:$font_size;background-color:".rcolor().";font-size:$font_size;font-family:Courier New;'>";
		echo str_replace("<","&lt;",$q->obj_hf_resources->obj_location->value);
		echo "</textarea></a></span>";
		echo "</ul>";
	} // end if (function parameters exist)
*/
/*

	echo "<br/>";
	echo "<input type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "'";
	//echo $helium_str;
	echo "/>";
	echo "</form>";
	echo "</ul>";
	echo "</ul>";
*/
	/*
	if ($q->obj_hf_resources->id_type=='remote-helium')
	{
		// todo: do for Rackspace too
		if ( $APP['fs']->is_aws() )
		{
			echo "<br/>";
			echo "<ul>";
			echo "<b>Upload new Helium HSP File:</b><br/><br/>";
			echo "<ul>";
			$s3redirect=$GLOBALS['settings']['s3']['redirect']['@attributes']['value'];
			$s3bucket=$GLOBALS['settings']['s3']['bucket']['@attributes']['value'];
			$s3keystart=$GLOBALS['settings']['s3']['paths']['job-input']['@attributes']['value'];
			$s3acl=$GLOBALS['settings']['s3']['upload']['default-acl']['@attributes']['value'];
			$aws_secret_access_key=$GLOBALS['settings']['secret-key']['@attributes']['value'];
			$aws_access_key=$GLOBALS['settings']['access-key']['@attributes']['value'];
			$s3timestamp = $GLOBALS['settings']['s3']['file-expiration']['@attributes']['value'];
			$s3filename=$s3keystart."/".sha1(time().$qn).".hsp";

			$s3redirect=str_replace("{this}",$this_server_url,$s3redirect);
			$s3redirect=str_replace("\$qn",$qn,$s3redirect);

			$policy_doc = "{'expiration': '$s3timestamp','conditions': [ {'bucket': '$s3bucket'},['starts-with', '\$key', '$s3filename'],{'acl': '$s3acl'},{'success_action_redirect': '$s3redirect&action=uhf'},['starts-with', '\$Content-Type', ''],['content-length-range', 0, 104857600000]]}";
			$policy_doc_encoded=base64_encode($policy_doc);

			$signature = hex2b64(hmacsha1($aws_secret_access_key, $policy_doc_encoded));

			echo "<form style='display:inline;' action='https://$s3bucket.s3.amazonaws.com/' method='post' enctype='multipart/form-data'>";
			echo "<input type='hidden' name='key' value='$s3filename'>";
			echo "<input type='hidden' name='AWSAccessKeyId' value='$aws_access_key'>";
			echo "<input type='hidden' name='acl' value='$s3acl'>";
			echo "<input type='hidden' name='success_action_redirect' value='$s3redirect&action=uhf'>";
			echo "<input type='hidden' name='policy' value='$policy_doc_encoded'>";
			echo "<input type='hidden' name='signature' value='$signature'>";
			echo "<input type='hidden' name='Content-Type' value='application/octet-stream'>";
			echo "<input name='file' type='file'><input type='submit' value='Submit'>";
			echo "</form>";
			echo "<br/>";
			echo "<br/>";
			echo "It is important for your .HSP file's Custom Export to Save its output to:<ul><b style='background-color:".rcolor()."'>c:\\temp\\helium.csv</b></ul>HIS will look for that output file coming out of your Helium Scraper HSP script.";
			echo "<br/>";

			echo "</ul>";
			echo "</ul>";
		} // end if (is aws)

	} // END IF (HELIUM IRESOURCE UPLOAD)
*/

echo "<br/>";
echo "<br/>";
echo "<b>";
echo getTranslation("Files to be downloaded to the remote job folder",$settings);
echo ":</b>";
echo "<br/>";
echo "<br/>";
echo getTranslation("upload files message",$settings);
echo "<br/>";

}
} // end if (input resource)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="input-resource" )
{

$fstr="Additional Temporary ";
/*if ($q->obj_hf_resources->id_type=='direct-get' || $q->obj_hf_resources->id_type=='remote-wget' || $q->obj_hf_resources->id_type=='remote-imacros' )
{
	$fstr="Overriding Temporary ";
}*/
//echo "<b>File Upload as $fstr"."Resource:</b>";
echo "<ul>";

echo getTranslation("Currently Uploaded Files",$settings);
echo ":<br/>";
echo "<ul>";
echo "<br/>";
if ( count($q->obj_hf_files)>0 )
{
	echo "<table>";
	echo "<tr>";
	echo "<td width='100'>";
	echo "<b>";
	echo "File Size";
	echo "</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>";
	echo "Assigned File Name";
	echo "</b>";
	echo "</td>";
	echo "<td>";
	echo "<b>";
	echo "Uploaded Source File Name";
	echo "</b>";
	echo "</td>";
	echo "</tr>";
}
else
{
	echo getTranslation("No files have been uploaded yet.",$settings);
	echo "<br/>";
	echo "<br/>";
}

foreach ($q->obj_hf_files as $hf_file)
{
	echo "<form action='?q=$qn&v=input-resource&action=update-uploaded-file' method='post' style='display:inline;'>";
	echo "<tr>";
	echo "<td nowrap='nowrap' valign='top'>";

	$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
	$keyname=$APP['fs']->url_to_key($bucket_name,$hf_file->obj_file->val);
	$obj_size = $APP['fs']->get_object_filesize ( $bucket_name, $keyname );

	echo $obj_size;
	echo "</td>";
	echo "<td valign='top'>";
	echo "<input type='hidden' name='id_hf' value='".$hf_file->id_hf."'/>";
	echo "<input type='hidden' name='id' value='".$hf_file->id."'/>";
	echo "<input type='text' name='str_targetfile' style='background-color:".rcolor()."' value='".str_replace("<","&lt;",$hf_file->obj_targetfile->body)."'/>";
	echo "<td valign='top'>";
	echo "<textarea readonly='readonly' style='background-color:#ddd;width:400;'>".str_replace("<","&lt;",$hf_file->obj_file->val)."</textarea>";
	echo "</td>";
	echo "</tr>";

	if ($hf_file->value!=$hf_file->obj_targetfile->body)
	{
		echo "<tr>";
		echo "<td>";
		echo "</td>";
		echo "<td colspan='3'>";
		echo "After Function Parameter Value Replacement:";
		echo "<span style='background-color:".rcolor()."'>";
		echo str_replace("<","&lt;",$hf_file->value);
		echo "</span>";
		echo "</td>";
		echo "</tr>";
	}

	echo "<tr>";
	echo "<td valign='top' colspan='2'>";

	echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";
	echo "<input type='submit' name='btnDelete' style='background-color:".rcolor().";display:inline;' value='";
	echo getTranslation("Delete",$settings);
	echo "'/>";

	echo "</td>";
	echo "</tr>";
	echo "</form>";


} // end foreach (file)

if ( count($q->obj_hf_files)>0 )
{
	echo "</table>";
}
echo "<br/>";
echo "</ul>";

$get_domain=explode("/",$this_server_url);
$get_domain_url=$get_domain[0]."/".$get_domain[1]."/".$get_domain[2];
// todo do for rackspace too
if ( get_class($APP['fs']) == "Storage_Localdisk" )
{
	echo getTranslation("File Upload",$settings);
	echo ":";
	echo "<br/>";
	echo "<br/>";
	echo "<ul>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{

		$local_redirect=$get_domain_url.$_SERVER['REQUEST_URI']."&action=upload-file";
		$bucket_kind=$APP['fs']->kind;
		$bucket_name=$APP['fs']->bucket;
		$local_keystart=$GLOBALS['settings'][$bucket_kind]['paths']['job-input']['@attributes']['value'];
		$new_filename=$local_keystart."/".sha1(time().$qn).".\${filename}";//what extension to use?
		echo "<form style='display:inline;' action='localdisk.upload.php' method='post' enctype='multipart/form-data'>";
		echo "<input type='hidden' name='bucket' value='$bucket_name'>";
		echo "<input type='hidden' name='key' value='$new_filename'>";
		echo "<input type='hidden' name='success_action_redirect' value='$local_redirect'>";
		echo "<input type='hidden' name='Content-Type' value='application/octet-stream'>";
		echo "<input name='file' value='Browse...' type='file' style='background-color:".rcolor().";display:inline;'><input type='submit' value='";
		echo getTranslation("Start File Upload",$settings);
		echo "' style='background-color:".rcolor().";display:inline;'>";
		echo "</form>";
	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}
	echo "</ul>";
	

}
else if ( get_class($APP['fs']) == "Storage_AWS" )
{
	echo getTranslation("File Upload",$settings);
	echo ":";
	echo "<br/>";
	echo "<br/>";
	echo "<ul>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{

		$s3redirect=$get_domain_url.$_SERVER['REQUEST_URI']."&action=upload-file";
		$s3bucket=$GLOBALS['settings']['s3']['bucket']['@attributes']['value'];
		$s3keystart=$GLOBALS['settings']['s3']['paths']['job-input']['@attributes']['value'];
		$s3acl=$GLOBALS['settings']['s3']['upload']['default-acl']['@attributes']['value'];
		$aws_secret_access_key=$GLOBALS['settings']['s3']['secret-key']['@attributes']['value'];
		$aws_access_key=$GLOBALS['settings']['s3']['access-key']['@attributes']['value'];
		$s3timestamp = $GLOBALS['settings']['s3']['file-expiration']['@attributes']['value'];
		$s3filename=$s3keystart."/".sha1(time().$qn).".\${filename}";//what extension to use?
	
		//$s3redirect=str_replace("{uri}",$this_server_url,$s3redirect);
		//$s3redirect=str_replace("{qid}",$qn,$s3redirect);
	
		$policy_doc = "{'expiration': '$s3timestamp','conditions': [ {'bucket': '$s3bucket'},['starts-with', '\$key', '$s3keystart'],{'acl': '$s3acl'},{'success_action_redirect': '$s3redirect'},['starts-with', '\$Content-Type', ''],['content-length-range', 0, 104857600000]]}";
		$policy_doc_encoded=base64_encode($policy_doc);
	
		//echo $policy_doc."<br/>";
		//$signature = urlencode(base64_encode(hash_hmac("sha1",utf8_encode($policy_doc_encoded),$aws_secret_access_key,true)));
		//$signature = (base64_encode(hash_hmac("sha1",($policy_doc_encoded),$aws_secret_access_key)));
		//$signature = base64_encode(hash_hmac('sha256', $policy_doc, $aws_secret_access_key, true));
		$signature = hex2b64(hmacsha1($aws_secret_access_key, $policy_doc_encoded));
		//echo $signature."<br/>";
	
		echo "<form style='display:inline;' action='https://$s3bucket.s3.amazonaws.com/' method='post' enctype='multipart/form-data'>";
		echo "<input type='hidden' name='key' value='$s3filename'>";
		echo "<input type='hidden' name='AWSAccessKeyId' value='$aws_access_key'>";
		echo "<input type='hidden' name='acl' value='$s3acl'>";
		echo "<input type='hidden' name='success_action_redirect' value='$s3redirect'>";
		echo "<input type='hidden' name='policy' value='$policy_doc_encoded'>";
		echo "<input type='hidden' name='signature' value='$signature'>";
		echo "<input type='hidden' name='Content-Type' value='application/octet-stream'>";
		echo "<input name='file' value='Browse...' type='file' style='background-color:".rcolor().";display:inline;'><input type='submit' value='";
		echo getTranslation("Start File Upload",$settings);
		echo "' style='background-color:".rcolor().";display:inline;'>";
		echo "</form>";

	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}

	echo "</ul>";
} // end if (aws direct upload form)
else
{
	echo getTranslation("File Upload",$settings);
	echo ":";
	echo "<br/>";
	echo "<br/>";
	echo "<ul>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		echo getTranslation("Current file storage selection",$settings);
		echo " \"".$APP['fs']->kind."\" ";
		echo getTranslation("does not allow direct file upload.",$settings);
		echo "<br/>";
		echo getTranslation("Direct file upload for storage selection",$settings);
		echo " \"".$APP['fs']->kind."\" ";
		echo getTranslation("is currently under development.",$settings);
		echo "<br/>";
		echo "<br/>";
		echo getTranslation("Contact support.",$settings);
	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}

	echo "</ul>";
}
echo "</ul>";

}
} // end if (view - filtering expression)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="gather" )
{
	$q->build();
	$translated_text=getTranslation("gather 1",$settings);
	$translated_text=str_replace("q=qn","q=$qn",$translated_text);
	echo $translated_text;
	echo "<br/>";
	echo "<br/>";

	echo "<b>";
	echo getTranslation("Resource Actions",$settings);
	echo ":</b>";
	echo "<ul>";
	$regather_button_text_extra="";
	if ( True )
	{
		// does a remote job already exist?
		// use last job as content source
		if ( isset($q->obj_cache_latest->body) && $q->obj_cache_latest->body!='undefined')
		{
			// is job still running? wait
			echo "<b>";
			echo getTranslation("This remote job has been run before. Using latest contents.",$settings);
			echo "</b>";

			$JU_PATH=$this_server_url."/ju.php";
			//$cid=$q->obj_hf_resources->str_cache_latest;
			$true_hf_resource_safe="Safe Link to view output content of job";//$JU_PATH."?cid=$cid&get&safe";
			echo "<br/>";
			echo "<br/>";
			echo "<b>";
			echo getTranslation("True Resource (safe)",$settings);
			echo ":</b>";
			echo "<br/>";
			echo "<a style='' href='$true_hf_resource_safe' target='_new'>";
			echo getTranslation($true_hf_resource_safe,$settings);
			echo "</a>\n";
			echo "<br/>";
		}
		else
		{
			echo "<b>This remote job has NOT been run before.</b>";
		}
		// Remote job needs
		echo "<br/>";
		echo getTranslation("To have the latest live content, a remote job needs to be submitted. Jobs usually finish within a minute or so.",$settings);
		echo "<br/>";
		echo "<br/>";
		$regather_button_text_extra="by submitting a live, remote, content-gathering job";
	}
	echo "<form style='display:inline;' action='?q=$qn&v=gather&action=regather-latest-cache' method='post'><input style='height:40px;background-color:".rcolor().";font-size:16px;' name='refresh_cache' type='submit' value='";
	echo getTranslation("Re-gather Latest Cache",$settings);
	echo " ";
	echo getTranslation($regather_button_text_extra,$settings);
	echo "'/></form>";
	echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&remote' method='post'><input type='submit' style='background-color:".rcolor().";font-size:16px;' value='";
	echo getTranslation("Force live remote content gather (no cache storage)",$settings);
	echo "'/></form><br/><br/>";


echo "</ul>";

echo "<h4>";
echo getTranslation("Live Remote Content Gather (no cache storage) - Manual Value Testing Submission",$settings);
echo "</h4>";
echo "<table><tr><td style='padding-left:50px;'>";
echo "<form action='?' method='get'>";
echo "<table>";
echo "<input type='hidden' name='q' value='$qn'/>";
echo "<input type='hidden' name='v' value='filtering-expression'/>";
echo "<input type='hidden' name='remote' value=''/>";
foreach ($q->obj_hf_parameters as $hfparam)
{
	if (!isset($hfparam->obj_overridden) || ( isset($hfparam->obj_overridden) && !$hfparam->obj_overridden) )
	{
		echo "<tr>";
		echo "<td>";
		echo $hfparam->parameter_name."=";
		echo "</td>";
		echo "<td>";
		if ( is_secret($hfparam->parameter_name) )
		{
			echo "<input name='".$hfparam->parameter_name."' id='".$hfparam->parameter_name."' style='background-color:".rcolor().";font-size:13px;width:300px;' type='password' value='".str_replace("<","&lt;",$hfparam->obj_default_value->body)."'/>";
		}
		else
		{
			echo "<textarea name='".$hfparam->parameter_name."' id='".$hfparam->parameter_name."' rows='1' cols='30' style='background-color:".rcolor().";width:300px;font-size:13px;'>".str_replace("<","&lt;",urldecode($hfparam->obj_default_value->body))."</textarea>";
		}
		echo "</td>";
		echo "</tr>";
	}
}
echo "<tr><td align='right' colspan='2'>";
echo "<input type='submit' style='background-color:".rcolor()."' value='";
echo getTranslation("Submit",$settings);
echo "'/>";
echo "</td></tr>";
echo "</table>";
echo "</form>";

echo "</td></tr></table>";

echo "<h4>";
echo getTranslation("Resource Content Approval",$settings);
echo "</h4>";
echo "<table><tr><td style='padding-left:50px;'>";

if ($q->str_cache_latest!="undefined")
{
	$add_msg="";
	if ( $q->str_cache_approved!='undefined')
	{
		echo "<b>";
		echo getTranslation("This function already has pre-existing, approved resource content that has been marked as usable.",$settings);
		echo "</b><br/><br/>";
		$add_msg="re";
	}
	echo "<form action='?q=$qn&v=gather&action=cache-approve' method='post'>";
	echo "<input type='submit' style='height:50px;background-color:".rcolor().";font-size:14px;' value='";
	echo getTranslation($add_msg."approved button",$settings);
	echo "'/>";
	echo "</form>";
	echo "<a href='?q=$qn&v=filtering-expression&use_approved=yes'>";
	echo getTranslation("If your filtering expression becomes suddenly broken, click here to use PREVIOUSLY APPROVED content.",$settings);
	echo "</a>";
	echo "<br/>";
	echo "<br/>";
	echo getTranslation("previously approved",$settings);

}
else
{
	echo "No content gathered yet.  Gather remote content before approval confirmation.";
	echo "<br/>";
	echo "<br/>";
}
echo "</td></tr></table>";

}
} // end if (view - input resource)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="hf-parameters" )
{

echo getTranslation("function parameters 1",$settings);
echo "<br/>";
echo "<br/>";
echo "<ul>";
echo "<font size='-1'>";
echo "$this_server_url?q=".substr($qn,0,min(strlen($qn),5))."&cxml&remote&arg1=value1&arg2=value2";
echo "</font>";
echo "</ul>";
echo "<br/>";
echo getTranslation("function parameters 2",$settings);

echo "<ul style='padding-left:30px;'>";
echo "<h3>";
echo getTranslation("List of Current Parameters",$settings);
echo ":";
echo "</h3>";
echo "</ul>";

echo "<table><tr><td style='padding-left:70px;'>";
foreach ($q->obj_hf_parameters as $hf_parameter)
{
	if ( isset($hf_parameter->obj_overpowered) && $hf_parameter->obj_overpowered)
	{
                continue;
	}

	if ( isset($hf_parameter->obj_inherited) || (isset($hf_parameter->obj_overpowering) && $hf_parameter->obj_overpowering) )
	{
	}
	else
	{
		echo "<span style='float:left;background-color:".rcolor()."'>";
		echo "<a href='#".htmlspecialchars($hf_parameter->parameter_name)."' style='text-decoration:none;color:black;'>";
		echo htmlspecialchars($hf_parameter->parameter_name);
		echo "</a>";
		echo "</span>";
	}
}
echo "</td></tr></table>";


// hf variables/parameters
echo "<h4>";
echo getTranslation("Function Parameters",$settings);
echo "</h4>";
echo "<ul>";

if ( count($q->obj_hf_parameters)>0 )
{
	foreach ($q->obj_hf_parameters as $hf_parameter)
	{
		$qkeywd=htmlspecialchars($hf_parameter->keyword,ENT_QUOTES);
		$hfparam=htmlspecialchars($hf_parameter->parameter_name,ENT_QUOTES);
		$hfpreserve=$hf_parameter->int_preserve_encode;
		if ( intval($hfpreserve)==1 )
		{
			$hfpreserve="true";
		}
		else
		{
			$hfpreserve="false";
		}

		$printed_defvalue=$hf_parameter->obj_default_value->body;

		$printed_curvalue=$hf_parameter->value;

		if ( is_secret($hf_parameter->keyword) )
		{
			$printed_def=str_repeat("*",8);//$printed_defvalue;
			$printed_cur=str_repeat("*",8);//$printed_curvalue;
		}
		else
		{
			$printed_def=$printed_defvalue;
			$printed_cur=$printed_curvalue;
		}
		$qdefval=$printed_def;
		$qdefval=htmlspecialchars($qdefval,ENT_QUOTES);

		$readonly_flag="";
		$disabled_flag="";
		if ( isset($hf_parameter->obj_inherited) )
		{
			if ($hf_parameter->obj_inherited)
			{
				$readonly_flag=" readonly='readonly'";
				$disabled_flag=" disabled";
			}
		}



		echo "<form action='?q=$qn&v=hf-parameters&action=update-hf-parameter' method='post'";

		if ( strlen($readonly_flag)>0 )
		{
			echo " style='background-color:#ddd;width:700px;'";
		}
		
		echo ">";

		echo "<b>";
		echo "<a name='".htmlspecialchars($hf_parameter->parameter_name)."'>";
		echo getTranslation("POST Parameter",$settings);
		echo "</a>";
		if ( isset($hf_parameter->obj_inherited) )
		{
			if ($hf_parameter->obj_inherited)
			{
				echo " (";
				echo getTranslation("Inherited from Parent",$settings);
				echo " ";
				echo "<a href='?q=".$hf_parameter->obj_inherited_from_id."&v=overview'>";
				echo $hf_parameter->obj_inherited_from_name;
				echo "</a>";
				echo ")";
			}
		}
		if ( isset($hf_parameter->obj_overridden) )
		{
			if ($hf_parameter->obj_overridden)
			{
				echo " (";
				echo getTranslation("Overridden",$settings);
				echo ")";
			}
		}
		echo "</b>";

		echo "<input$readonly_flag type='text' name='parameter_name' value='".htmlspecialchars($hf_parameter->parameter_name)."' style='background-color:".rcolor().";width:400;'/>";
		
		echo "<ul>";
		
		echo getTranslation("Keyword",$settings);
		echo "<textarea$readonly_flag type='text' name='keyword' rows='1' style='background-color:".rcolor().";width:400;'/>".str_replace("<","&lt;",$hf_parameter->keyword)."</textarea>";


		echo getTranslation("Default Value",$settings);
		if (intval($hf_parameter->int_preserve_encode)==0)
		{
			echo "<br/>";
			echo "(<a href='url.php' target='_new'>urlencode()</a>'d, ".getTranslation("please",$settings).")";
		}
		if ($printed_def!=urldecode($printed_def))
		{
			echo " ";
			echo getTranslation("Value Given",$settings);
			echo ": ";
		}
		if ( is_secret($hf_parameter->keyword) )
		{
			echo "<input type='password' $readonly_flag name='str_default_value' style='background-color:".rcolor().";width:400;' rows='1' value='".htmlspecialchars($hf_parameter->value,ENT_QUOTES)."'/>";
		}
		else
		{
			echo "<textarea$readonly_flag type='text' name='str_default_value' style='background-color:".rcolor().";width:400;' rows='1'>".str_replace("<","&lt;",$printed_def)."</textarea>";
		}
		if ($printed_def!=urldecode($printed_def))
		{
			$not_decode="";
			if (intval($hf_parameter->int_preserve_encode)==1)
			{
				$not_decode=getTranslation("NOT",$settings)." ";
			}
			echo "<ul>";
			echo "<font color='red'>".$not_decode;
			echo getTranslation("Decoded To",$settings);
			echo ": ".htmlspecialchars(urldecode($printed_def))."</font>&nbsp;";
			echo "</ul>";
		}
		echo "<br/>";
		echo getTranslation("Current Value",$settings);
		echo "<br/>";
		echo "<ul style='background-color:".rcolor().";width:500px;'>";

		echo htmlspecialchars($printed_cur);
		echo "</ul>";

		$cstr="";
		if (intval($hf_parameter->int_preserve_encode)>0)
		{
			$cstr=" checked='checked'";
		}
		echo getTranslation("Preserve UrlEncode",$settings);
		echo "<span style='background-color:".rcolor()."display:inline;'><input$cstr type='checkbox' name='int_preserve_encode' value='int_preserve_encode'/>&nbsp;</span>";
		echo "<br/>";
		echo "<br/>";

		$cstr="";
		if (intval($hf_parameter->int_immutable)>0)
		{
			$cstr=" checked='checked'";
		}

		echo getTranslation("Immutable/Unchangeable",$settings);
		echo "<span style='background-color:".rcolor()."display:inline;'><input$cstr type='checkbox' name='int_immutable' value='int_immutable'/>&nbsp;</span>";
		echo "<br/>";
		echo "<br/>";

		$cstr="";
		if (intval($hf_parameter->int_mandatory)>0)
		{
			$cstr=" checked='checked'";
		}
		echo getTranslation("Mandatory/Required",$settings);
		echo "<span style='background-color:".rcolor()."display:inline;'><input$cstr type='checkbox' name='int_mandatory' value='int_mandatory'/>&nbsp;</span>";
		echo "<br/>";
		echo "<br/>";

		echo "<input type='hidden' name='id_hf' value='".$hf_parameter->id_hf."'/>";

		echo "<input type='hidden' name='id' value='".$hf_parameter->id."'/>";

		echo "<input name='btnSave' style='background-color:".rcolor().";display:inline;' type='submit' value='";
		echo getTranslation("Save",$settings);
		echo "'/>";
		echo "<input name='btnDelete' style='background-color:".rcolor().";display:inline;' type='submit' value='";
		echo getTranslation("Delete",$settings);
		echo "'/>";

		echo "</form>";
		
		echo "<ul>";

			echo "<h4>";
			echo getTranslation("Function Parameter Value Constraints",$settings);
			echo "</h4>";

			echo "<ul>";

			$ehfpvc=$hf_parameter->obj_hfp_vcs;
			if (is_array($ehfpvc))
			{
				foreach ($ehfpvc as $ahfpvc)
				{
					echo getTranslation("Constraint Type",$settings);
					foreach ($STATIC['hfpvc_types'] as $hfpvct_key=>$hfpvct_value)
					{
						if ( $hfpvct_key==$ahfpvc->id_constraint_type)
						{
							echo "<span style='background-color:".rcolor().";width:400;'>";
							echo getTranslation($hfpvct_value,$settings);
							echo "</span>";
							break;
						}
					}
					echo "<ul>";
					
					echo getTranslation("Expression",$settings);
			
					echo "<span style='background-color:".rcolor().";width:400;'>";
					echo $ahfpvc->obj_constraint_text->body;
					if ( strlen($ahfpvc->obj_constraint_text->body)==0)
					{
					}
					echo "&nbsp;";
					echo "</span>";

					echo "</ul>";
					
					echo "<form method='post' action='?q=$qn&v=hf-parameters&action=delete-hf-parameter-constraint'>";
					echo "<input type='hidden' name='id_hfp' value='".$hf_parameter->id."'/>";
					echo "<input type='hidden' name='id_constraint' value='".$ahfpvc->id."'/>";
					echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
					echo getTranslation("Delete",$settings);
					echo "'/>";
					echo "</form>";

					} // end foreach
			} // end if

			if ( count($ehfpvc)==0 )
			{
				echo getTranslation("There are no constraints on this function parameter.",$settings);
			}

			echo "</ul>";
			
			if ( strlen($readonly_flag)==0 )
			{
				echo "<h4>";
				echo getTranslation("Add Function Parameter Value Constraint",$settings);
				echo "</h4>";
				echo "<ul>";
				echo "<form action='?q=$qn&v=hf-parameters&action=add-hf-parameter-constraint' method='post'>";
				echo "<input type='hidden' name='id_hf_parameter' value='".$hf_parameter->id."'/>";

				echo getTranslation("Constraint Type",$settings);
				echo ": ";
				echo "<select name='id_constraint_type' style='background-color:".rcolor().";display:inline;'>";
				echo "<option value=''></option>";
				foreach ($STATIC['hfpvc_types'] as $hfpvct_key=>$hfpvct_value)
				{
					echo "<option value='".$hfpvct_key."'>".getTranslation($hfpvct_value,$settings)."</option>";
				}
				echo "</select><br/>";
				echo getTranslation("Characters/Expression",$settings);
				echo ": ";
				echo "<textarea rows='1' type='text' name='expression' style='background-color:".rcolor().";width:300;display:inline;'></textarea><br/>";
				echo "<input type='submit' style='background-color:".rcolor().";display:inline;' name='btnSubmit' value='";
				echo getTranslation("Add Constraint",$settings);
				echo "'/>";
				echo "</form>";
				echo "</ul>";
			}
		echo "</ul>";
		echo "</ul>";
		
		
		
		} // foreach
} // end if (count)
else
{
	echo getTranslation("No function parameters yet provided.",$settings);
}

echo "</ul>";

echo "<h3 style='display:inline;'>";
echo getTranslation("Add a New Parameter",$settings);
echo "</h3>\n";


echo "<ul>";
echo "<form action='?q=$qn&v=hf-parameters&action=add-hf-parameter' method='post'>";
echo "<input type='hidden' name='id_hf' value='$qn'/>";

echo getTranslation("Replace this [keyword]",$settings);
echo "<br/>";
echo "<textarea name='keyword' style='background-color:".rcolor().";width:500px;' rows='1'>[cityname]</textarea>";

echo getTranslation("With the value of this POST Parameter",$settings);
echo ":";
echo "<br/>";
echo "<input name='parameter_name' style='background-color:".rcolor().";width:500px;' type='text' value='cityname'/>";

echo getTranslation("Default Value",$settings);
echo ":<br/>";

echo "(<a href='url.php' target='_new'>urlencode()</a>'d, ".getTranslation("please",$settings).")";
echo "<textarea name='str_default_value' style='background-color:".rcolor().";width:500px;' rows='1'>Atlanta%2C+GA</textarea>";
echo "<ul>";
echo getTranslation("function parameter default value help",$settings);
echo "</ul>";
echo "<br/>";

echo getTranslation("Preserve POST params",$settings);
echo "<br/>";
echo "<span style='background-color:".rcolor().";width:500px;'><input name='int_preserve_encode' value='int_preserve_encode' type='checkbox'/></span>";

echo getTranslation("Parameter Value Immutable (cannot be changed by GET parameter value provided at time of submission)?",$settings);
echo "<br/>";
echo "<span style='background-color:".rcolor().";width:500px;'><input name='int_immutable' value='int_immutable' type='checkbox'/></span>";

echo getTranslation("Should providing a value for this parameter during job submission be mandatory (required)?",$settings);
echo "<br/>";
echo "<span style='background-color:".rcolor().";width:500px;'><input name='int_mandatory' value='int_mandatory' type='checkbox'/></span>";

echo "<div style='width:500px;'>";
echo getTranslation("keyword secret description",$settings);
echo "</div>";

echo "<input type='submit' style='background-color:".rcolor().";' value='";
echo getTranslation("Add Parameter",$settings);
echo "'/>";

echo "</form>";
echo "</ul>";


echo "</ul>";

}
} // end if (view - function parameters)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="hf-tags" )
{

echo "<b>";
echo getTranslation("About Function Tags",$settings);
echo "</b><br/>";
echo "<br/>";
$translated_text=getTranslation("function tags 1",$settings);
$translated_text=str_replace("THIS_URL","$this_server_url",$translated_text);
$translated_text=str_replace("URL1","$this_server_url/?q=$qn&cxml",$translated_text);
echo $translated_text;

echo "<br/>";
echo "<br/>";
echo "<b>";
echo getTranslation("Current Function Tags",$settings);
echo ":</b>";
echo "<br/>";
echo "<ul>";
echo "<table border='0'>";
echo "<tr><td><b>";
echo getTranslation("Tag Value",$settings);
echo "</b></td><td><b>";
echo getTranslation("Action",$settings);
echo "</b></td></tr>";
if ( is_array($q->obj_hf_tags) )
{
	foreach ($q->obj_hf_tags as $hf_tag)
	{
		echo "<tr>";
		echo "<td width='400' nowrap='nowrap'><span style='background-color:".rcolor()."'>";
		echo $hf_tag->obj_tag->body;
		echo "</span>&nbsp;</td>";
		echo "<td>";
		echo "<form method='post' action='?q=$qn&v=hf-tags&action=delete-hf-tag'>";
		echo "<input type='hidden' name='tid' value='".$hf_tag->id."'/>";
		echo "<input type='hidden' name='qid' value='".$hf_tag->id_hf."'/>";
		echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
	echo getTranslation("Delete",$settings);
	echo "'/>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}
}
if ( count($q->obj_hf_tags)==0 )
{
	echo "<tr><td colspan='2'>";
	echo "<br/>";
	echo getTranslation("No function tags have been created yet",$settings);
	echo "</td></tr>";
}
echo "</table>";
echo "<br/>";
echo "</ul>";
echo "<b>";
echo getTranslation("Add a new Function Tag",$settings);
echo ":</b><br/>";
echo "<br/>";
echo "<ul>";
echo "<form method='post' action='?q=$qn&v=hf-tags&action=add-hf-tag'>";
echo getTranslation("Tag Value",$settings);
echo ": ";
echo "<input type='hidden' name='qid' value='$qn'/>";
echo "<input type='text' style='background-color:".rcolor()."display:inline;;' name='new_tag_value' value=''/>";
echo "<input type='submit' value='".getTranslation("Add Tag",$settings)."' style='background-color:".rcolor().";display:inline;'/>";
echo "</form>";
echo "</ul>";
echo "";
echo "\n";
echo "\n";
echo "</ul>";


echo "<h4>";
echo getTranslation("Universal Function Tags - Public Access",$settings);
echo "</h4>";
echo "<ul>";
echo getTranslation("Expose this function for usage as a public/globally accessible API?",$settings);
$chkstr="";
if (false) {$chkstr=" checked";}
echo " <form method='post' action='?q=$qn' style='display:inline;'>";
echo "<span style='background-color:".rcolor().";display:inline;'>";
echo "<input name='is_public' type='checkbox'$chkstr/>";
echo "</span>";
echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
echo getTranslation("Submit",$settings);
echo "'/></form>";
echo "<br/>";
echo "<br/>";
echo getTranslation("universal tag warning",$settings);
echo "<br/>";
echo "<br/>";

echo "</ul>";


}
} // end if (view - function tags)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="gui" )
{

echo getTranslation("Under construction",$settings);

}
}


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="input-resource" )
{
/*
echo "<br/>";
echo "<b>Enter Alt Resource Test:</b>";
echo "<ul>";
echo "<form action='?' method='get'><input type='hidden' name='q' value='$qn'/>";
echo "<textarea cols='40'  name='url' ></textarea>";
echo "<br/>";
echo "<input type='submit'/>";
echo "</form>";
echo "</ul>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
*/
}
} // end if (view - input resource)

echo "</body>";

?>
