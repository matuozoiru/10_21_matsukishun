<?php
include('functions.php');

// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM guest_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
  // エラーのとき
  showSqlErrorMsg($stmt);
} else {
  // エラーでないとき
  $rs = $stmt->fetch();
  // fetch()で1レコードを取得して$rsに入れる
  // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
  // var_dump()で見てみよう
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>todo更新ページ</title>
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

  <form method="post" action="update.php">
    <div class="form-group">
      <label for="name">名前</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter task" value="<?= $rs['name'] ?>">
    </div>
    <div class="form-group">
      <label for="date">生年月日</label>
      <input type="date" class="form-control" id="dob" name="dob" value="<?= $rs['dob'] ?>">
    </div>
    <div class="form-group">
      <label for="typ"></label>
      <p>旅行タイプ：<br>
        <select name="type">
          <option value="0">ファミリー：６歳以下の子供</option>
          <option value="1">ファミリー</option>
          <option value="2">カップル</option>
          <option value="3">友達</option>
          <option value="4" selected>１人旅</option>
          <option value="5">出張</option>
        </select></p>
    </div>
    <div class="form-group">
      <label for="national">国籍</label>
      <input type="text" class="form-control" id="national" name="national" value="<?= $rs['national'] ?>">
    </div>
    <div class="form-group">
      <label for="occupation">職業</label>
      <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $rs['occupation'] ?>">
    </div>
    <div class="form-group">
      <label for="cadd">現住所</label>
      <textarea class="form-control" id="cadd" name="cadd" rows="3"><?= $rs['cadd'] ?></textarea>
    </div>
    <div class="form-group">
      <label for="upfile">ID</label>
      <!-- <-- inputを追加 -->
      <input type="file" class="form-control-file" id="upfile" name="upfile" accept="image/*" capture="camera">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <!-- idは変えたくない = ユーザーから見えないようにする-->
    <input type="hidden" name="id" value="<?= $rs['id'] ?>">
  </form>

</body>

</html>