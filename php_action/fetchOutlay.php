<?php 	

require_once 'core.php';

$sql = "SELECT outlay_id, provider, outlay_date, quantity, payment_status, total FROM outlay WHERE available = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 


 while($row = $result->fetch_array()) {

	if($row[4] == 1) { 		
		$paymentStatus = "<label class='label label-success'>Pago completo</label>";
	} else if($row[4] == 2) { 		
		$paymentStatus = "<label class='label label-info'>Pago por adelantado</label>";
	} else { 		
		$paymentStatus = "<label class='label label-warning'>No pagado</label>";
	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
		<li><a href="editOrder.php?o=editOut&i='.$row[0].'" id="editOutlay"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
		<li><a type="button" data-toggle="modal" onclick="removeOutlay('.$row[0].')" data-target="#removeOutModal" id="removeOutModalBtn"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';


 	$output['data'][] = array( 		

		$row[0],

 		$row[2],
 		
 		$row[1], 
 
		$row[3],

		$paymentStatus,
		 
		$row[5],
    
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);