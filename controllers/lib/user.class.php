<?php

class User{
	public $users; 
	
	public function newUser($post){
		global $database;
		global $validate;
		
		if(empty($post["full_name"]) ||empty($post["phone"]) ||empty($post["email"]) ||empty($post["password"]) || empty($post["password2"]) || empty($post["role"]) || empty($post["facility"]) ){
		 $_SESSION['error'] = "Pls fill all required fields";
		redirect_to($_SERVER['HTTP_REFERER']);
		}
		
		if(isset($post['department']) && empty($post['department'])){
			 $_SESSION['error'] = "Pls select department";
			redirect_to($_SERVER['HTTP_REFERER']);
			}
			$full_name = trim($post['full_name']);
			$phone = trim($post['phone']);
			$email = trim($post['email']);
			$password = trim($post['password']);
			$password2 = trim($post['password2']);
			$role = trim($post['role']);
			$department = '';
			if(!empty($post['department'])){
				$department = trim($post['department']);
				}
			
			
			$facility = $post['facility'];
			if(!ctype_digit($phone)){
				$_SESSION['error'] = "Invalid phone number";
				redirect_to($_SERVER['HTTP_REFERER']);
				}
		
			if($validate->validate_email($email) == false){
				 $_SESSION['error'] = "Invalid email address";
				redirect_to($_SERVER['HTTP_REFERER']);
				}
			if($this->checkEmailExist($email) == true){
				$_SESSION['error'] = "A user with the same email address exist";
				redirect_to($_SERVER['HTTP_REFERER']);
				}
			
			if($this->checkPhoneExist($phone) == true){
				$_SESSION['error'] = "A user with the same phone number exist";
				redirect_to($_SERVER['HTTP_REFERER']);
				}	
			
			if($password != $password2){
				$_SESSION['error'] = "Passwords donot match";
				redirect_to($_SERVER['HTTP_REFERER']);
				}
				$join = "";
				
			try{
				$database->beginTransaction();
				
				$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		// $user_password_hash2 = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
		    	$hash_pass = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
				//user table
				$sql = "INSERT INTO users(`fm_id`,`email`,`phone`,`name`,`password`,`role`) VALUES(:fm_id,:email,:phone,:name,:password,:role)";
				$result1 = $database->prepare($sql);
				$result1->bindValue('fm_id',$_SESSION['fm_id'],PDO::PARAM_INT);
				$result1->bindValue('email',$email,PDO::PARAM_STR);
				$result1->bindValue('phone',$phone,PDO::PARAM_STR);
				$result1->bindValue('name',$full_name,PDO::PARAM_STR);
				$result1->bindValue('password',$hash_pass,PDO::PARAM_STR);
				$result1->bindValue('role',$role,PDO::PARAM_STR);
				$result1->execute();
				$user_id = $database->lastInsertId();
				
				//user_roles -this help us to knw which department and whether the person is a chief technician
				$sql = "INSERT INTO user_roles(`role_department`,`user_id`,`role`) VALUES(:role_department,:user_id,:role)";
				$result2 = $database->prepare($sql);
				$result2->bindValue('role_department',$department,PDO::PARAM_STR);
				$result2->bindValue('user_id',$user_id,PDO::PARAM_INT);
				$result2->bindValue('role',$role,PDO::PARAM_STR);
				$result2->execute();
				
				//user_role_facility
				foreach($facility as $data){
					$data = mysql_prep($data);
					$join .= "($user_id,$data),";
					}
				
				$join = substr($join,0,(strlen($join) - 1));	
				$sql = "INSERT INTO user_roles_facility(`user_id`,`estate_id`) VALUES $join";
				$result3 = $database->query($sql);
				
				if($result1->rowCount() > 0 && $result2->rowCount() > 0  && $result3->rowCount() > 0 ){
					$database->commit();
					$_SESSION['success'] = "User created successfully";
					redirect_to($_SERVER['HTTP_REFERER']);
					}else{
						$databae->rollBack();
						$_SESSION['error'] = "An error occurred. Pls try again";
						redirect_to($_SERVER['HTTP_REFERER']);
						}
				
				
				
				
				
				
				}catch(PDOException $e){
					die($e->getMessage());
						$databae->rollBack();
						$_SESSION['error'] = "An error occurred. Pls try again";
						redirect_to($_SERVER['HTTP_REFERER']);
					}
			
				
		
		}
		
	public function checkEmailExist($email){
		global $database;
		$sql = "SELECT user_id FROM users WHERE email = :email";
		$result = $database->prepare($sql);
		$result->bindValue('email',$email,PDO::PARAM_STR);
		$result->execute();
		if($result->rowCount() > 0){
			return true;
			}else{
				return false;
				}
		}	
		
	
	public function checkPhoneExist($phone){
		global $database;
		$sql = "SELECT user_id FROM users WHERE phone = :phone";
		$result = $database->prepare($sql);
		$result->bindValue('phone',$phone,PDO::PARAM_STR);
		$result->execute();
		if($result->rowCount() > 0){
			return true;
			}else{
				return false;
				}
		}	
		
	public function fetchUsers(){
		global $database;
		$sql = "SELECT u.user_id, u.email, u.phone, u.name AS full_name, u.role, u.active, ur.role_department AS department,ur.role FROM users u, user_roles ur WHERE u.fm_id = :fm_id AND ur.user_id = u.user_id";
		$this->users = $database->prepare($sql);
		$this->users->bindValue('fm_id',$_SESSION['fm_id']);
		$this->users->execute();
		}

public function displayUsers(){
	global $database;
		$this->fetchUsers();
		if($this->users->rowCount() > 0){
			$table = '<table id="table-example" class="table table-hover">
													<thead>
														<tr>
															<th>#</th>
															<th>Full Name</th>
															<th>Email</th>
															<th>Phone Number</th>
															<th>Facility</th>
															<th>Role</th>
															<th>Department</th>
															<th>Status</th>
															<th></th>
														</tr>
													</thead><tbody>';
									$i = 1;
													
			while($data = $this->users->fetch(PDO::FETCH_OBJ)){
					$full_name = ucwords($data->full_name);
					$email = ucwords($data->email);
					$phone = ($data->phone);
					
					
					
					$active = $data->active == 1?'<span class="label label-success">Active</span>':'<span class="label label-warning">Inactive</span>';
					$table .= "<tr> <td>$i</td> <td> $full_name </td> <td>$email</td>  <td>$phone</td> <td>";
					
					$sql = "SELECT e.name AS facility,e.id FROM estate e, user_roles_facility urf WHERE urf.user_id = $data->user_id AND e.id = urf.estate_id";
					$result = $database->query($sql);
					while($data2 = $result->fetch(PDO::FETCH_OBJ)){
						$table .= "<a class=\"btn btn-info\" href=\"\">".ucwords($data2->facility) . "</a><br /><br />

";
						}
					
					
					
					$table .="</td>  <td>".ucwords($data->role)."</td>  <td>".ucwords($data->department)."</td> <td>$active</td>";
					$table .= "<td style=\"width: 17%;\">
					
					
					
					<a data-container=\"body\" data-toggle=\"popover\" href=\"#\" class=\"table-link function-button\" data-placement=\"top\" data-content=\"View User\" data-original-title=\"\" title=\"\">
																	<span class=\"fa-stack\">
																		<i class=\"fa fa-square fa-stack-2x\"></i>
																		<i class=\"fa fa-list-alt fa-stack-1x fa-inverse\"></i>
																	</span>
																</a>
					
					
					
					
					
					
					
					
																<a data-container=\"body\" data-toggle=\"popover\" href=\"#\" class=\"table-link function-button yellow\" data-placement=\"top\" data-content=\"Deactivate User\" data-original-title=\"\" title=\"\">
																	<span class=\"fa-stack\">
																		<i class=\"fa fa-square fa-stack-2x\"></i>
																		<i class=\"fa fa-minus-circle fa-stack-1x fa-inverse\"></i>
																	</span>
																</a>
																<a data-container=\"body\" data-toggle=\"popover\" href=\"inventory.php?fi=$data->user_id\" class=\"table-link function-button yellow\" data-placement=\"top\" data-content=\"Reset Password\" data-original-title=\"\" title=\"\">
																	<span class=\"fa-stack\">
																		<i class=\"fa fa-square fa-stack-2x\"></i>
																		<i class=\"fa fa-lock fa-stack-1x fa-inverse\"></i>
																	</span>
																</a>
																
																<a data-container=\"body\" data-toggle=\"popover\" href=\"#\" class=\"table-link function-button danger\" data-placement=\"top\" data-content=\"Delete Facility\" data-original-title=\"\" title=\"\">
																	<span class=\"fa-stack\">
																		<i class=\"fa fa-square fa-stack-2x\"></i>
																		<i class=\"fa fa-trash-o fa-stack-1x fa-inverse\"></i>
																	</span>
																</a>
															</td>
					 
					 </tr>";
					
					
					$i++;
					}
				return $table .="</tbody></table>";	
			}
		}	
	
	} ?>