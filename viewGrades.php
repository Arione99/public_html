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
 
 
 $sectionInfo =$sqlClass->sectionInfo($_GET['sectionID']);
 $users =$sqlClass->studentInSection($section);
 $subjects =$sqlClass->getSubject($sectionInfo['gradeID']);
 $userInfo = $userClass->getData($_SESSION['id']);
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
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post">
                  <div class="box-body">
                      
                        <a href="javascript:void(0);" onclick="printPageArea('printableArea')">Print</a>
                    <div class="box">
                        <div class="box-body" id="printableArea">
                            <table width="100%">
                                <tr>
                                    <td style="text-align:right"><img src="images/logo1.JPG"></td>
                                    <td>
                                        <center>
                                            Republic of the Philippines<br>
                                            <strong style="font-size:18px">DEPARTMENT OF EDUCATION</strong><br>
                                            Region III<br>
                                            <strong style="font-size:18px">DIVISION OF PAMPANGA</strong><br>
                                            Mexico North District<br>
                                            <strong style="font-size:18px">PANDACAQUI ELEMENTARY SCHOOL</strong><br>
                                            <strong style="font-size:18px">PROGRESS REPORT CARD</strong><br>
                                            <strong style="font-size:18px">SY:<?php echo $sectionInfo['schoolYear']; ?></strong><br>
                                      </center>
                                    </td>
                                    <td><img src="images/logo2.JPG"></td>
                                </tr>
                            </table>
                            <table width="100%">
    							<tr>
                                    <td colspan="3"><strong style="font-size:18px">Name : <?php echo $_SESSION['fullname']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td><strong style="font-size:18px">Age : <?php $dateOfBirth = $userInfo['bday'];
                                            $today = substr($sectionInfo['schoolYear'],0,4).'-01-01';
                                            $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                            echo $diff->format('%y'); ?></strong></td>
                                    <td><strong style="font-size:18px">Birth Day : <?php echo date('F d, Y', strtotime($userInfo['bday'])); ?></strong></td>
                                    <td><strong style="font-size:18px">LRN : <?php echo $userInfo['email']; ?></strong></td>
                                </tr>
    							<tr>
                                    <td colspan="3"><strong style="font-size:18px">Advicer : <?php echo $_GET['advicer']; ?></strong></td>
                                </tr>
    							<tr>
                                    <td colspan="3"><strong style="font-size:18px">Grade & Section : <?php echo $sectionInfo['gradeID']; ?> - <?php echo $sectionInfo['sectionName']; ?></strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                    <br><i>Dear Parent:<br>
                                    This report card shows the ability and progress your child has made
                                    in the different learning areas as well as his/her core values.<br>
                                    The school welcomes you should you desire to know more about
                                    your child's progress.</i>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th colspan="3" style="text-align:center;">
                                    <br><strong style="font-size:18px">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</strong>
                                    </th>
                                </tr>
                            </table>
                            <br><br>
                            <table width="100%" class="table table-bordered">
                                    <tr>
                                        <th rowspan="2" style="background-color: #ffedd5;">LEARNING AREAS</th>
                                        <th colspan="4" style="background-color: #ffedd5;">Quarterly Rating</th>
                                        <th rowspan="2" style="background-color: #ffedd5;">Final Rating</th>
                                        <th rowspan="2" style="background-color: #ffedd5;">Remarks</th>
                                    </tr>
    								<tr>
    									<th style="background-color: #ffedd5;">1</th>
    									<th style="background-color: #ffedd5;">2</th>
    									<th style="background-color: #ffedd5;">3</th>
    									<th style="background-color: #ffedd5;">4</th>
    								</tr>
                                            <?php
                                            foreach($subjects as $subject){ 
                                             $studentgradeS=$sqlClass->studentgradeS($_GET['id'], $subject['id']); ?>
                                            <tr>
                                                <td><?php echo $subject['subject']; ?></td>
                                                <td><?php echo @$studentgradeS['quarter1']; ?></td>
                                                <td><?php echo @$studentgradeS['quarter2']; ?></td>
                                                <td><?php echo @$studentgradeS['quarter3']; ?></td>
                                                <td><?php echo @$studentgradeS['quarter4']; ?></td>
                                                <td><?php echo @$studentgradeS['final']; ?></td>
                                                <td><?php echo @$studentgradeS['remarks']; ?></td>
                                            </tr>
                                            <?php
                                            } ?>
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
      function printPageArea(areaID){
        var printContent = document.getElementById(areaID);
        var WinPrint = window.open('', '', 'width=900,height=650');
        WinPrint.document.write(printContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
    </script>
  </body>
</html>
