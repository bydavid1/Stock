<?php 	

require_once 'core.php';

$brandId = $_POST['brandId'];

$sql = "SELECT product_id, product_name FROM product WHERE brand_id = $brandId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
   while ($row = $result->fetch_array()){
   
    echo "<option value='".$row['product_id']."'>".$row['product_name']."</option>";

   }
}else{

    echo "<option value=''>No se pudieron cargar</option>";
}



$connect->close();

