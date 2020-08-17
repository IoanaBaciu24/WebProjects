<!DOCTYPE html>

<html>

<head>

<style>
    body {background-color:#ffe6ff;}
      #form{

display:flex;
flex-direction:column;
justify-content: center;
border-style: groove;
border-color: #ffdacc ;
margin-top: 100px;
margin-left: 230px;
padding-left:360px;
margin-right: 300px;
border-radius: 10px;
background-color:   #ffe6e6;
}
#t1{
    font-family: "Tahoma";
    
    color: #262626;

}
.lab{
    font-family: "Tahoma";
    
    color: #262626;
}
#btn{
    background-color: #FFA07A; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  margin-left: 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
#bby{

    width: 170px;
}
#bbydiv{
    margin-left: 1300px;
    margin-top: 200px;
}
</style>

</head>

<body>
    
    <div id = "form">
    <h2 id = "t1">Login page</h2>
        <form action = "validation.php" method = "POST">
            <p>
                <label class = "lab">Username: </label>
                <input type = "text" id = "id" name = "id">

            </p>
            <p>
                <label class = "lab">Password: </label>
                <input type = "password" id = "passw" name = "passw">
                
            </p>
            <p>
        
                <input type = "submit" id = "btn" value = "Login">
                
            </p>
            </form>
    </div>
    <div id = "bbydiv">
    <img src = "bby.png" id = "bby">
    <div>
</body>
</html>