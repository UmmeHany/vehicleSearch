<?php

/********************************/
$databasehost = "localhost";
$databasename = "vehiclepartstestdb";
$databasetable = "parts";
$databaseusername ="root";
$databasepassword = "root";
$fieldseparator = ";";
$lineseparator = "\n";
$csvfile = "parts.csv";

$addauto = 0;

$save = 1;
$outputfile = "parts.sql";
/********************************/


if(!file_exists($csvfile)) {
	echo "File not found. Make sure you specified the correct path.\n";
	exit;
}

$file = fopen($csvfile,"r");

if(!$file) {
	echo "Error opening data file.\n";
	exit;
}

$size = filesize($csvfile);

if(!$size) {
	echo "File is empty.\n";
	exit;
}

$csvcontent = fread($file,$size);

fclose($file);

$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());

$lines = 0;
$queries = "";
$linearray = array();

foreach(split($lineseparator,$csvcontent) as $line) {

	$lines++;

	$line = trim($line," \t");
	
	$line = str_replace("\r","",$line);
	
	/************************************
	This line escapes the special character. remove it if entries are already escaped in the csv file
	************************************/
	$line = str_replace("'","\'",$line);
	/*************************************/
	
	$linearray = explode($fieldseparator,$line);
	
	$linemysql = implode("','",$linearray);
	if($lines==1){
		$query = "CREATE TABLE parts (
					PartsId INT(20) PRIMARY KEY,
					Name VARCHAR(255)  NULL,
					Active INT(20)  NULL,
					VehicleIds VARCHAR(255)  NULL
					)";	
					@mysql_query($query);
	}
	
	if($lines>1){
		
		if($addauto)
				$query = "insert into $databasetable values('','$linemysql');";
			else
				$query = "insert into $databasetable values('$linemysql');";
			
			$queries .= $query . "\n";

			@mysql_query($query);
		
		
	}
			
}

@mysql_close($con);

if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}

echo "Found a total of $lines records in this csv file.\n";


?>
