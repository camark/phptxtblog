<?php
	/*
		Call flow command ok:
		"<param><value><string>1</string></value></param>
      <param><value><string>admin</string></value></param>
      <param><value><string>pleasure</string></value></param>
      <param><value><struct><member><name>title</name><value>a</value></member><member><name>description</name><value>aaa</	value></member></struct></value></param>
		<param><value><boolean>true</boolean></value></param>"
		2006-11-22日 
		Gm good Luck!
	*/
	include("inc/lib/xmlrpc.inc");
	include("inc/lib/xmlrpcs.inc");
	include("inc/lib/xmlrpc_wrappers.inc");
	include("inc/ghome.lib.php");

	class xmlrpc_server_methods_container
	{
		/*
		* Method used to test logging of php warnings generated by user functions.
		*/
		function phpwarninggenerator($m)
		{
			$a = $b; // this triggers a warning in E_ALL mode, since $b is undefined
			return new xmlrpcresp(new xmlrpcval(1, 'boolean'));
		}
	}

	function ConvertGBToUtf8($val){
		return iconv("gb2312","UTF-8//IGNORE",$val);
	}
	$addTwo_sig=array(array($xmlrpcInt,$xmlrpcInt,$xmlrpcInt));
        $addTwo_doc='Calucate the sum of tow Integer,return Integer';
	
	function addTwo($m){
		$a=$m->getParam(0);
		$b=$m->getParam(1);
		$c=$a->scalarval()+$b->scalarval();
		return new xmlrpcresp(new xmlrpcval($c,"int"));
	}
	
	function login_ok($author,$password){
		$auth_err=1;
		if($author!='admin' || $password!=getAdminPass())
			$auth_err=0;
		return $auth_err;
	}
	
	$getCategoryList_sig=array(array($xmlrpcArray,$xmlrpcInt,$xmlrpcString,$xmlrpcString));
	$getCategoryList_doc="get all Category of blog";
	

	function getCategoryList($m){
		$author=$m->getParam(1);
		$author=$author->scalarval();
		$password=$m->getParam(2);
		$password=$password->scalarval();
		if(!login_ok($author,$password)){
			$auth_err_msg='Authorize error!';
			return new xmlrpcresp(0, $xmlrpcerruser+1, $auth_err_msg);
		}
		
		$Categories=GetCategories();
		$rv=new xmlrpcval(array(),"array");
		$count_cat=count($Categories);
		for($i=0;$i<$count_cat;$i++){
			list($id,$cat_name)=split(":",$Categories[$i]);
			$rv->addScalar($cat_name,"string");
		}

		return new xmlrpcresp($rv);
	}
	
	$setPostCategory_sig=array(array($xmlrpcBoolean,$xmlrpcInt,$xmlrpcString,$xmlrpcString,$xmlrpcArray));
	$setPostCategory_doc='set a Blog to some Category';
	function setPostCategory($m){
		$author=$m->getParam(1);
		$author=$author->scalarval();
		$password=$m->getParam(2);
		$password=$password->scalarval();
			if(!login_ok($author,$password)){
			$auth_err_msg='Authorize error!';
			return new xmlrpcresp(0, $xmlrpcerruser+1, $auth_err_msg);
		}
		
		$blog_id=$m->getParam(0);
		$blog_id=$blog_id->scalarval();	

		return new xmlrpcresp(new xmlrpcval(true,"boolean"));
	}

	$getPost_sig=array(array($xmlrpcStruct,$xmlrpcInt,$xmlrpcString,$xmlrpcString));
	$getPost_doc='get a Post by id';
	function mwa_GetPost($m){
		$author=$m->getParam(1);
		$author=$author->scalarval();
		$password=$m->getParam(2);
		$password=$password->scalarval();
			if(!login_ok($author,$password)){
			$auth_err_msg='Authorize error!';
			return new xmlrpcresp(0, $xmlrpcerruser+1, $auth_err_msg);
		}

		$blog_id=$m->getParam(0);
		$blog_id=$blog_id->scalarval();	
		$blog_file="data/$blog_id.cgi";
		if(!file_exists($blog_file)){
			$noexit_err_msg="Blog id by $blog_id not exist!";
			return new xmlrpcresp(0,$xmlrpcerruser+1,$noexit_err_msg);
		}
		$lines=file("data/$blog_id.cgi");
		list($id,$postDay,$Cat_id,$Title,$isShow,$Weather,$From,$FromUrl,$Intro,$hasMore,$Details)=split("\t",$lines[0]);

		$Categories=new xmlrpcval(array(),'array');
		$Categories->addScalar($Cat_id,'string');
		$rv=new xmlrpcval(array(
			'title'=>new xmlrpcval($Title,'string'),
			'link'=>new xmlrpcval($FromUrl,'string'),
			'description'=>new xmlrpcval($Details,'string'),
			'author'=>new xmlrpcval('camark@sohu.com','string'),
			'category'=>$Categories,
			'pubDate'=>new xmlrpcval($postDay,'string')),
			'struct');

		return $rv;
	}

	$InsertPos_sig=array(array($xmlrpcString,$xmlrpcInt,$xmlrpcString,$xmlrpcString,$xmlrpcStruct,$xmlrpcInt));
	$InsertPos_doc='insert a post form xmlrpc';
	function InsertPost($m){
		$author=$m->getParam(1);
		$author=$author->scalarval();
		$password=$m->getParam(2);
		$password=$password->scalarval();	
		if(!login_ok($author,$password)){
			$auth_err_msg='Authorize error!';
			return new xmlrpcresp(0, $xmlrpcerruser+1, $auth_err_msg);
		}

		$id=gaCount();
		$id++;
		$log_isShow=1;
		$Cate_ID=1;
		$log_Weather=1;
		$log_From='del.icio.us';
		$log_Url='http://gm8pleasure.vip.533.net';
		$blog_id=$m->getParam(0);
		$blog_id=$blog_id->scalarval();		
		$blog_Data=$m->getParam(3);
		$temp=$blog_Data->structmem('title');
		$log_Title=$temp->scalarval();
		$temp=$blog_Data->structmem('description');
		$log_Intro=$temp->scalarval();
		$log_Intro=str_replace("\n","",$log_Intro);
		$log_Intro=str_replace("\r","",$log_Intro);
		$log_Intro=str_replace("\t","",$log_Intro);
		$log_Intro=iconv("UTF-8","gb2312//IGNORE",$log_Intro);

		$hasMore=0;
		$log_details=$log_Intro;
		$day=getGTime();		
		$str_Write=$id."\t".$day."\t".$Cate_ID."\t".$log_Title."\t".$log_IsShow."\t".$log_Weather."\t".$log_From."\t".$log_FromURL."\t".$log_Intro."\t".$hasMore."\t".$log_details."\n";
                $fHandle=fopen("data/$id.cgi",'w');
		fwrite($fHandle,$str_Write);
		fclose($fHandle);

		$countFile='data/arcount.cgi';
		$fcount=fopen($countFile,'w');
		fwrite($fcount,$id);
		fclose($fcount);

		return new xmlrpcresp(new xmlrpcval(strval($id), "string"));
	}
	$o=new xmlrpc_server_methods_container;
	$a=array(
	  "metaWeblog.newPost" => array(
	    "function" => "InsertPost",
	    "signature" => $InsertPos_sig,
	    "docstring" => $InsertPos_doc
  		   ),
	 "examples.addTwo" => array(
         "function" => "addTwo",
	     "signature" => $addTwo_sig,
	     "docstring" => $addTwo_doc			
		),
 	 "mt.setPostCategories" => array(
	     "function"=>"setPostCategory",
	     "signature"=>$setPostCategory_sig,
	     "docstring"=>$setPostCategory_doc
		),
	 "mt.getCategoryList"=>array(
		"function"=>"getCategoryList",
	     "signature"=>$getCategoryList_sig,
	     "docstring"=>$getCategoryList_doc
	 ),
	 "metaWeblog.getPost"=>array(
		"function"=>"mwa_GetPost",
	    "signature"=>$getPost_sig,
	    "docstring"=>$getPost_doc	
	 )
  	);
	$s=new xmlrpc_server($a, false);
	$s->setdebug(3);
	/* $s->compress_response = true;*/

	$s->service();
?>
