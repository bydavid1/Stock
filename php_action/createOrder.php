<?php 	

require_once 'core.php';
$session_id = session_id();

$valid['success'] = array('success' => false, 'messages' => array());

  $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName = $_POST['clientName'];
  $subTotalValue = $_POST['subTotal'];
  $iva = $_POST['iva'];
  $total = $_POST['total'];

				
	$sql = "INSERT INTO orders (order_date, client_name, sub_total, discount, total,  order_status) VALUES ('$orderDate', '$clientName',  '$subTotalValue', '$iva', '$total', '1');";
	$res = $connect->query($sql);
	$order_id;
	if($res > 0) {
		$order_id = $res->insert_id;
	}


	$data = "SELECT tmp.`quantity_tmp`, tmp.`product_id`,tmp.`rate_tmp`,product.`product_name` FROM tmp INNER JOIN product ON tmp.`product_id` = product.`product_id` WHERE session_id = $session_id";
   
	$result = $connect->query($data);
	while($products = $result->fetch_array()){

		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = '$products["product_id"]'";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);

			$updateQuantity = $updateProductQuantityData[0] - $products['quantity_tmp'];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '$updateQuantity' WHERE product_id = $products['product_id']";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES (5 , '".$products['product_id']."', '".$products['quantity_tmp']."', '".$products['rate_tmp']"', '".$products['rate_tmp']."', 1)";

				$connect->query($orderItemSql);				
	}
	 
	$valid['success'] = true;
	$valid['messages'] = "Agregado exitosamente";		
	
	$connect->close();

	echo json_encode($valid);

?>


 
