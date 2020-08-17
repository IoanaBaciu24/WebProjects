

<html>
    <head>
    </head>
<body>

    <div id = "testQs">
    <?php 
         session_start();
         $testId = $_COOKIE["testId"];
         $con = mysqli_connect("localhost", "root");
         $db = mysqli_select_db($con, "somedb2");
         $result = mysqli_query($con, "select * from questions where testId= '$testId'");
         echo "<form action='getResults.php' action = 'post'>";
         while($row = mysqli_fetch_array($result))
        {
            echo "<p>".$row[2]."</p>";
            echo " <input type='radio' name='".$row[2]."' value='".$row[3]."'>";
            echo "<label for='correct'>".$row[3]."</label><br>";
            echo " <input type='radio' id='".$row[4]."' name='".$row[2]."' value='".$row[4]."'>";
            echo "<label for='wrong'>".$row[4]."</label><br>";
        }
        echo "  <input type='submit' value='Submit'></form>";
    
    ?>
    </div> 

</body>

</html>