<?php

$translation['updatebody']['english']='- Server log update message';
$translation['updatebody']['german']='- Server-Protokoll-Update-Nachricht';
$translation['updatebody']['chinesesimplified']='- 服务器更新日志消息';
$translation['updatebody']['bulgarian']='- Сървър съобщение дневника актуализация';

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
	
	}

}

?>