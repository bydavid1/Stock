<?php require_once 'includes/header.php'; ?>
<?php require_once 'php_action/db_connect.php'; ?> 


<div class='div-request div-hide'>add</div>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Compras</li>
  <li class="active">
    Agregar compras
   </li>
</ol>

<div class="panel panel-default">
	<div class="panel-heading">

			<i class='glyphicon glyphicon-circle-arrow-right'></i> Agregar compra

	</div> <!--/panel-->	
	<div class="panel-body">
      <div class="success-messages"></div> <!--/success-messages-->

      <form class="form-horizontal" method="POST" action="php_action/createOutlay.php" id="createOutlayForm">

      <div class="form-group">
      <label for="outlayDate" class="col-sm-2 control-label">Fecha de orden</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="outlayDate" name="outlayDate" autocomplete="off" value="<?php echo date("m/d/Y");?>"/>
      </div>
    </div> <!--/form-group-->
    <div class="form-group">
      <label for="description" class="col-sm-2 control-label">Descripcion</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="description" name="description" placeholder="Descripcion" autocomplete="off"  />
      </div>
    </div> <!--/form-group-->


					<table class="table" id="outlayTable">
        <thead>
            <tr>			  			
                <th style="width:30%;">Proveedor</th>
				<th style="width:20%;">Producto</th>
                <th style="width:20%;">Precio</th>
                <th style="width:10%;">Cantidad</th>			  			
                <th style="width:10%;">Total</th>			  			
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
							$arrayNumber = 0;
							for($x = 1; $x < 2; $x++) { 
              ?>
                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
                    <td>
                        <div class="form-group col-sm-12">
                        <select class="form-control" name="brandName[]" id="brandName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                            <option value="">-- Selecciona --</option>
														<?php 
														  $sql = 'SELECT * FROM brands WHERE brand_status = 1';
															$query = $connect->query($sql);
															while($data = $query->fetch_array()){
																echo "<option value='".$data['brand_name']."'> ".$data['brand_name']."</option>";
															}
                            ?>    
                        </select>
                        </div>
                    </td>
										<td>
                    <div class="form-group col-sm-12">
                        <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" disabled onchange="enable(<?php echo $x; ?>)" >
                            <option value="">-- Selecciona --</option>
                        </select>
                    </div>
                    </td>
                    <td>
                    <div class="form-group col-sm-12">			  					
                        <input type="number" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" class="form-control" step='0.01' value='0' min='0' onkeyup='totalValue(<?php echo $x; ?>)' disabled/>			  					
                        <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>	
                    </div>
                    </td>
					<td>			  
                    <div class="form-group col-sm-12">					
                        <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" autocomplete="off" class="form-control"  value='1' min='1' onkeyup='totalValue(<?php echo $x; ?>)' disabled/>			  					
                        <input type="hidden" name="quantityValue[]" id="quantityValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>			  					
                        </div>
                    </td>		  					
                    <td>
                    <div class="form-group col-sm-12">			  					
                        <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" step='0.01' value='0' min='0' disabled="true"/>			  					
                        <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>			  					
                    </div>
                    </td>
                    <td>

                        <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                    </td>
                </tr>
            <?php
            $arrayNumber++;
            } 
            ?>
        </tbody>			  	
    </table>

    <div class="col-md-6">
        </div>
    <div class="col-md-6">	
    <div class="form-group">
          <label for="vat" class="col-sm-3 control-label">Cantidad total</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="grandQuantity" name="grandQuantity" disabled="true"/>
            <input type="hidden" class="form-control" id="grandQuantityValue" name="grandQuantityValue"/>
          </div>
        </div> <!--/form-group-->			  	
        <div class="form-group">
          <label for="grandTotal" class="col-sm-3 control-label">Total</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true"/>
            <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue"/>
          </div>
        </div> <!--/form-group-->	
        </div>

            <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
				    	<button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>

	            <button type="submit" class="btn btn-primary" id="createOutlay" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
          </div>
			  </div>

	       
     	</form> <!-- /.form -->	     

			 <script src="custom/js/outlay.js"></script>

       <?php require_once 'includes/footer.php'; ?>