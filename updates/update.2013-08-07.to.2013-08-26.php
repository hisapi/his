<?php

$translation['updatebody']['english']='- HIS Filter Expression Output Types Updated';
$translation['updatebody']['german']='- HIS Filter Expression Ausgang Typen Aktualisiert';
$translation['updatebody']['chinesesimplified']='- 他的过滤器表达式输出类型更新';
$translation['updatebody']['bulgarian']='- HIS Типове филтри Expression Изходни Обновено';

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