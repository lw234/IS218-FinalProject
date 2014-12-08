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
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=Enrollment"> Colleges with the highest enrollments in 2011</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=TLiabilities">Colleges with the highest total liabilities in 2011</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=NAssets">Colleges with the highest net assets in 2011</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=NAPS"> Colleges with the highest net assets per student</a><br>
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=LIE">Colleges with the largest increase in enrollment between 2011 and 2010</a><br>
		
		';
	}
	
}
class Enrollment extends page{
	
	function get(){
		
		$host = "sql2.njit.edu";
		$dbname = "lw234";
		$user ="lw234";
		$pass = 'QkuxTlWHS';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT college.Name, EN2011 FROM enrollment INNER JOIN college ON enrollment.UID = college.UID ORDER BY enrollment.EN2011 DESC ");
		
		$this->content .= "<h1>Highest College Enrollment in 2011</h1><br>";
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>College Name</th>
				<th>Enrollment</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['EN2011'] . "</td>";
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



/* QUESTION NUMBER 2: Create a web page that that lists the colleges with the largest amount of total liabilities.

 */

class TLiabilities extends page{
	
	function get(){
		
		$host = "sql2.njit.edu";
		$dbname = "lw234";
		$user ="lw234";
		$pass = 'QkuxTlWHS';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT college.Name, Finance.L2011 FROM college INNER JOIN Finance ON Finance.UID = college.UID ORDER BY Finance.L2011 DESC ");
		
		$this->content .= "<h1>Colleges with the highest total liabilities in 2011</h1><br>";
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>College Name</th>
				<th>Total Liablities</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['L2011'] . "</td>";
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
/* QUESTION NUMBER 3: Create a web page that that lists the colleges with the largest amount of total liabilities.

 */

class NAssets extends page{
	
	function get(){
		
		$host = "sql2.njit.edu";
		$dbname = "lw234";
		$user ="lw234";
		$pass = 'QkuxTlWHS';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT college.Name, Finance.N2011 FROM college INNER JOIN Finance ON Finance.UID = college.UID ORDER BY Finance.N2011 DESC ");
		
		$this->content .= "<h1>Colleges with the highest net assets in 2011</h1><br>"; 
		
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>College Name</th>
				<th>Total net assests</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['N2011'] . "</td>";
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