<?php

$translation['updatebody']['english']='- job failure choice for jobs over time limit';
$translation['updatebody']['german']='- Job Ausfall Wahl für Arbeitsplätze Frist';
$translation['updatebody']['chinesesimplified']='- 超过时间限制的工作作业失败的选择。';
$translation['updatebody']['bulgarian']='- Изборът работа провал за работни места през срока';

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
		if ($APP['db']->connect())
		{
			if ($APP['db']->kind=="mysql")
			{
				$APP['db']->query("ALTER TABLE `hf_id_user` ADD `int_mtf` VARCHAR(1) NOT NULL DEFAULT  '1' AFTER  `int_maxruntime`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.hf_id_user ADD 
int_mtf varchar(1) NOT NULL 
DEFAULT ('1') 
GO 
EXEC hf_id_user;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   hf_id_user
ADD
  int_mtf varchar2(1) DEFAULT '1' NOT NULL;");

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE hf_id_user ADD COLUMN int_mtf character varying(1) DEFAULT '1'::character varying NOT NULL");
			}
			if ($APP['db']->kind=="mongodb")
			{
				//
			}
			if ($APP['db']->kind=="dynamodb")
			{
				//
			}
		}
	
	}

}

?>