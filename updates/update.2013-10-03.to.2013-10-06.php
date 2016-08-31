<?php

$translation['updatebody']['english']='- Server software version added to schema<br/>- Remove unused table';
$translation['updatebody']['german']='- Server Software-Version hinzugefügt, um Schema<br/>- Entfernen Sie nicht verwendete Tabelle';
$translation['updatebody']['chinesesimplified']='- 服务器软件版本添加到架构<br/>- 删除未使用的表';
$translation['updatebody']['bulgarian']='- Версия сървърния софтуер добавя към схемата<br/>- Махни неизползван маса';

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
				$APP['db']->query("ALTER TABLE `user_server` ADD `software_version` VARCHAR(50) NOT NULL DEFAULT  'undefined' AFTER  `is_busy`");
				$APP['db']->query("DROP TABLE IF EXISTS hf_output");
			}
			if ($APP['db']->kind=="mssql")
			{
				$APP['db']->query("ALTER TABLE dbo.user_server ADD 
software_version varchar(50) NOT NULL 
DEFAULT ('undefined') 
GO 
EXEC user_server;
GO");
				$APP['db']->query("IF OBJECT_ID('dbo.hf_output', 'U') IS NOT NULL
  DROP TABLE dbo.hf_output");
			}
			if ($APP['db']->kind=="oracle")
			{
				$APP['db']->query("ALTER TABLE
   user_server
ADD
  software_version varchar2(50) DEFAULT 'undefined' NOT NULL;");
				$APP['db']->query("BEGIN
   EXECUTE IMMEDIATE 'DROP TABLE hf_output';
EXCEPTION
   WHEN OTHERS THEN
      IF SQLCODE != -942 THEN
         RAISE;
      END IF;
END;");
			}
			if ($APP['db']->kind=="postgres")
			{
				$APP['db']->query("ALTER TABLE user_server ADD COLUMN software_version character varying(50) DEFAULT 'undefined'::character varying NOT NULL");
				$APP['db']->query("DROP TABLE IF EXISTS hf_output");
			}
			if ($APP['db']->kind=="mongodb")
			{
				try{
					$mongo = $APP['db']->db;
					$dbname=$APP['db']->dbname;
					$collection = $mongo->$dbname->hf_output;
					$response = $collection->drop();
					if ($response['ok'].""=="1")
					{
					}
					else
					{
						echo "<pre>";
						echo "MONGO ERROR:";
						print_r($response);
						exit;
					}
				} catch (Exception $e) {
					echo "<pre>";
					echo "MONGO ERROR:";
					print_r($e);
					exit;
				}
			}
			if ($APP['db']->kind=="dynamodb")
			{
				$APP['db']->db->delete_table(array(
					'TableName' => "hf_output"
				));
				//$APP['db']->query("ALTER TABLE `user_server` ADD `software_version` VARCHAR( 50 ) NOT NULL DEFAULT  'undefined' AFTER  `is_busy`");
			}
		}
	
	}

}

?>