<p>Facebookへのログインに成功しました。</p>
<p>初期設定のままでは、実際のシェアは行われません。</p>
<p>Facebookへポストしたい場合は、[config.php]の SAFEMODE を FALSE に設定してください。</p>
<br>
<p>わざと処理速度を下げるために、5秒のスリープ処理を搭載しています。</p>
<?php

/*
for($i=1; $i<500; $i++){
	for($h=1; $h<500; $h++){
		echo $i*$h;
		if(++$count>30){
			echo "<br>";
			$count = 0;
		}
	}
}
*/
sleep(5);
?>