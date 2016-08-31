<?php

// ABSTRACT CLASS FOR TYPES OF STORAGE
abstract class Storage
{
	private $store="";
	private $debug=false;
	private $kind="";  
	private $auth1="";
	private $auth2="";
	private $auth3="";
	private $auth4="";
	private $auth5="";
	public $connected=false;

	abstract protected function connect();

	// Object Creation/Retrieval Functions
	abstract protected function create_object($is_file,$bucket,$objname,$str,$mimetype);
	abstract protected function download_object($bucket,$key_url,$target_local_filename);
	abstract protected function get_object($bucket,$key_url);
	abstract protected function get_object_filesize($bucket_name,$keyname);

	// Addressing/Key/Container naming
	abstract protected function bucket_syntax();
	abstract protected function container_url($bucket);
	abstract protected function key_url($bucket_name,$keyname);

	// Functions used by all concrete Storage types
	public function url_to_key($bucket,$key_url)
	{
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
		return $keyname;
	}
	public function connectcheck($failed)
	{
		if ($failed)
		{
			$this->connected=false;
			if ($this->debug)
			{
				echo "Could not select file store named '".htmlspecialchars($this->kind)."'.";
			}
			return false;
		}
		else
		{
			$this->connected=true;
			return true;
		}
		return false;
	}
	public function _format_bytes($a_bytes)
	{
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KiB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MiB';
		} elseif ($a_bytes < 1099511627776) {
			return round($a_bytes / 1073741824, 2) . ' GiB';
		} elseif ($a_bytes < 1125899906842624) {
			return round($a_bytes / 1099511627776, 2) .' TiB';
		} elseif ($a_bytes < 1152921504606846976) {
			return round($a_bytes / 1125899906842624, 2) .' PiB';
		} elseif ($a_bytes < 1180591620717411303424) {
			return round($a_bytes / 1152921504606846976, 2) .' EiB';
		} elseif ($a_bytes < 1208925819614629174706176) {
			return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
		} else {
			return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
		}
	} // end function
	
} // end abstract class

// CONCRETE STORAGE TYPE: AWS
require_once("api/aws-sdk/sdk.class.php");
class Storage_AWS extends Storage
{
	public $region="REGION_US_STANDARD";
	function __construct()
	{
	}
	function get_object_filesize($bucket_name,$keyname)
	{
		return $this->store->get_object_filesize($bucket_name,$keyname,true);
	}
	function connect()
	{
		$failed=false;
		$s3 = new AmazonS3(array(
			'key' => $this->auth1,
			'secret' => $this->auth2
		)) or $failed=true;
		//$s3->disable_ssl_verification();
		$this->store=$s3;
		if ( strpos($this->region,"-")!==false )
		{
			$this->store->set_region( "s3-".$this->region.".amazonaws.com" );
		}
		else
		{
			$this->store->set_region( constant("AmazonS3::".$this->region) );
		}
		$this->store->enable_path_style ( true );
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
		return "bucket";	
	}
	public function download_object($bucket_name,$keyname,$target_local_filename)
	{
		$file_resource = fopen($target_local_filename, 'w+');
		$response = $this->store->get_object($bucket_name, $keyname, array(
		    'fileDownload' => $file_resource
		));
	}
	public function key_url($bucket_name,$keyname)
	{
		$FILE_LOCATION="";
		$base_url=$this->container_url($bucket_name);
		if ($base_url!==false)
		{
			$base_url=$base_url."/".$keyname;
			$FILE_LOCATION=$base_url;
		}
		return $FILE_LOCATION;
	}
	public function container_url($bucket)
	{
		if ( strpos($this->region,"-")!==false )
		{
			return "https://s3-".$this->region.".amazonaws.com"."/".$bucket;
		}
		else
		{
			return "https://".constant("AmazonS3::".$this->region)."/".$bucket;
		}
	
		//  no slash on the end of string
	}
	public function create_object($is_file,$bucket,$objname,$str,$mimetype)
	{
		$this->store->enable_path_style ( true );
		// AWS
		if ($is_file)
		{
			clearstatcache();
			if ( filesize($str) > 0)
			{
				$response = $this->store->create_mpu_object($bucket, $objname, array(
					'fileUpload' => $str,
					'partSize' => 40*MB,
					'contentType' => $mimetype,
					'acl' => AmazonS3::ACL_PUBLIC,
					'storage' => AmazonS3::STORAGE_STANDARD
				));
			}
			else
			{
				$response = $this->store->create_object($bucket,$objname,array(
					'acl' => AmazonS3::ACL_PUBLIC,
				)) or $failed=true;
			} // end if (is an empty file or not)
		}
		else
		{
			if ( strlen($str)==0)
			{
				$response = $this->store->create_object($bucket,$objname,array(
					'acl' => AmazonS3::ACL_PUBLIC,
				)) or $failed=true;
			}
			else
			{
				$response=$this->store->create_object($bucket, $objname, array(
					'body' => $str,
					'contentType' => $mimetype,
					'headers' => array(
						'Content-Encoding'=>'UTF-8'
					),
					'acl' => AmazonS3::ACL_PUBLIC
				)) or $failed=true;
			} // end if (is blank string or not)
		} // end if (is file or not)
		return $response->isOK();
	} // end function
	public function get_object($bucket,$key_url)
	{
		$this->store->enable_path_style ( true );
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
		$response = $this->store->get_object($bucket, $keyname);
		if ( $response->isOK() )
		{
			return $response->body;
		}
	}
} // end class

// CONCRETE STORAGE TYPE: RACKSPACE
require_once("api/rcf-sdk/cloudfiles.php");
class Storage_Rackspace extends Storage
{
	function __construct()
	{
	}
	function get_object_filesize($bucket_name,$keyname)
	{
		$failed=false;
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
		$cont = $this->store->get_container($bucket) or $failed=true;
		if (!$failed)
		{
			$ret=$cont->get_object($keyname);
			return $ret->bytes;
		}
		return -1;
	}
	function connect()
	{
		$failed=false;
		try
		{
			$auth = new CF_Authentication($this->auth1,$this->auth2);
			$auth->authenticate();
			$conn = new CF_Connection($auth);// or $failed=true;
			$this->store=$conn;
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
		return "container";
	}
	public function key_url($bucket_name,$keyname)
	{
		$FILE_LOCATION="";
		$base_url=$this->container_url($bucket_name);
		if ($base_url!==false)
		{
			$base_url=$base_url."/".$keyname;
			$FILE_LOCATION=$base_url;
		}
		return $FILE_LOCATION;
	}
	public function container_url($bucket)
	{
		// RACKSPACE
		// Select container. 
		$cont = $this->store->get_container($bucket) or $failed=true;
		if ($failed)
		{
			if ($this->debug)
			{
				echo "Unable to select file storage bucket '".htmlspecialchars($bucket)."'.";
			}
			return false;
		}
		if ($cont->cdn_enabled)
		{
			return $cont->cdn_uri;
		}
		else
		{
			if ($this->debug)
			{
				if ($this->debug)
				{
					echo "File storage bucket '".htmlspecialchars($bucket)."' needs to have CDN enabled.";
				}
				return false;
			}
			else
			{
				return false;
			}
		}
	} // end function
	public function create_object($is_file,$bucket,$objname,$str,$mimetype)
	{
		// RACKSPACE - send file
		// Select container. 
		$cont = $this->store->get_container($bucket) or $failed=true;
		if ($failed)
		{
			if ($this->debug)
			{
				echo "Unable to select file storage bucket '".htmlspecialchars($bucket)."'.";
			}
			return false;
		}
		//Now lets make a new Object
		$obj = $cont->create_object($objname);
		$content_to_write_to_rscf="";
		if ($is_file)
		{
			$content_to_write_to_rscf=file_get_contents($str);
		}
		else
		{
			$content_to_write_to_rscf=$str;
		}
		$obj->content_type=$mimetype;
		$obj->set_etag(md5($content_to_write_to_rscf));
		//Now lets put some stuff into the Object
		$written=$obj->write($content_to_write_to_rscf);
		return true;
	} // end function
	public function download_object($bucket_name,$keyname,$target_local_filename)
	{
		$failed=false;
		$cont = $this->store->get_container($bucket_name) or $failed=true;
		if (!$failed)
		{
			$object=$cont->get_object($keyname);

			$stream = $object->getContent();
			// Cast to string
			//$content = (string) $stream;
			$stream->rewind();
			
			file_put_contents($target_local_filename, $stream->getStream());
			
			// OR ALT APPROACH: $cdnUrl = $object->getPublicUrl();
			
			return true;
		}
		return false;
	}	
	public function get_object($bucket,$key_url)
	{
		$failed=false;
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
		$cont = $this->store->get_container($bucket) or $failed=true;
		if (!$failed)
		{
			$ret=$cont->get_object($keyname);
			return $ret->read();
		}
		return "";
	}

} // end class

// CONCRETE STORAGE TYPE: LOCALDISK
class Storage_Localdisk extends Storage
{
	public $basefolder="";

	function __construct()
	{
	}
	public function get_object_filesize($bucket_name,$keyname)
	{
		$file_path=$bucket_name."/".$keyname;
		$file_size=filesize($file_path);
		return $this->_format_bytes($file_size);
	}
	public function connect()
	{
		$failed=false;
		// nothing to do here yet
		$this->store=true;
		if ( is_dir($this->basefolder) )
		{
		}
		else if ( is_link($this->basefolder) )
		{
			if ( is_dir( readlink($this->basefolder) ) )
			{
				//echo "SYMLINK READ, DIR IS ".readlink($this->basefolder);
			}
			else
			{
				echo readlink($this->basefolder);
				echo "FOLDER DOES NOT EXIST";
				$failed=true;
			}
		}
		else
		{
			echo "BUCKET NAME: ".$this->basefolder."\n";
			echo "DOES NOT EXIST";
			$failed=true;
		}	
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
		return "webfolder";	
	}
	public function key_url($bucket_name,$keyname)
	{
		$FILE_LOCATION="";
		$base_url=$this->container_url($bucket_name);
		if ($base_url!==false)
		{
			$base_url=$base_url."/".$keyname;
			$FILE_LOCATION=$base_url;
		}
		return $FILE_LOCATION;
	}
	public function container_url($bucket)
	{
		//  no slash on the end of string
		return $bucket;
	}
	public function create_object($is_file,$bucket,$objname,$str,$mimetype)
	{
		// bucket == folder name
		// objname == rel path to filename
		$bucket = $this->basefolder;
		if ( is_dir($bucket) )
		{
			//$slash="/";
			$objname=str_replace("\\","/",$objname);
			//$relfolders=explode($slash,$objname);
			//unset($relfolders[count($relfolders)-1]);
			//$relfolder=implode($slash,$relfolders);
			//$relfolder=$bucket."/".$relfolder;
			//if ( !is_dir($relfolder) )
			//{
				//mkdir($relfolder,0770,true);
			//}

			if ($is_file)
			{
				$success=copy($str,$bucket."/".$objname);
				if (!$success)
				{
					echo "There was a problem copying the file to the bucket.";
					exit;
				}
			}
			else
			{
				file_put_contents($bucket."/".$objname,$str);
			}
			return true;
			//file_put_contents($bucket.DIRECTORY_SEPARATOR.$objname,$str);
		}
		else
		{
			if ($this->debug==false)
			{
				echo "Unable to select file storage folder '".htmlspecialchars($bucket)."'.";
			}
			return false;
		}
	
	} // end function
	public function download_object($bucket_name,$keyname,$target_local_filename)
	{
		$options = array(
		  CURLOPT_FILE    => $target_local_filename,
		  CURLOPT_TIMEOUT =>  24*60*60, // set this to 24 hours so we dont timeout on big files
		  CURLOPT_URL     => $this->key_url($bucket_name,$keyname),
		);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		curl_exec($ch);
		curl_close($ch);
		return true;
	}
	public function get_object($bucket,$key_url)
	{
		//$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
		//$keyname=$bucket."/".$keyname;
		$keyname=$key_url;
		$contents=file_get_contents($keyname);
		/*
		$contents="";
		try
		{
			$handle = fopen($keyname, "rb");
			if ($handle)
			{
				while (!feof($handle)) {
				$contents .= fread($handle, 8192);
				}
				fclose($handle);
			}
		}
		catch (Exception $e)
		{

			return $e->getMessage();
		}*/
		/*
		$contents=file_get_contents($keyname);
		if ($contents===FALSE)
		{
			$handle = fopen($key_url, "rb");
			if ($handle)
			{
				while (!feof($handle)) {
				$contents .= fread($handle, 8192);
				}
				fclose($handle);
			}
		}*/
		return $contents;	
	}

} // end class

require_once "api/dropbox-php-sdk-1.1.3/lib/Dropbox/autoload.php";
// user has to go to their https://www.dropbox.com/developers/apps and "Create app" in order
//	  to create dropbox api key
//	  "Dropbox API app" radio box > "Files and datastores" radio box > "Yes My app only needs access to files it creates." radio box > provide app name "test01" in text box 
// CONCRETE STORAGE TYPE: LOCALDISK
use \Dropbox as dbx;
class Storage_Dropbox extends Storage
{
	function __construct()
	{
	}
	public function get_object_filesize($folder_name,$keyname)
	{
        $m=$this->store->getMetadata($this->key_url($folder_name,$keyname));
        return $m['bytes'];
	}
	public function connect()
	{
		$failed=false;
		try
		{
			$dbxClient = new dbx\Client($this->auth4, "PHP-Example/1.0");
			//$accountInfo = $dbxClient->getAccountInfo();
			//print_r($accountInfo);
			$this->store = $dbxClient;
            $m=$this->store->getMetadata( $this->container_url($this->bucket) );
            if ( !isset($m['path']) )
            {
                $res = $this->store->createFolder( $this->container_url($this->bucket) );
                if (!$res)
                {
                    $failed=true;
                }
            }
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
        return "folder";
	}
	public function key_url($folder_name,$keyname)
	{
        return $this->container_url($folder_name)."/".$keyname;
	}
	public function container_url($folder)
	{
        return "/".$folder;
	}
	public function download_object($bucket_name,$keyname,$target_local_filename)
	{
	}
	public function create_object($is_file,$folder,$objname,$str,$mimetype)
	{
        // http://dropbox.github.io/dropbox-sdk-php/api-docs/v1.1.x/class-Dropbox.Client.html#_uploadFile

		if ($is_file)
		{
			$pathError = dbx\Path::findErrorNonRoot($folder."/".$objname);
			if ($pathError !== null) {
				fwrite(STDERR, "Invalid <dropbox-path>: $pathError\n");
				die;
			}

			$size = null;
			if (\stream_is_local($sourcePath)) {
				$size = \filesize($sourcePath);
			}

			$fp = fopen($objname, "rb");
			$metadata = $this->store->uploadFile($this->key_url($folder,$objname), dbx\WriteMode::add(), $fp, $size);
			fclose($fp);
			//print_r($metadata);
		}
		else
		{
			$metadata = $this->store->uploadFileFromString($this->key_url($folder,$objname),dbx\WriteMode::add(),''.$str);
	//print_r($metadata);
		}
	
	}
	public function get_object($bucket,$key_url)
	{
        $m=$this->store->getMetadata($key_url);
        list($tempurl,$dt_modified)=$this->store->createTemporaryDirectLink($key_url);
        return file_get_contents($tempurl);
        /*
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
        $fd = fopen("./Frog.jpeg", "wb");
        $metadata = $this->store->getFile("/Photos/Frog.jpeg", $fd);
        fclose($fd);
        print_r($metadata);
        */
	}

}

include("api/BoxPHPAPI/BoxAPI.class.php");
class Storage_Box extends Storage
{
	function __construct()
	{
        /*
        // User details
        $box->get_user();
        
        // Get folder details
        $box->get_folder_details('FOLDER ID');
     
        // Get folder items list
        $box->get_folder_items('FOLDER ID');
        
        // All folders in particular folder
        $box->get_folders('FOLDER ID');
        
        // All Files in a particular folder
        $box->get_files('FOLDER ID');
        
        // All Web links in a particular folder
        $box->get_links('FOLDER ID');
        
        // Get folder collaborators list
        $box->get_folder_collaborators('FOLDER ID');
        
        // Create folder
        $box->create_folder('FOLDER NAME', 'PARENT FOLDER ID');
        
        // Update folder details
        $details['name'] = 'NEW FOLDER NAME';
        $box->update_folder('FOLDER ID', $details);
        
        // Share folder
        $params['shared_link']['access'] = 'ACCESS TYPE'; //open|company|collaborators
        print_r($box->share_folder('FOLDER ID', $params));
        
        // Delete folder
        $opts['recursive'] = 'true';
        $box->delete_folder('FOLDER ID', $opts);
        
        // Get file details
        $box->get_file_details('FILE ID');
        
        // Upload file
        $box->put_file('RELATIVE FILE URL', '0');
        
        // Update file details
        $details['name'] = 'NEW FILE NAME';
        $details['description'] = 'NEW DESCRIPTION FOR THE FILE';
        $box->update_file('FILE ID', $details);
        
        // Share file
        $params['shared_link']['access'] = 'ACCESS TYPE'; //open|company|collaborators
        print_r($box->share_file('File ID', $params));
        
        // Delete file
        $box->delete_file('FILE ID');
        
        if (isset($box->error)){
            echo $box->error . "\n";
        }    
        */
    
	}
	public function get_object_filesize($folder_name,$keyname)
	{
        $m=$this->store->getMetadata($this->key_url($folder_name,$keyname));
        return $m['bytes'];
	}
	public function connect()
	{
		$failed=false;
		try
		{
            $box = new Box_API($this->auth1, $this->auth2, $this->auth3);
            // BOX TOKENS EXPIRE AUTOMATICALLY
            //   ACCESS TOKENS = 1 hr
            //   REFRESH TOKENS = 60 days
            $loaded_token = $box->load_token($this->auth5);
            if(!$loaded_token)
            {
                $failed=true;
            }
            else
            {
                if ($loaded_token!==true)
                {
                    // THE TOKEN WAS AUTOMATICALLY UPDATED, NOW WE NEED TO STORE IT SOMEWHERE
                }
            }
            
            if (!$failed)
            {
                $this->store = $box;
                //$m=$this->store->getMetadata( $this->container_url($this->bucket) );
                /*
                if ( !isset($m['path']) )
                {
                    $res = $this->store->createFolder( $this->container_url($this->bucket) );
                    if (!$res)
                    {
                        $failed=true;
                    }
                }*/
            }
            
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
        return "folder";
	}
	public function key_url($folder_name,$keyname)
	{
        return $this->container_url($folder_name)."/".$keyname;
	}
	public function container_url($folder)
	{
        return "/".$folder;
	}
	public function download_object($bucket_name,$keyname,$target_local_filename)
	{
	}
	public function create_object($is_file,$folder,$objname,$str,$mimetype)
	{
        if ($is_file)
        {
            // Upload file
            $box->put_file('RELATIVE FILE URL', '0');
            
            $params['shared_link']['access'] = 'ACCESS TYPE'; //open|company|collaborators
            $share_result = $box->share_file('File ID', $params);
            
        }
        else
        {
        
        }
	
	}
	public function get_object($bucket,$key_url)
	{
        $m=$this->store->getMetadata($key_url);
        list($tempurl,$dt_modified)=$this->store->createTemporaryDirectLink($key_url);
        return file_get_contents($tempurl);
        /*
		$keyname=substr($key_url,strlen($this->container_url($bucket))+1);
        $fd = fopen("./Frog.jpeg", "wb");
        $metadata = $this->store->getFile("/Photos/Frog.jpeg", $fd);
        fclose($fd);
        print_r($metadata);
        */
	}

}


abstract class Storage_Adapter
{
	public $storage;
	public $kind;
	function is_rackspace()
	{
		if ( strpos($this->kind,"rackspace")!==false || strpos($this->kind,"rscf")!==false || strpos($this->kind,"cloudfiles")!==false || strpos($this->kind,"rcf")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_aws()
	{
		if ( strpos($this->kind,"aws")!==false || strpos($this->kind,"s3")!==false || strpos($this->kind,"amazon")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_localdisk()
	{
		if ( strpos($this->kind,"local")!==FALSE || strpos($this->kind,"hard")!==FALSE || strpos($this->kind,"disk")!==FALSE || strpos($this->kind,"drive")!==FALSE  || strpos($this->kind,"folder")!==FALSE )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_dropbox()
	{
		if ( strpos($this->kind,"dropbox")!==FALSE || strpos($this->kind,"dropbox")!==FALSE )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_box()
	{
		if ( strpos($this->kind,"box")===0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
class Post_Storage_Adapter extends Storage_Adapter
{
	function __construct($settings)
	{
		if ( isset($_POST['fstype']) )
		{
			$this->kind=strtolower($_POST['fstype']);
		}
		else
		{
			$this->kind="unknown";
			return;
		}
		if ($this->is_rackspace() )
		{
			$this->kind="rackspacecloudfiles";
			$this->storage = new Storage_Rackspace();
			$this->storage->auth1=$_POST['RS-USER-NAME'];
			$this->storage->auth2=$_POST['RS-API-KEY'];
			$this->storage->bucket=$_POST['RS-CONTAINER-NAME'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else if ($this->is_aws() )
		{
			$this->kind="s3";
			$this->storage = new Storage_AWS();
			$this->storage->auth1=$_POST['S3-ACCESS-KEY'];
			$this->storage->auth2=$_POST['S3-SECRET-KEY'];
			$this->storage->bucket=$_POST['S3-BUCKET-NAME'];
			$this->storage->kind=$this->kind;
			$this->storage->region=$_POST['S3-REGION-NAME'];
			$this->storage->connect();
		}
		else if ($this->is_dropbox() )
		{
			$this->kind="dropbox";
			$this->storage = new Storage_Dropbox();
			$this->storage->auth1=$_POST['DROPBOX-CORE-APP-KEY'];
			$this->storage->auth2=$_POST['DROPBOX-CORE-APP-SECRET'];
			$this->storage->auth3=$_POST['DROPBOX-CORE-AUTH-CODE'];
			$this->storage->auth4=$_POST['DROPBOX-CORE-ACCESS-TOKEN'];
			$this->storage->bucket=$_POST['DROPBOX-CORE-BUCKET'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else if ($this->is_localdisk() )
		{
			$this->kind="localdisk";
			$this->storage = new Storage_Localdisk();
			$this->storage->bucket=$_POST['LOCALDISK-WEBFOLDER-NAME'];
			$this->storage->basefolder=$_POST['LOCALDISK-FOLDER-NAME'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else if ($this->is_box() )
		{
			$this->kind="box";
			$this->storage = new Storage_Box();
			$this->storage->auth1=$_POST['BOX-OAUTH2-ID'];
			$this->storage->auth2=$_POST['BOX-OAUTH2-SECRET'];
			$this->storage->auth3=$_POST['BOX-REDIRECT-URI'];
			$this->storage->auth4=$_POST['BOX-AUTH-CODE'];
			$this->storage->auth5=$_POST['BOX-TOKEN'];
            
			$this->storage->bucket=$_POST['BOX-FOLDER-NAME'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else
		{
			echo "UNRECOGNIZED STORAGE TYPE ".$this->kind;
			$this->storage=false;
			exit;
		}
	}
}
class Settings_Storage_Adapter extends Storage_Adapter
{
	function __construct($settings)
	{
		// settings array
		$this->kind=$settings['storage']['@attributes']['value'];
		if ($this->is_rackspace() )
		{
			$this->storage = new Storage_Rackspace();
			$this->storage->auth1=$settings[$this->kind]['user-name']['@attributes']['value'];
			$this->storage->auth2=$settings[$this->kind]['api-key']['@attributes']['value'];
			$this->storage->bucket=$settings[$this->kind]['container']['@attributes']['value'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else if ($this->is_aws() )
		{
			$this->storage = new Storage_AWS();
			$this->storage->auth1=$settings[$this->kind]['access-key']['@attributes']['value'];
			$this->storage->auth2=$settings[$this->kind]['secret-key']['@attributes']['value'];
			$this->storage->bucket=$settings[$this->kind]['bucket']['@attributes']['value'];
			$this->storage->kind=$this->kind;
			$this->storage->region=$settings[$this->kind]['region']['@attributes']['value'];
			$this->storage->connect();
		}
		else if ($this->is_dropbox() )
		{
			$this->storage = new Storage_Dropbox();
			$this->storage->auth1=$settings[$this->kind]['app-key']['@attributes']['value'];
			$this->storage->auth2=$settings[$this->kind]['secret-key']['@attributes']['value'];
			$this->storage->auth3=$settings[$this->kind]['auth-code']['@attributes']['value'];
			$this->storage->auth4=$settings[$this->kind]['access-key']['@attributes']['value'];
			$this->storage->bucket=$settings[$this->kind]['folder']['@attributes']['value'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else if ($this->is_localdisk() )
		{
			$this->storage = new Storage_Localdisk();
			$this->storage->bucket=$settings[$this->kind]['webfolder']['@attributes']['value'];
			$this->storage->basefolder=$settings[$this->kind]['folder']['@attributes']['value'];
			$this->storage->kind=$this->kind;
			$this->storage->connect();
		}
		else
		{
			echo "UNRECOGNIZED STORAGE TYPE ".$this->kind;
			$this->storage=false;
			exit;
		}
	
	}

} // end class


class MatchEntry_Storage_Adapter extends Storage_Adapter
{
	function __construct($settings)
	{
		if ( isset($settings['fs_type']) )
		{
			$this->kind=$settings["fs_type"]->value;
		}
		// settings array
		if ($this->is_rackspace() )
		{
			$this->storage = new Storage_Rackspace();
			$this->storage->auth1=$settings["RS-USER-NAME"]->value;
			$this->storage->auth2=$settings["RS-API-KEY"]->value;
			$this->storage->bucket=$settings["RS-CONTAINER-NAME"]->value;
			$this->storage->kind=$settings["fs_type"]->value;
			$this->storage->connect();
		}
		else if ($this->is_aws() )
		{
			$this->storage = new Storage_AWS();
			$this->storage->auth1=$settings["S3-ACCESS-KEY"]->value;
			$this->storage->auth2=$settings["S3-SECRET-KEY"]->value;
			$this->storage->bucket=$settings["S3-BUCKET-NAME"]->value;
			$this->storage->region=$settings["S3-REGION-NAME"]->value;
			$this->storage->kind=$settings["fs_type"]->value;
			$this->storage->connect();
		}
		else if ($this->is_dropbox() )
		{
			$this->storage = new Storage_Dropbox();
			$this->storage->auth1=$settings['DROPBOX-CORE-APP-KEY']->value;
			$this->storage->auth2=$settings['DROPBOX-CORE-APP-SECRET']->value;
			$this->storage->auth3=$settings['DROPBOX-CORE-AUTH-CODE']->value;
			$this->storage->auth4=$settings['DROPBOX-CORE-ACCESS-TOKEN']->value;
			$this->storage->bucket=$settings['DROPBOX-FOLDER-NAME']->value;
			$this->storage->kind=$settings["fs_type"]->value;
			$this->storage->connect();
		}
		else if ($this->is_localdisk() )
		{
			$this->storage = new Storage_Localdisk();
			$this->storage->bucket=$settings["LOCALDISK-WEBFOLDER-NAME"]->value;
			$this->storage->basefolder=$settings["LOCALDISK-FOLDER-NAME"]->value;
			$this->storage->kind=$settings["fs_type"]->value;
			$this->storage->connect();
		}
		else
		{
			echo "UNRECOGNIZED STORAGE TYPE ".$this->kind;
			$this->storage=false;
			exit;
		}
	
	}

} // end class

?>
