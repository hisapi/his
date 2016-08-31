<?php

							if ( $match_entry->id_entry_subtype=='http-connection' )
							{
								// Send value via GET/POST to URL
								echo getTranslation("POST Variables",$settings);
								echo ":<br/>";
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
									echo getTranslation("No Post variables added yet.",$settings);
								}
								foreach ($match_entry->obj_me_settings as $mes)
								{
									if ( strpos($mes->name,"subsetting_post")===0 && endsWith($mes->name,"name") )
									{
										echo getTranslation("POST Variable",$settings);
										echo ":";
										echo "<ul>";

										echo "<table width='500'>";

										echo "<tr>";
										echo "<td valign='top'>";
										// NAME
										echo "<input type='text' name='".$mes->name."' value='".htmlspecialchars($mes->obj_value->body)."'  style='background-color:".rcolor().";width:200px;display:inline;'>";
										//echo str_replace("<","&lt;",$mes->obj_value->body);
										echo "</textarea><br/>";
										if ($mes->value!=$mes->obj_value->body)
										{
											echo "<font style='font-size:9px'>";
											echo getTranslation("VALUE AFTER REPLACEMENT",$settings);
											echo ":</font><br/>";
											echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:200px;\" rows='1' >";
											echo trim(str_replace("<","&lt;",$mes->value));
											echo "</textarea>";
										}
										
										$val_name=str_replace("name","val",$mes->name);
										echo "</td>";
										echo "<td valign='top'>";
										echo "<font style='font-size:70px;'>=</font>";
										echo "</td>";
										echo "<td valign='top'>";

										// VALUE
										echo "<textarea rows='1' name='".$match_entry->obj_me_settings[$val_name]->name."'  style='background-color:".rcolor().";width:200px;display:inline;'>";
										echo str_replace("<","&lt;",$match_entry->obj_me_settings[$val_name]->obj_value->body);
										echo "</textarea><br/>";
										if ($match_entry->obj_me_settings[$val_name]->value!=$match_entry->obj_me_settings[$val_name]->obj_value->body)
										{
											echo "<font style='font-size:9px'>";
											echo getTranslation("VALUE AFTER REPLACEMENT",$settings);
											echo ":</font><br/>";
											echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:200px;\" rows='1' >";
											echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings[$val_name]->value));
											echo "</textarea>";
										}
										echo "</td>";
										echo "<td valign='top'>";
										echo "<input style='background-color:".rcolor().";display:inline;' type='submit' value='";
										echo getTranslation("Update",$settings);
										echo "'/>";
										echo "</td>";
										echo "<td valign='top'>";
										echo "<input name='btn_del_".$mes->name."' style='background-color:".rcolor().";display:inline;' type='submit' value='";
										echo getTranslation("Delete",$settings);
										echo "'/>";
										echo "</td>";
										echo "</tr>";
										echo "</table>";

										echo "</ul>";
									}
								} // end foreach (each me_setting)
								echo "</ul>";

								echo "<br/>";
								echo getTranslation("Add a new POST variable named",$settings);
								echo ": <br/>";
								echo "<input type='text' style='background-color:".rcolor().";display:inline;' name='add_subsetting_postNname'/>";
								echo "<input type='submit' value='";
								echo getTranslation("Add Variable",$settings);
								echo "' style='background-color:".rcolor().";display:inline;' name='btn_add_subsetting_postNname'/>";
								echo "<br/>";
								echo getTranslation("Send data to URL",$settings);
								echo ": <textarea rows='1' style='background-color:".rcolor().";width:600px;' name='str_to_url'>";
								if ( isset($match_entry->obj_me_settings['str_to_url']) )
								{
									echo $match_entry->obj_me_settings['str_to_url']->obj_value->body;
								}
								echo "</textarea>";
								
								if ( isset($match_entry->obj_me_settings['str_to_url']) )
								{
									if ($match_entry->obj_me_settings['str_to_url']->obj_value->body!=$match_entry->obj_me_settings['str_to_url']->value)
									{
										echo "<ul>";
										echo getTranslation("VALUE AFTER PARAMETER/ADJACENT DICTIONARY REPLACEMENT",$settings);
										echo ":";
										echo "<ul>";
										echo "<textarea style=\"margin-left:0px;font-family:'Courier New';background-color:".rcolor().";width:600px;\" rows='1' >";
										echo trim(str_replace("<","&lt;",$match_entry->obj_me_settings['str_to_url']->value));
										echo "</textarea></ul>";
										echo "</ul>";
									}
								}
								echo getTranslation("Execute this HTTP connection while in edit mode?",$settings);
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
										echo getTranslation("Raw response from Output Target URL",$settings);
										echo ":";
										echo "<br/>";
										echo "<textarea style='background-color:#ddd;width:500px;display:inline;' rows='3'>";
										echo str_replace("<","&lt;",$post_result);
										echo "</textarea>";
										echo "<a href='?q=$qn&v=".$_GET['v']."'><img style='padding-left:50px;' border='0' src='images/refresh.png' height='50'/></a>";
										echo "</ul>";
									}
								}
								echo "<br/>";

							} // end if (http-connection output)


?>
