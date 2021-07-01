<?php 
		require_once('init.php');
		require_once('../classes/misc.php');


		 $country_id = $_POST['country_id'];

		if(!ctype_digit($country_id)){
			die();
		}
	
		 $state = Misc::fetchStates($country_id);

		 $html = '<select name="state" class="form-control select_styled base no-padding"> ';

		 		if ($state->rowCount() > 0) {
		 			while ($data = $state->fetch(PDO::FETCH_OBJ)){
					$html .='<option  value="'.$data->id.'">'.$data->name.'</option>';
					//$selected = ' selected="selected" ';
					}
		 		} 
		 			$html .='</select>';


		 			echo $html;

?>