<?php
//this file is call-ajax-controller.php.  It is called by view.php

 // prints currency in the international format for the en_US locale
 setlocale(LC_MONETARY, 'en_US');
 
//after echoing back from here
//try calling the model and try to get the model to echo back information


class ControllerClass {

    // initialize the variables/properties
    private $response;
    private $url = "http://localhost/earnings_code_challenge/view.php";

    //the constructor    
    public function __construct() {}

    public function getAverageSalary()
    {
		 $totalrows = 0;
		 $sum = 0;
		 
        // I am using javascript to validate on the client side, but I am validating on the server side too just in case		   
	    if (empty($_GET["name"])) 
	    {
		  echo "Search string is required";
		  return false;
	    }else{
	      $name = test_input($_GET["name"]);
	      if (preg_match("/^[a-zA-Z ]*$/",$name)) {
		      echo "The search string is O.K. Look here for the results <br>";
		      //exit;
		  }else{
		    echo "Only letters and white space allowed";
		    exit;
		  }
	    }
		 
		// again, I could have used curl to get the JSON data, but just keeping it simple
        $this->response = file_get_contents('https://data.cityofboston.gov/resource/4swk-wcg8.json');
  		$this->response = json_decode($this->response);
  		
  		// now, this just loops through the returned object 
		foreach($this->response as $num => &$values) 
		{	
		   // gets the object properties
		   $thevals = get_object_vars($values);   	   
		   
		   // assign property values to variables
		   $searchstring = $_GET['name']; 	   
		   $mystring1 = $thevals['title']; 
		   $mystring2 = $thevals['title']; 

		   $pos1 = stripos($mystring2, $searchstring);
   
			// Note our use of ===.  Simply == would not work as expected
			// because the positional issues of the 0th (first) character per api documentation. 
			if ($pos1 !== false) 
			{
			  echo "Found '$searchstring' in '$mystring2' ==> $". $thevals['total_earnings'] . "<br>";
			  $totalrows++;
			  $sum += $thevals['total_earnings'];
			} 
		}	
          
	    //calculate the average salary
	    if($totalrows > 0)
	    {
		  $average = $sum / $totalrows;

		  // report back earnings information as required
		  // 2/23/16 money format on windows workaround.  Using number_format($value, 2).  Only supports US Currency. No support for European currency e.g. 1000,00 for example.
		  echo "<br>The Grand Total Salary for the " . $searchstring . " positions-> is : $ " . number_format($sum, 2) . "<br>";
		  echo "The total rows is : " . $totalrows . "<br>";

		  echo "The Average salary for the " . $searchstring . " position based on Total Earnings is Grand Total Salary: $". number_format($sum,2 ) . " divided by total number of records " . $totalrows . " = $" . number_format($average, 2) . "<br>";	  
		  return 1;
	    }else{
		  // no data found, the program will return to the start page, but inform the user. The message may be visible on a slower system.
		  echo "Sorry no data found for: " . $searchstring . "<br>";		  
		  return 0;		  
	 }	
   }

} //end of controller

// cleans and tests input for correctness   
function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

//ensure the required inputs have been received before proceeding
if (isset($_GET['name'])) 
{
  //instantiate the CalculateEarnings controller class
  $workhorse=new ControllerClass();
  //then call the method
  $ret = $workhorse->getAverageSalary();
  if($ret === 0){
    //$workhorse->redirect("http://localhost/earnings_code_challenge");
  }

}
?>