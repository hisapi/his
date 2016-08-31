<?php

							$bool_do_database_output_actions=false;
							if ( $match_entry->id_entry_subtype=='database-connection' && $DATABASE_ADAPTER->database->connected)
							{
							
								// DETERMINE DBTYPES THAT ARE ENABLED
								foreach ($SERVICES as $SERVICE)
								{
									if ($SERVICE->name==$DATABASE_ADAPTER->kind)
									{
										if ($SERVICE->enabled)
										{
											if ($DATABASE_ADAPTER->database->connected)
											{
												// database actions will go here
												$bool_do_database_output_actions=true;
												//echo "<pre>";print_r($match_entry->obj_me_settings);
											}
										}
									}
								}
							}
							
							// DO DATABASE ACTIONS
							if ($bool_do_database_output_actions)
							{
								// IDENTIFY DATABASE ACTIONS TO DO
								$action_numbers=array();
								foreach ($match_entry->obj_me_settings as $mes)
								{
									// subsetting_db_action_...
									if ( strpos($mes->name,"subsetting_db_action_")===0 )
									{
										$name_parts=explode("_",str_replace("subsetting_db_action_","",$mes->name));
										$the_num=intval($name_parts[0]);
										if ( !in_array($the_num,$action_numbers) )
										{
											$action_numbers[]=$the_num;
										}
									}
								}
								sort($action_numbers);
								// DO DATABASE ACTIONS
								foreach ($action_numbers as $action_number)
								{
									foreach ($match_entry->obj_me_settings as $mes)
									{
										// subsetting_db_action_1
										if ( strpos($mes->name,"subsetting_db_action_".$action_number."_type")===0 )
										{
											$action_type=$match_entry->obj_me_settings["subsetting_db_action_".$action_number."_type"]->value;
											$action_table=$match_entry->obj_me_settings["subsetting_db_action_".$action_number."_table"]->value;
											$where_numbers=array();
											foreach ($match_entry->obj_me_settings as $mes)
											{
												// subsetting_db_action_1_where_
												
												if ( strpos($mes->name,"subsetting_db_action_".$action_number."_where_")===0 )
												{
													$name_parts=explode("_",str_replace("subsetting_db_action_".$action_number."_where_","",$mes->name));
													$the_num=intval($name_parts[0]);
													if ( !in_array($the_num,$where_numbers) )
													{
														$where_numbers[]=$the_num;
													}
												}
											}
											sort($where_numbers);
											$set_numbers=array();
											foreach ($match_entry->obj_me_settings as $mes)
											{
												// subsetting_db_action_1_set_
												if ( strpos($mes->name,"subsetting_db_action_".$action_number."_set_")===0 )
												{
													$name_parts=explode("_",str_replace("subsetting_db_action_".$action_number."_set_","",$mes->name));
													$the_num=intval($name_parts[0]);
													if ( !in_array($the_num,$set_numbers) )
													{
														$set_numbers[]=$the_num;
													}
												}
											}
											sort($set_numbers);
											
											$subsetting_action_base = "subsetting_db_action_".$action_number;
											$select_conditions=array();

											foreach ($where_numbers as $where_number)
											{
												$where_base = $subsetting_action_base."_where_".$where_number;
												$where_prevjoin="";
												$where_name="";
												$where_compare="";
												$where_value="";
												if ( isset($match_entry->obj_me_settings[$where_base."_name"]) )
												{
													$where_name=$match_entry->obj_me_settings[$where_base."_name"]->value;
												}
												if ( isset($match_entry->obj_me_settings[$where_base."_val"]) )
												{
													$where_val=$match_entry->obj_me_settings[$where_base."_val"]->value;
												}
												if ( isset($match_entry->obj_me_settings[$where_base."_compare"]) )
												{
													$where_compare=$match_entry->obj_me_settings[$where_base."_compare"]->value;
												}
												if ( isset($match_entry->obj_me_settings[$where_base."_prevjoin"]) )
												{
													$where_prevjoin=$match_entry->obj_me_settings[$where_base."_prevjoin"]->value;
												}
												if ( strlen($where_name)>0 && $where_compare!="" )
												{
													$select_condition=new SelectComparison();
													$select_condition->field=$where_name;
													if ($where_compare=="eq")
													{
														$select_condition->comparison="EQUAL";
													}
													elseif ($ $where_compare=="bw")
													{
														$select_condition->comparison="BEGINS_WITH";
													}
													else
													{
														$select_condition->comparison="EQUAL";
													}
													$select_condition->value=$where_val;
													$select_conditions[]=$select_condition;
												}
											} // foreach (where number)

											$set_conditions=array();
											foreach ($set_numbers as $set_number)
											{
												$set_base = $subsetting_action_base."_set_".$set_number;
												$set_name="";
												$set_value="";
												if ( isset($match_entry->obj_me_settings[$set_base."_name"]) )
												{
													$set_name=$match_entry->obj_me_settings[$set_base."_name"]->value;
												}
												if ( isset($match_entry->obj_me_settings[$set_base."_val"]) )
												{
													$set_val=$match_entry->obj_me_settings[$set_base."_val"]->value;
												}
												if ( strlen($set_name)>0 )
												{
													$set_conditions[$set_name]=$set_val;
												}
											} // foreach (set number)												
											if ($action_type=="delete")
											{
												$DATABASE_ADAPTER->database->delete($action_table,$select_conditions);
											}
											if ($action_type=="select")
											{
												//$retval=$APP['db']->select_table(get_class($this),$the_member_keys,$select_props,$count);
												//$database_output->select_table($action_table,$index_fields,$select_conditions);
											}
											if ($action_type=="insert")
											{
												//$database_output->debug=true;
												//print_r($set_conditions);
												//$DATABASE_ADAPTER->database->debug=true;
												//$DATABASE_ADAPTER->database->debug=true;
												$DATABASE_ADAPTER->database->insert($action_table,$set_conditions);
											}
											if ($action_type=="update")
											{
												$DATABASE_ADAPTER->database->update($action_table,$set_conditions,$select_conditions);
											}

											$database_connection_error_log = $DATABASE_ADAPTER->database->get_error();

											if (strlen($database_connection_error_log)==0)
											{
												$database_connection_error_log="No errors were detected.";
											}
											$raw_response = $database_connection_error_log;

										}
									}
								}

							} // end if (do database output actions)


?>