<?php


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
    	
    	<select name = "prd_genre_ID">
    		<option value="AA" > ANY GENRE </option>
    		<?=displayGenre() ?>
    		
    	</select>
    	<!------------------------------------------------------------------------------------------>
    	&nbsp;	
    	 Year: 
    	<input type="number" name = "sYear" value="<?=$_GET['sYear']?>">
    	
      	<!------------------------------------------------------------------------------------------> 
      	&nbsp;
    	 Movie Name : 
    	 <input type="text" name="prd_movie"   value=" ">
    	 
    	 <!------------------------------------------------------------------------------------------>
    	 <strong>Sort Selection by:</strong>
    	<select name="orderBy">
    		<option value="prd_movie_nm">Movie          </option>
    		<option value="prd_movie_dir">Director        </option>
    		<option value="prd_movie_year">Year            </option>
    		
    	</select>
    	
    	 <!------------------------------------------------------------------------------------------> 
    	<p>
    	<input type="submit" value="Search Movies" name="searchForm" />
    	<button type="button" onclick="location.href='reset.php'">
					Reset Search
		</button>
		<button type="button" onclick="location.href='reports.php'">
					Generate Movie Database Reports
		</button>
    	
    	
    	    	</p>
    	</form>
    	
    	
    	<div style="float:left">
    		<fieldset>
		    <legend> <b>   Movie Description </b> </legend> 
    		<iframe src="getProductInfo.php" name="getProductIframe"  width="800" height="100" frameborder=0/>
    	    </iframe>
    		</fieldset>
    	</div>
    	
    	 
    	 <!------------------------------------------------------------------------------------------> 
    	 <!------------------------------------------------------------------------------------------> 
    		
    	<?php
    	
    	  	 
    	
    	//Displays all products by default
    	if (!isset($_GET['searchForm'])) {
    		$records = displayAllProducts();
			
			} else {
    		$records = filterProducts();
			
    	}
		
 		 
		echo " <fieldset> ";
		echo "    <legend> <b> Movie List </b> </legend>	";
		
		echo  "<div style='width:800px; height:300px; overflow:auto;'>";
		  
		echo "<table >";
		
		echo "<tr class='tblRw1'>"; 
		echo  "<td> Movie  ";
		echo  "<td> Director   ";
		echo  "<td > Year  ";
		echo  "<td colspan='3'> Purchase Options  ";
		 
        foreach ($records as $record) {
	      echo "<tr>"; 
	      
		   echo "<td> <a target='getProductIframe' href='getProductInfo.php?prd_movie_Id=" . $record['prd_movie_Id'] . "'>";
 		   	   echo '- ' . $record['prd_movie_nm'];
		  echo "</a>";
		  
		  echo "<td>" . $record['prd_movie_dir'];
		  echo "<td>" . $record['prd_movie_year'];
		  echo "<td>" . "   " ;
		  echo "<td>" . $record['prd_sell_name'];
 		  echo "<td>" . "- $" . $record['prd_pricing'] . "<br>";
		  
	  
	    } //endForeach
	    echo " </fieldset> ";
	    
        
        echo "</table>";
		echo "</div>";  
		  
		  
    	?>
         <!------------------------------------------------------------------------------------------> 
    	 <!------------------------------------------------------------------------------------------> 
    	
     
    	
      
    </div>			
				
			
				<div id="footer" style="clear:left">
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