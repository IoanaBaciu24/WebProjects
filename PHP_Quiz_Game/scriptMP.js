var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


function createCookie(name, value, days) { 
    var expires; 
      
    if (days) { 
        var date = new Date(); 
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
        expires = "; expires=" + date.toGMTString(); 
    } 
    else { 
        expires = ""; 
    } 
      
    document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; path=/"; 
} 
function f1(testId){
    // alert(testId);
    // localStorage.setItem("testId", testId);
    // document.cookie = "testId=" + escape(testId) + "; path=/";
    createCookie("testId",testId, "10"); 
    window.location.href = "testPage.php";
}



window.addEventListener('load', function () {

    $(document).ready(function(){
        $("#score").on("click", function(){
            $.get(
                "someOps.php",
                {action: 'score'},
                function(obtained)
                {
                    alert(obtained);
                }
            );
        });

        $("#tests").on("click", function(){
            $.get(
                "someOps.php",
                {action: 'played'},
                function(obtained)
                {
                    alert(obtained);
                }
            );
        });
    });

});