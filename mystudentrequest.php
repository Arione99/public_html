<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
 $documents = $sqlClass->getDocuments();
 
 if(isset($_POST['submit'])){
     $insertDocuments =$sqlClass->insertRequest($_POST);
        header("location:requestingfile.php");
 }
 
 if(isset($_GET['proccess'])){
     $deleteSubject =$sqlClass->cancelRequest($_GET['proccess'], 'Proccess');
        header("location:requestingfile.php");
 }
 
  if(isset($_POST['finish'])){
     $insertDocuments =$sqlClass->finishRequest($_POST);
        //header("location:requestingfile.php");
 }
 
 
 
 $active =2;
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
            Request Documents
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
                  <h3 class="box-title">Request List</h3>
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
								
                                <th>Student Name</th>
                                <th>Grade & Section</th>
                                <th>Documents</th>
                                <th>Reason</th>
                                <th>Date Request</th>
                                
                                <th>Date Release</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php
							$getRequest =$sqlClass->getAllRequestByMyStudent();
							foreach($getRequest as $no => $request){ ?>
							  <tr>
								<td><?php echo $no+1; ?></th>
                                <td><?php echo $request['fname'].' '.$request['mname'].' '.$request['lname']; ?></td>
                                <td><?php echo 'Grade '.$request['gradeID'].'~Section '.$request['sectionName']; ?></td>
                                <td><?php echo $request['file']; ?></td>
                                <td><?php echo $request['reason']; ?></th>
                                <td><?php echo $request['dateRequest']; ?></td>
                                
                                <td><?php echo $request['dateRelease']; ?></td>
                                <td><?php echo $request['status']; ?></a></td>
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
			<!-- left column -->
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
  </body>
</html>
