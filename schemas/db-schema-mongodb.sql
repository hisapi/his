<?php
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_system_kind");
	$c->ensureIndex(array("id_user" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
	print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_inherit");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_id_user");
	$c->ensureIndex(array("id_user" => 1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_user_name");
	$c->ensureIndex(array("user_name" => 1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_tag");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_parameter");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_id_user");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("strings");
	$c->ensureIndex(array("id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_server");
	$c->ensureIndex(array("id_user" => 1,"name"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_resource");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_inherit");
	$c->ensureIndex(array("id_user" => 1,"id_hf"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_system_kind");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hfr_system_kind");
	$c->ensureIndex(array("id_resource" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_new");
	$c->ensureIndex(array("id_user" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_id_user");
	$c->ensureIndex(array("id_user" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("match_custom");
	$c->ensureIndex(array("id_expr" => 1,"idx_key"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("match_entry");
	$c->ensureIndex(array("id_expr" => 1,"idx_id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("me_setting");
	$c->ensureIndex(array("id_me" => 1,"name"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("ph_child");
	$c->ensureIndex(array("id_child_job" => 1,"id_parent_job"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("ph_parent");
	$c->ensureIndex(array("id_parent_job" => 1,"id_child_job"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hfp_vcs");
	$c->ensureIndex(array("id_hf_parameter" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_file");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_kill");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hf_node_filter");
	$c->ensureIndex(array("id_hf" => 1,"id"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("sys_setting");
	$c->ensureIndex(array("category" => 1,"param"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("user_server_service");
	$c->ensureIndex(array("id_user_server" => 1,"service_name"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("hfp_hf");
	$c->ensureIndex(array("parameter_name" => 1,"id_hf"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
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
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_flag");
	$c->ensureIndex(array("id_job" => 1,"flag"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}
try{
	$c=$APP['db']->db->selectDB($APP['db']->dbname)->createCollection("job_status");
	$c->ensureIndex(array("id_user" => 1,"id_status_job"=>1), array("unique" => 1, "dropDups" => 1));
} catch (Exception $e) {
        print_r($e);
}

sleep(6);

?>
