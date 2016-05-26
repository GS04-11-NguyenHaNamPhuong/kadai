<?php
/************************************************************
 *  ログイン認証OKの場合表示
 ************************************************************/
//1. SESSION開始
session_start();
include("func.php");

//2. セッションチェック(前ページのSESSION＿IDと現在のsession_idを比較)
sessionCheck(); //func.php

//3. 管理者FLGを表示
$admin = loginRollSet();//func.php

//1.  DB接続します
$pdo = db();//func.php

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３データ表示
$name = "<p>名前： " . $_SESSION["name"] . "</p>";
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC) ){
    //管理FLGで表示を切り分けたりしてみましょう！！！（追加してください！）
    $view .= '<p><a href="detail.php?id='.$result["id"].'">'.$result["name"]." : ".$result["lid"].".".$result["lpw"].'</a></p>';
  }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー情報表示</title>
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="login.php">データ登録</a>
        <a class="navbar-brand" href="logout.php">LOGOUT</a>
        <p>
            <?=$name?>
        </p>
        <p>
            <?=$admin?>
        </p>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
