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
    <head><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        body {background-color:#ffe6ff;}
            .pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  background-color: pink;   
}
#btn{
    background-color: #FFA07A; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  margin-top:10px;
  margin-left: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
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
#tbl {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
    }
    #tbl td, #tbl th {
  border: 1px solid #ddd;
  padding: 8px;
}


.pagination a:hover:not(.active) {background-color: #ddd;}


    #modif{
        display: flex;
        justify-content:space-evenly;
    }

    .btn{
    background-color: #FFA07A; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;

  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
    
    .dv1{
        background-color: #ffe6e6;
        font-family: Tahoma;
        color: #262626;
        padding-left: 20px;
        padding-right: 10px;
        padding-bottom: 15px;
        margin-left: 10px;
        margin-right: 10px;
        border-style: groove;
        border-color: #ffdacc ;
        border-radius: 10px;

    }

    #hello{
        font-family: Tahoma;
        color: #262626;
        margin-left: 15px;
    }


        </style>
    

<script>
           function funque()
           {
               console.log("a intrat in functie");
                var xmlhttp = new XMLHttpRequest();
                 xmlhttp.onreadystatechange = function(){
                     
                     if(this.readyState == 4 && this.status == 200)
                     {
                        var s = "";
                        var a;
                        var len;
                        var index = 0;
                        tbstr1 = "<table id = \"tbl\"><tr><th>Student ID</th><th>Student Name</th><th>Group</th></tr>";
                        tbstr2 = "</table>";
                        try{
                         a = JSON.parse(this.responseText);
                         len = a.length;}
                         catch(err){
                             console.log("caught an error");
                         }
                      
                        
                         var n = Math.min(index+4, len);
                         s+=tbstr1;
                        for(i = index;i<n;i++)
                        {
                            //s+= a[i];
                            //s+="<br>";
                            
                            s+="<tr>";
                            s+="<td>" + a[i][0] + "</td>"
                            s+="<td>" + a[i][1] + "</td>"
                            s+="<td>" + a[i][2] + "</td>"
                            s+="</tr>";
                            
                        }
                        s+=tbstr2;
                        index = 0;
                        document.getElementById("studs").innerHTML = s;
                        console.log(a);
                        console.log(typeof a);
                        $(document).ready(function(){
                            $("#back").click(function(){
                                    var ss = "";
                                    console.log(typeof index);
                                    if(Math.min(index, 0) == 0){
                                        console.log("aici");
                                        index = index - 4;

                                        n = Math.min(index + 4, len);
                                    ss+=tbstr1;
                                    for(i = index;i<n;i++)
                                    {
                                        // ss+= a[i];
                                        // ss+="<br>";
                                        ss+="<tr>";
                                        ss+="<td>" + a[i][0] + "</td>"
                                        ss+="<td>" + a[i][1] + "</td>"
                                        ss+="<td>" + a[i][2] + "</td>"
                                        ss+="</tr>";
                                    }
                                    ss+=tbstr2;
                                 
                                    if(ss!=""){
                                    document.getElementById("studs").innerHTML = ss;}}
                                    console.log(index);


                            });

                            $("#front").click(function(){
                                var s = "";
                                if(index < len)
                                {
                                    index = index + 4;
                                    n = Math.min(len, index + 4);
                                    s+=tbstr1;
                                    for(i = index;i<n;i++)
                                    {
                                        //s+= a[i];
                                        //s+="<br>";
                                        s+="<tr>";
                                        s+="<td>" + a[i][0] + "</td>"
                                        s+="<td>" + a[i][1] + "</td>"
                                        s+="<td>" + a[i][2] + "</td>"
                                        s+="</tr>";
                                    }
                                    
                                    s+=tbstr2;
                                    if(s!=""){
                                    document.getElementById("studs").innerHTML = s;}}
                                    console.log(index);
                            });
                        });

                     }
                
         

                    
                 };

                 var gr = document.getElementById("stgroup").value;
                 console.log("j jcwrrf -- " + gr);
                 xmlhttp.open("GET", "retrieveStudents.php?q=" + gr, true);
                     xmlhttp.send()
                     console.log(this.responseText);
                     console.log("miau");
           } 
          
        </script>


</head>
    <body>
        <h1 id = "hello">Hello, <?php        
                $result = mysqli_query($con, "select name from teacher where id='$id'");
                $row = mysqli_fetch_array($result);
                echo $row[0];
            ?></h1>

        <div id = "modif">
        <div id="assign" class = "dv1">
            <p class = "parag">To assign a grade to a student, fill the blank fields, then press submit</p>
            <label for = "studid">The unique id of the student: </label> 
            <input type = "text" id = "studid" name = "studid"><br><br>
            <label for = "courseid"> Course: </label>
            <input type = "text" id = "course" name = "course"><br><br>
            <label for = "mark">Choose the mark</label>
            <select id = "mark">
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
                <option value = "9">9</option>
                <option value = "10">10</option>
                
            </select>
            <br><br>
            <input type = "submit" id="asgngrbtn" class = "btn" value = "Destroy a future">

        </div>


        <div id="update" class = "dv1">
            <p class = "parag">To update the grade of a student, fill the blank fields, then press submit</p>
            <label for = "grid">The id of the grade: </label>
            <input type = "number" id = "grid" name = "grid" min = "1" max = "100000000"><br><br>
            <label for = "studid">The unique id of the student: </label> 
            <input type = "text" id = "studid" name = "studid"><br><br>
            <label for = "courseid"> Course: </label>
            <input type = "text" id = "course" name = "course"><br><br>
            <label for = "mark">Choose the mark</label>
            <select id = "mark">
                <option value = "1">1</option>
                <option value = "2">2</option>
                <option value = "3">3</option>
                <option value = "4">4</option>
                <option value = "5">5</option>
                <option value = "6">6</option>
                <option value = "7">7</option>
                <option value = "8">8</option>
                <option value = "9">9</option>
                <option value = "10">10</option>
                
            </select>
            <br><br>
            <input type = "submit" id="updtgrbtn"  class = "btn" value = "Update mark">

        </div>

        <div id = "delete" class = "dv1">
            <p class = "parag">To delete the grade of a student, fill the blank fields, then press submit</p>
            <label for = "grid">The id of the grade: </label>
            <input type = "number" id = "grid" name = "grid" min = "1" max = "100000000"><br><br>
            <input type = "submit" id="delgrbtn"  class = "btn" value = "Delete mark">

        </div>

        </div>
        <script>




            $(document).ready(function(){
                $("#asgngrbtn").click(function(){
                    var stid = $('#assign').find('input[name="studid"]').val();
                    var course = $('#assign').find('input[name="course"]').val();
                    var e = document.getElementById("mark");
                    var mark = e.options[e.selectedIndex].value;
                    var ajaxurl = "profOps.php";
                    console.log(stid);console.log(course);console.log(mark);
                  
                    $.ajax({
                        url:"./profOps.php",
                        type:"post",
                        data: {'stid': stid,
                            'course': course,
                            'mark': mark,
                            //'id': "prof1234",
                            'action': "insert"
                    },
                        success: function(data){
                	        alert(data);
                        }
                    });
                    
                });
                
                $("#updtgrbtn").click(function(){
                    var grid = $('#update').find('input[name="grid"]').val();
                    console.log(grid);
                    var stid = $('#update').find('input[name="studid"]').val();
                    var course = $('#update').find('input[name="course"]').val();
                    var e = document.getElementById("mark");
                    var mark = e.options[e.selectedIndex].value;
                    var ajaxurl = "profOps.php";
                    console.log(stid);console.log(course);console.log(mark);
                   
                    $.ajax({
                        url:"./profOps.php",
                        type:"post",
                        data: {
                            'grid': grid,
                            'stid': stid,
                            'course': course,
                            'mark': mark,
    
                            'action': "update"
                    },
                        success: function(data){
                	        alert(data);
                        }
                    });
                    
                });


                $("#delgrbtn").click(function(){
                    var grid = $('#delete').find('input[name="grid"]').val();
                    
                    var ajaxurl = "profOps.php";
                   
                    $.ajax({
                        url:"./profOps.php",
                        type:"post",
                        data: {
                            'grid': grid,
                            'action': "delete"
                    },
                        success: function(data){
                	        alert(data);
                        }
                    });
                    
                });

                
                 });



            

        </script>

<div class = "dv1">

<label for="stgroup">Write the group you want to see: </label>
<input type = "number" id = "stgroup" name = "stgroup" min = "1" max = "100000000">
<button onclick="funque()" id = "btn"> Get loaze </button>
</div>
                
<p id = "studs"></p>
                </table>
<div class="pagination">
<a href="#" id = "back">&laquo;</a>
<a href="#" id = "front">&raquo;</a>
</div>

    </body>

</html>