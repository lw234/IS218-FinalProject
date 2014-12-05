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
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=Enrollment"> Colleges with the highest enrollments.</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=TLiabilities">Colleges with the highest total liabilities</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=NAssets">Colleges with the highest net assets</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=NAPS"> Colleges with the highest net assets per student</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=LIE">Colleges with the largest increase in enrollment between 2011 and 2010</a><br>
		
		';
	}
	
}
class Enrollment extends page{
	
	function get(){
		
		$host = "sql1.njit.edu";
		$dbname = ""; 
		$user ="";
		$pass = '';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT UNITID,INSTNM FROM college");
		
		$this->content .= "<h1>Highest Enrollment</h1><h3>Top 50 in 2011</h3><br>";
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>Name</th>
				<th>Enrollment</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['UNITID'] . "</td>";
			$this->content .= "<td>" . $rows['INSTNM'] . "</td>";
			$this->content .= "</tr>";
		}
		
		$this->content .= "</table>";
		
		$DBH = null;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
}
?>