<?php 
include("DBConnection.php");
?>
<HTML>
<head>
<script type="text/javascript" src="td.js"></script>
</head>
<body>
<?php
			   
			    $quest_query="select * from topic order by topic_id ASC";
				$quest_query_result=mysql_query($quest_query);
			
				$repPrinter="<table width='480' border='1' align='center' cellspacing='1' bordercolor='#000000' class='report'><tr><th colspan='4'>Topics List</th></tr><tr><th>SL.NO</th><th>Topics</th><th>Action</th></tr>";
			
				$sl=0;
				while($row=mysql_fetch_array($quest_query_result, MYSQL_ASSOC))
	
				{
				//$delete='delete';
				$sl++;
				$topic_id=$row['topic_id'];
				
				$repPrinter.="<tr><td align='center'>$sl</td>".
							"<td align='left'>{$row['topic_text']}</td>".
							"<td align='center'><a href='#'  onClick='delTopic($topic_id);history.go(0);'><img src='image/delete.png' title='Delete' width='20' height='20'  style='border: 0; align: center;' /></a></td></tr>";
							
				
    			 }
	
	
				$repPrinter.="</table>";
			
				print_r($repPrinter);
			
  		
			 
  			 
?>
</body>
</html>