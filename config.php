<?php

//Facebookのアプリ情報
define('APP_ID','490580820960694');
define('APP_SECRET','d8117be64300a21c62f8f201a1e5c6a1');

//ユーザー登録時のメールアドレス
define('MAIL','hirayamaru@gmail.com');


//セーフモード
//TRUEになっている場合、ログインを行なってもFacebookに投稿されません。
define('SAFEMODE',TRUE);

//FaceBookポスト時の内容を指定することができます。
define('POST_FORMAT','『%title%』にログインしました。');
//%title%: ポストする元Webページのタイトル

?>