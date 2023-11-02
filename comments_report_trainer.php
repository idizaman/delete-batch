<?php 
	session_start(); 
	include("DBConnection.php");
	
	$userid = $_SESSION['uid'];
?>
<html>
<head>
<title>Trainer Report</title>
<style type="text/css">
<!--
.style24 {	font-size: 16px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }

.style6 {font-size: 14px; font-family: Verdana, sans-serif; font-weight: bold; }
.style25 {color: #000000}
-->
</style>
</head>
<body>
<form name="frmbviewcomments" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php 
if(!isset($_POST['btnComments']))
{
?>

<table width="393" border="0" align="center">
  <tr>
    <td colspan="3" bgcolor="54a8f4"><div align="center"><span class="style24">View Comments</span></div></td>
  </tr>
  <tr>
    <td width="158" height="34" bgcolor="54a8f4"><span class="style6">Select Batch Name:</span></td>
    <td colspan="2" bgcolor="54a8f4"><?php			    
			  $batchNamequery="select batch_name from batch where feedbk_status='DONE' AND trainer_id='$userid'";
			  $result=mysql_query($batchNamequery);
			  $num=mysql_num_rows($result);
			  
			  
	?>
        <select name="cmbComments">
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
        </select>
    </td>
  </tr>
  <tr bgcolor="54a8f4">
    <td><div align="left"></div></td>
    <td width="70"><div align="left">
      <input type="submit" name="btnComments" id="btnComments" value="View COmments">
    </div></td>
    <td width="151"><div align="left"></div></td>
  </tr>
</table>

<?php }?>
<?php 
if(isset($_POST['btnComments']) && isset($_POST['cmbComments']))
{
     $query="select batch_name,comments_text from comments where batch_name='{$_POST['cmbComments']}' order by comments_id DESC";
     $result=mysql_query($query)or die('Query failed: ' . mysql_error());
   
?>
<table width="554" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4">
    <td height="18" nowrap class="style5">Batch Name:</td>
    <td class="style5" nowrap><?php echo $_POST['cmbComments'];?></td>
  </tr>
  <tr bgcolor="#54a8f4">
    <td width="79" height="18" nowrap class="style5">SL NO.</td>
    <td width="271" class="style5" nowrap><div align="center">Comments</div></td>
    </tr>
 
<?php  
$sl=0;
while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{
 $sl++; 
  
?> 
  <tr bgcolor="#FFFFFF" class="style5">
    <td class="style5" nowrap><span class="style25"><?php echo $sl;?></span></td>
    <td class="style5" nowrap><span class="style25"><?php echo $row['comments_text'];?></span></td>
    </tr>
 <?php }?> 
</table>

<?php }?>

</form>

</body>
</html>