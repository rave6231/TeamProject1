<?php

function displayGenre(){
	$sql = "SELECT prd_genre_ID, prd_genre_desc
		FROM prd_genre WHERE 1";
	$records = getDataBySQL($sql);
    foreach ($records as $record){
    	echo "<option value = '" . $record['prd_genre_ID'] . 
    	"'>" . $record['prd_genre_desc'] . "</option>";
    }
} 


function displayAllProducts() {
	
	$sql = "SELECT p.`prd_pricing` , p.`prd_sell_Id` , p.`prd_movie_Id` , s.`prd_sell_name` , m.`prd_movie_nm` , m.`prd_movie_year`, m.`prd_movie_dir` \n"
     . "FROM `prd_movie` m, `prd_pricing` p\n"
     . "LEFT OUTER JOIN `prd_sell_typ` s ON s.`prd_sell_Id` = p.`prd_sell_Id` \n"
     . "WHERE p.`prd_movie_Id` = m.`prd_movie_Id` LIMIT 0, 30 ";
	
	$records = getDataBySQL($sql);
	 
		return $records;
	
}

function filterProducts(){
global $conn;

$sql = "SELECT p.`prd_pricing` , p.`prd_sell_Id` , p.`prd_movie_Id` , s.`prd_sell_name` , m.`prd_movie_nm` ,m.`prd_movie_year`, m.`prd_movie_dir` 
	                 FROM `prd_movie` m,  `prd_pricing` p
	                 LEFT OUTER JOIN `prd_sell_typ` s ON s.`prd_sell_Id` = p.`prd_sell_Id` 
	                 WHERE p.`prd_movie_Id` = m.`prd_movie_Id`";
      
	if (isset($_GET['searchForm']))  {    
		 
		$namedParameters = array();
		
		if (isset($_GET['prd_genre_ID']) AND !empty($_GET['prd_genre_ID']  )) 
		{
			$prd_genre_ID = $_GET['prd_genre_ID']; 
			
		 
			
			if ($prd_genre_ID != 'AA') {
				 
				$prd_genre_ID = $_GET['prd_genre_ID'];
				$sql .=	" AND prd_genre_ID = :prd_genre_ID";
				 
				$namedParameters[":prd_genre_ID"] = $prd_genre_ID;
			}
		}	
		     
			$movie = $_GET['prd_movie'];
			
			if (!empty($movie) AND $movie > ' ') { //the user entered a movie value in the form
			  
			   $movie = "%" . $movie . "%";	 
			   $movie = str_replace(' ', '', $movie)  ; 
			   $sql .= " AND m.prd_movie_nm   LIKE :movie"; //using named parameters
			   $namedParameters[":movie"] = "%" . $movie . "%";
			 
			 			 
			}
			
			
			 
			if (isset($_GET['sYear']) AND !empty($_GET['sYear']  )) {
				
			$sYear = $_GET['sYear'] ;
			if ($sYear  > 1900 ) { //the user entered a movie value in the form
			  
			   
			   $sql .= " AND m.prd_movie_year   = :sYear"; //using named parameters
			   $namedParameters[":sYear"] = $sYear ; 
			}
			 			 
			}
			
			
						 
			if (isset($_GET['orderBy']) AND !empty($_GET['orderBy']  )) {
						
				$orderBy =	$_GET['orderBy'];
												
				$orderByFields = array("prd_movie_nm", "prd_movie_dir", "prd_movie_year");
			    $orderByIndex = array_search($_GET['orderBy'],$orderByFields);
			
			    $sql .= " ORDER BY " . $orderByFields[$orderByIndex]; //prevents SQL injection
				 
			}
			
			 		
			
			
		    $statement = $conn->prepare($sql);
			$statement->execute($namedParameters);
			$records = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $records;
			
	
	}
}  // end filter products



?>