<?php

							if ( $match_entry->id_entry_subtype=='file-storage-connection' )
							{
								$STORAGE_ADAPTER = new MatchEntry_Storage_Adapter($match_entry->obj_me_settings);
								if ($STORAGE_ADAPTER->storage->connected)
								{
									if ( isset($match_entry->obj_me_settings["fs_action_type"]) && isset($match_entry->obj_me_settings["target_filename"]) )
									{
										if ( strlen($match_entry->obj_me_settings["fs_action_type"]->value)>0 && strlen($match_entry->obj_me_settings["target_filename"]->value)>0 )
										{
											if ($match_entry->obj_me_settings["fs_action_type"]->value=="write")
											{
												$bucket_name = "";
												if ( isset($STORAGE_ADAPTER->storage->basefolder) )
												{
													$bucket_name = $STORAGE_ADAPTER->storage->basefolder;
												}
												else
												{
													$bucket_name = $STORAGE_ADAPTER->storage->bucket;
												}
												if (strlen($bucket_name)>0 && isset($match_entry->obj_me_settings["mime"]) && strlen($match_entry->obj_me_settings["mime"]->value)>0)
												{
													try
													{
														$STORAGE_ADAPTER->storage->create_object(false,$bucket_name,$match_entry->obj_me_settings["target_filename"]->value,$match_entry->obj_me_settings["content"]->value,$match_entry->obj_me_settings["mime"]->value);
														if (isset($database_connection_error_log) && strlen($database_connection_error_log)==0)
														{
															$raw_response="No errors were detected.";
														}
													}
													catch (Exception $e)
													{
														$raw_response = var_export($e,true);
														$storage_error_log = $raw_response;
													}
												}
											}
											if ($match_entry->obj_me_settings["fs_action_type"]->value=="delete")
											{
											}
										} // action & target filename set
									} // fields set
								} // is storage connected
								else
								{
									$raw_response = getTranslation("Unable to connect to file store.",$setting);
									$storage_error_log = $raw_response;
								}
							} // is a file storage connection


?>
