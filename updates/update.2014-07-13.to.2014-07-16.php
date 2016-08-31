<?php

$translation['updatebody']['english']='- New job detection optimization';
$translation['updatebody']['german']='- Neuer Job Erkennung Optimierung';
$translation['updatebody']['chinesesimplified']='- 新的工作检测优化';
$translation['updatebody']['bulgarian']='- New оптимизация за откриване на работни места';

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
		if ($APP['db']->connect())
		{
			if ($APP['db']->kind=="mysql")
			{
				$APP['db']->query("ALTER TABLE  `job_new` CHANGE  `id`  `id` VARCHAR( 100 ) NULL DEFAULT  'undefined'");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.job_new CHANGE id  
id varchar(100) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC job_new;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE job_new ALTER COLUMN id varchar2(100) DEFAULT 'undefined';");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE job_new ALTER COLUMN id SET DEFAULT 'undefined' TYPE varchar(100);");
			}
			if ($APP['db']->kind=="mongodb")
			{
			}
			if ($APP['db']->kind=="dynamodb")
			{
			}
		}
	
	}

}

?>
