<?php

$translation['updatebody']['english']='- immutable (value cannot be changed) and mandatory (value must be provided) parameter options added';
$translation['updatebody']['german']='- unveränderlich (Wert kann nicht geändert werden) und Pflicht (Wert muss gestellt werden) Parameter Optionen hinzugefügt';
$translation['updatebody']['chinesesimplified']='- （必须提供值）不可变的（值不能改变），并强制添加的参数选项';
$translation['updatebody']['bulgarian']='- неизменни (стойност не може да се променя) и задължително (стойност трябва да се предостави) добавят опции параметър';

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
				$APP['db']->query("ALTER TABLE `hf_parameter` ADD `int_mandatory` VARCHAR(1) NOT NULL DEFAULT  '0' AFTER  `int_preserve_encode`");
				$APP['db']->query("ALTER TABLE `hf_parameter` ADD `int_immutable` VARCHAR(1) NOT NULL DEFAULT  '0' AFTER  `int_preserve_encode`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.hf_parameter ADD 
int_immutable varchar(1) NOT NULL 
DEFAULT ('0') 
GO 
EXEC hf_parameter;
GO");
				$APP['db']->query("ALTER TABLE dbo.hf_parameter ADD 
int_mandatory varchar(1) NOT NULL 
DEFAULT ('0') 
GO 
EXEC hf_parameter;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   hf_parameter
ADD
  int_immutable varchar2(1) DEFAULT '0' NOT NULL;");
				$APP['db']->query("ALTER TABLE
   hf_parameter
ADD
  int_mandatory varchar2(1) DEFAULT '0' NOT NULL;");

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE hf_parameter ADD COLUMN int_immutable character varying(1) DEFAULT '0'::character varying NOT NULL");
				$APP['db']->query("ALTER TABLE hf_parameter ADD COLUMN int_mandatory character varying(1) DEFAULT '0'::character varying NOT NULL");
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
