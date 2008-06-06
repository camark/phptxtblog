<?php
	
require 'inc/Smarty.class.php';
$dlcountfile='download/dlcount.cgi';
$smarty=new Smarty;
//$smarty->caching=true;
//$smarty->compile_check = true;
//$smarty->debugging = true;

$downloads=array();
if(file_exists($dlcountfile)){
	$lines=file($dlcountfile);
	$dlcount=$lines[0];

	for($i=0;$i<=$dlcount;$i++){
		$file="download/$i.cgi";
		if(file_exists($file)){
			$line=file($file);
			$info=$line[0];
			list($name,$os,$dev_tools,$readme,$durl)=explode("\t",$info);

			$downloads[]=array("name"=>$name,"os"=>$os,"dev_tools"=>$dev_tools,"readme"=>$readme,"durl"=>$durl);	
		}
	}
}

$msg='<p align=center>�������<br>&nbsp;&nbsp;�����ṩһ���ǿ�Դ�����������о������κ�����뷢���ʼ���<a href=mailto:camark@sohu.com>�ҵ�����</a>';
$smarty->assign('msg',$msg);
$smarty->assign('Downloads',$downloads);
$smarty->display('download.tpl');
?>			