<?php
function expression_results_and_interface($OBJ_EXPR,$idx,$entire_match,$idt,$bool_buffer_output_merge)
{
	global $db;
	global $mode_xml, $mode_edit, $mode_cxml, $mode_short,$mode_output;
	global $this_server_url, $q, $qn;
	global $standalone_code;
	global $STATIC;
	global $adjacent_dictionary;
	global $APP;
	global $mode_jidonly;
	global $settings;
	global $u;
	global $demo_domain;
    global $system_adjacent_dictionary_keys;

	$retval=array();
	$retval['buffer']="";
	// idx = tree # in the forest of trees
	// xml mode
	if ($mode_xml)
	{
			for ($in=1;$in<$idt+1;$in++) echo "\t";
			echo "<result>\n";

		for ($in=1;$in<$idt+2;$in++) echo "\t";
		echo "<hfs>\n";
	}
	// edit mode
	if ($mode_edit)
	{
		echo "<ul style='margin-left:0px;background-color:".rcolor()."'>";
		//echo "<font size=-1>";
	}

	// CUSTOM HEADER FIELDS/PRINTOUT
	$chead="";
	$chead_after_replace="";
	if ( isset($OBJ_EXPR->obj_match_customs['0.header']) )
	{
		$chead=$OBJ_EXPR->obj_match_customs['0.header']->obj_txt->body;
		$chead_after_replace=replace_hf_parameters($chead,$q->obj_hf_parameters);
	}
	if ($mode_cxml && !$mode_jidonly)
	{
		if (!$bool_buffer_output_merge)
		{
			echo $chead_after_replace;
		}
	}
	$retval['buffer']=$retval['buffer'].$chead_after_replace;
	//if ($mode_cxml && !$mode_jidonly) echo $chead_after_replace;
	if ($mode_edit)
	{
		echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>";
		echo getTranslation("Custom Header",$settings)." (".substr($OBJ_EXPR->id,0,min(5,strlen($OBJ_EXPR->id))).","."0";
		echo "): ";
		echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
		echo "<input type='hidden' name='idx_key' value='0.header'/>";
		echo "<textarea name='str_txt' rows='1' cols='50' style='width:500px;'>";
		echo str_replace("<","&lt;",$chead);
		echo "</textarea>";
		echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
		echo "</form>\n";
	}
	if ($chead!=$chead_after_replace && $mode_edit)
	{
		echo "\tAfter Replacement: ".htmlspecialchars($chead_after_replace)."\n";
	}
	if ($mode_edit) echo "<ul style='margin-left:5px;'>";

	$mi=0;
	//print_r($entire_match);
	if (is_array($entire_match) )
	{
		foreach ($entire_match as $match_field)
		{ // for each (each "(.*?)" field in the regex)
			$mi=$mi+1;

			$this_value=$match_field;
			$filtering_expression="";
			$rid=0;

			
			// CUSTOM HEADER FIELDS/PRINTOUT
			$custom_head=$OBJ_EXPR->obj_match_customs;
			$chead="";
			$chead_after_replace="";
			if ( $custom_head)
			{
				if ( isset($custom_head[($mi).'.header']) )
				{
					$chead=$custom_head[($mi).'.header']->obj_txt->body;
					$chead_after_replace=replace_hf_parameters($chead,$q->obj_hf_parameters);
				}
			}
			if ($mode_cxml && !$mode_jidonly)
			{
				if (!$bool_buffer_output_merge)
				{
					echo $chead_after_replace;
				}
			}
			$retval['buffer']=$retval['buffer'].$chead_after_replace;
			// CUSTOM HEADER GUI EDIT FIELD

			$this_box_color = "";
			if ($mode_edit)
			{
				echo "<br/>";
				echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Header",$settings)." (".substr($OBJ_EXPR->id,0,min(5,strlen($OBJ_EXPR->id))).",".($mi)."): ";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_key' value='".($mi).".header'/>";
				echo "<textarea rows='1' name='str_txt' style='width:500px;'/>";
				echo str_replace("<","&lt;",$chead);
				echo "</textarea>";
				echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
				echo "</form>\n";
				if ($chead!=$chead_after_replace)
				{
					echo "\tAfter Replacement: ".htmlspecialchars($chead_after_replace)."\n";
				}

				echo "<br/>";
				echo "<b><span style='margin-left:15px;'>".getTranslation("FILTER RESULT VALUE",$settings)." (".getTranslation("Length",$settings).": ".strlen($this_value)."):</span></b>\n";

				echo "<ul style='margin-left:15px;'>";
				$rows_textarea=1;
				if ( strlen($this_value)>30 )
				{
					//$rows_textarea=2;
				}
				echo "<textarea style=\"margin-left:0px;font-family:'Courier New';\" rows='$rows_textarea' cols='60'>";
				echo str_replace("<","&lt;",$this_value);
				//echo print_r($this_value);
				//echo trim(htmlspecialchars($this_value));
				echo "</textarea>";

				$this_box_color=rcolor();
				echo "<div style='vertical-align:top;background-color:".rcolor().";margin-left:0px;'>";

			}


			$match_entries=$OBJ_EXPR->obj_match_entries;

			$bool_has_filter=false;
			$bool_has_operation=false;
			$bool_has_buffer=false;
			$bool_has_action=false;
			$bool_has_output=false;
			$bool_has_output_type_print=false;
			$bool_buffer_children=false;
			if (is_array($match_entries))
			{
				//print_r($match_entries);
				
				if ($mode_edit)
				{
					echo "<ul style='margin-left:5px;'>";
				}
				foreach ($match_entries as $match_entry)
				{
					if ($match_entry->id_entry_type == 'processing')
					{
						$bool_has_filter=true;
					}
					if ($match_entry->id_entry_type == 'operation')
					{
						$bool_has_operation=true;
					}
					// OUTPUT
					if ($match_entry->id_entry_type == 'output')
					{
						if (strpos($match_entry->idx_id,"-1")===False)
						{
							$bool_has_output=true;
							if ($match_entry->id_entry_subtype == 'print-value')
							{
								$bool_has_output_type_print=true;
							}
						}
					} // END IF OUTPUT

					// ACTION
					if ($match_entry->id_entry_type == 'action' )
					{
						$bool_has_action=true;
						if ($match_entry->id_entry_subtype == 'buffer')
						{
							$bool_has_buffer=true;
						}
					} // END IF ACTION
				} // FOREACH
				if ($bool_has_buffer|| $bool_buffer_output_merge )
				{
					$bool_buffer_children=true;
				}
				usort($match_entries, "meordersort");

				if ($mode_edit)
				{

				} // END IF (NOTEFILTER)

				foreach ($match_entries as $match_entry)
				{
					foreach ($match_entry->obj_me_settings as $MESK=>$MESV)
					{
                        //if ( !isset($match_entry->obj_me_settings[$MESK]->value) )
                        //{
                        //    $match_entry->obj_me_settings[$MESK]->value = "";
                        //}
						$match_entry->obj_me_settings[$MESK]->value=replace_dictionary($match_entry->obj_me_settings[$MESK]->value,$adjacent_dictionary);
					}
					
					$match_entry_apply_to_subgroup_array = explode("#",$match_entry->idx_id);
					$match_entry_apply_to_subgroup = $match_entry_apply_to_subgroup_array[0];
					if ($match_entry_apply_to_subgroup!=$mi)
					{
						continue;
					}
					// PROCESSING
					if ($match_entry->id_entry_type=='processing')
					{
						if ($mode_edit)
						{
							$this_box_color=rcolor();
							echo getTranslation("PROCESSING",$settings);
							echo ": ";
							echo "<ul style='background-color:$this_box_color;'>";


							if ( isset($match_entry->obj_expression) )
							{
								echo "<a name='".$match_entry->obj_expression->id."_-1.notesection'>";
								echo "<div style='background-color:".rcolor().";padding-left:35px;'>";
								echo getTranslation("Describe everything in the outer area covered by",$settings);
								echo "<span style='background-color:$this_box_color;width:100px;display:inline;'>";
								echo getTranslation("this color",$settings);
								echo "</span>";
								echo getTranslation("- what does it take as input, and what does it give as output?",$settings);
								echo "<br/>";
			
								echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>";
								echo "<input type='hidden' name='id_expr' value='".$match_entry->obj_expression->id."'/>";
								echo "<input type='hidden' name='idx_key' value='-1.notesection'/>";
								echo "<textarea rows='1' name='str_txt' style='background-color:".rcolor().";width:75%;'/>";
								$custom_entry=$match_entry->obj_expression->obj_match_customs;
								if ( isset($custom_entry["-1.notesection"]) )
								{
									echo htmlspecialchars($custom_entry["-1.notesection"]->obj_txt->body);
								}
								echo "</textarea>";

								echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";

								echo "<a style='font-size:10px;padding-left:40px;' href='#filtering_toc'>";
								echo "Go to table of contents";
								echo "</a>";		

								echo "</form>\n";
								echo "</div>";
								echo "</a>";

							} // END IF (NOTESECTION)

							echo "<form action='?q=$qn&v=filtering-expression&action=update-match-entry' method='post' style='display:inline;'>";
							echo "<input type='hidden' name='id_expr' value='".$match_entry->id_expr."'/>";
							echo "<input type='hidden' name='idx_id' value='".$match_entry->idx_id."'/>";
							echo "<input type='hidden' name='id_entry_type' value='output'/>";
							echo "PROCESSING TYPE: <select name='id_entry_subtype'>";
							echo "<option value=''></option>";
							foreach ($STATIC['processing_types'] as $processing_key=>$processing_value)
							{
								$seltxt="";
								if ($processing_key==$match_entry->id_entry_subtype)
								{
									$seltxt=" selected";
								}
								echo "<option value='".$processing_key."'$seltxt>".getTranslation($processing_value,$settings)."</option>";
							}
							echo "</select>";
							echo "<br/>";
							echo "&nbsp;&nbsp;";
							echo getTranslation("use",$settings);
							echo " ";
							echo "<textarea rows='1' name='str_expression' style='width:600px;background-color:".rcolor().";display:inline;'>";
							if ( isset($match_entry->obj_me_settings['str_expression']) )
							{
								echo $match_entry->obj_me_settings['str_expression']->obj_value->body;
							}
							echo "</textarea>";
							
							echo "<ul style='padding-left:80px;'>";

							echo "<div style='background-color:".rcolor().";'>";
							
							$fail_match_checked=false;
							if ( isset($match_entry->obj_me_settings['str_bool_fail_n_matches']) )
							{
								if ($match_entry->obj_me_settings['str_bool_fail_n_matches']->value=="true")
								{
									$fail_match_checked=true;
								}
							}
							$checked_html="";
							if ($fail_match_checked)
							{
								$checked_html=" checked='checked'";
							}
							
							echo "<input type='checkbox' name='str_bool_fail_n_matches' value='true'$checked_html/>";
							echo " ";

							echo getTranslation("If # of Matches/Occurrences",$settings);
							echo " ";

							$selected="";
							echo "<select name='str_fail_match_operator' style='background-color:".rcolor().";display:inline;'>";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="eq")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='eq'$selected>";
							echo "=";
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="not")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='not'$selected>";
							echo getTranslation("Not",$settings);
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="gt")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='gt'$selected>";
							echo "&gt;";
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="lt")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='lt'$selected>";
							echo "&lt;";
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="lte")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='lte'$selected>";
							echo "&lt;=";
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="gte")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='gte'$selected>";
							echo "&gt;=";
							echo "</option>";
							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="mod")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='mod'$selected>";
							echo getTranslation("Mod by N = 0",$settings);
							echo "</option>";

							$selected="";
							if ( isset($match_entry->obj_me_settings['str_fail_match_operator']) )
							{
								if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="modnot0")
								{
									$selected=" selected='selected'";
								}
							}
							echo "<option value='modnot0'$selected>";
							echo getTranslation("Mod by N not 0",$settings);
							echo "</option>";

							echo "</select>";
							
							echo " ";
							
							echo "<input type='text' name='str_fail_n_matches' value='";
							if ( isset($match_entry->obj_me_settings['str_fail_n_matches']) )
							{
								echo $match_entry->obj_me_settings['str_fail_n_matches']->obj_value->body;
							}
							else
							{
								echo "0";
							}
							echo "' style='background-color:".rcolor().";display:inline;width:50px;'/>";
							echo " ";
							echo getTranslation("cause function to fail with status",$settings);
							echo " ";
							echo "<input type='text' name='str_fail_status' value='";
							if ( isset($match_entry->obj_me_settings['str_fail_status']) )
							{
								echo $match_entry->obj_me_settings['str_fail_status']->obj_value->body;
							}
							else
							{
								echo "failed";
							}
							echo "' style='background-color:".rcolor().";display:inline;'/>";
							echo "</div>";

							echo "<div style='background-color:".rcolor().";'>";
							$max_matches_checked=false;
							if ( isset($match_entry->obj_me_settings['str_bool_max_matches']) )
							{
								if ($match_entry->obj_me_settings['str_bool_max_matches']->value=="true")
								{
									$max_matches_checked=true;
								}
							}
							$checked_html="";
							if ($max_matches_checked)
							{
								$checked_html=" checked='checked'";
							}
							
							echo "<input type='checkbox' name='str_bool_max_matches' value='true'$checked_html/>";
							echo "Max # of Matches: ";
							echo "<input type='text' name='str_max_match_count' value='";
							if ( isset($match_entry->obj_me_settings['str_max_match_count']) )
							{
								echo $match_entry->obj_me_settings['str_max_match_count']->obj_value->body;
							}
							else
							{
								echo "0";
							}
							echo "' style='background-color:".rcolor().";display:inline;'/>";
							echo "</div>";

							echo "</ul>";
							echo "<br/>";

							echo "<ul>";
							echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
							echo "<input type='submit' name='btnUp' value='".getTranslation("Move Up",$settings)."'/>";
							echo "<input type='submit' name='btnDown' value='".getTranslation("Move Down",$settings)."'/>";
							echo "<input type='submit' name='btnDelete' value='".getTranslation("Delete",$settings)."'/>";
							echo "</ul>";
							echo "</form>";
							echo "\n<ul>";
							echo getTranslation("using",$settings);
							echo " ";
							if ($match_entry->id_entry_subtype=='filter-regex')
								echo getTranslation("pattern",$settings);
							if ($match_entry->id_entry_subtype=='filter-split-string')
								echo getTranslation("split delimiter",$settings);
							if ($match_entry->id_entry_subtype=='filter-xpath')
								echo getTranslation("XPath",$settings);
							if ($match_entry->id_entry_subtype=='filter-split-regex')
								echo getTranslation("split regex",$settings);
							echo ": <b>";
							if ($match_entry->id_entry_subtype=='filter-regex'||$match_entry->id_entry_subtype=='filter-split-regex')
							{
								echo "#";
							}
							if ( isset($match_entry->obj_me_settings['str_expression']) )
							{
								echo htmlspecialchars( $match_entry->obj_me_settings['str_expression']->obj_value->body );
							}
							if ($match_entry->id_entry_subtype=='filter-regex'||$match_entry->id_entry_subtype=='filter-split-regex')
							{
								echo "#ism";
								echo "<br/>";
								echo "<ul >";
								echo getTranslation("filter-regex tip",$settings);
								echo "</ul>";
							}
							echo "</b></ul>\n";
						} // end if (edit interface)


						$filtering_expression="";
						if ( isset($match_entry->obj_me_settings['str_expression']) )
						{
							$filtering_expression=$match_entry->obj_me_settings['str_expression']->obj_value->body;
						}
						$orig_filtering_expression=$filtering_expression;

						$filtering_expression=replace_hf_parameters($filtering_expression,$q->obj_hf_parameters);
						if ($mode_edit)
						{
							if ($filtering_expression!=$orig_filtering_expression)
							{
								if ($match_entry->id_entry_subtype=='filter-regex'||$match_entry->id_entry_subtype=='filter-split-regex')
								{
									echo "#";
								}
								echo htmlspecialchars($filtering_expression);
								if ($match_entry->id_entry_subtype=='filter-regex'||$match_entry->id_entry_subtype=='filter-split-regex')
								{
									echo "#ism";
								}
							}
							if ($match_entry->id_entry_subtype=='filter-regex')
							{
								echo "<br/>";
							}
						}

						// XML MODE OUTPUT
						if ($mode_xml)
						{
							for ($in=1;$in<$idt+3;$in++) echo "\t";
							echo "<hf>\n";

							for ($in=1;$in<$idt+4;$in++) echo "\t";
							echo "<expression>".htmlspecialchars($filtering_expression)."</expression>\n";
						} // end if


						// PROCESSING SUBTYPE: FILTER REGEX
						if ($match_entry->id_entry_subtype=='filter-regex')
						{
							// if regex
                                                        if (strlen($filtering_expression)>0)
							{
								preg_match_all("#".$filtering_expression."#ism",$this_value,$submatches,PREG_SET_ORDER);
							}
							else
							{
							}
							if ( strlen($filtering_expression)==0)
							{
								$submatches=array();
							}
							else if ($filtering_expression=="(.*)" )
							{
								$submatches=array( array($this_value) );
							}
							else
							{
								for ($i=0;$i<count($submatches);$i++)
								{
									unset($submatches[$i][0]);
								}
							}
						} // end if (is regex filtering)

						// PROCESSING SUBTYPE: SPLIT STRING
						if ($match_entry->id_entry_subtype=='filter-split-string')
						{
							$submatch_retval=array();
							if ( strlen($filtering_expression)>0 )
							{
								// if split
								$submatches=explode($filtering_expression,$this_value);
								foreach ($submatches as $sm)
								{
									$submatch_retval[]=array($sm);
								}
								$submatches=$submatch_retval;
							}
						}

						// PROCESSING SUBTYPE: STRING FORMATTER
						if ($match_entry->id_entry_subtype=='filter-string-formatter')
						{
							// if split
							//echo "SUBMATCHES:";
							$submatches=sscanf($this_value,$filtering_expression);
							$submatch_retval=array();
							foreach ($submatches as $sm)
							{
								$submatch_retval[]=array($sm);
							}
							$submatches=$submatch_retval;
							//print_r($submatches);
						}

						// PROCESSING SUBTYPE: REGEX SPLIT
						if ($match_entry->id_entry_subtype=='filter-split-regex')
						{
							// if split
							if ( strlen($filtering_expression)>0 )
							{
								$submatches=preg_split("#".$filtering_expression."#ism",$this_value);
								$submatch_retval=array();
								foreach ($submatches as $sm)
								{
									$submatch_retval[]=array($sm);
								}
								$submatches=$submatch_retval;
							}
							else
							{
								$submatches=array();
							}
							// echo "<pre>";
							// print_r($submatches);
						}

						// PROCESSING SUBTYPE: XPATH
						if ($match_entry->id_entry_subtype=='filter-xpath')
						{
							try
							{
								// if xpath
								if ( strlen($filtering_expression)>0 )
								{
									$xp_xml = new SimpleXMLElement($this_value);
									$submatches = $xp_xml->xpath( $filtering_expression ) ;
	
									for ($iii=0;$iii<count($submatches);$iii++)
									{
										$submatches[$iii]=array(if_attribute_xpath_parse(innerxml($submatches[$iii]),$filtering_expression));
									}
								}
							}
							catch (Exception $e)
							{
							}
						}

						// XML MODE OUTPUT
						if ($mode_xml)
						{
							for ($in=1;$in<$idt+4;$in++) echo "\t";
							echo "<results>\n";
						} // end if

						if ($mode_edit)
						{
							echo "<ul style='margin-left:5px;'>";
							echo "<ul style='margin-left:5px;'>";
						}
						
						$match_counter=0;

						// IF A NON-BLANK FILTERING EXPRESSION...
						if ( strlen($filtering_expression)>0 )
						{

							$chead="";
							$chead_after_replace="";
							//echo "<pre>";
							//print_r($match_entry->obj_expression);
							if ( isset($match_entry->obj_expression->obj_match_customs) )
							{
								$custom_head=$match_entry->obj_expression->obj_match_customs;
								if ( isset($custom_head['-1.header']) )
								{
										$chead=$custom_head['-1.header']->obj_txt->body;
										$chead_after_replace=replace_hf_parameters($chead,$q->obj_hf_parameters);
								}
							}
							if ($mode_cxml && !$mode_jidonly)
							{
								if (!$bool_buffer_output_merge)
								{
										echo $chead_after_replace;
								}
							}
							$retval['buffer']=$retval['buffer'].$chead_after_replace;
							// CUSTOM FOOTER GUI EDIT FIELD
							if ($mode_edit)
							{
								echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Header",$settings)."(".substr($match_entry->obj_expression->id,0,min(strlen($match_entry->obj_expression->id),5)).",-1): ";
								echo "<input type='hidden' name='id_expr' value='".$match_entry->obj_me_settings['str_expression']->obj_value->id."'/>";
								echo "<input type='hidden' name='idx_key' value='-1.header'/>";
								echo "<textarea rows='1' name='str_txt' style='width:500px;'/>";
								echo str_replace("<","&lt;",$chead);
								echo "</textarea>";
								echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
								echo "</form>\n";
							}
							if ($chead!=$chead_after_replace)
							{
								echo "\tAfter Replacement: ".htmlspecialchars($chead_after_replace)."\n";
							}



								if ( isset($match_entry->obj_me_settings['str_bool_max_matches']) && isset($match_entry->obj_me_settings['str_max_match_count']) )
								{
									if ($match_entry->obj_me_settings['str_bool_max_matches']->value!="false")
									{
										if ( strlen($match_entry->obj_me_settings['str_max_match_count']->value)>0 )
										{
											if ( count($submatches) > intval($match_entry->obj_me_settings['str_max_match_count']->value) && intval($match_entry->obj_me_settings['str_max_match_count']->value)>0 )
											{
												$submatches = array_slice($submatches,0,intval($match_entry->obj_me_settings['str_max_match_count']->value));
											}
									
										}
									}
								}

							$function_fail=false;
							// FAIL CONDITION CHECK
							if ( true )
							{
								if ( isset($match_entry->obj_me_settings['str_bool_fail_n_matches']) && isset($match_entry->obj_me_settings['str_fail_match_operator']) && isset($match_entry->obj_me_settings['str_fail_n_matches']) && isset($match_entry->obj_me_settings['str_fail_status']) )
								{
									if ($match_entry->obj_me_settings['str_bool_fail_n_matches']->value!="false")
									{
										if ( strlen($match_entry->obj_me_settings['str_fail_match_operator']->value)>0 && strlen($match_entry->obj_me_settings['str_fail_n_matches']->value)>0 && strlen($match_entry->obj_me_settings['str_fail_status']->value)>0  )
										{
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="eq")
											{
												if ( count($submatches) == intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="not")
											{
												if ( count($submatches) != intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="lt")
											{
												if ( count($submatches) < intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="gt")
											{
												if ( count($submatches) > intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="gte")
											{
												if ( count($submatches) >= intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="lte")
											{
												if ( count($submatches) <= intval($match_entry->obj_me_settings['str_fail_n_matches']->value) )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="mod")
											{
												if ( count($submatches) % intval($match_entry->obj_me_settings['str_fail_n_matches']->value) == 0 )
												{
													$function_fail=true;
												}
											}
											if ($match_entry->obj_me_settings['str_fail_match_operator']->value=="modnot0")
											{
												if ( count($submatches) % intval($match_entry->obj_me_settings['str_fail_n_matches']->value) != 0 )
												{
													$function_fail=true;
												}
											}
										} // end if (fail fields not blank)
									}
								}
							}

							if ($function_fail)
							{
								if ( ($mode_xml || $mode_cxml) && $mode_output )
								{
									$new_job_flag = new job_flag();
									$props=array();
									$props['id_job']=$_GET['JID'];
									$props['flag']="failed";
									$props['status']=$match_entry->obj_me_settings['str_fail_status']->value;//."-count:".count($submatches);
									$new_job_flag->create($props);
									sleep(2);
									return;
								}
								if ($mode_edit)
								{
									echo "<ul>";
									echo getTranslation("If this function were run, it would fail because there are",$settings)." ".count($submatches)." ".getTranslation("matches.",$settings);
									echo "</ul>";
								}
							}

							if ($match_entry->id_entry_subtype=='filter-regex' || $match_entry->id_entry_subtype=='filter-xpath')
							{
								foreach ($submatches as $sm)
								{
									$match_counter=$match_counter+1;
									$bo=expression_results_and_interface($match_entry->obj_expression,$match_counter,$sm,$idt+4,$bool_buffer_children);
									if ($bool_buffer_children)
									{
										$retval['buffer']=$retval['buffer'].$bo['buffer'];
									}
									if ($match_counter==20 && $mode_short)
									{
										if ($mode_edit)
										{
											echo "<span style='background-color:red;color:white'>Only a few values have been printed out on this edit page (limit 100)</span><br/>\n";
										}
										break;
									}
								} // foreach (submatch)
							} // end if (regex)
							else if ( $match_entry->id_entry_subtype=='filter-split-string' || $match_entry->id_entry_subtype=='filter-split-regex'||$match_entry->id_entry_subtype=='filter-string-formatter'  )
							{
								foreach ($submatches as $sm)
								{
									$bo=expression_results_and_interface($match_entry->obj_expression,1,$sm,$idt+4,$bool_buffer_children);
									if ($bool_buffer_children)
									{
										$retval['buffer']=$retval['buffer'].$bo['buffer'];
									}
								} // end for
							} // end if (split)


							// CUSTOM FOOTER GUI EDIT FIELD
							$cfoot="";
							$cfoot_after_replace="";
							if ( isset($match_entry->obj_expression->obj_match_customs) )
							{
								$custom_foot=$match_entry->obj_expression->obj_match_customs;
								if ( isset($custom_foot['-1.footer']) )
								{
									$cfoot=$custom_foot['-1.footer']->obj_txt->body;
									$cfoot_after_replace=replace_hf_parameters($cfoot,$q->obj_hf_parameters);
								}
							}
							if ($mode_cxml && !$mode_jidonly)
							{
								if (!$bool_buffer_output_merge)
								{
									echo $cfoot_after_replace;
								}
							}
							$retval['buffer']=$retval['buffer'].$cfoot_after_replace;
							if ($mode_edit)
							{
								echo "<br/>";
								echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Footer",$settings)."(".substr($match_entry->obj_expression->id,0,min(strlen($match_entry->obj_expression->id),5)).",-1): ";
								echo "<input type='hidden' name='id_expr' value='".$match_entry->obj_me_settings['str_expression']->obj_value->id."'/>";
								echo "<input type='hidden' name='idx_key' value='-1.footer'/>";
								echo "<textarea rows='1' name='str_txt' style='width:500px;'/>";
								echo str_replace("<","&lt;",$cfoot);
								echo "</textarea>";
								echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
								echo "</form>\n";
							}
							if ($cfoot!=$cfoot_after_replace)
							{
								echo "\tAfter Replacement: ".htmlspecialchars($cfoot_after_replace)."\n";
							}

						} // end if (not blank processing expression)

						if ($mode_edit)
						{
							echo "</ul>";
							echo "</ul>";
						}

						// A EXPRESSION WHICH HAS FAILED (NO MATCHES)
						// PRINT OUT VAL
						if ($mode_cxml)
						{
							if ($match_counter==0)
							{
								//echo htmlspecialchars($this_value);
							}
						}

						// XML MODE OUTPUT
						if ($mode_xml)
						{
							// A EXPRESSION WHICH HAS FAILED (NO MATCHES)
							// PRINT OUT VAL

							/*if ($match_counter==0) // there were no more submatches! print out val
							{
								for($in=1;$in<$idt+2+3;$in++) echo "\t";
								echo "<value>";
								echo "<offset>".$this_idx."</offset><string>".mb_convert_encoding(htmlspecialchars($this_value),"UTF-8")."</string>";
								echo "</value>\n";
							}*/
							for($in=1;$in<$idt+4;$in++) echo "\t";
							echo "</results>\n";
							for($in=1;$in<$idt+3;$in++) echo "\t";
							echo "</hf>\n";
						} // end if (xml)
						if ($mode_edit)
						{
							//echo "</ul>";
						}

						if ($mode_edit)
						{
							echo "</ul>";
						}

					} // END IF (PROCESSING)
					// OPERATION
					else if ($match_entry->id_entry_type=='operation')
					{
						$pp='';
						$ap='';
						if ( $match_entry->id_entry_subtype=='prepend-and-append' || $match_entry->id_entry_subtype=='prepend-and-append-file' )
						{
							if ( isset($match_entry->obj_me_settings['prepend']) )
							{
								$pp=$match_entry->obj_me_settings['prepend']->obj_value->body;
							}
							if ( isset($match_entry->obj_me_settings['prepend']) )
							{
								$ap=$match_entry->obj_me_settings['append']->obj_value->body;
							}
						} // end if (prepend & append)
						$find="";
						$replace_with="";
						if ( $match_entry->id_entry_subtype=='replace' || $match_entry->id_entry_subtype=='replace-using-regex' )
						{
							if ( isset($match_entry->obj_me_settings['find']) )
							{
								$find=$match_entry->obj_me_settings['find']->obj_value->body;
							}
							if ( isset($match_entry->obj_me_settings['replace_with']) )
							{
								$replace_with=$match_entry->obj_me_settings['replace_with']->obj_value->body;
							}
						} // end if (replace)

						if ($mode_edit)
						{
							echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-match-entry' method='post'>";
							echo "<input type='hidden' name='id_expr' value='".$match_entry->id_expr."'/>";
							echo "<input type='hidden' name='idx_id' value='".$match_entry->idx_id."'/>";
							echo "<input type='hidden' name='id_entry_type' value='".$match_entry->id_entry_type."'/>";
							echo getTranslation("OPERATION",$settings);
							echo ": <select name='id_entry_subtype'>";
							echo "<option value=''></option>";
							foreach ($STATIC['operation_types'] as $operation_type_key=>$operation_type_value)
							{
								$seltxt="";
								if ( $operation_type_key==$match_entry->id_entry_subtype )
								{
									$seltxt=" selected";
								}
								echo "<option value='".$operation_type_key."'".$seltxt.">".getTranslation($operation_type_value,$settings)."</option>";
							}
							echo "</select>";
							echo ":<br/>";
							echo "<ul>";

							if ( $match_entry->id_entry_subtype == 'prepend-and-append' || $match_entry->id_entry_subtype == 'prepend-and-append-file' )
							{
								echo getTranslation("Prepend",$settings);
								echo ": <textarea rows='1' name='prepend' style='background-color:".rcolor().";width:200px;display:inline;'>".htmlspecialchars($pp)."</textarea>;";
								echo getTranslation("Append",$settings);
								echo ": <textarea rows='1' name='append' style='background-color:".rcolor().";width:200px;display:inline;'>".htmlspecialchars($ap)."</textarea>;";
							} // end if (prepend)
							if ( $match_entry->id_entry_subtype == 'replace' || $match_entry->id_entry_subtype == 'replace-using-regex' )
							{
								echo getTranslation("Replace",$settings);
								echo ": <textarea style='background-color:".rcolor().";display:inline;' rows='1' name='find'>".htmlspecialchars($find)."</textarea>; ";
								echo getTranslation("With",$settings);
								echo ": <textarea style='background-color:".rcolor().";display:inline;' rows='1' name='replace_with'>".htmlspecialchars($replace_with)."</textarea>;";
							} // end if (replace)
							echo "<br/>";
							echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
							echo "<input type='submit' name='btnUp' value='".getTranslation("Move Up",$settings)."'/>";
							echo "<input type='submit' name='btnDown' value='".getTranslation("Move Down",$settings)."'/>";
							echo "<input type='submit' name='btnDelete' value='".getTranslation("Delete",$settings)."'/>";
							echo "</form>";
							echo "</ul>";
							echo "";
						} // end if (edit mode);
						if ( $match_entry->id_entry_subtype == 'read-non-html' )
						{
							$inside_counter=0;
							$finalval="";
							for ($i=0;$i<strlen($this_value);$i++)
							{
								$this_letter=substr($this_value,$i,1);
								if ($this_letter=="<")
								{
									$inside_counter=$inside_counter+1;
									continue;
								}
								if ($this_letter==">")
								{
									$inside_counter=$inside_counter-1;
									continue;
								}
								if ($inside_counter==0)
								{
									$finalval=$finalval.$this_letter;
								}
							} // end for
							$this_value=$finalval; // non-html
						}
						else if ( $match_entry->id_entry_subtype == 'urlencode' )
						{
							$this_value=urlencode($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'double-urlencode' )
						{
							$this_value=urlencode($this_value);
							$this_value=urlencode($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'treat-as-integer' )
						{
							$this_value=intval($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'treat-as-float' )
						{
							$this_value=floatval($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'urldecode' )
						{
							$this_value=urldecode($this_value);
							$this_value=str_replace("&amp;","&",$this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'double-urldecode' )
						{
							$this_value=urldecode($this_value);
							$this_value=str_replace("&amp;","&",$this_value);
							$this_value=urldecode($this_value);
							$this_value=str_replace("&amp;","&",$this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'prepend-and-append' )
						{
							$pp_new=replace_hf_parameters($pp,$q->obj_hf_parameters);
							$pp_new=replace_dictionary($pp,$adjacent_dictionary);
							$ap_new=replace_hf_parameters($ap,$q->obj_hf_parameters);
							$ap_new=replace_dictionary($ap,$adjacent_dictionary);
							if ($pp != $pp_new)
							{
								if ($mode_edit)
								{
									echo "<br/><ul style='vertical-align:top;'>VALUE BEFORE SUBSTITUTION: <textarea style=\"margin-left:0px;font-family:'Courier New';\" rows='1' cols='100'>".trim(htmlspecialchars($pp))."</textarea></ul>";
								}
							}
							if ($ap!= $ap_new)
							{
								if ($mode_edit)
								{
									echo "<br/><ul style='vertical-align:top;'>VALUE BEFORE SUBSTITUTION: <textarea style=\"margin-left:0px;font-family:'Courier New';\" rows='1' cols='100'>".trim(htmlspecialchars($ap))."</textarea></ul>";
								}
							}
							$ap=$ap_new;
							$pp=$pp_new;
							$this_value=$pp.$this_value.$ap; // prepend & append
						}
						else if ( $match_entry->id_entry_subtype == 'replace' )
						{
							// replace
							$this_value=str_replace($find,$replace_with,$this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'erase' )
						{
							$this_value=""; // erase
						}
						else if ( $match_entry->id_entry_subtype == 'prepend-and-append-file' )
						{
							// prepend & append file contents
							$ppf=file_get_contents($pp);
							$apf=file_get_contents($ap);
							$this_value=$ppf.$this_value.$apf; // prepend & append
						}
						else if ( $match_entry->id_entry_subtype == 'replace-using-regex' )
						{
							// replace using regular expression
							$this_value=preg_replace('#'.$find.'#', $replace_with, $this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'html-entities' )
						{
							// htmlentities
							$this_value=htmlentities($this_value,ENT_QUOTES);
						}
						else if ( $match_entry->id_entry_subtype == 'trim' )
						{
							// trim
							$this_value=trim($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'keywdreppass' )
						{
							//keyword prelacement pass
                            
							$value_after_replacement=replace_hf_parameters($this_value,$q->obj_hf_parameters);
							$value_after_replacement2=replace_dictionary($value_after_replacement,$adjacent_dictionary);
							$this_value=$value_after_replacement2;
						}
						else if ( $match_entry->id_entry_subtype == 'base64-decode' )
						{
							//base64_decode 
							$this_value=base64_decode($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'base64-encode' )
						{
							//base64_encode 
							$this_value=base64_encode($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'html-entity-decode' )
						{
							$this_value=html_entity_decode($this_value,ENT_QUOTES);
						}
						else if ( $match_entry->id_entry_subtype == 'htmlspecialchars' )
						{
							// htmlspecialchars
							$this_value=htmlspecialchars($this_value,ENT_QUOTES|ENT_SUBSTITUTE|ENT_XML1,'UTF-8');
						}
						else if ( $match_entry->id_entry_subtype == 'htmlspecialchars-decode' )
						{
							// htmlspecialchars_decode
							$this_value=htmlspecialchars_decode($this_value,ENT_QUOTES|ENT_XML1,'UTF-8');
						}
						else if ( $match_entry->id_entry_subtype == 'strtoupper' )
						{
							// strtoupper
							$this_value=strtoupper($this_value);
						}
						else if ( $match_entry->id_entry_subtype == 'strtolower' )
						{
							// strtolower
							$this_value=strtolower($this_value);
						}
						if ($mode_edit)
						{
							echo "<br/><ul style='vertical-align:top;'>";
							echo getTranslation("VALUE AFTER OPERATION",$settings);
							echo ": <textarea style=\"margin-left:0px;font-family:'Courier New';\" rows='1' cols='100'>".trim(htmlspecialchars($this_value))."</textarea></ul><br/><br/>";
						}

					} // END IF (OPERATION)
					// ACTION
					else if ($match_entry->id_entry_type=='action')
					{
						// todo need to add xml/cxml mode codes
						if ($mode_edit)
						{
							echo "<form action='?q=$qn&v=filtering-expression&action=update-match-entry' method='post' style='display:inline;'>";
							echo "<input type='hidden' name='id_expr' value='".$match_entry->id_expr."'/>";
							echo "<input type='hidden' name='idx_id' value='".$match_entry->idx_id."'/>";
							echo "<input type='hidden' name='id_entry_type' value='output'/>";
							echo getTranslation("ACTION",$settings);

							echo ": <select name='id_entry_subtype'>";
							echo "<option value=''></option>";
							foreach ($STATIC['action_types'] as $action_key=>$action_value)
							{
								$seltxt="";
								if ($action_key==$match_entry->id_entry_subtype)
								{
									$seltxt=" selected";
								}

								if ($action_key!="php-code" || $_SERVER['HTTP_HOST']!=$demo_domain)
								{
									echo "<option value='".$action_key."'$seltxt>".getTranslation($action_value,$settings)."</option>";
								}

							}
							echo "</select>";
						}
						if ( $match_entry->id_entry_subtype == 'his-hf' )
						{
							$his_url="";
							if ( isset($match_entry->obj_me_settings['str_his']) )
							{
								$his_url=$match_entry->obj_me_settings['str_his']->obj_value->body;
							}

							$his_url_after_hfp_replacement=replace_hf_parameters($his_url,$q->obj_hf_parameters);
							$his_url_after_dict_replace=replace_dictionary($his_url_after_hfp_replacement,$adjacent_dictionary);

							if ($mode_edit)
							{
								echo ": ";
								echo "<br/>";
								echo "<ul>";
								echo "HIS ";
								echo getTranslation("URL",$settings);
								echo ":<br/><textarea rows='1' name='str_his' style='width:500px;'>";
								echo htmlspecialchars($his_url);
								echo "</textarea>";
								echo "<br/>";
								if ($his_url!=$his_url_after_dict_replace)
								{
									echo "<b>";
									echo getTranslation("After Function Parameter/Adjacent Dictionary Value Replacement",$settings);
									echo ":</b>";
									echo "<ul>";
									echo "<textarea style='background-color:#ddd;width:500px;' readonly='readonly'>";
									echo htmlspecialchars($his_url_after_dict_replace);
									echo "</textarea>";
									echo "</ul>";
								}
								echo getTranslation("Shortcut to Settings page",$settings);
								echo ": ";
								echo "<ul>";
								echo "<a href='?q=$qn&v=settings' target='_new'>";
								echo getTranslation("Click Here",$settings);
								echo " ";
								echo "<img src='images/settings.png' border='0' width='20'/></a>";
								echo "</ul>";
								
								echo getTranslation("Example",$settings);
								echo "<ul>";
								echo "$this_server_url/<font color='red'>?</font>s=weather<font color='red'>&</font>uid=YOUR-UID<font color='red'>&</font>secret=YOUR-SECRET<font color='red'>&</font>cxml<font color='red'>&</font>remote<font color='red'>&</font>location=Atlanta%2C+GA";
								echo "</ul>";

								echo getTranslation("Example",$settings);
								echo "<ul>";
								echo "$this_server_url/<font color='red'>?</font>q=4f6cc17061477b0348630219f32985420855235a<font color='red'>&</font>uid=YOUR-UID<font color='red'>&</font>secret=YOUR-SECRET<font color='red'>&</font>cxml<font color='red'>&</font>remote<font color='red'>&</font>location=Atlanta%2C+GA";
								echo "</ul>";

								echo "<br/>";
								echo "<br/>";

								echo getTranslation("Suggested Local HIS Functions based on current parameters and dictionary values",$settings);
								echo ":";
								echo "<ul>";
								$suggested_hfs=array();

								foreach ($adjacent_dictionary as $adk=>$adv)
								{
									if ( is_standard_ad($adk) ) continue;

									$hfp_hf=new hfp_hf();
									$hfp_hfs=$hfp_hf->get_from_hashrange($u->id_user."@".$adk);
									foreach ($hfp_hfs as $each_hfp_hf)
									{
										if ($each_hfp_hf['id_hf']!="undefined")
										{
											$suggested_id_hf_ary = explode("@",$each_hfp_hf['id_hf']);
											$suggested_id_hf = $suggested_id_hf_ary[0];
											if ($suggested_id_hf==$qn) continue;
											$suggested_hf = new hf_id_user();
											$suggested_hf->get_from_hashrange($u->id_user,$suggested_id_hf);
											if ($suggested_hf->id!="undefined")
											{
												$suggested_hfs[]=array('hf'=>$suggested_hf,'param'=>$each_hfp_hf);
												//echo $suggested_hf->name;
												//echo "<br/>";
											}
										}
									}
								}
								foreach ($q->obj_hf_parameters as $hf_param)
								{
									if ( isset($hf_param->obj_overridden) && $hf_param->obj_overridden)
									{
										continue;
									}
									if ( isset($hf_param->obj_inherited) && $hf_param->obj_inherited)
									{
										//continue;
									}
									$hfp_hf=new hfp_hf();
									$hfp_hfs=$hfp_hf->get_from_hashrange($u->id_user."@".$hf_param->keyword);
									foreach ($hfp_hfs as $each_hfp_hf)
									{
										if ($each_hfp_hf['id_hf']!="undefined")
										{
											$suggested_id_hf_ary = explode("@",$each_hfp_hf['id_hf']);
											$suggested_id_hf = $suggested_id_hf_ary[0];
											if ($suggested_id_hf==$qn) continue;
											$suggested_hf = new hf_id_user();
											$suggested_hf->get_from_hashrange($u->id_user,$suggested_id_hf);
											if ($suggested_hf->id!="undefined")
											{
												$suggested_hfs[]=array('hf'=>$suggested_hf,'param'=>$each_hfp_hf);
												//$suggested_hfs[]=$suggested_hf;
												//echo $suggested_hf->name;
												//echo "<br/>";
											}
										}
									}
								}

								$printed_suggestions=array();
								foreach ($suggested_hfs as $suggested_hf)
								{
									$suggested_hf_function=$suggested_hf['hf'];
									$suggested_hf_param=$suggested_hf['param'];
									//if (in_array($suggested_hf->id,$printed_suggestions)) continue;

									echo "<a href='?q=".$suggested_hf_function->id."&v=overview' target='_new'>";
									echo $suggested_hf_function->name;
									echo "</a>";
									echo " ";


									echo getTranslation("uses",$settings);
									echo " ";
									echo "<font color='red'>";
									
									$full_hfp_split = explode("@",$suggested_hf_param['parameter_name']);
									$full_hfp = $full_hfp_split[1];
									
									echo htmlspecialchars($full_hfp);
									echo "</font>";
									echo " ";
									echo getTranslation("as an input",$settings);
									echo " ";

									echo "<input onClick='this.form.str_his.value=\"[THIS_HIS_WEB_INTERFACE_HOME]/?q=".urlencode($suggested_hf_function->id)."&cxml&remote&uid=ENTER-YOUR-UID&secret=ENTER-YOUR-SECRET\";' type='button' value='";
									echo getTranslation("Use",$settings);
									echo "'/>";
									echo " ";
									echo "<input onClick='this.form.str_his.value=\"[THIS_HIS_WEB_INTERFACE_HOME]/?s=".urlencode($suggested_hf_function->name)."&cxml&remote&uid=ENTER-YOUR-UID&secret=ENTER-YOUR-SECRET\";' type='button' value='";
									echo getTranslation("Use by Name",$settings);
									echo "'/>";
									echo "<br/>";
									$printed_suggestions[]=$suggested_hf_function->id;
								}

								echo "</ul>";

								echo "<br/>";
								echo "<br/>";

								echo "</ul>";
							} // end if (mode edit)

							if ($his_url!=$his_url_after_dict_replace)
							{
								$his_url=$his_url_after_dict_replace;
							}
							if ( $mode_xml || $mode_cxml || $mode_jidonly )
							{
								if ( strlen($his_url)>0 )
								{
									// set his action flag (not nec., the server can detect when placeholders exist for its job id)
									// choose placeholder hash to insert into output file for now
									// generate special postback url that will fulfill placeholder in the future, and replace the hash value

									//     in this file's temporary output
									// submit job to gather output
									// set this job's status equal to "paused" when done, instead of "completed"
									//    doable without changing code here

									// jobs getting executed & updating the placeholder hashes with real his hf output
									// database table mah_placeholders
									//     id
									//     id_job         (this job)
									//     str_placeholder (generated hash)
									//     id_child_job    (job submitted to gather results to replace this job's temporary hash value printed
									// postback url's activities will include something to fulfill the placeholder (not necessary)
									//     and also run a check to see if all placeholders for this job have been completed, and, if so,
									//     run all value replacements and overwrite an updated copy of this job's temporary output
									//     file to the file storage location

									$placeholder_hash=sha1($this_value.microtime().rand(1, 20));
									if (!$mode_jidonly)
									{
										echo $placeholder_hash;
									}
									
									$GLOBALS['HIS_URLS_TO_VISIT'.$GLOBALS['VISITOR']][$placeholder_hash]=$his_url."&jidonly&uid=".urlencode($_GET['uid'])."&secret=".urlencode($_GET['secret']); // $should add &remote also?
									$this_value="";
								} // end if (hisurl not blank)
							} // end if (xml or cxml)

						} // end if (his + postback)

						if ( $match_entry->id_entry_subtype == 'cur-as-key' || $match_entry->id_entry_subtype == 'cur-as-val' || $match_entry->id_entry_subtype == 'key-and-val' || $match_entry->id_entry_subtype == 'clear-adj' )
						{

							// use current value as adjacent dictionary key2/value3
							$readonly_key="";
							$readonly_value="";
							if ( $match_entry->id_entry_subtype=='cur-as-key' )
							{
								$readonly_key=" readonly='readonly' style='background-color:#ddd;'";
							}
							else if ( $match_entry->id_entry_subtype=='cur-as-val' )
							{
								$readonly_value=" readonly='readonly' style='background-color:#ddd;'";
							}

							$dict_key="";
							$dict_value="";


							if ( $match_entry->id_entry_subtype=='cur-as-key' || $match_entry->id_entry_subtype=='key-and-val' )
							{
								if ( isset($match_entry->obj_me_settings['str_value']) )
								{
									if ($match_entry->obj_me_settings['str_value'])
									{
										$dict_value=$match_entry->obj_me_settings['str_value']->obj_value->body;
									}
								}
							}
							if ( $match_entry->id_entry_subtype=='cur-as-val' || $match_entry->id_entry_subtype=='key-and-val' )
							{
								if ( isset($match_entry->obj_me_settings['str_key']) )
								{
									if ($match_entry->obj_me_settings['str_key'])
									{
										$dict_key=$match_entry->obj_me_settings['str_key']->obj_value->body;
									}
								}
							}

							if ( $match_entry->id_entry_subtype=='cur-as-key' )
							{
								// use current value as adjacent dictionary key
								$dict_key=$this_value;
							}
							else if ( $match_entry->id_entry_subtype=='cur-as-val' )
							{
								// use current value as adjacent dictionary value
								$dict_value=$this_value;
							}


							if ( $match_entry->id_entry_subtype!='clear-adj' )
							{

								if ( strlen($dict_key)==0 && $match_entry->id_entry_subtype!='clear-adj' )
								{
									$dict_key="[test_key]";
								}
								
								if ($mode_edit && $match_entry->id_entry_subtype!='clear-adj')
								{
									echo ":<br/>";
									echo "<ul>";
									$field_name="name='str_key'";
									if ($match_entry->id_entry_subtype=='cur-as-key')
									{
										$field_name="";
									}
									echo "<textarea $field_name$readonly_key>";
								}
								$dict_key_after_hfp_replacement=replace_hf_parameters($dict_key,$q->obj_hf_parameters);
								if ($mode_edit)
								{
									echo htmlspecialchars($dict_key);
									echo "</textarea>";
	
									$field_name="name='str_value'";
									if ($match_entry->id_entry_subtype=='cur-as-val')
									{
										$field_name="";
									}

									echo " <font style='font-size:70px;'>=</font> <textarea $field_name$readonly_value>";
								}
								$dict_value_after_hfp_replacement=replace_hf_parameters($dict_value,$q->obj_hf_parameters);
								if ($mode_edit)
								{
									echo htmlspecialchars($dict_value);
									echo "</textarea><br/>";
								}
								if ($mode_edit && $match_entry->id_entry_subtype!='clear-adj')
								{
									echo "</ul>";
								}


								// show a post-hfparameter'd version
								if ( count($q->obj_hf_parameters)>0 && ($dict_value!=$dict_value_after_hfp_replacement || $dict_key!=$dict_key_after_hfp_replacement) )
								{
									if ($mode_edit)
									{
										echo "<b>After Function Parameter Value Replacement:</b>";
										echo "<ul>";
										echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
										echo $dict_key_after_hfp_replacement;
									}
									$dict_key=$dict_key_after_hfp_replacement;
									if ($mode_edit)
									{
										echo "</textarea>";
										echo " <font style='font-size:70px;'>=</font> ";
										echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
										echo $dict_value_after_hfp_replacement;
									}
									$dict_value=$dict_value_after_hfp_replacement;
									if ($mode_edit)
									{
										echo "</textarea><br/>";
										echo "</ul>";
									}
								}
								// do a AVK replace ALSO & show
								$adjacent_dictionary_without_this_entry=$adjacent_dictionary;
	
								if ( isset($adjacent_dictionary_without_this_entry[$dict_key]) )
								{
									unset($adjacent_dictionary_without_this_entry[$dict_key]);
								}
							
								$dict_key_after_dict_replace=replace_dictionary($dict_key,$adjacent_dictionary_without_this_entry);
								$dict_value_after_dict_replace=replace_dictionary($dict_value,$adjacent_dictionary_without_this_entry);

								if ( count($adjacent_dictionary)>0 && ($dict_key!=$dict_key_after_dict_replace || $dict_value!=$dict_value_after_dict_replace) )
								{
									if ($mode_edit)
									{
										echo "<b>After Adjacent Dictionary Value Replacement:</b>";
										echo "<ul>";
										echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
										echo $dict_key_after_dict_replace;
									}
									$dict_key=$dict_key_after_dict_replace;
									if ($mode_edit)
									{
										echo "</textarea>";
										echo " <font style='font-size:70px;'>=</font> ";
										echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
										echo $dict_value_after_dict_replace;
									}
									$dict_value=$dict_value_after_dict_replace;
									if ($mode_edit)
									{
										echo "</textarea><br/>";
										echo "</ul>";
									}
								}

								if (strlen($dict_key)>0)
								{
									if ( isset($adjacent_dictionary[$dict_key]) )
									{
										unset($adjacent_dictionary[$dict_key]);
									}
									$adjacent_dictionary[$dict_key]=$dict_value;
								}


							} // END IF (NOT CLEAR ADJACENT DICTIONARY MATCHENTRY SUBTYPE)

							if ( $match_entry->id_entry_subtype=='clear-adj' )
							{
								foreach ($adjacent_dictionary as $ak=>$av)
								{
									if ( !in_array($ak,$system_adjacent_dictionary_keys) )
									{
										unset($adjacent_dictionary[$ak]);
									}
								}
								if ($mode_edit)
								{
									echo "<br/>";
									echo "<br/>";
									echo "<ul>";
									echo getTranslation("Adjacent dictionary has been cleared.",$settings);
									echo "<br/>";
									echo "<br/>";
								}
							} // END IF (CLEAR ADJACENT DICTIONARY)

							// show dictionary summary
							if ( count($adjacent_dictionary)>0 || $match_entry->id_entry_subtype=='clear-adj' )
							{
								if ($mode_edit)
								{
									echo "<ul>";

									echo "<b>";
									echo getTranslation("Current Parameter Values",$settings);
									echo ": ";
									echo "</b>";
									
									echo "<ul>";
									echo "<table border='1'>";
									foreach ($q->obj_hf_parameters as $hf_param)
									{
										if ( isset($hf_param->obj_overridden) && $hf_param->obj_overridden)
										{
											continue;
										}
										
										echo "<tr>";
										echo "<td>";
										echo htmlspecialchars($hf_param->keyword);
										echo "</td>";
										echo "<td style='font-size:10px'>";
										echo htmlspecialchars($hf_param->printable_value);
										echo "</td>";
										echo "</tr>";
									}
									echo "</table>";
									echo "<br/>";
									echo "</ul>";
									
									echo getTranslation("Current Adjacent Dictionary Contents",$settings);
									echo ": ";
									echo "<ul>";
									echo "<table border='1'>";
									foreach ($adjacent_dictionary as $adk=>$adv)
									{
										if ( is_standard_ad($adk) ) continue;
										echo "<tr>";
										echo "<td>";
										echo htmlspecialchars($adk);
										echo "</td>";
										echo "<td style='font-size:10px'>";
										echo htmlspecialchars($adv);
										echo "</td>";
										echo "</tr>";
									}
									if ( count($adjacent_dictionary)==0 )
									{
										echo "<tr>";
										echo "<td>";
										echo getTranslation("Adjacent dictionary is empty.",$settings);
										echo "</td>";
										echo "</tr>";
									}
									echo "</table>";
									echo "</ul>";
									echo "<br/>";

									
									echo "</ul>";
								}
							} // END IF (SHOW ADJ DICT SUMMARY TABLE)

							if ( $match_entry->id_entry_subtype=='clear-adj' )
							{
								if ($mode_edit)
								{
									echo "</ul>";
									echo "<br/>";
								}
							}

							if ($mode_edit)
							{
								//echo "</ul>";
							}
						} // end if (use current value as adjacent dictionary key)
						if ( $match_entry->id_entry_subtype == 'buffer' )
						{
							// buffer action - collect previous childrens' value/filtering results and set filtered value to this
							//$this_value=$retval['buffer'];
							if ($bool_has_buffer)
							{
								$bool_has_buffer=false;
								$bool_buffer_children=true;
							}
							if ( $bool_buffer_output_merge )
							{
							}
							else
							{
								$bool_has_filter=false;
							}

							if ($mode_edit)
							{
								echo "<ul><br/>";
								echo getTranslation("This Buffering action will prevent printing of preceeding sub-processings' data outputs unless a \"Print Value\" OUTPUT entry is made below.",$settings);
								echo "<br/>";
								echo "<br/>";
								
								echo getTranslation("Buffered Content added to Adjacent Dictionary Key [BUFFER]",$settings);
								echo ":<br/><textarea cols='100'>";
								if ( isset($retval['buffer']) )
								{
									echo str_replace("<","&lt;",$retval['buffer']);
									//echo htmlspecialchars($this_value);
								}
								echo "</textarea>";
								echo "<br/>";
							}
							if ($mode_cxml && !$mode_jidonly)
							{
								//echo $retval['buffer'];
							}
							// do a AVK replace ALSO & show
							$adjacent_dictionary["[BUFFER]"]=$retval['buffer'];

							// show dictionary summary
							if ( count($adjacent_dictionary)>0 )
							{
								if ($mode_edit)
								{
									echo "<b>";
									echo getTranslation("Current Parameter Values",$settings);
									echo ": ";
									echo "</b>";
									
									echo "<ul>";
									echo "<table border='1'>";
									foreach ($q->obj_hf_parameters as $hf_param)
									{
										if ( isset($hf_param->obj_overridden) && $hf_param->obj_overridden)
										{
											continue;
										}
										
										echo "<tr>";
										echo "<td>";
										echo htmlspecialchars($hf_param->keyword);
										echo "</td>";
										echo "<td style='font-size:10px'>";
										echo htmlspecialchars($hf_param->printable_value);
										echo "</td>";
										echo "</tr>";
									}
									echo "</table>";
									echo "<br/>";
									echo "</ul>";
								
									echo getTranslation("Current Adjacent Dictionary Contents",$settings);
									echo ": ";
									echo "<ul>";
									
									echo "<table border='1'>";
									foreach ($adjacent_dictionary as $adk=>$adv)
									{
										if ( is_standard_ad($adk) ) continue;
										echo "<tr>";
										echo "<td>";
										echo htmlspecialchars($adk);
										echo "</td>";
										echo "<td style='font-size:10px'>";
										echo htmlspecialchars($adv);
										echo "</td>";
										echo "</tr>";
									}
									echo "</table>";
									
									echo "</ul>";
									
									echo "<br/>";

									echo "</ul>";
								}
							}
						} // end if (buffer action)
						if ( $match_entry->id_entry_subtype == 'php-code' && strpos($settings['uri']['@attributes']['value'],$demo_domain)===FALSE )
						{
							// EXECUTE PHP CODE HERE - $STR contains current value
							$the_code="";
							if ( isset($match_entry->obj_me_settings['php_code']) )
							{
								$the_code=$match_entry->obj_me_settings['php_code']->obj_value->body;
							}

							$the_code_replace=replace_hf_parameters($the_code,$q->obj_hf_parameters);
							$the_code_replace=replace_dictionary($the_code_replace,$adjacent_dictionary);
							$the_code_original=$the_code;
							$the_code=$the_code_replace;

							$this_value_before_code=$this_value;
							$STR=$this_value;
							if ($mode_edit)
							{
								echo "<ul>";
								// use current value as adjacent dictionary key
								echo "<br/>";
								echo getTranslation("Run PHP Code (Variable \$STR gets or sets current value)",$settings);
								echo ":<br/><textarea cols='50' name='php_code'>";
								echo str_replace("<","&lt;",$the_code_original);
								echo "</textarea>";
								if ($the_code_original!=$the_code_replace)
								{
									echo "<br/>";
									echo "<b>After Function Parameter/Adjacent Dictionary Value Replacement:</b>";
									echo "<ul>";
									echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
									echo htmlspecialchars($the_code);
									echo "</textarea>";
									echo "</ul>";
								}
								echo "<br/>";
								echo "<br/>";
								echo "</ul>";
							} // end if (edit mode)
							if ( strlen($the_code)>0 )
							{
								eval($the_code);
							}
							$this_value=$STR;
							if ($mode_edit)
							{
								if ($this_value_before_code!=$this_value)
								{
									echo "<br/>";
									echo "<b>Value of \$STR After PHP Code:</b>";
									echo "<ul>";
									echo "<textarea style='background-color:#ddd;' readonly='readonly'>";
									echo htmlspecialchars($this_value);
									echo "</textarea>";
									echo "</ul>";
								}
							}
						} // end if (use current value as adjacent dictionary key)
						
						// MOVE MATCH ENTRY UP OR DOWN, UPDATE OR DELETE
						if ($mode_edit)
						{
							echo "<ul>";
							echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
							echo "<input type='submit' name='btnUp' value='".getTranslation("Move Up",$settings)."'/>";
							echo "<input type='submit' name='btnDown' value='".getTranslation("Move Down",$settings)."'/>";
							echo "<input type='submit' name='btnDelete' value='".getTranslation("Delete",$settings)."'/>";
							echo "</form>";
							//echo "<input type='submit' value='Update'/><input type='submit' name='btnUp' value='Move Up'/><input type='submit' name='btnDown' value='Move Down'/></form>";
							//echo "<form style='display:inline;' action='?q=$qn&action=delete-match-action' method='post'>";
							//echo "<input type='hidden' name='id_match_entry' value='".$match_entry['id']."'/>";
							//echo "<input type='submit' value='Delete'/>";
							//echo "</form>";
							echo "</ul>";
						} // end if (edit mode)

					}
					// OUTPUT
					else if ($match_entry->id_entry_type=='output')
					{
						// todo need to add xml/cxml mode codes
						if (strpos($match_entry->idx_id,"-1")===False)
						{
							$bool_has_output=true;
						}

						$raw_response = "";

						/// SERVICES DEFINITION
						$services_file=dirname(__FILE__)."/services.xml";
						$service_doc = xmlToArray( simplexml_load_file($services_file) );
						$SERVICES=array();
						foreach ($service_doc as $services)
						{
							foreach ($services as $service)
							{
								$SERVICES[]=new Service($service);
							}
						}

						// GENERALLY USED MATCH ENTRY SETTING - ITS OKAY IF IT IS NOT USED
						$do_this_output_in_edit_mode=false;
						if ( isset( $match_entry->obj_me_settings['run_in_edit_mode'] ) )
						{
							if ( $match_entry->obj_me_settings['run_in_edit_mode']->value=="true"  )
							{
								$do_this_output_in_edit_mode=true;
							}
						}
						
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
								if ($mode_edit)
								{
									echo "<br/>";
								}
								echo getTranslation("PLUGIN ERROR DURING INITIALIZATION",$settings);
								echo ": ";
								if ($mode_edit)
								{
									echo "<br/>";
									echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
								}
								echo str_replace("<","&lt;",$e);
								if ($mode_edit)
								{
									echo "</textarea>";
									echo "<br/>";
								}
							}
						}

						// IF NOT EDIT MODE, OR IS EDIT MODE & RUN-IN-EDIT-MODE SETTING IS TURNED ON
						if (!$mode_edit || ($mode_edit && $do_this_output_in_edit_mode) )
						{
						
							if ( file_exists($plugin_exec_filename) )
							{
								try
								{
									include($plugin_exec_filename);
								}
								catch (Exception $e)
								{
									if ($mode_edit)
									{
										echo "<br/>";
									}
									echo getTranslation("PLUGIN ERROR DURING EXECUTION",$settings);
									echo ": ";
									if ($mode_edit)
									{
										echo "<br/>";
										echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
									}
									echo str_replace("<","&lt;",$e);
									if ($mode_edit)
									{
										echo "</textarea>";
										echo "<br/>";
									}
								}
							}
							
						} // IF NOT MODE EDIT OR EDIT MODE + RUN IN EDIT MODE

						if ( file_exists($plugin_dispose_filename) )
						{
							try
							{
								include($plugin_dispose_filename);
							}
							catch (Exception $e)
							{
								if ($mode_edit)
								{
									echo "<br/>";
								}
								echo getTranslation("PLUGIN ERROR DURING DISPOSAL",$settings);
								echo ": ";
								if ($mode_edit)
								{
									echo "<br/>";
									echo "<textarea rows='3' style='background-color:".rcolor()."' style='width:500px;'/>";
								}
								echo str_replace("<","&lt;",$e);
								if ($mode_edit)
								{
									echo "</textarea>";
									echo "<br/>";
								}
							}
						}

						// SHOW EDIT GUI
						if ($mode_edit)
						{
							echo "<form action='?q=$qn&v=filtering-expression&action=update-match-entry' method='post' style='display:inline;'>";
							echo "<input type='hidden' name='id_expr' value='".$match_entry->id_expr."'/>";
							echo "<input type='hidden' name='idx_id' value='".$match_entry->idx_id."'/>";
							echo "<input type='hidden' name='id_entry_type' value='output'/>";
							echo getTranslation("OUTPUT",$settings);

							echo ": <select name='id_entry_subtype'>";
							echo "<option value=''></option>";
							foreach ($STATIC['output_types'] as $output_key=>$output_value)
							{
								$seltxt="";
								$extratxt="";
								if ($output_key==$match_entry->id_entry_subtype)
								{
									$seltxt=" selected";
								}
								if ($output_key!="print-value")
								{
									$extratxt=getTranslation("Post data externally, do not print",$settings);
									$extratxt=$extratxt.": ";
								}
								echo "<option value='".$output_key."'$seltxt>".$extratxt.getTranslation($output_value,$settings)."</option>";
							}
							echo "</select>";
							echo ": ";
							echo "<br/>";
								echo "<ul>";

							if ( $match_entry->id_entry_subtype == 'print-value' )
							{
								// PRINT VALUE
								echo "<br/>";
								echo "Value will be printed out to the web page/console/output file.";
								echo "<br/>";
							} // END IF (PRINT VALUE)

							if ( file_exists($plugin_edit_filename) )
							{
								include($plugin_edit_filename);
							}
							
							// Database hf
							if ( $match_entry->id_entry_subtype == 'database-hf' )
							{
								// Database Function
								echo "Database Type ";
								echo "<select name='str_dbtype'>";
								echo "<option value=''></option>";
								foreach ($APP['services'] as $service)
								{
									if ($service->enabled && $service->type=="database")
									{
										$seltxt="";
										if ( isset($match_entry->obj_me_settings['str_dbtype']) )
										{
											if ($match_entry->obj_me_settings['str_dbtype']->obj_value->body==$service->name)
											{
												$seltxt=" selected='selected'";
											}
										}
										echo "<option value='".$service->name."'$seltxt>".$service->name."</option>";
									}
								}
								echo "</select>";
								echo "<br/>";

								echo "";
								echo "Database Server: ";
								echo "<textarea rows='1' name='str_server'>";
								if ( isset($match_entry->obj_me_settings['str_server']) )
								{
									echo $match_entry->obj_me_settings['str_server']->obj_value->body;
								}
								echo "</textarea>";
								echo "<br/>";
								echo "<ul>";
								echo "username: <textarea rows='1' name='str_user'>";
								if ( isset($match_entry->obj_me_settings['str_user']) )
								{
									echo $match_entry->obj_me_settings['str_user']->obj_value->body;
								}
								echo "</textarea>";
								echo "<br/>";
								echo "password: <textarea rows='1' name='str_pass'>";
								if ( isset($match_entry->obj_me_settings['str_pass']) )
								{
									echo $match_entry->obj_me_settings['str_pass']->obj_value->body;
								}
								echo "</textarea>";
								echo "<br/>";
								echo "database name: <textarea rows='1' name='str_dbname'>";
								if ( isset($match_entry->obj_me_settings['str_dbname']) )
								{
									echo $match_entry->obj_me_settings['str_dbname']->obj_value->body;
								}
								echo "</textarea>";
								echo "<br/>";
								echo "</ul>";

								echo "Database Statement:<ul><textarea readonly='readonly'  style='background-color:#ddd;width:600px;'>";
								echo htmlspecialchars($this_value);
								echo "</textarea></ul>";

							} // end if (database hf)

							// Send E-Mail
							// TODO
							echo "<br/>";

							echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
							echo "<input type='submit' name='btnUp' value='".getTranslation("Move Up",$settings)."'/>";
							echo "<input type='submit' name='btnDown' value='".getTranslation("Move Down",$settings)."'/>";
							echo "<input type='submit' name='btnDelete' value='".getTranslation("Delete",$settings)."'/>";
							echo "</form>";
							
							echo "</ul>";
							echo "<br/>";
							
						} // end if (edit mode);
					} // end if (match entry type == output)
					
				} // END FOREACH (MATCH ENTRY)
				
				if ($mode_edit)
				{
					echo "</ul>";
				}

			} // END IF (ANY MATCH ENTRIES ON THIS MATCH)
				
			// NO MATCH PROCESSING FILTERS ON THIS AT ALL; PRINT OUT THE VALUE YOU HAVE
			if (!$bool_has_filter && (!$bool_has_output || ($bool_has_output && $bool_has_output_type_print)) )
			{
				if ($mode_cxml && !$mode_jidonly)
				{
					if (!$bool_buffer_output_merge)
					{
						if ( !isUTF8($this_value) )
						{
							// TODO: WHAT IF THIS WAS BINARY RESULT CONTENT?
							echo mb_convert_encoding(($this_value),"UTF-8");
						}
						else
						{
							echo $this_value;
						}
					}
				} // mode cxml
				$retval['buffer']=$retval['buffer'].$this_value;
				if ($mode_xml && !$mode_jidonly)
				{
					for($in=1;$in<$idt+2;$in++) echo "\t";
					echo "<value>";
					//echo "<offset>".$this_idx."</offset>";
					echo "<string>";
					if ( !isUTF8($this_value) )
					{
						echo mb_convert_encoding(htmlspecialchars($this_value),"UTF-8");
					}
					else
					{
						echo htmlspecialchars($this_value);
					}
					echo "</string>";
					echo "</value>\n";
				} // mode xml
			} // end if ( no filters found - behavior )
			
			// ADD OUTPUT, ADD PROCESSING, ADD OPERATION, ADD ACTION GUI ELEMENTS
			if ($mode_edit)
			{
				//echo "</div>";
				//echo "<ul>";

				echo "\n";
				echo "</div>";

				echo getTranslation("ADD",$settings)." ".getTranslation("OUTPUT",$settings).": ".getTranslation("Output this value",$settings).": ";
				echo "<form action='?q=$qn&v=filtering-expression&action=add-match-entry' method='post' style='display:inline;'>";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_id' value='".($mi)."'/>";
				echo "<input type='hidden' name='id_entry_type' value='output'/>";
				echo "<select name='id_entry_subtype'>";
				echo "<option value=''></option>";
				foreach ($STATIC['output_types'] as $output_key=>$output_value)
				{
					echo "<option value='".$output_key."'>".getTranslation($output_value,$settings)."</option>";
				}
				echo "</select><input value='".getTranslation("Submit",$settings)."' type='submit'/>";
				echo "</form>";
				echo "<br/>";


				echo getTranslation("ADD",$settings)." ".getTranslation("PROCESSING",$settings).": ".getTranslation("The text above",$settings).":<!--($mi,".$OBJ_EXPR->id.",$qn)-->";
				echo " ";
				echo "<form action='?q=$qn&v=filtering-expression&action=add-match-entry' method='post' style='display:inline;'>";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_id' value='".($mi)."'/>";
				echo "<input type='hidden' name='id_entry_type' value='processing'/>";
				echo "<select name='id_entry_subtype'>";
				echo "<option value=''></option>";
				foreach ($STATIC['processing_types'] as $processing_key=>$processing_value)
				{
					echo "<option value='".$processing_key."'>".getTranslation($processing_value,$settings)."</option>";
				}
				echo "</select><input value='".getTranslation("Submit",$settings)."' type='submit'/>";
				echo "</form>";
				echo "<br/>";

				echo getTranslation("ADD",$settings)." ".getTranslation("OPERATION",$settings).": ".getTranslation("In-place modify",$settings).": ";
				echo "<form action='?q=$qn&v=filtering-expression&action=add-match-entry' method='post' style='display:inline;'>";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_id' value='".($mi)."'/>";
				echo "<input type='hidden' name='id_entry_type' value='operation'/>";
				echo "<select name='id_entry_subtype'>";
				echo "<option value=''></option>";
				foreach ($STATIC['operation_types'] as $operation_key=>$operation_value)
				{
					echo "<option value='".$operation_key."'>".getTranslation($operation_value,$settings)."</option>";
				}
				echo "</select><input value='".getTranslation("Submit",$settings)."' type='submit'/>";
				echo "</form>";
				echo "<br/>";

				echo getTranslation("ADD",$settings)." ".getTranslation("ACTION",$settings).":";
				echo " ";
				echo "<form action='?q=$qn&v=filtering-expression&action=add-match-entry' method='post' style='display:inline;'>";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_id' value='".($mi)."'/>";
				echo "<input type='hidden' name='id_entry_type' value='action'/>";
				echo "<select name='id_entry_subtype'>";
				echo "<option value=''></option>";
				foreach ($STATIC['action_types'] as $action_key=>$action_value)
				{
					if ($action_key!="php-code" || $_SERVER['HTTP_HOST']!=$demo_domain)
					{
						echo "<option value='".$action_key."'>".getTranslation($action_value,$settings)."</option>";
					}
				}
				echo "</select><input value='".getTranslation("Submit",$settings)."' type='submit'/>";
				echo "</form>";

				echo "</b></font>\n";
				echo "</ul><br/>";
				//echo "<div style='margin-left:0px;background-color:".rcolor()."'>";
			} // end if (edit mode)

			$custom_foot=$OBJ_EXPR->obj_match_customs;
			$cfoot="";
			$cfoot_after_replace="";
			if ( $custom_foot )
			{
				if ( isset($custom_foot[($mi).'.footer']) )
				{
					$cfoot=$custom_foot[($mi).'.footer']->obj_txt->body;
					$cfoot_after_replace=replace_hf_parameters($cfoot,$q->obj_hf_parameters);
				}
			}
			if ($mode_cxml && !$mode_jidonly)
			{
				if (!$bool_buffer_output_merge)
				{
					echo $cfoot_after_replace;
				}
			}
			$retval['buffer']=$retval['buffer'].$cfoot_after_replace;
			if ($mode_edit)
			{
				echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Footer",$settings)." (".substr($OBJ_EXPR->id,0,min(5,strlen($OBJ_EXPR->id))).",".($mi)."): ";
				echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
				echo "<input type='hidden' name='idx_key' value='".($mi).".footer'/>";
				echo "<textarea rows='1' name='str_txt' style='width:500px;'/>";
				echo str_replace("<","&lt;",$cfoot);
				echo "</textarea>";
				echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
				echo "</form>\n";
			}
			if ($cfoot!=$cfoot_after_replace)
			{
				echo "\tAfter Replacement: ".htmlspecialchars($cfoot_after_replace)."\n";
			}

		} // end foreach (each match field (i.e. "(.*?)" ) in the regex)

	}
	else
	{
		// NO MATCH PROCESSING FILTERS ON THIS AT ALL; PRINT OUT THE VALUE YOU HAVE
		if ($mode_cxml && !$mode_jidonly)
		{
			if (!$bool_buffer_output_merge)
			{
				if ( !isUTF8($this_value) )
				{
					// TODO: WHAT IF THIS WAS BINARY RESULT CONTENT?
					echo mb_convert_encoding(($this_value),"UTF-8");
				}
				else
				{
					echo $this_value;
				}
			}
		} // mode cxml
		$retval['buffer']=$retval['buffer'].$this_value;
		if ($mode_xml && !$mode_jidonly)
		{
			for($in=1;$in<$idt+2;$in++) echo "\t";
			echo "<value>";
			//echo "<offset>".$this_idx."</offset>";
			echo "<string>";
			if ( !isUTF8($this_value) )
			{
				echo mb_convert_encoding(htmlspecialchars($this_value),"UTF-8");
			}
			else
			{
				echo htmlspecialchars($this_value);
			}
			echo "</string>";
			echo "</value>\n";
		} // mode xml
		
	}

	
	
	if ($mode_edit) echo "</ul>";

	// CUSTOM FOOTER FIELDS/PRINTOUT
	$cfoot="";
	$cfoot_after_replace="";
	if ( isset($OBJ_EXPR->obj_match_customs['0.footer']) )
	{
		if ( isset($OBJ_EXPR->obj_match_customs['0.footer']) )
		{
			$cfoot=$custom_foot['0.footer']->obj_txt->body;
			$cfoot_after_replace=replace_hf_parameters($cfoot,$q->obj_hf_parameters);
		}
	}
	if ($mode_cxml && !$mode_jidonly)
	{
		if (!$bool_buffer_output_merge)
		{
			echo $cfoot_after_replace;
		}
	}
	$retval['buffer']=$retval['buffer'].$cfoot_after_replace;
	//if ($mode_cxml && !$mode_jidonly) echo $cfoot_after_replace;
	if ($mode_edit)
	{
		echo "<form style='display:inline;' action='?q=$qn&v=filtering-expression&action=update-custom-text' method='post'>".getTranslation("Custom Footer",$settings)." (".substr($OBJ_EXPR->id,0,min(5,strlen($OBJ_EXPR->id))).","."0"."): ";
		echo "<input type='hidden' name='id_expr' value='".$OBJ_EXPR->id."'/>";
		echo "<input type='hidden' name='idx_key' value='0.footer'/>";
		echo "<textarea rows='1' name='str_txt' style='width:500px;'/>";
		echo str_replace("<","&lt;",$cfoot);
		echo "</textarea>";
		echo "<input type='submit' value='".getTranslation("Update",$settings)."'/>";
		echo "</form>\n";
	}
	if ($cfoot!=$cfoot_after_replace && $mode_edit)
	{
		echo "\tAfter Replacement: ".htmlspecialchars($cfoot_after_replace)."\n";
	}


	if ($mode_xml)
	{
		for ($in=1;$in<$idt+2;$in++) echo "\t";
		echo "</hfs>\n";
	}

	if ($mode_edit)
	{
		echo "\n\n";
		echo "</font></ul>";
	}
	if ($mode_xml)
	{
		for ($in=1;$in<$idt+1;$in++) echo "\t";
		echo "</result>\n";
	}
	//echo "<hr/>";
	return $retval;

} // end function

?>
