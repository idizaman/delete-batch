<?php 
include("DBConnection.php");

$agentquery="select trainer_id,trainer_name FROM trainer";
$agentresult=mysql_query($agentquery);
$agentnum=mysql_num_rows($agentresult);

if(isset($_POST['btnupdateuser']))
{
	$oldtrainerid=$_POST['oldtrainerid'];
	$trainerid=$_POST['txtemail'];
	$trainername=$_POST['txtname'];
	$staffid=$_POST['txtstaffid'];
	$phone=$_POST['txtphone'];
	$password=$_POST['txtpassword'];
	$access_level=$_POST['cmbaccesslevel'];
	
    $UpdateQuery="UPDATE trainer SET trainer_id='$trainerid',trainer_name='$trainername',phone='$phone',staff_id='$staffid',access_level='$access_level' WHERE trainer_id='$oldtrainerid'";
   
   mysql_query($UpdateQuery)or die(mysql_error());
   
   echo "User Information Successfuly Updated ";
   
}

if(isset($_POST['cmbagent']) && isset($_POST['btnview'])&& $_POST['cmbagent']!= -1)
{
	$trainerid=$_POST['cmbagent'];
    $infoquery="select * FROM trainer WHERE trainer_id='$trainerid'";
    $inforesult = mysql_query($infoquery) or die('Query failed: ' . mysql_error()); 
	
	
	$trainerid=mysql_result($inforesult,0,'trainer_id');
	$trainername=mysql_result($inforesult,0,'trainer_name');
	$phone=mysql_result($inforesult,0,'phone');
	$staffid=mysql_result($inforesult,0,'staff_id');
	$access_level=mysql_result($inforesult,0,'access_level');
	
}
if(isset($_POST['btndelete']))
{
	$oldtrainerid=$_POST['oldtrainerid'];    
	$deletequery="DELETE FROM trainer WHERE trainer_id='$oldtrainerid'";
    $deleteresult = mysql_query($deletequery) or die('Query failed: ' . mysql_error()); 
}

?>
<html >
<head>
<title>Add/Edit/delete User Information</title>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style6 {
	font-size: 18px
}
-->
</style>
<script type="text/JavaScript">
function formCheck()
{

	if (window.document.frmupdateuser.cmbagent.value == "-1" )
	{
	  window.alert('Select  Name');
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
<form name="frmupdateuser" action="<?php $_SERVER['PHP_SELF']?>" method="post" >
<?php 

if(!isset($_POST['btnupdateuser']) && !isset($_POST['btndelete']))
{
$agentquery="select trainer_id,trainer_name FROM trainer";
$agentresult=mysql_query($agentquery);
$agentnum=mysql_num_rows($agentresult);
?>
<Table width="427" border="0" align="center" bgcolor="#54a8f4">
    <tr bgcolor="#FFFFFF">
    <td class="style5">View User:</td>
    <td><select  name="cmbagent" id="cmbagent">
      <option value="-1">Select name </option>
      <?php
      
      while($counter <$agentnum)
      {
      ?>
      <option value="<?php echo mysql_result($agentresult,$counter,"trainer_id")?>">
        <?php
      echo mysql_result($agentresult,$counter,"trainer_name");
      $counter++;
      }
	?>
        </option>
    </select>
      <input type="submit" name="btnview" id="btnview" value="View User" onClick="var x= formCheck();return x;"/></td>
  </tr>
</table>
<?php
}
if(isset($_POST['btnview']) && !isset($_POST['btnupdateuser']))
{
?>
<Table width="427" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#CCCCCC" class="style6">
    <td colspan="2" bgcolor="#54a8f4"><div align="center" class="style6">Update Trainer  Information</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="135"><span class="style5"> Name:</span></td>
    <td width="282"><input name="txtname" type="text" id="txtname" size="40" value="<?php echo $trainername; ?>"/></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">Staff ID:</span></td>
    <td><input type="text" name="txtstaffid" id="txtstaffid" value="<?php echo $staffid; ?>"/></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">E-Mail ID:</span></td>
    <td><input type="text" name="txtemail" id="txtemail" value="<?php echo $trainerid;?>"/></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">Phone:</span></td>
    <td><input type="text" name="txtphone" id="txtphone" value="<?php echo $phone; ?>"/></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style5">Access Level:</td>
    <td>
    <select name="cmbaccesslevel" id="cmbaccesslevel">
      <option value="1" <?php if($access_level == "1") echo "selected";?> >Trainer</option>
      <option value="3" <?php if($access_level == "3") echo "selected";?> >Admin</option>
    </select>    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><input type="hidden" name="oldtrainerid" value="<?php echo $trainerid ;?>"></td>
    <td><input type="submit" name="btnupdateuser" id="btnupdateuser" value="Update User" />
      <input type="submit" name="btndelete" id="button" value="Delete" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>
  <?php }?>
</p>

<p>&nbsp; </p>
</form>
<p>&nbsp;</p>
</body>
</html>
