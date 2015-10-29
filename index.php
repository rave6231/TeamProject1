<?php

//comment mr comment !!!!!!!!  more 12:55


include 'include/database.inc.php';
include 'include/dbSQL.inc.php';

$conn = getDatabaseConnection(); //gets database connection


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Movies</title>
		<meta name="description" content="">
		<meta name="author" content="Team Seven">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<link href="css/mystylesT1.css" rel="stylesheet" />
	</head>

	<body>
			
	<div>
    <header>
      <h1>Movie Search</h1>
    </header>

    <div>
    	 
    	<form method ="get">
    	<!--------------------------------------------------------------------------------------->
    	Select Genre: 
    	
    	<select name = "categoryId">
    		
    		<?=displayCategories() ?>
    		
    	</select>
    	<!------------------------------------------------------------------------------------------>
    	&nbsp;	
    	 Year: 
    	<input type="number" name = "maxPrice" value="<?=$_GET['maxPrice']?>">
    	
      	<!------------------------------------------------------------------------------------------> 
      	&nbsp;
    	 Movie Name : 
    	 <input type="text" name="movie" id="movie"  ?>  
    	 
    	 <!------------------------------------------------------------------------------------------>
    	 <strong>Sort Selection by:</strong>
    	<select name="orderBy">
    		<option value="Title">Title</option>
    		<option value="Year">Year</option>
    	</select>
    	 <!------------------------------------------------------------------------------------------> 
    	<p>
    	<input type="submit" value="Search Movies" name="searchForm" />
    	</p>
    	</form>
    	
    	<hr> <br />
    	
    	<div style="float:left">
    	 <!------------------------------------------------------------------------------------------> 
    	 <!------------------------------------------------------------------------------------------> 
    		
    	<?php
    	 
    	
    	//Displays all products by default
    	if (!isset($_GET['searchForm'])) {
    		$records = displayAllProducts();
			
			} else {
    		$records = filterProducts();
			
    	}
		
 		foreach($records as $record) {
 			   echo "<a target='getProductIframe' href='getProductInfo.php?productId=" . $record['productId'] . "'>";
 		   	   echo $record['productName'];
 	   	   echo "</a>";
 		   	   echo "- $" . $record['price'] . "<br>";
 		}
	      
    	?>
         <!------------------------------------------------------------------------------------------> 
    	 <!------------------------------------------------------------------------------------------> 
    	
    	</div>
    	<br>
    	<div style="float:left">
    		 
    		<iframe src="getProductInfo.php" name="getProductIframe" />
    	    </iframe>
    		
    	</div>
      
    </div>			
				
			
				<div id="footer">
					<footer id="footer">
						<br>
						<hr>
						Disclaimer: The information in this page is illustrative only. It was developed as part of a CST 336 class
						&copy; Mike, Maritza, Adrian, Austin 2015
						<br>
						<img   src="img/csumb-logo.png" alt="CSUMB Logo"  >
					</footer>
				</div>
		</div>
	</body>
	
</html>
