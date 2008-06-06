<?php
	include("inc/ghome.lib.php");
	header("Content-type: application/xml;charset=utf-8");
	echo '<?xml version="1.0" encoding="gb2312"?>';
	echo "\r\n";
?>
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:admin="http://webns.net/mvcb/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns="http://purl.org/rss/1.0/">
<channel rdf:about="<?= $siteUrl ?>">
<title><?= $siteName ?></title>
<link><?= $siteUrl ?></link>
<description><?= $siteName ?></description>
<dc:language>zh-cn</dc:language>
<dc:creator><?= $blogEmail ?></dc:creator>
<items>
	<rdf:Seq>
	<?php
		$Cats=GetCategories();
		$count=gaCount();
		$gtemp=$count;
		$viewUrl_begin='http://gm8pleasure.vip.533.net/cgi-bin/GHomePHP/viewarticle.php?logID=';
		for($i=0;$i<10;$i++){
			$gtemp=$count-$i;
			if($gtemp<0) break;

			$lines=file("data/$gtemp.cgi");
			list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=explode("\t",$lines[0]);
			$viewUrl=$viewUrl_begin.$id;
			list($Cat_idTemp,$Cat_Name)=explode(':',$Cats[$Cat_id]);		
	?>
		<item rdf:about="<?= $viewUrl ?>">
			<title><![CDATA[<?= $Title ?>]]></title>
			<description><![CDATA[<?= $Intro ?>]]></description>
			<content:encoded><![CDATA[<?= trim($Details) ?>]]></content:encoded>
			<link><?= $viewUrl ?></link>
			<dc:subject><?= trim($Cat_Name) ?></dc:subject>
			<dc:creator><?= $From ?></dc:creator>
			<dc:date><?= $postDay ?></dc:date>
		</item>
	<?php
		}
	?>
	</rdf:Seq>
</items>
</channel>
</rdf:RDF>