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
				$APP['db']->query("CREATE TABLE IF NOT EXISTS assign_hf (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  hf_server varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,hf_server)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

				$APP['db']->query("CREATE TABLE IF NOT EXISTS assign_server (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  server_hf varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,server_hf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
				$APP['db']->query("ALTER TABLE `user_server` ADD `int_online` VARCHAR(1) NOT NULL DEFAULT '1' AFTER  `is_busy`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[assign_hf](
        [id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
        [hf_server] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary key29] PRIMARY KEY CLUSTERED
(
        [id_user] ASC,
        [hf_server] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;");

				$APP['db']->query("SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[assign_server](
        [id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
        [server_hf] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary key30] PRIMARY KEY CLUSTERED
(
        [id_user] ASC,
        [server_hf] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;
");

				$APP['db']->query("ALTER TABLE dbo.user_server ADD 
int_online varchar(1) NOT NULL 
DEFAULT ('1') 
GO 
EXEC user_server;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$query_string = "  CREATE TABLE 'DBNAME'.'ASSIGN_HF'
   (    'ID_USER' VARCHAR2(50 BYTE) DEFAULT 'undefined',
        'HF_SERVER' VARCHAR2(100 BYTE) DEFAULT 'undefined',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PRIMARY_KEY29' ON 'DBNAME'.'ASSIGN_HF' ('ID_USER', 'HF_SERVER')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'ASSIGN_HF' ADD CONSTRAINT 'PRIMARY_KEY29' PRIMARY KEY ('ID_USER', 'HF_SERVER')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'ASSIGN_HF' MODIFY ('ID_USER' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'ASSIGN_HF' MODIFY ('HF_SERVER' NOT NULL ENABLE);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);

				$query_string = "  CREATE TABLE 'DBNAME'.'ASSIGN_SERVER'
   (    'ID_USER' VARCHAR2(50 BYTE) DEFAULT 'undefined',
        'SERVER_HF' VARCHAR2(100 BYTE) DEFAULT 'undefined',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PRIMARY_KEY30' ON 'DBNAME'.'ASSIGN_SERVER' ('ID_USER', 'SERVER_HF')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'ASSIGN_SERVER' ADD CONSTRAINT 'PRIMARY_KEY30' PRIMARY KEY ('ID_USER', 'SERVER_HF')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'ASSIGN_SERVER' MODIFY ('ID_USER' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'ASSIGN_SERVER' MODIFY ('SERVER_HF' NOT NULL ENABLE);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);


				$APP['db']->query("ALTER TABLE
  user_server 
ADD
  int_online varchar2(1) DEFAULT '1' NOT NULL;");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("CREATE TABLE assign_hf (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    hf_server character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.assign_hf OWNER TO USERNAME;
ALTER TABLE ONLY assign_hf ADD CONSTRAINT assign_hf_pkey PRIMARY KEY (id_user, hf_server);");

				$APP['db']->query("CREATE TABLE assign_server (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    server_hf character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.assign_server OWNER TO USERNAME;
ALTER TABLE ONLY assign_server ADD CONSTRAINT assign_server_pkey PRIMARY KEY (id_user, server_hf);");
				$APP['db']->query("ALTER TABLE user_server ADD COLUMN int_online character varying(1) DEFAULT '1'::character varying NOT NULL");
			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("assign_hf");
					$c->ensureIndex(array("id_user" => 1,"hf_server"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
					print_r($e);
				}
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("assign_server");
					$c->ensureIndex(array("id_user" => 1,"server_hf"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
					print_r($e);
				}

			}
			if ($APP['db']->kind=="dynamodb")
			{
				$_POST['substep']=-1;
				include("schemas/db-schema-dynamodb.sql");
				create_table("assign_hf",false,"id_user","hf_server");
				echo " ";
				create_table("assign_server",false,"id_user","server_hf");
				echo " ";
			}
		}
	
	}

}

?>
