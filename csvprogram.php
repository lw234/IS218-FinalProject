<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
$csv = new CSVLoader();
$data = $csv->openFile('CollegeData/finance.csv');
$csv->writeToDatabase($data);

class CSVLoader{
	
	public function openFile($f){
		$firstLine = true;
		$fields;
		$data;
		//Open the $f file and use r for read mode.
		if($handle = fopen($f,"r")){
			//Getting the csv data.
			while($line = fgetcsv($handle)){
				//Was it the first time?
				if($firstLine == true){
					$firstLine = false;
					$fields = $line;
				}
				else{
				//Adding the [] adds a new numerical index. 
				$data[] = array_combine($fields,$line);	
				}
			}
		fclose($handle);
		
		return $data;
		
		}
		else{
			//Could not open file!
			echo "Failed to open the file " . $f;
		}
	}
	
	
	public function writeToDatabase($records){
		$host = "sql1.njit.edu";
		$dbname = "ia85";
		$table = "Finance";
		try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname","ia85","carport85");
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//Let's write to the database
		foreach($records as $record){
			$insert = null;
			foreach($record as $key => $value){
				$insert[] = $value;
			}
			
			print_r($insert);
			
			$STH = $DBH->prepare("insert into $table values(?,?,?,?,?,?,?)");
			$STH->execute($insert);	
		}
		
		
		$DBH = null;
		
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	
			
	}
}

?>