<?php

$translation['updatebody']['english']='- keyword replacement operation added';
$translation['updatebody']['german']='- Stichwort Ersatzoperation hinzugefügt';
$translation['updatebody']['chinesesimplified']='- 添加关键字替换操作';
$translation['updatebody']['bulgarian']='- дума операция подмяна на добавяне';

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
		global $settings;
		global $APP;
        
        
	
	}

}

?>
