<?php

function compute_score($compl){
    $parts = explode(";", $compl);
    $numbers = explode(",",$parts[0]);

    $score = 0;
    for ($i=0;$i<count($numbers);$i++)
    {
        $score = $score + intval($numbers[$i]);
          
    }

    return $score;
}

function getPlayed($compl){
    $parts = explode(";", $compl);
    return $parts[1];
}


session_start();
 $userId = $_SESSION['uname'];
$con = mysqli_connect("localhost", "root", "", "somedb2");  

if($_GET['action'] == "score")
{
    $score = 0;
    $total = 0;

    $uname = mysqli_real_escape_string($con, stripcslashes($userId));
    $result = mysqli_query($con, "select * from users where user='$uname'");
    $row = mysqli_fetch_array($result);

    $compl = $row[2];

    echo compute_score($compl);

    

}
if($_GET['action'] == "played")
{
    $uname = mysqli_real_escape_string($con, stripcslashes($userId));
    $result = mysqli_query($con, "select * from users where user='$uname'");
    $row = mysqli_fetch_array($result);

    $compl = $row[2];

    echo getPlayed($compl);
}

?>