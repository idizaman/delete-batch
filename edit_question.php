<html>
<head>
<title>Edit Question</title>

<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style7 {font-size: 16px}
.style10 {color: #000000}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #000000; }
</style>
<script language="javascript" type="text/javascript">
function refresh()
{
window.close();
	if (window.opener && !window.opener.closed) 
		{
		window.opener.location.reload();
		
		}
		
window.opener.location.reload();		 
}


</script>
</head>



<?php
include("DBConnection.php");
$quesid=$_GET['quesid'];
if(isset($_POST['btnSave']))
			{
				$ques_type=$_POST['cmbQuesType'];
				$ques_text=$_POST['questext'];
				$ques_id=$_POST['hdnid'];
				
                $update_query="update  question set ques_type='$ques_type',ques_text='$ques_text' where question_id='$ques_id'";
				$update_query_result=mysql_query($update_query);
					
				echo"<table align='center' bordercolor='#54a8f4' border='2'>";
				echo "<tr><td>Question Success Fuly Saved <br>    Please Press OK</td></tr>";
				echo "<tr align='center'><td><input type='button' name='btnOK' value='ok' onclick='refresh();'></td></tr></table>";
				}

if(!isset($_POST['btnSave']))
			{			
			$quest_query="select * from question where  question_id='$quesid'";
			$quest_query_result=mysql_query($quest_query);
			$questype=mysql_result($quest_query_result,0,'ques_type');
			$questext=mysql_result($quest_query_result,0,'ques_text');
?>

<body>
<form name="frmeditsave" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table width="266"  border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4" class="style5">
    <td colspan="2"><div align="center" class="style11">Edit Questions</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="103" class="style5 style10">Question Type:</td>
    <td width="153"><label>
      <select name="cmbQuesType" id="cmbQuesType">
      <option value="Punctuality" <?php if($questype=="Punctuality") echo "selected";?>>Punctuality</option>
			<option value="hardware"<?php if($questype=="hardware") echo "selected";?>>hardware</option>
			<option value="Training materials"<?php if($questype=="Training materials") echo "selected";?>>Training materials</option>
			<option value="Knowledge"<?php if($questype=="Knowledge") echo "selected";?>>Training materials</option>
			<option value="Sufficient timing"<?php if($questype=="Sufficient timing") echo "selected";?>>Sufficient timing</option>
			<option value="Equal attention"<?php if($questype== "Equal attention") echo "selected";?>>Equal attention</option>
			<option value="Sufficient practice"<?php if($questype=="Sufficient practice") echo "selected";?>>Sufficient practice</option>
			<option value="Visual aids"<?php if($questype=="Visual aids") echo "selected";?>>Visual aids</option>
			<option value="Quiz for learning"<?php if($questype=="Quiz for learning") echo "selected";?>>Quiz for learning</option>
			<option value="Manage work stress"<?php if($questype=="Manage work stress") echo "selected";?>>Manage work stress</option>
			<option value="Obtain feedback"<?php if($questype=="Obtain feedback") echo "selected";?>>Obtain feedback</option>
			<option value="Active participation"<?php if($questype=="Active participation") echo "selected";?>>Active participation</option>
			<option value="Co-piloting"<?php if($questype=="Co-piloting") echo "selected";?>>Co-piloting</option>
			<option value="Role play"<?php if($questype=="Role play") echo "selected";?>>Role play</option>
			<option value="Training exercise"<?php if($questype=="Training exercise") echo "selected";?>>Training exercise</option>
      </select>
    </label></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style5 style10">Question:<input type="hidden" name="hdnid" value="<?php echo $quesid;?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style11"><textarea name="questext" id="questext" cols="40" rows="5"><?php echo $questext; ?></textarea></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input name="btnSave" type="submit" class="style11" id="btnSave" value="Save"  /></td>
  </tr>
</table>
<?php }?>
</form>
</body>
</html>
