<?php
	if(!isset($_SESSION['logined'])){
		header("Location:admin_login.php");
		exit;
	} 

	if(!isset($_REQUEST['logID'])){
		header("Location:gErrorPage.php?msg=���ܽ��б༭::��û��������Ҫ�༭�����");
		exit;
	}

	include("inc/head.php");
	include("inc/ghome.lib.php");
	include("fckeditor20/fckeditor.php");
	$thisprog="gModify.php";
?>
	<script>
	function CheckForm(){
		if(input_form.log_Title.value.length==0){
			alert("���������");
			return false;
		}	
				
		return true;
	}
	</script>
	<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
      <tr>
      	<td>		    
      		<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
              <tr align="center">
                <td colspan="2" class="msg_head">�޸���־</td>
				  <?php 
						$Cats=GetCategories();
						$logID=$_REQUEST['logID'];
						if(file_exists("data/$logID.cgi"))
						{
							$lines=file("data/$logID.cgi");							
							list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=split("\t",$lines[0]);
				  ?>
              </tr>
              <form name="input_form" method="post" action="<?php echo $thisprog; ?>" onSubmit="Javascript:return CheckForm();">  
      			<input type=hidden name=logID value=<?php echo $logID;?> />				
                <tr bgcolor="#FFFFFF">
				  <td width=112 align=right nowrap><b>����</b></td>
				  <td>����:<?= $siteName ?><input type=checkbox name="delblog" value=1>ɾ������־ 
				      ת����־����� 
					    <select name="Cate_ID">
						<?php
							foreach($Cats as $Cat){
								list($CatID,$CatName)=explode(":",$Cat);
								echo "<Option value=$CatID>$CatName</Option>";
							}
						?>
						</select>
				  </td>
				</tr>
				<tr bgcolor="#FFFFFF">
                  <td width="112" align="right" nowrap><b>���⣺</b></td>
                  <td width="100%">
                    <input name="log_Title" type="text" id="log_Title" size="50" value="<?= $Title ?>">&nbsp;
                    <select name="log_Weather" id="log_Weather" onChange="document.images['show_Weather'].src='images/weather/'+options[selectedIndex].value.split('|')[0]+'.gif';" size="1">
                          <?php
							   $Weathers=array("0|δ֪","1|����","2|����","3|����","4|�η�","5|ѩ��","6|�ʺ�","7|¶ˮ");
                               foreach($Weathers as $Weather_temp){
								   list($id_temp,$name_temp)=explode("|",$Weather_temp);
								   if($Weather_temp==$Weather){
									   echo "<option value=$Weather_temp selected>$name_temp</options>";
								   }
								   else{
									   echo "<option value=$Weather_temp>$name_temp</options>"; 
								   }
							   }
                          ?>
					</select>&nbsp;										
					<img id="show_Weather" id="show_Weather" src="images/weather/0.gif" align="absmiddle">
					</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><strong>���ԣ�</strong></td>
                  <td><input name="log_IsShow" type="radio" value="0" <?php if($isShow) echo "checked"; ?>> ������־&nbsp;&nbsp;
					  <input type="radio" name="log_IsShow" value="1" <?php if(!$isShow) echo "checked"; ?>> ������־</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><b>���ԣ�</b></td>
                  <td>					
					<input name="log_From" type="text" id="log_From" value=<?php echo $From; ?> size="12">
      				&nbsp;<b>��ַ��
                    <input name="log_FromURL" type="text" id="log_FromURL" value=<?php echo $FromUrl ?> size="38">
                  </b></td>
                </tr>
      		  <tr bgcolor="#FFFFFF">
      			<td align=right valign=top><b>����:</b></td>
      			<td>
      		  <?php
      		  	$oFCKeditor = new FCKeditor('log_Details') ;
				$oFCKeditor->BasePath='fckeditor20/';
				$oFCKeditor->Value="$Details";
				$oFCKeditor->Height=400;
				$oFCKeditor->Create() ;
      		  ?>
      			</td>
      		  </tr>
      		<tr bgcolor="#FFFFFF">
      			<td colspan=2 align=center>
      				<input type=submit value="�ύ��������">&nbsp;&nbsp;
      				<input type=reset value=��д>
      			</td>
      		</tr>
      		</table>				
      	</td>	
      </tr>
  	</table>
	<?php
						}
	include("inc/footer.php");
	?>
	