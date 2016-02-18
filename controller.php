<?php

 // prints currency in the international format for the en_US locale
 setlocale(LC_MONETARY, 'en_US');
 

// this class consumes the boston city salary web service and calculates the average earnings from the 'total_earnings' field
// this class has a method that calculated the average and echoes back the test message $this->getAverageSalary();

class CalculateEarnings {
    
    // initiate the variables/properties
    private $theTest;
    private $response;
    private $totalRatings = 0;
    private $totalRated = 0;
    private $totalrows = 0;

    //the constructor
    protected function templateMethod() 
    {
        $this->getAverageSalary();
    }

    public function getAverageSalary()
    {
        // I could have used javascript to validate on the client side, but I wanted to keep it simple and work on the core requirements
		if (empty($_POST['name'])) {
			echo 'Please enter a search string';
			return false;
		}
		
		// again, I could have used curl to get the JSON data, but just keeping it simple
        $this->response = file_get_contents('https://data.cityofboston.gov/resource/4swk-wcg8.json');
  		$this->response = json_decode($this->response);
  		
  		// now, this just loops through the returned object 
		foreach($this->response as $num => &$values) 
		{
		
		   // gets the object properties
		   $thevals = get_object_vars($values);   	   
		   
		   // assign property values variables
		   $searchstring    = $_POST['name']; 	   
		   $mystring1 = $thevals['title']; 
		   $mystring2 = $thevals['title']; 

		   $pos1 = stripos($mystring2, $searchstring);
   
			// Note our use of ===.  Simply == would not work as expected
			// because the positional issues of is the 0th (first) character per api documentation. 
			if ($pos1 !== false) 
			{
			  echo "Found '$searchstring' in '$mystring2' ==> $". $thevals['total_earnings'] . "<br>";
			  //echo "Found '$searchstring' ==> $" . $thevals['total_earnings']. "<br>";
			  $totalrows = $totalrows + 1;
			  $sum += $thevals['total_earnings'];
			} 
		}	
          
	    //calculate the average salary
	    if($totalrows > 0)
	    {
		  $average = $sum / $totalrows;

		  // report back earnings information as required
		  echo "<br>The Grand Total Salary for the " . $searchstring . " positions is : " . money_format('%i', $sum) . "<br>";
		  echo "The total rows is : " . $totalrows . "<br>";

		  echo "The Average salary for the " . $searchstring . " position based on Total Earnings is Grand Total Salary: ". money_format('%i', $sum) . " divided by total number of records " . $totalrows . " = " . money_format('%i', $average) . "<br>";
	  
		  echo "<br> Click the <b>BACK</b> arrow to go again.";
	    }else{
		  // no data found, inform the user
		  echo "Sorry no data found for: " . $searchstring . "<br>";
		  echo "<br> Click the <b>BACK</b> arrow to go again.";
	 }	
   }
}

//ensure the required inputs have been received befor proceeding
if (isset($_POST['name']) && isset($_POST['submit'])) 
{
  //instantiate the CalculateEarnings controller class
  $workhorse=new CalculateEarnings();
  //then call the method
  $workhorse->getAverageSalary();

}


?>