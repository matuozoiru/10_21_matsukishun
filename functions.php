<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function connectToDb()
{
  $dbn = 'mysql:dbname=gsf_d03_db21;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = 'root';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}

//SQL処理エラー
function showSqlErrorMsg($stmt)
{
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function nav()
{
  $nav = '<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">宿泊台帳一覧</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">宿泊台帳登録</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="select.php">台帳一覧</a>
          </li>
        </ul>
      </div>
    </nav>';
}

// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
  // ログイン失敗時の処理（ログイン画面に移動）
  if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
    header('Location: login.php');
  } else {

    // ログイン成功時の処理（一覧画面に移動）
    session_regenerate_id(true);
    $_SESSION['chk_ssid'] = session_id();
  }
}

//管理者ログイン
function chk_kanri()
{
  if ($_SESSION['kanri_flg'] == 0) {
    header('Location: select.php');
  }
}

// menuを決める
function menu()
{
  $menu = '<li class="nav-item"><a class="nav-link" href="index.php">todo登録</a></li><li class="nav-item"><a class="nav-link" href="select.php">todo一覧</a></li>';
  $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';

  return $menu;
}