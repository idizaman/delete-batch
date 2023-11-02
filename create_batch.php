<?php 
include("DBConnection.php");
$query="select trainer_name,trainer_id FROM trainer where access_level='1'";
$result=mysql_query($query);
$num=mysql_num_rows($result);
$tquery="select trainer_name,trainer_id FROM trainer where status is NULL";
$tresult=mysql_query($tquery);
$tnum=mysql_num_rows($tresult);

$topicquery="select topic_id,topic_text FROM topic";
$topicresult=mysql_query($topicquery);
$topicnum=mysql_num_rows($topicresult);
/*if(isset($_POST['btnSave']))
{
	echo $SaveQuery="INSERT into batch(batch_id,batch_name,trainer_id,no_of_participent,topic_id,
				  start_date,end_date,total_hour)".
                  "values('$batchid','$batchname','$trainer_id','$no_of_partcipent',
				 '$topics','$startdate','$enddate','$totalhour')";

	mysql_query($SaveQuery)or die(mysql_error());
}*/
if (!isset($_POST['btnCreateBatch']) or isset($_POST['btnOK']))
{

?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Batch</title>

<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style7 {font-size: 16px}
.style10 {color: #000000}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #000000; }
.style13 {
	font-size: 12px;
	font-weight: bold;
}
.style15 {color: #000000; font-weight: bold; font-size: 12px; }
</style>
<script language=JavaScript src="tigra_calculator/calculator.js"></script>
<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/JavaScript">
function formCheck()
{

	if (window.document.frmcreatbatch.cmbunit.value == "-1" )
	{
	  window.alert('Select Unit Name');
		return false;	
	}
	
	else if (window.document.frmcreatbatch.cmbtrainer.value == "-1" )
	{
	  window.alert('Select Trainer Name');
		return false;
	}
	
	else if (window.document.frmcreatbatch.noofpartcipent.value == "" )
	{
	  window.alert('Plsease Enter Participent Number');
		return false;
	}
	
	else if (window.document.frmcreatbatch.txttotalhour.value == "" )
	{
	  window.alert('Plsease Enter Total Training Hour');
		return false;
	}
	else if (window.document.frmcreatbatch.cmbtopics.value == "-1" )
	{
	  window.alert('Select Training Topic');
		return false;
	}
	else if (window.document.frmcreatbatch.startdate.value == "" )
	{
	  window.alert('Plsease Enter Training Start Date');
		return false;
	}
	else if (window.document.frmcreatbatch.enddate.value == "" )
	{
	  window.alert('Plsease Enter Training End Date');
		return false;
	}
	else
	{
		return true;
	}
}

function checktrainer()
{

	if (window.document.frmcreatbatch.cmbtrainer.value == "combined" )
	{
	 document.getElementById("cmbtrainermulti").disabled=false; 
	}
	
	else
	{
	  document.getElementById("cmbtrainermulti").disabled=true; 
	  document.getElementById("cmbtrainermulti").value=""; 
	}



}


</script>


</head>

<body>
<form name="frmcreatbatch" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onSubmit="var x= formCheck();return x;">
<table width="428" height="217" border="0" align="center" bgcolor="#54a8f4">
  <tr class="style5">
    <td colspan="2"><div align="center" class="style7">Batch Information</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="163" class="style5 style10">Unit Name:</td>
    <td width="255"><span class="style10">
      <select  id="cmbunit" name="cmbunit">
      <option value="-1">Select Unit</option>
      <option value="CL">Care Line</option>
      <option value="COPS">COPS</option>
      <option value="BDCR">BDCR</option>
      <option value="BSP">BSP</option>
      <option value="BP">BP</option>
      <option value="CRM">CRM</option>
	  <option value="CareCenter">Care Center</option>
      <option value="Commercial">Commercial</option>
      <option value="ContactCenter">Contact Center</option>
      <option value="MonobrandOperations">Monobrand Operations</option>
      <option value="Others">Others</option>
      </select>
    </span> </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style11">Trainer Name:</td>
    <td><span class="style10">
      <select name="cmbtrainer" id="cmbtrainer"  onChange="checktrainer();">
        <option value="-1">Select Trainer name </option>
        <?php
       $counter=0;
      while($counter < $num)
      {
      ?>
        <option value="<?php echo mysql_result($result,$counter,"trainer_id")?>">
        <?php
      echo mysql_result($result,$counter,"trainer_name");
      $counter++;
      }
	?>
        </option>
      </select>
      <select name="cmbtrainermulti[]" id="cmbtrainermulti" size="5" multiple id="select" disabled="disabled">
   
        <?php
       $counter=0;
      while($counter < $tnum)
      {
      ?>
        <option value="<?php echo mysql_result($tresult,$counter,"trainer_id")?>">
        <?php
      echo mysql_result($tresult,$counter,"trainer_name");
      $counter++;
      }
	?>
        </option>
      </select>
    </span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style11">No Of Participant:</td>
    <td><input name="noofpartcipent" type="text" id="noofpartcipent" size="10" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style11">Total Hour:</td>
    <td><input name="txttotalhour" type="text" id="txttotalhour" size="10" /><a href="javascript:TCR.TCRPopup(document.forms['frmcreatbatch'].elements['txttotalhour'])"><img width="15" height="13" border="0" alt="Click here to see the calculator" src="tigra_calculator/calc.gif"></a></td>
  </tr>
   <tr  bgcolor="#FFFFFF">
    <td class="style11">Topic Name:</td>
    <td>
      <select  name="cmbtopics" id="cmbtopics">
      
      
	<option value="-1">Select Topic </option>
        <?php
      $counter=0;
	     
      while($counter <$topicnum)
      {
      ?>
        <option value="<?php echo mysql_result($topicresult,$counter,"topic_text")?>">
        <?php
      echo mysql_result($topicresult,$counter,"topic_text");
      $counter++;
      }
	?>
    </option>
    </select>    </td>
    </tr>
  <tr bgcolor="#FFFFFF">
  <td class="style11">Training Start Date:</td>
  <td>
    <input name="startdate" type="text" id="startdate" size="10"/><img src="./images/cal.gif" alt="Pick a Date" onClick="popUpCalendar(this,document.frmcreatbatch.startdate,'yyyy-mm-dd');return false;" style="cursor:pointer;cursor:hand;">    </td>
  </tr> 
  <tr bgcolor="#FFFFFF">  
  <td class="style11">Training End Date:</td>
  <td> 
  <input name="enddate" type="text" id="enddate" size="10"/><img src="./images/cal.gif" alt="Pick a Date"  style="cursor:pointer;cursor:hand;" onClick="popUpCalendar(this, document.frmcreatbatch.enddate,'yyyy-mm-dd');return false;">  </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td> 
    <input  type="reset" name="Reset" id="button" value="Reset"/>
    <input  type="submit" name="btnCreateBatch" id="button2" value="Create Batch"/></td>
  </tr>
</table>
</form>
<p>
<?php 
}

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

if (isset($_POST['btnCreateBatch']))
{  
    $unitname=$_POST['cmbunit'];
	$trainer_id=$_POST['cmbtrainer'];
	$no_of_partcipent=$_POST['noofpartcipent'];
	$totalhour=$_POST['txttotalhour'];
	$topics=$_POST['cmbtopics'];
	$startdate=$_POST['startdate'];
	$enddate=$_POST['enddate'];

	$query="SELECT COUNT(batch_id) serial FROM batch WHERE batch_id LIKE '$unitname%'";
	$result=mysql_query($query);
	$serialnumber=mysql_result($result,0,'serial');
	//echo $serialnumber; exit;
	if($serialnumber!=0)
	{
		$newserialnumber=$serialnumber+1;
		$batchid=$unitname.$newserialnumber;
	}
	else 
	{ 
		$newserialnumber=1;
		$batchid=$unitname.$newserialnumber;
	}	
	$arr = explode("-",$startdate);
	$start = $arr[0].$arr[1].$arr[2];
	$batchname=$batchid.$topics.$start;
	
	$SaveQuery="INSERT into batch(batch_id,batch_name,unit_name,trainer_id,no_of_participent,topic_id,
				  start_date,end_date,total_hour)".
                  "values('$batchid','$batchname','$unitname','$trainer_id','$no_of_partcipent',
				 '$topics','$startdate','$enddate','$totalhour')";

	//exit;
	mysql_query($SaveQuery)or die(mysql_error());
	
	if($_POST['cmbtrainer']=="combined")
	{
	
	foreach($_POST['cmbtrainermulti'] as $trainermulti) 
			
			{  
				 $trainermulti ;
					
				$SaveQueryComb="INSERT into trainer_combine(batch_id,batch_name,unit_name,trainer_id,no_of_participent,topic_id,
				  start_date,end_date,total_hour)".
                  "values('$batchid','$batchname','$unitname','$trainermulti','$no_of_partcipent',
				 '$topics','$startdate','$enddate','$totalhour')";

				 mysql_query($SaveQueryComb)or die(mysql_error());
				
			}
	}

//exit;
?>
</p>
<form name="frmcreatbatch" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<table width="428" height="217" border="0" align="center" bgcolor="#54a8f4">
  <tr class="style5">
    <td colspan="2" class="style10"><div align="center" class="style7">Batch Information</div></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Batch Id:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $batchid;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Batch Name:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $batchname;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td width="163" bgcolor="#FFFFFF" class="style11">Unit Name:</td>
    <td width="255" bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $unitname;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Trainer Name:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $trainer_id;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">No Of Perticipent:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $no_of_partcipent;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Total Hour:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $totalhour;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Topic Name:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $topics;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Training Start Date:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $startdate;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF" class="style5">
    <td bgcolor="#FFFFFF" class="style11">Training End Date:</td>
    <td bgcolor="#FFFFFF" class="style5"><span class="style13"><?php echo $enddate;?></span></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input type="submit" name="btnOK" id="btnOK" value="ok"></td>
  </tr>
</table>

<?php 

}

	
?>
<p>&nbsp;</p>
</form>
</body>
</html>
