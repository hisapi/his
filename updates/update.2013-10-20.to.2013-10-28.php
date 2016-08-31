<?php

$translation['updatebody']['english']='- Job max run time process killing & job retry';
$translation['updatebody']['german']='- Job Max.Laufz Prozess Tötung & Job wiederholen';
$translation['updatebody']['chinesesimplified']='- 工作最大的运行时间进程查杀及作业重试';
$translation['updatebody']['bulgarian']='- Job макс план убийството време процес и работата повторен опит';

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
				$APP['db']->query("ALTER TABLE `hf_id_user` ADD `int_retry_count` VARCHAR(3) NOT NULL DEFAULT  '0' AFTER  `int_maxruntime`");
				$APP['db']->query("ALTER TABLE `job_id_user` ADD `int_try` VARCHAR(3) NOT NULL DEFAULT  '0' AFTER  `str_ad`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.hf_id_user ADD 
int_retry_count varchar(3) NOT NULL 
DEFAULT ('0') 
GO 
EXEC hf_id_user;
GO");
				$APP['db']->query("ALTER TABLE dbo.job_id_user ADD 
int_try varchar(3) NOT NULL 
DEFAULT ('0') 
GO 
EXEC job_id_user;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   hf_id_user
ADD
  int_retry_count varchar2(3) DEFAULT '0' NOT NULL;");
				$APP['db']->query("ALTER TABLE
   job_id_user
ADD
  int_try varchar2(3) DEFAULT '0' NOT NULL;");

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE hf_id_user ADD COLUMN int_retry_count character varying(3) DEFAULT '0'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE job_id_user ADD COLUMN int_try character varying(3) DEFAULT '0'::character varying NOT NULL");			}
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