<?php
	include("inc/bloglib.php");	
	$count=gaCount();
	if($count==0){
		echo "<p align=center>暂时没有文章</p>";
	}
	else
	{
		$perPage=8;
		if($count%$perPage!=0)
			$pageCount=intval($count/$perPage+1);
		else
			$pageCount=$count/$perPage;

		if(!isset($_REQUEST['page'])){
			$currentPage=1;
		}
		else{
			$currentPage=$_REQUEST['page'];
		}
?>
	<SPAN class=smalltxt>
	<A href="ShowArticle.php?page=1"><IMG src="images/icon_ar.gif" align=absMiddle border=0></A>	
<?php
	 for($i=1;$i<=$pageCount;$i++){
		 if($i!=$currentPage)
			 echo "<a href=ShowArticle.php?page=$i>[$i]</a>";
		 else
			 echo "[$i]";
	 }
?>
    <A href="ShowArticle.php?page=<?php echo $pageCount; ?>"><IMG src="images/icon_al.gif" align=absMiddle border=0></A>	
    </SPAN>
  <TABLE height=9 cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
	<TBODY>
	<TR>
	  <TD></TD>
	</TR>
	</TBODY>
  </TABLE>
<?php
		$gcount=$count-($currentPage-1)*$perPage;
		$Cats=GetCategories();
		$gtemp=$gcount;
		for($i=0;$i<$perPage;$i++)
		{
			$gtemp=$gcount-$i;
			if($gtemp<0) break;
			if(file_exists("data/$gtemp.cgi")){
				$lines=file("data/$gtemp.cgi");
				list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=split("\t",$lines[0]);
				#print $Details;
				$count_line=count($lines);
				if($count_line>1)
				{
						for($j=1;$j<$count_line;$j++){
								$Details=$Details.$lines[$j];
						}
				}
				#$Intro=str_replace("<br/>","",$Intro);
				list($weather_id,$weather_name)=explode('|',$Weather);
				list($Cat_idTemp,$Cat_Name)=explode(':',$Cats[$Cat_id]);
				$viewcount=getViewCount($gtemp);
?>
<div class="content_head"> 
	<img src="images/weather/<?php echo $weather_id; ?>.gif">
	<?php echo "<a class=snap-preview href=viewarticle.php?logID=$gtemp><strong>$Title</strong></a> &nbsp&nbsp[日期:$postDay &nbsp;&nbsp;|&nbsp;&nbsp;<a href=showMember.php>$From</a>]"; ?>
</div>         
<div class="content_main">
	<?php echo $Intro; ?>
</div>
<?php
				if($hasMore){
?>
<br>
<br>
<a class=snap-preview href="viewarticle.php?logID=<?php echo $gtemp; ?>">
	<img src="images/icon_readmore.gif" align="absmiddle" border="0">
	阅读全文……
</a>
<?php
				}
?>
<br>
<div align="right" class="smalltxt" height="32px">
	作者:<a href="showMember.php" target="_blank"><?= $From ?></a>&nbsp;|&nbsp;分类:<?= $Cat_Name ?>&nbsp;|&nbsp;查看:<?= $viewcount ?>&nbsp;&nbsp;
<?php
	if(isset($_SESSION['logined']))
		echo "<a href=blogEdit.php?logID=$gtemp><img src=images/icon_edit.gif border=0 alt=编辑日志 align=absmiddle></a>"
?>
</div>
<?php
			}
		}
?>

<?php
	}
?>

<SPAN class=smalltxt>
<A href="ShowArticle.php?page=1"><IMG src="images/icon_ar.gif" align=absMiddle border=0></A>	
<?php
	 for($i=1;$i<=$pageCount;$i++){
		 if($i!=$currentPage)
			 echo "<a href=ShowArticle.php?page=$i>[$i]</a>";
		 else
			 echo "[$i]";
	 }
?>
<A href="ShowArticle.php?page=<?php if(isset($pageCount)) print "$pageCount"; else print "1"; ?>"><IMG src="images/icon_al.gif" align=absMiddle border=0></A>	
</SPAN>
