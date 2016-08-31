<?php

							if ( $match_entry->id_entry_subtype=='http-connection' )
							{
								if ( isset($match_entry->obj_me_settings['str_to_url']) && strlen($match_entry->obj_me_settings['str_to_url']->value)>0 )
								{
									$data_array=array();
									foreach ($match_entry->obj_me_settings as $mes)
									{
										if ( strpos($mes->name,"subsetting_post")===0 && endsWith($mes->name,"name") )
										{
											$data_array[$mes->value]=$match_entry->obj_me_settings[str_replace("name","val",$mes->name)]->value;
										}
									}
									$posting_url = $match_entry->obj_me_settings['str_to_url']->value;
									$defaults = array( 
										CURLOPT_POST => 1, 
										CURLOPT_HEADER => 0, 
										CURLOPT_URL => $posting_url, 
										CURLOPT_FRESH_CONNECT => 1, 
										CURLOPT_RETURNTRANSFER => 1, 
										CURLOPT_FORBID_REUSE => 1, 
										CURLOPT_TIMEOUT => 10, 
										CURLOPT_FOLLOWLOCATION=>TRUE,
										CURLOPT_POSTFIELDS => http_build_query($data_array)
									); 
									$options = array();
									$ch = curl_init(); 
									curl_setopt_array($ch, ($options + $defaults)); 
									if( ! $post_result = curl_exec($ch)) 
									{ 
										$post_result  = curl_error($ch);
										//trigger_error(curl_error($ch));
									}
									$raw_response = $post_result;
									curl_close($ch); 

								} // IF URL IS NOT EMPTY
							} // IF HTTP CONNECTION OUTPUT SUBTYPE



?>
