<?php 
include("DBConnection.php");
if(isset($_POST['deleteBatch']))
{
	$batchname=$_POST['cmbbatch'];    
	$deletequery="DELETE FROM batch WHERE batch_name='$batchname'";
    $deleteresult = mysql_query($deletequery) or die('Query failed: ' . mysql_error()); 

     echo "Deleted Data";
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Batch</title>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
-->
</style>
<script type="text/javascript" src="td.js"></script>

<script type="text/JavaScript">
function formCheck()
{

	if (window.document.frmbatchdelete.cmbbatch.value == "-1" )
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
<form name="frmbatchdelete" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onSubmit="var x= formCheck();return x;">
<?php 
if(!isset($_POST['deleteBatch']))
{

?>
<table width="527" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#FFFFFF">
    <td width="113" class="style5">Delete Batch:</td>
    <td width="213"><select  name="cmbbatch" id="cmbagent">
      <option value="-1">Select Batch name </option>
      <?php
		$batchquery="select batch_name FROM batch where feedbk_status is NULL";
		$batchresult=mysql_query($batchquery);
		$batchnum=mysql_num_rows($batchresult);
		$counter=0;
        while($counter <$batchnum)
        {
       ?>
       <option value="<?php echo mysql_result($batchresult,$counter,"batch_name")?>">
        <?php
        echo mysql_result($batchresult,$counter,"batch_name");
            $counter++;
       }
	   ?>
        </option>
        
        
    </select></td>
    <td width="87"><input type="submit" name="deleteBatch" id="deleteBatch" value="Delete Batch" /></td>
  </tr>
</table>
<?php }?>
</form>
</body>
</html>
