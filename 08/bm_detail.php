<?php
include("functions.php");
//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}

//4.select.phpと同じようにデータを取得（以下はイチ例）
// while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//    $name = $result["name"];
//    $email = $result["name"];
//  }


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
      </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="bm_update.php">
      <div class="jumbotron">
       <fieldset>
        <legend>登録更新</legend>
        <label>本の名前：<input type="text" name="name" value="<?=$row["book_name"]?>"></label><br>
        <label>URL：<input type="text" name="url" value="<?=$row["book_url"]?>"></label><br>
        <label><textArea name="cmt" rows="4" cols="40"><?=$row["book_cmt"]?></textArea></label><br>
        <!-- type=hiddenでブラウザ上には表示させない。でもデータは送れる。 -->
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="submit" value="更新">
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->


</body>
</html>






