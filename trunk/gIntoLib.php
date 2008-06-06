<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<?php
			include("inc/admin_left.php");
		?>
		<td valign=top>
		<div class="content_head">入库结果</div>
		<div class="content_main">
		<ul>
		<?php
			$count=gaCount();
			$prevcount=$count;
			$needCopy='data/needcopy';
			$fnc=opendir($needCopy);
			$files=array();
			while(($file=readdir($fnc))!==false){
				if($file!='.' && $file!='..')
				{
					$files[]=$file;
				}
			}
     		closedir($fnc);
			sort($files);
			foreach($files as $file){
				$count=$count+1;
				$filetocopy=$needCopy.'/'.$file;
				copy($filetocopy,"data/$count.cgi");
				unlink($filetocopy);
		?>
			<li>文件:<?= $filetocopy ?>已经成功入库</li>
		<?php
				}
			if($prevcount!=$count){
				$fhandle=fopen('data/arcount.cgi','wb');
				flock($fhandle,LOCK_EX);
				fwrite($fhandle,$count);
				flock($fhandle,LOCK_UN);
				fclose($fhandle);
			}
			else
				echo '<li>当前没有可以入库的文章</li>';
		?>
		</ul>
		</div>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>