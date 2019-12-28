
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
  

