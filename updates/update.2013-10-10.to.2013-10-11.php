<?php

$translation['updatebody']['english']='- 1-Click online update added';
$translation['updatebody']['german']='- 1-Klick-Online-Update hinzugefügt';
$translation['updatebody']['chinesesimplified']='- 1点击在线更新';
$translation['updatebody']['bulgarian']='- 1-Click онлайн обновяване добавяне';

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
		global $settings;
	
	}

}

?>