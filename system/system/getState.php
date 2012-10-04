<?php

	session_start();
	require '../config.php';
	require 'sdk/facebook.php';
	
	$facebook = new Facebook(array(
	    'appId' => APP_ID,
	    'secret' => APP_SECRET
	));

	$error = "";

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
		$error = "ログインできていません。$error";
	}



	//▼シェアタイム関連の処理
	//セッション"SharePost"と"nextShareTime"のチェックを行う。
	//sharePost: すでにシェアした記事のスラッグ名のリスト
	//nextShareTime: 次にシェアすることのできる時刻
/*
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
*/

	//▼認証関連
/*
		$auth = "false";

		if(file_exists("KEY.md")){
			try{
				$key = @file_get_contents("KEY.md"); //認証書の読み込み
				if($key == md5(MAIL)){
					$auth = "true"; //認証書が見つかり、データが正しい。
				}
				else{
					$error = "証明書の値が正しくありませんでした。$error";
				}
			}
			catch(Exception $e){
				//$error =  "KEYファイルから情報が読み取れませんでした。";
				$error = "証明書から情報が読み取れませんでした。$error";
				//break;
			}
		}
		else{
				//$error =  "KEYファイルが生成されていませんでした。";		
				$error = "証明書ファイルが生成されていませんでした。$error";
		}
*/


	$info = array(
		//'name' => $name,
		//'auth' => $auth,
		//'key' => $key,
		//'nowTime' => date ("m/d H:i",strtotime ("+9 hour")),
		//'nowTimeStamp' => strtotime ("now"),
		//'nextShareTime' => date ("m/d H:i",$_SESSION['nextShareTime']),
		//'nextShareTimeStamp' => $_SESSION['nextShareTime'],
		//'sharePost' => $_SESSION['sharePost'],
		//'mail' => MAIL,
		'prior' => PRIOR,
		'callBackUrl' => CALLBACK_URL,
	    'loginState'=> $loginState,
	    'loginUri'=> $loginUrl,
	    'logoutUri'=> $logoutUrl,
	    'error' => $error,
	    'nowpage' => "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
	    //'shareInfo'=> $shareInfo,
	    //'accessToken' => $token,
	    //'postSlug' => $_SESSION['postSlug']
	);
	header('Content-type: application/json');
	echo json_encode($info);
	//return $info;

    //$facebook->api('/me/feed', 'POST', array('message' => 'はじめましてこんにちは、ボクです。（'. date('r'). '）'));
?>