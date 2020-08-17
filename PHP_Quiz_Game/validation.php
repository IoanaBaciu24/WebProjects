<?php 

    $uname = $_POST['uname'];
    $passw = $_POST['passw'];


    $con = mysqli_connect("localhost", "root");
    $db = mysqli_select_db($con, "somedb2");

    $uname = mysqli_real_escape_string($con, stripcslashes($uname));
    $passw = mysqli_real_escape_string($con, stripcslashes($passw));

    $result = mysqli_query($con, "select * from users where user='$uname' and passw='$passw'");

    $row = mysqli_fetch_array($result);
    // echo($uname);
    // echo($passw);
    // echo($row);   
    if($row == null)
    {
        echo "login failure"; 
    }
    else{
        if(strcmp($row[0],$uname) + strcmp($row[1],$passw) == 0)
        {
            session_start();
            $_SESSION['uname'] = $row[0];
            $_SESSION['completedLevels'] = $row[2];
            header("Location: mainPG.php");
            exit;
            // echo("yas");
        }
        else {
            echo "login failure";
        }
        }

?>