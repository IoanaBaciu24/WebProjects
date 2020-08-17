<?php

    $q = $_REQUEST["q"];

    $con = mysqli_connect('localhost', 'root');
    $db = mysqli_select_db($con, 'db1');
    $sql = "SELECT * FROM student where group_id = ".$q;
    $result = mysqli_query($con, $sql);

   $arr = array();
   $i = 0;

    while($row = mysqli_fetch_array($result))
    {
        //echo $row[0]," ", $row[1]," ", $row[2], "<br>";
        $aux = array(0=>$row[0], 1=>$row[1], 2=>$row[2]);
        $arr[$i] = $aux;
        $i = $i + 1;    
    }
    echo json_encode($arr);

    //echo "gata!!";
?> 
