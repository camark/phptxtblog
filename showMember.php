<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width=128>
			<strong>用户察看</strong>
		</td>
		<?php
			$sexs=array();
			$sexs[]='未知';
			$sexs[]='男';
			$sexs[]='女';			
			if(file_exists($adminFile))
			{
					$admin_Info=file($adminFile);
					list($password,$sex,$mailbox,$isHideMail,$qq,$homePage,$Intro)=explode("\t",$admin_Info[0]);
			}
			else
			{
				$sex=0;
				$mailbox='未知';
				$isHideMail=1;
				$qq='未知';
				$homePage='未知';
				$Intro='未知';
			}
		?>
		<td valign="top" align="center">
			<table width="95%" border="0" cellpadding="6" cellspacing="1" bgcolor="#CCCCCC">
			  <tr bgcolor="#EFEFEF">
				<td colspan="2"><b>用户 <font color="#FF0000">admin</font> 的详细资料：</b></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">名称：</td>
				<td>&nbsp;admin</td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td width="98" align="right" nowrap>性别：</td>
				<td width="100%">&nbsp;<?= $sexs[$sex] ?></td>
				</tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">邮箱：</td>
			  <?php
			    if($isHideMail)
					echo "<td>&nbsp;<a href='mailto:' alt='点击发送 Email'></a></td>";
				else
					echo "<td>&nbsp;<a href='mailto:$mailbox' alt='点击发送 Email'>$mailbox</a></td>";
			  ?>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">腾讯QQ：</td>
				<td>&nbsp;<a href='http://friend.qq.com/cgi-bin/friend/user_show_info?ln=<?= $qq ?>' target='_blank' alt='点击查看QQ信息'><?= $qq ?></a>&nbsp;</td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right" nowrap>个人主页：</td>
				<td>&nbsp;<a href='<?= $homePage ?>' target='_blank' alt='点击浏览主页'><?= $homePage ?></a></td>
			  </tr>			  
			  <tr bgcolor="#FFFFFF">
				<td align="right">个人介绍：</td>
				<td><?= $Intro ?></td>
			  </tr>
			  <tr bgcolor="#FFFFFF">
				<td align="right">注册时间：</td>
				<td>&nbsp;<?= $createTime ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php
	include("inc/footer.php");
?>