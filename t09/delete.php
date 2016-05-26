<?php
 $id  = $_POST["id"];
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}
$update = $pdo->prepare("DELETE FROM gs_user_db WHERE id=:id");
//WHERE id=変更するidを指定
$update ->bindValue(':id', $id);
//SQL実行
$flag = $update ->execute();

?>