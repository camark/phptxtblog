<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
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
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>		
			<?php
				include("inc/left.php");
				$msg=$_REQUEST['msg'];				
				list($msgHead,$msgReason)=@explode("::",$msg);
				if($msgHead=='' || $msgReason==''){
					$msgHead='发生错误';
					$msgReason='原因未知';
				}
			?>
		<td valign=top>
			<div class="content_head">
				你&nbsp;<strong><?= $msgHead ?>&nbsp;</strong>的原因是：<br>
			</div>
			<div class="content_main">
				<ul>
				  <li><?= $msgReason ?></li>
				</ul>
				<p>你可以采取如下行动：</p>
				<ul>
				  <li><a href="javascript:history.go(-1)">返回到前一页</a></li>
				  <li>你没有登陆，请<a href=admin.php>登陆</a></li>
				  <li>系统发生错误,请登陆到<a href=ShowArticle.php>首页</a></li>
				</ul>	
			</div>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>