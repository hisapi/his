<?php
define('MB', 1024 * 1024);

$SERVER_VERSION=$software_version;
require_once("utility.functions.php");
$log=array();
$log_limit=45;
$log_updated=false;

$reassign_ping_max_limit_seconds = 5*60;

function logger($msg)
{
	global $log, $log_limit, $log_updated;
	echo $msg;
	$log[]=gmdate("c")." ".$msg;
	$log_updated=true;
	if ( count($log)==$log_limit )
	{
		// remove first entry every time we hit limit
		array_shift($log);
	}
}

$auth_file=(dirname($BIN_DIR).$PATH_SEPERATOR."auth.xml");

if (!file_exists($auth_file))
{
	echo "\tauth.xml does not exist.  Make sure PWD is correct. See HIS Web Interface at\n";
	echo "\t\t$this_server_url?v=map\n";
	echo "\n";
	exit;
}

$auth = xmlToArray(simplexml_load_file($auth_file));
if (!isset($auth['auth'][0]))
{
	$auth['auth'][0]=$auth['auth'];
	unset($auth['auth']['@attributes']);
}

parse_str(implode('&', array_slice($argv, 1)), $_GET);

$INSTANCE_NAME="";
if ( isset($GLOBALS['settings']['server']['name']) )
{
	$INSTANCE_NAME=$GLOBALS['settings']['server']['name']['@attributes']['value'];
}
if ( isset($_GET['--name']) )
{
	$INSTANCE_NAME=$_GET['--name'];
}
$INSTANCE_NAME = trim($INSTANCE_NAME);
$INSTANCE_NAME = str_replace("@","_AT_",$INSTANCE_NAME);
// NODE NAME 40 chars or less
if ( strlen($INSTANCE_NAME)>40 )
{
	logger("WARNING: SHORTENING SERVER NAME TO 40 CHARACTERS\n");
	$INSTANCE_NAME = substr($INSTANCE_NAME,0,40);
}
if ( strlen($INSTANCE_NAME) == 0)
{
	$INSTANCE_NAME = "default_INSTANCE_NAME_";
	$INSTANCE_NAME = $INSTANCE_NAME . (intval(ceil(rand(0, 9))));
	$INSTANCE_NAME = $INSTANCE_NAME . (intval(ceil(rand(0, 9))));
	$INSTANCE_NAME = $INSTANCE_NAME . (intval(ceil(rand(0, 9))));
	if ($IS_LINUX) {$INSTANCE_NAME=$INSTANCE_NAME."_linux";}
	if ($IS_WINDOWS) {$INSTANCE_NAME=$INSTANCE_NAME."_windows";}
	$INSTANCE_NAME=$INSTANCE_NAME.$INT_32_OR_64;
}

logger( "SERVER TYPE:\n" );
if ($IS_LINUX) {logger( "\tLinux"."-x".$INT_32_OR_64."\n" );}
if ($IS_WINDOWS) {logger( "\tWindows"."-x".$INT_32_OR_64."\n" );}
if ($IS_WINDOWS && $INT_32_OR_64==64)
{
	logger( "\tNote: It is possible for 32-bit runtimes to run on 64-bit systems.\n" );
}
logger( "SERVER INSTANCE NAME:\n\t".$INSTANCE_NAME."\n");

logger( "NUMBER OF AUTHS IN AUTHS.XML:\n\t".count($auth['auth'])."\n");
logger( "DATABASE:\n");
if (isset($GLOBALS['settings'][$APP['db']->kind]['server']))
{
	logger( "\t".$GLOBALS['settings'][$APP['db']->kind]['server']['@attributes']['value']."/".$APP['db']->dbname."\n");
}
else
{
	logger("\tDynamoDB/".$APP['db']->dbname."\n");
}
$wai=exec('whoami');
$SERVER_USERNAME=$wai;
if ( strpos($SERVER_USERNAME,"/") !== FALSE )
{
	$SERVER_USERNAME=explode("/",$SERVER_USERNAME);
	$SERVER_USERNAME=$SERVER_USERNAME[1];
}
if ( strpos($SERVER_USERNAME,"\\") !== FALSE )
{
	$SERVER_USERNAME=explode("\\",$SERVER_USERNAME);
	$SERVER_USERNAME=$SERVER_USERNAME[1];
}
logger( "SLEEP BETWEEN JOBS:\n\t".$GLOBALS['settings']['server']['jobs']['sleep-between']['@attributes']['value']."\n");
logger( "USING SYSTEM ACCOUNT:\n\t".$wai."\n");
logger( "SERVER VERSION:\n\t$SERVER_VERSION\n" );
logger( "SERVER INSTANCE NAME:\n\t".$INSTANCE_NAME."\n");


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

$last_10_placeholder_merges=array();


$server_loop_idx = -1;
$server_loop_max = 10000;

while (true)
{
	$server_loop_idx = $server_loop_idx+1;
	if ($server_loop_idx>$server_loop_max)
	{
		$server_loop_idx = 0;
	}

	if (!$APP['db']->connect())
	{
		echo "unable to connect to database";
		exit;
	}

	$sys_setting_version = new sys_setting();
	$sys_setting_version->get_from_hashrange("system","version");
	$database_version = $sys_setting_version->val;

	if ($database_version != $software_version)
	{
		//logger( "SERVER SOFTARE VERSION ERROR:\n" );
		//logger( "\tHIS DATABASE IS VERSION ".$database_version."\n"."\tSERVER SOFTWARE IS VERSION ".$software_version."\n" );
		//logger( "\tUPDATE SERVER SOFTWARE TO CONTINUE\n" );
	}
	
	$JOBS = array();
	$JID="";
	$REQUEST="";
	$REMOTE_JOB_TYPE="";

	$id_user="";
	$secret="";
	// LOOP THROUGH ALL AUTHS
	for ($a=0;$a<count($auth['auth']);$a++)
	{
		if ($auth['auth'][$a]==false)
		{
			logger("Unable to read auth\n");
			sleep(10);
			continue;
		}
		$AUTH=$auth['auth'][$a];
		$id_user=$AUTH['@attributes']['uid'];
		$secret=$AUTH['@attributes']['secret'];
		
		// READ USER CREDENTIALS PROVIDED & CONFIRM MATCH
		$check_user=new user_id_user();
		$check_user->get_from_hashrange($id_user);
		if ($check_user->secret=='undefined')
		{
			logger("UNABLE TO MATCH SECRET FOR USER ".$id_user.".\n");
			//$auth['auth'][$a]=false;
			sleep(10);
			$auth = xmlToArray(simplexml_load_file($auth_file));
			if (!isset($auth['auth'][0]))
			{
				$auth['auth'][0]=$auth['auth'];
				unset($auth['auth']['@attributes']);
			}
			continue;
		}
		if ($check_user->secret!=$secret)
		{
			logger($check_user->secret." =? ".$secret);
			logger("AUTH.XML ENTRY FAILED FOR USER NAME:".$check_user->user_name."\n");
			//$auth['auth'][$a]=false;
			sleep(10);
			$auth = xmlToArray(simplexml_load_file($auth_file));
			if (!isset($auth['auth'][0]))
			{
				$auth['auth'][0]=$auth['auth'];
				unset($auth['auth']['@attributes']);
			}
			continue;
		}
		
		// UPDATE LIST OF SERVER SERVICES THIS SERVER HAS ENABLED
		$user_server_service = new user_server_service();
		$user_server_services = $user_server_service->get_from_hashrange(substr($check_user->id_user,0,6)."@".$INSTANCE_NAME);
		foreach ($SERVICES as $service)
		{
			$service_enabled_state = "";
			if (isset($service->enabled) )
			{
				if ($service->enabled)
				{
					$service_enabled_state = "1";
				}
				else
				{
					$service_enabled_state = "0";
				}
			}
			else
			{
				$service_enabled_state = "0";
			}

			$found_service=false;
			if ($user_server_services)
			{
				foreach ($user_server_services as $each_server_service)
				{
					if ($each_server_service['service_name']==$service->name)
					{
						$found_service=true;
						if (!isset($each_server_service['service_enabled']) || $each_server_service['service_enabled'].""!=$service_enabled_state."")
						{
							$update_server_service = new user_server_service();
							$update_server_service->set($each_server_service);
							$update_server_service->update(array('service_enabled'=>$service_enabled_state));
						}
					
					} // END IF (FOUND AN EXISTING DB ENTRY FOR THIS SERVICE)
				} // END FOREACH (EACH CURRENT SERVER SERVICE)
			}
			if (!$found_service)
			{
				$create_server_service = new user_server_service();
				$props=array();
				$props['id_user_server']=substr($check_user->id_user,0,6)."@".$INSTANCE_NAME;
				$props['service_name']=$service->name;
				$props['service_enabled']=$service_enabled_state."";
				$create_server_service->create($props);
			} // END IF (ADD SERVER SERVICE ENTRY)
		
		} // END FOREACH (EACH SERVICE ON THE SERVER)
		
		// GET DETAIL INFO FOR THIS SERVER
		$SECONDS_SINCE_EPOCH=get_time();
		$user_server=new user_server();
		$user_server->get_from_hashrange($id_user,$INSTANCE_NAME);
	
		$server_id_sk="";
		$a_sys_kind=new user_system_kind();
		$sys_kinds=$a_sys_kind->get_from_hashrange($id_user);
		foreach ($sys_kinds as $sys_kind)
		{
			if (strpos(strtolower(php_uname("a")),strtolower($sys_kind['detection_text']))!==False)
			{
				$server_id_sk=$sys_kind['id'];
			}
		}
		$my_ip = file_get_contents($this_server_url."/whatismyip.php");
	
		// IF THIS SERVER IS NOT FOUND...INSERT IT INTO SERVER LIST
		if ($user_server->name=="undefined")
		{
			// ADD THIS NODE TO THE LIST OF NODES IN THE JOBNODES TABLE
			$props=array();
			$props["id_user"]=$id_user;
			$props["name"]=$INSTANCE_NAME;
			$props["last_ping"]="$SECONDS_SINCE_EPOCH";
			$props["force_restart"]="0";
			$props["str_log"]="undefined";
			$props["ip_address"]=$my_ip;//
			$props["id_sk"]=$server_id_sk;
			$props["int_routable"]="0";
			$props["is_busy"]="0";
			$props["int_online"]="1";
			$props["software_version"]=$software_version;
			$user_server->create($props);
		} // end if

		if ($user_server->name=="undefined")
		{
			logger( "UNABLE TO ADD SERVER TO USER_SERVER LIST.\n");
			exit;
		}
		
		
		// UPDATE SERVER IN THE SERVER LIST
		$user_server->update(array("last_ping"=>$SECONDS_SINCE_EPOCH,"is_busy"=>"0","software_version"=>$software_version));
	
		// FORCE RESTART SIGNAL GIVEN
		if ($user_server->force_restart=='1')
		{
			$user_server->update(array("force_restart"=>"0","is_busy"=>"1"));
			logger( "FORCE RESTART SIGNAL GIVEN.  EXITING...\n");
			exit;
		}

		// SERVER VERSION MISMATCH ERROR
		if ($database_version != $software_version)
		{
			$user_server->update(array("int_online"=>"0"));
		
			logger( "SERVER SOFTARE VERSION ***ERROR***:\n" );
			logger( "\tHIS DATABASE IS VERSION ".$database_version."\n"."\tSERVER SOFTWARE IS VERSION ".$software_version."\n" );
			logger( "\t\tTO FIX:\n" );
			logger( "\t\t\t1) UPDATE THIS SERVER'S HIS SOFTWARE TO CONTINUE\n" );
			logger( "\t\t\t	 THERE IS AN UPDATE SCRIPT IN YOUR MAIN SERVER\n" );
			if ($IS_LINUX) {logger( "\t\t\t	 FOLDER CALLED update-linux-his-server.sh\n" );}
			if ($IS_WINDOWS) {logger( "\t\t\t	 FOLDER CALLED update-win-his-server.vbs\n" );}
			
			logger( "\t\t\t2) ONCE SERVER IS UPDATED, MARK THIS SERVER INSTANCE AS\n");
			logger( "\t\t\t	 'ONLINE' IN YOUR WEB INTERFACE/ON YOUR \"JOB CLUSTER\"\n" );
			logger( "\t\t\t	 PAGE\n" );
		}
		
		
		$BOOL_EXECUTE_JOB_PREPROCESSING=true;
		$BOOL_EXECUTE_JOB_EXECUTION=true;
		$BOOL_EXECUTE_JOB_POSTPROCESSING=true;
		$BOOL_EXECUTE_JOB_PARENT_MERGING=true;
		$BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS=true;
		$BOOL_EXECUTE_MERGING=true;
		$BOOL_FIND_NEW_JOB=true;
		
		$JOB_FAILED = false;
		$JOB_FAIL_STATUS = "failed";
		$STDOUT="";
		$PARENT_JOB = false;
		$OUTPUT_CONTENT = "";
		$PROCESS_MANAGER = new Processmanager();

		$new_job_news=new job_new();
		
		
		// CHECK FOR JOBS THAT ARE ALREADY "RUNNING" or "PAUSED" (AWAITING MERGING)
		$unfinished_jobs=array();
		
		$statuses = array("running","paused","merging","undefined");
		$existent_statuses=array();
		foreach ($statuses as $a_status)
		{
			$check_existing_jobs = new job_status();
			$already_existing_jobs_assigned_to_this_server = $check_existing_jobs->get_from_hashrange($id_user,$a_status."#".$INSTANCE_NAME."@","BEGINS_WITH");
			if ( $already_existing_jobs_assigned_to_this_server && count($already_existing_jobs_assigned_to_this_server) > 0 )
			{
				foreach ($already_existing_jobs_assigned_to_this_server as &$old_existing_job)
				{
					$check_is_child = new ph_child();
					$check_is_child->get_from_hashrange(explode("#",$old_existing_job['id_status_job'])[1]);
					if ($check_is_child->id_child_job!="undefined")
					{
						$old_existing_job['id_parent_job']=$check_is_child->id_parent_job;
					}
					else
					{
						$old_existing_job['id_parent_job']=false;
					}
					$existent_statuses[$a_status]=true;
					$unfinished_jobs[] = $old_existing_job;
				}
			}			
		}
		
		// RESTART PREVIOUSLY INTERRUPTED RUNNING JOBS
		if ( $unfinished_jobs && count($unfinished_jobs) > 0 && isset($existent_statuses["running"]) )
		{
			foreach ($unfinished_jobs as $old_existing_job2)
			{
				if (explode("#",$old_existing_job2['id_status_job'])[0]!="running")
				{
					continue;
				}
				logger("THIS SERVER HAS PRE-EXISTING RUNNING JOBS THAT MAY HAVE\nBEEN INTERRUPTED WHILE RUNNING - RESTARTING THOSE JOBS\n");
				// ONLY "RUNNING" JOBS WIL GET TO THIS POINT
				$running_job = new job_id_user();
				$running_job->get_from_hashrange($old_existing_job2['id_user'],explode("#",$old_existing_job2['id_status_job'])[1]);
				
				$running_job->build(array("obj_user","obj_rqdata","obj_response","obj_output","obj_ad","str_rqdata","str_response","str_output","str_ad"));
				if (intval($running_job->int_try)>intval($running_job->obj_hf->int_retry_count) && intval($running_job->obj_hf->int_retry_count)>0 )
				{
					logger("\tOVER MAX RETRY LIMIT, SETTING JOB=FAILED\n");
					$JOB_FAILED=true;
					$BOOL_EXECUTE_JOB_PREPROCESSING=false;
					$BOOL_EXECUTE_JOB_EXECUTION=false;
					$BOOL_EXECUTE_JOB_POSTPROCESSING=false;
					$BOOL_EXECUTE_JOB_PARENT_MERGING=false;
					$BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS=false;
					$BOOL_EXECUTE_MERGING=false;
					$BOOL_FIND_NEW_JOB=false;	
					$new_job_news=new job_new();
					$new_job_news->id_user=$running_job->id_user;
					$new_job_news->id=$running_job->id;
				}
				
				
				if ($running_job->id!="undefined" && !$JOB_FAILED)
				{
					logger("\tPRE-EXISTING JOB BEING RESTARTED:\n\t".$running_job->id."\n");
					$running_job->update( array("id_status"=>"new","dt_created"=>$this_epoch_time,"dt_modified"=>$this_epoch_time) );
					// CLEAR JOB FLAGS
					$running_job->delete_job_flags();
					
					logger("DELETING ANY EXISTING DESCENDANT JOBS\n");
					// CLEAR PH_* ENTRIES
					$running_job->delete_ph_decendants();
					$running_job->delete_job_new();
					
					$this_epoch_time=get_time();
					
				} // END IF (VALID JOB)
			} // END FOREACH (EACH ALREADY RUNNING JOB)
		} // END IF (COUNT OF ALREADY RUNNING JOBS)

		// SERVER IS OFFLINE...WAIT THEN EXIT
		// RESTART NOW (AND NOT EARLIER) SO THAT INTERRUPTED RUNNING AND PAUSED JOBS CAN BE RESOLVED
		if ($user_server->int_online!='1')
		{
			logger( "SERVER IS CURRENTLY OFFLINE.  CHECKING AGAIN IN 30 SECONDS...");
			sleep(30);
			exit;
		}


		$do_merge_pauses_occasionally = true; // $server_loop_idx % 2 == 0 && $server_loop_idx>0;

		$merging_pickup_time = 30 * 2;
		
		// CONTINUE MERGING PREVIOUSLY INTERRUPTED 'PAUSED' MERGES
		if ($BOOL_EXECUTE_MERGING && isset($existent_statuses["merging"]) && $do_merge_pauses_occasionally)
		{
			if ( $unfinished_jobs && count($unfinished_jobs) > 0 )
			{

				foreach ($unfinished_jobs as $unfinished_job)
				{
					if (explode("#",$unfinished_job['id_status_job'])[0]=="merging")
					{
						logger("FOUND A 'MERGING' LEAF NODE (INTERRUPTED PARENT JOB OUTPUT MERGE)\nRESUMING MERGE ON JOB:...\n");
						logger("\t".explode("#",$unfinished_job['id_status_job'])[1]."\n");
						// START AS CHILD OF THE LAST PAUSED LEAF NODE, IF THAT CHILD IS "DONE"
						$THIS_PLACEHOLDER = new ph_child();
						$all_child_jobs_by_parent = $THIS_PLACEHOLDER->get_from_hashrange(explode("#",$unfinished_job['id_status_job'])[1]);
						//print_r($all_child_jobs_by_parent);
						/*
						// WE CAN ALREADY PRESUME ALL SIBLING JOBS ARE DONE
						$all_are_done_status = true;
						foreach ($all_child_jobs_by_parent as $the_child_job)
						{
						}*/
						//print_r($THIS_PLACEHOLDER);
						//echo "THIS PLACEHOLDER:\n";
						//print_r($THIS_PLACEHOLDER);
						if ($THIS_PLACEHOLDER->id_parent_job!='undefined')
						{
							$CHILD_JOB = new job_id_user();
							$CHILD_JOB->get_from_hashrange($check_user->id_user,$THIS_PLACEHOLDER->id_child_job);
							
							$timespan=(intval(get_time())-intval($CHILD_JOB->dt_modified));
							if ($timespan>$merging_pickup_time)
							{
								//echo "CHILD JOB:\n";
								//print_r($CHILD_JOB);
								if ($CHILD_JOB->id!="undefined")
								{
									if ($CHILD_JOB->id_status=="merging")
									{
										$BOOL_FIND_NEW_JOB=false;
										$BOOL_EXECUTE_JOB_PREPROCESSING=false;
										$BOOL_EXECUTE_JOB_EXECUTION=false;
										$BOOL_EXECUTE_JOB_POSTPROCESSING=false;
										$BOOL_EXECUTE_JOB_PARENT_MERGING=true;
										$BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS=true;
										
										$new_job_news->id_user = $check_user->id_user;
										$new_job_news->id = $CHILD_JOB->id;
										break;
									
									} // END IF (CHILD JOB == DONE)
								
								} // END IF (CHILD JOB EXISTS)
								
							} // MERGING PICKUP TIME (START MERGING OLD JOBS)
						} // END IF (PH_PARENT LOOKUP IS VALID)
					} // END FOREACH (EACH UNFINISHED JOB)
				
				} // END FOREACH (UNFINISHED JOB)		
			
			} // END IF
		} // END IF
		
		// SEND SERVER LOG UPDATES
		if ( $log_updated && isset($user_server) )
		{
			$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
			if ( isset($user_server) )
			{
				$user_server->build();
				$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
				$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
				$log_updated=false;
			}
		} // END IF (ANY NEW LOG ENTRIES TO SEND)
		// EXIT IF SERVER VERSION MISMATCH
		if ($database_version != $software_version)
		{
			sleep(30);
			exit;
		}		
		
		// TRY TO COLLECT NEW JOB INFO
		if ($BOOL_FIND_NEW_JOB)
		{
			if ($APP['ms']->kind!="no-messaging")
			{
				//echo "CHECKING MESSAGES on "."sendto_".$INSTANCE_NAME;
				$message = $new_job_news->receive("sendto_".$INSTANCE_NAME);
				//echo "MESSAGE:";
				//echo($message);
				if ($message)
				{
					if ( isset($message) )
					{
						if ($message."" == "" || strlen($message."")==0)
						{
							continue;
						}
						//echo "READING";
						$message_xml= xmlToArray( simplexml_load_string($message) );
						$new_job_news->fromobjectxml($message_xml);
						//print_r($new_job_news);
					}
					else
					{
					}
				}
			}
			else
			{
				$max_new_jobs_collection = 10;
				
				$stop_looking_for_new_job = false;
				
				while (!$stop_looking_for_new_job)
				{
					$all_new_jobs = $new_job_news->get_from_hashrange($id_user,$INSTANCE_NAME."@","BEGINS_WITH",$max_new_jobs_collection);
					
					if ($all_new_jobs)
					{
						$job_count = 0;
						foreach ($all_new_jobs as $each_new_job)
						{
							$FIND_JOB=new job_id_user();
							$FIND_JOB->get_from_hashrange($new_job_news->id_user,$each_new_job['id']);
							if ($FIND_JOB->id!="undefined")
							{
								$job_count = $job_count + 1;
								$new_job_news->set($each_new_job);
								$stop_looking_for_new_job=true;
								break;
							}
						} // END FOR
						if ($max_new_jobs_collection==0)
						{
							$stop_looking_for_new_job=true;
						}
						if ($job_count==0)
						{
							$new_job_news=new job_new();
							$max_new_jobs_collection=0;
						}
					} // END IF
					else
					{
						$new_job_news=new job_new();
						$stop_looking_for_new_job=true;
						break;
					}
					sleep(5);
				
				} // END WHILE (LOOKING FOR A NEW JOB)
				
			} // END IF
			
			$do_reassign_occasionally = $server_loop_idx % 10 == 0 && $server_loop_idx>0;
			$is_reassign_server = false;

			$assigner_setting = new sys_setting();
			$assigner_setting->get_from_hashrange("jobcluster-".substr($id_user,0,10),"reassigner");			
			if ($assigner_setting->val=="undefined")
			{
				$assigner_setting->create( array("category"=>"jobcluster-".substr($id_user,0,10),"param"=>"reassigner","val"=>$INSTANCE_NAME) );
			}

			$assigner_setting->get_from_hashrange("jobcluster-".substr($id_user,0,10),"reassigner");			
			if ($assigner_setting->val==$INSTANCE_NAME)
			{
				$is_reassign_server=true;
			}
			
			$check_reassigner = new user_server();
			$check_reassigner->get_from_hashrange($id_user,$assigner_setting->val);
			if ($check_reassigner->name!="undefined")
			{
				$the_time = get_time();
				if (intval($the_time)-intval($check_reassigner->last_ping)>$reassign_ping_max_limit_seconds)
				{
					$assigner_setting->update(array("val"=>$INSTANCE_NAME));			

					$user_servers = new user_server();
					$all_user_servers = $user_servers->get_from_hashrange($id_user);
					$ready_servers = array();
					if ($all_user_servers)
					{
						foreach ($all_user_servers as $each_user_server)
						{
							if ($each_user_server->is_busy=="0" && $each_user_server->int_online=="1")
							{
								$ready_servers[] = $each_user_server;
							}
						}
					}
					if (count($ready_servers)>0)
					{
						usort($ready_servers,"lastpingordersort");
						$assigner_setting->update(array("val"=>$ready_servers['name']));			
					}
					
				} // END IF (CURRENT REASSIGNER HAS NOT PINGED IN THE PAST 5 MINUTES)
			} // END IF (REASSIGNER IS REAL)
			else
			{
				$assigner_setting->update(array("val"=>$INSTANCE_NAME));			
			}
			
			// RE-ASSIGN WAITING JOBS IF THIS SERVER HAS NO JOBS OF ITS OWN TO PROCESS
			if ( ($new_job_news->id_user=="undefined"||$new_job_news->id_user=="") && $do_reassign_occasionally && $is_reassign_server)
			{
				//$JOB->update(array("id_status"=>"failed"));


				$SECONDS_SINCE_EPOCH=get_time();
				$user_server_update = new user_server();
				$user_server_update->get_from_hashrange($id_user,$INSTANCE_NAME);
				$user_server_update->update(array("last_ping"=>$SECONDS_SINCE_EPOCH,"is_busy"=>"0"));
				
				$user_servers=array();
				$user_server_check = new user_server();

				// LIST OF ALL JOB SERVERS
				$user_server_checks = $user_server_check->get_from_hashrange($id_user);
				
				// HOW MANY NON-BUSY JOB SERVERS
				$not_busy_servers = array();
				foreach ($user_server_checks as $user_server_check)
				{
					if (isset($user_server_check['is_busy']))
					{
						if ($user_server_check['is_busy'].""!="1")
						{
							$not_busy_servers[] = $user_server_check;
						}
					}
				}
				

				// HOW MANY OTHER NON-BUSY JOB SERVERS (INC. THIS ONE) WERE LAST SEEN IN THE PAST 30 SECONDS			
				$server_second_timerange = 30;
				$current_not_busy_servers = array();
				foreach ($not_busy_servers as $not_busy_server)
				{
					$timespan=(intval(get_time())-intval($not_busy_server['last_ping']));
					if ($timespan<$server_second_timerange||$INSTANCE_NAME==$not_busy_server['name'])
					{
						$current_not_busy_servers[]=$not_busy_server;
					}
				}

				//   SORT THIS LIST
				usort($current_not_busy_servers,"nameindexordersort");
				usort($current_not_busy_servers,"lastpingordersort");

				$current_not_busy_servers_by_name=array();
				foreach ($current_not_busy_servers as $current_not_busy_server)
				{
					$current_not_busy_servers_by_name[$current_not_busy_server['name']]=$current_not_busy_server;
				}
				//echo "CURRENT NOT BUSY SERVERS:";print_r($current_not_busy_servers_by_name);

				$reassign_jobs_older_than_seconds = 60*60; // 1 hour


				$assigned_servers = array();
				//echo "FIRST SERVER:".$current_not_busy_servers[0]['name'];
				//   IS THIS SERVER THE FIRST IN THE LIST?
				if ( count($current_not_busy_servers)>0 ) //&& $INSTANCE_NAME==$current_not_busy_servers[0]['name'] )
				{
					//echo "HOW MANY WAITING JOBS?";
					// HOW MANY WAITING JOBS
					$get_jobs = new job_new();
					$all_jobs = $get_jobs->get_from_hashrange($id_user);
					//echo "THIS IS REASSIGNER NODE";

					$first_list_length = 3;
					$first_server_jobs=array();

					if ( count($user_servers) == count($not_busy_servers) )
					{
						$first_list_length = 0;
					}

					if ( $all_jobs )
					{
						foreach ($all_jobs as $each_job)
						{
							$job_id = $each_job['id'];
							
							$server_name_split = explode("@",$job_id);
							$server_name=$server_name_split[0];
							
							if ( !isset($first_server_jobs[$server_name]) )
							{
								$first_server_jobs[$server_name]=array();
							}
							if (count($first_server_jobs[$server_name])<$first_list_length)
							{
								$first_server_jobs[$server_name][]=$job_id;
							}
						}
					}
					
						
					foreach ($user_server_checks as $user_server_check)
					{
						if (isset($user_server_check['is_busy']))
						{
							if ($user_server_check['int_online'].""=="0")
							{
								unset($first_server_jobs[ $user_server_check['name'] ]);
							}
						}
					}
					
					$dont_reassign_these_jobs = array();
					foreach ($first_server_jobs as $first_server_next_jobs)
					{
						$dont_reassign_these_jobs=array_merge($dont_reassign_these_jobs,$first_server_next_jobs);
					}
					
					$new_jobs = array();
					if ( $all_jobs )
					{
						foreach ($all_jobs as $each_job)
						{
							$each_job_field = job_id_user();
							$each_job_field->get_from_hashrange($id_user,$each_job['id']);
							// HOW MANY WAITING JOBS HAVE WERE MODIFIED LONGER THAN 30 SECONDS AGO
							$timespan=(intval(get_time())-intval($each_job_field->dt_modified));
							if ($timespan>$reassign_jobs_older_than_seconds)
							{
								if ( !in_array($each_job['id'],$dont_reassign_these_jobs) )
								{
									$new_jobs[]=$each_job_field;
								}
							}
						}
					}
					
					//usort($new_jobs,"jobmodifiedordersort");
					
					////$new_jobs = array_reverse($new_jobs);
					
					//echo "NEW JOBS:";print_r($new_jobs);
					// HOW MANY OF THE WAITING JOBS CAN BE REASSIGNED
					$reassignable_jobs = array();
					
					if ( count($new_jobs) > 0 )
					{
						$new_job=$new_jobs[rand(0,count($new_jobs)-1)];
					
						$job_assign_hf = $new_job['id_hf'];
						
						$job_reassign_attempt=new job_id_user();
						$job_reassign_attempt->get_from_hashrange($id_user,$job_assign_hf);
						
						$was_reassigned=false;
						if ($job_reassign_attempt->id!="undefined")
						{
							$was_reassigned = $job_reassign_attempt->reassign_auto();
						}
						if ($was_reassigned)
						{
							logger( "\tJOB REASSIGNED\n" );
						}
						
					} // END IF (ANY NEW JOBS TO REASSIGN)
				} // IS THIS THE RE-ASSIGNER SERVER

				// SKIP EVERYTHING ELSE, GO BACK TO BEGINNING TO RE-CHECK FOR NEW JOBS ASSIGNED TO THIS SERVER
				continue;

			} // END IF (NO NEW JOBS AVAILABLE)

		} // END IF (BOOL_FIND_NEW_JOB IS TRUE)
		
		// PROCESS NEW JOB - MAKE SURE IT IS CURRENTLY MARKED AS "NEW"
		$JOB=new job_id_user();
		$idx=0;
		// COLLECT THE REST OF THE JOB INFO
		$failed_to_find_job=false;
		while ($JOB->id=="undefined")
		{
			if ($idx>0)
			{
				sleep(1);
			}
			if ($idx>5)
			{
				//logger("RECEIVED NEW JOB SUBMISSION:\n\t".$INSTANCE_NAME."@".$new_job_news->id."\n\t"."BUT THERE IS NO JOB_ID_USER ENTRY FOR THAT JOB ID\n");
				//print_r($JOB);
				$failed_to_find_job=true;
				break;
			}
			$JOB->get_from_hashrange($new_job_news->id_user,$new_job_news->id); // change to drive off of ip address
			$idx = $idx + 1;
		} // END WHILE
		
		// SKIP THE REST IF UNABLE TO FIND A JOB BY THAT NAME
		if ($failed_to_find_job)
		{
			continue;
		}

		$assigner_setting = new sys_setting();
		$assigner_setting->get_from_hashrange("jobcluster-".substr($id_user,0,10),"reassigner");			
		if ($assigner_setting->val==$INSTANCE_NAME)
		{
			$user_server_reassigns=array();
			$user_server_reassign = new user_server();

			// LIST OF ALL JOB SERVERS
			$user_server_reassigns = $user_server_reassign->get_from_hashrange($id_user);
				
			// HOW MANY NON-BUSY JOB SERVERS
			$not_busy_servers = array();
			foreach ($user_server_reassigns as $user_server_reassign)
			{
				if (isset($user_server_reassign['is_busy']))
				{
					if ($user_server_reassign['is_busy'].""!="1")
					{
						$not_busy_servers[] = $user_server_reassign;
					}
				}
			}
				

			// HOW MANY OTHER NON-BUSY JOB SERVERS (INC. THIS ONE) WERE LAST SEEN IN THE PAST 30 SECONDS			
			$server_second_timerange = 30;
			$current_not_busy_servers = array();
			foreach ($not_busy_servers as $not_busy_server)
			{
				$timespan=(intval(get_time())-intval($not_busy_server['last_ping']));
				if ($timespan<$server_second_timerange||$INSTANCE_NAME==$not_busy_server['name'])
				{
					$current_not_busy_servers[]=$not_busy_server;
				}
			}

			//   SORT THIS LIST
			usort($current_not_busy_servers,"nameindexordersort");
			usort($current_not_busy_servers,"lastpingordersort");

			if ( count($current_not_busy_servers)>0 )
			{

				$assigner_setting->update(array("val"=>$current_not_busy_servers[0]['name']));//"jobcluster-".substr($id_user,0,10),"reassigner");			
			}

		} // END SECTION - CHANGE REASSIGNER


		// TODO: WHAT IF AN ENTIRE JOB SERVER MACHINE GOES OFFLINE?  NEED TIMEOUT CHANGE ASSIGNER FUNCTIONALITY

		// WAIT FOR JOB STATUS TO BE != UNDEFINED
		$JID=$JOB->id;
		$idx=0;
		while ($JOB->id_status=="undefined")
		{
			if ($idx>10)
			{
				break;
			}
			sleep(2);
			$JOB->get_from_hashrange($new_job_news->id_user,$INSTANCE_NAME.$new_job_news->id);
			$idx=$idx+1;
		}
		// JOB STATUS IS NOT "NEW" ANYMORE, SO SKIP THE JOB
		if ($JOB->id_status!="new" && !$JOB_FAILED)
		{
			if ($BOOL_FIND_NEW_JOB)
			{
				// FOUND A NEW JOB, BUT IT'S NOT NEW ANYMORE
				logger("\tJOB STATUS IS ".strtoupper($JOB->id_status)."\n\t\tSKIPPING JOB $JID\n");
				$JOB->delete_job_new();
				continue;
			}
		}
		
		if ($JOB->id_user=="undefined"||$JOB->id_user=="")
		{
			//echo "JOB IS BLANK";
			//$JOB->update(array("id_status"=>"failed"));
			continue;
		}

		if ($BOOL_EXECUTE_JOB_PREPROCESSING)
		{
			// BUILD JOB (EXCLUDE HF OBJECT BECAUSE WE WANT TO FIRST COLLECT THE JOB'S REQUEST DATA)
			$JOB->build(array("obj_response","obj_hf","obj_output","obj_user"));

			$rqdata=$JOB->obj_rqdata->body;
			$requestdata=base64_decode($rqdata);
			$requestdata=unserialize($requestdata);
			$the_post=$requestdata['post'];
			$the_post_encoded = http_build_query($the_post);
			$_POST=$the_post;
		}
		
		// BUILD JOB (INCLUDE HF THIS TIME)
		$JOB->build(array("obj_response","obj_output","obj_user"));
		
		logger( "OBSERVING JOB #".$JOB->id."\n" );
		

		global $adjacent_dictionary;
		$adjacent_dictionary=array();

		if ($BOOL_EXECUTE_JOB_PREPROCESSING)
		{
			// DELETE JOB_NEW ENTRY
			$JOB->delete_job_new();

			// UPDATE NODE IN THE NODE LIST
			$user_server->update(array("is_busy"=>"1"));
			
			$this_time_epoch = get_time();
			
			$this_try = intval($JOB->int_try);
			$this_try = $this_try+1;
			
			$JOB->update(array("id_status"=>"running","dt_modified"=>$this_time_epoch,"int_try"=>$this_try));
			
			// CHANGE JOB STATUS
			logger( "\t" . "PROCESSING JOB #" . $JOB->id. "\n");
			logger( "\t" . "UPDATING JOB STATUS TO \"RUNNING\" \n" );

			$TEMP_DIR = "/tmp";
			if ($IS_WINDOWS)
			{
				//$TEMP_DIR=exec("echo %TEMP%");
				$TEMP_DIR=$GLOBALS['settings']['server']['temp']['win']['@attributes']['value'];
			}
			else
			{
				$TEMP_DIR=$GLOBALS['settings']['server']['temp']['linux']['@attributes']['value'];
			}
			if ( ! file_exists($TEMP_DIR) )
			{
				logger( "\t" . "CREATING TEMP FOLDER\n");
				mkdir($TEMP_DIR,0774,true);
			}
			
			// CREATE MAIN JOBS FOLDER
			$JOBS_FOLDER =  $TEMP_DIR.$PATH_SEPERATOR. "jobs" ;
			if ( ! file_exists($JOBS_FOLDER) )
			{
				logger( "\t" . "CREATING JOB FOLDER\n");
				mkdir($JOBS_FOLDER);
			}
			// IF JOB_FOLDER ALREADY EXISTS, CLEAN IT UP
			$JOB_FOLDER = ($JOBS_FOLDER.$PATH_SEPERATOR.$JID);
			if ( file_exists($JOB_FOLDER) )
			{
				$LIST_OF_FILES=array();
				if ($handle = opendir($JOB_FOLDER))
				{
					while (false !== ($entry = readdir($handle)))
					{
						if ($entry != "." && $entry != "..")
						{
							//$LIST_OF_FILES[]=$entry;
							try
							{
								$delete_file=join_paths($JOB_FOLDER,$entry);
								if ( is_dir($delete_file) )
								{
									delTree($delete_file);
								}
								else
								{
									unlink($delete_file);
								}
							}
							catch (Exception $e)
							{
							}
						}
					}
					closedir($handle);
				} // end if (dir)
				try
				{
					@rmdir($JOB_FOLDER);
				}
				catch (Exception $e)
				{
				}
			}
			// CREATE JOB_FOLDER
			if (! file_exists($JOB_FOLDER) )
			{
				logger( "\t" . "CREATING JOB FOLDER\n");
				mkdir($JOB_FOLDER);
			}

			logger( "\t\t" . "HF ID: " . ($JOB->id_hf)."\n" );
			
			logger( "\t" . "RUNNING BATCH JOB\n");
			$CD_ADD="";
			if ($IS_WINDOWS)
			{
				$CD_ADD="/d ";
			}
			//$BATCH_FILE = ($JOB_FOLDER.$PATH_SEPERATOR. "run.".$bext);

			echo "\tCOPYING UPLOADED FUNCTION FILES:\n";
			foreach ($JOB->obj_hf->obj_hf_files as $hf_file)
			{
				$url_path=$hf_file->obj_file->val;
				$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
				$dl_key = $APP['fs']->url_to_key($bucket_name,$url_path);
				$filepath=$JOB_FOLDER.$PATH_SEPERATOR.$hf_file->value;
				$APP['fs']->download_object($bucket_name,$dl_key,$filepath);

				/*
				$fp = fopen($filepath, 'wb');
				fwrite($fp, $hf_file->obj_file->body);
				fclose($fp);
				*/
			}

			$BATCH_PREPEND="";
			$BATCH_PREPEND=$BATCH_PREPEND."cd $CD_ADD".q($JOB_FOLDER)."\n";

			$BATCH_FILE="";

			logger( "\t" . "DOING REQUEST TEXT REPLACEMENTS\n" );
			logger("\tINHERITED RESOURCES:\n");
			foreach ($JOB->obj_hf->obj_hf_resources as $hf_resource)
			{
				$BOOL_IS_CORRECT_SYSTEM_KIND = False;
				if ( count($hf_resource->obj_system_kinds) == 0 )
				{
					$BOOL_IS_CORRECT_SYSTEM_KIND=True;
				}
				foreach ($hf_resource->obj_system_kinds as $hf_sk)
				{
					if ($hf_sk->id_sk=="any")
					{
						$BOOL_IS_CORRECT_SYSTEM_KIND = True;
						break;
					}
					else
					{
						$a_sys_kind=new user_system_kind();
						$a_sys_kind->get_from_hashrange($JOB->id_user,$hf_sk->id_sk);
						if ( strpos(php_uname("a"),$a_sys_kind->detection_text)!==False )
						{
							logger("\tSYSTEM KIND ".$a_sys_kind->name." DETECTED\n");
							$BOOL_IS_CORRECT_SYSTEM_KIND = True;
							break;
						}
					}
				}
				if (!$BOOL_IS_CORRECT_SYSTEM_KIND)
				{
					logger("\tINCORRECT SYSTEM KIND FOR FILE ".$hf_resource->value_filename."\n");
				}
				else
				{
					if ( isset($hf_resource->obj_inherited) )
					{
						if ($hf_resource->obj_inherited )
						{
							if ((!isset($hf_resource->obj_overridden))||( isset($hf_resource->obj_overridden) && !$hf_resource->obj_overridden ))
							{
								$filename_txt=$hf_resource->value_filename;
								$filename_txt=str_replace("/","",$filename_txt);
								$filename_txt=str_replace("\\","",$filename_txt);
								$filename_txt=str_replace(":","",$filename_txt);
								$filename_txt=replace_hf_parameters($filename_txt,$JOB->obj_hf->obj_hf_parameters);
		
								$location_txt=$hf_resource->value_location;
		
								$is_run_file=false;
								if ( strpos(strtolower($filename_txt),"run")!==FALSE )
								{
									$BATCH_FILE=$JOB_FOLDER."/".$filename_txt;
									$location_txt=$BATCH_PREPEND.$location_txt;
									$is_run_file=true;
								}
								
								$location_txt = str_replace("[JID]", $JID, $location_txt);
								$location_txt = str_replace("[JOB_FOLDER]", $JOB_FOLDER, $location_txt);
								$location_txt = str_replace("[SERVERBINS]", dirname(dirname(__file__))."/serverbins-$oss/", $location_txt);
								$location_txt = str_replace("[USERNAME]", $SERVER_USERNAME, $location_txt);

								$location_txt = str_replace("[HISGETPOST]", $the_post_encoded,$location_txt);
								$location_txt = str_replace("[SERVER_ARCHITECTURE]", $INT_32_OR_64, $location_txt);
								
								
								
								$location_txt=replace_hf_parameters($location_txt,$JOB->obj_hf->obj_hf_parameters);
								
								if ($is_run_file && $IS_WINDOWS)
								{
									$location_txt = str_replace("%", "%%", $location_txt);
								}
								$location_txt = str_replace("[PERCENT]", "%", $location_txt);
								$location_txt = str_replace("\r\n", "\n", $location_txt);
			
								logger("\t\tFILENAME: $filename_txt\n\t\tTEXT: ".substr($location_txt,0,200)."\n");
								file_put_contents($JOB_FOLDER."/".$filename_txt,$location_txt); //FILE_APPEND
							}
							else
							{
								logger("\t\tFILENAME: ".$hf_resource->value_filename." IS OVERRIDDEN (NOT WRITTEN)\n");
							}
						}
					} // is inherited
				}
			}
			logger("\tNON-INHERITED RESOURCES:\n");
			foreach ($JOB->obj_hf->obj_hf_resources as $hf_resource)
			{
				/*
				if (isset($hf_resource->obj_overpowering))
				{
					if ($hf_resource->obj_overpowering)
					{
						continue;
					}
				}
				*/
				$BOOL_IS_CORRECT_SYSTEM_KIND = False;
				if ( count($hf_resource->obj_system_kinds) == 0 )
				{
					$BOOL_IS_CORRECT_SYSTEM_KIND=True;
				}
					foreach ($hf_resource->obj_system_kinds as $hf_sk)
					{
							if ($hf_sk->id_sk=="any")
							{
								$BOOL_IS_CORRECT_SYSTEM_KIND = True;
								break;
							}
							else
							{
								$a_sys_kind=new user_system_kind();
								$a_sys_kind->get_from_hashrange($JOB->id_user,$hf_sk->id_sk);
								if ( strpos(php_uname("a"),$a_sys_kind->detection_text)!==False )
								{
									logger("\tSYSTEM KIND ".$a_sys_kind->name." DETECTED\n");
									$BOOL_IS_CORRECT_SYSTEM_KIND = True;
									break;
								}
							}
					}
				if (!$BOOL_IS_CORRECT_SYSTEM_KIND)
				{
					logger("\tINCORRECT SYSTEM KIND FOR FILE ".$hf_resource->value_filename."\n");
				}
				else
				{
					if ( !isset($hf_resource->obj_inherited) || (isset($hf_resource->obj_overpowering) && $hf_resource->obj_overpowering) )
					{
						$filename_txt=$hf_resource->value_filename;
						$filename_txt=str_replace("/","",$filename_txt);
						$filename_txt=str_replace("\\","",$filename_txt);
						$filename_txt=str_replace(":","",$filename_txt);
						//$filename_txt=replace_hf_parameters($filename_txt,$JOB->obj_hf->obj_hf_parameters);

						$location_txt=$hf_resource->value_location;
						
						$is_run_file=false;
						if ( strpos(strtolower($filename_txt),"run")!==FALSE )
						{
							$BATCH_FILE=$JOB_FOLDER."/".$filename_txt;
							$location_txt=$BATCH_PREPEND.$location_txt;
							$is_run_file=true;
						}
						
						$location_txt = str_replace("[JID]", $JID, $location_txt);
						$location_txt = str_replace("[JOB_FOLDER]", $JOB_FOLDER, $location_txt);
						$location_txt = str_replace("[SERVERBINS]", dirname(dirname(__file__)).DIRECTORY_SEPARATOR."serverbins-$oss", $location_txt);
						$location_txt = str_replace("[USERNAME]", $SERVER_USERNAME, $location_txt);

						$location_txt = str_replace("[HISGETPOST]", $the_post_encoded,$location_txt);
						$location_txt = str_replace("[SERVER_ARCHITECTURE]", $INT_32_OR_64, $location_txt);
						
						//$location_txt=replace_hf_parameters($location_txt,$JOB->obj_hf->obj_hf_parameters);

						if ($is_run_file && $IS_WINDOWS)
						{
							$location_txt = str_replace("%", "%%", $location_txt);
						}
						$location_txt = str_replace("[PERCENT]", "%", $location_txt);
						$location_txt = str_replace("\r\n", "\n", $location_txt);
		
						logger("\t\tFILENAME: $filename_txt\n\t\tTEXT: ".substr($location_txt,0,200)."\n");
						file_put_contents($JOB_FOLDER."/".$filename_txt,$location_txt); //FILE_APPEND
					} // is not inherited
				} // is correct os
			}
			if ( file_exists($BATCH_FILE) )
			{
				logger("\tSETTING PERMISSIONS ON\n\t\t$BATCH_FILE\n");
				if (!$IS_WINDOWS)
				{
					system("chmod +x $BATCH_FILE");
				}
			}
		
			logger( "\t" . "JOB FILES HAVE BEEN WRITTEN\n");
			logger( "\t\t" . $JOB_FOLDER."\n");

		} // END IF ($BOOL_EXECUTE_JOB_PREPROCESSING)

		
		$JOB_RESULT_PARSING = true;
		if (!$BOOL_EXECUTE_JOB_EXECUTION)
		{
			$JOB_RESULT_PARSING=false;
		}
		
		
		// EXECUTE THE JOB
		if ($BOOL_EXECUTE_JOB_EXECUTION)
		{
		
			// COLLECT NAMES OF FILES THAT EXIST IN JOB_FOLDER BEFORE JOB IS RUN
			$LIST_OF_PRE_JOB_FOLDER_FILES=array();
			

			
			if ($handle = opendir($JOB_FOLDER))
			{
				while (false !== ($entry = readdir($handle)))
				{
					if ($entry != "." && $entry != "..")
					{
						$LIST_OF_PRE_JOB_FOLDER_FILES[]=$entry;
					}
				}
				closedir($handle);
			} // end if (dir)
			
			
			// RUN THE JOB (RUN.BAT MOST OF THE TIME)
			$STDOUT = "";

		
	
			logger( "\tRUNNING SCRIPT\n");

			// SEND LOG UPDATES
			if ( $log_updated && isset($user_server) )
			{
				$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
				if ( isset($user_server) )
				{
					$user_server->build();
					$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
					$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
					$log_updated=false;
				}
			} // end if (any new log entries to send)

			$kill_array=array();
			if ( isset($JOB->obj_hf->obj_hf_kill) )
			{
				foreach ($JOB->obj_hf->obj_hf_kill as $a_kill)
				{
					$kill_array[]=$a_kill->value;
				}
			}
			
			// START JOB PROCESS
			$STDOUT="";
			$STDRETURN=0;
			//exec ( $BATCH_FILE, $STDOUT, $STDRETURN );

			$PROCESS_MANAGER->path = $JOB_FOLDER;
			$PROCESS_MANAGER->processes = 1;
			$PROCESS_MANAGER->addScript($BATCH_FILE, $JOB->obj_hf->int_maxruntime);
			$PROCESS_MANAGER->exec($kill_array,$IS_WINDOWS);

			// MOVED THESE 2 LINES UP
			//$JOB_FAILED = false;
			//$JOB_FAIL_STATUS = "failed";
			
			// IF PROCESS HAD TO BE KILLED & MAX-TIME FAILURE IS TURNED ON, DO NOT FURTHER PROCESS JOB
			if ($PROCESS_MANAGER->killed && intval($JOB->obj_hf->int_mtf)==1)
			{
				$JOB_RESULT_PARSING=false;
				$BOOL_EXECUTE_JOB_EXECUTION = false;
				$BOOL_EXECUTE_JOB_POSTPROCESSING = false;
				$BOOL_EXECUTE_JOB_PARENT_MERGING = false;
				$BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS = false;
			}
			
			// GET RESULTS
			// GET A LIST OF FILES CURRENTLY IN FOLDER

			// COLLECT JOB CONTENT
			//$OUTPUT_CONTENT = "";

			# WHICH FILE IS NEW?
			#  stop on the first new file we find (how to handle multiple downloaded files in the future?)
			$NEW_FILENAMES = array();

			# DETERMINE WHICH FILE IS NEW
			$POST_JOB_FILE_LIST = array();
			if ($JOB_RESULT_PARSING)
			{
				if ($handle = opendir($JOB_FOLDER) ) {
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							$POST_JOB_FILE_LIST[]=$entry;
						}
					}
					closedir($handle);
				}
			}
			natsort($POST_JOB_FILE_LIST);
			foreach ($POST_JOB_FILE_LIST as $POST_FILE)
			{
				$FOUND_FILE_IN_PRE = False;
				foreach ($LIST_OF_PRE_JOB_FOLDER_FILES as $PRE_FILE)
				{
					if (trim($PRE_FILE) == trim($POST_FILE) )
					{
						$FOUND_FILE_IN_PRE = True;
						// FUTURE TODO? MULTIPLE FILES...
						break;
					}
				}
				if (!$FOUND_FILE_IN_PRE)
				{
					/*
					if ( strstr($POST_FILE,"error.txt") )
					{
						if ( file_exists($JOB_FOLDER.$PATH_SEPERATOR."output.txt") )
						{
							if ( strlen(file_get_contents($JOB_FOLDER.$PATH_SEPERATOR."output.txt"))>0 )
							{
								$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.("output.txt");
								break;
							}
							else
							{
								$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.($POST_FILE);
								//break;
							}
						}
						else
						{
							$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.($POST_FILE);
							//break;
						}
					} // end if (wget)
					else
					{
						$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.($POST_FILE);
						//break;
					}
					*/
					$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.($POST_FILE);
				}
				//else
				//{
				//
				//	$NEW_FILENAMES[] = $JOB_FOLDER.$PATH_SEPERATOR.($POST_FILE);
				//	//break;
				//}
			} // END FOR

			if (count($NEW_FILENAMES)> 0 && $JOB_RESULT_PARSING)
			{
				foreach ($NEW_FILENAMES as $ANEW_FILENAME)
				{
					if (file_exists($ANEW_FILENAME) && !is_dir($ANEW_FILENAME) )
					{
						// NEW FILE CREATED
						logger( "\t" . "GATHERING FILE CONTENT FROM\n");
						logger( "\t" . "\t" . $ANEW_FILENAME."\n");
					}
				} // end foreach (new file)
			}
			else
			{
				//NO FILE CREATED
				// GET STDOUT
				logger( "\t\t" . "GATHERING STDOUT\n");
				if ( isset($PROCESS_MANAGER->pipes[0][1]) && isset($PROCESS_MANAGER->pipes[0][2]) )
				{
					$STDOUT = $PROCESS_MANAGER->pipes[0][1];
					if (strlen($PROCESS_MANAGER->pipes[0][2])> 0 || strlen($PROCESS_MANAGER->pipes[0][1])==0)
					{
						$STDOUT = $STDOUT.$PROCESS_MANAGER->pipes[0][2];
					}
				}
				//echo "STDOUT: ".$STDOUT;
				//echo "STDOUT: ".gettype($STDOUT);
				//echo "STDOUT: ".get_class($STDOUT);
				//if ( strpos($STDOUT,"\n")!==FALSE)
				//{
				$OUTPUT_CONTENT = $STDOUT; //implode("\n",$STDOUT);
				//}
				//else
				//{
				//	$OUTPUT_CONTENT = $STDOUT;
				//}
				logger( "\t\t" . strlen($OUTPUT_CONTENT) . " TOTAL CHARACTERS IN OUTPUT\n");

				$NEW_FILENAMES[] = ($JOB_FOLDER.$PATH_SEPERATOR. "output.txt");
				file_put_contents($NEW_FILENAMES[0],$OUTPUT_CONTENT);
			}
			if ( count($NEW_FILENAMES)>1 )
			{
				$ALL_CONTENT="";
				foreach ($NEW_FILENAMES as $ANEW_FILENAME)
				{
					if ( !is_dir($ANEW_FILENAME) )
					{
						$ALL_CONTENT=$ALL_CONTENT.file_get_contents($ANEW_FILENAME);
					}
				}
				$NEW_FILENAMES=$JOB_FOLDER.$PATH_SEPERATOR."output.txt";
				file_put_contents($NEW_FILENAMES,$ALL_CONTENT);
				$STDOUT = $ALL_CONTENT;
			}
			else
			{
				$NEW_FILENAMES=$NEW_FILENAMES[0];
				$ALL_CONTENT=$ALL_CONTENT.file_get_contents($NEW_FILENAMES);
				$STDOUT = $ALL_CONTENT;
			}
			
			$OUTPUT_CONTENT = "";

			// UPLOAD RESPONSE FILE TO FS
			if ($JOB_RESULT_PARSING)
			{
				// UPLOAD THESE NEW FILES, TO PRESERVE THEIR DATA
				// PLACE RESULT UPLOAD ALTERNATIVES HERE

				logger( "\tUPLOADING RESOURCE RESULT COLLECTED...\n");

				// S3 AND RACKSPACE
				$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['job-output']['@attributes']['value']."/".sha1(microtime().$JOB->id_hf);

				// Define a mebibyte
				//define('MB', 1024 * 1024);
				$uploaded_file_mime = "text/plain"; //"application/octet-stream";
				$uploaded_file_ext = "txt";
				$path_parts = pathinfo($NEW_FILENAMES);
				foreach ($STATIC['mime_types'] as $mime_key=>$mime_value)
				{
					if ( isset($path_parts['extension']) )
					{
						if ( strtolower($path_parts['extension']) == strtolower($mime_value) )
						{
							$uploaded_file_mime=$mime_key;
							$uploaded_file_ext=$mime_value;
							//echo "matched mime type: $mime_key with extension $mime_value";
							break;
						}
					}
				} // end foreach
				if ( strlen($uploaded_file_ext)==0 )
				{
					$uploaded_file_ext="txt";
				}
				$keyname=$keyname.".".$uploaded_file_ext;

				if ( $fs->connect() )
				{
					$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
					$file_upload_success=$fs->create_object(true,$bucket_name,$keyname,$NEW_FILENAMES,$uploaded_file_mime);
					if ($file_upload_success)
					{
						logger( "\tUPLOADED OUTPUT GENERATED BY JOB'S\n\t\tINPUT RESOURCE EXECUTION:\n".$NEW_FILENAMES."\n" );
					}
				} // end if (able to connect to file storage
				else
				{
				} // end else ( not able to connect to file storage )
				$FILE_LOCATION=$APP['fs']->key_url($bucket_name,$keyname);
				$OUTPUT_CONTENT = $FILE_LOCATION;
			
			}

			// NO OUTPUT?
			if ( strlen($OUTPUT_CONTENT) == 0 )
			{
				$OUTPUT_CONTENT = "no output from job";
			}

		} // END IF ($BOOL_EXECUTE_JOB_EXECUTION)
			
		//print_r($the_post);

		if ($BOOL_EXECUTE_JOB_POSTPROCESSING)
		{
			// RUN [C]XML AND OUTPUT EXPRS AFTER FILTERING AND GATHER
			if ( ( isset($the_post['cxml']) || isset($the_post['xml']) || ( isset($the_post['action']) && $the_post['action']=="regather-latest-cache" ) ) && $JOB_RESULT_PARSING  )
			{
				logger( "\t" . "ORIGINAL OUTPUT: \n".$OUTPUT_CONTENT."\n");
				logger( "\tGENERATING XML OR CXML MODE OUTPUT\n" );
				// RUN [C]XML OUTPUT & UPLOAD RESULT
				// only do if expression exists?
				if ( strlen(trim($JOB->obj_hf->obj_expression->value.""))>0 || isset($the_post['xml']) || isset($the_post['cxml']) || ( isset($the_post['action']) && $the_post['action']=="regather-latest-cache" )  )
				{
					// output_content is s3/rs filename
					// get file content
					// get job requestdata
					$get_str="";
					// build:
					// php -f somefile.php a=1 b[]=2 b[]=3
					// this loop will reproduce the same GET values given on the address bar, when we call this script on the system
					$_GET_ORIGINAL=$_GET;
					$_GET=Array();
					foreach ($the_post as $get_variable_key=>$get_variable_value)
					{
						// remove jidonly key so that we get actual output instead of only a job submission id value
						if ($get_variable_key!="jidonly"&&$get_variable_key!="--name"&&$get_variable_key!="action"&&$get_variable_key!="v")
						{
							$_GET[$get_variable_key]=$get_variable_value;
						}
						if ( isset($the_post['action']) )
						{
							if ($the_post['action']=="regather-latest-cache")
							{
								$_GET["cxml"]="";
							}
						}
					}
					$adjacent_dictionary=$default_adjacent_dictionary;
					$_GET['JID']=$JOB->id;
					$_GET['uid']=$JOB->id_user;
					$_GET['secret']=$check_user->secret;
					$_GET['url']=$OUTPUT_CONTENT;
					ob_start();
					include("index.php");
					$STDOUT=ob_get_clean();
					$_GET=$_GET_ORIGINAL;
					
					logger( "\t\t\t" . "INITIAL FILTERED OUTPUT: \n".substr($STDOUT,0,200)."\n");
					
					//if ( count($adjacent_dictionary)>0 )
					//{
					logger( "\tSAVING ADJACENT DICTIONARY TO JOB\n");
					$ad_data=array('ad'=>$adjacent_dictionary);
					$ad_encoded=base64_encode(serialize($ad_data));
					$JOB->update( array('str_ad'=>$ad_encoded) );
					//}
				}
				else
				{
					// blank expression & check binary compatibility
					$STDOUT = file_get_contents($NEW_FILENAMES);
					try
					{
						logger( "\t\t\t" . "INITIAL NON-FILTERED OUTPUT: \n\"".substr($STDOUT,0,200)."\"\n");
					}
					catch (Exception $e)
					{
					}
				}

				// UPLOAD THIS FILE TO THE SERVER, TO PRESERVE ITS DATA
				// S3/RS is currently used
				// place result upload alternatives here

				logger( "\tUPLOADING CXML OR XML MODE OUTPUT...\n");

				// S3 AND RACKSPACE
				$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
				$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['job-output']['@attributes']['value']."/".sha1(microtime().$JOB->id_hf."1");

				// Define a mebibyte
				//define('MB', 1024 * 1024);
				$uploaded_file_mime = "text/plain"; //"application/octet-stream";
				$uploaded_file_ext = "txt";
				foreach ($STATIC['mime_types'] as $mime_key=>$mime_value)
				{
					if ($JOB->obj_hf->id_mime_type==$mime_key)
					{
						$uploaded_file_mime=$mime_key;
						$uploaded_file_ext=$mime_value;
						break;
					}
				} // end foreach
				if ( strlen($uploaded_file_ext)==0 )
				{
					$uploaded_file_ext="txt";
				}
				if ( isset($the_post['xml']) )
				{
					$uploaded_file_mime="text/xml";
					$uploaded_file_ext="xml";
					$keyname=$keyname.".".$uploaded_file_ext;
				}
				else
				{
					$keyname=$keyname.".".$uploaded_file_ext;
				}

				if ( $APP['fs']->connect() )
				{
					$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
					$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,$STDOUT,$uploaded_file_mime);
					if ($file_upload_success)
					{
						logger( "\tUPLOADED FILTERING EXPRESSION TRANSFORMATION\n\t\tOF JOB RESPONSE\n" );
					}
					else
					{
						logger( "\tUPLOAD FAILURE\n" );
					}
				} // end if (able to connect to file storage
				else
				{
					logger( "\tUpload FAILED: unable to connect to file storage\n" );
					logger( "\t".var_dump($APP['fs'])."\n" );
				} // end else ( not able to connect to file storage )

				$OUTPUT_LOCATION=$APP['fs']->key_url($bucket_name,$keyname);
				// send value OUTPUT_LOCATION to JOBS db table
				if ( strlen($OUTPUT_LOCATION)>0 || isset($the_post['servercxo']) || isset($the_post['servercco']) )
				{
					$NEW_STRING=new strings();
					$sha1_string=sha1(microtime().$OUTPUT_LOCATION);
					$props=array();
					$props['id']=$sha1_string;
					$props['val']=$OUTPUT_LOCATION;
					$NEW_STRING->create($props);
					$JOB->update_raw(array("str_output"=>$NEW_STRING->id));
				}
				// END OF OUTPUT INSERTION INTO DB

				// IS CXO OR CCO TURNED ON? CREATE CACHE ENTRY, AND UPDATE HF_ID_USER TABLE
				if ( isset($the_post['servercxo']) || isset($the_post['servercco']) )
				{
					echo "\tCXO/CCO PROCESSING\n";
					$db_field="str_cache_out_xml";
					if ( isset($the_post['servercco']) )
					{
						$db_field="str_cache_out_cxml";
					}
					$JOB->obj_hf->update_raw(array($db_field=>$NEW_STRING->id));
				}
			} // end if (create output & upload)

			$run_output_expression_if_exists=false;
			$output_expression_jid=$JID;
			
			
			// SET SPECIAL JOB FLAGS - FAILURE, ETC
			if ($JOB_RESULT_PARSING)
			{
				$job_flag = new job_flag();
				$job_flags = $job_flag->get_from_hashrange($JID);
				if ($job_flags && is_array($job_flags) )
				{
					foreach ($job_flags as $a_flag)
					{
						if ($a_flag['id_job']!="undefined")
						{
							if ($a_flag['flag']=="failed")
							{
								logger( "\t" . "JOB FAILURE CONDITION FLAG DETECTED\n");
								$JOB_FAIL_STATUS = $a_flag['status'];
								$JOB_FAILED=true;
							}
						}
					}
				}
			
			}
		
		} // END IF ($BOOL_EXECUTE_JOB_POSTPROCESSING)

		if ($PROCESS_MANAGER->killed)
		{
			logger( "\tWARNING: PROCESS WAS KILLED BECAUSE OF TIME LIMIT\n" );
			if ( intval($JOB->obj_hf->int_mtf)==1 )
			{
				$JOB_FAILED=true;
				$JOB_FAIL_STATUS = "failed-maxruntimehit";
				//$this_time_epoch = get_time();
				//$JOB->update(array("id_status"=>"maxruntimehit","dt_done"=>$this_time_epoch,"dt_modified"=>$this_time_epoch));					
			}
		}

		// JOB FAILURE
		if ($JOB_FAILED)
		{
			logger( "\t" . "JOB #" . $JID . "\n\t\tMAY HAVE FAILED!!!\n");
			// CHANGE JOB STATUS
			$NEW_STRING=new strings();
			$sha1_string=sha1(microtime().$OUTPUT_CONTENT.rand(1,20));
			$props=array();
			$props['id']=$sha1_string;
			$props['val']=$OUTPUT_CONTENT;
			$NEW_STRING->create($props);
			
			if ( intval($JOB->int_try)<=intval($JOB->obj_hf->int_retry_count) || intval($JOB->obj_hf->int_retry_count)<0 )
			{
				// NEED TO DELETE OLD JOB_FLAG ENTRIES
				logger( "\tDELETING OLD JOB FLAGS\n");
				$old_job_flags = new job_flag();
				$all_old_flags = $old_job_flags->get_from_hashrange($JID);
				foreach ($all_old_flags as $an_old_flag)
				{
					$delete_job_flag = new job_flag();
					$delete_job_flag->set($an_old_flag);
					if ($delete_job_flag->id_job!="undefined")
					{
						$delete_job_flag->delete();
					}
				}
				logger( "\tRETRYING JOB...\n");

				// UPDATE JOB STATUS
				$this_time_epoch = get_time();
				$JOB->update(array("id_status"=>"new","dt_modified"=>$this_time_epoch,"dt_created"=>$this_time_epoch));
			}
			else
			{
				// UPDATE JOB STATUS TO FAILED
				$this_time_epoch = get_time();
				$JOB->update(array("id_status"=>$JOB_FAIL_STATUS,"dt_modified"=>$this_time_epoch,"dt_created"=>$this_time_epoch));
				$JOB->update_raw(array("str_response"=>$NEW_STRING->id));
			}
			$BOOL_EXECUTE_JOB_PARENT_MERGING=false;
			$BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS=false;
			$BOOL_EXECUTE_JOB_EXECUTION=false;
		} // END IF (JOB FAILURE)
		
		if ($BOOL_EXECUTE_JOB_PARENT_MERGING)
		{
			// JOB COMPLETION
			if (!$JOB_FAILED)
			{
				logger( "\t" . "JOB #" . $JID . " FINISHED\n");
				// CHANGE JOB STATUS

				logger( "\t" . "CHECKING FOR PLACEHOLDERS...\n");
				// WAS THIS A PARENT JOB BEING RUN, THAT CREATED PH_PARENT/CHILD ENTRIES?
				$THIS_PLACEHOLDER = new ph_parent();
				$THIS_PLACEHOLDER->get_from_hashrange($JOB->id);
				if ($THIS_PLACEHOLDER->id_parent_job!='undefined')
				{
					if ($JOB->id_status!="paused" && $JOB->id_status!="done")
					{
						// THIS WAS A PARENT JOB BEING RUN, THAT CREATED PH_PARENT/CHILD ENTRIES
						logger( "\t" . "THIS WAS A PARENT JOB BEING RUN, IT CREATED PH_PARENT/CHILD ENTRIES\n");
						$NEW_STRING=new strings();
						$sha1_string=sha1(microtime().$OUTPUT_CONTENT.rand(1,20));
						$props=array();
						$props['id']=$sha1_string;
						$props['val']=$OUTPUT_CONTENT;
						$NEW_STRING->create($props);
						$JOB->update_raw(array("str_response"=>$NEW_STRING->id));
						$JOB->update(array("id_status"=>"paused","dt_modified"=>get_time()));

						logger( "\t\t" ."SETTING STATUS TO 'PAUSED'". "\n");
					} // END IF (JOB IS NOT ALREADY PAUSED)
				}
				else
				{
					if ($JOB->id_status!="paused" && $JOB->id_status!="done")
					{
						logger( "\t" . "THIS WAS *NOT* A PARENT JOB BEING RUN, IT CREATED NO NEW PH_PARENT/CHILD ENTRIES\n");
						// THIS WAS *NOT* A PARENT JOB BEING RUN, NO PH_PARENT/CHILD ENTRIES CREATED
						$NEW_STRING=new strings();
						$sha1_string=sha1(microtime().rand(1,1000));
						$props=array();
						$props['id']=$sha1_string;
						$props['val']=$OUTPUT_CONTENT;
						$NEW_STRING->create($props);
						
						$this_time_epoch = get_time();
						$JOB->update_raw(array("str_response"=>$NEW_STRING->id));
						$JOB->update(array("id_status"=>"done","dt_modified"=>$this_time_epoch,"dt_done"=>$this_time_epoch));
						$JOB->delete_ph_decendants();
						logger( "\t\t" ."SETTING STATUS TO 'DONE'". "\n");
					}
				} // END IF - IS THIS JOB A PARENT JOB?

				// THIS "WHILE" ROUTINE WILL TAKE THIS COMPLETED JOB'S ID, AND IF JOB IS A CHILD JOB,
				//	CHECKS IF ALL SIBLING JOBS HAVE ALSO COMPLETED - IF THEY HAVE ALL COMPLETED,
				//	RUN A REPLACEMENT ROUTINE AGAINST THE JOB'S PARENT USING THE JOB'S
				//	SIBLINGS AS REPLACEMENTS FOR THE PARENT JOB'S PLACEHOLDER VALUES
				//	SET THE CURRENT JOB = PARENT JOB & REPEAT UNTIL TOP OF TREE IS REACHED
				//	OR NON-DONE JOB IS ENCOUNTERED
				$JID_MERGE_CHECK=$JOB->id;
				// 1. THIS LOOP WILL SCAN THROUGH A JOB'S SIBLINGS, AND IF ALL OF THEM ARE
				//	  ALSO IN A "DONE" STATE, WILL TAKE THE PARENT JOB'S OUTPUT,
				//	  AND MERGE ALL SIBLING OUTPUTS INTO THAT PARENT JOB'S PLACEHOLDERS
				//	  IT WILL THEN TREAT THE PARENT JOB AS THE CURRENT JOB , AND REPEAT STEP 1.
				// 2. IF THIS PARTICULAR JOB WAS THE LAST REMAINING JOB TO BE COMPLETED OUT OF A
				//	  COMPLEX TREE OF DESCENDANT JOBS, THEN THIS RECURSIVE JOB OUTPUT
				//	  PLACEHOLDER REPLACEMENT WILL EXTEND ALL THE WAY TO THE TOP/FIRST JOB
				while($JID_MERGE_CHECK!="undefined")
				{
					$pstring="";
					if ($JOB->id!=$JID_MERGE_CHECK || $BOOL_FIND_NEW_JOB)
					{
						$pstring="(PARENT JOB)";
					}
					logger( "\t" . $pstring." JID BEING MERGED: $JID_MERGE_CHECK\n");


					$THIS_JOB = new job_id_user();
					$THIS_JOB->get_from_hashrange($JOB->id_user,$JID_MERGE_CHECK);

					// WAS THIS A CHILD JOB BEING RUN TO FILL PH_PARENT/CHILD ENTRIES?
					$THIS_PLACEHOLDER = new ph_child();
					$THIS_PLACEHOLDER->get_from_hashrange($JID_MERGE_CHECK);
					if ($THIS_PLACEHOLDER->id_child_job!='undefined')
					{
						// THIS JOB WAS RUN TO FILL A PLACEHOLDER IN AN OUTPUT ENTRY FROM ANOTHER JOB
						logger( "\t\t" . "THIS JOB WAS RUN TO FILL A PLACEHOLDER IN AN OUTPUT ENTRY FROM ANOTHER JOB\n");

						$PARENT_JID=$THIS_PLACEHOLDER->id_parent_job;

						// HAVE ALL PLACEHOLDERS BEEN COMPLETED?
						$all_placeholder_check = new ph_parent();
						$ALL_PLACEHOLDERS = $all_placeholder_check->get_from_hashrange($PARENT_JID);
						$ALL_PLACEHOLDERS=array_reverse($ALL_PLACEHOLDERS);

						// IF ALL PLACEHOLDERS HAVE BEEN COMPLETED, CONDUCT A FULL TEXT REPLACE OF THE PLACEHOLDER VALUES WITH THE FINAL OUTPUTS IN THE ORIGINAL FUNCTION'S OUTPUT
						$ALL_PLACEHOLDERS_WITH_JOB_RESPONSE=array();
						$bool_all_jobs_completed=true;
						$count_placeholders = count($ALL_PLACEHOLDERS);
						$this_placeholder=1;
						
						$check_all_placeholders = true;
						foreach ($last_10_placeholder_merges as $a_last_10_merge)
						{
							if ($a_last_10_merge[0]==$PARENT_JID)
							{
								// last known "not done" job
								$LAST_NOT_DONE_JOB = new job_id_user();
								$LAST_NOT_DONE_JOB->get_from_hashrange($JOB->id_user,$ALL_PLACEHOLDERS[$a_last_10_merge[2]]['id_child_job']);
								if ($LAST_NOT_DONE_JOB->id_status!="done")
								{
									$check_all_placeholders = false;
									$bool_all_jobs_completed = false;
								}
							}
						}
						
						$apidx=0;
						if ($check_all_placeholders)
						{
							for ($apidx=$apidx;$apidx<count($ALL_PLACEHOLDERS);$apidx++)
							{
								$EACH_PLACEHOLDER = $ALL_PLACEHOLDERS[$apidx];
								
								//print_r($EACH_PLACEHOLDER);
								//	logger( "\t\t\t" . "WTF TEST\n");
								if ($EACH_PLACEHOLDER)
								{
									if ($this_placeholder%2000==0||$this_placeholder==1||$this_placeholder==count($ALL_PLACEHOLDERS))
									{
										// SEND LOG UPDATES
										if ( $log_updated && isset($user_server) )
										{
											$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
											if ( isset($user_server) )
											{
												$user_server->build();
												$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
												$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
												$log_updated=false;
											}
										} // end if (any new log entries to send)
									}

									//logger( "\t\t\t" . var_export($EACH_PLACEHOLDER,true)."\n");
									
									//logger( "\t\t\t" . "\t".var_export($EACH_PLACEHOLDER,true)."\n");
									$CHILD_JID=$EACH_PLACEHOLDER['id_child_job'];
									$CHILD_JOB = new job_id_user();
									$CHILD_JOB->get_from_hashrange($JOB->id_user,$CHILD_JID);
									
									logger( "\t\t\t" . "READING CHILD PLACEHOLDER JOB STATUS (".$this_placeholder."/".$count_placeholders."): ".$CHILD_JOB->id_status."\n");							
									//logger( "\t\t\t" . "\t".var_export($CHILD_JOB,true)."\n");
									if ($CHILD_JOB->id_status!='done' && $CHILD_JOB->id_status!='undefined')
									{
										$add_to_last_10=true;
										$l10idx=0;
										foreach ($last_10_placeholder_merges as $a_last_10)
										{
											if ($a_last_10[0]==$EACH_PLACEHOLDER['id_parent_job'])
											{
												break;
											}
											$l10idx=$l10idx+1;
										}
										$last_10_entry=array($EACH_PLACEHOLDER['id_parent_job'],$EACH_PLACEHOLDER['id_child_job'],$this_placeholder-1);
										if ($add_to_last_10)
										{
											array_unshift($last_10_placeholder_merges,$last_10_entry);
											$bool_all_jobs_completed=false;
											break;
										}
										else
										{
											// UPDATE LAST 10 ENTRY
											$last_10_placeholder_merges[$l10idx]=$last_10_entry;
											$this_last = array_slice($last_10_placeholder_merges,$l10idx,1);
											array_unshift($last_10_placeholder_merges,$this_last);
										}
										if ( count($last_10_placeholder_merges)>10 )
										{
											array_pop($last_10_placeholder_merges);
										}
									}
								}
								else
								{
									//logger( "\t\t\t" . "EMPTY PLACE WTF\n");
								}
								$this_placeholder=$this_placeholder+1;
							} // END FOREACH
						} // END IF (CHECK ALL PLACEHOLDERS)
						
						if ($bool_all_jobs_completed)
						{
							$THIS_JOB->update(array('id_status'=>'merging'));
							$this_placeholder=1;
							foreach ($ALL_PLACEHOLDERS as $EACH_PLACEHOLDER)
							{
								//print_r($EACH_PLACEHOLDER);
								//	logger( "\t\t\t" . "WTF TEST\n");
								if ($EACH_PLACEHOLDER)
								{
									if ($this_placeholder%300==0)
									{
										// SEND LOG UPDATES
										if ( $log_updated && isset($user_server) )
										{
											$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
											if ( isset($user_server) )
											{
												$user_server->build();
												$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
												$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
												$log_updated=false;
											}
										} // end if (any new log entries to send)
									}

									//logger( "\t\t\t" . var_export($EACH_PLACEHOLDER,true)."\n");
									
									//logger( "\t\t\t" . "\t".var_export($EACH_PLACEHOLDER,true)."\n");
									$CHILD_JID=$EACH_PLACEHOLDER['id_child_job'];
									$CHILD_JOB = new job_id_user();
									$CHILD_JOB->get_from_hashrange($JOB->id_user,$CHILD_JID);
									
									logger( "\t\t\t" . "MERGING CHILD PLACEHOLDER JOB STATUS (".$this_placeholder."/".$count_placeholders."): ".$CHILD_JOB->id_status."\n");							
									//logger( "\t\t\t" . "\t".var_export($CHILD_JOB,true)."\n");
									if ($CHILD_JOB->id_status!='done' && $CHILD_JOB->id_status!="merging" && $CHILD_JOB->id_status!="undefined")
									{
										$bool_all_jobs_completed=false;
										break;
									}
									//print_r($CHILD_JOB);
									$CHILD_JOB->build(array("obj_rqdata","obj_response","obj_ad","obj_hf","obj_user"));
									$EACH_PLACEHOLDER['output']=$CHILD_JOB->obj_output->body;
									$ALL_PLACEHOLDERS_WITH_JOB_RESPONSE[]=$EACH_PLACEHOLDER;
								}
								else
								{
									//logger( "\t\t\t" . "EMPTY PLACE WTF\n");
								}
								$this_placeholder=$this_placeholder+1;
							} // END FOREACH
							logger( "\t\t\t" . "ALL JOBS COMPLETED - MAKE PLACEHOLDER REPLACEMENTS\n");

							$PARENT_JOB = new job_id_user();
							$PARENT_JOB->get_from_hashrange($JOB->id_user,$PARENT_JID);
							$PARENT_JOB->build(array("obj_rqdata","obj_response","obj_ad","obj_hf","obj_user"));
							
							logger("\n\t\tORIGINAL PARENT URL:\n\t\t\t".$PARENT_JOB->obj_output->val."\n");
							$PARENT_RESPONSE_WITH_PLACEHOLDERS=$PARENT_JOB->obj_output->body;
							logger( "\tPARENT BEFORE REPLACEMENTS: ".substr($PARENT_RESPONSE_WITH_PLACEHOLDERS,0,min(500,strlen($PARENT_RESPONSE_WITH_PLACEHOLDERS)))."\n" );
							
							// ALL JOBS HAVE BEEN COMPLETED
							// EXECUTE PLACEHOLDER REPLACEMENT
							foreach ($ALL_PLACEHOLDERS_WITH_JOB_RESPONSE as $PLACEHOLDER)
							{
								$PLACEHOLDER_KEYWORD=$PLACEHOLDER['placeholder'];
								$PLACEHOLDER_FINAL_VALUE=$PLACEHOLDER['output'];
								logger( "\t\tA PLACEHOLDER VALUE: ".substr($PLACEHOLDER_FINAL_VALUE,0,min(200,strlen($PLACEHOLDER_FINAL_VALUE)))."\n" );							
								$PARENT_RESPONSE_WITH_PLACEHOLDERS=str_replace($PLACEHOLDER_KEYWORD,$PLACEHOLDER_FINAL_VALUE,$PARENT_RESPONSE_WITH_PLACEHOLDERS);
							} // end foreach
							logger( "\t\t\t\t" . count($ALL_PLACEHOLDERS_WITH_JOB_RESPONSE)." REPLACEMENTS MADE\n");

							$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
							$keyname=$APP['fs']->url_to_key($bucket_name,$PARENT_JOB->obj_output->val);
							//echo $keyname;

							$path_parts = explode(".",$PARENT_JOB->obj_output->val);
							$extension = $path_parts[count($path_parts)-1];
							$detected_mime_type="text/plain";
							foreach ($STATIC['mime_types'] as $mime_key=>$mime_value)
							{
								if ($extension==$mime_value)
								{
									$detected_mime_type=$mime_key;
									break;
								}
							} // end foreach
							logger( "\t\t\t\t" . "UPLOADING FINAL FILE\n");

							$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,$PARENT_RESPONSE_WITH_PLACEHOLDERS,$detected_mime_type);
							if ($file_upload_success)
							{
								logger( "\t\t\t\tUpload complete\n" );
								//logger( "\t".var_dump($APP['fs'])."\n" );
								//logger( "\t\t\t\tBucket Name:".$bucket_name."\n" );
								//logger( "\t\t\t\tKeyname:".$keyname."\n" );
								//logger( "\tContent:".$PARENT_RESPONSE_WITH_PLACEHOLDERS."\n" );
								logger( "\t\t\t\tMime Type:".$detected_mime_type."\n" );
							}
							else
							{
								logger( "\t\t\t\tUpload failure\n" );
							}
							// MOVED PARENT JOB = DONE TO BE AFTER PLACEHOLDER REPLACEMENTS
							$this_time_epoch=get_time();
							
							logger( "\t\tDELETING ALL DESCENDANT CHILD JOBS\n" );
							$PARENT_JOB->update(array("id_status"=>"done","dt_done"=>$this_time_epoch,"dt_modified"=>$this_time_epoch));
							$THIS_JOB->update(array("id_status"=>"done"));
							$PARENT_JOB->delete_ph_decendants();
							
							$JID_MERGE_CHECK=$PARENT_JID;

						} // end if (ALL JOBS COMPLETED)
						else
						{
							$JID_MERGE_CHECK="undefined";
							logger( "\t\t\t" . "THERE ARE STILL OTHER JOBS THAT NEED TO BE COMPLETED\n");
							break;
						}

					} // end if ( IS A PLACEHOLDER FROM ANOTHER JOB )
					else
					{
						$THIS_JOB = new job_id_user();
						$THIS_JOB->get_from_hashrange($JOB->id_user,$JID_MERGE_CHECK);
						// THIS JOB WAS *NOT* RUN TO FILL A PLACEHOLDER IN AN OUTPUT ENTRY FROM ANOTHER JOB
						logger( "\t\t" . "THIS JOB WAS *NOT* RUN TO FILL A PLACEHOLDER IN AN OUTPUT ENTRY FROM ANOTHER JOB\n");
						
						if ($THIS_JOB)
						{
							if ($THIS_JOB->id_status == 'done' )
							{
								// this will be the case on direct runs
								// and also this will be the ending point on nested subjobs after having
								// traced up to the completed root of the job tree
								// $STDOUT = is the value that is posted to the output expression url
								$OUTPUT_STRING = new strings();
								$OUTPUT_STRING->get_from_hashrange( $THIS_JOB->str_output );
								$OUTPUT_STRING->build();
								if (isset($OUTPUT_STRING->body))
								{
									if ( strlen($OUTPUT_STRING->body)>0 )
									{
										// in edit mode, this won't get hit
										$STDOUT=$OUTPUT_STRING->body;
										logger( "\t\t" . "POST-MERGE OUTPUT:\n".substr($STDOUT,0,200)."\n");
										
										// CHILD JOB MERGING _MIGHT_ HAVE CHANGED THE RAW OUTPUT OF THE JOBS...UPDATE IT JUST IN CASE SO THAT ADJACENT DICTIONARY GETS THE UPDATED INFO
										$adjacent_dictionary["[RAW_OUTPUT]"]=$STDOUT;
										logger( "\tSAVING ADJACENT DICTIONARY TO JOB\n");
										$ad_data=array('ad'=>$adjacent_dictionary);
										$ad_encoded=base64_encode(serialize($ad_data));
										$JOB->update( array('str_ad'=>$ad_encoded) );
										
										
										/*
										$output_expression_jid=$JID_MERGE_CHECK;
										if ( strlen(trim($STDOUT))>0 )
										{
											logger( "\t\t" . "OUTPUT EXPRESSION WILL EXECUTE IF IT EXISTS\n");
											$run_output_expression_if_exists=true;
										}*/
									} // end if (output exists/not blank ([c]xml mode)
								} // end if (output exists ([c]xml mode)
									
								
							} // end if (job is completed)
						} // END IF
						
						$JID_MERGE_CHECK = "undefined";
						break;
					} // end if ( IS NOT A PLACEHOLDER FROM ANOTHER JOB)

				} // END WHILE (RECURSIVELY MERGE SIBLINGS INTO PARENT VALUES)

			} // end if (JOB SUCCEEDED)

		} // END IF ($BOOL_EXECUTE_JOB_PARENT_MERGING)
			
		if ($APP['ms']->kind!="no-messaging" && $JOB->obj_hf->int_wait.""=="1")
		{
			logger( "\t" . "SENDING UPDATE MESSAGE\n" );
			$JOB->send("replyfrom_".$INSTANCE_NAME,$JOB->toobjectxml());
		}
		if ($BOOL_EXECUTE_JOB_EXECUTION || $JOB_FAILED)
		{
			// UPDATE THE LATEST CACHE IF THAT MODE WAS SUBMITTED WITH THE JOB
			if ( isset($the_post['action']) )
			{
				if ( $the_post['action']=="regather-latest-cache" )
				{
					logger("\n\tUPDATING LATEST CACHE\n");

					sleep(1);
					// OUTPUT_CONTENT = string url already
					$sha1_string = sha1(microtime().$OUTPUT_CONTENT);

					$new_string = new strings();
					$props=array();
					$props["id"]=$sha1_string;
					$props["val"]=$OUTPUT_CONTENT;
					$new_string->create_raw($props);
					

					$sha2_string = sha1(microtime().$OUTPUT_LOCATION);

					$new_string2 = new strings();
					$props=array();
					$props["id"]=$sha2_string;
					$props["val"]=$OUTPUT_LOCATION;
					$new_string2->create_raw($props);
					
					//$JOB=new job_id_user();
					if ($JOB->id_user=="undefined")
					{
						$JOB->get_from_hashrange($new_job_news->id_user,$INSTANCE_NAME."@".$new_job_news->id);
					}
					
					//$adjacent_dictionary['test']="hi";
					//print_r($adjacent_dictionary);
					// update latest cache
					$JOB->obj_hf->update_raw(array("str_cache_latest"=>$sha1_string,"str_cache_ad"=>$JOB->str_ad,"str_cache_out_cxml"=>$sha2_string));
					//unset($adjacent_dictionary['[adjacent_dictionary_str]']);
					//$JOB->obj_hf->update_raw( array('str_cache_ad'=>) );
				}
			}
		} // END IF (UPDATE LATEST CACHE [DON'T DO IF THIS IS AN INCOMPLETE)

		if ($BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS)
		{
			$OJOB = $JOB;
			if ($PARENT_JOB!=false)
			{
				$OJOB=$PARENT_JOB;
			}
			
			$OJOB->build();
			
			if ( isset($OJOB->obj_ad->body) )
			{
				//$JOB->build();
				$adjacent_dictionary_encoded = $OJOB->obj_ad->body;
				$adjacent_dictionary_base64decoded=base64_decode($adjacent_dictionary_encoded);
				$adjacent_dictionary_array=unserialize($adjacent_dictionary_base64decoded);
				$adjacent_dictionary=$adjacent_dictionary_array['ad'];
				$adjacent_dictionary["[RAW_OUTPUT]"]=$STDOUT;
			}

			// TODO: RECURSIVELY EXECUTE ALL PARENTS' OUTPUT EXPRESSIONS?
			//	DO LATER: FOR NOW, WE'LL ONLY EXECUTE LEAF NODES & ROOT PARENT NODES' OUTPUT EXPRESSION
			
			// HF OUTPUT METHODS
			
			// EXECUTE JOB OUTPUT EXPRESSIONS
			if ( (isset($the_post['cxml']) || isset($the_post['xml'])) && $OJOB->id_status=="done") //&& $run_output_expression_if_exists )
			{
				// RUN OUTPUT EXPRESSIONS
				// $STDOUT value will be sent
				logger("\n\tRUNNING OUTPUT EXPRESSIONS\n");
				//logger("OJOB\n");
				//logger(var_export($OJOB->obj_hf->obj_hf_outputs,true));

				$JQID=$OJOB->id_hf;
				logger( "\t" . "OUTPUT EXPRESSION JOB's HF ID: " . ($JQID)."\n" );
				
				$OJOB->build(array('obj_user','obj_hf_inherit','obj_hf_node_filters','obj_hf_tags','obj_hf_outputs','obj_hf_files','obj_hf_kill','obj_hf_resources','obj_hf_system_kind'));
				$rqdata=$OJOB->obj_rqdata->body;
				$requestdata=base64_decode($rqdata);
				$requestdata=unserialize($requestdata);
				$the_post=$requestdata['post'];
				$the_post_encoded = http_build_query($the_post);
				$ojob_params=$the_post;
				$_ORIGINAL_POST=$_POST;
				$_POST=$ojob_params;
				$OJOB->build(array('obj_user'));

				$match_entries=$OJOB->obj_hf->obj_expression->obj_match_entries;
				
				if ($match_entries)
				{
					if ( count($match_entries)>0 )
					{
						usort($match_entries, "meordersort");
					}
				}
				$bool_output_expression = false;

				if ($match_entries)
				{
					foreach ($match_entries as $match_entry)
					{
						if (strpos($match_entry->idx_id,"-1")===0 &&  $match_entry->id_entry_type == 'output')
						{
							foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
							{
								$match_entry->obj_me_settings[$MESK]->value=replace_dictionary($match_entry->obj_me_settings[$MESK]->value,$adjacent_dictionary);
								$match_entry->obj_me_settings[$MESK]->value=replace_hf_parameters($match_entry->obj_me_settings[$MESK]->value,$OJOB->obj_hf->obj_hf_parameters);
							}
						
							logger( "\tOUTPUT EXPRESSION: ".$match_entry->id_entry_subtype."\n" );
							//$hf_parameters = $OJOB->obj_hf->obj_hf_parameters;
							
							// collect adjacent dictionary
							
							//$output_expression=replace_hf_parameters(trim($output_expression),$hf_parameters);
							//logger( "\t".$output_expression."\n" );
							// $STDOUT is the entire functions' raw output

							// $STDOUT is the CXML Function output we want
							// check the database for what to do with it
					
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
									logger( "\t\t".("PLUGIN ERROR DURING INITIALIZATION") . ": ".str_replace("<","&lt;",$e) );
								}
							}

							if ( file_exists($plugin_exec_filename) )
							{
								try
								{
									include($plugin_exec_filename);
									logger("\t\tRESPONSE: ".substr($raw_response,0,min(50,strlen($raw_response)))."\n");

								}
								catch (Exception $e)
								{
									logger( "\t\t" .("PLUGIN ERROR DURING EXECUTION"). ": ".str_replace("<","&lt;",$e) );
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
									logger( "\t\t". ("PLUGIN ERROR DURING DISPOSAL").": ".str_replace("<","&lt;",$e) );
								}
							}

						} // end if (output expression match entry)
					} // end foreach (all match entries)
				} // end if (any match entries)


				$_POST=$_ORIGINAL_POST;

			} // end if


		} // END IF ($BOOL_EXECUTE_JOB_OUTPUT_EXPRESSIONS)
		
		if ($JOB->obj_hf->int_cleanup=="1" && $BOOL_EXECUTE_JOB_EXECUTION)
		{
			logger("\n\tCLEANING UP JOB...\n");
			try
			{
				@rrmdir($JOB_FOLDER);
			}
			catch (Exception $e)
			{
			}
		} // END IF (DO CLEANUP)


		logger( "\t" . "REACHED CURRENT END OF JOB #$JID\n" );
		logger( "SERVER VERSION:\n\t$SERVER_VERSION\n" );
		logger( "SERVER INSTANCE NAME:\n\t".$INSTANCE_NAME."\n");

		if ( $log_updated )
		{
			$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
			if ( isset($user_server) )
			{
				$user_server->build();
				$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
				$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
				$log_updated=false;
			}
		} // end if (any new log entries to send)

		
		// UPDATE NODE IN THE NODE LIST
		$user_server->update(array("is_busy"=>"0"));

		// SEND LOG UPDATES
		if ( $log_updated && isset($user_server) )
		{
			$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
			if ( isset($user_server) )
			{
				$user_server->build();
				$keyname=$APP['fs']->url_to_key($bucket_name,$user_server->obj_log->val);
				$file_upload_success=$APP['fs']->create_object(false,$bucket_name,$keyname,implode("\n",$log),"text/plain");
				$log_updated=false;
			}
		} // end if (any new log entries to send)
		
	} // end for (each job in job list)

	$APP['db']->disconnect();

	sleep($GLOBALS['settings']['server']['jobs']['sleep-between']['@attributes']['value']);
} // end while loop
if ($mode_server)
{
	exit;
}



?>
