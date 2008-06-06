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
			alert("请输入标题");
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
                <td colspan="2" class="msg_head">在分类&nbsp;<font color="#FFFA20">
				  <?php 
						$Cats=GetCategories();
						$CatName=explode(':',$Cats[$_POST['log_CateID']]);
						$Cate_ID=$CatName[0];
						echo $CatName[1]; 
				  ?></font>&nbsp;中发表新日志</td>
              </tr>
              <form name="input_form" method="post" action="<?php echo $thisprog; ?>" onSubmit="Javascript:return CheckForm();">  
      			<input type=hidden name=Cate_ID value=<?php echo $Cate_ID;?> />				
                <tr bgcolor="#FFFFFF">
                  <td width="112" align="right" nowrap><b>标题：</b></td>
                  <td width="100%">
                    <input name="log_Title" type="text" id="log_Title" size="50">&nbsp;
                    <select name="log_Weather" id="log_Weather" onChange="document.images['show_Weather'].src='images/weather/'+options[selectedIndex].value.split('|')[0]+'.gif';" size="1">
                          <option value="0|未知" selected>天气</option>
                          <option value="1|晴天">晴天</option>
                          <option value="2|多云">多云</option>	 
                          <option value="3|雨天">雨天</option>
                          <option value="4|刮风">刮风</option>
                          <option value="5|雪天">雪天</option>
                          <option value="6|彩虹">彩虹</option>
                          <option value="7|露水">露水</option>
                        </select>&nbsp;
                        <img id="show_Weather" id="show_Weather" src="images/weather/0.gif" align="absmiddle">
      					</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><strong>属性：</strong></td>
                  <td><input name="log_IsShow" type="radio" value="0" checked> 公开日志&nbsp;&nbsp;<input type="radio" name="log_IsShow" value="1"> 隐藏日志</td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td align="right"><b>来自：</b></td>
                  <td>					
					<input name="log_From" type="text" id="log_From" value=<?php echo $siteName; ?> size="12">
      				&nbsp;<b>地址：
                    <input name="log_FromURL" type="text" id="log_FromURL" value=<?php echo $siteUrl ?> size="38">
                  </b></td>
                </tr>
      		  <tr bgcolor="#FFFFFF">
      			<td align=right valign=top><b>内容:</b></td>
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
      				<input type=submit value="提交文章内容">&nbsp;&nbsp;
      				<input type=reset value=重写>
      			</td>
      		</tr>
      		</table>				
      	</td>	
      </tr>
  	</table>
	<?php
	include("inc/footer.php");
	?>
	