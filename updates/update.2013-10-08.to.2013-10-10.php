<?php

$translation['updatebody']['english']='- job table schema update';
$translation['updatebody']['german']='- jobtabelle Schema Update';
$translation['updatebody']['chinesesimplified']='- 工作表架构更新';
$translation['updatebody']['bulgarian']='- таблица със задания схема актуализация';

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
				$APP['db']->query("ALTER TABLE `job_id_user` ADD `dt_done` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `id_type`");
				$APP['db']->query("ALTER TABLE `job_id_user` ADD `dt_modified` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `id_type`");
				$APP['db']->query("ALTER TABLE `job_id_user` ADD `dt_created` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `id_type`");
				$APP['db']->query("ALTER TABLE `job_id_user` DROP `dt`");
				$APP['db']->query("ALTER TABLE `job_id_user` DROP `str_request`");
				$APP['db']->query("ALTER TABLE `job_id_user` DROP `id_type`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.job_id_user ADD 
dt_created varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC job_id_user;
GO");
				$APP['db']->query("ALTER TABLE dbo.job_id_user ADD 
dt_modified varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC job_id_user;
GO");
				$APP['db']->query("ALTER TABLE dbo.job_id_user ADD 
dt_done varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC job_id_user;
GO");
				$APP['db']->query("ALTER TABLE dbo.job_id_user DROP COLUMN dt");
				$APP['db']->query("ALTER TABLE dbo.job_id_user DROP COLUMN str_request");
				$APP['db']->query("ALTER TABLE dbo.job_id_user DROP COLUMN id_type");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   job_id_user
ADD
  dt_created varchar2(50) DEFAULT 'undefined' NOT NULL;");
				$APP['db']->query("ALTER TABLE
   job_id_user
ADD
  dt_modified varchar2(50) NOT NULL;");
				$APP['db']->query("ALTER TABLE
   job_id_user
ADD
  dt_done varchar2(50) DEFAULT 'undefined' NOT NULL;");
  
				$APP['db']->query("ALTER TABLE
   job_id_user
DROP COLUMN
  dt;");
				$APP['db']->query("ALTER TABLE
   job_id_user
DROP COLUMN
  str_request;");
				$APP['db']->query("ALTER TABLE
   job_id_user
DROP COLUMN
  id_type;");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE job_id_user ADD COLUMN dt_created character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE job_id_user ADD COLUMN dt_modified character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE job_id_user ADD COLUMN dt_done character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE job_id_user DROP COLUMN dt;");
				$APP['db']->query("ALTER TABLE job_id_user DROP COLUMN str_request;");
				$APP['db']->query("ALTER TABLE job_id_user DROP COLUMN id_type;");
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