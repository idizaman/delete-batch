<?php 
include("DBConnection.php");
?>
<html>
<head>
<title>View Batch</title>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
-->
</style>
</head>

<body>
<form name="frmbviewbatch" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<?php 
if(!isset($_POST['viewBatch']))
{
?>

<table width="427" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4">
    <td colspan="2" class="style5"><div align="center"> Batch Wise Feedback Information</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td class="style5">Select Unit:</td>
    <td><select  name="cmbunit" id="cmbagent">
      <option value="ALL" selected>ALL</option>
      <?php
		$unitquery="select distinct(unit_name) FROM batch";
		$unitresult=mysql_query($unitquery);
		$unitnum=mysql_num_rows($unitresult);
		$counter=0;
        while($counter <$unitnum)
        {
       ?>
      <option value="<?php echo mysql_result($unitresult,$counter,"unit_name")?>">
        <?php
        echo mysql_result($unitresult,$counter,"unit_name");
            $counter++;
       }
	   ?>
        </option>
    </select>
        <input type="submit" name="viewBatch" id="viewBatch" value="View Report" /></td>
  </tr>
</table>
<?php }?>
<?php 
if(isset($_POST['viewBatch']) && isset($_POST['cmbunit']))
{
   if($_POST['cmbunit']=="ALL")
   {
      $query="select b.batch_id,b.batch_name,b.topic_id,t.trainer_name,
	          b.no_of_participent 
			  from batch b,trainer t where t.trainer_id=b.trainer_id";
   }
   else
   {
   	  $query="select b.batch_id,b.batch_name,b.topic_id,t.trainer_name,
	          b.no_of_participent from batch b,trainer t where t.trainer_id=b.trainer_id          
			  and unit_name='{$_POST['cmbunit']}'";
   }
      //echo $query;
      $result=mysql_query($query)or die('Query failed: ' . mysql_error());
   
?>

<table width="611" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4">
    <td width="57" height="18" nowrap class="style5"><div align="center">Batch Id</div></td>
    <td width="85" class="style5" nowrap><div align="center">Batch Name</div></td>
    <td width="88" class="style5" nowrap><div align="center">Topic Name</div></td>
    <td width="108" class="style5" nowrap><div align="center">Trainer Name</div></td>
    <td width="91" class="style5" nowrap><div align="center">Total Trainee </div></td>
    <td width="124" class="style5" nowrap><div align="center">Total Fedback</div></td>
    <td width="97" class="style5" nowrap><div align="center">Avarage Score</div></td>
    </tr>
 
<?php  

while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{
	$fbcount_query="select count(question_id)div count(distinct(question_id)) as cnt from answer where batch_name='{$row['batch_name']}'";
	$fbcount_result=mysql_query($fbcount_query);
	$fbcount=mysql_result($fbcount_result,0,"cnt");
	
	$scorequery="select avg(answer) as avans from answer where batch_name='{$row['batch_name']}'";
	$score_result=mysql_query($scorequery);
	$avaragescore=mysql_result($score_result,0,"avans");
?> 
  <tr bgcolor="#FFFFFF">
  <td class="style5" nowrap><div align="center"><?php echo $row['batch_id'];?></div></td>
  <td class="style5" nowrap><div align="center"><?php echo $row['batch_name'];?></div></td>
  <td class="style5" nowrap><div align="center"><?php echo $row['topic_id'];?></div></td>
 <?php
 if($row['trainer_name']=="combined")
 {
 ?> 
  <td class="style5" nowrap><div align="center"><a href="#"  onClick="window.open('trainername.php?bid=<?php echo $row['batch_id'];?>','','height=200,width=200,status=no,toolbar=no,menubar=no,location=no')"><?php echo $row['trainer_name'];?></a></div></td>
  
  <?php }
  else
  {
  
  ?>
  <td class="style5" nowrap><div align="center"><?php echo $row['trainer_name'];?></div></td>
  
  <?php 
  
  }
  ?>
  <td class="style5" nowrap><div align="center"><?php echo $row['no_of_participent'];?></div></td>
  <td class="style5" nowrap><div align="center"><?php echo $fbcount;?></div></td>
  <td class="style5" nowrap><div align="center"><?php printf("%.2f",$avaragescore);/*echo $avaragescore;*/?></div></td>
    </tr>
 <?php }?> 
</table>

<?php }?>

</form>
<p>&nbsp;</p>
</body>
</html>
