<?php

$translation['updatebody']['english']='- HIS Job Re-assignment';
$translation['updatebody']['german']='- HIS Job Re-Zuordnung';
$translation['updatebody']['chinesesimplified']='- HIS 工作重新分配';
$translation['updatebody']['bulgarian']='- HIS Job Re-назначение';

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
				$APP['db']->query("ALTER TABLE  `hf_id_user` CHANGE  `int_wait`  `int_wait` VARCHAR( 1 ) NULL DEFAULT  '0'");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.hf_id_user CHANGE int_wait  
int_wait varchar(1) NOT NULL 
DEFAULT ('0') 
GO 
EXEC hf_id_user;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE hf_id_user ALTER COLUMN int_wait DEFAULT '0';");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE hf_id_user ALTER int_wait SET DEFAULT '0';");
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
