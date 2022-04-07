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
 
 $users =$sqlClass->getUser('Teacher');
 
 if(isset($_POST['gradeID'])){ 
    $insertSection = $sqlClass->insertSection($_POST);
        header("location:section.php");
 }

 if(isset($_POST['update'])){ 
    $updateSection = $sqlClass->updateSection($_POST);
        header("location:section.php");
 } 
 
  if(isset($_GET['delete'])){ 
    $updateSection = $sqlClass->deleteSection($_GET['delete']);
        header("location:section.php");
 }
$year = date("Y");
$schoolyear = ($year-1).'-'.$year;

if(isset($_POST['search'])){
    
    
    $schoolyear = $_POST['schoolyear'];
}
 
 $active =3;
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
            Section Settings
          </h1>
          <form method="post">
            <div class="row">
                <div class="form-group col-md-3">
                  <label for="exampleInputPassword1">Search school year</label>
                  <select type="text" class="form-control" name="schoolyear" required>
                    <?php
                    for($x=2021; $year>=$x; $x++){
                        $value = ($x-1).'-'.$x; ?>
                        <option <?php echo $value == $schoolyear ? 'selected': ''; ?>><?php echo $value; ?></option>
                    <?php
                    } ?>
                        
                        <option <?php echo $year.'-'.($year+1) == $schoolyear ? 'selected': ''; ?>><?php echo $year.'-'.($year+1); ?></option>
                              </select>
                </div>
                            
                <div class="form-group col-md-1"><br>
                  <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
          </form>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <?php
            foreach($grades as $grade){ 
               $sections = $sqlClass->getSection($grade['id'], $schoolyear); ?>
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Grade <?php echo $grade['grade']; ?> Year:(<?php echo $schoolyear; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-md-2">
                              <label for="exampleInputEmail1">Section</label>
                              <input type="number" class="form-control" name="section" placeholder="#" required>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="exampleInputPassword1">Section Name</label>
                              <input type="text" class="form-control" name="sectionName" required>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="exampleInputPassword1">School Year</label>
                              <input type="text" class="form-control" name="schoolYear" placeholder="yyyy-yyyy" required>
                            </div>
                            
                            <div class="form-group col-md-3">
                              <label for="exampleInputPassword1">Advicer</label>
                              <select type="text" class="form-control" name="advicer" required>
                                  <?php
                                  foreach($users as $user){ ?>
                                  <option value="<?php echo $user['id']; ?>"><?php echo $user['fname'].' '.$user['lname']; ?></option>
                                  <?php
                                  } ?>
                              </select>
                            </div>
                            <div class="form-group col-md-1"><br>
                              <button type="submit" name="gradeID" value="<?php echo $grade['id']; ?>" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    <table width="100%">
                        <tr>
                            <th>Section</th>
                            <th>Advicer</th>
                            <th>School Year</th>
                            <th>List of Student</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach($sections as $section){
							$studentInSection = $sqlClass->studentInSection($section['id']);
                        echo '
                        <tr>
                            <td>'.$section['sectionName'].'</td>
                            <td>'.$section['fname'].' '.$section['lname'].'</td>
                            <td>'.$section['schoolYear'].'</td>
                            <td><a href="student.php?id='.$section['id'].'">'.count($studentInSection).' Students</a></td>
                            <td><a data-toggle="modal" data-target="#myModal'.$section['id'].'" style="color:red"><i class="fa fa-fw fa-edit"></i></a>'; echo count($studentInSection) == 0 ? ' | <a href="section.php?delete='.$section['id'].'" style="color:red"><i class="fa fa-fw fa-trash"></i></a>' :''; echo '</td>
                        </tr>
                        <!-- The Modal -->
                          <div class="modal" id="myModal'.$section['id'].'">
                            <div class="modal-dialog">
                              <div class="modal-content">
                              
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h4 class="modal-title">Update</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                  <form method="post">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                          <label for="exampleInputEmail1">Section</label>
                                          <input type="number" class="form-control" name="section" value="'.$section['section'].'">
                                        </div>
                                        <div class="form-group col-md-3">
                                          <label for="exampleInputPassword1">Section Name</label>
                                          <input type="text" class="form-control" name="sectionName" value="'.$section['sectionName'].'">
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                          <label for="exampleInputPassword1">Advicer</label>
                                          <select type="text" class="form-control" name="advicer">';
                                              foreach($users as $user){ 
                                              echo '<option value="'.$user['id'].'"'; echo $user['id']==$section['advicer']? 'selected':''; echo '>'.$user['fname'].' '.$user['lname'].'</option>';
                                              }
                                        echo '
                                          </select>
                                        </div>
                                        <div class="form-group col-md-2"><br>
                                          <button type="submit" name="update" value="'.$section['id'].'" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                  </form>
                                </div>
                                
                              </div>
                            </div>
                          </div>';
                        }?>
                    </table>
                  </div><!-- /.box-body -->
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
