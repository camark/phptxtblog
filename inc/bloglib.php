<?php
	function getViewCount($id){
		$count=0;
		$file="data/$id.cgi.look";

		if(file_exists($file))
		{
			$lines=file($file);
			$count=trim($lines[0]);
		}

		return $count;
	}

	function incViewCount($id){
		$count=getViewCount($id);
		$file="data/$id.cgi.look";

		$temp_count=$count+1;
		$fhandle=fopen($file,'w');
		flock($fhandle,LOCK_EX);
		fwrite($fhandle,$temp_count);
		flock($fhandle,LOCK_UN);
		fclose($fhandle);
	}
?>