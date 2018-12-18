<?php 	

require_once 'core.php';

$sql = "SELECT outlay_id, outlay_description, outlay_date FROM outlay";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 


 while($row = $result->fetch_array()) {

    $total = 10.00;

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" > <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    <li><a type="button" data-toggle="modal" onclick="removeOutlay('.$row[0].')" data-target="#removeProductModal" id="removeProductModalBtn"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';


 	$output['data'][] = array( 		
 		// image
 		$row[1],
 		// product name
 		$row[2], 
 		// rate
 		$row[0],
         // button
        $total,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);