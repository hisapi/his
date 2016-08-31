<?php

$translation['updatebody']['english']='- results return not to include new folders';
$translation['updatebody']['german']='- Ergebnisse angezeigt, keine neuen Ordner enthalten';
$translation['updatebody']['chinesesimplified']='- 结果返回不包括新的文件夹';
$translation['updatebody']['bulgarian']='- резултати се върнат да не включва нови папки';

class Update
{

	public function __construct()
	{
		global $translation;
		
	}
	
	public function notes()
	{
		global $settings;
		return getTranslation("updatebody",$settings);	
	}

	public function execute()
	{
		global $APP;
	
	}

}

?>
