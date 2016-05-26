<?php

//1.GETでidを取得
if(
    !isset($_GET["id"])
){
    exit('ParamError');
}

$id   = $_GET["id"];

//2.DB接続など
try {
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
}catch (PDOException $e){
 exit('DbConnectError:'.$e->getMessage());
}
//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）

$stmt =$pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', $id);
$status =$stmt->execute();
//4.select.phpと同じようにデータを取得（以下はイチ例）
// while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//    $name = $result["name"];
//    $email = $result["name"];
//  }
if($status==false){
    $error =$stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    if( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $name = $result["name"];
        $lid = $result["lid"];
        $lpw = $result["lpw"];
    }
}

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
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>User Information</legend>
    <input type="hidden" name="id" value="<?=$id?>">
     <label>User Name：<input type="text" name="name" value="<?=$result["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$result["lid"]?>"></label><br>
     <label>PassWord：<input type="text" name="lpw" value="<?=$result["lpw"]?>"></label><br>
     <input type="submit" value="Send">
    </fieldset>
  </div>
</form>
<form method="post" action="delete.php">
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="submit" value="Delete">
</form>
<!-- Main[End] -->


</body>
</html>






