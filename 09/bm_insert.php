<?php
include("functions.php");

$pdo = db_con();

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$cmt = $_POST["cmt"];

//３．データ登録SQL作成 prepareの中にはsqlを記述
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, book_name, book_url, book_cmt,
indate )VALUES(NULL, :a1, :a2, :a3, sysdate())");
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) STR:文字列
$stmt->bindValue(':a2', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $cmt, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sql実行

//４．データ登録処理後
if($status==false){
  queryError($stmt);
}else{
  //５．index.phpへリダイレクト
  header("Location: bm_insert_view.php");//半角スペース必要
  exit;
}
?>
