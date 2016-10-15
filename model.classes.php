<?php

include_once('utility.simpledom.php');
include_once('utility.functions.php');


$HIS_MATCH_TYPES=array(
	'processing'=>'processing',
	'operation'=>'operation',
	'action'=>'action',
	'output'=>'output'
);
$HIS_HFPVC_TYPES=array(
	'allow-alphanum'=>'allow alphanumeric characters',
	'allow-space'=>'allow spaces',
	'allow-num'=>'allow numbers',
	'allow-alpha'=>'allow alphabetic characters',
	'allow-special'=>'allow the following special characters:',
	'disallowed-str'=>'disallowed string',
	'match-regex'=>'must match regular expression'
);
$HIS_ACTION_TYPES=array(
	'his-hf'=>'HIS Function + postback printed output to here',
	'cur-as-key'=>'use current value as adjacent dictionary key',
	'cur-as-val'=>'use current value as adjacent dictionary value',
	'key-and-val'=>'set adjacent dictionary key and value',
	'clear-adj'=>'clear adjacent dictionary',
	'buffer'=>'set adjacent dictionary key "[BUFFER]"s value equal to preceding sub-processings outputs',
	'php-code'=>'PHP Code'
);
$HIS_JOB_STATUS=array(
	'new'=>'new',
	'running'=>'running',
	'paused'=>'paused',
	'done'=>'done',
	'failed'=>'failed'
);
$HIS_JOB_TYPES=array(
	'batch-shell-script'=>'Batch/Shell Script'
);
$HIS_OUTPUT_TYPES=array(
	'print-value'=>'Print value (default if none is selected)',
	'http-connection'=>'HTTP connection',
	'database-connection'=>'Database connection',
	'file-storage-connection'=>'File storage connection',
	'message-queue-connection'=>'Message Queue connection',
	'send-email'=>'Send E-Mail'
);
$HIS_PROCESSING_TYPES=array(
	'filter-regex'=>'needs further filtering - use regular expression',
	'filter-split-string'=>'needs further filtering - split using string delimiter',
	'filter-split-regex'=>'needs further filtering - split using regular expression',
	'filter-xpath'=>'needs further filtering - use xpath expression',
	'filter-string-formatter'=>'needs further filtering - use string format specifier',
);
$HIS_CONDITIONS=array(
	'perfectly'=>'working perfectly',
	'partially-raw'=>'data is still partially raw (contains HTML), needs further adjustment',
	'reported-not-working'=>'reported as not working',
	'might-not-be-working'=>'might not be working',
	'not-working'=>'not working',
	'being-worked-on'=>'being worked on',
	'not-being-worked-on'=>'not being worked on',
	'too-difficult-to-fix'=>'too difficult to fix',
	'target-using-obfuscation'=>'target is using obfuscation',
	'no-hf_resources-available'=>'no resources available',
	'needs-to-be-checked-by-qa'=>'needs to be checked by QA',
	'just-an-idea'=>'just an idea - do not do yet',
	'automatic-failure-detection'=>'Automatic Function Failure Detection - Broken Functions'
);
$HIS_OPERATION_TYPES=array(
	'read-non-html'=>'read as text, non-html',
	'urlencode'=>'urlencode',
	'double-urlencode'=>'double urlencode',
	'urldecode'=>'urldecode',
	'treat-as-integer'=>'treat as integer',
	'treat-as-float'=>'treat as floating point number',
	'double-urldecode'=>'double urldecode',
	'keywdreppass'=>'keyword replacement pass',
	'prepend-and-append'=>'prepend and append',
	'replace'=>'replace',
	'erase'=>'erase (set equal to "")',
	'prepend-and-append-file'=>'prepend and append file contents',
	'replace-using-regex'=>'replace using regular expression',
	'format-with-string-specifier'=>'format with string specifier',
	'html-entities'=>'encode ALL possible &lt; HTML characters into applicable HTML entities (&amp;lt;)',
	'html-entity-decode'=>'decode ALL possible &amp;lt; characters into applicable HTML characters (&lt;)',
	'trim'=>'trim',
	'htmlspecialchars'=>'htmlspecialchars (UTF-8 encoded, XML+Quotes, &lt; converts to &amp;lt;)',
	'htmlspecialchars-decode'=>'htmlspecialchars-decode (XML+Quotes, &amp;lt; converts to &lt;)',
	'strtoupper'=>'Convert to upper case',
	'strtolower'=>'Convert to lower case',
	'base64-encode'=>'Encode as base64',
	'base64-decode'=>'Decode base64'
);
$HIS_IRESOURCE_TYPES=array(
	'remote-wget'=>'HTML Raw (Remote wget)',
	'remote-imacros'=>'HTML DOM (Remote iMacros)',
	'remote-imacros-simple'=>'HTML Simple DOM (Remote iMacros)',
	'remote-win-batch'=>'Windows Batch File (Remote)',// (inc. local folder svn, git, imap, wget, iMacros, WinSCP references)',
	'remote-shell'=>'Linux/Unix Shell Script (Remote)',
	'remote-cygwin'=>'Cygwin (Remote)',
	'remote-text'=>'Text',
	'remote-sftp'=>'SFTP (Remote)',
	'remote-ftp'=>'FTP (Remote)',
	'remote-scp'=>'SCP (Remote)',
	'remote-winscp'=>'WinSCP (Remote)',
	'remote-ssh'=>'SSH (Remote)',
	'remote-torrent'=>'Torrent (Remote)',
	'remote-awk'=>'awk/gawk (Remote)',
	'remote-ttsraw'=>'Text to Speech [Festival TTS Linux] - Raw Text to Speak (Remote)',
	'remote-ttsurl-reference'=>'Text to Speech [Festival TTS Linux] - URL Containing Text (Remote)',
	'remote-cvs'=>'CVS Checkout (Remote)',
	'remote-upload'=>'Per-Instance File Upload (Remote)',
	'remote-imap'=>'E-Mail Read through IMAP Connection (Remote)',//(Example: imap[s]://user:pass@example-server.com:999/Inbox/NOT SEEN)',
	'remote-email-outgoing'=>'E-Mail - Outgoing (Remote)',
	'remote-mysql'=>'MySQL Database Connection/Function (Remote)',
	'remote-imacros-download'=>'Web Browsing Session File Download (Remote iMacros)',
	'remote-phone-call-outgoing-twilio'=>'Phone Call - Outgoing (Remote)',
	'remote-phone-call-incoming-twilio'=>'Phone Call - Incoming (Remote)',
	'remote-faxin-godaddy-fax-outgoing'=>'Fax - Outgoing (Remote)',
	'remote-faxout-godaddy-fax-incoming'=>'Fax - Incoming (Remote)',
	'remote-smsout-twilio'=>'SMS - Outgoing (Remote)',
	'remote-smsin-twilio'=>'SMS - Incoming (Remote)',
	'remote-snailmail-postalmethods'=>'Snail Mail - Outgoing (Remote)',
	'remote-his-hf'=>'Human Intelligence System Function (Remote)',
	'remote-hit-amazon'=>'Amazon Human Intelligence Task (Remote)',
	'remote-py2.3'=>'Compile & Run: Python 2.3 Script',
	'remote-py2.4'=>'Compile & Run: Python 2.4 Script',
	'remote-py2.5'=>'Compile & Run: Python 2.5 Script',
	'remote-py2.6'=>'Compile & Run: Python 2.6 Script',
	'remote-py2.7'=>'Compile & Run: Python 2.7 Script',
	'remote-py3.0'=>'Compile & Run: Python 3.0 Script',
	'remote-py3.1'=>'Compile & Run: Python 3.1 Script',
	'remote-py3.2'=>'Compile & Run: Python 3.2 Script',
	'remote-perl5.12'=>'Compile & Run: Perl 5.12 Script',
	'remote-perl'=>'Compile & Run: Perl 5.12 Script',
	'remote-vb.net-vbnc'=>'Compile & Run: Visual Basic.NET 2008',
	'remote-c#.net'=>'Compile & Run: C#.NET 2008',
	'remote-gcc'=>'Compile & Run: C (compiled with gcc)',
	'remote-g++'=>'Compile & Run: C++ (compiled with g++)',
	'remote-java6'=>'Compile & Run: Java 6',
	'remote-java7'=>'Compile & Run: Java 7',
	'remote-java'=>'Compile & Run: Java (Java7)',
	'remote-php5.4'=>'Compile & Run: PHP 5.4 Script',
	'remote-php5'=>'Compile & Run: PHP 5 Script',
	'remote-php'=>'Compile & Run: PHP Script (PHP5)',
	'remote-assy32-nasm-linux-32-intel'=>'Compile & Run: Assembly (nasm, linux x86, Intel)',
	'remote-assy64-nasm-linux-64'=>'Compile & Run: Assembly (nasm, linux x64)',
	'remote-TeX'=>'TeX',
	'remote-matlab'=>'MATLAB',
	'remote-sage'=>'Sage',
	'remote-fortran'=>'Fortran',
	'remote-ampl'=>'AMPL',
	'remote-r'=>'R',
	'remote-vbscript'=>'VBScript',
	'remote-lisp'=>'Lisp',
	'remote-haskell'=>'Haskell',
	'remote-prolog'=>'Prolog',
	'remote-ruby'=>'Ruby',
	'remote-tcl'=>'Tcl',
	'remote-scheme'=>'Scheme',
	'remote-smalltalk'=>'Smalltalk',
	'remote-dart'=>'Dart',
	'remote-winbatch'=>'Winbatch',
	'remote-libxslt'=>'libxslt (Remote)',
	'remote-xslfo'=>'XSL-FO (Remote)',
	'remote-helium'=>'Helium Scraper Custom Template Export (Remote Helium Scraper)',
);
$HIS_IRESOURCE_EXAMPLES=array(
	'remote-wget'=>'http://google.com',
	'remote-imacros'=>'VERSION BUILD=7511734
TAB T=1
TAB CLOSEALLOTHERS
SET !EXTRACT_TEST_POPUP NO
SET !ENCRYPTION NO
URL GOTO=http://battlelog.battlefield.com/bf3/gate/
TAG POS=1 TYPE=LABEL FORM=ID:gate-form ATTR=TXT:Origin*<SP>Account<SP>E-mail
TAG POS=1 TYPE=INPUT:TEXT FORM=ID:gate-form ATTR=ID:gate-form-email CONTENT={login}
TAG POS=1 TYPE=INPUT:PASSWORD FORM=ID:gate-form ATTR=ID:gate-form-password CONTENT={pw}
TAG POS=1 TYPE=INPUT:SUBMIT FORM=ID:gate-form ATTR=VALUE:Sign<SP>in
TAG POS=1 TYPE=A ATTR=CLASS:main-loggedin-leftcolumn-active-soldier-name
WAIT SECONDS=5
TAG POS=1 TYPE=HTML ATTR=* EXTRACT=HTM
TAG POS=1 TYPE=A ATTR=CLASS:base-no-ajax
SAVEAS TYPE=EXTRACT FOLDER={JOB_FOLDER} FILE=*',
	'remote-imacros-simple'=>'http://google.com',
	'remote-win-batch'=>'echo "HI";<br/>ipconfig /all',
	'remote-shell'=>'echo "HI";ifconfig',
	'remote-cygwin'=>'gcc hello.c -o hello.exe
./hello.exe',
	'remote-text'=>'hello world',
	'remote-sftp'=>'SFTP (Remote)',
	'remote-ftp'=>'FTP (Remote)',
	'remote-scp'=>'SCP (Remote)',
	'remote-winscp'=>'WinSCP (Remote)',
	'remote-ssh'=>'SSH (Remote)',
	'remote-torrent'=>'Torrent (Remote)',
	'remote-awk'=>'awk/gawk (Remote)',
	'remote-tts-raw'=>'This is hello world in spoken language.',
	'remote-tts-reference'=>'http://example.com/path/to/your/readable/spoken-text-file.txt',
	'remote-cvs'=>'CVS Checkout (Remote)',
	'remote-upload'=>'Per-Instance File Upload (Remote)',
	'remote-imap'=>'E-Mail Read through IMAP Connection (Remote)',//(Example: imap[s]://user:pass@example-server.com:999/Inbox/NOT SEEN)',
	'remote-email-outgoing'=>'E-Mail - Outgoing (Remote)',
	'remote-mysql'=>'MySQL Database Connection/Function (Remote)',
	'remote-imacros-download'=>'Web Browsing Session File Download (Remote iMacros)',
	'remote-twilio-phone-call-outgoing'=>'Phone Call - Outgoing (Remote)',
	'remote-twilio-phone-call-incoming'=>'Phone Call - Incoming (Remote)',
	'remote-godaddy-fax-outgoing'=>'Fax - Outgoing (Remote)',
	'remote-godaddy-fax-incoming'=>'Fax - Incoming (Remote)',
	'remote-twilio-sms-outgoing'=>'SMS - Outgoing (Remote)',
	'remote-twilio-sms-incoming'=>'SMS - Incoming (Remote)',
	'remote-postalmethods-snail-mail'=>'Snail Mail - Outgoing (Remote)',
	'remote-amazon-hit'=>'Amazon Human Intelligence Task (Remote)',
	'remote-his-hf'=>'http://your-website.com/his/s=facebook,list,friends&user=me@me.com&pass=test',
	'remote-py-2.3'=>'print "hello world"
for i in range(1,11):
    print str(i)',
	'remote-py-2.4'=>'print "hello world"
for i in range(1,11):
    print str(i)',
	'remote-py-2.5'=>'print "hello world"
for i in range(1,11):
    print str(i)',
	'remote-py-2.6'=>'print "hello world"
for i in range(1,11):
    print str(i)',
	'remote-py-2.7'=>'print "hello world"
for i in range(1,11):
    print str(i)',
	'remote-py-3.0'=>'Compile & Run: Python 3.0 Script',
	'remote-py-3.1'=>'Compile & Run: Python 3.1 Script',
	'remote-py-3.2'=>'Compile & Run: Python 3.2 Script',
	'remote-perl-5.12'=>'print "hello world\\n";',
	'remote-perl'=>'print "hello world\\n";',
	'remote-vb.net-vbnc'=>'Console.WriteLine("Hello world")
For x = 0 to 10
    Console.WriteLine(x)
Next x',
	'remote-c#.net'=>'class HelloWorld
{
    static void Main()
    {
        System.Console.WriteLine("Hello world");
    }
}',
	'remote-gcc'=>'#include <stdio.h>
int main()
{
    printf("hello world\\n");
    return 0;
}',
	'remote-g++'=>'#include <iostream>
int main()
{
    std::cout << "Hello World!\\n";
    return 0;
}',
	'remote-java6'=>'public class HelloWorld
{
    public static void main(String[] args)
    {
        System.out.println("hello world");
    }
}',
	'remote-java7'=>'public class HelloWorld
{
    public static void main(String[] args)
    {
        System.out.println("hello world");
    }
}',
	'remote-java'=>'public class HelloWorld
{
    public static void main(String[] args)
    {
        System.out.println("hello world");
    }
}',
	'remote-php5.4'=>'echo "hello world";
for ($i=0;$i<10;$i++)
{
    echo $i."\\n";
}',
	'remote-php5'=>'echo "hello world";
for ($i=0;$i<10;$i++)
{
    echo $i."\\n";
}',
	'remote-php'=>'echo "hello world";
for ($i=0;$i<10;$i++)
{
    echo $i."\\n";
}',
	'remote-assembly-nasm-linux-32-intel'=>'section .data
msg  db    "hello world",0x0a

len  equ   $-msg

section .text
    global _start

_start:

    mov    ebx,0x01
    mov    ecx,msg
    mov    edx,len
    mov    eax,0x04
    int    0x80

    mov    ebx,0x00
    mov    eax,0x01
    int    0x80

',
	'remote-assembly-nasm-linux-64'=>'; 64-bit Hello World in Linux NASM

global _start    ; global entry point for ld

section .text
_start:

    ; sys_write(stdout,message,length)

    mov    rax,1        ; sys_write
    mov    rdi, 1       ; stdout
    mov    rsi, message ; message address
    mov rdx, length     ; message string length
    syscall

    ; sys_exit(return_code)

    mov    rax, 60      ; sys_exit
    mov    rdi, 0       ; return 0 (success)

section .data
    message: db \'hello, world!\',0x0A    ; message and newline
    length:    equ    $-message           ; NASM definition pseudo-instruction
',
	'remote-tex'=>'\\documentclass{article}
\\begin{document}
hello world
\\end{document}',
	'remote-matlab'=>'MATLAB',
	'remote-sage'=>'Sage',
	'remote-fortran'=>'Fortran',
	'remote-ampl'=>'AMPL',
	'remote-r'=>'R',
	'remote-vbscript'=>'VBScript',
	'remote-lisp'=>'(print "hello world")',
	'remote-haskell'=>'module Main where

main = putStrLn "hello, world"',
	'remote-prolog'=>'Prolog',
	'remote-ruby'=>'puts "hello world"
for i in 1..10
    puts i
end
(1..10).each { |i|
    puts i
}

',
	'remote-tcl'=>'Tcl',
	'remote-scheme'=>'(display "hello world")
(newline)',
	'remote-smalltalk'=>'Transscript show:\'hello world\';cr',
	'remote-dart'=>'Dart',
	'remote-winbatch'=>'Winbatch',
	'remote-libxslt'=>'libxslt (Remote)',
	'remote-xslfo'=>'XSL-FO (Remote)',
	'remote-helium'=>'Helium Scraper Custom Template Export (Remote Helium Scraper)',
);
$HIS_WAIT_TYPES=array(
	"0" => "Respond instantly to GET/POST requests (see \"Output Expressions\" page)",
	"1" => "Respond to GET/POST requests when HIS Function finishes processing",
);
$HIS_MIME_TYPES=array(
	'text/xml'=>'xml',
	'text/plain'=>'txt',
	'text/csv'=>'csv',
	'text/tab-separated-values'=>'tsv',
	'text/css'=>'css',
	'text/html'=>'html',
	'text/vcard'=>'vcard',
	'application/x-www-form-urlencoded'=>'form',
	'application/x-dvi'=>'dvi',
	'application/x-latex'=>'tex',
	'application/x-font-ttf'=>'ttf',
	'application/x-shockwave-flash'=>'swf',
	'application/x-stuffit'=>'sit',
	'application/x-rar-compressed'=>'rar',
	'application/x-tar'=>'tar',
	'text/x-gwt-rpc'=>'xgr',
	'application/x-javascript'=>'js',
	'text/x-jquery-tmpl'=>'js',
	'application/vnd.oasis.opendocument.text'=>'',
	'application/vnd.oasis.opendocument.spreadsheet'=>'',
	'application/vnd.oasis.opendocument.presentation'=>'',
	'application/vnd.oasis.opendocument.graphics'=>'',
	'application/vnd.ms-excel'=>'xls',
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'=>'',
	'application/vnd.ms-powerpoint'=>'ppt',
	'application/vnd.openxmlformats-officedocument.presentationml.presentation'=>'',
	'application/msword'=>'doc',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document'=>'',
	'application/vnd.mozilla.xul+xml'=>'',
	'application/vnd.google-earth.kml+xml'=>'',
	'multipart/mixed'=>'',
	'multipart/alternative'=>'',
	'multipart/related'=>'',
	'multipart/form-data'=>'',
	'multipart/signed'=>'',
	'multipart/encrypted'=>'enc',
	'model/example'=>'',
	'model/iges'=>'iges',
	'model/mesh'=>'mesh',
	'model/vrml'=>'vrml',
	'model/x3d+binary'=>'',
	'model/x3d+vrml'=>'',
	'model/x3d+xml'=>'',
	'message/http'=>'',
	'message/imdn+xml'=>'',
	'message/partial'=>'',
	'message/rfc822'=>'',
	'image/svg+xml'=>'svg',
	'image/gif'=>'gif',
	'image/jpeg'=>'jpg',
	'image/pjpeg'=>'pjpg',
	'image/png'=>'png',
	'image/tiff'=>'tiff',
	'image/vnd.microsoft.icon'=>'ico',
	'application/atom+xml'=>'atom',
	'application/ecmascript'=>'ecma',
	'application/EDI-X12'=>'edx',
	'application/EDIFACT'=>'edi',
	'application/json'=>'json',
	'application/javascript'=>'js',
	'application/octet-stream'=>'oct',
	'application/ogg'=>'ogg',
	'application/pdf'=>'pdf',
	'application/postscript'=>'ps',
	'application/rss+xml'=>'rss',
	'application/soap+xml'=>'soap',
	'application/font-woff'=>'fwf',
	'application/xhtml+xml'=>'html',
	'application/xml-dtd'=>'dtd',
	'application/xop+xml'=>'xop',
	'application/zip'=>'zip',
	'application/x-gzip'=>'gz',
	'audio/mpeg3'=>'mp3',
	'audio/x-mpeg-3'=>'mp3',
	'audio/mpeg'=>'mpg',
	'audio/wav'=>'wav'
);

$STATIC=array();
global $STATIC;
$STATIC['match_types']=$HIS_MATCH_TYPES;
$STATIC['hfpvc_types']=$HIS_HFPVC_TYPES;
$STATIC['action_types']=$HIS_ACTION_TYPES;
$STATIC['job_status']=$HIS_JOB_STATUS;
$STATIC['job_types']=$HIS_JOB_TYPES;
$STATIC['output_types']=$HIS_OUTPUT_TYPES;
$STATIC['processing_types']=$HIS_PROCESSING_TYPES;
$STATIC['conditions']=$HIS_CONDITIONS;
$STATIC['operation_types']=$HIS_OPERATION_TYPES;
$STATIC['hf_resource_types']=$HIS_IRESOURCE_TYPES;
$STATIC['hf_resource_examples']=$HIS_IRESOURCE_EXAMPLES;
$STATIC['mime_types']=$HIS_MIME_TYPES;
$STATIC['wait_types']=$HIS_WAIT_TYPES;

// SET STATIC['languages'] and more...
include("translation.php");







$BIN_DIR=__dir__;

$PATH_SEPERATOR="/";
if ( strpos(php_uname('s'),"nux")===false)
{
		$PATH_SEPERATOR="\\";
}

$settings_file=($BIN_DIR.$PATH_SEPERATOR."his-config.php");
if ( !file_exists($settings_file)  )
{
	$settings_file=(dirname($BIN_DIR).$PATH_SEPERATOR."his-config.php");
}

if ( file_exists($settings_file) )
{
	include_once($settings_file);
}
else
{
	if ( PHP_SAPI !== 'cli' && strpos($_SERVER['REQUEST_URI'],"install.php")===false)
	{
		include("view.menu.public.php");
		include("view.public.php");
		exit;
	}
}


$APP=array();
$APP['db']=false;
$APP['fs']=false;
$APP['ms']=false;

include_once("model.database.php");
if ( file_exists($settings_file) )
{
	include_once($settings_file);
	$GLOBALS['settings']=$settings;

	
	include_once("model.storage.php");
	$db = new Settings_Database_Adapter($settings);
	$db=$db->database;
	$db->debug=false;
	$APP['db']=$db;
	if (!$db->connect())
	{
		include("templates/existsmessage.php");
		exit;
	}
	
	include_once("model.storage.php");
	$fs = new Settings_Storage_Adapter($settings);
	$fs=$fs->storage;
	$APP['fs']=$fs;
	if (!$fs->connect())
	{
		include("templates/existsmessage.php");
		exit;
	}
	
	include_once("model.message.php");
	$ms = new Settings_Message_Adapter($settings);
	$ms=$ms->messenger;
	$APP['ms']=$ms;


}

/// SERVICES
$services_file=$BIN_DIR.$PATH_SEPERATOR."services.xml";
$service_doc = xmlToArray( simplexml_load_file($services_file) );
$services=array();
foreach ($service_doc as $services_list)
{
	foreach ($services_list as $service)
	{
		$new_service=new Service($service);
		$services[]=$new_service;
	}
}


//$GLOBALS['settings']=$settings;
$APP['services']=$services;
$GLOBALS['APP']=$APP;
global $APP;











class his
{
	public $obj_key_type='hash';
	public $obj_version;
	public function __construct()
	{
		global $software_version;
		$this->obj_version = $software_version;
	}
	public function create_from_xml_array($data)
	{
		$this->fromobjectxml($data);
	}
	public function rcreate($props,$mode_raw=false)
	{
		$this->create($props,$mode_raw);
	}
	public function member_value_array()
	{
		$retval=array();
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			$retval[$member]=$this->$member;
		}
		return $retval;
	}
	public function fromobjectxml($data)
	{
		// data is an array'd xml

		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ( isset($data['@attributes'][$member]) )
			{
				//echo "setting $member equal to ".($data['@attributes'][$member]);
				//echo "<br/>";
				if ($member!="str_file")
				{
					$this->$member = html_entity_decode($data['@attributes'][$member],ENT_XML1,"UTF-8");
				}
				else
				{
					$this->$member = base64_decode($data['@attributes'][$member]);
				}
			}
			else
			{
				if (is_array($data) && array_key_exists($member,$data['@attributes']))
				{
					if ( strpos($member,"int_")===0)
					{
						$this->$member="0";
					}
					else
					{
						$this->$member="";
					}
				}
				else
				{
					//echo "unable to find $member";
					//echo "<br/>";
					//print_r($data);
				}
			}
		}
	}
	public function toobjectxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			$member_val = $this->$member;
			$member_vals= toxmlvalue($this->$member);
			//$member_val = htmlentities($this->$member, ENT_DISALLOWED|ENT_XML1, "UTF-8");
			$localprops=$localprops." $member='".$member_val."'";
		}
		$retval="<".get_class($this).$localprops.">";
		//$retval = $retval.var_export($this,true);
		$retval=$retval."</".get_class($this).">\n";
		//echo $retval;
		return $retval;
	}
	public function send($queue,$data)
	{
		global $APP;
		$queue_name=$APP['ms']->queue_prefix."".get_class($this)."_".$queue;
		//echo "sending data to queue: ".$queue_name;
		$APP['ms']->send_message($queue_name,$data);
	}
	public function receive($queue)
	{
		global $APP;
		return $APP['ms']->read_message($APP['ms']->queue_prefix."".get_class($this)."_".$queue);
	}
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0) continue;
			$localprops=$localprops." $member='".toxmlvalue($this->$member)."'";
		}
		if (!$this->obj_inherited)
		{
			$retval="<".get_class($this).$localprops.">";
			$retval=$retval."</".get_class($this).">\n";
		}
		return $retval;
	}
	public $obj_debug=false;
	public function build($obj_build_exclude=array())
	{
		global $APP;
		//echo "BUILDING...\n";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ( strpos( $member, "str_")!==FALSE )
			{
				$obj_prop=str_replace("str_","obj_",$member);
				//echo "building $obj_prop\n";
				$this->$obj_prop=new strings();
				$hash_id=$this->$member;
				$this->$obj_prop->get_from_hashrange( $hash_id );
				if ($this->$obj_prop->id=='undefined' || in_array($obj_prop,$obj_build_exclude) )
				{
					//echo "SKIPPING $obj_prop";
					$this->$obj_prop=false;
				}
				else
				{
					$this->$obj_prop->build($obj_build_exclude);
				}
			}
		}
	}
	public function create_raw($props)
	{
		$this->create($props,true);
	}
	public function set($props)
	{
		$props=$this->remove_non_members($props);
		foreach ($props as $prop_key=>$prop_value)
		{
			$this->$prop_key=$prop_value."";
		}
	}
	public function delete()
	{
		global $APP;
		$member_list=$this->member_list($this);
		$first_member=$member_list[0];

		$select_conditions=array();

		$select_condition=new SelectComparison();
		$select_condition->field=$first_member;
		$select_condition->comparison="EQUAL";
		$select_condition->value=$this->$first_member;
		$select_conditions[]=$select_condition;
		if ($this->obj_key_type=="hashrange")
		{
				$second_member=$member_list[1];
				$select_condition=new SelectComparison();
				$select_condition->field=$second_member;
				$select_condition->comparison="EQUAL";
				$select_condition->value=$this->$second_member;
				$select_conditions[]=$select_condition;
		}
		
		foreach ($member_list as $each_member)
		{
			if (strpos($each_member,"str_")===0)
			{
				$obj_member = str_replace("str_","obj_",$each_member);
				if ( isset($this->$obj_member) && $this->$obj_member)
				{
					$this->$obj_member->delete();
				}
			}
		}

		if ($this->obj_debug)
		{
			$APP['db']->debug=true;
		}
		$APP['db']->delete(get_class($this),$select_conditions);
	}
	public function create($props,$mode_raw=false)
	{
		global $APP;
		if ($this->obj_debug)
		{
			//echo "before remove";
			//print_r($props);
		}
		$props=$this->remove_non_members($props);
		if ($this->obj_debug)
		{
			//echo "after remove";
			//print_r($props);
		}
		$props_keys=array_keys($props);
		for($i=0;$i<count($props_keys);$i++)
		{
			$prop_key=$props_keys[$i];
			if ( strlen(trim($prop_key))==0)
			{
				continue;
			}
			$prop_val=$props[$props_keys[$i]];
			if (!$mode_raw)
			{
				$prop_val=$this->special_storage($prop_key,$prop_val);
				$props[$prop_key]=$prop_val;
			}
		}
		if ($this->obj_debug)
		{
			echo "<pre>";
			echo "CREATE()<br/>";
			//echo "PROPS:<br/>";
			//print_r($props);
			$APP['db']->debug=true;
		}
		$APP['db']->insert(get_class($this),$props);
		foreach ($props as $prop_key=>$prop_val)
		{
			//$prop_val=str_replace("'","\'",$prop_val); // "'
			$this->$prop_key=$prop_val."";
		} // end foreach
		if ($this->obj_debug)
		{
			print_r($this);
		}
	} // end function
	public function hash_to_expression_tree($hash,$do_substitutions=true)
	{
		if ($hash=="undefined") return;
		if ( !isset($this->obj_expression) )
		{
			// $this->obj_expression=new stdClass();
			$this->obj_expression=new strings();
			$this->obj_expression->get_from_hashrange($hash);
			$this->obj_expression->build();
		}
		if ( isset($this->obj_hf_parameters) && isset($this->obj_expression) && isset($this->obj_expression->body) )
		{
			if ($do_substitutions)
			{
				$this->obj_expression->value=replace_hf_parameters($this->obj_expression->body,$this->obj_hf_parameters);
			}
			else
			{
				if ( isset($this->obj_expression) )
				{
					if ( isset($this->obj_expression->body) )
					{
						$this->obj_expression->value=$this->obj_expression->body;
					}
				}
				else
				{
				}
				//$this->obj_expression->value=$this->obj_expression->body;
			}
		}
		if ( isset($this->obj_expression) && !is_bool($this->obj_expression) && get_class($this->obj_expression)=="strings" )
		{
			$this->obj_expression->obj_match_customs=array();
			$match_custom=new match_custom();
			$all_customs = $match_custom->get_from_hashrange($hash);
			if ( $all_customs )
			{
				foreach ( $all_customs as $each_custom )
				{
					$a_custom= new match_custom();
					$a_custom->set( $each_custom );
					$a_custom->build();
					$this->obj_expression->obj_match_customs[$a_custom->idx_key]=$a_custom;
				}


			} // end if

			$this->obj_expression->obj_match_entries=array();
			$match_entry=new match_entry();
			$all_entries = $match_entry->get_from_hashrange($hash);
			if ( $all_entries )
			{
				foreach ( $all_entries as $each_entry )
				{
						$a_entry= new match_entry();
						$a_entry->set( $each_entry );
						$a_entry->build();
						$this->obj_expression->obj_match_entries[$a_entry->idx_id]=$a_entry;
				}
				usort($this->obj_expression->obj_match_entries, "mesort");

			} // end if
		}

	} // end function
	public function special_storage($prop_key,$prop_val)
	{
		global $APP;
		if ( strpos($prop_key,"str_") !== FALSE )
		{
			if ($this->obj_debug)
			{
				echo "In Special_storage function() for prop: $prop_key<br/><br/>";
			}
			$content_mime_type="text/plain";
			$content_extension="txt";

			$original_content_extension = $content_extension;


			$sha1_string=sha1(microtime().$prop_key.$prop_val.rand(3,5));
			$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".".$content_extension;
			$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
			$content_detection_info = get_mime_and_extension($prop_val);
			// GIVES MIME TYPE, EXTENSION
			$content_mime_type = $content_detection_info[0];
			$content_extension = $content_detection_info[1];

			if ( !stringEndsWith($keyname,$content_extension) )
			{
				$keyname = str_lreplace($original_content_extension,$content_extension,$keyname);
			}

			$APP['fs']->create_object(false,$bucket_name,$keyname,$prop_val,$content_mime_type);
			$string_url=$APP['fs']->key_url($bucket_name,$keyname);
			$sha1_string2=sha1($prop_key.microtime().$prop_val.rand(1,20));
			$props_string=array();
			$props_string['id']=$sha1_string2;
			$props_string['val']=$string_url;
			$new_string=new strings();
			$new_string->create($props_string);

			$prop_val=$sha1_string2;
		} // end if
		return $prop_val;
	} // end function
	public function update_raw($props)
	{
		$this->update($props,true);
	}
	public function remove_non_members($props)
	{
		$member_list=$this->member_list($this);
		$props_keys=array_keys($props);
		foreach ($props_keys as $prop_key)
		{
				$found_member=false;
				foreach ($member_list as $member)
				{
						if ($prop_key==$member)
						{
								$found_member=true;
								break;
						}
				}
				if (!$found_member)
				{
						unset($props[$prop_key]);
				}
		}
		return $props;
	}
	public function update($new_props,$mode_raw=false)
	{
		global $APP;
		if ( !is_array($new_props) )
		{
			echo "model.classes.php Update() function expects array as input";
		}
		if ($this->obj_debug)
		{
			echo "UPDATE called in class ".get_class($this);
			print_r($new_props);
			$APP['db']->debug=true;
		}
		$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
		$member_list=$this->member_list($this);
		$first_member=$member_list[0];
		$second_member="";
		if (!$mode_raw)
		{
			$new_props_keys=array_keys($new_props);
			for ($i=0;$i<count($new_props_keys);$i++)
			{
				$new_props[$new_props_keys[$i]]=$this->special_storage($new_props_keys[$i],$new_props[$new_props_keys[$i]]);
			}
		}
		$select_conditions=array();

		$select_condition=new SelectComparison();
		$select_condition->field=$first_member;
		$select_condition->comparison="EQUAL";
		$select_condition->value=$this->$first_member;
		$select_conditions[]=$select_condition;
		if ($this->obj_key_type=="hashrange")
		{
			$second_member=$member_list[1];
			$select_condition=new SelectComparison();
			$select_condition->field=$second_member;
			$select_condition->comparison="EQUAL";
			$select_condition->value=$this->$second_member;
			$select_conditions[]=$select_condition;
		}
		$APP['db']->update( get_class($this),$new_props,$select_conditions );
		foreach ($new_props as $new_prop_key=>$new_prop_val)
		{
			$this->$new_prop_key=$new_prop_val."";
		}
	}
	public function get_from_hashrange($hash,$range=false,$comparison="EQUAL",$count=0)
	{
		global $APP;
		// comparison == EQUAL or BEGINS_WITH
		if ($hash=="undefined")
		{
			return;
		}
		if ($range=="undefined")
		{
			return;
		}
		if ($this->obj_debug)
		{
			echo "Searching for hash: ".$hash;
			echo "<br/>";
			echo "in table: ".get_class($this);
			echo "<br/>";
			echo "range: ".$range;
			echo "<br/>";
			echo "Comparison: ".$comparison;
			echo "<br/>";
			echo "Count: ".$count;
			echo "<br/>";
			echo "<br/>";
		}
		$member_list=$this->member_list($this);
		$the_members=array();
		foreach ($member_list as $member_name)
		{
			$the_members[$member_name]=$member_name;
		}
		$the_members=$this->remove_non_members($the_members);
		$the_member_keys=array_keys($the_members);
		$select_props=array();
		$new_comparison=new SelectComparison();
		$new_comparison->field=$the_member_keys[0];
		$new_comparison->comparison="EQUAL";
		$new_comparison->value=$hash;
		$new_comparison->tabletype=$this->obj_key_type;
		$select_props[]=$new_comparison;
		if ( strlen($range)>0 )
		{
			$new_comparison=new SelectComparison();
			$new_comparison->field=$the_member_keys[1];
			$new_comparison->comparison=$comparison;
			$new_comparison->value=$range;
			$new_comparison->tabletype=$this->obj_key_type;
			$select_props[]=$new_comparison;
		}
		if ($this->obj_debug)
		{
			$APP['db']->debug=true;
		}
		$retval=$APP['db']->select_table(get_class($this),$the_member_keys,$select_props,$count);
		//echo "CALLED by ".get_class($this)."<br/>";
		//echo "RETURNING:<br/>";
		//echo "<ul>";
		//echo "<pre>";
		//print_r($retval);
		//echo "<pre>";
		//echo "</ul>";
		if ($retval)
		{
			if ($this->obj_debug)
			{
				/*
				echo "result from hf:";
				print_r($retval);
				*/
			}
			foreach ($retval as $single)
			{
				$i=0;
				foreach ($single as $retval_key=>$retval_val)
				{
					if ($i==0)
					{
						if ($retval_val=="undefined")
						{
						}
					}
					$this->$retval_key=$retval_val."";
					$i=$i+1;
				}
			}
		}
		return $retval;
	}
	public function member_list($instance)
	{
		$retval=array();
		$class_name=get_class($instance);
		$reflector = new ReflectionClass($class_name);
		$properties = $reflector->getProperties();
		foreach($properties as $property)
		{
			$prop_name=$property->getName();
			if ( strpos($prop_name,"obj_")===FALSE )
			{
				$retval[]=$prop_name;
			}
		}
		return $retval;
	}
}
class hf_id_user extends his
{
	public $obj_key_type='hashrange';
	public $id_user= 'undefined';
	public $id = 'undefined';
	public $name= 'undefined';
	public $str_expression= 'undefined';
	public $id_condition= 'undefined';
	public $str_cache_out_xml= 'undefined';
	public $str_cache_out_cxml= 'undefined';
	public $str_cache_approved='undefined';
	public $str_cache_latest='undefined';
	public $str_cache_ad='undefined';
	public $id_mime_type= 'undefined';
	public $int_ws= '0';
	public $int_wait= '0';
	public $int_cleanup= '0';
	public $int_maxruntime= '0';
	public $int_mtf= '1';
	public $int_retry_count= '0';
	public $str_fastresponse= 'undefined';

	public function create($props,$mode_raw=false)
	{
		parent::create($props,$mode_raw);
		$this->refresh_assignments(true);
	}
	public function refresh_assignments($mode_create=true)
	{
		$id_user = $this->id_user;
		$assign_hfs = new assign_hf();
		$curr_assign_hfs = $assign_hfs->get_from_hashrange($id_user,$this->id,"BEGINS_WITH");
		if ($curr_assign_hfs && count($curr_assign_hfs)>0 )
		{
			foreach ($curr_assign_hfs as $curr_assign_hf)
			{
				$del_assign_hf = new assign_hf();
				$del_assign_hf->set($curr_assign_hf);
				if ($del_assign_hf->id_user!="undefined")
				{
					$del_assign_hf->delete();
				}
				$curr_assign_hf_split = explode("@",$curr_assign_hf['hf_server']);
				if ($curr_assign_hf_split)
				{
					$curr_svr=$curr_assign_hf_split[1];
					$curr_hf=$curr_assign_hf_split[0];
					$del_assign_svr = new assign_server();
					$del_assign_svr->get_from_hashrange( $id_user, $curr_svr.'@'.$curr_hf );
					if ($del_assign_svr->id_user!="undefined")
					{
						$del_assign_svr->delete();
					}
				}
			}
		}
		if (!$mode_create)
		{
			return;
		}

		$user_servers = new user_server();
		$server_list = $user_servers->get_from_hashrange($this->id_user);
		

		$list_of_eligible_servers=array();
		if ($server_list && is_array($server_list) )
		{
			foreach ($server_list as $server_entry)
			{
				$passed_filter=false;
				if (isset($this->obj_hf_node_filters) && $this->obj_hf_node_filters)
				{
					if ( count($this->obj_hf_node_filters)>0 )
					{
						$passed_filter=false;
						foreach ($this->obj_hf_node_filters as $node_filter)
						{
							if ( strpos($server_entry['name'],$node_filter->value)!==FALSE)
							{
								$passed_filter=true;
								break;
							}
						} // end foreach (each filter)
					} // end if (filter count)
					else
					{
						$passed_filter=true;
					}
				}
				else
				{
					$passed_filter=true;
				}
			
				if ($passed_filter)
				{
					if (isset($this->obj_hf_system_kind) && $this->obj_hf_system_kind)
					{
						$found_matched_sk=false;
						foreach ($this->obj_hf_system_kind as $hsk)
						{
							if ($hsk->id_sk==$server_entry['id_sk']||$hsk->id_sk=="any")
							{
								if (!isset($hsk->obj_enabled) || (isset($hsk->obj_enabled) && $hsk->obj_enabled) )
								{
									$found_matched_sk=true;
									break;
								}
							}
						}
						if ( count($this->obj_hf_system_kind) == 0 )
						{
							$found_matched_sk=true;
						}
						if (!$found_matched_sk)
						{
							$passed_filter=false;
						}
					}
				}
		
				if ($passed_filter)
				{
					$new_assign_hf = new assign_hf();
					$new_assign_hf->create( array("id_user"=>$id_user,"hf_server"=>$this->id."@".$server_entry['name'] ) );
					$new_assign_svr = new assign_server();
					$new_assign_svr->create( array("id_user"=>$id_user,"server_hf"=>$server_entry['name']."@".$this->id ) );
				} // end if (passed filter)
				else
				{
				}
			} // end for
		} // end if (any servers)
	} // end function

	public function delete($recursive=false)
	{
		global $u;
		$this->refresh_assignments(false);
		if ($recursive)
		{
			$this->build();
		}
		if ($recursive)
		{
			$user_inherit = new user_inherit();
			$user_inherit->get_from_hashrange($u->id_user,$this->id);
			// handled by str_/obj_ auto deletion
			//$this->obj_expression->delete();
			if ($user_inherit->id_hf!="undefined")
			{
				$user_inherit->delete();
			}
			foreach ($this->obj_hf_inherit as $inherit)
			{
				if ($inherit->id_hf==$this->id)
				{
					$inherit->delete();
				}
			}

			$all_hf=new hf_id_user();
			$all_hfs=$all_hf->get_from_hashrange($this->id_user);
			foreach ($all_hfs as $each_hf)
			{
				$all_hfi=new hf_inherit();
				$all_hfis=$all_hfi->get_from_hashrange($each_hf['id']);
				foreach ($all_hfis as $each_hfi)
				{
					if ($each_hfi['id']!="undefined")
					{
						if ($each_hfi['id_inherit']==$this->id)
						{
							$delete_hfi=new hf_inherit();
							$delete_hfi->set($each_hfi);
							if ($delete_hfi->id!="undefined")
							{
								$delete_hfi->delete();
							}
						}
					}
				} // END FOREACH
			} // END FOREACH
			
			foreach ($this->obj_hf_parameters as $param)
			{
				if ($param->id_hf==$this->id)
				{
					$param->delete();
				}
			}
			foreach ($this->obj_hf_node_filters as $filter)
			{
				if ($filter->id_hf==$this->id)
				{
					$filter->delete();
				}
			}
			foreach ($this->obj_hf_tags as $tag)
			{
				if ($tag->id_hf==$this->id)
				{
					$tag->delete();
				}
			}
			foreach ($this->obj_hf_outputs as $output)
			{
				if ($output->id_hf==$this->id)
				{
					$output->delete();
				}
			}
			foreach ($this->obj_hf_files as $afile)
			{
				if ($afile->id_hf==$this->id)
				{
					$afile->delete();
				}
			}
			foreach ($this->obj_hf_kill as $akill)
			{
				if ($akill->id_hf==$this->id)
				{
					$akill->delete();
				}
			}
			foreach ($this->obj_hf_resources as $res)
			{
				if ($res->id_hf==$this->id)
				{
					foreach ($res->obj_system_kinds as $sk)
					{
						$sk->delete();
					}
					$res->delete();
				}
			}
			foreach ($this->obj_hf_system_kind as $sk)
			{
				if ($sk->id_hf==$this->id)
				{
					$sk->delete();
				}
			}
		}
		parent::delete();
	}
	public function toxml($first=false)
	{
		global $u;
		global $software_version;
		$retval="";
		if ($this->obj_hf_inherit)
		{
			if (count($this->obj_hf_inherit)>0)
			{
				if ($first)
				{
					$retval=$retval."<hf_id_users>\n";
				}
			}
		}

		foreach ($this->obj_hf_inherit as $hf_inherit)
		{
			$inherited_hf = new hf_id_user();
			$inherited_hf->get_from_hashrange($this->id_user,$hf_inherit->id_inherit);
			$inherited_hf->build(array(),false);
			//echo "<pre>";
			//print_r($inherited_hf);
			$retval=$retval.$inherited_hf->toxml();
		}

		//echo "<pre>";
		//echo str_replace("<","&lt;",var_export($this,true));
		$member_list=$this->member_list($this);
		$localprops="";


		$localprops=$localprops." version='$software_version'";

		$inheritable_prop = "";
		$user_inherits = new user_inherit();
		$user_inherits->get_from_hashrange($u->id_user,$this->id);
		if ($user_inherits->id_hf!="undefined")
		{
			$inheritable_prop=" bool_inheritable='true'";
		}
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id") continue;
			if (strpos($member,"str_")===0) continue;
			$member_value=$this->$member;
			if ( intval($member_value)."" == $member_value."" )
			{
				$localprops=$localprops." $member='".$member_value."'";
			}
			else
			{
				$localprops=$localprops." $member='".toxmlvalue($this->$member)."'";
			}
		}
		$retval=$retval."<".get_class($this).$inheritable_prop.$localprops.">\n";
		
		//$retval=$retval."\t<hf_expressions>\n";
		//foreach ($this->obj_exprssion as $hf_expression)
		//{
			$retval=$retval.$this->obj_expression->toxml(True);
		//}
		//$retval=$retval."\t</hf_expressions>\n";

		$retval=$retval."\t<hf_parameters>\n";
		foreach ($this->obj_hf_parameters as $hf_param)
		{
			$retval=$retval.$hf_param->toxml();
		}
		$retval=$retval."\t</hf_parameters>\n";
		
		$retval=$retval."\t<hf_resources>\n";
		foreach ($this->obj_hf_resources as $hf_resource)
		{
			$retval=$retval.$hf_resource->toxml();
		}
		$retval=$retval."\t</hf_resources>\n";

		$retval=$retval."\t<hf_node_filters>\n";
		foreach ($this->obj_hf_node_filters as $hf_node_filters)
		{
			$retval=$retval.$hf_node_filters->toxml();
		}
		$retval=$retval."\t</hf_node_filters>\n";
		

		$retval=$retval."\t<hf_tags>\n";
		foreach ($this->obj_hf_tags as $hf_tags)
		{
			$retval=$retval.$hf_tags->toxml();
		}
		$retval=$retval."\t</hf_tags>\n";
		
		$retval=$retval."\t<hf_files>\n";
		foreach ($this->obj_hf_files as $hf_files)
		{
			$retval=$retval.$hf_files->toxml();
		}
		$retval=$retval."\t</hf_files>\n";
		
		$retval=$retval."\t<hf_kills>\n";
		foreach ($this->obj_hf_kill as $hf_kill)
		{
			$retval=$retval.$hf_kill->toxml();
		}
		$retval=$retval."\t</hf_kills>\n";
	
		$retval=$retval."\t<hf_inherits>\n";
		foreach ($this->obj_hf_inherit as $hf_inherit)
		{
			$retval=$retval.$hf_inherit->toxml();
		}
		$retval=$retval."\t</hf_inherits>\n";

		$retval=$retval."\t<hf_system_kinds>\n";
		foreach ($this->obj_hf_system_kind as $hf_system_kind)
		{
			$retval=$retval.$hf_system_kind->toxml();
		}
		$retval=$retval."\t</hf_system_kinds>\n";
	

		$retval=$retval."</".get_class($this).">\n";
		
		if ($this->obj_hf_inherit)
		{
			if (count($this->obj_hf_inherit)>0)
			{
				if ($first)
				{
					$retval=$retval."</hf_id_users>";
				}
			}
		}

		return $retval;
	}
	public function rcreate($props,$mode_raw=false)
	{
		global $u;

		$this->create($props,true);
		if ( isset($this->obj_bool_inheritable) )
		{
			if ($this->obj_bool_inheritable)
			{
				$new_user_inherit = new user_inherit();
				$props2=array("id_user"=>$u->id_user,"id_hf"=>$props['id']);
				$new_user_inherit->create( $props2 );
			}
		}

		foreach ($this->obj_hf_parameters as &$param)
		{
			$param->rcreate($param->member_value_array());
		}
		foreach ($this->obj_hf_inherit as &$inherit)
		{
			$inherit->rcreate($inherit->member_value_array());
		}
		foreach ($this->obj_hf_node_filters as &$filter)
		{
			$filter->rcreate($filter->member_value_array());
		}
		foreach ($this->obj_hf_tags as &$tag)
		{
			$tag->rcreate($tag->member_value_array());
		}
		foreach ($this->obj_hf_outputs as &$output)
		{
			$output->rcreate($output->member_value_array());
		}
		foreach ($this->obj_hf_files as &$afile)
		{
			$afile->rcreate($afile->member_value_array());
		}
		foreach ($this->obj_hf_kill as &$akill)
		{
			$akill->rcreate($akill->member_value_array());
		}
		foreach ($this->obj_hf_resources as &$res)
		{
			$res->rcreate($res->member_value_array());
		}
		foreach ($this->obj_hf_system_kind as $sk)
		{
			$sk->rcreate($sk->member_value_array());
		}
		$this->obj_expression->rcreate($this->obj_expression->member_value_array(),true);
	}
	public function create_from_xml_array($data)
	{
		$this->obj_hf_parameters=array();
		$this->obj_hf_inherit=array();
		$this->obj_hf_node_filters=array();
		$this->obj_hf_tags=array();
		$this->obj_hf_outputs=array();
		$this->obj_hf_files=array();
		$this->obj_hf_kill=array();
		$this->obj_hf_resources=array();
		$this->obj_hf_system_kind=array();

		parent::create_from_xml_array($data);

		if ( isset($data['@attributes']['bool_inheritable']) )
		{
			$this->obj_bool_inheritable=true;
		}
		if ( isset($data['@attributes']['version']) )
		{
			$this->obj_version=$data['@attributes']['version'];
		}

		if ( isset($data['hf_expression']) )
		{
			if ( isset($data['hf_expression']['@attributes']) )
			{
				if ( isset($data['hf_expression']['@attributes']['val']) )
				{
					$this->str_expression = $data['hf_expression']['@attributes']['val'];
					$new_expression = new strings();
					$new_expression->obj_version = $this->obj_version;
					$new_expression->create_from_xml_array( $data['hf_expression'] );
					$this->obj_expression = $new_expression;
				}
			}
		}
		if ( isset($data['hf_parameters']) )
		{
			if ( isset($data['hf_parameters']['hf_parameter']) )
			{
				if ( isset($data['hf_parameters']['hf_parameter']['@attributes']) )
				{
					$new_param = new hf_parameter();
					$new_param->obj_version = $this->obj_version;
					$new_param->create_from_xml_array($data['hf_parameters']['hf_parameter']);
					$this->obj_hf_parameters[]=$new_param;
				}
				else
				{
					foreach ($data['hf_parameters']['hf_parameter'] as $hf_parameter)
					{
						$new_param = new hf_parameter();
						$new_param->obj_version = $this->obj_version;
						$new_param->create_from_xml_array($hf_parameter);
						$this->obj_hf_parameters[]=$new_param;
					}
				}
			}
		}
		if ( isset($data['hf_resources']) )
		{
			if ( isset($data['hf_resources']['hf_resource']) )
			{
				if ( isset($data['hf_resources']['hf_resource']['@attributes']) )
				{
					$new_resource = new hf_resource();
					$new_resource->obj_version = $this->obj_version;
					$new_resource->create_from_xml_array($data['hf_resources']['hf_resource']);
					$this->obj_hf_resources[]=$new_resource;
				}
				else
				{
					foreach ($data['hf_resources']['hf_resource'] as $hf_resource)
					{
						$new_resource = new hf_resource();
						$new_resource->obj_version = $this->obj_version;
						$new_resource->create_from_xml_array($hf_resource);
						$this->obj_hf_resources[]=$new_resource;
					}
				}
			}
		}
		if ( isset($data['hf_node_filters']) )
		{
			if ( isset($data['hf_node_filters']['hf_node_filter']) )
			{
				if ( isset($data['hf_node_filters']['hf_node_filter']['@attributes']) )
				{
					$new_node_filter = new hf_node_filter();
					$new_node_filter->obj_version = $this->obj_version;
					$new_node_filter->create_from_xml_array($data['hf_node_filters']['hf_node_filter']);
					$this->obj_hf_node_filters[]=$new_node_filter;
				}
				else
				{
					foreach ($data['hf_node_filters']['hf_node_filter'] as $hf_filter)
					{
						$new_node_filter = new hf_node_filter();
						$new_node_filter->obj_version = $this->obj_version;
						$new_node_filter->create_from_xml_array($hf_filter);
						$this->obj_hf_node_filters[]=$new_node_filter;
					}
				}
			}
		}
		if ( isset($data['hf_tags']) )
		{
			if ( isset($data['hf_tags']['hf_tag']) )
			{
				if ( isset($data['hf_tags']['hf_tag']['@attributes']) )
				{
					$new_tag = new hf_tag();
					$new_tag->obj_version = $this->obj_version;
					$new_tag->create_from_xml_array($data['hf_tags']['hf_tag']);
					$this->obj_hf_tags[]=$new_tag;
				}
				else
				{
					foreach ($data['hf_tags']['hf_tag'] as $hf_tag)
					{
						$new_tag = new hf_tag();
						$new_tag->obj_version = $this->obj_version;
						$new_tag->create_from_xml_array($hf_tag);
						$this->obj_hf_tags[]=$new_tag;
					}
				}
			}
		}
		if ( isset($data['hf_outputs']) )
		{
			if ( isset($data['hf_outputs']['hf_output']) )
			{
				if ( isset($data['hf_outputs']['hf_output']['@attributes']) )
				{
					$new_output = new hf_output();
					$new_output->obj_version = $this->obj_version;
					$new_output->create_from_xml_array($data['hf_outputs']['hf_output']);
					$this->obj_hf_outputs[]=$new_output;
				}
				else
				{
					foreach ($data['hf_outputs']['hf_output'] as $hf_output)
					{
						$new_output = new hf_output();
						$new_output->obj_version = $this->obj_version;
						$new_output->create_from_xml_array($hf_output);
						$this->obj_hf_outputs[]=$new_output;
					}
				}
			}
		}
		if ( isset($data['hf_files']) )
		{
			if ( isset($data['hf_files']['hf_file']) )
			{
				if ( isset($data['hf_files']['hf_file']['@attributes']) )
				{
					$new_file = new hf_file();
					$new_file->obj_version = $this->obj_version;
					$new_file->create_from_xml_array($data['hf_files']['hf_file']);
					$this->obj_hf_files[]=$new_file;
				}
				else
				{
					foreach ($data['hf_files']['hf_file'] as $hf_file)
					{
						$new_file = new hf_file();
						$new_file->obj_version = $this->obj_version;
						$new_file->create_from_xml_array($hf_file);
						$this->obj_hf_files[]=$new_file;
					}
				}
			}
		}
		if ( isset($data['hf_kills']) )
		{
			if ( isset($data['hf_kills']['hf_kill']) )
			{
				if ( isset($data['hf_kills']['hf_kill']['@attributes']) )
				{
					$new_kill = new hf_kill();
					$new_kill->obj_version = $this->obj_version;
					$new_kill->create_from_xml_array($data['hf_kills']['hf_kill']);
					$this->obj_hf_kills[]=$new_kill;
				}
				else
				{
					foreach ($data['hf_kills']['hf_kill'] as $hf_kill)
					{
						$new_kill = new hf_kill();
						$new_kill->obj_version = $this->obj_version;
						$new_kill->create_from_xml_array($hf_kill);
						$this->obj_hf_kills[]=$new_kill;
					}
				}
			}
		}
		if ( isset($data['hf_inherits']) )
		{
			if ( isset($data['hf_inherits']['hf_inherit']) )
			{
				if ( isset($data['hf_inherits']['hf_inherit']['@attributes']) )
				{
					$new_inherit = new hf_inherit();
					$new_inherit->obj_version = $this->obj_version;
					$new_inherit->create_from_xml_array($data['hf_inherits']['hf_inherit']);
					if ( isset($data['hf_inherits']['hf_inherit']['@attributes']['name']) )
					{
						$new_inherit->name=$data['hf_inherits']['hf_inherit']['@attributes']['name'];
						$this->obj_hf_inherit[]=$new_inherit;
					}
				}
				else
				{
					foreach ($data['hf_inherits']['hf_inherit'] as $hf_inherit)
					{
						$new_inherit = new hf_inherit();
						$new_inherit->obj_version = $this->obj_version;
						$new_inherit->create_from_xml_array($hf_inherit);
						if ( isset($hf_inherit['@attributes']['name']) )
						{
							$new_inherit->name=$hf_inherit['@attributes']['name'];
							$this->obj_hf_inherit[]=$new_inherit;
						}
					}
				}
			}
		}
		if ( isset($data['hf_system_kinds']) )
		{
			if ( isset($data['hf_system_kinds']['hf_system_kind']) )
			{
				if ( isset($data['hf_system_kinds']['hf_system_kind']['@attributes']) )
				{
					$new_system_kind = new hf_system_kind();
					$new_system_kind->obj_version = $this->obj_version;
					$new_system_kind->create_from_xml_array($data['hf_system_kinds']['hf_system_kind']);
					if ( isset($data['hf_system_kinds']['hf_system_kind']['@attributes']['name']) )
					{
						$new_system_kind->name=$data['hf_system_kinds']['hf_system_kind']['@attributes']['name'];
						$this->obj_hf_system_kind[]=$new_system_kind;
					}
				}
				else
				{
					foreach ($data['hf_system_kinds']['hf_system_kind'] as $hf_system_kind)
					{
						$new_system_kind = new hf_system_kind();
						$new_system_kind->obj_version = $this->obj_version;
						$new_system_kind->create_from_xml_array($hf_system_kind);
						if (isset($hf_system_kind['@attributes']['name']))
						{
							$new_system_kind->name=$hf_system_kind['@attributes']['name'];
							$this->obj_hf_system_kind[]=$new_system_kind;
						}
					}
				}
			}
		}
	}

	public function give_ids()
	{
		global $u,$APP;

		$this->id_user = $u->id_user;

		$usk = new user_system_kind();
		$user_system_kinds = $usk->get_from_hashrange($this->id_user);
		$hfs = new hf_id_user();
		$all_hfs = $hfs->get_from_hashrange($this->id_user);

		if ( isset($_POST['replace-id-'.str_replace(" ","_",$this->name)]) )
		{
			$this->id = $_POST['replace-id-'.str_replace(" ","_",$this->name)];
		}
		else
		{
			if ( isset($_POST['id-'.str_replace(" ","_",$this->name)]) )
			{
				$this->id = $_POST['id-'.str_replace(" ","_",$this->name)];
			}
			else
			{
				$this->id = sha1(microtime().$this->name);
			}
		}

		foreach ($this->obj_hf_parameters as &$hf_param)
		{
			$hf_param->id_hf = $this->id;
			$hf_param->id = sha1(microtime().rand(1,1000).$this->id);
			foreach ($hf_param->obj_hfp_vcs as &$constraint)
			{
				// cant count on str_constraint_text being there
				//$constraint->id=sha1(microtime().$this->str_constraint_text.rand(8,100).$hf_param->id);
				$constraint->id=sha1(microtime().rand(8,1000).$hf_param->id);
				$constraint->id_hf_parameter=$hf_param->id;
			}
		} // END FOREACH
		foreach ($this->obj_hf_inherit as &$hf_inherit)
		{
			$hf_inherit->id_hf = $this->id;
			$hf_inherit->id = sha1(microtime().rand(1,1000).$this->id);
			$use_library=true;
			if ( isset($_POST["inheritor-".str_replace(" ","_",$this->name)."-inherits-".str_replace(" ","_",$hf_inherit->name)]) )
			{
				if ( $_POST["inheritor-".str_replace(" ","_",$this->name)."-inherits-".str_replace(" ","_",$hf_inherit->name)]=="import" )
				{
					$use_library=false;
				}
			}
			if (!$use_library)
			{
				// USE ID FROM POST ARRAY
				if ( isset($_POST['id-'.str_replace(" ","_",$hf_inherit->name)] ) )
				{
					$hf_inherit->id_inherit = $_POST['id-'.str_replace(" ","_",$hf_inherit->name)];
				}
				else
				{
					$use_library = true;
				}
			}
			if ($use_library)
			{
				foreach ($all_hfs as $each_hf)
				{
					if ($each_hf['name']==$hf_inherit->name)
					{
						$hf_inherit->id_inherit=$each_hf['id'];
						break;
					}
				}
			}
		} // END FOREACH
		foreach ($this->obj_hf_node_filters as &$hf_node_filter)
		{
			$hf_node_filter->id_hf = $this->id;
			$hf_node_filter->id = sha1(microtime().rand(1,1000).$this->id);
		}
		foreach ($this->obj_hf_tags as &$hf_tag)
		{
			$hf_tag->id_hf = $this->id;
			$hf_tag->id = sha1(microtime().rand(1,1000).$this->id);
		}
		foreach ($this->obj_hf_outputs as &$hf_output)
		{
			$hf_output->id_hf = $this->id;
			$hf_output->id = sha1(microtime().rand(1,1000).$this->id);
		}
		foreach ($this->obj_hf_files as &$hf_file )
		{
			$hf_file ->id_hf = $this->id;
			$hf_file->id = sha1(microtime().rand(1,1000).$this->id);
		}
		foreach ($this->obj_hf_kill as &$hf_kill)
		{
			$hf_kill->id_hf = $this->id;
			$hf_kill->id = sha1(microtime().rand(1,1000).$this->id);
		}
		foreach ($this->obj_hf_resources as &$hf_resource)
		{
			$hf_resource->id_hf = $this->id;
			$hf_resource->id = sha1(microtime().rand(1,1000).$this->id);
			if (isset($hf_resource->obj_system_kinds) )
			{
				if ( $hf_resource->obj_system_kinds )
				{
					foreach ($hf_resource->obj_system_kinds as &$hf_sk)
					{
						$hf_sk->id_resource=$hf_resource->id;
						$hf_sk->id = sha1(microtime().rand(1,1000).$hf_resource->id);
						foreach ($user_system_kinds as $u_sk)
						{
							if ($u_sk['name']==$hf_sk->name)
							{
								$hf_sk->id_sk = $u_sk['id'];
							}
						}
					}
				}
			}
		}
		foreach ($this->obj_hf_system_kind as &$hf_sk)
		{
			$hf_sk->id_hf = $this->id;
			$hf_sk->id = sha1(microtime().rand(1,1000).$this->id);
			foreach ($user_system_kinds as $u_sk)
			{
				if ($u_sk['name']==$hf_sk->name)
				{
					$hf_sk->id_sk = $u_sk['id'];
				}
			}

		}

		$this->obj_expression->id = sha1(microtime().$this->str_expression);
		$this->obj_expression->val=$this->str_expression;
		$this->str_expression = $this->obj_expression->id;

		$sha1_string=sha1(microtime().$this->obj_expression->id.$this->obj_expression->val.rand(3,5));
		$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".txt";
		$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
		$APP['fs']->create_object(false,$bucket_name,$keyname,$this->obj_expression->val,"text/plain");
		$string_url=$APP['fs']->key_url($bucket_name,$keyname);

		$this->obj_expression->val=$string_url;

		$this->obj_expression->give_ids();
		if ( isset($_POST['update-name-'.str_replace(" ","_",$this->name)]) )
		{
			$this->original_name=$this->name;
			$this->name=$_POST['update-name-'.str_replace(" ","_",$this->name)];
		}
	} // end function
	public function build($obj_build_exclude=array(),$do_substitutions=true)
	{
		if ($this->obj_debug)
		{
			echo "building parent HF_ID_USER...\n";
		}
		parent::build($obj_build_exclude);
		if ($this->obj_debug)
		{
			echo "finished building parent...\n";
		}

		if ( !isset($this->obj_expression) )
		{
			//echo "SETTING EXPRESSION";
			$this->obj_expression=new strings();
		}

		$this->obj_hf_inherit=array();
		$this->obj_hf_parameters=array();
		$this->obj_hf_node_filters=array();
		$this->obj_hf_tags=array();
		$this->obj_hf_outputs=array();
		$this->obj_hf_files=array();
		$this->obj_hf_kill=array();
		$this->obj_hf_resources=array();
		$this->obj_hf_system_kind=array();
		// MANY TO 1 RELATIONSHIPS

		if ($this->obj_debug)
		{
			echo "hf inherits...\n";
		}
		$hf_inherit= new hf_inherit();
		$all_hf_inherit= $hf_inherit->get_from_hashrange($this->id);
		if ( $all_hf_inherit && !in_array("obj_hf_inherit",$obj_build_exclude) )
		{
			foreach ($all_hf_inherit as $each_hf_inherit)
			{
				$a_hf_inherit = new hf_inherit();
				$a_hf_inherit->set( $each_hf_inherit );
				$a_hf_inherit->build();

				$this->obj_hf_inherit[]=$a_hf_inherit;

			}
		}

		if ($this->obj_debug)
		{
			echo "hf parameters...\n";
		}
		$hf_parameter=new hf_parameter();
		$all_hf_parameters = $hf_parameter->get_from_hashrange($this->id);
		if ($all_hf_parameters && !in_array("obj_hf_parameters",$obj_build_exclude))
		{
			foreach ($all_hf_parameters as $each_hf_parameter)
			{
				$a_hf_parameter = new hf_parameter();
				$a_hf_parameter->set( $each_hf_parameter );
				$a_hf_parameter->build();
				$this->obj_hf_parameters[]=$a_hf_parameter;
			}
			foreach ($this->obj_hf_parameters as &$a_hf_parameter)
			{
				$a_hf_parameter->merge($this->obj_hf_parameters);
			}
		}

		if ($this->obj_debug)
		{
			echo "hf resource...\n";
		}
		$hf_resource= new hf_resource();
		$all_hf_resource= $hf_resource->get_from_hashrange($this->id);
		if ( $all_hf_resource  && !in_array("obj_hf_resources",$obj_build_exclude) )
		{
			foreach ($all_hf_resource as $each_hf_resource)
			{

				$a_hf_resource = new hf_resource();
				$a_hf_resource->set( $each_hf_resource );
				$a_hf_resource->build();
				$a_hf_resource->subs=$this->name;
				$this->obj_hf_resources[]=$a_hf_resource;

			}
		}

		if ($do_substitutions)
		{
			$this->int_maxruntime_value=replace_hf_parameters($this->int_maxruntime,$this->obj_hf_parameters);
		}
		else
		{
			$this->int_maxruntime_value=$this->int_maxruntime;
		}

		if ($this->obj_debug)
		{
			echo "hf node filters...\n";
		}
		$hf_node_filter=new hf_node_filter();
		$all_hf_node_filters = $hf_node_filter->get_from_hashrange($this->id);
		if ($all_hf_node_filters && !in_array("obj_hf_node_filters",$obj_build_exclude) )
		{
			foreach ($all_hf_node_filters as $each_hf_node_filter )
			{
				$a_hf_node_filter= new hf_node_filter();
				$a_hf_node_filter->set( $each_hf_node_filter );
				$a_hf_node_filter->build();
				$this->obj_hf_node_filters[]=$a_hf_node_filter;
			}
		}
		foreach ($this->obj_hf_node_filters as &$a_hf_node_filter)
		{
			if ($do_substitutions)
			{
				$a_hf_node_filter->value=replace_hf_parameters($a_hf_node_filter->obj_filter->body,$this->obj_hf_parameters);
			}
			else
			{
				$a_hf_node_filter->value=$a_hf_node_filter->obj_filter->body;
			}
		}

		if ($this->obj_debug)
		{
			echo "hf tags...\n";
		}
		$hf_tag = new hf_tag();
		$all_hf_tags = $hf_tag->get_from_hashrange($this->id);
		if ($all_hf_tags && !in_array("obj_hf_tags",$obj_build_exclude) )
		{
			foreach ($all_hf_tags as $each_hf_tag)
			{
				$a_hf_tag= new hf_tag();
				$a_hf_tag->set( $each_hf_tag);
				$a_hf_tag->build();
				$this->obj_hf_tags[]=$a_hf_tag;
			}
		}

		if ($this->obj_debug)
		{
			echo "hf file...\n";
		}
		$hf_file= new hf_file();
		$all_hf_files = $hf_file->get_from_hashrange($this->id);
		if ( $all_hf_files && !in_array("obj_hf_files",$obj_build_exclude) )
		{
			foreach ($all_hf_files as $each_hf_file)
			{
				$a_hf_file = new hf_file();
				$a_hf_file->set( $each_hf_file );
				$a_hf_file->build();
				$this->obj_hf_files[]=$a_hf_file;
			}
		}
		foreach ($this->obj_hf_files as &$a_hf_file)
		{
			if ($do_substitutions)
			{
				$a_hf_file->value=replace_hf_parameters($a_hf_file->obj_targetfile->body,$this->obj_hf_parameters);
			}
			else
			{
				$a_hf_file->value=$a_hf_file->obj_targetfile->body;
			}
		}

		if ($this->obj_debug)
		{
			echo "hf kill...\n";
		}
		$hf_kill= new hf_kill();
		$all_hf_kill= $hf_kill->get_from_hashrange($this->id);
		if ( $all_hf_kill && !in_array("obj_hf_kill",$obj_build_exclude) )
		{
			foreach ($all_hf_kill as $each_hf_kill)
			{
				$a_hf_kill = new hf_kill();
				$a_hf_kill->set( $each_hf_kill);
				$a_hf_kill->build();
				$this->obj_hf_kill[]=$a_hf_kill;
			}
		}
		foreach ($this->obj_hf_kill as &$a_hf_kill)
		{
			if ($do_substitutions)
			{
				$a_hf_kill->value=replace_hf_parameters($a_hf_kill->obj_name->body,$this->obj_hf_parameters);
			}
			else
			{
				$a_hf_kill->value=$a_hf_kill->obj_name->body;
			}
		}

		foreach ($this->obj_hf_resources as &$a_hf_resource)
		{
			if ($do_substitutions)
			{		
				$a_hf_resource->value_location=replace_hf_parameters($a_hf_resource->obj_location->body,$this->obj_hf_parameters);
				$a_hf_resource->value_filename=replace_hf_parameters($a_hf_resource->obj_filename->body,$this->obj_hf_parameters);
			}
			else
			{
				$a_hf_resource->value_location=$a_hf_resource->obj_location->body;
				$a_hf_resource->value_filename=$a_hf_resource->obj_filename->body;
			}
		}

		if ($this->obj_debug)
		{
			echo "hf system kinds...\n";
		}
		$hf_system_kind= new hf_system_kind();
		$all_hf_system_kind= $hf_system_kind->get_from_hashrange($this->id);
		if ( $all_hf_system_kind && !in_array("obj_hf_system_kind",$obj_build_exclude) )
		{
			foreach ($all_hf_system_kind as $each_hf_system_kind)
			{
				$a_hf_system_kind = new hf_system_kind();
				$a_hf_system_kind->set( $each_hf_system_kind );
				$a_hf_system_kind->build();
				$this->obj_hf_system_kind[]=$a_hf_system_kind;
			}
		}

		if ($this->obj_debug)
		{
			echo "hf assimilation...\n";
		}
		// ASSIMILATE PARENT INHERITANCE
		foreach ($this->obj_hf_inherit as $hf_inherit)
		{
			// RECURSIVELY ASSIMILATE THE PARENT FUNCTION
			$hf_inherit->assimilate($this,$obj_build_exclude);
		}

		$local_sk_found=false;
		foreach ($this->obj_hf_system_kind as &$tsk)
		{
			if ($tsk->id_hf==$this->id)
			{
				$local_sk_found=true;
				break;
			}
		}
		if ($local_sk_found)
		{
			foreach ($this->obj_hf_system_kind as &$tsk)
			{
				if ($tsk->id_hf!=$this->id)
				{
					$tsk->obj_enabled=false;
				}
			}
		}



		/*
		if ($do_substitutions)
		{
		echo "<pre>";
		print_r($this);
		}
		*/

		$this->obj_bool_inheritable=false;
		$hf_inheritable= new user_inherit();
		$hf_inheritable->get_from_hashrange($this->id_user,$this->id);
		if ($hf_inheritable->id_user!="undefined")
		{
			$this->obj_bool_inheritable=true;
		}
		// BUILD RECURSIVE EXPRESSION TREE
		if ($this->obj_debug)
		{
			echo "building hash expression tree";
		}
		$this->hash_to_expression_tree($this->str_expression,$do_substitutions);
		if ( isset($this->obj_hf_parameters) )
		{
			if ($this->obj_debug)
			{
				echo "merging expressions";
			}
			if ( isset($this->obj_expression) && !is_bool($this->obj_expression) && get_class($this->obj_expression)=="strings" )
			{
				$this->obj_expression->merge($this->obj_hf_parameters);
			}
		}
		if ($this->obj_debug)
		{
			echo "finished building function";
		}
	} // end function build
}

class sys_setting extends his
{
	public $obj_key_type='hashrange';
	public $category='undefined';
	public $param='undefined';
	public $val='undefined';
}
class user_user_name extends his
{
	public $user_name='undefined';
	public $id_user='undefined';
	public $email='undefined';
	public $pw='undefined';
	public $secret='undefined';
	public $lang='undefined';

	public function build($obj_build_exclude=array())
	{
		global $APP;
		if ($this->obj_debug)
		{
			echo "build()";
		}
		parent::build($obj_build_exclude);
		$this->obj_hfs=array();
		if (!in_array("obj_hfs",$obj_build_exclude))
		{
			if ($this->obj_debug)
			{
				echo "checking obj_hfs";
			}
			$user_hfs = new hf_id_user();
			//echo "WTF";
			$all_user_hfs = $user_hfs->get_from_hashrange($this->id_user);
			//echo "WTF2";
			//print_r($all_user_hfs);
			if ($all_user_hfs)
			{
				foreach ($all_user_hfs as $each_user_hf)
				{
					$a_user_hf= new hf_id_user();
					$a_user_hf->set( $each_user_hf);
					//$a_user_hf->build();
					$this->obj_hfs[]=$a_user_hf;
				}
			}
		}
		$this->obj_servers=array();
		if (!in_array("obj_servers",$obj_build_exclude))
		{
			$user_server= new user_server();
			$all_user_servers= $user_server->get_from_hashrange($this->id_user);
			if ($all_user_servers)
			{
				foreach ($all_user_servers as $each_user_server)
				{
					$a_user_server= new user_server();
					$a_user_server->set($each_user_server);
					//$a_user_server->build();
					$this->obj_servers[]=$a_user_server;
				} // END FOREACH
			} // END IF
		} // END IF
		$this->obj_system_kinds=array();
		if (!in_array("obj_system_kinds",$obj_build_exclude))
		{
			$user_system_kind= new user_system_kind();
			$all_user_system_kinds= $user_system_kind->get_from_hashrange($this->id_user);
			if ($all_user_system_kinds)
			{
				foreach ($all_user_system_kinds as $each_user_system_kind)
				{
					$a_user_system_kind= new user_system_kind();
					$a_user_system_kind->set($each_user_system_kind);
					//$a_user_system_kind->build();
					$this->obj_system_kinds[]=$a_user_system_kind;
				} // END FOREACH
			} // END IF
		} // END IF
		$this->obj_inherits=array();
		if (!in_array("obj_inherits",$obj_build_exclude))
		{
			$user_inherit= new user_inherit();
			$all_user_inherits= $user_inherit->get_from_hashrange($this->id_user);
			if ($all_user_inherits)
			{
				foreach ($all_user_inherits as $each_user_inherit)
				{
					$a_user_inherit= new user_inherit();
					$a_user_inherit->set($each_user_inherit);
					//$a_user_inherit->build();
					$this->obj_inherits[]=$a_user_inherit;
				} // END FOREACH
			} // END IF
		} // END IF


	} // end function
}
class user_id_user extends his
{
	public $id_user='undefined';
	public $user_name='undefined';
	public $email='undefined';
	public $pw='undefined';
	public $secret='undefined';
	public $lang='undefined';

	public function build($obj_build_exclude=array())
	{
		if ($this->obj_debug)
		{
			echo "build()";
		}
		parent::build($obj_build_exclude);
		$this->obj_hfs=array();
		if (!in_array("obj_hfs",$obj_build_exclude))
		{
			$user_hfs = new hf_id_user();
			$all_user_hfs = $user_hfs->get_from_hashrange($this->id_user);
			if ($all_user_hfs)
			{
				foreach ($all_user_hfs as $each_user_hf)
				{
					$a_user_hf= new hf_id_user();
					$a_user_hf->set( $each_user_hf);
					//$a_user_hf->build();
					$this->obj_hfs[]=$a_user_hf;
				}
			}
		}
		$this->obj_servers=array();
		if (!in_array("obj_servers",$obj_build_exclude))
		{
			$user_server= new user_server();
			$all_user_servers= $user_server->get_from_hashrange($this->id_user);
			if ($all_user_servers)
			{
				foreach ($all_user_servers as $each_user_server)
				{
					$a_user_server= new user_server();
					$a_user_server->set($each_user_server);
					//$a_user_server->build();
					$this->obj_servers[]=$a_user_server;
				}
			}
		}
		$this->obj_system_kinds=array();
		if (!in_array("obj_system_kinds",$obj_build_exclude))
		{
			$user_system_kind= new user_system_kind();
			$all_user_system_kinds= $user_system_kind->get_from_hashrange($this->id_user);
			if ($all_user_system_kinds)
			{
				foreach ($all_user_system_kinds as $each_user_system_kind)
				{
					$a_user_system_kind= new user_system_kind();
					$a_user_system_kind->set($each_user_system_kind);
					//$a_user_system_kind->build();
					$this->obj_system_kinds[]=$a_user_system_kind;
				}
			}
		}
		$this->obj_inherits=array();
		if (!in_array("obj_inherits",$obj_build_exclude))
		{
			$user_inherit= new user_inherit();
			$all_user_inherits= $user_inherit->get_from_hashrange($this->id_user);
			if ($all_user_inherits)
			{
				foreach ($all_user_inherits as $each_user_inherit)
				{
					$a_user_inherit= new user_inherit();
					$a_user_inherit->set($each_user_inherit);
					//$a_user_inherit->build();
					$this->obj_inherits[]=$a_user_inherit;
				} // END FOREACH
			} // END IF
		} // END IF

	} // end function
}
class strings extends his
{
	public $id='undefined';
	public $val='undefined';
	public function delete()
	{
		if ( isset($this->obj_match_customs) )
		{
			foreach ($this->obj_match_customs as $mc)
			{
				$mc->delete();
			}
		}
		if ( isset($this->obj_match_entries) )
		{
			foreach ($this->obj_match_entries as $me)
			{
				$me->delete();
			}
		}
		parent::delete();
	}
	public function give_ids()
	{
		foreach ($this->obj_match_customs as &$mc)
		{
			$mc->id_expr = $this->id;
		}
		foreach ($this->obj_match_entries as &$me)
		{
			$me->id_expr = $this->id;
			$me->idx_id= $me->idx_id."#".sha1(microtime().rand(1,1000).$this->id);
			$me->give_ids();
		}
	}
	public function rcreate($props,$mode_raw=false)
	{
		$this->create($props,$mode_raw);
		foreach ($this->obj_match_customs as &$mc)
		{
			$mc->rcreate($mc->member_value_array());
		}
		foreach ($this->obj_match_entries as &$me)
		{
			$me->rcreate($me->member_value_array(),true);
		}
	}
	public function merge($obj_params)
	{
		if ( $obj_params && count($obj_params)>0 )
		{

			foreach ($this->obj_match_customs as &$mc)
			{
				$mc->value = replace_hf_parameters($mc->obj_txt->body,$obj_params);
			}
			foreach ($this->obj_match_entries as &$me)
			{
				foreach ($me->obj_me_settings as &$mes)
				{
					$mes->value=replace_hf_parameters($mes->obj_value->body,$obj_params);
				}
				if ( isset($me->obj_expression) && get_class($me->obj_expression)=="strings" )
				{
					$me->obj_expression->merge($obj_params);
				}
			}
		}
	}
	public function build($obj_build_exclude=array())
	{
		global $APP;
		parent::build($obj_build_exclude);
		// is strings class
		$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
		if ( !in_array("body",$obj_build_exclude) )
		{
			$this->body = $APP['fs']->get_object($bucket_name,$this->val);
		}
		else
		{
			$this->body=false;
		}
	}
	public function toxml($expression = false)
	{
		global $u;

		if ($expression)
		{
			if ( !isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
			{
				$retval="\t<hf_expression val='".toxmlvalue($this->body)."'".">\n";
				
				$retval=$retval."\t\t<customs>\n";
				foreach ($this->obj_match_customs as $mck=>$mcv)
				{
					$retval=$retval.$mcv->toxml();
				}
				$retval=$retval."\t\t</customs>\n";
				$retval=$retval."\t\t<matchentries>\n";
				foreach ($this->obj_match_entries as $me)
				{
					$retval=$retval.$me->toxml();
				}
				$retval=$retval."\t\t</matchentries>\n";

				$retval=$retval."\t</hf_expression>\n";
			}
		}
		return $retval;
	}
	public function create_from_xml_array($data)
	{
		parent::create_from_xml_array($data);
		$this->obj_match_customs=array();
		$this->obj_match_entries=array();

		// customs
		if ( isset($data['customs']) )
		{
			if ( isset($data['customs']['match_custom']) )
			{
				if ( isset($data['customs']['match_custom']['@attributes']) )
				{
					$match_custom = new match_custom();
					$match_custom->obj_version = $this->obj_version;
					$match_custom->create_from_xml_array($data['customs']['match_custom']);
					$this->obj_match_customs[]=$match_custom;
				}
				else
				{
					foreach ($data['customs']['match_custom'] as $mcustom)
					{
						$match_custom= new match_custom();
						$match_custom->obj_version = $this->obj_version;
						$match_custom->create_from_xml_array($mcustom);
						$this->obj_match_customs[]=$match_custom;
					}
				}
			}
		}

		// matchentries
		if ( isset($data['matchentries']) )
		{
			if ( isset($data['matchentries']['match_entry']) )
			{
				if ( isset($data['matchentries']['match_entry']['@attributes']) )
				{
					$match_entry = new match_entry();
					$match_entry->obj_version = $this->obj_version;
					$match_entry->create_from_xml_array($data['matchentries']['match_entry']);
					$this->obj_match_entries[]=$match_entry;
				}
				else
				{
					foreach ($data['matchentries']['match_entry'] as $mentry)
					{
						$match_entry= new match_entry();
						$match_entry->obj_version = $this->obj_version;
						$match_entry->create_from_xml_array($mentry);
						$this->obj_match_entries[]=$match_entry;
					}
				}
			}
		}


	}

}
class hfr_system_kind extends his
{
	public $obj_key_type='hashrange';
	public $id_resource='undefined';
	public $id='undefined';
	public $id_sk='undefined';
	
	public function toxml()
	{
		global $u;
		$localprops="";
		foreach ($u->obj_system_kinds as $usk)
		{
			if ($this->id_sk==$usk->id && $usk->id_user==$u->id_user)
			{
				$localprops=" name='".toxmlvalue($usk->name)."'";
			}
		}
		if ( !isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
		{
			$retval="\t\t\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	
}
class hf_resource extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $str_location='undefined';
	public $str_filename='undefined';
	public function rcreate($props,$mode_raw=false)
	{
		$this->create($props,$mode_raw);
		if ( isset($this->obj_system_kinds) )
		{
			if ($this->obj_system_kinds)
			{
				foreach ($this->obj_system_kinds as &$sk)
				{
					$sk->rcreate($sk->member_value_array());
				}
			}
		}
	}
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		$retval="";
		if ( !isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
		{
			$retval="\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t\t<system_kinds>\n";
			foreach ($this->obj_system_kinds as $sk)
			{
				$retval=$retval.$sk->toxml();
			}
			$retval=$retval."\t\t\t</system_kinds>\n";
			
			$retval=$retval."\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	public function create_from_xml_array($data)
	{
		parent::fromobjectxml($data);
		if ( isset($data['system_kinds']) )
		{
			if (isset($data['system_kinds']['hfr_system_kind']))
			{
				if (isset($data['system_kinds']['hfr_system_kind']['@attributes']))
				{
					$new_hfr_sk = new hfr_system_kind();
					$new_hfr_sk->obj_version = $this->obj_version;
					$new_hfr_sk->create_from_xml_array($data['system_kinds']['hfr_system_kind']);
					if ( isset($data['system_kinds']['hfr_system_kind']['@attributes']['name']) )
					{
						$new_hfr_sk->name=$data['system_kinds']['hfr_system_kind']['@attributes']['name'];
						$this->obj_system_kinds[]=$new_hfr_sk;
					}
				}
				else
				{
					foreach ($data['system_kinds']['hfr_system_kind'] as $hfr_sk)
					{
						$new_hfr_sk = new hfr_system_kind();
						$new_hfr_sk->obj_version = $this->obj_version;
						$new_hfr_sk->create_from_xml_array($hfr_sk);
						if ( isset($hfr_sk['@attributes']['name']) )
						{
							$new_hfr_sk->name=$hfr_sk['@attributes']['name'];
							$this->obj_system_kinds[]=$new_hfr_sk;
						}
					}
				}
			}
		} // END IF
	}
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
		$this->obj_system_kinds=array();
		$hfr_system_kind= new hfr_system_kind();
		$all_hfr_system_kinds= $hfr_system_kind->get_from_hashrange($this->id);
		if ($all_hfr_system_kinds)
		{
			foreach ($all_hfr_system_kinds as $each_hfr_system_kind)
			{
				$a_hfr_system_kind= new hfr_system_kind();
				$a_hfr_system_kind->get_from_hashrange($each_hfr_system_kind['id_resource'],$each_hfr_system_kind['id']);
				$a_hfr_system_kind->build();
				$this->obj_system_kinds[]=$a_hfr_system_kind;
			}
		}
	}
}

class user_inherit extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $id_hf='undefined';
}

class hf_system_kind extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $id_sk='undefined';
		public function toxml()
		{
			global $u;
			$localprops="";
			foreach ($u->obj_system_kinds as $usk)
			{
					if ($this->id_sk==$usk->id && $usk->id_user==$u->id_user)
					{
						$localprops=" name='".toxmlvalue($usk->name)."'";
					}
			}
			$retval="";
			if (!isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
			{
					$retval="\t\t<".get_class($this).$localprops.">\n";
					$retval=$retval."\t\t</".get_class($this).">\n";
			}
			return $retval;
		}
}
class job_new extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $id='undefined';
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
		if ($this->id_user!='undefined')
		{
			$this->obj_user=new user_id_user();
			$this->obj_user->get_from_hashrange($this->id_user);
		}
	}
}
class job_status extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $id_status_job='undefined';
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
		if ($this->id_user!='undefined')
		{
			$this->obj_user=new user_id_user();
			$this->obj_user->get_from_hashrange($this->id_user);
		}
	}
}
class job_id_user extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $id='undefined';
	public $id_status='undefined';
	public $id_hf='undefined';
	public $dt_created='undefined';
	public $dt_modified='undefined';
	public $dt_done='undefined';
	public $str_rqdata='undefined';
	public $str_response='undefined';
	public $str_output='undefined';
	public $str_ad='undefined';
	public $int_try='0';
	
	public function status_new()
	{
		global $APP;
        // CREATE JOB_NEW ENTRY

        /*if (PHP_SAPI === 'cli')
        {
            logger( "RESTARTING ORPHANED RUNNING JOB:\n\t".$this->id."\n");
        }*/
        $prop=array();
        $prop["id_user"]=$this->id_user;
        $prop["id"]=$this->id;
        
        $has_at = strpos($prop['id'],"@");
        
        if ($has_at!==FALSE)
        {

            $idsplit = explode("@",$prop["id"]);
            $server_name = $idsplit[0];
            
            $create_new_job=new job_new();
            if ($APP['ms']->kind!="no-messaging")
            {
                $create_new_job->set($prop);
                $xml_send = $create_new_job->toobjectxml();
                $create_new_job->send("sendto_".$server_name,$xml_send);
            }
            else
            {
                $create_new_job->create($prop);
				$this->delete_job_status();
            }
        }
	}
	public function update($new_props,$mode_raw=false)
	{
		if ($this->obj_debug)
		{
			echo "PARENT UPDATE\n";
			print_r($this);
		}
		if ( isset($new_props['id_status']) && $new_props['id_status']=="new")
		{
			$this->status_new();
		}
		else if ( isset($new_props['id_status']) && ($new_props['id_status']=="done") )
		{
			$this->delete_job_status();
		}
		else if ( isset($new_props['id_status']) )
		{
			$this->delete_job_new();
			$this->delete_job_status();
			$check_job_status = new job_status();
			$props=array("id_user"=>$this->id_user,"id_status_job"=>$new_props['id_status']."#".$this->id);
			$check_job_status->create($props);
		}
		parent::update($new_props,$mode_raw);
	}
	public function delete_job_flags()
	{
		if ($this->id!="undefined")
		{
			// CLEAR JOB FLAGS
			$old_job_flags = new job_flag();
			$all_old_flags = $old_job_flags->get_from_hashrange($this->id);
			foreach ($all_old_flags as $an_old_flag)
			{
				$delete_job_flag = new job_flag();
				$delete_job_flag->set($an_old_flag);
				if ($delete_job_flag->id_job!="undefined")
				{
					$delete_job_flag->delete();
				}
			}
		}
	}
	public function delete_ph_decendants()
	{
		return;
		if ($this->id!="undefined")
		{
			$old_ph_parent = new ph_parent();
			$old_ph_parents = $old_ph_parent->get_from_hashrange($this->id);
			foreach ($old_ph_parents as $each_ph_parent)
			{
				$delete_ph_parent = new ph_parent();
				$delete_ph_parent->set($each_ph_parent);
				if ($delete_ph_parent->id_parent_job!="undefined")
				{
					$delete_ph_child = new ph_child();
					$delete_ph_child->get_from_hashrange($delete_ph_parent->id_child_job,$delete_ph_parent->id_parent_job);
					if ($delete_ph_child->id_child_job!="undefined")
					{
						$child_job = new job_id_user();
						$child_job->get_from_hashrange($this->id_user,$delete_ph_child->id_child_job);
						$child_job->delete();
					}
				} // END IF
			} // END FOREACH
			
		} // END IF
	} // END FUNCTION
	public function delete_job_new()
	{
		global $APP;
		if ($APP['ms']->kind!="no-messaging")
		{
			// SOME TYPE OF MESSAGING IS BEING USED
		}
		else
		{
			$check_new_job = new job_new();
			$check_new_job->get_from_hashrange($this->id_user,$this->id);
			if ($check_new_job->id!="undefined")
			{
				$check_new_job->delete();
			}
		} // END IF
	} // END FUNCTION 
	
	public function delete_job_status()
	{
		global $APP;
		if ($APP['ms']->kind!="no-messaging")
		{
			// SOME TYPE OF MESSAGING IS BEING USED
		}
		else
		{
			$check_job_status = new job_status();
			$check_job_status->get_from_hashrange($this->id_user,$this->id_status."#".$this->id);
			if ($check_job_status->id_user!="undefined")
			{
				$check_job_status->delete();
			}
		} // END IF
	} // END FUNCTION 
	
	
	
	
	
	
	public function delete()
	{
		// CLEAR JOB FLAGS
		$this->delete_job_flags();
		// CLEAR ALREADY-CREATED PH_* JOBS
		$this->delete_ph_decendants();
		$this->delete_job_new();
		parent::delete();
	}
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
		//echo "USER:";
		if ($this->id_user!='undefined')
		{
			if (!in_array("obj_user", $obj_build_exclude) )
			{
				$this->obj_user=new user_id_user();
				$this->obj_user->get_from_hashrange($this->id_user);
			}
		}
		//echo "HF";
		$hf_excludes=array();
		if ( count($obj_build_exclude)>0 )
		{
			$hf_excludes=array("obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_fastresponse");
		}
		if ($this->id_hf!='undefined')
		{
			if (!in_array("obj_hf", $obj_build_exclude) )
			{
				$this->obj_hf=new hf_id_user();
				$this->obj_hf->get_from_hashrange($this->id_user,$this->id_hf);
				$this->obj_hf->build($hf_excludes);
			}
		}
		//echo "DONE JOB";
	}

	public function reassign_auto()
	{
		global $mode_server;
		$user_servers=array();
		$user_server = new user_server();

		// LIST OF ALL JOB SERVERS
		$user_servers = $user_server->get_from_hashrange($this->id_user);
			
		// HOW MANY NON-BUSY JOB SERVERS
		$not_busy_servers = array();
		foreach ($user_servers as $user_server)
		{
			if (isset($user_server['is_busy']))
			{
				if ($user_server['is_busy'].""!="1" && $user_server['int_online'].""=="1")
				{
					$not_busy_servers[] = $user_server;
				}
			}
		}
			

		// HOW MANY OTHER NON-BUSY JOB SERVERS (INC. THIS ONE) WERE LAST SEEN IN THE PAST 30 SECONDS			
		$server_second_timerange = 30;
		$current_not_busy_servers = array();
		foreach ($not_busy_servers as $not_busy_server)
		{
			$timespan=(intval(get_time())-intval($not_busy_server['last_ping']));
			if ($timespan<$server_second_timerange)
			{
				$current_not_busy_servers[]=$not_busy_server;
			}
		}

		//   SORT THIS LIST
		usort($current_not_busy_servers,"nameindexordersort");
		usort($current_not_busy_servers,"lastpingordersort");
	
		$current_not_busy_servers_by_name=array();
		foreach ($current_not_busy_servers as $current_not_busy_server)
		{
			$current_not_busy_servers_by_name[$current_not_busy_server['name']]=$current_not_busy_server;
		}
		//echo "CURRENT NOT BUSY SERVERS:";print_r($current_not_busy_servers_by_name);
		//echo "FIRST SERVER:".$current_not_busy_servers[0]['name'];
		//   IS THIS SERVER THE FIRST IN THE LIST?
		//if ( count($current_not_busy_servers)>0 ) //&& $INSTANCE_NAME==$current_not_busy_servers[0]['name'] )
		//{
	
	
		$assigned_servers = array();


		$assignable_hf = new assign_hf();
		//echo "SEARCHING FOR ASSIGNABILITY:".$job_assign_hf;
		$job_reassignability = $assignable_hf->get_from_hashrange($this->id_user,$this->id_hf,"BEGINS_WITH");
		//echo "ASSIGNABILITY:";
		//print_r($job_reassignability);
		$find_id_prefix = $this->id_hf."@";
		$eligible_servers=array();
		foreach ($job_reassignability as $job_reassign_hf)
		{
			//echo "ADDING ELIGIBLE SERVER:".str_replace($find_id_prefix,"",$job_reassign_hf['hf_server'])."\n";
			$eligible_servers[]=str_replace($find_id_prefix,"",$job_reassign_hf['hf_server']);
		}
		$eligible_not_busy_servers=array();
		foreach ($eligible_servers as $eligible_server)
		{
			if ( in_array($eligible_server,array_keys($current_not_busy_servers_by_name)) && !in_array($eligible_server,$assigned_servers) )
			{
				$eligible_not_busy_servers[] = $eligible_server;
			}
		}
		if ( count($eligible_not_busy_servers)==0 )
		{
			foreach ($eligible_servers as $eligible_server)
			{
				$eligible_not_busy_servers[] = $eligible_server;
			}
		}
		//echo "ELIGIBLE JOB SERVERS (NOT BUSY):";print_r($eligible_not_busy_servers);
		
		$a_job_has_been_reassigned = false;

		if ( count($eligible_not_busy_servers)>0 )
		{
		
			$eligible_not_busy_server=$eligible_not_busy_servers[rand(0,count($eligible_not_busy_servers)-1)];
			
			$new_assigned_server = $eligible_not_busy_server;
			$assigned_servers[]=$new_assigned_server;

			$old_full_job_id = $this->id;
			$old_full_split = explode("@",$old_full_job_id);

			$old_server_name = $old_full_split[0];
			$old_job_id = $old_full_split[1];

			$new_full_job_id = $new_assigned_server."@".$old_job_id;
			
			if ($new_assigned_server!=$old_server_name)
			{
				if ($mode_server)
				{
					logger( "REASSIGNING JOB ".$old_job_id." TO:\n\t".$new_assigned_server."\n" );
				}
				else
				{
					echo "<div align='center' style='background-color:green;color:white;'>";
					echo "REASSIGNING JOB ".$old_job_id." TO:\n\t".$new_assigned_server."\n";
					echo "</div>";
				}
				
				// UPDATE JOB ASSIGNMENT
				$job_obj = new job_id_user();
				$job_obj->get_from_hashrange($this->id_user,$old_full_job_id);
				
				if ($job_obj->id_status=="undefined")
				{
					if ($mode_server)
					{
						logger( "\tJOB HAS ALREADY BEEN RE-ASSIGNED\n" );
						return;
					}
					else
					{
						echo "<div align='center' style='background-color:green;color:white;'>";
						echo  "\tJOB HAS ALREADY BEEN RE-ASSIGNED\n" ;
						echo "</div>";
					}
					break;
				}

				$job_obj->delete_job_new();
				$job_obj->update( array("id"=>$new_full_job_id,"dt_modified"=>get_time() ));
				$job_obj->delete_job_flags();
				
				//$job_obj->set($new_job);
				
				// UPDATE ANY PH_CHILD AND PH_PARENT ENTRIES
				// IF THIS JOB HAS CHANGED NAME (ASSIGNED TO A DIFFERENT SERVER), IT COULD
				// ONLY BE A CHILD NODE BEING RENAMED
				// UPDATE THE PH_CHILD ENTRY AND THEN THE PH_PARENT ENTRY THAT GOES ALONG WITH IT
				$find_ph_child = new ph_child();
				$find_ph_child->get_from_hashrange($old_full_job_id);
				if ($find_ph_child->id_child_job!="undefined")
				{
					//echo "REASSIGNING CHILD";
					// FIND ITS ASSOCIATED PARENT AND UPDATE
					$find_ph_parent = new ph_parent();
					$find_ph_parent->get_from_hashrange($find_ph_child->id_parent_job,$old_full_job_id);
					if ($find_ph_parent->id_parent_job!="undefined")
					{
						//echo "REASSIGNING parent";
						// FIND ITS ASSOCIATED PARENT AND UPDATE
						$find_ph_parent->update( array("id_child_job"=>$new_full_job_id ));
					}
					$find_ph_child->update( array("id_child_job"=>$new_full_job_id ));
				}
				
				// CREATE JOB_NEW TABLE ENTRY FOR JOBS TO BE FOUND
				if ($job_obj->id_status=="new")
				{
					$job_obj->status_new();
				}

				
				$member_list=$this->member_list($this);
				foreach ($member_list as $member)
				{
					$this->$member=$job_obj->$member;
				}
				$a_job_has_been_reassigned = true;
				//break;
			} // END IF (OLD SERVER NAME != NEW SERVER NAME)

		} // END IF (COUNT OF ELIGIBLE NOT BUSY SERVERS > 0)
		if ($a_job_has_been_reassigned)
		{
			// A JOB HAS ALREADY BEEN SUCCESSFULLY RE-ASSIGNED, NOW EXIT LOOP TO GET TO THE CONTINUE STATEMENT BELOW
		} // END IF	
		return $a_job_has_been_reassigned;
		
	} // END FUNCTION
	
} // END CLASS

class jobs_files extends his
{
	public $obj_key_type='hashrange';
	public $id_job='undefined';
	public $id='undefined';
	public $str_file='undefined';
}
class user_server_service extends his
{
	public $obj_key_type='hashrange';
	public $id_user_server='undefined';
	public $service_name='undefined';
	public $service_enabled='undefined';
}
class user_server extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $name='undefined';
	public $last_ping='undefined';
	public $force_restart='undefined';
	public $str_log='undefined';
	public $ip_address='undefined';
	public $id_sk='undefined';
	public $int_routable='0';
	public $is_busy='0';
	public $int_online='1';
	public $software_version='0';

	public function create($props, $mode_raw=false)
	{
		parent::create($props,$mode_raw);
		$this->refresh_assignments(true);
	}
	public function delete()
	{
		$this->refresh_assignments(false);
		parent::delete();
	}

	public function refresh_assignments($mode_create=true)
	{
		$id_user = $this->id_user;
		$assign_servers = new assign_server();
		$curr_assign_servers = $assign_servers->get_from_hashrange($id_user,$this->name,"BEGINS_WITH");
		if ($curr_assign_servers && count($curr_assign_servers)>0 )
		{
			foreach ($curr_assign_servers as $curr_assign_server)
			{
				$del_assign_server = new assign_server();
				$del_assign_server->set($curr_assign_server);
				if ($del_assign_server->id_user!="undefined")
				{
					$del_assign_server->delete();
				}
				$curr_assign_server_split = explode("@",$curr_assign_server['server_hf']);
				if ($curr_assign_server_split)
				{
					$curr_hf=$curr_assign_server_split[1];
					$curr_svr=$curr_assign_server_split[0];
					$del_assign_hf = new assign_hf();
					$del_assign_hf->get_from_hashrange( $id_user, $curr_hf.'@'.$curr_svr );
					if ($del_assign_hf->id_user!="undefined")
					{
						$del_assign_hf->delete();
					}
				}
			}
		}
		if (!$mode_create)
		{
			return;
		}

		// LOOP THROUGH ALL FUNCTIONS
		$user_function = new hf_id_user();
		$user_functions = $user_function->get_from_hashrange($id_user);
		foreach ($user_functions as $user_function)
		{
			$hf_obj=new hf_id_user();
			$hf_obj->set($user_function);
			if ($hf_obj->id!="undefined")
			{
				$hf_obj->build( array("obj_expression","obj_hf_parameters","bj_hf_tags","obj_hf_files","obj_hf_kill","obj_hf_resources","obj_cache_out_xml","obj_cache_out_cxml","obj_cache_approved","obj_cache_latest","obj_cache_ad","obj_fastresponse") );

				$passed_filter=false;
				if ($hf_obj->obj_hf_node_filters)
				{
					if ( count($hf_obj->obj_hf_node_filters)>0 )
					{
						$passed_filter=false;
						foreach ($hf_obj->obj_hf_node_filters as $node_filter)
						{
							if ( strpos($this->name,$node_filter->value)!==FALSE)
							{
								$passed_filter=true;
								break;
							}
						} // end foreach (each filter)
					} // end if (filter count)
					else
					{
						$passed_filter=true;
					}
					
				}
				else
				{
					$passed_filter=true;
				}
	
				if ($passed_filter)
				{
					if ($hf_obj->obj_hf_system_kind)
					{
						$found_matched_sk=false;
						foreach ($hf_obj->obj_hf_system_kind as $hsk)
						{
							if ($hsk->id_sk==$this->id_sk||$hsk->id_sk=="any")
							{
								$found_matched_sk=true;
								break;
							}
						}
                        if ( count($hf_obj->obj_hf_system_kind) == 0 )
                        {
                            $found_matched_sk = true;
                        }
						if (!$found_matched_sk)
						{
							$passed_filter=false;
						}
					}
				}

				if ($passed_filter)
				{
					$new_assign_hf = new assign_hf();
					$new_assign_hf->create( array("id_user"=>$id_user,"hf_server"=>$hf_obj->id."@".$this->name ) );
					$new_assign_svr = new assign_server();
					$new_assign_svr->create( array("id_user"=>$id_user,"server_hf"=>$this->name."@".$hf_obj->id) );
				}


			} // function is not undefined
		} // end foreach (each function)

	}
}
class ph_parent extends his
{
	public $obj_key_type='hashrange';
	public $id_parent_job='undefined';
	public $id_child_job='undefined';
	public $placeholder='undefined';
}
class ph_child extends his
{
	public $obj_key_type='hashrange';
	public $id_child_job='undefined';
	public $id_parent_job='undefined';
	public $placeholder='undefined';
}
class job_flag extends his
{
	public $obj_key_type='hash';
	public $id_job='undefined';
	public $flag='undefined';
	public $status='undefined';
}
class match_custom extends his
{
	public $obj_key_type='hashrange';
	public $id_expr='undefined';
	public $idx_key='undefined';
	public $str_txt='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!isset($this->obj_inherited) || !$this->obj_inherited)
		{
			$retval="\t\t\t<".get_class($this).$localprops.">\n";
			/* foreach ($this->obj_system_kinds as $sk)
			{
				$retval=$retval.$sk->toxml();
			}*/
			$retval=$retval."\t\t\t</".get_class($this).">\n";
		}
		return $retval;
	}


}
class match_entry extends his
{
	public $obj_key_type='hashrange';
	public $id_expr='undefined';
	public $idx_id='undefined';
	public $id_entry_type='undefined';
	public $id_entry_subtype='undefined';
	public $int_order='undefined';
	public function rcreate($props,$mode_raw=false)
	{
		$this->create($props,true);
		foreach ($this->obj_me_settings as &$mes)
		{
			$mes->rcreate($mes->member_value_array(),true);
		}
		if ( isset($this->obj_expression) && get_class($this->obj_expression)=="strings" )
		{
			$this->obj_expression->rcreate($this->obj_expression->member_value_array(),true);
		}
	}
	public function delete()
	{
		if (isset($this->obj_me_settings))
		{
			foreach ($this->obj_me_settings as $ms)
			{
				$ms->delete();
			}
		}
		if ( isset($this->obj_expression) )
		{
			if ( isset($this->obj_expression->obj_version) )
			{
				$this->obj_expression->delete();
			}
		}
		parent::delete();
	}

	public function give_ids()
	{
		global $APP;
		$found_expression_id_and_set = "";
		foreach ($this->obj_me_settings as &$me)
		{
			$me->id_me = $this->id_expr."@".$this->idx_id;
			if ($me->name=="str_expression")
			{
				if ( isset( $this->obj_expression) )
				{
					$found_expression_id_and_set=sha1(microtime().$this->int_order.$this->id_expr.$this->idx_id.rand(1,1000));
					$this->obj_expression->id=$found_expression_id_and_set;

					$sha1_string=sha1(microtime().$this->obj_expression->id.$me->name.$this->obj_expression->val.rand(3,1000));
					$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".txt";
					$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
					$APP['fs']->create_object(false,$bucket_name,$keyname,$this->obj_expression->val,"text/plain");
					$string_url=$APP['fs']->key_url($bucket_name,$keyname);
					$this->obj_expression->val=$string_url;

					$this->obj_expression->give_ids();
					$me->str_value = $this->obj_expression->id;
				}
			}
			else
			{
				/*
				if ( isset($this->obj_expression->val) )
				{
					//echo "<pre>";
					//print_r($this);
					$sha1_string=sha1(microtime().$me->id_me.$me->name.rand(3,1000));
					$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".txt";
					$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
					$APP['fs']->create_object(false,$bucket_name,$keyname,$this->obj_expression->val,"text/plain");
					$string_url=$APP['fs']->key_url($bucket_name,$keyname);

					$sha2_string=sha1(microtime().$string_url.$me->name.rand(3,1000));

					$NEW_STRING = new strings();
					$props=array();
					$props['id']=$sha2_string;
					$props['val']=$string_url;
					$NEW_STRING->create($props);

					$me->str_value=$sha2_string;
				}
				else
				{
				*/
					$sha1_string=sha1(microtime().$me->id_me.$me->name.rand(3,1000));
					$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".txt";
					$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
					$APP['fs']->create_object(false,$bucket_name,$keyname,$me->str_value,"text/plain");
					$string_url=$APP['fs']->key_url($bucket_name,$keyname);

					$sha2_string=sha1(microtime().$string_url.$me->name.rand(3,1000));

					$NEW_STRING = new strings();
					$props=array();
					$props['id']=$sha2_string;
					$props['val']=$string_url;
					$NEW_STRING->create($props);

					$me->str_value=$sha2_string;
				//}
			}
		} // END FOREACH
		/*
		if ($found_expression_id_and_set!="")
		{
			//echo "<pre>";
			//print_r($this);
			$sha1_string=sha1(microtime().$me->id_me.$me->name.rand(3,1000));
			$keyname=$GLOBALS['settings'][$APP['fs']->kind]['paths']['strings']['@attributes']['value']."/".$sha1_string.".txt";
			$bucket_name=$GLOBALS['settings'][$APP['fs']->kind][$APP['fs']->bucket_syntax()]['@attributes']['value'];
			$APP['fs']->create_object(false,$bucket_name,$keyname,$this->obj_expression->val,"text/plain");
			$string_url=$APP['fs']->key_url($bucket_name,$keyname);

			$sha2_string=sha1(microtime().$string_url.$me->name.rand(3,1000));

			$NEW_STRING = new strings();
			$props=array();
			$props['id']=$sha2_string;
			$props['val']=$string_url;
			$NEW_STRING->create($props);

			$me->str_value=$sha2_string;
		
		}
		*/
		
	} // END FUNCTION
	public function build($obj_build_exclude=array())
	{
		$me_setting=new me_setting();
		$all_me_settings= $me_setting->get_from_hashrange($this->id_expr."@".$this->idx_id);
		$this->obj_me_settings=array();
		if ( is_array($all_me_settings) )
		{
			foreach ($all_me_settings as $each_mes)
			{
				$a_mes= new me_setting();
				$a_mes->set( $each_mes );
				$a_mes->build();
				$this->obj_me_settings[$a_mes->name]=$a_mes;
			}
		}
		parent::build($obj_build_exclude);
		if ( isset($this->obj_me_settings['str_expression']) )
		{
			if ( $this->obj_me_settings['str_expression']!='undefined' )
			{
				$this->hash_to_expression_tree($this->obj_me_settings['str_expression']->obj_value->id);
			}
		}

	}
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			//if ($member=="idx_id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$val = $this->$member;
				if ($member=="idx_id")
				{
					$vals=explode("#",$val);
					$val=$vals[0];
				}
				$localprops=$localprops." $member='".$val."'";
			}
		}
		if ( !isset($this->obj_inherited) || !$this->obj_inherited)
		{
			$retval="\t\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t\t\t<me_settings>\n";
			foreach ($this->obj_me_settings as $mes)
			{
				$retval=$retval.$mes->toxml();
			}
			$retval=$retval."\t\t\t\t</me_settings>\n";
			if (isset($this->obj_expression))
			{
				if ($this->obj_expression)
				{
					$retval=$retval.$this->obj_expression->toxml(true);
				}
			}
			$retval=$retval."\t\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	public function create_from_xml_array($data)
	{
		parent::create_from_xml_array($data);
		$this->obj_me_settings=array();

		// me_setting 
		if ( isset($data['me_settings']) )
		{
			if ( isset($data['me_settings']['me_setting']) )
			{
				if ( isset($data['me_settings']['me_setting']['@attributes']) )
				{
					$me_setting= new me_setting();
					$me_setting->obj_version = $this->obj_version;
					$me_setting->create_from_xml_array($data['me_settings']['me_setting']);
					$this->obj_me_settings[]=$me_setting;
				}
				else
				{
					foreach ($data['me_settings']['me_setting'] as $mset)
					{
						$me_setting= new me_setting();
						$me_setting->obj_version = $this->obj_version;
						$me_setting->create_from_xml_array($mset);
						$this->obj_me_settings[]=$me_setting;
					}
				}
			}
		}

		$str_expression_found = false;
		foreach ($this->obj_me_settings as $mes)
		{
			if ($mes->name=="str_expression")
			{
				$str_expression_found=true;
			}
		}
		if ( $str_expression_found || isset($data['hf_expression']) )
		{
			if ( isset($data['hf_expression']['@attributes']) )
			{
				if ( isset($data['hf_expression']['@attributes']['val']) )
				{
					//$this->str_expression = $data['hf_expression']['@attributes']['val'];
					$new_expression = new strings();
					$new_expression->obj_version = $this->obj_version;
					$new_expression->create_from_xml_array( $data['hf_expression'] );
					$this->obj_expression = $new_expression;
				}
			}
		}

	} // end function

}
class me_setting extends his
{
	public $obj_key_type='hashrange';
	public $id_me='undefined';
	public $name='undefined';
	public $str_value='undefined';
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
        if ( isset($this->obj_value->body) )
        {
            $this->value = $this->obj_value->body;
        }
		//$this->obj_expression->value=replace_hf_parameters($this->obj_expression->body,$this->obj_hf_parameters);
		//send-any-value-http
	}
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="idx_id") continue;
			if ($member=="id_me") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!isset($this->obj_inherited) || !$this->obj_inherited)
		{
			$retval="\t\t\t\t\t<".get_class($this).$localprops.">\n";
			//$retval=$retval."\t\t\t\t<me_settings>\n";
			/*foreach ($this->obj_me_settings as $me)
			{
				$retval=$retval.$me->toxml();
			}*/
			//$retval=$retval."\t\t\t\t</me_settings>\n";
			$retval=$retval."\t\t\t\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
}
class hfp_vcs extends his
{
	public $obj_key_type='hashrange';
	public $id_hf_parameter='undefined';
	public $id='undefined';
	public $id_constraint_type='undefined';
	public $str_constraint_text='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_hf_parameter") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
		{
			$retval="\t\t\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t\t\t</".get_class($this).">\n";
		}
		return $retval;
	}

}
class hf_node_filter extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $str_filter='undefined';
	
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!isset($this->obj_inherited) || !$this->obj_inherited)
		{
			$retval="<".get_class($this).$localprops.">";
			$retval=$retval."</".get_class($this).">\n";
		}
		return $retval;
	}
	
}
class hfp_hf extends his
{
	public $obj_key_type='hashrange';
	public $parameter_name='undefined';
	public $id_hf='undefined';
}
class hf_parameter extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $keyword='undefined';
	public $parameter_name='undefined';
	public $str_default_value='undefined';
	public $int_preserve_encode='0';
	public $int_immutable='0';
	public $int_mandatory='0';
	
	public function update($new_props,$mode_raw=false)
	{
		global $u;
		// remove hfp_hf entry for old keyword
		$old_hfp = new hfp_hf();
		$old_hfp->get_from_hashrange($u->id_user."@".$this->keyword,$this->id_hf,"BEGINS_WITH");
		if ($old_hfp->id_hf!="undefined")
		{
			$old_hfp->delete();
		}
		parent::update($new_props,$mode_raw);
		$new_hfp = new hfp_hf();
		$props=array();
		$props["parameter_name"]=$u->id_user."@".$this->keyword;
		$props["id_hf"]=$this->id_hf."@".substr(sha1(microtime().$this->id_hf.$this->keyword),0,5);
		$new_hfp->create($props);
	}
	public function create($props,$mode_raw=false)
	{
		global $u;
		parent::create($props,$mode_raw);
		// index building (keyword)
		$new_hfp = new hfp_hf();
		$props=array();
		$props["parameter_name"]=$u->id_user."@".$this->keyword;
		$props["id_hf"]=$this->id_hf."@".substr(sha1(microtime().$this->id_hf.$this->keyword),0,5);
		$new_hfp->create($props);
	}
	public function delete()
	{
		global $u;
		// index building (keyword)
		//echo $u->id_user."@".$this->keyword." AND ".$this->id_hf;
		$old_hfp = new hfp_hf();
		$old_hfp->get_from_hashrange($u->id_user."@".$this->keyword,$this->id_hf,"BEGINS_WITH");
		if ($old_hfp->id_hf!="undefined")
		{
			$old_hfp->delete();
		}
		if ( isset($this->obj_hfp_vcs) && $this->obj_hfp_vcs )
		{
			foreach($this->obj_hfp_vcs as $hfp_vcs)
			{
				$hfp_vcs->delete();
			}
		}
		parent::delete();
	}
	
	public function rcreate($props,$mode_raw=false)
	{
		$this->create($props);
		foreach ($this->obj_hfp_vcs as &$constraint)
		{
			$constraint->rcreate($constraint->member_value_array());
		}
	}
	public function create_from_xml_array($data)
	{
		parent::create_from_xml_array($data);
		$this->obj_hfp_vcs=array();
		if ( isset($data['constraints']) )
		{
			if ( isset($data['constraints']['hfp_vcs']) )
			{
				if ( isset($data['constraints']['hfp_vcs']['@attributes']) )
				{
					$new_constraint = new hfp_vcs();
					$new_constraint->obj_version = $this->obj_version;
					$new_constraint->create_from_xml_array($data['constraints']['hfp_vcs']);
					$this->obj_hfp_vcs[]=$new_constraint;
				}
				else
				{
					foreach ($data['constraints']['hfp_vcs'] as $hfp_constraint)
					{
					$new_constraint= new hfp_vcs();
					$new_constraint->obj_version = $this->obj_version;
					$new_constraint->create_from_xml_array($hfp_constraint);
					$this->obj_hfp_vcs[]=$new_constraint;
					}
				}
			}
		}

	}
	public function toxml()
	{
		$localprops="";
		$retval="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			//$localprops=$localprops.$member."=".var_export($this->$member,true);
			if ($member=="id_hf") continue;
			if ($member=="id") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_member=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".htmlentities($this->$obj_member->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".htmlentities($this->$member)."'";
			}
		}

		if (!isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
		{
			$retval="\t\t<".get_class($this).$localprops.">\n";

			$retval=$retval."\t\t\t<constraints>\n";
			foreach ($this->obj_hfp_vcs as $constraint)
			{
				$retval=$retval.$constraint->toxml();
			}
			$retval=$retval."\t\t\t</constraints>\n";

			$retval=$retval."\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	public function merge($sibling_params)
	{
        global $system_adjacent_dictionary_keys;
        global $adjacent_dictionary;
        
		if ( $sibling_params && count($sibling_params)>0 )
		{
			foreach ($sibling_params as $sibling_param)
			{
				if ($sibling_param->keyword!=$this->keyword)
				{
					$this->value = str_replace($sibling_param->keyword,$sibling_param->value,$this->value);
				}
			}
		}
		if ( $adjacent_dictionary && count($adjacent_dictionary)>0 )
		{
			foreach ($adjacent_dictionary as $adj_dict_entry_key=>$adj_dict_entry_value)
			{
				$this->value = str_replace($adj_dict_entry_key,$adj_dict_entry_value,$this->value);
			}
		}
	}
	public function build($obj_build_exclude=array())
	{
		global $APP;
		global $hf_parameters_given;

		parent::build($obj_build_exclude);
		$this->obj_hfp_vcs=array();
		$hfp_vcs=new hfp_vcs();
		$all_constraints = $hfp_vcs->get_from_hashrange($this->id);

		if ( is_array($all_constraints) )
		{
			foreach ($all_constraints as $each_constraint )
			{
				$a_hfp_vcs= new hfp_vcs();
				$a_hfp_vcs->set( $each_constraint );
				$a_hfp_vcs->build();
				$this->obj_hfp_vcs[]=$a_hfp_vcs;
			}
		}
		$hfp_name=$this->parameter_name;

		// hf parameter given
		$_POSTGET=array();
		foreach ($_GET as $GK=>$GV)
		{
			$_POSTGET[$GK]=$GV;
		}
		foreach ($_POST as $PK=>$PV)
		{
			$_POSTGET[$PK]=$PV;
		}
		if ( isset($_POSTGET[$hfp_name]) && intval($this->int_immutable)==0 )
		{
			if (intval($this->int_preserve_encode)==0)
			{
				$this->value=$_POSTGET[$hfp_name];
			}
			else
			{
				if (urlencode($_POSTGET[$hfp_name])!=$_POSTGET[$hfp_name])
				{
					$this->value=urlencode($_POSTGET[$hfp_name]);
				}
				else
				{
					$this->value=$_POSTGET[$hfp_name];
				}
			}
			$hf_parameters_given=true;
			$mode_short=false;
		}
		else
		{
			// hf parameter value not given
			// or hf parameter is immutable (will always have default value)
			// only in edit mode, does "user id" make any sense :(
			if ( false ) //$q->id_user!=$u->id_user && is_secret($this->keyword) )
			{
				$this->value="123";
			}
			else
			{
				$default_value=$this->obj_default_value->body;
				$this->value=$default_value;
				if (intval($this->int_preserve_encode)==0)
				{
					$this->value=urldecode($default_value);
				}
				else
				{
					$this->value=$default_value;
				}
			}
		} // hf parameter given in arguments
		
		if ( is_secret($this->keyword) )
		{
			$this->printable_value="*****";
		}
		else
		{
			$this->printable_value=$this->value;
		}

		// get value constraints
		$parameter_constraints=$this->obj_hfp_vcs;
		$validated_value="";
		if ( count($parameter_constraints) > 0 )
		{
			if ( isset($this->value) )
			{
				$fstr="".$this->value."";
				if ( strlen(($fstr))>0 )
				{
					for ($fstri=0;$fstri<strlen($fstr);$fstri++)
					{
						$character=substr($fstr,$fstri,1);
						$bMatch=false;
						$bEnforceRules=false;
						if ( is_array($parameter_constraints) )
						{
							foreach ($parameter_constraints as $parameter_constraint)
							{
								// 1 allow alphanumeric
								// 2 allow spaces
								// 3 allow numbers
								// 4 allow alphabetic characters
								// 5 allow the following special characters:
								if (($parameter_constraint->id_constraint_type)=="allow-alphanum")
								{
									$bEnforceRules=true;
									// allow alphanumeric
									if ( ctype_alnum($character) )
									{
											$bMatch=true;
									}
									else
									{
											$bMatch=false;
									}
								}
								else if (($parameter_constraint->id_constraint_type)=='allow-space')
								{
									$bEnforceRules=true;
									// allow spaces
									if ( $character==" " )
									{
										$bMatch=true;
									}
								}
								else if (($parameter_constraint->id_constraint_type)=='allow-num')
								{
									$bEnforceRules=true;
									// allow numbers
									if ( is_numeric($character) )
									{
										$bMatch=true;
									}
								}
								else if (($parameter_constraint->id_constraint_type)=='allow-alpha')
								{
									$bEnforceRules=true;
									// allow alphabetic
									if ( ctype_alpha($character) )
									{
										$bMatch=true;
									}
								}
								else if (($parameter_constraint->id_constraint_type)=='allow-special')
								{
									$bEnforceRules=true;
										// allow the following characters
									$ctxt=$parameter_constraint->obj_constraint_text->body;
									for ($i=0;$i<strlen($ctxt);$i++)
									{
										$ctxc=substr($ctxt,$i,1);
										if ($character==$ctxc)
										{
											$bMatch=true;
											break;
										}
									}
								}
								if ($bMatch)
								{
										break;
								}
							}  // end foreach (each constraint on parameter)
						} // end if (is array)
						if ($bMatch || !$bEnforceRules)
						{
							$validated_value=$validated_value.$character;
						}
					} // foreach (each character in value)
					$this->value=$validated_value;
				} // end if (string longer than 0 length)
			} // end if (hf parameter value isset)
		} // end if (any constraints)
		else
		{
			$validated_value=$this->value;
		}
		$bMatches=true;
		if ( is_array($parameter_constraints) )
		{
			foreach ($parameter_constraints as $parameter_constraint)
			{
				// 5 disallowed string
				// 6 must match regular expression
				if ($parameter_constraint->id_constraint_type == 'disallowed-str' )
				{
					// 5 disallowed string
					if (strpos($validated_value,$parameter_constraint->obj_constraint_text->body)!==false)
					{
						$bMatches=false;
					}
				} // end if (constraint type)
				else if ( $parameter_constraint->id_constraint_type == 'match-regex' )
				{
					// 6 must match regular expression
					if ( preg_match($parameter_constraint->obj_constraint_text->body,$validated_value)==0 )
					{
						$bMatches=false;
					}
				} // end if (constraint type)
				if (!$bMatches)
				{
					break;
				}
			} // foreach (parameter constraint)
		} // end if (count param constraints)

		if (!$bMatches)
		{
			// hf parameter value not given
			// only in edit mode does "user id" make any sense :(
			if ( false ) //$->id_user!=$this_user->ID && is_secret($this->keyword) )
			{
				$this->value="123";
			}
			else
			{
				if (intval($this->int_preserve_encode)==0)
				{
					$this->value=urldecode($this->obj_default_value->body);
				}
				else
				{
					$this->value=$this->obj_default_value->body;
				}
			}
		} // end if (constraint types 5 or 6 failed validation) - restore default values



	}
}
class hf_password extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $str_pass='undefined';
}
class hf_kill extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $str_name='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}

		if (!$this->obj_inherited)
		{
			$retval="\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	public function build($obj_build_exclude=array())
	{
		parent::build($obj_build_exclude);
/*
		if ( isset($this->obj_hf) )
		{
			echo "FUNCTION FOUND";
			print_r($this->obj_hf->obj_hf_parameters);
		}
*/
	}
}
class hf_tag extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $str_tag='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$localprops=$localprops." $member='".toxmlvalue($this->$obj_name->body)."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!$this->obj_inherited)
		{
			$retval="\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
}
class user_system_kind extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $id='undefined';
	public $name='undefined';
	public $detection_text='undefined';
}
class assign_hf extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $hf_server='undefined';
}
class assign_server extends his
{
	public $obj_key_type='hashrange';
	public $id_user='undefined';
	public $server_hf='undefined';
}
class hf_inherit extends his
{
	public $obj_key_type='hashrange';
	public $id_hf='undefined';
	public $id='undefined';
	public $id_inherit='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			//$localprops=$localprops.$member."=".var_export($this->$member,true);
			if ($member=="id_hf") continue;
			if ($member=="id") continue;
			if (strpos($member,"id_inherit")===0)
			{
				//$obj_member=str_replace("str_","obj_",$member);
				$inherited_hf = new hf_id_user();
				$inherited_hf->get_from_hashrange($GLOBALS['u']->id_user,$this->$member);
				$inherit_val=$inherited_hf->name;
				$localprops=$localprops." name='".htmlentities($inherit_val)."'";
			}
			else
			{
				$localprops=$localprops." $member='".htmlentities($this->$member)."'";
			}
		}
		if (!isset($this->obj_inherited) || (isset($this->obj_inherited) && !$this->obj_inherited) )
		{
			$retval="\t\t<".get_class($this).$localprops.">";
			$retval=$retval."</".get_class($this).">\n";
		}
		return $retval;
	}


	public function identify_overrides(&$obj,$collection_name,$member_name)
	{
			$member_chain = array();
			if ( strpos($member_name,"->")===false)
			{
				$member_chain[]=$member_name;
			}
			else
			{
				$member_items = explode("->",$member_name);
				$member_chain = $member_items;
			}

			// mark any inheritted param if a non-inherited param has same name
			// get non-inherited names
			$inherited_param=array();
			foreach ($obj->$collection_name as $aco)
			{
				if ( isset( $aco->obj_inherited) )
				{
					if ( $aco->obj_inherited )
					{
						if ( count($member_chain)==1)
						{
							$inherited_param[]=$aco->$member_name;
						}
						if ( count($member_chain)==2)
						{
							$inherited_param[]=$aco->$member_chain[0]->$member_chain[1];
						}
					}
				}
			}
					$non_inherited_param=array();
			foreach ($obj->$collection_name as $aco)
			{
				if ( !isset( $aco->obj_inherited) )
				{
					if ( count($member_chain)==1)
					{
						$non_inherited_param[]=$aco->$member_name;
					}
					if ( count($member_chain)==2)
					{
						$non_inherited_param[]=$aco->$member_chain[0]->$member_chain[1];
					}
				}
				else if ( !$aco->obj_inherited )
				{
					if ( count($member_chain)==1)
					{
						$non_inherited_param[]=$aco->$member_name;
					}
					if ( count($member_chain)==2)
					{
						$non_inherited_param[]=$aco->$member_chain[0]->$member_chain[1];
					}
				}
			}

			$overridden_params=array();
			foreach ($inherited_param as $ip)
			{
				foreach ($non_inherited_param as $nip)
				{
					if ($ip==$nip)
					{
						$overridden_params[]=$nip;
					}
				}
			}
			// set overridden property
			foreach ($overridden_params as $overridden_param)
			{
				foreach ($obj->$collection_name as &$aco)
				{
					if ( (count($member_chain)==1 && $aco->$member_name==$overridden_param  ) || (count($member_chain)==2 && $aco->$member_chain[0]->$member_chain[1]==$overridden_param  )  )
					{
						if ( isset($aco->obj_inherited) )
						{
							if ( $aco->obj_inherited )
							{
								$aco->obj_overridden=true;
							}
						}
					}
				}
			}
	}
	public function assimilate(&$obj,$obj_build_exclude=array())
	{
		//echo "ASSIMILATE";
		//echo "<pre>";
		//print_r($obj);
		// obj is child function
		// new_hf is the inherited (parent) function who will grant its properties to the child
		$new_hf=new hf_id_user();
		$new_hf->get_from_hashrange($obj->id_user,$this->id_inherit);
		if ($new_hf->id!="undefined")
		{
			//echo "NOT BLANK";
			$new_hf->build($obj_build_exclude,false); // dont let the parent do substitutions on its own data
			//echo "FUNCTION ".$new_hf->name." IS ASSIMILATING ONTO FUNCTION ".$obj->name;
			//print_r($new_hf);
			foreach ($new_hf->obj_hf_parameters as &$parent_hf_parameter)
			{
				$parent_hf_parameter->obj_inherited=true;
				$parent_hf_parameter->obj_inherited_from_name=$new_hf->name;
				$parent_hf_parameter->obj_inherited_from_id=$new_hf->id;
				$obj->obj_hf_parameters[]=$parent_hf_parameter;
			} // end for
			$this->identify_overrides($obj,"obj_hf_parameters","parameter_name");
			
			foreach ($new_hf->obj_hf_node_filters as &$parent_node_filter)
			{
				$parent_node_filter->obj_inherited=true;
				$parent_node_filter->obj_inherited_from_name=$new_hf->name;
				$parent_node_filter->obj_inherited_from_id=$new_hf->id;
				$obj->obj_hf_node_filters[]=$parent_node_filter;
			} // end for

			foreach ($new_hf->obj_hf_files as &$parent_hf_file)
			{
				$parent_hf_file->obj_inherited=true;
				$parent_hf_file->obj_inherited_from_name=$new_hf->name;
				$parent_hf_file->obj_inherited_from_id=$new_hf->id;
				$obj->obj_hf_files[]=$parent_hf_file;
			} // end for

			foreach ($new_hf->obj_hf_kill as &$parent_hf_kill)
			{
				$parent_hf_kill->obj_inherited=true;
				$parent_hf_kill->obj_inherited_from_name=$new_hf->name;
				$parent_hf_kill->obj_inherited_from_id=$new_hf->id;
				$obj->obj_hf_kill[]=$parent_hf_kill;
			} // end for

			foreach ($new_hf->obj_hf_resources as &$parent_hf_resource)
			{
				$parent_hf_resource->obj_inherited=true;
				$parent_hf_resource->obj_inherited_from_name=$new_hf->name;
				$parent_hf_resource->obj_inherited_from_id=$new_hf->id;
				// obj is child
				// new_hf is the parent
				foreach ($obj->obj_hf_resources as &$current_res)
				{
					if (!isset($current_res->obj_inherited) || !$current_res->obj_inherited)
					{
						if ($current_res->id==$parent_hf_resource->id)
						{
							$parent_hf_resource->obj_overpowered=true;
							$current_res->obj_overpowering = true;
							$current_res->obj_inherited_from_name = $new_hf->name;
							$current_res->obj_inherited_from_id= $new_hf->id;
							$parent_hf_resource->str_filename = $current_res->str_filename;
							$parent_hf_resource->obj_filename = $current_res->obj_filename;
							//$current_res->str_location = $parent_hf_resource->str_location;
							//$current_res->obj_location = $parent_hf_resource->obj_location;
						}
					}
				}
				$obj->obj_hf_resources[]=$parent_hf_resource;
			} // end for
			$this->identify_overrides($obj,"obj_hf_resources","obj_filename->body");

			foreach ($new_hf->obj_hf_system_kind as &$parent_hf_system_kind)
			{
				$parent_hf_system_kind->obj_inherited=true;
				$parent_hf_system_kind->obj_inherited_from_name=$new_hf->name;
				$parent_hf_system_kind->obj_inherited_from_id=$new_hf->id;
				$obj->obj_hf_system_kind[]=$parent_hf_system_kind;
			} // end for

			$inherited_hf_system_kinds=array();
			foreach ($obj->obj_hf_system_kind as &$a_hf_system_kind)
			{
				if ( isset($a_hf_system_kind->obj_inherited_from_id) )
				{
					if ( !isset($inherited_hf_system_kinds[$a_hf_system_kind->obj_inherited_from_id]) )
					{
						$inherited_hf_system_kinds[$a_hf_system_kind->obj_inherited_from_id]=array();
					}
					$inherited_hf_system_kinds[$a_hf_system_kind->obj_inherited_from_id][]=$a_hf_system_kind->id_sk;
				}
			} // END FOREACH

            if ( count($inherited_hf_system_kinds)>1 )
            {    
                $inheritance_intersection=call_user_func_array('array_intersect', $inherited_hf_system_kinds);

		if ( count($inheritance_intersection)>0 )
		{
			foreach ($obj->obj_hf_system_kind as &$a_hf_system_kind)
			{
				if ( in_array($a_hf_system_kind->id_sk,$inheritance_intersection) )
				{
					$a_hf_system_kind->obj_enabled=true;
				}
				else
				{
					$a_hf_system_kind->obj_enabled=false;
				}
			}
		}
		else
		{
			foreach ($obj->obj_hf_system_kind as &$a_hf_system_kind)
			{
				//if ( isset($a_hf_system_kind->obj_inherited_from_id) )
				//{
				//	$a_hf_system_kind->obj_enabled=false;
				//}
				//else
				//{
					$a_hf_system_kind->obj_enabled=true;
				//}
			}
		}
            }

			
		} // end if (function is not undefined)
	} // end function
} // end class

class hf_file extends his
{
	public $obj_key_type="hashrange";
	public $id_hf='undefined';
	public $id='undefined';
	public $str_file='undefined';
	public $str_targetfile='undefined';
	public function toxml()
	{
		$localprops="";
		$member_list=$this->member_list($this);
		foreach ($member_list as $member)
		{
			if ($member=="id_user") continue;
			if ($member=="id_resource") continue;
			if (strpos($member,"id_hf")===0) continue;
			if ($member=="id") continue;
			if ($member=="id_expr") continue;
			if (strpos($member,"str_")===0)
			{
				$obj_name=str_replace("str_","obj_",$member);
				$xml_value="";
				if ($member=="str_file")
				{
					$xml_value = base64_encode($this->$obj_name->body);
				}
				else
				{
					$xml_value = toxmlvalue($this->$obj_name->body);
				}
				$localprops=$localprops." $member='".$xml_value."'";
			}
			else
			{
				$localprops=$localprops." $member='".$this->$member."'";
			}
		}
		if (!isset($this->obj_inherited) || !$this->obj_inherited)
		{
			$retval="\t\t<".get_class($this).$localprops.">\n";
			$retval=$retval."\t\t</".get_class($this).">\n";
		}
		return $retval;
	}
	public function build($obj_build_exclude=array())
	{
		if ( !in_array("body",$obj_build_exclude) )
		{
			$obj_build_exclude[]="body";
		}
		parent::build($obj_build_exclude);
		if ($this->obj_targetfile)
		{
			$this->obj_targetfile->build();
		}
		$default_filename=false;
		if (!isset($this->obj_targetfile->body))
		{
			$default_filename=true;
		}
		else if ( strlen(trim($this->obj_targetfile->body))==0 )
		{
			$default_filename=true;
		}
		if ($default_filename)
		{
			$url_to_file=$this->obj_file->val;
			$filename_parts=explode("/",$url_to_file);
			$filename=$filename_parts[count($filename_parts)-1];
			$pos_of_first_dot=strpos($filename,".")+1;
			$filename=substr($filename,$pos_of_first_dot);
			if (!isset($this->obj_targetfile))
			{
				$this->obj_targetfile=new strings();
			}
			if (!isset($this->obj_targetfile->body))
			{
				$this->obj_targetfile=new strings();
			}
			$this->obj_targetfile->body=$filename;
		}
	}


    public function fromobjectxml($data)
    {
        parent::fromobjectxml($data);
        if ( strpos($this->str_targetfile,".")!==FALSE)
        {
            $dot_split = explode(".",$this->str_targetfile);
            $new_ext = $dot_split[ count($dot_split)-1 ];
            
            $this->str_targetfile=$this->str_targetfile.".".$new_ext;
        } // END IF
    } // END FUNCTION
    
}


function mesort($a, $b) {
	if ($a->int_order == $b->int_order) {
		return 0;
	}
	return ($a->int_order < $b->int_order) ? -1 : 1;
}
class SelectComparison
{
	public $field;
	public $comparison; // EQUAL or BEGINS_WITH
	public $value;
	public function __construct()
	{
	}

}



class Service
{
	public $name="";
	public $type="";
	public $enabled=true;
	public $dependencies=array();
	public $settingsfile="";
	public $icon="";
	public $home="";
	public $error="";
	public function __construct($s)
	{
		$this->name=$s['@attributes']['name'];
		$this->type=$s['@attributes']['type'];
		if ( isset($s['icon']) )
		{
			if ( isset($s['icon']['@attributes']['value']) )
			{
				$this->icon=$s['icon']['@attributes']['value'];
			}
		}
		if ( isset($s['home']) )
		{
			if ( isset($s['home']['@attributes']['value']) )
			{
				$this->home=$s['home']['@attributes']['value'];
			}
		}
		if ( isset($s['settingsfile']) )
		{
			$this->settingsfile=$s['settingsfile'];
		}
		if ( isset($s['dependencies']) )
		{
			if ( isset($s['dependencies']['dependency']) )
			{
				$dependency=$s['dependencies']['dependency'];
				$bool_many_dependencies=false;
				foreach ($dependency as $k=>$v)
				{
					if ($k.""=="0")
					{
						$bool_many_dependencies=true;
					}
					break;
				}
				if ($bool_many_dependencies)
				{
					foreach ($dependency as $each_dependency)
					{
						$this->dependencies[]=new ServiceDependency($each_dependency);
					}
				}
				else
				{
					$this->dependencies[]=new ServiceDependency($dependency);
				}
				foreach ($this->dependencies as $d)
				{
					if (!$d->enabled)
					{
						$this->enabled=false;
						if ( strlen($this->error)>0 )
						{
							$this->error=$this->error."\n";
						}
						$this->error=$this->error.$d->error;
					}
				} // foreach dependency
			} // end if (this service has dependencies)
		}
		else
		{
			$this->enabled=true;
		} // end if (this service has dependencies)
	} // end function (Service constructor)
} // end class
class ServiceDependency
{
	public $enabled=true;
	public $error="";
	public function __construct($d)
	{
        global $this_server_url;
        
		if ( isset($d['error-message']) )
		{
			if (isset($d['error-message']['@attributes']['value']))
			{
				$this->error=$d['error-message']['@attributes']['value'];
			}
		}

		if ( isset($d['php-constant-defined']) )
		{
			if (isset($d['php-constant-defined']['name']))
			{
				if (isset($d['php-constant-defined']['name']['@attributes']))
				{
					if (isset($d['php-constant-defined']['name']['@attributes']['value']))
					{
						$php_const_name=$d['php-constant-defined']['name']['@attributes']['value'];
						if ( !defined($php_const_name) )
						{
							$this->enabled=false;
						}
					}
				}
			}
		} // END IF (CONSTANT DEFINED)

		if ( isset($d['php-equation-true']) )
		{
			if (isset($d['php-equation-true']['equation']))
			{
				if (isset($d['php-equation-true']['equation']['@attributes']))
				{
					if (isset($d['php-equation-true']['equation']['@attributes']['value']))
					{
						$php_eq=$d['php-equation-true']['equation']['@attributes']['value'];
                        $php_res = eval("return ".$php_eq.";");
                        
						if ( !$php_res )
						{
							$this->enabled=false;
						}
					}
				}
			}
		} // END IF (FUNCTION EXISTS)

		if ( isset($d['php-equation-false']) )
		{
			if (isset($d['php-equation-false']['equation']))
			{
				if (isset($d['php-equation-false']['equation']['@attributes']))
				{
					if (isset($d['php-equation-false']['equation']['@attributes']['value']))
					{
						$php_eq=$d['php-equation-false']['equation']['@attributes']['value'];
                        $php_res = eval("return ".$php_eq.";");
                        
						if ( $php_res )
						{
							$this->enabled=false;
						}
					}
				}
			}
		} // END IF (FUNCTION EXISTS)
        
        
		if ( isset($d['php-function-exists']) )
		{
			if (isset($d['php-function-exists']['name']))
			{
				if (isset($d['php-function-exists']['name']['@attributes']))
				{
					if (isset($d['php-function-exists']['name']['@attributes']['value']))
					{
						$php_fun_name=$d['php-function-exists']['name']['@attributes']['value'];
						if ( !function_exists($php_fun_name) )
						{
							$this->enabled=false;
						}
					}
				}
			}
		} // END IF (FUNCTION EXISTS)
        
	} // end if (constructor)
}

class SetupPage
{
	public $page=-1;
	public $nextpage=-1;
	public $header1="";
	public $header2="";
	public $footer1="";
	public $footer2="";
	public $body="";
	public $hide_refresh=true;
	public $hide_back=false;
	public $hide_next=false;
	public $title="";
	public $pagetitle="Installation";
	public function content()
	{
		global $settings;

		$language=$_POST;
		if ( isset($settings['language']['@attributes']['value']) )
		{
			$language=$settings;
		}
		
		$footer_buttons="";
		if (!$this->hide_refresh)
		{
			$footer_buttons=$footer_buttons."<a onClick='location.reload()' class='button'>";
			$footer_buttons=$footer_buttons.getTranslation('Refresh',$language);
			$footer_buttons=$footer_buttons."</a>";
		}
		if (!$this->hide_back)
		{
			$footer_buttons=$footer_buttons."<a onClick='history.back()' class='button'>";
			$footer_buttons=$footer_buttons.getTranslation('go back',$language);
			$footer_buttons=$footer_buttons."</a>";
		}
		if (!$this->hide_next)
		{
			$footer_buttons=$footer_buttons.'<input id="btnSubmit" name="btnSubmit" type="submit" value="'.getTranslation('submit',$language).'" class="button" />';
		}
		return $this->header1.'<div style="float:right;" align="right">'.$footer_buttons.'</div>'.$this->title.$this->header2.$this->body.$this->footer1.$footer_buttons.$this->footer2;
	}
	public function generate_headers_footers()
	{
		global $settings;
		
		$intNextPage=$this->nextpage;
		$intPrevPage=$this->page-1;
		
		$language=$_POST;
		if ( isset($settings['language']['@attributes']['value']) )
		{
			$language=$settings;
		}
		
		$this->header1="<!DOCTYPE html>
			<html lang='".getTranslation('iso639',$language)."' xmlns='http://www.w3.org/1999/xhtml' >
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta http-equiv='Content-Language' Content='".getTranslation('iso639',$language)."'/>
			<title>HIS &rsaquo; ".getTranslation($this->pagetitle,$language)."</title>
			<link rel='stylesheet' href='templates/install.css?ver=0.1.1' type='text/css' />

			</head>
			<body>
			<table align='center'><tr><td valign='center' style='padding-right:10px;'>
			<img alt='HIS' src='images/his-only.png' />
			</td><td>
			<h1 id='logo' style='text-align:center;display:inline;font-size:30px;'>
		";

		$this->header1=$this->header1.getTranslation('Human Intelligence System',$language);
		$this->header1=$this->header1."</h1>
		</td></tr></table><br/>
		<form name='pageform' id='pageform' method='post' action='?page=$intNextPage'>
		";
		$this->header2="<table class='form-table'>";

		$this->footer1="</table>";
		
		$this->footer1=$this->footer1."<p class='step'>";

		
		
		if ( isset($_POST['language']) )
		{
			$this->footer2=$this->footer2."<input type='hidden' name='language' value='".$_POST['language']."'/>";
		}
		
		$this->footer2=$this->footer2."
			</p>
			</form>
			</body>
			</html>";
	
	}
	public function __construct($intThisPage,$intNextPageNum=-1)
	{
		if ($intNextPageNum==-1)
		{
			$intNextPageNum = $intThisPage + 1;
		}
		$this->page=$intThisPage;
		$this->nextpage=$intNextPageNum;
		
		$this->generate_headers_footers();

	} // end constructor
}

class ServiceConfigurator
{
	public $fields=array();
	public $settings="";
	public function __construct($services_file,$servicename)
	{
		$this->fields=array();
		$servicename=htmlspecialchars($servicename);
		$service_doc = simpledom_load_file($services_file);
		$FIELDS=array();
		foreach ($service_doc as $service)
		{
				if ($service->getAttribute('name')==$servicename)
				{
					$settings_content="";
					if ( isset($service->settingsfile) )
					{
						$settings_content=($service->settingsfile->innerXML());
					}
					$this->settings=$settings_content;
					preg_match_all("#{{(.*?)}}#",$settings_content,$matches,PREG_SET_ORDER);
					foreach ($matches as $match)
					{
						if ( count($match)==2 )
						{
							// fieldspec:
							// 1|2|3|4|5
							// 1 = fieldname
							// 2 = field text
							// 3 = field help area text
							// 4 = default value
							// 5 = image value (for help)
                            // 6 = special script/actions
                            // 7 = universality (true|false) = dictates whether or not this field will show in matchentry interfaces inside his
							$full_field_spec=$match[1];
							$fieldvals=explode("|||",$full_field_spec);
							//preg_match_all("#(.*?)\|(.*?)\|(.*?)\|(.*?)\|(.*?)\|(.*)#",$full_field_spec,$fieldvals,PREG_SET_ORDER);
							if ( count($fieldvals)==7 )
							{
								$field_name=$fieldvals[0];
								$field_text=$fieldvals[1];
								$field_help_text=$fieldvals[2];
								$field_default_value=$fieldvals[3];
								$image_value=$fieldvals[4];
								$special_content=$fieldvals[5];
								$universal_setting=$fieldvals[6];
								$SETUP_FIELD=new SetupField($field_name,$field_text,
									$field_help_text,$field_default_value,$image_value,$special_content,$universal_setting,"{{".$full_field_spec."}}");
								if ( isset($_POST[$field_name]) )
								{
									$SETUP_FIELD->value=htmlspecialchars($_POST[$field_name]);
								}
								else
								{
									$SETUP_FIELD->value=$SETUP_FIELD->defaultvalue;
								}
								$FIELDS[]=$SETUP_FIELD;
							
							} // END ALL FIELD
						} // end if (right number of entries in match array)
					} // END FOR - ALL MATCHES:  {{  }}
			} // end if matching service
		} // / end foreach (all services

		// end pasted code

		$this->fields=$FIELDS;

	} // end constructor
} // end class


class SetupField
{
	public $fieldname="";
	public $fieldtext="";
	public $helptext="";
	public $defaultvalue="";
	public $image="";
	public $value="";
	public $special="";
	public $original="";
	public $universal="";
	public function __construct($s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8)
	{
        global $this_server_url;
        
		$this->fieldname=$s1;
		$this->fieldtext=$s2;
		$this->helptext=html_entity_decode($s3);

        if ( isset($_GET['code']) )
        {
            $s4=str_replace("{code}",$_GET['code'],$s4);
        }
        else
        {
            $s4=str_replace("{code}","",$s4);
        }
        
        if (!isset($_POST[$this->fieldname]) && (strpos($s4,'$this_server_url')!==false ) )
        {
            $this->defaultvalue=eval("return $s4;");
        }
        else
        {
            $this->defaultvalue=$s4;
        }
        
		$this->image=$s5;
        
        $s6=str_replace("{uri}",$this_server_url,$s6);
        if ( isset($_GET['page']) )
        {
            $s6=str_replace("{page}",$_GET['page'],$s6);
        }
        
		$this->special=$s6;
        
        
		$this->universal=$s7;
		$this->original=$s8;
	}
}




?>
