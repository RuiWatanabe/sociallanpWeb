<?php

//Facebookのアプリ情報
define('APP_ID','490580820960694');
define('APP_SECRET','d8117be64300a21c62f8f201a1e5c6a1');

//ユーザー登録時のメールアドレス
//define('MAIL','hirayamaru@gmail.com');



//FaceBookポスト時の内容を指定することができます。
define('POST_FORMAT','『%title%』にログインしました。');
//%title%: ポストする元Webページのタイトル


define('SAFEMODE',TRUE);
//セーフモード
//TRUEになっている場合、ログインを行なってもFacebookに投稿されません。

define('PRIOR',FALSE);
//追加コンテンツを事前に読み込んでおくかどうかを指定します。
//TRUEにすると、ボタンクリック後の読み込みが早くなります。
//FALSEにすると、追加コンテンツが不正に取得される危険性が低くなります。

?>