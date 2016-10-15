<?php

$translation['updatebody']['english']='- HIS Job Status Indexing';
$translation['updatebody']['german']='- HIS Jobstatus-Indizierung';
$translation['updatebody']['chinesesimplified']='- HIS 作业状态索引';
$translation['updatebody']['bulgarian']='- HIS Job Status индексиране';

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
				$APP['db']->query("CREATE TABLE IF NOT EXISTS job_status (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id_status_job varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,id_status_job)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_status](
        [id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
        [id_status_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_job_status] PRIMARY KEY CLUSTERED
(
        [id_user] ASC,
        [id_status_job] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;");

			}
			if ($APP['db']->kind=="oracle")
			{
				$query_string = "  CREATE TABLE 'DBNAME'.'JOB_STATUS'
   (    'ID_USER' VARCHAR2(50 BYTE) DEFAULT 'undefined',
        'ID_STATUS_JOB' VARCHAR2(100 BYTE) DEFAULT 'undefined',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PKEY_JOB_STATUS' ON 'DBNAME'.'JOB_STATUS' ('ID_USER', 'ID_STATUS_JOB')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'JOB_STATUS' ADD CONSTRAINT 'PKEY_JOB_STATUS' PRIMARY KEY ('ID_USER', 'ID_STATUS_JOB')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'JOB_STATUS' MODIFY ('ID_USER' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'JOB_STATUS' MODIFY ('ID_STATUS_JOB' NOT NULL ENABLE);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("CREATE TABLE job_status (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_status_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.job_status OWNER TO USERNAME;
ALTER TABLE ONLY job_status ADD CONSTRAINT job_status_pkey PRIMARY KEY (id_user, id_status_job);");

			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_status");
					$c->ensureIndex(array("id_user" => 1,"id_status_job"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
					print_r($e);
				}
			}
			if ($APP['db']->kind=="dynamodb")
			{
				$_POST['substep']=-1;
				include("schemas/db-schema-dynamodb.sql");
				create_table("job_status",false,"id_user","id_status_job");
				echo " ";
			}
		}
	
	}

}

?>
