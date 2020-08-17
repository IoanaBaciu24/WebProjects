<?php

    session_start();
    $id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root", "", "db1");
    //$db = mysqli_select_db($con, "db1");
    // $sql = "insert into grade (studentID, teacherID, grade_value, course) values('abab1221', 'prof1234', 10,'algebra')";
    // mysqli_query($con, $sql);
    //echo $sql;
    // echo $_POST['action'];
    // echo "here";
    // insert();
    // if(isset($_POST['action'])){

    //     switch ($_POST['action'])
    //     {
    //         case "insert":
    //             insert();
    //             break;
    //     }
    // }
   
    if($_POST['action'] == "insert"){
           
        $stid = $_POST['stid'];
        $course = $_POST['course'];
        $mark = $_POST['mark'];
        
        //$id = $_SESSION['id'];
        $sql = "insert into grade (studentID, teacherID, grade_value, course) values('$stid', '$id', '$mark','$course')";
        $query = mysqli_query($con, $sql);
        if($query){
            echo json_encode("Data Inserted Successfully");
            }
        else {
            echo json_encode('problem');
            }
        }
    if($_POST['action'] == "update")
    {
        $stid = $_POST['stid'];
        $course = $_POST['course'];
        $mark = $_POST['mark'];
        $grid = $_POST['grid'];
        //$id = $_SESSION['id'];
        //$sql = "insert into grade (studentID, teacherID, grade_value, course) values('$stid', 'prof1234', '$mark','$course')";
        $sql = "update grade set studentID = '$stid', teacherID = 'prof1234', grade_value = '$mark', course = '$course' where id = '$grid' ";
        $query = mysqli_query($con, $sql);
        if($query){
            echo json_encode("Data Updated Successfully");
            }
        else {
            echo json_encode('problem');
            }
        }

    if($_POST['action'] == "delete"){

        $grid = $_POST['grid'];
        $sql = "delete from grade where id = '$grid'";
        $query = mysqli_query($con, $sql);
        if($query){
            echo json_encode("Data Deleted Successfully");
            }
        else {
            echo json_encode('problem');
            }
        }

    
    
    
    
?>
