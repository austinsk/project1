<?php 
class Session {
	private $db;
	
	public function __construct(){
  // Instantiate new Database object
  
 
  // Set handler to overide SESSION
  session_set_save_handler(
    array($this, "_open"),
    array($this, "_close"),
    array($this, "_read"),
    array($this, "_write"),
    array($this, "_destroy"),
    array($this, "_gc")
  );
 
  // Start the session
  session_start();
  try{
 
	$this->db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" .DB_NAME . "",'' . DB_USER . '','' .DB_PASS . '');

//$database = new PDO("mysql:host=DB_SERVER;dbname=compsci",'DB_USER','DB_PASS');
} catch(PDOException $e)
{
echo $e->getMessage();
	}
	
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$database->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);


}



public function _open(){
  // If successful
  if($this->db){
    // Return True
    return true;
  }
  // Return False
  return false;
}
 
 
 
 public function _close(){
  // Close the database connection
  // If successful
 // if($this->db->close()){
    // Return True
  //  return true;
 // }
  // Return False
  return false;
}





public function _read($id){
  // Set query
  global $database;
 // echo $database;
  echo $this->db;
  $result = $database->prepare('SELECT data FROM session WHERE id = :id');
   
  // Bind the Id
  $result->bindValue(':id', $id,PDO::PARAM_INT);
 $result->execute();
  // Attempt execution
  // If successful
  if($result->rowCount()){
    // Save returned row
    $row = $result->fetch(PDO::FETCH_OBJ);;
    // Return the data
    return $row->data;
  }else{
    // Return an empty string
    return '';
  }
}






public function _write($id, $data){
	global $database;
	echo $database;
  // Create time stamp
  $access = time();
     
  // Set query  
  $result = $database->prepare('REPLACE INTO sessions VALUES (:id, :access, :data)');
     
  // Bind data
  $result->bindValue(':id', $id,PDO::PARAM_INT);
  $result->bindValue(':access', $access,PDO::PARAM_INT);  
  $result->bindValue(':data', $data,PDO::PARAM_INT);
 
  // Attempt Execution
  // If successful
  if($this->db->execute()){
    // Return True
    return true;
  }
   
  // Return False
  return false;
}




public function _destroy($id){
  // Set query
  $this->db->query('DELETE FROM sessions WHERE id = :id');
     
  // Bind data
  $this->db->bind(':id', $id);
     
  // Attempt execution
  // If successful
  if($this->db->execute()){
    // Return True
    return true;
  }
 
  // Return False
  return false;
}




/**
 * Garbage Collection
 */
public function _gc($max){
  // Calculate what is to be deemed old
  $old = time() - $max;
 
  // Set query
  $this->db->query('DELETE * FROM sessions WHERE access < :old');
     
  // Bind data
  $this->db->bind(':old', $old);
     
  // Attempt execution
  if($this->db->execute()){
    // Return True
    return true;
  }
 
  // Return False
  return false;
}
}?>