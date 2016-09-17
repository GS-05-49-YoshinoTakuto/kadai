<?php
include("functions.php");
//1.POSTでParamを取得
$id = $_POST["id"];
$name = $_POST["name"];
$url = $_POST["url"];
$cmt = $_POST["cmt"];

//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book_name=:name, book_url=:url, book_cmt=:cmt WHERE id=:id");
$stmt->bindValue(':name', $name,   PDO::PARAM_STR);
$stmt->bindValue(':url', $url,  PDO::PARAM_STR);
$stmt->bindValue(':cmt', $cmt, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
	queryError($stmt);
}else{
	header("Location: bm_insert_view.php");
	exit;
}

?>
