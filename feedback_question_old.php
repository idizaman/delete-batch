<?php
include("DBConnection.php");
if(isset($_POST['btnSave']))
{
			
			 $count=$_POST['quescount'];
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
			if(isset($_POST['btnfinish']))
			{
			 $batch_name=$_POST['cmbBatchID'];
			 $update_query="UPDATE batch set feedbk_status='DONE' where batch_name='$batch_name'";
			 $update_query_result=mysql_query($update_query);
			
			
			}
?>
<html>
<head>
<title>Training Feedback</title>
<style type="text/css">

.style6 {font-size: 14px; font-family: Verdana, sans-serif; font-weight: bold; }
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

	if (window.document.frmfeedback.cmbBatchID.value == "-1" )
	{
	  
	  window.alert('Select Batch');
	  return false;	
	}
	else
	{
		return true;
	}
}


</script>

</head>

<body>
<form name="frmfeedback" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="var x= formCheck();return x;">

<?php 
	if(!isset($_POST['btnSubmit']) && !isset($_POST['btnfinish']))

	{

?>
	<table width="393" border="0" align="center">
  	<tr>
    <td colspan="3" bgcolor="54a8f4"><div align="center"><span class="style24">Select Batch</span></div></td>
    </tr>
  	<tr>
    <td width="158" height="34" bgcolor="54a8f4"><span class="style6">Batch Name:</span></td>
    <td colspan="2" bgcolor="54a8f4"> 
	<?php			    
			  $batchNamequery="select batch_name from batch where feedbk_status is NULL";
			  $result=mysql_query($batchNamequery);
			  $num=mysql_num_rows($result);
			  
			  
	?>
    
      <select name="cmbBatchID">
      <option value="-1">Select Batch</option>
                            
                            <?php
      $counter=0;
      while($counter < $num)
      {
      ?>
                            <option value="<?php echo mysql_result($result,$counter,"batch_name")?>">
                            <?php
      echo mysql_result($result,$counter,"batch_name");
      $counter++;
      }
	  
	?>
    	</option>
        </select>       </td>
  	</tr>
  	<tr bgcolor="54a8f4">
    <td><div align="left"></div></td>
    <td width="70"><div align="left">
      <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
    </div>    </td>
    <td width="151"><div align="left">
      <input name="btnfinish" type="submit" id="btnfinish" value="Finish Feed Back">
    </div>    </td>
    </tr>
    </table>
  <?php }?> 
  <?php
    if(isset($_POST['btnSubmit']) && !isset($_POST['btnfinish']))
	{
		$batchname=$_POST['cmbBatchID'];
		$batch_query="select b.batch_id,b.batch_name,b.topic_id,b.ques_set_id,t.trainer_name from batch b,trainer t where b.trainer_id=t.trainer_id and b.batch_name='$batchname'";
		$batch_query_result=mysql_query($batch_query);
		$batchid=mysql_result($batch_query_result,0,'batch_id');
		$batchname=mysql_result($batch_query_result,0,'batch_name');
		$topicid=mysql_result($batch_query_result,0,'topic_id');
		$trainername=mysql_result($batch_query_result,0,'trainer_name');
	    $quessetid=mysql_result($batch_query_result,0,'ques_set_id');
	
	
?>	
	
	<table width="746" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
  	<tr>
    <td colspan="6"><div align="center"><span class="style24">Training FeedBack</span></div></td>
  	</tr>
  	<tr>
    <td width="75" ><strong>Date:</strong></td>
    <td colspan="3"><input name="examdate" type="text" size="10"/><img src="./images/cal.gif" alt="Pick a Date"  style="cursor:pointer;cursor:hand;" onClick="popUpCalendar(this, document.frmfeedback.examdate,'yyyy-mm-dd');return false;"></td>
    <td colspan="2" rowspan="4">&nbsp;</td>
  	</tr>
  	<tr>
    <td><strong>Trainer :</strong></td>
    <td colspan="3"><label><?php echo $trainername;?></label></td>
  	</tr>
  	<tr>
    <td><strong>Batch ID:</strong></td>
    <td width="95"><?php echo $batchid;?><input type="hidden" name="hidbatchid" value="<?php echo $batchid; ?>"/></td>
    <td width="98"><strong>Batch Name</strong>:</td>
    <td width="203"><?php echo $batchname;?><input type="hidden" name="hidbatchname" value="<?php echo $batchname; ?>"/></td>
  	</tr>
  	<tr>
    <td><strong>Topic:</strong></td>
    <td colspan="3"><?php echo $topicid;?></td>
  	</tr>
  	<tr>
    <td colspan="6">&nbsp;</td>
  	</tr>
  	<tr>
    <td><div align="center" class="style24 style26">SL NO</div></td>
    <td height="23" colspan="3"><div align="center" class="style24 style26">Question</div></td>
    <td width="32"></td>
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
    <td><div align="center"><?php echo $i+1; ?></div></td>
    <td colspan="3"><?php echo $questext; ?>    </td>
    <td><input type="hidden" name="hidquesid<?php echo $i;?>" value="<?php echo $quesid; ?>"/>    </td>
    <td width="203">
    <select name="answer<?php echo $i;?>">
    	<option value="-1">Select Answer </option>
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
  <table width="746" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
    <tr>
    <td colspan="3">
      <div align="center"></div>     </td>
    <td width="369" colspan="2"><input type="submit" name="btnSave" id="btnSave" value="Save" /></td>
    </tr>
    </table>
   <?php }?>

</form>
   </body>
   </html>
