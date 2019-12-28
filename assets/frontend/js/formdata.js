// Check price and field value
function checkPrice(obj){	
	var price = $(obj).val();
	var error = false;
	var message = "";
	if(price == ""){
		$(obj).val(0);
		error = true;
		message = "Minimum value is 0 for item";
	} else if(parseFloat(price) <= 0){
		$(obj).val(0);
		error = true;
		message = "Price cannot be negative or zero";
	} else if(!$.isNumeric(price)){
		$(obj).val(0);
		error = true;
		message = "Enter numeric value only";
	}
	if(error){
		$(obj).focus();
		showErrorToaster(message);
		return;
	}

	if($(obj).prev('.item-name').val() == ""){
		$(obj).prev('.item-name').focus();
		showErrorToaster('Item name cannot be empty!');
	}
	calculateTotalAmount();		
}

function calculateTotalAmount(){
	var totalAmount = 0;
	$(".item-price").each(function() {
		totalAmount += parseFloat($(this).val());
	});
	$('#total-price').val(totalAmount);	
}

function addRow(btnObj){
	// Check of current row has price
	if($(btnObj).prev('.item-price').val() == "" || parseFloat($(btnObj).prev('.item-price').val()) <= 0){
		$(btnObj).prev('.item-price').focus();
		showErrorToaster('Item price is not valid invalid');
		return;
	}
	// Check of current row has item name
	if($(btnObj).prev('.item-price').prev('.item-name').val() == ""){
		$(btnObj).prev('.item-price').prev('.item-name').focus();
		showErrorToaster('Item name cannot be empty!');
		return;
	}
	var numItems = $('.bubble').length;
    if(numItems >= 4){
    	showErrorToaster('You can add only 5 items at a time');
        return false;
    }

    if(checkIfEmptyItemOrPrice()){
    	showErrorToaster('You cannot add more item, some field has invalid value');
    } else {

		var rowHtml = '<div class="form-group row bubble">\
				  		<label for="email" class="col-md-3"></label>\
						<input type="text" required class="col-md-4 form-control item-name" placeholder="Item Name" name="item[]">\
						<input type="text" class="col-md-1 offset-md-1 form-control item-price" placeholder="Price" value="0" name="price[]" onblur="checkPrice(this);" required>\
						<button type="button" class="offset-md-1 btn btn-danger btn-sm" onclick="deleteRow(this)";>  &nbsp;&nbsp;-&nbsp;&nbsp;</button>\
					</div>';
		$('#add-more-fields').append(rowHtml);
	}	
}

function checkIfEmptyItemOrPrice(){
	var error = false;
	$(".item-price").each(function() {
		if($(this).val() == 0){
			$(this).focus();
        	error =  true;
        	return false;
		}
	});

	$(".item-name").each(function() {
		if($(this).val() == ""){
			$(this).focus();
        	error =  true;
        	return false;

		}
	});
	return error;
}

function deleteRow(btnObj){
	$(btnObj).parent().slideUp(300, function () {
        $(btnObj).parent().remove();
		calculateTotalAmount();
    });
	
}

function saveData(btnObj){
	if($('#user-id').val() ==  ''){
		showErrorToaster("Please select a user first");
		$('#user-id').focus();
		return false;
	}
	var formData = $('#expenses-form').serialize();
	console.log(formData);
	$.ajax({
        method: "POST",
        dataType: "JSON",
        url: "controllers/addinventory.php",
        data: {formData:formData,action:'save_expenses'},
        success: function (response){
            showSuccessToaster(response);
            $('#expenses-form')[0].reset();
        },
        error: function (response){
            showErrorToaster(response.responseJSON);
            if(response.status == 419 || response.status == 401){
                window.location.href = "{{ route('login') }}";
            }
        } 
    });
}

var loader = '<div class="spinner-border"></div>';
$('#transactionModal').on('show.bs.modal', function (event) {
    $('#transactionModal .modal-body form').html(loader);
    var button = $(event.relatedTarget); 
    var userId = button.data('user'); 
    $.ajax({
        method: "GET",
        dataType: "json",
        data:{user_id:userId},
        url: "controllers/dashboard.php?action=transctionmodalbody",
        success: function (response) {
            $('#transactionModal .modal-body form').html(response);
        },
        error: function (response) {
            showErrorToaster(response.responseJSON);
            if(response.status == 419 || response.status == 401){
                window.location.href = window.location.href
            }
            
        }
    });
});

function enableDisableField(obj) {

    if($(obj).parent().next().next().prop('disabled')){
        $(obj).parent().next().next().prop('disabled',false);
    } else {
        $(obj).parent().next().next().prop('disabled',true);
    }
}
function checkPayablePrice(obj) {
    var totalAmountToPay = parseFloat($('#payable-amount').text());
    var amountToPayToUser = parseFloat($(obj).prev().text());
    var currentAmount = parseFloat($(obj).val());
    if( currentAmount > amountToPayToUser || currentAmount > totalAmountToPay){
        var message = 'Amount cannot be greater than payable amount or amount to paid user';
        showErrorToaster(message);
        $(obj).val(0);
    }

}

function payAmount(btnObj,formId) {
    var totalAmountToPay = parseFloat($('#payable-amount').text());
    //console.log(totalAmountToPay);
    var amountToPayToEach = 0.00;
    $(".amount-to-pay-to-each").each(function() {
        amountToPayToEach += parseFloat($(this).text());
    });
    //console.log(amountToPayToEach);

    var amountPaid = 0.00;
    $(".amount-paid").each(function() {
        if(!$(this).prop('disabled')){
            amountPaid += parseFloat($(this).val());
        }
    });
    //console.log(amountPaid);

    if(amountPaid > totalAmountToPay){
        var message = 'Paid amount cannot be greater than Payable Amount';
        showErrorToaster(message);
        // Set 0 to all input fields
        $(".amount-paid").each(function() {
            $(this).val(0);
        });
    }

    var formData = $(formId).serialize();
    $.ajax({
        method: "GET",
        dataType: "json",
        data:{user_id:userId},
        url: "controllers/dashboard.php?action=makepayment",
        success: function (response) {
            showErrorToaster(response);
        },
        error: function (response) {
            showErrorToaster(response.responseJSON);
            if(response.status == 419 || response.status == 401){
                window.location.href= window.location.href
            }
            
        }
    });
} 