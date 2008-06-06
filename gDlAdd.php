<?php
	if(!isset($_SESSION['logined'])){
		header("Location:admin_login.php");
		exit;
	}
	include("inc/ghome.lib.php");
	include("inc/head.php");
	function getDlCount(){
		$dlcountfile='download/dlcount.cgi';
		if(!file_exists($dlcountfile))
			return 0;
		else{
			$lines=file($dlcountfile);
			$count=$lines[0];
			return $count;
		}
	} 

	function incDelCount($count){
		$dlcountfile='download/dlcount.cgi';
		$handle=fopen($dlcountfile,'wb');
		fwrite($handle,$count);
		fclose($handle);
	}
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<?php
			 include("inc/admin_left.php");
		?>
		<td valign="top">
		<?php
			  $softName=$_POST['softName'];
			  $softOS=$_POST['softOs'];
			  $softDevtool=$_POST['softDevtool'];
			  $softReadme=$_POST['softReadme'];
			  $softDurl=$_POST['softDurl'];

			  $dl_count=getDlCount();
			  $handle=fopen("download/$dl_count.cgi","wb");
			  $str_Write=$softName."\t".$softOS."\t".$softDevtool."\t".$softReadme."\t".$softDurl.$sepChar;
			  fwrite($handle,$str_Write);
			  fclose($handle);
			  incDelCount($dl_count+1);
			  $msg=$softName.'已经录入成功';
			  echo $msg;
		?>
		</td>
	</tr>
</table>
