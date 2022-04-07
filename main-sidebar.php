<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $_SESSION['image']; ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['fullname']; ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $_SESSION['position']=='Admin'?'Secretary':$_SESSION['position']; ?></a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
        <?php
        if($_SESSION['position'] == 'Admin'){ ?>
            <li <?php echo $active == 1 ?'class="active"':''; ?>>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
              </a>
            </li>
            <li <?php echo $active == 9 ?'class="active"':''; ?>>
              <a href="secretary.php">
                <i class="fa fa-users"></i> <span>Secretary</span> </i>
              </a>
            </li>
            <li <?php echo $active == 2 ?'class="active"':''; ?>>
              <a href="teacher.php">
                <i class="fa fa-user"></i> <span>Teachers</span> </i>
              </a>
            </li>
            <li <?php echo $active == 3 ?'class="active"':''; ?>>
              <a href="section.php">
                <i class="fa fa-dashboard"></i> <span>Section</span> </i>
              </a>
            </li>
            <li <?php echo $active == 6 ?'class="active"':''; ?>>
              <a href="subject.php">
                <i class="fa fa-folder"></i> <span>Subject</span> </i>
              </a>
            </li>
            <li <?php echo $active == 7 ?'class="active"':''; ?>>
              <a href="documents.php">
                <i class="fa fa-book"></i> <span>Documents</span> </i>
              </a>
            </li>
            <li <?php echo $active == 8 ?'class="active"':''; ?>>
              <a href="requestingfile.php">
                <i class="fa fa-files-o"></i> <span>Requesting Documents</span> </i>
              </a>
            </li>
        <?php
        }
        else if($_SESSION['position'] == 'Teacher'){ ?>
            <li <?php echo $active == 1 ?'class="active"':''; ?>>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
              </a>
            </li>
            <li <?php echo $active == 2 ?'class="active"':''; ?>>
              <a href="mystudentrequest.php">
                <i class="fa fa-file"></i> <span>Requesting Documents</span> </i>
              </a>
            </li>
            
            <li <?php echo $active == 3 ?'class="active treeview"':'class="treeview"'; ?>>
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Advisory</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
            <?php
            $advisory = $sqlClass->getAdvisory();
            foreach($advisory as $advicer){ ?>
                <li><a href="advicer.php?id=<?php echo $advicer['id']; ?>"><i class="fa fa-circle-o"></i> Grade <?php echo $advicer['gradeID']; ?>-<?php echo $advicer['sectionName'].' ('.$advicer['schoolYear']; ?>)</a></li>
            
            <?php
            } ?>
              </ul>
            </li>
            
        <?php
        } else { ?>
			
            <li <?php echo $active == 1 ?'class="active"':''; ?>>
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
              </a>
            </li>
			<li <?php echo $active == 3 ?'class="active treeview"':'class="treeview"'; ?>>
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Grades</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
            <?php
            $grades = $sqlClass->studentrecordhistory();
            foreach($grades as $grade){ ?>
                <li><a href="viewGrades.php?id=<?php echo $grade['id']; ?>&sectionID=<?php echo $grade['sectionID']; ?>&advicer=<?php echo $grade['fname'].' '.$grade['lname']; ?>"><i class="fa fa-circle-o"></i> Grade <?php echo $grade['gradeID']; ?>-<?php echo $grade['sectionName'].' ('.$grade['schoolYear']; ?>)</a></li>
            
            <?php
            } ?>
              </ul>
            </li>
            <li <?php echo $active == 2 ?'class="active"':''; ?>>
              <a href="requestfile.php">
                <i class="fa fa-file"></i> <span>Request Documents <span class="badge"><?php echo count($sqlClass->readytoPickup()); ?></span></span> </i>
              </a>
            </li>
		<?php
		} ?>
          </ul>
        </section>
        <!-- /.sidebar -->