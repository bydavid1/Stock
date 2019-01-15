<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName 		= $_POST['productName'];
	$codProduct 		= $_POST['codProduct'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['quantity'];
  $rate 					= $_POST['rate'];
  $brandName 			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];
  $typeProd 	= $_POST['type'];
  $date      = date("d/m/y");

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO product (cod_product, type, product_name, product_image, brand_id, categories_id, quantity, rate, active, status) 
				VALUES ('$codProduct', '$typeProd', '$productName', '$url', '$brandName', '$categoryName', '$quantity', '$rate', '$productStatus', 1)";
                $res = $connect->query($sql);
				$product_id = $connect->insert_id;
				
                $kardex = "INSERT INTO kardex (concept, date, quantity, balance, product_id) VALUES ('Inicio en inventario', $date, $quantity, '0', $product_id)";
                $fact = $connect->query($kardex);
				if($res > 0 && $fact > 0) {
					$valid['success'] = TRUE;
					$valid['messages'] = "Creado exitosamente";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error no se ha podido guardar";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 
	


	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST