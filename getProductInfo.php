<?php 

include 'include/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection

// Check if productId has been set
if (isset($_GET['prd_movie_Id'])) {
	
	$prd_movie_Id = $_GET['prd_movie_Id'];
	
	$sql = "SELECT prd_movie_nm, prd_movie_desc , prd_movie_year, prd_movie_dir 
	FROM prd_movie WHERE prd_movie_Id = :prd_movie_Id"; 
		
	

    $namedParameters = array();
    $namedParameters[":prd_movie_Id"] = $prd_movie_Id;	
	
	
     $conn = getDatabaseConnection();	
     $statement = $conn->prepare($sql);
     $statement->execute($namedParameters);
	 $records = $statement->fetchAll(PDO::FETCH_ASSOC);
	 

	
	foreach ($records as $record) {
		echo "Movie: " . $record['prd_movie_nm'] . "<br />";
		echo  $record['prd_movie_desc']  . "<br />";
		echo "Director: " . $record['prd_movie_dir'] ." " . $record['prd_movie_year'] ;
	}
}	
?>



 
 
   