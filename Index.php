<?php
$program = new program();

class program{
	
	function __construct(){
		
		$page = 'homepage';
		$arg = NULL;
		
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}
		
		if(isset($_REQUEST['arg'])){
			$arg = $_REQUEST['arg'];
		}
		
		$page = new $page($arg);
		
	}
	
	
}
	
abstract class page{
	
	public $content;
	
	function __construct($arg = NULL){
		
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			
			$this->get();
		}
		else{
			
			$this->post();
		}
	}
	
	function menu(){
				
	}
		
	function get(){
	}
	
	function post(){
	}
	
	function __destruct(){
		//Echo out some content
		echo $this->content;
	}
	
	
	
}
	
class homepage extends page{
	
	function get(){
		$this->content = '
		<h1> IS 218 Final Project </h1>
		<h2>College Data Project</h2>
		<h3>Directory</h3>
		<a href = "index.php?page=Enrollment"> Colleges with the highest enrollments.</a><br>
		<a href = "index.php?page=TLiabilities">Colleges with the highest total liabilities</a><br>
		<a href = "index.php?page=NAssets">Colleges with the highest net assets</a><br>
		<a href = "index.php?page=NAPS"> Colleges with the highest net assets per student</a><br>
		<a href = "index.php?page=LIE">Colleges with the largest increase in enrollment between 2011 and 2010</a><br>
		
		';
	}
	
}
?>