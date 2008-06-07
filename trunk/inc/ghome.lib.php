<?php
  include("SiteConfig.php");
	$homePage='ShowArticle.php';
	$favFile='data/favorite.cgi';
	$linkFile='data/link.cgi';
	$catFile='data/Category.cgi';
	$sepChar="\r\n";
	$adminFile="data/admin.cgi";
	$countFile='data/count.cgi';
	$visitFile='data/visit.cgi';
	$blogEmail='camark@sohu.com';
	$commentCountFile='data/commentcount.cgi';
	$topComment='data/topComment.cgi';

	function getCommentCount(){
		$commentCount=0;
		$commentCountFile="data/commentcount.cgi";

		if(!isset($_SESSION['CommentCount'])){
			if(file_exists($commentCountFile)){
				$fhandle=fopen($commentCountFile,'rb');
				flock($fhandle,LOCK_SH);
				$commentCount=fread($fhandle,filesize($commentCountFile)+1);
				flock($fhandle,LOCK_UN);
				fclose($fhandle);
			}
						
			$_SESSION['CommentCount']=$commentCount;
		}
		else
		{
			$commentCount=$_SESSION['CommentCount'];
		}

		return $commentCount;
	}

	function getVisitCount(){
		$count=0;
		$countFile="data/count.cgi";
		$visitFile="data/visit.cgi";
		$sepChar="\r\n";
		if(!isset($_SESSION['Recorded'])){
			if(file_exists($countFile)){
				$fhandle=fopen($countFile,'rb');
				flock($fhandle,LOCK_SH);
				$count=fread($fhandle,filesize($countFile)+1);
				flock($fhandle,LOCK_UN);
				fclose($fhandle);
			}

			$visitTime=date("Y-m-d H:ia");
			$visitIP=$_SERVER['REMOTE_ADDR'];
			$visitAgent=$_SERVER['HTTP_USER_AGENT'];
			$visitLines=file($visitFile);
			$writeVisit=array_slice($visitLines,-100);
			$fvisit=fopen($visitFile,'wb+');
			flock($fvisit,LOCK_EX);
			foreach($writeVisit as $wv){
				fwrite($fvisit,$wv);
			}
			fwrite($fvisit,$visitTime."\t".$visitIP."\t".$visitAgent.$sepChar);
			flock($fvisit,LOCK_UN);
			fclose($fvisit);


			$count++;
			$fhandle=fopen($countFile,'wb');
			flock($fhandle,LOCK_EX);
			fwrite($fhandle,$count);
			flock($fhandle,LOCK_UN);
			fclose($fhandle);
			$_SESSION['Recorded']=$count;
		}
		else{
			$count=$_SESSION['Recorded'];
		}

		return $count;
	}

	function getAdminPass(){
         #global $adminFile,$adminpass;	
		 $adminFile="data/admin.cgi";
		 $adminpass='9988';
		 if(file_exists($adminFile)){
			 $admin_Info=file($adminFile);
    		list($password,$sex,$mailbox,$isHideMail,$qq,$homePage,$Intro)=explode("\t",$admin_Info[0]);

			return $password;
		 }
		 else
			 return $adminpass;
	 }

	function GetCategories()
	{
		$Cat_File='data/Category.cgi';
		$lines=file($Cat_File);
	
		return $lines;
	}

	function getGTime(){
		$today=getDate();
		return $today['year'].'-'.$today['mon'].'-'.$today['mday'];
	}

	function gaCount(){
		$countFile='data/arcount.cgi';
		if(file_exists($countFile)){
			
			$lines=file($countFile);			
			$count=$lines[0];
		}
		else
		{
			$count=0;
			$fcount=fopen($countFile,'w');
			flock($fcount,LOCK_EX);
			fwrite($fcount,$count);
			flock($fcount,LOCK_UN);
			fclose($fcount);
		}

		return $count;
	}

	function splitLine($str){
		$len=strlen($str);
		$ts=0;
		$hasMore='0';
		$br="<br />";
		$brLen=strlen($br);
		for($i=0;$i<$len-$brLen;$i++){
			$str_temp=substr($str,$i,$brLen);
			if($str_temp==$br){
				$ts=$ts+1;
			}

			if($ts==4) break;
		}
		if($ts==4){
			$hasMore='1';
			return array(substr($str,0,$i+$brLen),$hasMore);
		}
		else{
			return array($str,$hasMore);
		}
	}

	function checkLogin(){
		if(!isset($_SESSION['logined'])){
		 header("Location:admin_login.php");
	 }
	}

	function getBlogBaseUrl(){
		return 'http://gm8pleasure.vip.533.net/cgi-bin/GHomePHP';
	}
?>
