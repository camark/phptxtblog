<?php
	include("inc/ghome.lib.php");		
	if(!isset($_POST['adminpassword']))
	{
		header("location:admin_login.php");
	}
	include("inc/head.php");	
?>
<?php
	 $pass=$_POST['adminpassword'];
	 
	 if($pass!=getAdminpass()){
?>
<table width="768" border="0" align="center" cellpadding="4" cellspacing="6" background="images/blog_main.gif">
	<tr>
		<td>
			<p align=center>УмТыДэЮѓЃЌЧы<a href="admin_login.php">жиаТЕЧТН!</a></p>
		</td>
	</tr>
</table>
<?php	  
	 }
	 else{
		 $_SESSION['logined']=1;
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>	   
			<?php
				 include("inc/admin_left.php");
			?>		
		<td>
			<?php
				 include("inc/allArticle.php");
			?>
		</td>
	</tr>
</table>
<?php
	 }
	 include("inc/footer.php");
?>


