<?php
/** 共通で使うものを別ファイルにしておきましょう。*/

//DB接続関数（PDO）
function db_con(){
	try {
		$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
	} catch (PDOException $e) {
		exit('DbConnectError:'.$e->getMessage());
	}
	//値を関数の外に出す
	return $pdo;
}

//SQL処理エラー
function queryError($stmt){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
	$error = $stmt->errorInfo();
	exit("QueryError:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
	return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}


?>
