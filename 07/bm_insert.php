<?php
//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$cmt = $_POST["cmt"];

//2. DB接続します 基本コピーでOK
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');//localhostの場合 root パスワードは空。通常サーバーを登録したらidとpasswardがもらえる
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//３．データ登録SQL作成 prepareの中にはsqlを記述
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_name, book_url, book_cmt,
indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) STR:文字列
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $cmt, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sql実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: bm_insert_view.php");//半角スペース必要
  exit;
}
?>
