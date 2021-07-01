<?php 
		require_once('init.php');
		require_once('../classes/misc.php');


		 $category_id = $_POST['category_id'];

		if(!ctype_digit($category_id)){
			die();
		}
	
		 $services = Misc::fetchServices($category_id);

		 $html = ' ';

		 		if ($services->rowCount() > 0) {

		 			while ($data = $services->fetch(PDO::FETCH_OBJ)){
					$html .='<option  value="'.$data->id.'">'.$data->name.'</option>';
					//$selected = ' selected="selected" ';
					}
		 		} 
		 			$html .='</select>';


		 			echo $html;

?>