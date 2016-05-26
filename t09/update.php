<?php
//1.POSTでParamを取得
//1.POSTでParamを取得
echo $_POST["name"];
echo $_POST["lid"];
echo $_POST["lpw"];
echo $_POST["id"];
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["lid"]) || $_POST["lid"]=="" ||
  !isset($_POST["lpw"]) || $_POST["lpw"]=="" ||
  !isset($_POST["id"]) || $_POST["id"]==""
){
  exit('ParamError');
} else {
    $name   = $_POST["name"];
    $lid  = $_POST["lid"];
    $lpw  = $_POST["lpw"];
        $id  = $_POST["id"];
}

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
//３．データ登録SQL作成
$stmt = $pdo->prepare(
    "UPDATE gs_user_table
    SET
        name = :name
    ,   lid = :lid
    ,   lpw = :lpw
    WHERE
        id = :id;");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: login.php");
  exit;
}

//2.DB接続など


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。




?>