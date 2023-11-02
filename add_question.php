<?php 
include("DBConnection.php");

?>

<html>
<head>
<title>Add/Delete/Edit question</title>

<script type="text/javascript" src="td.js"></script>
<script type="text/JavaScript">
function formCheck()
{

	if (window.document.frmaddques.cmbquestype.value == "-1" )
	{
	  window.alert('Select Question Type');
		return false;	
	}
	
	else if (window.document.frmaddques.txtquestion.value == "" )
	{
	  window.alert('Write Question');
		return false;
	}
	
	else
	{
		return true;
	}
}

</script>


<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style7 {font-size: 16px}
.style10 {color: #000000}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #000000; }
</style>

</head>

<body>
<form name="frmaddques" action="<?php $_SERVER['PHP_SELF']?>" method="post" onSubmit="var x= formCheck();return x;">
<table width="428" height="217" border="0" align="center" bgcolor="#54a8f4">
  <tr class="style5">
    <td colspan="2"><div align="center" class="style7">Add Questions</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="163" class="style5 style10">Question Type:</td>
    <td width="255"><label>
      <select name="cmbquestype" id="cmbquestype">
            <option value="-1">Select Ques Type</option>
            <option value="Punctuality">Punctuality</option>
			<option value="hardware">hardware</option>
			<option value="Training materials">Training materials</option>
			<option value="Knowledge">Knowledge</option>
			<option value="Sufficient timing">Sufficient timing</option>
			<option value="Equal attention">Equal attention</option>
			<option value="Sufficient practice">Sufficient practice</option>
			<option value="Visual aids">Visual aids</option>
			<option value="Quiz for learning">Quiz for learning</option>
			<option value="Manage work stress">Manage work stress</option>
			<option value="Obtain feedback">Obtain feedback</option>
			<option value="Active participation">Active participation</option>
			<option value="Co-piloting">Co-piloting</option>
			<option value="Role play">Role play</option>
			<option value="Training exercise">Training exercise</option>
			<option value="Team Based Training">Team Based Training</option>
			<option value="General">General</option>
      </select>
    </label></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style5 style10">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style5 style10">Question:</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style11"><textarea name="txtquestion" id="txtquestion" cols="65" rows="5"></textarea></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style11">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input type="reset" name="Reset" id="button" value="Reset" />
    <input type="submit" name="btnAdd" id="btnAdd" value="add" /></td>
  </tr>
</table>
</form>

<?php if ( isset($_POST['btnAdd']))
{  
    $quesType=$_POST['cmbquestype'];
	$quesText=$_POST['txtquestion'];
	$status=0;
	$quesSaveQuery="INSERT into question(ques_type,ques_text,status)".
                  "values('$quesType','$quesText','$status')";

	mysql_query($quesSaveQuery)or die(mysql_error());


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
			
  			 }
			 
			 

?>
</body>
</html>
