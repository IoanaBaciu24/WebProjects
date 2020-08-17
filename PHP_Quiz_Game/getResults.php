<?php

// function computeScore($userId)
// {
//     return 0;
// }


function doTheString($compl, $lvl, $tname)
{
    $parts = explode(";", $compl);
    if(count($parts)==1)
    {
        $unos = $parts[0].','.$lvl;
        $dos = $tname;
        $res = $unos.";".$dos;
    }
    else{
        $unos = $parts[0].','.$lvl;
        $dos = $parts[1].','.$tname;
        $res = $unos.";".$dos;
    }

    return $res;
}


session_start();

$testId = $_COOKIE["testId"];
$con = mysqli_connect("localhost", "root");
$db = mysqli_select_db($con, "somedb2");
$result = mysqli_query($con, "select * from questions where testId= '$testId'");

$score = 0;
$total = 0;

while($row = mysqli_fetch_array($result))
{
   $q = $row[2];
   if($row[3]== $_GET[$q]){$score++;}
   $total++;
}

if($total == $score)
    {
        echo "yas";
        $uname = $_SESSION["uname"];
        $result = mysqli_query($con, "select * from users where user= '$uname'");
        $row = mysqli_fetch_array($result);
        $compl = $row[2];
        $result = mysqli_query($con, "select * from tests where id= '$testId'");
        $row = mysqli_fetch_array($result);
        $tname = $row[1];
        $lvl = $row[2];

        $newstr = doTheString($compl, $lvl, $tname);
        $result = mysqli_query($con, "update users set completedTests='$newstr' where user='$uname'");
        // $row = mysqli_fetch_array($result);



    }
    else {echo "nem";}

?>