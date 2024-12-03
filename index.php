<?php
  
  date_default_timezone_set("asia/Tokyo");

  $comment_array = array();
  $dbh = null;
  $stmt = null;
  $error_messages = array();

  // db 接続
  try {
    $dbh = new PDO('mysql:host=localhost;dbname=bulletin_board', "root", "");
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  // ユーザーネーム＆コメントを取得
  if (!empty($_POST['submitButton'])) {

    if (empty($_POST['username'])) {
      echo "ユーザーネームを入力してください。";
      $error_messages['username'] = 'ユーザーネームを入力してください。';
    } 
    if (empty($_POST['comment'])) {
      echo "コメントを入力してください。";
      $error_messages['comment'] = 'コメントを入力してください。';
    }

  if (empty($error_messages)) {
    $postDate = date("Y-m-d H:i:s");

    try {
      $stmt = $dbh->prepare("INSERT INTO `bb-table` (`userName`, `comment`, `postDate`) VALUES (:userName, :comment, :postDate);");
      $stmt->bindParam(':userName', $_POST['username']);
      $stmt->bindParam(':comment', $_POST['comment']);
      $stmt->bindParam(':postDate', $postDate);
  
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
  }

  // dbからコメントデータを取得する
  $sql = "SELECT * FROM `bb-table`;";
  $comment_array = $dbh->query($sql);

  // dbの接続を閉じる
  $dbh = null;


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP掲示板</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <h1 class="title">PHP掲示板アプリ</h1>
  <hr>

  <div class="boardWrapper">
    <!-- 出力コメント -->
    <section>
      <!-- php loop -->
      <?php foreach($comment_array as $comment): ?>
      <article>
        <div class="wrapper">
          <div class="nameArea">
            <span>名前：</span>
            <p class="username"><?php echo $comment["userName"]?></p>
            <time>:<?php echo $comment["postDate"]?></time>
          </div>
          <p class="comment"><?php echo $comment["comment"]?></p>
        </div>
      </article>
      <!-- php close -->
       <?php endforeach; ?>
    </section>
    <!-- コメントフォーム -->
    <form class="formWrapper" method="post" autocomplete="off">
      <div>
        <input type="submit" value="書き込む" name="submitButton">
        <label for="">名前：</label>
        <input type="text" name="username">
      </div>
      <div>
        <textarea class="commentTextArea" name="comment" style="resize: none;"></textarea>
      </div>
    </form>
  </div>
</body>
</html>