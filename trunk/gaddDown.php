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
					  <TD colSpan=2><B>¼�����</B></TD>
				</TR>
				<tr bgColor=#ffffff>
					<td>�������</td>
					<td><input name="softName"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>����ƽ̨</td>
					<td><input name="softOs"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>��������</td>
					<td><input name="softDevtool"></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>ʹ��˵��</td>
					<td><textarea name="softReadme" cols=60 rows=5></textarea></td>
				</tr>
				<tr bgColor=#ffffff>
					<td>���ص�ַ</td>
					<td><input name="softDurl"></td>
				</tr>
                 <TR align=middle bgColor=#ffffff>
					  <TD colSpan=2><INPUT type=submit value=" ��д��� " name=Submit> 
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

