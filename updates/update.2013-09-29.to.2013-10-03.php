<?php

$translation['updatebody']['english']='- status.php added<br/>- Option to customize job submission response when mode is "fast response"';
$translation['updatebody']['german']='- Status.php hinzugefügt<br/>- Option zur Auftragsübertragung Antwort anpassen, wenn Modus "schnelle Reaktion"';
$translation['updatebody']['chinesesimplified']='- status.php添加<br/>
- 选项时定制作业提交响应模式是“快速响应”';
$translation['updatebody']['bulgarian']='- Status.php добавяне<br/>- Възможност да персонализирате отговор подаване работа, когато режим е "бърз отговор"';

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
				$APP['db']->query("ALTER TABLE `hf_id_user` ADD `str_fastresponse` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `int_maxruntime`");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.hf_id_user ADD 
str_fastresponse varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC hf_id_user;
GO");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   hf_id_user
ADD
  str_fastresponse varchar2(50) DEFAULT 'undefined' NOT NULL;");

			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE hf_id_user ADD COLUMN str_fastresponse character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
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