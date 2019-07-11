<?php
include('functions.php');

//入力チェック(受信確認処理追加)
if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['dob']) || $_POST['dob'] == ''
) {
  exit('ParamError');
}

//POSTデータ取得
$id     = $_POST['id'];
$name = $_POST['name'];
$dob = $_POST['dob'];
$typ = $_POST['typ'];
$national = $_POST['national'];
$occupation = $_POST['occupation'];
$cadd = $_POST['cadd'];


//DB接続します(エラー処理追加)
$pdo = connectToDb();

//データ登録SQL作成
$sql = 'UPDATE guest_table SET name=:a1, dob=:a2, typ=:a3, national=:a4, occupation=:a5, cadd=:a6 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $dob, PDO::PARAM_STR);
$stmt->bindValue(':a3', $typ, PDO::PARAM_INT);
$stmt->bindValue(':a4', $national, PDO::PARAM_STR);
$stmt->bindValue(':a5', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':a6', $cadd, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: select.php');
  exit();
}
