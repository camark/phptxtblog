<?php
	include("inc/head.php");
	include("inc/ghome.lib.php");
?>
<table width="768" border="0" align="center" cellpadding="4" cellspacing="6" background="images/blog_main.gif">
  <tr>
    <td width="128" align="center" valign="top" nowrap align="center" bgcolor="#FFFFFF"><br>
    <br><div class="msg_head">管理面板导航</div><div class="msg_main"><a href="admin.php"><b>管理首页</b></a><br />
</div><br><br></td>
    <td width="100%" valign="top" bgcolor="#FFFFFF" align="center">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" align="center">
      <br><br><br><br><table width="40%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF" class="siderbar_head">请输入管理员密码：</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><br>
		<form name="adminlogin" method="post" action="admin.php">
			<input type="password" id="adminpassword" name="adminpassword">&nbsp;
			<input type="submit" id="submit" name="submit" value=" 确定登陆 ">
		</form>
	</td>
  </tr>
</table>
</td>
  </tr>
</table></td>
  </tr>
</table>
<?php
	 include("inc/footer.php");
?>
