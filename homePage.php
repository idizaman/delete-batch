<?php
/*******SESSION MAINTENANCE***********/
session_start();
if(!isset($_SESSION['uid'])&&!isset($_SESSION['access']))
{die("<p>Access Restricted!!</p>");}
/*************************************/
$access=$_SESSION['access'];
$eid=$_SESSION['uid'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>Training Feed Back System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="report/sddm.css" >

<style type="text/css">
<!--
/* The "clearFix" class is used for clearing the main menu items because they
   are left-floated for horizontal main menus and we have to clear them if our main
   menu is relatively positioned (as in this example) so that the main menu box
   takes its place correctly on the page. We have to apply this class to the parent
   DIV of the root UL of our menu tree. Please take a look at section 6.1 in the
   SmartMenus User's Manual for a detailed explanation if you like. */

.clearFix:after { /* for modern browsers */
    content:".";
    display:block;
    height:0;
    clear:both;
    visibility:hidden;
}
.clearFix { /* for IE7/Win */
    min-height:1px;
}
* html .clearFix { /* for IE5-6/Win */
    height:1px;
}
* html>body .clearFix { /* for IE5/Mac */
    height:auto;
    display:inline-block;
}
.style4 {
	font-size: 24px
}
.style5 {
	color: #000066;
	font-weight: bold;
}
.style6 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>




<!-- SmartMenus 6 config and script core files -->
<script type="text/javascript" src="SM6/c_config.js"></script>
<script type="text/javascript" src="SM6/c_smartmenus.js"></script>
<!-- SmartMenus 6 config and script core files -->






</head>

<body bgcolor="#54a8f4">
<table width="100%">
<tr ><td colspan="2"><table><td height="46"><img src="images/New_logo_2.jpg" alt="" width="48" height="44"></td>
<td><h1 align="left" class="subItem style4 style5">Training Feed Back System</h1></td></table></td>
</tr>
<tr>
  <td width="65%">
  <div class="clearFix" style="width:20em;padding:0;background:#54a8f4;border:1px solid;border-color:#54a8f4;"><?php echo 'welcome '.$_SESSION['uid'];?> <a href="logout.php" >[sign out]</a>&nbsp;<a href="changePassword.php" >[Change Password]</a><?php
if(isset($_GET['passChange']) && $_GET['passChange']=='success')
{
	echo "Password Succesfuly Changed.";
}	
?></div> </td>
 
 <td width="35%">
<div class="clearFix" style="width:35em;padding:0;background:#54a8f4;border:1px solid;border-color:#54a8f4;">
<ul id="Menu1" class="MM">
  <li>
  <a href="homePage.php">Home</a>
  </li>
 <?php if($access==1){?>
  <li><a href="#">Training  Feed Back</a>
    <ul>
      <li><a href="feedback_question.php" target='basefrm'>Feed Back Entry</a></li>
      </ul>
  </li>
  
    <li><a href="#">Batch Manager</a>
     <ul>
      <li><a href="view_batch.php" target='basefrm'>View Batch</a></li>
      <li><a href="create_batch.php" target='basefrm'>Create Batch</a></li>
    </ul>
   </li> 
   <li><a href="#">Question Manager</a>
     <ul>
      <li><a href="assign_question.php" target='basefrm'>Assign Question</a></li>
      </ul>
      </li>
      
    <li><a href="#">Training Reports</a>
    <ul>
      <li><a href="batch_report.php" target='basefrm'>Feed Back Report</a></li>
      <li><a href="comments_report_trainer.php" target='basefrm'>View Batch wise Comments</a></li>
      </ul>
   </li>  
      
          
  <?php }?>
 
 
 <?php if($access==3){?>
  <li><a href="#">Training  Feed Back</a>
    <ul>
      <li><a href="feedback_question.php" target='basefrm'>Feed Back Entry</a></li>
      </ul>
  </li>
  
  <li><a href="#">Training Reports</a>
    <ul>
      <li><a href="batch_report.php" target='basefrm'>Feed Back Report</a></li>
      <li><a href="trainer_report.php" target='basefrm'>Trainer Wise Report</a></li>
       <li><a href="comments_report.php" target='basefrm'>View Batch wise Comments</a></li>
    </ul>
   </li>
   <li><a href="#">Batch Manager</a>
     <ul>
     <li><a href="view_batch.php" target='basefrm'>View Batch</a></li>
      <li><a href="create_batch.php" target='basefrm'>Create Batch</a></li>
      <li><a href="delete_batch.php" target='basefrm'>Delete Batch</a></li>
    </ul>
   </li> 
   <li><a href="#">Question Manager</a>
     <ul>
      <li><a href="assign_question.php" target='basefrm'>Assign Question</a></li>
      <li><a href="view_question.php" target='basefrm'>View Question</a></li>
      <li><a href="add_question.php" target='basefrm'>Add Question</a></li>
      <li><a href="add_topics.php" target='basefrm'>Add Topic </a></li>
      <li><a href="view_topics.php" target='basefrm'>View Topics </a></li>
      </ul>
      </li>
    <li><a href="#">User Manager</a>
     <ul>
      <li><a href="add_trainer.php" target='basefrm'>Add Trainer</a></li>
      <li><a href="update_trainer.php" target='basefrm'>Update Trainer Info</a></li>   
      
    </ul>
   </li>  
          
  <?php }?>
</ul>
</div></td>
</tr>
<tr><td colspan="2"align="center">
<div >
 
  <iframe width="100%" name="basefrm" scrolling="auto" frameborder="1" height="452"></iframe>
</div>
</td><tr>
<tr><td colspan="2"><div class="footer" id="footerDiv"> 
  <div align="center" class="style6">Copyright © CCD MIS Team, Planning &amp; Development, CCD</div>
</div>
</td></tr>
</table>
</body>
</html>