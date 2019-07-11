<?php
include('functions.php');

// 入力チェック

if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['dob']) || $_POST['dob'] == ''
) {
  exit('ParamError');
}

//POSTデータ取得
$name = $_POST['name'];
$dob = $_POST['dob'];
$typ = $_POST['typ'];
$national = $_POST['national'];
$occupation = $_POST['occupation'];
$cadd = $_POST['cadd'];

//DB接続
$pdo = connectToDb();

$sql = 'INSERT INTO guest_table(id, name, dob, typ, national, occupation, cadd, indate)
VALUES(NULL, :a1, :a2, :a3, :a4,:a5,:a6,sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $dob, PDO::PARAM_STR);
$stmt->bindValue(':a3', $typ, PDO::PARAM_INT);
$stmt->bindValue(':a4', $national, PDO::PARAM_STR);
$stmt->bindValue(':a5', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':a6', $cadd, PDO::PARAM_STR);
// :imageを$file_nameで追加！
$status = $stmt->execute();
//データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  //index.phpへリダイレクト
  header('Location: index.php');
}
