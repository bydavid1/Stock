
<?php 	

require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.quantity, product.rate,  
brands.brand_name, categories.categories_name FROM product 
INNER JOIN brands ON product.brand_id = brands.brand_id 
INNER JOIN categories ON product.categories_id = categories.categories_id  
WHERE product.status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];

 	$button = "<a class='btn btn-info' href='#' onclick='agregar(".$productId.")'><i class='glyphicon glyphicon-plus'></i></a>";


	$brand = $row[4];
	$category = $row[5];
 	$output['data'][] = array( 		
 		// product name
 		$row[1], 
 		// rate
 		$row[3],
 		// quantity 
 		$row[2], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);

?>
