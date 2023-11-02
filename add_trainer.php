<?php
include("DBConnection.php");
if(isset($_POST['btnSubmit']))
{
	$trainerid=$_POST['txtemail'];
	$trainername=$_POST['txtname'];
	$staffid=$_POST['txtstaffid'];
	$phone=$_POST['txtphone'];
	$password=$_POST['txtpassword'];
	$access_level=$_POST['cmbaccesslevel'];
	
	$SaveQuery="INSERT into trainer(trainer_id,staff_id,trainer_name,phone,password,
				  access_level)".
                  "values('$trainerid','$staffid','$trainername','$phone',
				 '$password','$access_level')";
    mysql_query($SaveQuery)or die(mysql_error());
	
	echo "Successfully save........";
}
?>


<html>
<head>
<title>Add Trainer</title>
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

	if (window.document.frmaddtrainer.txtname.value == "" )
	{
	  window.alert('Enter Trainer Name');
		return false;	
	}
	
	else if (window.document.frmaddtrainer.txtstaffid.value == "" )
	{
	  window.alert('Enter Staff ID');
		return false;
	}
	
	else if (window.document.frmaddtrainer.txtemail.value == "" )
	{
	  window.alert('Enter Email Address');
		return false;
	}
	
	else if (window.document.frmaddtrainer.txtphone.value == "" )
	{
	  window.alert('Enter Phone Number');
		return false;
	}
	else if (window.document.frmaddtrainer.txtpassword.value == "" )
	{
	  window.alert('Enter Password');
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
<form name="frmaddtrainer" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onSubmit="var x= formCheck();return x;">
<?php 
if(!isset($_POST['btnSubmit']))
{
?>

<Table width="427" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4" class="style5">
    <td colspan="2"><div align="center" class="style6">Trainer Information</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="135"><span class="style5">Trainer Name:</span></td>
    <td width="282"><input name="txtname" type="text" id="txtname" size="40" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">Staff ID:</span></td>
    <td><input type="text" name="txtstaffid" id="txtstaffid" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">E-Mail ID:</span></td>
    <td><input type="text" name="txtemail" id="txtemail" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">Phone:</span></td>
    <td><input type="text" name="txtphone" id="txtphone" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><span class="style5">Password:</span></td>
    <td><input type="text" name="txtpassword" id="txtpassword" /></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style5">Access Level:</td>
    <td>
    <select name="cmbaccesslevel" id="select">
    <option value="1">Trainer</option>
    <option value="3">Admin</option>
    </select>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>&nbsp;</td>
    <td><input type="reset" name="Reset" id="button" value="Reset" />
    <input type="submit" name="btnSubmit"  value="Submit" /></td>
  </tr>
</table>
<?php }?>

</form>
</body>
</html>
