<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $outlayDate = date('Y-m-d', strtotime($_POST['outlayDate']));	
  $description = $_POST['description'];
  $grandTotal = $_POST['grandTotalValue'];
  $grandQuantity = $_POST['grandQuantityValue'];

  $sql = "INSERT INTO outlay (outlay_description, outlay_date, quantity, total) VALUES ('$description', '$outlayDate','$grandQuantity','$grandTotal');";
  $res = $connect->query($sql);

  if($res > 0){
      $insert = true;
      $outlay_id = $connect->insert_id;
  }else{
      $insert = false;
  }
  

  for($x = 0; $x < count($_POST['productName']); $x++) {
    
    $query = "INSERT INTO `outlay_item` (`outlay_item_id`, `outlay_id`, `brand_name`, `product_name`, `quantity`, `rate`, `total`) VALUES (NULL,".$outlay_id.",'".$_POST['brandName'][$x]."','".$_POST['productName'][$x]."','".$_POST['quantity'][$x]."','".$_POST['rate'][$x]."','".$_POST['totalValue'][$x]."');";
    $result = $connect->query($query);
  }

  //

  if($insert === TRUE && $result > 0){
    $valid['success'] = true;
    $valid['messages'] = 'Se agrego exitosamente';
  }else{
    $valid['success'] = false;
    $valid['messages'] = 'Ocurrio un error';
  }

  $connect->close();

	echo json_encode($valid);