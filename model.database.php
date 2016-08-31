<?php
require_once("utility.functions.php");
// AWS
require_once("api/aws-sdk/sdk.class.php");


// ABSTRACT CLASS FOR TYPES OF database
abstract class Database
{
	public $db=false;
	public $debug=false;
	public $kind="";  
	public $connected=false;
	
	public $auth1="";
	public $auth2="";
	public $dbname="";
	public $url="";

	public $table_prefix="";

	abstract protected function connect();
	abstract protected function disconnect();
	abstract protected function get_error();
	abstract protected function update($table_name,$new_props,$condition_props);
	abstract protected function delete($table_name,$condition_props);
	abstract protected function insert($table_name,$props);
	abstract protected function select_table($table_name,$fields,$select_props,$count=0);
	abstract protected function get_tables();

	public function close()
	{
		$this->disconnect();
	}

}

abstract class Relational_SQL_Database extends Database
{
	public $limit_after_select=false;
	public $limit_at_end=false;
	public $limit_sql;

	abstract function execute_query($query_string);
	
	public function update($table_name,$new_props,$condition_props)
	{
		$condition_part=array();
		foreach ($condition_props as $select_prop)
		{
			$select_prop_val=str_replace("'","\'",$select_prop->value);
			if ($select_prop->comparison=="EQUAL")
			{
				$condition_part[]=$select_prop->field."='".$select_prop_val."'";
			}
			else if ($select_prop->comparison=="BEGINS_WITH")
			{
				$select_prop_val=str_replace("%","\%",$select_prop->value);
				$select_prop_val=str_replace("_","\_",$select_prop->value);
				$condition_part[]=$select_prop->field." LIKE '".$select_prop_val."%'";
			}
		}
		$condition_sql=implode(" AND ",$condition_part);
		$set_parts=array();
		foreach ($new_props as $new_prop_key=>$new_prop_value)
		{
			$set_parts[]=$new_prop_key."='".str_replace("'","\'",$new_prop_value)."'";
		}
		$set_sql=implode(",",$set_parts);
		if ( count($condition_part)==0 )
		{
			$condition_sql="1";
		}
		$query_string="UPDATE $table_name SET $set_sql WHERE $condition_sql";
		if ($this->debug)
		{
			echo "QUERY:<br/>";
			echo $query_string."<br/>";
		}
		return $this->query($query_string);
	} // END FUNCTION
	
	public function delete($table_name,$condition_props)
	{
		$condition_part=array();
		foreach ($condition_props as $select_prop)
		{
			$select_prop_val=str_replace("'","\'",$select_prop->value);
			if ($select_prop->comparison=="EQUAL")
			{
				$condition_part[]=$select_prop->field."='".$select_prop_val."'";
			}
			else if ($select_prop->comparison=="BEGINS_WITH")
			{
				$select_prop_val=str_replace("%","\%",$select_prop->value);
				$select_prop_val=str_replace("_","\_",$select_prop->value);
				$condition_part[]=$select_prop->field." LIKE '".$select_prop_val."%'";
			}
		}
		$conditions=implode(" AND ",$condition_part);
		$query_string="DELETE FROM ".$table_name." WHERE ".$conditions;
		return $this->query($query_string);
	
	} // END FUNCTION

	public function insert($table_name,$props)
	{
		$i=0;
		$prop_list="";
		$val_list="";
		foreach ($props as $prop_key=>$prop_val)
		{
			if ($i>0)
			{
				$prop_list=$prop_list.",";
				$val_list=$val_list.",";
			}
			$prop_list=$prop_list."$prop_key";
			$prop_val=str_replace("'","\'",$prop_val);
			$val_list=$val_list."'$prop_val'";
			$i=$i+1;
		}
		$query_string="INSERT INTO ".$table_name." (".$prop_list.") VALUES (".$val_list.")";
		return $this->query($query_string);
	}

	public function select_table($table_name,$fields,$select_props,$count=0)
	{
		$condition_part=array();
		foreach ($select_props as $select_prop)
		{
			$select_prop_val=str_replace("'","\'",$select_prop->value);
			if ($select_prop->comparison=="EQUAL")
			{
				$condition_part[]=$select_prop->field."='".$select_prop_val."'";
			}
			else if ($select_prop->comparison=="BEGINS_WITH")
			{
				$select_prop_val=str_replace("%","\%",$select_prop->value);
				$select_prop_val=str_replace("_","\_",$select_prop->value);
				$condition_part[]=$select_prop->field." LIKE '".$select_prop_val."%'";
			}
		}
		$condition_sql=implode(" AND ",$condition_part);
		if ( count($condition_part)==0 )
		{
			$condition_sql="1";
		}
		$query_string = "SELECT ";
		if ($this->limit_after_select && $count>0)
		{
			$query_string = $query_string." ".$this->limit_sql." ".$count;
		}
		$query_string = $query_string.implode(",",$fields)." FROM ".$table_name." WHERE $condition_sql";
		if ($this->limit_at_end && $count>0)
		{
			$query_string = $query_string." ".$this->limit_sql." ".$count;
		}
		return $this->query($query_string);
	
	}

	public function query($query_string)
	{
		if (!$this->connected) {$this->connect();}
		$result = $this->execute_query($query_string);
		$result = $this->correct_result_idx($result,$query_string);
		return $result;
	}
} // END CLASS

// CONCRETE DATABASE TYPE: MYSQL
class Database_Mysql extends Relational_SQL_Database
{
	public $limit_sql="LIMIT";
	public function __construct()
	{
		$this->limit_at_end=true;
	}

	public function connect()
	{
		if ($this->connected)
		{
			if ($this->db->ping())
			{
				return $this->connected;
			}
		}
		$failed=false;
		try
		{
			$this->db = mysqli_connect($this->url, $this->auth1,$this->auth2) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not connect to database: ".htmlspecialchars(mysqli_error());
			}
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		if ($failed)
		{
			$this->connected=false;
			return false;
		}
		else
		{
			mysqli_select_db($this->db,$this->dbname) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not select database named '".htmlspecialchars($this->dbname)."': ".mysqli_error();
				$this->connected=false;
				return false;
			}
			if (!$failed)
			{
				$this->connected=true;
				return true;
			}
			else
			{
				$this->connected=false;
				return false;
			}
		}
	} // END IF (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;
		mysqli_close($this->db);
	}
	public function get_error()
	{
		if ( isset($this->db->error) )
		{
			return $this->db->error;
		}
		return "";
	}

	public function execute_query($query_string)
	{
		$result = false;
		try
		{
			if ($this->debug)
			{
				echo "<pre>".htmlentities($query_string)."<br/>\n";
			}
			if (!$this->db->ping())
			{
				$this->connect();
			}
			$result = mysqli_query($this->db,$query_string);
		}
		catch (Exception $e)
		{
			if ($this->debug)
			{
				echo "DATABASE ERROR: <br/><pre>";
				print_r($this->get_error());
				exit;
			}
		}
		return $result;
	}
	
	public function correct_result_idx($result,$query_string)
	{
		$terms=explode(" ",$query_string);
		if (strtolower(trim($terms[0]))=="update" || strtolower(trim($terms[0]))=="insert" || strtolower(trim($terms[0]))=="delete" || strtolower(trim($terms[0]))=="create" || strtolower(trim($terms[0]))=="drop" || strtolower(substr(trim($terms[0]),0,1))=="-" || strtolower(trim($terms[0]))=="rem" || strtolower(trim($terms[0]))=="set" || strtolower(trim($terms[0]))=="alter") return $result;
		if (!$result)
		{
			return $result;
		}
		
		$retval=array();
		$i=0;
		while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			foreach ($line as $key => $val)
			{
				$retval[$i][strtolower($key)]=$val;
			}
			$i++;
		}
		mysqli_free_result($result);
		return $retval;
	} 
	
	public function get_tables()
	{
		$retval=array();
		$this->connect();
		$tables=$this->query("SHOW TABLES FROM ".$this->dbname.";");
		if ($tables)
		{
			if ( is_array($tables) )
			{
				foreach ($tables as $table_info)
				{
					$retval[]=$table_info['tables_in_'.$this->dbname];
				}
			}
		} // END IF
		return $retval;
	}
	
} // END CLASS

// CONCRETE DATABASE TYPE: MSSQL
class Database_Mssql extends Relational_SQL_Database
{
	public $limit_sql="TOP";
	public function __construct()
	{
		$this->limit_after_select=true;
	}

	public function connect()
	{
		if ($this->connected) return $this->connected;
		$failed=false;
		try
		{
			$this->db = mssql_connect($this->url, $this->auth1,$this->auth2) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not connect to database: ".htmlspecialchars(mssql_error());
			}
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		if ($failed)
		{
			$this->connected=false;
			return false;
		}
		else
		{
			mssql_select_db($this->dbname,$this->db) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not select database named '".htmlspecialchars($this->dbname)."': ".mysqli_error();
				$this->connected=false;
				return false;
			}
			$this->connected=true;
			return true;
		}
	} // END IF (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;
		mssql_close($this->db);
	}
	public function get_error()
	{
		return mssql_get_last_message();
	}

	public function execute_query($query_string)
	{
		$result = false;
		try
		{
			if ($this->debug)
			{
				echo htmlentities($query_string)."<br/>\n";
			}
			$result = @mssql_query($query_string) or $fail=true;
		}
		catch (Exception $e)
		{
			if ($this->debug)
			{
				echo "DATABASE ERROR: <br/><pre>";
				print_r($this->get_error());
				exit;
			}
		}
		return $result;
	}
	
	public function correct_result_idx($result,$query_string)
	{
		$terms=explode(" ",$query_string);
		if (strtolower(trim($terms[0]))=="update" || strtolower(trim($terms[0]))=="insert" || strtolower(trim($terms[0]))=="delete" || strtolower(trim($terms[0]))=="create" || strtolower(trim($terms[0]))=="drop" || strtolower(substr(trim($terms[0]),0,1))=="-" || strtolower(trim($terms[0]))=="rem" || strtolower(trim($terms[0]))=="set" || strtolower(trim($terms[0]))=="alter") return $result;
		if (!$result)
		{
			return $result;
		}
		
		$retval=array();
		$i=0;
		while ($line = mssql_fetch_array($result, MSSQL_ASSOC))
		{
			foreach ($line as $key => $val)
			{
				$retval[$i][strtolower($key)]=$val;
			}
			$i++;
		}
		mssql_free_result($result);
		return $retval;
	} 
	
	public function get_tables()
	{
		$retval=array();
		$this->connect();
		
		$tables=$this->query("select name from ".$this->dbname."..sysobjects where xtype = 'U';");
		foreach ($tables as $dbtable)
		{
			$existing_table_found=$dbtable['name'];
			$retval[]=$existing_table_found;
		}
		return $retval;
	}
	
} // END CLASS

// CONCRETE DATABASE TYPE: ORACLE
class Database_Oracle extends Relational_SQL_Database
{
	public $limit_sql="AND ROWNUM >= 1 AND ROWNUM <= ";
	public function __construct()
	{
		$this->limit_at_end=true;
	}

	public function connect()
	{
		if ($this->connected) return $this->connected;
		$failed=false;
		try
		{
			$this->db = oci_connect($this->auth1,$this->auth2,$this->url."/".$this->dbname) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not connect to database: ERROR: ";
				//trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				$e = oci_error();
				print_r($e);
				exit;
			}
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		if ($failed)
		{
			$this->connected=false;
			return false;
		}
		else
		{
			$this->connected=true;
			return true;
		}
	} // END IF (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;
		oci_close($this->db);
	}
	public function get_error()
	{
		if ( isset($this->db->error) )
		{
			return $this->db->error;
		}
		return "";
	}

	public function execute_query($query_string)
	{
		if ($this->debug)
		{
			echo htmlentities($query_string)."<br/>\n";
		}
		$fail=false;
		$result = oci_parse($this->db, $query_string) or $fail=true;
		$lid=-1;
		if ( stringEndsWith( $query_string,":id" ) )
		{
			oci_bind_by_name($result,":id",$lid);
		}
		if (!$fail)
		{
			$fail=!oci_execute($result);
			oci_commit($this->db);
		}
		if ( stringEndsWith( $query_string,":id" ) )
		{
			$lid=intval($lid);
			$result=$lid;
		}
		
		return $result;
	}
	
	public function correct_result_idx($result,$query_string)
	{
		$terms=explode(" ",$query_string);
		if (strtolower(trim($terms[0]))=="update" || strtolower(trim($terms[0]))=="insert" || strtolower(trim($terms[0]))=="delete" || strtolower(trim($terms[0]))=="create" || strtolower(trim($terms[0]))=="drop" || strtolower(substr(trim($terms[0]),0,1))=="-" || strtolower(trim($terms[0]))=="rem" || strtolower(trim($terms[0]))=="set" || strtolower(trim($terms[0]))=="alter") return $result;
		if (!$result)
		{
			return $result;
		}
		
		$retval=array();
		oci_fetch_all($result, $resul, null,null,OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		$i=0;
		if ($resul)
		{
			while ($i<count($resul))
			{
				$original_keys=array_keys($resul[$i]);
				foreach ($original_keys as $key )
				{
					if (strtolower($key)!=$key)
					{
						$retval[$i][strtolower($key)]=$resul[$i][$key];
						unset($resul[$i][$key]);
					}
					else
					{
						// value is already there
					}
				}
				$i=$i+1;
			}
		}
		oci_free_statement($result);
		return $retval;
	} 
	
	public function get_tables()
	{
		$retval=array();
		$this->connect();
		
		$tables=$this->query("select table_name from all_tables");
		foreach ($tables as $dbtable)
		{
			$existing_table_found=$dbtable['table_name'];
			$retval[]=$existing_table_found;
		}
		
		return $retval;
	}
	
} // END CLASS

// CONCRETE DATABASE TYPE: POSTGRES
class Database_Postgres extends Relational_SQL_Database
{
	public $limit_sql="LIMIT 1";
	public function __construct()
	{
		$this->limit_at_end=true;
	}

	public function connect()
	{
		if ($this->connected) return $this->connected;
		$failed=false;
		try
		{
			$port_number=5432;
			if ( strpos($this->url,":")!==false )
			{
				$port_explode=explode(":",$this->url);
				if ( count($port_explode)>1 )
				{
					$port_number=intval($port_explode[1]);
				}
				$this->url=$port_explode[0];
			}
			$this->db=pg_connect("host=".$this->url." port=".$port_number." dbname=".$this->dbname." user=".$this->auth1." password=".$this->auth2) or $failed=true;
			if ($failed && $this->debug)
			{
				echo "Could not connect to database: ";
				$e = pg_last_error();
				echo htmlspecialchars($e);
			}
		}
		catch (Exception $e)
		{
			$failed=true;
		}
		if ($failed)
		{
			$this->connected=false;
			return false;
		}
		else
		{
			$this->connected=true;
			return true;
		}
	} // END IF (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;
		pg_close($this->db);
	}
	public function get_error()
	{
		return pg_last_error();
	}

	public function execute_query($query_string)
	{
		$result = false;
		try
		{
			if ($this->debug)
			{
				echo htmlentities($query_string)."<br/>\n";
			}
			$result = pg_query($query_string) or $fail=true;
		}
		catch (Exception $e)
		{
			if ($this->debug)
			{
				echo "DATABASE ERROR: <br/><pre>";
				print_r($this->get_error());
				exit;
			}
		}
		return $result;
	}
	
	public function correct_result_idx($result,$query_string)
	{
		$terms=explode(" ",$query_string);
		if (strtolower(trim($terms[0]))=="update" || strtolower(trim($terms[0]))=="insert" || strtolower(trim($terms[0]))=="delete" || strtolower(trim($terms[0]))=="create" || strtolower(trim($terms[0]))=="drop" || strtolower(substr(trim($terms[0]),0,1))=="-" || strtolower(trim($terms[0]))=="rem" || strtolower(trim($terms[0]))=="set" || strtolower(trim($terms[0]))=="alter") return $result;
		if (!$result)
		{
			return $result;
		}
		
		$retval=pg_fetch_all($result);
		pg_free_result($result);
		return $retval;
	} 
	
	public function get_tables()
	{
		$retval=array();
		$this->connect();

		$tables=$this->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public';");//SELECT table_schema,table_name FROM information_schema.tables ORDER BY table_schema,table_name");
		foreach ($tables as $dbtable)
		{
			$existing_table_found=$dbtable['table_name'];
			$retval[]=$existing_table_found;
		}
		return $retval;
	}
	
} // END CLASS

// CONCRETE DATABASE TYPE: MONGODB
class Database_Mongodb extends Database
{
	public function __construct()
	{
		$this->limit_at_end=true;
	}

	public function connect()
	{
		if ($this->connected) return $this->connected;

		try
		{
			$this->db = new Mongo("mongodb://".$this->auth1.":".$this->auth2."@".$this->url."/".$this->dbname."") or $failed=true;
			//$this->db->selectDB($this->dbname);
			if ($failed && $this->debug)
			{
				echo "Unable to connect to mongo database.";
				exit;
			}
			if ($this->debug)
			{
				//echo "listing collections";
				//$collections = $this->db->selectDB($this->dbname)->getCollectionNames();
				//var_dump($collections);
			}
		}
		catch (Exception $e)
		{
			$failed=true;
			if ($failed && $this->debug)
			{
				print_r($e);
				exit;
			}
		}
	
	} // END FUNCTION (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;
	}
	public function get_error()
	{
		if ( isset($this->db->error) )
		{
			//return $this->db->error;
		}
		return "";
	}

	public function get_tables()
	{
		$retval=array();
		$collections = $this->db->selectDB($this->dbname)->getCollectionNames();
		foreach ($collections as $dbtable)
		{
			$retval[]=$dbtable;
		}
		return $retval;
	}

	public function update($table_name,$new_props,$condition_props)
	{
		$dbname=$this->dbname;
		$collection=$this->db->$dbname->$table_name;

                $mongoQuery= array();
                foreach ($condition_props as $select_prop)
                {
                        if ($select_prop->comparison=="EQUAL")
                        {
                                $mongoQuery[$select_prop->field]=$select_prop->value;
                        }
                        else if ($select_prop->comparison=="BEGINS_WITH")
                        {
                                $select_prop_val=$select_prop->value;
                                $select_prop_val=str_replace("/","\/",$select_prop_val);
                                $regexObj = new MongoRegex("/^".$select_prop_val."/i");
                                $mongoQuery[$select_prop->field]=$regexObj;
                        }
                }
		$updates=array();
		foreach ($new_props as $new_prop_key=>$new_prop_value)
		{
			$updates[$new_prop_key]=$new_prop_value;
		}
		$update_set = array('$set'=>$updates);
		$collection->update($mongoQuery,$update_set);
		// $db->users->update(array("b" => "q"), array('$set' => array("a" => 1)));
	} // END FUNCTION

	public function delete($table_name,$condition_props)
	{
		$dbname=$this->dbname;
		$collection=$this->db->$dbname->$table_name;

                $mongoQuery= array();
                foreach ($condition_props as $select_prop)
		{
			if ($select_prop->comparison=="EQUAL")
			{
				$mongoQuery[$select_prop->field]=$select_prop->value;
			}
			else if ($select_prop->comparison=="BEGINS_WITH")
			{
				$select_prop_val=$select_prop->value;
				$select_prop_val=str_replace("/","\/",$select_prop_val);
				$regexObj = new MongoRegex("/^".$select_prop_val."/i");
				$mongoQuery[$select_prop->field]=$regexObj;
			}
		}
		$collection->remove($mongoQuery);
		//$this->db->users->remove(array("z" => "abc"));
	
	} // END FUNCTION

	public function insert($table_name,$props)
	{
		//echo "inserting...";
		//echo "<pre>";
		try
		{
			//print_r($props);
			$dbname=$this->dbname;
			$c=$this->db->$dbname->$table_name;
			//print_r($c);
			$c->save($props);
		} catch (Exception $e) {
			print_r($e);
		}
		//echo "DONE";
	}

	public function select_table($table_name,$fields,$select_props,$count=0)
	{
		$dbname=$this->dbname;
		$collection=$this->db->$dbname->$table_name;

		$mongoQuery= array();
		foreach ($select_props as $select_prop)
		{
			if ($select_prop->comparison=="EQUAL")
			{
				$mongoQuery[$select_prop->field]=$select_prop->value;
			}
			else if ($select_prop->comparison=="BEGINS_WITH")
			{
				$select_prop_val=$select_prop->value;
				$select_prop_val=str_replace("/","\/",$select_prop_val);
				$regexObj = new MongoRegex("/^".$select_prop_val."/i"); 
				$mongoQuery[$select_prop->field]=$regexObj;
			}
		}
		//print_r($mongoQuery);
		// search for fruits
		$cursor = $collection->find($mongoQuery);
		$retval=array();
		foreach ($cursor as $doc)
		{
			$retone=array();
			foreach ($doc as $doc_field_name=>$doc_field_value)
			{
				$retone[$doc_field_name]=$doc_field_value;
			}
			$retval[]=$retone;
			// need to break this out more to get fields
		}
		//echo "<pre>";
		//print_r($retval);
		return $retval;
	} // END FUNCTION
	
} // END CLASS

// CONCRETE DATABASE TYPE: DYNAMODB
class Database_Dynamodb extends Database
{
	public function __construct()
	{
		$this->limit_at_end=true;
	}

	public function connect()
	{
		if ($this->connected) return $this->connected;
		$failed=false;
		try
		{
			$this->db = new AmazonDynamoDB(
				array(
					'key' => $this->auth1,
					'secret' => $this->auth2
				)
			);
			$this->db->set_region( constant("AmazonDynamoDB::".$this->region) );
			$this->connected=true;
		}
		catch (Exception $e)
		{
			$failed=true;
			$this->connected=false;
			if ($this->debug)
			{
				echo "Database connection failed: ";
				print_r($e);
				exit;
			}
		}
		return $this->connected;
	} // END FUNCTION (CONNECT FUNCTION)
	
	public function disconnect()
	{
		$this->connected=false;

	}
	public function get_error()
	{
		if ( isset($this->db->error) )
		{
			return var_export($this->db,true);
		}
		return "";
	}

	public function get_tables()
	{
		$this->connect();
		$retval=array();
		try
		{
			$response = $this->db->list_tables();
		}
		catch (Exception $e)
		{
			echo "<pre>";
			print_r($e);
			exit;
		}
		$table_list=$response->body->TableNames;
		foreach ($table_list as $dbtable)
		{
			$retval[]=$dbtable;
		} // END FOREACH
		return $retval;
	}

	public function update($table_name,$new_props,$condition_props)
	{
		$attribute_updates=array();
		$attribute_hashrange=false;
		if ( count($condition_props)==1 )
		{
			$attribute_hashrange=array(
				'HashKeyElement'  => $condition_props[0]->value,
			);
			unset($condition_props[0]);
		}
		else if ( count($condition_props)==2 )
		{
			$attribute_hashrange=array(
				'HashKeyElement'  => $condition_props[0]->value,
				'RangeKeyElement' => $condition_props[1]->value
			);
			unset($condition_props[1]);
			unset($condition_props[0]);
		}
		foreach ($new_props as $new_prop_key=>$new_prop_value)
		{
			$attribute_updates[$new_prop_key]=array(
				'Action' => AmazonDynamoDB::ACTION_PUT,
				'Value'  => array(AmazonDynamoDB::TYPE_STRING => $new_prop_value."")
			);
		}
		$expected_props=array();
		foreach ($condition_props as $remaining_condition_prop)
		{
			$expected_props[$remaining_condition_prop->field]=array(
				'Value' => array( AmazonDynamoDB::TYPE_STRING => $remaining_condition_prop->value )
			);
		}

		$update_command=array(
			'TableName' => $table_name,
			'Key' => $this->db->attributes($attribute_hashrange),
			'AttributeUpdates' => $attribute_updates,
		);
		if ( count($expected_props)>0 )
		{
			$update_command['Expected']=$expected_props;
		}
		$response = $this->db->update_item($update_command);
		if ($response->isOK())
		{
		}
		else
		{
			if ($this->debug)
			{
				echo "<pre>";
				echo "in UPDATE()";
				echo "for table ".$table_name;
				echo "new props:";
				print_r($new_props);
				echo "hashrange props:";
				print_r($attribute_hashrange);
				echo "expected props:";
				print_r($expected_props);

				echo "condition props:";
				print_r($condition_props);
				echo "dynamodb error:";
				print_r($response->body);
				print_r($response);
				exit;
			}
		}

	} // END FUNCTION

	public function delete($table_name,$condition_props)
	{
		$attribute_hashrange=false;
		if ( count($condition_props)==1 )
		{
			$attribute_hashrange=array(
				'HashKeyElement'  => $condition_props[0]->value,
			);
			unset($condition_props[0]);
		}
		else if ( count($condition_props)==2 )
		{
			$attribute_hashrange=array(
				'HashKeyElement'  => $condition_props[0]->value,
				'RangeKeyElement' => $condition_props[1]->value
			);
			unset($condition_props[1]);
			unset($condition_props[0]);
		}
		$expected_props=array();
		foreach ($condition_props as $remaining_condition_prop)
		{
			$expected_props[$remaining_condition_prop->field]=array(
				'Value' => array( AmazonDynamoDB::TYPE_STRING => $remaining_condition_prop->value )
			);
		}

		$delete_command=array(
			'TableName' => $table_name,
			'Key' => $this->db->attributes($attribute_hashrange)
		);
		if ( count($expected_props)>0 )
		{
			$delete_command['Expected']=$expected_props;
		}

		$response = $this->db->delete_item($delete_command);
		if ($response->isOK())
		{
		}
		else
		{
			if ($this->debug)
			{
				echo "in DELETE()";
				echo "in table: ".$table_name;
				echo "condition props:";
				print_r($condition_props);
				echo "dynamodb error:";
				print_r($response->body);
				exit;
			}
		}
		
	} // END FUNCTION

	public function insert($table_name,$props)
	{
	
		$attributes1=$this->db->attributes($props);
		$response = $this->db->batch_write_item(array(
			'RequestItems' => array(
				$table_name => array(
					array(
						'PutRequest' => array(
							'Item' => $attributes1
						)
					),
			)
			)
		));
		if ($response->isOK())
		{
		}
		else
		{
			if ($this->debug)
			{
				echo "in INSERT() for table ".$table_name;
				echo "dynamodb error:";
				print_r($response->body);
				exit;
			}
		}
	
	} // END FUNCTION

	public function select_table($table_name,$fields,$select_props,$count=0)
	{
		if ( count($select_props)==1 )
		{
			if ($select_props[0]->tabletype=="hash")
			{
				$response = $this->db->get_item(array(
					'TableName' => $table_name,
					'Key' => $this->db->attributes(array(
						'HashKeyElement'  => $select_props[0]->value,
					)),
					'AttributesToGet' => $fields,
					'ConsistentRead' => 'true'
				));
			}
			else if ($select_props[0]->tabletype=="hashrange")
			{
				$response = $this->db->query(array(
					'TableName'    => $table_name,
					'HashKeyValue' => array(
						AmazonDynamoDB::TYPE_STRING => $select_props[0]->value
					),
				));
			}

		}
		else if ( count($select_props)==2 )
		{
			if ($select_props[1]->comparison=="EQUAL")
			{
				$response = $this->db->query(array(
					'TableName'    => $table_name,
					'HashKeyValue' => array(
						AmazonDynamoDB::TYPE_STRING => $select_props[0]->value
					),
					'RangeKeyCondition' => array(
						'ComparisonOperator' => AmazonDynamoDB::CONDITION_EQUAL,
						'AttributeValueList' => array(
							array(AmazonDynamoDB::TYPE_STRING => $select_props[1]->value)
						),
					)
				));
			}
			else if ($select_props[1]->comparison=="BEGINS_WITH")
			{
				$response = $this->db->query(array(
					'TableName'    => $table_name,
					'HashKeyValue' => array(
						AmazonDynamoDB::TYPE_STRING => $select_props[0]->value
					),
					'RangeKeyCondition' => array(
						'ComparisonOperator' => AmazonDynamoDB::CONDITION_BEGINS_WITH,
						'AttributeValueList' => array(
							array(AmazonDynamoDB::TYPE_STRING => $select_props[1]->value)
						),
					)
				));
			}
		}

		if ($this->debug)
		{
		}
		
		$retval=array();

		// Check for success...
		if ($response->isOK())
		{
			if ( isset($response->body->Item) )
			{
				$retitem=array();
				$field_found=false;
				foreach ($response->body->Item as $item)
				{
					foreach ($item as $field_key=>$field_value)
					{
						$retitem[$field_key]="".$field_value->S;
						$field_found=true;
					}
				}
				if ($field_found)
				{
					$retval[]=$retitem;
				}
			}
			else if ( isset($response->body->Items) )
			{
				foreach ($response->body->Items as $item)
				{
					$retitem=array();
					$field_found=false;
					foreach ($item as $field_key=>$field_value)
					{
						$retitem[$field_key]="".$field_value->S;
						$field_found=true;
					}
					if ($field_found)
					{
						$retval[]=$retitem;
					}
				}
			}
			else
			{
				echo "RESPONSE:";
				print_r($response);
				exit;
			}
		}
		else
		{
			if (true)  // $this->debug
			{
				echo "in SELECT_TABLE()";
				echo "for table: ".$table_name;
				echo "dynamodb error:";
				print_r($response->body);
			}
		}
		return $retval;	

	} // END FUNCTION
	
} // END CLASS


abstract class Database_Adapter
{
	public $database;
	public $kind;
	function is_mysql()
	{
		if ( strpos(strtolower($this->kind),"mysql")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_mongo()
	{
		if ( strpos(strtolower($this->kind),"mongo")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_mssql()
	{
		if ( strpos(strtolower($this->kind),"sqlserver")!==false || strpos(strtolower($this->kind),"mssql")!==false || strpos(strtolower($this->kind),"ms sql")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_oracle()
	{
		if ( strpos(strtolower($this->kind),"oracle")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_postgres()
	{
		if ( strpos(strtolower($this->kind),"postgres")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_dynamodb()
	{
		if ( strpos(strtolower($this->kind),"dynamodb")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
class Post_Database_Adapter extends Database_Adapter
{
	function __construct($settings)
	{
		if ( isset($_POST['dbtype']) )
		{
			$this->kind=strtolower($_POST['dbtype']);
		}
		else
		{
			$this->kind="unknown";
			return;
		}
		if ($this->is_mysql() || $this->is_mssql() || $this->is_oracle() || $this->is_postgres() || $this->is_mongo() )
		{
			if ($this->is_mysql() )
			{
				$this->database = new Database_Mysql();
				$this->kind="mysql";
			}
			if ($this->is_mssql() )
			{
				$this->kind="mssql";
				$this->database = new Database_Mssql();
			}
			if ($this->is_oracle() )
			{
				$this->kind="oracle";
				$this->database = new Database_Oracle();
			}
			if ($this->is_postgres() )
			{
				$this->kind="postgres";
				$this->database = new Database_Postgres();
			}
			if ($this->is_mongo() )
			{
				$this->kind="mongodb";
				$this->database = new Database_Mongodb();
			}
			if ( isset($_POST['DBHOST']) && isset($_POST['DBUSER']) && isset($_POST['DBPASS']) && isset($_POST['DBNAME']) )
			{
				$this->database->url=$_POST['DBHOST'];
				$this->database->auth1=$_POST['DBUSER'];
				$this->database->auth2=$_POST['DBPASS'];
				$this->database->dbname=$_POST['DBNAME'];
				$this->database->table_prefix=$_POST['DBTABLEPREFIX'];
				$this->database->kind=$this->kind;
				$this->database->connect();
			}
		}
		else if ($this->is_dynamodb() )
		{
			$this->kind="dynamodb";
			$this->database = new Database_Dynamodb();
			if ( isset($_POST['DYNAMO-ACCESS-KEY']) && isset($_POST['DYNAMO-SECRET-KEY']) && isset($_POST['DYNAMO-REGION-NAME']) )
			{
				$this->database->auth1=$_POST['DYNAMO-ACCESS-KEY'];
				$this->database->auth2=$_POST['DYNAMO-SECRET-KEY'];
				$this->database->region=$_POST['DYNAMO-REGION-NAME'];
				$this->database->dbname=$this->database->region;
				$this->database->url=constant("AmazonDynamoDB::".$this->database->region);
				$this->database->table_prefix=$_POST['DBTABLEPREFIX'];
				$this->database->kind=$this->kind;
				$this->database->connect();
			}
		}
		else
		{
			echo "UNRECOGNIZED database TYPE ".$this->kind;
			$this->database=false;
			exit;
		}
	}
}
class Settings_Database_Adapter extends Database_Adapter
{
	function __construct($settings)
	{
		// settings array
		$this->kind=strtolower($settings['memory']['@attributes']['value']);
		if ($this->is_mysql() || $this->is_mssql() || $this->is_oracle() || $this->is_postgres() )
		{
			if ($this->is_mysql() )
			{
				$this->kind="mysql";
				$this->database = new Database_Mysql();
			}
			if ($this->is_mssql() )
			{
				$this->kind="mssql";
				$this->database = new Database_Mssql();
			}
			if ($this->is_oracle() )
			{
				$this->kind="oracle";
				$this->database = new Database_Oracle();
			}
			if ($this->is_postgres() )
			{
				$this->kind="postgres";
				$this->database = new Database_Postgres();
			}
			if ($this->is_mongo() )
			{
				$this->kind="mongodb";
				$this->database = new Database_Mongodb();
			}
			$this->database->url=$settings[$this->kind]['server']['@attributes']['value'];
			$this->database->auth1=$settings[$this->kind]['user']['@attributes']['value'];
			$this->database->auth2=$settings[$this->kind]['pass']['@attributes']['value'];
			$this->database->dbname=$settings[$this->kind]['database']['@attributes']['value'];
			$this->database->table_prefix=$settings[$this->kind]['table-prefix']['@attributes']['value'];
			$this->database->kind=$this->kind;
			$this->database->connect();
		}
		else if ($this->is_dynamodb() )
		{
			$this->kind="dynamodb";
			$this->database = new Database_Dynamodb();
			$this->database->auth1=$settings[$this->kind]['access-key']['@attributes']['value'];
			$this->database->auth2=$settings[$this->kind]['secret-key']['@attributes']['value'];
			$this->database->region=$settings[$this->kind]['region']['@attributes']['value'];
			$this->database->dbname=$this->database->region;
			$this->database->url=constant("AmazonDynamoDB::".$this->database->region);
			$this->database->table_prefix=$settings[$this->kind]['table-prefix']['@attributes']['value'];
			$this->database->kind=$this->kind;
			$this->database->connect();
		}
		else
		{
			echo "UNRECOGNIZED database TYPE ".$this->kind;
			$this->database=false;
			exit;
		}
	
	} // END FUNCTION

} // end class


class MatchEntry_Database_Adapter extends Database_Adapter
{
	function __construct($settings)
	{
		// settings array
		$this->kind=$settings['db_type']->value;
		if ($this->is_mysql() || $this->is_mssql() || $this->is_oracle() || $this->is_postgres() )
		{
			if ($this->is_mysql() )
			{
				$this->kind="mysql";
				$this->database = new Database_Mysql();
			}
			if ($this->is_mssql() )
			{
				$this->kind="mssql";
				$this->database = new Database_Mssql();
			}
			if ($this->is_oracle() )
			{
				$this->kind="oracle";
				$this->database = new Database_Oracle();
			}
			if ($this->is_postgres() )
			{
				$this->kind="postgres";
				$this->database = new Database_Postgres();
			}
			if ($this->is_mongo() )
			{
				$this->kind="mongodb";
				$this->database = new Database_Mongodb();
			}
			if ( isset($settings['DBHOST']) && isset($settings['DBUSER']) && isset($settings['DBPASS']) && isset($settings['DBNAME']) )
			{
				$this->database->url=$settings['DBHOST']->value;
				$this->database->auth1=$settings['DBUSER']->value;
				$this->database->auth2=$settings['DBPASS']->value;
				$this->database->dbname=$settings['DBNAME']->value;
				$this->database->table_prefix="";//$settings['DBTABLEPREFIX']->value;
				$this->database->kind=$this->kind;
				$this->database->connect();
			}
		}
		else if ($this->is_dynamodb() )
		{
			$this->kind="dynamodb";
			$this->database = new Database_Dynamodb();
			if ( isset($settings['DYNAMO-ACCESS-KEY']) && isset($settings['DYNAMO-SECRET-KEY']) && isset($settings['DYNAMO-REGION-NAME']) )
			{
				$this->database->auth1=$settings['DYNAMO-ACCESS-KEY']->value;
				$this->database->auth2=$settings['DYNAMO-SECRET-KEY']->value;
				$this->database->region=$settings['DYNAMO-REGION-NAME']->value;
				$this->database->url=constant("AmazonDynamoDB::".$this->database->region);
				$this->database->table_prefix="";//$settings['DBTABLEPREFIX']->value;
				$this->database->kind=$this->kind;
				$this->database->connect();
			}
		}
		else
		{
			echo "UNRECOGNIZED database TYPE ".$this->kind;
			$this->database=false;
			exit;
		}
	
	} // END FUNCTION

} // end class

?>
