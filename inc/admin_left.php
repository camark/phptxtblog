		<script language="JavaScript">
		  <!--
			var now = new Date();
			var month = new Date( fixYear( now.getYear() ), now.getMonth(), 1 );			
			function fixYear( year )
			{
			  return( year < 1000 ? year + 1900 : year );
			}
			
			function getNumberDays( d )
			{
			  switch( d.getMonth() + 1 )
			  {
			case 1: case 3: case 5: case 7:
			case 8: case 10: case 12:
			  return( 31 );
			case 4: case 6: case 9: case 11:
			  return( 30 );
			case 2:
			  return( 28 + ( d.getYear % 4 == 0 ? 1 : 0 ) );
			  }
			}
		  //-->
	    </script>
		<td width="168" bgcolor="#f8f8f8" valign="top">
			<div class="siderbar_head">
				<img src="images/sider_member.gif" align="absmiddle" border="0" />
				 用户中心
			</div>
			<div class="siderbar_main">
				你好，admin<br>
				<a href="AddArticle.php">
					<img src="images/icon_newblog.gif" align="absmiddle" border="0" />发表文章</a>
				&nbsp;|&nbsp;
				<a href="gClass.php">
					<img src="images/icon_admincp.gif" align="absmiddle" border="0" />分类管理</a>
				<br>
				<a href="favorite.php">
				    <img src="images/icon_favorite.gif"align="absmiddle" border="0" />网络书签</a>
				&nbsp;|&nbsp;
				<a href="glink.php">
					<img src="images/icon_forum.gif" align="absmiddle" border="0" />首页链接</a>
				<br>
				<a href="gmember.php">
				     <img src="images/icon_memedit.gif"align="absmiddle" border="0" />修改资料</a>
				&nbsp;|&nbsp;
				<a href="gIntoLib.php">
					<img src="images/icon_agent.gif" align="absmiddle" border="0" />文章入库</a>
				<br>				
				<a href="gaddDown.php">
					<img src="images/icon_media.gif" align="absmiddle" border="0" />软件下载</a>
				&nbsp;|&nbsp;
				<a href="admin_logout.php">
					<img src="images/icon_logout.gif" align="absmiddle" border="0" />退出登录</a>
			</div>
			<br>
			<div class="siderbar_head">
				<img src="images/sider_calendar.gif" align="absMiddle" border="0"> 日历
			</div>
			<script>
				document.write("<table border=0 cellpadding=2 cellspacing=1 width=100% background=images/Calendar/month"+(now.getMonth()+1)+".gif>");
			</script>	
					<tr>
						<td align="middle" colspan="7">
							<script lanugage="javascript">
							    document.write(now.getYear()+"-"+(now.getMonth()+1));
							</script>
						</td>
					</tr>
					<tr>
					</tr>
					<tr class="calendar-week" bgcolor="#f8f8f8">
						<td><b>日</b></td>
						<td><b>一</b></td>
						<td><b>二</b></td>
						<td><b>三</b></td>
						<td><b>四</b></td>
						<td><b>五</b></td>
						<td><b>六</b></td>
					</tr>
					<tr>
						<script language="JavaScript">
						<!--
						  var startDay = month.getDay();
						  for( i = 0 ; i < startDay ; i++ )
						  {
							document.write( "<td></td>" );
						  }
				
						  var numDays = getNumberDays( month );
						  for( i = 0 ; i < numDays ; i++ )
						  {
							if( ( i + startDay + 1 ) % 7 == 1 )
							{
							  document.write( "</tr><tr>" );
							}
				
						if(i+1==now.getDate())
						{
						   document.write( "<td class='calendar'><font color=blue>" +
													 (i+1) + "</font></td>" ); 
						}
						else
						{
						   document.write( "<td class='calendar'>" +
													 (i+1) + "</td>" ); 
						}
							
						  }        
						// -->
						</script>
					</tr>
				</table>
                <br>
				<div class="siderbar_head">
					<img src="images/sider_siteinfo.gif" border="0" align="absmiddle" /> 站点统计
				</div>
				<div class="siderbar_main">日志：<?= gaCount() ?> 篇<br>
					评论：<?= getCommentCount() ?> 篇<br>
					引用：0 个</a><br>
					会员：1 人<br>
					<a href="gVisit.php">访问：<?= getVisitCount() ?> 次</a><br>
					建立：<?= $createTime ?>
				</div>
				<br>
				<div class="siderbar_head">
					<img src="images/sider_newcomm.gif" border="0" align="absmiddle" /> 最新评论
				</div>
				<div class="siderbar_main">
				<?php
					if(file_exists($topComment)){
						$topComments=file($topComment);
						if(count($topComments)>0){
							foreach($topComments as $top_temp){
								list($Author,$day,$msg,$ArticleID,$CommentID)=explode("\t",$top_temp);
								$msg=trim($msg);
								$msg=ltrim($msg);
								if(strlen($msg)>20)
									$tempmsg=substr($msg,0,20);
								else
									$tempmsg=$msg;
								echo "<a href=viewarticle.php?logID=$ArticleID#commentmark_$CommentID title=$Author 于$day 发布评论:$msg>$tempmsg</a><br>";
							}
						}
					}
					else
					{
						echo '暂时没有评论....';
					}
				?>
				</div>
				<br>
				<div class="siderbar_head">
					<img src="images/sider_search.gif" border="0" align="absmiddle"> 日志搜索
				</div>
				<div class="siderbar_main">
					<form name="blogsearch" method="post" action="search.php">
						<input name="SearchContent" type="text" id="SearchContent" size="18" title="请输入要搜索的内容" />
						<input name="Submit" type="Image" id="Submit" value="" src="images/go.gif" align="absmiddle" style="height:17px;width:18px" />
					</form>
				</div>
				<br>
				<div class="siderbar_head">
					<img src="images/sider_links.gif" border="0" align="absmiddle" /> 友情链接
				</div>
	            <div class="siderbar_main">
					<div class="hyperlink"><a href="" target="_blank"></a>
					</div>
					<div align="right" style="margin: 4px;">
					<?php
						if(file_exists('data/favorite.cgi')){
							$favs=file('data/favorite.cgi');
							foreach($favs as $fav){
								list($fav_name,$fav_url,$fav_intro)=explode("\t",$fav);
								echo "<a href=$fav_url target=_blank title=$fav_intro>$fav_name</a><br>";
							}
						}
				    ?>
						<a href="glinks.php">更多友情链接...</a>
					</div>
				</div>

				<div class="siderbar_head">
					<img src="images/sider_other.gif" border="0" align="absmiddle" /> 
					其他信息
				</div>
				<div class="siderbar_main" align="center">
					<br>
					<img src="images/powered_php.png" width=80 height=31><br />
					<img src="images/gbk.gif" border="0" alt="BLOG编码" align="absmiddle"><br />
					<a href="blogrss1.php" target="_blank"><img src="images/rss1.gif" border="0" alt="RSS 1.0" align="absmiddle"></a><br />
					<a href="blogrss2.php" target="_blank"><img src="images/rss2.gif" border="0" alt="RSS 2.0" align="absmiddle"></a><br />
					&nbsp;<a href="http://www.creativecommons.cn/licenses/by-nc-sa/1.0/" target="_blank"><img src="images/cc.gif" border="0"   alt="创作共用协议" align="absmiddle"></a>
				</div>
		</td>
