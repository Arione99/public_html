<?php
session_start();
include("connection.php");
include("functions.php");

if($_SERVER ['REQUEST_METHOD'] == "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
{
    //read from database
    $query = "select * from users where user_name = '$user_name' limit 1";
    $result =  mysqli_query($con, $query);

    if($result)
    {
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['password'] === $password)
            {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: student.php");
                die;
            }
        }
    }
    echo "Wrong username or password!";
}else
{
    echo "please enter some valid information!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log In</title>
</head>
<body>
    <h1>Pandacaqui Elementary School</h1>
    
    <style type = "text/css">
        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: green;
            border: solid thin;
            font-family: 'Times New Roman', Times, serif;
        }

        #box{
        background-color: #78909C;
        margin: auto;
        width: 300px;
        padding: 20px;
        
        }

        h1{
            
         background-color:#78909C;
         border: solid green;
         font-weight:bold;
         text-align: center;
         font-size: 50px;
         font-family: 'Times New Roman', Times, serif;
         padding-bottom:50px;
         color:white;

        }

        body{
   
         background-image: url(Elem.jpg);
         background-repeat: no-repeat;
         background-size: 1400px;
         background-position: center;
         background-color: greenyellow;  

        }
        h4{
            color: white;
            text-align:center;
            padding-top: 100px;
        }

        form{
            color:white;
        }


        </style>
        

        <div id="box">
            <form method="post">
                <div style= "font-size: 20px; margin:10px; color: white;" >Log In</div>
                <td>Username:</td>
                <input id="text" type="text" name="user_name"><br><br>
                <td>Password:</td>
                <input id="text" type="password" name="password"><br><br></td>

                <input id="button" type="submit" value="Log In"><br><br>

            </form>
         </div>
         <h4>Copyright@2021</h4>
</body>
</html>