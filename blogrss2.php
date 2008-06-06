<?php
	include("inc/ghome.lib.php");
	header("Content-type: application/xml;charset=utf-8");
	echo '<?xml version="1.0" encoding="gb2312"?>';
	echo "\r\n";
	echo '<rss version="2.0">';
	echo "\r\n";
?>
<channel>
<title><?= $siteName ?></title>
<link><?= $siteUrl ?></link>
<Description><?= $siteName ?></Description>
<language>zh-cn</language>
<copyright>由GM于2005年12月设计，基于PHP的纯文本型Blog</copyright>
<webMaster><?= $blogEmail ?></webMaster>
<images>
	<title><?= $siteName ?></title> 
	<url><?= $siteUrl ?>/images/logos.gif</url> 
	<link><?= $siteUrl ?></link> 
	<description><?= $siteName ?></description> 
</images>
	<?php
		$Cats=GetCategories();
		$count=gaCount();
		if($count==0){
	?>
		<item></item>
	<?php
		}
	    else
		{
		$gtemp=$count;
		for($i=0;$i<10;$i++){
			$gtemp=$count-$i;
			if($gtemp<0) break;

			$lines=file("data/$gtemp.cgi");
			list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=explode("\t",$lines[0]);
			$viewUrl_begin='http://gm8pleasure.vip.533.net/cgi-bin/GHomePHP/viewarticle.php?logID=';
			$viewUrl=$viewUrl_begin.$id;
			list($Cat_idTemp,$Cat_Name)=explode(':',$Cats[$Cat_id]);		
	?>
		<item>
			<link><?= $viewUrl ?></link>
			<title><![CDATA[<?= $Title ?>]]></title>
			<author><?= $From ?></author>
			<category><?= trim($Cat_Name) ?></category>
			<pubdate><?= $postDay ?></pubdate>
			<guid><?= $viewUrl ?></guid>
			<description><![CDATA[<?= trim($Details) ?>]]></description>			
		</item>
	<?php
		}
		}
	?>
</channel>
</rss>