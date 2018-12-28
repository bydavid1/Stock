<?php 	

require_once 'core.php';

$brandName = $_POST['brandName'];

$dataBrand = "SELECT brand_id FROM brands WHERE brand_name = '$brandName'";
$res = $connect->query($dataBrand);
while ($data = $res->fetch_array()){

    $sql = "SELECT product_name FROM product WHERE brand_id = '".$data[0]."';";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
   while ($row = $result->fetch_array()){
   
    echo "<option value='".$row['product_name']."'>".$row['product_name']."</option>";

   }
}else{

    echo "<option value=''>No se pudieron cargar</option>";
}

}

$connect->close();

