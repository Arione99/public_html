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
        header("location:requestfile.php");
 }
 
 if(isset($_GET['cancel'])){
     $deleteSubject =$sqlClass->cancelRequest($_GET['cancel'], 'Cancel');
        header("location:requestfile.php");
 }
 
 $getRequest =$sqlClass->getRequest();
 
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
            <div class="col-md-4">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">New Requesting</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Date</label>
                      <input type="date" class="form-control" name="dateRequest" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Document</label>
                      <select class="form-control" name="file" required>
                        <?php
                        foreach($documents as $doc){
                        echo '<option>'.$doc['documents'].'</option>';
						} ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Reason</label>
                      <textarea type="text" class="form-control" name="reason" required></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" value="" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div><!-- /.box-body -->
                </form>
              </div><!-- /.box -->
            </div><!--/.col (left) -->
            
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">History List</h3>
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
                                <th>Documents</th>
                                <th>Reason</th>
                                <th>Date Request</th>
                                
                                <th>Date Release</th>
                                <th>Soft Copy</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php
							foreach($getRequest as $no => $request){ ?>
							  <tr>
								<td><?php echo $no+1; ?></th>
                                <td><?php echo $request['file']; ?></td>
                                <td><?php echo $request['reason']; ?></th>
                                <td><?php echo $request['dateRequest']; ?></td>
                                
                                <td><?php echo $request['dateRelease']; ?></td>
                                <td><?php echo $request['uploadfiles'] != NULL ? '<a href="'.$request['uploadfiles'].'" target=”_blank”>Open File</a>':''; ?></td>
                                <td title="Click to cancel"><?php echo $request['status'] == 'Pending' ?'<a href="requestfile.php?cancel='.$request['id'].'">'.$request['status'].'</a>':$request['status']; ?></a></td>
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
  </body>
</html>
