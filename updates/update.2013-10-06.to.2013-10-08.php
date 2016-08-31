<?php

$translation['updatebody']['english']='- HIS Action suggestions';
$translation['updatebody']['german']='- HIS Aktion Anregungen';
$translation['updatebody']['chinesesimplified']='- HIS 操作建议';
$translation['updatebody']['bulgarian']='- HIS Екшън предложения';

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
				$APP['db']->query("CREATE TABLE IF NOT EXISTS hfp_hf (
  parameter_name varchar(100) NOT NULL DEFAULT 'undefined',
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (parameter_name,id_hf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hfp_hf](
	[parameter_name] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary key28] PRIMARY KEY CLUSTERED 
(
	[parameter_name] ASC,
	[id_hf] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;");
			}
			if ($APP['db']->kind=="oracle")
			{
				$query_string = "  CREATE TABLE 'DBNAME'.'HFP_HF'
   (    'PARAMETER_NAME' VARCHAR2(100 BYTE) DEFAULT 'undefined',
        'ID_HF' VARCHAR2(50 BYTE) DEFAULT 'undefined',
   ) SEGMENT CREATION IMMEDIATE
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  CREATE UNIQUE INDEX 'DBNAME'.'PRIMARY_KEY28' ON 'DBNAME'.'HFP_HF' ('PARAMETER_NAME', 'ID_HF')
  PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS' ;

  ALTER TABLE 'DBNAME'.'HFP_HF' ADD CONSTRAINT 'PRIMARY_KEY28' PRIMARY KEY ('PARAMETER_NAME', 'ID_HF')
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE 'USERS'  ENABLE;
  ALTER TABLE 'DBNAME'.'HFP_HF' MODIFY ('PARAMETER_NAME' NOT NULL ENABLE);
  ALTER TABLE 'DBNAME'.'HFP_HF' MODIFY ('ID_HF' NOT NULL ENABLE);
";
				$query_string=str_replace("(SEMICOLON)",";",$query_string);
				$query_string=str_replace("DBNAME",strtoupper($APP['db']->dbname),$query_string);
				$query_string=str_replace("USERNAME",($APP['db']->auth1),$query_string);
				$APP['db']->query($query_string);
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("CREATE TABLE hfp_hf (
    parameter_name character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hfp_hf OWNER TO USERNAME;
ALTER TABLE ONLY hfp_hf ADD CONSTRAINT hfp_hf_pkey PRIMARY KEY (parameter_name, id_hf);");
			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hfp_hf");
					$c->ensureIndex(array("parameter_name" => 1,"id_hf"=>1), array("unique" => 1, "dropDups" => 1));
				} catch (Exception $e) {
						print_r($e);
				}
			}
			if ($APP['db']->kind=="dynamodb")
			{
				$_POST['substep']=-1;
				include("schemas/db-schema-dynamodb.sql");
				create_table("hfp_hf",false,"parameter_name","id_hf"); 
			}
		}
	
	}

}

?>