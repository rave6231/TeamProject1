<?php



function displayCategories(){
	$sql = "SELECT categoryId, categoryName
		FROM oe_category WHERE 1";
	$records = getDataBySQL($sql);
    foreach ($records as $record){
    	echo "<option value = '" . $record['categoryId'] . 
    	"'>" . $record['categoryName'] . "</option>";
    }
} 




function displayAllProducts() {
	$sql = "SELECT productName, price, productId  FROM oe_product";
	$records = getDataBySQL($sql);
	return $records;
	
	/*
	foreach($records as $record) {
		echo $record['productName'] . "-" . $record['price'] . "<br>";
	}
	 */
	
}

function filterProducts(){
global $conn;
	if (isset($_GET['searchForm'])) {  //user submitted the filter form
		
		$categoryId = $_GET['categoryId'];
		
		//This is the WRONG way to create queries because it allows SQL injection
		/*
		$sql = "SELECT productName, price , productId
				FROM oe_product
				WHERE categoryId = '" . $categoryId . "'" ;
		 */  
	
		 	$sql = "SELECT productName, price, productId 
				FROM oe_product
				WHERE categoryId = :categoryId"; //using Named Parameters (prevents SQL injection)
		    
		    $namedParameters = array();
			$namedParameters[":categoryId"] = $categoryId;
			
			
			
			$maxPrice = $_GET['maxPrice'];
			
			if (!empty($maxPrice)) { //the user entered a max price value in the form
				
			   //$sql = $sql . " ";
			   $sql .= " AND price <= :price"; //using named parameters
			   $namedParameters[":price"] = $maxPrice;
			 
			}
			
			if (isset($_GET['healthyChoice'])) {
				
				$sql .= " AND healthyChoice = 1";
			}
			
			$orderByFields = array("price", "productName");
			$orderByIndex = array_search($_GET['orderBy'],$orderByFields);
			
			//$sql .= " ORDER BY " . $_GET['orderBy'];
			$sql .= " ORDER BY " . $orderByFields[$orderByIndex]; //prevents SQL injection
			
			
			
		    $statement = $conn->prepare($sql);
			$statement->execute($namedParameters);
			$records = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $records;
			
			/*
			foreach($records as $record) {
		   	   echo $record['productName'] . "-" . $record['price'] . "<br>";
		    }
			 * 
			 */	
	}
}


function isHealthyChoiceChecked(){
			
   if (isset($_GET['healthyChoice'])){
   	 return "checked";
   }		
	
}



?>