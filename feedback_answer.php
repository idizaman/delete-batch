<?php
session_start();
if(!isset($_SESSION['uid'])&&!isset($_SESSION['access']))
{die("<p>Access Restricted!!</p>");}
/*************************************/
$access=$_SESSION['access'];
$eid=$_SESSION['uid'];
if($_POST['cmbBatchID']!="")
{
$_SESSION['batchID']=$_POST['cmbBatchID'];
}
$batchname=$_SESSION['batchID'];
include("DBConnection.php");
if(isset($_POST['btnSave']))
{
			$count=$_POST['quescount'];
			$txtTraineeCount=$_POST['txtTraineeCount'];
			$textFbCount=$_POST['textFbCount'];
			
			for($k=0;$k<$count;$k++)
			{
				$ques_id=$_POST['hidquesid'.$k];
				$answer=$_POST['answer'.$k];
				$batch_id=$_POST['hidbatchid'];
				$batch_name=$_POST['hidbatchname'];
				$date=$_POST['examdate'];
				$insert_query="INSERT into answer(Question_id,answer,batch_id,batch_name,date)".
				"values('$ques_id','$answer','$batch_id','$batch_name','$date')";
				$insert_query_result=mysql_query($insert_query);
			}
			if($_POST['yes']=="YES")
			{
			 $comment=$_POST['comments'];
			 $comment_query="INSERT into comments(batch_id,batch_name,comments_text)".
					  "values('$batch_id','$batch_name','$comment')";
			 $comment_query_result=mysql_query($comment_query);
			}
			
			
}
			
?>
<html>
<head>
<title>Training Feedback</title>
<style type="text/css">
.style24 {
	font-size: 16px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style26 {font-size: 12px}
.style27 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>

<script type="text/javascript" src="popcalendar.js"></script>

<script type="text/javascript">	

	function check()
	{
		document.getElementById("no").checked=false;
		document.getElementById("yes").checked=true;
		document.getElementById("a").style.display="block";
	}
	function uncheck()
	{
		document.getElementById("yes").checked=false;
		document.getElementById("no").checked=true;
		document.getElementById("a").style.display="none";
	}
	function formCheck()
   {
	if (window.document.frmfeedbackAnswer.cmbBatchID.value == "-1" )
	{
	  window.alert('Select Batch');
	  return false;	
	}
	else
	{
		return true;
	}
}

function validateNumber()
{
		
		if (document.frmfeedbackAnswer.examdate.value == "" )
		{
		  window.alert('Select Date');
		  return false;	
		}
		
		
		for( var i=0; i< document.frmfeedbackAnswer.quescount.value; i++)
		{
			
			    var quescnt=document.frmfeedbackAnswer.quescount.value;
				
				for( var j=1; j< quescnt; j++)
				{
				document.getElementById('sll'+j).style.background='white';
				document.getElementById('qsn'+j).style.background='white';
				}
			
			if(document.frmfeedbackAnswer['answer'+i].value == "NA")
				{
				
				var quesno= document.frmfeedbackAnswer['hidSlid'+i].value
					
				alert('Answer Ques NO ( '+quesno+' )');
			
				document.getElementById('sll'+quesno).style.background='yellow';
				document.getElementById('qsn'+quesno).style.background='yellow';

				return false;
				}
		}
		return true;
	
}

</script>
</head>
<body>
<form name="frmfeedbackAnswer" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="var x= formCheck();return x;">
<?php
    	
		$batch_query="select b.batch_id,b.batch_name,b.topic_id,b.ques_set_id,b.no_of_participent,t.trainer_name from batch b,trainer t where b.trainer_id=t.trainer_id and b.batch_name='$batchname'";
		$batch_query_result=mysql_query($batch_query);
		$batchid=mysql_result($batch_query_result,0,'batch_id');
		$batchname=mysql_result($batch_query_result,0,'batch_name');
		$topicid=mysql_result($batch_query_result,0,'topic_id');
		$trainername=mysql_result($batch_query_result,0,'trainer_name');
	    $quessetid=mysql_result($batch_query_result,0,'ques_set_id');
		$no_of_participent=mysql_result($batch_query_result,0,'no_of_participent');
?>	
  <table width="783" height="263" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
  	<tr>
    <td colspan="6"><div align="center"><span class="style24">Training FeedBack</span></div></td>
  	</tr>
  	<tr>
    <td width="88" nowrap ><strong>Date:</strong></td>
    <td colspan="3"><input name="examdate" type="text" value="<?php if($_POST['examdate']) echo $_POST['examdate']; ?>"size="10"/><img src="./images/cal.gif" alt="Pick a Date"  style="cursor:pointer;cursor:hand;" onClick="popUpCalendar(this, document.frmfeedbackAnswer.examdate,'yyyy-mm-dd');return false;"></td>
    <td colspan="2" nowrap><strong>Total Trainee</strong>:      
      <input name="txtTraineeCount" type="text"  size="5" value="<?php echo $no_of_participent;?>"disabled></td>
  	</tr>
  	<tr>
    <td nowrap><strong>Trainer :</strong></td>
    <td colspan="3"><label><?php echo $trainername;?></label></td>
    <?php 
	$fbcount_query="select count(question_id)div count(distinct(question_id)) as cnt from answer where batch_name='$batchname'";
	$fbcount_result=mysql_query($fbcount_query);
	$fbcount=mysql_result($fbcount_result,0,"cnt");
	?>
  	<td colspan="2" nowrap><strong>Feedback Done</strong>:
      <input name="textFbCount" type="text"  value="<?php echo $fbcount;?>"size="5" disabled></td>
  	</tr>
  	<tr>
    <td nowrap><strong>Batch ID:</strong></td>
    <td width="95"><?php echo $batchid;?>
      <input type="hidden" name="hidbatchid" value="<?php echo $batchid; ?>"/></td>
    <td width="105">:<strong>Topic:</strong></td>
    <td width="241"><?php echo $topicid;?></td>
  	<td colspan="2" nowrap>&nbsp;</td>
  	</tr>
  	<tr>
    <td nowrap><strong>Batch Name:</strong></td>
    <td colspan="3"><?php echo $batchname;?>
      <input type="hidden" name="hidbatchname" value="<?php echo $batchname; ?>"/></td>
  	<td colspan="2" nowrap>&nbsp;</td>
  	</tr>
  	<tr>
    <td colspan="6" nowrap>&nbsp;</td>
  	</tr>
  	<tr>
    <td nowrap><div align="center" class="style24 style26">SL NO</div></td>
    <td height="23" colspan="3"><div align="center" class="style24 style26">Question</div></td>
    <td width="17"></td>
    <td><div align="center" class="style24 style26">Answer</div></td>
  	</tr>
  	<?php
  		    $ques_id_query="select distinct(ques_id) as quesid from questionset where ques_set_id='$quessetid'";
			$ques_id_query_result=mysql_query($ques_id_query);
		    $numques=mysql_num_rows($ques_id_query_result);
			//while($row=mysql_fetch_array($ques_id_query_result,MYSQL_ASSOC))
			for($i=0;$i<mysql_num_rows($ques_id_query_result);$i++)
			{
		 	//$quesid=$row['quesid'];
			$quesid=mysql_result($ques_id_query_result,$i,'quesid');
			$tQuery="SELECT ques_text from question  where question_id='$quesid'";
 		 	$tResult=mysql_query($tQuery)or die('Query failed: ' . mysql_error());
			$questext=mysql_result($tResult,0,'ques_text');
  ?>
  	<tr>
    <td nowrap><div id="sll<?php echo $i+1; ?>" align="center"><?php echo $i+1; ?></div>
    <input type="hidden" name="hidSlid<?php echo $i;?>" value="<?php echo $i+1 ?>"/>
    </td>
    
    <td colspan="3"><div id="qsn<?php echo $i+1; ?>"><?php echo $questext; ?></div></td>
    <td><input type="hidden" name="hidquesid<?php echo $i;?>" value="<?php echo $quesid; ?>"/>    </td>
    <td width="197">
    <select name="answer<?php echo $i;?>">
    	<option value="NA">Select Answer </option>
    	<option value="1">poor / not at all </option>
     	<option value="2">average / seldom</option>
      	<option value="3">good / sometimes </option> 
      	<option value="4">v. good / most of the times </option> 
      	<option value="5">excellent / always</option>
	    </select>    </td>
    </tr>
  <?php
  }
  ?>
  
    <tr>
    <td colspan="6"><input type="hidden" name="quescount" value="<?php echo $numques; ?>"/></td>
    </tr>
    <tr>
    <td colspan="6"><span class="style27">Comments:
      <input type="checkbox" name="yes" id="yes"  value="YES" onClick="check();">
      YES 
      <input name="no" type="checkbox" id="no"   value="NO" onClick="uncheck();" checked>
    NO</span></td>
    </tr>
    </table>
  <div id="a" style="display:none">
  <table width="746" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
  
    <tr>
     <td colspan="5"><textarea name="comments" id="comments" cols="45" rows="5"></textarea></td>
    </tr>
    </table>
    </div>
  <table width="783" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
    <tr>
    <td colspan="3">
      <div align="center"></div>     </td>
    <td width="398" colspan="2"><input type="submit" name="btnSave" id="btnSave" value="Save" onClick="return validateNumber();" /></td>
    </tr>
  </table>

<?php 

      if($no_of_participent==$fbcount)
			{
			echo "<script> var a=window.alert('Feed Back Has Finished');";
			
			echo"if(a=true) window.location='feedback_question.php?limit=exeed';";
			
			
			echo"</script>";
			  
			}

?>

</form>
   </body>
   </html>
