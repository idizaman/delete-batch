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
    <td colspan="2" class="style5"><div align="center">View Batch Information</div></td>
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
        <input type="submit" name="viewBatch" id="viewBatch" value="ViewBatch" /></td>
  </tr>
</table>
<?php }?>
<p>&nbsp;</p>
<?php 
if(isset($_POST['viewBatch']) && isset($_POST['cmbunit']))
{
   if($_POST['cmbunit']=="ALL")
   {
      $query="select b.batch_id,b.batch_name,b.topic_id,t.trainer_name,
	          b.no_of_participent,b.total_hour,b.start_date,b.end_date,b.feedbk_status 
			  from batch b,trainer t where t.trainer_id=b.trainer_id";
   }
   else
   {
   	  $query="select b.batch_id,b.batch_name,b.topic_id,t.trainer_name,
	          b.no_of_participent,b.total_hour,b.start_date,b.end_date,b.feedbk_status 
			  from batch b,trainer t where t.trainer_id=b.trainer_id          
			  and unit_name='{$_POST['cmbunit']}'";
   }
   
      $result=mysql_query($query)or die('Query failed: ' . mysql_error());
   
?>

<table width="699" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4">
    <td width="57" height="18" nowrap class="style5">Batch Id</td>
    <td width="79" class="style5" nowrap>Batch Name</td>
    <td width="77" class="style5" nowrap>Topic Name</td>
    <td width="111" class="style5" nowrap>Trainer Name</td>
    <td width="72" class="style5" nowrap>Trainee No</td>
    <td width="69" class="style5" nowrap>Total Hour</td>
    <td width="68" class="style5" nowrap>Start Date</td>
    <td width="59" class="style5" nowrap>End Date</td>
    <td width="69" class="style5" nowrap>Feed Back</td>
  </tr>
 
<?php  

while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{
  if($row['feedbk_status']==NULL){$FeedBackStatus="Not Done";}else{$FeedBackStatus="Done";}
?> 
  <tr bgcolor="#FFFFFF">
    <td class="style5" nowrap><?php echo $row['batch_id'];?></td>
    <td class="style5" nowrap><?php echo $row['batch_name'];?></td>
    <td class="style5" nowrap><?php echo $row['topic_id'];?></td>
    <td class="style5" nowrap><?php echo $row['trainer_name'];?></td>
    <td class="style5" nowrap><?php echo $row['no_of_participent'];?></td>
    <td class="style5" nowrap><?php echo $row['total_hour'];?></td>
    <td class="style5" nowrap><?php echo $row['start_date'];?></td>
    <td class="style5" nowrap><?php echo $row['end_date'];?></td>
    <td class="style5" nowrap><?php echo $FeedBackStatus;?></td>
  </tr>
 <?php }?> 
  
</table>

<?php }?>

</form>
<p>&nbsp;</p>
</body>
</html>
