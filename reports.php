<?php

include 'include/database.inc.php';

$conn = getDatabaseConnection();
//gets database connection
//------------

//------------------------(Get SQL Data & Format Table)-------------------------------
function tblBuild($sql, $title, $fields) {

	global $conn;
	
	$statement = $conn -> prepare($sql);
	$statement -> execute();
	$records = $statement -> fetchAll(PDO::FETCH_ASSOC);
	
	$recfields = explode('+', $fields);
	$cols = count($recfields);
	
	//----------------------( START TABLE)-------- 		
	echo "<table>";

	echo "<th colspan='$cols'>";
	echo $title;
	echo "</th>";
	//-----------------------(Table Field Names)-----------
	
	 echo "<tr class='td1' >";
	for ($i=0; $i < $cols; $i++) {
		echo "<td class='td1'>";
		echo $recfields[$i];
	}
	  echo "</tr>"; 
	 
	//-----------------------(Table DATA )---------------------------------------//
	foreach ($records as $rec) {
		
		echo "<tr>";
		foreach ($recfields as $recfield) {
			echo "<td class='td'>";
			echo $rec[$recfield];
		}
		echo "</tr>";
	}

	echo "</table>";

} 

?>
<!--------------------------------------------------------------------------->
<!--------------------------------------------------------------------------->
<html>
	<head>
		<title>Movie DB Stats</title>
		<link href="css/tblstyle.css" rel="stylesheet" />
	</head>

	<style>
	</style>
	<body>
		<h2> Movie Database Report </h2>
		<!------------------------>
		
		<strong>SQL:</strong>
		<pre> 
SELECT s.`prd_sell_name` , avg( p.`prd_pricing` ) AS 'Price'
FROM `prd_movie` m, `prd_pricing` p
LEFT OUTER JOIN `prd_sell_typ` s ON s.`prd_sell_Id` = p.`prd_sell_Id` 
WHERE p.`prd_movie_Id` = m.`prd_movie_Id` 
GROUP BY s.`prd_sell_name` 
 
       </pre>
         <?= tblBuild("SELECT s.`prd_sell_name` , round(avg( p.`prd_pricing` ),2) AS 'Price'
FROM `prd_movie` m, `prd_pricing` p
LEFT OUTER JOIN `prd_sell_typ` s ON s.`prd_sell_Id` = p.`prd_sell_Id` 
WHERE p.`prd_movie_Id` = m.`prd_movie_Id` 
GROUP BY s.`prd_sell_name` ",
        "Average Cost of a Movie",
		"prd_sell_name+Price") ?>
		
		
		
	 
		<strong>SQL:</strong>
		<pre> 
SELECT COUNT( DISTINCT `prd_movie_nm` ) AS 'NBR_Movies'
FROM `prd_movie`  
 
       </pre>
         <?= tblBuild("SELECT COUNT( DISTINCT `prd_movie_nm` ) AS 'NBR_Movies'
FROM `prd_movie` ",
" Number of Unique Movies",
		"NBR_Movies") ?>	
	
 
		<strong>SQL:</strong>
		<pre> 
SELECT  `prd_genre_desc` , COUNT( DISTINCT  `prd_movie_nm` ) AS  `GENRE` 
FROM  `prd_movie` m,  `prd_genre` g
WHERE m.`prd_genre_Id` = g.`prd_genre_ID` 
GROUP BY m.`prd_genre_Id` 
ORDER BY g.`prd_genre_desc`

       </pre>
         <?= tblBuild("SELECT  `prd_genre_desc` , COUNT( DISTINCT  `prd_movie_nm` ) AS  `GENRE` 
FROM  `prd_movie` m,  `prd_genre` g
WHERE m.`prd_genre_Id` = g.`prd_genre_ID` 
GROUP BY m.`prd_genre_Id` 
ORDER BY g.`prd_genre_desc`
", " Movies Grouped By Genre",
		"prd_genre_desc+GENRE") ?>		
	
		
		
		
	</body>
</html>