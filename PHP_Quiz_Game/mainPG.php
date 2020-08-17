<?php

    function compute_level($compl){
        $parts = explode(";", $compl);
        $numbers = explode(",",$parts[0]);

        $max = 0;
        for ($i=0;$i<count($numbers);$i++)
        {
            if($max<intval($numbers[$i]))
                {
                    $max = intval($numbers[$i]);
                }
        }

        return $max + 1;
    }
?>


<html>

<head>
<script src="scriptMP.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
</head>
<body>

    <h1>WELCOME TO MY SWAMP</h1>
<!-- <form method = "post" action= "testPage.php"> -->
    <div id = "available tests">
    <?php
        session_start();
        $uname = $_SESSION["uname"];
        $con = mysqli_connect("localhost", "root");
        $db = mysqli_select_db($con, "somedb2");
        $uname = mysqli_real_escape_string($con, stripcslashes($uname));
        $result = mysqli_query($con, "select * from users where user='$uname'");
        $row = mysqli_fetch_array($result);
      
        $lvl = compute_level($row[2]);
        $result = mysqli_query($con, "select * from tests where level<=$lvl");

        while($row = mysqli_fetch_array($result))
        {
        
            echo "<button onclick = 'f1(".$row[0].")' id = '".$row[0]."'>".$row[1]." has level: ".$row[2]."</button><br>"; 
            // echo "<input type = 'submit' >"
        }


    ?>
    </div>
<!-- </form> -->
<button id = "score">Score</button>
<button id = "tests">See completed tests</button>

</body>
</html>