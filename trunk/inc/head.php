<html lang="en-US" xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<?php
	$gHomePage='ShowArticle.php';
?>
<head>
	<title>杨易的Blog</title>
	<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
	<meta content="Microsoft FrontPage 6.0" name="GENERATOR">
        <meta keywords="PHP 文本型 Blog Java Delphi C＃ Hibernate Ant">
	<link href="styles/default.css" rev="stylesheet" rel="stylesheet" type="text/css" media="all" />		
</head>
<body>
<table height="82" cellspacing="0" cellpadding="0" width="768" align="center" background="images/blog_header.gif"
			border="0">
			<tr>
				<td width="2%" rowspan="2">
					<img height="82" src="images/blog_headerright.gif" width="18"></td>
				<td width="13%" rowspan="2">
					<img height="82" src="images/blog_logo.gif" width="100"></td>
				<td class="header" width="83%" height="54">&nbsp;<strong>.Net极限</strong></td>
				<td class="header" width="2%" rowspan="2">
					<img height="82" src="images/blog_headerleft.gif" width="18"></td>
			</tr>
			<tr>
				<td class="header" align=right>
				<a href=<?php echo $gHomePage; ?>>主页</a>&nbsp;
				<?php
					$links=file("data/link.cgi");
					foreach($links as $link){
						list($link_Name,$link_Url,$link_Intro)=explode("\t",$link);
				?>
					|&nbsp;<a href="<?php echo $link_Url; ?>" alt="<?php echo $link_Intro; ?>"><?php echo $link_Name; ?></a>&nbsp;
                <?php
					}
				?>
				</td>
			</tr>
</table>
