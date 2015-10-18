<?php

function getDatabaseConnection() {
	$host = "localhost";
	$dbname = "rave6231";	//your otterid
	$username = "rave6231"; 	//your otterid
	$password = "s3cr3t";

	//creates connection to database
	$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

	// Setting Errorhandling to Exception
	$dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $dbConn;
}

function getDataBySQL($sql){
global $conn;
	$statement = $conn->prepare($sql); //prevents SQL Injection
	$statement->execute();
	$records = $statement->fetchAll(PDO::FETCH_ASSOC); 
	return $records;
}


?>