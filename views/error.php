 <!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>Error <small>You are trying to access the page which is not found on server</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1> ERROR : - 404 </h1>
                    <span>(Page Not Found)</span>
                    <br><br><br>
                    <button type="button" id="back-page" class="btn btn-info">Go Back To Dashboard</button>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
    
<script type="text/javascript">
    $('#back-page').on('click',function(){
         var url = '/index.php';
        //var url = 'http://18.233.119.100/index.php?page=dashboard_page';

        window.location.href = url;
    });
</script>
</body>
</html>
 









    


   

