<?php
	include("inc/ghome.lib.php");
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width="128" bgcolor="#f8f8f8" valign="top">
			<?php
				 $msg='<p align=center>�������<br>&nbsp;&nbsp;�����ṩһ���ǿ�Դ�����������о������κ�����뷢���ʼ���<a href=mailto:camark@sohu.com>�ҵ�����</a>';
				 echo $msg;
			?>
		</td>
		<td valign=top align="left">
		<?php
			$dlcountfile='download/dlcount.cgi';
			if(file_exists($dlcountfile)){
				$lines=file($dlcountfile);
				$dlcount=$lines[0];

				for($i=0;$i<=$dlcount;$i++){
					$file="download/$i.cgi";
					if(file_exists($file)){
						$line=file($file);
						$info=$line[0];
						list($name,$os,$dev_tools,$readme,$durl)=explode("\t",$info);
		?>
			<div class="content_head">
                <img src="images/weather/1.gif">
				<strong><?= $name ?></strong>
			</div>
			<div class="content_main">
				&nbsp;&nbsp;<?= $readme ?>
			</div>
			<br/>
            <div align="right" class="smalltxt" height="32px">
				����ϵͳ:<?= $os ?>&nbsp;|&nbsp;��������:<?= $dev_tools ?>
			&nbsp;|&nbsp;<a href="<?= $durl ?>">����</a>&nbsp;&nbsp;
			</div>
		<?php
					}
				}
			}
			else{
				echo '��ǰû�п������ص����';
			}
		?>
		</td>
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>