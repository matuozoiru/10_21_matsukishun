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

// Fileアップロードチェック
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == 0) {
  // ファイルをアップロードしたときの処理
  // ①送信ファイルの情報取得
  $uploadedFileName = $_FILES['upfile']['name'];
  $tempPathName = $_FILES['upfile']['tmp_name'];
  $fileDirectoryPath = 'upload/';


  // ②File名の準備
  $extension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);
  $uniqueName = date('YmdHis') . md5(session_id()) . "." . $extension;
  $fileNameToSave = $fileDirectoryPath . $uniqueName;


  // ③サーバの保存領域に移動&④表示
  if (is_uploaded_file($tempPathName)) {
    if (move_uploaded_file($tempPathName, $fileNameToSave)) {
      chmod($fileNameToSave, 0644);
    } else {
      // $img = '保存に失敗しました';
      exit('保存に失敗しました');
    }
  } else {
    // $img = '画像があがっていないです';
    exit('画像があがっていないです');
  }
} else {
  // ファイルをアップしていないときの処理
  // $img = '画像が送信されていません';
  exit('画像が送信されていません');
}




// DB接続
$pdo = connectToDb();

// データ登録SQL作成
// imageカラムとバインド変数を追加
$sql = 'INSERT INTO guest_table(id, name, dob, typ, national, occupation, cadd, image, indate)
VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, :image, sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $dob, PDO::PARAM_STR);
$stmt->bindValue(':a3', $typ, PDO::PARAM_INT);
$stmt->bindValue(':a4', $national, PDO::PARAM_STR);
$stmt->bindValue(':a5', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':a6', $cadd, PDO::PARAM_STR);
$stmt->bindValue(':image', $fileNameToSave, PDO::PARAM_STR);
// :imageを$file_nameで追加！
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
showSqlErrorMsg($stmt);
} else {
//index.phpへリダイレクト
header('Location: index.php');
}

