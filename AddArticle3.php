<?php
	//if((!isset($_SESSION['SelCat'])) || (!isset($_POST['log_CateID']))){
	//	header('Location:SelCat.php');
	//	exit;
	//}
	include("inc/head.php");
	include("inc/ghome.lib.php");
	$thisprog="gadd.php";
?>
	<script>
	function CheckForm(){
		if(input.log_Title.value.length==0){
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
						$CatName=explode(':',$Cats[$_POST['log_CateID']-1]);
						$Cate_ID=$CatName[0];
						echo $CatName[1]; 
				  ?></font>&nbsp;中发表新日志</td>
              </tr>
              <form name="input" method="post" action="<?php echo $thisprog; ?>" onSubmit="Javascript:return CheckForm();">  
      			<input type=hidden name=Cate_ID value=<?php echo $Cate_ID;?> />				
                <tr bgcolor="#FFFFFF">
                  <td align="right" nowrap><b>标题：</b></td>
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
					</b>
				  </td>
                </tr>      		  
      			<tr bgcolor="#FFFFFF">
					<script language="JavaScript" src="inc/ubbhelp.js"></script>
					<script language="JavaScript" src="inc/ubbcode.js"></script>
      				<td valign=top align=right>
						<b>内容:</b>
						<br>
						<br>
						<table width="98%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
							<tr>
							  <td align="center" bgcolor="#EFEFEF"><b>表&nbsp;&nbsp;情</b></td>
							</tr>
							<tr>
							  <td bgcolor="#FFFFFF">
									<img style="cursor:hand;" onclick="AddText('[arrow]');" src="images/smilies/icon_arrow.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[biggrin]');" src="images/smilies/icon_biggrin.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[confused]');" src="images/smilies/icon_confused.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[cool]');" src="images/smilies/icon_cool.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[cry]');" src="images/smilies/icon_cry.gif" /><br> 
									<img style="cursor:hand;" onclick="AddText('[eek]');" src="images/smilies/icon_eek.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[evil]');" src="images/smilies/icon_evil.gif" />
									<img style="cursor:hand;" onclick="AddText('[exclaim]');" src="images/smilies/icon_exclaim.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[frown]');" src="images/smilies/icon_frown.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[idea]');" src="images/smilies/icon_idea.gif" /><br>  
									<img style="cursor:hand;" onclick="AddText('[lol]');" src="images/smilies/icon_lol.gif" />
									<img style="cursor:hand;" onclick="AddText('[mad]');" src="images/smilies/icon_mad.gif" />
									<img style="cursor:hand;" onclick="AddText('[mrgreen]');" src="images/smilies/icon_mrgreen.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[neutral]');" src="images/smilies/icon_neutral.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[question]');" src="images/smilies/icon_question.gif" /><br>  
									<img style="cursor:hand;" onclick="AddText('[razz]');" src="images/smilies/icon_razz.gif" />
									<img style="cursor:hand;" onclick="AddText('[redface]');" src="images/smilies/icon_redface.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[rolleyes]');" src="images/smilies/icon_rolleyes.gif" />
									<img style="cursor:hand;" onclick="AddText('[sad]');" src="images/smilies/icon_sad.gif" /> 
									<img style="cursor:hand;" onclick="AddText('[smile]');" src="images/smilies/icon_smile.gif" /> <br> 
									<img style="cursor:hand;" onclick="AddText('[surprised]');" src="images/smilies/icon_surprised.gif"/> 
									<img style="cursor:hand;" onclick="AddText('[twisted]');" src="images/smilies/icon_twisted.gif" />
									<img style="cursor:hand;" onclick="AddText('[wink]');" src="images/smilies/icon_wink.gif" />	
								</td>
							</tr>
						  </table>
					</td>
					<td>
					<table width="98%" border="0" cellspacing="0" cellpadding="2">
					  <tr>
						<td width="100%">
							<select name="font" onFocus="this.selectedIndex=0" onChange="chfont(this.options[this.selectedIndex].value)" size="1">
								<option value="" selected>选择字体</option>
								<option value="宋体">宋体</option>
								<option value="黑体">黑体</option>
								<option value="Arial">Arial</option>
								<option value="Book Antiqua">Book Antiqua</option>
								<option value="Century Gothic">Century Gothic</option>
								<option value="Courier New">Courier New</option>
								<option value="Georgia">Georgia</option>
								<option value="Impact">Impact</option>
								<option value="Tahoma">Tahoma</option>
								<option value="Times New Roman">Times New Roman</option>
								<option value="Verdana">Verdana</option>
							 </select>
							<select name="size" onFocus="this.selectedIndex=0" onChange="chsize(this.options[this.selectedIndex].value)" size="1">
							  <option value="" selected>字体大小</option>
							  <option value="-2">-2</option>
							  <option value="-1">-1</option>
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							  <option value="6">6</option>
							  <option value="7">7</option>
							</select>
							<select name="color"  onFocus="this.selectedIndex=0" onChange="chcolor(this.options[this.selectedIndex].value)" size="1">
							  <option value="" selected>字体颜色</option>
							  <option value="White" style="background-color:white;color:white;">White</option>
							  <option value="Black" style="background-color:black;color:black;">Black</option>
							  <option value="Red" style="background-color:red;color:red;">Red</option>
							  <option value="Yellow" style="background-color:yellow;color:yellow;">Yellow</option>
							  <option value="Pink" style="background-color:pink;color:pink;">Pink</option>
							  <option value="Green" style="background-color:green;color:green;">Green</option>
							  <option value="Orange" style="background-color:orange;color:orange;">Orange</option>
							  <option value="Purple" style="background-color:purple;color:purple;">Purple</option>
							  <option value="Blue" style="background-color:blue;color:blue;">Blue</option>
							  <option value="Beige" style="background-color:beige;color:beige;">Beige</option>
							  <option value="Brown" style="background-color:brown;color:brown;">Brown</option>
							  <option value="Teal" style="background-color:teal;color:teal;">Teal</option>
							  <option value="Navy" style="background-color:navy;color:navy;">Navy</option>
							  <option value="Maroon" style="background-color:maroon;color:maroon;">Maroon</option>
							  <option value="LimeGreen" style="background-color:limegreen;color:limegreen;">LimeGreen</option>
						   </select>
						  </td>
						<td rowspan="2" nowrap><b>模式：</b>&nbsp;
							<input type="radio" name="mode" value="2" onclick="chmode('2')" checked>
							基本&nbsp;
							 <input type="radio" name="mode" value="0" onclick="chmode('0')">
							高级&nbsp;
							<input type="radio" name="mode" value="1" onclick="chmode('1')">
						帮助</td>
					  </tr>
					  <tr>
						<td>
						<a href="javascript:bold()"><img src="images/ubbcode/bb_bold.gif" border="0" alt="插入粗体文本"></a>
						<a href="javascript:italicize()"><img src="images/ubbcode/bb_italicize.gif" border="0" alt="插入斜体文本"></a> 
						<a href="javascript:underline()"><img src="images/ubbcode/bb_underline.gif" border="0" alt="插入下划线"></a> 
						<a href="javascript:center()"><img src="images/ubbcode/bb_center.gif" border="0" alt="居中对齐"></a> 
						<a href="javascript:hyperlink()"><img src="images/ubbcode/bb_url.gif" border="0" alt="插入超级链接"></a> 
						<a href="javascript:email()"><img src="images/ubbcode/bb_email.gif" border="0" alt="插入邮件地址"></a> 
						<a href="javascript:image()"><img src="images/ubbcode/bb_image.gif" border="0" alt="插入图像"></a> 
						<a href="javascript:flash()"><img src="images/ubbcode/bb_flash.gif" border="0" alt="插入 Flash"></a> 
						<a href="javascript:code()"><img src="images/ubbcode/bb_code.gif" border="0" alt="插入代码"></a> 
						<a href="javascript:quote()"><img src="images/ubbcode/bb_quote.gif" border="0" alt="插入引用"></a> 
						<a href="javascript:list()"><img src="images/ubbcode/bb_list.gif" border="0" alt="插入列表"></a> 
						<a href="javascript:wma()"><img src="images/ubbcode/bb_wma.gif" alt="插入音频文件" width="23" height="22" border="0"></a> 
						<a href="javascript:wmv()"><img src="images/ubbcode/bb_wmv.gif" alt="插入视频文件" width="23" height="22" border="0"></a>
						</td>
					  </tr>
					</table>
				  <table width="98%" border="0" cellpadding="0" cellspacing="0">
					<tr valign="top">
					  <td><textarea name="log_Details" style="width:100%" rows="18" wrap="VIRTUAL" id="Message" onSelect="javascript: storeCaret(this);" onClick="javascript: storeCaret(this);" onKeyDown="javascript: ctlent();" onKeyUp="javascript: storeCaret(this);"></textarea></td>
					</tr>
				  </table>
				</td>
      		</tr>
      		</table>				
      	</td>	
      </tr>
  	</table>
	<?php
	include("inc/footer.php");
	?>
	