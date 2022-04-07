

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Pandacaqui Elementary School</title>
    <link rel="stylesheet" href="css/teacher.css">
    <!--boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    

    <h3>Hello, <?php echo $user_data['user_name']; ?> 
Welcome to Pandacaqui Elemetary School web base system!</h3>
<a class = "bttn" href="logout.php">Log out</a>
   
    
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name">Teachers Dashboard</div>

            </div>
            <i id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="logout.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name" >Profile</span>
               <!-- <span class="tooltip">Dashboard</span> -->
            </a>
            </li>
            <li>
                <a href="logout.php">
                <i class='bx bx-message-rounded-dots' ></i>
                    <span class="links_name" >Message</span>
                
               <!-- <span class="tooltip">Dashboard</span> -->
            </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class='bx bxs-file-doc'></i>
                    <span class="links_name" >Documents</span>
          
               <!-- <span class="tooltip">Dashboard</span> -->
            </a>
            </li>
            <li>
                <a href="logout.php"> 
                <i class='bx bxs-bell-ring' ></i>
                    <span class="links_name" >Notifications</span>
          
               <!-- <span class="tooltip">Dashboard</span> -->
            </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out' ></i>
                    <span class="links_name" >Log out</span>
                
               <!-- <span class="tooltip">Dashboard</span> -->
               </a>
            </li>
        </ul>
    </div>
<center><div class = "grades">Update Student Info</div></center>

<center><div class = "docx">Grade level and sections</div></center>

<center><div class = "class">Add/Remove Student</div></center>

</body>
</html>
