<?php

    $id = $_POST['id'];
    $passw = $_POST['passw'];

    $con = mysqli_connect("localhost", "root");
    $db = mysqli_select_db($con, "db1");

    $id = mysqli_real_escape_string($con, stripcslashes($id));
    $passw = mysqli_real_escape_string($con, stripcslashes($passw));

  

    $result = mysqli_query($con, "select * from teacher where id='$id' and passw='$passw'");
    //or die("failed to query db".mysql_error());

    $row = mysqli_fetch_array($result);
   
    if($row == null)
    {
        echo "login failure"; 
    }

    else{
    if(strcmp($row[0],$id) + strcmp($row[2],$passw) == 0)
    {
        session_start();
        $_SESSION['id'] = $id;
        header("Location: pageForProf.php");
        exit;
    }
    else {
        echo "login failure";
    }
    }
?>