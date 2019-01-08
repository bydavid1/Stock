$(document).ready(function() {
	
	load(1);
	load(2);

	var divRequest = $(".div-request").text();

		// top nav bar 
		$("#navOutlay").addClass('active');
		// add order	
		// top nav child bar 
		$('#addOutlay').addClass('active');	

	$("#outlayDate").datepicker();	

    $("#createOutlayForm").unbind('submit').bind('submit', function() {

        var form = $(this);

        $('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

				
			var provider = $("#provider").val();
			var nit = $("#nit").val();
			var outlayDate = $("#outlayDate").val();
			var grandQuantity = $("#grandQuantity").val();
			var grandTotal = $("#grandTotal").val();
			

			// form validation 
			if(provider == "") {
				$("#provider").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#provider').closest('.form-group').addClass('has-error');
			} else {
				$('#provider').closest('.form-group').addClass('has-success');
			} // /else

			// form validation 
			if(nit == "") {
				$("#nit").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#nit').closest('.form-group').addClass('has-error');
			} else {
				$('#nit').closest('.form-group').addClass('has-success');
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

		   tableRow = $("#outlayTable tbody tr:last").attr('id');
		   count = tableRow.substring(3);	
		   $('#trCount').val(count); 
		  if(outlayDate && grandQuantity && grandTotal && nit && provider){ 
			if(validateProduct == true && validateQuantity == true  && validateRate == true && validateTotal == true) {

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),				
					dataType: 'json',
					beforeSend: function(){
						console.log(count);
					},
					success:function(response) {
						// reset button
						console.log(response);
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

function load(page){
	var q= $("#q").val();
	var v= $("#v").val();
	$("#loader").fadeIn('slow');
	$("#gif").fadeIn('slow');

	if(page == 1){
		$.ajax({
			url:'./php_action/fetchAddProduct.php?action=ajax&page='+page+'&q='+q,
			 beforeSend: function(objeto){
			 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');
				
			}
		})
	}else{
		 var num = 1;
		$.ajax({
			url:'./php_action/fetchCostumerData.php?action=ajax&page='+num+'&q='+v,
			 beforeSend: function(objeto){
			 $('#gif').html('<img src="./img/ajax-loader.gif"> Cargando...');
		  },
			success:function(data){
				$(".data").html(data).fadeIn('slow');
				$('#gif').html('');
				
			}
		})
	}

}