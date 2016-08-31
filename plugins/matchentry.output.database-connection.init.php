<?php
						$DATABASE_ADAPTER=false;
						$database_connection_error_log="";
						$database_table_list="";
						$database_dependencies_valid=true;

						if ( $match_entry->id_entry_subtype=='database-connection' && isset($match_entry->obj_me_settings['db_type']) )
						{
							$DATABASE_ADAPTER = new MatchEntry_Database_Adapter($match_entry->obj_me_settings);
							$database_connection_error_log="";
							foreach ($SERVICES as $SERVICE)
							{
								if ($SERVICE->name==$DATABASE_ADAPTER->database->kind)
								{
									if (!$SERVICE->enabled)
									{
										foreach ($SERVICE->dependencies as $dependency)
										{
											if (!$dependency->enabled)
											{
												$database_connection_error_log=$database_connection_error_log.getTranslation("PLATFORM DEPENDENCY FAILURE",$settings).":\n".$dependency->error."\n";
												$database_dependencies_valid=false;
											}
										}
									}
								}
							}
						}


						// COLLECT TABLE LIST FOR DATABASE, IF DATABASE IS CONNECTED...ELSE LOG ERROR
						if ( true || $database_dependencies_valid)
						{
							if ($DATABASE_ADAPTER)
							{
								if ($DATABASE_ADAPTER->database->connected)
								{
									$database_table_list=$DATABASE_ADAPTER->database->get_tables();
									//$database_connection_error_log=var_export($database_output->get_tables(),true);//var_export($database_output,true);
								}
								else
								{
									$database_connection_error_log=getTranslation("Failed to connect to database using provided credentials.",$settings);
								}
							
							}
							else
							{
								$database_connection_error_log=getTranslation("Failed to connect to database using provided credentials.",$settings);						
							}
						}

?>