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
				   $favsites=file($favFile);
				   if(isset($_POST['Submit']))
				   {
					   if($_REQUEST['action']=='addFav'){						   
						   $fHandle=fopen($favFile,'a+');
						   $favsiteName=$_POST['favsite_Name'];
						   $favsiteUrl=$_POST['favsite_URL'];
						   $favsiteIntro=$_POST['favsite_Info'];
						   $strWrite=$favsiteName."\t".$favsiteUrl."\t".$favsiteIntro."\n";
						   fwrite($fHandle,$strWrite);
						   fclose($fHandle);
	
						   $favsites[]=$strWrite;
					   }
				   }
				   if(isset($_REQUEST['action']) && $_REQUEST['action']=='delFav'){
					   $favID=$_REQUEST['FavID'];
					   for($i=0;$i<count($favsites);$i++){
						   if($favID!=$i)
							   $array[]=$favsites[$i];
					   }
					   $favsites=array();
					   if(isset($array)) $favsites=$array;
					   if(!isset($array)){
						   delete($favFile);
					   }
					   else
					   {
						   $fhandle=fopen($favFile,"wb");
						   foreach($array as $fav_temp){
							   fwrite($fhandle,$fav_temp);							
						   }
						   fclose($fhandle);
					   }
				   }					   
			  ?>
				<div class="content_head">
					<strong>admin �ĸ�����ǩ</strong>
				</div>
				<div class="content_main">
					<span class="hyperlink">
					<?php
   							if(count($favsites)>0){
								foreach($favsites as $fav_num => $favName)
								{
									list($fav_Name,$fav_Url,$fav_Intro)=explode("\t",$favName);
						?>	
						<a href="favorite.php?action=delFav&FavID=<?= $fav_num ?>" title="ɾ���˸�����ǩ" onClick="winconfirm('�����Ҫɾ�������ǩ��','favorite.asp?action=delFav&FavID=<?= $fav_num ?>'); return false"><b><font color="#FF0000">��</font></b></a>
						&nbsp;|&nbsp;
						<a href="<?= $fav_Url ?>" target="_blank" title="<?= $fav_Intro ?>"><?= $fav_Name ?></a><br>
					<?php
								}
							}
							else{
								echo "��ǰû�п��õ���ǩ";
							}
					?>
					</span>
				</div>
				<div class="content_head">
					<strong>��Ӹ�����ǩ</strong> - Ϊ�˴�ң��벻Ҫ�ύ�Ƿ���Ϣ
				</div>
				<div class="content_main">
					<table width="98%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
					  <form name="blogFavAdd" method="post" action="favorite.php?action=addFav">
					  <tr bgcolor="#FFFFFF">
						<td width="12%" align="center" nowrap>վ�����ƣ�</td>
						<td width="54%"><input name="favsite_Name" type="text" id="favsite_Name" size="32"> 
						<strong>����</strong></td>
						<td width="34%">վ����ܣ�</td>
						</tr>
					  <tr bgcolor="#EFEFEF">
						<td align="center" nowrap bgcolor="#FFFFFF">վ���ַ��</td>
						<td bgcolor="#FFFFFF"><input name="favsite_URL" type="text" id="favsite_URL" value="http://" size="32">
						  <strong>����</strong></td>
						<td rowspan="2" bgcolor="#FFFFFF"><textarea name="favsite_Info" cols="40" rows="3" wrap="VIRTUAL" id="favsite_Info"></textarea></td>
					  </tr>
					  <tr bgcolor="#EFEFEF">
						<td align="center" nowrap bgcolor="#FFFFFF"></td>
						<td bgcolor="#FFFFFF"><input type="submit" name="Submit" value=" �ύ��ǩ "></td>
						</tr></form>
					</table>
				</div>
			  </td>
		  </tr>
</table>
<?php
	 include("inc/footer.php");
?>

