<?php
	if(!isset($_SESSION['logined'])){
		header("Location:admin_login.php");
		exit;
	}
	if((!isset($_SESSION['SelCat'])) || (!isset($_POST['log_CateID']))){
		header('Location:SelCat.php');
		exit;
	}
	include("inc/head.php");
	include("inc/ghome.lib.php");
	include("fckeditor20/fckeditor.php");
	$thisprog="gadd.php";
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
                <td colspan="2" class="msg_head">�ڷ���&nbsp;<font color="#FFFA20">
				  <?php 
						$Cats=GetCategories();
						$CatName=explode(':',$Cats[$_POST['log_CateID']]);
						$Cate_ID=$CatName[0];
						echo $CatName[1]; 
				  ?></font>&nbsp;�з�������־</td>
              </tr>
              <form name="input_form" method="post" action="<?php echo $thisprog; ?>" onSubmit="Javascript:return CheckForm();">  
      			<input type=hidden name=Cate_ID value=<?php echo $Cate_ID;?> />				
                <tr bgcolor="#FFFFFF">
                  <td width="112" align="right" nowrap><b>���⣺</b></td>
                  <td width="100%">
                    <input name="log_Title" type="text" id="log_Title" size="50">&nbsp;
                    <select name="log_Weather" id="log_Weather" onChange="document.images['show_Weather'].src='images/weather/'+options[selectedIndex].value.split('|')[0]+'.gif';" size="1">
                          <option value="0|δ֪" selected>����</option>
                          <option value="1|����">����</option>
                          <option value="2|����">����</option>	 
                          <option value="3|����">����</option>
                          <option value="4|�η�">�η�</option>
                          <option value="5|ѩ��">ѩ��</option>
                          <option value="6|�ʺ�">�ʺ�</option>
                          <option value="7|¶ˮ">¶ˮ</option>
                        </select>&nbsp;
                        <img id="show_Weather" id="show_Weather" src="images/weather/0.gif" align="absmiddle">
      					</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><strong>���ԣ�</strong></td>
                  <td><input name="log_IsShow" type="radio" value="0" checked> ������־&nbsp;&nbsp;<input type="radio" name="log_IsShow" value="1"> ������־</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><b>���ԣ�</b></td>
                  <td>					
					<input name="log_From" type="text" id="log_From" value=<?php echo $siteName; ?> size="12">
      				&nbsp;<b>��ַ��
                    <input name="log_FromURL" type="text" id="log_FromURL" value=<?php echo $siteUrl ?> size="38">
                  </b></td>
                </tr>
      		  <tr bgcolor="#FFFFFF">
      			<td align=right valign=top><b>����:</b></td>
      			<td>
      		  <?php
      		  	$oFCKeditor = new FCKeditor('log_Details') ;
				$oFCKeditor->BasePath='fckeditor20/';
				$oFCKeditor->Value='';
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
	include("inc/footer.php");
	?>
	