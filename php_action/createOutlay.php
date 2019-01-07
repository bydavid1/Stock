<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $outlayDate = date('Y-m-d', strtotime($_POST['outlayDate']));	
  $description = $_POST['description'];
  $grandTotal = $_POST['grandTotalValue'];
  $grandQuantity = $_POST['grandQuantityValue'];
  $provider = $_POST['provider'];
  $nit = $_POST['nit'];
  $paymentStatus = $_POST['paymentStatus'];
  $paymentType = $_POST['paymentType'];
  $count = $_POST['trCount'];


  $sql = "INSERT INTO outlay (outlay_description, provider, nit, outlay_date, quantity, total, payment_status, payment_type, available) VALUES ('$description', '$provider', '$nit', '$outlayDate','$grandQuantity','$grandTotal', '$paymentStatus', '$paymentType', 1);";
  
  $res = $connect->query($sql);

  if($res > 0){
      $insert = true;
      $outlay_id = $connect->insert_id;
  }else{
      $insert = false;
  }
  
  $number = (int) $count;

  for($x = 0; $x < $number; $x++) {
    
    $query = "INSERT INTO `outlay_item` (`outlay_item_id`, `outlay_id`, `product_code`, `product_name`, `quantity`, `rate`, `total`, `available`) VALUES (NULL,".$outlay_id.",'".$_POST['productCode'][$x]."','".$_POST['productNameValue'][$x]."','".$_POST['quantity'][$x]."','".$_POST['rate'][$x]."','".$_POST['totalValue'][$x]."', 1);";
    $result = $connect->query($query);

    $data = "SELECT quantity, product_id FROM product WHERE cod_product = '".$_POST['productCode'][$x]."'";
		$updateProductQuantityData = $connect->query($data);
     $producQuantityData = $updateProductQuantityData->fetch_array();
      $updateQuantity = $producQuantityData['quantity'] + $_POST['quantity'][$x];
    
    $update = "UPDATE `product` SET `quantity` = $updateQuantity WHERE `cod_product` = '".$_POST['productCode'][$x]."'";
    $quantityUpdated = $connect->query($update);

    $kardex = "INSERT INTO kardex (concept, date, quantity, balance, product_id) VALUES ('Compra', '$outlayDate', ".$producQuantityData['quantity'].", '+". $_POST['quantity'][$x]."', ".$producQuantityData['product_id'].")";
    $fact = $connect->query($kardex);

  }


  if($insert == TRUE && $result > 0){
    $valid['success'] = true;
    $valid['messages'] = 'Se agrego exitosamente';
  }else{
    $valid['success'] = false;
    $valid['messages'] = 'Ocurrio un error';
  }

  $connect->close();

	echo json_encode($valid);