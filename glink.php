<?php
	include("inc/ghome.lib.php");
	checkLogin();
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
		  <tr>
			  <?php
				   include("inc/admin_left.php");
			  ?>
			  <td valign="top">
			  <?php
				   $links=file($linkFile);
				   if(isset($_POST['Submit']))
				   {
					   if($_REQUEST['action']=='addLink'){						   
						   $fHandle=fopen($linkFile,'a+');
						   $linkName=$_POST['link_Name'];
						   $linkUrl=$_POST['link_URL'];
						   $linkIntro=$_POST['link_Info'];
						   $strWrite=$linkName."\t".$linkUrl."\t".$linkIntro.$sepChar;
						   fwrite($fHandle,$strWrite);
						   fclose($fHandle);
	
						   $links[]=$strWrite;
					   }					   
				   }

				   if(isset($_REQUEST['action']) && $_REQUEST['action']=="delLink"){
					   $linkID=$_REQUEST['linkID'];
					   for($i=0;$i<count($links);$i++){
						   if($i!=$linkID)
							   $array[]=$links[$i];
					   }
					   $links=array();
					   if(count($array)>0){
						   $links=$array;
						   $fhandle=fopen($linkFile,"wb");
						   foreach($links as $link){
							   fwrite($fhandle,$link);
						   }
						   fclose($fhandle);
					   }
				   }
			  ?>
					<div class="content_head">
						<strong>现有的首页链接</strong>
					</div>
					<div class="content_main">
						<span class="hyperlink">
						<?php
							if(count($links)>0){							
								foreach($links as $link_num => $linkName)
								{
									list($link_Name,$link_Url,$link_Intro)=explode("\t",$linkName);
						?>	
							<a href="glink.php?action=delLink&linkID=<?= $link_num ?>" title="删除此首页链接" onClick="winconfirm('你真的要删除这个书签吗？','glink.php?action=delLink&linkID=<?= $link_num ?>'); return false"><b><font color="#FF0000">×</font></b></a>
							&nbsp;|&nbsp;
							<a href="<?= $link_Url ?>" target="_blank" title="<?= $link_Intro ?>"><?= $link_Name?></a><br>
						<?php
								}
							}
							else{
								echo "当前没有首页链接";
							}
						?>
						</span>
					</div>
					<div class="content_head">
						<strong>添加首页链接</strong> - 自己要小心啊！
					</div>
					<div class="content_main">
						<table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
						  <form name="blogFavAdd" method="post" action="glink.php?action=addLink">
						  <tr bgcolor="#FFFFFF">
							<td width="12%" align="center" nowrap>链接名称：</td>
							<td width="54%"><input name="link_Name" type="text" id="link_Name" size="32"> 
							<strong>必填</strong></td>
							<td width="34%">链接介绍：</td>
							</tr>
						  <tr bgcolor="#EFEFEF">
							<td align="center" nowrap bgcolor="#FFFFFF">站点地址：</td>
							<td bgcolor="#FFFFFF">
							  <input name="link_URL" type="text" id="link_URL" value="<?= $siteUrl ?>/" size="32">
							  <strong>必填</strong></td>
							<td rowspan="2" bgcolor="#FFFFFF"><textarea name="link_Info" cols="40" rows="3" wrap="VIRTUAL" id="link_Info"></textarea></td>
						  </tr>
						  <tr bgcolor="#EFEFEF">
							<td align="center" nowrap bgcolor="#FFFFFF"></td>
							<td bgcolor="#FFFFFF"><input type="submit" name="Submit" value=" 提交修改 "></td>
							</tr></form>
						</table>
					</div>			  
			  </td>
		  </tr>
</table>
<?php
	include("inc/footer.php");
?>
