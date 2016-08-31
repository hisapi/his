<?php



							if ( $match_entry->id_entry_subtype=='print-value' )
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


							} // IF PRINT VALUE OUTPUT SUBTYPE



?>
