<?php
	include("inc/ghome.lib.php");
	if(!isset($_SESSION['logined'])){
		$msg='����δ��½!';;
	}
	else
	{
		$msg="�ɹ��˳�,�ص�<a href=$homePage>��ҳ</a>";
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
