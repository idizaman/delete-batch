<?php
include("DBConnection.php");
$batchid=$_GET['bid'];

    $query="select distinct(tc.trainer_id),t.trainer_name from trainer_combine tc,trainer t where tc.trainer_id=t.trainer_id and tc.batch_id='$batchid'";
    $result=mysql_query($query);
	
		echo "<table border='1' align='center' cellspacing='2' bgcolor='#000066'><tr aling='center' bgcolor='#B4DCEF'><td>"."Trainer Name"."</td></tr>";
		
	while($row=mysql_fetch_array($result, MYSQL_ASSOC))
	{
		
		echo "<tr><td bgcolor='#FFFFFF'>".$row['trainer_name']."</td></tr>";
		
			
	}	
	
	echo "</table>";
?>


