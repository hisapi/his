<?php

// ABSTRACT CLASS FOR TYPES OF MESSAGE
abstract class Message 
{
	private $messenger=false;
	private $debug=false;
	private $kind=""; 
 
	private $host="";
	private $port="";
	private $vhost="";
	private $queue_prefix="";
	private $auth1="";
	private $auth2="";
	public $connected=false;

	abstract protected function connect();
	abstract protected function get_queue_list();
	abstract protected function send_message($queue,$message);
	abstract protected function read_message($queue);
	abstract protected function close();

	// Functions used by all concrete Message types
	public function connectcheck($failed)
	{
		if ($failed)
		{
			$this->connected=false;
			if ($this->debug)
			{
				echo "Could not connect to message queue named '".htmlspecialchars($this->kind)."'.";
			}
			return false;
		}
		else
		{
			$this->connected=true;
			return true;
		}
		return false;
	}
	public function _format_bytes($a_bytes)
	{
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KiB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MiB';
		} elseif ($a_bytes < 1099511627776) {
			return round($a_bytes / 1073741824, 2) . ' GiB';
		} elseif ($a_bytes < 1125899906842624) {
			return round($a_bytes / 1099511627776, 2) .' TiB';
		} elseif ($a_bytes < 1152921504606846976) {
			return round($a_bytes / 1125899906842624, 2) .' PiB';
		} elseif ($a_bytes < 1180591620717411303424) {
			return round($a_bytes / 1152921504606846976, 2) .' EiB';
		} elseif ($a_bytes < 1208925819614629174706176) {
			return round($a_bytes / 1180591620717411303424, 2) .' ZiB';
		} else {
			return round($a_bytes / 1208925819614629174706176, 2) .' YiB';
		}
	} // end function
	
} // end abstract class


class Message_None extends Message 
{
	public $connected=true;
	public function connect(){$this->connected=true;return true;}
	public function get_queue_list(){}
	public function send_message($queue,$message){}
	public function read_message($queue){}
	public function close(){}

}

// CONCRETE MESSAGE TYPE: RABBIT MQ
//require_once("");
class Message_RabbitMQ extends Message 
{
	public function get_queue_list()
	{

	}
	function __construct()
	{
	}
	function connect()
	{
		if ($this->connected) {return true;}
		$failed=false;
		$this->debug=true;

		$includes = folder_loader("api/PhpAmqpLib",Array("Channel","Exception","Abstract","AMQPException","AMQPProtocolException","Interface","AMQPConnection","AMQPException","AMQPStreamConnection","AbstractConnection"),Array("Tests"));
		foreach ($includes as $inc)
		{
		        include_once($inc);
		}
		//use PhpAmqpLib\Connection\AMQPConnection;
		//use PhpAmqpLib\Message\AMQPMessage;
		//if (class_exists("PhpAmqpLib\Connection\AMQPConnection")) echo "YES";
		//else echo "NO";
		//echo "<pre>";
		//$this->vhost="";
		try
		{
			$conn = new PhpAmqpLib\Connection\AMQPConnection($this->host, $this->port, $this->auth1, $this->auth2, $this->vhost) or $failed=true;
		} catch (Exception $e)
		{
			echo htmlspecialchars($e);
			exit;
		}
		$this->messenger = $conn;
		return $this->connectcheck($failed);
	}
	function close()
	{
		$this->connected=false;
		$this->messenger->close();
	}
	function send_message($queue,$message)
	{
		if (!$this->connected) {$this->connect();}
		$ch = $this->messenger->channel();

		/*
		    The following code is the same both in the consumer and the producer.
		    In this way we are sure we always have a queue to consume from and an
		        exchange where to publish messages.
		*/
		
		/*
		    name: $queue
		    passive: false
		    durable: true // the queue will survive server restarts
		    exclusive: false // the queue can be accessed in other channels
		    auto_delete: false //the queue won't be deleted once the channel is closed.
		*/
		$ch->queue_declare($queue, false, true, false, false);

		/*
		    name: $exchange
		    type: direct
		    passive: false
		    durable: true // the exchange will survive server restarts
		    auto_delete: false //the exchange won't be deleted once the channel is closed.
		*/
		$exchanger=$queue;
		$ch->exchange_declare($exchanger, 'direct', false, true, false);
		$ch->queue_bind($queue, $exchanger);
		$msg = new PhpAmqpLib\Message\AMQPMessage($message, array('content_type' => 'text/plain', 'delivery_mode' => 2));
		$ch->basic_publish($msg, $exchanger);
		$ch->close();
		$this->close();
	}
        function read_message($queue)
        {
		//echo "READ MESSAGE";
                if (!$this->connected) {$this->connect();}
                $ch = $this->messenger->channel();

                /*
                    name: $queue
                    passive: false
                    durable: true // the queue will survive server restarts
                    exclusive: false // the queue can be accessed in other channels
                    auto_delete: false //the queue won't be deleted once the channel is closed.
                */
		$ch->queue_declare($queue, false, true, false, false);

		/*
		    name: $exchange
		    type: direct
		    passive: false
		    durable: true // the exchange will survive server restarts
		    auto_delete: false //the exchange won't be deleted once the channel is closed.
		*/
		$exchanger=$queue;
		$ch->exchange_declare($exchanger, 'direct', false, true, false);
		$ch->queue_bind($queue, $exchanger);
		

			$msg = $ch->basic_get($queue);
			if ( isset($msg->delivery_info) )
			{
				if ( isset($msg->delivery_info['delivery_tag']) )
				{
					//echo "info:";
					//print_r($msg);
					$ch->basic_ack($msg->delivery_info['delivery_tag']);
				}
			}
		//echo "<pre>";
		//print_r($msg);
		//var_dump($msg);
		$message = "";
		if ( isset($msg->body) )
		{
			$message = $msg->body;
		}
		
		$ch->close();
		$this->close();
		return $message;


        } // end function (read messages)

}

// CONCRETE MESSAGE TYPE: SQS
require_once("api/aws-sdk/sdk.class.php");
class Message_SQS extends Message 
{
	public $region;
	public function get_queue_list()
	{
        if (!$this->connected) {$this->connect();}
		return $this->messenger->list_queues();
	}
	public function send_message($queue,$message)
	{
		if (!$this->connected) {$this->connect();}
		//$this->messenger->set_region(AmazonSQS::$this->region);
		$this->messenger->set_region("sqs.".$this->region_url_snippet().".amazonaws.com");
		/*$amazon_user_id = $this->get_user_id();
                $queue_url="";
                if ( strlen($amazon_user_id)>0 )
                {
                        $queue_url = "http://sqs.".str_replace("_","-",strtolower($this->region_url_snippet())).".amazonaws.com/$amazon_user_id/$queue";

                }
                else
                {
                        echo "<error>Unable to collect IAM User Id for user ".$this->auth1." using IAM.  Unable to send to SQS queue.</error>";
			exit;
                }
		*/
                $queue_url="";
                //echo "QUEUE URL: $queue_url";
                $queue_list_response = $this->messenger->get_queue_list();
                $found_queue = false;
		if ($queue_list_response)
		{
			if ( count($queue_list_response)>0 )
			{
		                foreach ($queue_list_response as $queue_list_item)
		                {
		                        if( strpos($queue_list_item,$queue) )
		                        {
		                                $found_queue=true;
		                                $queue_url = $queue_list_item;
		                                break;
		                        }
		                }
			}
		}
                if (!$found_queue)
                {
                        $queue_created_successfully=false;
                        $create_queue_response = $this->create_queue($queue);
                        if ( isset($create_queue_response->body) )
                        {
                                if ( isset($create_queue_response->body->CreateQueueResult) )
                                {
                                        if ( isset($create_queue_response->body->CreateQueueResult->QueueUrl) )
                                        {
                                                $queue_created_successfully=true;
						$queue_url = $create_queue_response->body->CreateQueueResult->QueueUrl;
						echo $queue_url;
                                                //echo "CREATED QUEUE SUCCESSFULLY";
                                        }
                                }
                        }
                }


                $message_content = "";
                $message_receipt_handle = "";
                if ($found_queue || $queue_created_successfully)
                {
			$response = $this->messenger->send_message($queue_url, $message);
			//echo "sending message $message";
		}
		return $response->isOK();
	}
	public function get_user_id()
	{
		$failed=false;
		$iam = new AmazonIAM(array(
			'key' => $this->auth1,
			'secret' => $this->auth2
		)) or $failed=true;
		$amazon_user_id = "";
		if (!$failed)
		{
			$user_response = $iam->get_user();
			if ( isset($user_response->body) )
			{
				if ( isset($user_response->body->GetUserResult) )
				{
					if ( isset($user_response->body->GetUserResult) )
					{
						if ( isset($user_response->body->GetUserResult->User) )
						{
							if ( isset($user_response->body->GetUserResult->User->UserId) )
							{
								$amazon_user_id = $user_response->body->GetUserResult->User->UserId;
							}
						}
					}
				}
			}
		}
		return $amazon_user_id;
	}
	public function region_url_snippet()
	{
		// from http://docs.aws.amazon.com/general/latest/gr/rande.html#sqs_region
		if ( $this->region=="REGION_US_E1" )
		{
			return "us-east-1";
		}
		else if ( $this->region=="REGION_US_W1" )
		{
			return "us-west-1";
		}
		else if ( $this->region=="REGION_US_W2" )
		{
			return "us-west-2";
		}
		else if ( $this->region=="REGION_APAC_SE1" )
		{
			return "ap-southeast-1";
		}
		else if ( $this->region=="REGION_APAC_SE2" )
		{
			return "ap-southeast-2";
		}
		else if ( $this->region=="REGION_APAC_NE1" )
		{
			return "ap-northeast-1";
		}
		else if ( $this->region=="REGION_SA_E1" )
		{
			return "sa-east-1";
		}
		else if ( $this->region=="REGION_US_GOV1" )
		{
			return "us-gov-1";
		}
		return "us-east-1";
	}
	public function read_message($queue)
	{
	        if (!$this->connected) {$this->connect();}
		$this->messenger->set_region("sqs.".$this->region_url_snippet().".amazonaws.com");
		/*$amazon_user_id=$this->get_user_id();
		$queue_url="";
		
		if ( strlen($amazon_user_id)>0 )
		{
			$queue_url = "http://sqs.".str_replace("_","-",strtolower($this->region_url_snippet())).".amazonaws.com/$amazon_user_id/$queue";
			
		}
		else
		{
			return "<error>Unable to collect IAM User Id for user ".$this->auth1." using IAM.  Unable to read SQS queue.</error>";
		}
		*/
		$queue_url="";
		//echo "QUEUE URL: $queue_url";
		$queue_list_response = $this->messenger->get_queue_list();
		$found_queue = false;
		if ( $queue_list_response )
		{
			if ( count($queue_list_response)>0 )
			{
				foreach ($queue_list_response as $queue_list_item)
				{
					if( strpos($queue_list_item,$queue) )
					{
						$found_queue=true;
						$queue_url = $queue_list_item;
						break;
					}
				}
			}
		}
		if (!$found_queue)
		{
			$queue_created_successfully=false;
                        $create_queue_response = $this->create_queue($queue);
			if ( isset($create_queue_response->body) )
			{
				if ( isset($create_queue_response->body->CreateQueueResult) )
				{
					if ( isset($create_queue_response->body->CreateQueueResult->QueueUrl) )
					{
						$queue_created_successfully=true;
						$queue_url = $create_queue_response->body->CreateQueueResult->QueueUrl;
						//echo $queue_url;
						//echo "CREATED QUEUE SUCCESSFULLY";
					}
				}
			}
		}
		$message_content = "";
		$message_receipt_handle = "";
		if ($found_queue || $queue_created_successfully)
		{
			$response = $this->messenger->receive_message($queue_url, array(
				'MaxNumberOfMessages' => 1
			));
			if ( isset($response->body) )
			{
				if ( isset($response->body->ReceiveMessageResult) )
				{
					if ( isset($response->body->ReceiveMessageResult->Message) )
					{
						if ( isset($response->body->ReceiveMessageResult->Message->Body) )
						{
							$message_content = $response->body->ReceiveMessageResult->Message->Body;
						}
						if ( isset($response->body->ReceiveMessageResult->Message->ReceiptHandle) )
						{
							$message_receipt_handle = $response->body->ReceiveMessageResult->Message->ReceiptHandle;
						}
					
					}
				
				}
			}
			if (strlen($message_receipt_handle)>0 )
			{
				$response = $this->messenger->delete_message($queue_url, $message_receipt_handle);
				if (!$response->isOK())
				{
					return "<warning>Warning: unable to delete message using receipt handle</warning>";
				}
			}
			return $message_content;
		}
		else
		{
			return "<error>Unable to create queue, or queue status was not able to be determined.</error>";
		}
	}
	public function close()
	{
	}
	function __construct()
	{
	}
	function create_queue($queue)
	{
        if (!$this->connected) {$this->connect();}
		//echo "REGION:".$this->region;
		//$this->messenger->set_region(AmazonSQS::$this->region);
		$this->messenger->set_region("sqs.".$this->region_url_snippet().".amazonaws.com");
		$response = $this->messenger->create_queue($queue);
		if ( $response->isOK() )
		{
	                $queue_url="";
	                //echo "QUEUE URL: $queue_url";
			sleep(5);
	                $queue_list_response = $this->messenger->get_queue_list();
	                $found_queue = false;
	                if ( $queue_list_response )
	                {
	                        if ( count($queue_list_response)>0 )
	                        {
	                                foreach ($queue_list_response as $queue_list_item)
	                                {
	                                        if( strpos($queue_list_item,$queue) )
	                                        {
	                                                $found_queue=true;
	                                                $queue_url = $queue_list_item;
	                                                break;
	                                        }
	                                }
	                        }
	                }
			$response_setattr = $this->messenger->set_queue_attributes($queue_url, array(
			    array( // Attribute.0
			        'Name' => 'MessageRetentionPeriod',
			        'Value' => 60
			    )
			));
		}
		return $response;
	}
	function connect()
	{
		if ($this->connected) {return true;}
		$failed=false;
		$sqs = new AmazonSQS(array(
			'key' => $this->auth1,
			'secret' => $this->auth2
		)) or $failed=true;
		$this->messenger=$sqs;
		return $this->connectcheck($failed);
	}
	public function bucket_syntax()
	{
		return "bucket";	
	}
} // end class



abstract class Message_Adapter
{
	public $messenger;
	public $kind;
	function is_none()
	{
		if ( strpos($this->kind,"no-")!==false || strpos($this->kind,"messaging")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_sqs()
	{
		if ( strpos($this->kind,"aws")!==false || strpos($this->kind,"sqs")!==false || strpos($this->kind,"amazon")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function is_rabbit()
	{
		if ( strpos($this->kind,"rabbit")!==false )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
class Post_Message_Adapter extends Message_Adapter
{
	function __construct($settings)
	{
		if ( isset($_POST['mstype']) )
		{
                	$this->kind=$_POST['mstype'];
		}
		else
		{
			$this->kind="unknown";
			return;
		}
		if ($this->is_none() )
		{
			$this->messenger = new Message_None();
		}
		else if ($this->is_sqs() )
		{
			$this->messenger = new Message_SQS();
			$this->messenger->auth1=$_POST['SQS-ACCESS-KEY'];
			$this->messenger->auth2=$_POST['SQS-SECRET-KEY'];
			$this->messenger->region=$_POST['SQS-REGION-NAME'];
			$this->messenger->queue_prefix=$_POST['SQS-QUEUE-PREFIX'];
			$this->messenger->kind=$this->kind;
			$this->messenger->connect();
		}
		else if ($this->is_rabbit() )
		{
			$this->messenger = new Message_RabbitMQ();
			$this->messenger->host=$_POST['RABBITHOST'];
			$this->messenger->port=$_POST['RABBITPORT'];
			$this->messenger->auth1=$_POST['RABBITUSER'];
			$this->messenger->auth2=$_POST['RABBITPASS'];
			$this->messenger->vhost=$_POST['RABBITVHOST'];
			$this->messenger->queue_prefix=$_POST['RABBITQUEUEPREFIX'];
			$this->messenger->kind=$this->kind;
			$this->messenger->connect();
		}
		else
		{
			echo "UNRECOGNIZED MESSENGER TYPE ".$this->kind;
			$this->messenger=false;
			exit;
		}
	}
}
class Settings_Message_Adapter extends Message_Adapter
{
	function __construct($settings)
	{
		// settings array
		$this->kind=$settings['messenger']['@attributes']['value'];
		if ($this->is_none() )
		{
			$this->messenger = new Message_None();
			$this->messenger->kind=$this->kind;
		}
		else if ($this->is_sqs() )
		{
			$this->messenger = new Message_SQS();
			$this->messenger->auth1=$settings[$this->kind]['access-key']['@attributes']['value'];
			$this->messenger->auth2=$settings[$this->kind]['secret-key']['@attributes']['value'];
			$this->messenger->region=$settings[$this->kind]['region']['@attributes']['value'];
			$this->messenger->queue_prefix=$settings[$this->kind]['queue-prefix']['@attributes']['value'];
			$this->messenger->kind=$this->kind;
			//$this->messenger->connect();
		}
		else if ($this->is_rabbit() )
		{
			$this->messenger = new Message_RabbitMQ();
			$this->messenger->host=$settings[$this->kind]['server']['@attributes']['value'];
			$this->messenger->port=$settings[$this->kind]['port']['@attributes']['value'];
			$this->messenger->auth1=$settings[$this->kind]['user']['@attributes']['value'];
			$this->messenger->auth2=$settings[$this->kind]['pass']['@attributes']['value'];
			$this->messenger->vhost=$settings[$this->kind]['vhost']['@attributes']['value'];
			$this->messenger->queue_prefix=$settings[$this->kind]['queue-prefix']['@attributes']['value'];
			//$this->messenger->exchanger=$settings[$this->kind]['exchange']['@attributes']['value'];
			$this->messenger->kind=$this->kind;
			//$this->messenger->connect();
		}
		else
		{
			echo "UNRECOGNIZED MESSENGER TYPE "+$this->kind;
			$this->messenger=false;
			exit;
		}
	
	}

} // end class


?>