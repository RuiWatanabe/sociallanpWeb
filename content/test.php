<?php
session_start();
	
?>
<h2>Facebookへのログインに成功しました。</h2>

<img src="system/images/icon.png" />

<p>初期設定のままでは、実際のシェアは行われません。</p>
<p>Facebookへポストしたい場合は、[config.php]の SAFEMODE を FALSE に設定してください。</p>
<p>表示時間を伸ばし、先読みなどの機能動作を確認しやすくするため、7秒のスリープ処理を搭載しています。</p>

<pre>
<?php
sleep(7);

//print_r($_SESSION);
?>
</pre>
