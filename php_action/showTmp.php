
<table class="table">
<tr>
<th class='text-center'>CODIGO</th>
<th class='text-center'>CANT.</th>
<th>PRODUCTO</th>
<th class='text-right'>PRECIO UNIT.</th>
<th class='text-right'>PRECIO TOTAL</th>
<th></th>
</tr>   

<?php
require_once 'core.php'; //Conexion y verificacion de sesion

$session_id= session_id();
$sumador_total=0;
	$sql=mysqli_query($connect, "select * from product, tmp where product.product_id=tmp.product_id and tmp.session_id='".$session_id."'");
	while ($row=mysqli_fetch_array($sql))
	{
	$id_tmp=$row["id_tmp"];
	$codigo_producto=$row['product_id'];
	$cantidad=$row['quantity_tmp'];
	$nombre_producto=$row['product_name'];

	$precio_venta=$row['rate_tmp'];
	$precio_venta_f=number_format($precio_venta,2);//Formateo variables
	$precio_venta_r=str_replace(",","",$precio_venta_f);//Reemplazo las comas
	$precio_total=$precio_venta_r*$cantidad;
	$precio_total_f=number_format($precio_total,2);//Precio total formateado
	$precio_total_r=str_replace(",","",$precio_total_f);//Reemplazo las comas
	$sumador_total+=$precio_total_r;//Sumador
		?>
    <tr>
			<td class='text-center'><?php echo $codigo_producto;?></td>
			<td class='text-center'><?php echo $cantidad;?></td>
			<td><?php echo $nombre_producto;?></td>
			<td class='text-right'><?php echo $precio_venta_f;?></td>
			<td class='text-right'><?php echo $precio_total_f;?></td>
			<td class='text-center'><a href="#" onclick="eliminar('<?php echo $id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i></a></td>
	</tr>
<?php
	}

	$subtotal=number_format($sumador_total,2,'.','');
	$total_iva=($subtotal * 0.13 )/100;
	$total_iva=number_format($total_iva,2,'.','');
	$total_factura=$subtotal+$total_iva;
	?>

	<tr>
<td class='text-right' colspan=4>SUBTOTAL $</td>
	<td>
	<div class="pull-right">
	<input type="text" class="form-control text-right" id="subTotal" name="subTotal" disabled value="<?php echo number_format($subtotal,2);?>"/>
	</div>
	</td>
	<td></td>
</tr>
<tr>
<td class='text-right' colspan=4>IVA (13%) $</td>
	<td>
	<div class="pull-right">
	<input type="text" class="form-control text-right" id="iva" name="iva" disabled value="<?php echo number_format($total_iva,2);?>"/>
	</div>
	</td>
	<td></td>
</tr>
<tr>
<td class='text-right' colspan=4>TOTAL $</td>
	<td>
	<div class="pull-right">
	<input type="text" class="form-control text-right" id="total" name="total" disabled value="<?php echo number_format($total_factura,2);?>"/>
	</div>
	</td>
	<td></td>
</tr>

</table>




