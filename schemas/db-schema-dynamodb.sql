<?php

function create_table($table_name,$wait_for_active,$hash_name,$range_name="")
{
	global $db;
	if ( strlen($range_name)>0 )
	{
		$response = $db->db->create_table(array(
		    'TableName' => $table_name,
		    'KeySchema' => array(
		        'HashKeyElement' => array(
		            'AttributeName' => $hash_name,
		            'AttributeType' => AmazonDynamoDB::TYPE_STRING
		        ),
			'RangeKeyElement' => array(
        		    'AttributeName' => $range_name,
		            'AttributeType' => AmazonDynamoDB::TYPE_STRING
		        )
		    ),
		    'ProvisionedThroughput' => array(
		        'ReadCapacityUnits' => 10,
		        'WriteCapacityUnits' => 5
		    )
		));
	}
	else
	{
		$response = $db->db->create_table(array(
			'TableName' => $table_name,
			'KeySchema' => array(
				'HashKeyElement' => array(
					'AttributeName' => $hash_name,
					'AttributeType' => AmazonDynamoDB::TYPE_STRING
				)
			),
			'ProvisionedThroughput' => array(
				'ReadCapacityUnits' => 10,
				'WriteCapacityUnits' => 5
			)
		));

	}
 
	if ($response->isOK())
	{
	    //echo '# Kicked off the creation of the DynamoDB table...' . PHP_EOL;
	}
	else
	{
	    echo "<pre>";
		echo "Table creation response may have errored";
		echo ":<br/>";
	    print_r($response);
	    //exit;
	}
	if ($wait_for_active)
	{
		$count = 0;
		do {
			sleep(1);
			$count++;
		 
			$response = $db->db->describe_table(array(
				'TableName' => $table_name
			));
		}
		while ((string) $response->body->Table->TableStatus !== 'ACTIVE');
		echo "The table \"${table_name}\" has been created (slept ${count} seconds)." . PHP_EOL; 
	}
}

$number_of_steps = 0;

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{

	echo " ";
	create_table("user_system_kind",false,"id_user","id"); 
	create_table("hf_inherit",false,"id_hf","id"); 
	create_table("user_id_user",false,"id_user"); 
	echo " ";
	create_table("user_user_name",false,"user_name");

}

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("hf_tag",false,"id_hf","id"); 
	create_table("hf_parameter",false,"id_hf","id"); 
	create_table("hf_id_user",false,"id_user","id"); 
	echo " ";
	create_table("strings",false,"id"); 
}

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("user_server",false,"id_user","name"); 
	create_table("hf_resource",false,"id_hf","id"); 
	create_table("user_inherit",false,"id_user","id_hf"); 
	echo " ";
	create_table("hf_system_kind",false,"id_hf","id"); 
	echo " ";
	create_table("hfr_system_kind",false,"id_resource","id"); 
}
// less useful tables

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("job_new",false,"id_user","id"); 
	create_table("job_id_user",false,"id_user","id"); 
	create_table("match_custom",false,"id_expr","idx_key"); 
	echo " ";
	create_table("match_entry",false,"id_expr","idx_id"); 
}

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("me_setting",false,"id_me","name"); 
	echo " ";
	create_table("ph_child",false,"id_child_job","id_parent_job"); 
	create_table("ph_parent",false,"id_parent_job","id_child_job"); 
	echo " ";
	create_table("hfp_vcs",false,"id_hf_parameter","id"); 
}

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("hf_file",false,"id_hf","id"); 
	echo " ";
	create_table("hf_kill",false,"id_hf","id"); 
	create_table("hf_node_filter",false,"id_hf","id"); 
	echo " ";
	create_table("sys_setting",false,"category","param"); 
	echo " ";
}

$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("user_server_service",false,"id_user_server","service_name"); 
	echo " ";
	create_table("hfp_hf",false,"parameter_name","id_hf"); 
	echo " ";
	create_table("assign_hf",false,"id_user","hf_server"); 
	echo " ";
	create_table("assign_server",false,"id_user","server_hf"); 
	echo " ";
}


$number_of_steps = $number_of_steps+1;
if ( intval($_POST['substep'])==$number_of_steps)
{
	create_table("job_flag",false,"id_job","flag"); 
	echo " ";
}



?>
