<?php
	include("inc/ghome.lib.php");
	if(!isset($_SESSION['logined'])){
		$msg='你尚未登陆!';;
	}
	else
	{
		$msg="成功退出,回到<a href=$homePage>主页</a>";
		session_unregister('logined');
	}
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
		  <tr>
			  <td>
  				<p align="center"><?= $msg ?></p>
			  </td>
		  </tr>
</table>
<?php
	 include("inc/footer.php");
?>
