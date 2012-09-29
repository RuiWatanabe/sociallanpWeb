<?php
	//require '../config.php';

// ファイルの終端に１行追加する
$fp = fopen("KEY", "w+");
//fwrite( $fp, md5(MAIL) );
fwrite( $fp, $_REQUEST['code'] );
fclose( $fp );
?>