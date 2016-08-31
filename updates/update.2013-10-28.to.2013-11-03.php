<?php

$translation['updatebody']['english']='- Custom job failures added';
$translation['updatebody']['german']='- Individuelle Jobfehlern hinzugefügt';
$translation['updatebody']['chinesesimplified']='- 加入自定义工作失败';
$translation['updatebody']['bulgarian']='- Персонализирани неуспехи работа добавяне';

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
				$APP['db']->query("CREATE TABLE IF NOT EXISTS job_flag (
  id_job varchar(100) NOT NULL DEFAULT 'undefined',
  flag varchar(50) NOT NULL DEFAULT 'undefined',
  status varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_job,flag)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_flag](
	[id_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[flag] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[status] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_job_flag] PRIMARY KEY CLUSTERED 
(
	[id_job] ASC,
	[flag] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;");

			}
			if ($APP['db']->kind=="oracle")
			{
				$query_string = "  CREATE TABLE 'DBNAME'.'JOB_FLAG'
   (    'ID_JOB' VARCHAR2(100 BYTE) DEFAULT 'undefined',
        'FLAG' VARCHAR2(50 BYTE) DEFAULT 'undefined',
        'STATUS' VARCHAR2(100 BYTE) DEFAULT 'undefined',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PKEY_JOB_FLAG' ON 'DBNAME'.'JOB_FLAG' ('ID_JOB', 'FLAG')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'JOB_FLAG' ADD CONSTRAINT 'PKEY_JOB_FLAG' PRIMARY KEY ('ID_JOB', 'FLAG')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'JOB_FLAG' MODIFY ('ID_JOB' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'JOB_FLAG' MODIFY ('STATUS' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'JOB_FLAG' MODIFY ('FLAG' NOT NULL ENABLE);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("CREATE TABLE job_flag (
    id_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    flag character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    status character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.job_flag OWNER TO USERNAME;
ALTER TABLE ONLY job_flag ADD CONSTRAINT job_flag_pkey PRIMARY KEY (id_job, flag);");

			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_flag");
					$c->ensureIndex(array("id_job" => 1,"flag"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
						print_r($e);
				}
			}
			if ($APP['db']->kind=="dynamodb")
			{
				$_POST['substep']=-1;
				include("schemas/db-schema-dynamodb.sql");
				create_table("job_flag",false,"id_job","flag"); 
			}
		}
	
	}

}

?>
