<?php
set_time_limit(0);
error_reporting (E_ALL );
//print_r($_POST);
$godaddy_username="your_username";
$godaddy_password="your_password";

$postalmethods_username="your_username";
$postalmethods_password="your_password";

$docmail_username="your_username";
$docmail_password="your_password";

$twilio_sid="your_sid";
$twilio_authtoken="your_authtoken";
$twilio_from_number="11234567890";
$twilio_to_number="11234567890";

$aws_accesskey_ses="your_access_key";
$aws_secretkey_ses="your_secret_key";

$aws_accesskey_mturk="your_access_key";
$aws_secretkey_mturk="your_secret_key";


$imap_email_user="my_email@gmail.com";
$imap_email_pass="my_password";
$imap_email_server="imap.gmail.com";
$imap_email_port="993";
$smtp_email_server="smtp.gmail.com";
$smtp_email_port="587";

$semantria_key="your_semantria_key";
$semantria_secret="your_semantria_secret";


$paypal_api_username='my_api_username';
$paypal_api_password='my_api_password';
$paypal_api_signature='my_api_signature';


$imacros_license_key='XXXXX-XXXXX-XXXXX-XXXXX-XXXXX-XXXXX';

if ( isset($_POST['imacros_license_key']) )
{
	if ( strlen($_POST['imacros_license_key'])>0 )
	{
		$imacros_license_key=$_POST['imacros_license_key'];
	}
}
if ( isset($_POST['godaddy_username']) )
{
	if ( strlen($_POST['godaddy_username'])>0 )
	{
		$godaddy_username=$_POST['godaddy_username'];
	}
}
if ( isset($_POST['godaddy_password']) )
{
	if (strlen($_POST['godaddy_password'])>0)
	{
		$godaddy_password=$_POST['godaddy_password'];
	}
}
if ( isset($_POST['postalmethods_username']) )
{
	if ( strlen($_POST['postalmethods_username'])>0)
	{
		$postalmethods_username=$_POST['postalmethods_username'];
	}
}
if ( isset($_POST['postalmethods_password']) )
{
	if ( strlen($_POST['postalmethods_password'])>0)
	{
		$postalmethods_password=$_POST['postalmethods_password'];
	}
}
if ( isset($_POST['twilio_sid']) )
{
	if ( strlen($_POST['twilio_sid'])>0 )
	{
		$twilio_sid=$_POST['twilio_sid'];
	}
}
if ( isset($_POST['twilio_authtoken']) )
{
	if ( strlen($_POST['twilio_authtoken'])>0)
	{
		$twilio_authtoken=$_POST['twilio_authtoken'];
	}
}
if ( isset($_POST['twilio_to_number']) )
{
	if ( strlen($_POST['twilio_to_number']) > 0 )
	{
		$twilio_to_number=$_POST['twilio_to_number'];
		$twilio_to_number=str_replace(" ","",$twilio_to_number);
		$twilio_to_number=str_replace("-","",$twilio_to_number);
		$twilio_to_number=str_replace("(","",$twilio_to_number);
		$twilio_to_number=str_replace(")","",$twilio_to_number);
		$twilio_to_number=str_replace("+","",$twilio_to_number);
		$twilio_to_number=str_replace(".","",$twilio_to_number);
	}
}
if ( isset($_POST['twilio_from_number']) )
{
	if ( strlen($_POST['twilio_from_number'])>0 )
	{
		$twilio_from_number=$_POST['twilio_from_number'];
		$twilio_from_number=str_replace(" ","",$twilio_from_number);
		$twilio_from_number=str_replace("-","",$twilio_from_number);
		$twilio_from_number=str_replace("(","",$twilio_from_number);
		$twilio_from_number=str_replace(")","",$twilio_from_number);
		$twilio_from_number=str_replace("+","",$twilio_from_number);
		$twilio_from_number=str_replace(".","",$twilio_from_number);
	}
}
if ( isset($_POST['aws_accesskey_ses']) )
{
	if ( strlen($_POST['aws_accesskey_ses']) >0 )
	{
		$aws_accesskey_ses=$_POST['aws_accesskey_ses'];
	}
}
if ( isset($_POST['aws_secretkey_ses']) )
{
	if ( strlen($_POST['aws_secretkey_ses']) >0 )
	{
		$aws_secretkey_ses=$_POST['aws_secretkey_ses'];
	}
}
if ( isset($_POST['aws_accesskey_mturk']) )
{
	if ( strlen($_POST['aws_accesskey_mturk']) > 0 )
	{
		$aws_accesskey_mturk=$_POST['aws_accesskey_mturk'];
	}
}
if ( isset($_POST['aws_secretkey_mturk']) )
{
	if ( strlen($_POST['aws_secretkey_mturk'])>0 )
	{
		$aws_secretkey_mturk=$_POST['aws_secretkey_mturk'];
	}
}

if ( isset($_POST['imap_email_user']) )
{
	if ( strlen($_POST['imap_email_user']) > 0 )
	{
		$imap_email_user=$_POST['imap_email_user'];
	}
}
if ( isset($_POST['imap_email_pass']) )
{
	if ( strlen($_POST['imap_email_pass'])>0 )
	{
		$imap_email_pass=$_POST['imap_email_pass'];
	}
}
if ( isset($_POST['imap_email_server']) )
{
	if ( strlen($_POST['imap_email_server']) > 0 )
	{
		$imap_email_server=$_POST['imap_email_server'];
	}
}
if ( isset($_POST['imap_email_port']) )
{
	if ( strlen($_POST['imap_email_port'])>0 )
	{
		$imap_email_port=intval($_POST['imap_email_port']);
	}
}
if ( isset($_POST['smtp_email_server']) )
{
	if ( strlen($_POST['smtp_email_server']) > 0 )
	{
		$smtp_email_server=$_POST['smtp_email_server'];
	}
}
if ( isset($_POST['smtp_email_port']) )
{
	if ( strlen($_POST['smtp_email_port'])>0 )
	{
		$smtp_email_port=intval($_POST['smtp_email_port']);
	}
}

if ( isset($_POST['semantria_key']) )
{
	if ( strlen($_POST['semantria_key'])>0 )
	{
		$semantria_key=$_POST["semantria_key"];
	}
}

if ( isset($_POST['semantria_secret']) )
{
	if ( strlen($_POST['semantria_secret'])>0 )
	{
		$semantria_secret=$_POST["semantria_secret"];
	}
}


if ( isset($_POST['paypal_api_username']) )
{
	if ( strlen($_POST['paypal_api_username'])>0 )
	{
		$paypal_api_username=$_POST["paypal_api_username"];
	}
}

if ( isset($_POST['paypal_api_password']) )
{
	if ( strlen($_POST['paypal_api_password'])>0 )
	{
		$paypal_api_password=$_POST["paypal_api_password"];
	}
}

if ( isset($_POST['paypal_api_signature']) )
{
	if ( strlen($_POST['paypal_api_signature'])>0 )
	{
		$paypal_api_signature=$_POST["paypal_api_signature"];
	}
}






function add_library_hf($options) // $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
{
	global $u;
	global $library_messages;
	global $APP;

	if ( !isset($options['id_user']) )
	{
		echo "library add id_user not found!";
		exit;

	}
	if ( !isset($options['hf_name']) )
	{
		echo "library add hf_name not found!";
		exit;

	}
	if ( !isset($options['hf_expression']) )
	{
		echo "library add hf_expression not found!";
		exit;

	}
	if ( !isset($options['inheritable']) )
	{
		echo "library add inheritable not found!";
		exit;

	}
	if ( !isset($options['sys_kinds']) )
	{
		echo "library add sys_kinds not found!";
		exit;

	}
	if ( !isset($options['resources']) )
	{
		echo "library add resources not found!";
		exit;

	}
	if ( !isset($options['hf_parameters']) )
	{
		echo "library add hf_parameters not found!";
		exit;

	}
	$id_user=$options['id_user'];
	$hf_name=$options['hf_name'];
	$hf_expression=$options['hf_expression'];
	$inheritable=$options['inheritable'];
	$sys_kinds=$options['sys_kinds'];
	$resources=$options['resources'];
	$hf_parameters=$options['hf_parameters'];
	$inherit_from="";
	if ( isset($options['inherit_from']) )
	{
		$inherit_from=$options['inherit_from'];
	}

	$id_mime_type="undefined";
	if ( isset($options['mime']) )
	{
		$id_mime_type=$options['mime'];
	}

	$retval="";
	
	$props=array();
	$props['id_user']=$id_user;
	$props['id']=sha1(microtime().$hf_name.rand(1,20));
	$retval=$props['id'];
	$props['name']=$hf_name;
	$props['str_expression']=$hf_expression;
	// CREATE HIS FUNCTION
	$props['id_condition']="perfectly";
	$props['str_cache_out_xml']="undefined";
	$props['str_cache_out_cxml']="undefined";

	$props['str_cache_approved']='undefined';
	$props['str_cache_latest']='undefined';

	$props['id_mime_type']=$id_mime_type;
	$props['int_ws']="0";
	$props['int_wait']="0";
	$props['int_maxruntime']="0";
	$props['int_delay']="10";

	$new_hf=new hf_id_user();
	$new_hf->create($props);

	// CREATE SYSTEM KINDS
	foreach ($sys_kinds as $hf_sys_kind)
	{
		echo " ";
		$system_kind_current_id="";
		// GET THIS SYS KIND FROM USER_SYSTEM_KINDS
		foreach ($u->obj_system_kinds as $user_system_kind)
		{
			if ($user_system_kind->name==$hf_sys_kind)
			{
				$system_kind_current_id=$user_system_kind->id;
			}
		} // end foreach (system kind name)

		if ( $hf_sys_kind=="any")
		{
			$system_kind_current_id="any";
		}

		if (strlen($system_kind_current_id)>0)
		{
			$props=array();
			$props['id_hf']=$new_hf->id;
			$props['id']=sha1(microtime().$system_kind_current_id.rand(1,20));
			$props['id_sk']=$system_kind_current_id;
			$new_hf_sk=new hf_system_kind();
			$new_hf_sk->create($props);
		}
		else
		{
			$library_message.="Unable to find sys kind: $hf_sys_kind for function $hf_name.\n";
		}
	} // end foreach (system kind)
	foreach ($resources as $hf_resource)
	{
		echo " ";
		// CREATE RESOURCE
		$props=array();
		$props['id_hf']=$new_hf->id;
		$props['id']=sha1(microtime().$hf_resource['content'].rand(1,20));
		$props['str_location']=$hf_resource['content'];
		$props['str_filename']=$hf_resource['filename'];
		$new_hf_resource=new hf_resource();
		$new_hf_resource->create($props);
		echo " ";
		if ( isset($hf_resource['system_kinds']) )
		{
			foreach ($hf_resource['system_kinds'] as $hfr_system_kind)
			{
				echo " ";
				$system_kind_current_id="";
				// GET THIS SYS KIND FROM USER_SYSTEM_KINDS
				foreach ($u->obj_system_kinds as $user_system_kind)
				{
					if ($user_system_kind->name==$hfr_system_kind)
					{
						$system_kind_current_id=$user_system_kind->id;
					}
				} // end foreach (system kind name)

				if ( $hfr_system_kind=="any")
				{
					$system_kind_current_id="any";
				}

				if (strlen($system_kind_current_id)>0)
				{
					$new_hfrsk=new hfr_system_kind();
					$props=array();
					$props['id_resource']=$new_hf_resource->id;
					$props['id']=sha1(microtime().rand(1,20).$system_kind_current_id);
					$props['id_sk']=$system_kind_current_id;
					$new_hfrsk->create($props);
				}
				else
				{
					echo "<pre>";
					print_r($u);
					echo "LIBRARY ERROR: UNABLE TO FIND SYSTEM KIND ($hfr_system_kind)";
					exit;
				}

			} // end foreach (system kind)
		} // end if (system kinds is set)
	} // end if (resource)


	if ( strlen($inherit_from)>0 )
	{
		$props=array();
		$props['id_hf']=$new_hf->id;
		$props['id']=sha1(microtime().rand(1,20).rand(2,30));
		$props['id_inherit']=$inherit_from;
		$new_hf_inherit=new hf_inherit();
		$new_hf_inherit->create($props);
	}
	// this part makes the function inherit from other functions
	if ($inheritable)
	{


		$props=array();
		$props['id_user']=$id_user;
		$props['id_hf']=$new_hf->id;

		$new_user_inherit = new user_inherit();
		$new_user_inherit->create($props);
	}
	foreach ($hf_parameters as $hf_parameter)
	{
		echo " ";
		$props=array();
		$props['id_hf']=$new_hf->id;
		$props['id']=sha1(microtime().rand(1,20).$hf_parameter['keyword'].$hf_parameter['parameter_name'] );
		$props['keyword']=$hf_parameter['keyword'];
		$props['parameter_name']=$hf_parameter['parameter_name'];
		$props['str_default_value']=$hf_parameter['default_value'];
		$props['int_preserve_encode']="0";

		if ( isset($hf_parameter['int_preserve_encode']) )
		{
			if ( strtolower($hf_parameter['int_preserve_encode'])=="true" )
			{
				$props['int_preserve_encode']="1";
			}
		}

		$new_hf_parameter = new hf_parameter();
		$new_hf_parameter->create($props);
		
		if ( isset($hf_parameter['constraints']) )
		{
			foreach ($hf_parameter['constraints'] as $hfp_constraint)
			{
				echo " ";
				$props=array();
				$props['id_hf_parameter']=$new_hf_parameter->id;
				$props['id']=sha1(microtime().rand(1,20).$hfp_constraint['constraint_type'].$hfp_constraint['constraint_text'] );
				$props['id_constraint_type']=$hfp_constraint['constraint_type'];
				$props['str_constraint_text']=$hfp_constraint['constraint_text'];

				$new_hfp_vcs = new hfp_vcs();
				$new_hfp_vcs->create($props);
				//usleep(10);
				
			} // end foreach
		
		}
		//usleep(10);
	} // end foreach
	usleep(10);

	return $retval;
} // end function


$new_user = new user_id_user();

if ( !isset($_POST['id_user']) )
{
	echo "ERROR: NO POST DATA";
	echo "<pre>";
	print_r($_POST);
	exit;
}
while (trim($new_user->id_user)=="undefined")
{
	$new_user->get_from_hashrange($_POST['id_user']);
	//echo "ERROR: NO USER";
	//echo "<pre>";
	//print_r($new_user);
	sleep(3);
}
$u=$new_user;
global $u;
$u->build(array("obj_hfs","obj_servers"));

// use $first_step_of_library_installation as the start

$library_step = $first_step_of_library_installation;

// this one is 14
// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
if ($_GET['page']==$library_step+0)
{

// default wget
$_POST['default_wget'] = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default wget",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\wget\wget.exe" "[SERVERBINS]\wget\wget.exe" -d -O output.txt -U "[wget_user_agent]" --timeout=[wget_timeout] --tries=[wget_tries] --no-check-certificate "[wget_url]" 1>>error.txt 2>&1
if not exist "[SERVERBINS]\wget\wget.exe" echo "unable to find wget, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
				'filename'=>'run.bat',
				'content'=>'wget --help && echo 0 >err.txt || echo 1 >err.txt
wget_err=`cat err.txt`
if [ $wget_err -ne  0 ] ; then
    rm err.txt
    echo "wget is not available on this system" >error.txt
    exit 1
fi
rm err.txt

wget -d -O output.txt -U \'[wget_user_agent]\' --timeout=[wget_timeout] --tries=[wget_tries] --no-check-certificate \'[wget_url]\' 1>>error.txt 2>&1',
				'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		)

	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[wget_user_agent]',
			'parameter_name'=>'wget_user_agent',
			'default_value'=>'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			)
		),
		array(
			'keyword'=>'[wget_timeout]',
			'parameter_name'=>'wget_timeout',
			'default_value'=>'120',
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[wget_tries]',
			'parameter_name'=>'wget_tries',
			'default_value'=>'2',
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[wget_url]',
			'parameter_name'=>'wget_url',
			'default_value'=>'http://google.com',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			)
		)
	)
));
return;
}

// 15
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// univeral java
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default java",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x32\bin\javac.exe" hello.java
if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" helloapp >output.txt
if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" del /F /Q helloapp.class
if not exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" echo "unable to find java 1.8.0 u20 x32, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.java',
			'content'=>'class helloapp{
    public static void main(String[] args) {
        System.out.println("Hello World!"); // Display the string.
    }
}',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'javac --help && echo 0 >err.txt || echo 1 >err.txt
javac_err=`cat err.txt`
if [ $javac_err -ne  0 ] ; then
    rm err.txt
    echo "javac is not available on this system" >error.txt
    exit 1
fi
rm err.txt

java --help && echo 0 >err.txt || echo 1 >err.txt
java_err=`cat err.txt`
if [ $java_err -ne  0 ] ; then
    rm err.txt
    echo "java is not available on this system" >error.txt
    exit 1
fi
rm err.txt

javac hello.java && java helloapp >output.txt
rm -f helloapp.class',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
	),
	'hf_parameters'=>array()
));
return;
}

// 16
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win java1.8_20 x32
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win java8u20 x32",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x32\bin\javac.exe" hello.java
if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" helloapp >output.txt
if exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" del helloapp.class
if not exist "[SERVERBINS]\jdk1.8.0_20_x32\bin\java.exe" echo "unable to find java 1.8.0 u20 x32, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.java',
			'content'=>'class helloapp{
    public static void main(String[] args) {
        System.out.println("Hello World!"); // Display the string.
    }
}',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 17
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win java1.8_20 x64
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win java8u20 x64",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\jdk1.8.0_20_x64\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x64\bin\javac.exe" hello.java
if exist "[SERVERBINS]\jdk1.8.0_20_x64\bin\java.exe" "[SERVERBINS]\jdk1.8.0_20_x64\bin\java.exe" helloapp >output.txt
if exist "[SERVERBINS]\jdk1.8.0_20_x64\bin\java.exe" del helloapp.class
if not exist "[SERVERBINS]\jdk1.8.0_20_x64\bin\java.exe" echo "unable to find java 1.8.0 u20 x64, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.java',
			'content'=>'class helloapp{
    public static void main(String[] args) {
        System.out.println("Hello World!"); // Display the string.
    }
}',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 18
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default ruby193
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default ruby",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\ruby193\bin\ruby.exe" "[SERVERBINS]\ruby193\bin\ruby.exe" hello.rb >output.txt
if not exist "[SERVERBINS]\ruby193\bin\ruby.exe" echo "unable to find ruby 1.9.3, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'run.bat',
			'content'=>'ruby --help && echo 0 >err.txt || echo 1 >err.txt
ruby_err=`cat err.txt`
if [ $ruby_err -ne  0 ] ; then
    rm err.txt
    echo "ruby is not available on this system" >error.txt
    exit 1
fi
rm err.txt
ruby hello.rb >output.txt 2>>error.txt',
			'system_kinds'=>array("Linux","Mac","FreeBSD","Cygwin",'Solaris')
		),
		array(
			'filename'=>'hello.rb',
			'content'=>'class HelloWorld
   def initialize(name)
      @name = name.capitalize
   end
   def sayHi
      puts "Hello #{@name}!"
   end
end

hello = HelloWorld.new("World")
hello.sayHi',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 19
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win imacros dom scripting
$_POST['imacros_hfid'] = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win imacros dom scripting",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'REM INSTALLATION REQUIRES ADMINISTRATOR PRIVILEGES

reg Query "HKLM\Hardware\Description\System\CentralProcessor\0" | find /i "x32" > NUL && set OS=32 || set OS=64

if not exist "[SERVERBINS]\imacros\iMacros.exe" "[SERVERBINS]\imacros\iMacrosSetup_10.3.27.5830_x[PERCENT]OS[PERCENT].exe" /SP- /NORESTART /TASKS="*parent" /NOICONS /CLOSEAPPLICATIONS /NOCANCEL /VERYSILENT /SUPPRESSMSGBOXES /DIR="[SERVERBINS]\imacros\"


if not exist "[SERVERBINS]\imacros\iMacros.exe" timeout /t 60 /NOBREAK
if not exist "[SERVERBINS]\imacros\iMacros.exe" taskkill /F /im imacros*
if not exist "[SERVERBINS]\imacros\iMacros.exe" xcopy /Y "c:\Program Files (x86)\Ipswitch\iMacros"\* "[SERVERBINS]\imacros\"
if not exist "[SERVERBINS]\imacros\iMacros.exe" echo "unable to find iMacros, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\imacros\iMacros.exe" exit 0

REM PROGRAM FILES FOR 32
If DEFINED ProgramFiles(x86) Set _programs=%ProgramFiles(x86)%
If Not DEFINED ProgramFiles(x86) Set _programs=%ProgramFiles%

if not exist "[SERVERBINS]\imacros\iefirstrun.txt" start /I "%ProgramFiles%\Internet Explorer\iexplore.exe" >>setup.txt 2>>error.txt
if not exist "[SERVERBINS]\imacros\iefirstrun.txt" timeout /t 5 /NOBREAK >>setup.txt 2>>error.txt
if not exist "[SERVERBINS]\imacros\iefirstrun.txt" taskkill /F /IM iexplore* >>setup.txt 2>>error.txt
if not exist "[SERVERBINS]\imacros\iefirstrun.txt" echo iexplore has been run >"[SERVERBINS]\imacros\iefirstrun.txt"



if not exist "[JOB_FOLDER]\license.txt" echo license.txt file not found; upload it to the Input Resources section of this HIS Function >license.txt
if not exist "[JOB_FOLDER]\license.txt" exit 0

start /wait iees_disable.bat

reg add HKEY_CURRENT_USER\Software\Ipswitch\iMacros /v LicenseKey /t REG_SZ /f /d [JOB_FOLDER]\license.txt

reg add "HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\Main" /v DisableFirstRunCustomize /t REG_DWORD /f /d 1


"[SERVERBINS]\imacros\iMacros.exe" -silent -macro "[JOB_FOLDER]\hello.iim"

			
if [PERCENT]errorlevel[PERCENT] == 1 goto ok
if NOT [PERCENT]errorlevel[PERCENT] == 1 goto error

:ok
echo Macro completed successfully!
goto end

:error
echo Error encountered during replay.
echo Errorcode=[PERCENT]errorlevel[PERCENT]
echo Errorcode=[PERCENT]errorlevel[PERCENT]
echo Errorcode=[PERCENT]errorlevel[PERCENT]
echo Errorcode=[PERCENT]errorlevel[PERCENT]
echo Errorcode=[PERCENT]errorlevel[PERCENT]
echo Please see http://wiki.imacros.net/Error-Codes
echo for a detailed description of error codes.

:end',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'iees_disable.bat',
			'content'=>'::START

ECHO OFF
REM  IEHarden Removal Project
REM  HasVersionInfo: Yes
REM  Author: Axelr
REM  Productname: Remove IE Enhanced Security
REM  Comments: Helps remove the IE Enhanced Security Component of Windows 2003 and 2008(including R2)
REM  IEHarden Removal Project End
ECHO ON
::Related Article
::933991 Standard users cannot turn off the Internet Explorer Enhanced Security feature on a Windows Server 2003-based terminal server
::http://support.microsoft.com/default.aspx?scid=kb;EN-US;933991

:: Rem out if you like to Backup the registry keys
::REG EXPORT "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A7-37EF-4b3f-8CFC-4F3A74704073}" "%TEMP%.HKEY_LOCAL_MACHINE.SOFTWARE.Microsoft.Active Setup.Installed Components.A509B1A7-37EF-4b3f-8CFC-4F3A74704073.reg" 
::REG EXPORT "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A7-37EF-4b3f-8CFC-4F3A74704073}" "%TEMP%.HKEY_LOCAL_MACHINE.SOFTWARE.Microsoft.Active Setup.Installed Components.A509B1A8-37EF-4b3f-8CFC-4F3A74704073.reg"

REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A7-37EF-4b3f-8CFC-4F3A74704073}" /v "IsInstalled" /t REG_DWORD /d 0 /f
REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A8-37EF-4b3f-8CFC-4F3A74704073}" /v "IsInstalled" /t REG_DWORD /d 0 /f

::Removing line below as it is not needed for Windows 2003 scenarios. You may need to enable it for Windows 2008 scenarios
::Rundll32 iesetup.dll,IEHardenLMSettings
Rundll32 iesetup.dll,IEHardenUser
Rundll32 iesetup.dll,IEHardenAdmin
Rundll32 iesetup.dll,IEHardenMachineNow

::This apply to Windows 2003 Servers
REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Setup\OC Manager\Subcomponents" /v "iehardenadmin" /f /va
REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Setup\OC Manager\Subcomponents" /v "iehardenuser" /f /va

REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Setup\OC Manager\Subcomponents" /v "iehardenadmin" /t REG_DWORD /d 0 /f
REG ADD "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows\CurrentVersion\Setup\OC Manager\Subcomponents" /v "iehardenuser" /t REG_DWORD /d 0 /f

::REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A7-37EF-4b3f-8CFC-4F3A74704073}" /f /va
::REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Active Setup\Installed Components\{A509B1A8-37EF-4b3f-8CFC-4F3A74704073}" /f /va

:: Optional to remove warning on first IE Run and set home page to blank. remove the :: from lines below
:: 32-bit HKCU Keys
REG DELETE "HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\Main" /v "First Home Page" /f
REG ADD "HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\Main" /v "Default_Page_URL" /t REG_SZ /d "about:blank" /f
REG ADD "HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\Main" /v "Start Page" /t REG_SZ /d "about:blank" /f
:: This will disable a warning the user may get regarding Protected Mode being disable for intranet, which is the default.
:: See article http://social.technet.microsoft.com/Forums/lv-LV/winserverTS/thread/34719084-5bdb-4590-9ebf-e190e8784ec7 
:: Intranet Protected mode is disable. Warning should not appear and this key will disable the warning
REG ADD "HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\Main" /v "NoProtectedModeBanner" /t REG_DWORD /d 1 /f

:: Removing Terminal Server Shadowing x86 32bit 
REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion\Terminal Server\Install\Software\Microsoft\Windows\CurrentVersion\Internet Settings\ZoneMap" /v "IEHarden" /f
::  Removing Terminal Server Shadowing Wow6432Node
REG DELETE "HKEY_LOCAL_MACHINE\SOFTWARE\Wow6432Node\Microsoft\Windows NT\CurrentVersion\Terminal Server\Install\Software\Microsoft\Windows\CurrentVersion\Internet Settings\ZoneMap" /v "IEHarden" /f

exit 0

::END',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.iim',
			'content'=>'VERSION BUILD=8032216
TAB T=1
TAB CLOSEALLOTHERS
SET !EXTRACT_TEST_POPUP NO
SET !USERAGENT "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)"
SET !ENCRYPTION NO
URL GOTO=[imacros_url]
WAIT SECONDS=2
TAG POS=1 TYPE=HTML ATTR=* EXTRACT=HTM
SAVEAS TYPE=EXTRACT FOLDER=[JOB_FOLDER] FILE=*
',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[imacros_url]',
			'parameter_name'=>'imacros_url',
			'default_value'=>'http://google.com',
			'constraints'=>
				array(
					array(
						'constraint_type'=>'disallowed-str',
						'constraint_text'=>'"'
					),
					array(
						'constraint_type'=>'disallowed-str',
						'constraint_text'=>' '
					)
				)
		)
	)
));

return;
}

// 20
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python23
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python23",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python23\python.exe" "[SERVERBINS]\python23\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python23\python.exe" echo "unable to find python23, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 21
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python25
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python25",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python25\python.exe" "[SERVERBINS]\python25\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python25\python.exe" echo "unable to find python25, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 22
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python26
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python26",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python26\python.exe" "[SERVERBINS]\python26\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python26\python.exe" echo "unable to find python26, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 23
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python27
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python27",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python27\python.exe" "[SERVERBINS]\python27\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python27\python.exe" echo "unable to find python27, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 24
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python30
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python30",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python30\python.exe" "[SERVERBINS]\python30\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python30\python.exe" echo "unable to find python30, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print("hello world")
print(sys.version)',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 25
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python31
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python31",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python31\python.exe" "[SERVERBINS]\python31\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python31\python.exe" echo "unable to find python31, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print("hello world")
print(sys.version)',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 26
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win python32
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win python32",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python32\python.exe" "[SERVERBINS]\python32\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python32\python.exe" echo "unable to find python32, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print("hello world")
print(sys.version)',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 27
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default python27
$_POST['universal_python'] = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"universal python",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\python27\python.exe" "[SERVERBINS]\python27\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\python27\python.exe" echo "unable to find python27, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'run.bat',
			'content'=>'python --help && echo 0 >err.txt || echo 1 >err.txt
python_err=`cat err.txt`
if [ $python_err -ne  0 ] ; then
    rm err.txt
    echo "python is not available on this system" >error.txt
    exit 1
fi
rm err.txt
python hello.py >output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 28
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default perl514
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default perl",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\perl514\bin\perl.exe" "[SERVERBINS]\perl514\bin\perl.exe" hello.pl >output.txt
if not exist "[SERVERBINS]\perl514\bin\perl.exe" echo "unable to find per1514, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'run.bat',
			'content'=>'perl --help && echo 0 >err.txt || echo 1 >err.txt
perl_err=`cat err.txt`
if [ $perl_err -ne  0 ] ; then
    rm err.txt
    echo "perl is not available on this system" >error.txt
    exit 1
fi
rm err.txt
perl hello.pl >output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.pl',
			'content'=>'print "Hello World\n";',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 29
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win epd732py27 x32 
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win epd732py27 x32",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\epd732_x32\python.exe" "[SERVERBINS]\epd732_x32\python.exe" hello.py >output.txt
if not exist "[SERVERBINS]\epd732_x32\python.exe" echo "unable to find epd732_x32, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import sys
print "hello world"
print sys.version',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 30
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default php54 
$_POST['universal_php']=add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default php",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\php54\php.exe" "[SERVERBINS]\php54\php.exe" hello.php >output.txt
if not exist "[SERVERBINS]\php54\php.exe" echo "unable to find php54, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'run.bat',
			'content'=>'php --help || echo $? >err.txt
php_err=`cat err.txt`
if [ $php_err -ne  0 ] ; then
    rm err.txt
    echo "php is not available on this system" >error.txt
    exit 1
fi
rm err.txt
php hello.php >output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.php',
			'content'=>'<?php
echo "hello world";
phpinfo();
?>',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 31
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// linux vb.net w/vbnc & mono
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"linux vb.net w/vbnc & mono",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Linux'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'vbnc --help && echo 0 >err.txt || echo 1 >err.txt
vbnc_err=`cat err.txt`
if [ $vbnc_err -ne  0 ] ; then
    rm err.txt
    echo "vbnc is not available on this system" >error.txt
    exit 1
fi
rm err.txt

mono --help && echo 0 >err.txt || echo 1 >err.txt
mono_err=`cat err.txt`
if [ $mono_err -ne  0 ] ; then
    rm err.txt
    echo "mono is not available on this system" >error.txt
    exit 1
fi
rm err.txt

vbnc /out:hello.exe hello.vb 2>>error.txt
mono hello.exe 2>>error.txt
rm -f hello.exe',
			'system_kinds'=>array("Linux")
		),
		array(
			'filename'=>'hello.vb',
			'content'=>'Imports System
Public Module hello_world
   Sub Main()
     Console.WriteLine ("Hello World using Visual Basic!")
   End Sub
End Module',
			'system_kinds'=>array("Linux")
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 32
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win php449
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win php449",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'
if exist "[SERVERBINS]\php449\php.exe" "[SERVERBINS]\php449\php.exe" hello.php >output.txt
if not exist "[SERVERBINS]\php449\php.exe" echo "unable to find php449, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'hello.php',
			'content'=>'<?php
echo "hello world";
phpinfo();
?>',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array()
));


return;
}

// 33
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win send fax 
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win godaddy send fax",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'hello.iim',
			'content'=>'VERSION BUILD=8032216
TAB T=1
TAB CLOSEALLOTHERS
SET !EXTRACT_TEST_POPUP NO
SET !ENCRYPTION NO

URL GOTO=https://login.secureserver.net/index.php?clearcookies=1&app=fte
TAG POS=1 TYPE=INPUT:TEXT FORM=ID:login_form ATTR=ID:username CONTENT=[user_secret]
TAG POS=1 TYPE=INPUT:PASSWORD FORM=ID:login_form ATTR=ID:password CONTENT=[password]
TAG POS=1 TYPE=SPAN FORM=ID:login_form ATTR=TXT:Log<SP>In

TAG POS=1 TYPE=INPUT:FILE FORM=ID:file-upload ATTR=ID:newfile CONTENT=[uploaded_file]
TAG POS=1 TYPE=INPUT:SUBMIT FORM=ID:file-upload ATTR=ID:fileSubmit&&VALUE:Upload

WAIT SECONDS=30

TAG POS=1 TYPE=INPUT:TEXT ATTR=ID:phone1 CONTENT=[fax_secret]

TAG POS=1 TYPE=SPAN ATTR=TXT:Send<SP>fax
WAIT SECONDS=5
TAG POS=1 TYPE=HTML ATTR=* EXTRACT=HTM
SAVEAS TYPE=EXTRACT FOLDER=[JOB_FOLDER] FILE=*
TAG POS=1 TYPE=SPAN ATTR=TXT:Done
TAG POS=1 TYPE=A ATTR=ID:logout
URL GOTO=https://login.secureserver.net/index.php?clearcookies=1&app=fte',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[fax_secret]',
			'parameter_name'=>'fax_secret',
			'default_value'=>'111-111-1111',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>' '
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			)
		),
		array(
			'keyword'=>'[user_secret]',
			'parameter_name'=>'user_secret',
			'default_value'=>urlencode($godaddy_username),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>' '
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'
'
				)
			)
		),
		array(
			'keyword'=>'[password]',
			'parameter_name'=>'password',
			'default_value'=>urlencode($godaddy_password),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>' '
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'
'
				)
			)
		),
	),
	'inherit_from'=>$_POST['imacros_hfid']
));

return;
}

// 34
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win php postalmethods send 
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"postalmethods send physical mail",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'letter.html',
			'content'=>'    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 1 September 2005), see www.w3.org" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PostalMethods HTML Sample - http://www.postalmethods.com/</title>

<style type="text/css">
/*<![CDATA[*/
<!--
body {
        text-align: left;
        white-space: normal;
        font-family: "Times New Roman", Times, serif;
        margin:0;
        padding:0;
        height: 11in; /*Letter Size Paper*/
        width: 8.5in; /*Letter Size Paper*/
		margin-left: 0.5in;
		margin-top: 0.5in;
		margin-bottom: 0.5in;
}
#Addresses {
		position:relative;
		height:2.875in;	
        width:7.4in;
}
#ReturnAddress {
    position:absolute;
    width:3.5in; Your company logo (optional). You can change the size of the font and your company logo image to make it fit to the envelope window */
    height:0.792in;
    text-transform: uppercase;
	font-family:Arial, Helvetica, sans-serif;
    font-size: 10pt;
    z-index:100;
}
#CompanyLogo {
    position:absolute;
    left:2in;
    width:1.45in;
    height:0.792in;
    z-index:10;
	text-align:right;
}
#RecipientAddress {
    position:absolute;
    top:1.542in;
    width:2.75in;
    height:1.625in;
    text-transform: uppercase;
	font-family:Arial, Helvetica, sans-serif;
    font-size: 9pt;
}
#RightSideContent {
	position:relative;
	border:thin #000000;
	left: 4.5in;
	height: 2.8in;
	width: 2.9in;
}
#BodyContent {
    position:relative;
    left:0;
    width:7.4in;
    font-size: 11pt;
    line-height: 1.5;
    white-space: normal;
    margin:0;
    padding:0;
}
.PageBreak {
	page-break-after:always; /*Using this tag as a DIV class, forces a page break when printing the letter*/
	height:1px;
	margin:0;
	padding:0;
}
-->
/*]]>*/
</style>
</head>
<body>
<div id="Addresses">
<!-- Return Address -->
    <div id="ReturnAddress" style="background-color:white;">
	[returnline1]<br/>
	[returnline2]<br/>
	[returnline3]<br/>
	[returnline4]<br/>
	[returnline5]<br/>
	[returnline6]<br/>
	[returnline7]<br/>
	</div>

<!-- Recipient Address -->
    <div id="RecipientAddress"  style="background-color:white;">
	[to1]<br/>
	[to2]<br/>
	[to3]<br/>
	</div>

<!-- Content printed to the right side of the addresses. This content is not visible through the envelope windows. -->
	<div id="RightSideContent">[rightside]</div>
</div>
<!-- Content of the letter -->
<div id="BodyContent">

[bodycontent]

<!--<div class="PageBreak">&nbsp;</div>-->

</div>
</body>
</html>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'hello.php',
			'content'=>'<?php
 
/************* Settings  Begin ****************/
 
$filename = \'[uploaded_file]\';  // file to be posted; contents need to conform to requirements (address in proper address area)
$username = \'[postalmethods_username]\';
$password = \'[postalmethods_password]\';
$description = \'Sending a letter using PHP\';
$mode = \'[postalmethods_mode]\';  // Default, Production, or Development.
 
/************* Settings  End ******************/
 
 
// Open File
if( !($fp = fopen($filename, "r"))){
	// Error opening file
	// Handle error however appropriate for your script
	echo "Error opening file";
	exit;
}
 
// Read data from the file into $data
$data = "";
while (!feof($fp)) $data .= fread($fp,1024);
fclose($fp);

$file_extension_parts=explode(".", $filename);
$file_extension=$file_extension_parts[count($file_extension_parts)-1];
 
$soapclient = new SoapClient(\'https://api.postalmethods.com/2009-02-26/PostalWS.asmx?WSDL\');
$result = $soapclient->SendLetter(array(\'Username\'    => $username,
                                     \'Password\'       => $password,
                                     \'MyDescription\'  => $description,  // free-form description for your records
                                     \'FileExtension\'  => $file_extension,  // make sure the extension reflects the file type
                                     \'FileBinaryData\' => $data,  // PHP5 does base64_encoding implicitly
                                     \'WorkMode\'       => $mode)); 
 
 
//print_r($result);
 
$status_code = $result->SendLetterResult;  // $status_code is the (positive) transaction ID if successful, or a (negative) error number if unsuccessful
if ($status_code > 0){
	print "Message submitted successfully with transaction ID <b>$status_code</b>";
} else {
	print "Message submission failed on error <a href=\"http://www.postalmethods.com/resources/reference/status-codes\">$status_code</a>";
}
?>',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[postalmethods_username]',
			'parameter_name'=>'postalmethods_username',
			'default_value'=>urlencode($postalmethods_username),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[postalmethods_password]',
			'parameter_name'=>'postalmethods_password',
			'default_value'=>urlencode($postalmethods_password),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[postalmethods_mode]',
			'parameter_name'=>'postalmethods_mode',
			'default_value'=>'Development',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[uploaded_file]',
			'parameter_name'=>'uploaded_file',
			'default_value'=>'letter.html',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[to1]',
			'parameter_name'=>'to1',
			'default_value'=>'My+Friends+House',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[to2]',
			'parameter_name'=>'to2',
			'default_value'=>'123+Just+a+Test+Ln.',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[to3]',
			'parameter_name'=>'to3',
			'default_value'=>'Mycity%2C+NY++10023',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline1]',
			'parameter_name'=>'returnline1',
			'default_value'=>'My+House',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline2]',
			'parameter_name'=>'returnline2',
			'default_value'=>'123+Just+Testing+St.',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline3]',
			'parameter_name'=>'returnline3',
			'default_value'=>'Los+Angeles%2C+CA++90001',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline4]',
			'parameter_name'=>'returnline4',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline5]',
			'parameter_name'=>'returnline5',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline6]',
			'parameter_name'=>'returnline6',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline7]',
			'parameter_name'=>'returnline7',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[rightside]',
			'parameter_name'=>'rightside',
			'default_value'=>'++++%09%3Cspan+style%3D%22text-align%3Aright%22%3E%0D%0A++++%09%09%3Ch1%3EPostalMethods%3C%2Fh1%3E%0D%0A++++++++%09%3Cem%3EDate%3A+March+01%2C+2009%3C%2Fem%3E%0D%0A++++++++%3C%2Fspan%3E%0D%0A++++++++%3Cp%3EPostalMethods+makes+it+effortless+to+post+invoices%2C+send+confirmations%2C+or+generate+any+other+type+of+message+via+postal+mail+%28%22snail+mail%22%29.+Additionally%2C+letters+can+easily+be+issued+from+any+online+service+or+legacy+application.%3C%2Fp%3E%0D%0A++++++++%3Cp%3ENo+more+manual+printing%2C+folding%2C+inserting%2C+sealing%2C+stamping%2C+or+delivering.+PostalMethods+does+it+all+for+you.%3C%2Fp%3E%0D%0A',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[bodycontent]',
			'parameter_name'=>'bodycontent',
			'default_value'=>'%3Ch2%3EWhat+can+I+use+PostalMethods+for%3F%3C%2Fh2%3E%0D%0A++%3Cul%3E%0D%0A%09%3Cli%3EPost+a+bunch+of+invoices+without+printing%2C+folding%2C+stuffing%2C+sealing%2C+stamping%2C+and+posting%3C%2Fli%3E%0D%0A%09%3Cli%3EEnable+an+e-commerce+package+to+send+confirmations%2C+notifications+and+invoices+by+post%3C%2Fli%3E%0D%0A%09%3Cli%3EEnable+an+online+service+to+send+snail+mail%3C%2Fli%3E%0D%0A%09%3Cli%3ESend+letters+from+your+CRM+or+accounting+software%3C%2Fli%3E%0D%0A%09%3Cli%3EHave+call+center+personnel+send+postal+mail+with+no+manual+intervention%3C%2Fli%3E%0D%0A++%3C%2Ful%3E%0D%0A%0D%0A%3Ch2%3EHow+quickly+are+letters+delivered%3F%3C%2Fh2%3E%0D%0A%3Cp%3ELetters+are+transferred+to+a+postal+distribution+center+once+a+day+on+business+days.+For+example%2C+mail+sent+from+the+USA+is+transferred+at+11am+EST%2C+so+any+letters+submitted+until+around+10am+EST+will+make+it+into+the+transferred+batch.+Once+transferred+to+the+USPS%2C+standard+delivery+times+apply.%3C%2Fp%3E%0D%0A%0D%0A%3Ch2%3EIs+the+developer+account+really+free%3F%3C%2Fh2%3E%0D%0A%3Cp%3EYes.+The+difference+between+a+developer+account+and+a+regular+account+is+that+your+letters+will+not+actually+get+sent.+Rather%2C+your+control+panel+will+simulate+the+posting+of+letters.+You+can+develop+your+application+and+see+how+the+system+reacts.%3C%2Fp%3E%0D%0A%0D%0A%3Ch2%3EDo+you+add+your+logo+to+my+letter%3F%3C%2Fh2%3E%0D%0A%3Cp%3ENO%21+We+only+add+serial+numbers+and+2D+bar-codes+to+the+letter+for+fulfillment+purposes.+These+marks+cannot+be+associated+with+PostalMethods+in+any+way.+We+also+add+a+stamp+and+a+bar-code+on+the+envelope.+That%27s+it.%3C%2Fp%3E%0D%0A%0D%0A%3Cdiv+class%3D%22PageBreak%22%3E%26nbsp%3B%3C%2Fdiv%3E%0D%0A%0D%0A%3Ch2%3ECan+I+have+multiple+users%2Fusernames+under+an+account%3F%3C%2Fh2%3E%0D%0A%3Cp%3EYes.+You+can+have+multiple+users+%28people%29+working+under+a+single+username+%28login%29%2C+and+you+can+have+multiple+usernames%2C+so+that+each+person%2C+department%2C+or+web+application+in+your+business+can+review+their+own+posting+activity.+To+add+a+new+user+login+to+your+account+as+a+user+with+Administrator+permissions+and+click+Account.+In+the+Users+tab%2C+click+on+Add.%3C%2Fp%3E%0D%0A%3Ch2%3ECan+I+have+a+mixed+account+-+developing+under+one+username+and+posting+under+another%3F%3C%2Fh2%3E%0D%0A%3Cp%3EYes%2C+you+can+have+multiple+users+under+an+account+each+with+its+own+mode+-+Development+or+Production.+This+means+that+you+can+keep+developing+under+one+username+%28no+cost%2C+simulated+letter+posting%29%2C+while+another+username+is+active+%28charged+per+item%2C+letters+actually+sent%29.%3C%2Fp%3E%0D%0A%0D%0A%3Ch2%3EHow+do+I+send+a+letter%3F%3C%2Fh2%3E%0D%0A%3Cp%3EYou+can+submit+messages+by+two+methods%3A%3C%2Fp%3E%0D%0A++%3Col%3E%0D%0A%09%3Cli%3ESimply+send+an+email+with+an+attachment+to+send%40letter.postalmethods.com.+The+first+page+of+the+attachment+needs+to+include+the+recipient+address.%3Cbr+%2F%3E%0D%0ASee+Email+Reference+for+full+details%3C%2Fli%3E%0D%0A%09%3Cli%3EProgram+a+script+to+submit+a+message+through+our+API%2C+as+explained+in+our+Quick+Start+guide.%3C%2Fli%3E%0D%0A++%3C%2Fol%3E%0D%0A++%0D%0A%3Ch2%3EWhat+happens+to+undeliverable+letters%3F%3C%2Fh2%3E%0D%0A%3Cp%3EThey+are+returned+to+you+if+your+return+address+appears+in+the+top+window+of+a+double+windows+envelope%2C+and+you+have+selected+first+class+postage+%28which+includes+returning+the+letter+to+its+originator+if+undeliverable%29.%3C%2Fp%3E%0D%0A%0D%0A%3Ch2%3ECan+I+send+a+letter+internationally%3F%3C%2Fh2%3E%0D%0A%3Cp%3EYes%2C+letters+can+be+sent+to+any+postal+address+worldwide.+See+the+Pricing+page+under+Optional+Add-Ons+for+details.%3C%2Fp%3E%0D%0A',
			'constraints'=>array(
			)
		)
	),
	'inherit_from'=>$_POST['universal_php']
));

return;
}

// 35
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win cygwin bash
$_POST['cygwin_bash'] = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win cygwin bash",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'set CYGWIN=nodosfilewarning
mkdir "[SERVERBINS]\cygwin64\home\[USERNAME]"
move /Y [JOB_FOLDER]\.bash_profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.bash_profile"
move /Y [JOB_FOLDER]\.bashrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.bashrc"
move /Y [JOB_FOLDER]\.inputrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.inputrc"
move /Y [JOB_FOLDER]\.profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.profile"
if exist "[SERVERBINS]\cygwin64\bin\bash.exe" "[SERVERBINS]\cygwin64\bin\bash.exe" --login -i [JOB_FOLDER]\hello.sh >output.txt
if not exist "[SERVERBINS]\cygwin64\bin\bash.exe" echo "unable to find cygwin, might not be in serverbins" >output.txt',
			'system_kinds'=>array("Windows")
		),
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'.profile',
			'content'=>'# To the extent possible under law, the author(s) have dedicated all 
# copyright and related and neighboring rights to this software to the 
# public domain worldwide. This software is distributed without any warranty. 
# You should have received a copy of the CC0 Public Domain Dedication along 
# with this software. 
# If not, see <http://creativecommons.org/publicdomain/zero/1.0/>. 

# base-files version 4.1-1

# ~/.profile: executed by the command interpreter for login shells.

# The latest version as installed by the Cygwin Setup program can
# always be found at /etc/defaults/etc/skel/.profile

# Modifying /etc/skel/.profile directly will prevent
# setup from updating it.

# The copy in your home directory (~/.profile) is yours, please
# feel free to customise it to create a shell
# environment to your liking.  If you feel a change
# would be benificial to all, please feel free to send
# a patch to the cygwin mailing list.

# User dependent .profile file

# Set user-defined locale
export LANG=$(locale -uU)

# This file is not read by bash(1) if ~/.bash_profile or ~/.bash_login
# exists.
#
# if running bash
if [ -n "${BASH_VERSION}" ]; then
  if [ -f "${HOME}/.bashrc" ]; then
    source "${HOME}/.bashrc"
  fi
fi',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'.inputrc',
			'content'=>'# To the extent possible under law, the author(s) have dedicated all 
# copyright and related and neighboring rights to this software to the 
# public domain worldwide. This software is distributed without any warranty. 
# You should have received a copy of the CC0 Public Domain Dedication along 
# with this software. 
# If not, see <http://creativecommons.org/publicdomain/zero/1.0/>. 

# base-files version 4.1-1

# ~/.inputrc: readline initialization file.

# The latest version as installed by the Cygwin Setup program can
# always be found at /etc/defaults/etc/skel/.inputrc

# Modifying /etc/skel/.inputrc directly will prevent
# setup from updating it.

# The copy in your home directory (~/.inputrc) is yours, please
# feel free to customise it to create a shell
# environment to your liking.  If you feel a change
# would be benifitial to all, please feel free to send
# a patch to the cygwin mailing list.

# the following line is actually
# equivalent to "\C-?": delete-char
"\e[3~": delete-char

# VT
"\e[1~": beginning-of-line
"\e[4~": end-of-line

# kvt
"\e[H": beginning-of-line
"\e[F": end-of-line

# rxvt and konsole (i.e. the KDE-app...)
"\e[7~": beginning-of-line
"\e[8~": end-of-line

# VT220
"\eOH": beginning-of-line
"\eOF": end-of-line

# Allow 8-bit input/output
#set meta-flag on
#set convert-meta off
#set input-meta on
#set output-meta on
#$if Bash
  # Don\'t ring bell on completion
  #set bell-style none

  # or, don\'t beep at me - show me
  #set bell-style visible

  # Filename completion/expansion
  #set completion-ignore-case on
  #set show-all-if-ambiguous on

  # Expand homedir name
  #set expand-tilde on

  # Append "/" to all dirnames
  #set mark-directories on
  #set mark-symlinked-directories on

  # Match all files
  #set match-hidden-files on

  # \'Magic Space\'
  # Insert a space character then performs
  # a history expansion in the line
  #Space: magic-space
#$endif',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'.bashrc',
			'content'=>'# To the extent possible under law, the author(s) have dedicated all 
# copyright and related and neighboring rights to this software to the 
# public domain worldwide. This software is distributed without any warranty. 
# You should have received a copy of the CC0 Public Domain Dedication along 
# with this software. 
# If not, see <http://creativecommons.org/publicdomain/zero/1.0/>. 

# base-files version 4.1-1

# ~/.bashrc: executed by bash(1) for interactive shells.

# The latest version as installed by the Cygwin Setup program can
# always be found at /etc/defaults/etc/skel/.bashrc

# Modifying /etc/skel/.bashrc directly will prevent
# setup from updating it.

# The copy in your home directory (~/.bashrc) is yours, please
# feel free to customise it to create a shell
# environment to your liking.  If you feel a change
# would be benifitial to all, please feel free to send
# a patch to the cygwin mailing list.

# User dependent .bashrc file

# If not running interactively, dont do anything
[[ "$-" != *i* ]] && return

# Shell Options
#
# See man bash for more options...
#
# Dont wait for job termination notification
# set -o notify
#
# Dont use ^D to exit
# set -o ignoreeof
#
# Use case-insensitive filename globbing
# shopt -s nocaseglob
#
# Make bash append rather than overwrite the history on disk
# shopt -s histappend
#
# When changing directory small typos can be ignored by bash
# for example, cd /vr/lgo/apaache would find /var/log/apache
# shopt -s cdspell

# Completion options
#
# These completion tuning parameters change the default behavior of bash_completion:
#
# Define to access remotely checked-out files over passwordless ssh for CVS
# COMP_CVS_REMOTE=1
#
# Define to avoid stripping description in --option=description of ./configure --help
# COMP_CONFIGURE_HINTS=1
#
# Define to avoid flattening internal contents of tar files
# COMP_TAR_INTERNAL_PATHS=1
#
# Uncomment to turn on programmable completion enhancements.
# Any completions you add in ~/.bash_completion are sourced last.
# [[ -f /etc/bash_completion ]] && . /etc/bash_completion

# History Options
#
# Dont put duplicate lines in the history.
# export HISTCONTROL=$HISTCONTROL${HISTCONTROL+,}ignoredups
#
# Ignore some controlling instructions
# HISTIGNORE is a colon-delimited list of patterns which should be excluded.
# The & is a special pattern which suppresses duplicate entries.
# export HISTIGNORE=$\'[ \t]*:&:[fb]g:exit\'
# export HISTIGNORE=$\'[ \t]*:&:[fb]g:exit:ls\' # Ignore the ls command as well
#
# Whenever displaying the prompt, write the previous line to disk
# export PROMPT_COMMAND="history -a"

# Aliases
#
# Some people use a different file for aliases
# if [ -f "${HOME}/.bash_aliases" ]; then
#   source "${HOME}/.bash_aliases"
# fi
#
# Some example alias instructions
# If these are enabled they will be used instead of any instructions
# they may mask.  For example, alias rm=\'rm -i\' will mask the rm
# application.  To override the alias instruction use a \ before, ie
# \rm will call the real rm not the alias.
#
# Interactive operation...
# alias rm=\'rm -i\'
# alias cp=\'cp -i\'
# alias mv=\'mv -i\'
#
# Default to human readable figures
# alias df=\'df -h\'
# alias du=\'du -h\'
#
# Misc :)
# alias less=\'less -r\'                          # raw control characters
# alias whence=\'type -a\'                        # where, of a sort
# alias grep=\'grep --color\'                     # show differences in colour
# alias egrep=\'egrep --color=auto\'              # show differences in colour
# alias fgrep=\'fgrep --color=auto\'              # show differences in colour
#
# Some shortcuts for different directory listings
# alias ls=\'ls -hF --color=tty\'                 # classify files in colour
# alias dir=\'ls --color=auto --format=vertical\'
# alias vdir=\'ls --color=auto --format=long\'
# alias ll=\'ls -l\'                              # long list
# alias la=\'ls -A\'                              # all but . and ..
# alias l=\'ls -CF\'                              #

# Umask
#
# /etc/profile sets 022, removing write perms to group + others.
# Set a more restrictive umask: i.e. no exec perms for others:
# umask 027
# Paranoid: neither group nor others have any perms:
# umask 077

# Functions
#
# Some people use a different file for functions
# if [ -f "${HOME}/.bash_functions" ]; then
#   source "${HOME}/.bash_functions"
# fi
#
# Some example functions:
#
# a) function settitle
# settitle () 
# { 
#   echo -ne "\e]2;$@\a\e]1;$@\a"; 
# }
# 
# b) function cd_func
# This function defines a \'cd\' replacement function capable of keeping, 
# displaying and accessing history of visited directories, up to 10 entries.
# To use it, uncomment it, source this file and try \'cd --\'.
# acd_func 1.0.5, 10-nov-2004
# Petar Marinov, http:/geocities.com/h2428, this is public domain
# cd_func ()
# {
#   local x2 the_new_dir adir index
#   local -i cnt
# 
#   if [[ $1 ==  "--" ]]; then
#     dirs -v
#     return 0
#   fi
# 
#   the_new_dir=$1
#   [[ -z $1 ]] && the_new_dir=$HOME
# 
#   if [[ ${the_new_dir:0:1} == \'-\' ]]; then
#     #
#     # Extract dir N from dirs
#     index=${the_new_dir:1}
#     [[ -z $index ]] && index=1
#     adir=$(dirs +$index)
#     [[ -z $adir ]] && return 1
#     the_new_dir=$adir
#   fi
# 
#   #
#   # \'~\' has to be substituted by ${HOME}
#   [[ ${the_new_dir:0:1} == \'~\' ]] && the_new_dir="${HOME}${the_new_dir:1}"
# 
#   #
#   # Now change to the new dir and add to the top of the stack
#   pushd "${the_new_dir}" > /dev/null
#   [[ $? -ne 0 ]] && return 1
#   the_new_dir=$(pwd)
# 
#   #
#   # Trim down everything beyond 11th entry
#   popd -n +11 2>/dev/null 1>/dev/null
# 
#   #
#   # Remove any other occurence of this dir, skipping the top of the stack
#   for ((cnt=1; cnt <= 10; cnt++)); do
#     x2=$(dirs +${cnt} 2>/dev/null)
#     [[ $? -ne 0 ]] && return 0
#     [[ ${x2:0:1} == \'~\' ]] && x2="${HOME}${x2:1}"
#     if [[ "${x2}" == "${the_new_dir}" ]]; then
#       popd -n +$cnt 2>/dev/null 1>/dev/null
#       cnt=cnt-1
#     fi
#   done
# 
#   return 0
# }
# 
# alias cd=cd_func',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'.bash_profile',
			'content'=>'# To the extent possible under law, the author(s) have dedicated all 
# copyright and related and neighboring rights to this software to the 
# public domain worldwide. This software is distributed without any warranty. 
# You should have received a copy of the CC0 Public Domain Dedication along 
# with this software. 
# If not, see <http://creativecommons.org/publicdomain/zero/1.0/>. 

# base-files version 4.1-1

# ~/.bash_profile: executed by bash(1) for login shells.

# The latest version as installed by the Cygwin Setup program can
# always be found at /etc/defaults/etc/skel/.bash_profile

# Modifying /etc/skel/.bash_profile directly will prevent
# setup from updating it.

# The copy in your home directory (~/.bash_profile) is yours, please
# feel free to customise it to create a shell
# environment to your liking.  If you feel a change
# would be benifitial to all, please feel free to send
# a patch to the cygwin mailing list.

# User dependent .bash_profile file

# source the users bashrc if it exists
if [ -f "${HOME}/.bashrc" ] ; then
  source "${HOME}/.bashrc"
fi

# Set PATH so it includes users private bin if it exists
# if [ -d "${HOME}/bin" ] ; then
#   PATH="${HOME}/bin:${PATH}"
# fi

# Set MANPATH so it includes users private man if it exists
# if [ -d "${HOME}/man" ]; then
#   MANPATH="${HOME}/man:${MANPATH}"
# fi

# Set INFOPATH so it includes users private info if it exists
# if [ -d "${HOME}/info" ]; then
#   INFOPATH="${HOME}/info:${INFOPATH}"
# fi',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'# THESE FIRST LINES ARE IMPORTANT BECAUSE THE CHANGE THE PWD TO THE CORRECT FOLDER
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
echo "HI";',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 36
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default g++
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default c++",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'g++ --help && echo 0 >err.txt || echo 1 >err.txt
g++_err=`cat err.txt`
if [ $g++_err -ne  0 ] ; then
    rm err.txt
    echo "g++ is not available on this system" >error.txt
    exit 1
fi
rm err.txt

g++ hello.cpp -o hello.exe && ./hello.exe >output.txt
rm -f ./hello.exe',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris'),
		),
		array(
			'filename'=>'run.bat',
			'content'=>'cd /d "[SERVERBINS]\mingw\bin\"
PATH=[PERCENT]PATH[PERCENT];[PERCENT]CD[PERCENT]
cd /d [JOB_FOLDER]
if exist "[SERVERBINS]\mingw\bin\g++.exe" "[SERVERBINS]\mingw\bin\g++.exe" hello.cpp -o hello.exe
if not exist "[SERVERBINS]\mingw\bin\g++.exe" echo "unable to find mingw g++, might not be in serverbins" >output.txt
if exist "[SERVERBINS]\mingw\bin\g++.exe" hello.exe >output.txt
if exist "[SERVERBINS]\mingw\bin\g++.exe" del /F /Q hello.exe',
			'system_kinds'=>array('Windows'),
		),
		array(
			'filename'=>'hello.cpp',
			'content'=>'#include <iostream>
using namespace std;
int main()
{
  cout << "Hello World!" << endl;   cout << "Welcome to C++ Programming" << endl;
  return 1;
}',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));

return;
}

// 37
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default gcc
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default c",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'gcc --help && echo 0 >err.txt || echo 1 >err.txt
gcc_err=`cat err.txt`
if [ $gcc_err -ne  0 ] ; then
    rm err.txt
    echo "gcc is not available on this system" >error.txt
    exit 1
fi
rm err.txt

gcc hello.c -o hello.exe && ./hello.exe >output.txt
rm -f hello.exe',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris'),
		),
		array(
			'filename'=>'run.bat',
			'content'=>'cd /d "[SERVERBINS]\mingw\bin\"
PATH=[PERCENT]PATH[PERCENT];[PERCENT]CD[PERCENT]
cd /d [JOB_FOLDER]
if exist "[SERVERBINS]\mingw\bin\gcc.exe" "[SERVERBINS]\mingw\bin\gcc.exe" hello.c -o hello.exe
if not exist "[SERVERBINS]\mingw\bin\gcc.exe" echo "unable to find mingw gcc, might not be in serverbins" >output.txt
if exist "[SERVERBINS]\mingw\bin\gcc.exe" hello.exe >output.txt
if exist "[SERVERBINS]\mingw\bin\gcc.exe" del /F /Q hello.exe',
			'system_kinds'=>array('Windows'),
		),
		array(
			'filename'=>'hello.c',
			'content'=>'#include<stdio.h>

int main()
{
    printf("Hello World");
	return 1;

}',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));
return;
}

// 38
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default gfortran
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"default gfortran",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'gfortran --help && echo 0 >err.txt || echo 1 >err.txt
gfortran_err=`cat err.txt`
if [ $gfortran_err -ne  0 ] ; then
    rm err.txt
    echo "gfortran is not available on this system" >error.txt
    exit 1
fi
rm err.txt

gfortran hello.f -o hello.exe 2>>error.txt
./hello.exe >output.txt 2>>error.txt
rm -f ./hello.exe',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris'),
		),
		array(
			'filename'=>'run.bat',
			'content'=>'cd /d "[SERVERBINS]\mingw\bin\"
PATH=[PERCENT]PATH[PERCENT];[PERCENT]CD[PERCENT]
cd /d [JOB_FOLDER]
if exist "[SERVERBINS]\mingw\bin\gfortran.exe" "[SERVERBINS]\mingw\bin\gfortran.exe" hello.f -o hello.exe
if not exist "[SERVERBINS]\mingw\bin\gfortran.exe" echo "unable to find mingw gfortran, might not be in serverbins" >output.txt
if exist "[SERVERBINS]\mingw\bin\gfortran.exe" hello.exe >output.txt
if exist "[SERVERBINS]\mingw\bin\gfortran.exe" del /F /Q hello.exe',
			'system_kinds'=>array('Windows'),
		),
		array(
			'filename'=>'hello.f',
			'content'=>'      program hello
          print *, "Hello World!"
      end program hello',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array()
));


return;
}

// 39
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// default twilio send sms curl
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"twilio sms curl cygwin",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'curl --help && echo 0 >err.txt || echo 1 >err.txt
curl_err=`cat err.txt`
if [ $curl_err -ne  0 ] ; then
    rm err.txt
    echo "curl is not available on this system" >error.txt
    exit 1
fi
rm err.txt

curl -X POST \'https://api.twilio.com/2010-04-01/Accounts/[twilio_sid]/SMS/Messages.xml\' -d \'From=%2B[twilio_phonenum_from]\' -d \'To=[twilio_phonenum_to]\' -d \'Body=[twilio_sms_body]\' -u [twilio_sid]:[twilio_authtoken]',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'# THESE FIRST LINES ARE IMPORTANT BECAUSE THE CHANGE THE PWD TO THE CORRECT FOLDER
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
curl -X POST \'https://api.twilio.com/2010-04-01/Accounts/[twilio_sid]/SMS/Messages.xml\' -d \'From=%2B[twilio_phonenum_from]\' -d \'To=[twilio_phonenum_to]\' -d \'Body=[twilio_sms_body]\' -u [twilio_sid]:[twilio_authtoken]',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[twilio_sid]',
			'parameter_name'=>'twilio_sid',
			'default_value'=>urlencode($twilio_sid),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-alphanum',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_authtoken]',
			'parameter_name'=>'twilio_authtoken',
			'default_value'=>urlencode($twilio_authtoken),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-alphanum',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_phonenum_from]',
			'parameter_name'=>'twilio_phonenum_from',
			'default_value'=>urlencode($twilio_from_number),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_phonenum_to]',
			'parameter_name'=>'twilio_phonenum_to',
			'default_value'=>urlencode($twilio_to_number),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_sms_body]',
			'parameter_name'=>'twilio_sms_body',
			'default_value'=>'this+is%0D%0Ajust%0D%0Aa+test+%3A)',
			'int_preserve_encode'=>'true',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			)
		)
	),
	'inherit_from'=>$_POST['cygwin_bash']
));
return;
}

// 40
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// twilio send call curl
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"twilio call curl cygwin",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'curl --help && echo 0 >err.txt || echo 1 >err.txt
curl_err=`cat err.txt`
if [ $curl_err -ne  0 ] ; then
    rm err.txt
    echo "curl is not available on this system" >error.txt
    exit 1
fi
rm err.txt

curl -X POST \'https://api.twilio.com/2010-04-01/Accounts/[twilio_sid]/Calls.xml\' -d \'From=%2B[twilio_phonenum_from]\' -d \'To=[twilio_phonenum_to]\' -d \'Url=[twilio_twiml_url]\' -u [twilio_sid]:[twilio_authtoken]',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'# THESE FIRST LINES ARE IMPORTANT BECAUSE THE CHANGE THE PWD TO THE CORRECT FOLDER
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
curl -X POST \'https://api.twilio.com/2010-04-01/Accounts/[twilio_sid]/Calls.xml\' -d \'From=%2B[twilio_phonenum_from]\' -d \'To=[twilio_phonenum_to]\' -d \'Url=[twilio_twiml_url]\' -u [twilio_sid]:[twilio_authtoken]',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[twilio_sid]',
			'parameter_name'=>'twilio_sid',
			'default_value'=>urlencode($twilio_sid),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-alphanum',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_authtoken]',
			'parameter_name'=>'twilio_authtoken',
			'default_value'=>urlencode($twilio_authtoken),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-alphanum',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_phonenum_from]',
			'parameter_name'=>'twilio_phonenum_from',
			'default_value'=>urlencode($twilio_from_number),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_phonenum_to]',
			'parameter_name'=>'twilio_phonenum_to',
			'default_value'=>'6611234567',
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			)
		),
		array(
			'keyword'=>'[twilio_twiml_url]',
			'parameter_name'=>'twilio_twiml_url',
			'default_value'=>'http%3A%2F%2Fgoogle.com',
			'int_preserve_encode'=>'true',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			)
		)
	),
	'inherit_from'=>$_POST['cygwin_bash']
));


return;
}



$qfx='<QuestionForm xmlns="http://mechanicalturk.amazonaws.com/AWSMechanicalTurkDataSchemas/2005-10-01/QuestionForm.xsd">  <Overview>
		    <Title>Game 01523, "X" to play</Title>
		    <Text>
		      You are helping to decide the next move in a game of Tic-Tac-Toe.  The board looks like this:
		    </Text>
		    <Binary>
		      <MimeType>
		        <Type>image</Type>
		        <SubType>gif</SubType>
		      </MimeType>
		      <DataURL>http://mydomain.com/tictactoe.gif</DataURL>
		      <AltText>The game board, with "X" to move.</AltText>
		    </Binary>
		    <Text>
		      Player "X" has the next move.
		    </Text>
		  </Overview>
		  <Question>
		    <QuestionIdentifier>nextmove</QuestionIdentifier>
		    <DisplayName>The Next Move</DisplayName>
		    <IsRequired>true</IsRequired>
		    <QuestionContent>
		      <Text>
		        What are the coordinates of the best move for player "X" in this game?
		      </Text>
		    </QuestionContent>
		    <AnswerSpecification>
		      <FreeTextAnswer>
		        <Constraints>
		          <Length minLength="2" maxLength="2" />
		        </Constraints>
		        <DefaultText>C1</DefaultText>
		      </FreeTextAnswer>
		    </AnswerSpecification>
		  </Question>
		  <Question>
		    <QuestionIdentifier>likelytowin</QuestionIdentifier>
		    <DisplayName>The Next Move</DisplayName>
		    <IsRequired>true</IsRequired>
		    <QuestionContent>
		      <Text>
		        How likely is it that player "X" will win this game?
		      </Text>
		    </QuestionContent>
		    <AnswerSpecification>
		      <SelectionAnswer>
		        <StyleSuggestion>radiobutton</StyleSuggestion>
		        <Selections>
		          <Selection>
		            <SelectionIdentifier>notlikely</SelectionIdentifier>
		            <Text>Not likely</Text>
		          </Selection>
		          <Selection>
		            <SelectionIdentifier>unsure</SelectionIdentifier>
		            <Text>It could go either way</Text>
		          </Selection>
		          <Selection>
		            <SelectionIdentifier>likely</SelectionIdentifier>
		            <Text>Likely</Text>
		          </Selection>
		        </Selections>
		      </SelectionAnswer>
		    </AnswerSpecification>
		  </Question>
		</QuestionForm>';



// 41
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// amazon mechanical turk hit curl
$mturk_hit = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"amazon mechanical turk hit cygwin",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'curl --help && echo 0 >err.txt || echo 1 >err.txt
curl_err=`cat err.txt`
if [ $curl_err -ne  0 ] ; then
    rm err.txt
    echo "curl is not available on this system" >error.txt
    exit 1
fi
rm err.txt

awk --help && echo 0 >err.txt || echo 1 >err.txt
awk_err=`cat err.txt`
if [ $awk_err -ne  0 ] ; then
    rm err.txt
    echo "awk is not available on this system" >error.txt
    exit 1
fi
rm err.txt

php --help && echo 0 >err.txt || echo 1 >err.txt
php_err=`cat err.txt`
if [ $php_err -ne  0 ] ; then
    rm err.txt
    echo "php is not available on this system" >error.txt
    exit 1
fi
rm err.txt

php get_signature.php
timestamp=`cat time.txt`
signature=`cat signature.txt`

txt_file=assignment_duration.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=aws_access_key.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=assignment_title.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=assignment_description.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=mturk_sandbox_endpoint.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=reward_amount.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=questionform_xml.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=comma_separated_keywords.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt




assignment_duration=`cat assignment_duration.txt`
aws_access_key=`cat aws_access_key.txt`
assignment_title=`cat assignment_title.txt`
assignment_description=`cat assignment_description.txt`
mturk_sandbox_endpoint=`cat mturk_sandbox_endpoint.txt`
reward_amount=`cat reward_amount.txt`
questionform_xml=`cat questionform_xml.txt`
comma_separated_keywords=`cat comma_separated_keywords.txt`
curl -X POST "$mturk_sandbox_endpoint$?Service=AWSMechanicalTurkRequester&Version=2012-03-25&Operation=CreateHIT&LifetimeInSeconds=604800&Reward.1.CurrencyCode=USD&AssignmentDurationInSeconds=$assignment_duration&AWSAccessKeyId=$aws_access_key&Signature=$signature&Timestamp=$timestamp&Title=$assignment_title&Description=$assignment_description&Reward.1.Amount=$reward_amount&Question=$questionform_xml&Keywords=$comma_separated_keywords" >output.txt
rm -f time.txt
rm -f signature.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'assignment_duration.txt',
			'content'=>'[assignment_duration]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'aws_access_key.txt',
			'content'=>'[aws_access_key]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'assignment_title.txt',
			'content'=>'[assignment_title]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'assignment_description.txt',
			'content'=>'[assignment_description]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'mturk_sandbox_endpoint.txt',
			'content'=>'[mturk_sandbox_endpoint]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'reward_amount.txt',
			'content'=>'[reward_amount]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'questionform_xml.txt',
			'content'=>'[questionform_xml]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'comma_separated_keywords.txt',
			'content'=>'[comma_separated_keywords]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'get_signature.php',
			'content'=>'<?php
// Define constants
$AWS_SECRET_ACCESS_KEY = \'[aws_secret_key]\';
$SERVICE_NAME = "AWSMechanicalTurkRequester";

// Define authentication routines
function generate_timestamp($time) {
  return gmdate("Y-m-d\TH:i:s\Z", $time);
}

function hmac_sha1($key, $s) {
  return pack("H*", sha1((str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x5c), 64))) .
                         pack("H*", sha1((str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x36), 64))) . $s))));
}

function generate_signature($service, $operation, $timestamp, $secret_access_key) {
  $string_to_encode = $service . $operation . $timestamp;
  $hmac = hmac_sha1($secret_access_key, $string_to_encode);
  $signature = base64_encode($hmac);
  return $signature;
}

// Calculate the request authentication parameters
$operation = "CreateHIT";
$timestamp = generate_timestamp(time());
$signature = generate_signature($SERVICE_NAME, $operation, $timestamp, $AWS_SECRET_ACCESS_KEY);

file_put_contents("time.txt",($timestamp) );
file_put_contents("signature.txt",($signature) );
?>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'curl --help && echo 0 >err.txt || echo 1 >err.txt
curl_err=`cat err.txt`
if [ $curl_err -ne  0 ] ; then
    rm err.txt
    echo "curl is not available on this system" >error.txt
    exit 1
fi
rm err.txt


php --help && echo 0 >err.txt || echo 1 >err.txt
php_err=`cat err.txt`
if [ $php_err -ne  0 ] ; then
    rm err.txt
    echo "php is not available on this system" >error.txt
    exit 1
fi
rm err.txt

awk --help && echo 0 >err.txt || echo 1 >err.txt
awk_err=`cat err.txt`
if [ $awk_err -ne  0 ] ; then
    rm err.txt
    echo "awk is not available on this system" >error.txt
    exit 1
fi
rm err.txt

php get_signature.php
timestamp=`cat time.txt`
signature=`cat signature.txt`

txt_file=assignment_duration.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=aws_access_key.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=assignment_title.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=assignment_description.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=mturk_sandbox_endpoint.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=reward_amount.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=questionform_xml.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt

txt_file=comma_separated_keywords.txt
awk \'{gsub("\"", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("`", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("{", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("}", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub(" ", "")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt
awk \'{gsub("$", "\$")}1\' $txt_file.txt > replace.txt && mv replace.txt $txt_file.txt




assignment_duration=`cat assignment_duration.txt`
aws_access_key=`cat aws_access_key.txt`
assignment_title=`cat assignment_title.txt`
assignment_description=`cat assignment_description.txt`
mturk_sandbox_endpoint=`cat mturk_sandbox_endpoint.txt`
reward_amount=`cat reward_amount.txt`
questionform_xml=`cat questionform_xml.txt`
comma_separated_keywords=`cat comma_separated_keywords.txt`
curl -X POST "$mturk_sandbox_endpoint$?Service=AWSMechanicalTurkRequester&Version=2012-03-25&Operation=CreateHIT&LifetimeInSeconds=604800&Reward.1.CurrencyCode=USD&AssignmentDurationInSeconds=$assignment_duration&AWSAccessKeyId=$aws_access_key&Signature=$signature&Timestamp=$timestamp&Title=$assignment_title&Description=$assignment_description&Reward.1.Amount=$reward_amount&Question=$questionform_xml&Keywords=$comma_separated_keywords" >output.txt
rm -f time.txt
rm -f signature.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[questionform_xml]',
			'parameter_name'=>'questionform_xml',
			'default_value'=>urlencode($qfx),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[aws_secret_key]',
			'parameter_name'=>'aws_secret_key',
			'default_value'=>urlencode($aws_secretkey_mturk),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[aws_access_key]',
			'parameter_name'=>'aws_access_key',
			'default_value'=>urlencode($aws_accesskey_mturk),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mturk_production_endpoint]',
			'parameter_name'=>'mturk_production_endpoint',
			'default_value'=>'https://mechanicalturk.amazonaws.com',
			'constraints'=>array(
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mturk_sandbox_endpoint]',
			'parameter_name'=>'mturk_sandbox_endpoint',
			'default_value'=>'https://mechanicalturk.sandbox.amazonaws.com',
			'constraints'=>array(
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[comma_separated_keywords]',
			'parameter_name'=>'comma_separated_keywords',
			'default_value'=>urlencode('tictactoe, game, game playing, play'),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_duration]',
			'parameter_name'=>'assignment_duration',
			'default_value'=>'30',
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_title]',
			'parameter_name'=>'assignment_title',
			'default_value'=>urlencode('My first HIT - Tic-Tac-Toe game playing'),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_description]',
			'parameter_name'=>'assignment_description',
			'default_value'=>urlencode('Pick the next move in a tic-tac-toe game.'),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[reward_amount]',
			'parameter_name'=>'reward_amount',
			'default_value'=>urlencode('1.00'),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'true'
		)
	),
	'inherit_from'=>$_POST['cygwin_bash']
));
// end mturk example


return;
}

// 42
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win miktex tex make pdf
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win miktex tex make pdf",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" hello.tex
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" "[SERVERBINS]\miktex2.9.4250\miktex\bin\dvipdfm.exe" hello.dvi
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" if [PERCENT]errorlevel[PERCENT] equ 0 del /F /Q hello.log
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" del /F /Q hello.dvi
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" del /F /Q hello.aux
if not exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\tex.exe" echo "unable to find miktex, might not be in serverbins" >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.tex',
			'content'=>'Hello, World
\bye          % marks the end of the file; not shown in the final output',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(),
	'mime'=>'application/pdf'
));

return;
}

// 43
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// win miktex latex make pdf
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win miktex latex make pdf",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" hello.tex
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" "[SERVERBINS]\miktex2.9.4250\miktex\bin\dvipdfm.exe" hello.dvi
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" if [PERCENT]errorlevel[PERCENT] equ 0 del /F /Q hello.log
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" del /F /Q hello.dvi
if exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" del /F /Q hello.aux
if not exist "[SERVERBINS]\miktex2.9.4250\miktex\bin\latex.exe" echo "unable to find miktex latex, might not be in serverbins" >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.tex',
			'content'=>'\documentclass{article}
\title{Cartesian closed categories and the price of eggs}
\author{Jane Doe}
\date{September 1994}
\begin{document}
   \maketitle
   Hello world!
\end{document}',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(),
	'mime'=>'application/pdf'
));
return;
}

// 44
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// tex make pdf
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"tex make pdf cygwin",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'tex --help && echo 0 >err.txt || echo 1 >err.txt
tex_err=`cat err.txt`
if [ $tex_err -ne  0 ] ; then
    rm err.txt
    echo "tex is not available on this system" >error.txt
    exit 1
fi
rm err.txt

dvipdfm --help && echo 0 >err.txt || echo 1 >err.txt
dvipdfm_err=`cat err.txt`
if [ $dvipdfm_err -ne  0 ] ; then
    rm err.txt
    echo "dvipdfm is not available on this system" >error.txt
    exit 1
fi
rm err.txt

tex hello.tex
dvipdfm hello.dvi
if [ $? == 0 ]; then rm -f hello.log; fi
rm -f hello.dvi',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.tex',
			'content'=>'\documentclass{article}
\title{Cartesian closed categories and the price of eggs}
\author{Jane Doe}
\date{September 1994}
\begin{document}
   \maketitle
   Hello world!
\end{document}',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'set CYGWIN=nodosfilewarning
mkdir "[SERVERBINS]\cygwin64\home\[USERNAME]"
move /Y [JOB_FOLDER]\.bash_profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.bash_profile"
move /Y [JOB_FOLDER]\.bashrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.bashrc"
move /Y [JOB_FOLDER]\.inputrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.inputrc"
move /Y [JOB_FOLDER]\.profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.profile"
if exist "[SERVERBINS]\cygwin64\bin\bash.exe" "[SERVERBINS]\cygwin64\bin\bash.exe" --login -i [JOB_FOLDER]\hello.sh
if not exist "[SERVERBINS]\cygwin64\bin\bash.exe" echo "unable to find cygwin, might not be in serverbins" >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'# THESE FIRST LINES ARE IMPORTANT BECAUSE THE CHANGE THE PWD TO THE CORRECT FOLDER
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
latex hello.tex
dvipdfm hello.dvi
if [ $? == 0 ]; then rm -f hello.log; fi
rm -f hello.dvi
rm -f hello.aux',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
	),
	'inherit_from'=>$_POST['cygwin_bash'],
	'mime'=>'application/pdf'
));

return;
}

// 45
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// latex make pdf
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"latex make pdf cygwin",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'latex --help && echo 0 >err.txt || echo 1 >err.txt
latex_err=`cat err.txt`
if [ $latex_err -ne  0 ] ; then
    rm err.txt
    echo "latex is not available on this system" >error.txt
    exit 1
fi
rm err.txt

dvipdfm --help && echo 0 >err.txt || echo 1 >err.txt
dvipdfm_err=`cat err.txt`
if [ $dvipdfm_err -ne  0 ] ; then
    rm err.txt
    echo "dvipdfm is not available on this system" >error.txt
    exit 1
fi
rm err.txt

latex hello.tex
dvipdfm hello.dvi
if [ $? == 0 ]; then rm -f hello.log; fi
rm -f hello.dvi',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.tex',
			'content'=>'\documentclass{article}
\title{Cartesian closed categories and the price of eggs}
\author{Jane Doe}
\date{September 1994}
\begin{document}
   \maketitle
   Hello world!
\end{document}',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'set CYGWIN=nodosfilewarning
mkdir "[SERVERBINS]\cygwin64\home\[USERNAME]"
move /Y [JOB_FOLDER]\.bash_profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.bash_profile"
move /Y [JOB_FOLDER]\.bashrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.bashrc"
move /Y [JOB_FOLDER]\.inputrc "[SERVERBINS]\cygwin64\home\[USERNAME]\.inputrc"
move /Y [JOB_FOLDER]\.profile "[SERVERBINS]\cygwin64\home\[USERNAME]\.profile"
if exist "[SERVERBINS]\cygwin64\bin\bash.exe" "[SERVERBINS]\cygwin64\bin\bash.exe" --login -i [JOB_FOLDER]\hello.sh
if not exist "[SERVERBINS]\cygwin64\bin\bash.exe" echo "unable to find cygwin, might not be in serverbins" >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'# THESE FIRST LINES ARE IMPORTANT BECAUSE THE CHANGE THE PWD TO THE CORRECT FOLDER
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
latex hello.tex
dvipdfm hello.dvi
if [ $? == 0 ]; then rm -f hello.log; fi
rm -f hello.dvi
rm -f hello.aux',
			'system_kinds'=>array("Windows")
		)
	),
	'hf_parameters'=>array(
	),
	'inherit_from'=>$_POST['cygwin_bash'],
	'mime'=>'application/pdf'
));
return;
}

// 46
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// haskell
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win haskell",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if exist "[SERVERBINS]\haskell2012.4.0.0\bin\ghc.exe" "[SERVERBINS]\haskell2012.4.0.0\bin\ghc.exe" -o hello.exe hello.hs
if not exist "[SERVERBINS]\haskell2012.4.0.0\bin\ghc.exe" echo "unable to find haskell, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\haskell2012.4.0.0\bin\ghc.exe" exit 0
hello.exe >output.txt
del /F /Q hello.exe
del /F /Q hello.o
del /F /Q hello.hi',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.hs',
			'content'=>'module Main where

main = putStrLn "Hello, World!"',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
	)
));


return;
}

// 47
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// racket/scheme
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"racket/scheme",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if not exist "[SERVERBINS]\racket\racket.exe" echo "unable to find racket, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\racket\racket.exe" exit 0
"[SERVERBINS]\racket\racket.exe" hello.rak',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.rak',
			'content'=>'#lang racket
(define display-list 
  (lambda (ls)
    (if (null? ls)
        (newline)
        (begin
          (display (car ls))
          (newline)
          (display-list (cdr ls))))))

(define write-list-to-file 
  (lambda (filename ls)
    (with-output-to-file filename
      (lambda ()
        (display-list ls)))))
(write-list-to-file "testfile.tmp" \'(this is a test!))',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
	)
));
return;
}

// 48
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// prolog
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"win prolog32",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'
if not exist "[SERVERBINS]\swi-prolog32\bin\swipl.exe" echo "unable to find swi-prolog, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\swi-prolog32\bin\swipl.exe" exit 0
"[SERVERBINS]\swi-prolog32\bin\swipl.exe" -q --goal=main --stand_alone=true -o myprog -c hello.pl >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'hello.pl',
			'content'=>':- initialization(main).
main :- write(\'Hello World!\'), nl, halt.',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
	)
));

return;
}


// 49
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// python read email ssl imap
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"python read email ssl imap",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if not exist "[SERVERBINS]\python27\python.exe" echo "unable to find python27, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\python27\python.exe" exit 0
"[SERVERBINS]\python27\python.exe" hello.py >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'run.bat',
			'content'=>'python --help && echo 0 >err.txt || echo 1 >err.txt
python_err=`cat err.txt`
if [ $python_err -ne  0 ] ; then
    rm err.txt
    echo "python is not available on this system" >error.txt
    exit 1
fi
rm err.txt

python hello.py >output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.py',
			'content'=>'
import imaplib

user_name=\'[imap_user_email_address]\'
password=\'[imap_user_email_password]\'

M = imaplib.IMAP4_SSL(\'[imap_server]\',[imap_port])
M.login(user_name, password)

M.select("inbox")
typ, data = M.search(None, "UNSEEN")
for num in data[0].split():
    typ, data = M.fetch(num, "(RFC822)")
    #print "Message %s\n%s\n" % (num, data[0][1])
    print data[0][1]
    break
M.close()
M.logout()',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[imap_user_email_address]',
			'parameter_name'=>'imap_user_email_address',
			'default_value'=>urlencode($imap_email_user),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[imap_user_email_password]',
			'parameter_name'=>'imap_user_email_password',
			'default_value'=>urlencode($imap_email_pass),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[imap_server]',
			'parameter_name'=>'imap_server',
			'default_value'=>urlencode($imap_email_server),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[imap_port]',
			'parameter_name'=>'imap_port',
			'default_value'=>urlencode($imap_email_port),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			),
			'int_preserve_encode'=>'false'
		)
	)
));


return;
}

// 50
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// python read email ssl smtp
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"python send email ssl smtp",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'if not exist "[SERVERBINS]\python27\python.exe" echo "unable to find python27, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\python27\python.exe" exit 0
"[SERVERBINS]\python27\python.exe" hello.py >output.txt',
			'system_kinds'=>array('Windows')
		),
		array(
			'filename'=>'run.bat',
			'content'=>'python --help && echo 0 >err.txt || echo 1 >err.txt
python_err=`cat err.txt`
if [ $python_err -ne  0 ] ; then
    rm err.txt
    echo "python is not available on this system" >error.txt
    exit 1
fi
rm err.txt

python hello.py >output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'hello.py',
			'content'=>'import smtplib

FROMADDR = \'[smtp_email_from]\'
LOGIN    = FROMADDR
PASSWORD = \'[smtp_email_password]\'
TOADDRS  = [\'[smtp_email_to]\']
SUBJECT  = \'[email_subject]\'

msg = (\'From: %s\r\nTo: %s\r\nSubject: %s\r\n\r\n\'
       % (FROMADDR, \', \'.join(TOADDRS), SUBJECT) )
msg += \'[email_body]\r\n\'

server = smtplib.SMTP(\'[smtp_email_server]\', [smtp_email_port])
server.set_debuglevel(1)
server.ehlo()
server.starttls()
server.login(LOGIN, PASSWORD)
server.sendmail(FROMADDR, TOADDRS, msg)
server.quit()',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[smtp_email_from]',
			'parameter_name'=>'smtp_email_from',
			'default_value'=>urlencode($imap_email_user),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[smtp_email_to]',
			'parameter_name'=>'smtp_email_to',
			'default_value'=>urlencode($imap_email_user),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[smtp_email_password]',
			'parameter_name'=>'smtp_email_password',
			'default_value'=>urlencode($imap_email_pass),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[smtp_email_server]',
			'parameter_name'=>'smtp_email_server',
			'default_value'=>urlencode($smtp_email_server),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[smtp_email_port]',
			'parameter_name'=>'smtp_email_port',
			'default_value'=>urlencode($smtp_email_port),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[email_subject]',
			'parameter_name'=>'email_subject',
			'default_value'=>urlencode("This is just a simple SMTP test!"),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[email_body]',
			'parameter_name'=>'email_body',
			'default_value'=>urlencode("This is a big long email body!"),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		)
	)
));


return;
}

// 51
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// tts raw w/festival
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"linux festival tts",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Linux'),
	'resources'=>array(
		array(
			'filename'=>'human.txt',
			'content'=>'[say]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'lame --help && echo 0 >err.txt || echo 1 >err.txt
lame_err=`cat err.txt`
if [ $lame_err -ne  0 ] ; then
    rm err.txt
    echo "lame is not available on this system" >error.txt
    exit 1
fi
rm err.txt

festival --help && echo 0 >err.txt || echo 1 >err.txt
festival_err=`cat err.txt`
if [ $festival_err -ne  0 ] ; then
    rm err.txt
    echo "festival is not available on this system" >error.txt
    exit 1
fi
rm err.txt

cat -A human.txt | text2wave -o output.wav
lame -f output.wav output.mpg',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[say]',
			'parameter_name'=>'say',
			'default_value'=>urlencode("Hello, how are you?"),
			'constraints'=>array(
			),
			'int_preserve_encode'=>'false'
		)
	),
	'mime'=>'audio/mpeg'
));

return;
}

// 52
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// mysql execute script
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"mysql execute script",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'hello.sql',
			'content'=>'connect my_database;
show tables;',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'if not exist "[SERVERBINS]\mysql\mysql.exe" echo "unable to find mysql.exe, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\mysql\mysql.exe" exit 0
[SERVERBINS]\mysql\mysql.exe -u [mysql_user] -p[mysql_password] -h [mysql_server] -P [mysql_port] -e "source hello.sql" >output.txt',
			'system_kinds'=>array('Windows')
		),

		array(
			'filename'=>'run.bat',
			'content'=>'mysql --help && echo 0 >err.txt || echo 1 >err.txt
mysql_err=`cat err.txt`
if [ $mysql_err -ne  0 ] ; then
    rm err.txt
    echo "mysql is not available on this system" >error.txt
    exit 1
fi
rm err.txt

mysql -u [mysql_user] -p[mysql_password] -h [mysql_server] -P [mysql_port] -e "source hello.sql >output.txt"',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[mysql_user]',
			'parameter_name'=>'mysql_user',
			'default_value'=>urlencode(""),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mysql_password]',
			'parameter_name'=>'mysql_password',
			'default_value'=>urlencode(""),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mysql_server]',
			'parameter_name'=>'mysql_server',
			'default_value'=>urlencode("mydatabaseserver.com"),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mysql_port]',
			'parameter_name'=>'mysql_port',
			'default_value'=>urlencode("3306"),
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			),
			'int_preserve_encode'=>'false'
		)
	),
	'mime'=>'audio/mpeg'
));

return;
}

// 53
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// NEEDS WORK
// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// deluge torrent download
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"deluge torrent download",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'hello.sql',
			'content'=>'connect my_database;
show tables;',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'run.bat',
			'content'=>'if not exist "[SERVERBINS]\deluge\deluged.exe" echo "unable to find deluged.exe, might not be in serverbins" >output.txt
if not exist "[SERVERBINS]\deluge\deluged.exe" exit 0
[SERVERBINS]\deluge\deluged.exe
[SERVERBINS]\deluge\deluge-console.exe "add -p [JOB_FOLDER] [torrent_url]"
[SERVERBINS]\deluge\deluge-console.exe info',
			'system_kinds'=>array('Windows')
		),

		array(
			'filename'=>'run.bat',
			'content'=>'deluge "add -p [JOB_FOLDER] [torrent_url]"
deluge info',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[torrent_url]',
			'parameter_name'=>'torrent_url',
			'default_value'=>urlencode(""),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			),
			'int_preserve_encode'=>'false'
		)
	)
));
return;
}

// 54
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// docmail send physical mail
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"docmail send physical mail",
	'hf_expression'=>"",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'hello.php',
			'content'=>'<?php  
//
//updated 22/06/2011 17:10  corrections made to the script - now runs correctly
//updated 27/06/2011 17:30  additional example code, comments and debug output
//updated 14/07/2011 11:30  bIsMono flag was not being set correctly
//updated 18/01/2012 11:45   example section "Add Single Address" had incorrect parameter names LastName and NameTitle in array. Changed to Surname and Title respectively.
//updated 19/04/2012 12:36  corrected delivery type options in comments
//updated 17/07/2012 13:30  added example email on success & error variables for use in ProcessMailing calls  +  example polling loop for GetStatus after calling ProcessMailing
//updated 18/07/2012 10:40  added code to use ExtendedCall: GetProcessingError to return detail of any errors during aysnchronous processing after ProcessMailing

require("lib/nusoap.php"); 

// Flag for outputting debug print messages
$debug = false;
$fileContentsDebug = false;
$callParamArrayDebug = false;
	
try {
	// human-readable web service definition for all available calls can be found here:   https://www.cfhdocmail.com/TestAPI2/DMWS.asmx
	
	if ( strtolower(\'[docmail_mode]\')==\'production\' )
	{
		//Live URL
		//$wsdl = "https://www.cfhdocmail.com/LiveAPI2/DMWS.asmx?WSDL";
	}
	else
	{
		//Test URL
		//$wsdl = "https://www.cfhdocmail.com/Test_SimpleAPI/DocMail.SimpleAPI.asmx?WSDL";
		$wsdl = "https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?WSDL";
	}
	$sUsr = \'[docmail_username]\';  // docmail username
	$sPwd = \'[docmail_password]\'; // docmail password
	$sMailingName = "test";   // "Your reference" for this mailing (information)
	$sCallingApplicationID = "PHPCodeTemplate";   // could be useful to show your appliction name in docmail (information)
	$sTemplateName = "LetterTemplate.doc" ; // friendly name in docmail for your template file (information)
	$sTemplateFileName = "LetterTemplate.doc" ; // file name to be passed to docmail for your template file (information)
	$TemplateFile = "LetterTemplate.doc";           // filename (in this case the file is on the root of the webserver!)
	$bColour = false;                // Print in colour?
	$bDuplex = true;                // Print on both sides of paper?
	$eDeliveryType = "Standard";// First, Standard or Courier - to get the BEST benefit use Standard 
	$eAddressNameFormat = "Full Name";//How the name appears in the envelope address  “Full Name”, “Firstname Surname”, “Title Initial Surname”,“Title Surname”, or “Title Firstname Surname” 
	$ProductType  = "A4Letter";	//ProductType (on Mailing): “A4Letter”, “BusinessCard”, “GreetingCard”, or “Postcard”
	$DocumentType  = "A4Letter";	//DocumentType (on Templates - selects the sub-type for a given template): “A4Letter”, “BusinessCard”,“GreetingCardA5”, “PostcardA5”, “PostcardA6”, “PostcardA5Right” or “PostcardA6Right” 
	
	//used in adding an address list file
	$AddressFile = "test.csv";           // address CSV file filename (in this case the file is on the root of the webserver!)
	
	//used in adding a single address
	$NameTitle = "";		   //recipient title/saultation
	$FirstName = "[Firstname]";	   //recipient 1st name
	$LastName  = "[Surname]";		   //recipient surname
	$sAddress1 = "[Address1]";         // Address line 1
	$sAddress2 = "[Address2]";         // Address line 2
	$sAddress3 = "[Address3]";       // Address line 3
	$sAddress4 = "[Address4]";          // Address line 4
	$sAddress5 = "[Address5]"; 
	$sPostCode = "[Postcode]";       // PostCode
	
	$sMailingDescription ="" ; 
	$bIsMono = !$bColour  ; 
	$sDespatchASAP =true ; 
	$sDespatchDate ="" ; 
	$ProofApprovalRequired = false; //false = Automatically approve the order without returning a proof
	
	
	/********** Added variables used in ProcessMaiing to return error and success messages on completion of async processing ***********/
	
	$EmailOnProcessMailingError = "";	//email address
	$EmailOnProcessMailingSuccess = "";	//email address
	
	$HttpPostOnProcessMailingError = "";     //URL on your server set up to handle callbacks
	$HttpPostOnProcessMailingSuccess = "";   //URL on your server set up to handle callbacks

	//true  = proof approval requried.  
	//	call ProcessMailing  with Submit=0 PartialProcess=1 to approve the proof and submit the mailing
	//	Poll GetStatus to check that proof is ready (loop)  \'Mailing submitted\', \'Mailing processed\' or \'Partial processing complete\' mean the proof is ready
	//	call GetProofFile to return the proof file data
	//	call ProcessMailing  with Submit=1 PartialProcess=0 to approve the proof and submit the mailing
	// Setup nusoap client
	$client = new nusoap_client($wsdl, true); //PHP5 now has is\'t own soapclient class, so use nusoap_client to avoid clash
	// Increase soap client timeout
	$client->timeout = 240;
	// Increase php script server timeout
	set_time_limit(240);
	
	error_reporting(E_ALL);
	
	///////////////////////
	// CreateMailing  - Setup array to pass into webservice call
	///////////////////////
	
	// Setup array to pass into webservice call
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"CustomerApplication" => $sCallingApplicationID,
		"ProductType" => $ProductType,
		"MailingName" => $sMailingName,
		"MailingDescription" => $sMailingDescription,
		"IsMono" => $bIsMono,
		"IsDuplex" => $bDuplex,
		"DeliveryType" => $eDeliveryType,
		"DespatchASAP" => $sDespatchASAP,
		//"DespatchDate" => $sDespatchDate,   //only include if delayed despatch is required
		"AddressNameFormat" => $eAddressNameFormat,
		"ReturnFormat" => "Text"
	);
	// other available params listed here:  https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=CreateMailing
	print "<b>About to call CreateMailing</b><br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("CreateMailing",$arr);  
	if ($debug) {print_r($result["CreateMailingResult"]);   print "<br> " ;}
	CheckError($result["CreateMailingResult"]);   //parse & check error fields from result as described above
	
	print "get mailing guid  <br>" ;
	$MailingGUID = GetFld($result["CreateMailingResult"],"MailingGUID");//parse the value  for key \'MailingGUID\' from $result
	
	///////////////////////
	//Add Single Address   - use this to add a single address by setting up array to pass into webservice call
	///////////////////////
	/*
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"Title" => $NameTitle, 
		"FirstName" => $FirstName, 
		"Surname"  => $LastName,  
		"Address1" => $sAddress1,
		"Address2" => $sAddress2,
		"Address3" => $sAddress3,
		"Address4" => $sAddress4,
		"Address5" => $sAddress5,
		"Address6" => $sPostCode,
		"ReturnFormat" => "Text" 
	);
	print "<br>About to call AddAddress for MailingGUID ".$MailingGUID."<br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("AddAddress",$arr);
	if ($debug) {print_r($result["AddAddressResult"]);   print "<br> " ;}
	CheckError($result["AddAddressResult"]);   //parse & check error fields from result as described above
	*/
	
	///////////////////////
	//Add Address File  - use this to add a file of addresses (in CSV format with a header row) - Read in $AddressFile file data and Setup array to pass into webservice call
	///////////////////////
	
	// Load contents of the Address CSV file into base-64 array to pass across SOAP
	// for example the Address CSV file is at the root of the webserver
	
	$AddressFileHandle = fopen($AddressFile, "rb");
	$AddressFileContents = base64_encode(fread($AddressFileHandle, filesize($AddressFile)));
	fclose($AddressFileHandle);
	if ($debug) {
		print "address file is " .filesize($AddressFile) ." bytes<br>";
		if ($fileContentsDebug) {
			print "Contents of file:<br>";
			print_r($AddressFileContents);
			print "<br><br>";
		}
	}
	
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"FileName" => $AddressFile, 
		"FileData" => $AddressFileContents, 
		"HasHeaders" => True,
		"ReturnFormat" => "Text" 
	);
	print "<b>About to call AddMailingListFile for MailingGUID</b> ".$MailingGUID."<br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("AddMailingListFile",$arr);
	if ($debug) {print_r($result["AddMailingListFileResult"]);   print "<br> " ;}
	CheckError($result["AddMailingListFileResult"]); 
	
	///////////////////////
	// AddTemplateFile  - Read in $TemplateFile file data and Setup array to pass into webservice call
	///////////////////////
	
	// Load contents of word file into base-64 array to pass across SOAP
	// for example the word file is at the root of the webserver
	$TemplateHandle = fopen($TemplateFile, "rb");
	$TemplateContents = base64_encode(fread($TemplateHandle, filesize($TemplateFile)));
	fclose($TemplateHandle);
	if ($debug) {
		print "file is " .filesize($TemplateFile) ." bytes<br>";
		if ($fileContentsDebug) {
			print "Contents of file:<br>";
			print_r($TemplateContents);
			print "<br><br>";
		}
	}
	
	$arr = array(
	"Username" => $sUsr,
	"Password" => $sPwd,
	"MailingGUID" => $MailingGUID,
	"DocumentType" => $DocumentType,     
	"TemplateName" => $sTemplateName,
	"FileName" => $sTemplateFileName,
	"FileData" => $TemplateContents, 
	"AddressedDocument"  => true,  
	"Copies" => 1,
	"ReturnFormat" => "Text"
	);
	// other available params listed here:  https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=AddTemplateFile
	print "<b>About to call AddTemplateFile for MailingGUID</b> ".$MailingGUID."<br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("AddTemplateFile",$arr);
	if ($debug) {print_r($result["AddTemplateFileResult"]);   print "<br> " ;} 
	CheckError($result["AddTemplateFileResult"]); 
	
	
	///////////////////////
	// ProcessMailing - Setup array to pass into webservice call
	///////////////////////
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"CustomerApplication" => $sCallingApplicationID,
		"SkipPreviewImageGeneration" => false,
		"Submit" => !$ProofApprovalRequired , //auto submit when approval is not requried
		"PartialProcess" =>  $ProofApprovalRequired, //fully process when approval is not requried 
		"Copies" => 1,
		"ReturnFormat" => "Text",
		"EmailSuccessList" => 	$EmailOnProcessMailingSuccess,
		"EmailErrorList" => 	$EmailOnProcessMailingError,
		"HttpPostOnSuccess" => 	$HttpPostOnProcessMailingSuccess,
		"HttpPostOnError" =>	$HttpPostOnProcessMailingError
	);
	// there are useful parameters that you may wish to include on this call which enable asynchronous notifications of successes and fails of automated orders to be sent to you via email or HTTP Post:
	//		EmailSuccessList,EmailErrorList
	//		HttpPostOnSuccess,HttpPostOnError
	// other available params listed here:  https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=ProcessMailing
	print "<b>About to call ProcessMailing</b><br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("ProcessMailing",$arr);
	if ($debug) {print_r($result["ProcessMailingResult"]);   print "<br> " ;}
	CheckError($result["ProcessMailingResult"]); 
	
	//Example polling loop function to wait & confirm the processing from ProcessMailing has completed
	if ($ProofApprovalRequired) {
		WaitForProcessMailingStatus($client,$sUsr,$sPwd,$MailingGUID,"Partial processing complete",$callParamArrayDebug);
	}
	else{
		WaitForProcessMailingStatus($client,$sUsr,$sPwd,$MailingGUID,"Mailing submitted",$callParamArrayDebug);
	}
	
	
	/*
	//additional calls that may be useful:
	
	///////////////////////
	// GetStatus - Setup array to pass into webservice call
	///////////////////////
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"ReturnFormat" => "Text"
	);
	// other available params listed here:  (https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=GetStatus) returns the status of a mailing from the mailing guid
	print "<b>About to call GetStatus</b><br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("GetStatus",$arr);
	if ($debug) {print_r($result["GetStatusResult"]);   print "<br> " ;}
	CheckError($result["GetStatusResult"]); 
	
	
	///////////////////////
	// GetProofFile - Setup array to pass into webservice call
	///////////////////////
	//NOTE:  Status must that the show last "ProcessMailing"	call is complete before a proof can be returned.

	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"ReturnFormat" => "Text"
	);
	//  other available params listed here:  (GetProofFile (https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=GetProofFile) returns the file data of the PDF proof if it has been generated.
	print "<b>About to call GetProofFile</b><br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("GetProofFile",$arr);
	if ($debug) {print_r($result["GetProofFileResult"]);   print "<br> " ;}
	CheckError($result["GetProofFileResult"]); 
	
	///////////////////////
	// ProcessMailing - With "Submit" and "PartialProcess" flags set to APPROVE the mailing - Setup array to pass into webservice call
	///////////////////////
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"CustomerApplication" => $sCallingApplicationID,
		"SkipPreviewImageGeneration" => false,
		"Submit" => true, //auto submit
		"PartialProcess" =>  false, //fully process
		"Copies" => 1,
		"ReturnFormat" => "Text",
		"EmailSuccessList" => 	$EmailOnProcessMailingSuccess,
		"EmailErrorList" => 	$EmailOnProcessMailingError,
		"HttpPostOnSuccess" => 	$HttpPostOnProcessMailingSuccess,
		"HttpPostOnError" =>	$HttpPostOnProcessMailingError
	);
	// there are useful parameters that you may wish to include on this call which enable asynchronous notifications of successes and fails of automated orders to be sent to you via email or HTTP Post:
	//		EmailSuccessList,EmailErrorList
	//		HttpPostOnSuccess,HttpPostOnError
	// other available params listed here:  https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=ProcessMailing
	if ($debug) print "About to call ProcessMailing<br>";
	if ($callParamArrayDebug) print_r($arr)."<br>";
	$result = $client->call("ProcessMailing",$arr);
	if ($debug) {print_r($result["ProcessMailingResult"]);   print "<br> " ;}
	CheckError($result["ProcessMailingResult"]); 
	
	*/
	
	
} 
catch (Exception $e) {
	print "PROBLEM:" .$e->getMessage() ."<br>";
	var_dump($e->getMessage());
}

function WaitForProcessMailingStatus($client,$sUsr,$sPwd,$MailingGUID,$ExpectedStatus,$callParamArrayDebug){
	///////////////////////
	// GetStatus - Setup array to pass into webservice call
	///////////////////////
	$arr = array(
		"Username" => $sUsr,
		"Password" => $sPwd,
		"MailingGUID" => $MailingGUID,
		"ReturnFormat" => "Text"
	);
	
	//poll GetStatus in a loop until the processing has completed
	//loop a maximum of 10 times, with a 10 second delay between iterations.
	//	alternatively; handle callbacks from the HttpPostOnSuccess & HttpPostOnError parameters on ProcessMailing to identify when the processing has completed
	$i = 0;
	do {
		// other available params listed here:  (https://www.cfhdocmail.com/TestAPI2/DMWS.asmx?op=GetStatus) returns the status of a mailing from the mailing guid
		print "<b>About to call GetStatus</b><br>";
		if ($callParamArrayDebug) print_r($arr)."<br>";
		$result = $client->call("GetStatus",$arr);
		
		print "RESULT WAS :" ; print_r($result); print "<br> " ;
		if ($debug) {print_r($result["GetStatusResult"]);   print "<br> " ;}
		CheckError($result["GetStatusResult"]); 
		
		$Status=GetFld($result["GetStatusResult"],"Status");
		$Error=GetFld($result["GetStatusResult"],"Error code");
		print("Status = ".$Status);  print "<br> " ;
		
		//end loop once processing is complete
		if ($Status== $ExpectedStatus ){break;}	//success
		if ($Status== "Error in processing" ){break;}	//error in processing
		if ($Error ){break;}				//error
			
	
		sleep(10);//wait 10 seconds before repeasting	
		++$i;		
	} while ($i < 10);	
	
	//
	if ($Status== "Error in processing") {
		//get description of error in processing
		$arr = array(
			"Username" => $sUsr,
			"Password" => $sPwd,
			"MethodName" => "GetProcessingError",
			"ReturnFormat" => "Text",
			"Properties" => array(
									"PropertyName" => "GetProcessingError",
									"PropertyValue" => $MailingGUID
								 )
		);
		print "<b>About to call ExtendedCall: GetProcessingError</b><br>";
		if ($callParamArrayDebug) print_r($arr)."<br>";
		$result = $client->call("ExtendedCall",$arr);
		CheckError($result["ExtendedCallResult"]); 
		print_r($result["ExtendedCallResult"]);   print "<br> " ;
	}
	
	//TODO:	handle the status not being reached appropriately for your system
	if ($Status!= $ExpectedStatus) {print("WARNING: exepcted status".$ExpectedStatus." not reached.  Current status: ".$Status);}
}
function CheckError($Res){ 
	print "Checking for errors<br>";
	//check for  the keys \'Error code\', \'Error code string\' and \'Error message\' to test/report errors
	$errCode = GetFld($Res,"Error code");
	if ($errCode) {
		$errName = GetFld($Res,"Error code string");
		$errMsg = GetFld($Res,"Error message");
		print \'ErrCode \'; print_r($errCode); print "<br>";
		print \'ErrName \'; print_r($errName); print "<br>";
		print \'ErrMsg \'; print_r($errMsg); print "<br>";
		throw new Exception("<h2>There was an error:</h2> ".$errCode." ".errName." - ".errMsg);
	}
	print "No error<br>";
}
function GetFld($FldList,$FldName){
	// calls return a multi-line string structured as :
	// [KEY]: [VALUE][carriage return][line feed][KEY]: [VALUE][carriage return][line feed][KEY]: [VALUE][carriage return][line feed][KEY]: [VALUE]
	//explode lines
	//print "Looking for Field \'".$FldName."\'<br>";
	$lines = explode("\n",$FldList);
	for ( $lineCounter=0;$lineCounter < count($lines); $lineCounter+=1){
		//explode field/value
		$fields = explode(":",$lines[$lineCounter]);
		//find matching field name
		if ($fields[0]==$FldName)	{
			//print "\'".$FldName."\' Value: ".ltrim($fields[1], " ")."<br>";
			return ltrim($fields[1], " "); //return value
		}
	}
	//print "\'".$FldName."\' NOT found<br>";
}
?>',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[docmail_username]',
			'parameter_name'=>'docmail_username',
			'default_value'=>urlencode($docmail_username),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[docmail_password]',
			'parameter_name'=>'docmail_password',
			'default_value'=>urlencode($docmail_password),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[docmail_mode]',
			'parameter_name'=>'docmail_mode',
			'default_value'=>'development', // development or production
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[uploaded_file]',
			'parameter_name'=>'uploaded_file',
			'default_value'=>'letter.html',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[to1]',
			'parameter_name'=>'to1',
			'default_value'=>'My+Friends+House',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[to2]',
			'parameter_name'=>'to2',
			'default_value'=>'123+Just+a+Test+Ln.',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[to3]',
			'parameter_name'=>'to3',
			'default_value'=>'Mycity%2C+NY++10023',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline1]',
			'parameter_name'=>'returnline1',
			'default_value'=>'My+House',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline2]',
			'parameter_name'=>'returnline2',
			'default_value'=>'123+Just+Testing+St.',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline3]',
			'parameter_name'=>'returnline3',
			'default_value'=>'Los+Angeles%2C+CA++90001',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline4]',
			'parameter_name'=>'returnline4',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline5]',
			'parameter_name'=>'returnline5',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline6]',
			'parameter_name'=>'returnline6',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[returnline7]',
			'parameter_name'=>'returnline7',
			'default_value'=>'',
			'constraints'=>array(
			)
		),
	),
	'inherit_from'=>$_POST['universal_php']

));


return;
}

// 55
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// semantria demo
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"semantria demo still editing",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'discovery.py',
			'content'=>'# -*- coding: utf-8 -*-
from __future__ import print_function, unicode_literals

import sys
import time
import uuid
import semantria

# API Key/Secret
SEMANTRIA_KEY = \'\'
SEMANTRIA_SECRET = \'\'


def onError(sender, result):
    print("\n", "ERROR: ", result)

if __name__ == "__main__":
	print("Semantria Collection processing mode demo.")

	docs = []
	print("Reading collection from file...")
	with open(\'source.txt\') as f:
		for line in f:
			docs.append(line)

	if len(docs) < 1:
		print("Source file isn\'t available or blank.")
		sys.exit(1)

	# Initializes Semantria Session
	session = semantria.Session(SEMANTRIA_KEY, SEMANTRIA_SECRET, use_compression=True)
	session.Error += onError

	# Queues collection for analysis using default configuration
	collection_id = str(uuid.uuid4())
	status = session.queueCollection({"id": collection_id, "documents": docs})
	if status != 200 and status != 202:
		print("Error.")
		sys.exit(1)

	print("%s collection queued successfully." % collection_id)

	# Retreives analysis results for queued collection
	result = None
	while True:
		time.sleep(1)
		print("Retrieving your processed results...")
		result = session.getCollection(collection_id)
		if result[\'status\'] != \'QUEUED\':
			break

	if result[\'status\'] != \'PROCESSED\':
		print("Error.")
		sys.exit(1)

	# Prints analysis results
	print("")
	for facet in result[\'facets\']:
		print("%s : %s" % (facet[\'label\'], facet[\'count\']))
		try:
			for attr in facet[\'attributes\']:
				print("\t%s : %s" % (attr[\'label\'], attr[\'count\']))
		except KeyError:
			pass',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'hello.txt',
			'content'=>'[semantria_text]',
			'system_kinds'=>array()
		),
 		array(
			'filename'=>'hello.py',
			'content'=>'# -*- coding: utf-8 -*-
from __future__ import print_function
import semantria
import uuid
import time

print("Semantria service demo ...", "\r\n")

# the consumer key and secret
consumerKey = ""
consumerSecret = ""

initialTexts = [
    "Lisa - there\'s 2 Skinny cow coupons available $5 skinny cow ice cream coupons on special k boxes and Printable FPC from facebook - a teeny tiny cup of ice cream. I printed off 2 (1 from my account and 1 from dh\'s). I couldn\'t find them instore and i\'m not going to walmart before the 19th. Oh well sounds like i\'m not missing much ...lol",
    "In Lake Louise - a guided walk for the family with Great Divide Nature Tours  rent a canoe on Lake Louise or Moraine Lake  go for a hike to the Lake Agnes Tea House. In between Lake Louise and Banff - visit Marble Canyon or Johnson Canyon or both for family friendly short walks. In Banff  a picnic at Johnson Lake  rent a boat at Lake Minnewanka  hike up Tunnel Mountain  walk to the Bow Falls and the Fairmont Banff Springs Hotel  visit the Banff Park Museum. The \"must-do\" in Banff is a visit to the Banff Gondola and some time spent on Banff Avenue - think candy shops and ice cream.",
    "On this day in 1786 - In New York City  commercial ice cream was manufactured for the first time."
]


def onRequest(sender, result):
    print("\n", "REQUEST: ", result)


def onResponse(sender, result):
    print("\n", "RESPONSE: ", result)


def onError(sender, result):
    print("\n", "ERROR: ", result)


def onDocsAutoResponse(sender, result):
    print("\n", "AUTORESPONSE: ", len(result), result)


def onCollsAutoResponse(sender, result):
    print("\n", "AUTORESPONSE: ", len(result), result)

# Creates JSON serializer instance
serializer = semantria.JsonSerializer()
# Initializes new session with the serializer object and the keys.
session = semantria.Session(consumerKey, consumerSecret, serializer, use_compression=True)

# Initialize session callback handlers
#session.Request += onRequest
#session.Response += onResponse
session.Error += onError
#session.DocsAutoResponse += onDocsAutoResponse
#session.CollsAutoResponse += onCollsAutoResponse

for text in initialTexts:
    # Creates a sample document which need to be processed on Semantria
    # Unique document ID
    # Source text which need to be processed
    doc = {"id": str(uuid.uuid1()).replace("-", ""), "text": text}
    # Queues document for processing on Semantria service
    status = session.queueDocument(doc)
    # Check status from Semantria service
    if status == 202:
        print("\"", doc["id"], "\" document queued successfully.", "\r\n")

# Count of the sample documents which need to be processed on Semantria
length = len(initialTexts)
results = []

while len(results) < length:
    print("Retrieving your processed results...", "\r\n")
    # As Semantria isn\'t real-time solution you need to wait some time before getting of the processed results
    # In real application here can be implemented two separate jobs, one for queuing of source data
    # another one for retreiving
    # Wait ten seconds while Semantria process queued document
    time.sleep(2)	
    # Requests processed results from Semantria service
    status = session.getProcessedDocuments()
    # Check status from Semantria service
    if isinstance(status, list):
        for object_ in status:
            results.append(object_)

for data in results:
    # Printing of document sentiment score
    print("Document ", data["id"], " Sentiment score: ", data["sentiment_score"], "\r\n")

    # Printing of document themes
    if "themes" in data:
        print("Document themes:", "\r\n")
        for theme in data["themes"]:
            print("	", theme["title"], " (sentiment: ", theme["sentiment_score"], ")", "\r\n")

    # Printing of document entities
    if "entities" in data:
        print("Entities:", "\r\n")
        for entity in data["entities"]:
            print("\t",
                  entity["title"], " : ", entity["entity_type"],
                  " (sentiment: ", entity["sentiment_score"], ")", "\r\n"
            )

#i = raw_input("Enter to close app ...")


',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[semantria_text]',
			'parameter_name'=>'semantria_text',
			'default_value'=>'California is the most geographically diverse state in the nation.',
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[semantria_key]',
			'parameter_name'=>'semantria_key',
			'default_value'=>''.$semantria_key.'',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		array(
			'keyword'=>'[semantria_secret]',
			'parameter_name'=>'semantria_secret',
			'default_value'=>''.$semantria_secret.'',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		)
	),
	'inherit_from'=>$_POST['universal_python']
));
return;
}

// 56
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{


// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// paypal direct payment from cc php
add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"paypal direct payment from cc php",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'username.txt',
			'content'=>'[paypal_api_username]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'password.txt',
			'content'=>'[paypal_api_password]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'signature.txt',
			'content'=>'[paypal_api_signature]',
			'system_kinds'=>array()
		),

		array(
			'filename'=>'customer_first_name.txt',
			'content'=>'[customer_first_name]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_last_name.txt',
			'content'=>'[customer_last_name]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_credit_card_type.txt',
			'content'=>'[customer_credit_card_type]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_credit_card_number.txt',
			'content'=>'[customer_credit_card_number]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'cc_expiration_month.txt',
			'content'=>'[cc_expiration_month]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'cc_expiration_year.txt',
			'content'=>'[cc_expiration_year]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'cc_cvv2_number.txt',
			'content'=>'[cc_cvv2_number]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_address1.txt',
			'content'=>'[customer_address1]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_address2.txt',
			'content'=>'[customer_address2]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_city.txt',
			'content'=>'[customer_city]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_state.txt',
			'content'=>'[customer_state]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_zip.txt',
			'content'=>'[customer_zip]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'customer_country.txt',
			'content'=>'[customer_country]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'payment_amount.txt',
			'content'=>'[payment_amount]',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'currency.txt',
			'content'=>'[currency]',
			'system_kinds'=>array()
		),
		
		
 		array(
			'filename'=>'hello.php',
			'content'=>'<?php

/** DoDirectPayment NVP example; last modified 08MAY23.
 *
 *  Process a credit card payment. 
*/

$environment = \'[paypal_api_environment]\';	// or \'beta-sandbox\' or \'live\'

/**
 * Send HTTP POST Request
 *
 * @param	string	The API method name
 * @param	string	The POST Message fields in &name=value pair format
 * @return	array	Parsed HTTP Response body
 */
function PPHttpPost($methodName_, $nvpStr_) {
	global $environment;
	
	$file_username_contents = file_get_contents("username.txt");
	$file_password_contents = file_get_contents("password.txt");
	$file_signature_contents = file_get_contents("signature.txt");

	// Set up your API credentials, PayPal end point, and API version.
	$API_UserName = urlencode($file_username_contents);
	$API_Password = urlencode($file_password_contents);
	$API_Signature = urlencode($file_signature_contents);
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment || "beta-sandbox" === $environment)
	{
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode(\'51.0\');

	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);

	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

	// Set the request as a POST FIELD for curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

	// Get response from the server.
	$httpResponse = curl_exec($ch);

	if(!$httpResponse) {
		exit("$methodName_ failed: ".curl_error($ch).\'(\'.curl_errno($ch).\')\');
	}

	// Extract the response details.
	$httpResponseAr = explode("&", $httpResponse);

	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}

	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists(\'ACK\', $httpParsedResponseAr)) {
		exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	}

	return $httpParsedResponseAr;
}

// Set request-specific fields.
$paymentType = urlencode(\'Sale\');				// \'Sale\' or \'Authorization\'
$firstName = urlencode( file_get_contents("customer_first_name.txt") );
$lastName = urlencode(file_get_contents("customer_last_name.txt"));
$creditCardType = urlencode(file_get_contents("customer_credit_card_type.txt"));
$creditCardNumber = urlencode(file_get_contents("customer_credit_card_number.txt"));
$expDateMonth = file_get_contents("cc_expiration_month.txt");
// Month must be padded with leading zero
$padDateMonth = urlencode(str_pad($expDateMonth, 2, \'0\', STR_PAD_LEFT));

$expDateYear = urlencode(file_get_contents("cc_expiration_year.txt"));
$cvv2Number = urlencode(file_get_contents("cc_cvv2_number.txt"));
$address1 = urlencode(file_get_contents("customer_address1.txt"));
$address2 = urlencode(file_get_contents("customer_address2.txt"));
$city = urlencode(file_get_contents("customer_city.txt"));
$state = urlencode(file_get_contents("customer_state.txt"));
$zip = urlencode(file_get_contents("customer_zip.txt"));
$country = urlencode(file_get_contents("customer_country.txt"));				// US or other valid country code
$amount = urlencode(file_get_contents("payment_amount.txt"));
$currencyID = urlencode(file_get_contents("currency.txt"));							// or other currency (\'GBP\', \'EUR\', \'JPY\', \'CAD\', \'AUD\')

// Add request-specific fields to the request string.
$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
			"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
			"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";

// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost(\'DoDirectPayment\', $nvpStr);

if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
	exit(\'Direct Payment Completed Successfully: \'.print_r($httpParsedResponseAr, true));
} else  {
	exit(\'DoDirectPayment failed: \' . print_r($httpParsedResponseAr, true));
}

?>',
			'system_kinds'=>array()
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[paypal_api_username]',
			'parameter_name'=>'paypal_api_username',
			'default_value'=>$paypal_api_username,
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[paypal_api_password]',
			'parameter_name'=>'paypal_api_password',
			'default_value'=>$paypal_api_password,
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[paypal_api_signature]',
			'parameter_name'=>'paypal_api_signature',
			'default_value'=>$paypal_api_signature,
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[paypal_api_environment]',
			'parameter_name'=>'paypal_api_environment',
			'default_value'=>"beta-sandbox",
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				)
			)
		),
		


		array(
			'keyword'=>'[customer_first_name]',
			'parameter_name'=>'customer_first_name',
			'default_value'=>"John",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_last_name]',
			'parameter_name'=>'customer_last_name',
			'default_value'=>"Doe",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_credit_card_type]',
			'parameter_name'=>'customer_credit_card_type',
			'default_value'=>"Visa",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_credit_card_number]',
			'parameter_name'=>'customer_credit_card_number',
			'default_value'=>"4111111111111111",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[cc_expiration_month]',
			'parameter_name'=>'cc_expiration_month',
			'default_value'=>"12",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[cc_expiration_year]',
			'parameter_name'=>'cc_expiration_year',
			'default_value'=>gmdate("Y"),
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[cc_cvv2_number]',
			'parameter_name'=>'cc_cvv2_number',
			'default_value'=>"",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_address1]',
			'parameter_name'=>'customer_address1',
			'default_value'=>"123 Washington Way",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_address2]',
			'parameter_name'=>'customer_address2',
			'default_value'=>"",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_city]',
			'parameter_name'=>'customer_city',
			'default_value'=>"New York",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_state]',
			'parameter_name'=>'customer_state',
			'default_value'=>"NY",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_zip]',
			'parameter_name'=>'customer_zip',
			'default_value'=>"10023",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[customer_country]',
			'parameter_name'=>'customer_country',
			'default_value'=>"US",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[payment_amount]',
			'parameter_name'=>'payment_amount',
			'default_value'=>"1.00",
			'constraints'=>array(
			)
		),
		array(
			'keyword'=>'[currency]',
			'parameter_name'=>'currency',
			'default_value'=>"USD",
			'constraints'=>array(
			)
		),
		
	),
	'inherit_from'=>$_POST['universal_php']
));

return;
}

// 57
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{



// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// amazon mturk hit wait for answer
$mturk_hit = add_library_hf( array(
	'id_user'=>$u->id_user,
	'hf_name'=>"amazon mturk hit wait for answer cygwin",
	'hf_expression'=>"(.*)",
	'inheritable'=>true,
	'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
	'resources'=>array(
		array(
			'filename'=>'run.bat',
			'content'=>'php --help && echo 0 >err.txt || echo 1 >err.txt
php_err=`cat err.txt`
if [ $php_err -ne  0 ] ; then
    rm err.txt
    echo "php is not available on this system" >error.txt
    exit 1
fi
rm err.txt

curl --help && echo 0 >err.txt || echo 1 >err.txt
curl_err=`cat err.txt`
if [ $curl_err -ne  0 ] ; then
    rm err.txt
    echo "curl is not available on this system" >error.txt
    exit 1
fi
rm err.txt

# STEP 1: GENERATE 40 RANDOM ALPHANUM IN ORDER TO ACHIEVE A UNIQUE HITTYPE
rand_title=`tr -dc [:alnum:] < /dev/urandom | head -c 40`

# STEP 2: SYNCHRONIZE SYSTEM TIME TO ENSURE VALID SIGNATURE
sudo ntpdate ntp.ubuntu.com

# STEP 3: GENERATE A VALID SIGNATURE
php get_signature.php operation=CreateHIT >> output.txt
timestamp=`cat time.txt`
signature=`cat signature.txt`

# STEP 4: CURL COMMAND: CREATE THE HIT THAT WORKERS WILL WORK ON
curl -X POST "[mturk_sandbox_endpoint]?Service=AWSMechanicalTurkRequester&Version=2012-03-25&Operation=CreateHIT&LifetimeInSeconds=604800&Reward.1.CurrencyCode=USD&AssignmentDurationInSeconds=[assignment_duration]&AWSAccessKeyId=[aws_access_key]&Signature=$signature&Timestamp=$timestamp&Title=[assignment_title]-$rand_title&Description=[assignment_description]&Reward.1.Amount=[reward_amount]&Question=[questionform_xml]&Keywords=[comma_separated_keywords]" >hitcreation.txt

# STEP 5: CLEANUP SIGNATURES
rm -f time.txt
rm -f signature.txt

# STEP 6: GENERATE A VALID SIGNATURE
php get_signature.php operation=SetHITTypeNotification >> output.txt
timestamp=`cat time.txt`
signature=`cat signature.txt`

# STEP 7: GET HIT TYPE ID
php get_hit_type.php
hittypeid=`cat hittypeid.txt`

# PRETTY WHITESPACE IN OUTPUT
echo "" >>output.txt
echo "" >>output.txt
echo "" >>output.txt

# STEP 8: COLLECT HITID FOR THE HIT WE\'VE CREATED
php get_hit_id.php
hitid=`cat hitid.txt`

# STEP 9: CLEANUP SIGNATURES
rm -f time.txt
rm -f signature.txt

# STEP 10: SLEEP, BECAUSE MTURK WORKER INTERFACE TAKES A WHILE FOR THE HIT TO BE POSTED IN HIT WORKER SEARCH RESULTS
sleep 20

# STEP 11: SYNCHRONIZE SYSTEM TIME AGAIN TO ENSURE VALID SIGNATURE
sudo ntpdate ntp.ubuntu.com

# STEP 12: LOOP UNTIL A WORKER SUBMITS AN ANSWER FOR THE HIT
x=0
while [ $x -eq 0 ]
do

  # STEP 12A: GENERATE A VALID SIGNATURE 
  php get_signature.php operation=GetHIT >>output.txt
  timestamp=`cat time.txt`
  signature=`cat signature.txt`

  # STEP 12B: CURL COMMAND: CHECK ON THE STATUS OF THIS HIT
  curl -X POST "[mturk_sandbox_endpoint]?Service=AWSMechanicalTurkRequester&AWSAccessKeyId=[aws_access_key]&Version=2012-03-25&Operation=GetHIT&Signature=$signature&Timestamp=$timestamp&HITId=$hitid"  >gethit.txt

  # STEP 12C: PROCESS THE HIT XML STATUS TEXT, WRITE A "0" OR "1" INTO STATUS.TXT
  #   (0=NO WORKER ANSWER YET, 1=WORKER HAS ANSWERED)
  php check_status.php >> output.txt
  x=$(( `cat status.txt` + 0 ))

  # STEP 12D: SLEEP BEFORE CHECKING AGAIN
  sleep 5

  # STEP 12E: CLEANUP SIGNATURE FILES
  rm -f time.txt
  rm -f signature.txt

done


# STEP 13: GENERATE SIGNATURE
php get_signature.php operation=GetAssignmentsForHIT >>output.txt
timestamp=`cat time.txt`
signature=`cat signature.txt`

# STEP 13: RETRIEVE HUMAN ANSWERS
curl -X POST "[mturk_sandbox_endpoint]?Service=AWSMechanicalTurkRequester&AWSAccessKeyId=[aws_access_key]&Version=2012-03-25&Operation=GetAssignmentsForHIT&Signature=$signature&Timestamp=$timestamp&HITId=$hitid&PageSize=1&PageNumber=1" >full_answer.txt

# STEP 14: CLEANUP SO THAT THESE EXTRA TEXTS DON\'T MAKE IT TO THE HIS TEXT PROCESSING PARTS
# COMMENT THE FOLLOWING LINES IF DEBUGGING IS NEEDED...WILL RETURN XML, TEXT
rm -f time.txt
rm -f gethit.txt
rm -f signature.txt
rm -f hitid.txt
rm -f hittypeid.txt
rm -f hitcreation.txt
rm -f status.txt
rm -f output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		),
		array(
			'filename'=>'get_signature.php',
			'content'=>'<?php

parse_str(implode(\'&\', array_slice($argv, 1)), $_GET);

// Define constants
$AWS_SECRET_ACCESS_KEY = \'[aws_secret_key]\';
$SERVICE_NAME = "AWSMechanicalTurkRequester";

// Define authentication routines
function generate_timestamp($time) {
  return gmdate("Y-m-d\TH:i:s\Z", $time);
}

function hmac_sha1($key, $s) {
  return pack("H*", sha1((str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x5c), 64))) .
                         pack("H*", sha1((str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x36), 64))) . $s))));
}

function generate_signature($service, $operation, $timestamp, $secret_access_key) {
  $string_to_encode = $service . $operation . $timestamp;
  $hmac = hmac_sha1($secret_access_key, $string_to_encode);
  $signature = base64_encode($hmac);
  return $signature;
}

// Calculate the request authentication parameters
$operation = $_GET["operation"];
$timestamp = generate_timestamp(time());
$signature = generate_signature($SERVICE_NAME, $operation, $timestamp, $AWS_SECRET_ACCESS_KEY);

file_put_contents("time.txt",urlencode($timestamp) );
file_put_contents("signature.txt",urlencode($signature) );
?>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'check_status.php',
			'content'=>'<?php
// http://docs.aws.amazon.com/AWSMechTurk/latest/AWSMturkAPI/ApiReference_HITDataStructureArticle.html

$matches=array();
$content=file_get_contents("gethit.txt");
preg_match_all("#<HITStatus>(.*?)</HITStatus>#i",$content,$matches);
if (isset($matches[1][0]))
{
    $status = $matches[1][0];
    if ($status=="Assignable" || $status=="Unassignable" )
    {
        echo "HIT still assignable, not completed yet.  Checking again in a few seconds...\n";
        file_put_contents("status.txt","0");
    }
    else
    {
        echo "HIT not assignable anymore!  Somebody has worked on it!  Exiting while loop\n";
        echo "CONTENT FROM GET HIT REQUEST:\n";
        echo $content;
        file_put_contents("status.txt","1");
    }
}
else
{
    echo "HIT still assignable, not completed yet.  Checking again in a few seconds...\n";
    file_put_contents("status.txt","0");
}
?>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'get_hit_type.php',
			'content'=>'<?php
$matches=array();
$content=file_get_contents("hitcreation.txt");
preg_match_all("#<HITTypeId>(.*?)</HITTypeId>#i",$content,$matches);
if (isset($matches[1][0]))
{
$hit_type_id=$matches[1][0];
file_put_contents("hittypeid.txt",$hit_type_id);
}
?>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'get_hit_id.php',
			'content'=>'<?php
$matches=array();
$content=file_get_contents("hitcreation.txt");
preg_match_all("#<HITId>(.*?)</HITId>#i",$content,$matches);
if (isset($matches[1][0]))
{
$hit_id=$matches[1][0];
file_put_contents("hitid.txt",$hit_id);
}
?>',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'warning.txt',
			'content'=>'Cygwin is not included in serverbins, if you are loading serverbins from serverbins-win-small.zip',
			'system_kinds'=>array()
		),
		array(
			'filename'=>'hello.sh',
			'content'=>'echo \'not working yet, still under development.  contact support\';>output.txt',
			'system_kinds'=>array('Linux','Mac','FreeBSD','Cygwin','Solaris')
		)
	),
	'hf_parameters'=>array(
		array(
			'keyword'=>'[questionform_xml]',
			'parameter_name'=>'questionform_xml',
			'default_value'=>urlencode($qfx),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[aws_secret_key]',
			'parameter_name'=>'aws_secret_key',
			'default_value'=>urlencode($aws_secretkey_mturk),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[aws_access_key]',
			'parameter_name'=>'aws_access_key',
			'default_value'=>urlencode($aws_accesskey_mturk),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mturk_production_endpoint]',
			'parameter_name'=>'mturk_production_endpoint',
			'default_value'=>'https://mechanicalturk.amazonaws.com',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[mturk_sandbox_endpoint]',
			'parameter_name'=>'mturk_sandbox_endpoint',
			'default_value'=>'https://mechanicalturk.sandbox.amazonaws.com',
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'"'
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'false'
		),
		array(
			'keyword'=>'[comma_separated_keywords]',
			'parameter_name'=>'comma_separated_keywords',
			'default_value'=>urlencode('tictactoe, game, game playing, play'),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_duration]',
			'parameter_name'=>'assignment_duration',
			'default_value'=>30,
			'constraints'=>array(
				array(
					'constraint_type'=>'allow-num',
					'constraint_text'=>''
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_title]',
			'parameter_name'=>'assignment_title',
			'default_value'=>urlencode('My first HIT - Tic-Tac-Toe game playing'),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[assignment_description]',
			'parameter_name'=>'assignment_description',
			'default_value'=>urlencode('Pick the next move in a tic-tac-toe game.'),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'true'
		),
		array(
			'keyword'=>'[reward_amount]',
			'parameter_name'=>'reward_amount',
			'default_value'=>urlencode('1.00'),
			'constraints'=>array(
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'\''
				),
				array(
					'constraint_type'=>'disallowed-str',
					'constraint_text'=>'`'
				)
			),
			'int_preserve_encode'=>'true'
		)
	),
	'inherit_from'=>$_POST['cygwin_bash']
));
// end mturk synchronous wait for answer
return;
}

// 58
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// seaports 
add_library_hf( array(
        'id_user'=>$u->id_user,
        'hf_name'=>"List of Seaports",
        'hf_expression'=>"(.*)",
        'inheritable'=>false,
        'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
        'resources'=>array(
        ),
        'hf_parameters'=>array(
                array(
                        'keyword'=>'[wget_url]',
                        'parameter_name'=>'wget_url',
                        'default_value'=>("http://en.wikipedia.org/wiki/List_of_seaports"),
                        'constraints'=>array(
                                array(
                                        'constraint_type'=>'disallowed-str',
                                        'constraint_text'=>'"'
                                ),
                                array(
                                        'constraint_type'=>'disallowed-str',
                                        'constraint_text'=>'\''
                                ),
                                array(
                                        'constraint_type'=>'disallowed-str',
                                        'constraint_text'=>'`'
                                )
                        ),
                        'int_preserve_encode'=>'true'
                ),
	),
	'inherit_from'=>$_POST['default_wget']
));
return;
}

// 59
$library_step = $library_step + 1;
if ($_GET['page']==$library_step)
{

// $id_user,$hf_name,$hf_expression,$inheritable,$sys_kinds,$resources,$hf_parameters,$inherit_from="")
// airports
add_library_hf( array(
        'id_user'=>$u->id_user,
        'hf_name'=>"List of Airports",
        'hf_expression'=>"<tr>.*?<td>([A-Za-z0-9]{0,3})</td>.*?<td>([A-Za-z0-9]{0,4})</td>.*?<td>(.*?)</td>.*?<td>(.*?)</td>.*?</tr>",
        'inheritable'=>false,
        'sys_kinds'=>array('Windows','Linux','Mac','FreeBSD','Cygwin','Solaris'),
        'resources'=>array(
                array(
                        'filename'=>'hello.php',
                        'content'=>'<?php
for ($i=65;$i<91;$i++)
{
    $letter = chr($i);
    $url = "http://en.wikipedia.org/wiki/List_of_airports_by_IATA_code:_$letter";
    file_put_contents("info.$i.txt",file_get_contents($url));
}
?>',
                        'system_kinds'=>array()
                )
        ),
        'hf_parameters'=>array(
        ),
	'inherit_from'=>$_POST['universal_php']
));
return;
}


// the one above was #45 








?>
