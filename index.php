<?php
include("version.php");
include("demos.php");
include("extensions.php");
global $demo_domain;

$job_submission_server_available_timelimit = 60*60; // 60 minutes

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$mode_server=false;
$mode_output=false;
if (PHP_SAPI === 'cli')
{
	$mode_server=true;

	// for processing cmd line args
	// given like so:
	//     php -f somefile.php a=1 b[]=2 b[]=3
	// sets GET array
	if ( count($argv)>1 )
	{
		if (count($_GET)==0)
		{
			parse_str(implode('&', array_slice($argv, 1)), $_GET);
		}
		else
		{
			//echo "FOUND EXISTING GET:";
			//print_r($_GET);
		}
		if ( !isset($_GET['--name']) )
		{
			$mode_output=true;
			$mode_server=false;
		}
	}
}
if ( isset($_GET['JID']) )
{
	$mode_output=true;
	$mode_server=false;
}

$mode_demo=false;

if ( isset($_SERVER['HTTP_HOST']) )
{
	if ($_SERVER['HTTP_HOST']==$demo_domain)
	{
		$mode_demo=true;
	}
}

$mode_xml=false;
$mode_short=false;
$mode_edit=true;
$mode_cxml=false;
$mode_jidonly=false;

if ( isset($_GET['xml']) )
{
        $mode_xml=true;
        $mode_edit=false;
        $mode_cxml=false;
}
if ( isset($_GET['short']) )
{
        $mode_short=true;
}
if ( isset($_GET['cxml']) || $mode_output )
{
        $mode_xml=false;
        $mode_edit=false;
        $mode_cxml=true;
}
if ( isset($_GET['jidonly']) )
{
    $mode_edit=false;
	$mode_jidonly=true;
}
if ($mode_edit)
{
	$mode_short=true;
}
if ($mode_server)
{
	$mode_edit=false;
}




if (!$mode_server&&!$mode_output)
{
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
}

$BIN_DIR=__dir__;
global $BIN_DIR;
$qn="";
global $qn;


$INT_32_OR_64=32;
if (PHP_INT_SIZE===8)
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
$oss="linux";
if ($IS_WINDOWS) {$oss="win";}


include_once("model.classes.php");

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

if (!$mode_output && isset($_SERVER['HTTP_HOST']) )
{
	$this_server_url=$this_http."://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	$this_server_url=str_replace("/index.php", "", $this_server_url);
}
else
{
	$this_server_url=$GLOBALS['settings']['uri']['@attributes']['value'];
}


if (!$mode_server)
{
	include_once("controller.guard.php");
	include_once("update.php");
}
if ($mode_server&&!$mode_output)
{
	include_once("controller.server.php");
	exit;
}

$this_job_id=-1;

$alert_messages="";


if ( !isset($_GET['q']) && !isset($_GET['tags']) && isset($_GET['s']) && !isset($_GET['t']) )
{
	$_GET['tags']=$_GET['s'];
}
if ( !isset($_GET['q']) && !isset($_GET['tags']) && isset($_GET['t']) && !isset($_GET['s']) )
{
	$_GET['tags']=$_GET['t'];
}
// use hf tags to identify hf ID # (only if QID # not given)
if ( !isset($_GET['q']) && isset($_GET['tags']) && (!isset($_GET['v'])||(isset($_GET['v']) && $_GET['v']!="find-hf" ) ) )
{
	$hfs = new hf_id_user();
	$all_hfs = $hfs->get_from_hashrange($u->id_user);
	$selected_hfs = array();

	$search_term=explode(",",$_GET['tags']);
	foreach ($all_hfs as $ahf)
	{
		$found_all=true;
		foreach ($search_term as $search_item)
		{
			if ( strpos( strtolower($ahf['name']), strtolower($search_item) )===false )
			{
				$found_all = false;
				break;
			}
		} // foreach
		/*
		if (!$found_all)
		{
				// check tags
				$tagcheck_hf = new hf_id_user();
				$tagcheck_hf->set($ahf);
				$tagcheck_hf->build();
				$found_all=false;
				foreach ($search_term as $search_item)
				{
						foreach ($tagcheck_hf->obj_hf_tags as $tag)
						{
								$tag_value = $tag->obj_tag->body;
								if ( strpos( strtolower($ahf['name']), strtolower($search_item) )===false )
								{
										$found_all = false;
										break;
								}
						} // foreach
						if (!$found_all)
						{
								break;
						}
				} // foreach
		}
		*/
		if ($found_all)
		{
			$selected_hfs[] = $ahf;
		} // end if
	} // foreach
	if ( !isset($_GET['randomfunction']) )
	{
		foreach ($selected_hfs as $selected_hf)
		{
			{
				$_GET['q']=$selected_hf['id'];
				break;
			}
		}
	}
	else
	{
		// SELECT A RANDOM FUNCTION OUT OF THE QUALIFYING ONES
		$selected_function_idx = rand(0,count($selected_hfs)-1);
		$_GET['q']=$selected_hfs[$selected_function_idx]['id'];
	}
} // end if (no checking for tags)

if ($mode_edit)
{
	if (!isset($_GET['v']))
	{
		$_GET['v']="his-overview";
		if ( isset($_GET['s']) || isset($_GET['t']) || isset($_GET['tags']) )
		{
			if ( isset($_GET['q']) )
			{
				$_GET['v']="overview";
			}
		}
	}
}

if (!$mode_server && !$mode_output)
{
	include_once("controller.action_handler.php");
	if ( $mode_edit )
	{
		//include_once("view.menu.public.php");
		include_once("view.menu.main.php");
	}
}

$qn="";
if ( isset($_GET['q']) )
{

	if ( strlen(trim($_GET['q']))>0 )
	{
		$qn = $_GET['q'];
	}
	else
	{
		unset($_GET['q']);
	}
}




if ( !isset($_GET['q']))
{
	//require_once("view.public.php");
	require_once("view.main.php");
	exit;
}

$hf_build_exclusions=array();
if ($mode_edit)
{
	if ($_GET['v']=="input-resource")
	{
		$hf_build_exclusions=array("obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_node_filters","obj_hf_outputs","obj_hf_tags","obj_cache_ad","obj_fastresponse","obj_hf_kill");
	}
	if ($_GET['v']=="hf-tags")
	{
		$hf_build_exclusions=array("obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_parameters","obj_hf_node_filters","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit");
	}
	if ($_GET['v']=="hf-parameters")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_tags");
	}
	if ($_GET['v']=="integration")
	{
		$hf_build_exclusions=array();
	}
	if ($_GET['v']=="overview")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_hf_parameters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_tags");
	}
	if ($_GET['v']=="filtering-expression")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_cache_out_xml","obj_cache_out_cxml","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
		if (!isset($_GET['use_approved']) || $_GET['use_approved']!="yes")
		{
			$hf_build_exclusions[]="obj_cache_approved";
		}
	}
	if ($_GET['v']=="gather"||$_GET['v']=="hf-list"||$_GET['v']=="add-hf"||$_GET['v']=="map"||$_GET['v']=="features"||$_GET['v']=="find-hf"||$_GET['v']=="server-info"||$_GET['v']=="settings"||$_GET['v']=="download")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
	}
	if ($_GET['v']=="techniques")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_hf_parameters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
	}
	if ($_GET['v']=="mime")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_hf_parameters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
	}
	if ($_GET['v']=="node-filters")
	{
		$hf_build_exclusions=array("obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
	}
	if ($_GET['v']=="time")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_expression","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_hf_outputs","obj_cache_ad","obj_hf_inherit","obj_hf_tags");
	}
	if ($_GET['v']=="output-expression")
	{
		$hf_build_exclusions=array("obj_hf_node_filters","obj_expression","obj_cache_out_xml","obj_cache_approved","obj_cache_latest","obj_hf_system_kind","obj_hf_resources","obj_fastresponse","obj_hf_kill","obj_hf_inherit","obj_hf_tags");
	}
	if ( isset($_GET['xout']) )
	{
		if(($key = array_search("obj_cache_out_xml", $hf_build_exclusions)) !== false)
		{
		    unset($hf_build_exclusions[$key]);
		}
	}
	if ( isset($_GET['cout']) )
	{
		if(($key = array_search("obj_cache_out_cxml", $hf_build_exclusions)) !== false)
		{
		    unset($hf_build_exclusions[$key]);
		}
	}
}

$q = new hf_id_user();
$q->get_from_hashrange($u->id_user,$qn);
$q->build($hf_build_exclusions);
global $q;

$id_submitted_job=-1;
$qtab="  ";

if (!$mode_server)
{
	global $adjacent_dictionary;
	$adjacent_dictionary=array();
}

global $system_adjacent_dictionary_keys;
$system_adjacent_dictionary_keys=array("[YYYY-MM-DD]","[DD-MM-YYYY]","[MM-DD-YYYY]","[YY-MM-DD]","[DD-MM-YY]","[HH-MM-SS]","[DATE-ISO8601]","[DATE-RFC2822]","[DATE-EPOCHSECS]","[DAYOFWEEK]","[THIS_HIS_WEB_INTERFACE_HOME]","[THIS_FUNCTION_ID]","[JID]","[JOB_FOLDER]","[SERVERBINS]","[HISGETPOST]");

$adjacent_dictionary["[YYYY-MM-DD]"]=gmdate("Y-m-d");
$adjacent_dictionary["[DD-MM-YYYY]"]=gmdate("d-m-Y");
$adjacent_dictionary["[MM-DD-YYYY]"]=gmdate("m-d-Y");
$adjacent_dictionary["[YY-MM-DD]"]=gmdate("y-m-d");
$adjacent_dictionary["[DD-MM-YY]"]=gmdate("d-m-y");
$adjacent_dictionary["[HH-MM-SS]"]=gmdate("H-i-s");
$adjacent_dictionary["[DATE-ISO8601]"]=gmdate("c");
$adjacent_dictionary["[DATE-RFC2822]"]=gmdate("r");
$adjacent_dictionary["[DATE-EPOCHSECS]"]=gmdate("U");
$adjacent_dictionary["[DAYOFWEEK]"]=gmdate("N");
$adjacent_dictionary["[THIS_HIS_WEB_INTERFACE_HOME]"]=$this_server_url;
$adjacent_dictionary["[THIS_FUNCTION_ID]"]=$qn;


$GLOBALS['VISITOR']=microtime();
$GLOBALS['HIS_URLS_TO_VISIT'.$GLOBALS['VISITOR']]=array();

$mode_xml=false;
$mode_short=false;
$mode_edit=true;
$mode_cxml=false;
if ( isset($_GET['xml']) )
{
	$mode_xml=true;
	$mode_edit=false;
	$mode_cxml=false;
}
if ( isset($_GET['short']) )
{
	$mode_short=true;
}
if ( isset($_GET['cxml']) )
{
	$mode_xml=false;
	$mode_edit=false;
	$mode_cxml=true;
}
if ($mode_edit)
{
	$mode_short=true;
}
if ($mode_edit)
{
	$adjacent_dictionary["[JID]"]="JOB-ID-WILL-APPEAR-HERE";
	$adjacent_dictionary["[JOB_FOLDER]"]="JOB-FOLDER-PATH-HERE";
	$adjacent_dictionary["[SERVERBINS]"]="PATH-TO-SERVERBINS-FOLDER-HERE";
	$adjacent_dictionary["[HISGETPOST]"]="URLENCODED-POST/GET-DATA-HERE";
}

if ( isset($_GET['JID']) )
{
    $adjacent_dictionary["[JID]"]=$_GET['JID'];
}

$default_adjacent_dictionary=$adjacent_dictionary;

$cxml_default_mime_type="text/xml";
$this_mime=false;
if (strlen($q->id_mime_type)>0)
{
	foreach ($STATIC['mime_types'] as $mime_type_key=>$mime_type_value)
	{
		if ($q->id_mime_type==$mime_type_key)
		{
			$this_mime=$mime_type_key;
			break;
		}
	} // end foreach
} // end if
if (!$this_mime)
{
	$this_mime=array();
	$this_mime['extension']="txt";
	$this_mime['mime_type']="text/plain";
}
else
{
	$mime_key=$this_mime;
	$this_mime=array();
	$this_mime['extension']=$STATIC['mime_types'][$mime_key];
	$this_mime['mime_type']=$mime_key;
}

if ( isset($_GET['xout']) && !$mode_server &&!$mode_output)
{
	if ($q->obj_cache_out_xml)
	{
		header("Location: ".$q->obj_cache_out_xml->val);
		exit;
	}
	else
	{
		$_GET['v']="integration";
	}
} // end if xout
if ( isset($_GET['cout']) && !$mode_server &&!$mode_output)
{
	if ($q->obj_cache_out_cxml)
	{
		header("Location: ".$q->obj_cache_out_cxml->val);
		exit;
	}
	else
	{
		$_GET['v']="integration";
	}
} // end if cout


$hf_parameters_given=false;
global $hf_parameters_given;

$ephemeral_remote=false;
if (isset($_GET['remote']) )
{
	$ephemeral_remote=true;
}

if ( $q->obj_hf_outputs && ($mode_xml || $mode_cxml) )
{
	foreach ($q->obj_hf_outputs as $hf_output)
	{
		if ( isset($hf_output->obj_output_expression) )
		{
			if ( strlen($hf_output->obj_output_expression->body)>0 )
			{
				$ephemeral_remote=true;
			}
		}
	}
} // end if (hf outputs defined - then set ephemeral to true)
$is_upload=false;

$hf_resource_location_override="";
if ( isset($_GET['url']) )
{
	if (strlen($_GET['url'])>0)
	{
		$hf_resource_location_override=$_GET['url'];

		//$hf_resource_location_override=urldecode($hf_resource_location_override);
		$hf_resource_location_override=str_replace("&amp;","&",$hf_resource_location_override);
		$hf_resource_location_override=str_replace(" ","+",$hf_resource_location_override);
		$ephemeral_remote=true;
	}
}



require_once("recursive.php");

// Handle uploaded file as url override only if direct GET
/*if ( $q->obj_hf_resources->id_type=='abc' ) // what about remote-wget, etc?
{
	if ($APP['fs']->is_aws() )
	{
		// if uploaded S3 file redirect direct coming from S3, treat as hf_resource_location (url) override
		// Amazon S3 Upload

		if ( isset($_GET['bucket']) && isset($_GET['key']) && isset($_GET['etag']) )
		{
			$s="https://s3.amazonaws.com/".$_GET['bucket']."/".$_GET['key'];

			$hf_resource_location_override=$s;
			$ephemeral_remote=true;
		} // end if
	}
	// todo do for Rackspace too
} // end if
else
{
*/
	// otherwise, preserve the input hf_resource as usual (todo soon use jobs_files table to enable usage of these files)
	if ( !isset($_GET['action']) && isset($_GET['bucket']) && isset($_GET['key']) && isset($_GET['etag']) && !isset($_GET['v']) )
	{
		$ephemeral_remote=true;
	} // end if
//} // end else

$hf_expression="";
if ( isset($q->obj_expression) && isset($q->obj_expression->value) )
{
	$hf_expression=$q->obj_expression->value;
}

/*
$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];

$hf_resource_location=$APP['fs']->get_object($bucket_name,$q->obj_hf_resources->obj_location->val);
$hf_expression=$APP['fs']->get_object($bucket_name,$q->obj_expression->val);

$original_hf_expression=$hf_expression;
$hf_resource_raw=$hf_resource_location;
if ( strlen($hf_resource_location_override)>0 )
{
	$hf_resource_location=$hf_resource_location_override;
}
$hf_resource_location_provided=$hf_resource_location;

// do url/location hf replacement (hf_resource)
$hf_resource_location_before_replacements=$hf_resource_location;
$hf_resource_location=replace_hf_parameters($hf_resource_location,$q->obj_hf_parameters);
if ($hf_resource_location!=$hf_resource_location_before_replacements)
{
	if ($hf_parameters_given)
	{
		$ephemeral_remote=true;
	}
}

$hstring="";
if ( count($q->obj_hf_parameters)>0 && $q->obj_hf_resources->id_type=='remote-wget')
{
	$hf_resource_link_link=$hf_resource_location;
	foreach ($q->obj_hf_parameters as $hf_parameter)
	{
		if ( is_secret($hf_parameter->keyword) )
		{
			$hstring=$hstring."&".$hf_parameter->parameter_name."=".str_repeat("*",10);
		}
		else
		{
			$hstring=$hstring."&".$hf_parameter->parameter_name."=".$hf_parameter->value;
		}
	} // end for
} // end if
$hf_resource_location=str_replace("{all_parameters_for_helium}",$hstring,$hf_resource_location);
*/

// do url/location hf replacement (top level regex/filtering)
$hf_expression=replace_hf_parameters($hf_expression,$q->obj_hf_parameters);

//$hf_expression="(.*)";

$refresh_cache=false;
if ( isset($_GET['use_approved']) )
{
	$ephemeral_remote=false;
}
if ( isset($_POST['refresh_cache']) )
{
	$refresh_cache=true;
}
if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="regather-latest-cache" )
	{
		$refresh_cache=true;
	}
}

// GET HTML
//   USE STANDARD FILE_GET_CONTENTS EXECUTION TO GET CONTENT
//       $x = $db->select_one("SELECT codes FROM executions WHERE id=3");
//   USE PEAR HTTP_REQUEST2 GET EXECUTION TO GET CONTENT




$posted_content=false;
$cache_content_used=false;
$original_html="";
$remote_content_collected="";
$matches=array();

if ( isset($_POST['data']) )
{
	// directly POSTed content
	$remote_content_collected=$_POST['data'];
	$posted_content=true;
	$ephemeral_remote=true;
}

// submit job action from interface
if ( !$posted_content && ( $ephemeral_remote || $refresh_cache || $mode_xml || $mode_cxml || $mode_jidonly ) && !isset($_GET['use_approved']) && (!$mode_output || $mode_jidonly ) )
{

	if (!$mode_demo)
	{
		
		$u->build();
		if ( count($u->obj_servers)>0 )
		{

			$uploaded_file="";
			// todo do for rackspace too
			/*
			if ($APP['fs']->is_aws())
			{
				// spot-uploaded file as input hf_resource
				if ( isset($_GET['bucket']) && isset($_GET['key']) && isset($_GET['etag']) )
				{
					// Amazon S3 Upload has already been completed
					$uploaded_file="https://s3.amazonaws.com/".$_GET['bucket']."/".$_GET['key'];
				} // end if
			}
			*/
		
			$POST_DATA=$_GET;
			foreach ($_POST as $PK=>$PD)
			{
				if ( !isset($POST_DATA[$PK]) )
				{
					$POST_DATA[$PK]=$PD;
				}
			}
			$requestdata=array('post'=>$POST_DATA);
			$rd=base64_encode(serialize($requestdata));
		
			$sha1_jid=sha1(microtime().$rd.rand(1, 20));
			
			$possible_server_list = array();
			
			$assign_hf_list = new assign_hf();
			$assign_hfs = $assign_hf_list->get_from_hashrange($u->id_user,$qn."@","BEGINS_WITH");
			if ($assign_hfs && count($assign_hfs)>0 )
			{
				foreach ($assign_hfs as $assign_hf)
				{
					$possible_server_name_split = explode("@",$assign_hf['hf_server']);
					if ($possible_server_name_split)
					{
						$possible_server_name = $possible_server_name_split[1];
						$possible_user_server = new user_server();
						$possible_user_server->get_from_hashrange($u->id_user,$possible_server_name);
						if ($possible_user_server->name!="undefined" && intval($possible_user_server->int_online)==1)
						{
							$possible_server_list[] = $possible_user_server;
						}
					}
				} // END FOREACH (ASSIGN HFS)
			}

			// sort possible servers by busyness
			usort($possible_server_list, "serveravailsort");
			//$possible_server_list = array_reverse($possible_server_list);
			
			
			$list_of_eligible_servers=array();

			foreach ($possible_server_list as $possible_server)
			{
				$timespan=(intval(gmdate('U'))-intval($possible_server->last_ping));

				// if the "last seen time is within 3 minutes"
				if ( intval($timespan) < $job_submission_server_available_timelimit )
				{
					$list_of_eligible_servers[]=$possible_server;
				}
				
			} // END FOREACH
			
			$count_of_eligible_servers = count($list_of_eligible_servers);
			if ($count_of_eligible_servers>0)
			{
				$rand_server_index = rand(0, $count_of_eligible_servers-1);
				$selected_job_server = $list_of_eligible_servers[$rand_server_index];
				$selected_job_server_name = $selected_job_server->name;

				$this_job_id=$selected_job_server_name."@".$sha1_jid;
                
                
				
				$this_time = gmdate('U');
				$prop=array();
				$prop["id_user"]=$u->id_user;
				$prop["id"]=$this_job_id;
				$prop["id_status"]='new';
				$prop["id_hf"]=$qn;
				$prop["dt_created"]=$this_time;
				$prop["dt_modified"]=$this_time;
				$prop["str_rqdata"]=$rd;
				$prop["str_response"]='undefined';
				$prop["str_output"]='undefined';
			
				$new_job_id=new job_id_user();
				$new_job_id->create($prop);


				$prop=array();
				$prop["id_user"]=$u->id_user;
				$prop["id"]=$this_job_id;
                
				$new_job=new job_new();
				if ($APP['ms']->kind!="no-messaging")
				{
					$new_job->set($prop);
					$xml_send = $new_job->toobjectxml();
					$new_job->send("sendto_".$selected_job_server_name,$xml_send);
				}
				else
				{
					$new_job->create($prop);
				}
                
				if ($mode_jidonly)
				{
					echo $this_job_id;
				}
				if ($mode_edit)
				{
					$alert_messages=$alert_messages. "<center><span style='background-color:green;color:white;'>".getTranslation("Job",$settings)." <a style='color:white;' href='?q=$qn&v=job-servers#unfinished_".str_replace("<","&lt;",$this_job_id)."'>".str_replace("<","&lt;",$this_job_id)."</a> ".getTranslation("has been submitted",$settings)."</span></center>";
				}

				if ($mode_jidonly)
				{
					return;
					//exit; ??
				}
				$id_submitted_job=$this_job_id;
				
				$trigger_wait_message = false;
			
				// wait here or not....IS up to hf wait behavior.  this is wait
				// jidonly mode implies only the collection of the job id, so
				// no waiting is required when mode_jidonly is on
				if (intval($q->int_wait)==1 && !$mode_jidonly)
				{
					$messaging_complete=False;
					$cnt=0;$all_messages="";
					while (true)
					{
						$cnt = $cnt + 1;
						if ( (intval($q->int_maxruntime)==0 && $cnt>15) || ($cnt>intval($q->int_maxruntime) && intval($q->int_maxruntime)>0) )
						{
							$check_job_id = new job_id_user();
							$check_job_id->get_from_hashrange($new_job_id->id_user,$new_job_id->id);
							if ($check_job_id->id_status=="new")
							{
								$slow_msg="<br/>";
								$slow_msg.=getTranslation("Consider clicking the stopwatch icon at top and change function to 'Fast Response' instead of the current value 'Slow Response'.  Fast Response will guarantees job submission.",$settings);
								$alert_messages="<center><span style='background-color:red;color:white;'>".getTranslation("Job submission",$settings)." #".str_replace("<","&lt;",$this_job_id)." ".getTranslation("was cancelled",$settings)." ($cnt).<br/>".getTranslation("The job cluster was too busy or not responsive.",$settings).$slow_msg."</span></center>";
								if ( ($mode_xml||$mode_cxml) && !$mode_server && !$mode_output )
								{
									$trigger_wait_message=true;
								}
							} // END IF
						} // END IF
						if ($APP['ms']->kind!="no-messaging" && !$messaging_complete)
						{
							// WAIT FOR MESSAGE QUEUE RESPONSE
							$message = $new_job_id->receive("replyfrom_".$selected_job_server_name);
							$all_messages.=$message."<br/>\n";
							if ( ($message.""=="NULL"|| strlen($message."")==0) && $cnt<15 )
							{
								sleep(1);
								continue;
							}
							$message_xml= xmlToArray( simplexml_load_string($message) );

							$collected_job_id = new job_id_user();
							$collected_job_id->fromobjectxml($message_xml);
							if ($collected_job_id->id == $id_submitted_job)
							{
								$new_job_id->fromobjectxml($message_xml);
								$messaging_complete=True;
							}
							else
							{
								$all_messages .= "received a wrong message: ".htmlspecialchars($message);
								// we collected a message from anoth/er job - re-post the message to the queue so we don't end up stealing other jobs' responses
								$collected_job_id->send("replyfrom_".$selected_job_server_name,$message);
							}
						}
						else
						{
							$new_job_id->get_from_hashrange($u->id_user,$new_job_id->id);
						}
						if ($new_job_id->id_status!='running' && $new_job_id->id_status!='new' && $new_job_id->id_status!='paused' )
						{
							// JOB IS DONE
							break;
						}
						else
						{
							sleep(1);
						}
					} // END WHILE (WAIT FOR JOB TO FINISH)
					$new_job_id->build();
					$gather_from="obj_response";
					if ($mode_xml||$mode_cxml)
					{
						$gather_from="obj_output";
					}
					$original_html=$new_job_id->$gather_from->val;
					$new_job_id->$gather_from->build();
					$remote_content_collected=$new_job_id->$gather_from->body;
				} // END IF (WAIT MODE)

				// THIS IS NO-WAIT
				if ($refresh_cache && $mode_edit && intval($q->int_wait) == 0 )
				{
					$latest_content = getTranslation("time behavior fast",$settings);
					$q->update(array("str_cache_latest"=>$latest_content));
					$q->build();
					$original_html="";
					$remote_content_collected=$latest_content;
				}

				if ( $mode_cxml || $mode_xml)
				{
					if ( intval($q->int_wait) == 1 && !$trigger_wait_message)
					{
						// cxml mode => give user direct raw download
						if (!$mode_server&&!$mode_output)
						{
							header("Location: $original_html");
						}
						exit;
					} // END IF (WAIT MODE)
					else
					{
						if ($trigger_wait_message)
						{
							// cxml mode, with no waiting => print submission message
							if (!$mode_server&&!$mode_output)
							{
								if ( !isset($q->obj_fastresponse) || !$q->obj_fastresponse || $q->obj_fastresponse->body=="" || $q->obj_fastresponse->body=="undefined")
								{
									echo "<warning job='".$new_job_id->id."' type='max-timelimit-for-direct-response-exceeded' explanation='".getTranslation("cannot wait for results",$settings)."'/>";
								}
								else
								{
									$q->obj_fastresponse->value = replace_hf_parameters($q->obj_fastresponse->body,$q->obj_hf_parameters);
									$q->obj_fastresponse->value=str_replace("[JID]",$new_job_id->id,$q->obj_fastresponse->value);
									echo $q->obj_fastresponse->value;
								}
							}
						}
						else
						{
							// cxml mode, with no waiting => print submission message
							if (!$mode_server&&!$mode_output)
							{
								if ( !isset($q->obj_fastresponse) || !$q->obj_fastresponse || $q->obj_fastresponse->body=="" || $q->obj_fastresponse->body=="undefined")
								{
									echo "<success value='JOB-SUBMITTED' job='".$new_job_id->id."'/>";
								}
								else
								{
									$q->obj_fastresponse->value = replace_hf_parameters($q->obj_fastresponse->body,$q->obj_hf_parameters);
									$q->obj_fastresponse->value=str_replace("[JID]",$new_job_id->id,$q->obj_fastresponse->value);
									echo $q->obj_fastresponse->value;
								}
							}
						} // END IF (TRIGGER WAIT MESSAGE HIT OR NOT HIT)
					} // END IF (NOT WAIT MODE)
					exit;
				}
				$cache_content_used=false;
			} // END IF (THERE WERE ELIGIBLE JOB SERVERS, JOB WAS SUBMITTED)
			else
			{
				if ($mode_cxml||$mode_xml)
				{
					echo "<error message='".getTranslation("Job was not able to be submitted; no eligible job servers were available.",$settings)."'/>";
					exit;
				}
				$alert_messages=$alert_messages."<center><span style='background-color:red;color:white;'>";
				$alert_messages=$alert_messages.getTranslation("EDIT page version: Job was not able to be submitted; no eligible job servers were available.",$settings);
				$alert_messages=$alert_messages. "</span></center>";
			} // END IF (THERE WERE NO ELIGIBLE JOB SERVERS, JOB WAS NOT SUBMITTED)
		}  // END IF (ARE THERE ANY USER SERVERS?)
		else
		{
			if ($mode_cxml||$mode_xml)
			{
				echo "<error message='".getTranslation("Unable to submit job.  Add a Job Server first.",$settings)."'/>";
				exit;
			}
			$alert_messages=$alert_messages."<center>";
			$the_q="";
			if ( isset($_GET['q']) )
			{
				$the_q="q=$qn&";
			}
			$alert_messages=$alert_messages."<span style='background-color:red;color:white;'>";
			$word_translation=getTranslation("Unable to submit job.  Add a Job Server first.",$settings);
			$word_translation=str_replace("{THE_Q}",$the_q,$word_translation);
			$alert_messages=$alert_messages.$word_translation;
			$alert_messages=$alert_messages. "</span>";
			$alert_messages=$alert_messages."</center>";
		} // NO USER SERVERS HAVE BEEN ADDED YET
	}
	else
	{
		// DEMO MODE
		if ($mode_edit)
		{
			$alert_messages=$alert_messages."<center><span style='background-color:red;color:white;'>";
			$alert_messages=$alert_messages.getTranslation("Unable to submit remote jobs in demo mode.",$settings);
			$alert_messages=$alert_messages. "</span></center>";
		}
		if ($mode_xml||$mode_cxml)
		{
			echo "<error message='".getTranslation("Unable to submit remote jobs in demo mode.",$settings)."'/>";
			exit;
		}
	}

} // END IF (SUBMIT JOB)

if ($mode_output)
{
	if ( strlen($hf_resource_location_override)>0 )
	{
		//echo "getting content";
		$remote_content_collected=file_get_contents($hf_resource_location_override);
	}
	else
	{
		if ( !$mode_jidonly )
		{
			exit;
		}
	}
} // END IF (OUTPUT MODE)

// content has been gathered now (only if a job was submitted, though)
// add the content into the cache if appropriate


$cache_message="<br/>";


// Load content from cache
if ( !$ephemeral_remote && !$refresh_cache && !$posted_content && !$mode_output)
{
	// means they DID NOT provide url AND NOT (hf param)...but maybe use_approved
	if ( isset($_GET['use_approved']) )
	{
		// check cache to see if there is content
		if ($mode_edit)
		{
			$cache_message="<br/>Loading Gathered Content from Approved Cache...<br/>&nbsp;&nbsp;&nbsp;(".$q->str_cache_approved.")\n";
		}
		if ($q->str_cache_approved!='undefined')
		{
			if ( $q->obj_cache_approved )
			{
				$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
				$remote_content_collected=$APP['fs']->get_object($bucket_name,$q->obj_cache_approved->val);
			}
			$cache_content_used=true;
		}
		else
		{
			if ($mode_edit)
			{
				$cache_message="No approved cache data available\n";
			}
		}
	} // end if (use approved)
	else
	{
		// check cache to see if there is content
		if ($mode_edit)
		{
			$cache_message="";//"<br/>Loading Gathered Content from Latest Cache...<br/>&nbsp;&nbsp;(".$q->obj_hf_resources->str_cache_latest.")\n";
		}
		if ($q->str_cache_latest!='undefined')
		{
			if ( $q->obj_cache_latest)
			{
		        $bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
				$remote_content_collected=$APP['fs']->get_object($bucket_name,$q->obj_cache_latest->val);
			}
			$cache_content_used=true;
		}
		else
		{
			if ($mode_edit)
			{
				$cache_message="No latest cache data available\n";
			}
			$cache_content_used=true;
		}
	} // end if (not use approved)
	if ($mode_edit)
	{
		$cache_message .= "\n";
	}
	//} // end if (use approved = yes)
} // end if (ephemeral_remote turned on)
else
{
	if ($mode_edit)
	{
		if (intval($q->str_cache_latest)==-2)
		{
			$cache_message.="<font style='background-color:yellow;'>A remote job is being run currently.</font><br/>";
		}
	}
}


// update cache
// we didn't use cached content on this one, no ephemeral content, and we're in edit mode, with non-blank content
if (!$cache_content_used && $mode_edit && !$posted_content && !$mode_output)
{
	if (!$ephemeral_remote)
	{
		// proceed with creating cache entries because we are in edit mode
		// and the user is training their hf; storing cached hf_resource
		// content is important to us
		if (strlen($remote_content_collected)>0)
		{
			if ($mode_edit)
			{
				$cache_message.="Updating cache with latest content.\n\n";
			}
			if ( strlen($original_html)==0 )
			{
				$cache_html=$remote_content_collected;
			}
			else
			{
				$cache_html=$original_html;
			} // end if (original_html is pointer to real hf_resource)
		} // end if (existing html available)
	} // end if (not force remote)
	else
	{
		if ($mode_edit)
		{
			$cache_message.="\n";
			$cache_message.="Live remote content gathering was forced by either hf parameter existance, ephemeral/forced remote job submission, \n";
			$cache_message.="\"Use Pre-Approved Content\" mode, live xml mode, live cxml mode, file upload as hf_resource, or url (i.e. hf_resource specifier)\n";
			$cache_message.="override\n";
		}
	} // end if-else (ephemeral_remote)
}  // end if (cache content (or prev job) not used)
else
{
	if ($mode_edit)
	{
		$cache_message.="<br/>";
		$cache_message.=getTranslation("Cache content is being used",$settings);
	}
}  // end if (cache content (or prev job) not used)


if ( intval($q->int_ws)==0 && strlen(trim($hf_expression))>0 )
{
	$remote_content_collected=str_replace("\n","",$remote_content_collected);
	$remote_content_collected=str_replace("\r","",$remote_content_collected);
}

if ($mode_edit)
{
	if (isset($_GET['q']))
	{
		require_once("view.menu.edit.php");
		echo $alert_messages;
		//require_once("view.public.php");
		require_once("view.main.php");
		require_once("view.edit.php");
	}
	else
	{
		//require_once("view.public.php");
		require_once("view.main.php");
	}
}
if ( $mode_edit )
{
	if (!isset($_GET['v']) || (isset($_GET['v']) && ($_GET['v']!="filtering-expression" && !isset($_GET['view-filtering']) ) ) )
	{
		exit;
	}
}
if ( isset($_GET['view-filtering']) )
{
	if ($_GET['view-filtering']=="false")
	{
		exit;
	}
}

if ($mode_cxml)
{
	// $content_type="Content-Type:";
	// $content_type=$content_type.$this_mime['mime_type'];
	// if ( strpos($content_type,"text")!==false) // if it has text in the mime type
	// {
		// $content_type=$content_type."; charset=utf-8";
	// }
	// //header ("Content-Type:"."text/xml; charset=utf-8");
	// if (!isset($_GET['noheader']) && !isset($_GET['noheaders']) && !$mode_output)
	// {
		// header('Content-disposition: attachment; filename=file.'.$this_mime['extension']);
		// header($content_type);
	// }
	// //echo $content_type;
	// //header("Content-Transfer-Encoding: base64");
	// if ($this_mime['mime_type']=="text/xml")
	// {
		// echo "<"."?xml version='1.0' "."encoding='UTF-8' ?".">\n";
	// } // end if (xml header)
}

if ($mode_xml)
{
	if (!$mode_output)
	{
		header ("Content-Type:"."text/xml; charset=utf-8");
	}
	echo "<"."?xml version='1.0' "."encoding='UTF-8' ?".">\n";
	echo "<root>";
	echo "\n";
	echo "\t<purpose>".htmlspecialchars($q->name)."</purpose>";
	echo "\n";
	//echo "\t<inputhf_resource>".htmlspecialchars($remote_content_collected)."</inputhf_resource>";
	//echo "\n";

	echo "\t<hfs>";
	echo "\n";

	echo "\t\t<hf>\n";
	echo "\t\t\t<expression>".htmlspecialchars($hf_expression)."</expression>";
	echo "\n";
}// xml mode

if ($mode_xml) echo "\t\t\t<results>\n";

if ($mode_edit)
{
	echo "<h1>";
	echo getTranslation("HIS Filter Expression Results and Recursive Sub-Processing Follows",$settings);
	echo ":</h1>";
}

if ($mode_edit)
{


	echo "<pre>";
//print_r($q);
	echo "<a name='filtering_toc'>";
	echo create_filtering_toc($q->obj_expression);
	echo "</a>";
}

if ( strlen(trim($hf_expression))>0 )
{
	try
	{
		if ($hf_expression=="(.*)")
		{
			$matches=array(array('',$remote_content_collected));
			unset($matches[0][0]);
		}
		else
		{
			$hf_expression = "#".$hf_expression."#ism";
			preg_match_all($hf_expression,$remote_content_collected,$matches,PREG_SET_ORDER);
			for ($i=0;$i<count($matches);$i++)
			{
				unset($matches[$i][0]);
			}
		}
		//echo htmlspecialchars(var_export($matches,true));
	}
	catch (Exception $e)
	{
		if ($mode_edit)
		{
			echo "<br/>";
			echo "<br/>";
			$remote_content_collected_to_print=$remote_content_collected;
			$print_len=1000;
			if ( strlen($remote_content_collected)>$print_len )
			{
				$remote_content_collected_to_print=substr($remote_content_collected,0,intval($print_len/2)-1);
				$remote_content_collected_to_print=$remote_content_collected_to_print."\n...\n";
				$remote_content_collected_to_print=$remote_content_collected_to_print.substr($remote_content_collected,strlen($remote_content_collected)-(($print_len/2)-1),($print_len/2)-1);
			}
			echo "The content below does not match the given expression (".htmlspecialchars($hf_expression)."):<br/>";
			echo "<textarea cols='100' rows='5' style='background-color:".rcolor()."'>";
			echo str_replace("<","&lt;",$remote_content_collected_to_print);
			echo "</textarea>";
			echo "<br/><br/><br/>";
		}
		$matches=array(array('','Caught exception: '.$e->getMessage()));
	} // end try
} // end if (any top-level filtering expression exists)
else
{
	// no filtering expression
	// show raw content
	if ($mode_edit && $q->obj_cache_latest)
	{
		if ( isset($q->obj_cache_latest->val) )
		{
			echo "<ul>";
			echo getTranslation("Filtering Expression is blank, raw data from the remote job is returned (no filtering will take place).",$settings);
			echo "<br/>";
			echo "<ul>";
			echo "<a href='".$q->obj_cache_latest->val."' target='_new'>";
			echo getTranslation("Click here to download raw data returned from remote job",$settings);
			echo "</a>";
			echo "</ul>";
			echo "</ul>";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			echo "<br/>";
			exit;
		}
	}
}

if ( count($matches)==0 )
{
	if ($mode_edit)
	{
		echo "<br/>";
		echo "<br/>";
		$remote_content_collected_to_print=$remote_content_collected;
		$print_len=1000;
		if ( strlen($remote_content_collected)>$print_len )
		{
			$remote_content_collected_to_print=substr($remote_content_collected,0,intval($print_len/2)-1);
			$remote_content_collected_to_print=$remote_content_collected_to_print."\n...\n";
			$remote_content_collected_to_print=$remote_content_collected_to_print.substr($remote_content_collected,strlen($remote_content_collected)-(($print_len/2)-1),($print_len/2)-1);
		}
		echo "The content below does not match the given expression (".htmlspecialchars($hf_expression)."):<br/>";
		echo "<textarea cols='100' rows='5' style='background-color:".rcolor()."'>";
		echo str_replace("<","&lt;",$remote_content_collected_to_print);
		echo "</textarea>";
		//echo 'Caught exception: ',  $e->getMessage(), "\n";
		echo "<br/><br/><br/>";
		echo "<br/><br/><br/>";
		exit;
	}
} // end if (no pattern matches, no matched content)

// CUSTOM HEADER HERE
$custom_head=$q->obj_expression->obj_match_customs;
$chead="";
$chead_after_replace="";
if ( $custom_head )
{
	if ( isset($custom_head['-1.header']) )
	{
		$chead=$custom_head['-1.header']->obj_txt->body;
		$chead_after_replace=replace_hf_parameters($chead,$q->obj_hf_parameters);
	}
}
if ($mode_cxml && !$mode_jidonly) echo $chead_after_replace;
if ($mode_edit)
{
	echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Header",$settings)." (".substr($q->str_expression,0,min(5,strlen($q->str_expression))).","."-1"."): ";
	echo "<input type='hidden' name='id_expr' value='".$q->str_expression."'/>";
	echo "<input type='hidden' name='idx_key' value='-1.header'/>";
	echo "<textarea name='str_txt' rows='1' cols='50' style='width:500px;'>".htmlspecialchars($chead)."</textarea>";
	echo "<input type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";
	echo "</form>\n";
}
if ($chead!=$chead_after_replace && $mode_edit)
{
	echo "\tAfter Replacement: ".htmlspecialchars($chead_after_replace)."\n";
}

if ( strlen(trim($hf_expression))==0 )
{
	if ($mode_cxml || $mode_xml)
	{
		if ($mode_cxml)
		{
			if ($q->id_mime_type=="undefined")
			{
				if (!$mode_server&&!$mode_output)
				{
					header("Content-Type: text/plain; charset=utf-8");
				}
			}
			else
			{
				if (!$mode_server&&!$mode_output)
				{
					header("Content-Type: ".$q->id_mime_type);
				}
			}
		}
		if ($mode_cxml)
		{
			echo $remote_content_collected;
		}
		if ($mode_xml)
		{
			echo base64_encode($remote_content_collected);
		}
	}
}

$cnt=0;
foreach ($matches as $ma)
{
	$cnt=$cnt+1;
	expression_results_and_interface($q->obj_expression,$cnt-1,$ma,4,false);
	if ($cnt==20 && $mode_short)
	{
		if ($mode_edit)
		{
			echo "<span style='background-color:red;color:white'>Only a few values have been printed out on this edit page (limit 100)</span><br/>\n";
		}
		break;
	}
} // END FOREACH (MATCHES IN INITIAL HF)


$custom_foot=$q->obj_expression->obj_match_customs;
$cfoot="";
$cfoot_after_replace="";
if ( $custom_foot)
{
	if ( isset($custom_foot['-1.footer']) )
	{
		$cfoot=$custom_foot['-1.footer']->obj_txt->body;
		$cfoot_after_replace=replace_hf_parameters($cfoot,$q->obj_hf_parameters);
	}
}
if ($mode_cxml && !$mode_jidonly) echo $cfoot_after_replace;
if ($mode_edit)
{
	echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Footer",$settings)." (".substr($q->str_expression,0,min(5,strlen($q->str_expression))).","."-1"."): ";
	echo "<input type='hidden' name='id_expr' value='".$q->str_expression."'/>";
	echo "<input type='hidden' name='idx_key' value='-1.footer'/>";
	echo "<textarea name='str_txt' rows='1' cols='50' style='width:500px;'>".htmlspecialchars($cfoot)."</textarea>";
	echo "<input type='submit' value='";
	echo getTranslation("Update",$settings);
	echo "'/>";
	echo "</form>\n";
}
if ($cfoot!=$cfoot_after_replace && $mode_edit)
{
	echo "\tAfter Replacement: ".htmlspecialchars($cfoot_after_replace)."\n";
}



if ($mode_xml)
{
	echo "\t\t\t</results>\n";

	echo "\t\t</hf>\n";

	echo "\t</hfs>";
	echo "\n";
	echo "</root>";
}


if ($mode_output)
{
	//echo "\nHIS VISITS\n";
	if ( isset($_GET['JID']) )
	{
		$this_jid=($_GET['JID']);
		if ( isUTF8($this_jid) )
		{
			$this_jid = iconv("UTF-8","ISO-8859-1//IGNORE",$this_jid);
			//$this_jid = utf8_decode($this_jid);
		}
	
        //$midx=0;
		foreach ($GLOBALS['HIS_URLS_TO_VISIT'.$GLOBALS['VISITOR']] as $PLACEHOLDER_HASH=>$HIS_URL)
		{
            // FOR DEBUG
            //$midx = $midx + 1;
            //if ($midx>10)
            //{
            //    break;
            //}
            
			//echo $PLACEHOLDER_HASH."\n";
			// in jidonly mode, only the newly submitted job id is printed out
			
			// http mode does not work, do local mode
			$NEW_CHILD_JID="";
			$idx=0;
			$failed_to_create_child_jobs=false;
			while ( strlen($NEW_CHILD_JID)<40 || strlen($NEW_CHILD_JID)>90 )
			{
				if ($idx>0)
				{
					sleep(5);
				}
				if ($idx>50)
				{
					$failed_to_create_child_jobs=true;
					break;
				}
				$NEW_CHILD_JID = @file_get_contents($HIS_URL."&JID=".urlencode($this_jid) );
				if ( isUTF8($NEW_CHILD_JID) )
				{
					$NEW_CHILD_JID = iconv("UTF-8","ISO-8859-1//IGNORE",$NEW_CHILD_JID);
				}
				$idx=$idx+1;
			} // END WHILE
			
			if ($failed_to_create_child_jobs)
			{
				$new_job_flag = new job_flag();
				$props=array();
				$props['id_job']=$this_jid;
				$props['flag']="failed";
				$props['status']="failed-to-create-child-jobs";//."-count:".count($submatches);
				exit;
			}
			

			if (strlen($NEW_CHILD_JID)>0 && strlen($this_jid)>0)
			{
				$ph_parent = new ph_parent();
				$props=array();
				$props['id_parent_job']=$this_jid;
				$props['id_child_job']=$NEW_CHILD_JID;
				$props['placeholder']=$PLACEHOLDER_HASH;
				$ph_parent->create($props);

				$ph_child= new ph_child();
				$props=array();
				$props['id_child_job']=$NEW_CHILD_JID;
				$props['id_parent_job']=$this_jid;
				$props['placeholder']=$PLACEHOLDER_HASH;
				$ph_child->create($props);
				sleep(1);
			}
		} // END IF (HIS URL ACTION)

	} // END IF (JID IS SET)
} // end if (mode server)

?>
