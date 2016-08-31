<?php

							if ( $match_entry->id_entry_subtype=='database-connection' )
							{
								// DATABASE TYPE 
								$db_type_options="<option value=''></option>";
								$cnt=0;
								$bool_found_db_type_choice = false;
								foreach ($SERVICES as $SERVICE)
								{
									if ( $SERVICE->type=="database")
									{
										$seltxt="";
										$distxt="";
										//if ($cnt>4) {$distxt=" disabled='disabled'";}
										if ( isset($match_entry->obj_me_settings['db_type']) )
										{
											if ($match_entry->obj_me_settings['db_type']->obj_value->body==$SERVICE->name)
											{
												$seltxt=" selected='selected'";
												$bool_found_db_type_choice = true;
											}
										}
										$db_type_options=$db_type_options."<option$distxt$seltxt value='".$SERVICE->name."'>".$SERVICE->name."</option>";
										$cnt=$cnt+1;
									}
								}

								echo getTranslation("Database Type",$settings);
								echo ": <select name='db_type' style='height:46px;background-color:".rcolor().";display:inline;'>";
								echo $db_type_options;
								echo "</select>";

								echo "<input type='submit' style='background-color:".rcolor().";display:inline;' value='";
								echo getTranslation("Update",$settings);
								echo "'/>";

								echo "<br/>";


								// loop through services.xml to find fields
								if ($bool_found_db_type_choice)
								{
									$SERVICE_CONFIG = new ServiceConfigurator("services.xml",$match_entry->obj_me_settings['db_type']->value);
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

								} // end if (db type (service) is set)

								// Send value via GET/POST to URL
								echo getTranslation("Database Actions",$settings);
								echo ": <br/>";
								//echo "<pre>";print_r($match_entry);echo "</pre>";
								echo "<ul>";
								$count_subsettings = 0;
								foreach ($match_entry->obj_me_settings as $mes)
								{
									//subsetting
									if ( strpos($mes->name,"subsetting_")===0 )
									{
										$count_subsettings = $count_subsettings+1;
									}
								}
								echo "<br/>";
								if ( $count_subsettings==0 )
								{
									echo getTranslation("No database actions added yet.",$settings);
								}
								foreach ($match_entry->obj_me_settings as $mes)
								{
									if ( strpos($mes->name,"subsetting_db_action")===0 && endsWith($mes->name,"_table") )
									{
										//echo "<pre>";print_r($match_entry->obj_me_settings);

										echo getTranslation("Database Action",$settings);
										echo ":";
										echo "<ul>";

										echo "<table width='500'>";
										echo "<tr>";
										echo "<td valign='top'>";

										$type_name=str_replace("_table","_type",$mes->name);

										// TYPE
										echo "<select style='height:46px;background-color:".rcolor().";display:inline;' name='".htmlentities($match_entry->obj_me_settings[$type_name]->name)."'>";
										echo "<option value=''>";
										echo "</option>";
										$seltxt="";
										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="select")
										{
											$seltxt=" selected='selected'";
										}
										echo "<option$seltxt value='select' disabled='disabled'>";
										echo "SELECT";
										echo "</option>";
										$seltxt="";
										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="update")
										{
											$seltxt=" selected='selected'";
										}
										echo "<option$seltxt value='update' disabled='disabled'>";
										echo "UPDATE";
										echo "</option>";
										$seltxt="";
										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="insert")
										{
											$seltxt=" selected='selected'";
										}
										echo "<option$seltxt value='insert'>";
										echo "INSERT";
										echo "</option>";
										$seltxt="";
										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="delete")
										{
											$seltxt=" selected='selected'";
										}
										echo "<option$seltxt value='delete' disabled='disabled'>";
										echo "DELETE";
										echo "</option>";
										echo "</select>";

										echo "<br/>";
										echo "</td>";
										echo "<td valign='top' style='font-size:20px;font-weight:bold;'>";
										echo " ";
										echo getTranslation("TABLE",$settings);
										echo " ";
										echo "</td>";
										echo "<td valign='top'>";

										// TABLE
										echo "<textarea rows='1' name='".$mes->name."'  style='background-color:".rcolor().";width:200px;display:inline;'>";
										echo str_replace("<","&lt;",$mes->obj_value->body);
										echo "</textarea><br/>";
										if ($mes->value!=$mes->obj_value->body)
										{
											echo "<font style='font-size:9px'>";
											echo getTranslation("AFTER REPLACEMENT",$settings);
											echo ":</font><br/>";
											echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:200px;\" rows='1' >";
											echo trim(str_replace("<","&lt;",$mes->value));
											echo "</textarea>";
										}
										echo "</td>";
										echo "<td valign='top' width='110'>";
										echo "<input style='background-color:".rcolor().";display:inline;' type='submit' value='";
										echo getTranslation("Update",$settings);
										echo "'/>";
										echo "</td>";
										echo "<td colspan='2' valign='top'>";
										echo "<input name='btn_del_".$mes->name."' style='background-color:".rcolor().";display:inline;' type='submit' value='";
										echo getTranslation("Delete Action",$settings);
										echo "'/>";
										echo "</td>";
										echo "</tr>";

										$action_number_prefix = str_replace("_table","",$mes->name);
										
										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="update" || $match_entry->obj_me_settings[$type_name]->obj_value->body=="insert" || $match_entry->obj_me_settings[$type_name]->obj_value->body=="select" )
										{
											echo "";
											echo "<tr>";
											echo "<td>";
											echo "</td>";
											echo "<td style='font-size:20px;font-weight:bold;'>";
											if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="select" )
											{
												echo "FIELDS";
											}
											else
											{
												echo "SET";
											}
											echo "</td>";
											echo "</tr>";
											// loop through all set subsettings in this action

											foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
											{
												if ( strpos($MESK,$action_number_prefix."_set_")===0 && endsWith($MESK,"_name") )
												{
													$set_prefix = str_replace("_name","",$MESK);

													$set_number = str_replace($action_number_prefix."_set_","",$MESK);
													$set_number = str_replace("_name","",$set_number);
													$set_number = intval($set_number);
													
													echo "<tr>";
													echo "<td>";
													echo "</td>";
													echo "<td>";
													echo "</td>";
													echo "<td valign='top' style='font-size:20px;font-weight:bold;'>";
													$str_prefix_name_val = "";
													if ( isset($match_entry->obj_me_settings[$set_prefix."_name"]) )
													{
														$str_prefix_name_val = str_replace("'","&#39;",$match_entry->obj_me_settings[$set_prefix."_name"]->obj_value->body);
													}
													echo "<input type='text' name='".$set_prefix."_name"."' value='".$str_prefix_name_val."' style='width:200px;background-color:".rcolor()."'/>";
													if ($match_entry->obj_me_settings[$set_prefix."_name"]->value!=$match_entry->obj_me_settings[$set_prefix."_name"]->obj_value->body)
													{
														echo "<font style='font-size:9px'>";
														echo getTranslation("AFTER REPLACEMENT",$settings);
														echo ":</font><br/>";
														echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:200px;\" rows='1' >";
														echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings[$set_prefix."_name"]->value));
														echo "</textarea>";
														}
													echo "</td>";
													if ($match_entry->obj_me_settings[$type_name]->obj_value->body!="select" )
													{
														echo "<td width='40' align='center' valign='top' style='font-size:20px;font-weight:bold;'>";
														echo "<font style='font-size:30px;'>=</font>";
														echo "</td>";
														echo "<td colspan='2' valign='top' style='font-size:20px;font-weight:bold;'>";
														echo "<textarea rows='1' name='".$set_prefix."_val"."' style='background-color:".rcolor()."'>";
														if ( isset($match_entry->obj_me_settings[$set_prefix."_val"]) )
														{
															echo str_replace("<","&lt;",$match_entry->obj_me_settings[$set_prefix."_val"]->obj_value->body);
														}
														echo "</textarea>";
														if ($match_entry->obj_me_settings[$set_prefix."_val"]->value!=$match_entry->obj_me_settings[$set_prefix."_val"]->obj_value->body)
														{
															echo "<font style='font-size:9px'>";
															echo getTranslation("AFTER REPLACEMENT",$settings);
															echo ":</font><br/>";
															echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:200px;\" rows='1' >";
															echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings[$set_prefix."_val"]->value));
															echo "</textarea>";
														}
														echo "</td>";
													}
													echo "<td colspan='3' nowrap='nowrap' valign='top'>";
													echo "<input style='background-color:".rcolor().";display:inline;' type='submit' value='";
													echo getTranslation("Update",$settings);
													echo "'/>";
													echo "<input style='background-color:".rcolor().";display:inline;' type='submit' name='btn_del_".$set_prefix."_name' value='";
													if ($match_entry->obj_me_settings[$type_name]->obj_value->body!="select" )
													{
														echo getTranslation("Delete Set",$settings);
													}
													else
													{
														echo getTranslation("Delete Field",$settings);
													}
													echo "'/>";
													echo "</td>";
													echo "</tr>";
												}
											} // END FOREACH

											echo "<tr>";
											echo "<td>";
											echo "</td>";
											echo "<td colspan='2' style='font-size:20px;font-weight:bold;'>";
											echo "<input style='background-color:".rcolor()."' type='submit' name='btn_".$action_number_prefix."_addset' value='";
											if ($match_entry->obj_me_settings[$type_name]->obj_value->body!="select" )
											{
												echo getTranslation("Add Set",$settings);
											}
											else
											{
												echo getTranslation("Add Field",$settings);
											}
											echo "'/>";
											echo "</td>";
											echo "</tr>";
										}

										if ($match_entry->obj_me_settings[$type_name]->obj_value->body=="update" || $match_entry->obj_me_settings[$type_name]->obj_value->body=="delete" || $match_entry->obj_me_settings[$type_name]->obj_value->body=="select")
										{
											echo "<tr>";
											echo "<td>";
											echo "</td>";
											echo "<td style='font-size:20px;font-weight:bold;'>";
											echo "WHERE";
											echo "</td>";
											echo "</tr>";
											// loop through all where subsettings in this action

											$min_where = -1;
											$max_where = -1;
											$first_one=true;
											foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
											{
												if ( strpos($MESK,$action_number_prefix."_where_")===0 && endsWith($MESK,"_name") )
												{
													$where_number = str_replace($action_number_prefix."_where_","",$MESK);
													$where_number = str_replace("_name","",$where_number);
													$where_number = intval($where_number);
													if ($MESK==$action_number_prefix."_where_".$where_number."_name")
													{
														if ($first_one||$where_number<$min_where)
														{
															$min_where=$where_number;
														}
														if ($first_one||$where_number>$max_where)
														{
															$max_where=$where_number;
														}
														$first_one=false;
													}
												}	
											} // END FOREACH
											foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
											{
												if ( strpos($MESK,$action_number_prefix."_where_")===0 && endsWith($MESK,"_name") )
												{
													$where_prefix = str_replace("_name","",$MESK);

													$where_number = str_replace($action_number_prefix."_where_","",$MESK);
													$where_number = str_replace("_name","",$where_number);
													$where_number = intval($where_number);
													
													echo "<tr>";
													echo "<td>";
													echo "</td>";
													echo "<td>";
													if ( intval($where_number)>intval($min_where) )
													{
														// where # > 1, so show "and/or/xor" operator selector
														echo "<select name='".$where_prefix."_prevjoin"."' style='height:46px;background-color:".rcolor()."'>";
														$seltxt="";
														if ( isset($match_entry->obj_me_settings[$where_prefix."_prevjoin"]) )
														{
															if ($match_entry->obj_me_settings[$where_prefix."_prevjoin"]->value=="and")
															{
																$seltxt=" selected='selected'";
															}
														}
														echo "<option value='and'$seltxt>";
														echo getTranslation("AND",$settings);
														echo "</option>";
														$seltxt="";
														if ( isset($match_entry->obj_me_settings[$where_prefix."_prevjoin"]) )
														{
															if ($match_entry->obj_me_settings[$where_prefix."_prevjoin"]->value=="or")
															{
																$seltxt=" selected='selected'";
															}
														}
														echo "<option value='or'$seltxt>";
														echo getTranslation("OR",$settings);
														echo "</option>";
														echo "</select>";
													}
													echo "</td>";
													echo "<td style='font-size:20px;font-weight:bold;'>";
													$where_name_value="";
													if ( isset($match_entry->obj_me_settings[$where_prefix.'_name']) )
													{
														$where_name_value=$match_entry->obj_me_settings[$where_prefix.'_name']->obj_value->body;
														$where_name_value=str_replace("'","&#39;",$where_name_value);
													}
													echo "<input type='text' name='".$where_prefix."_name"."' value='".$where_name_value."' style='width:200px;background-color:".rcolor()."'";
													echo "</td>";
													echo "<td colspan='2' style='font-size:20px;font-weight:bold;'>";
													echo "<select name='".$where_prefix."_compare' style='height:46px;background-color:".rcolor()."'>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="eq" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='eq'$seltxt>";
													echo "=";
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="le" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='le'$seltxt disabled='disabled'>";
													echo "<=";
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="ge" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='ge'$seltxt disabled='disabled'>";
													echo ">=";
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="lt" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='lt'$seltxt disabled='disabled'>";
													echo "<";
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="gt" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='gt'$seltxt disabled='disabled'>";
													echo ">";
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="bw" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='bw'$seltxt disabled='disabled'>";
													echo getTranslation("Begins With",$settings);
													echo "</option>";
													$seltxt="";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_compare"]) )
													{
														if ( $match_entry->obj_me_settings[$where_prefix."_compare"]->value=="bt" )
														{
															$seltxt=" selected='selected'";
														}
													}
													echo "<option value='bt'$seltxt disabled='disabled'>";
													echo getTranslation("Between",$settings);
													echo "</option>";

													echo "</select>";
													echo "</td>";
													echo "<td style='font-size:20px;font-weight:bold;'>";
													echo "<textarea rows='1' type='text' name='".$where_prefix."_val"."' style='background-color:".rcolor()."'>";
													if ( isset($match_entry->obj_me_settings[$where_prefix."_val"]) )
													{
														echo str_replace("<","&lt;",$match_entry->obj_me_settings[$where_prefix."_val"]->obj_value->body);
													}
													echo "</textarea>";
													echo "</td>";
													echo "<td colspan='3' nowrap='nowrap'>";
													echo "<input style='background-color:".rcolor().";display:inline;' type='submit' value='";
													echo getTranslation("Update",$settings);
													echo "'/>";
													echo "<input style='background-color:".rcolor().";display:inline;' type='submit' name='btn_del_".$where_prefix."_name' value='";
													echo getTranslation("Delete Where",$settings);
													echo "'/>";
													echo "</td>";
													echo "</tr>";
												}
											}

											echo "<tr>";
											echo "<td>";
											echo "</td>";
											echo "<td colspan='2' style='font-size:20px;font-weight:bold;'>";
											echo "<input style='background-color:".rcolor()."' type='submit' name='btn_".$action_number_prefix."_addwhere' value='";
											echo getTranslation("Add Where",$settings);
											echo "'/>";
											echo "</td>";
											echo "</tr>";
										}
										echo "</table>";

										echo "</ul>";
									}
								} // end foreach (each me_setting)
								echo "</ul>";

								echo "<br/>";

								echo getTranslation("Add a new database action for table",$settings);
								echo ": <br/>";

								$table_option_list="";
								if ($database_table_list)
								{
									foreach ($database_table_list as $dbtable)
									{
										$table_option_list=$table_option_list."<option value='".$dbtable."'>".$dbtable."</option>";
									}
								}

								echo "<ul>";
								if ( strlen($table_option_list)>0 )
								{
									echo "<select name='add_subsetting_db_action_table_name' style='height:46px;background-color:".rcolor().";display:inline;'>";
									echo $table_option_list;
									echo "</select>";
								}
								else
								{
									echo getTranslation("Table name",$settings);
									echo ": <input type='text' name='add_subsetting_db_action_table_name' value='' style='background-color:".rcolor().";width:300px;display:inline;'/>";
								}

								echo "<input type='submit' value='";
								echo getTranslation("Add Database action",$settings);
								echo "' style='background-color:".rcolor().";display:inline;' name='btn_add_subsetting_db_action_table_name'/>";
								echo "<br/>";

								echo "</ul>";


								echo getTranslation("Execute this Database connection while in edit mode?",$settings);
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
										echo getTranslation("Raw response from Database",$settings);
										echo ": <br/>";
										echo "<textarea style='background-color:#ddd;width:500px;display:inline;' rows='3'>";
										echo str_replace("<","&lt;",$raw_response);
										echo "</textarea>";
										echo "<a href='?q=$qn&v=filtering-expression'><img style='padding-left:50px;' border='0' src='images/refresh.png' height='50'/></a>";
										echo "</ul>";
									}
								}
								echo "<br/>";

							} // end if (database-connection output)
						
?>