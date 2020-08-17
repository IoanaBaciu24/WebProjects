<html>

    <head><title>start screen</title></head>
    <style>
        body {background-color:#ffe6ff;}
            #div1{

                    display:flex;
                    flex-direction:column;
                    justify-content: center;
                    border-style: groove;
                    border-color: #ffdacc ;
                    margin-top: 100px;
                    margin-left: 230px;
                    padding-left:360px;
                    margin-right: 300px;
                    border-radius:10px;
                    background-color:   #ffe6e6;
                    
            }
            #p1{
                  font-family: "Tahoma";
                  font-size: 20px;  
                  margin-left : 30px;
                  color: #262626;
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
    </style>
    <body>
        <div id = "div1">
            <h4 id = "p1">Whomst are you?</h4><br><br>
            <p>
                <button onclick = "location.href = 'login.php'" id = "sbtn" type = "button" class = "btn">Student</button>
                <button onclick = "location.href = 'loginprof.php'" id = "pbtn" type = "button" class = "btn">Teacher</button></p>
            
        
            
        </div>
    </body>

</html>