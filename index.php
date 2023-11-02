<html>
<head>
<title>Welcome to Training Feed Back System</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 18px;
	color: #660066;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style9 {
	color: #660066;
	font-weight: bold;
}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<form id="frmindex" name="frmindex" method="post" action="login.php">
 
  <table width="52%" height="219" align="center" >
    <tr bgcolor="#55A0FF">
      <td height="40" colspan="2" align="center"><span class="style1">Training Feed Back System </span></td>
    </tr>
    <tr bgcolor="#55A0FF">
      <td height="40" colspan="2" align="center"><table width="66%" height="148" border="1" bordercolor="#660066"  bgcolor="#55A0FF" class="loginbox style9">
          <tr align="center" bgcolor="#55A0FF">
            <td colspan="4"><p class="style16 style7">Login</p>
                <span class="style7">
                <?php
	/*if ($errorMessage != '') {
	print '<div align="center"><strong><font color="red">'.$errorMessage.'</font></strong></div>';
	}*/
	
	if(isset($_GET['login']) && $_GET['login']=='success')
	{
	echo "<p><h2>Correct User Id and Password.</h2></p>"; 
	}
	else if(isset($_GET['login']) && $_GET['login']=='failure')
	{
	echo "<p><h2>Wrong User Id and Password.</h2></p>"; 
	}
	
	
	
?>
              </span></td>
          </tr>
          <tr bgcolor="#55A0FF">
            <td align="right"><span class="style7">User Name:</span></td>
            <td colspan="3" align="left"><input name="userName" type="text" id="name" size="22" />
            </td>
          </tr>
          <tr bgcolor="#55A0FF">
            <td align="right"><span class="style7">Password:</span></td>
            <td colspan="3" align="left"><input name="pass" type="password" id="pass" size="22"/>
            </td>
          </tr>
          <tr bgcolor="#55A0FF">
            <td align="right" bgcolor="#55A0FF">&nbsp;</td>
            <td width="16%" align="left"><input name="Cancel" type="reset" class='loginButton ' id="Cancel" value="Reset" /></td>
            <td width="14%" align="left"><input name="Submit" type="submit"  class='loginButton ' onClick="javascript: if(name.value=='' || pass.value==''){alert('Please insert user id & password');return false;}" value="Login"></td>
            <td width="23%" align="left">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr bgcolor="#55A0FF">
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>