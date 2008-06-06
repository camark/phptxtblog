# Put my Blog Into PHPBlog

use Win32::ODBC;
use File::Copy;

&Connect;
exit(0);

sub getArticleCount{
	$count=0;
	$fdir="c:\\GHomePHP\\data\\arcount.cgi";
	if(-e $fdir){
		open(TEMP,$fdir);
		$count=<TEMP>;
		close(TEMP);
	}
	return $count;
}

sub getIntoLibMax{
	$file="c:\\GHomePHP\\data\\maxLib.cgi";
	$max=1;
	if(-e $file)
	{
		open(TEMP,$file);
		$max=<TEMP>;
		close(TEMP);
	}

	return $max;
}
sub Connect {
   $dsn = "blogdata";
   $count=getArticleCount();
   $max=getIntoLibMax();
   $id=$count+1;  
   $db = new Win32::ODBC($dsn);
   die "ERROR: Failed to open database\n" if(!$db);

   $sql="select * from blog_Content where log_ID>$max";
   $db->Sql($sql);
   ($ErrNum, $ErrText, $ErrConn) = $db->Error();
   
   print $count."\n";
   print $ErrText;
   $phpDir="c:\\GHomePHP\\data\\";
   while($db->FetchRow()){
	   ($logID,$CatID,$Title,$Intro,$Content,$Weather,$isHide,$logFrom,$logFromUrl,$logPostYear,$logPostMonth,$logPostDay)=$db->Data("log_ID","log_CateID","log_Title","log_Intro","log_Content","log_Weather","log_IsShow","log_From","log_FromUrl","log_PostYear","log_PostMonth","log_PostDay");
	   print $Intro."\n";
	   $day=$logPostYear."-".$logPostMonth."-".$logPostDay;
	   print $day."\n";
	   open(GTEMP,">c:\\GHomePHP\\data\\$id.cgi");
	   if(length($Intro)==length($Content)){
		   $hasMore=0;
	   }
	   else
	   {
		   $hasMore=1;
	   }

	   $Intro=~s/\r\n/<br \/>/g;
	   $Content=~s/\r\n/<br \/>/g;
	   $Content=~s/\t/&nbsp;&nbsp;&nbsp;&nbsp;/g;	   	   
	   print GTEMP $id."\t".$day."\t".$CatID."\t".$Title."\t".$isHide."\t".$Weather."\t".$logFrom."\t".$logFromUrl."\t".$Intro."\t".$hasMore."\t".$Content."\r\n";
	   close(GTEMP);

	   $id=$id+1;
	   #copy("c:\\GHomePHP\\data\\$id.cgi","c:\\GHomePHP\\data\\needcopy\\$id.cgi");
   }

	$id=$id-1;
	$fdir="c:\\GHomePHP\\data\\arcount.cgi";
	open(TEMP,">$fdir");
	print TEMP $id."\r\n";
	close(TEMP);
	$fdir="c:\\GHomePHP\\data\\maxLib.cgi";
	open(TEMP,">$fdir");
	print TEMP $logID."\r\n";
	close(TEMP);

   $db->Close();
}


