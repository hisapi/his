<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


$qn=-1;
if ( isset($_GET['q']) )
{
	$qn = $_GET['q'];
}


if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="update-job-status" )
	{
		if ( isset($_POST['id']) && isset($_POST['id_status']) && strlen($_POST['id_status'])>0  )
		{
			// CREATE JOB_NEW TABLE ENTRY FOR JOBS TO BE FOUND

			$check_job = new job_id_user();
			$check_job->get_from_hashrange($u->id_user,$_POST['id']);
			if ($check_job->id!="undefined")
			{
				$new_status = $_POST['id_status'];
				if ($new_status=="new")
				{
					// CLEAR JOB FLAGS
					$check_job->delete_job_flags();
					// CLEAR PH_* ENTRIES
					$check_job->delete_ph_decendants();
					$check_job->delete_job_new();
					$check_job->delete_job_status();
				}
				if ($new_status=="new")
				{
					$check_job->update( array("id_status"=>$new_status,"dt_created"=>gmdate("U"),"dt_modified"=>gmdate("U")) );
				}
				else
				{
					$check_job->update( array("id_status"=>$new_status,"dt_modified"=>gmdate("U")) );
				}
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ( strpos($_GET['action'],"update-cleanup")!==false )
	{
		$cleanup_true=false;
		if ( isset( $_POST['chkCleanup'] ) )
		{
			if ( $_POST['chkCleanup']=="true")
			{
				$cleanup_true=true;
			}
		}
		$hf_id_obj = new hf_id_user();
		$hf_id_obj->get_from_hashrange($u->id_user,$qn);
		if ($cleanup_true)
		{
			$hf_id_obj->update(array("int_cleanup"=>"1"));
		}
		else
		{
			echo 
			$hf_id_obj->update(array("int_cleanup"=>"0"));
		}
	}	
}
if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="delete-job" )
	{
		if ( isset($_POST['id']) )
		{
			$DELETE_JOB = new job_id_user();
			$DELETE_JOB->get_from_hashrange($u->id_user,$_POST['id']);
			if ($DELETE_JOB->id!="undefined")
			{
				// CLEAR JOB FLAGS
				$DELETE_JOB->delete_job_flags();
				// CLEAR PH_* ENTRIES
				$DELETE_JOB->delete_ph_decendants();
				$DELETE_JOB->delete_job_new();
				$DELETE_JOB->delete_job_status();
				$DELETE_JOB->delete();
			}
		} // END IF (ID SET)
	} // END IF (ACTION IS DELETE-JOB)
}
if ( isset($_GET['action']) )
{
	if ( strpos($_GET['action'],"update-match-entry")!==false )
	{
		if ( isset($_POST['id_expr']) && isset($_POST['idx_id']) && isset($_POST['id_entry_type']) && isset($_POST['id_entry_subtype'])  )
		{
			// move up or down
			$move_by_pos_or_neg=0;
			if ( isset($_POST['btnUp']) )
			{
				$move_by_pos_or_neg=-1;
			}
			if ( isset($_POST['btnDown']) )
			{
				$move_by_pos_or_neg=1;
			}
			if ($move_by_pos_or_neg!=0)
			{
				//echo "<pre>";
				$this_match_entry=new match_entry();
				$this_match_entry->get_from_hashrange($_POST['id_expr'],$_POST['idx_id']);
				$slot_number = explode("#",$_POST['idx_id']);
				$match_entry=new match_entry();
				$all_match_entries = $match_entry->get_from_hashrange($_POST['id_expr'],$slot_number[0]."#","BEGINS_WITH");
				usort($all_match_entries,"meordersortarray");

				$my_idx=-1;
				$idx = 0;
				foreach ($all_match_entries as $me)
				{
					if ($me['idx_id']==$this_match_entry->idx_id)
					{
						$my_idx = $idx;
					}
					$idx = $idx + 1;
				}

				$min_found = 0;
				$idx=0;
				foreach ($all_match_entries as $me)
				{
					if ($idx==0||$me['int_order']<$min_found)
					{
						$min_found = intval($me['int_order']);
					}
					$idx = $idx + 1;
				}
				$max_found = 0;
				$idx=0;
				foreach ($all_match_entries as $me)
				{
					if ($idx==0||$me['int_order']>$max_found)
					{
						$max_found = intval($me['int_order']);
					}
					$idx = $idx + 1;
				}
				$my_order_number = intval($this_match_entry->int_order);
				if ( ( $my_order_number > $min_found && $move_by_pos_or_neg<0) || ($my_order_number < $max_found && $move_by_pos_or_neg>0)  )
				{
					for ($idx = 0;$idx<count($all_match_entries);$idx++)
					{
						$me=$all_match_entries[$idx];
						if (  $idx == $my_idx+$move_by_pos_or_neg )
						{
							$switch_entry = new match_entry();
							$switch_entry->get_from_hashrange($me['id_expr'],$me['idx_id']);
							$original_switch_order_entry=$switch_entry->int_order;
							$switch_entry->update(array("int_order"=>$this_match_entry->int_order));
							$this_match_entry->update(array("int_order"=>$original_switch_order_entry));
						}
					}
				}

			} // end if (move up or down)
		}
	}
} // end if (match entry up or down)


// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-fastresponse')
	{
		if ( isset($_POST['str_fastresponse']) )
		{
			$q=new hf_id_user();
			$q->get_from_hashrange($u->id_user,$_GET['q']);
			if ($q->id_user!="undefined")
			{
				$new_props=array();
				$new_props['str_fastresponse']=$_POST['str_fastresponse'];
				$q->update($new_props);
			}
		} // end if (field is set)
	} // end if (action)
} // end if (action)


// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-language')
	{
		if ( isset($_POST['user_language']) )
		{
			if ( $_POST['user_language']=="")
			{
				$_POST['user_language']="undefined";
			}
			$u->update(array("lang"=>$_POST['user_language']));

			$update_user=new user_id_user();
			$update_user->get_from_hashrange($u->id_user);
			if ($update_user->id_user!="undefined")
			{
				$props=array();
				$props['lang']=$u->lang;
				$update_user->update($props);
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='generate-new-secret-key')
	{
		$props=array();
		$props['secret']=sha1(time().rand(1,20).$u->user_name);;
		$u->update($props);
		$existing_user_by_id=new user_id_user();
		$existing_user_by_id->get_from_hashrange($u->id_user);
		if ($existing_user_by_id->id_user!="undefined")
		{
			$existing_user_by_id->update($props);
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='hf-edit-system-kind')
	{
		$refresh_assignments=false;
		if ( isset($_POST['btnSubmit']) )
		{
			// add new hf system kinds
			$hfsk = new hf_system_kind();
			$all_hf_sk = $hfsk->get_from_hashrange($qn);
			if ( isset($_POST['system_kind']) )
			{
				foreach ($_POST['system_kind'] as $psk)
				{
					$found_existing_hsk = FALSE;
					foreach ($all_hf_sk as $ahsk)
					{
						if ($psk == $ahsk['id_sk'])
						{
							$found_existing_hsk = TRUE;
						}
					}
					if (!$found_existing_hsk)
					{
						$new_hfsk = new hf_system_kind();
						$props=array();
						$props['id_hf']=$qn;
						$props['id']=sha1(time().$psk.rand(2,30));
						$props['id_sk']=$psk;
						$new_hfsk->create($props);
						$refresh_assignments=true;
					}
				}
			}
			foreach ($all_hf_sk as $ahsk)
			{
				$found_existing_hsk = FALSE;
				if ( isset($_POST['system_kind']) )
				{
					foreach ($_POST['system_kind'] as $psk)
					{
						if ($psk == $ahsk['id_sk'])
						{
							$found_existing_hsk = TRUE;
						}
					}
				}
				if (!$found_existing_hsk)
				{
					$delete_hfsk = new hf_system_kind();
					$delete_hfsk->get_from_hashrange($qn,$ahsk['id']);
					if ($delete_hfsk->id!="undefined")
					{
						//print_r($delete_hfsk);
						$delete_hfsk->delete();
						$refresh_assignments=true;
					}
				}
			}
			
		}
		else
		{
			// delete all hf system kinds?
		}

		if ($refresh_assignments)
		{
			$this_hf = new hf_id_user();
			$this_hf->get_from_hashrange($u->id_user,$qn);
			if ($this_hf->id!="undefined")
			{
				$this_hf->build( array("obj_expression","obj_hf_parameters","obj_hf_tags","obj_hf_files","obj_hf_kill","obj_hf_resources","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_cache_ad","obj_fastresponse") );
				$this_hf->refresh_assignments();
			}
		}

	}
}


// main page - add a system kind
// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-system-kind')
	{
		if ( isset($_POST['name']) && isset($_POST['detection_text']) )
		{
			if ( strlen($_POST['name'])>0 && strlen($_POST['detection_text'])>0 )
			{
				$new_id=sha1(time().rand(1,20).$_POST['name'].$_POST['detection_text']);
				$new_user_sk=new user_system_kind();
				$_POST['id']=$new_id;
				$_POST['id_user']=$u->id_user;
				$props=array();
				$new_user_sk->create($_POST);
			}
		}


	}
}

// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-hf-inherit')
	{
		if ( isset($_POST['id_hf']) )
		{
			if ( strlen($_POST['id_hf'])>0 )
			{
				$sha1_hfi=sha1(time().rand(1,20).$_POST['id_hf']);
				
				$found_hfi=false;
				$hfi_check=new hf_inherit();
				$hfi_list = $hfi_check->get_from_hashrange($_GET['q']);
				foreach ($hfi_list as $hfi_for_this_function)
				{
					if ($hfi_for_this_function['id_inherit']==$_POST['id_hf'])
					{
						$found_hfi=true;
					}
				} // END FOREACh
				
				if (!$found_hfi)
				{
					$props=array();
					$props['id_hf']=$_GET['q'];
					$props['id']=$sha1_hfi;
					$props['id_inherit']=$_POST['id_hf'];
					
					$new_hfi=new hf_inherit();
					$new_hfi->create($props);
				} // END IF (NO HF_INHERIT ENTRY FOR THIS ALREADY)
				
			} // END IF (FIELD IS SET)
		} // END IF (FIELD IS SET)
	} // END IF
} // END IF (ACTION)

// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-inheritance')
	{
		//print_r($_POST);
		if (isset($_POST['btnInheritanceOn']) )
		{
			$props=array();
			$props['id_user']=$u->id_user;
			$props['id_hf']=$_GET['q'];
			
			$new_user_inherit=new user_inherit();
			$new_user_inherit->get_from_hashrange($props['id_user'],$props['id_hf']);
			if ($new_user_inherit->id_user=="undefined")
			{
				$new_user_inherit->create($props);
			}
	
		}
		if (isset($_POST['btnInheritanceOff']) )
		{
				
			$new_user_inherit=new user_inherit();
			$new_user_inherit->get_from_hashrange($u->id_user,$_GET['q']);
			if ($new_user_inherit->id_user!="undefined")
			{
				$new_user_inherit->delete();
			}

		}
		
	}
}


// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='delete-hf-inherit')
	{
		if ( isset($_POST['id']) )
		{
			$this_hf_inherit=new hf_inherit();
			$this_hf_inherit->get_from_hashrange($_GET['q'],$_POST['id']);
			$this_hf_inherit->delete();
		}
	}
}



// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-hf')
	{
		// name
		// str_hf_resource
		// hf_resource_type
		if ( isset($_POST['name']) && isset($_POST['str_hf_resource']) )
		{
			if ( strlen($_POST['name'])>0  )
			{

				$already_exists = false;

				$existing_hf = new hf_id_user();
				$hf_list = $existing_hf->get_from_hashrange($u->id_user);
				foreach ($hf_list as $existing_his_function)
				{
					if ($existing_his_function['name']==$_POST['name'])
					{
						$already_exists = true;
						break;
					}
				}
				if ($already_exists)
				{
					$_GET['v']="add-hf";
					echo "<div align='center' style='background-color:red;color:white;'>";
					echo getTranslation("A Function with that name already exists.",$settings);
					echo "</div>";
					return;
				}

				$props=array();
				$props['id_user']=$u->id_user;
				$props['id']=sha1(time().$_POST['name'].rand(1,20));
				$props['name']=$_POST['name'];
				if (
					true
				)
				{
					$props['str_expression']="(.*)";
				}
				else
				{
					$props['str_expression']="";
				}
				
				// CREATE HIS FUNCTION
				
				$props['id_condition']="perfectly";
				$props['str_cache_out_xml']="undefined";
				$props['str_cache_out_cxml']="undefined";
				$props['str_cache_approved']="undefined";
				$props['str_cache_latest']="undefined";
				$props['str_cache_ad']="undefined";
				$props['id_mime_type']="undefined";
				$props['int_ws']="0";
				$props['int_wait']="0";
				$props['int_cleanup']="1";
				$props['int_maxruntime']="0";
				$props['int_mtf']="1";
				$props['int_delay']="10";
				$props['int_retry_count']="0";
				$props['str_fastresponse']="undefined";
				$new_hf=new hf_id_user();
				$new_hf->create($props);

				if ( strlen($_POST['str_hf_resource'])>0 )
				{
				
					// CREATE RESOURCE
					$props=array();
					$props['id_hf']=$new_hf->id;
					$props['id']=sha1(time().$_POST['str_hf_resource'].rand(1,20));
					$props['str_location']=$_POST['str_hf_resource'];
					$props['str_filename']="run.bat";
					$new_hf_resource=new hf_resource();
					$new_hf_resource->create($props);
				}
				
				if ( isset($_POST['id_inherit']) )
				{
					if ( strlen($_POST['id_inherit'])>0 )
					{
						$props=array();
						$props['id_hf']=$new_hf->id;
						$props['id']=sha1(time().$_POST['id_inherit'].rand(1,20));
						$props['id_inherit']=$_POST['id_inherit'];
						$new_hf_inherit=new hf_inherit();
						$new_hf_inherit->create($props);
					}
				}
				
				
				// CREATE SYSTEM KINDS
				if ( isset($_POST['system_kind']) )
				{
					foreach ($_POST['system_kind'] as $hf_sys_kind)
					{
						$props=array();
						$props['id_hf']=$new_hf->id;
						$props['id']=sha1(time().$hf_sys_kind.rand(1,20));
						$props['id_sk']=$hf_sys_kind;
						$new_hf_sk=new hf_system_kind();
						$new_hf_sk->create($props);
					}
				}

				$new_hf->build( array("obj_expression","obj_hf_parameters","bj_hf_tags","obj_hf_files","obj_hf_kill","obj_hf_resources","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_cache_ad","obj_fastresponse") );
				$new_hf->refresh_assignments();

				echo "<div align='center' style='background-color:green;color:white;'>";
				echo getTranslation("Function added.",$settings);
				echo "</div>";
				
				
			} // end if (strlen)
			else
			{
				$_GET['v']="add-hf";
				echo "<div align='center' style='background-color:red;color:white;'>";
				echo getTranslation("Function name cannot be empty.",$settings);
				echo "</div>";
				return;
			} // end else (strlen)
		} // end if (is posts set)

	} // action = add-hf
} // action

// hf page - add resource
if (isset($_GET['action']))
{
	if ($_GET['action']=="add-hf-resource")
	{
		if ( isset($_POST['str_filename']) && isset($_POST['str_location']) )
		{
		
			$props=array();
			$props['id_hf']=$_GET['q'];
			$props['id']=sha1(time().$_POST['str_location']);
			$props['str_filename']=$_POST['str_filename'];
			$props['str_location']=$_POST['str_location'];
			$new_resource=new hf_resource();
			$new_resource->create($props);
		}
	}
}

// hf page - add resource
if (isset($_GET['action']))
{
	if ($_GET['action']=="update-hf-resource")
	{
		if ( isset($_POST['id']) && isset($_POST['str_filename']) && isset($_POST['str_location']) )
		{
			// str_filename
			// str_location
			// id
			$props=array();
			$props['id_hf']=$_GET['q'];
			$props['id']=$_POST['id'];
			$current_resource=new hf_resource();
			$current_resource->get_from_hashrange($props['id_hf'],$props['id']);

			if ($current_resource->id=="undefined")
			{
				// cound be an overpowering resource
				$current_resource=new hf_resource();
				$current_resource->create($props);
			}

			if ( isset($_POST['btnDelete']) )
			{
				if ($current_resource->id!="undefined")
				{
					$current_resource->delete();
				}
			}
			else
			{
				// update
				$props['str_filename']=$_POST['str_filename'];
				$props['str_location']=$_POST['str_location'];
				$current_resource->update($props);

				// add new hf system kinds
				$hfsk = new hfr_system_kind();
				$all_hf_sk = $hfsk->get_from_hashrange($current_resource->id);
				if ( isset($_POST['system_kind']) )
				{
					foreach ($_POST['system_kind'] as $psk)
					{
						$found_existing_hsk = FALSE;
						if ($all_hf_sk)
						{
							foreach ($all_hf_sk as $ahsk)
							{
								if ($psk == $ahsk['id_sk'])
								{
									$found_existing_hsk = TRUE;
								}
							}
						}
						if (!$found_existing_hsk)
						{
							$new_hfsk = new hfr_system_kind();
							$props=array();
							$props['id_resource']=$current_resource->id;
							$props['id']=sha1(time().$psk.rand(2,30));
							$props['id_sk']=$psk;
							$new_hfsk->create($props);
						}
					}

					if ($all_hf_sk)
					{
						foreach ($all_hf_sk as $ahsk)
						{
							$found_existing_hsk = FALSE;
							foreach ($_POST['system_kind'] as $psk)
							{
								if ($psk == $ahsk['id_sk'])
								{
									$found_existing_hsk = TRUE;
								}
							}
							if (!$found_existing_hsk)
							{
								$delete_hfrsk = new hfr_system_kind();
								$delete_hfrsk->get_from_hashrange($current_resource->id,$ahsk['id']);
								if ($delete_hfrsk->id!="undefined")
								{
									//print_r($delete_hfsk);
									$delete_hfrsk->delete();
								}
							}
						} // for each
					} // end if (array)
				} // end if (system_kind is provided)

			} // end else (update, not delete)
			
	


			
		}
	}
}



// hf page - update condition
if (isset($_GET['action']))
{
	if ($_GET['action']=="update-condition")
	{
		if ( isset($_POST['id_condition']) && isset($_GET['q']) )
		{
			$q=new hf_id_user();
			$q->get_from_hashrange($u->id_user,$_GET['q']);
			$new_props=array();
			$new_props['id_condition']=$_POST['id_condition'];
			$q->update($new_props);
		}
	}
}

// hf page - edit primary/starting regular exprssion
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="edit-main-filtering-pattern")
	{
		if ( isset($_POST['id_expression']) && isset($_POST['regex']) )
		{
			if ( strlen($_POST['id_expression'])>0 )
			{
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_GET['q']);
				if ($_POST['id_expression']==$this_hf->str_expression)
				{
					$_POST['regex']=trim($_POST['regex']);
					if ( $APP['fs']->connect() )
					{
						$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['job-output']['@attributes']['value']."/".sha1(microtime().$_POST['regex']).".txt";
						$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
						$file_upload_success=$fs->create_object(false,$bucket_name,$keyname,$_POST['regex'],"text/plain");
						if ($file_upload_success)
						{
							$FILE_LOCATION=$APP['fs']->key_url($bucket_name,$keyname);
							$new_string = new strings();
							// TODO: Validate that this is a valid id_expression, related w/this HF
							$new_string->get_from_hashrange($_POST['id_expression']);
							if ($new_string->id!="undefined")
							{
								$props=array();
								$props["id"]=$_POST['id_expression'];
								$props["val"]=$FILE_LOCATION;
								$new_string->update_raw($props);
							}
							else
							{
								$this_hf->update(array("str_expression"=>$_POST['regex']));
							}
						}
						else
						{
							$this_hf->update(array("str_expression"=>$_POST['regex']));
						}
					} // end if (able to connect to file storage
					else
					{
						$this_hf->update(array("str_expression"=>$_POST['regex']));
					}
				}

			} //valid values
		} // isset post
	} // end if (action)
} // end if (action set)
// cache approve
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="cache-approve")
	{
		$this_hf = new hf_id_user();
		$this_hf->get_from_hashrange($u->id_user,$_GET['q']);
		if ($this_hf->id!='undefined')
		{
			$this_hf->update_raw(array("str_cache_approved"=>$this_hf->str_cache_latest));
		}
	} // end if (action)
} // end if (action)

// add/update cxml header & footers
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-custom-text")
	{
		if ( isset($_POST['str_txt']) && isset($_POST['id_expr']) && isset($_POST['idx_key']) )
		{
			if ( strlen($_POST['id_expr'])>0 && strlen($_POST['idx_key'])>0 && strlen($_POST['str_txt'])>=0 )
			{
				$props=array();
				$props["id_expr"]=$_POST['id_expr'];
				$props["idx_key"]=$_POST['idx_key'];
				$props["str_txt"]=$_POST['str_txt'];
				$match_custom=new match_custom();
				$match_custom->get_from_hashrange($props['id_expr'],$props['idx_key']);
				if ( $match_custom->id_expr=='undefined' )
				{
					$match_custom->create($props);
				}
				else
				{
					$match_custom->update(array("str_txt"=>$props['str_txt']));
				}
			} // end if values
		} // end if values
	} // end if (action)
} // end if (action)

// job node filtering - getting certain jobs to only run on certain remote nodes
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="add-job-node-filter")
	{
		if ( isset($_POST['filter_expression']) )
		{
			if ( strlen($_POST['filter_expression'])>0  )
			{
				$sha1_filterhf_id=sha1(time().$_POST['filter_expression']);
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_POST['id_hf']);
				if ($this_hf->id!="undefined")
				{
					$props=array();
					$props['id_hf']=$_POST['id_hf'];
					$props['id']=$sha1_filterhf_id;
					$props['str_filter']=$_POST['filter_expression'];
					$new_hf_node_filter=new hf_node_filter();
					$new_hf_node_filter->create($props);

					$this_hf->build( array("obj_expression","obj_hf_parameters","bj_hf_tags","obj_hf_files","obj_hf_kill","obj_hf_resources","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_cache_ad","obj_fastresponse") );
					$this_hf->refresh_assignments();
				}

			}
		} // end if (field set)
	} // end if (action)
} // end if (action)

// similarly, delete job-node filters
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="delete-job-node-filter")
	{
		if ( isset($_POST['nid']) )
		{
			if ( strlen($_POST['nid'])>0  )
			{
				$id_hf=$_POST['id_hf'];
				$this_node_filter=new hf_node_filter();
				$this_node_filter->get_from_hashrange($id_hf,$_POST['nid']);
				if ($this_node_filter->id!="undefined")
				{
					$this_node_filter->delete();

					$this_hf = new hf_id_user();
					$this_hf->get_from_hashrange($u->id_user,$qn);
					if ($this_hf->id!="undefined")
					{
						$this_hf->build( array("obj_expression","obj_hf_parameters","bj_hf_tags","obj_hf_files","obj_hf_kill","obj_hf_resources","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_cache_ad","obj_fastresponse") );
						$this_hf->refresh_assignments(true);
					}
				}
			}
		}
	}
} // end if (action)


if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-input-resource")
	{
		if ( isset($_POST['str']) )
		{
			if ( strlen($_POST['str'])>0  && strlen($_POST['rid'])>0 )
			{
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_GET['q']);
				if ($this_hf->id_hf_resource==$_POST['rid'])
				{
					$this_hf_resource=new hf_resource();
					$this_hf_resource->get_from_hashrange($_POST['rid']);
					$new_props=array();
					$new_props['str_location']=$_POST['str'];
					$this_hf_resource->update($new_props);
				}
			}
		} // end if (nonblank string)
	}
} // end if (action)

if ( isset($_GET['action']) )
{
	if ($_GET['action']=="cco" || $_GET['action']=="cxo")
	{
		if ($_GET['action']=="cco")
		{
			$xu=($this_server_url."/index.php?q=$qn&cxml&servercco&remote&id_user=".$u->id_user."&secret=".$u->secret); // add login args?
		}
		if ($_GET['action']=="cxo")
		{
			$xu=($this_server_url."/index.php?q=$qn&xml&servercxo&remote&id_user=".$u->id_user."&secret=".$u->secret); // add login args?
		}
		$xcontent=file_get_contents($xu);
	} // end if (cco or cxo action)
} // end if (action)

if ( isset($_GET['action']) )
{
	if ($_GET['action']=="add-match-entry" || $_GET['action']=="update-match-entry")
	{
		if ( isset($_POST['id_expr']) && isset($_POST['idx_id']) && isset($_POST['id_entry_type']) && isset($_POST['id_entry_subtype']) )
		{
			if ( strlen($_POST['id_expr'])>0 && strlen($_POST['idx_id'])>0 && strlen($_POST['id_entry_type'])>0 && strlen($_POST['id_entry_subtype']) )
			{
				if ($_GET['action']=="add-match-entry")
				{
					$idx_id=intval($_POST['idx_id']);
					$search_current_entries = new match_entry();
					$current_match_entries = $search_current_entries->get_from_hashrange($_POST['id_expr'],$idx_id."#","BEGINS_WITH");
					$max_order_count=0;
					if ( ($current_match_entries) )
					{
						foreach ($current_match_entries as $a_match_entry)
						{
							$max_order_count = max ( $max_order_count, intval($a_match_entry['int_order']) );
						}
					}
					$max_order_count=$max_order_count+1;
					$sha1_new_me_id = sha1(time().$_POST['id_expr'] );
					$props=array();
					$props["id_expr"]=$_POST['id_expr'];
					$props["idx_id"]=$idx_id."#".$sha1_new_me_id;
					$props["id_entry_type"]=$_POST['id_entry_type'];
					$props["id_entry_subtype"]=$_POST['id_entry_subtype'];
					$props["int_order"]=$max_order_count."";
					$new_me = new match_entry();
					$new_me->create($props);
				}
				if ($_GET['action']=="update-match-entry")
				{
					if ( isset($_POST['btnDelete']) )
					{
						$match_entry = new match_entry();
						$match_entry->get_from_hashrange($_POST['id_expr'],$_POST['idx_id']);
						$match_entry->delete();
					}
					else
					{
						$match_entry = new match_entry();
						$match_entry->get_from_hashrange($_POST['id_expr'],$_POST['idx_id']);
						$match_entry->update(array("id_entry_subtype"=>$_POST['id_entry_subtype']));

						// DATABASE CONNECTION SUBSETTINGS

						// LEVEL 2 - ADDSET OR ADDWHERE BUTTONS HIT 
						foreach ($_POST as $PK=>$PV)
						{
							if (strpos($PK,'btn_subsetting_db_action_')===0 && endsWith($PK,"_addset") )
							{
								$match_entry->build();
								$db_action_prefix = str_replace("_addset","",$PK);
								$db_action_prefix = str_replace("btn_","",$db_action_prefix);

								$max_set_found = 0;
								foreach ($match_entry->obj_me_settings as $mes)
								{
									if ( strpos($mes->name,$db_action_prefix."_set_")===0 && endsWith($mes->name,"_name") )
									{
										$mes_name=$mes->name;
										$mes_name=str_replace($db_action_prefix."_set_","",$mes_name);
										$mes_name=str_replace("_name","",$mes_name);
										$mes_name=intval($mes_name);
										if ($mes_name>$max_set_found)
										{
											$max_set_found=$mes_name;
										}
									}
								}
								$max_set_found=$max_set_found+1;
								$new_set_prefix=$db_action_prefix."_set_".$max_set_found;
								$_POST[$new_set_prefix."_name"] = '';
								$_POST[$new_set_prefix."_val"] = '';
								unset($_POST[$PK]);
							} // end if (addset button was hit)
							if (strpos($PK,'btn_subsetting_db_action_')===0 && endsWith($PK,"_addwhere") )
							{
								$match_entry->build();
								$db_action_prefix = str_replace("_addwhere","",$PK);
								$db_action_prefix = str_replace("btn_","",$db_action_prefix);

								$max_where_found = 0;
								foreach ($match_entry->obj_me_settings as $mes)
								{
									if ( strpos($mes->name,$db_action_prefix."_where_")===0 && endsWith($mes->name,"_name") )
									{
										$mes_name=$mes->name;
										$mes_name=str_replace($db_action_prefix."_where_","",$mes_name);
										$mes_name=str_replace("_name","",$mes_name);
										$mes_name=intval($mes_name);
										if ($mes_name>$max_where_found)
										{
											$max_where_found=$mes_name;
										}
									}
								}
								$max_where_found=$max_where_found+1;
								$new_where_prefix=$db_action_prefix."_where_".$max_where_found;
								if ($max_where_found>1)
								{
									$_POST[$new_where_prefix."_prevjoin"] = '';
								}
								$_POST[$new_where_prefix."_name"] = '';
								$_POST[$new_where_prefix."_val"] = '';
								$_POST[$new_where_prefix."_compare"] = '';
								unset($_POST[$PK]);

							} // end if (addwhere button was hit)
						} // for each (post field)

						// LEVEL 1 - DELETE A DATABASE ACTION
						foreach ($_POST as $PK=>$PV)
						{
							if (strpos($PK,'btn_del_subsetting_db_action')===0 )
							{
								$base_db_action= str_replace("btn_del_","",$PK);
								$base_db_action= str_replace("_table","",$base_db_action);
								$base_db_action= str_replace("_name","",$base_db_action);
								$me_to_del = new me_setting();
								$me_del_list = $me_to_del->get_from_hashrange($_POST['id_expr']."@".$_POST['idx_id']);
								if ( count($me_del_list)>0 )
								{
									foreach ($me_del_list as $me_del_item)
									{
										if (strpos($me_del_item['name'],$base_db_action)===0)
										{
											$me_del = new me_setting();
											$me_del->set($me_del_item);
											$me_del->delete();
											if ( isset($_POST[$me_del_item['name']]) )
											{
												unset($_POST[$me_del_item['name']]);
											}
										}
									}
								}
								unset($_POST[$PK]);
							}
						}
						// LEVEL 1 - ADD A DATABASE ACTION
						if ( isset($_POST['btn_add_subsetting_db_action_table_name']) )
						{
							if ( isset($_POST['add_subsetting_db_action_table_name']))
							{
									if ( strlen($_POST['add_subsetting_db_action_table_name'])>0 )
									{
										$max_db_action=0;
										$me_list = new me_setting();
										$mes_list = $me_list->get_from_hashrange($_POST['id_expr']."@".$_POST['idx_id']); //,$props['name']);
										if ( count($mes_list)>0 )
										{
												foreach ($mes_list as $mes_item)
												{
														// subsetting_post1name
														if ( strpos($mes_item['name'],"subsetting_db_action_")===0 )
														{
															$item_trim = $mes_item['name'];
															$item_trim = str_replace("subsetting_db_action_","",$item_trim);
															$item_trim = str_replace("_table","",$item_trim);
															if ($mes_item['name']=="subsetting_db_action_".$item_trim."_table")
															{
																	$max_db_action= intval($item_trim);
															}
														}
												}
										}
										$max_db_action=$max_db_action+1;
										$_POST['subsetting_db_action_'.$max_db_action.'_type']="";
										$_POST['subsetting_db_action_'.$max_db_action.'_table']=$_POST['add_subsetting_db_action_table_name'];
									}
							}
							unset($_POST['add_subsetting_db_action_table_name']);
						}
						if ( isset($_POST['add_subsetting_db_action_table_name']) )
						{
								unset($_POST['add_subsetting_db_action_table_name']);
						}
						if ( isset($_POST['btn_add_subsetting_db_action_table_name']) )
						{
								unset($_POST['btn_add_subsetting_db_action_table_name']);
						}



						// HTTP CONNECTION SUBSETTINGS
						foreach ($_POST as $PK=>$PV)
						{
							if (strpos($PK,'btn_del_subsetting_post')===0 )
							{
								$subsetting_to_delete = str_replace("btn_del_","",$PK);
								$subsetting_to_delete_val = str_replace("btn_del_","",$PK);
								$subsetting_to_delete_val = str_replace("name","val",$subsetting_to_delete_val);
								$me_to_del = new me_setting();
								$me_to_del->get_from_hashrange($_POST['id_expr']."@".$_POST['idx_id'],$subsetting_to_delete);
								$me_to_del->delete();

								$me_to_del = new me_setting();
								$me_to_del->get_from_hashrange($_POST['id_expr']."@".$_POST['idx_id'],$subsetting_to_delete_val);
								$me_to_del->delete();
								unset($_POST[$subsetting_to_delete]);
								unset($_POST[$subsetting_to_delete_val]);
								unset($_POST[$PK]);
							}
						}
						if ( isset($_POST['btn_add_subsetting_postNname']) )
						{
							if ( isset($_POST['add_subsetting_postNname']))
							{
								if ( strlen($_POST['add_subsetting_postNname'])>0 )
								{
									$max_post=1;
									$me_list = new me_setting();
									$mes_list = $me_list->get_from_hashrange($_POST['id_expr']."@".$_POST['idx_id']); //,$props['name']);
									if ( count($mes_list)>0 )
									{
										foreach ($mes_list as $mes_item)
										{
											// subsetting_post1name
											if ( strpos($mes_item['name'],"subsetting_post")===0 )
											{
												$item_trim = $mes_item['name'];
												$item_trim = str_replace("subsetting_post","",$item_trim);
												$item_trim = str_replace("name","",$item_trim);
												if ($mes_item['name']=="subsetting_post".$item_trim."name")
												{
													$max_post = intval($item_trim)+1;
												}
											}
										}
									}
									$_POST['subsetting_post'.$max_post.'name']=$_POST['add_subsetting_postNname'];
									$_POST['subsetting_post'.$max_post.'val']="";
								}
							}
							unset($_POST['add_subsetting_postNname']);
						}
						if ( isset($_POST['add_subsetting_postNname']) )
						{
							unset($_POST['add_subsetting_postNname']);
						}
						if ( isset($_POST['btn_add_subsetting_postNname']) )
						{
							unset($_POST['btn_add_subsetting_postNname']);
						}
						
						// str_bool_fail_n_matches
						// str_fail_n_matches
						if (!isset($_POST['str_bool_max_matches']) )
						{							
							if ( isset($_POST['str_max_match_count']) )
							{
								$_POST['str_bool_max_matches']='false';
							}
						}
						if (!isset($_POST['str_bool_fail_n_matches']) )
						{							
							if ( isset($_POST['str_fail_n_matches']) )
							{
								$_POST['str_bool_fail_n_matches']='false';
							}
						}

						$POST_FIELDS=array_keys($_POST);
						$POST_FIELD_LEN=count($POST_FIELDS)-1;
						
						//echo "<pre>";
						//print_r($_POST);
						//echo "</pre>";
						for ($i=$POST_FIELD_LEN;$i>=0;$i--)
						{
							if ($POST_FIELDS[$i]!="id_expr"&&$POST_FIELDS[$i]!="id_expr"&&$POST_FIELDS[$i]!="idx_id"&&$POST_FIELDS[$i]!="id_entry_type"&&$POST_FIELDS[$i]!="id_entry_subtype"&&$POST_FIELDS[$i]!=""&&$POST_FIELDS[$i]!="btnDelete"&&$POST_FIELDS[$i]!="btnDown"&&$POST_FIELDS[$i]!="btnUp")
							{
								// this is a non-standard field - a me_setting field

								$id_me="";
								$me_name=$POST_FIELDS[$i];
								$me_value=$_POST[$me_name];

								$props=array();
								$props['id_me']=$_POST['id_expr']."@".$_POST['idx_id'];
								$props['name']=$me_name;
								$props['str_value']=$me_value;

								$new_me = new me_setting();
								$new_me->get_from_hashrange($props['id_me'],$props['name']);
								if ($new_me->id_me=='undefined')
								{
									//echo "CREATE";
									$new_me->create($props);
								}
								else
								{
									//echo "EDIT";
									if ( $APP['fs']->connect() )
									{
										$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['job-output']['@attributes']['value']."/".sha1(microtime().$new_me->str_value).".txt";
										$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
										$file_upload_success=$fs->create_object(false,$bucket_name,$keyname,$props['str_value'],"text/plain");
										if ($file_upload_success)
										{
											$FILE_LOCATION=$APP['fs']->key_url($bucket_name,$keyname);
											$new_string = new strings();
											$new_string->get_from_hashrange($new_me->str_value);
											if ($new_string->id!="undefined")
											{
												$props=array();
												$props["val"]=$FILE_LOCATION;
												$new_string->update_raw($props);
											}
										}
									} // end if (able to connect to file storage


									// update latest cache
									//$JOB->obj_hf->update_raw(array("str_cache_latest"=>$sha1_string));

									// existing entry for this setting
									//$new_me->update(array('str_value'=>$props['str_value']));
								}
							} // end if (a non-standard me field)
						} // end for ( through each form field sent)

					} // end if (update)
				}
			} // end if (all fields non blank)
		} // end if (all fields exist)
	} // end if (action)
} // end if (action)



if ( isset($_GET['action']) )
{
	if ($_GET['action']=="add-hf-parameter")
	{
		if ( isset($_POST['id_hf']) && isset($_POST['keyword']) && isset($_POST['parameter_name']) && isset($_POST['str_default_value']) )
		{
			if ( strlen($_POST['id_hf'])>0 && strlen($_POST['keyword'])>0 && strlen($_POST['parameter_name'])>0 && strlen($_POST['str_default_value'])>=0 )
			{
				if ( !is_system_keyword($_POST['keyword']) && !is_system_post($_POST['parameter_name']) )
				{
			
					$_POST['id']=sha1(time().$_POST['keyword'].$_POST['str_default_value']);
					// add {JOB_FOLDER} and {JID} filtering
					// q & action filtering
					if ( isset($_POST['int_preserve_encode']) )
					{
						$_POST['int_preserve_encode']='1';
					}
					if ( isset($_POST['int_immutable']) )
					{
						$_POST['int_immutable']='1';
					}
					if ( isset($_POST['int_mandatory']) )
					{
						$_POST['int_mandatory']='1';
					}
					$new_hf_parameter=new hf_parameter();
					$new_hf_parameter->create($_POST);
				}
				else
				{
					echo "<div align='center' style='background-color:red;color:white;'>";
					echo getTranslation("The provided parameter name or keyword is used by the HIS system itself.  Use a different value.",$settings);
					echo "</div>";
				}
			} // end if (values)
		} // end if (isset)
	}
} // end if (action)


if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-mime-type")
	{
		if ( isset($_POST['qid']) && isset($_POST['id_mime']) )
		{
			if (strlen($_POST['qid'])>0 && strlen($_POST['id_mime'])>0)
			{
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_POST['qid']);
				$new_props=array();
				$new_props['id_mime_type']=$_POST['id_mime'];
				$this_hf->update($new_props);
			}
		} // end if isset
	} // end if action
} // end if action


if ( isset($_GET['action']) )
{
	if ($_GET['action']=="regather-latest-cache")
	{
		if (isset($_POST['refresh_cache']) )
		{
			//print_r($_POST);
		}
	}
} // end if action

if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-input-resource-type")
	{
		if ( isset($_POST['id_hf_resource']) && isset($_POST['new_hf_resource_type']) )
		{
			$this_hf = new hf_id_user();
			$this_hf->get_from_hashrange($u->id_user,$_GET['q']);
			if ($this_hf->id_hf_resource==$_POST['id_hf_resource'])
			{
				$this_hf_resource=new hf_resource();
				$this_hf_resource->get_from_hashrange($_POST['id_hf_resource']);
				$new_props=array();
				$new_props['id_type']=$_POST['new_hf_resource_type'];
				$this_hf_resource->update_raw($new_props);

			}
		} // isset
	} // action
} // end if action

if (isset($_GET['action']))
{
	if ($_GET['action']=="edit-output-method")
	{

		if (isset($_POST['id_hf']) && isset($_POST['id_output_type']) && isset($_POST['str_output_expression']))
		{
			$qid_val=($_POST['id_hf']);
			$output_type=($_POST['id_output_type']);
			$output_exp=$_POST['str_output_expression'];
			$oid=sha1(time().$output_type.$output_exp);

			if ( isset($_POST['id']) )
			{
				$post_oid=$_POST['id'];
				if ( isset($_POST['btnDelete']) )
				{
					$hf_output=new hf_output();
					$hf_output->get_from_hashrange($qid_val,$post_oid);
					if ($hf_output->id_hf!='undefined' && $hf_output->id!='undefined')
					{
						$hf_output->delete();
					}
				}
				else
				{
					$props=array();
					$props['id_hf']=$qid_val;
					$props['id']=$post_oid;
					$props['id_output_type']=$output_type;
					$props['str_output_expression']=$output_exp;
					$hf_output=new hf_output();
					$hf_output->get_from_hashrange($qid_val,$post_oid);
					$new_props=array();
					$new_props['id_output_type']=$output_type;
					$new_props['str_output_expression']=$output_exp;
					$hf_output->update($new_props);
				}
			}
			else
			{
				$props=array();
				$props['id_hf']=$qid_val;
				$props['id']=$oid;
				$props['id_output_type']=$output_type;
				$props['str_output_expression']=$output_exp;
				$hf_output=new hf_output();
				$hf_output->create($props);
			}

		} // end if (all fields exist)

	} // end if
} // end action

// whitespace sensitivity
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-whitespace")
	{
		if ( isset($_POST['qid']) )
		{
			if ( strlen($_POST['qid'])>0)
			{
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_POST['qid']);
				if ($this_hf->id!="undefined")
				{
					if ( isset($_POST['whitespace']) )
					{
						$this_hf->update(array('int_ws'=>'1'));
					}
					else
					{
						$this_hf->update(array('int_ws'=>'0'));
					}
				}
			} // end if (qid)
		}
	} // action
} // action

if ( isset($_GET['action']) )
{
	if ($_GET['action']=="add-remote-job-node-password")
	{
		if ( isset($_POST['qid']) && isset($_POST['node_password'])  )
		{
			if ( strlen($_POST['qid'])>0 && strlen($_POST['node_password'])>0)
			{
				$this_hf=new hf_id_user();
				$this_hf->get_from_hashrange($u->id_user,$_POST['qid']);
				if ($this_hf->id!='undefined')
				{
					$sha1_hfpw=sha1(time().$_POST['node_password']);
					$props=array();
					$props['id_hf']=$_POST['qid'];
					$props['id']=$sha1_hfpw;
					$props['str_pass']=$_POST['node_password'];
					$new_hf_password=new hf_password();
					$new_hf_password->create($props);
				}
			}
		}
	}
} // END IF


if ( isset($_GET['action']) )
{
	if ($_GET['action']=="delete-remote-job-node-password")
	{
		if ( isset($_POST['pid']) && isset($_POST['id_hf'])  )
		{
			$this_hf_password=new hf_password();
			$this_hf_password->get_from_hashrange($_POST['id_hf'],$_POST['pid']);
			$this_hf_password->delete();
		}
	}
}

// edit/delete hf parameters
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="update-hf-parameter")
	{
		if ( isset($_POST['id']) && isset($_POST['id_hf']) && isset($_POST['keyword']) && isset($_POST['parameter_name']) && isset($_POST['str_default_value']) )
		{
			if ( isset( $_POST['btnDelete'] ) )
			{
				$del_hf_parameter=new hf_parameter();
				$del_hf_parameter->set($_POST);
				$del_hf_parameter->delete();
			} // btnDelete
			if ( isset( $_POST['btnSave'] ) )
			{
				$update_hf_parameter=new hf_parameter();
				$update_hf_parameter->set($_POST);
				$new_props=array();
				$new_props['keyword']=$_POST['keyword'];
				$new_props['parameter_name']=$_POST['parameter_name'];
				$new_props['str_default_value']=$_POST['str_default_value'];
				if ( isset($_POST['int_immutable']) )
				{
					$new_props['int_immutable']="1";
				}
				else
				{
					$new_props['int_immutable']="0";
				}
				if ( isset($_POST['int_mandatory']) )
				{
					$new_props['int_mandatory']="1";
				}
				else
				{
					$new_props['int_mandatory']="0";
				}
				if ( isset($_POST['int_preserve_encode']) )
				{
					$new_props['int_preserve_encode']="1";
				}
				else
				{
					$new_props['int_preserve_encode']="0";
				}
				$update_hf_parameter->update($new_props);

			} // btnSubmit
		}
	}
}

// hf page - add a tag
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-hf-tag')
	{
		if ( isset($_POST['qid']) && isset($_POST['new_tag_value']) )
		{
			$new_tag_value=$_POST['new_tag_value'];
			$new_tag_value=substr($new_tag_value,0,min(254,strlen($new_tag_value)));

			$props=array();
			$props['id_hf']=$_POST['qid'];
			$props['id']=sha1(time().$new_tag_value);
			$props['str_tag']=$_POST['new_tag_value'];

			$new_hf_tag=new hf_tag();
			$new_hf_tag->create($props);

		}
	}
} // end if

// hf page - delete a tag
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='delete-hf-tag')
	{
		if (strlen($_POST['tid'])>0 && strlen($_POST['qid'])>0)
		{
			$delete_tag=new hf_tag();
			$delete_tag->get_from_hashrange($_POST['qid'],$_POST['tid']);
			if ($delete_tag->id!='undefined')
			{
				$delete_tag->delete();
			}
		}
	}
} // end if

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='rss')
	{
		if ( isset($_POST['server_name']) && isset($_POST['restart']) )
		{
			if ( strlen($_POST['server_name'])>0 )
			{
				$update_server = new user_server();
				$update_server->get_from_hashrange($u->id_user,$_POST['server_name']);
				if ($update_server->id_user!="undefined")
				{
					$update_server->update(array("force_restart"=>"1"));
				}
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='ras')
	{
		if ( isset($_POST['restart']) )
		{
			$update_server = new user_server();
			$all_servers = $update_server->get_from_hashrange($u->id_user);
			foreach ($all_servers as $each_server)
			{
				$a_server = new user_server();
				$a_server->set($each_server);
				if ($a_server->id_user!="undefined")
				{
					$a_server->update(array("force_restart"=>"1"));
				} // end if
			} // end foreach
		} // end if
	} // end if
} // end if

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='upload-file')
	{
		// todo do for rackspace too
		if ( isset($_GET['bucket']) && isset($_GET['key']) && isset($_GET['etag']) )
		{
			if ($_SERVER['HTTP_HOST']!=$demo_domain)
			{
				$uploaded_file=$APP['fs']->key_url($_GET['bucket'],$_GET['key']);
				$props=array();
				$props['id']=sha1(rand(1,100).time().$_GET['key']);
				$props['val']=$uploaded_file;
				$new_string = new strings();
				$new_string->create_raw($props);
				$props=array();
				$props['id_hf']=$_GET['q'];
				$props['id']=sha1(rand(30,50).$_GET['key'].$_GET['bucket'].time());
				$props['str_file']=$new_string->id;
				$new_hf_file=new hf_file();
				$new_hf_file->create_raw($props);
			}

		} // end if

	}
} // end action (upload new helium file)

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='uhf')
	{
		$uploaded_file="";
		// spot-uploaded file as input hf_resource

		// todo do for rackspace too
		if ($APP['fs']->is_aws())
		{
			if ( isset($_GET['bucket']) && isset($_GET['key']) && isset($_GET['etag']) )
			{
				// Amazon S3 Upload has already been completed
				$uploaded_file="https://s3.amazonaws.com/".$_GET['bucket']."/".$_GET['key'];
				$uploaded_file=str_replace("'","\\'",$uploaded_file);
				$uploaded_file=$uploaded_file."?--auto-close=true&--starting-url={starting-url}{all_parameters_for_helium}";
				$rid=$q['id_hf_resource'];
				$db->update("UPDATE hf_resources SET location='$uploaded_file' WHERE id=$rid");
			} // end if
		}

		$uploaded_file="";
	}
} // end action (upload new helium file)


if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-name')
	{
		if ( isset($_POST['name']) )
		{

			$the_name=$_POST['name'];
			$the_name=str_replace("'","&#39;",$the_name);
			$the_hf=new hf_id_user();
			$the_hf->get_from_hashrange($u->id_user,$qn);
			if ($the_hf->id!="undefined")
			{
				$the_hf->update(array("name"=>$the_name));
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-delay')
	{
		if ( isset($_POST['int_delay']) )
		{
			$the_delay=intval($_POST['int_delay']);
			$the_hf=new hf_id_user();
			$the_hf->get_from_hashrange($u->id_user,$qn);
			if ($the_hf->id!="undefined")
			{
				$the_hf->update(array("int_delay"=>$the_delay));
			}
		}
	}
}


if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-wait')
	{
		$the_wait="0";
		if ( isset($_POST['int_wait']) )
		{
			$the_wait=$_POST['int_wait'];
		}
		$the_hf=new hf_id_user();
		$the_hf->get_from_hashrange($u->id_user,$qn);
		if ($the_hf->id!="undefined")
		{
			$new_props=array();
			$new_props['int_wait']=$the_wait;
		   $the_hf->update($new_props);

		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-maxruntime')
	{
		if ( !isset($_POST['int_mtf']) )
		{
			$_POST['int_mtf']='0';
		}
		$the_rt="0";
		if ( isset($_POST['int_maxruntime']) )
		{
			$the_rt=$_POST['int_maxruntime'];
		}
		$the_hf=new hf_id_user();
		$the_hf->get_from_hashrange($u->id_user,$qn);
		if ($the_hf->id!="undefined")
		{
			$new_props=array();
			$new_props['int_maxruntime']=$the_rt;
			$new_props['int_mtf']=$_POST['int_mtf'];
			$the_hf->update($new_props);
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='update-hf-retry')
	{
		$the_rt="0";
		if ( isset($_POST['int_retry_count']) )
		{
			$the_rt=intval($_POST['int_retry_count']);
			if ($the_rt>999)
			{
				$the_rt=999;
			}
		}
		$the_hf=new hf_id_user();
		$the_hf->get_from_hashrange($u->id_user,$qn);
		if ($the_hf->id!="undefined")
		{
			$new_props=array();
			$new_props['int_retry_count']=$the_rt;
			$the_hf->update($new_props);
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='delete-hf-terminate-name')
	{
		if ( isset($_POST['str_name']) )
		{
			$props=array();
			$props['id_hf']=$_POST['id_hf'];
			$props['id']=$_POST['id'];
			$props['str_name']=$_POST['str_name'];
			$the_kill=new hf_kill();
			$the_kill->get_from_hashrange($props['id_hf'],$props['id']);
			if ($the_kill->id!='undefined')
			{
				$the_kill->delete();
			}
		}
	}
}


if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-hf-terminate-name')
	{
		if ( isset($_POST['str_name']) )
		{
			$props=array();
			$props['id_hf']=$qn;
			$props['id']=sha1(time().$_POST['str_name'].rand(2,20));
			$props['str_name']=$_POST['str_name'];
			$the_kill=new hf_kill();
			$the_kill->create($props);
		}
	}
}






if ( isset($_GET['action']) )
{
	if ($_GET['action']=='delete-hf')
	{
		$props=array();
		$props['id_user']=$u->id_user;
		$props['id']=$qn;
		$delete_hf=new hf_id_user();
		$delete_hf->get_from_hashrange($u->id_user,$qn);
		if ($delete_hf->id!="undefined")
		{
			$delete_hf->build();
			$delete_hf->delete(true);
			$_GET['v']="hf-list";
			$qn="";
			if ( isset($_GET['s']) )
			{
				unset($_GET['s']);
			}
			if ( isset($_GET['q']) )
			{
				unset($_GET['q']);
			}
			if ( isset($_GET['tags']) )
			{
				unset($_GET['tags']);
			}
		}
	}
}


if ( isset($_GET['action']) )
{
	if ($_GET['action']=='add-hf-parameter-constraint')
	{
		if (strlen($qn)>0)
		{
			if ( isset($_POST['id_hf_parameter']) && isset($_POST['id_constraint_type']) && isset($_POST['expression']) && isset($_POST['btnSubmit'])  )
			{
				$props=array();
				$props['id_hf_parameter']=$_POST['id_hf_parameter'];
				$props['id']=sha1(time().$_POST['expression']);
				$props['id_constraint_type']=$_POST['id_constraint_type'];
				$props['str_constraint_text']=$_POST['expression'];
				$new_hfp_vcs=new hfp_vcs();
				$new_hfp_vcs->create($props);
			}
		}
	}
}


// delete hf parameter constraint
if ( isset($_GET['action']) )
{
	if ($_GET['action']=="delete-hf-parameter-constraint")
	{
		if ( isset($_POST['id_constraint']) )
		{
			$delete_hfp_vc=new hfp_vcs();
			$delete_hfp_vc->get_from_hashrange($_POST['id_hfp'],$_POST['id_constraint']);
			if ($delete_hfp_vc->id_hf_parameter!='undefined')
			{
				$delete_hfp_vc->delete();
			}
		}
	}
}


// main page - add a hf
if ( isset($_GET['action']) )
{
	if ($_GET['action']=='delete-user-server')
	{
		if ( isset($_POST['name']) )
		{
			$this_user_server=new user_server();
			$this_user_server->get_from_hashrange($u->id_user,$_POST['name']);
			if ($this_user_server->id_user!="undefined")
			{
				$this_user_server->delete();
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='server-offline')
	{
		if ( isset($_POST['name']) )
		{
			$this_user_server=new user_server();
			$this_user_server->get_from_hashrange($u->id_user,$_POST['name']);
			if ($this_user_server->id_user!="undefined")
			{
				$this_user_server->update(array('int_online'=>'0'));
			}
		}
	}
}

if ( isset($_GET['action']) )
{
	if ($_GET['action']=='server-online')
	{
		if ( isset($_POST['name']) )
		{
			$this_user_server=new user_server();
			$this_user_server->get_from_hashrange($u->id_user,$_POST['name']);
			if ($this_user_server->id_user!="undefined")
			{
				$this_user_server->update(array('int_online'=>'1'));
			}
		}
	}
}




if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="update-uploaded-file" )
	{
		if ( isset($_POST['str_targetfile']) && isset($_POST['id_hf']) && isset($_POST['id'])  )
		{
			if ( strlen($_POST['id_hf'])>0 && strlen($_POST['id'])>0 )
			{
				$this_hf_file=new hf_file();
				$this_hf_file->get_from_hashrange($_POST['id_hf'],$_POST['id']);
				if ( isset($_POST['btnDelete']) )
				{
					$this_hf_file->delete();
				}
				else
				{
					if ($this_hf_file->id!='undefined')
					{
						$new_props=array();
						$new_props['str_targetfile']=$_POST['str_targetfile'];
						$this_hf_file->update($new_props);
					}
				}
			}
		}
	}
} // end action

if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="download-update" && $_SERVER['HTTP_HOST']!=$demo_domain )
	{

		$failed=false;
		$failed_msg = "";

		$version_content="";
		if ( in_array("https",stream_get_wrappers() ) )
		{
			try
			{
				$version_content=file_get_contents("https://humanintelligencesystem.com/version/");
				$version_content=substr($version_content,0,min(10,strlen($version_content)));
			}
			catch (Exception $e)
			{
				$failed=true;
				$failed_msg = getTranslation("Unable to connect to",$settings)." ";
				$failed_msg = '<a href="https://humanintelligencesystem.com/" target="_new">humanintelligencesystem.com</a>';
			}
		}
	
		if ( strlen(trim($version_content))>0 )
		{
			if (trim($version_content)!=$software_version)
			{
				
				// CHECK FOR TEMP DIR
				if ( file_exists( join_paths($BIN_DIR,"tmp") ) )
				{
					
				} // end if (check if folder exists)
				else
				{
					$make_dir = mkdir( join_paths($BIN_DIR,"tmp"),0774,true);
					if ($make_dir)
					{
					}
					else
					{
						$failed=true;
						$failed_msg = getTranslation("Unable to create folder",$settings);
						$failed_msg .= "<ul>";
						$failed_msg .= join_paths($BIN_DIR,"tmp")."";
						$failed_msg .= "</ul>";
						$failed_msg .= getTranslation("Permissions may need to be adjusted to allow Apache to create a new folder at",$settings);
						$failed_msg .= "<ul>";
						$failed_msg .= $BIN_DIR;
						$failed_msg .= "</ul>";

						$apache_user=exec('whoami');
						if ( $apache_user )
						{
							if ( strlen($apache_user)==0 )
							{
								$apache_user = getTranslation("Unknown",$settings);
							}
						}
						else
						{
							$apache_user = getTranslation("Unknown",$settings);
						}

						$failed_msg .= getTranslation("Apache user may be",$settings)." <b>".$apache_user."</b>";
						
					}
				}

				// CLEAN UP EXISTING TMP FOLDER
				if (!$failed && false)
				{
					try
					{
						$dir = join_paths($BIN_DIR,"tmp");
						$it = new RecursiveDirectoryIterator($dir);
						$files = new RecursiveIteratorIterator($it,
									 RecursiveIteratorIterator::CHILD_FIRST);
						foreach($files as $file) {
							if ($file->getFilename() === '.' || $file->getFilename() === '..') {
								continue;
							}
							if ($file->isDir()){
								rmdir($file->getRealPath());
							} else {
								unlink($file->getRealPath());
							}
						}
						//rmdir($dir);
					}
					catch (Exception $e)
					{
						$failed=true;
						$failed_msg = getTranslation("Failed to clean up tmp/ folder.  Possibly caused by permissions issue.",$settings);
					}
				} // end if

				// CHECK FOR CURL EXTENSION
				/*
				if ( !$failed && !in_array("curl",get_loaded_extensions()) )
				{
					$failed=true;
					$failed_msg = getTranslation("php_curl extension is not enabled.  Enable php_curl extension to proceed with version update.",$settings);
				}
				*/
				
				$target_version_file = "his-".$version_content.".zip";
				$server_download_new_version = 'https://humanintelligencesystem.com/version?get='.$version_content;

				try
				{
					// ATTEMPT TO DOWNLOAD ZIP FILE
					set_time_limit(0); // unlimited max execution time

					$file = fopen ($server_download_new_version, "rb");
					if ($file) {
					  $newf = fopen (join_paths($BIN_DIR,"tmp",$target_version_file), "wb");

					  if ($newf)
					  while(!feof($file)) {
						fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
					  }
					}

					if ($file) {
					  fclose($file);
					}

					if ($newf) {
					  fclose($newf);
					}					
					
					
				}
				catch (Exception $e)
				{
					$failed=true;
					$failed_msg = getTranslation("Unable to create file",$settings);
					$failed_msg .= "<ul>";
					$failed_msg .= join_paths($BIN_DIR,"tmp",$target_version_file)."  ";
					$failed_msg .= "</ul>";
					$failed_msg .= getTranslation("Permissions may need to be adjusted to allow Apache to create a new file at",$settings);
					$failed_msg .= "<ul>";
					$failed_msg .= join_paths($BIN_DIR,"tmp");
					$failed_msg .= "</ul>";
				}

				
				// CHECK FOR ZIP EXTENSION
				if ( !$failed && !in_array("zip",get_loaded_extensions()) )
				{
					$failed=true;
					$failed_msg = getTranslation("php_zip extension is not enabled.  Enable php_zip extension to proceed with version update.",$settings);
				}
				
				// EXTRACT ZIP FILE
				if (!$failed)
				{
					$zip = new ZipArchive;
					if ($zip->open( join_paths($BIN_DIR,"tmp",$target_version_file) ) === TRUE) {
						$zip->extractTo( join_paths($BIN_DIR,"tmp") );
						$zip->close();
					} else {
						$failed=true;
						$failed_msg = getTranslation("Unable to open downloaded zip file.  Is extension php_zip enabled?",$settings);
					}
				}
				
				// MOVE TMP/HIS/* FILES OVER TOP OF CURRENT FILES
				if (!$failed)
				{
					$source = join_paths($BIN_DIR,"tmp","his");
					$dest= $BIN_DIR;

					foreach (
						$iterator = new RecursiveIteratorIterator(
							new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
							RecursiveIteratorIterator::SELF_FIRST) as $item
					)
					{
						if ($item->isDir())
						{
							mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
						}
						else
						{
						
							if (!copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName()) )
							{
								$failed=true;
								$failed_msg=getTranslation("Unable to move extracted file from",$settings);
								$failed_msg .= "<ul>";
								$failed_msg .= $item;
								$failed_msg .= "</ul>";
								$failed_msg .= "to";
								$failed_msg .= "<ul>";
								$failed_msg .= $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
								$failed_msg .= "</ul>";
								$failed_msg.=getTranslation("Might be a permissions problem.",$settings);
							}
							else
							{
								// successfully copied file
							}
					  	}
					}
				}
				
				// DELETE TEMP DIR
				if (!$failed)
				{
					$dir = join_paths($BIN_DIR,"tmp");
					$it = new RecursiveDirectoryIterator($dir);
					$files = new RecursiveIteratorIterator($it,
								 RecursiveIteratorIterator::CHILD_FIRST);
					foreach($files as $file) {
						if ($file->getFilename() === '.' || $file->getFilename() === '..') {
							continue;
						}
						if ($file->isDir()){
							rmdir($file->getRealPath());
						} else {
							unlink($file->getRealPath());
						}
					}
					rmdir($dir);
				}

			} // END IF (DIFF VERSION) ? EMAIL IF ATTEMPTED WHEN NOT DIFF VERSION ?
		}

		if ($failed)
		{
			$PAGE=new SetupPage(intval("1"));
			$PAGE->hide_back=true;
			$PAGE->pagetitle="Update";
			$PAGE->title="<h1>";
			$PAGE->title=$PAGE->title.getTranslation("Error while installing",$settings);
			$PAGE->title=$PAGE->title." ".$version_content." ";
			$PAGE->title=$PAGE->title.getTranslation("update package",$settings);
			$PAGE->title=$PAGE->title."</h1>";
			$PAGE->generate_headers_footers();
							
			$PAGE->body=$PAGE->body."<p>";
			$PAGE->body=$PAGE->body.$failed_msg;
			$PAGE->body=$PAGE->body."</p>";
			echo $PAGE->content();
			exit;
		}
		else
		{
			$PAGE=new SetupPage(intval("1"));
			$PAGE->hide_back=true;
			$PAGE->pagetitle="Update";
			$PAGE->title="<h1>";
			$PAGE->title=$PAGE->title.getTranslation("Successfully installed",$settings);
			$PAGE->title=$PAGE->title." ".$version_content." ";
			$PAGE->title=$PAGE->title.getTranslation("update package",$settings);
			$PAGE->title=$PAGE->title."</h1>";
			$PAGE->generate_headers_footers();
							
			$PAGE->body=$PAGE->body."<p>";
			$PAGE->body=$PAGE->body.getTranslation("Update package was downloaded, extracted, and installed successfully.",$settings);
			$PAGE->body=$PAGE->body."</p>";
			echo $PAGE->content();
			exit;
		}
	

	} // END IF (ACTION)

}

if ( isset($_GET['action']) )
{
	if ( $_GET['action']=="reassign-job" )
	{
		if ( isset($_POST['id']) )
		{
			$REASSIGN_JOB = new job_id_user();
			$REASSIGN_JOB->get_from_hashrange($u->id_user,$_POST['id']);
			if ($REASSIGN_JOB->id!="undefined")
			{
				$was_reassigned=$REASSIGN_JOB->reassign_auto();
				if (!$was_reassigned)
				{
					echo "<div align='center' style='background-color:red;color:white;'>";
					echo "Job was not reassigned.";
					echo "</div>";
				}
			}
		} // END IF (ID SET)
	} // END IF (ACTION IS DELETE-JOB)
}




?>
