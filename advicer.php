<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
 $section = $_GET['id'];
 
 if(isset($_POST['position'])){
     $insertUser =$sqlClass->insertUser($_POST);
        header("location:advicer.php?id=$section");
 }
 
 if(isset($_GET['delete'])){
     $deleteSubject =$sqlClass->deleteUser($_GET['delete']);
        header("location:advicer.php?id=$section");
 }
 
 if(isset($_POST['updateGrade'])){
     $insertGrade =$sqlClass->insertGrade($_POST);
        header("location:advicer.php?id=$section");
 }
 
 $active =3;
 
 $year = date("Y");
 $schoolyear = $year.'-'.($year+1);
 
 $sectionInfo =$sqlClass->sectionInfo($section);
 $users =$sqlClass->studentInSection($section);
 $subjects =$sqlClass->getSubject($sectionInfo['gradeID'])
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
            <?php echo 'Grade '.$sectionInfo['gradeID'].' Section '.$sectionInfo['sectionName'].' ('.$sectionInfo['schoolYear'].')'; ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <!--div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">New Student Account</h3>
                  <small>Default password "123456"</small>
                </div>
                <form method="post">
                  <div class="box-body">
                      <input type="hidden" value="<?php echo $section; ?>" name="section" required>
                    <div class="form-group">
                      <label for="exampleInputPassword1">LRN</label>
                      <input type="text" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Middle Name</label>
                      <input type="text" class="form-control" name="mname" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input type="text" class="form-control" name="lname" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Birth Date</label>
                      <input type="date" class="form-control" name="bday" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Gender</label>
                      <select class="form-control" name="gender" required>
                          <option>Female</option>
                          <option>Male</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <textarea class="form-control" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" name="position" value="Student" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div><!--/.col (left) -->
            
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
                                <th>Action</th>
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
                                <td><a data-toggle="modal" data-target="#updateGrade<?php echo $user['mainID']; ?>" style="color:red"><i class="fa fa-fw fa-edit"></i></a></td>
                              </tr>
                              
                            <?php
                            } ?>
                            </tbody>
                          </table>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                  </div><!-- /.box-body -->

                </form>
                            <?php
                            foreach($users as $no => $user){ ?>
                                 <!-- Modal -->
                                <div class="modal fade" id="updateGrade<?php echo $user['mainID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document" style="width: 800px;">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="post">
                                        <table width="100%" class="table table-bordered">
											
                                            <tr>
                                                <th colspan="7">Name : <?php echo $user['fname'].' '.$user['mname'].' '.$user['lname']; ?></th>
                                            </tr>
											
                                            <tr>
                                                <th colspan="4">Grade : <?php echo $sectionInfo['gradeID']; ?></th>
                                                <th colspan="3">Section : <?php echo $sectionInfo['sectionName']; ?></th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2">LEARNING AREAS</th>
                                                <th colspan="4">Quarterly Rating</th>
                                                <th rowspan="2">Final Rating</th>
                                                <th rowspan="2">Remarks</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                            </tr>
                                            <?php
                                            foreach($subjects as $subject){ 
                                             $studentgradeS=$sqlClass->studentgradeS($user['mainID'], $subject['id']); ?>
                                            <tr>
                                                <td> <?php echo $subject['subject']; ?>
                                                <input type="hidden" name="id[]" value="<?php echo @$studentgradeS['id']; ?>">
                                                <input type="hidden" name="subjectID_[]" value="<?php echo $subject['id']; ?>"></td>
                                                <td><input style="width:45px" name="quarter1_[]" value="<?php echo @$studentgradeS['quarter1']; ?>"></td>
                                                <td><input style="width:45px" name="quarter2_[]" value="<?php echo @$studentgradeS['quarter2']; ?>"></td>
                                                <td><input style="width:45px" name="quarter3_[]" value="<?php echo @$studentgradeS['quarter3']; ?>"></td>
                                                <td><input style="width:45px" name="quarter4_[]" value="<?php echo @$studentgradeS['quarter4']; ?>"></td>
                                                <td><input name="final_[]" value="<?php echo @$studentgradeS['final']; ?>"></td>
                                                <td><input name="remarks_[]" value="<?php echo @$studentgradeS['remarks']; ?>"></td>
                                            </tr>
                                            <?php
                                            } ?>
                                        </table>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit"  name="updateGrade" value="<?php echo $user['mainID']; ?>" class="btn btn-primary">Save changes</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            <?php
                            } ?>
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
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
      });
    </script>
  </body>
</html>
