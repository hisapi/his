<?php

$translation['updatebody']['english']='- Added option to override inherited resource names';
$translation['updatebody']['german']='- Option hinzugefügt, um geerbt Ressource-Namen überschreiben';
$translation['updatebody']['chinesesimplified']='- 添加选项来覆盖继承的资源名称';
$translation['updatebody']['bulgarian']='- Добавена възможност да се преодолеят наследените имена ресурси';

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