<?php
	include("inc/ghome.lib.php");
	include("inc/bloglib.php");
	$blogcount=gaCount();
	$id=$_REQUEST['logID'];
	if($id<1 || $id>$blogcount){
		header("Location:gErrorPage.php?msg=��������ļ�::�ļ��ı�Ų���ȷ");
		exit();
	}

	if(isset($_REQUEST['submit'])){
		$valcode=strval($_REQUEST['validatecode']);
		$valcode1=strval($_SESSION['gBlog_validatecode']);
		if($valcode!=$valcode1){
			header("Location:gErrorPage.php?msg=�����������::��֤�� $valcode �� $valcode1 ��һ��!");
			exit;
		}
	}
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
			  ?>
			  <td valign=top>	
			  <?php
				  
				   if(file_exists("data/$id.cgi")){
					   $lines=file("data/$id.cgi");
					   list($gid,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=split("\t",$lines[0]);
					   #$Details=str_replace("<br/>","",$Details);
					   incViewCount($id);
					   list($weather_id,$weather_name)=explode('|',$Weather);
					   $hasPrev=true;
					   $hasNext=true;
					   $prevID=$id+1;
					   $nextID=$id-1;
					   if($prevID>$blogcount)
						   $hasPrev=false;
					   if($nextID<1)
						   $hasNext=false;
			  ?>
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:4px;">
				<tr>
					 <td width="50%" align="left">
					 <?php
				          if($hasPrev)
							 echo "<a href=viewarticle.php?logID=$prevID><img src=images/icon_ar.gif border=0 align=absmiddle>��һƪ </a>";
				     ?>
					 </td>
					 <td width="50%" align="right">
					 <?php
					      if($hasNext)
							 echo "<a href=viewarticle.php?logID=$nextID>��һƪ<img src=images/icon_al.gif border=0 align=absmiddle> </a>";
					 ?>
					 </td>
				 </tr>
			  </table>
			  <div class="content_head"> 
			      <img src="images/weather/<?php echo $weather_id ?>.gif">
			      <?php echo "<strong>$Title</strong> &nbsp&nbsp[����:$postDay &nbsp;&nbsp;|����:&nbsp;&nbsp;<a href=showmember.php target=_blank >$From</a>]"; ?>
			  </div>       
			  <div class="content_main">
				<?php echo $Details; ?>
			  </div>
			   <table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr><td></td></tr>
			  </table>
			  <?php
					   if(isset($_REQUEST['action'])){
							$fhandle=fopen("data/$id.cgi.comment","a+");
							$msg=htmlspecialchars($_REQUEST['comment_message']);
							$msg=str_replace("\r\n","<br>",$msg);
							$msg=str_replace(" ","&nbsp;",$msg);
							$day=getGTime();		
						    $strWrite=htmlspecialchars($_REQUEST['comment_author'])."\t".$day."\t".$msg;
							fwrite($fhandle,$strWrite.$sepChar);
							fclose($fhandle);

							$singleCommentCount=count(file("data/$id.cgi.comment"));
							$commentCount=0;
							if(file_exists($commentCountFile)){
								$fhandle=fopen($commentCountFile,'r');
								flock($fhandle,LOCK_SH);
								$commentCount=fread($fhandle,filesize($commentCountFile));
								flock($fhandle,LOCK_UN);
								fclose($fhandle);
							}		
							$commentCount++;
							$fhandle=fopen($commentCountFile,"wb");
							flock($fhandle,LOCK_EX);
							fwrite($fhandle,$commentCount);
							flock($fhandle,LOCK_UN);
							fclose($fhandle);
							
							$tops=array();
							if(file_exists($topComment)){
								$tops=file($topComment);
							}

							$tops[]=trim($strWrite)."\t".$id."\t".$singleCommentCount.$sepChar;
							$count_tops=count($tops);
							$maxSaveComment=5;
							$fhandle=fopen($topComment,'w');
							for($i=1;$i<$maxSaveComment;$i=$i+1){
								$j=$count_tops-$i;
								if($j<0) break;
								fwrite($fhandle,$tops[$j]);
							}
							fclose($fhandle);
					   }
					   if(!file_exists("data/$id.cgi.comment")){	
			  ?>
			  <div class="content_head">��ʱû������</div>
			  <?php
						}
						else{
							$comments=file("data/$id.cgi.comment");
							$i=1;
							foreach($comments as $comment){
								list($author,$time,$message)=explode("\t",$comment);
			 ?>
						<div class="content_head"><a name=commentmark_<?= $i ?> >
							<img src="images/icon_quote.gif" border="0" align="absmiddle"><?= $author ?>�� <?= $time ?>������������:
						</div>
						<div class="content_main">
							<?= $message ?>
						</div>
			 <?php
							$i=$i+1;
							}
						}
					    
			  ?>
			  <table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr><td></td></tr>
			  </table>
			  <form name="comment_form" method=post action="viewarticle.php?action=addcomment">
			  <script>
			  function CheckForm(){
					if(comment_form.comment_author.value.length==0  ){
						alert("�����¸��մ�����");
						return false;
					}
					
					if(comment_form.comment_message.value.length==0  ){
						alert("������˵��ɶ�ɣ�");
						return false;
					}
					
					if(comment_forum.comment_message.value.length>1024){
						alert("���Բ��ܴ���1024!");
						return false;
					}

					if(comment_forum.validatecode.value.length==0){
						alert("��������֤�룡");
						return false;
					}
				
				return true;
			  }
			  </script>
			  <input type=hidden name="logID" value=<?= $id ?>>
			  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#CCCCCC">
	          <tr>
                 <td colspan="2" bgcolor="#EFEFEF"><a name="#comment"></a><b>�������� - </b></td>
             </tr>
			 <tr>
				<td bgcolor="white">
					����
				</td>
				<td bgcolor="white" valign=center>
					<input type=text name="comment_author" maxsize=20>&nbsp;��֤��<input name="validatecode" type="text" id="validatecode" size="3" />&nbsp;<img src='inc/validatecode.php' align=absmiddle>
				</td>
			 </tr>
			 <tr>
				<td bgcolor="white" valign=top>
					����
				</td>
				<td bgcolor="white">
					<textarea name="comment_message" cols=100 rows=10>
					</textarea>
				</td>	
			 </tr>
			 <tr>
				<td colspan=2 bgcolor=white align=center><input type=submit name=submit value="�Ѿ�д����"><input type=reset value="��д">
			 </tr>
			 </table>
			  <?php
				   }
			  ?>
			  </td>
			  </form>
		  </tr>
	</table>
		  
<?php
	include("inc/footer.php");
?>

