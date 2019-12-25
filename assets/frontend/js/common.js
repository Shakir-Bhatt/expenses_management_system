



function showErrorToaster(message){
	$('.toast-error .toast-body span').text(message);
    $('.toast-error').toast('show');
    setTimeout(function(){ $('.toast-error').toast('hide'); }, 3000);
}

function showSuccessToaster(message){
	$('.toast-success .toast-body span').text(message);
    $('.toast-success').toast('show');
    setTimeout(function(){ $('.toast-success').toast('hide'); }, 3000);
}

// window.setTimeout(function () {
//     $(".toast-success").fadeTo(2000, 500).slideUp(500, function(){
// 		$(".toast-success").slideUp(500);
// 	});
// 	$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
//     	$(".alert-danger").slideUp(500);
// 	});
// }, 5000);
	
