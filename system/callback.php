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
     }
     else{
          $login = false;    
     }
}


//facebookにシェアする
  //$user = $facebook->getUser();
  if($login != false){
            try{
                  $return = "true";
                  //$return =  $facebook->api('/me/feed', 'POST', array('message' => "SocialLanpをシェアしました。" , 'link' => "http://sociallanp.lastlanp.jp"));
                  //echo $req;
           }
             catch(Exception $e){
                  $return = "error";                      
                  }
  }
      else{
            $return= "error";
      }
     

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