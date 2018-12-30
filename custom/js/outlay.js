$(document).ready(function() {

	var divRequest = $(".div-request").text();

		// top nav bar 
		$("#navOutlay").addClass('active');
		// add order	
		// top nav child bar 
		$('#addOutlay').addClass('active');	

	$("#outlayDate").datepicker();
	
	$("#manageOutlayTable").DataTable({
		'ajax': 'php_action/fetchOutlay.php',
		'order': []
	});		

    $("#createOutlayForm").unbind('submit').bind('submit', function() {

        var form = $(this);

        $('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

				
			var description = $("#description").val();
			var outlayDate = $("#outlayDate").val();
			var grandQuantity = $("#grandQuantity").val();
			var grandTotal = $("#grandTotal").val();
			

			// form validation 
			if(description == "") {
				$("#description").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#description').closest('.form-group').addClass('has-error');
			} else {
				$('#description').closest('.form-group').addClass('has-success');
			} // /else

			if(outlayDate == "") {
				$("#outlayDate").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#outlayDate').closest('.form-group').addClass('has-error');
			} else {
				$('#outlayDate').closest('.form-group').addClass('has-success');
			} // /else

			if(grandQuantity == "") {
				$("#grandQuantity").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#grandQuantity').closest('.form-group').addClass('has-error');
			} else {
				$('#grandQuantity').closest('.form-group').addClass('has-success');
			} // /else

			if(grandTotal == "") {
				$("#grandTotal").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#grandTotal').closest('.form-group').addClass('has-error');
			} else {
				$('#grandTotal').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){	    		    	
		    	$("#"+productNameId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
           } // for  
           

           
    	// array validation
			var rateValue = document.getElementsByName('rate[]');				
			var validateRate;
			for (var x = 0; x < rateValue.length; x++) {       			
				var rateValueId = rateValue[x].id;	    	
		    if(rateValue[x].value == ''){	    		    	
		    	$("#"+rateValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+rateValueId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+rateValueId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < rateValue.length; x++) {       						
		    if(rateValue[x].value){	    		    		    	
		    	validateRate = true;
	      } else {      	
                validateRate = false;
	      }          
           } // for  
           
            // array validation
			var quantityValue = document.getElementsByName('quantity[]');				
			var validateQuantity;
			for (var x = 0; x < quantityValue.length; x++) {       			
				var quantityValueId = quantityValue[x].id;	    	
		    if(quantityValue[x].value == ''){	    		    	
		    	$("#"+quantityValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+quantityValueId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+quantityValueId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < quantityValue.length; x++) {       						
		    if(quantityValue[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
                validateQuantity = false;
	      }          
		   } // for 
		   
		 // array validation
			var totalValue = document.getElementsByName('total[]');				
			var validateTotal;
			for (var x = 0; x < totalValue.length; x++) {       			
				var totalValueId = totalValue[x].id;	    	
		    if(totalValue[x].value == ''){	    		    	
		    	$("#"+totalValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+totalValueId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+totalValueId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < totalValue.length; x++) {       						
		    if(totalValue[x].value){	    		    		    	
		    	validateTotal = true;
	      } else {      	
                validateTotal = false;
	      }          
		   } // for
		   
		  if(description && outlayDate && grandQuantity && grandTotal){ 
			if(validateProduct == true && validateQuantity == true && validateBrand == true && validateRate == true && validateTotal == true) {

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),					
					dataType: 'json',
					beforeSend: function(){
						
					},
					success:function(response) {
						// reset button
						$("#createOutlay").button('reset');
						
						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if(response.success == true) {

							// create order button
							$(".success-messages").html('<div class="alert alert-success">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
				  '</div>');
							
						} else {
							$(".success-messages").html('<div class="alert alert-danger">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +	            		            		            	
							  '</div>');								
						}
					} // /response
				}); // /ajax
			} // if array validate is true
		}// /if field validate is true
		
		return false;

    });
}); //Document


function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#outlayTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#outlayTable tbody tr:last").attr('id');
		arrayNumber = $("#outlayTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'php_action/fetchBrandData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
			'<td>'+
			'<div class="form-group col-sm-12">'+
			'<input type="text" name="productCode[]" id="productCode'+count+'" autocomplete="off" class="form-control" onchange="getProductData('+count+')"/>'+		  					
			'<input type="hidden" name="productCodeValue[]" id="ProductCodeValue'+count+'" autocomplete="off" class="form-control"/>'+
			'</div>'+
			'</td>'+
			'<td>'+
			'<div class="form-group col-sm-12">'+
			'<input type="text" name="productName[]" id="productName'+count+'" autocomplete="off" class="form-control" disabled />'+			  					
			'<input type="hidden" name="productNameValue[]" id="productNameValue<'+count+'" autocomplete="off" class="form-control"/>'+	
			'</div>'+
			'</td>'+
				'<td>'+
				' <div class="form-group col-sm-12">'+
					'<input type="number" name="rate[]" id="rate'+count+'" autocomplete="off"  class="form-control" step="0.01"  min="0" onkeyup="totalValue('+count+')" disabled/>'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
				'<td>'+
				'<div class="form-group col-sm-12">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="totalValue('+count+')" autocomplete="off" disabled class="form-control" value="1"  min="1" onkeyup="totalValue('+count+')" />'+
                    '<input type="hidden" name="quantityValue[]" id="quantityValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
				'<td>'+
				' <div class="form-group col-sm-12">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" step="0.01"  min="0" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#outlayTable tbody tr:last").after(tr);
			} else {				
				$("#outlayTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row


function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();

	} else {
		alert('error! Refresh the page again');
	}
}

function getProductData(row = null) {
	if(row) {
		var code = $("#productCode"+row).val();		
		console.log(code);
		if(code == "") {
			$("#rate"+row).val("");
			$("#quantity"+row).val("");						
			$("#total"+row).val("");
            $("#productName"+row).prop('disabled', true);
            $("#rate"+row).prop('disabled', true);
            $("#quantity"+row).prop('disabled', true);
		} else {
			$.ajax({
				url: 'php_action/fetchSelectedDataProduct.php',
				type: 'post',
				data: "code="+code,
				dataType: 'json',
				success:function(response) {
                    console.log(response);
					if(response.success == true){
						$("#productName"+row).val(response.messages);
						$("#quantity"+row).prop('disabled', false);
						$("#rate"+row).prop('disabled', false);
					}else{
						$("#productName"+row).val(response.messages);
						$("#productName"+row).prop('disabled', true);
						$("#rate"+row).prop('disabled', true);
						$("#quantity"+row).prop('disabled', true);
					}

					
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data


function totalValue(row = null) {
 var rate = Number($("#rate"+row).val());
 var quantity = Number($("#quantity"+row).val());

 total = rate * quantity;
 total = total.toFixed(2);

 $("#total"+row).val(total);
 $("#totalValue"+row).val(total);

 subAmount();
}

function removeOutlay(outlay_id = null) {
	if(outlay_id) {
		// remove product button clicked
		$("#removeProductBtn").unbind('click').bind('click', function() {
			// loading remove button
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					// loading remove button
					$("#removeProductBtn").button('reset');
					if(response.success == true) {
						// remove product modal
						$("#removeProductModal").modal('hide');

						// update the product table
						manageProductTable.ajax.reload(null, false);

						// remove success messages
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeProductMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if productid
} // /remove product function


function subAmount() {
	var tableProductLength = $("#outlayTable tbody tr").length;
	var total = 0;
	var quantity = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#outlayTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		total = Number(total) + Number($("#total"+count).val());
		quantity = Number(quantity) + Number($("#quantity"+count).val());
	} // /for


	total = total.toFixed(2);
	$("#grandTotal").val(total);
	$("#grandTotalValue").val(total);


	$("#grandQuantity").val(quantity);
	$("#grandQuantityValue").val(quantity);


} // /sub total amount