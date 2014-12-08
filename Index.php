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
		<a href = "http://web.njit.edu/~lw234/IS218/FinalProject/Index.php?page=NAPS"> Colleges with the highest net assets per student in 2011</a><br>
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

/* QUESTION NUMBER 4: Create a web page that lists the colleges with the largest amount of net assets per student.

 */

class NAPS extends page{
	
	function get(){
		
		$host = "sql2.njit.edu";
		$dbname = "lw234";
		$user ="lw234";
		$pass = 'QkuxTlWHS';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT college.Name, Finance.N2011, enrollment.EN2011, round(Finance.N2011/enrollment.En2011,0) AS AssetPerS FROM college INNER JOIN Finance ON Finance.UID = college.UID INNER JOIN enrollment ON college.UID = enrollment.UID ORDER BY AssetPerS DESC ");
		
		$this->content .= "<h1>Colleges with the highest net assets per student in 2011</h1><br>"; 
		
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>College Name</th>
				<th>Total net assests per student</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['AssetPerS'] . "</td>";
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

/* QUESTION NUMBER 5: Create a web page that shows the colleges with the largest percentage increase in enrollment between the years of 2011 and 2010.

 */

class LIE extends page{
	
	function get(){
		
		$host = "sql2.njit.edu";
		$dbname = "lw234";
		$user ="lw234";
		$pass = 'QkuxTlWHS';
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$STH = $DBH->query("SELECT college.Name,enrollment.EN2010,enrollment.EN2011,Format(round((enrollment.EN2011-enrollment.EN2010)*100/enrollment.EN2010,1),#,0) AS PIncrease FROM college INNER JOIN enrollment ON enrollment.UID = college.UID ORDER BY PIncrease DESC ");
		
		$this->content .= "<h1>Colleges with the largest percentage increase in enrollment between the years of 2011 and 2010</h1><br>"; 
		
		
		$this->content .= "<table border = 2>";
		$this->content .= "
			<tr>
				<th>College Name</th>
				<th>Number of students 2010</th>
				<th>Number of students 2011</th>
				<th>Percent Increase</th>
			</tr>
		";
		
		while($rows = $STH->fetch()){
			$this->content .= "<tr>";
			$this->content .= "<td>" . $rows['Name'] . "</td>";
			$this->content .= "<td>" . $rows['EN2010'] . "</td>";
			$this->content .= "<td>" . $rows['EN2011'] . "</td>";
			$this->content .= "<td>" . $rows['PIncrease'] . "</td>";
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