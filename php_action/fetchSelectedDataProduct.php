<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$productCode = $_POST['code'];

$sql = "SELECT product_name FROM product WHERE cod_product = '$productCode'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 while ($row = $result->fetch_array()){
    $res = $row[0];
 }
   $valid['success'] = true;
   $valid['messages'] = $res;
}else{
   $valid['success'] = false;
   $valid['messages'] = "ERROR";	
}

$connect->close();

echo json_encode($valid);



