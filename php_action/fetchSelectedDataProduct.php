<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'message1' => array(), 'message2' => array());
$type = $_POST['type'];

if ($type == "get"){

   $productCode = $_POST['code'];
   $sql = "SELECT product_name FROM product WHERE cod_product = '$productCode'";
   $result = $connect->query($sql);
   
   if($result->num_rows > 0) { 
    while ($row = $result->fetch_array()){
       $res = $row['product_name'];
    }
      $valid['success'] = true;
      $valid['messages1'] = $res;
      $valid['messages2'] = null;
   }else{
      $valid['success'] = false;
      $valid['messages1'] = null;	
      $valid['messages2'] = null;
   }

   echo json_encode($valid);

}else if($type == "add"){

   $id = $_POST['id'];


   $sql = "SELECT product_name, cod_product FROM product WHERE product_id = $id";
   $result = $connect->query($sql);

   if($result->num_rows > 0) { 
      while ($row = $result->fetch_array()){
         $name = $row['product_name'];
         $cod = $row['cod_product'];
      }
      $valid['success'] = true;
      $valid['messages1'] = $name;
      $valid['messages2'] = $cod;
   }else{
      $valid['success'] = false;
      $valid['messages1'] = null;	
      $valid['messages2'] = null;
   }

     echo json_encode($valid);
}


$connect->close();





