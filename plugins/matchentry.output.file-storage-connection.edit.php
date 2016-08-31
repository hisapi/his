<?php

							if ( $match_entry->id_entry_subtype=='file-storage-connection' )
							{
								// STORAGE TYPE 
								$fs_type_options="<option value=''></option>";
								$cnt=0;
								$bool_found_fs_type_choice = false;
								foreach ($SERVICES as $SERVICE)
								{
									if ($SERVICE->enabled && $SERVICE->type=="file-storage")
									{
										$seltxt="";
										$distxt="";
										if ($cnt>4)
										{
											$distxt=" disabled='disabled'";
										}
										if ( isset($match_entry->obj_me_settings['fs_type']) )
										{
											if ($match_entry->obj_me_settings['fs_type']->obj_value->body==$SERVICE->name)
											{
												$seltxt=" selected='selected'";
												$bool_found_fs_type_choice = true;
											}
										}
										$fs_type_options=$fs_type_options."<option$distxt$seltxt value='".$SERVICE->name."'>".$SERVICE->name."</option>";
										$cnt=$cnt+1;
									}
								}

								echo getTranslation("File Storage Type",$settings);
								echo ": <select name='fs_type' style='height:46px;background-color:".rcolor().";display:inline;'>";
								echo $fs_type_options;
								echo "</select>";

								echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
								echo getTranslation("Update",$settings);
								echo "'/>";

								echo "<br/>";

								// loop through services.xml to find fields
								if ($bool_found_fs_type_choice)
								{
									$SERVICE_CONFIG = new ServiceConfigurator("services.xml",$match_entry->obj_me_settings['fs_type']->value);
									foreach ($SERVICE_CONFIG->fields as $scf)
									{
										if ($scf->universal!="true") {continue;}
										echo getTranslation($scf->fieldtext,$settings);
										$scf_value="";
										if ( isset($match_entry->obj_me_settings[$scf->fieldname]) )
										{
											$scf_value=$match_entry->obj_me_settings[$scf->fieldname]->obj_value->body;
										}
										echo ": <input type='text' value='".htmlentities($scf_value)."' style='background-color:".rcolor().";width:600px;' name='".$scf->fieldname."'/>";
										echo "<table width='500' style='padding-left:30px;' cellspacing='0' cellpadding='0'><tr><td>";
										echo getTranslation($scf->helptext,$settings);
										echo "<br/>";
										echo "<br/>";
										echo "</td></tr></table>";
										
										if ( isset( $match_entry->obj_me_settings[$scf->fieldname] ) )
										{
	
											if ($match_entry->obj_me_settings[$scf->fieldname]->obj_value->body!=$match_entry->obj_me_settings[$scf->fieldname]->value)
											{
												echo "<ul>";
												echo getTranslation("VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT",$settings);
												echo ":";
												echo "<ul>";
												echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:600px;\" rows='1' >";
												echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings[$scf_fieldname]->value));
												echo "</textarea></ul>";
												echo "</ul>";
											}
										}

									} // end foreach

								} // end if (fs type (service) is set)

								// Send value via GET/POST to URL
								echo getTranslation("File Storage Action",$settings);
								echo ": <br/>";
								echo "<ul>";

								echo getTranslation("Action Type",$settings);
								echo ": <select name='fs_action_type' style='height:46px;background-color:".rcolor().";display:inline;'>";
								$seltxt="";
								echo "<option value=''></option>";
								if ( isset($match_entry->obj_me_settings["fs_action_type"]) )
								{
									if ($match_entry->obj_me_settings["fs_action_type"]->obj_value->body=="write")
									{
										$seltxt=" selected='selected'";
									}
								}
								echo "<option value='write'$seltxt>Write</option>";
								$seltxt="";
								if ( isset($match_entry->obj_me_settings["fs_action_type"]) )
								{
									if ($match_entry->obj_me_settings["fs_action_type"]->obj_value->body=="delete")
									{
										$seltxt=" selected='selected'";
									}
								}
								echo "<option value='delete'$seltxt disabled='disabled'>Delete</option>";
								echo "</select>";

								echo "<br/>";

								echo getTranslation("File path",$settings);

								$scf_value="";
								if ( isset($match_entry->obj_me_settings["target_filename"]) )
								{
									$scf_value=$match_entry->obj_me_settings["target_filename"]->obj_value->body;
								}
								echo ": <input type='text' value='".htmlentities($scf_value)."' style='background-color:".rcolor().";width:600px;' name='"."target_filename"."'/>";
	
								if ( isset( $match_entry->obj_me_settings["target_filename"] ) )
								{
									if ($match_entry->obj_me_settings["target_filename"]->obj_value->body!=$match_entry->obj_me_settings["target_filename"]->value)
									{
										echo "<ul>";
										echo getTranslation("VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT",$settings);
										echo ":";
										echo "<ul>";
										echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:600px;\" rows='1' >";
										echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings["target_filename"]->value));
										echo "</textarea></ul>";
										echo "</ul>";
									}
								}
								
								if ( isset( $match_entry->obj_me_settings["fs_action_type"] ) )
								{

									if ($match_entry->obj_me_settings["fs_action_type"]->obj_value->body=="write")
									{
										echo getTranslation("Content",$settings);

										$scf_value="";
										if ( isset($match_entry->obj_me_settings["content"]) )
										{
											$scf_value=$match_entry->obj_me_settings["content"]->obj_value->body;
										}
										echo ": <textarea rows='1' style='background-color:".rcolor().";width:600px;' name='"."content"."'/>";
										echo str_replace("<","&lt;",$scf_value);
										echo "</textarea>";
										
										if ( isset( $match_entry->obj_me_settings["content"] ) )
										{
		
											if ($match_entry->obj_me_settings["content"]->obj_value->body!=$match_entry->obj_me_settings["content"]->value)
											{
												echo "<ul>";
												echo getTranslation("VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT",$settings);
												echo ":";
												echo "<ul>";
												echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:600px;\" rows='1' >";
												echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings["content"]->value));
												echo "</textarea></ul>";
												echo "</ul>";
											}
										}

										echo getTranslation("MIME Type",$settings);
										echo ":";
										echo "<br/>";

										$scf_value="";
										if ( isset($match_entry->obj_me_settings["mime"]) )
										{
											$scf_value=$match_entry->obj_me_settings["mime"]->obj_value->body;
										}

										echo "<select name='mime' style='background-color:".rcolor().";display:inline;'>";
										echo "<option value=''></option>";
										foreach ($STATIC['mime_types'] as $mime_type_key=>$mime_type_value)
										{
											$seltxt="";
											if ($mime_type_key==$scf_value)
											{
												$seltxt=" selected";
											}
											echo "<option value='".$mime_type_key."'$seltxt>".$mime_type_key."</option>";
										}
										echo "</select>";
										echo "<br/>";
										
										if ( $STORAGE_ADAPTER )
										{

											if ($STORAGE_ADAPTER->storage->connected && strlen($storage_error_log)==0)
											{

												echo getTranslation("Resulting File Stored",$settings);
												echo ":";
												echo "<br/>";
												echo "<a target='_new' href='";
												echo $STORAGE_ADAPTER->storage->key_url($STORAGE_ADAPTER->storage->bucket,$match_entry->obj_me_settings["target_filename"]->value);
												echo "'>";
												echo $STORAGE_ADAPTER->storage->key_url($STORAGE_ADAPTER->storage->bucket,$match_entry->obj_me_settings["target_filename"]->value);
												echo "</a>";
											}
										}

									} // end if (show content entry only if "write" is the file storage action

								}
								echo "</ul>";

								echo getTranslation("Execute this File Storage connection while in edit mode?",$settings);
								echo " ";
								echo "<select name='run_in_edit_mode' style='background-color:".rcolor().";display:inline;'>";
								$seltxt="";
								if ( isset( $match_entry->obj_me_settings['run_in_edit_mode'] ) )
								{
									if (  $match_entry->obj_me_settings['run_in_edit_mode']->value=="false"  )
									{
										$seltxt="selected='selected'";
									}
								}
								echo "<option value='false' $seltxt>";
								echo getTranslation("False",$settings);
								echo "</option>";
								$seltxt="";
								if ( isset( $match_entry->obj_me_settings['run_in_edit_mode'] ) )
								{
									if (  $match_entry->obj_me_settings['run_in_edit_mode']->value=="true"  )
									{
										$seltxt="selected='selected'";
									}
								}
								echo "<option value='true' $seltxt>";
								echo getTranslation("True",$settings);
								echo "</option>";
								echo "</select>";
								if ( isset( $match_entry->obj_me_settings['run_in_edit_mode'] ) )
								{
									if (  $match_entry->obj_me_settings['run_in_edit_mode']->value=="true"  )
									{
										echo "<ul>";
										echo getTranslation("Raw response from File Storage Server",$settings);
										echo ": <br/>";
										echo "<textarea style='background-color:#ddd;width:500px;display:inline;' rows='3'>";
										echo str_replace("<","&lt;",$raw_response);
										echo "</textarea>";
										echo "<a href='?q=$qn&v=filtering-expression'><img style='padding-left:50px;' border='0' src='images/refresh.png' height='50'/></a>";
										echo "</ul>";
									}
								}
								echo "<br/>";
							} // end if (file-storage-connection output)


?>