# Earnings Code Challenge


This is Gilbert Alipui's crack at the Teikametrics code challenge.  Thank you for granting me the opportunity to tackle this challenge.  I have enjoyed working on it a great deal.

<b>The Problem:</b>  
Using the Boston Employee Earnings Report, create a simple web API service which given a job title, will respond with the average salary for that position.  
Requirements  The average salary should be based on Total Earnings and not Regular. title should allow for case insensitve comparison. 
title should match on partials (example, teacher should match Teacher, Teacher I, Subsitute Teacher.

<b>Introduction:</b>

I chose to use PHP5 (without the use of any framework) for this challenge because PHP is great for rapidly getting a prototype up and running.  Also, my most recent back-end work has been with PHP so it was a natural choice for me.

I tried not to go overboard on any aspect.  I applied a little bootstrap css to round out the corners of the submit button and highlight the textfield as a required field, and did basic validation on the server side to ensure no empty submissions
get through, and to avoid the dreaded division by zero!

Naturally, I am open to working with Ruby on Rails, and GO so it would be interesting to compare the level of effort between Ruby and PHP.

<b>My Solution Methodology:</b>

My solution is pretty straight forward.  Once I figured out the correct URL for the nice JSON data, I used json_decode to store the data into array.  I then totaled up the earnings based on Total Earnings whilst totalling up the total number of 
records.  This enabled me to find the average earnings.  I passed 'i' for case-insensitive matching to fulfill the case-insensitivity requirement.  Since it was case-insensitive, I chose not to use strtoupper as that would have been redundant.

I did not use a framework since this was a fairly straightforward problem and a database was not required.

<b>Solution API</b>

My solution consists of two primary files.  

1. view.php
2. controller.php


The view file is a basic UI to get the search string from the user.  Upon clicking the submit button, controller.php is called.  It does basic validation and if the required input is present, instantiates the CalculateEarnings class and calls its getAverageSalary
method to provide the average earnings for the search string if it is found.  If it is not found, it emits an error message to that effect and exits.  The user is informed to use the browser's back arrow to perform another search.

If I spent additional time on the project, I would opt for Extjs6 for a nice polished tabbed UI, and a PHP framework like Yii to generate the CRUD saffolding to store search results in a MySQL database.  I would then add a tab with a panel to display some
nice pie charts or bar graphs breaking down the various titles and their respective average salaries, and other canned queries. 
