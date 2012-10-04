<?php
session_start();
require '../config.php';	
require 'sdk/facebook.php';	



   $facebook = new Facebook(array(
         'appId' => APP_ID,
         'secret' => APP_SECRET,
     ));


//ログインをキャンセルした場合の処理
if($_REQUEST['error']){
     $facebook->destroySession();
     $login = false;
}
else{
    
     $user = $facebook->getUser();
    
     if($user && isset($_REQUEST['code'])&&isset($_REQUEST['state'])){
          $login = $facebook->getAccessToken();
          $u = $facebook->api("/me&locale=ja_JP");
     }
     else{
          $login = false;    
     }
}


//facebookにシェアする
  //$user = $facebook->getUser();
$return = "error";
if($login != false){
            try{
                 
                  $postdata = str_replace("%title%", $body, POST_FORMAT); //%title%→サイトのタイトル
  		 	
		  		 	if(SAFEMODE != TRUE){
		 	 		 	$facebook->api('/me/feed', 'POST', array('message' => $postdata , 'link' => $url));
		 	 		 	$return = "true : FaceBookにポストしました。内容: ".$postdata;
		  		 	}
		  		 	else{
		 	 		 	$return = "true : セーフモードになっているため、ポストしませんでした。";	  		 	
		  		 	}
           }
             catch(Exception $e){
                 $return = $return." : ポストに失敗しました。:".$login.":APP_ID";
                }
  }
  else{
      $return = $return." : 正常にログインできていません。";
  }
     
     
     
     
//print_r($facebook->api("/me&locale=ja_JP"));
//print_r($facebook->api("/me&locale=ja_JP"));
//$u = json_encode($u);
//echo "<pre>";
//print_r($u);
//echo "</pre>";


if(isset($u)){
//$u = json_encode($u);

//ソーシャルランプのDBに情報を格納する

//職歴・学歴の取得
$employ = $u['work']['0']['employer']['name'].$u['work']['0']['position']['name'];
if(!$employ) $employ = $me['education']['0']['school']['name'];


	$url = 'http://sociallanp.lastlanp.jp/add/visiter.php';
	$data = array(
	     'screen_id' => $u['id'],
	     'mail' => $u['email'],
	     'entranceID' => APP_ID,
	     'name' => $u['name'],
	     'screen_name' => $u['username'],
	     'gender' => $u['gender'],
	     'location' => $u['location']['name'],
	     'name' => $u['name'],
	     'employ' => $employ,
	     'entranceName' => $_SERVER["HTTP_HOST"],
	);
	$options = array('http' => array(
	     'method' => 'POST',
	     'content' => http_build_query($data),
	));
	$contents = file_get_contents($url, false, stream_context_create($options));
}
//print_r($contents);



//}
?>

<html>
<head>
<meta http-equiv="Content-Type" charset="UTF-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript">
function closeWindow(){

	//window.parent.callback('<?php echo $token; ?>');
	window.opener.callback('<?php echo $return; ?>');
	window.close();
	//$('.tbox,.tmask',parent.document).stop().animate({opacity:'0'});
	//window.parent.
}
</script>
</head>

<body onload="closeWindow()">
<h2>ログインが完了しました。</h2>
<p>このウィンドウは、通常自動的に閉じられます。</p>
<p>もしこのウィンドウが表示され続ける場合、このページを閉じて、元のウィンドウを更新して下さい。</p>
</body>
</html>