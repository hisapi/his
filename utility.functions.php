<?php
if (!function_exists("json_decode"))
{
	echo "php5-json is not installed";
	exit;
}

function get_time()
{
    global $this_server_url;
    try
    {
        return intval(gmdate("U"));//file_get_contents($this_server_url."/time.php");
    }
    catch (Exception $e)
    {
        return intval(gmdate("U"));
    }
}

function get_mime_and_extension($data)
{
    global $STATIC;
    
    if ( class_exists("finfo") )
    {
        $finfo = new finfo(FILEINFO_MIME);
        $mime_info  = $finfo->buffer($data);
        if ( strpos($mime_info,";")!==FALSE ) // application/x-sh; charset=us-ascii
        {
            $mime_split = explode(";",$mime_info);
            $mime_info = $mime_split[0];
        }
        // application/x-sh
        if ( isset($STATIC['mime_types'][$mime_info]) )
        {
            return array($mime_info,$STATIC['mime_types'][$mime_info]);
        }
    } // END IF (FINFO CLASS IS DEFINED)
    return array("text/plain",$STATIC['mime_types']["text/plain"]);
}

function rcolor()
{
	$rr=rand(155,255);
	$gr=rand(155,255);
	$br=rand(155,255);
	return "#".dechex($rr).dechex($gr).dechex($br).";font-size:20px;padding:10px;display:block;margin:10px;font-weight:bold;";
}
function file_download($filename,$data)
{
	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename='.$filename);
	//header('Content-Type: application/octet-stream');
	header('Content-Type: text/xml');
	header('Content-Transfer-Encoding: UTF-8');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');

	$has_mbstring = extension_loaded('mbstring') ||@dl(PHP_SHLIB_PREFIX.'mbstring.'.PHP_SHLIB_SUFFIX); 
	$has_mb_shadow = (int) ini_get('mbstring.func_overload'); 

	if ($has_mbstring && ($has_mb_shadow & 2) ) { 
	   $size = mb_strlen($data,'UTF-8'); 
	} else { 
	   $size = strlen($data); 
	} 

	header('Content-Length: ' . $size); // mb_strlen
	echo $data;
	exit;
}

function join_paths() {
	$paths = array();

	foreach (func_get_args() as $arg) {
		if ($arg !== '') { $paths[] = $arg; }
	}

	return preg_replace('#/+#','/',join('/', $paths));
}
function create_filtering_toc($exp)
{
	global $settings;
	$retval="<ul>";

	foreach ($exp->obj_match_entries as $ome)
	{
		if ( isset($ome->obj_expression) )
		{
			$notesection = "";
			if ( isset($ome->obj_expression->obj_match_customs["-1.notesection"]) )
			{
				$notesection=$ome->obj_expression->obj_match_customs["-1.notesection"]->value;
			}
			$is_link=true;
			if ( strlen($notesection)==0 )
			{
				$notesection=getTranslation("(blank)",$settings);
				$is_link=false;
			}
			$is_link=true;
		
			if ($is_link)
			{
				$retval.="<a href='#".$ome->obj_expression->id."_-1.notesection'>";
			}
			$retval.=htmlspecialchars($notesection);
			if ($is_link)
			{
				$retval.="</a>";
			}
			$retval.="<br/>";
		}
	}

	//echo "<pre>";
	//print_r($exp);
	if ( isset($exp->obj_expression) )
	{
		echo "<pre>";
		print_r($exp->obj_expression);
	}

	foreach ($exp->obj_match_entries as $mes)
	{
		if ( isset($mes->obj_expression) )
		{
			$retval.=create_filtering_toc($mes->obj_expression);
		}
	}
	$retval.="</ul>";
	return $retval;
} // END FUNCTION
function toxmlvalue($str)
{
	if (!defined('ENT_DISALLOWED'))
	{
		$str = htmlentities($str, ENT_XML1|ENT_QUOTES, "UTF-8");
	}
	else
	{
		$str = htmlentities($str, ENT_DISALLOWED|ENT_XML1|ENT_QUOTES, "UTF-8");
	}
	$str = str_replace("\r","&#13;",$str);
	$str = str_replace("\n","&#10;",$str);
	return $str;
}
function form_field_name($str)
{
	$str = htmlentities($str,ENT_QUOTES);
	$str = str_replace("&","_",$str);
	$str = str_replace("#","_",$str);
	$str = str_replace(";","_",$str);
	$str = str_replace("'","_",$str);
	$str = str_replace("\"","_",$str);
	$str = str_replace(";","_",$str);
	$str = str_replace(" ","_",$str);
	$str = str_replace(".","_",$str);
	return $str;
}
function isUTF8($str) {
		if ($str === mb_convert_encoding(mb_convert_encoding($str, "UTF-32", "UTF-8"), "UTF-8", "UTF-32")) {
			return true;
		} else {
			return false;
		}
}

function beginsWith( $str, $sub ) {
	return ( substr( $str, 0, strlen( $sub ) ) == $sub );
}

// return tru if $str ends with $sub
function endsWith( $str, $sub ) {
	return ( substr( $str, strlen( $str ) - strlen( $sub ) ) == $sub );
}

function generaterandomstring($length = 10, $letters = '1234567890abcdefghijklmnopqrstuvwkyz')
  {
	  $s = '';
	  $lettersLength = strlen($letters)-1;

	  for($i = 0 ; $i < $length ; $i++)
	  {
		$s .= $letters[rand(0,$lettersLength)];
	  }

	  return $s;
  }
  
  
function serveravailsort($a, $b)
{
	if (intval($a->is_busy) == intval($b->is_busy))
	{
		if (intval($a->last_ping) == intval($b->last_ping)) {
			return 0;
		}
		return ( intval($a->last_ping) < intval($b->last_ping) ) ? -1 : 1;
	}
	return ( intval($a->is_busy) < intval($b->is_busy) ) ? -1 : 1;
}

function nameindexordersort($a, $b)
{
	if ($a['name'] == $b['name']) {
		return 0;
	}
	return ($a['name'] < $b['name']) ? -1 : 1;
}
function jobmodifiedordersort($a, $b)
{
	if ($a['dt_modified'] == $b['dt_modified']) {
		return 0;
	}
	return ($a['dt_modified'] < $b['dt_modified']) ? -1 : 1;
}
function lastpingordersort($a, $b)
{
	if ($a['last_ping'] == $b['last_ping']) {
		return 0;
	}
	return ($a['last_ping'] < $b['last_ping']) ? -1 : 1;
}
function meordersort($a, $b)
{
	if ($a->int_order == $b->int_order) {
		return 0;
	}
	return ($a->int_order < $b->int_order) ? -1 : 1;
}
function meordersortarray($a, $b)
{
	if ($a['int_order'] == $b['int_order']) {
		return 0;
	}
	return ($a['int_order'] < $b['int_order']) ? -1 : 1;
}

function folder_loader($dir,$priorities,$excludes)
{
	$retval=Array();
	$amqp_folders = scandir($dir, 1);
	foreach ($priorities as $priority)
	{
		for ($i=0;$i<count($amqp_folders);$i++)
		{
			if (strpos(strtolower($amqp_folders[$i]),strtolower($priority))!==FALSE)
			{
				$slice = array_slice($amqp_folders,$i,1);
				unset($amqp_folders[$i]);
				array_unshift($amqp_folders,$slice[0]);
			}
		}
	}
	foreach ($amqp_folders as $amqp_folder)
	{
		if (strpos($amqp_folder,".")===0) continue;
		if (is_dir($dir."/".$amqp_folder))
		{
				$retval = array_merge($retval, folder_loader($dir."/".$amqp_folder,$priorities,$excludes));
		}
		else
		{
			$to_add = $dir."/".$amqp_folder;
			$found_exclude = False;
			foreach ($excludes as $exclude)
			{
				if ( strpos($to_add,$exclude)!==False)
				{
					$found_exclude = True;
				}
			}
			if (!$found_exclude)
			{
				if ( strpos($to_add,".php")!==FALSE)
				{
					$retval[] = $to_add;
				}
			}
		}
	}
	return $retval;
}



/*
 * Calculate HMAC-SHA1 according to RFC2104
 * See http://www.faqs.org/rfcs/rfc2104.html
 */
function hmacsha1($key,$data) {
	$blocksize=64;
	$hashfunc='sha1';
	if (strlen($key)>$blocksize)
		$key=pack('H*', $hashfunc($key));
	$key=str_pad($key,$blocksize,chr(0x00));
	$ipad=str_repeat(chr(0x36),$blocksize);
	$opad=str_repeat(chr(0x5c),$blocksize);
	$hmac = pack(
				'H*',$hashfunc(
					($key^$opad).pack(
						'H*',$hashfunc(
							($key^$ipad).$data
						)
					)
				)
			);
	return bin2hex($hmac);
}

/*
 * Used to encode a field for Amazon Auth
 * (taken from the Amazon S3 PHP example library)
 */
function hex2b64($str)
{
	$raw = '';
	for ($i=0; $i < strlen($str); $i+=2)
	{
		$raw .= chr(hexdec(substr($str, $i, 2)));
	}
	return base64_encode($raw);
}

function is_remote($i)
{
	if ( strpos("remote",$i) !== false )
	{
		return false;
	}
	else
	{
		return true;
	}

} // end function

$system_post_variables=array("v","action","q","data","jidonly","tags","s","jidonly","--name","cxml","xml","uid","secret","url","randomfunction");
global $system_post_variables;

function is_system_post($str)
{
	global $system_post_variables;
	if ( in_array($str,$system_post_variables) || in_array(strtoupper($str),$system_post_variables) || in_array(strtolower($str),$system_post_variables) )
	{
		return true;
	}
	else
	{
		return false;
	}
}


function is_system_keyword($str)
{
	$standard_ad[]="[JID]";
	$standard_ad[]="[JOB_FOLDER]";
	$standard_ad[]="[SERVERBINS]";
	$standard_ad[]="[HISGETPOST]";
	$standard_ad[]="[USERNAME]";
	$standard_ad[]="[PERCENT]";
	$standard_ad[]="[THIS_FUNCTION_ID]";
	$standard_ad[]="[THIS_HIS_WEB_INTERFACE_HOME]";
	$standard_ad[]="[DAYOFWEEK]";
	$standard_ad[]="[DATE-EPOCHSECS]";
	$standard_ad[]="[DATE-RFC2822]";
	$standard_ad[]="[DATE-ISO8601]";
	$standard_ad[]="[HH-MM-SS]";
	$standard_ad[]="[DD-MM-YY]";
	$standard_ad[]="[YY-MM-DD]";
	$standard_ad[]="[MM-DD-YYYY]";
	$standard_ad[]="[DD-MM-YYYY]";
	$standard_ad[]="[YYYY-MM-DD]";
	if ( in_array($str,$standard_ad) || in_array(strtoupper($str),$standard_ad) || in_array(strtolower($str),$standard_ad) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function is_standard_ad($str)
{
	$standard_ad[]="[THIS_FUNCTION_ID]";
	$standard_ad[]="[THIS_HIS_WEB_INTERFACE_HOME]";
	$standard_ad[]="[RAW_OUTPUT]";
	$standard_ad[]="[BUFFER]";
	$standard_ad[]="[YYYY-MM-DD]";
	$standard_ad[]="[DD-MM-YYYY]";
	$standard_ad[]="[MM-DD-YYYY]";
	$standard_ad[]="[YY-MM-DD]";
	$standard_ad[]="[DD-MM-YY]";
	$standard_ad[]="[HH-MM-SS]";
	$standard_ad[]="[DATE-ISO8601]";
	$standard_ad[]="[DATE-RFC2822]";
	$standard_ad[]="[DATE-EPOCHSECS]";
	$standard_ad[]="[DAYOFWEEK]";
	$standard_ad[]="[THIS_HIS_WEB_INTERFACE_HOME]";
	$standard_ad[]="[JID]";
	$standard_ad[]="[JOB_FOLDER]";
	$standard_ad[]="[SERVERBINS]";
	$standard_ad[]="[HISGETPOST]";
	$standard_ad[]="[RAW_OUTPUT]";

	if ( in_array($str,$standard_ad) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

function is_secret($str)
{
	$secret_words[]="pass";
	$secret_words[]="pw";
	$secret_words[]="private";
	$secret_words[]="hidden";
	$secret_words[]="secret";
	$secret_words[]="license";
	foreach ($secret_words as $secret_word)
	{
		if ( strstr(strtolower($str),strtolower($secret_word))!=FALSE )
		{
			return true;
		} // end if
	} // end for
	return false;
} // end function

function innerxml($node)
{
	$content="";
	if (count($node->children()))
	{
		foreach($node->children() as $child)
		{
			$content .= $child->asXml();
		}
	}
	else
	{
		$content=(string)$node->asXML();
	}
	return $content;
}
function if_attribute_xpath_parse($val,$xpath)
{
	$xpath_slash_split=explode("/",$xpath);
	$last_xpath_part = $xpath_slash_split[ count($xpath_slash_split)-1 ];
	$is_attribute_xpath = $last_xpath_part[0] == "@";
	$rest_xpath="";
	if ( strlen($last_xpath_part)>1 )
	{
		$rest_xpath = substr($last_xpath_part,1);
	}
	$val_simplified = preg_replace("# ".$rest_xpath."=\"(.*?)\"#i","$1",$val);
	if ($is_attribute_xpath)
	{
		$val=$val_simplified;
	}
	return $val;
}

// Unicode BOM is U+FEFF, but after encoded, it will look like this.
define ('UTF32_BIG_ENDIAN_BOM'   , chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define ('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define ('UTF16_BIG_ENDIAN_BOM'   , chr(0xFE) . chr(0xFF));
define ('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define ('UTF8_BOM'			   , chr(0xEF) . chr(0xBB) . chr(0xBF));

function detect_utf_encoding($text) {

	//$text = file_get_contents($filename);
	$first2 = substr($text, 0, 2);
	$first3 = substr($text, 0, 3);
	$first4 = substr($text, 0, 3);

	if ($first3 == UTF8_BOM) return 'UTF-8';
	elseif ($first4 == UTF32_BIG_ENDIAN_BOM) return 'UTF-32BE';
	elseif ($first4 == UTF32_LITTLE_ENDIAN_BOM) return 'UTF-32LE';
	elseif ($first2 == UTF16_BIG_ENDIAN_BOM) return 'UTF-16BE';
	elseif ($first2 == UTF16_LITTLE_ENDIAN_BOM) return 'UTF-16LE';
}

function xmlToArray($xml)
{
	$array = json_decode(json_encode($xml), TRUE);
	if ($array)
	{
		if ( count(array_slice($array, 0)) > 0)
		{
			foreach ( array_slice($array, 0) as $key => $value )
			{
				if ( $value===false || $value==="" || $value===NULL )
				{
					$array[$key] = NULL; // NULL
				}
				elseif ( is_array($value) )
				{
					$array[$key] = xmlToArray($value);
				}
			}
		}
	}
	return $array;
} // end function

function q($str)
{
		if (strpos($str," ")===false)
		{
			return $str;
		}
		else
		{
			return "\"".$str."\"";
		}
} // end function

function aq($str)
{
		if (strpos($str,"&")===false)
		{
			return $str;
		}
		else
		{
			return "\"".$str."\"";
		}
} // end function

function time_elapsed($secs){
	$bit = array(
		'y' => $secs / 31556926 % 12,
		'w' => $secs / 604800 % 52,
		'd' => $secs / 86400 % 7,
		'h' => $secs / 3600 % 24,
		'm' => $secs / 60 % 60,
		's' => $secs % 60
		);
	$ret=array();
	foreach($bit as $k => $v)
		if($v > 0)$ret[] = $v . $k;

	return join(' ', $ret);
}

function funserialize($serialized, &$into)
{
	static $sfalse;
	if ($sfalse === null)
		$sfalse = serialize(false);
	$into = @unserialize($serialized);
	return $into !== false || rtrim($serialized) === $sfalse;//whitespace at end of serialized var is ignored by PHP
}


function replace_hf_parameters($str,$hf_parameters)
{
	if (count($hf_parameters)>0)
	{
		foreach ($hf_parameters as $hf_parameter)
		{
			$is_overridden=false;
			if ( isset($hf_parameter->obj_overridden) )
			{
				if ($hf_parameter->obj_overridden)
				{
					$is_overridden=true;
				}
			}
			if (!$is_overridden)
			{
				if ( isset($hf_parameter->keyword) )
				{
					if ( strpos($str,$hf_parameter->keyword)!==FALSE )
					{
						//echo "SUBBING WITH ".$hf_parameter->value."<br/>";
						$str=str_replace($hf_parameter->keyword,$hf_parameter->value,$str);
					}
				}
				else
				{
					echo "HF PARAMETER REPLACEMENT KEYWORD PROPERTY NOT FOUND";
					print_r($hf_parameter);
				}
			}
			else
			{
				//echo "SKIPPING ".$hf_parameter->value."<br/>";
			}
		} // end for each
	} // end if (count hf parameters)
	return $str;
} // end function

function ser_value($value)
{
		if (is_null($value))	{  return "N";  }
		elseif (is_bool($value))	{  return $value ? "b:0":"b:1";  }
		elseif (is_integer($value))	{  return "i:".$value;  }
		else	{  return "s:".strlen($value).":\"".$value."\"";  }
}
function serialize_data($array)
{
	$n = count($array);
	$result = "a:".$n.":{";
	$i = 1;
	foreach ($array as $key => $value)
	{
		$result .= ser_value($key).";";
		$result .= (is_array($value)) ? serialize_data($value) : ser_value($value).";";
	}
	$result .= "}";

	return $result;
}

function findElement($e,$str)
{
	$retval=false;
	foreach ($e as $k=>$v)
	{
		if ($k==$str)
		{
			$retval=$v;
		}
		if ( !$retval && is_array($v) )
		{
			$retval=findElement($v,$str);
		}
		if ($retval!=false)
		{
			break;
		}
	} // end foreach
	return $retval;
} // end function

function generate_salt($length=40){
	$string = "";
	$possible = "abcdefghijklmnopqrstuvwxyz!@#$%^*()_+-=,./ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

	for($i=0;$i < $length;$i++) {
		$char = $possible[mt_rand(0, strlen($possible)-1)];
		$string .= $char;
	}
	return $string;
}
function convertPHPSizeToBytes($sSize)  
{  
    if ( is_numeric( $sSize) ) {
       return $sSize;
    }
    $sSuffix = substr($sSize, -1);  
    $iValue = substr($sSize, 0, -1);  
    switch(strtoupper($sSuffix)){  
    case 'P':  
        $iValue *= 1024;  
    case 'T':  
        $iValue *= 1024;  
    case 'G':  
        $iValue *= 1024;  
    case 'M':  
        $iValue *= 1024;  
    case 'K':  
        $iValue *= 1024;  
        break;  
    }  
    return $iValue;  
}  

function format_bytes($a_bytes,$i_mode = false)
{
    $mult_factor = 1.0;
    if (!$i_mode)
    {
        $mult_factor = 1.048576;
    }
    $i_name = "i";
    if (!$i_mode)
    {
        $i_name = "";
    }

    if ($a_bytes < 1024) {
        return $a_bytes .' B';
    } elseif ($a_bytes < 1048576) {
        return round(round($a_bytes / 1024, 2)*$mult_factor, 2) .' K'.$i_name.'B';
    } elseif ($a_bytes < 1073741824) {
        return round(round($a_bytes / 1048576, 2)*$mult_factor, 2) . ' M'.$i_name.'B';
    } elseif ($a_bytes < 1099511627776) {
        return round(round($a_bytes / 1073741824, 2)*$mult_factor, 2) . ' G'.$i_name.'B';
    } elseif ($a_bytes < 1125899906842624) {
        return round(round($a_bytes / 1099511627776, 2)*$mult_factor, 2) .' T'.$i_name.'B';
    } elseif ($a_bytes < 1152921504606846976) {
        return round(round($a_bytes / 1125899906842624, 2)*$mult_factor, 2) .' P'.$i_name.'B';
    } elseif ($a_bytes < 1180591620717411303424) {
        return round(round($a_bytes / 1152921504606846976, 2)*$mult_factor, 2) .' E'.$i_name.'B';
    } elseif ($a_bytes < 1208925819614629174706176) {
        return round(round($a_bytes / 1180591620717411303424, 2)*$mult_factor, 2) .' Z'.$i_name.'B';
    } else {
        return round(round($a_bytes / 1208925819614629174706176, 2)*$mult_factor, 2) .' Y'.$i_name.'B';
    }
} // end function

function getMaximumFileUploadSize()  
{  
    $get_min = min(convertPHPSizeToBytes(ini_get('post_max_size')), convertPHPSizeToBytes(ini_get('upload_max_filesize')));
    
    if ($get_min == convertPHPSizeToBytes(ini_get('post_max_size')) )
    {
        return ini_get('post_max_size');
    }
    else
    {
        return ini_get('upload_max_filesize');
    }
}  

function str_replace_first($search, $replace, $subject) {
	$pos = strpos($subject, $search);
	if ($pos !== false) {
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}

function stringEndsWith($whole, $end)
{
	return (strpos($whole, $end, strlen($whole) - strlen($end)) !== false);
}

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function replace_dictionary($str,$dict)
{
	if (count($dict)>0)
	{
		foreach ($dict as $k=>$v)
		{
			if ( strlen($k)>0)
			{
				if ( strpos($str,$k) !== false )
				{
					$str=str_replace($k,$v,$str);
				}
			}
		}
	}
	return $str;
}

class Processmanager {
	//public $executable = "C:\\www\\_PHP5_2_10\\php";
	//public $root = "C:\\www\\parallelprocesses\\";
	public $scripts = array();
	public $processesRunning = 0;
	public $processes = 3;
	public $path = "";
	public $pipes=array();
	public $killed=false;
	public $running = array();
	public $sleep_time = 2;
	public $kill_record="";
	
	function addScript($script, $max_execution_time = 0)
	{
		$this->scripts[] = array("script_name" => $script,
		"max_execution_time" => $max_execution_time);
	}
	
	function exec($kill_flat_array,$is_windows)
	{
		$i = 0;
		for(;;)
		{
			// Fill up the slots
			while (($this->processesRunning<$this->processes) and ($i<count($this->scripts)))
			{
				//echo "<span style='color: orange;'>Adding script: ".$this->scripts[$i]["script_name"]."</span><br />";
				//ob_flush();
				//flush();
				$this->running[] = new Process($this->scripts[$i]["script_name"], $this->scripts[$i]["max_execution_time"],$this->path); // used to have & at the front of the cmd
				$this->processesRunning++;
				$i++;
			}
			
			// Check if done
			if (($this->processesRunning==0) and ($i>=count($this->scripts)))
			{
				break;
			}
			// sleep, this duration depends on your script execution time, the longer execution time, the longer sleep time
		  
			// check what is done
			foreach ($this->running as $key => $val)
			{
				if (!$val->isRunning() or $val->isOverExecuted())
				{
					//echo "RUNNING STATUS:".$val->isRunning();
					//echo "OVER STATUS:".$val->isOverExecuted();
					
					if ($val->isOverExecuted())
					{
						$this->killed=true;
                        if ($is_windows)
                        {
                            system("taskkill /PID ".$val->getPid()." /T /F");
                        }
                        else
                        {
                            system("kill -9 ".$val->getPid().";");
                        }
                        $this->kill_record = "";
						foreach ($kill_flat_array as $kill_item)
						{
							if ($is_windows)
							{
								//////////////$kill_manager = new Processmanager();
								//$kill_manager->path = "c:\\windows\\system32\\";
								//////////////$kill_manager->processes = 1;
								//////////////$kill_manager->path = $this->path;
								//$kill_manager->addScript("taskkill /F /IM ".$kill_item, 0);
								//////////////$kill_manager->addScript("taskkill /PID ".$val->getPid()." /T", 10);
								//////////////$kill_manager->exec( array(),$is_windows);
								$this->kill_record = "";
								/*
								annoying on win32
								foreach ($kill_manager->running as $kkey => $kval)
								{
									if ( isset($kill_manager->pipes[$kkey][1]) )
									{
										$this->kill_record = $kill_manager->pipes[$kkey][1];
										
										if ( isset($kill_manager->pipes[$kkey][2]) && isset($kill_manager->pipes[$kkey][1]) )
										{
											if (strlen($kill_manager->pipes[$kkey][2])> 0 || strlen($kill_manager->pipes[$kkey][1])==0)
											{
												$this->kill_record = $this->kill_record.$kill_manager->pipes[$kkey][2];
											}									
										}
									}

								}
								*/
								//print_r($kill_manager->pipes);
							}
							else
							{
							
							}
						}
					}
					if (!$val->isRunning())
					{
						/*
						annoying on win32
						try
						{
							//echo "<span style='color: green;'>Done: ".$val->script."</span><br />";
							$this->pipes[$key]=array();
							//$this->pipes[$key][0]=stream_get_contents($val->pipes[0]);
							$this->pipes[$key][1]=stream_get_contents($val->pipes[1]);
							$this->pipes[$key][2]=stream_get_contents($val->pipes[2]);
							if ( strlen($this->kill_record)>0 )
							{
								$this->pipes[$key][2].=$this->kill_record;
							}
						}
						catch (Exception $e)
						{
							logger("\tWARNING: PROBLEM ACQUIRING PIPES\n");
						}
						*/
					}
					else
					{
					/*
						annoying on win32
						try
						{
							//echo "<span style='color: red;'>Killed: ".$val->script."</span><br />";
							//print_r($val->pipes);
							//echo stream_get_contents($pipes[1]);
							$this->pipes[$key]=array();
							//$this->pipes[$key][0]=stream_get_contents($val->pipes[0]);
							$this->pipes[$key][1]=stream_get_contents($val->pipes[1]);
							$this->pipes[$key][2]=stream_get_contents($val->pipes[2]);
							if ( strlen($this->kill_record)>0 )
							{
								$this->pipes[$key][2].=$this->kill_record;
							}
						}
						catch (Exception $e)
						{
							logger("\tWARNING: PROBLEM ACQUIRING PIPES\n");
						}
					*/
					}
					//fclose($val->pipes[1]);
					//fclose($val->pipes[2]);
					//proc_close($val->resource);
					proc_terminate($val->resource);
					unset($this->running[$key]);
					$this->processesRunning--;
					//ob_flush();
					//flush();
				}
			} // END FOREACH
			sleep(1);
		} // END FOR
	} // END FUNCTION (EXEC)
}

class Process {
	public $resource;
	public $pipes;
	
	public $pipecontent;
	
	public $script;
	public $max_execution_time;
	public $start_time;
	
	function __construct($script, $max_execution_time,$cwd) {
		$this->script = $script;
		$this->pipecontent = array('','','');
		$this->pipes = array();
		$this->max_execution_time = $max_execution_time;
		$descriptorspec	= array(
			////0 => array('pipe', 'r'),
			//1 => array('pipe', 'w'),
			//2 => array('pipe', 'w')
		);
		//echo "Launching ".$script;
		//$this->resource	= proc_open($this->script, $descriptorspec, $this->pipes, $cwd); //, $_ENV
		$this->resource	= proc_open($this->script, $descriptorspec, $this->pipes, $cwd); //, $_ENV
		// set both pipes non-blocking
		// important for getting stdout?
		//stream_set_blocking($this->pipes[0], 0); // or value set to 1
		// these 2 lines have no effect on win32
		// http://www.php.net/manual/en/function.stream-set-blocking.php#110755
		//stream_set_blocking($this->pipes[1], 0);
		//stream_set_blocking($this->pipes[2], 0);
		$this->start_time = intval(gmdate('U'));
	}
	
	// is still running?
	function isRunning()
	{
		$status = proc_get_status($this->resource);

		// on win32 these 2 lines cause non-console (threaded) applications to block
		// this means if the gui proc_open'd process wants to sits there forever, the server will
		// never get past these 2 calls (or at least until somehow the gui application closes)
		// on win32 console commands work okay with this
		//$this->pipecontent[1].=stream_get_contents($this->pipes[1]);
		//$this->pipecontent[2].=stream_get_contents($this->pipes[2]);
		
		//echo "IS RUNNING:";
		//print_r($status);
		
		// how to handle separately threaded gui processes
		return intval($status["running"])==1;
	}
	// is still running?
	function getPid()
	{
		$status = proc_get_status($this->resource);
		return $status["pid"];
	}

	// long execution time, proccess is going to be killer
	function isOverExecuted()
	{
		if (intval($this->max_execution_time)>0)
		{
			//echo "wait time:".$this->max_execution_time;
			if (intval(gmdate('U'))<$this->start_time+intval($this->max_execution_time))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}

}

function createTree(&$list, $parent){
    $tree = array();
    if ($parent)
    {
    if ( is_array($parent) && count($parent)>0 )
    {
    foreach ($parent as $k=>$l){
        if(isset($list[$l['id']])){
            $l['children'] = createTree($list, $list[$l['id']]);
        }
        $tree[] = $l;
    }
    }
    } 
    return $tree;
}
function treeLeaves($nodes)
{
	$leaves=array();
	foreach ($nodes as $node)
	{
		if ( !isset($node['children']) || ( isset($node['children']) && count($node['children'])==0 ) )
		{
			$leaves[]=$node;
		}
		else
		{
			$child_leaves=treeLeaves($node['children']);
			if ( count($child_leaves)>0 )
			{
				foreach ($child_leaves as $child_leaf)
				{
					$leaves[]=$child_leaf;
				}
			}
		}
	}
	return $leaves;
}

function delTree($dir) { 
   if ( strlen(trim($dir))==0 ) {return;}
   if ( trim($dir)=="/" ) {return;}
   if ( trim($dir)=="." ) {return;}
   if ( trim($dir)==".." ) {return;}
   $dir=str_replace("..","",$dir);
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  } 

function rrmdir($dir)
{
  if ( isset($_SERVER['HTTP_HOST'] ) )
  {
    return;
  }
   if (is_dir($dir))
   { 
     $objects = scandir($dir); 
     foreach ($objects as $object)
     { 
       if ($object != "." && $object != "..")
       { 
         if (filetype($dir."/".$object) == "dir")
         {
            rrmdir($dir."/".$object);
         }
         else
         {
            unlink($dir."/".$object); 
         }
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
}

/*
$manager = new Processmanager();
$manager->executable = "C:\\www\\_PHP5_2_10\\php";
$manager->path = "C:\\www\\parallelprocesses\\";
$manager->processes = 3;
$manager->sleep_time = 2;
$manager->addScript("script1.php", 10);
$manager->addScript("script2.php");
$manager->addScript("script3.php");
$manager->addScript("script4.php");
$manager->addScript("script5.php");
$manager->addScript("script6.php");
$manager->exec();
*/




?>
