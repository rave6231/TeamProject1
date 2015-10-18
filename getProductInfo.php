<?php 

include 'include/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection

// Check if productId has been set
if (isset($_GET['productId'])) {
	
	$productId = $_GET['productId'];
	
	$sql = "SELECT productName, productDescription
		FROM oe_product WHERE productId = " . $_GET['productId'];
		
	$sql1 = "SELECT productName, productDescription      
	        FROM oe_product WHERE productId = :productId";      // Dont know why it wont work!!!!

    $namedParameters = array();
    $namedParameters[":productId"] = $productId;	
	
	$records = getDataBySQL($sql);    //// test with $SQL1 or $SQL
	
	foreach ($records as $record) {
		echo "ProductName: " . $record['productName'] . "<br />";
		echo "ProductDescription: " . $record['productDescription'] . "<br />";
	}
}	
?>


