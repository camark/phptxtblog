<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width=128>
			<strong>�û��쿴</strong>
		</td>
		<?php
			$sexs=array();
			$sexs[]='δ֪';
			$sexs[]='��';
			$sexs[]='Ů';			
			if(file_exists($adminFile))
			{
					$admin_Info=file($adminFile);
					list($password,$sex,$mailbox,$isHideMail,$qq,$homePage,$Intro)=explode("\t",$admin_Info[0]);
			}
			else
			{
				$sex=0;
				$mailbox='δ֪';
				$isHideMail=1;
				$qq='δ֪';
				$homePage='δ֪';
				$Intro='δ֪';
			}
		?>
		<td valign="top" align="center">
			<table width="95%" border="0" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
			  <tr bgcolor="#EFEFEF">
				<td colspan="2"><b>�û� <font color="#FF0000">admin</font> ����ϸ���ϣ�</b></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">���ƣ�</td>
				<td>&nbsp;admin</td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td width="98" align="right" nowrap>�Ա�</td>
				<td width="100%">&nbsp;<?= $sexs[$sex] ?></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">���䣺</td>
			  <?php
			    if($isHideMail)
					echo "<td>&nbsp;<a href='mailto:' alt='������� Email'></a></td>";
				else
					echo "<td>&nbsp;<a href='mailto:$mailbox' alt='������� Email'>$mailbox</a></td>";
			  ?>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">��ѶQQ��</td>
				<td>&nbsp;<a href='http://friend.qq.com/cgi-bin/friend/user_show_info?ln=<?= $qq ?>' target='_blank' alt='����鿴QQ��Ϣ'><?= $qq ?></a>&nbsp;</td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right" nowrap>������ҳ��</td>
				<td>&nbsp;<a href='<?= $homePage ?>' target='_blank' alt='��������ҳ'><?= $homePage ?></a></td>
			  </tr>			  
			  <tr bgcolor="#FFFFFF">
				<td align="right">���˽��ܣ�</td>
				<td><?= $Intro ?></td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">ע��ʱ�䣺</td>
				<td>&nbsp;<?= $createTime ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php
	include("inc/footer.php");
?>