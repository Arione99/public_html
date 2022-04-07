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
        //save to database
        $user_id = random_num(10);
        $query = "insert into users (user_id, user_name, password) values ('$user_id', '$user_name', '$password')";
        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    }else
        {
        echo "please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<h1>Pandacaqui Elementary School</h1>
    

        <div id="box">
            <form method="post">
                <div style= "font-size: 20px; margin:10px; color: white;" >Sign Up</div>
                <td>Username:</td>
                <input id="text" type="text" name="user_name"><br><br>
                <td>Password:</td>
                <input id="text" type="password" name="password"><br><br>

                <input id="button" type="submit" value="Sign Up"><br><br>

                <a href="login.php">Click to Log In</a><br><br>

            </form>
         </div>
         <h4>Copyright@2021</h4>
</body>
</html>