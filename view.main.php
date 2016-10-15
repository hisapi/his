<?php
// gui

// COLUMN 2
if ( isset($_GET['v']) )
{
	if ( in_array($_GET['v'],array_keys($main_menu)) )
	{
		echo "<h1>";
		echo getTranslation($main_menu[$_GET['v']],$settings) ;
		echo "</h1>";
	}
}

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="find-hf" )
{
	include("search.php");
}
} // end if (hf search)

if ( isset($_GET['action']) && isset($_GET['step']) )
{
	if ($_GET['action']=="import-function" && intval($_GET['step'])>0 && (isset($_FILES['import_file'])|| isset($_POST['import_file']) ) )
	{
		if ( isset($_FILES["import_file"]) &&  ($_FILES["import_file"]["error"] > 0  && !isset($_POST['import_file']) ) ) // || strpos($_FILES['import_file']['tmp_name'],sys_get_temp_dir())!==0)
		{
				echo getTranslation("Upload Error",$settings).": " . $_FILES["import_file"]["error"];
				echo "<br/>";
				echo "<ul>";
				echo getTranslation("Check your php.ini for the following entries",$settings).":";
				echo "<ul>";
				echo "upload_max_filesize";
				echo "<br/>";
				echo "post_max_size";
				echo "<br/>";
				echo "memory_limit";
				echo "<br/>";
				echo "<br/>";
				echo "</ul>";

				echo getTranslation("Hit the back button to continue",$settings);

				echo "</ul>";
		}
		else
		{
			echo "<tr><td>";
			echo "<form action='?action=import-function&step=2&v=import' method='post'>";

			if ( isset($_FILES['import_file']['tmp_name']) )
			{
				$input_file = $_FILES['import_file']['tmp_name'];
				$import_contents = file_get_contents($input_file);
				if (!file_exists($input_file))
				{
					echo getTranslation("Error, unable to import HF XML file.",$settings);
					exit;
				}
			}
			
			if (isset($_POST['import_file']))
			{
				$import_contents = $_POST['import_file'];
			}
			if ( strlen($import_contents)==0 )
			{
				echo getTranslation("Error, unable to import HF XML file.",$settings);
				exit;
			}
			$hf_obj = new hf_id_user();
			$all_hfs = $hf_obj->get_from_hashrange($u->id_user);

			echo "<input type='hidden' name='import_file' value='".htmlspecialchars($import_contents,ENT_QUOTES)."'/>";
			$import_xml= xmlToArray(simplexml_load_string($import_contents));

			//print_r($import_xml);

			foreach ($all_hfs as &$each_hf)
			{
				$each_hf['from']="library";
			}
			$import_hfs=array();
			if ( isset($import_xml['hf_id_user']) )
			{
				foreach ($import_xml['hf_id_user'] as $hf_xml)
				{
					$new_hf = new hf_id_user();
					$new_hf->create_from_xml_array($hf_xml);
					$new_hf->from="import";
					$new_hf->xml = $hf_xml;
					$import_hfs[]=$new_hf;
				}
			}
			else
			{
				$new_hf = new hf_id_user();
				$new_hf->create_from_xml_array($import_xml);
				$new_hf->from="import";
				$new_hf->xml = $import_xml;
				$new_hf->original_name=$new_hf->name;
				$import_hfs[]=$new_hf;
			}
			$step_2_corrections=array();
			$to_import=array();


			if ( intval($_GET['step'])==2)
			{
				for ($i=0;$i<count($import_hfs);$i++)
				{
					$import_hf = $import_hfs[$i];
					$import_hf->original_name = $import_hf->name;
					$matched_functions=array();
					foreach ($all_hfs as $library_hf)
					{
						if ($import_hf->name==$library_hf['name'])
						{
							$matched_functions[]=$library_hf;
						}
					}
					$imported_function_exists=false;
					if ( count($matched_functions)> 0 )
					{
						$imported_function_exists=true;
					}

					$found_all_needed_inherits=true;
					$matched_inherits=array();
					foreach ($import_hf->obj_hf_inherit as $inherit)
					{
						foreach ($all_hfs as $library_hf)
						{
							if ($inherit->name==$library_hf['name'])
							{
								$matched_inherits[]=$library_hf;
							}
						}
						foreach ($import_hfs as $hf_importing)
						{
							if ($inherit->name==$hf_importing->name)
							{
								$matched_inherits[]=$hf_importing;
							}
						}
						if ( count($matched_inherits) == 0 )
						{
							$found_all_needed_inherits=false;
						}
					}
					if ($found_all_needed_inherits)
					{
						if ( isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
						{
							if ( $_POST['import-behavior-'.form_field_name($import_hf->name)]!="error" && $_POST['import-behavior-'.form_field_name($import_hf->name)]!="skip" )
							{
								$to_import[]=$import_hf->name;
								if ( !isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
								{
									$_POST['import-behavior-'.form_field_name($import_hf->name)] = "skip";
									$step_2_corrections[]='import-behavior-'.form_field_name($import_hf->name);
								}
								else
								{
									if ( $_POST['import-behavior-'.form_field_name($import_hf->name)]!="replace" && $_POST['import-behavior-'.form_field_name($import_hf->name)]!="new" && $_POST['import-behavior-'.form_field_name($import_hf->name)]!="skip" )
									{
										$_POST['import-behavior-'.form_field_name($import_hf->name)] = "skip";
										$step_2_corrections[]='import-behavior-'.form_field_name($import_hf->name);
									}
								}
								if ( !isset($_POST['update-inheritors-'.form_field_name($import_hf->name)]) )
								{
									$_POST['update-inheritors-'.form_field_name($import_hf->name)]="no";
									//$step_2_corrections[]='update-inheritors-'.str_replace(" ","_",$import_hf->name); 
								}
								else
								{
									if ( $_POST['update-inheritors-'.form_field_name($import_hf->name)]!="yes" && $_POST['update-inheritors-'.form_field_name($import_hf->name)]!="no"  )
									{
										$_POST['update-inheritors-'.form_field_name($import_hf->name)]="no";
										$step_2_corrections[]='update-inheritors-'.form_field_name($import_hf->name); 
									}
								}

								// VERIFY INHERIT FROM BEHAVIOR
								foreach ($import_hf->obj_hf_inherit as $inherit)
								{
									if ( isset($_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]) )
									{
										if ($_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]=="import")
										{
											if ( isset($_POST['import-behavior-'.form_field_name($inherit->name)]) )
											{
												if ($_POST['import-behavior-'.form_field_name($inherit->name)]!="new")
												{
													$_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]="library";
													//echo "ERROR";exit;
													if ($_POST['import-behavior-'.form_field_name($inherit->name)]!="replace")
													{
														$step_2_corrections[]='inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name);
													}
												}
											}
											else
											{
												$_POST['import-behavior-'.form_field_name($inherit->name)]="skip";
												$step_2_corrections[]='import-behavior-'.form_field_name($inherit->name);
											}
										}
										else
										{
											if ($_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]!="library")
											{
												$step_2_corrections[]='inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name);
												$_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]="library";
											}
										}
									}
									else
									{
										$_POST['inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)]="library";
										$step_2_corrections[]='inheritor-'.form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name);
									}
								}

								// OVERWRITE/REPLACE DATA COLLECTION
								if ( isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
								{
									if ($_POST['import-behavior-'.form_field_name($import_hf->name)]=="replace")
									{
										foreach ($all_hfs as $library_hf)
										{
											if ($library_hf['name']==$import_hf->name)
											{
												$_POST['replace-id-'.form_field_name($import_hf->name)]=$library_hf['id'];
											}
										}
									}
								}
								// VERIFY FUNCTION NAME (IF NEW FUNCTION AND ALREADY EXISTS - THE USER NEEDS TO CHANGE THE NAME
								if ($imported_function_exists)
								{
									if ( isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
									{
										if ($_POST['import-behavior-'.form_field_name($import_hf->name)]=="new")
										{
											$found_match=false;
											foreach ($all_hfs as $library_hf)
											{
												if ($_POST['update-name-'.form_field_name($import_hf->name)]==$library_hf['name'])
												{
													$found_match=true;
												}
											}
											if ($found_match)
											{
												$step_2_corrections[]='update-name-'.form_field_name($import_hf->name);
											}
											while ($found_match)
											{
												$_POST['update-name-'.form_field_name($import_hf->name)].="(1)";
												$found_match=false;
												foreach ($all_hfs as $library_hf)
												{
													if ($_POST['update-name-'.form_field_name($import_hf->name)]==$library_hf['name'])
													{
															$found_match=true;
													}
												}
											} // end while
										}
									}
								}

								// CREATE IDS FOR THESE FUNCTIONS
								$_POST['id-'.form_field_name($import_hf->name)]=sha1(microtime().$import_hf->name);

								// UPDATE NAME
								//if ( isset($_POST['update-name-'.str_replace(" ","_",$import_hf->name)]) )
								//{
								//	$import_hf->name = $_POST['update-name-'.str_replace(" ","_",$import_hf->name)];
								//}
							} // end if (import behavior for a function not "error" or "skip"
						} // end if (import behavior for a function is set)

						// FOUND ALL INHERITANCES, ALL IMPORT SETTINGS CORRECT NOW
						//    MOVED GIVE_IDS to later in code

					} // END IF (FOUND ALL INHERITANCES)

					// POST Array now contains final instructions for taking the xml, and adding it into the library
					// build an actual complete hf_id_user object

				} // end for (each import)

				if ( count($step_2_corrections) > 0 || count($to_import)==0)
				{
					$_GET['step']=1;

					if ( count($to_import) == 0)
					{
						echo "<center>";
						echo "<span style='color:red;'>";
						echo getTranslation("No functions are selected for import.  Select an 'Import Behavior' other than 'Skip importing this function'",$settings);
						echo "</span>";
						echo "</center>";
					}

					//echo "<pre>";
					//print_r($step_2_corrections);
				}
				else
				{
					$imported=array();
					$updated_inheritances=array();
					for ($i=0;$i<count($import_hfs);$i++)
					{
						$import_hf = $import_hfs[$i];
						$matched_functions=array();
						foreach ($all_hfs as $library_hf)
						{
							if ($import_hf->name==$library_hf['name'])
							{
								$matched_functions[]=$library_hf;
							}
						}
						$imported_function_exists=false;
						if ( count($matched_functions)> 0 )
						{
							$imported_function_exists=true;
						}

						$found_all_needed_inherits=true;
						$matched_inherits=array();
						foreach ($import_hf->obj_hf_inherit as $inherit)
						{
							foreach ($all_hfs as $library_hf)
							{
								if ($inherit->name==$library_hf['name'])
								{
									$matched_inherits[]=$library_hf;
								}
							}
							foreach ($import_hfs as $hf_importing)
							{
								if ($inherit->name==$hf_importing->name)
								{
									$matched_inherits[]=$hf_importing;
								}
							}
							if ( count($matched_inherits) == 0 )
							{
								$found_all_needed_inherits=false;
							}
						}
						if ($found_all_needed_inherits)
						{
							if ( isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
							{
								if ( $_POST['import-behavior-'.form_field_name($import_hf->name)]!="error" && $_POST['import-behavior-'.form_field_name($import_hf->name)]!="skip")
								{
									//echo "<pre>";
									//echo "BEFORE:";
									//print_r($import_hf);
									$import_hf->give_ids();
									//echo "<pre>";
									//print_r($import_hf);
									//ob_start();
									$imported[]=$import_hf->name;
									
									if ( $_POST['import-behavior-'.form_field_name($import_hf->original_name)]=="replace")
									{
										$delete_old_hf = new hf_id_user();
										$delete_old_hf->get_from_hashrange($u->id_user,$import_hf->id);
										$delete_old_hf->build();
										if ($delete_old_hf->id!="undefined")
										{
											$delete_old_hf->delete(true);
										}
									}
									$import_hf->name = $_POST['update-name-'.form_field_name($import_hf->original_name)];
									//echo "<pre>";
									//echo "DURING:";
									//print_r($import_hf);
									
									$import_hf->rcreate($import_hf->member_value_array());
									$import_hf->refresh_assignments(false);
									$import_hf->build();
									$import_hf->refresh_assignments(true);


									//echo "<pre>";
									//echo "AFTER:";
									//print_r($import_hf);
									if ( $_POST['update-inheritors-'.form_field_name($import_hf->original_name)]=="yes" && $_POST['import-behavior-'.form_field_name($import_hf->original_name)]=="new" )
									{
										$update_inherits=array();

										$ahfs=new hf_id_user();
										$all_hfs = $ahfs->get_from_hashrange($u->id_user);
										foreach ($all_hfs as $ahf)
										{
											$ahi=new hf_inherit();
											$all_inherits = $ahi->get_from_hashrange($ahf['id']);
											
											foreach ($all_inherits as $ainherit)
											{
												$uhi=new hf_inherit();
												$uhi->get_from_hashrange($ainherit['id_hf'],$ainherit['id']);
												foreach ($matched_functions as $matched_function)
												{
													if ($uhi->id_inherit==$matched_function['id'])
													{
														$update_inherits[]=$uhi;
													}
												}
											}
										}
										foreach ($update_inherits as $update_inherit)
										{
											$update_inherit->update(array("id_inherit"=>$import_hf->id));
										}
										$updated_inheritances=array_merge($updated_inheritances,$update_inherits);

									}
									//$content = ob_get_clean();
								}
							}
						}
					} // end for each import
					if ( count($imported)> 0 )
					{
						echo "<span style='color:red;'>";
						if ( count($imported)==1 )
						{
							echo count($imported)." ".getTranslation("function was imported.",$settings);
						}
						else
						{
							echo count($imported) ." ".getTranslation("functions were imported.",$settings);
						}
						echo " ";
						if ( count($updated_inheritances)>0 )
						{
							if ( count($updated_inheritances)==1 )
							{
								echo count($updated_inheritances) ." ". getTranslation("inheritance was updated.",$settings);
							}
							else
							{
								echo count($updated_inheritances) ." ".getTranslation("inheritances were updated.",$settings);
							}
						}
						echo "</span>";
						$_GET['v']="hf-list";
					}

				} // END IF (FUNCTIONS ARE BEING IMPORTED & NO CORRECTIONS NEED TO BE MADE)

				//echo "<pre>";
				//print_r($import_hfs);
				//print_r($import_xml);

			} // END IF (STEP 2)
			//print_r($step_2_corrections);

			if ( count( $step_2_corrections ) > 0 )
			{
				for ($i=count($import_hfs)-1;$i>=0 && intval($_GET['step'])==1 ;$i--)
				{
					$import_hf = $import_hfs[$i];
					$original_xml = $import_hf->xml;
					$import_hf = new hf_id_user();
					$import_hf->create_from_xml_array($original_xml);                       
					$import_hf->from="import";
					$import_hf->xml = $original_xml;
					$import_hfs[$i]=$import_hf;
				}
			}

			if ( intval($_GET['step'])==1 )
			{
				echo "<center>";
				echo "<input type='submit' style='background-color:".rcolor()."' value='";
				echo getTranslation("Continue and Import Functions into Library",$settings);
				echo "'/>";
				echo "</center>";
			}

			for ($i=count($import_hfs)-1;$i>=0 && intval($_GET['step'])==1 ;$i--)
			{
				$import_hf = $import_hfs[$i];

				if ( count($step_2_corrections) > 0 )
				{
					//print_r($step_2_corrections);
					$original_xml = $import_hf->xml;
					$import_hf = new hf_id_user();
					$import_hf->create_from_xml_array($original_xml);				
					$import_hf->from="import";
					$import_hf->xml = $original_xml;
				}

				echo "<i style='background-color:".rcolor().";width:inherit;'>";
				echo getTranslation("Import",$settings).": ";
				echo $import_hf->name;
				echo "</i>";
				
				echo "<ul>";

				// option 1: inheritance: none, missing, or okay
				// option 2: import as new function/new function w/diff name or existing function (replace existing functions)
				//    OPTION: import, but change name of imported function
				//    option 5a: import, replace existing function

				$matched_functions=array();
				foreach ($all_hfs as $library_hf)
				{
					if ($import_hf->name==$library_hf['name'])
					{
						$matched_functions[]=$library_hf;
					}
				}
				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo getTranslation("Change function name",$settings).": ";
				$corrected_function_name=false;
				foreach ($step_2_corrections as $s2c)
				{
					if ($s2c == "update-name-".form_field_name($import_hf->name) )
					{
						$corrected_function_name=true;
					}
				}
				$green_style="";
				$show_value = $import_hf->name;
				if ($corrected_function_name)
				{
					$green_style="background-color:green;color:white;";
				}
				if ( isset($_POST["update-name-".form_field_name($import_hf->name)]) )
				{
					$show_value = $_POST["update-name-".form_field_name($import_hf->name)];
				}
				echo "<input type='text' style='background-color:".rcolor().";width:500;display:inline;$green_style;' name='update-name-".form_field_name($import_hf->name)."' value='".htmlspecialchars($show_value,ENT_QUOTES)."'/>";

				$imported_function_exists=false;
				echo "<br/>";
				if ( count($matched_functions)> 0 )
				{
					$imported_function_exists=true;
				}

				$found_all_needed_inherits=true;
				$matched_inherits=array();
				foreach ($import_hf->obj_hf_inherit as $inherit)
				{
					foreach ($all_hfs as $library_hf)
					{
						if ($inherit->name==$library_hf['name'])
						{
							$matched_inherits[]=$library_hf;
						}
					}
					foreach ($import_hfs as $hf_importing)
					{
						if ($inherit->name==$hf_importing->name)
						{
							$matched_inherits[]=$hf_importing;
						}
					}
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo getTranslation("Inherits From",$settings).":";
					echo " ";
					if ( count($matched_inherits) > 1 )
					{

						$corrected_inherit=false;
						foreach ($step_2_corrections as $s2c)
						{
							if ($s2c == "inheritor-".form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name) )
							{
								$corrected_inherit=true;
							}
						}
						$green_style="";
						$show_value = "library";
						if ($corrected_inherit)
						{
							$green_style="background-color:green;color:white;";
						}
						echo "<select style='background-color:".rcolor().";width:500px;display:inline;$green_style' name='inheritor-".form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)."'>";
						if ( isset($_POST["inheritor-".form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)] ) ) 
						{
							$show_value = $_POST["inheritor-".form_field_name($import_hf->name)."-inherits-".form_field_name($inherit->name)];
						}
						foreach ($matched_inherits as $matched_inherit)
						{
							$sel_txt = "";
							if (isset($matched_inherit->name) )
							{
								if ($matched_inherit->from==$show_value)
								{
									$sel_txt = " selected='selected'";
								}
								echo "<option$sel_txt value='".htmlspecialchars($matched_inherit->from)."'>".htmlspecialchars($matched_inherit->name)." (".getTranslation("from ".$matched_inherit->from,$settings).")"."</option>";
							}
							else
							{
								if ($matched_inherit['from']==$show_value)
								{
									$sel_txt = " selected='selected'";
								}
								echo "<option$sel_txt value='".htmlspecialchars($matched_inherit['from'])."'>".htmlspecialchars($matched_inherit['name'])." (".getTranslation("from ".$matched_inherit['from'],$settings).")"."</option>";
							}
						}
						echo "</select>";
						echo "<img src='images/checkmark.png' width='40'/>";
					}
					else if ( count($matched_inherits) == 1 )
					{
						foreach ($matched_inherits as $matched_inherit)
						{
							echo "<b>";
							echo $matched_inherit->name;
							echo " (". getTranslation("from ".$matched_inherit->from,$settings).")";
							echo "</b>";
							echo "<img src='images/checkmark.png' width='40'/>";
							echo "<input type='hidden' name='inheritor-".form_field_name($import_hf->name)."-inherits-".form_field_name($matched_inherit->name)."' value='".$matched_inherit->from."'>";
						}
					}
					else
					{
						echo "<select style='background-color:".rcolor().";width:500px;display:inline;'>";
						echo "<option>";
						echo $inherit->name;
						echo "</option>";
						echo "</select>";
						echo "<img src='images/failure.png' width='40'/>";
						$found_all_needed_inherits=false;
					}
                    echo "<br/>";
				}
				if ( count($import_hf->obj_hf_inherit)==0 )
				{
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo getTranslation("Inherits From",$settings).": ";
					echo "<select style='background-color:".rcolor().";width:500px;display:inline;'>";
					echo "<option>";
					echo getTranslation("None",$settings);
					echo "</option>";
					echo "</select>";
					echo "<img src='images/checkmark.png' width='40'/>";
				}
				echo "<br/>";

				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo "&nbsp;&nbsp;";
				echo getTranslation("Import Behavior",$settings).": ";


				$corrected_import_behavior=false;
				foreach ($step_2_corrections as $s2c)
				{
					if ($s2c == 'import-behavior-'.form_field_name($import_hf->name))
					{
						$corrected_import_behavior=true;
					}
				}
				$green_style="";
				$show_value = "";
				if ($corrected_import_behavior)
				{
					$green_style="background-color:green;color:white;";
				}
				if ( isset($_POST['import-behavior-'.form_field_name($import_hf->name)]) )
				{
					$show_value=$_POST['import-behavior-'.form_field_name($import_hf->name)];
				}

				echo "<select name='import-behavior-".form_field_name($import_hf->name).""."' style='background-color:".rcolor().";display:inline;$green_style;'>";
				$dupe_function_disable="";
				$skip_select=" selected='selected'";
				$a_new_function_disable=" disabled='disabled'";
				if (!$imported_function_exists)
				{
					$dupe_function_disable=" disabled='disabled'";
					$a_new_function_disable="";
					$skip_select="";
				}
				$error_import_from_future_version=false;
				$new_hf_test = new hf_id_user();
				$current_hf_xml_version = $new_hf_test->obj_version;
				$import_hf_xml_version = $import_hf->obj_version;
				//echo "CURRENT: ".$current_hf_xml_version;
				if ($current_hf_xml_version != $import_hf_xml_version )
				{
					$current_stamp_list=explode("-",$current_hf_xml_version);
					$import_stamp_list=explode("-",$import_hf_xml_version);
					$current_stamp_year = intval($current_stamp_list[0]);
					$current_stamp_month= intval($current_stamp_list[1]);
					$current_stamp_day = intval($current_stamp_list[2]);
					$import_stamp_year = intval($import_stamp_list[0]);
					$import_stamp_month= intval($import_stamp_list[1]);
					$import_stamp_day = intval($import_stamp_list[2]);
					$current_stamp = ($current_stamp_year*365)+($current_stamp_month*30)+$current_stamp_day;
					$import_stamp = ($import_stamp_year*365)+($import_stamp_month*30)+$import_stamp_day;
					if ($import_stamp>$current_stamp)
					{
						$error_import_from_future_version = true;
					}
				}
				if ($error_import_from_future_version)
				{
					echo "<option value='error'>".getTranslation("Please upgrade your HIS installation, this HF XML file is from a newer version of HIS.",$settings)."</option>";
				}
				elseif ($found_all_needed_inherits)
				{
					$sel_txt="";
					if ( $show_value=="new")
					{
						$sel_txt=" selected='selected'";
						$skip_select="";
					}
					echo "<option$sel_txt value='new'>".getTranslation("Create new function",$settings);
					if ($imported_function_exists)
					{
						echo " ".getTranslation("(change function name)",$settings);
					}
					echo "</option>";
					$sel_txt="";
					if ( $show_value=="replace")
					{
						$sel_txt=" selected='selected'";
						$skip_select="";
					}
					echo "<option$sel_txt value='replace'$dupe_function_disable>".getTranslation("Overwrite/replace existing function",$settings)."</option>";
					$sel_txt="";
					if ( $show_value=="skip")
					{
						$sel_txt=" selected='selected'";
						$skip_select="";
					}
					echo "<option$sel_txt value='skip'$skip_select>".getTranslation("Skip importing this function",$settings)."</option>";
				}
				else
				{
					echo "<option value='error'>".getTranslation("Unable to import function",$settings)."</option>";
				}
				echo "</select>";
				echo "<br/>";

				if ($imported_function_exists)
				{
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo getTranslation("Update current library functions who inherit from this function,",$settings);
					echo "<br/>";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo getTranslation("to have their inheritances point to this newly imported function?",$settings);
					echo "<br/>";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";
					echo "&nbsp;&nbsp;";

					$corrected_update_inheritors=false;
					foreach ($step_2_corrections as $s2c)
					{
						if ($s2c == 'update-inheritors-'.form_field_name($import_hf->name))
						{
							$corrected_update_inheritors=true;
						}
					}
					$green_style="";
					$show_value = "";
					if ($corrected_update_inheritors)
					{
						$green_style="background-color:green;color:white;";
					}
					if ( isset($_POST['update-inheritors-'.form_field_name($import_hf->name)]) )
					{
						$show_value=$_POST['update-inheritors-'.form_field_name($import_hf->name)];
					}

					echo "<select name='update-inheritors-".form_field_name($import_hf->name).""."' style='background-color:".rcolor().";width:500px;display:inline;$green_style;'>";
					$sel_txt="";
					if ($show_value=="no")
					{
						$sel_txt=" selected='selected'";
					}
					echo "<option$sel_txt value='no'>";
					echo getTranslation("No",$settings);
					echo "</option>";
					$sel_txt="";
					if ($show_value=="yes")
					{
						$sel_txt=" selected='selected'";
					}
					echo "<option$sel_txt value='yes'>";
					echo getTranslation("Yes",$settings);
					echo "</option>";
					echo "</select>";
					echo "<br/>";
				} // END IF (IMPORTED FUNCTION EXISTS)

				echo "</ul>";

				echo "<hr/>";
			} // END FOR (LOOP BACKWARD THROUGH ALL IMPORTED HFS)

			if ( intval($_GET['step'])==1 )
			{
				echo "<center>";
				echo "<input type='submit' style='background-color:".rcolor()."' value='";
				echo getTranslation("Continue and Import Functions into Library",$settings);
				echo "'/>";
				echo "</center>";
			}
			echo "</form>";
			echo "</td></tr>";
		} // end if (step 1 or 2)




	} // END IF (IMPORTED FILE UPLOADED)
}


if ( isset($_GET['v']) )
{
if ($_GET['v']=="download")
{

	echo "<h3 style='padding-left:30px;'>";
	echo getTranslation("STEP 1: HIS Web Interface - Source",$settings);
	echo "</h3>";

	echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
	echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

	echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?get=current'>";
	echo getTranslation("Download",$settings);
	echo " Zip (12MB)</a>";

	echo "<br/>";

	echo "<a style='zIndex:2;;color:black;' href='https://humanintelligencesystem.com/version?get=current&type=tar'>";
	echo getTranslation("Download",$settings);
	echo " Tar (21MB)</a>";
	echo "<br/>";
	echo "<br/>";

	echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?get=current'>";
	echo getTranslation("Latest Release",$settings);
	echo " Jul 16, 2014</a>";

	echo "<br/>";


	echo "</td>";
	echo "</tr>";
	echo "</table>";


	echo "<ul>";
	echo "<ul>";
	echo getTranslation("Extract to your www/ folder, and browse to index.php",$settings);
	echo "</ul>";
	echo "</ul>";

	echo "<br/>";



	$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	if ( strpos($ua,"windows nt")===FALSE || isset($_GET['showall']) )
	{

		echo "<h3 style='padding-left:30px;'>";
		echo getTranslation("STEP 2: HIS Server - Linux Server Install Script",$settings);
		echo "</h3>";

		echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
		echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

		echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?dl=server-linux'>";
		echo getTranslation("Download",$settings);
		echo " Tar (6KB)</a>";

		echo "<br/>";
		echo "<br/>";


		echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?dl=server-linux'>";
		echo getTranslation("Latest Release",$settings);
		echo " Oct 12, 2013</a>";
		echo "<br/>";
		echo "<span style='padding-left:30px;font-size:13px;'><a href='?v=addserver-linux' style='color:black;'>";
		echo getTranslation("View Install Instructions Here",$settings);
		echo "</a></span>";

		echo "<br/>";

		echo "</td>";
		echo "</tr>";
		echo "</table>";


		echo "<ul>";
		echo "<ul>";
		echo getTranslation("Run ./install-linux-his-server.sh",$settings);
		echo "</b>";
		echo "</ul>";
		echo "</ul>";

		echo "<br/>";

	}

	$ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	if ( strpos($ua,"windows nt")!==FALSE || isset($_GET['showall']) )
	{
		echo "<h3 style='padding-left:30px;'>";
		echo getTranslation("STEP 2: HIS Server - Windows Server Install Script",$settings);
		echo "</h3>";

		echo "<table border='0' cellspacing='0' cellpadding='0' width='350' height='100' style='margin-left:60px;'>";
		echo "<tr><td valign='top' style='padding:15px;padding-left:60px;background-image:url(\"images/download_banner.png\");background-repeat:no-repeat;background-size:100% 100%;'>";

		echo "<a style='zIndex:2;color:black;' href='https://humanintelligencesystem.com/version?dl=server-win'>";
		echo getTranslation("Download",$settings);
		echo " Zip (1.8MB)</a>";

		echo "<br/>";
		echo "<br/>";

		echo "<a style='zIndex:2;color:black;text-decoration:none;font-size:16px;' href='https://humanintelligencesystem.com/version?dl=server-win'>";
		echo getTranslation("Latest Release",$settings);
		echo " Oct 20, 2013</a>";
		echo "<br/>";
		echo "<span style='padding-left:30px;font-size:13px;'><a href='?v=addserver-win' style='color:black;'>";
		echo getTranslation("View Install Instructions Here",$settings);
		echo "</a></span>";
		echo "<br/>";

		echo "</td>";
		echo "</tr>";
		echo "</table>";

		echo "<ul>";
		echo "<ul>";
		echo getTranslation("Double-click install-win-his-server.vbs",$settings);
		echo "</ul>";
		echo "</ul>";

		echo "<br/>";


	}

	echo "<br/>";
	echo "<br/>";
	echo "<ul>";
	if ( !isset($_GET['showall']) )
	{
		echo "<a href='?v=download&showall'>";
		echo getTranslation("Click here to show all Download options",$settings);
		echo "</a>";
	}
	else
	{
		echo "<a href='?v=download'>";
		echo getTranslation("Click here to show normal Download options",$settings);
		echo "</a>";
	}
	echo "<br/>";
	echo "<br/>";
	echo "<a href='https://humanintelligencesystem.com/all-downloads/'>";
	echo getTranslation("Click here to show older downloads",$settings);
	echo "</a>";

	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";


}
}


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="his-overview" || $_GET['v']=="login")
{
	/*
	if ( isset($_GET['s']) )
	{
		echo "<b>";
		echo getTranslation("Important Information",$settings);
		echo "</b>";
		echo "<ul>";
		echo "<b style='color:red;'>Function Tag(s) ".$_GET['s']." were given as substitute for &q=3f8bcd... Function ID in the URL, but no hf was matched.</b>";
		echo "</ul>";
	}*/

	echo "<ul>";

	echo getTranslation('overview1',$settings);

	echo "</ul>";
	echo "<style>td.features {width:'33%';";
	echo "font-size:13px;";
	echo "text-align:center;font-weight:bold;}</style>";
	echo "<table width='100%'>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("Input THIS, Output THAT",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Apolitical logic repository",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Nested String Processing",$settings);
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("Scalable Storage",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Code if you want",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Focus on Action",$settings);
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("Any language",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Any infrastructure",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Collect data from anywhere",$settings);
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("Job Submission",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("API for APIs",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Automate anything",$settings);
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("Text Filtering Wizard",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("Long Running Jobs",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("POSTBACK Enabled",$settings);
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='features'>";
	echo getTranslation("HIS Functions are Exportable",$settings);
	echo "</td>";
	echo "<td class='features'>";
	echo getTranslation("HIS XML Exports = Open Format",$settings);
	echo "</td>";
	echo "</tr>";
	echo "</table>";

	echo "<br/>";
	echo "<br/>";

	echo "<ul>";

	echo getTranslation('overview2',$settings);

	echo "<br/>";
	echo "<br/>";
	echo "</ul>";

}
}


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="hf-list" )
{
	echo "<b>";
	echo getTranslation("Function List",$settings);
	echo "</b>";
	echo "<br/>";
	echo "<br/>";


	echo getTranslation('functionlist1',$settings);
	echo "<br/>";
	echo "<br/>";

	//echo "<pre style='font-family:Courier New;'>";
	$u->build(array("obj_servers","obj_inherits"));

	$qs = $u->obj_hfs;

	$qc=1;
	$print_list="";
	if ( count($qs)>0 )
	{
		$print_list="<table style='padding-left:40px;'>";
		$print_list.="<tr>";
		foreach ($qs as $qk=>$qv)
		{
			$astyle="font-size:12px;";
			$print_list.="<td nowrap='nowrap'>";
			$print_list=$print_list."<a style='$astyle' href='?q=".$qv->id."&v=overview'><h3 style='display:inline;'>{$qv->name}</h3></a>";
			$print_list.="</td>";
			if ($qc%3==0&&$qc>1)
			{
				$print_list.="</tr>";
				$print_list.="<tr>";
			}
			$qc=$qc+1;

		} // end foreach (hf)
		if ($qc%3!=0||$qc==0)
		{
				$print_list.="</tr>";
		}
		$print_list.="</table>";
	} // end if (any hfs exist)

	if ($qc>0)
	{
		echo $print_list;
	}
	echo "<br/>";
	echo "<br/>";

	if ( count($qs)==0 )
	{
		echo "<ul>";
		echo getTranslation('no hfs',$settings);
		echo " <a href='?v=add-hf'>";
		echo getTranslation('here',$settings);
		echo "<img width='50' src='images/add-hf.png'/>";
		echo "</a>";
		echo "<br/>";
		echo "<br/>";
		echo "</ul>";
	}



	echo "<b>";
	echo getTranslation("System Kind List",$settings);
	echo "</b>";
	echo "<br/>";

	$sks=$u->obj_system_kinds;
	//echo "<pre>";
	//print_r($u->obj_system_kinds);

	echo "<ul>";

	echo getTranslation('sklist1',$settings);

	echo "<br/>";
	echo "<br/>";
	echo "<ul>";
	foreach ($u->obj_system_kinds as $sk)
	{
		echo $sk->name;
		echo "<br/>";
	}
	echo "</ul>";



	echo "</ul>";

	if ( count($sks)==0 )
	{
		echo "<ul>";
		echo getTranslation('no sks',$settings);
		echo "</ul>";
	}



}
} // end if (view - overview)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="add-hf" )
{
/*
		$rtoptions="<option value=''></option>";
	foreach ($STATIC['hf_resource_types'] as $hf_resource_type_key=>$hf_resource_type_value ){
			$rtoptions=$rtoptions."<option value='".$hf_resource_type_key."'>".$hf_resource_type_value."</option>";
	}
	*/
	$rotxt="";
	$rotxt=$rotxt."<span style='background-color:".rcolor().";width:400;'><input type='checkbox' name='system_kind[]' value='any' />Any</span>";
	$u->build(array("obj_servers","obj_hfs"));


	if ($u->obj_system_kinds)
	{
		foreach ($u->obj_system_kinds as $system_kind)
		{
			$chktxt = "";
			if ( isset($_POST['system_kind']) )
			{
				if ( in_array($system_kind->id,$_POST['system_kind']) )
				{
					$chktxt=" checked='checked'";
				}
			}
			$rotxt=$rotxt."<span style='background-color:".rcolor().";width:400;'><input$chktxt type='checkbox' name='system_kind[]' value='".$system_kind->id."' />".$system_kind->name."</span>";
		}
	}

	echo "<h2>";
	echo getTranslation("Add Function",$settings);
	echo "</h2>";

	echo "<ul>";
	echo "<form style='display:inline;' action='?action=add-hf&v=hf-list' method='post'>";
	echo "<table style='padding-left:40px;' border='0'>";
	echo "<tr>";

	$fun_name="";
	if ( isset($_POST['name']) )
	{
		$fun_name=str_replace("'","&#39;",$_POST['name']);
	}

	echo "<td >".getTranslation("Function Name",$settings)."</td>";
	echo "<td valign='top'><input type='text' value='$fun_name' name='name' style='background-color:".rcolor().";margin:0px;width:500' /></td>";
	echo "<td valign='top' style='font-size:10px;'>";
	echo "</td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td>";
	echo "<br/>";
	echo "</td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td valign='top'>";

	echo "(";
	echo getTranslation("Optional",$settings);
	echo ")";
	echo "<br/>";
	echo getTranslation("Source Code",$settings);
	echo "<br/>";
	echo getTranslation("Content in your run.bat",$settings);
	echo "</td>";
	$src_txt="";
	if ( isset($_POST['str_hf_resource']) )
	{
		$src_txt=str_replace("<","&lt",$_POST['str_hf_resource']);
	}

	echo "<td valign='top'><textarea name='str_hf_resource' style='background-color:".rcolor().";width:500;margin:0px;' rows='5'>";
	echo $src_txt;
	echo "</textarea></td>";
	echo "<td valign='top' style='font-size:10px;'>";
	echo getTranslation("When your function is executed (as a \"job\" on a remote server), this content will first be written into a text file created in a FRESH new folder created specifically for the job.",$settings);
	echo "</td>";
	echo "</tr>";


	echo "<tr>";
	echo "<td>";
	echo "<br/>";
	echo "</td>";
	echo "</tr>";


	echo "<tr>";
	echo "<td nowrap='nowrap' style='padding-right:15px;' valign='top'>".getTranslation("Automation Type",$settings)."</td>";
	echo "<td valign='top'>";

	echo "<select name='id_inherit' style='background-color:".rcolor().";margin:0px;width:500;'>";
	echo "<option value=''>default system batch/shell</option>";
	foreach ($u->obj_inherits as $user_inherit)
	{
		// id_user
		// id_hf
		$hf_obj=new hf_id_user();
		$all_hfs = $hf_obj->get_from_hashrange($user_inherit->id_user,$user_inherit->id_hf);
		if ( $all_hfs )
		{
			foreach ( $all_hfs as $each_hf )
			{
				$a_hf = new hf_id_user();
				$a_hf->set( $each_hf );

				$seltxt="";
				if ( isset($_POST['id_inherit']) )
				{
					if ($_POST['id_inherit']==$a_hf->id)
					{
						$seltxt=" selected='selected'";
					}
				}
				echo "<option$seltxt value='".$a_hf->id."'>HIS ".getTranslation("Function",$settings).": ";
				echo $a_hf->name;
				echo "</option>";
			}
		}
		//print_r($user_inherit);
	}
	echo "</select>";
	echo "</td>";
	echo "<td valign='top' style='font-size:10px;'>";
	echo getTranslation("Inherit files, parameters, and logic from existing HIS Functions.",$settings);
	echo "</td>";
	echo "</tr>";


	echo "<tr><td valign='top'>".getTranslation("Run On",$settings)."</td><td>$rotxt</td></tr>";


	/*
	echo "<tr><td valign='top'>Filtering Expression</td><td><textarea name='expr' style='width:500;' rows='5'></textarea></td></tr>";
	echo "<tr><td>Expression Type</td><td><select name='expression_type' style='width:500;'>$etoptions</select></td></tr>";
	echo "<tr><td valign='top'>Output Expression</td><td><textarea name='output_expression' style='width:500;' rows='5'></textarea></td></tr>";
	echo "<tr><td>Output Type</td><td><select name='output_type' style='width:500;'>$otoptions</select></td></tr>";
	*/
	echo "<tr><td><input style='background-color:".rcolor()."' value='";
	echo getTranslation("Submit",$settings);
	echo "' type='submit'/></td></tr>";
	echo "</table>";
	echo "</form>";

	echo "</ul>";

	echo "<h2>";
	echo getTranslation("Import Function",$settings);
	echo "</h2>";

	echo "<ul>";
	echo "<h3 display:inline;>";
	echo getTranslation("Select a HF XML file to import into your HIS Library.",$settings);
	echo "</h3>";
	echo "<form style='display:inline;' action='?action=import-function&v=import&step=1' method='POST' enctype='multipart/form-data'>";
	echo "<input type='file' name='import_file' style='background-color:".rcolor().";display:inline;font-size:24px;'>";
	echo "<input type='submit' name='btnSubmit' value='";
	echo getTranslation("Submit",$settings);
	echo "' style='background-color:".rcolor().";display:inline;'/>";
	echo "</form>";

	echo "<br/>";
	echo "<br/>";
	echo getTranslation("Max File Upload Size",$settings);
	echo ": ";
	echo (getMaximumFileUploadSize());

	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";
	echo "<br/>";



	echo "<!--";
	echo "<h2>";
	echo getTranslation("Add System Kind (Linux, Windows, Mac, ...)",$settings);
	echo "</h2>";

	echo "<form action='?action=add-system-kind' method='post'>";
	echo "<table>";
	echo "<tr><td valign='top'>";
	echo getTranslation("Name",$settings);
	echo "</td><td><textarea name='name' style='width:500;' rows='5'></textarea></td></tr>";
	echo "<tr><td valign='top'>";
	echo getTranslation("Detection Code php_uname('s')",$settings);
	echo "</td><td><textarea name='detection_text' style='width:500;' rows='5'></textarea></td></tr>";

	echo "<tr><td><input value='";
	echo getTranslation("Submit",$settings);
	echo "' type='submit'/></td></tr>";

	echo "</table>";
	echo "</form>";
	echo "-->";

	echo "<!--";
	echo "<h2>";
	echo getTranslation("Invite User",$settings);
	echo "</h2>";

	echo "<ul>";

	$rtoptions="<option value=''></option>";
	foreach ($STATIC['hf_resource_types'] as $hf_resource_type_key=>$hf_resource_type_value ){
			$rtoptions=$rtoptions."<option value='".$hf_resource_type_key."'>".$hf_resource_type_value."</option>";
	}
	/*
	$etoptions="<option value=''></option>";
	$filter_types = $db->select_table("SELECT id,filter_type FROM filter_types");
	if ( is_array($filter_types) )
	{
			foreach ( $filter_types as $k=>$r )
			{
					$etoptions=$etoptions."<option value='".$r['id']."'>".$r['filter_type']."</option>";
			}
	}*/
	/*
	$otoptions="<option value=''></option>";
	foreach ( $db->select_table("SELECT id,output_type FROM output_types") as $k=>$r )
	{
			$otoptions=$otoptions."<option value='".$r['id']."'>".$r['output_type']."</option>";
	}*/
	echo "<form action='?action=add-hf' method='post'>";
	echo "<table>";
	echo "<tr><td valign='top'>";
	echo getTranslation("E-mail Addresses (one per line)",$settings);
	echo "</td><td><textarea name='str_hf_resource' style='width:500;' rows='5'></textarea></td></tr>";
	echo "</table>";
	echo "</form>";

	echo "</ul>";
	echo "-->";


}
} // end if (add hf)

if ( isset($_GET['v']) )
{
if ($_GET['v']=="settings")
{

	echo "<b>";
	echo getTranslation("User Keys",$settings);
	echo "</b>";
	echo "<ul>";

	echo getTranslation("user key summary",$settings);
	echo "<br/>";
	echo "<br/>";

	echo "<b>UID:</b>";
	echo " ";
	echo "<span style='background-color:".rcolor().";display:inline;'>";
	echo $u->id_user;
	echo "</span>";
	echo "<br/>";
	echo "<br/>";
	echo "<b>";
	echo getTranslation("Secret Key",$settings);
	echo ":</b>";
	echo " ";
	echo " ";
	echo "<script type='text/javascript'>";
	echo "var show_secret=false;";
	echo "function switch_secret()";
	echo "{";
	echo "	if (!show_secret)";
	echo "	{";
	echo "		document.lock_image.src='images/unlocked.png';";
	echo "		document.getElementById('show_secret').innerHTML='<input type=\"text\" id=\"show_secret_text\" style=\"text-decoration:none;background-color:".rcolor().";display:inline;width:600px;text-decoration:none;font-weight:regular;\" value=\"".$u->secret."\"/>';";
	echo "		document.getElementById('show_secret_text').focus();";
	echo "	}";
	echo "	else";
	echo "	{";
	echo "		document.lock_image.src='images/locked.png';";
	echo "		document.getElementById('show_secret').innerHTML='".getTranslation("Click to Show",$settings)."';";
	echo "	};";
	echo "	show_secret=!show_secret;";
	echo "}";
	echo "</script>";
	echo "<span style='background-color:".rcolor().";display:inline;'>";
	echo "<a href='javascript:void(0);' style='color:black;'>";
	// insert randomization here
	echo "<img border='0' height=20 style='position:relative;top:3px;' name='lock_image' id='lock_image' height=50 src='images/locked.png' onClick='switch_secret();'/>";
	echo "<span style='display:inline;' id='show_secret' onClick='switch_secret();'>".getTranslation("Click to Show",$settings)."<noscript>: ".$u->secret."</noscript></span>";
	echo "</a>";
	echo "</span>";
	echo "<br/>";
	echo "<br/>";
	echo getTranslation("Never give your Secret Key to anyone.",$settings);
	echo "<br/>";
	echo "<br/>";
	echo "<b>".getTranslation('make new secret key',$settings)."</b>";
	echo "<br/>";
	echo "<ul>";
	echo "<form action='?q=$qn&v=settings&action=generate-new-secret-key' method='post'><input type='submit' style='background-color:".rcolor()."' value='".getTranslation('make new secret key',$settings)."'/></form>";
	echo "</ul>";
	echo "</ul>";
	echo "<br/>";

	echo "<table width='600'><tr><td width='400'>";

	echo "<b>";
	echo getTranslation("User Language",$settings);
	echo "</b>";
	echo "<ul>";
	echo "<form action='?v=settings&action=update-language' method='post'>";
	echo "<select name='user_language' style='display:inline;background-color:".rcolor().";'>";
	echo "<option value=''>(use default)</option>";
	$display_language="";
	foreach ($STATIC['languages'] as $language_key=>$language_value)
	{
		$seltxt="";
		if ($language_key==$u->lang || ($u->lang=="undefined" && $language_key==$settings['language']['@attributes']['value']) )
		{
			$display_language=$language_key;
			$seltxt=" selected";
		}
		echo "<option value='$language_key'$seltxt>$language_value</option>";
	}
	echo "</select>";
	echo "<input style='display:inline;background-color:".rcolor()."' type='submit' value='";
	echo getTranslation("Submit",$settings);
	echo "'/>";
	echo "</form>";
	echo "</ul>";

	echo "</td><td>";

	echo "<img src='images/".$display_language.".png'/>";

	echo "</td></tr></table>";

	echo "<br/>";



}
}

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="server-info" )
{
	//$APP['ms']->send_message($APP['ms']->queue_prefix."testing","hello world".time());
	//sleep(1.5);
	//$response = $APP['ms']->read_message($APP['ms']->queue_prefix."testing");
	//echo $response;

	echo "<b>";
	echo getTranslation("HIS System Information",$settings);
	echo ": ";
	echo "</b>";
	echo "<ul>";
	
	echo "<b>";
	echo getTranslation("Software Version",$settings);
	echo ": ";
	echo "</b>";
	echo $software_version;
	echo "<br/>";
	
	
	echo "<b>";
	echo getTranslation("Database Version",$settings);
	echo ": ";
	echo "</b>";
	$sys_setting = new sys_setting();
	$sys_setting->get_from_hashrange("system","version");
	echo $sys_setting->val;
	echo "<br/>";


	echo "<b>";
	echo getTranslation("HF XML File Format Version",$settings);
	echo ": ";
	echo "</b>";
	echo $software_version;
	echo "<br/>";

	echo "</ul>";
	
	
	echo "<table width='600'><tr><td width='500'>";

	echo "<b>";
	echo getTranslation("Memory (database)",$settings);
	echo ": ";
	echo "</b>";
	echo "<ul>";
	echo "<b>";
	echo getTranslation("Type",$settings);
	echo "</b>";
	echo ": ";
	echo strtoupper($APP['db']->kind);
	echo "<br/>";
	echo "<b>";
	echo getTranslation("Address",$settings);
	echo ": ";
	echo "</b>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		echo $APP['db']->url;
		//echo $GLOBALS['settings'][$GLOBALS['settings']['memory']['@attributes']['value']]['server']['@attributes']['value'];
	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}
	echo "<br/>";
	echo "<b>";
	echo getTranslation("Database Name",$settings);
	echo "</b>";
	echo ": ";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		echo $APP['db']->dbname;
	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}

	echo "<br/>";
	echo "</ul>";

	echo "</td><td>";
	echo "<img width='50' height='50' src='images/".$GLOBALS['settings']['memory']['@attributes']['value'].".png'/>";

	echo "</td></tr></table>";


	echo "<table width='600'><tr><td width='500'>";

	echo "<b>";
	echo getTranslation("Storage (files)",$settings);
	echo ": ";
	echo "</b>";
	echo "<ul>";
	echo "<b>";
	echo getTranslation("Type",$settings);
	echo ": ";
	echo "</b>";
	echo strtoupper($GLOBALS['settings']['storage']['@attributes']['value'])."<br/>";
	echo "</ul>";

	echo "</td><td>";
	echo "<img width='50' height='50' src='images/".$GLOBALS['settings']['storage']['@attributes']['value'].".png'/>";

	echo "</td></tr></table>";

	echo "<table width='600'><tr><td width='500'>";

	echo "<b>";
	echo getTranslation("Messaging (message queue)",$settings);
	echo ": ";
	echo "</b>";
	echo "<ul>";
	echo "<b>";
	echo getTranslation("Type",$settings);
	echo ": ";
	echo "</b>";
	echo strtoupper($GLOBALS['settings']['messenger']['@attributes']['value'])."<br/>";
	echo "</ul>";

	echo "</td><td>";
	echo "<img width='50' height='50' src='images/".$GLOBALS['settings']['messenger']['@attributes']['value'].".png'/>";

	echo "</td></tr></table>";


	echo "<br/>";

	echo "<b>";
	echo getTranslation("Server",$settings);
	echo ":";
	echo "</b>";
	echo "<ul>";
		echo "<b>";
		echo getTranslation("Server Address",$settings);
		echo ": ";
		echo "</b>";
		echo $this_server_url."<br/>";
	if ( isset($_SERVER['SERVER_NAME']))
	{
		echo "<b>";
		echo getTranslation("Server Name",$settings);
		echo ": ";
		echo "</b>";
		echo $_SERVER['SERVER_NAME']."<br/>";
	}
	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		if ( isset($_SERVER['SCRIPT_FILENAME']) )
		{
			echo "<b>";
			echo getTranslation("HIS Directory Path",$settings);
			echo ": ";
			echo "</b>";
			echo str_replace("index.php","",$_SERVER['SCRIPT_FILENAME'])."<br/>";
		}
		if ( isset($_SERVER['HTTPS']) )
		{
			echo "<b>";
			echo "HTTPS: ";
			echo "<b>";
			echo $_SERVER['HTTPS']."<br/>";
		}
		if ( isset($_SERVER['SCRIPT_URI']) )
		{
			echo "<b>";
			echo "Script URI: ";
			echo "</b>";
			echo $_SERVER['SCRIPT_URI']."<br/>";
		}
		//echo "Apache Version: ".apache_get_version()."<br/>";
		if ( isset($_SERVER['SERVER_SOFTWARE']) )
		{
			echo "<b>";
			echo getTranslation("Server Software",$settings);
			echo ": ";
			echo "</b>";
			echo $_SERVER['SERVER_SOFTWARE']."<br/>";
		}
		if ( isset($_SERVER['HTTP_USER_AGENT']) )
		{
			echo "<b>";
			echo getTranslation("User Agent",$settings);
			echo ": ";
			echo "</b>";
			echo $_SERVER['HTTP_USER_AGENT']."<br/>";
		}
		echo getTranslation("System",$settings);
		echo ": ".php_uname()."<br/>";
		echo "<b>";
		echo "PHP OS: ";
		echo "</b>";
		echo PHP_OS."<br/>";
		echo "<b>";
		echo "PHP ";
		echo getTranslation("Version",$settings);
		echo ": ";
		echo "</b>";
		echo phpversion();
		echo "<br/>";
		echo "<b>";
		
		// ADD SECTION FOR RECOMMENDED/ADDITIONAL PHP EXTENSIONS?
		
		echo "PHP ";
		echo getTranslation("Extensions",$settings);
		echo ": ";
		echo "</b>";
		echo "<br/>";
		echo "<ul>";
		echo "<table>";
		$i=0;
		foreach (get_loaded_extensions() as $extension)
		{
			if ($i%6==0)
			{
				echo "<tr>";
			}
			echo "<td style='padding-right:20px;'>";
			echo $extension;
			echo "</td>";
			$i=$i+1;
			if ($i%6==0)
			{
				echo "</tr>";
			}
		}
		echo "</table>";
		echo "</ul>";

		// ADD SECTION FOR RECOMMENDED STREAM WRAPPERS/WARNINGS FOR EXAMPLE IF HTTPS IS NOT FOUND
		
		echo "<br/>";
		echo "<b>";
		echo "PHP ";
		echo getTranslation("Stream Wrappers",$settings);
		echo ": ";
		echo "</b>";
		echo "<br/>";
		echo "<ul>";
		echo "<table>";
		$i=0;
		foreach (stream_get_wrappers() as $extension)
		{
			if ($i%6==0)
			{
				echo "<tr>";
			}
			echo "<td style='padding-right:20px;'>";
			echo $extension;
			echo "</td>";
			$i=$i+1;
			if ($i%6==0)
			{
				echo "</tr>";
			}
		}
		echo "</table>";
		echo "</ul>";
	
		/*
		echo "PHP Curl: <br/>";
		echo "<ul>";
		echo "<pre style='font-size:8px;'>";
		echo print_r(curl_version());
		echo "</pre>";
		echo "</ul>";
		*/
		// add mbstring

		//phpinfo();

	}

	
	echo "</ul>";
	
	echo "</ul>";

}
} // end if (hf search)



if ( isset($_GET['v']) )
{
if ( $_GET['v']=="addserver-win" )
{

	echo "<br/>";
	echo "<a href='?v=map' style='color:black;'>";
	echo " ";
	echo getTranslation("Back to Cluster Map",$settings);
	echo "<img src='images/back.png' border='0' width='30'/>";
	echo "</a>";
	echo "<h3>";
	echo getTranslation("Windows Job Server Setup Instructions",$settings);
	echo ":</h3>";

	echo "<ul>";

	echo "<h3>";
	echo "1. ";
	echo getTranslation("Download",$settings);
	echo " ";
	echo "<a href='https://humanintelligencesystem.com/version?dl=server-win'>his-server-installer-win-wget.zip</a></h3>";
	echo "<h3>";
	echo "2. ";
	echo getTranslation("Extract the zip file, folder \"his-server-installer-win-wget\" is created",$settings);
	echo "</h3>";
	echo "<h3>";
	echo "3. ";
	echo getTranslation("Open the folder",$settings);
	echo "</h3>";

	echo "<h3>4. ";
	echo getTranslation("Copy the text below & paste into new file \"his-config.php\" in your server folder",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		$settings_file_content=file_get_contents("his-config.php");
	}
	else
	{
		$settings_file_content=getTranslation("Not available in demo",$settings);
	}

	echo trim($settings_file_content);
	echo "</textarea>";
	echo "</ul>";

	echo "<h3>";
	echo "5. ";
	echo getTranslation("Copy the text below & paste into \"launch_job_cluster.vbs\" in your server folder, on your job server",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";
	echo "Set oShell = CreateObject(\"WScript.Shell\")\n";
	echo "oShell.Run \"run-win-his-server.vbs --name us-east-node1-win7-x64-instance1\",1,false\n";
	echo "oShell.Run \"run-win-his-server.vbs --name us-east-node1-win7-x64-instance2\",1,false\n";
	echo "oShell.Run \"run-win-his-server.vbs --name us-east-node1-win7-x64-instance3\",1,false\n";
	echo "</textarea>";
	echo "</ul>";

	echo "<h3>";
	echo "6. ";
	echo getTranslation("Copy the text below & paste into \"auth.xml\" in your server folder, on your job server",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";


	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{

		echo "<root>\n";
		echo "\t<auth uid='".$u->id_user."' secret='".$u->secret."'/>\n";
		echo "</root>\n";

	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}


	echo "</textarea>";
	echo "</ul>";

	echo "<h3>";
	echo "7. ";
	echo getTranslation("Double-Click \"install-win-his-server.vbs\"",$settings);
	echo "</h3>";


	echo "<center>";
	echo "<a href='?v=map' style='color:black;text-decoration:none;'>";
	echo getTranslation("Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running.",$settings);
	echo "<br/>";
	echo "<img src='images/map.png' border='0' />";
	echo "</a>";
	echo "</center>";


	echo "<h3>";
	echo getTranslation("After completing above steps, your server is now running.",$settings);
	echo "<br/>";
	echo "&nbsp;";
	echo "&nbsp;";
	echo "&nbsp;";
	echo "&nbsp;";
	echo getTranslation("But here are some extra tips for starting & shutting down your server.",$settings);
	echo "</h3>";

	echo "<ul>";
	echo "<ul>";
	echo "<h3>";
	echo "8. ";
	echo getTranslation("Double-Click \"launch_job_cluster.vbs\" to launch your job cluster.",$settings);
	echo "</h3>";
	echo "<h3>";
	echo "9. ";
	echo getTranslation("Double-Click \"kill-win-his-server.bat\" to kill your job cluster.",$settings);
	echo "</h3>";
	echo "</ul>";
	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";


	echo "</ul>";

}
}

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="addserver-linux" )
{
	echo "<br/>";
	echo "<a href='?v=map' style='color:black;'>";
	echo " ";
	echo getTranslation("Back to Cluster Map",$settings);
	echo "<img src='images/back.png' border='0' width='30'/>";
	echo "</a>";
	echo "<h3>";
	echo getTranslation("Linux Job Server Setup Instructions",$settings);
	echo ":</h3>";

	echo "<ul>";

	echo "<h3>";
	echo getTranslation("1. Run these bash commands",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<div style='background-color:rgb(200,200,200);width:600px;font-size:14px;padding-left:20px;padding-right:20px;'>";
	echo "wget --output-document=his-server-installer-linux-wget.tar <a href='https://humanintelligencesystem.com/version?dl=server-linux'>https://humanintelligencesystem.com/version?dl=server-linux</a>";
	echo "<br/>";
	echo "tar xvf his-server-installer-linux-wget.tar";
	echo "<br/>";
	echo "mv his-server-installer-linux-wget his-server";
	echo "<br/>";
	echo "cd his-server";
	echo "<br/>";
	echo "chmod +x install-linux-his-server.sh";
	echo "<br/>";
	echo "echo ";
	echo "<br/>";
	echo "echo ";
	echo "<br/>";
	echo "pwd";
	echo "<br/>";
	echo "ls -l";
	echo "<br/>";
	echo "echo ";
	echo "<br/>";
	echo "<br/>";
	echo "</div>";
	echo "</ul>";

	echo "<h3>";
	echo getTranslation("2. Copy the text below & paste into new file \"his-config.php\" in your server folder",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		$settings_file_content=file_get_contents("his-config.php");
	}
	else
	{
		$settings_file_content=getTranslation("Not available in demo",$settings);
	}
	echo trim($settings_file_content);
	echo "</textarea>";
	echo "</ul>";


	echo "<h3>";
	echo getTranslation("3. Copy the text below & paste into \"launch_job_cluster.sh\" in your server folder, on your job server",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";
	echo "echo \"Launching job server instances...\"\n";
	echo "echo \n";
	echo "nohup ./run-linux-his-server.sh --name us-east-node1-ubuntu-x64-instance1 &\n";
	echo "nohup ./run-linux-his-server.sh --name us-east-node1-ubuntu-x64-instance2 &\n";
	echo "nohup ./run-linux-his-server.sh --name us-east-node1-ubuntu-x64-instance3 &\n";
	echo "</textarea>";
	echo "</ul>";

	echo "<h3>";
	echo getTranslation("4. Copy the text below & paste into \"auth.xml\" in your server folder, on your job server",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<textarea cols='100' rows='10' style='font-size:11px;'>";


	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{

		echo "<root>\n";
		echo "\t<auth uid='".$u->id_user."' secret='".$u->secret."'/>\n";
		echo "</root>\n";

	}
	else
	{
		echo getTranslation("Not available in demo",$settings);
	}


	echo "</textarea>";
	echo "</ul>";

	echo "<h3>";
	echo getTranslation("5. Run these bash commands",$settings);
	echo ":</h3>";
	echo "<ul>";
	echo "<div style='background-color:rgb(200,200,200);width:600px;padding-left:20px;padding-right:20px;'>";
	echo "<h3>chmod +x ./install-linux-his-server.sh<br/><br/>
	./install-linux-his-server.sh</h3>";
	echo "</div>";
	echo "</ul>";

	echo "<center>";
	echo "<a href='?v=map' style='color:black;text-decoration:none;'>";
	echo getTranslation("Be sure to check the \"Cluster Map\" after setting up your server.<br/>Your new server instances will show up on the map instantly once they are running.",$settings);
	echo "<br/>";
	echo "<img src='images/map.png' border='0' />";
	echo "</a>";
	echo "</center>";

	echo "</ul>";


	echo "<h3>";
	echo getTranslation("After completing above steps, your server is now running.",$settings);
	echo "<br/>";
	echo "&nbsp;";
	echo "&nbsp;";
	echo "&nbsp;";
	echo "&nbsp;";
	echo getTranslation("But here are some extra tips for starting & shutting down your server.",$settings);
	echo "</h3>";

	echo "<ul>";
	echo "<ul>";
	echo "<h3>";
	echo getTranslation("6. Launch \"./launch_job_cluster.sh\" to launch your job cluster.",$settings);
	echo "</h3>";
	echo "<h3>";
	echo getTranslation("7. Launch \"./kill-linux-his-server.sh\" to kill your job cluster.",$settings);
	echo "</h3>";
	echo "</ul>";
	echo "</ul>";

	echo "<br/>";
	echo "<br/>";
	echo "<br/>";



	echo "</ul>";


}
}



if ( isset($_GET['v']) )
{
if ( $_GET['v']=="map" )
{

	$sys_setting_version = new sys_setting();
	$sys_setting_version->get_from_hashrange("system","version");
	$database_version = $sys_setting_version->val;


	$canvas_w=878;
	$canvas_h=1000;
	$u->build(array("obj_hfs","obj_system_kinds","obj_inherits"));
	$nodes=$u->obj_servers;


	echo "<table width='700' border='0'>";
	echo "<tr>";
	echo "<td width='50%' align='center'>";

		echo "
			<table><tr><td>
				<a style='text-decoration:none;' href='?v=addserver-win'>
				<img style='display:inline;' border='0' alt='".getTranslation("Add Windows Job Server",$settings)."' title='".getTranslation("Add Server",$settings)."' height='40' width='40' src='images/add-hf.png'/>
				</a>
			</td><td>
				<a style='text-decoration:none;' href='?v=addserver-win'>
				<h4 style='display:inline;color:black;'>".getTranslation("Add Windows Job Server",$settings)."</h4>
				</a>
			</td></tr></table>
		";

	echo "</td>";
	echo "<td align='center'>";

		echo "
			<table><tr><td>
				<a style='text-decoration:none;' href='?v=addserver-linux'>
				<img style='display:inline;' border='0' alt='".getTranslation("Add Linux Job Server",$settings)."' title='".getTranslation("Add Server",$settings)."' height='40' width='40' src='images/add-hf.png'/>
				</a>
			</td><td>
				<a style='text-decoration:none;' href='?v=addserver-linux'>
				<h4 style='display:inline;color:black;'>".getTranslation("Add Linux Job Server",$settings)."</h4>
				</a>
			</td></tr></table>
		";

	echo "</td>";
	echo "<td nowrap='nowrap'>";


		echo "
			<table><tr><td>
				<a style='text-decoration:none;' href='view.logs.php'>
				<img style='display:inline;' border='0' alt='".getTranslation("View Job Server Logs",$settings)."' title='".getTranslation("View Job Server Logs",$settings)."' height='40' width='40' src='images/scroll.png'/>
				</a>
			</td><td>
				<a style='text-decoration:none;' href='view.logs.php'>
				<h4 style='display:inline;color:black;'>".getTranslation("View Job Server Logs",$settings)."</h4>
				</a>
			</td></tr></table>
		";


	echo "</td>";
	echo "</tr>";

	echo "<tr><td colspan='3'>";
echo "

	<style>
	#myCanvas {
		border: 1px solid #9C9898;
	}
	</style>



";
if ( count($nodes)>0 )
{
	echo "    ";
	echo getTranslation("page automatically refreshes every 30 seconds",$settings);
}
echo "
	<br/>
	<noscript>".getTranslation("JavaScript must be enabled for cluster map to display properly.",$settings)."</noscript>
	<a name='map'>
	<canvas id='myCanvas' width='$canvas_w' height='$canvas_h'></canvas>
	</a>
	<br/>
";

if ( count($nodes)>0 )
{
	echo "    <a name='bottom'>";
	echo getTranslation("page automatically refreshes every 30 seconds",$settings);
	echo "</a>";
}
echo "
	<script>
";
if ( count($nodes)>0 )
{
	echo "      setTimeout('window.location=\"?v=map#map\";',30*1000);";
}
echo "
	var canvas = document.getElementById('myCanvas');
	var context = canvas.getContext('2d');
";

// make a circle
// add ROUTABLE_CNT points equally spaced along the circle
// put draw lines between these Routable servers (full connectivity)


$routable_count=0;
/*
for($i=0;$i<count($nodes);$i++)
{
	if ($nodes[$i]['int_routable']=="1")
	{
		$routable_count=$routable_count+1;
	}
}
*/
foreach ($nodes as $node)
{
	//$nodes[]=$node;
}
//$routable_count=count($nodes);
$degree_separation=90;
if (count($nodes)>0)
{
	$degree_separation=360/count($nodes);//$routable_count;
}
// radians
$circle_center_x=($canvas_w/2)-70;
$circle_center_y=700;
$radius_w=($canvas_w/2)*0.8;
$radius_h=$radius_w/2;
$r_cnt=0;
$server_image_w=68;
$server_image_w_orig=68;
$server_image_w_min=10;
$server_image_h=99;
$server_image_w= $server_image_w - ($server_image_w * 2 * (count($nodes)/100));

echo "
				var imageObjP = new Image();

				imageObjP.onload = function() {
						context.drawImage(imageObjP, $circle_center_x, 10);
						context.font = 'italic bold 8pt Arial';
						context.fillText('".getTranslation("You, Searching for Data",$settings)."', $circle_center_x-10,10+100);
				};
				imageObjP.src='images/you.png';

";

echo "
		context.beginPath();
		context.moveTo($circle_center_x+50,10+100);
		context.lineTo($circle_center_x+50, 200);
		context.stroke();
";
echo "
				var imageObjW = new Image();

				imageObjW.onload = function() {
						context.drawImage(imageObjW, $circle_center_x, 150);
						context.font = 'italic bold 8pt Arial';
						context.fillText('".getTranslation("This HIS Web Interface (you are here)",$settings)."', $circle_center_x-50,10+150+100);
						context.font = 'italic bold 12pt Arial';
						context.fillText('".$this_server_url."', $circle_center_x-50+100+70,10+150+200-80-80);
						context.fillText('"."(".getTranslation("you are here",$settings).")"."', $circle_center_x-50+100+70,10+150+200-80-80+20);
						context.fillText('".getTranslation("version",$settings)." ".$software_version."', $circle_center_x-50+100+70,10+150+200-80-80+20+20);
				};
				imageObjW.src='images/website.png';

";
echo "
		// path to database
		context.beginPath();
		context.moveTo($circle_center_x+50,20+100+100);
		context.lineTo($circle_center_x+50+150, 350);
		context.stroke();

		// path to file storage
		context.beginPath();
		context.moveTo($circle_center_x+50,20+100+100);
		context.lineTo($circle_center_x+50-150, 350);
		context.stroke();

";

$db_print="";
if ($APP['db']->kind=="dynamodb")
{
	$db_print1="";
	$db_print2="DYNAMODB";
}
else
{
	$db_print1=$GLOBALS['settings']['memory']['@attributes']['value'];
	$db_print2=$GLOBALS['settings'][$GLOBALS['settings']['memory']['@attributes']['value']]['server']['@attributes']['value'];

	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
	}
	else
	{
		$db_print2="DemoDatabaseAddress.com";
	}

	$db_print1=strtoupper($db_print1);
	//$db_print2=strtoupper($db_print2);
}

$sys_setting_version = new sys_setting();
$sys_setting_version->get_from_hashrange("system","version");


echo "
				var imageObjD = new Image();
				imageObjD.onload = function() {
						context.drawImage(imageObjD, $circle_center_x+150, 300);
						context.font = 'italic bold 8pt Arial';
						context.fillText('".getTranslation("HIS Database",$settings)."', $circle_center_x+10+150,400);
					context.font = 'italic bold 12pt Arial';
					context.fillText('".$db_print1."', $circle_center_x-50+100+70+150,350-20);
					context.fillText('".$db_print2."', $circle_center_x-50+100+70+150,350);
					context.fillText('"."(".getTranslation("your data is here",$settings).")"."', $circle_center_x-50+100+70+150,350+20);
					context.fillText('".getTranslation("version",$settings)." ".$sys_setting->val."', $circle_center_x-50+100+70+150,350+20+20);

				};
				imageObjD.src='images/his-overview.png';
";
echo "
				var imageObjF = new Image();
				imageObjF.onload = function() {
						context.drawImage(imageObjF, $circle_center_x-150, 300);
						context.font = 'italic bold 8pt Arial';
						context.fillText('HIS ".getTranslation("File Storage",$settings)."', $circle_center_x+10-150,400);
					context.font = 'italic bold 12pt Arial';
					context.fillText('".strtoupper($GLOBALS['settings']['storage']['@attributes']['value'])."', $circle_center_x-50+100+70-150-280,350);
					context.fillText('"."(".getTranslation("your data is here",$settings).")"."', $circle_center_x-50+100+70-430,350+20);

				};
				imageObjF.src='images/files.png';
";

//$server_image_w=$server_image_w_orig;
if ($server_image_w<$server_image_w_min)
{
	$server_image_w=$server_image_w_min;
}
$server_image_h=($server_image_w/$server_image_w_orig)*$server_image_h;

for($i=0;$i<count($nodes);$i++)
{
	$user_system_kind=new user_system_kind();
	$user_system_kind->get_from_hashrange($nodes[$i]->id_user,$nodes[$i]->id_sk);

	$server_image_addition="";
	if ($user_system_kind->id!="undefined")
	{
		$server_image_addition="-".strtolower($user_system_kind->name);
	}
	else
	{
		$server_image_addition="";
	}

	$server_image="images/server$server_image_addition.png";
	if ($nodes[$i]->int_routable=="1")
	{
		$server_image="images/server-routable.png";
	}
	else
	{
		//continue;
	}
	$server_x=$circle_center_x+$radius_w*cos( ( ( $degree_separation*$r_cnt)*3.1415 ) / 180 );
	$server_y=$circle_center_y+$radius_h*sin( ( ( $degree_separation*$r_cnt)*3.1415 ) / 180 );

	
	$sidefeature1="";
	$sidefeature2="";
	$version_text="";
	if ($database_version!=$nodes[$i]->software_version)
	{
		$sidefeature2="server.sidefeature.oldversion.png";
		$version_text="(".getTranslation("outdated",$settings).")";
	}
	if (intval($nodes[$i]->int_online)!=1)
	{
		$sidefeature1="server.sidefeature.offline.png";
		$version_text.="(".getTranslation("OFFLINE",$settings).")";
	}

	
	if ( intval(gmdate('U')) > intval($nodes[$i]->last_ping) )
	{
		$timespan=time_elapsed(intval(gmdate('U'))-intval($nodes[$i]->last_ping));
		$is_past=true;
		$is_future=false;
	}
	elseif ( intval(gmdate('U')) < intval($nodes[$i]->last_ping) )
	{
		$timespan=time_elapsed(intval($nodes[$i]->last_ping)-intval(gmdate('U')) );
		$is_past=false;
		$is_future=true;
	}
	else
	{
		$is_past=true;
		$is_future=false;
		$timespan="0s";
	}

	$traffic_light="yellow";
	if ($is_past)
	{
		if ( strpos($timespan,"h")!==FALSE || strpos($timespan,"d")!==FALSE)
		{
			$timespan=$timespan." ".getTranslation("ago",$settings);
			$server_image="images/server-broken$server_image_addition.png";
			$traffic_light="red";
		}
		else if ( strpos($timespan,"m")!==FALSE)
		{
			$timespan=$timespan." ".getTranslation("ago",$settings);
			$traffic_light="yellow";
		}
		else if ( strpos($timespan,"s")!==FALSE)
		{
			$timespan=$timespan." ".getTranslation("ago",$settings);
			$traffic_light="green";
		}
		else
		{
			$timespan=$timespan." ".getTranslation("ago",$settings);
			$traffic_light="green";
		}

	}
	else
	{
		$timespan=$timespan." ".getTranslation("from now",$settings);
		$traffic_light="blue";
	}

	if ($database_version!=$nodes[$i]->software_version)
	{
		$server_image="images/server-broken$server_image_addition.png";
		$traffic_light="red";
	}
	if (intval($nodes[$i]->int_online)!=1)
	{
		$traffic_light="red";
	}
	
	
	echo "
		var x$i = ".$server_x .";
		var y$i = ".$server_y .";
		var imageObj$i = new Image();
		var imageObj$i"."light = new Image();
		var imageObj$i"."sidefeature1 = new Image();
		var imageObj$i"."sidefeature2 = new Image();
		imageObj$i"."light.src='images/light.$traffic_light.png';
		if ('$sidefeature1'!='')
		{
			imageObj$i"."sidefeature1.src='images/$sidefeature1';
		}
		if ('$sidefeature2'!='')
		{
			imageObj$i"."sidefeature2.src='images/$sidefeature2';
		}
		
		imageObj$i.onload = function() {
			context.drawImage(imageObj$i, x$i, y$i,$server_image_w,$server_image_h);
			context.font = 'italic bold 8pt Arial';
			context.fillText('".$nodes[$i]->name."', x$i-20,y$i+$server_image_h+10);
			context.fillText('".$nodes[$i]->ip_address."', x$i-20,y$i+$server_image_h+25);
			context.fillText('".getTranslation("Last Seen",$settings)." ".$timespan."', x$i-20,y$i+$server_image_h+40);
			context.fillText('".getTranslation("version",$settings)." ".$nodes[$i]->software_version." ".$version_text."', x$i-20,y$i+$server_image_h+55);
			context.drawImage(imageObj$i"."light, x$i+30, y$i-27,22,40);
			if ('$sidefeature1'!='')
			{
				context.drawImage(imageObj$i"."sidefeature1, x$i, y$i,$server_image_w,$server_image_h);
			}
			if ('$sidefeature2'!='')
			{
				context.drawImage(imageObj$i"."sidefeature2, x$i, y$i,$server_image_w,$server_image_h);
			}
		};
		imageObj$i.src='$server_image';

		// path to database
		context.beginPath();
		context.moveTo(x$i+($server_image_w/2),y$i+($server_image_h/2));
		context.lineTo($circle_center_x+50+150,300+50);
		context.stroke();

		// path to file storage
		context.beginPath();
		context.moveTo(x$i+($server_image_w/2),y$i+($server_image_h/2));
		context.lineTo($circle_center_x+50-150,300+50);
		context.stroke();


	";
	$r_cnt=$r_cnt+1;
}



echo "
	</script>


	";


	echo "<h3>".getTranslation('List of Job Processing Servers (for Remote Jobs):',$settings)."</h3>";
	echo "<table width='100%'><tr><td style='padding-left:20px;'>";
	$u->build(array("obj_hfs","obj_inherits"));
	$nodes=$u->obj_servers;
	if (count($nodes)>0)
	{
		echo "<table border='0' width='700' cellspacing='0' cellpadding='0'>";
		echo "<tr><td>";
		echo "<form onsubmit='return confirm(\"".getTranslation("Update ALL Servers to latest version?",$settings)."\");' style='display:inline;' method='post' action='?action=ras'><input style='background-color:".rcolor().";display:inline;' type='submit' name='restart' value='% ".getTranslation("ALL",$settings)."' title='".getTranslation("Update ALL Servers to latest version?",$settings)."' alt='".getTranslation("Update ALL Servers to latest version?",$settings)."'/></form>";
		echo "</td><td width='100'><u><b>";
		echo getTranslation("Job Node",$settings);
		echo "</b></u></td><td><u><b>";
		echo getTranslation("Desktop",$settings);
		echo "</b></u></td><td style='padding-left:30px;'><u><b>";
		echo getTranslation("Address",$settings);
		echo "</b></u></td><td><u><b>";
		echo getTranslation("Last Seen",$settings);
		echo "</b></u></td></tr>";
		foreach ($nodes as $single_node)
		{
			$icons="";
			$svr_name=$single_node->name;

			$row_style="";
			if (intval($single_node->int_online)!=1)
			{
				$row_style="background-color:#666;";
			}

			echo "<tr style='$row_style'>";
			echo "<td nowrap='nowrap'>";
			echo "<form style='display:inline;' method='post' action='?v=map&action=rss'><input style='background-color:".rcolor().";display:inline;' type='submit' name='restart' value='%' title='".getTranslation("Restart Server",$settings)."' alt='".getTranslation("Restart Server",$settings)."'/><input type='hidden' name='server_name' value='$svr_name'/></form>";

			$the_q="";
			if ( isset($_GET['q']) )
			{
				$the_q="q=$qn&";
			}
			if (intval($single_node->int_online)==1)
			{
				echo "<form action='?$the_q"."v=map&action=server-offline' method='post' style='display:inline;'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
				echo getTranslation("Put Offline",$settings);
				echo "'/></form>";
			}
			else
			{
				echo "<form action='?$the_q"."v=map&action=server-online' method='post' style='display:inline;'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
				echo getTranslation("Put Online",$settings);
				echo "'/></form>";
			}

			echo "</td>";

			$show_rdp=false;
			foreach ($u->obj_system_kinds as $usk)
			{
				if ($usk->id==$single_node->id_sk)
				{
					if (strtolower($usk->name)=="windows")
					{
						$show_rdp=true;
					}
				}
			}

			$icons="";

			echo "<td style='padding-right:20px;' nowrap='nowrap'>";
			echo $svr_name;

			if (intval($single_node->int_online)!=1)
			{
				echo " (";
				echo getTranslation("OFFLINE",$settings);
				echo ")";
			}

			echo "</td>";


			if ($show_rdp)
			{
				echo "<td>";
				echo "<a href='download.php?dl=rdp&server=".$svr_name."'>";
				echo "<img width='30' height='30' border='0' src='images/rdp.png'/>";
				echo "</a>";
				echo "</td>";
			}
			else
			{
				echo "<td>";
				echo "";
				echo "</td>";
			}
			echo "<td style='padding-left:30px;padding-right:20px;'>".$single_node->ip_address."</td>";
			echo "<td nowrap='nowrap'>";
			if ( intval(gmdate('U')) > intval($single_node->last_ping) )
			{
				echo time_elapsed(intval(gmdate('U'))-intval($single_node->last_ping))." ".getTranslation("ago",$settings)." ";
			}
			elseif ( intval(gmdate('U')) < intval($single_node->last_ping) )
			{
				echo "+".time_elapsed(intval($single_node->last_ping)-intval(gmdate('U')))." ".getTranslation("from now",$settings);
			}
			else
			{
				echo "0s ".getTranslation("ago",$settings);
			}
			echo "</td><td nowrap='nowrap'>";
			$the_q="";
			if ( isset($_GET['q']) )
			{
				$the_q="q=$qn&";
			}
			echo "<form action='?$the_q"."v=map&action=delete-user-server' style='display:inline;' method='post'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
			echo getTranslation("Delete",$settings);
			echo "'/></form>";

			echo "</td></tr>";
		}
		echo "</td></tr>";
		echo "</table>\n\n";
	}



	echo "<br/><br/>".getTranslation('Want to add a job server?',$settings)."<br/>";
	echo "<a href='?v=map'>".getTranslation('Click here',$settings)."</a> ".getTranslation('to generate a his-config.php file for your server.',$settings)."<br/>";

	echo "</td></tr></table>";
	echo "</ul>";



	echo "</td></tr>";
	echo "</table>";

}
} // end if (cluster map)



if ( isset($_GET['v']) )
{
if ( $_GET['v']=="job-servers" )
{


	echo "<a name='queue'><h3>".getTranslation("Job Queue/List of Jobs",$settings)."</h3>";
	echo "<ul>";

	echo "<form action='?q=$qn&v=job-servers' method='post'><input style='background-color:".rcolor().";display:inline;' type='submit' value='";
	echo getTranslation("Refresh",$settings);
	echo "'/></form>";
	
	if ($APP['ms']->kind=="no-messaging")
	{

		echo "<ul>";
		$new_job = new job_new();
		$new_jobs=$new_job->get_from_hashrange($u->id_user);
		if ($new_jobs)
		{
			echo "<h3>";
			echo getTranslation("New Jobs",$settings);
			echo " ";
			echo "(";
			echo count($new_jobs);
			echo ")";
			echo "</h3>";

			foreach ($new_jobs as $new_job)
			{
				echo getTranslation("Job ID",$settings);
				echo ": ";
				echo $new_job['id'];
				echo "<br/>";
			}
		}
		
		if ( !$new_jobs ||  count($new_jobs)==0 )
		{
			echo getTranslation("No waiting jobs found.",$settings);
		}
		echo "</ul>";
		
		echo "<form action='?q=$qn&v=job-servers' method='post'><input style='background-color:".rcolor().";display:inline;' type='submit' value='";
		echo getTranslation("Refresh",$settings);
		echo "'/></form>";
	}

	$working_job = new job_status();
	$unfinished_jobs=$working_job->get_from_hashrange($u->id_user);

	$unique_statuses=array();
	if ( count($unfinished_jobs)>0 )
	{
		foreach ($unfinished_jobs as $unfinished_job)
		{
			$status = explode("#",$unfinished_job['id_status_job'])[0];
			if ( in_array($status,array_keys($unique_statuses)) )
			{
				$unique_statuses[$status]=intval($unique_statuses[$status])+1;
			}
			else
			{
				$unique_statuses[$status]=1;
			}
		}
	}
	$status_string = "";
	$idx=0;
	foreach ($unique_statuses as $skey=>$sval)
	{
		if ($idx>0)
		{
			$status_string .= ", ".ucfirst($skey).": (".$sval.")";
		}
		else
		{
			$status_string .= " ".ucfirst($skey).": (".$sval.")";
		}
		$idx=$idx+1;
	}

	echo "<h3>";
	echo getTranslation("Unfinished Jobs",$settings);
	echo " ";
	echo "(";
	echo count($unfinished_jobs);
	echo ");";
	echo $status_string;

	echo "</h3>";


	echo "<ul>";
	if ( count($unfinished_jobs)>0 )
	{
		echo "<table cellspacing='0' cellpadding='0' width='300' >";
			echo "<tr>";
	
			echo "<td nowrap='nowrap' style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Job ID",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
			echo "<td nowrap='nowrap' style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Function Name",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
			echo "<td style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Status",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
			echo "<td style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Number of Tries Attempted",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
			echo "<td style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Date Created",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
			echo "<td style='padding-right:15px;vertical-align:bottom;'>";
			echo "<b>";
			echo "<u>";
			echo getTranslation("Date Modified",$settings);
			echo "</u>";
			echo "</b>";
			echo "</td>";
	
			echo "</tr>";
		foreach ($unfinished_jobs as $unfinished_job)
		{
			$job_id = explode("#",$unfinished_job['id_status_job'])[1];
			$job_obj = new job_id_user();
			$job_obj->get_from_hashrange($u->id_user,$job_id);
			
			$hf_obj = new hf_id_user();
			$hf_obj->get_from_hashrange($u->id_user,$job_obj->id_hf);
			echo "<tr>";
	
			echo "<td colspan='6' nowrap='nowrap' style='padding-right:15px;' valign='top'>";
			echo "<a target='_new' name='unfinished_".$job_obj->id."' href='$this_server_url/get.php?return=output&job=".$job_obj->id."'>";
			echo $job_obj->id;
			echo "</a>";
			echo "</td>";
			echo "<td rowspan='3'>";

			echo "<form method='post' action='?v=job-servers&action=delete-job'>";
			echo "<input type='hidden' name='id' value='".htmlspecialchars($job_obj->id,ENT_QUOTES)."'/>";
			echo "<input type='submit' value='";
			echo getTranslation("Delete",$settings);
			echo "' style='background-color:".rcolor()."'/>";
			echo "</form>";
			echo "</td>";


			echo "<td rowspan='3'>";

			echo "<form method='post' action='?v=job-servers&action=reassign-job'>";
			echo "<input type='hidden' name='id' value='".htmlspecialchars($job_obj->id,ENT_QUOTES)."'/>";
			echo "<input type='submit' value='";
			echo getTranslation("Reassign",$settings);
			echo "' style='background-color:".rcolor()."'/>";
			echo "</form>";
			echo "</td>";


			echo "<td nowrap='nowrap' rowspan='3'>";
			echo getTranslation("Update",$settings);
			echo ":";

			echo "<form style='display:inline;' method='post' action='?v=job-servers&action=update-job-status'>";
			echo "<input type='hidden' name='id' value='".htmlspecialchars($job_obj->id,ENT_QUOTES)."'/>";

			echo "<select name='id_status' style='background-color:".rcolor().";display:inline;'>";			
			echo "<option value=''>";
			echo getTranslation("pick new status",$settings);
			echo "</option>";
			echo "<option value='failed'>";
			echo "failed";			
			echo "</option>";
			echo "<option value='new'>";
			echo "new";			
			echo "</option>";
			echo "<option value='done'>";
			echo "done";			
			echo "</option>";
			echo "<option value='cancelled'>";
			echo "cancelled";			
			echo "</option>";
			echo "</select>";			

			echo "<input type='submit' value='";
			echo getTranslation("Submit",$settings);
			echo "' style='background-color:".rcolor().";display:inline;'/>";
			echo "</form>";
			echo "</td>";

			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "</td>";
			echo "<td colspan='5' nowrap='nowrap' style='padding-right:15px;' valign='top'>";
			echo "<a target='_new' href='$this_server_url/?q=".$job_obj->id_hf."&v=overview'>";
			echo $hf_obj->name;
			echo "</a>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<a href='?q=$qn&v=job-servers#unfinished_".$job_obj->id."'><img src='images/refresh.png' width='20' title='".getTranslation("Refresh this job in list",$settings)."' alt='".getTranslation("Refresh this job in list",$settings)."'/>";
			echo "</td>";
			echo "<td style='padding-right:15px;' valign='top'>";

			echo "<a target='_new' href='$this_server_url/get.php?return=status&job=".$job_obj->id."'>";
			echo $job_obj->id_status;
			echo "</a>";			

			echo "</td>";

			echo "<td style='padding-right:15px;text-align:center;' valign='top' nowrap='nowrap'>";
			echo $job_obj->int_try;
			echo "</td>";


			echo "<td style='padding-right:15px;' valign='top' nowrap='nowrap'>";
			echo time_elapsed(intval(gmdate('U'))-intval($job_obj->dt_created));
			echo " ";
			echo getTranslation("ago",$settings);
			echo "</td>";
			echo "<td style='padding-right:15px;' valign='top' nowrap='nowrap'>";
			echo time_elapsed(intval(gmdate('U'))-intval($job_obj->dt_modified));
			echo " ";
			echo getTranslation("ago",$settings);
			//echo $unfinished_job['dt_modified'];
			echo "</td>";
			echo "<td style='padding-right:15px;' valign='top'>";
			echo "</td>";
	
			echo "</tr>";
		} // END FOREACH
		echo "</table>";

	} // END IF (ANY UNFINISHED JOBS)

	if ( count($unfinished_jobs)==0 )
	{
		echo getTranslation("No unfinished jobs found.",$settings);
	}
	echo "</ul>";

	echo "<form action='?v=job-servers' method='post'><input style='background-color:".rcolor().";display:inline;' type='submit' value='";
	echo getTranslation("Refresh",$settings);
	echo "'/></form>";

	echo "</pre>";
	echo "</ul>";
	echo "</a>";




	foreach ($unfinished_jobs as &$unfinished_job)
	{
		$job_id = explode("#",$unfinished_job['id_status_job'])[1];
		$job_obj = new job_id_user();
		$job_obj->get_from_hashrange($u->id_user,$job_id);
			
		$check_is_child = new ph_child();
		$check_is_child->get_from_hashrange($job_obj->id);
		if ($check_is_child->id_child_job!="undefined")
		{
			$unfinished_job['id_parent_job']=$check_is_child->id_parent_job;
		}
		else
		{
			$unfinished_job['id_parent_job']=false;
		}
	}

	$new = array();
	foreach ($unfinished_jobs as $a)
	{
	    $new[$a['id_parent_job']][] = $a;
	}
	$tree=array();
	if ( count($new)>0 )
	{
		$new_keys=array_keys($new);
		$tree = createTree($new, $new_keys[0]); // changed
	}

	function print_node($n)
	{
		global $settings;
		global $this_server_url;
		echo "<ul style='padding-left:10px;'>";
		echo "<a href='"."$this_server_url/get.php?return=output&job=".$n['id']."'  target='_new'>".$n['id']."</a>";
		echo " ";

		echo "<a href='#unfinished_".$n['id']."'>";
		echo "(";
		echo getTranslation("view",$settings);
		echo ")";
		echo "</a>";

		echo "(";
		echo "<a href='"."$this_server_url/get.php?return=status&job=".$n['id']."'  target='_new'>".$n['id_status']."</a>";
		echo ")";
		if ( isset($n['children']) )
		{
			foreach ($n['children'] as $c)
			{
				print_node($c);
			}
		}
		echo "</ul>";
	}
	if ( count($tree) != count($unfinished_jobs) )
	{
		echo "<h3>";
		echo getTranslation('Unfinished Job Hierarchy',$settings);
		echo "</h3>";
		if ( count($tree)>0 )
		{
			foreach ($tree as $n)
			{
				print_node($n);
			}
		}
		else
		{
			echo "<ul>";
			echo getTranslation("Flat hierarchy (all jobs are parent jobs), see job list above.",$settings);
			echo "</ul>";
		}
		//	print_r($tree);
	}




	echo "<h3>";
	echo getTranslation("View Server Logs",$settings);
	echo "</h3>";
	echo "<ul>";
	echo "<form action='view.logs.php'><input type='submit' style='background-color:".rcolor().";display:inline;' value='".getTranslation("View Server Logs",$settings)."'/></form>";
	echo "</ul>";

	echo "<h3>".getTranslation('List of Job Processing Servers (for Remote Jobs):',$settings)."</h3>";
	echo "<table width='100%'><tr><td style='padding-left:20px;'>";
	$u->build(array("obj_hfs","obj_inherits"));
	$nodes=$u->obj_servers;
	if (count($nodes)>0)
	{
		echo "<table border='0' width='700' cellspacing='0' cellpadding='0'>";
		echo "<tr><td>";
		echo "<form onsubmit='return confirm(\"".getTranslation("Update ALL Servers to latest version?",$settings)."\");' style='display:inline;' method='post' action='?action=ras'><input style='background-color:".rcolor().";display:inline;' type='submit' name='restart' value='% ".getTranslation("ALL",$settings)."' title='".getTranslation("Update ALL Servers to latest version?",$settings)."' alt='".getTranslation("Update ALL Servers to latest version?",$settings)."'/></form>";
		echo "</td><td width='100'><u><b>";
		echo getTranslation("Job Node",$settings);
		echo "</b></u></td><td><u><b>";
		echo getTranslation("Desktop",$settings);
		echo "</b></u></td><td style='padding-left:30px;'><u><b>";
		echo getTranslation("Address",$settings);
		echo "</b></u></td><td><u><b>";
		echo getTranslation("Last Seen",$settings);
		echo "</b></u></td></tr>";
		foreach ($nodes as $single_node)
		{
			$icons="";
			$svr_name=$single_node->name;

			$row_style="";
			if (intval($single_node->int_online)!=1)
			{
				$row_style="background-color:#666;";
			}

			echo "<tr style='$row_style'>";
			echo "<td nowrap='nowrap'>";
			echo "<form style='display:inline;' method='post' action='?v=job-servers&action=rss'><input style='background-color:".rcolor().";display:inline;' type='submit' name='restart' value='%' title='".getTranslation("Restart Server",$settings)."' alt='".getTranslation("Restart Server",$settings)."'/><input type='hidden' name='server_name' value='$svr_name'/></form>";

			$the_q="";
			if ( isset($_GET['q']) )
			{
				$the_q="q=$qn&";
			}
			if (intval($single_node->int_online)==1)
			{
				echo "<form action='?$the_q"."v=job-servers&action=server-offline' method='post' style='display:inline;'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
				echo getTranslation("Put Offline",$settings);
				echo "'/></form>";
			}
			else
			{
				echo "<form action='?$the_q"."v=job-servers&action=server-online' method='post' style='display:inline;'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
				echo getTranslation("Put Online",$settings);
				echo "'/></form>";
			}

			echo "</td>";

			$show_rdp=false;
			foreach ($u->obj_system_kinds as $usk)
			{
				if ($usk->id==$single_node->id_sk)
				{
					if (strtolower($usk->name)=="windows")
					{
						$show_rdp=true;
					}
				}
			}

			$icons="";

			echo "<td style='padding-right:20px;' nowrap='nowrap'>";
			echo $svr_name;

			if (intval($single_node->int_online)!=1)
			{
				echo " (";
				echo getTranslation("OFFLINE",$settings);
				echo ")";
			}

			echo "</td>";


			if ($show_rdp)
			{
				echo "<td>";
				echo "<a href='download.php?dl=rdp&server=".$svr_name."'>";
				echo "<img width='30' height='30' border='0' src='images/rdp.png'/>";
				echo "</a>";
				echo "</td>";
			}
			else
			{
				echo "<td>";
				echo "";
				echo "</td>";
			}
			echo "<td style='padding-left:30px;padding-right:20px;'>".$single_node->ip_address."</td>";
			echo "<td nowrap='nowrap'>";
			if ( intval(gmdate('U')) > intval($single_node->last_ping) )
			{
				echo time_elapsed(intval(gmdate('U'))-intval($single_node->last_ping))." ".getTranslation("ago",$settings)." ";
			}
			elseif ( intval(gmdate('U')) < intval($single_node->last_ping) )
			{
				echo "+".time_elapsed(intval($single_node->last_ping)-intval(gmdate('U')))." ".getTranslation("from now",$settings);
			}
			else
			{
				echo "0s ".getTranslation("ago",$settings);
			}
			echo "</td><td nowrap='nowrap'>";
			$the_q="";
			if ( isset($_GET['q']) )
			{
				$the_q="q=$qn&";
			}
			echo "<form action='?$the_q"."v=job-servers&action=delete-user-server' style='display:inline;' method='post'><input type='hidden' name='name' value='".str_replace("'","\'",$single_node->name)."'/><input style='background-color:".rcolor().";display:inline;' type='submit' name='btnSubmit' value='";
			echo getTranslation("Delete",$settings);
			echo "'/></form>";

			echo "</td></tr>";
		}
		echo "</td></tr>";
		echo "</table>\n\n";
	}



	echo "<br/><br/>".getTranslation('Want to add a job server?',$settings)."<br/>";
	echo "<a href='?v=map'>".getTranslation('Click here',$settings)."</a> ".getTranslation('to generate a his-config.php file for your server.',$settings)."<br/>";

	echo "</td></tr></table>";
	echo "</ul>";







}
} // end if (job servers)

if ( isset($_GET['v']) )
{
if ( $_GET['v']=="settings" )
{
/*
	echo "<b>";
	echo getTranslation("Cleanup Database",$settings);
	echo "</b>";
	include("cleanup.php");
*/

	echo "<b>";
	echo getTranslation("URLEncode/URLDecode Tester",$settings);
	echo "</b>";
	echo "<ul>";
	echo "<form action='url.php'><input type='submit' style='background-color:".rcolor()."' value='".getTranslation('Go to',$settings)." ".getTranslation('URLEncode/URLDecode Tester',$settings)."'/></form>";
	echo "</ul>";

	echo "<br/>";


	if ($_SERVER['HTTP_HOST']!=$demo_domain)
	{
		echo "<b>";
		echo getTranslation("HIS System Information",$settings);
		//echo ": ";
		echo "</b>";
		echo "<ul>";
		
		echo "<b>";
		echo getTranslation("Software Version",$settings);
		echo ": ";
		echo "</b>";
		echo $software_version;
		echo "<br/>";
		
		
		echo "<b>";
		echo getTranslation("Database Version",$settings);
		echo ": ";
		echo "</b>";
		$sys_setting = new sys_setting();
		$sys_setting->get_from_hashrange("system","version");
		echo $sys_setting->val;
		echo "<br/>";


		echo "<b>";
		echo getTranslation("HF XML File Format Version",$settings);
		echo ": ";
		echo "</b>";
		echo $software_version;
		echo "<br/>";

		echo "</ul>";

		echo "<br/>";

		echo "<b>";
		echo getTranslation("Available Software Versions",$settings);
		echo "</b>";
		echo "<ul>";

		echo "<b>";
		echo getTranslation("Local Software Version",$settings);
		echo ": ";
		echo "</b>";
		echo $software_version;
		echo "<br/>";


		echo "<b>";
		echo getTranslation("Latest Software Version",$settings);
		echo ": ";
		echo "</b>";
		
		$version_content="";
		if ( in_array("https",stream_get_wrappers() ) )
		{
			try
			{
				$version_content=file_get_contents("https://humanintelligencesystem.com/version/");
				$version_content=substr($version_content,0,min(10,strlen($version_content)));
				echo $version_content;
			}
			catch (Exception $e)
			{
				echo getTranslation("Unable to connect to",$settings);
				echo '<a href="https://humanintelligencesystem.com/" target="_new">humanintelligencesystem.com</a>';
			}
		}
		else
		{
			echo getTranslation("Unable to create secure HTTPS connection.  Do you have the php_openssl extension enabled?",$settings);
		}
		echo "<br/>";
		echo "<br/>";
		
		// php_openssl
		
		if ( strlen(trim($version_content))>0 )
		{
			echo "<ul>";
			if (trim($version_content)!=$software_version)
			{
				// update available
				
				echo "<table><tr><td>";
				
				echo "<table bgcolor='orange'>";
				echo "<tr><td align='center' style='padding:20px;padding-top:10px;padding-bottom:10px;color:white;font-weight:bold;'>";
				echo "<u>";
				echo getTranslation("Update Available",$settings);
				echo "</u>";
				echo "<br/>";
				echo $version_content;
				echo "</td></tr>";
				echo "</table>";
				
				echo "</td><td>";
				
				echo "<form action='?action=download-update' method='post'>";
				echo "<input type='submit' value='";
				echo getTranslation("Update Now",$settings);
				echo "' style='background-color:".rcolor()."'/>";
				echo "</form>";
				
				echo "</td></tr></table>";
				
			}
			else
			{
				// already have the latest
				echo "<table bgcolor='green'>";
				echo "<tr><td align='center' style='padding:20px;padding-top:10px;padding-bottom:10px;color:white;font-weight:bold;'>";
				echo "<u>";
				echo getTranslation("Up-to-date",$settings);
				echo "</u>";
				echo "<br/>";
				echo $version_content;
				echo "</td></tr>";
				echo "</table>";
			}
			echo "</ul>";
		}
		echo "<br/>";
		
		echo getTranslation("For more information about available software versions, see",$settings);
		echo " ";
		echo "<a href='https://humanintelligencesystem.com/all-downloads/' target='_new'>humanintelligencesystem.com</a>";
		
		echo "<br/>";
		
		echo "</ul>";
	}
	
	echo "<br/>";
	echo "<br/>";

	
}
} // end if (settings page)


if ( isset($_GET['v']) )
{
if ( $_GET['v']=="features" )
{

echo "<table>";
echo "<tr>";
echo "<td>";
//echo getTranslation("Resource Type",$settings);
echo "</td>";
echo "<td>";
echo "</td>";
echo "<td>";
echo "</td>";

$u->build();

echo "<table>";

echo "<tr>";
echo "<td valign='top'>";
echo "<u>";
echo "<b>";
echo getTranslation("Function Names",$settings);
echo "</b>";
echo "</u>";
echo "</td>";
echo "<td valign='top' colspan='".count($u->obj_system_kinds)."'>";
echo "<u>";
echo "<b>";
echo getTranslation("Recognized Job Server System Environment Kinds",$settings);
echo "</b>";
echo "</u>";
echo "<br/>";
echo "<br/>";
echo "</td>";

echo "<tr>";
echo "<td></td>";
foreach ($u->obj_system_kinds as $user_system_kind)
{
	echo "<td align='center'>";
	echo "<img src='images/".strtolower($user_system_kind->name).".png' alt='".strtolower($user_system_kind->name)."' title='".strtolower($user_system_kind->name)."' width='30' />";
	echo "</td>";
}
echo "</tr>";

foreach ($u->obj_inherits as $user_inherit)
{
	$parent_function = new hf_id_user();
	$parent_function->get_from_hashrange($u->id_user,$user_inherit->id_hf);
	if ($parent_function->id!="undefined")
	{

		echo "<tr>";
		echo "<td width='300'>";
		echo "<a href='?q=".$parent_function->id."&v=overview'>";
		echo $parent_function->name;
		echo "</a>";
		echo "</td>";

		$can_do=false;
		$r=rand(1,2);
		if ($r==1){$can_do=true;}
		$cell_style="";

		foreach ($u->obj_system_kinds as $user_system_kind)
		{
			$hf_inherit_check=new hf_id_user();
			$hf_inherit_check->get_from_hashrange($u->id_user,$user_inherit->id_hf);

			// instead of build()ing every HF (silly), lets build the system kinds for each HF
			$hf_system_kind= new hf_system_kind();
			$all_hf_system_kind= $hf_system_kind->get_from_hashrange($hf_inherit_check->id);
			if ( $all_hf_system_kind )
			{
				foreach ($all_hf_system_kind as $each_hf_system_kind)
				{
					$a_hf_system_kind = new hf_system_kind();
					$a_hf_system_kind->set( $each_hf_system_kind );
					$a_hf_system_kind->build();

					$hf_inherit_check->obj_hf_system_kind[]=$a_hf_system_kind;
				}
			}

			//$hf_inherit_check->build();

			$found_sys_kind=false;
			if ( isset($hf_inherit_check->obj_hf_system_kind) )
			{
				if ( is_array($hf_inherit_check->obj_hf_system_kind) )
				{
					$ci=0;
					foreach ($hf_inherit_check->obj_hf_system_kind as $hfsk)
					{
						if ($user_system_kind->id == $hfsk->id_sk)
						{
							$found_sys_kind=true;
						}
						$ci=$ci+1;
					}
					if ($ci==0)
					{
						$found_sys_kind=true;
					}
				}
				else
				{
					$found_sys_kind=true;
				}
			}
			else
			{
				$found_sys_kind=true;
			}
			if ($found_sys_kind)
			{
				$cell_style="background-color:green;";
			}
			else
			{
				$cell_style="background-color:red;";
			}

			// his - windows
			echo "<td width='30' style='$cell_style'>";
			echo "&nbsp;";
			echo "</td>";
		}
		echo "</tr>";
	}
}


if ( count($u->obj_inherits)==0 )
{
	echo "<tr>";
	echo "<td colspan='".count($u->obj_system_kinds)."'>";
	echo getTranslation("No inheritable functions.",$settings);
	echo "</td>";
	echo "<td width='90' style='background-color:#DDD'></td>";
	echo "<td width='90' style='background-color:#DDD'></td>";
	echo "</tr>";
}
echo "</table>";


echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";


echo "<h1>";
echo getTranslation("Server",$settings);
echo " ";
echo getTranslation("Compatability and Features",$settings);
echo "</h1>";

echo "<br/>";


$service_types=array('database','file-storage','message-queue');

echo "<table>";
foreach ($service_types as $service_type)
{
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
	
	
	echo "<tr>";
	echo "<td valign='top' width='200'>";
	if ($service_type==$service_types[0])
	{
		echo "<u>";
		echo "<b>";
		echo getTranslation("Job Servers",$settings);
		echo "</b>";
		echo "</u>";
	}
	else
	{
		echo "&nbsp;";
	}
	echo "</td>";
	echo "<td valign='top' colspan='".(count($SERVICES)+1)."'>";

	$cap_sent = "";
	foreach ( explode(" ",str_replace("-"," ",$service_type,$settings)) as $word)
	{
		$cap_sent = $cap_sent.ucfirst($word);
		$cap_sent = $cap_sent." ";
	}
	echo "<u>";
	echo "<b>";
	echo getTranslation(trim($cap_sent),$settings);
	
	echo " ";
	echo getTranslation("Services",$settings);
	echo "</b>";
	echo "</u>";
	echo "</td>";
	
	echo "<tr>";
	echo "<td></td>";
	foreach ($SERVICES as $service)
	{
		if ($service->type == $service_type)
		{
			echo "<td nowrap='nowrap' align='center'>";
			echo "<img src='".$service->icon."' width='30' alt='".$service->name."' title='".$service->name."'/>";
			echo "<br/>";
			echo "</td>";
		}
	}
	echo "</tr>";
	
	
	echo "<tr>";
	echo "<td nowrap='nowrap'>";
	echo getTranslation("(This Web Interface)",$settings);
	echo "</td>";
	
	foreach ($SERVICES as $service)
	{
		if ($service->type == $service_type)
		{
			if ($service->enabled)
			{
				$color_bg="green";
			}
			else
			{
				$color_bg="red";
			}
			echo "<td style='background-color:$color_bg;'>";
			echo "&nbsp;";
			echo "</td>";
		}
	} // END FOREACH (LOCAL WEB SERVER SERVICES)
	echo "</tr>";
		
	foreach ($u->obj_servers as $each_server)
	{
	
		echo "<tr>";
		echo "<td nowrap='nowrap'>";
		echo $each_server->name;
		echo "</td>";
		$user_server_services = new user_server_service();

		$hash_user_server = substr($u->id_user,0,6)."@".$each_server->name;
		
		$server_services = $user_server_services->get_from_hashrange($hash_user_server);

		foreach ($SERVICES as $service)
		{
			if ($service->type == $service_type)
			{
				$service_enabled=0;
				if ($server_services)
				{
					foreach ($server_services as $server_service)
					{
						if ($service->name == $server_service['service_name'])
						{
							$service_enabled=intval($server_service['service_enabled']);
						}
					}
				}
		
				$color_bg="red";
				if ($service_enabled==1)
				{
					$color_bg="green";
				}
				echo "<td style='background-color:$color_bg;'>";
				echo "&nbsp;";
				echo "</td>";
			}
		} // END FOREACH (EACH SYSTEM KIND)
		echo "<td width='30'>";
		echo "&nbsp;";
		echo "</td>";
		echo "</tr>";
	} // END FOREACH (EACH SERVER)
	
	
	if ( count($u->obj_servers)==0 )
	{
		echo "<tr>";
		echo "<td>";
		echo getTranslation("No Servers have been added to the cluster yet.",$settings);
		echo "</td>";
		foreach ($SERVICES as $service)
		{
			if ($service->type == $service_type)
			{
				echo "<td style='background-color:#DDD'></td>";
			}
		}
		
		echo "</tr>";
	}

} // END FOREACH (SERVICE TYPES)

echo "</table>";
	
echo "<br/>";
echo "<br/>";
echo "<br/>";


echo "<table>";

echo "<tr>";
echo "<td valign='top' width='200'>";
echo "<b>";
echo "<u>";
echo getTranslation("Job Servers",$settings);
echo "</u>";
echo "</b>";
echo "</td>";
echo "<td valign='top' colspan='".count($u->obj_system_kinds)."'>";
echo "<u>";
echo "<b>";
echo getTranslation("Job Server Platforms",$settings);
echo "</b>";
echo "</u>";
echo "<br/>";
echo "<br/>";
echo "</td>";

echo "<tr>";
echo "<td></td>";
foreach ($u->obj_system_kinds as $user_system_kind)
{
	echo "<td align='center'>";
	echo "<img src='images/".strtolower($user_system_kind->name).".png' alt='".strtolower($user_system_kind->name)."' title='".strtolower($user_system_kind->name)."' width='30' />";
	echo "</td>";
}
echo "</tr>";


foreach ($u->obj_servers as $each_server)
{

	echo "<tr>";
	echo "<td nowrap='nowrap'>";
	echo $each_server->name;
	echo "</td>";

	foreach ($u->obj_system_kinds as $user_system_kind)
	{
		$found_sk=false;
		if ($each_server->id_sk==$user_system_kind->id)
		{
			$found_sk=true;
		}
		$color_bg="red";
		if ($found_sk)
		{
			$color_bg="green";
		}
		echo "<td width='30' style='background-color:$color_bg;'>";
		echo "&nbsp;";
		echo "</td>";
	} // END FOREACH (EACH SYSTEM KIND)
	echo "</tr>";
	continue;
} // END FOREACH (EACH SERVER)


if ( count($u->obj_servers)==0 )
{
	echo "<tr>";
	echo "<td>";
	echo getTranslation("No Servers have been added to the cluster yet.",$settings);
	echo "</td>";
	foreach ($u->obj_system_kinds as $user_system_kind)
	{
		echo "<td width='90' style='background-color:#DDD'></td>";
	}
	echo "</tr>";
}
echo "</table>";


echo "<br/>";
echo "<br/>";
echo "<br/>";


}
}

?>
