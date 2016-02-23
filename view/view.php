<?php
//this is view.php and it calls controller/call-ajax-controller.php which in turn calls ../model/model.php
?>
<!DOCTYPE HTML>
<html>
<head>
<style>

.error {color: #FF0000;}   /* to color the required fields asterisk red */ 

body { background: #D1F1FF !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */

.btn {color: #002EB8 !important;} 

.btn:focus { background-color: #E5FFFF;}

.btn:hover{ background-color: #2AD100 !important;}

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   
</style>

   <body class="body">
      
      <!-- Copy-and-paste ajax code from http://www.tutorialspoint.com/php/php_and_ajax.htm -->
      <script language = "javascript" type = "text/javascript">
         // Javascript validation to prevent empty textfield from being submitted
         function checkvalue() { 
		 var mystring = document.getElementById('name').value; 
		 if(!mystring.match(/\S/)) {
			 alert ('Empty value is not allowed');
			 return false;
		  } else {
			 //alert("correct input");
			 return true;
		  }
		}

         <!--
            //Browser Support Code
            function ajaxFunction(){
               var ajaxRequest;  // The variable that makes Ajax possible!
               
               try {
                  // Opera 8.0+, Firefox, Safari
                  ajaxRequest = new XMLHttpRequest();
               }catch (e) {
                  // Internet Explorer Browsers
                  try {
                     ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                  }catch (e) {
                     try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                     }catch (e){
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                     }
                  }
               }
               
               // Create a function that will receive data 
               // sent from the server and will update
               // div section in the same page.
					
               ajaxRequest.onreadystatechange = function(){
                  if(ajaxRequest.readyState == 4){
                     var ajaxDisplay = document.getElementById('ajaxDiv');
                     ajaxDisplay.innerHTML = ajaxRequest.responseText;
                  }
               }
               
               // Now get the value from user and pass it to
               // server script.
					
               var name = document.getElementById('name').value;
               var queryString = "?name=" + name ;
            
               ajaxRequest.open("GET", "../controller/call-ajax-controller.php" + queryString, true);
               ajaxRequest.send(null); 
            }
         //-->
      </script>
		
      <h1>Gilbert Alipui: Response to Teikametrics' Code Challenge - Salary Search</h1>
      <h2> Enter a position like, teacher to view a teacher's average salary</h2>
      <p>
      <form name = 'myform'>
          Search for Position: <input type = 'text' id = 'name' onblur='checkvalue()' autofocus/> <span class="error"> * required field.</span><br />
        <input type = 'button' onclick = 'ajaxFunction()' value='Submit' class='btn' >
        <p>
      </form>
			     
      <div id = 'ajaxDiv'>Your result will display here</div>
   </body>
</html>