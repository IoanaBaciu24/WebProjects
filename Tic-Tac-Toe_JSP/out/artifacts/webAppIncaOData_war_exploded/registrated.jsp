<%@ page import="javaThingsForTheApp.User" %><%--
  Created by IntelliJ IDEA.
  User: papuci
  Date: 5/4/2020
  Time: 5:02 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Title</title>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax-utils.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
<p id="p0">
<%! User user; %>
<%  user = (User) session.getAttribute("user");
    if (user != null) {
        out.println("Welcome "+user.getUname());


%>
<p>
<p id = "p1">Wait untill another one registrates</p>
<div id = "table">



</div>

<script>
    var THEPLAYER = 0;
    function repeatLogged(){
        getLoggedBoyes(function (loggedB) {
            console.log(loggedB);
            if(loggedB['numberOfLoggedInUsers'] === 2)
            {
                document.getElementById("p1").innerHTML = "Now you can start playing!";
                clearTimeout(id);
                document.getElementById("table").innerHTML =
           // "<div class=\"row\"><button class=\"cell\" id = \"0\"></button><button class=\"cell\" id = \"1\"></button><button class=\"cell\" id = \"2\"></button></div> <div class=\"row\" ><button class=\"cell\" id = \"3\"></button><button class=\"cell\" id = \"4\"></button><button class=\"cell\" id = \"5\"></button></div><div class=\"row\" ><button class=\"cell\" id = \"6\"></button><button class=\"cell\" id = \"7\"></button><button class=\"cell\" id = \"8\"></button></div>";
                '<div class="row"><button class="cell" id = "0" ></button><button class="cell" id = "1"></button><button class="cell" id = "2"></button></div> <div class="row" ><button class="cell" id = "3"></button><button class="cell" id = "4"></button><button class="cell" id = "5"></button></div><div class="row" ><button class="cell" id = "6"></button><button class="cell" id = "7"></button><button class="cell" id = "8"></button></div>';
                <%User user; user = (User) session.getAttribute("user");%>
                var user = <%= "\"" + user.getUname() + "\""%>;
                console.log("the user is" + user);
                getPlayer(user, function (player) {
                    THEPLAYER = player["returnValue"];
                })
            }
        })
        var id = setTimeout(repeatLogged,2000);

    }
    function func(value, index, array) {
            var txt;
            if(+value === 0)
                txt = "";
            if (+value == 1)
                txt = "X";
            if (+value == -1)
                txt = "O";
            // console.log("the index is: ");
            // console.log(index);
            // console.log(index.toString());
            // console.log(document.getElementById("0"));
            // console.log(document.getElementById(index));
            console.log("value from function: " + typeof value);
            console.log("set value: " + txt);
            if(document.getElementById(index)!=null){
                console.log(document.getElementById(index.toString()));
                document.getElementById(index.toString()).innerHTML = txt;}
    }
    function updateTable(){
        checkStatus(function (result) {
            if(result["won"] === 0 && result["tie"] ===false){

            getTable(function (array) {
                console.log(array["returnValue"]);
                array["returnValue"].forEach(func)
            });}

            else{
                if(result["tie"] === true)
                {
                    alert("this is a tie!!");
                    clean("users");
                    window.location.replace("http://localhost:8080/webAppIncaOData_war_exploded/index.jsp");
                }
                else if(result["won"] === 1)
                {
                    alert("player X has won!");
                    clean("users");
                    window.location.replace("http://localhost:8080/webAppIncaOData_war_exploded/index.jsp");
                }
                else {alert("player O has won!");
                    clean("users");
                    window.location.replace("http://localhost:8080/webAppIncaOData_war_exploded/index.jsp");
                }

            }

        })

        setTimeout(updateTable, 5000);
    }
    $(document).ready(function(){


        // $(".cell").click(function () {
        //     console.log("ici i sha");
        //     var idofbtn = this.id;
        //     console.log(idofbtn);
        //     sendAMove(1,idofbtn, function (result) {
        //         if(result["returnValue"] === true)
        //             document.getElementById(idofbtn).innerText = "X";
        //
        //     });
        // });

        $(document).on('click', '.cell', function () {
                console.log("ici i sha");
                var idofbtn = this.id;
                console.log(idofbtn);

                getTurn(THEPLAYER, function (result) {
                    if(result["returnValue"]===true){
                    sendAMove(THEPLAYER,idofbtn, function (result) {});}
                    console.log("not your turn");
                })


        });

            setTimeout(repeatLogged,2000);
            setTimeout(updateTable, 2000);

    }
    )
</script>



<%}
else
    out.print("get out of my swamp");

%>
</body>
</html>
