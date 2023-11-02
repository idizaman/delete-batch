<?php 
include("DBConnection.php");
if ( isset($_POST['btnAdd']))
{  

	$topicText=$_POST['txttopic'];

    $topicSaveQuery="INSERT into topic(topic_text)"."values('$topicText')";

	mysql_query($topicSaveQuery)or die(mysql_error());



echo "Topics Successfuly added";

}
?>

<html>
<head>
<title>Add/Delete/Edit question</title>

<script type="text/javascript" src="td.js"></script>

<script type="text/JavaScript">
function formCheck()
{

	if (window.document.frmaddtopics.txttopic.value == "" )
	{
	  
	  window.alert('Write Topics');
	  return false;	
	}
	else
	{
		return true;
	}
}

</script>


<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
.style7 {font-size: 16px}
.style10 {color: #000000}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; color: #000000; }
</style>

</head>

<body>
<form name="frmaddtopics" action="<?php $_SERVER['PHP_SELF']?>" method="post" onSubmit="var x= formCheck();return x;">

<?php 
if ( !isset($_POST['btnAdd']))
{

?>

<table width="383" height="113" border="0" align="center" bgcolor="#54a8f4">
  <tr class="style5">
    <td colspan="2"><div align="center" class="style7">Add Topics</div></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td colspan="2" class="style5 style10">Topic:</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td height="25" colspan="2" class="style11"><input name="txttopic" type="text" id="txttopic" size="50" maxlength="100"/></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="163" height="26">&nbsp;</td>
    <td width="210"><input type="reset" name="Reset" id="button" value="Reset" />
    <input type="submit" name="btnAdd" id="btnAdd" value="add" /></td>
  </tr>
</table>
<?php }?>

</form>

</body>
</html>
