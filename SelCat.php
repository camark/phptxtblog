<?php	
	$_SESSION['SelCat']=1;
	include("inc/head.php");
	include("inc/ghome.lib.php");
?>
	<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
      <tr>
      	<td>
		  <table width="768" border="0" align="center" cellpadding="4" cellspacing="6"> 		  
				<tr>
				  <td width="128" align="center" nowrap><b>��������־<br>
					<br>
					<font color="#FF0000">ѡ�����</font>
				  </b></td>
				  <td align="center" valign="top"><table width="90%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
					<tr align="center">
					  <td colspan="2" class="msg_head">ѡ�����</td>
					  </tr>
					<form name="form_C" method="post" action="AddArticle.php">
					<tr bgcolor="#FFFFFF">
					  <td width="19%" align="right"><b>���ࣺ</b></td>
					  <td width="81%"><select name="log_CateID" id="log_CateID">
					<?php
					$classes=GetCategories();
					foreach ($classes as $classx) {
					   $Cats=explode(':',$classx);					  
					   echo "<option value=$Cats[0]>$Cats[1]</option>";
					}
					?>
					  </select>
					  </td>
					</tr>
					<tr align="center" bgcolor="#FFFFFF">
					  <td colspan="2"><input name="C_Submit" type="submit" id="C_Submit" value=" ȷ �� "></td>
					  </tr></form>
				  </table></td>
				</tr>
			  </table>
		</td>
	  </tr>
	</table>
	<?php
	include("inc/footer.php");
	?>
	
