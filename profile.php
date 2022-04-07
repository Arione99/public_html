<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
 $profile =$userClass->getData($_SESSION['id']);
 
 if(isset($_POST['update'])){
	
	$target_dir = "images/profile/" . strtotime(date('Y-m-d H:i:s'));
	$target_file = $target_dir .  basename($_FILES["image"]["name"]);
	
	if($target_dir != $target_file){
		//no image
		$_POST['image'] = $target_file;
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			$updateUser =$sqlClass->updateUser($_POST);
		} else {
			echo "<script>alert('Sorry, there was an error uploading your profile.');</script>";
		}
	} else {
		//with image
		$_POST['image'] = $_POST['image_old'];
		$updateUser =$sqlClass->updateUser($_POST);
	}
}

if(isset($_POST['updatePassword'])){
	
	$oldPassword = md5($_POST['oldPassword']);
	$password = md5($_POST['newPassword']);
	
	if($oldPassword != $profile['password']){
		
		echo "<script>alert('Sorry, old password was not match.');</script>";
	} else {
		$updatePassword =$sqlClass->updatePassword($password);
		echo "<script>alert('Successfully change password.');</script>";
	}
}
 
 $active =0;
 
 
?>
<!DOCTYPE html>
<html>
  <head>
      <?php include_once "head.php"; ?>
      <link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <?php include_once "navbar.php"; ?>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once "main-sidebar.php"; ?>
      </aside>
      
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile Settings
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-7">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Personal Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                  <div class="box-body">
					<div class="form-group">
                      <label for="exampleInputPassword1">Profile Picture</label>
                      <input type="file" class="form-control" name="image">
					  <input type="hidden" class="form-control" name="image_old" value="<?php echo $profile['image']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="email" class="form-control" name="email" value="<?php echo $profile['email']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input type="text" class="form-control" name="fname" value="<?php echo $profile['fname']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Middle Name</label>
                      <input type="text" class="form-control" name="mname" value="<?php echo $profile['mname']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input type="text" class="form-control" name="lname" value="<?php echo $profile['lname']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Birth Date</label>
                      <input type="date" class="form-control" name="bday" value="<?php echo $profile['bday']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Gender</label>
                      <select class="form-control" name="gender" required>
                          <option <?php echo $profile['gender']=='Female'?'selected':''; ?>>Female</option>
                          <option <?php echo $profile['gender']=='Female'?'selected':''; ?>>Male</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <textarea class="form-control" name="address" required><?php echo $profile['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                    </div>
                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            
            <div class="col-md-5">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Change Password</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                  <div class="box-body">
					<div class="form-group">
                      <label for="exampleInputPassword1">Old Password</label>
                      <input type="password" class="form-control" name="oldPassword" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" class="form-control" name="newPassword" required>
                    </div>
					
                    <div class="form-group">
                        <br>
                        <button type="submit" name="updatePassword" class="btn btn-primary">Update Password</button>
                    </div>
                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <!-- right column -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y'); ?> Pandacaqui Elementary School</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
      });
    </script>
  </body>
</html>
