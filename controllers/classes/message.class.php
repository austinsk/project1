<?php

	class Message{

		public $details;
		public $user;
		public $user_role;
		public $messages;


		

		public function fetchAllMessages($sender_id, $recipient_id){


			global $database;

			$sql= "SELECT m.* FROM message m WHERE ((sender_id = $sender_id AND recipient_id = $recipient_id) OR (sender_id = $recipient_id AND recipient_id =$sender_id)) ORDER BY m.id ASC";

			$this->messages = $database->query($sql);

			


		}

		


		public function sendMessage(){




			 $message = clean($_POST['message']);

			 $recipient_id = $_POST['recipient_id'];

			 $message_parent_id = 0;



			
			
			

			//check for empty stuff

			
			$date_created = time();
			$active = 1;

			global $database;

			$sql = "INSERT INTO message (`message`, `sender_id` ,`message_parent_id` , `recipient_id`, `date_created`,`active`) VALUES ( :message, :sender_id, :message_parent_id,  :recipient_id, :date_created, :active)";

		

			$result = $database->prepare($sql);
			$result->bindValue('sender_id',$_SESSION['user_id'],PDO::PARAM_INT);
			$result->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
			$result->bindValue('message',$message,PDO::PARAM_STR);
			$result->bindValue('message_parent_id',$message_parent_id,PDO::PARAM_INT);
			$result->bindValue('date_created',$date_created,PDO::PARAM_INT);
			$result->bindValue('active',$active,PDO::PARAM_INT);


			$result->execute();


			if($result->rowCount() > 0){
              
				success('Message sent successfully');
			}else{
				error('An error occurred. Please try again');
			}


		}



		public function fetchEmployeeMessageInbox(){
			global $database;
			$sql = "SELECT m.*, s.first_name, s.surname FROM message m LEFT JOIN staff s ON (m.sender_id = s.id) WHERE m.recipient_id = 21 ORDER BY m.id ASC";
			$result = $database->query($sql);
			return $result;
		}


		public function displayEmployeeMessageInbox(){
			
			
		$result=$this->fetchEmployeeMessageInbox();
		if($result->rowCount()>0){
			
			
			$html='<table id="inbox" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>From</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>';


						
               while($data=$result->fetch(PDO::FETCH_ASSOC)){
				   
				   	

               	 $html .='<tr>
                  
		                  <td>'.$data['first_name'].'</td>
		                  <td>'.$data['subject'].'</td>
		                  <td>'.$date.'</td>
		                  <td>
		                  <a class="btn btn-xs btn-info" href="message-details?id='.$data['id'].'">View</a>
		                  

		                  </td>
		                  
		                </tr>';

						
               }

              
                
               $html .= '</tbody>
                <tfoot>
                <tr>
                  <th>From</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>';
      }else{

      	$html = '<h3>You Have No Messages</h3>';
      }


			return $html;

			
		
		
		}



		public function fetchMessages(){
		global $database;	
		
	
		
		$sql="SELECT m.reply,m.sender_type,m.recipient_type,m.recipient_id,m.id,m.sender_type,m.sender_id, m.subject,m.sender_read_status,m.read_status,m.message_parent_id AS parent, m.date_created FROM message m 
			WHERE 
			(	(m.id IN(SELECT DISTINCT message_parent_id FROM message WHERE recipient_id = :user AND recipient_type = :role AND type = :type AND active=:active)) || 
				(m.recipient_id = :user AND m.recipient_type = :role AND m.type = :type AND m.active=:active AND m.message_parent_id =0) 
			) AND 
			(
				(m.sender_type=:role AND m.sender_id=:user AND m.sender_read_status=:status)
				||
				(m.recipient_id = :user AND m.recipient_type = :role AND m.read_status=:status)
			)
			
			
			";
			
			
			
		$result = $database->prepare($sql);
		switch($_SESSION['user_role']){
			case 'church member':
				$result->bindValue('role','student');
				break;
			
			default:
				$result->bindValue('role','staff');
			}
		
		
		$result->bindValue('user',$_SESSION['user_id'],PDO::PARAM_INT);
		$result->bindValue('type','portal',PDO::PARAM_STR);
		$result->bindValue('status',0,PDO::PARAM_INT);
		$result->bindValue('active',1,PDO::PARAM_INT);
		$result->execute();

	    $result->rowCount();
		return $result;
		
		
		}
	
	
	public function displayMessages(){
		global $database;

		
		
		$result= $this->fetchMessages();
		
		switch($_SESSION['user_role']){
								case 'church member':
									$role1='jijh';
										break;
										
										
									
								default:
									$role1='staff';
									break;
								}
								 
		if($result->rowCount() > 0){
			$html = '<table id="inbox" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>From</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>';
			while($data = $result->fetch(PDO::FETCH_OBJ)){
				
				
				if($data->sender_id==$_SESSION['user_id'] && $data->sender_type==$role1 && $data->reply==1){
						$reply="<strong>Reply:</strong>";
			
				switch($data->sender_type){
	
					
					case 'staff':
						$sql = "SELECT surname, other_names, first_name, passport AS path FROM staff WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->recipient_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if(!empty($data2->path)){
							$path = '../../models/uploads/staff/'.$data2->path;
							}else{
								$path = '../../models/img/pic_icon.gif';
								}
						
						$title = ucwords($data2->surname).' '.ucwords($data2->other_names) . '(Staff)';
					break;	
					
					case 'churvh':
						$sql = "SELECT surname, other_names,COALESCE(father_passport,mother_passport) AS path FROM parents WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->recipient_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if(!empty($data2->path)){
							$path = '../../models/uploads/parent/'.$data2->path;
							}else{
								$path = '../../models/img/pic_icon.gif';
								}
						
						$title = ucwords($data2->surname).' '.ucwords($data2->other_names). '(Parent)';;
					break;	
					
					
					}
				}else{
				    $data->sender_type;
					$reply='';
					switch($data->sender_type){
	
					
					case 'staff':
					
						$sql = "SELECT surname, other_names, first_name, passport AS path FROM staff WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->sender_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if(!empty($data2->path)){
							$path = '../../models/uploads/staff/'.$data2->path;
							}else{
								$path = '../../models/img/pic_icon.gif';
								}
						
						$title = ucwords($data2->surname).' '.ucwords($data2->other_names) . '(Staff)';
					break;	
					
					case 'church':
						$sql = "SELECT surname, other_names, COALESCE(father_passport,mother_passport) AS path FROM parents WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->sender_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if(!empty($data2->path)){
							$path = '../../models/uploads/parent/'.$data2->path;
							}else{
								$path = '../../models/img/pic_icon.gif';
								}
						
						$title = ucwords($data2->surname).' '.ucwords($data2->other_names). '(Parent)';;
					break;	
					
						case 'student':
						$sql = "SELECT surname, first_name, passport AS path FROM students WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->sender_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if(!empty($data2->path)){
							$path = '../../models/uploads/students/'.$data2->path;
							}else{
								$path = '../../models/img/pic_icon.gif';
								}
						
						$title = ucwords($data2->surname).' '.ucwords($data2->first_name). '(student)';;
					break;	
					
					
					}
					}
				
					
					
					
					
					if(!empty($data->subject)){
						$subject = ucwords($data->subject);
						}else{
							$subject = 'New Message';
							}
					
					$new_data2 = '';
					
					$parameter=$data->id;
				//	$new_data = "&s=$data->sender_type&r=1";
					if(!empty($data->parent)){
						$parameter=$data->parent;
					//	$new_data2 = "&sid=$data->sender_id";
					}
				//'.$data->parent.$new_data.$new_data2.'
				
				$date = date('F j, Y, g:i a',$data->date_created);
				$html .='<tr>
                  
		                  <td>'.$data2->first_name.' '.$data2->other_names.' '.$data2->surname.'</td>
		                  <td>'.$data->subject.'</td>
		                  <td>'.$date.'</td>
		                  <td>
		                  <a class="btn btn-xs btn-info" href="message-details?id='.$data->id.'">View</a>
		                  

		                  </td>
		                  
		                </tr>
                 
				';
				}


				 $html .= '</tbody>
                <tfoot>
                <tr>
                  <th>From</th>
                  <th>Subject</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>';
				
				
				
			}else{
				return '<h4 align="center">You have no new message</h4>';
				}
			
			return $html;
		}	


		public function readMessage($id){
	global $database;
	//update read status;
	
			if(!ctype_digit($id)){
				error('An error occurred');
				go();
			}

			
	
	
	//fetch original message and content
	$sql = "SELECT  m.* FROM message m  WHERE m.id = :id";
	$result = $database->prepare($sql);
	$result->bindValue('id',$id,PDO::PARAM_INT);
	$result->execute();
	$this->details = $result->fetch(PDO::FETCH_OBJ);
	
	

	
	
	
	
	
	
	$sql = "SELECT first_name, last_name, profile_picture, pic_set, thumb FROM users WHERE id = ". $this->details->sender_id;
		$this->user = $database->query($sql)->fetch(PDO::FETCH_OBJ);
		
		
		if($this->user->pic_set == 1){
							$this->user_path = $this->user->profile_picture;
							}else{
								$this->user_path = '../../models/img/pic_icon.gif';
								}
	

	
	}	
	
	
	
	
	public function fetchConversations($id){
	global $database;
	
			if(!ctype_digit($id)){
				error('An error occurred');
				go();
			}

			
	$sql = "SELECT  m.* FROM message m  WHERE m.message_parent_id = :id";
	$this->conversation = $database->prepare($sql);
	$this->conversation->bindValue('id',$id,PDO::PARAM_INT);
	$this->conversation->execute();
	}	







	public function fetchInbox($role){
			global $database;
			
		
		// $sql="SELECT m.sender_type,m.recipient_type,m.recipient_id,m.id,m.sender_type,m.sender_id, m.subject,m.sender_read_status,m.read_status,m.message_parent_id AS parent, m.date_created FROM message m 
		// 	WHERE m.recipient_id = :user AND m.active = :active AND m.recipient_type = :role";

		$sql = "SELECT m.sender_type,m.recipient_type,m.recipient_id,m.id,m.sender_type,m.sender_id, m.subject,m.sender_read_status,m.read_status,m.message_parent_id AS parent, m.date_created FROM message m, users u WHERE m.recipient_id = :user AND m.sender_id = u.id AND m.active = :active AND m.recipient_type = :role GROUP BY m.sender_id DESC";

			// (m.id IN(SELECT DISTINCT message_parent_id FROM message WHERE recipient_id = :user AND recipient_type = :role AND active=:active)) || (m.recipient_id = :user AND m.recipient_type = :role AND m.active=:active AND m.message_parent_id =0) ;
		$result = $database->prepare($sql);
			switch($role){
				case 'church':
					$result->bindValue('role','church');
					break;
				
				
					
				default:
					case 'individual':
					$result->bindValue('role','individual');
			}
			
		$result->bindValue('user',$_SESSION['user_id'],PDO::PARAM_INT);
	
		$result->bindValue('active',1,PDO::PARAM_INT);
		$result->execute();

		return $result;
			
			
	}











		
		public function inbox($role){
			global $database;
			$result=$this->fetchInbox($role);
			if($result->rowCount()>0){

				// die();
				
				$html=' <table id="inbox" class="table table-hover table-striped">
                  <tbody>';
					while($data=$result->fetch(PDO::FETCH_OBJ)){
					
						
						
						switch($role){
								case 'church':
									$role1='church';
										break;
										
								
									
								default:
									$role1='individual';
									break;
								}		
					
					$parameter=$data->id;
					$reply='';
					if($data->sender_id==$_SESSION['user_id'] && $data->sender_type==$role1 && $data->reply=1){
						$reply="<strong>Reply:</strong>";
								switch($data->recipient_type){
										
										case 'individual':

											
										
											$sql = "SELECT last_name, first_name, profile_picture AS path FROM users WHERE id = :id";
											$result2 = $database->prepare($sql);
											$result2->bindValue('id',$data->recipient_id);
											$result2->execute();
											$data2 = $result2->fetch(PDO::FETCH_OBJ);
											if($data2->pic_set == 1){
												$path = $data2->path;
												}else{
													$path = 'assets/images/avatar2.jpg';
													}
											
											$title = ucwords($data2->first_name).' '.ucwords($data2->last_name) . '(Individual)';
										break;	
										
								case 'company':
					
									$sql = "SELECT name, pic_set, path  FROM companies WHERE id = :id";
									$result2 = $database->prepare($sql);
									$result2->bindValue('id',$data->sender_id);
									$result2->execute();
									$data2 = $result2->fetch(PDO::FETCH_OBJ);
									if($data2->pic_set == 1){
										$path = $data2->path;
										}else{
											$path = 'assets/images/avatar2.jpg';
											}
									
									$title = ucwords($data2->name).'(Company)';
										
									



									default :


									$path = 'assets/images/avatar2.jpg';

									$title = 'User Name';

									break;
										
										
										}
						
						
						
					}else{
						
						switch($data->sender_type){
					
					case 'individual':
					
					
						$sql = "SELECT first_name, last_name, pic_set, profile_picture AS path FROM users WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->sender_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if($data2->pic_set == 1){
							$path = $data2->path;
							}else{
								$path = 'assets/images/avatar2.jpg';
								}
						
						$title = ucwords($data2->first_name).' '.ucwords($data2->last_name) . ' (Individual)';
					break;	


					case 'company':
					
						$sql = "SELECT name, pic_set, path  FROM companies WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$data->sender_id);
						$result2->execute();
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if($data2->pic_set == 1){
							$path = $data2->path;
							}else{
								$path = 'assets/images/avatar2.jpg';
								}
						
						$title = ucwords($data2->name).' (Company)';
					break;	
						

					default :


					$path = 'assets/images/avatar2.jpg';

					$title = 'User Name';

					break;
						
					
					}
				}
					
					
					
					$date = date('F j, Y, g:i a',$data->date_created);
					
					if(!empty($data->subject)){
						$subject = ucwords($data->subject);
						}else{
							$subject = 'New Message';
							
							}
							
					
					
							$class='';
							
					
					if($data->sender_id==$_SESSION['user_id'] && $data->sender_type==$role1 ){
							if($data->sender_read_status==0){
								$class=" unread-message ";
							}
						}else{
								if($data->read_status==0){
									$class=" unread-message ";
								}
							}		
							
					
						$html .=' <tr class="'.$class.'">

						<td class="mailbox-attachment"><img class="direct-chat-img" src="'.$path.'" alt=""></td>
                    
                    <td style="width:35%" class="mailbox-name"><a href="read-message?id='.$parameter.'"><div class="full-width">'.$title.'</div></a></td>
                    <td class="mailbox-subject"><a href="read-message?id='.$parameter.'"><div class="full-width">'.$reply.' '.$subject.'</div></a>
                    </td>
                    
                    <td style="width:32%" class="mailbox-date">'.$date.'</td>
                  </tr>';
					}
				
				return $html .='</body></table>';
				}else{
					return '<h3 align="center">Your inbox is empty</h3>';
					}
			
			
		}	



		public function fetchUserDetails($id){
		global $database;
		
			if(!ctype_digit($id)){
				error('An error occurred');
				go();
			}

			$sql = "SELECT first_name, last_name, profile_picture, thumb, pic_set  FROM users WHERE id = :id";
						$result2 = $database->prepare($sql);
						$result2->bindValue('id',$id);
						$result2->execute();
						
						$data2 = $result2->fetch(PDO::FETCH_OBJ);
						if($data2->pic_set == 1){
							$path = $data2->thumb;
							}else{
								$path = 'assets/images/avatar2.jpg';
								}
						
						$title = ucwords($data2->last_name).' '.ucwords($data2->first_name);
						$user_details= array('name'=>$title,'path'=>$path);

	
				
				return $user_details;	
		}
	
		
		
		public function replyMessage($post){
		global $database;
		
		$message_parent_id = $post['message_parent_id'];
		$recipient_id = $post['recipient_id'];
		
		$read_status = clean($post['read_status']);
		$_SESSION['reply']['message'] = $message = trim($post['message']);
			
		
		// if(empty($recipient)){
		// 	$_SESSION['error'] = "An error occurred";
		// 	go($_SERVER['HTTP_REFERER']);
		// 	}
		
		if(empty($message)){
			$_SESSION['error'] = "Pls enter message";
			go($_SERVER['HTTP_REFERER']);
			}	
		
		$user_id = trim($_SESSION['user_id']);
		




		try{
				$database->beginTransaction();	 	 	 		 	 
				
				// 	 	 	 	 	 	 	 	 	 	 		 	date_read 	active
				$query1  = "INSERT INTO message(`sender_id`,`recipient_id`,`message`,
				`message_parent_id`,`read_status`,`date_created`,`active`) 
				VALUES(:sender_id,:recipient_id,:message, :message_parent_id,:read_status,:date_created,:active) ";
				$result1 = $database->prepare($query1);
				$result1->bindValue('sender_id',$user_id,PDO::PARAM_STR);
				// $result1->bindValue('',$user_role,PDO::PARAM_INT);
				$result1->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
				// $result1->bindValue('recipient_type',$recipient,PDO::PARAM_STR);
				// $result1->bindValue('subject',$subject,PDO::PARAM_STR);
				$result1->bindValue('message',$message,PDO::PARAM_STR);
				$result1->bindValue('message_parent_id',$message_parent_id,PDO::PARAM_STR);
				// $result1->bindValue('allow_reply','yes',PDO::PARAM_INT);
				// $result1->bindValue('type','portal',PDO::PARAM_INT);
				$result1->bindValue('read_status',0,PDO::PARAM_STR);
				$result1->bindValue('date_created',time(),PDO::PARAM_STR);
				$result1->bindValue('active',1,PDO::PARAM_STR);
				$result1->execute();
				
				
				$reply=0;
				if($read_status=='sender_read_status'){
					$reply=1;
				}
				
				
				$sql="UPDATE message SET $read_status=0 AND reply=$reply WHERE id=$message_parent_id";
				$result2=$database->query($sql);
				
		
					if($result1->rowCount() > 0  && $result1->rowCount() > 0 ){
						$database->commit();
						$_SESSION['success'] = "Message sent";
						unset($_SESSION['message']);
					}else{
						$database->rollBack();
						$_SESSION['error'] = "An error occurred. Pls try again";
					}
			
		
		go($_SERVER['HTTP_REFERER']);
			
			}catch(PDOException $e){
				$database->rollBack();
				$_SESSION['error'] = "An error occurred. Pls try again";
				die($e->getMessage());
				go($_SERVER['HTTP_REFERER']);
		
		}
			
			
			
				
	
	}
	







	}



 ?>