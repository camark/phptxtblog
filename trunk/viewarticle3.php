<?php
	include("inc/ghome.lib.php");
	include("inc/bloglib.php");
	require("inc/Sajax.php");
	function addComment($id,$author,$time,$message){
		//global $commentCountFile;
		//global $topComment;
		$sepChar="\r\n";
		$fhandle=fopen("data/$id.cgi.comment","ab+");
		$author=htmlspecialchars($author);
		$message=htmlspecialchars($message);
		$message=str_replace("\r\n","<br/>",$message);
		$writeC=$author."\t".$time."\t".$message;
		fwrite($fhandle,$writeC.$sepChar);
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

	function refresh($id){
		$commentFile="data/$id.cgi.comment";
		if(!file_exists($commentFile))
			return "��ǰû������\n";
		else{
			$lines=file($commentFile);
			return join($sepChar,$lines);
		}
	}
	
	$sajax_request_type = "GET";
	sajax_init();
	$sajax_debug_mode=0;
	sajax_export("addComment", "refresh");
	sajax_handle_client_request();
	
	$blogcount=gaCount();
	$id=$_REQUEST['logID'];
	if($id<1 || $id>$blogcount){
		header("Location:gErrorPage.php?msg=��������ļ�::�ļ��ı�Ų���ȷ");
		exit();
	}
	include("inc/head.php");
?>
	<script language="JavaScript">	
		  <!--
			<?
				sajax_show_javascript();
			?>
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

			function HtmlCode(str){
				var result;
				result=str.replace(">","&lgt;");
				result=result.replace("<","&gt;");
				result=result.replace("\r\n","<br/>");

				return result;
			}

			function add_cb(){
			}

			function add(){
				var Id;
				Id=document.getElementById("logID").value;
				if(Id=="")
					return;
				var Author;
				var validateCode;
				var comment;
				var gnow=new Date();
				var gTime=gnow.getYear()+"-"+gnow.getMonth()+"-"+gnow.getDate();				
				Author = document.getElementById("comment_author").value;
				validateCode = document.getElementById("validatecode").value;
				validateCode2 = document.getElementById("gValidateCode2").value;
				comment=document.getElementById("comment_message").value;
				if (Author == "" || comment=="" || validateCode=="")
				{
					alert("������������Ϣ��");
					return;				
				}

//				if(validateCode2!=""){
//					if(validateCode2!=validateCode){
//						alert("��������ȷ����֤��!");
//						return;
//					}
//				}
				alert(Author);				
				document.getElementById("comment_author").value="";
				document.getElementById("comment_message").value="";
				document.getElementById("validatecode").value="";
				document.getElementById("validateImg").src="inc/validatecode.php";
				x_addComment(Id,Author,gTime,comment,add_cb);
			}

			function grefresh(){
				var Id=document.getElementById("logID").value;
				if(Id!="")
					x_refresh(Id,refresh_cb);
			}

			function refresh_cb(vNewData){	
				var i;
				var array;
				var totalmsg="";
				
				if(vNewData=='��ǰû������\n')
					totalmsg="<div class=content_head>��ǰû������!</div>";
				else{
					var newData=vNewData.split("\n");
					for(i=0;i<newData.length-1;i++){
						var data=newData[i];
						array=data.split("\t");

						author=array[0];
						time=array[1];
						msg=array[2];
						totalmsg=totalmsg+"<div class=content_head><a name=commentmark_"+(i+1)+"><img src='images/icon_quote.gif' border=0 align=absmiddle>"+author+"��"+time+"������������:</div><div class=content_main>"+msg+"</div>";
					}
				}
				document.getElementById("gComment").innerHTML=totalmsg;
				setTimeout("grefresh()", 5000);
			}	
			
//			function testCharset(){
//				var av=document.getElementById("comment_author").value;
//				alert(av);
//			}
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
			      <img src="images/weather/<?= $weather_id ?>.gif">
			      <?php echo "<strong>$Title</strong> &nbsp&nbsp[����:$postDay &nbsp;&nbsp;|����:&nbsp;&nbsp;<a href=showmember.php target=_blank >$From</a>]"; ?>
			  </div>       
			  <div class="content_main">
				<?= $Details ?>
			  </div>
			   <table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr><td></td></tr>
			  </table>
			  <div id="gComment">���ڼ�������</div>												
			  <table width="100%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr><td></td></tr>
			  </table>
			  <form name="comment_form" method=post action="#" onsubmit="add();return false">			 
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
					<input type="text" name="comment_author" size=20>&nbsp;��֤��<input name="validatecode" type="text" id="validatecode" size="3" />&nbsp;<img src='inc/validatecode.php' align=absmiddle id="validateImg">
					<input type=hidden name="gValidateCode2" value="<?= $_SESSION['gBlog_validatecode'] ?>">
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
				<td colspan=2 bgcolor=white align=center><input type="submit" name=submit value="�Ѿ�д����"><input type=reset value="��д">
			 </tr>
			 </table>
			  <?php
				   }
			  ?>
			  </td>
			  </form>
		  </tr>
	</table>
	<script>
		document.body.onload=grefresh;
	</script>	  
<?php
	include("inc/footer.php");
?>

