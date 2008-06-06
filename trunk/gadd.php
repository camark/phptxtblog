
	<?php
	include("inc/head.php");
	include("inc/ghome.lib.php");
	?>	
	<TABLE class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
      <tr>
      	<td>
      	<?php
			 $id=gaCount();
			 $id=$id+1;
			 $fHandle=fopen("data/$id.cgi",'w');
			
			 $details=stripslashes($_POST['log_Details']);
			 $details=str_replace("\r\n","<br />",$details);			 
			 $day=getGTime();
			 list($log_Intro,$hasMore)=splitLine($details); 
			 $str_Write=$id."\t".$day."\t".$_POST['Cate_ID']."\t".$_POST['log_Title']."\t".$_POST['log_IsShow']."\t".$_POST['log_Weather']."\t".$_POST['log_From']."\t".$_POST['log_FromURL']."\t".$log_Intro."\t".$hasMore."\t".$details."\n";
			 fwrite($fHandle,$str_Write);
			 fclose($fHandle);

			 $countFile='data/arcount.cgi';
			 $fcount=fopen($countFile,'w');
			 fwrite($fcount,$id);
			 fclose($fcount);

			 echo '<p align=center>添加文章成功!</p><br>'; 
			 echo "<p align=center><a href='$homePage'>点击返回</a></p>";
		?>
      	</td>	
      </tr>
  </table>
	<?php
	include("inc/footer.php");
	?>
