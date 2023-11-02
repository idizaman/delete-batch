<?php
session_start();
if(!isset($_SESSION['uid'])&&!isset($_SESSION['access']))
{die("<p>Access Restricted!!</p>");}
include("DBConnection.php");


		if (isset($_POST['Submit'])) 
		{
			 $batchID=$_POST['cmbBatchID'];
			 $set_query="select max(ques_set_id) as 'maxno' from questionset";
			 $set_result=mysql_query($set_query);
			 $set_id=mysql_result($set_result,0,"maxno");
			 echo $new_set=$set_id+1;
			

		foreach($_POST['queschk'] as $queschk) 
		{
			$queschk ;
			
			$insert_query="INSERT into questionset(ques_set_id,ques_id,batch_id)".
					  "values('$new_set','$queschk','$batchID')";
			$insert_query_result=mysql_query($insert_query);
		}

			 $update_query="update batch set ques_set_id='$new_set' where batch_name='$batchID'";
			 $update_result=mysql_query($update_query);


}


?>
<html>
<head>
<title>Assign Question To a batch</title>
<style type="text/css">
<!--
.style7 {font-size: 16px}
.style16 {color: #000000}
</style>
</head>

<body>
<form name="frmeditsave" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php			    
			  $batchNamequery="select batch_name from batch where ques_set_id is NULL";
			  $result=mysql_query($batchNamequery);
			  $num=mysql_num_rows($result);
			 
			 if($num=='0')
			 {
			  echo"No Batch Available to Create Question Set";
			 
			 }
			 
			 else
			 { 
			  
			  
?>

<table width="680" border="1" align="center" cellspacing="1" bordercolor="#000000" class="report">
  <tr  bgcolor="#54a8f4" class="style7">
    <th colspan="4"> Make Question Set</th>
  </tr>
  <tr bgcolor="#FFFFFF">
    <th><div align="left">Select Batch:</div></th>
    <th colspan="2"><div align="left">
    
        
    
      <select name="cmbBatchID">
                          
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
      </div></th>
    <th>&nbsp;</th>
  </tr>
  <tr bgcolor="#FFFFFF">
    <th colspan="4">&nbsp;</th>
  </tr>
  <tr bgcolor="#54a8f4">
    <th width="90">SL.NO</th>
    <th width="125">Question Type</th>
    <th width="388">Question</th>
    <th width="54">Select</th>
  </tr>
  <?php 

		$quest_query="select * from question where status='0' order by question_id";
		$quest_query_result=mysql_query($quest_query);
		
		$sl=0;
				while($row=mysql_fetch_array($quest_query_result, MYSQL_ASSOC))
				{
					$sl++;
?>
  <tr bgcolor="#DDEEFF">
    <td align="center"><span class="style16"><?php echo $sl;?></span></td>
    <td align="left"><span class="style16"><?PHP echo $row["ques_type"] ;?></span></td>
    <td align="left"><span class="style16"><?PHP echo $row["ques_text"] ;?></span></td>
    <td><span class="style16">&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="queschk[]" id="queschk" value="<?php echo $row["question_id"];?>" />
    </span></td>
  </tr>
  
  <?php				
				}		
	?>
 <tr bgcolor="#54a8f4">
    <td align="center">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="left"><input name="Submit" type="submit" id="button" value="Submit"></td>
    <td>&nbsp;</td>
  </tr>
</table>

<?php }?>
</form>
</body>
</html>
