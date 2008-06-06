<?php
	include("inc/ghome.lib.php");
	if(checklogin()){
		header("Location:admin_login.php");
		exit();
	}
	include("inc/head.php");
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td>
			<?php
				 $logID=$_REQUEST['logID'];
				 if(isset($_POST['delblog']))
				 {
					 $count=gaCount();
					 unlink("data/$logID.cgi");  //删除文件
					 $commentfile="data/$logID.cgi.comment";
					 $lookFile="data/$logID.cgi.look";
					 if(file_exists($commentfile))
						 unlink($commentfile);
					 if(file_exists($lookFile))
						 unlink($lookFile);
					 for($i=$count;$i>$logID;$i--){
						 $j=$i-1;
						 if($j<0) break;
						 rename("data/$i.cgi","data/$j.cgi");
					 }

					 $countFile='data/arcount.cgi';
					 $fcount=fopen($countFile,'w');
					 $count=$count-1;
					 flock($fcount,LOCK_EX);
					 fwrite($fcount,$count);
					 flock($fcount,LOCK_UN);
					 fclose($fcount);
					 $msg='<p align=center>删除文章成功!</p><br>';
				 }
				 else
				 {
					 $fHandle=fopen("data/$logID.cgi",'w');
			
					 #$details=$_POST['log_Details'];
    				  $details=stripslashes($_POST['log_Details']);
					 $details=str_replace("\r\n","<br />",$details);			 
					 $day=getGTime();
					 list($log_Intro,$hasMore)=splitLine($details); 					 $str_Write=$logID."\t".$day."\t".$_POST['Cate_ID']."\t".$_POST['log_Title']."\t".$_POST['log_IsShow']."\t".$_POST['log_Weather']."\t".$_POST['log_From']."\t".$_POST['log_FromURL']."\t".$log_Intro."\t".$hasMore."\t".$details."\n";
					 flock($fHandle,LOCK_EX);
					 fwrite($fHandle,$str_Write);
					 flock($fHandle,LOCK_UN);
					 fclose($fHandle);
							
					 $msg='<p align=center>修改文章成功!</p><br>'; 					 
				 }

				 echo $msg;
				 echo "<p align=center><a href='$homePage'>点击返回</a></p>";
			?>
		</td>		
	</tr>
</table>	
<?php
	include("inc/footer.php");
?>
