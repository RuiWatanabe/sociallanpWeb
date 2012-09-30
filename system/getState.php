<?php

	session_start();
	require '../config.php';
	require 'sdk/facebook.php';
	
	$facebook = new Facebook(array(
	    'appId' => APP_ID,
	    'secret' => APP_SECRET
	));


	$loginState = $facebook->getUser(); //ログインしているかどうかをチェック。している場合ユーザIDを返す。

	define('CALLBACK_URL',str_replace("getState", "callback", "http://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));

	//ログインURL用のパラメータを設定
	$params = array(
		//'display'=>'popup',
		  'scope' => 'publish_stream',
		  'redirect_uri' => CALLBACK_URL
	);
	$loginUrl = $facebook->getLoginUrl($params); //ログインURLの取得
	$logoutUrl = $facebook->getLogoutUrl();	//ログアウトURLの取得


	if($loginState){
		$token = $facebook->getAccessToken();	
		//$name = $facebook->api('/user');
		//$name = Facebook.fqlQuery("select name from profile where id=$loginState");
	}else{
		//$facebook->destroySession();
		//session_destroy();
		//header("Location: $logoutUrl");
	}



	//▼シェアタイム関連の処理
	//セッション"SharePost"と"nextShareTime"のチェックを行う。
	//sharePost: すでにシェアした記事のスラッグ名のリスト
	//nextShareTime: 次にシェアすることのできる時刻
	$shareInfo = "null";
	 if(!isset($_SESSION['sharePost']) || !isset($_SESSION['nextShareTime'])){ 
		//セッションがカラだった場合、セッション設定を初期化。
			$_SESSION['nextShareTime'] = 0; 
			$_SESSION['sharePost'] = array();
		$shareInfo = 'notset'; //セッションを利用していない(シェア)
	}
	else if($_SESSION['nextShareTime']<strtotime ("+9 hour")){ //セッションはあるがタイムアウトしている場合
		$shareInfo = 'timeout'; //タイムアウトしている(再シェア)
	}
	else{
		if(in_array($_SESSION['postSlug'],$_SESSION['sharePost']))//セッションに指定スラッグが追加されているかどうかをtrue of false
			$shareInfo = 'already'; //すでに当該記事をシェアしていて、タイムアウトではない。
		else
			$shareInfo = 'still'; //セッションを利用しているが、当該記事はまだシェアしていない。(シェア)
	}


	//▼認証関連
	$auth = "false";
	$key = file_get_contents("KEY");
	if($key == md5(MAIL)){
		$auth = "true";
	}else{
		$auth = "false";
	}



	$info = array(
		'name' => $name,
		'auth' => $auth,
		//'key' => $key,
		'nowTime' => date ("m/d H:i",strtotime ("+9 hour")),
		'nowTimeStamp' => strtotime ("now"),
		'nextShareTime' => date ("m/d H:i",$_SESSION['nextShareTime']),
		'nextShareTimeStamp' => $_SESSION['nextShareTime'],
		'sharePost' => $_SESSION['sharePost'],
		'mail' => MAIL,
		'prior' => PRIOR,
		'callBackUrl' => CALLBACK_URL,
	    'loginState'=> $loginState,
	    'loginUri'=> $loginUrl,
	    'logoutUri'=> $logoutUrl,
	    //'shareInfo'=> $shareInfo,
	    'accessToken' => $token,
	    //'postSlug' => $_SESSION['postSlug']
	);
	header('Content-type: application/json');
	echo json_encode($info);
	//return $info;

    //$facebook->api('/me/feed', 'POST', array('message' => 'はじめましてこんにちは、ボクです。（'. date('r'). '）'));
?>