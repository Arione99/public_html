<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
  if(isset($_GET['default'])){
     $deleteSubject =$sqlClass->defaultUser($_GET['default']);
 }

 $active =3;
 
 $year = date("Y");
 $schoolyear = $year.'-'.($year+1);
 
 $users =$sqlClass->getUser('Student');
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
            All Student
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Student List</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                  <div class="box-body">
                    <div class="box">
                        <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>LRN</th>
                                <th>Name</th>
                                <th>Address</th>
                                
                                <th>Gender</th>
                                <th>B-day</th>
                                <th>Password</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($users as $no => $user){ ?>
                              <tr>
                                <td><?php echo $no+1; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['fname'].' '.$user['mname'].' '.$user['lname']; ?></td>
                                <td><?php echo $user['address']; ?></td>
                                <td><?php echo $user['gender']; ?></td>
                                <td><?php echo $user['bday']; ?></td>
                                <td><?php echo $user['password']=='e10adc3949ba59abbe56e057f20f883e'?'Default':'<a href="allstudent.php?default='.$user['id'].'" style="color:red" title="Default password 123456"><i class="fa fa-fw fa-retweet"></i></a>'; ?></td>
                                
                              </tr>
                              
                            <?php
                            } ?>
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
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
