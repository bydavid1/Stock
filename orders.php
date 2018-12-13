<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

	echo "<div class='div-request div-hide'>manord</div>";
?>


<div class="panel panel-default">
	<div class="panel-heading">

		<?php 
		echo	'<i class="glyphicon glyphicon-edit"></i> Gestionar ventas';
		 ?>

	</div> <!--/panel-->	
	<div class="panel-body">

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Teléfono</th>
						<th>Total de productos</th>
						<th>Estado del pago</th>
						<th>Opciones</th>
					</tr>
				</thead>
			</table>

	 


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	