<?php
	if(!isset($_REQUEST['SearchContent'])){
		header('Location:gErrorPage.php?msg=�㲻�ܽ�������::��������ȷ�������ؼ���!');
		exit;
	}

	include("inc/ghome.lib.php");
	include("inc/head.php");
	$thisprog='search.php';

	function DisplayResult($finished){
		$results=$_SESSION['SearchResult'];
		if($finished)
			$sresult='�������';
		else
			$sresult='��������';
		echo "<table width=97%><tr><td class=msg_head>$sresult</td></tr>";		
		foreach($results as $result){
				 $lines=file("data/$result.cgi");
				 list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=split("\t",$lines[0]);
				 echo "<tr><td><a href=viewarticle.php?logID=$id>$Title</a></td></tr>";
		}

		if($finished && count($results)==0)
		{
			echo "<tr><td>û���ҵ�ҪѰ�ҵļ�¼</td></tr>";
		}
		echo "</table>";
	}
?>
<table class="wordbreak" cellSpacing="6" cellPadding="4" width="768" align="center" background="images/blog_main.gif" border="0">
	<tr>
		<td width=128 align=center>
			�������
		</td>
		<td>
		<?php
			$stop=false;
			$perPage=8;
			if(!isset($_REQUEST['action'])){
				$action='startSearch';
			}
			else{
				$action=$_REQUEST['action'];
			}
			
			$searchStr=preg_quote($_REQUEST['SearchContent']);				

			if(!isset($_REQUEST['ss'])){
				$count=gaCount();
				$startSearch=$count;
			}
			else
			{
				$startSearch=$_REQUEST['ss'];
			}

			$endSearch=$startSearch-$perPage;
			if($endSearch<1)
			{
				$endSearch=1;
				$stop=true;
			}

			if($action=='startSearch'){								
				$reloadUrl="search.php?action=continueSearch&SearchContent=$searchStr";
				$searchResult=array();
				$_SESSION['SearchResult']=$searchResult;
				echo '��ʼ����....';
			}

			if($action=='continueSearch'){
				DisplayResult(false);
				$SearchResults=$_SESSION['SearchResult'];
				for($i=$startSearch;$i>$endSearch;$i=$i-1)
				{
					if($i<1) break;
					$file="data/$i.cgi";
					$lines=file($file);
					$line=array(trim($lines[0]));
					$finds=preg_grep('/'.$searchStr.'/',$line);
					if(count($finds)>0)
						$SearchResults[]=$i;
				}

				$_SESSION['SearchResult']=$SearchResults;
				$ss=$startSearch-$perPage;
				$es=$ss-$perPage;
				if($ss<1 || $es<1){
					$reloadUrl="$thisprog?action=stopSearch&SearchContent=$searchStr";
				}
				else
					$reloadUrl="$thisprog?action=continueSearch&ss=$ss&SearchContent=$searchStr";
			}			

			if($action=='stopSearch'){
				DisplayResult(true);
				$stop=true;
			}

			if($stop==false)
				echo "<p align=right><a href=search.php?action=stopSearch&SearchContent=$searchStr>ֹͣ����</a>";
		?>				
		</td>
	</tr>
</table>	
<?php
	if($stop==false)
		echo "<meta http-equiv=refresh content='1;url=$reloadUrl'>";
?>
<?php
	include("inc/footer.php");
?>