<?php
  //1. POSTデータ取得（）
  $name = $_POST["name"];
  $email = $_POST["email"];
  $age = $_POST["age"];
  $naiyou = $_POST["naiyou"];
  //2. DB接続します
  $pdo = new PDO('mysql:dbname=an;charset=utf8;host=localhost', 'root', '');

  //３．データ登録SQL作成
  $stmt = $pdo->prepare("INSERT INTO an_table (id, name, email, age, naiyou, indate )VALUES(NULL, :name, :email, :age, :naiyou, sysdate())");
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':age', $age);
  $stmt->bindValue(':naiyou', $naiyou);
  $status = $stmt->execute();

  //４．データ登録処理後
  if($status==false){
    //Errorの場合$status=falseとなり、エラー表示
    echo "SQLエラー";
    exit;
    
  }else{
    //５．index.phpへリダイレクト
      header("Location: index.php");
      exit();


  }
?>
