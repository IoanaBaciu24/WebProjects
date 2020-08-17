<?php

    //session_start();
    //$id = $_SESSION['id'];
    //echo $id;

    session_start();
    $id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root");
    $db = mysqli_select_db($con, "db1");
?>

<html>
    <head>
        <style>
body {background-color:#ffe6ff;}
    #tbl {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
    }
    #tbl td, #tbl th {
  border: 1px solid #ddd;
  padding: 8px;
}

#hello{
        font-family: Tahoma;
        color: #262626;
        margin-left: 15px;
    }
#tbl tr:nth-child(even){background-color: #f2f2f2;}

#tbl tr:hover {background-color: #ddd;}
#tbl th {
  padding-top: 12px;
  padding-left: 10px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #FFA07A;
  color: white;
}


            </style>
    </head>
    <body>
        <h1 id = "hello">Hello, 
            <?php        
                $result = mysqli_query($con, "select name from student where id='$id'");
                $row = mysqli_fetch_array($result);
                echo $row[0];
            ?></h1>

<div id = "grades">
    <table id = "tbl">
        <tr>
            <th>id</th>
            <th>teacher id</th>
            <th>given mark</th>
            <th>course</th>
        </tr>
    <?php
        $result = mysqli_query($con, "select * from grade where studentID='$id' order by course");
        
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            //echo $row[0]," ", $row[2]," ", $row[3]," ",$row[4], "<br>";
            echo "<td>".$row[0]."</td>";
            echo "<td>".$row[2]."</td>";
            echo "<td>".$row[3]."</td>";
            echo "<td>".$row[4]."</td>";
            echo "<tr>";
        }
    ?>
    <div>
    
</div>


    </body>
</html>