<?php
    $dbHost = getenv('DB_HOST');
    $dbName = getenv('DB_NAME');
    $dbUSER = getenv('DB_USER');
    $dbPW = getenv('DB_PW');
    $result = "";
    if (isset($_POST['db'])) {
        // データベースに接続
      $pdo = new PDO(
        // ホスト名、データベース名
        "mysql:host={$dbHost};dbname={$dbName};",
        // ユーザー名
        $dbUSER,
        // パスワード
        $dbPW,
        // レコード列名をキーとして取得させる
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]
      );

      // SQL文をセット
      $stmt = $pdo->prepare('SELECT * FROM users');

      // SQL文を実行
      $stmt->execute();

      // ループして1レコードずつ取得
      foreach ($stmt as $row) {
        var_dump($row);
      }
    }
    elseif (isset($_POST['redis'])) {
        // Redisに接続
      $redis = new Redis();
      $redis->connect('127.0.0.1', 6379);
      // 値を設定
      $redis->set('key', 'value');
      // 値を取得
      echo 'key:' . $redis->get('key') . '<br/>';
      // 値を削除
      $redis->delete('key');
      // 再度値を取得
      echo 'key:' . $redis->get('key') . '<br/>';
      $redis->close();
    }
    else {
        $result = "削除しました";
    }
    echo $result;
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>PHPでクリックされたボタンに応じて別の処理を実行する方法</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <button type="submit" name="db">DB接続</button>
            <button type="submit" name="redis">redis</button>
            <button type="submit" name="remove">削除</button>
        </form>
    </body>
</html>