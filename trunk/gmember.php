<?php	
	include("inc/ghome.lib.php");
	checkLogin();
	include("inc/head.php");	
	$thisprog='gmember.php';
?>
<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
   <tr>
	   <?php
			include("inc/admin_left.php");			
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
				$mailbox='';
				$isHideMail=1;
				$qq='';
				$homePage='';
				$Intro='';
			}
	   ?>
       <td valign="top">
	   <?php
			if(!isset($_POST['Submit'])){
	   ?>
	        <TABLE cellSpacing=1 cellPadding=4 width="95%" bgColor=#cccccc border=0>
				<TBODY>
					<TR bgColor=#efefef>
					  <TD colSpan=2><B>�༭��������</B></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <FORM id=form_mem name=form_mem
					  action=<?= $thisprog ?> method=post OnSubmit="Javascript:return checkForm();">
					  <script>
						function checkForm(){
							if(form_mem.mem_NewPassword.value!=form_mem.RePassword.value){
								alert("��������ȷ�����벻һ�£�");
								return false;
							}

							if(form_mem.mem_OldPassword.value.length==0){
								alert("�����������!");
								return false;
							}

							return true;
						}
		              </script>
					  <TD noWrap align=right width=98>���ƣ�</TD>
					  <TD width="100%">&nbsp;admin</TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>�����룺</TD>
					  <TD>&nbsp;<INPUT id=mem_OldPassword type=password size=16 
						name=mem_OldPassword> <SPAN class=htd><B><FONT 
						color=#ff0000>&nbsp;*</FONT></B> �޸����ϱ�������ԭ����</SPAN></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>�����룺</TD>
					  <TD>&nbsp;<INPUT id=mem_NewPassword type=password size=16 
						name=mem_NewPassword> &nbsp;<SPAN class=htd><B><FONT 
						color=#ff0000>*</FONT></B> ���������6-16λ</SPAN></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>ȷ�����룺</TD>
					  <TD>&nbsp;<INPUT id=mem_RePassword type=password size=16 
						name=mem_RePassword></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>�Ա�</TD>
					  <TD>
					    <?php
						foreach($sexs as $sex_index => $sex_temp){	
		                    $str='';
							if($sex_index==$sex)
								$str='checked';
							echo "<INPUT type=radio value=$sex_index $str name=mem_Sex> $sexs[$sex_index]";	
						}
						?>
					  </TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>���䣺</TD>
					  <TD>&nbsp;<INPUT id=mem_Email size=30 name=mem_Email value=<?= $mailbox ?>> &nbsp; <INPUT 
						id=mem_HideEmail type=checkbox <?php if($isHideMail) echo "checked" ?> name=mem_HideEmail> 
						��������</TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>��ѶQQ��</TD>
					  <TD>&nbsp;<INPUT id=mem_QQ name=mem_QQ value=<?= $qq ?>></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>������ҳ��</TD>
					  <TD>&nbsp;<INPUT id=mem_HomePage size=35 name=mem_HomePage value=<?= $homePage ?>></TD>
					</TR>
					<TR bgColor=#ffffff>
					  <TD noWrap align=right>���˼�飺</TD>
					  <TD>&nbsp;<TEXTAREA id=mem_Intro name=mem_Intro rows=5 wrap=VIRTUAL cols=50><?= $Intro ?></TEXTAREA></TD></TR>
					<TR align=middle bgColor=#ffffff>
					  <TD colSpan=2><INPUT type=submit value=" ȷ���༭ " name=Submit> 
						</TD>
					</TR>
					</FORM>
				</TBODY>
			</TABLE>
		<?php
			}
			else
			{
				if(file_exists($adminFile))
				{
					$admin_Info=file($adminFile);
					list($password,$sex,$mailbox,$isHideMail,$qq,$homePage,$Intro)=explode("\t",$admin_Info[0]);
					if($password!=$_POST['mem_OldPassword']){
		?>
					<p align="center">������������������룡</p>
		<?php
					}
					else{
						$fhandle=fopen($adminFile,"wb");
						if(!isset($_POST['mem_HideEmail'])){
							$isHideEmail=0;
						}
						else{
							$isHideEmail=1;
						}

						$strWrite=$_POST['mem_NewPassword']."\t".$_POST['mem_Sex']."\t".$_POST['mem_Email']."\t".$isHideEmail."\t".$_POST['mem_QQ']."\t".$_POST['mem_HomePage']."\t".$_POST['mem_Intro'].$sepChar;
						fwrite($fhandle,$strWrite);
						fclose($fhandle);
					}
				}
				else
				{
					if($adminpass!=$_POST['mem_OldPassword']){
		?>
				 <p align="center">������������������룡</p>
		<?php
					}
					else{
						$fhandle=fopen($adminFile,"wb");
						if(!isset($_POST['mem_HideEmail'])){
							$isHideEmail=0;
						}
						else{
							$isHideEmail=1;
						}

						$strWrite=$_POST['mem_NewPassword']."\t".$_POST['mem_Sex']."\t".$_POST['mem_Email']."\t".$isHideEmail."\t".$_POST['mem_QQ']."\t".$_POST['mem_HomePage']."\t".$_POST['mem_Intro'].$sepChar;
						fwrite($fhandle,$strWrite);
						fclose($fhandle);
					}
				}
		?>			
		<?php
			}
		?>
	   </td>
  </tr>
</table>
<?php
			 include("inc/footer.php");
?>
