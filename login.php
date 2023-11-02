<?php
session_start(); 

if (isset($_POST['userName']) && isset($_POST['pass'])) 
{
		include("DBConnection.php");

		$userid= $_POST['userName'];
		$password = $_POST['pass'];

// check if the user id and password combination exist in database
	$sql = "SELECT trainer_id,password,access_level
           		FROM trainer
           		WHERE trainer_id = '$userid' 
				AND password = '$password'";

   		$result = mysql_query($sql) or die('Query failed. ' . mysql_error());
			  
    	//$accessLevel=mysql_result($result,0,"access_level");
	
   			  
	
	
		if (mysql_num_rows($result) == 1) 
   
   		{
      // the user id and password match, 
      // set the session
	  
	  		$accessLevel=mysql_result($result,0,"access_level");
      			
        
	  			$_SESSION['uid']=$userid;
	  			$_SESSION['access']=$accessLevel;
	  
	   		    //$redirectLoc="Location: index.php?login=success";
		        //header($redirectLoc);
	   
	  
	
      // after login we move to the main page
	  		/*if($accessLevel=="0")
				{
      				header('Location: register.php');
					exit;
	  			}	*/
	  
	  			if($accessLevel=="1")
				{	
  	    			$redirectLoc="Location: homePage.php";
					header($redirectLoc);
					exit;
	  			}	
	   
	
	   			else if($accessLevel=="2")
				{	
  	    			$redirectLoc="Location: homePage.php";
					header($redirectLoc);
					exit;
	  			}	
				
			 	else if($accessLevel=="3")
				{	
  	    			$redirectLoc="Location: homePage.php";
					header($redirectLoc);
					exit;
	  			}	
				
				  /*else if($accessLevel=="4")
				{	
  	    			$redirectLoc="Location: startPage.php?status=registered";
					header($redirectLoc);
					exit;
	  			}	*/
   } 
   		else {
      			//$errorMessage = 'Sorry, wrong user id / password';
				
				$redirectLoc="Location: index.php?login=failure";
		        header($redirectLoc);
   
   			}
 
 
 }
 
 


?>
