<!-- add outlay -->
<div class="modal fade" id="addOutlayModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitOutlayForm" action="php_action/createOutlay.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar compra</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div>
          
	        <div class="form-group">
	        	<label for="brands" class="col-sm-4 control-label">Proveedor: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <select class="form-control" id="brands" name="brands">
				      	<option value="">-- Selecciona --</option>
                          <?php 
                              $sql = 'SELECT * FROM brands WHERE brand_status = 1';
                              $query = $connect->query($sql);

                while($data = $query->fetch_array()){
                    echo "<option value='".$data['brand_id']."'> ".$data['brand_name']."</option>";
                }
                           ?>       	
				      </select>
				    </div>
	        </div> <!-- /form-group-->

            <div class="form-group">
	        	<label for="description" class="col-sm-4 control-label">Nombre: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="description" placeholder="Descripcion" name="description" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->		

            <div class="form-group">
	        	<label for="outlayDate" class="col-sm-4 control-label">Fecha: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="outlayDate" placeholder="Fecha" name="outlayDate" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
	        
	        <button type="submit" class="btn btn-primary" id="createOutlay" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->