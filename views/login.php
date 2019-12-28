<?php 
    session_start();
    if(isset($_SESSION["auth"])){
        header("Location: ../index.php?page=dashboard");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expenses</title>
        <script src="../assets/jquery.min.js"></script>
        <link rel="stylesheet" href="../assets/bootstrap.min.css">
        <script src="../assets/popper.min.js"></script>
        <script src="../assets/bootstrap.min.js"></script>

    </head>
    <body>
      <div class="col-md-6 offset-md-3 col-sm-12" style="margin-top: 100px;">
        <div class="jumbotron" style="padding: 2rem 4rem !important;">
            <?php if(isset($_SESSION['error'])): ?>
            <div class="toast toast-error show" data-autohide="false" style="max-width: 100%;background: #ca2d22d4;color: #ffffff;">
                <div class="toast-body" style="text-align: center !important;">
                    <span> <?= $_SESSION['error'] ?></span>
                    <!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button> -->
                </div>
            </div>
            <?php endif; ?>
            <form action="../controllers/login.php" method="POST">
                <div class="row">
                    <h1 class="col-md-6 offset-md-4 col-sm-12">Sign In</h1>
                </div>
                <br>
                <div class="row">
                    <label class="col-md-4">Email Id</label>
                    <input type="email" class="form-control col-md-6 col-sm-10" name="email" value="shakir@gmail.com" placeholder="Username" required="" />
                </div>
                <br>
                <div class="row">
                    <label class="col-md-4">Password</label>
                    <input type="password" class="form-control col-md-6 col-sm-10" name="password" value="shakir@123" placeholder="Password" required="" />
                </div>
                <br>

                <div class="row">
                    <button class="btn btn-block btn-primary col-md-6 offset-md-4 col-sm-10" type="submit">Log in</button>
                </div>
            </form> 
        </div>
        <script type="text/javascript">
            // $('.close').click(function(){
            //     $(this).parent().parent().removeClass('show');
            // })
        </script>
    </body>
</html>
