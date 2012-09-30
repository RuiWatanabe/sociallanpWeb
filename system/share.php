<?php
session_start();
$body = $_POST['title'];
$url = $_POST['url'];
require 'sdk/facebook.php';
require '../config.php';
	
	$facebook = new Facebook(array(
	    'appId' => APP_ID,
	    'secret' => APP_SECRET
	));
	
  //echo $facebook->api('/me/feed', 'POST', array('message' => 'テスト'));
  $user = $facebook->getUser();
  if($user){
  		try{
	  		$postdata = str_replace("%title%", $body, POST_FORMAT); //%title%→サイトのタイトル
  		 	
  		 	if(SAFEMODE != TRUE){
 	 		 	$facebook->api('/me/feed', 'POST', array('message' => $postdata , 'link' => $url));
 	 		 	echo "FaceBookにポストしました。内容: ".$postdata;
  		 	}
  		 	else{
 	 		 	echo "セーフモードになっているため、ポストしませんでした。";	  		 	
  		 	}
  		 	//▼$facebook->api('/me/feed', 'POST', array('message' => "『".$body."』を読みました。" , 'link' => $url));
  		 	//if($_SESSION['postSlug']!='' && $_SESSION['postSlug']!='undefined')
  		 	//	array_push($_SESSION['sharePost'], $_SESSION['postSlug']);
  			//$_SESSION['nextShareTime'] = strtotime("+15 hour"); //次のシェアタイムを1時間後に設定]
  		 	//echo "share.php:FaceBookにポストしました。".strtotime("+3 hour");
	 	}
  		 catch(Exception $e){
	  		 echo "share.php:送信に失敗しました。".$e;	  		 	
  		 	}
	 }
	 else{
	 	 echo "share.php:送信に失敗しました。";
	 }
	 
	 
?>