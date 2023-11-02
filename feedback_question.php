<?php
session_start(); 
if(!isset($_SESSION['uid'])&&!isset($_SESSION['access']))
{die("<p>Access Restricted!!</p>");}
/*************************************/
$access=$_SESSION['access'];
$eid=$_SESSION['uid'];

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
.style27 {
	color: #BE4421;
	font-weight: bold;
}
-->
</style>

<script type="text/javascript" src="popcalendar.js"></script>

<script type="text/javascript">	
function btnsubmit()
	{
	  document.frmfeedback.action='feedback_answer.php';return true;
	}
function btnfinish()		
		{
			document.frmfeedback.action='feedback_question.php';return true;
		}

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
<form name="frmfeedback" method="post" onSubmit="var x= formCheck();return x;">

	<table width="393" border="0" align="center">
  	<tr>
    <td colspan="3" bgcolor="54a8f4"><div align="center"><span class="style24">Select Batch</span></div></td>
    </tr>
  	<tr>
    <td width="158" height="34" bgcolor="54a8f4"><span class="style6">Batch Name:</span></td>
    <td colspan="2" bgcolor="54a8f4"> 
	<?php			    
		
		if($access==3)  
		{	  
			 $batchNamequery="select batch_name from batch where feedbk_status is NULL";
		}
		 else
		 {
			$batchNamequery="select batch_name from batch where feedbk_status is NULL and trainer_id='$eid'";
			//echo $batchNamequery
		 }
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
      <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" onClick="var x=btnsubmit();return true;">
    </div>    </td>
    <td width="151"><div align="left">
      <input name="btnfinish" type="submit" id="btnfinish" value="Finish Feed Back" onClick="var x=btnfinish();return true;">
    </div>    </td>
    </tr>
  	<tr bgcolor="54a8f4">
  	  <td colspan="3" bgcolor="#FFFFFF">
      
        <div align="center" class="style27">
          <?php 
	if(isset($_GET['limit']) && $_GET['limit']=='equal')
	{
	echo "<p>Your Required Feed Back Has Been Finished </p>"; 
	}
	else if(isset($_GET['limit']) && $_GET['limit']=='exeed')
	{
	echo "<p>Your Required Feed Back Has Been Done </p>"; 
	}
	
	?>
       </div></td>
  	  </tr>
    </table>

  
  <div id="a" style="display:none">
    <table width="746" border="1" align="center" cellspacing="2" bordercolor="#55A0FF" bgcolor="#FFFFFF" >
  
    <tr>
     <td colspan="5"><textarea name="comments" id="comments" cols="45" rows="5"></textarea></td>
    </tr>
    </table>
    </div>


</form>
   </body>
   </html>
