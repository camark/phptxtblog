<?php
	class XMLFav{
		var $webStations=array();
		var $siteUrl_x;
		var $rss_file;
		function XMLFav(){
			$this->webStations=array(
				'http://technorati.com/faves?add='=>array('Add this blog to my Technorati Favorites!','tech-fav-1.gif'),
				'http://fusion.google.com/add?feedurl='=>array('ͨ��Google����','addtogoogle.gif'),
				'http://add.my.yahoo.com/rss?url='=>array('ͨ��My Yahoo����','addtomyyahoo.gif'),
				'http://my.msn.com/addtomymsn.armx?id=rss&amp;ut='=>array('ͨ��My MSN����','rss_mymsn.gif'),
				'http://www.zhuaxia.com/add_channel.php?url='=>array('ͨ��ץϺzhuaxia.com����','zhuaxia.gif'),
				'http://www.bloglines.com/sub/'=>array('ͨ��bloglines����','bloglines.gif')
			);

			$this->siteUrl_x=getBlogBaseUrl();
			$this->rss_file=$this->siteUrl_x.'/blogrss2.php';
		}

		function produceHtml(){
			echo '<a href="'.$this->rss_file.'" target="_blank",title="�����ҵ�Blog"><img src="images/rss/icon_xml.gif" border=0><br>';
			foreach($this->webStations as $key=>$value){
				$url_tips=$value[0];
				$url_img=$value[1];
				echo '<a href="'.$key.$this->rss_file.'" target="_blank" title="'.$url_tips.'"><img src="images/rss/'.$url_img.'" style="border: medium none;" align="middle"></a><br>';
			}
		}
	}	
?>	