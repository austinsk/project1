<?php
//this is a code fragment from a cron job that checks the db and sends mails periodically  (every 5 mins)


class Sms{
	public $sender;
	public $numbers;
	public $message;
	
	public function __construct($sender,$numbers,$message){
		$this->message = urlencode($message);
		$this->numbers = $numbers;
		$this->sender = urlencode($sender);
		}
		
	public function send_single_message(){
		 $numbers = trim($this->numbers);
		 $url = "http://www.bulksmsnigeria.net/components/com_spc/smsapi.php?username=acnwogbo&password=nnc123&sender=$this->sender&recipient={$numbers}&message=$this->message";
		//$url = "http://api.clickatell.com/http/sendmsg?user=dsalientsailor&password=nnc123&api_id=3564578&to=2348135341653&text=Message
//";

	//we open it
 	$fp = fopen($url, 'r');
	//read the data that is sent back i.e response data
 	 echo  $data = fread($fp, 10);
	//close connection
 	fclose($fp);
	if(stripos($data, "ok") !== false){
		//do success stuff
		//$_SESSION['success'] = "SMS sent";
	}
	
		
		}
	public function send_message(){
		$number_array = explode(' ',$this->numbers);
		$numbers = '';
		foreach($number_array as $data){
			$num = trim($data);
			if(!empty($num)){
				$numbers .= $num;
				}
				
			
			}
			
			//$numbers = 
		$url = "http://www.bulksmsnigeria.net/components/com_spc/smsapi.php?username=edujohn&password=omeokweedu&sender=$this->sender&recipient={$numbers}&message=$this->message";
		
	//we open it
 	$fp = fopen($url, 'r');
	//read the data that is sent back i.e response data
 	 $data = fread($fp, 10);
	//close connection
 	fclose($fp);
	if(stripos($data, "ok") !== false){
		//do success stuff
		$_SESSION['success'] = "SMS sent";
	}
	
		
		}	
	}	
	
?>