
var expensesTable;
$(function () {
    expensesTable = $('#expensesTable').DataTable({
        ajax: {
            url: 'controllers/dashboard.php?action=expenses',
            error: function(response){
            }
        },
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search"
        },

        drawCallback: function (data) {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        },
        "processing": true,
        "serverSide": true,
        "fixedHeader": true,
        "columnDefs":[{
            "sortable":false,
            "targets":[2,3]
        }],
        "order":[[4,"desc"]],
        "searchCols": [
            null,
            null,
            null,
            null,
            { "search": "today", "regex": true }
        ],

        initComplete: function (data) {
            var ThisDTFilterRight = $("#expensesTable_filter");
            var htmlRight = ' <label>\
                                <select class="form-control" onchange="filterData(this,4);">\
                                    <option value="today">Today</option>\
                                    <option value="month">Month</option>\
                                    <option value="all">All</option>\
                                </select>\
                        </label>';

            ThisDTFilterRight.append(htmlRight);

            // $(".zinc-date-search").datepicker({
            //     format: 'dd/mm/yyyy'
            // })
            // .on('changeDate', function(ev){
            //     console.log('date changed');
            //     getCustomFilter(this, 8);
            // });
        }
        
    });
});

function filterData(obj,columnNumber){
    expensesTable.columns(columnNumber).search($(obj).val()).draw(); 
}

var transactionTable;
$(function () {
    transactionTable = $('#transactionTable').DataTable({
        ajax: {
            url: 'controllers/dashboard.php?action=transction',
            error: function(response){
            }
        },
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Search"
        },

        drawCallback: function (data) {
            $('[data-toggle="popover"]').popover();
            $('[data-toggle="tooltip"]').tooltip();
        },
        "processing": true,
        "serverSide": true,
        "fixedHeader": true,
        "columnDefs":[{
            // "sortable":false,
            // "targets":[2,3]
        }],
        //"order":[[4,"desc"]],
        
    });
});
var loader = '<div class="spinner-border"></div>';
$('#transactionModal').on('show.bs.modal', function (event) {
    $('#transactionModal .modal-body').html(loader);
    var button = $(event.relatedTarget); 
    var userId = button.data('user'); 
    $.ajax({
        method: "GET",
        dataType: "json",
        data:{user_id:userId},
        url: "controllers/dashboard.php?action=transctionmodalbody",
        success: function (response) {
            $('#transactionModal .modal-body').html(response);
        },
        error: function (response) {
            showErrorToaster(response.responseJSON);
            if(response.status == 419 || response.status == 401){
                //window.location.href = "{{ route('login') }}";
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

function payAmount(btnObj) {
    var totalAmountToPay = parseFloat($('#payable-amount').text());
    console.log(totalAmountToPay);
    var amountToPayToEach = 0.00;
    $(".amount-to-pay-to-each").each(function() {
        amountToPayToEach += parseFloat($(this).text());
    });
    console.log(amountToPayToEach);

    var amountPaid = 0.00;
    $(".amount-paid").each(function() {
        if(!$(this).prop('disabled')){
            amountPaid += parseFloat($(this).val());
        }
    });
    console.log(amountPaid);

    if(amountPaid > totalAmountToPay){
        var message = 'Paid amount cannot be greater than Payable Amount';
        showErrorToaster(message);
        // Set 0 to all input fields
        $(".amount-paid").each(function() {
            $(this).val(0);
        });
    }
    
}   

