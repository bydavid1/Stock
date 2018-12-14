
<?php 	

require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.rate,  
brands.brand_name, categories.categories_name FROM product 
INNER JOIN brands ON product.brand_id = brands.brand_id 
INNER JOIN categories ON product.categories_id = categories.categories_id  
WHERE product.status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];

	 $quantity = "<input type='text' class='form-control'  id='cantidad_".$productId."'  value='1' >";
	 $button = "<a class='btn btn-info' href='#' onclick='agregar(".$productId.")'><i class='glyphicon glyphicon-shopping-cart'></i></a>";

	$brand = $row[3];
	$category = $row[4];
 	$output['data'][] = array( 		
 		// product name
 		$row[1], 
 		// rate
 		$row[2],		 	
 		// brand
 		$brand,
 		// category 		
		 $category,
	    //quantity
		 $quantity,
 		// button
 		 $button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);

?>
