<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ソーシャルランプ: 設定テストページ</title>

	<!-- 同じディレクトリ内で呼び出す場合 -->
	<script type="text/javascript" src="../system.js"></script>
	
	<!-- 異なったディレクトリから呼び出す場合 -->
	<!--
	<script type="text/javascript" id="js_socialLanp" src="../system.js?http://hirayamaru.info/sociallanp/system.js"></script>
	-->

<style type="text/css">

	body{
		margin:0;
	}

	.wrapper{
		margin-right: auto;
		margin-left: auto;
		width:800px;
		height:100%;
		text-align: center;
	}
	
	.socialLanp{
		display: block;
		width:302px;
		height:64px;
		background-image: url("../system/images/button_off.png");
		
		color: #fff;
		font-size: 20px;
		text-decoration: none;
		font-weight: bold;
		line-height: 62px;
		letter-spacing: .2em;
		
		margin-right: auto;
		margin-left: auto;
	}
	
	.socialLanp:hover{
		background-image: url("../system/images/button_on.png");		
	}
	
	.addContent{
		text-align: left;
	}
</style>

</head>


<body>

<div class="wrapper">
	<h1>今すぐシェアしてクーポンをゲット！</h1>
	<a class="socialLanp" rel="test" target="_blank">クーポンを取得</a>
</div>

</body>
</html>
