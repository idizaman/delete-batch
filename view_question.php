<?php 
include("DBConnection.php");
?>
<HTML>
<head>
<script type="text/javascript" src="td.js"></script>
</head>
<body>
<?php
				$quest_query="select * from question where status='0' order by question_id";
				$quest_query_result=mysql_query($quest_query);
			
				$repPrinter="<table width='680' border='1' align='center' cellspacing='1' bordercolor='#000000' class='report'><tr ><th colspan='4'>Feedback Question List</th></tr><tr bgcolor='#54a8f4'><th>SL.NO</th><th>Question Type</th><th>Question</th><th>Action</th></tr>";
			
				$sl=0;
				while($row=mysql_fetch_array($quest_query_result, MYSQL_ASSOC))
	
				{
				//$delete='delete';
				$sl++;
				$ques_id=$row['question_id'];
				
				$repPrinter.="<tr><td align='center'>$sl</td>".
							"<td align='left'>{$row['ques_type']}</td>".
							"<td align='left'><textarea name='editquestion' id='editquestion'rows=3 cols=50 readonly>{$row['ques_text']}</textarea></td>".
							"<td><a href='#' onClick=\"window.open('edit_question.php?quesid=$ques_id','','height=200,width=360,status=no,toolbar=no,menubar=no,location=no')\"'><img src='image/edit.png' title='Edit' width='20' height='20'  style='border: 0; align: center;'/></a>&nbsp;&nbsp;&nbsp;<a href='#'  onClick='deleteQues($ques_id);history.go(0);'><img src='image/delete.png' title='Delete' width='20' height='20'  style='border: 0; align: center;' /></a></td></tr>";
							
				
    			 }
	
	
				$repPrinter.="</table>";
			
				print_r($repPrinter);
			
  			 
?>
</body>
</html>