<?php

$translation['updatebody']['english']='- Output expression update and schema update';
$translation['updatebody']['german']='- Output Ausdruck Update und Schema-Update';
$translation['updatebody']['chinesesimplified']='- 输出表达式更新和架构更新';
$translation['updatebody']['bulgarian']='- Актуална Output изразяване и схема актуализация';

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
				$APP['db']->query("ALTER TABLE `job_id_user` ADD `str_ad` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `str_output`");
				$APP['db']->query("ALTER TABLE `hf_id_user` ADD `str_cache_ad` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `str_cache_latest`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.job_id_user ADD 
str_ad varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC job_id_user;
GO");
				$APP['db']->query("ALTER TABLE dbo.hf_id_user ADD 
str_cache_ad varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC hf_id_user;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   job_id_user
ADD
  str_ad varchar2(50) DEFAULT 'undefined' NOT NULL;");
				$APP['db']->query("ALTER TABLE
   hf_id_user
ADD
  str_cache_ad varchar2(50) DEFAULT 'undefined' NOT NULL;");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE job_id_user ADD COLUMN str_ad character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE hf_id_user ADD COLUMN str_cache_ad character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
			}
			if ($APP['db']->kind=="mongodb")
			{
				//$APP['db']->query("ALTER TABLE `job_id_user` ADD `str_ad` VARCHAR( 50 ) NOT NULL DEFAULT  '' AFTER  `str_output`");
			}
			if ($APP['db']->kind=="dynamodb")
			{
				//$APP['db']->query("ALTER TABLE `job_id_user` ADD `str_ad` VARCHAR( 50 ) NOT NULL DEFAULT  '' AFTER  `str_output`");
			}
		}
	
	}

}

?>