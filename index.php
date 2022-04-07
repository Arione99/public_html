<?php
 include_once "connection/connection.php";
 
 include_once "connection/userClass.php";
 $userClass = new User();
 
    if (@$_GET['logout'] == 'true'){
        $userClass->userLogout();
    }
    if ($userClass->getSession()==0){
        header("location:login.php");
	}
	 
 include_once "connection/sqlClass.php";
 $sqlClass = new SQL();
 
 $grades = $sqlClass->grade();
 $year = date("Y");
 $schoolyear = ($year-1).'-'.$year;
 
 if(isset($_POST['send'])){
	 
     $insertAnnouncement =$sqlClass->insertAnnouncement($_POST);
        header("location:index.php");
 }
 
 
 if(isset($_GET['delete'])){
     $deleteAnnouncement =$sqlClass->deleteAnnouncement($_GET['delete']);
        header("location:index.php");
 }

 $active =1;
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
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php $sections = 0; foreach($grades as $grade){ 
                        $sections += count($sqlClass->getSection($grade['id'], $schoolyear)); } echo $sections; ?></h3>
                  <p>All Section</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                        
                <?php
                if($_SESSION['position'] == 'Admin'){ ?>
                <a href="section.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                } ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo count($sqlClass->getUser('Teacher')); ?></h3>
                  <p>All Teacher</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                       
                <?php
                if($_SESSION['position'] == 'Admin'){ ?>
                <a href="teacher.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                } ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo count($sqlClass->getUser('Student')); ?></h3>
                  <p>All Student</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                       
                <?php
                if($_SESSION['position'] == 'Admin'){ ?>
                <a href="allstudent.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                } ?>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo count($sqlClass->getAllRequest('Pending')); ?></h3>
                  <p>Pending Request</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>   
                <?php
                if($_SESSION['position'] == 'Admin'){ ?>
                <a href="requestingfile.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                <?php
                } ?>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
			
            <?php
            if($_SESSION['position'] == 'Admin'){ ?>
            <section class="col-lg-6 connectedSortable">
              
              <!-- quick email widget -->
              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Post Announcement</h3>
                  <!-- tools box -->
                </div>
				
                <form method="post">
					<div class="box-body">
						<div class="form-group">
						  <select class="form-control" name="announcementTo">
							<option value="1">To All</option>
							<option value="2">To Teachers</option>
							<option value="3">To Student/Guardian</option>
						  </select>
						</div>
						<div class="form-group">
						  <input type="text" class="form-control" name="subject" placeholder="Subject"/>
						</div>
						<div>
						  <textarea class="textarea" placeholder="Message" name="message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
						</div>
					</div>
					<div class="box-footer clearfix">
					  <button type="submit" class="pull-right btn btn-default" name="send">Send <i class="fa fa-arrow-circle-right"></i></button>
					</div>
                </form>
              </div>

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-6 connectedSortable">
			<!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Announcement List</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
				  <?php
				  $getAnnouncement =$sqlClass->getAnnouncement();
				  foreach($getAnnouncement as $announcement){ ?>
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- todo text -->
                      <span class="text"><?php echo $announcement['subject']; ?></span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo date('M d H:i', strtotime($announcement['dateTime'])); ?></small><br>
                      <span><?php echo $announcement['message']; ?></span>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <a href="index.php?delete=<?php echo $announcement['id']; ?>"><i class="fa fa-trash-o"></i></a>
                      </div>
                    </li>
				  <?php
				  } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- right col -->
			<?php
			} else { ?>
			            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-12 connectedSortable">
			<!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Announcement List</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                  <ul class="todo-list">
				  <?php
				  $getAnnouncement =$sqlClass->getAnnouncement();
				  foreach($getAnnouncement as $announcement){ ?>
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- todo text -->
                      <span class="text"><?php echo $announcement['subject']; ?></span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo date('M d H:i', strtotime($announcement['dateTime'])); ?></small><br>
                      <span><?php echo $announcement['message']; ?></span>
                      <!-- General tools such as edit or delete-->
                    
                    </li>
				  <?php
				  } ?>
                    
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- right col -->
			<?php
			} ?>
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; <?php echo date('Y'); ?> Pandacaqui Elementary School</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>
  </body>
</html>