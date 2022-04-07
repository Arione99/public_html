<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
 $grades = $sqlClass->grade();
 
 if(isset($_POST['gradeID'])){
     $insertSubject =$sqlClass->insertSubject($_POST);
        header("location:subject.php");
 }
 
 if(isset($_GET['delete'])){
     $deleteSubject =$sqlClass->deleteSubject($_GET['delete']);
        header("location:subject.php");
 }
 
 $active =6;
?>
<!DOCTYPE html>
<html>
  <head>
      <?php include_once "head.php"; ?>
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
            Subject Settings
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <?php
            foreach($grades as $grade){ 
                $subjects = $sqlClass->getSubject($grade['id']); ?>
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Grade <?php echo $grade['grade']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                  <div class="box-body">
                    <div class="row">
                        
                        <div class="form-group col-md-6">
                          <label for="exampleInputPassword1">Subject Name</label>
                          <input type="text" class="form-control" name="subject">
                        </div>
                        <div class="form-group col-md-6">
                            <br>
                            <button type="submit" name="gradeID" value="<?php echo $grade['id']; ?>" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <table width="100%">
                        <tr>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach($subjects as $subject){
                        echo '
                        <tr>
                            <td>'.$subject['subject'].'</td>
                            <td><a href="subject.php?delete='.$subject['id'].'" style="color:red"><i class="fa fa-fw fa-trash-o"></i></a></td>
                        </tr>'; 
                        }?>
                    </table>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            <?php
            } ?>
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
  </body>
</html>
