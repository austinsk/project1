<?php
class Elements{
	

	public static function textinput($type,$name,$placeholder='',$value='',$required=false,$class=''){
		if($required==true){
			$required=' required="required" ';
			}else{
				$required='';
				}
		$html='<input  '.$required.' value="'.$value.'" type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" class="form-control '.$class.'"  /> ';

		return $html;
		}


	public static function fileinput($type,$name,$placeholder='',$value='',$required=false,$class=''){
		if($required==true){
			$required=' required="required" ';
			}else{
				$required='';
				}
		$html='<input  '.$required.' value="'.$value.'" type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" class=" '.$class.'"  /> ';

		return $html;
		}



	public static function radio($type,$label,$id='',$name='',$class='',$value='',$required=false){
		if($required==true){
			$required=' required="required" ';
			}else{
				$required='';
				}
		$html='<input  id="'.$id.'"  '.$required.' value="'.$value.'" type="'.$type.'" name="'.$name.'" class="form-control '.$class.'"  />
					<label for="'.$id.'">'.$label.'</label> ';

		return $html;
		}




		
	
	public static function textHidden($name,$value){
		$html='<input '.$required.' value="'.$value.'" type="hidden" name="'.$name.'" class="form-control '.$class.'"  /> ';
		}	
	
	
	public static function textarea($name,$value='',$required=false,$class=''){
		if($required==true){
			$required=' required="required" ';
			}else{
				$required='';
				}
		$html='<textarea '.$required.' class="form-control '.$class.'" name="'.$name.'">'.$value.'</textarea> ';
		
		return $html;
		}
		
	
	public static function select(){
		$args=func_get_args();
		
		$head='';
		$body='';
		$i=0;
		foreach($args as $data){
			
			if($i==0){
				$head='<select name="'.$data.'" class="form-control" ><option value="">Select</option>';
				}else{
					$body .='<option value="'.$data.'">'.ucwords($data).'</option>';
					}
			
			$i++;
			
			}
			
			$html=$head.$body.'</select>';
		
			return $html;
		
		}	
		
	
	public static function selectWithArray($name,$array,$required=false){




		
	if($required==true){
			$required=' required="required" ';
			}else{
				$required='';
				} 
		$html='<select '.$required.' name="'.$name.'" class="form-control" >
		<option value="">Select</option>';
		foreach($array as $key=>$data){
					$html .='<option value="'.$data['name'].'">'.ucwords($data['name']).'</option>';
			}
			$html .='</select>';
			return $html;
		}	
		
		
	

}
?>