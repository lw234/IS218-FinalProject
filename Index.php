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
		<a href = "index.php?page=pEnrollment">The highest enrollments.</a><br>
		<a href = "index.php?page=pLiabilities">The highest total liabilities</a><br>
		<a href = "index.php?page=pAssets">The highest net assets</a><br>
		<a href = "index.php?page=pRevenue">The highest total revenue</a><br>
		<a href = "index.php?page=pRPS">The highest total revenue per student</a><br>
		<a href = "index.php?page=pAPS">The highest net assets per student</a><br>
		<a href = "index.php?page=pLPS">The highest total liabilities per student</a><br>
		<a href = "index.php?page=p5">Top Colleges</a><br>
		<a href = "index.php?page=pState">Colleges in my state</a><br>
		<a href = "index.php?page=pPiL">The largest increase in liabilities</a><br>
		<a href = "index.php?page=pPiE">The largest increase in enrollment</a><br>
		
		';
	}
	
}
?>