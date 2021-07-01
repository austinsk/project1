<?php 
		require_once('init.php');
		require_once('../classes/misc.php');


		 $state_id = $_POST['state_id'];

		if(!ctype_digit($state_id)){
			die();
		}
	
		 $state = Misc::fetchCity($state_id);

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