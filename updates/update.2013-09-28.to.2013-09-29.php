<?php

$translation['updatebody']['english']='- User server services compatability table added';
$translation['updatebody']['german']='- Benutzer Server-Dienste Kompatibilität Tabelle hinzugefügt';
$translation['updatebody']['chinesesimplified']='- 添加用户服务器服务兼容性表';
$translation['updatebody']['bulgarian']='- Потребителят сървър услуги съвместимост таблицата добавяне';

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
				$query_string="CREATE TABLE IF NOT EXISTS user_server_service (
  id_user_server varchar(50) NOT NULL DEFAULT 'undefined',
  service_name varchar(50) NOT NULL DEFAULT 'undefined',
  service_enabled varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_user_server,service_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);
			}
			if ($APP['db']->kind=="mssql")
			{
				$query_string="SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_server_service](
	[id_user_server] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[service_name] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[service_enabled] [varchar](1) NOT NULL DEFAULT ('0'),
 CONSTRAINT [primary key27] PRIMARY KEY CLUSTERED 
(
	[id_user_server] ASC,
	[service_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);
			}
			if ($APP['db']->kind=="oracle")
			{
				$query_string="  CREATE TABLE 'DBNAME'.'USER_SERVER_SERVICE'
   (    'ID_USER_SERVER' VARCHAR2(50 BYTE) DEFAULT '',
        'SERVICE_NAME' VARCHAR2(50 BYTE) DEFAULT '',
        'SERVICE_ENABLED' VARCHAR2(1 BYTE) DEFAULT '0',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PRIMARY_KEY27' ON 'DBNAME'.'USER_SERVER_SERVICE' ('ID_USER_SERVER', 'SERVICE_NAME')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'USER_SERVER_SERVICE' ADD CONSTRAINT 'PRIMARY_KEY27' PRIMARY KEY ('ID_USER_SERVER', 'SERVICE_NAME')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'USER_SERVER_SERVICE' MODIFY ('ID_USER_SERVER' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'USER_SERVER_SERVICE' MODIFY ('SERVICE_NAME' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'USER_SERVER_SERVICE' MODIFY ('SERVICE_ENABLED' NOT NULL ENABLE);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);
			}
			if ($APP['db']->kind=="postgres")
			{
				$query_string="CREATE TABLE user_server_service (
    id_user_server character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    service_name character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    service_enabled character varying(1) DEFAULT '0'::character varying NOT NULL
);
ALTER TABLE public.user_server_service OWNER TO USERNAME;
ALTER TABLE ONLY user_server_service ADD CONSTRAINT user_server_service_pkey PRIMARY KEY (id_user_server, service_name);";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);
			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_server_service");
					$c->ensureIndex(array("id_user_server" => 1,"service_name"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
						print_r($e);
				}
			}
			if ($APP['db']->kind=="dynamodb")
			{
				$_POST['substep']=-1;
				include("schemas/db-schema-dynamodb.sql");
				create_table("user_server_service",false,"id_user_server","service_name"); 
			}
		}
	
	}

}

?>
