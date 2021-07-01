<?php 

	
	class Company{


		public function verifyCompany($id){



			global $database;


			$sql = "UPDATE companies SET verified = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "Company Successfully Verified";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}


		public function unVerifyCompany($id){



			global $database;


			$sql = "UPDATE companies SET verified = 0 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "Company Successfully Verified";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
		}



		public function viewVerifiedCompanies(){
		global $database;

		$sql = "SELECT u.*, c.name AS country_name, s.name AS state_name FROM companies u LEFT JOIN countries c ON (u.country = c.id) LEFT JOIN states s ON (u.state = s.id) WHERE u.active = 1 AND u.verified = 1";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  <th>Company Name</th>
                  
                  <th>State</th>
                  <th>Country</th>
                  <th>Date Created</th>
                  <th style="width:30%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){

				$date = date("F j, Y", $data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['name']).'</td>

			                  

			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td>'.$date.'</td>

			                  <td><button id="'.$data['id'].'" class="unverify btn btn-warning btn-sm">UnVerify Company</button>
			                  <a href="" class="unverify btn btn-info btn-sm"> Company Details</a></td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No Company to Display</h3>';
		}

		echo $html;
	}




	public function viewUnVerifiedCompanies(){
		global $database;

		$sql = "SELECT u.*, c.name AS country_name, s.name AS state_name FROM companies u LEFT JOIN countries c ON (u.country = c.id) LEFT JOIN states s ON (u.state = s.id) WHERE u.active = 1 AND u.verified = 0";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th>Company Name</th>
                  
                  
                  <th>State</th>
                  <th>Country</th>
                  <th>Date Created</th>
                  <th style="width:30%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){

				$date = date("F j, Y", $data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['name']).'</td>

			                  

			                  
			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td>'.$date.'</td>


			                  <td>
			                  	<button id="'.$data['id'].'" class="verify btn btn-success">Verify Company</button>
			                  	<a id="'.$data['id'].'" href="user-details.php?id='.$data['id'].'" class="btn btn-info">Company Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No Company to Display</h3>';
		}

		echo $html;
	}


	}






?>