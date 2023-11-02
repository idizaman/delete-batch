<?php 
include("DBConnection.php");
?>
<html>
<head>
<title>Trainer Report</title>

<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
-->
</style>

</head>
<body>

<table width="622" border="0" align="center" bgcolor="#54a8f4">
  <tr bgcolor="#54a8f4">
    <td colspan="4" class="style5"><div align="center"> Trainer Training Feed Back Avarage Score</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="174" class="style5">Trainer Name</td>
    <td width="140" class="style5">Number Of Batch</td>
    <td width="118" class="style5">No Of Trainee</td>
    <td width="172" class="style5">Avarage Score(Out Of 5)</td>
  </tr>
  
  <?php 
  
  $query="select avg(a.answer)as avgans ,t.trainer_name,t.trainer_id from answer a,batch b,trainer t 
where b.trainer_id=t.trainer_id and a.batch_name=b.batch_name group by t.trainer_name";
  $result=mysql_query($query);
  while($row=mysql_fetch_array($result,MYSQL_ASSOC))
{
  
    $batchcount_query="select count(batch_id)as cnt,sum(no_of_participent) as smpart from batch where trainer_id='{$row['trainer_id']}'";
	$batchcount_result=mysql_query($batchcount_query);
	$batchcount=mysql_result($batchcount_result,0,"cnt");
	$batchsum=mysql_result($batchcount_result,0,"smpart");
	
  
  ?>
  
  
  <tr bgcolor="#FFFFFF">
    <td class="style5"><?php echo $row['trainer_name'];?></td>
    <td class="style5"><?php echo $batchcount;?></td>
    <td class="style5"><?php echo $batchsum;?></td>
    <td class="style5"><?php printf("%.2f",$row['avgans']); //echo $row['avgans'];?></td>
  </tr>

<?php

}
?>
</table>
</body>

</html>