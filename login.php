<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
 	if ($userClass->getSession() == true){
        header("location:index.php");
	}

    $errors = array();
    
    if (isset($_POST['signin'])){
    
      extract($_POST);
      if(empty($email) || empty($password)) {
        if($email == "") {
          $errors[] = "Username is required";
        }
    
        if($password == "") {
          $errors[] = "Password is required";
        }
      } else {
        $login = $userClass->checkLogin($email, $password);
        if ($login) {
          // Login Success
    	  
           header("location:index.php");
    	  
        } else {
          // Login Failed
          $errors[] = 'Wrong username or password';
        }
      }
    }
 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Log in | Pandacaqui Elementary School</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="images/logoschool.png">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>
        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" name="email" class="form-control" placeholder="Email or LRN"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">   
            <?php
            foreach($errors as $error){
                echo '<strong>Error!</strong> '.$error.'<br>';
            } ?>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin">Log in</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>