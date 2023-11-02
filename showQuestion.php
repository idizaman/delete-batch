<?php
$quesid=$_GET['quesid'];
$quesOpt=$_GET['quesOpt'];
$topicid=$_GET['topicid'];
$topicOpt=$_GET['topicOpt'];

include("DBConnection.php");

		
		
            if(isset($_GET['quesid']) && $_GET['quesOpt']=='del')
	
			{   

        		$delete_query="update  question set status='1' where question_id='$quesid'";
				$delete_query_result=mysql_query($delete_query);
		
				
			}
			
			else if(isset($_GET['topicid']) && $_GET['topicOpt']=='del')
	
			{   

        		$delete_query="delete from topic where topic_id='$topicid'";
				$delete_query_result=mysql_query($delete_query);
		
				
			}
				
			

	    function getQuestion()
	
	  		{
	
				$quest_query="select * from question where status='0' order by question_id DESC";
				$quest_query_result=mysql_query($quest_query);
			
				$repPrinter="<table width='680' border='1' align='center' cellspacing='1' bordercolor='#000000' class='report'><tr><th colspan='4'>Feedback Question List</th></tr><tr><th>SL.NO</th><th>Question Type</th><th>Question</th><th>Action</th></tr>";
			
				$sl=0;
				while($row=mysql_fetch_array($quest_query_result, MYSQL_ASSOC))
	
				{
				//$delete='delete';
				$sl++;
				$ques_id=$row['question_id'];
				
				$repPrinter.="<tr><td align='center'>$sl</td>".
							"<td align='left'>{$row['ques_type']}</td>".
							"<td align='left'><textarea name='editquestion' id='editquestion'rows=3 cols=50 readonly>{$row['ques_text']}</textarea></td>".
							"<td><a href='#' onClick=''><img src='image/edit.png' title='Edit' width='20' height='20'  style='border: 0; align: center;'/></a>&nbsp;&nbsp;&nbsp;<a href='#'  onClick='deleteQues($ques_id);'><img src='image/delete.png' title='Delete' width='20' height='20'  style='border: 0; align: center;' /></a></td></tr>";
							
				
    			 }
	
	
				$repPrinter.="</table>";
			
				print_r($repPrinter);
			
  			 }
			 
			  /*function viewQuestion()
	
	  		{
	
				$quest_query="select * from question where status='0' order by question_id DESC";
				$quest_query_result=mysql_query($quest_query);
			
				$repPrinter="<table width='680' border='1' align='center' cellspacing='1' bordercolor='#000000' class='report'><tr><th colspan='4'>Feedback Question List</th></tr><tr><th>SL.NO</th><th>Question Type</th><th>Question</th></tr>";
			
				$sl=0;
				while($row=mysql_fetch_array($quest_query_result, MYSQL_ASSOC))
	
				{
				//$delete='delete';
				$sl++;
				$ques_id=$row['question_id'];
				
				$repPrinter.="<tr><td align='center'>$sl</td>".
							"<td align='left'>{$row['ques_type']}</td>".
							"<td align='left'><textarea name='editquestion' id='editquestion'rows=3 cols=50 readonly>{$row['ques_text']}</textarea></td></tr>";
							
				
    			 }
	
	
				$repPrinter.="</table>";
			
				print_r($repPrinter);
			
  			 }*/
			 
			 
			 
?> 

