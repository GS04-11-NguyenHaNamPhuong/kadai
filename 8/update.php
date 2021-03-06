<?php
//1.POSTでParamを取得
//1.POSTでParamを取得
echo $_POST["name"];
echo $_POST["email"];
echo $_POST["age"];
echo $_POST["naiyou"];
echo $_POST["id"];
if(
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["email"]) || $_POST["email"]=="" ||
  !isset($_POST["age"]) || $_POST["age"]=="" ||
  !isset($_POST["naiyou"]) || $_POST["naiyou"]=="" ||
  !isset($_POST["id"]) || $_POST["id"]==""
){
  exit('ParamError');
} else {
    $name   = $_POST["name"];
    $email  = $_POST["email"];
    $age  = $_POST["age"];
    $naiyou = $_POST["naiyou"];
    $id = $_POST["id"];
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
    "UPDATE gs_an_table
    SET
        name = :name
    ,   email = :email
    ,   age = :age
    ,   naiyou = :naiyou
    WHERE
        id = :id;");
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':age', $age);
$stmt->bindValue(':naiyou', $naiyou);
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;
}

//2.DB接続など


//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。




?>
