<%@ page import="java.util.Date" %><%--
  Created by IntelliJ IDEA.
  User: papuci
  Date: 5/3/2020
  Time: 9:50 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>X & 0</title>
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/ajax-utils.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">

  </head>
  <body>
  <h1>Welcome to tic-tac-toe!</h1>
  <button onclick="funque()">Take me to login!</button>
  <script>
    function funque() {
      clean("table");
      window.location.replace("http://localhost:8080/webAppIncaOData_war_exploded/login.jsp");
    }
  </script>
  </body>
</html>
