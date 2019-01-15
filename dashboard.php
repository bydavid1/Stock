<?php require_once 'includes/header.php'; ?>

<?php 


$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1 and paymentStatus < 3";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = 0;
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['total'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
 
$orderSql = "SELECT * FROM outlay WHERE available = 1";
$orderQuery = $connect->query($orderSql);
$totalOutlay = 0;
while ($data = $orderQuery->fetch_assoc()) {
	$totalOutlay += $data['total'];
}

$connect->close();

?>

	<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>


<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">


<div class="row">
	
	<div class="col-md-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="product.php" style="text-decoration:none;color:black;">
					Total de productos
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

		<div class="col-md-4">
			<div class="panel panel-info">
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total ventas
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	<div class="col-md-4">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<a href="product.php" style="text-decoration:none;color:black;">
					Inventario bajo
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->


	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading"> <i class="glyphicon glyphicon-signal"></i> Reporte de ventas y gastos</div>
			<div class="panel-body">
			<canvas id="canvas"></canvas>
			</div>	
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php if($totalRevenue) {
		    	echo number_format($totalRevenue,2);
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Ingresos totales</p>
		  </div>
		</div> 

		<div class="card" style="margin-top: 10px;">
		  <div class="cardHeader" style="background-color:#ef5350;">
		    <h1><?php if($totalOutlay) {
		    	echo number_format($totalOutlay,2);
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Compras totales</p>
		  </div>
		</div> 


	</div>

	
	
</div> <!--/row-->

<!--Charts -->
<script src="custom/Charts/dist/Chart.bundle.js"></script>
<script src="custom/Charts/samples/utils.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');


		});
		
		//Chart JS
		var color = Chart.helpers.color;
		var barChartData = {
			labels: [
				<?php 
				for($i=6;$i>=1;$i--){
				?>

				'<?php echo date("m")-$i;?>',

				<?php 
				}
				?>
			],
			datasets: [{
				label: 'Compras',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [
          500, 750, 500, 450, 490, 510
				]
			}, {
				label: 'Ventas',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
	       700, 800, 600, 410, 500, 500
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Ultimos 6 meses'
					}
				}
			});

		};


	
	</script>

<?php require_once 'includes/footer.php'; ?>