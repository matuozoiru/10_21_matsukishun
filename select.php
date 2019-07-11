<?php
include('functions.php');

//DB接続
$pdo = connectToDb();

//データ表示SQL作成
$sql = 'SELECT * FROM guest_table ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

$type = '.タイプ:';

//データ表示
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  $view = '';
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<li class="list-group-item">';
    $view .= '<p>' . '名前：' . $result['name'] . '</p>';
    $view .= '<p>' . '生年月日：' . $result['dob'] . '</p>';
    if ($result['typ'] == 0) {
      $view .= '<p>旅行タイプ : ファミリー：６歳以下 の 子 供</p>';
    } elseif ($result['typ'] == 1) {
      $view .= '<p>旅行タイプ : ファミリー</p>';
    } elseif ($result['typ'] == 2) {
      $view .= '<p>旅行タイプ : カップル</p>';
    } elseif ($result['typ'] == 3) {
      $view .= '<p>旅行タイプ : 友達</p>';
    } elseif ($result['typ'] == 4) {
      $view .= '<p>旅行タイプ : １人旅</p>';
    } elseif ($result['typ'] == 5) {
      $view .= '<p>旅行タイプ : 出張</p>';
    }
    $view .= '<p>' . '国籍：' . $result['national'] . '</p>';
    $view .= '<p>' . '仕事：' . $result['occupation'] . '</p>';
    $view .= '<p>' . '現住所：' . $result['cadd'] . '</p>';
    // imgタグで出力しよう！
    $view .= '<p>ID :</p>';
    $view .= '<img src="' . $result['image'] . '" alt="" height="150px">';
    $view .= '<div><a href="detail.php?id=' . $result['id'] . '" class="badge badge-primary">Edit</a>';
    $view .= '<a href="delete.php?id=' . $result['id'] . '" class="badge badge-danger">Delete</a></div>';
    $view .= '</li>';
  }
}

// if ($result['typ'] == 0) {
// $view .= '<p>ファミリー：６歳以下 の 子 供 </p>';
// } elseif ($result['typ'] == 1) {
// $show = '<li><a>ファミリー</a></li>';
// }
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>台帳リスト表示</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">宿泊台帳</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">宿泊台帳入力</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="select.php">台帳一覧</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <div>
    <ul class="list-group">
      <?= $view ?>
  </div>

</body>

</html>