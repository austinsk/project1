<?php

// This is a helper class to make paginating 
// records easy.


class Pagination{
	//protected  $table_name;
  public $current_page;
  public $per_page;
  public $total_count;
  public $page;
  

  public function __construct($page=1, $per_page=20, $total_count=0){
  	$this->current_page = (int)$page;
    $this->per_page = (int)$per_page;
    $this->total_count = (int)$total_count;
	$this->page = $page;
  }
public function set_table_name($table_name)
{
	$this->table_name = $table_name;
	}

  public function offset() {
    // Assuming 20 items per page:
    // page 1 has an offset of 0    (1-1) * 20
    // page 2 has an offset of 20   (2-1) * 20
    //   in other words, page 2 starts with item 21
    return ($this->current_page - 1) * $this->per_page;
  }

  public function total_pages() {
    return ceil($this->total_count/$this->per_page);
	}
	
  public function previous_page() {
    return $this->current_page - 1;
  }
  
  public function next_page() {
    return $this->current_page + 1;
  }

	public function has_previous_page() {
		return $this->previous_page() >= 1 ? true : false;
	
	}

	public function has_next_page() {
		return $this->next_page() <= $this->total_pages() ? true : false;
	}
	
	
	public static function count_all($sql) {
		  global $database;
		 	$result = $database->query($sql);
			$total = $result->fetchColumn();
			return $total;
	}
	
	
	
	
	public function navigate($url,$data=''){
			
				
		global $crypt;
		if($this->total_pages() > 1) {
			$table = "<ul class=\"pagination\">";
		if($this->has_previous_page()) { 
    	$table .= "<li><a class=\"nothing\" title=\"Previous\" href=\"{$url}?$data&page=";
      $table .= ($this->previous_page());
      $table .= "\"><img src=\"../../models/img/backward.png\" width=\"20\" height=\"16\" /></a></li>"; 
    }

		for($i=1; $i <= $this->total_pages(); $i++) {
			
			if($i == $this->page) {
				$table .= "<li> <a class=\"p-current\"><b>{$i}</b></a></li>";
			} else {
				$table .= "<li> <a class=\"nothing\" href=\"{$url}?$data&page=" . ($i) . "\"><b>{$i}</b></a></li> "; 
			}
			
		}

		if($this->has_next_page()) { 
			$table .= "<li><a class=\"nothing\" title=\"Next\" href=\"{$url}?$data&page=";
			$table .= ($this->next_page());
			$table .= "\"> <img src=\"../../models/img/forward.png\" width=\"20\" height=\"16\" /></a></li>";
		}
		$page_number = ($this->page * $this->per_page) - ($this->per_page- 1);
		$to  = $page_number +($this->per_page- 1);
		$table .="<li class=\"showing\">Showing $page_number to $to of $this->total_count Records</li>";
		$table .= "</ul>";
		
		}
		if(!empty($table)){echo $table;}
	}
		 





















public function navigate2($url){
		global $crypt;
		if($this->total_pages() > 1) {
			$table = "<ul class=\"pagination\">";
		if($this->has_previous_page()) { 
    	$table .= "<li><a class=\"nothing\"  href=\"{$url}?page=";
      $table .= ($this->previous_page());
      $table .= "\"><img src=\"../images/prev.png\"  /></a></li>"; 
    }

		for($i=1; $i <= $this->total_pages(); $i++) {
			
			if($i == $this->page) {
				$table .= "<li> <a class=\"pagination-active\">{$i}</a></li>";
			} else {
				$table .= "<li> <a class=\"nothing\" href=\"{$url}?page=" . ($i) . "\">{$i}</a></li> "; 
			}
			
		}

		if($this->has_next_page()) { 
			$table .= "<li><a class=\"nothing\" href=\"{$url}?page=";
			$table .= ($this->next_page());
			$table .= "\"><img src=\"../images/nerxt.png\"  /></a>";
		}
		$table .= "</li></ul>";
		$table .= "Showing";
		}
		if(!empty($table)){echo $table;}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function text_navigate($url,$pi,$ai){
		global $crypt;
			global $crypt;
		if($this->total_pages() > 1) {
			$table = "<ul class=\"pagination\">";
		if($this->has_previous_page()) { 
    	$table .= "<li><a class=\"nothing left\"  href=\"{$url}?pi=$pi&ai=$ai&page=";
      $table .= ($this->previous_page());
      $table .= "\">Previous Comments</a></li>"; 
    }

		

		if($this->has_next_page()) { 
			$table .= "<li><a class=\"nothing right\" href=\"{$url}?pi=$pi&ai=$ai&page=";
			$table .= ($this->next_page());
			$table .= "\">More Comments</a>";
		}
		$table .= "</li></ul>";
		}
		if(!empty($table)){echo $table;}
	}
	

	

}

?>