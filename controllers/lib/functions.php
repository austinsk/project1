<?php

function object_to_array($result){
			$array = array();
			foreach ($result as $key=>$value)
			{
				if (is_object($value))
				{
					$array[$key]=object_2_array($value);
				}
				if (is_array($value))
				{
					$array[$key]=object_2_array($value);
				}
				else
				{
					$array[$key]=$value;
				}
			}
			return $array;
		}



function show_array($array){
	echo '<pre>',print_r($array),'</pre>';
};
function clean($data){
	return htmlentities(strip_tags(trim($data)));
	}
function clean3($data){
	return addslashes(strip_tags(trim($data)));
	}

function clean2($data){
	return htmlentities(addslashes(trim($data)));
	}


function naira(){
	return "&#8358;";
	}
function ordinal($number) {
    $ends = array('th','st','nd','rd','th','th','th','th','th','th');
    if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
    else
        return $number. $ends[$number % 10];
}
	// This file is the place to store all basic functions
function delete_session(){
			unset($_SESSION['user_id'],$_SESSION['user_role'] ,$_SESSION['user_logged_in'],$_SESSION['userAgent'],$_SESSION['rmt_address']);
       // session_destroy();
		 unset($_COOKIE['rememberme']);
   		 setcookie('rememberme', '', time() - 3600, '/');

			}



function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


function log_action($action, $message="") {
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}


	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}



function go( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}else{
			$location = $_SERVER['HTTP_REFERER'];
			header("Location: {$location}");
			exit;
			
			}
	}

	

 
	 function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( trim($value) );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( trim($value) ); }
			// if magic quotes are active, then the slashes already exist
			//striptags
		}
		//return htmlentities($value,ENT_QUOTES, 'UTF-8');
		return $value;
	}
	
	

	function money($data){
		$new_money = "&#8358;" . number_format($data,2);
		return $new_money;}
	
	function money2($data){
		$new_money = "N" . number_format($data,2);
		return $new_money;}	
	
	
	
	/*public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}
	
	
*/
function insert($data){
	return strtolower(trim($data));
	}

function thumb($path){
	$thumb = explode('.',$path);
	$thumbs = $thumb[0] . '_THUMB.' . $thumb[1];
	return '../picedit/'.$thumbs;
	}	

function thumb2($path){
	$thumb = explode('.',$path);
	$thumb = $thumb[0] . '_THUMB2.' . $thumb[1]; 
	return '../picedit/'.$thumb;
	}	

function profile_thumb($path){
	$thumb = explode('.',$path);
	$thumb = $thumb[0] . '_THUMB.' . $thumb[1];
	return '../picedit/'.$thumb;
	}

	

function resize_name($name){
	$name = ucwords($name);
	if(strlen($name) > 15){
		$name = substr($name,0,15) . "...";
	}	
	return $name;
}

function resize_name3($name){
	$name = ucwords($name);
	if(strlen($name) > 10){
		$name = substr($name,0,10) . "...";
	}	
	return $name;
}

function resize_name_small($name){
	$name = ucwords($name);
	if(strlen($name) > 6){
		$name = substr($name,0,5) . "...";
	}	
	return $name;
}


function resize_name2($name){
	$name = ucwords($name);
	if(strlen($name) > 30){
		$name = substr($name,0,30) . "...";
	}	
	return $name;
}
function resize_school_name($name){
	$name = ucwords($name);
	if(strlen($name) > 30){
		$name = substr($name,0,29) . "...";
	}	
	return $name;
}


function resize_text($name){
	$name = $name;
	if(strlen($name) > 30){
		$name = substr($name,0,30) . "...";
	}	
	return $name;
}


function resize_album_name($name){
	$name = ucwords($name);
	if(strlen($name) > 30){
		$name = substr($name,0,30) . "...";
	}	
	return $name;
}



function ago($time)
{
$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
$lengths = array("60","60","24","7","4.35","12","10");

$now = time();

$difference     = $now - $time;
$tense         = "ago";

for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
$difference /= $lengths[$j];
}

$difference = round($difference);

if($difference != 1) {
$periods[$j].= "s";
}

return "$difference $periods[$j] ago ";
}

 function gender($sex){
	 $title;
	switch($sex){
		case 'nale':
		$title = "his";
		break;
		
		case 'female':
		$title = "her";
		break;
		
		}
		return $title;
	}


    function getVisitorIP() {
        $ip = "0.0.0.0";
        if( ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) && ( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) ) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif( ( isset( $_SERVER['HTTP_CLIENT_IP'])) && (!empty($_SERVER['HTTP_CLIENT_IP'] ) ) ) {
            $ip = explode(".",$_SERVER['HTTP_CLIENT_IP']);
            $ip = $ip[3].".".$ip[2].".".$ip[1].".".$ip[0];
        } elseif((!isset( $_SERVER['HTTP_X_FORWARDED_FOR'])) || (empty($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            if ((!isset( $_SERVER['HTTP_CLIENT_IP'])) && (empty($_SERVER['HTTP_CLIENT_IP']))) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        return $ip;
    }


 function singularPlural($item){
		if($item ==0 || $item ==1){
			return "$item item";
			}else if($item > 1){
				return "$item items";
				}
		}
		
		





function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */
    
    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
     
    switch($interval) {
     
    case 'yyyy': // Number of full years
        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;
    case "q": // Number of full quarters
        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;
    case "m": // Number of full months
        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;
    case 'y': // Difference between day numbers
        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;
    case "d": // Number of full days
        $datediff = floor($difference / 86400);
        break;
    case "w": // Number of full weekdays
        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;
    case "ww": // Number of full weeks
        $datediff = floor($difference / 604800);
        break;
    case "h": // Number of full hours
        $datediff = floor($difference / 3600);
        break;
    case "n": // Number of full minutes
        $datediff = floor($difference / 60);
        break;
    default: // Number of full seconds (default)
        $datediff = $difference;
        break;
    }    
    return $datediff;
}
	
	
	
	function convertTime($seconds) {
		  $hours = floor($seconds / 3600);
		  $minutes = floor(($seconds / 60) % 60);
		  $seconds = $seconds % 60;
		  $time = '';
		  if(!empty($hours)){
			  $time .= $hours .' hours,';
			  }
			if(!empty($minutes)){
			  $time .= $minutes .' minutes,';
			  } 
			 
			 if(!empty($seconds)){
			  $time .= $seconds .' seconds';
			  }   
			  
			  
		  return $time;
}	
	
	
	
function success($message, $mobile=''){
	if(isset($mobile) && $mobile == 1){
		echo json_encode(array('status'=>$message));
	}else{

		$_SESSION['success']  = $message;

	

	}
	
	}

function error($message = "An error occurred. Pls try again", $mobile){
	if(isset($mobile) && $mobile == 1){
echo json_encode(array('status'=>$message));
	}else{

		
$_SESSION['error']  = $message;
	

	}
	}


function elapsed_time($timestamp, $precision = 2) { 
   $time = time() - $timestamp; 
   $a = array('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'min' => 60, 'sec' => 1); 
   $i = 0; 
     foreach($a as $k => $v) { 
       $$k = floor($time/$v); 
       if ($$k) $i++; 
       $time = $i >= $precision ? 0 : $time - $$k * $v; 
       $s = $$k > 1 ? 's' : ''; 
       $$k = $$k ? $$k.' '.$k.$s.' ' : ''; 
       @$result .= $$k; 
     } 
   return $result ? $result.'ago' : '1 sec to go'; 
 }		

	
?>