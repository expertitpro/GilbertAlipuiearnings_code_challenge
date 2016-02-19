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
</head>
<body class="body"> 
<?php

//include the controller class file
//this include file could also have a .inc extension 
function callController() {
    require_once('controller.php');
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{
  // do nothing. prevents caling the controller prematurely leading to division by zero!
 }else{
  // ensure the controller is only called on POST
  callController();
}    

// define variables and set to empty values
$nameErr = "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{    
   if (empty($_POST["name"])) 
   {
     $nameErr = "Search string is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed";
     }
   }
 }
   
function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//builds up the basic UI 
?>
  
<h1>Gilbert Alipui: Response to Teikametrics' Code Challenge - Salary Search</h1>
<p><span class="error">* required field.</span></p>
<!--form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"-->
<form method="post" action="<?php echo 'http://localhost/earnings_code_challenge/controller.php';?>">
   Search: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   
  <input type="submit" name="submit" value="Submit" class="btn">
</form>

<?php

?>
