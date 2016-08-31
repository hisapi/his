<?php

$translation['updatebody']['english']='- Status links added to jobs list';
$translation['updatebody']['german']='- Status-Links hinzugefügt, um Arbeitsplätze Liste';
$translation['updatebody']['chinesesimplified']='- 状态链接添加到作业列表';
$translation['updatebody']['bulgarian']='- Статус връзки добавен в списъка за работни места';

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