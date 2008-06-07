<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Welecom to PhpTextBlog</title>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
	<meta content="Microsoft FrontPage 6.0" name="GENERATOR">
        <meta keywords="PHP 文本型 Blog Java Delphi C＃ Hibernate Ant">
	<link href="../styles/default.css" rev="stylesheet" rel="stylesheet" type="text/css" media="all" />		
</head>
<body>
<table height="82" cellspacing="0" cellpadding="0" width="768" align="center" background="../images/blog_header.gif"
			border="0">
			<tr>
				<td width="2%" rowspan="2">
					<img height="82" src="../images/blog_headerright.gif" width="18"></td>
				<td width="13%" rowspan="2">
					<img height="82" src="../images/blog_logo.gif" width="100"></td>
				<td class="header" width="83%" height="54">&nbsp;<strong>PhpText Blog Config</strong></td>
				<td class="header" width="2%" rowspan="2">
					<img height="82" src="../images/blog_headerleft.gif" width="18"></td>
			</tr>
			<tr>
				<td class="header" align=right>				
				</td>
			</tr>
</table>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="../images/blog_main.gif" border="0">
		  <tr>			  
			  <td valign=top>	
			  <?php
			  	$siteName=$_POST['siteName'];
			  	$siteName=trim($siteName);
			  	
			  	if($siteName=='')
			  	{
			  		print "<h4>Error!</h4>";
			  		print "You must input invalid site Name!<br>";
			  		print 'Press this <a href="javascript:history.go(-1)">link </a>to back';
			  	}
			  	else
			  	{
			  		$siteUrl=$_POST['siteUrl'];
			  		$siteUrl=trim($siteUrl);
			  		
			  		if($siteUrl=='')
			  		{
			  			print "<h4>Error!</h4>";
			  			print "You must input invalid site Url to provide Rss!<br>";
			  			print 'Press this <a href="javascript:history.go(-1)">link </a>to back';	
			  		}
			  		else
			  		{
			  			$fileName="../inc/SiteConfig.php";
			  			$fileHandle=fopen($fileName,'w');
			  			if(!$fileHandle)
			  			{
			  				print "Open File Error";
			  			}
			  			else
			  			{
				  			fwrite($fileHandle,"<?php"."\n");
				  			fwrite($fileHandle,"\t".'$siteName="'.$siteName.'"'.";\r\n");
				  			fwrite($fileHandle,"\t".'$siteUrl="'.$siteUrl.'"'.";\r\n");
				  			$copyRight=$_POST['copyRight'];
				  			fwrite($fileHandle,"\t".'$CopyRight="'.$copyRight.'"'.";\r\n");
				  			$createTime=date('Y-m-j');
				  			fwrite($fileHandle,"\t".'$createTime="'.$createTime.'"'.";\r\n");
				  			$adminPass=$_POST['adminPass'];
				  			$adminPass=trim($adminPass);
				  			
				  			if($adminPass=='')
				  				$adminPass='9988';
				  				
				  			fwrite($fileHandle,"\t".'$adminpass="'.$adminPass.'"'.";\n");
				  			fwrite($fileHandle,"?>"."\n");
				  			fclose($fileHandle);
				  			
				  			print "<h4>Configuration!</h4>";
				  			print "Save Config Ok!<br>";
				  			print 'Press this <a href="../index.htm">link </a>to See';	
				  			
				  			unlink("../install_site.php");
			  			}
			  		}
			  	}
			  ?>
			  </td>
		  </tr>
</table>
<table width="768" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td><img src="../images/blog_footerright.gif" width="18" height="30"></td>
				<td width="100%" align="center" valign="middle" background="../images/blog_footer.gif"
					style="padding-bottom:2px; " class="header">				
				</td>
				<td><img src="../images/blog_footerleft.gif" width="18" height="30"></td>
			</tr>
	</table>
</body>
</html>