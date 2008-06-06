<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width=128 align=center>
			访问纪录
		</td>
		<td>
			<?php
				if(!file_exists($visitFile)){
					echo "当前没有访问纪录!";
				}
				else{
					$visits=file($visitFile);
					$visitcount=count($visits);
					$visitPerpage=20;
					$currentPage=0;
					if($visitcount % $visitPerpage!=0)
						$pageCount=intval($visitcount/$visitPerpage+1);
					else
						$pageCount=$visitcount/$visitPerpage;

					if(!isset($_REQUEST['page'])){
						$currentPage=1;
					}
					else{
						$currentPage=$_REQUEST['page'];
					}
			?>
			<SPAN class=smalltxt>
			<A href="gVisit.php?page=1"><IMG src="images/icon_ar.gif" align=absMiddle border=0></A>	
			<?php
				 for($i=1;$i<=$pageCount;$i++){
					 if($i!=$currentPage)
						 echo "<a href=gVisit.php?page=$i>[$i]</a>";
					 else
						 echo "[$i]";
				 }
			?>
			 <A href="gVisit.php?page=<?= $pageCount ?>"><IMG src="images/icon_al.gif" align=absMiddle border=0></A>	
			</SPAN>
			<table width="99%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
			<tr class="msg_head"><td>来访时间</td><td>IP地址</td><td>客户器信息</td></tr>
			<?php
				$gStartVisit=$visitcount-($currentPage-1)*$visitPerpage;
				$gtemp=$gStartVisit;
				for($i=1;$i<$visitPerpage;$i++){
					$gtemp=$gStartVisit-$i;
					if($gtemp<0) break;
					$visit_temp=$visits[$gtemp];
					list($visitTime,$visitIP,$visitAgent)=explode("\t",$visit_temp);
					echo "<tr><td nowrap bgcolor=white>$visitTime</td><td nowrap bgcolor=white>$visitIP</td><td bgcolor=white>$visitAgent</td></tr>";
				}
			?>
			</table>
			<?php
				}
			?>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>