<?php
	if(!isset($_SESSION['logined'])){
		header("Location:admin_login.php");
		exit;
	}
	include("inc/ghome.lib.php");
	include("inc/head.php");   
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<?php
			 include("inc/admin_left.php");
		?>
		<td valign="top">
			<form method="post" action="gDlAdd.php">			
			 <table cellSpacing=1 cellPadding=4 width="95%" bgColor=#cccccc border=0>
                <TR bgColor=#efefef>
					  <TD colSpan=2><B>录入软件</B></TD>
				</TR>
				<tr bgColor=#ffffff>
					<td>软件名称</td>
					<td><input name="softName"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>运行平台</td>
					<td><input name="softOs"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>开发工具</td>
					<td><input name="softDevtool"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>使用说明</td>
					<td><textarea name="softReadme" cols=60 rows=5></textarea></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>下载地址</td>
					<td><input name="softDurl"></td>
				</tr>
                 <TR align=middle bgColor=#ffffff>
					  <TD colSpan=2><INPUT type=submit value=" 填写完毕 " name=Submit> 
						</TD>
				 </TR>
			</table>	
			</form>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>

