<?php
include("DBConnection.php");

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

function btnsubmit()
	{
		
			document.frmfeedback.action='feedback_question.php';return true;
	}
		
function btnfinish()		
		{
			document.frmfeedback.action='feedback.php';return true;
		}
 
</script>

</head>

<body>
<form name="frmfeedback" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="var x= formCheck();return x;">

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
      <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" onclick="var x=btnsubmit();return true;">
    </div>    </td>
    <td width="151"><div align="left">
      <input name="btnfinish" type="submit" id="btnfinish" value="Finish_Feed_Back" onclick="var x=btnfinish();return true;">
    </div>    </td>
    </tr>
    </table>
  	
	
</form>
   </body>
   </html>
